@extends('layouts.admin')

@section('title', 'Manage Activity')

@push('head-script')
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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

        <!-- Modal -->
        <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="addActivityModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addActivityModalLabel">Add Activity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form statis (tidak pakai DB) -->
                        <form>
                            <div class="form-group">
                                <label for="add_activityName">Activities</label>
                                <textarea class="form-control" id="add_activityName" rows="3"
                                    placeholder="Enter The Activities Name" required></textarea>
                            </div>
                            @for ($i = 1; $i <= 3; $i++)
                            <div class="form-group">
                                <label for="addSubsector{{ $i }}">Subsector {{ $i }}</label>
                                <select class="form-control subsector-dropdown" id="addSubsector{{ $i }}">
                                    <option value="">- Choose Subsector -</option>
                                    <optgroup label="Sector: Agriculture">
                                        <option value="1">Rice Farming</option>
                                        <option value="2">Corn Cultivation</option>
                                    </optgroup>
                                    <optgroup label="Sector: Fisheries">
                                        <option value="3">Aquaculture</option>
                                        <option value="4">Fish Processing</option>
                                    </optgroup>
                                </select>
                            </div>
                            @endfor
                            <button type="submit" class="btn btn-primary" style="margin-left: 140px;">Add Activity</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Activities</th>
                        <th style="text-align: center;">Sector 1</th>
                        <th style="text-align: center;">Sector 2</th>
                        <th style="text-align: center;">Sector 3</th>
                        <th style="text-align: center; width: 190px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td>Planting Rice</td>
                        <td>Rice Farming</td>
                        <td>Corn Cultivation</td>
                        <td>Aquaculture</td>
                        <td style="text-align: center;">
                        <button class="btn btn-warning btn-sm">
    <i class="fa-solid fa-pen-to-square"></i>
</button>
<button class="btn btn-danger btn-sm">
    <i class="fa-solid fa-trash"></i>
</button>
                        </td>
                    </tr>
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
    $(document).ready(function () {
        $('#dataTable').DataTable();

        $('.subsector-dropdown').change(function () {
            var selectedValues = [];
            $('.subsector-dropdown').each(function () {
                var value = $(this).val();
                if (value) {
                    selectedValues.push(value);
                }
            });
        });

        $('.subsector-dropdown').trigger('change');
    });
</script>
@endpush
