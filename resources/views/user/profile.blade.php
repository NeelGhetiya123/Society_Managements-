@extends('layouts.app1')
@section('profile')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="content-wrapper">
            <div class="row">
                <!-- User Information -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Member Information</h4>
                            <p><strong>Name:</strong> {{ $LoggedUserInfo->name }}</p>
                            <p><strong>Email:</strong> {{ $LoggedUserInfo->email }}</p>
                            <p><strong>Bio:</strong> {{ $LoggedUserInfo->bio }}</p>
                            <p><strong>Picture:</strong></p>
                            @if ($LoggedUserInfo->picture)
                            <div style="max-width: 300px; margin: auto;">
                                <img src="{{ asset('storage/' . $LoggedUserInfo->picture) }}"
                                class="img-fluid rounded" alt="User Picture"
                                style="max-width: 50%; height: auto;">
                            </div>
                            @else
                            <p>Member Picture not available</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Profile Update Form -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Profile</h4>
                            <form action="{{ route('user.profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ $LoggedUserInfo->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input disabled type="email" id="email" name="email"
                                        class="form-control" value="{{ $LoggedUserInfo->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="bio">Bio</label>
                                    <textarea id="bio" name="bio"
                                        class="form-control">{{ $LoggedUserInfo->bio }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="picture">Profile Picture</label>
                                    <input type="file" id="picture" name="picture"
                                        class="form-control-file">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection