@extends('layouts.app')
@section('flat')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                <!-- Add your dashboard content here -->
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Flats Management</h4>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addFlatModal">
                                    <i class="fas fa-building"></i> Add Flat
                                </button>
                            </div>
                <!-- Add Flats Modal -->
                <div class="modal fade" id="addFlatModal" tabindex="-1" role="dialog" aria-labelledby="addFlatModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="addFlatForm" method="post" action="{{ route('flats.store') }}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addFlatModalLabel">Add Flat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="allotedTo">Alloted to</label>
                                        <input type="text" class="form-control" id="allotedTo" name="allotedTo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="flatNo">Flat No.</label>
                                        <input type="number" class="form-control" id="flatNo" name="flatNo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="blockNo">Block No.</label>
                                        <input type="text" class="form-control" id="blockNo" name="blockNo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNo">Phone No.</label>
                                        <input type="tel" class="form-control" id="phoneNo" name="phoneNo" required maxlength="10" pattern="\d{10}">
                                    </div>
                                    <script>
                                        document.getElementById('phoneNo').addEventListener('input', function (event) {
                                            this.value = this.value.replace(/[^\d]/g, '').slice(0, 10);
                                        });
                                    </script>

                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select class="form-control" id="type" name="type" required>
                                            <option value="">Select Type</option>
                                            <option value="Flat">Flat</option>
                                            <option value="Tenament">Tenament</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="created_at">Created At</label>
                                        <input type="datetime-local" class="form-control" id="created_at" name="created_at" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Flat</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Flats Table -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Alloted to</th>
                                <th>Flat No.</th>
                                <th>Block No.</th>
                                <th>Phone No.</th>
                                <th style="text-align: center;">Type</th>
                                <th>Created At</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($flats as $flat)
                                <tr>
                                    <td>{{ $flat->id }}</td>
                                    <td>{{ $flat->allotedTo }}</td>
                                    <td>{{ $flat->flatNo }}</td>
                                    <td>{{ $flat->blockNo }}</td>
                                    <td>{{ $flat->phoneNo }}</td>

                                    <td style="text-align: center;">
                                        <span class="badge
                                            @if ($flat->type === 'Flat') badge-primary
                                            @elseif ($flat->type === 'Tenament') badge-success
                                            @else badge-info
                                            @endif">
                                            {{ $flat->type }}
                                        </span>
                                    </td>

                                    <td>{{ \Carbon\Carbon::parse($flat->created_at)->toDateString() }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <!-- Edit Button -->
                                            <button class="btn btn-sm btn-outline-success mr-2" data-toggle="modal" data-target="#editFlatModal{{ $flat->id }}">
                                                <i class="fas fa-pencil-alt"></i>&nbsp;Edit
                                            </button>

                                            <!-- Delete Form -->
                                            <form action="{{ route('flats.destroy', $flat->id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this flat?');">
                                                    <i class="far fa-trash-alt"></i>&nbsp;Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Flat Modal -->
                                <div class="modal fade" id="editFlatModal{{ $flat->id }}" tabindex="-1" role="dialog" aria-labelledby="editFlatModalLabel{{ $flat->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('flats.update', $flat->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Flats</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $flat->id }}">
                                                    <div class="form-group">
                                                        <label>Alloted To</label>
                                                        <input type="text" class="form-control" name="allotedTo" value="{{ $flat->allotedTo }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Flat No.</label>
                                                        <input type="number" class="form-control" name="flatNo" value="{{ $flat->flatNo }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Block No.</label>
                                                        <input type="text" class="form-control" name="blockNo" value="{{ $flat->blockNo }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Phone No.</label>
                                                        <input type="tel" class="form-control" name="phoneNo" value="{{ $flat->phoneNo }}" required maxlength="10" pattern="\d{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edittype{{ $flat->id }}">Types</label>
                                                        <select class="form-control" id="edittype{{ $flat->id }}" name="type" required>
                                                            <option value="Flat" {{ $flat->type === 'Flat' ? 'selected' : '' }}>Flat</option>
                                                            <option value="Tenament" {{ $flat->type === 'Tenament' ? 'selected' : '' }}>Tenament</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Created At</label>
                                                        <input type="datetime-local" class="form-control" name="created_at" value="{{ \Carbon\Carbon::parse($flat->created_at)->format('Y-m-d\TH:i') }}" required>
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
@endsection