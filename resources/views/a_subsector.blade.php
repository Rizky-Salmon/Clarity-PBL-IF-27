@extends('layouts.admin')

@section('title', 'Manage Sub Sector')


@push('head-script')
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endpush

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <div style="display: flex; align-items: center;">
                <img src="/img/logoaneh.png" style="height: 60px; width: 60px; margin-right: 10px;">
                <h3 style="margin-top: 10px; font-weight: bold; color: black;">Subsector </h3>
            </div>

            <div class="float-right">
                <button type="button" class="btn btn-primary" id="buttonSelectedFilter" data-toggle="modal" data-target="#filterSector">
                    <i class="fas fa-filter"></i> Filter Sector
                </button>
                <!--Add subsector button-->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSubsectorModal">
                    <i class="fas fa-plus"></i> Add Sub Sector
                </button>

            </div>


            <div class="modal fade" id="addSubsectorModal" tabindex="-1" role="dialog" aria-labelledby="addSubsectorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSubsectorModalLabel">Add Subsector</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('subsector.store') }}" method="POST">
                            @csrf
                                <div class="form-group">
                                    <label for="addSectorName">Sector Name</label>
                                    <select name="addSectorName" class="form-control" id="addSectorName"
                                    selectedOption="{{ old('addSectorName') }}">
                                        <option value="">- Select Sector -</option>
                                        @forelse($sector as $key => $value)
                                        <option value="{{ $value->id_sector }}">{{ $value->sector_name }}</option>
                                        @empty
                                        <option value="">No Sector</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="addSubsectorName">Subsector Name</label>
                                    <input type="text" class="form-control @error('add_SubsectorName') is-invalid @enderror" id="add_SubsectorName" placeholder="Enter Subsector Name" value="{{ old('add_SubsectorName') }}" required>
                                    @error('add_SubsectorName')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="addSubsectorDescription">Description</label>
                                    <textarea class="form-control @error('add_SubsectorDescription') is-invalid @enderror" id="add_SubsectorDescription" rows="3" placeholder="Enter Description" value="{{ old('add_SubsectorDescription') }}" required></textarea>
                                    @error('add_SubsectorDescription')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Add Subsector</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="filterSector" tabindex="-1" role="dialog" aria-labelledby="addSubsectorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSubsectorModalLabel">Filter Sector</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/a_subsector" method="get">
                                <div class="form-group">
                                    <label for="addSectorName">Sector</label>

                                    <select name="id_sector" class="form-control" id="id_sector" selectedOption="{{ $selectedSector ? $selectedSector : 'All' }}">
                                        <option value="">- Select Sector -</option>
                                        <option value="All">All Sector</option>

                                        @forelse($sector as $key => $value)
                                        <option value="{{ $value->id_sector }}">{{ $value->sector_name }}</option>
                                        @empty
                                        <option value="">No Sector</option>

                                        @endforelse
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Apply</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <p>Showing filter for : <small id="textOption"><i class="fas fa-spin fa-spinner"></i></small></p>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center;">No</th>
                            <th style="text-align: center;">Sector</th>
                            <th style="text-align: center;">Subsector</th>
                            <th style="text-align: center;">Description</th>
                            <th style="text-align: center; width: 190px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection


@push('footer-script')
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>


<script>
    var datatable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: window.location.href
        },
        columns: [
            {
                data: 'id_subsector',
                name: 'id_subsector'
            },
            {
                data: 'sector_name',
                name: 'sector_name'
            },
            {
                data: 'subsector_name',
                name: 'subsector_name'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%'
            }
        ]
    });
</script>


<script>
    $(document).ready(function() {
        var selectedValue = $('#id_sector').attr('selectedOption');
        // var buttonFilter = $('#buttonSelectedFilter');

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
@endpush
