@extends('layouts.app')
@section('bill')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
        <!-- Add your dashboard content here -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="card-title mb-0">Bills Management</h1>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addBillModal">
                            <i class="fas fa-file-invoice"></i> Add Bills
                        </button>
                    </div>
            <!-- Add Bill Modal -->
            <div class="modal fade" id="addBillModal" tabindex="-1" role="dialog" aria-labelledby="addBillModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="addBillForm" method="post" action="{{ route('bills.store') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addBillModalLabel">Add Bill</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="billTitel">Bill Title</label>
                                    <input type="text" class="form-control" id="billTitel" name="billTitel" required>
                                </div>
                                <div class="form-group">
                                    <label for="flatsNo">Flat No.</label>
                                    <input type="number" class="form-control" id="flatsNo" name="flatsNo" required>
                                </div>
                                <div class="form-group">
                                    <label for="billAmount">Bill Amount</label>
                                    <input type="number" class="form-control" id="billAmount" name="billAmount" required>
                                </div>
                                <div class="form-group">
                                    <label for="month">Month</label>
                                    <input type="month" class="form-control" id="month" name="month" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Bill</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Bills Table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bill Title</th>
                            <th>Flat No.</th>
                            <th>Bill Amount</th>
                            <th>Paid Amount</th>
                            <th>Month</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $bill)
                            <tr>
                                <td>{{ $bill->id }}</td>
                                <td>{{ $bill->billTitel }}</td>
                                <td>{{ $bill->flatsNo }}</td>
                                <td>{{ $bill->billAmount }}</td>
                                <td>{{ $bill->paidAmount }}</td>
                                <td>{{ $bill->month }}</td>
                                <td>{{ \Carbon\Carbon::parse($bill->updated_at)->toDateString() }}</td>
                                <td>
                                    <div class="d-flex">
                                        
                                        <!-- Delete Form -->
                                        <form action="{{ route('bills.destroy', $bill->id) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="far fa-trash-alt"></i>&nbsp;Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
