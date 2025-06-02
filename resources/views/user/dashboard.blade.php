@extends('layouts.app1')
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
                            @if (session('LoggedUserInfo'))
                            {{ $LoggedUserInfo->name }}
                            @else
                            <p>Access denied. Please <a href="{{ route('user.login') }}">login</a> to view
                                this page.</p>
                            @endif
                        </h3>
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
                    </div>
                </div>
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
                            <a href="{{ route('user.profile') }}" style="text-decoration: none; color: white">
                                <br><p class="mb-4"><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;My Profile</h3></p>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                            <a href="{{ route('user.bill') }}" style="text-decoration: none; color: white">
                                <br><p class="mb-4"><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pay Bill</h3></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <a href="{{ route('user.complaint') }}" style="text-decoration: none; color: white">
                                    <br><p class="mb-4"><h3>&nbsp;&nbsp;&nbsp;Add Complaint</h3></p><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <a href="{{ route('user.announcement') }}" style="text-decoration: none; color: white">
                                    <p class="mb-4"><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Show Announcements</h3></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection