# -*- coding: utf-8 -*-
# ==============================================================================
# SKRIP LAYANAN AI DENGAN FLASK (VERSI DENGAN PERBAIKAN CORS)
# ==============================================================================

# Step 1: PASTIKAN LIBRARY SUDAH TERINSTAL
# pip install Flask flask-cors transformers torch pandas python-levenshtein

# Step 2: IMPORT SEMUA MODUL
from flask import Flask, request, jsonify
from flask_cors import CORS # <-- 1. TAMBAHKAN IMPORT INI
import torch
import torch.nn as nn
import numpy as np
import json
import Levenshtein
from transformers import DistilBertTokenizer, DistilBertModel
import os

# ==============================================================================
# Step 3: KONFIGURASI DAN PEMUATAN MODEL (DILAKUKAN SEKALI SAAT STARTUP)
# ==============================================================================
print("--- MEMUAT MODEL DAN KONFIGURASI ---")

# Konfigurasi Model
DEVICE = torch.device("cpu")
MODEL_NAME = 'distilbert-base-uncased'
MAX_LEN = 128
PREDICTION_THRESHOLD = 0.3

# Path ke file artefak
MODEL_PATH = 'ai_models/best_model_state.bin'
LABELS_PATH = 'ai_models/all_unique_labels.json'
VOCAB_PATH = 'ai_models/domain_words.txt'
SECTORS_PATH = 'ai_models/all_sectors.json'
SUB_SECTORS_PATH = 'ai_models/all_sub_sectors.json'

# Memuat semua file artefak
with open(LABELS_PATH, 'r') as f: all_unique_labels = json.load(f)
with open(VOCAB_PATH, 'r') as f: domain_words = [line.strip() for line in f]
with open(SECTORS_PATH, 'r') as f: all_sectors = set(json.load(f))
with open(SUB_SECTORS_PATH, 'r') as f: all_sub_sectors = set(json.load(f))
id_to_label = {i: label for i, label in enumerate(all_unique_labels)}

# Mendefinisikan arsitektur model
class BERTClass(torch.nn.Module):
    def __init__(self, num_labels):
        super(BERTClass, self).__init__()
        self.bert = DistilBertModel.from_pretrained(MODEL_NAME)
        self.classifier = torch.nn.Linear(768, num_labels)
    def forward(self, ids, mask):
        hidden_state = self.bert(input_ids=ids, attention_mask=mask)[0]
        return self.classifier(hidden_state[:, 0])

# Memuat "otak" AI
model = BERTClass(len(all_unique_labels))
model.load_state_dict(torch.load(MODEL_PATH, map_location=DEVICE))
model.to(DEVICE)
model.eval()

# Memuat tokenizer
tokenizer = DistilBertTokenizer.from_pretrained(MODEL_NAME)

print("--- MODEL DAN KONFIGURASI SIAP! ---")

# ==============================================================================
# Step 4: FUNGSI UNTUK PREDIKSI (TIDAK BERUBAH)
# ==============================================================================
def correct_spelling_levenshtein(text, vocab, max_dist=2):
    # ... (logika koreksi ejaan Anda)
    words = text.lower().strip().split()
    corrected = []
    for word in words:
        if not word or word in vocab:
            corrected.append(word)
            continue
        best_match = min(vocab, key=lambda v: Levenshtein.distance(word, v))
        if Levenshtein.distance(word, best_match) <= max_dist:
            corrected.append(best_match)
        else:
            corrected.append(word)
    return " ".join(corrected)

def predict_activity(text):
    # ... (logika prediksi Anda)
    corrected_text = correct_spelling_levenshtein(text, domain_words)
    tokenized = tokenizer.encode_plus(
        corrected_text, None, max_length=MAX_LEN, padding='max_length', 
        return_token_type_ids=True, truncation=True
    )
    ids = torch.tensor(tokenized['input_ids'], dtype=torch.long).unsqueeze(0).to(DEVICE)
    mask = torch.tensor(tokenized['attention_mask'], dtype=torch.long).unsqueeze(0).to(DEVICE)
    with torch.no_grad():
        outputs = model(ids, mask)
        probs = torch.sigmoid(outputs).detach().cpu().numpy()[0]
    predicted_labels = [id_to_label[i] for i, p in enumerate(probs) if p > PREDICTION_THRESHOLD]
    sectors = [p for p in predicted_labels if p in all_sectors]
    subsectors = [p for p in predicted_labels if p in all_sub_sectors]
    return corrected_text, sectors, subsectors

# ==============================================================================
# Step 5: MEMBUAT APLIKASI FLASK DAN ENDPOINT API
# ==============================================================================
app = Flask(__name__)
CORS(app) # <-- 2. TAMBAHKAN BARIS INI UNTUK MENGIZINKAN SEMUA KONEKSI

@app.route('/predict', methods=['POST'])
def handle_prediction():
    if not request.json or 'text' not in request.json:
        return jsonify({'error': 'Request harus berisi JSON dengan key "text"'}), 400
    
    input_text = request.json['text']
    
    if not input_text.strip():
        return jsonify({'corrected_text': '', 'sectors': [], 'sub_sectors': []})

    corrected_text, sectors, subsectors = predict_activity(input_text)
    
    return jsonify({
        'corrected_text': corrected_text,
        'sectors': sectors,
        'sub_sectors': subsectors
    })

if __name__ == '__main__':
    # <-- 3. NAMA FILE DI SINI SEKARANG SESUAI
    app.run(host='0.0.0.0', port=5000, debug=True)
