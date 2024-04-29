@extends('layouts.admin')

@section('title', 'Manage Sector')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <div style="display: flex; align-items: center;">
                <img src="img/logoaneh.png" style="height: 60px; width: 60px; margin-right: 10px;">
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
                                    <label for="addSectorName">Sector Name</label>
                                    <input type="text" class="form-control" id="addSectorName" required>
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
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Sector</th>
                            <th style="text-align: center; width: 190px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sector as $sec)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sec->sector_name }}</td>
                            <td>
                                <div class="edit-sector-buttons">
                                    <a href="#" data-toggle="modal" data-target="#editSectorModal">
                                        <button type="button" class="btn btn-success btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#deleteSectorModal{{ $sec->id_sector }}">
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="editSectorModal" tabindex="-1" role="dialog" aria-labelledby="editSectorModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSectorModalLabel">Update
                                            Sector</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('sector.update', $sec->id_sector) }}" method="POST">
                                            @method('PUT')
                                            @csrf

                                            <input type="hidden" name="id_sector" value="{{ $sec->id_sector }}">
                                            <div class="form-group">
                                                <label for="sectorName">Sector</label>
                                                <input type="text" class="form-control" id="sectorName" name="sector_name" value="{{ $sec->sector_name }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Save Changes</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="deleteSectorModal{{ $sec->id_sector }}" tabindex="-1" role="dialog" aria-labelledby="deleteSectorModalLabel{{ $sec->id_sector }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteSectorModalLabel{{ $sec->id_sector }}">Delete
                                            Sector</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this sector?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('sector.destroy', $sec->id_sector) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
