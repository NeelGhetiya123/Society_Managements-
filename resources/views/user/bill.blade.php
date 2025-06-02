@extends('layouts.app1')
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
                        <h1 class="card-title mb-0">New Bill's</h1>
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
                            <th>Month</th>
                            <th>Paid Amount</th>
                            <th>Updated At</th>
                            <th>Pay Bill</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $bill)
                            <tr>
                                <td>{{ $bill->id }}</td>
                                <td>{{ $bill->billTitel }}</td>
                                <td>{{ $bill->flatsNo }}</td>
                                <td>{{ $bill->billAmount }}</td>
                                <td>{{ $bill->month }}</td>
                                <td>{{ $bill->paidAmount }}</td>
                                <td>{{ \Carbon\Carbon::parse($bill->updated_at)->toDateString() }}</td>
                                <td>
                                    <div class="d-flex">
                                        <!-- Edit Button -->
                                        <button class="btn btn-sm btn-outline-success mr-2" data-toggle="modal" data-target="#editBillModal{{ $bill->id }}">
                                            <i class="fa fa-credit-card"></i>&nbsp;&nbsp;Pay
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Bill Modal -->
                            <div class="modal fade" id="editBillModal{{ $bill->id }}" tabindex="-1" role="dialog" aria-labelledby="editBillModalLabel{{ $bill->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('bills.update', $bill->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Bill</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="{{ $bill->id }}">
                                                <div class="form-group">
                                                    <label>Bill Title</label>
                                                    <input type="text" class="form-control" name="billTitel" value="{{ $bill->billTitel }}" required disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Flat No.</label>
                                                    <input type="number" class="form-control" name="flatsNo" value="{{ $bill->flatsNo }}" required disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Bill Amount</label>
                                                    <input type="number" class="form-control" name="billAmount" value="{{ $bill->billAmount }}" required disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Month</label>
                                                    <input type="month" class="form-control" name="month" value="{{ $bill->month }}" required disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Paid Amount</label>
                                                    <input type="number" class="form-control" name="paidAmount" value="{{ $bill->paidAmount }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
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
@endsection
