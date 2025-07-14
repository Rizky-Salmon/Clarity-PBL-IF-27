@extends('layouts.admin')

@section('title', 'Manage Activity')

@push('head-script')
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <div style="display: flex; align-items: center;">
            <img src="{{ asset('/img/activity.png') }}" style="height: 60px; width: 60px; margin-right: 10px;">
            <h3 style="margin-top: 10px; font-weight: bold; color: black;">Activity Data</h3>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addActivityModal">
            <i class="fas fa-plus"></i> Add Activity
        </button>
        <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog"
            aria-labelledby="addActivityModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addActivityModalLabel">Add Activity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{ route('activity.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="add_activityName">Activities</label>
                                <textarea class="form-control" id="add_activityName" name="add_activityName" rows="3"
                                    placeholder="Enter The Activities Name" required>{{ old('add_activityName') }}</textarea>
                                <small id="predictionHelp" class="form-text text-muted">Ketik aktivitas untuk mendapatkan saran sub-sektor.</small>
                                <p id="correctedTextDisplay" class="text-info mt-2" style="font-style: italic;"></p>
                            </div>
                            <div class="form-group">
                                <label for="addSubsector1">Subsector 1</label>
                                <select name="subsector_id1" class="form-control subsector-dropdown" id="addSubsector1"
                                    required>
                                    <option value="">- Choose Subsector -</option>
                                    {{-- Render semua opsi subsektor dari Laravel --}}
                                    @foreach ($sectors as $sector)
                                    <optgroup label="Sector: {{ $sector->sector_name }}">
                                        @foreach ($sector->subSectors as $subsector)
                                        <option value="{{ $subsector->id_subsector }}"
                                            data-subsector-name="{{ strtolower($subsector->subsector_name) }}"
                                            {{ old('subsector_id1') == $subsector->id_subsector ? 'selected' : '' }}>
                                            {{ $subsector->subsector_name }}
                                        </option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="addSubsector2">Subsector 2</label>
                                <select name="subsector_id2" class="form-control subsector-dropdown" id="addSubsector2">
                                    <option value="">- Choose Subsector -</option>
                                    @foreach ($sectors as $sector)
                                    <optgroup label="Sector: {{ $sector->sector_name }}">
                                        @foreach ($sector->subSectors as $subsector)
                                        <option value="{{ $subsector->id_subsector }}"
                                            data-subsector-name="{{ strtolower($subsector->subsector_name) }}"
                                            {{ old('subsector_id2') == $subsector->id_subsector ? 'selected' : '' }}>
                                            {{ $subsector->subsector_name }}
                                        </option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="addSubsector3">Subsector 3</label>
                                <select name="subsector_id3" class="form-control subsector-dropdown" id="addSubsector3">
                                    <option value="">- Choose Subsector -</option>
                                    @foreach ($sectors as $sector)
                                    <optgroup label="Sector: {{ $sector->sector_name }}">
                                        @foreach ($sector->subSectors as $subsector)
                                        <option value="{{ $subsector->id_subsector }}"
                                            data-subsector-name="{{ strtolower($subsector->subsector_name) }}"
                                            {{ old('subsector_id3') == $subsector->id_subsector ? 'selected' : '' }}
                                            >
                                            {{ $subsector->subsector_name }}
                                        </option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" id="submit_activity" class="btn btn-primary" style="margin-left: 140px;">Add
                                Activity</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Activities</th>
                        <th style="text-align: center;">Subsector 1</th>
                        <th style="text-align: center;">Subsector 2</th>
                        <th style="text-align: center;">Subsector 3</th>
                        <th style="text-align: center; width: 190px;">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('footer-script')
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="/js/demo/datatables-demo.js"></script>
<script>
    var datatable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: window.location.href,
            dataSrc: function(json) {
                console.log(json);
                return json.data;
            }
        },
        columns: [{
                data: null,
                name: 'id_activity',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'activity_name',
                name: 'activity_name'
            },
            {
                data: 'subsector_name1',
                name: 'subsector_name1'
            },
            {
                data: 'subsector_name2',
                name: 'subsector_name2'
            },
            {
                data: 'subsector_name3',
                name: 'subsector_name3'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: '15%'
            }
        ]
    });
</script>

