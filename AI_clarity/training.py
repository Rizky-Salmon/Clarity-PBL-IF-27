# -*- coding: utf-8 -*-
# ==============================================================================
# SKRIP PELATIHAN (TRAINING)
# Tujuan: Melatih model BERT dari awal dan menghasilkan 5 file artefak.
# Jalankan skrip ini di lingkungan lokal Anda (misalnya, di dalam VS Code).
# ==============================================================================

# Step 1: INSTALASI LIBRARY YANG DIBUTUHKAN
# Pastikan Anda telah menginstal library ini di lingkungan Python Anda.
# Anda bisa menjalankan 'pip install transformers torch pandas scikit-learn python-levenshtein tqdm' di terminal.
print("Memeriksa dan menginstal library jika diperlukan...")
try:
    import transformers
except ImportError:
    import subprocess
    import sys
    subprocess.check_call([sys.executable, "-m", "pip", "install", "transformers", "torch", "pandas", "scikit-learn", "python-levenshtein", "tqdm"])

# Step 2: IMPORT SEMUA MODUL
import pandas as pd
import numpy as np
import torch
import torch.nn as nn
import re
import Levenshtein
import json
from torch.utils.data import Dataset, DataLoader
from torch.optim import AdamW 
from transformers import DistilBertTokenizer, DistilBertModel, get_linear_schedule_with_warmup
from sklearn.model_selection import train_test_split
from sklearn.metrics import f1_score
from tqdm import tqdm
import os

# ==============================================================================
# Step 3: KONFIGURASI DAN PARAMETER UTAMA
# ==============================================================================
# --- GANTI NAMA FILE INI SESUAI DENGAN NAMA DATASET ANDA ---
DATASET_PATH = 'datatest (1).csv' 

DEVICE = torch.device("cuda" if torch.cuda.is_available() else "cpu")
MODEL_NAME = 'distilbert-base-uncased'
MAX_LEN = 128
TRAIN_BATCH_SIZE = 8
VALID_BATCH_SIZE = 8
EPOCHS = 50
LEARNING_RATE = 2e-5
PREDICTION_THRESHOLD = 0.3

print(f"Menggunakan device: {DEVICE}")

# ==============================================================================
# Step 4: MEMUAT DAN MEMBERSIHKAN DATA
# ==============================================================================
if not os.path.exists(DATASET_PATH):
    print(f"\nError: File dataset '{DATASET_PATH}' tidak ditemukan.")
    print("Pastikan file CSV berada di folder yang sama dengan skrip ini, atau ganti variabel DATASET_PATH.")
else:
    df = pd.read_csv(DATASET_PATH)
    print(f"\nFile '{DATASET_PATH}' berhasil dimuat. Bentuk: {df.shape}")

    df.columns = df.columns.str.lower().str.strip().str.replace(' ', '_').str.replace('-', '_')
    df.dropna(subset=['activities'], inplace=True)
    df['activities'] = df['activities'].str.strip()
    
    sector_cols = ['sector_1', 'sector_2', 'sector_3']
    sub_sector_cols = ['sub_sector_1', 'sub_sector_2', 'sub_sector_3']
    
    df['all_sectors'] = df[sector_cols].values.tolist()
    df['all_sectors'] = df['all_sectors'].apply(lambda x: list(set(str(i).strip() for i in x if pd.notna(i) and str(i).strip().lower() != 'nan')))

    df['all_sub_sectors'] = df[sub_sector_cols].values.tolist()
    df['all_sub_sectors'] = df['all_sub_sectors'].apply(lambda x: list(set(str(i).strip() for i in x if pd.notna(i) and str(i).strip().lower() != 'nan')))

    df['all_labels'] = df['all_sectors'] + df['all_sub_sectors']
    
    all_unique_labels = sorted(list(set(label for sublist in df['all_labels'] for label in sublist)))
    all_unique_sectors = sorted(list(set(label for sublist in df['all_sectors'] for label in sublist)))
    all_unique_sub_sectors = sorted(list(set(label for sublist in df['all_sub_sectors'] for label in sublist)))
    
    print(f"Total label unik yang ditemukan: {len(all_unique_labels)}")
    
    label_to_id = {label: i for i, label in enumerate(all_unique_labels)}
    
    print("\nMembuat Kamus Domain untuk Koreksi Ejaan...")
    corpus = ' '.join(df['activities']).lower()
    domain_words = list(set(re.findall(r'\b\w+\b', corpus)))
    print(f"Kamus domain dengan {len(domain_words)} kata unik berhasil dibuat.")

# ==============================================================================
# Step 5 & 6 & 7: Definisi Dataset, Model, dan Fungsi Pelatihan
# ==============================================================================
class CustomDataset(Dataset):
    def __init__(self, dataframe, tokenizer, max_len, all_unique_labels, label_to_id):
        self.tokenizer = tokenizer
        self.text = dataframe.activities.values
        self.all_labels_list = dataframe.all_labels.values
        self.max_len = max_len
        self.all_unique_labels = all_unique_labels
        self.label_to_id = label_to_id
        self.targets = self.binarize_labels(self.all_labels_list)

    def __len__(self):
        return len(self.text)

    def binarize_labels(self, labels_list):
        binarized = np.zeros((len(labels_list), len(self.all_unique_labels)), dtype=float)
        for i, labels in enumerate(labels_list):
            for label in labels:
                if label in self.label_to_id:
                    binarized[i, self.label_to_id[label]] = 1.0
        return binarized

    def __getitem__(self, index):
        text = str(self.text[index])
        inputs = self.tokenizer.encode_plus(
            text, None, add_special_tokens=True, max_length=self.max_len,
            padding='max_length', return_token_type_ids=True, truncation=True
        )
        return {
            'ids': torch.tensor(inputs['input_ids'], dtype=torch.long),
            'mask': torch.tensor(inputs['attention_mask'], dtype=torch.long),
            'targets': torch.tensor(self.targets[index], dtype=torch.float)
        }

