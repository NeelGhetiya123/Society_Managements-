@extends('layouts.app')
@section('dashboard')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            Welcome
                            @if (session('LoggedAdminInfo'))
                            {{ $LoggedAdminInfo->name }}
                            @else
                            <p>Access denied. Please <a href="{{ route('admin.login') }}">login</a> to view
                                this page.</p>
                            @endif
                        </h3>
                        <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                            class="text-primary"><a href="/admin/member">2 New members registered!</a></span>
                        </h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <div class="font-weight-normal mb-0">
                                <div class="btn btn-sm btn-info mr-2" >
                                    <?php
                                        echo date("l jS F Y")  ?>
                                </div>
                            </div>
                        </div>
                    </div></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                    <div class="card-people mt-auto">
                        <img src="/images/dashboard/people.svg" alt="people">
                        <div class="weather-info">
                            <div class="d-flex">
                                <div>
                                    <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                                </div>
                                <div class="ml-2">
                                    <h4 class="location font-weight-normal">Rajkot</h4>
                                    <h6 class="font-weight-normal">India</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                            <a href="{{ route('admin.flat') }}" style="text-decoration: none; color: white">
                                <p class="mb-4">Number of Flats</p>
                                <p class="fs-30 mb-2"><h2>&nbsp;{{ $totalFlats }}</h2></p>
                                <p>(total number of all flat's)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                            <a href="{{ route('admin.member') }}" style="text-decoration: none; color: white">
                                <p class="mb-4">Number of Members</p>
                                <p class="fs-30 mb-2"><h2>&nbsp;{{ $totalMembers }}</h2></p>
                                <p>(total number of all member's)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <a href="{{ route('admin.bill') }}" style="text-decoration: none; color: white">
                                <p class="mb-4">Number of Bill's</p>
                                <p class="fs-30 mb-2"><h2>&nbsp;{{ $totalBills }}</h2></p>
                                <p>(total number of all bill's)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <a href="{{ route('admin.complaint') }}" style="text-decoration: none; color: white">
                                <p class="mb-4">Number of Complain's</p>
                                <p class="fs-30 mb-2"><h2>&nbsp;{{ $totalComplaints }}</h2></p>
                                <p>(total number of all complaints)</p></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection