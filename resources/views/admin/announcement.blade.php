@extends('layouts.app')
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
                            <h1 class="card-title mb-0">Announcement Management</h1>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addAnnouncementModal">
                                <i class="fas fa-address-card"></i> Add Announcement
                            </button>
                        </div>
        <!-- Add Announcement Modal -->
        <div class="modal fade" id="addAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="addAnnouncementForm" method="post" action="{{ route('announcements.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addAnnouncementModalLabel">Add Announcement</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label for="eventDate">Event Date</label>
                                <input type="datetime-local" class="form-control" id="eventDate" name="eventDate" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="title">Title</label>
                                <textarea type="text" class="form-control" id="title" name="title" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Announced</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Announcements Table -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Announced Date</th>
                        <th style="text-align: center;">Event Date</th>
                        <th style="text-align: center;">Title</th>
                        <th style="text-align: center;">Action</th>
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
                            <td>
                                <div class="d-flex">
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-outline-success mr-2" data-toggle="modal" data-target="#editAnnouncementModal{{ $announcement->id }}">
                                        <i class="fas fa-pencil-alt"></i>&nbsp;Edit
                                    </button>

                                    <!-- Delete Form -->
                                    <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this visitor?');">
                                            <i class="far fa-trash-alt"></i>&nbsp;Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Announcement Modal -->
                        <div class="modal fade" id="editAnnouncementModal{{ $announcement->id }}" tabindex="-1" role="dialog" aria-labelledby="editAnnouncementModalLabel{{ $announcement->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('announcements.update', $announcement->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Announcements</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="{{ $announcement->id }}">
                                            <div class="form-group">
                                                <label>Event Date</label>
                                                <input type="datetime-local" class="form-control" name="eventDate" value="{{ $announcement->eventDate }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="title" value="{{ $announcement->title }}" required>
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
    <!-- content-wrapper ends -->
</div>
@endsection