<script>
    $(document).ready(function() {
        // Cache DOM elements
        const $correctedTextDisplay = $('#correctedTextDisplay');
        const $subsectorDropdowns = $('.subsector-dropdown');

        // Extract all subsector options with their names and IDs from the HTML
        // This creates a mapping { "subsector name in lowercase": "subsector_id" }
        const allSubsectorOptions = [];
        // Pastikan untuk mengambil opsi dari *salah satu* dropdown saja, karena semua dropdown memiliki opsi yang sama
        $subsectorDropdowns.first().find('option').each(function() {
            const value = $(this).val();
            const name = $(this).data('subsector-name'); // Mengambil dari data attribute
            if (value && name) { // Pastikan value dan name ada
                allSubsectorOptions.push({
                    id: value,
                    name: name
                });
            }
        });

        let predictionTimer;
        const PREDICTION_DELAY = 500; // milliseconds, delay before sending request

        $('#add_activityName').on('input', function() {
            clearTimeout(predictionTimer);
            const inputText = $(this).val();

            if (inputText.trim().length > 2) {
                $correctedTextDisplay.text('Memeriksa ejaan & mencari sub-sektor...');
                predictionTimer = setTimeout(() => {
                    callFlaskApi(inputText);
                }, PREDICTION_DELAY);
            } else {
                clearSubsectorDropdowns();
                $correctedTextDisplay.text('');
            }
        });

        // Event listener saat modal disembunyikan (ditutup)
        $('#addActivityModal').on('hidden.bs.modal', function () {
            // Bersihkan input dan hasil prediksi saat modal ditutup
            $('#add_activityName').val('');
            clearSubsectorDropdowns();
            $correctedTextDisplay.text('');
        });


        function callFlaskApi(text) {
            const FLASK_API_URL = 'http://127.0.0.1:5000/predict'; // PASTIKAN INI SESUAI

            fetch(FLASK_API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ text: text })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('API Response:', data);

                // Tampilkan corrected_text
                if (data.corrected_text && data.corrected_text.toLowerCase() !== $('#add_activityName').val().toLowerCase()) {
                    $correctedTextDisplay.text('Correction Text: ' + data.corrected_text);
                } else {
                    $correctedTextDisplay.text('');
                }

                // Panggil fungsi untuk mengisi dropdown dengan data sub_sectors yang diterima
                populateSubsectorDropdowns(data.sub_sectors);
            })
            .catch(error => {
                console.error('Error calling Flask API:', error);
                $correctedTextDisplay.text('Gagal mengambil saran. Pastikan server AI berjalan.');
                clearSubsectorDropdowns();
            });
        }

        // --- FUNGSI POPULATE SUBSECTOR DROPDOWNS YANG DIPERBAIKI ---
        function populateSubsectorDropdowns(predictedSubsectors) {
            // Reset semua dropdown terlebih dahulu
            clearSubsectorDropdowns();

            const dropdowns = [$('#addSubsector1'), $('#addSubsector2'), $('#addSubsector3')];
            let assignedSubsectorIds = new Set(); // Untuk melacak ID subsektor yang sudah ditetapkan

            // Iterasi melalui dropdown yang tersedia (addSubsector1, addSubsector2, addSubsector3)
            for (let i = 0; i < dropdowns.length; i++) {
                const currentDropdown = dropdowns[i];

                // Cek apakah ada prediksi yang tersisa untuk dropdown ini
                if (i < predictedSubsectors.length) {
                    const predictedSubName = predictedSubsectors[i].toLowerCase(); // Ambil prediksi ke-i

                    // Cari ID dari predictedSubName di daftar allSubsectorOptions
                    // Memastikan ID belum ditugaskan ke dropdown lain
                    const matchedOption = allSubsectorOptions.find(option =>
                        option.name === predictedSubName && !assignedSubsectorIds.has(option.id)
                    );

                    if (matchedOption) {
                        currentDropdown.val(matchedOption.id); // Setel nilai dropdown
                        assignedSubsectorIds.add(matchedOption.id); // Tandai sudah ditetapkan
                    }
                } else {
                    // Jika tidak ada lagi prediksi yang tersisa, berhenti mengisi dropdown selanjutnya
                    break;
                }
            }
        }


        function clearSubsectorDropdowns() {
            $subsectorDropdowns.val(''); // Reset semua dropdown ke opsi default
        }

        // Script asli untuk dropdown yang memungkinkan pemilihan subsector yang sama tanpa menonaktifkan opsi
        // (Tetap dipertahankan, meskipun logika pengisian otomatis di atas yang lebih dominan)
        $('.subsector-dropdown').change(function() {
            var selectedValues = [];
            $('.subsector-dropdown').each(function() {
                var value = $(this).val();
                if (value) {
                    selectedValues.push(value);
                }
            });
        });

        // Inisialisasi dropdowns jika ada nilai default yang diatur dari old()
        $('.subsector-dropdown').trigger('change');
    });
</script>


@if (session('openModal'))
<script>
    let modal = "{{ session('openModal') }}";
    setTimeout(function() {
        $('#' + modal).modal('show');
    }, 2000); // Jeda 2 detik
</script>
@endif


@endpush