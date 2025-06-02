@extends('layouts.app')
@section('member')
<!-- partial -->
<div class="main-panel">
<div class="ml-2 mr-2 content-wrapper">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="card-title mb-0">Members List</h1>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addMemberModal">
                        <i class="fas fa-user-plus"></i> Add Members
                    </button>
                </div>

                <!-- Add Member Modal -->
                <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="addMemberForm" method="post" action="{{ route('members.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addMemberModalLabel">Add Members</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="memberName">Name</label>
                                        <input type="text" class="form-control" id="memberName" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="flatNo">Flat No.</label>
                                        <input type="text" class="form-control" id="flatNo" name="flatNo" maxlength="3" required>
                                        <small id="flatNoError" style="color: red; display: none;">Please enter a 3-digit number between 100 and 999.</small>
                                    </div>
                                    <script>
                                        document.getElementById('flatNo').addEventListener('input', function (e) {
                                            var inputValue = e.target.value;
                                            
                                            if (/[^0-9]/.test(inputValue)) {
                                                e.target.value = inputValue.replace(/[^0-9]/g, '');
                                            }

                                            var errorMessage = document.getElementById('flatNoError');
                                            if (inputValue.length < 3 || inputValue.length > 3 || inputValue < 100 || inputValue > 999) {
                                                errorMessage.style.display = 'inline';
                                            } else {
                                                errorMessage.style.display = 'none';
                                            }
                                        });
                                    </script>
                                    <div class="form-group">
                                        <label for="memberPhone">Member Phone</label>
                                        <input type="tel" class="form-control" id="memberPhone" name="memberPhone" required maxlength="10" pattern="\d{10}">
                                    </div>
                                    <script>
                                        document.getElementById('memberPhone').addEventListener('input', function (event) {
                                        this.value = this.value.replace(/[^\d]/g, '').slice(0, 10);
                                        });
                                    </script>
                                    <div class="form-group">
                                        <label for="memberEmail">Email</label>
                                        <input type="email" class="form-control" id="memberEmail" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="memberRole">Types</label>
                                        <select class="form-control" id="memberRole" name="role" required>
                                            <option value="">Select Types</option>
                                            <option value="Flats">Flats</option>
                                            <option value="Tenament">Tenament</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="memberPicture">Profile Picture</label>
                                        <input type="file" class="form-control-file" id="memberPicture" name="picture">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Members</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Profile Picture</th>
                                <th>Name</th>
                                <th>Flat No.</th>
                                <th>Member Phone</th>
                                <th style="text-align: center;">Email</th>
                                <th>Types</th>
                                <th>Created At</th>
                                <th style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td class="py-1" style="text-align: center;">
                                        @if ($member->picture)
                                            <img src="{{  asset('storage/' . $member->picture) }}" alt="Profile Picture" class="img-fluid rounded" style="max-width: 50px; height: auto;">
                                        @else
                                            <img src="{{ asset('path/to/default/profile.png') }}" alt="Profile Picture" class="img-fluid rounded" style="max-width: 50px; height: auto;">
                                        @endif
                                    </td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->flatNo }}</td>
                                    <td>{{ $member->memberPhone }}</td>
                                    <td style="text-align: center;">{{ $member->email }}</td>
                                    <td style="text-align: center;">
                                        <span class="badge
                                            @if ($member->role === 'Flat') badge-primary
                                            @elseif ($member->role === 'Tenament') badge-success
                                            @else badge-info
                                            @endif">
                                            {{ $member->role }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($member->created_at)->toDateString() }}</td>
                                    <td>
                                        <div class="d-inline-flex align-items-center">
                                            <!-- Edit Button -->
                                            <a href="#" class="btn btn-sm btn-outline-success edit-user mr-1 mb-0" data-toggle="modal" data-target="#editMemberModal{{ $member->id }}" data-id="{{ $member->id }}">
                                                <i class="fas fa-pencil-alt"></i>&nbsp;Edit
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="delete-form mt-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="far fa-trash-alt"></i>&nbsp;Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Member Modal -->
                                <div class="modal fade" id="editMemberModal{{ $member->id }}" tabindex="-1" role="dialog" aria-labelledby="editmemberModalLabel{{ $member->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form id="editMemberForm{{ $member->id }}" action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editMemberModalLabel{{ $member->id }}">Edit Members</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $member->id }}">
                                                    <div class="form-group">
                                                        <label for="editMemberName{{ $member->id }}">Name</label>
                                                        <input type="text" class="form-control" id="editMemberName{{ $member->id }}" name="name" value="{{ $member->name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Flat No.</label>
                                                        <input type="number" class="form-control" name="flatNo" value="{{ $member->flatNo }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Member Phone</label>
                                                        <input type="text" class="form-control" name="memberPhone" value="{{ $member->memberPhone }}" required maxlength="10" pattern="\d{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                                                    </div>

                                                    <script>
                                                        document.getElementById('memberPhone').addEventListener('input', function (event) {
                                                        this.value = this.value.replace(/[^\d]/g, '').slice(0, 10);
                                                        });
                                                    </script>
                                                    <div class="form-group">
                                                        <label for="editMemberEmail{{ $member->id }}">Email</label>
                                                        <input type="email" class="form-control" id="editMemberEmail{{ $member->id }}" name="email" value="{{ $member->email }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editMemberRole{{ $member->id }}">Types</label>
                                                        <select class="form-control" id="editMemberRole{{ $member->id }}" name="role" required>
                                                            <option value="Flats" {{ $member->role === 'Flats' ? 'selected' : '' }}>Flats</option>
                                                            <option value="Tenament" {{ $member->role === 'Tenament' ? 'selected' : '' }}>Tenament</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editMemberPicture{{ $member->id }}">Profile Picture</label>
                                                        <input type="file" class="form-control-file" id="editMemberPicture{{ $member->id }}" name="picture">
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
</div>                        
@endsection