class BERTClass(torch.nn.Module):
    def __init__(self, num_labels):
        super(BERTClass, self).__init__()
        self.bert = DistilBertModel.from_pretrained(MODEL_NAME)
        self.dropout = torch.nn.Dropout(0.3)
        self.classifier = torch.nn.Linear(768, num_labels)

    def forward(self, ids, mask):
        output_1 = self.bert(input_ids=ids, attention_mask=mask)
        hidden_state = output_1[0]
        pooler = hidden_state[:, 0]
        output = self.classifier(self.dropout(pooler))
        return output

def loss_fn(outputs, targets):
    return torch.nn.BCEWithLogitsLoss()(outputs, targets)

def train_fn(data_loader, model, optimizer, device, scheduler):
    model.train()
    for d in tqdm(data_loader, desc="Training", leave=False):
        ids, mask, targets = d['ids'].to(device), d['mask'].to(device), d['targets'].to(device)
        optimizer.zero_grad()
        outputs = model(ids=ids, mask=mask)
        loss = loss_fn(outputs, targets)
        loss.backward()
        optimizer.step()
        scheduler.step()

def eval_fn(data_loader, model, device):
    model.eval()
    fin_targets = []
    fin_outputs = []
    with torch.no_grad():
        for d in tqdm(data_loader, desc="Validating", leave=False):
            ids, mask, targets = d['ids'].to(device), d['mask'].to(device), d['targets'].to(device)
            outputs = model(ids=ids, mask=mask)
            fin_targets.extend(targets.cpu().detach().numpy().tolist())
            fin_outputs.extend(torch.sigmoid(outputs).cpu().detach().numpy().tolist())
    return fin_outputs, fin_targets

# ==============================================================================
# Step 8: MENJALANKAN PROSES UTAMA
# ==============================================================================
if 'df' in locals():
    train_df, valid_df = train_test_split(df, test_size=0.2, random_state=42)
    train_df, valid_df = train_df.reset_index(drop=True), valid_df.reset_index(drop=True)

    tokenizer = DistilBertTokenizer.from_pretrained(MODEL_NAME)

    train_dataset = CustomDataset(train_df, tokenizer, MAX_LEN, all_unique_labels, label_to_id)
    valid_dataset = CustomDataset(valid_df, tokenizer, MAX_LEN, all_unique_labels, label_to_id)
    train_data_loader = DataLoader(train_dataset, batch_size=TRAIN_BATCH_SIZE, shuffle=True)
    valid_data_loader = DataLoader(valid_dataset, batch_size=VALID_BATCH_SIZE)

    model = BERTClass(len(all_unique_labels))
    model.to(DEVICE)
    
    optimizer = AdamW(model.parameters(), lr=LEARNING_RATE)
    num_training_steps = int(len(train_df) / TRAIN_BATCH_SIZE * EPOCHS)
    scheduler = get_linear_schedule_with_warmup(optimizer, num_warmup_steps=0, num_training_steps=num_training_steps)
    
    best_f1_score = 0.0
    
    print("\n--- MEMULAI PROSES FINE-TUNING & VALIDASI ---")
    for epoch in range(EPOCHS):
        print(f"--- Epoch {epoch + 1}/{EPOCHS} ---")
        train_fn(train_data_loader, model, optimizer, DEVICE, scheduler)
        outputs, targets = eval_fn(valid_data_loader, model, DEVICE)
        
        final_outputs = (np.array(outputs) > PREDICTION_THRESHOLD).astype(int)
        score = f1_score(targets, final_outputs, average='micro')
        print(f"Validation F1 Score = {score:.4f}")
        
        if score > best_f1_score:
            print(f"F1 Score meningkat ({best_f1_score:.4f} --> {score:.4f}). Menyimpan model...")
            torch.save(model.state_dict(), 'best_model_state.bin')
            best_f1_score = score
            
    print(f"\n--- PELATIHAN SELESAI --- Best Validation F1 Score: {best_f1_score:.4f}")
    
    # ==============================================================================
    # Step 9: MENYIMPAN SEMUA ARTEFAK UNTUK PREDIKSI
    # ==============================================================================
    print("\nMenyimpan artefak pendukung...")
    with open('all_unique_labels.json', 'w') as f:
        json.dump(all_unique_labels, f)
    with open('domain_words.txt', 'w') as f:
        for word in domain_words: f.write(f"{word}\n")
    with open('all_sectors.json', 'w') as f:
        json.dump(all_unique_sectors, f)
    with open('all_sub_sectors.json', 'w') as f:
        json.dump(all_unique_sub_sectors, f)

    print("\nArtefak berhasil disimpan di folder yang sama dengan skrip ini:")
    print("1. best_model_state.bin")
    print("2. all_unique_labels.json")
    print("3. domain_words.txt")
    print("4. all_sectors.json")
    print("5. all_sub_sectors.json")
