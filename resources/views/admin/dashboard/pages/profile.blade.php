@extends('admin.layouts.app-dashboard')
 
@section('content')
                <div class="app-main" id="main">
                    <!-- begin container-fluid -->
                    <div class="container-fluid">
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-md-12 m-b-30">
                                <!-- begin page title -->
                                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                                    <div class="page-title mb-2 mb-sm-0">
                                        <h1>Form Layouts</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="{{ route('admin.home') }}"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    Forms
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Form Profile</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <!-- end page title -->
                            </div>
                        </div>
                        <!-- end row -->
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Profile</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.profile.submit') }}" method="POST">
                                            @foreach($adminQuery as $adminQ)
                                            @csrf
                                            <div class="form-group">
                                                <label for="user-name-id">User Name</label>
                                                <input type="text" class="form-control" name="user_name" id="user-name-id" placeholder="user name" value="{{ $adminQ->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="user-email-id">Email Address</label>
                                                <input type="email" class="form-control" id="user-email-id" aria-describedby="emailHelp" placeholder="Enter email" name="user_email" value="{{ $adminQ->email }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="user-pass-id">Password</label>
                                                <input type="password" class="form-control" id="user-pass-id" placeholder="Password" name="user_pass" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="user-cpass-id">Confirm Password</label>
                                                <input type="password" class="form-control" id="user-cpass-id" placeholder="Confirm Password" name="user_cpass" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            @endforeach
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container-fluid -->
                </div>
@endsection
@section('adminjsContent')

@endsection