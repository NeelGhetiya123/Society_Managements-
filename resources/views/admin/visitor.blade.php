@extends('layouts.app')
@section('visitor')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <!-- Add your dashboard content here -->
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1 class="card-title mb-0">Visitor Management</h1>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addVisitorModal">
                                <i class="fas fa-address-card"></i> Add Visitor
                            </button>
                        </div>
        <!-- Add Visitor Modal -->
        <div class="modal fade" id="addVisitorModal" tabindex="-1" role="dialog" aria-labelledby="addVisitorModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="addVisitorForm" method="post" action="{{ route('visitors.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addVisitorModalLabel">Add Visitor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
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
                                <label for="visitorName">Visitor Name</label>
                                <input type="text" class="form-control" id="visitorName" name="visitorName" required>
                            </div>
                            <div class="form-group">
                                <label for="visitorPhone">Visitor Phone</label>
                                <input type="tel" class="form-control" id="visitorPhone" name="visitorPhone" required maxlength="10" pattern="\d{10}">
                            </div>
                            <script>
                                document.getElementById('visitorPhone').addEventListener('input', function (event) {
                                this.value = this.value.replace(/[^\d]/g, '').slice(0, 10);
                                });
                            </script>
                            <div class="form-group">
                                <label for="personToMeet">Person To Meet</label>
                                <input type="text" class="form-control" id="personToMeet" name="personToMeet" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Visitor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Visitors Table -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Flat No.</th>
                        <th>Visitor Name</th>
                        <th>Visitor Phone</th>
                        <th>Person To Meet</th>
                        <th>Entry Time</th>
                        <th>Exit Time</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitors as $visitor)
                        <tr>
                            <td>{{ $visitor->id }}</td>
                            <td>{{ $visitor->flatNo }}</td>
                            <td>{{ $visitor->visitorName }}</td>
                            <td>{{ $visitor->visitorPhone }}</td>
                            <td>{{ $visitor->personToMeet }}</td>
                            <td>{{ $visitor->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $visitor->exitTime }}</td>
                            
                            <td>
                                <div class="d-flex">
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-outline-success mr-2" data-toggle="modal" data-target="#editVisitorModal{{ $visitor->id }}">
                                        <i class="fas fa-pencil-alt"></i>&nbsp;Edit
                                    </button>

                                    <!-- Delete Form -->
                                    <form action="{{ route('visitors.destroy', $visitor->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this visitor?');">
                                            <i class="far fa-trash-alt"></i>&nbsp;Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Visitor Modal -->
                        <div class="modal fade" id="editVisitorModal{{ $visitor->id }}" tabindex="-1" role="dialog" aria-labelledby="editVisitorModalLabel{{ $visitor->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('visitors.update', $visitor->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Visitors</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="{{ $visitor->id }}">
                                            <div class="form-group">
                                                <label>Flat No.</label>
                                                <input type="number" class="form-control" name="flatNo" value="{{ $visitor->flatNo }}" required disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Visitor Name</label>
                                                <input type="text" class="form-control" name="visitorName" value="{{ $visitor->visitorName }}" required disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Visitor Phone</label>
                                                <input type="text" class="form-control" name="visitorPhone" value="{{ $visitor->visitorPhone }}" required maxlength="10" pattern="\d{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" disabled>
                                            </div>

                                            <script>
                                                document.getElementById('visitorPhone').addEventListener('input', function (event) {
                                                this.value = this.value.replace(/[^\d]/g, '').slice(0, 10);
                                                });
                                            </script>
                                            <div class="form-group">
                                                <label>Person To Meet</label>
                                                <input type="text" class="form-control" name="personToMeet" value="{{ $visitor->personToMeet }}" required disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Exit Time</label>
                                                <input type="datetime-local" class="form-control" name="exitTime" value="{{ $visitor->exitTime }}" required>
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