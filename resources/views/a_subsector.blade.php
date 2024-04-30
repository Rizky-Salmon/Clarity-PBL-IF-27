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
                            <form>
                                <div class="form-group">
                                    <label for="addSectorName">Sector Name</label>
                                    <input type="text" class="form-control" id="addSectorName" required>
                                </div>
                                <div class="form-group">
                                    <label for="addSubsectorName">Subsector Name</label>
                                    <input type="text" class="form-control" id="addSubsectorName" required>
                                </div>
                                <div class="form-group">
                                    <label for="addSectorDescription">Description</label>
                                    <textarea class="form-control" id="addSectorDescription" rows="3" required></textarea>
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

                        @forelse ( $subsector as $key => $value )
                        <tr>
                            <td>{{ $key++ }}.</td>
                            <td>{{ $value->sectorData->sector_name }}</td>
                            <td>{{ $value->subsector_name }}</td>
                            <td>{{ $value->subsector_name }}</td>
                            <th>
                                <div class="edit-subsector-buttons">
                                    <a href="#" data-toggle="modal" data-target="#editSubsectorModal">
                                        <button type="button" class="btn btn-success btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#deleteSubsectorModal">
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </a>
                                </div>
                            </th>

                            <div class="modal fade" id="editSubsectorModal" tabindex="-1" role="dialog" aria-labelledby="editSubsectorModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editSubsectorModalLabel">Update Subsector!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="subsectorName">Subsector</label>
                                                    <input type="text" class="form-control" id="subsectorName">
                                                </div>
                                                <div class="form-group">
                                                    <label for="subsectorDescription">Description</label>
                                                    <textarea class="form-control" id="subsectorDescription" rows="3"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Save Changes</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="deleteSubsectorModal" tabindex="-1" role="dialog" aria-labelledby="deleteSubsectorModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteSubsectorModalLabel">Delete Subsector</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this subsector?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger">Delete</button>
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        @empty

                        @endforelse

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
<script src="/js/demo/datatables-demo.js"></script>


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
@endpush
