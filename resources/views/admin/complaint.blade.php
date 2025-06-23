@extends('layouts.app')
@section('complaint')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <!-- Add your dashboard content here -->
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1 class="card-title mb-0">Complaints Management</h1>
                        </div>
        <!-- Complaints Table -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Member Name</th>
                        <th>Flats No.</th>
                        <th style="text-align: center;">Complaint</th>
                        <th>Member Phone</th>
                        <th>Complaint Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($complaints as $complaint)
                        <tr>
                            <td>{{ $complaint->id }}</td>
                            <td>{{ $complaint->memberName }}</td>
                            <td style="text-align: center;">{{ $complaint->flatNo }}</td>
                            <td>
                                <div class="form-group">
                                    <textarea readonly id="complaint" name="complaint"
                                        class="form-control">{{ $complaint->complaint }}
                                    </textarea>
                                </div>
                            </td>
                            <td>{{ $complaint->memberPhone }}</td>
                            <td>{{ $complaint->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>
                                <div class="d-flex">
                                    <!-- Delete Form -->
                                    <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this complaint?');">
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
@endsection