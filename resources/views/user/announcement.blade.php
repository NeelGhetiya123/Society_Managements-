@extends('layouts.app1')
@section('announcement')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <!-- Add your dashboard content here -->
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1 class="card-title mb-0">Show Announcement's</h1>
                        </div>
        <!-- Announcements Table -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Announced Date</th>
                        <th>Event Date</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($announcements as $announcement)
                        <tr>
                            <td>{{ $announcement->id }}</td>
                            <td>{{ $announcement->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::parse($announcement->eventDate)->format('j F, Y h:i A') }}</td>
                            <td>
                                <div class="form-group">
                                    <textarea readonly id="title" name="title"
                                        class="form-control">{{ $announcement->title }}
                                    </textarea>
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