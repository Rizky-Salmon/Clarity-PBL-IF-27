@extends('layouts.admin')

@section('title', 'Manage Sector')

@push('head-script')
<!-- Custom styles for this page -->
<link href="\vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- CSS DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.8/css/jquery.dataTables.css">

@endpush

@section('content')

<!-- DataTales Sector -->
<div class="card shadow mb-4">

    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <div style="display: flex; align-items: center;">

            <img src="{{ asset('/img/sector.png') }}" style="height: 60px; width: 60px; margin-right: 10px;">
            <h3 style="margin-top: 10px; font-weight: bold; color: black;">Sector</h3>
        </div>
        <!-- Add sector button -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSectorModal">
            <i class="fas fa-plus"></i> Add Sector
        </button>
        <div class="modal fade" id="addSectorModal" tabindex="-1" role="dialog" aria-labelledby="addSectorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSectorModalLabel">Add Sector</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sector.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="add_sectorName">Sector Name</label>
                                <input type="text" class="form-control @error('add_sectorName') is-invalid @enderror" id="add_sectorName" name="add_sectorName" placeholder="Enter Sector Name" value="{{ old('add_sectorName') }}" required>
                                @error('add_sectorName')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror

                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Add Sector</button>
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
                        <th width="5%" style="text-align: center;">No</th>
                        <th style="text-align: center;">Sector</th>
                        <th style="text-align: center;">Subsector</th>
                        <th width="30%" style="text-align: center; width: 190px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection


@push('footer-script')
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    var datatable = $('#dataTable').DataTable({
        processing: true
        , serverSide: true
        , ordering: true
        , ajax: {
            url: window.location.href
        }
        , columns: [{
                data: null,
                name: 'id_sector', // Sesuaikan dengan kolom yang digunakan sebagai identitas unik
                render: function(data, type, row, meta) {
                    // Mengembalikan nomor urut berdasarkan posisi data dalam tabel,
                    // termasuk nomor halaman dan jumlah entri per halaman
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'sector_name'
                , name: 'sector_name'
            }
            , {
                data: 'subsector'
                , name: 'subsector'
            }

            , {
                data: 'action'
                , name: 'action'
                , orderable: false
                , searcable: false
                , width: '15%'
            }
        , ]
    })

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

@endpush
