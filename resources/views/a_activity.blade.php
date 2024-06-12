@extends('layouts.admin')

@section('title', 'Manage Activity')

@push('head-script')
    <!-- Custom styles for this page -->
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- CSS DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.8/css/jquery.dataTables.css">
@endpush

@section('content')

    <!-- DataTables Activity -->
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
                            <form action="{{ route('activity.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="add_activityName">Activities</label>
                                    <textarea class="form-control" id="add_activityName" name="add_activityName" rows="3"
                                        placeholder="Enter The Activities Name" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="addSubsector1">Subsector 1</label>
                                    <select name="subsector_id1" class="form-control subsector-dropdown" id="addSubsector1"
                                        required>
                                        <option value="">- Choose Subsector -</option>
                                        @foreach ($sectors as $sector)
                                            <optgroup label="Sector: {{ $sector->sector_name }}">
                                                @foreach ($sector->subSectors as $subsector)
                                                    <option value="{{ $subsector->id_subsector }}">
                                                        {{ $subsector->subsector_name }}</option>
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
                                                    <option value="{{ $subsector->id_subsector }}">
                                                        {{ $subsector->subsector_name }}</option>
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
                                                    <option value="{{ $subsector->id_subsector }}">
                                                        {{ $subsector->subsector_name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Add
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
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
            var selectedValue = $('#id_sector').attr('selectedOption');

            // Mengecek jika nilai adalah kosong atau 'All', dan mengatur nilainya di select
            if (selectedValue === '' || selectedValue === 'All') {
                $('#id_sector').val('All');
            } else {
                $('#id_sector').val(selectedValue);
            }

            var selectedText = $('#id_sector option:selected').text();

            // Tampilkan teks di dalam elemen dengan ID 'textOption'
            $('#textOption').text(selectedText);
        });
    </script>

    @if (session('openModal'))
        <script>
            let modal = "{{ session('openModal') }}";
            // Tunggu 2-3 detik sebelum menampilkan modal
            setTimeout(function() {
                $('#' + modal).modal('show');
            }, 2000); // Jeda 2 detik
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.subsector-dropdown').change(function() {
                // Ambil nilai dari dropdown yang dipilih
                var selectedValues = [];
                $('.subsector-dropdown').each(function() {
                    var value = $(this).val();
                    if (value) {
                        selectedValues.push(value);
                    }
                });

                // Perbarui dropdown lainnya
                $('.subsector-dropdown').each(function() {
                    var dropdown = $(this);
                    var currentValue = dropdown.val();
                    dropdown.find('option').each(function() {
                        var option = $(this);
                        if (selectedValues.indexOf(option.val()) > -1 && option.val() !=
                            currentValue) {
                            option.prop('disabled', true);
                        } else {
                            option.prop('disabled', false);
                        }
                    });
                });
            });
        });
    </script>
@endpush
