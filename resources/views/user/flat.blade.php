@extends('layouts.app1')
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
                                <th>Type</th>
                                <th>Created At</th>
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
                            <td>
                                <span class="badge
                                    @if ($flat->type === 'Flat') badge-primary
                                    @elseif ($flat->type === 'Tenament') badge-success
                                    @else badge-info
                                    @endif">
                                    {{ $flat->type }}
                                </span>
                            </td>

                            <td>{{ \Carbon\Carbon::parse($flat->created_at)->toDateString() }}</td>
                            
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