@extends('layouts.app1')
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
                            <h1 class="card-title mb-0">Complaint's</h1>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addComplaintModal">
                                <i class="fas fa-address-card"></i> Add Complaint
                            </button>
                        </div>
        <!-- Add Complaint Modal -->
        <div class="modal fade" id="addComplaintModal" tabindex="-1" role="dialog" aria-labelledby="addComplaintModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="addComplaintForm" method="post" action="{{ route('complaints.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addComplaintModalLabel">Add Complaint</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="memberName">Member Name</label>
                                <input type="text" class="form-control" id="memberName" name="memberName" required>
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
                                <label for="complaint">Complaint</label>
                                <textarea type="text" class="form-control" id="complaint" name="complaint" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="memberPhone">Member Phone</label>
                                <input type="tel" class="form-control" id="memberPhone" name="memberPhone" required maxlength="10" pattern="\d{10}">
                            </div>
                            <script>
                                document.getElementById('memberPhone').addEventListener('input', function (event) {
                                this.value = this.value.replace(/[^\d]/g, '').slice(0, 10);
                                });
                            </script>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Complaint</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Complaints Table -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Member Name</th>
                        <th>Flats No.</th>
                        <th>Complaint</th>
                        <th>Member Phone</th>
                        <th>Complaint Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($complaints as $complaint)
                        <tr>
                            <td>{{ $complaint->id }}</td>
                            <td>{{ $complaint->memberName }}</td>
                            <td>{{ $complaint->flatNo }}</td>
                            <td>
                                <div class="form-group">
                                    <textarea id="complaint" name="complaint"
                                        class="form-control">{{ $complaint->complaint }}
                                    </textarea>
                                </div>
                            </td>
                            <td>{{ $complaint->memberPhone }}</td>
                            <td>{{ $complaint->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection