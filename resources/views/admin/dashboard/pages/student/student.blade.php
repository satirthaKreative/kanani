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
                                        <h1>Students</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="javascript:;"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    Tables
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Students Table</li>
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
                            
                            <div class="col-lg-12">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <!-- <div class="col-lg-12">
                                                <span>
                                                    <a class="btn btn-success text-white" onclick="add_tutor_modal_fx()">Add Student</a>
                                                </span>
                                            </div> -->
                                        </div>
                                        
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="datatable" class="display compact table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Native Language</th>
                                                        <th>Country</th>
                                                        <th>Role Status</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($studentQuery as $ck)
                                                    <tr>
                                                        <td>{{ ucwords($ck->first_name) }} {{ ucwords($ck->last_name) }}</td>
                                                        <td>{{ strtolower($ck->email) }}</td>
                                                        <td>{{ ucwords($ck->language_name) }}</td>
                                                        <td>{{ ucwords($ck->country_name) }}</td>
                                                        <td>
                                                            @if($ck->user_role == 1)
                                                                @php $user_role = "<b class='text-warning'>Child</b>"; @endphp
                                                            @elseif($ck->user_role == 2)
                                                                @php $user_role = "<b class='text-info'>Teen</b>"; @endphp
                                                            @elseif($ck->user_role == 3)
                                                                @php $user_role = "<b class='text-danger'>Adult</b>"; @endphp
                                                            @endif

                                                            <?php echo $user_role; ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($ck->account_status == "active"){
                                                                    $coun_state = "<b class='text-success'>Active</b>"; 
                                                                }else if($ck->account_status == "inactive"){
                                                                    $coun_state = "<b class='text-danger'>Inactive</b>"; 
                                                                }
                                                                echo $coun_state;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($ck->account_status == "active"){
                                                                    $update_state = "inactive"; 
                                                                }else if($ck->account_status == "inactive"){
                                                                    $update_state = "active"; 
                                                                }
                                                            ?>
                                                            <!-- <span class="text-info text-bold"><a href="javascript:;" onclick="student_edit_fx({{ $ck->id }})" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></span> <span class="text-danger text-bold"><a href="javascript:;" class="btn btn-sm btn-danger" onclick="student_del_fx({{ $ck->id }})"><i class="fa fa-trash"></i></a></span>  -->
                                                            <span class="text-info text-bold"><a href="javascript:;" class="btn btn-sm btn-success" onclick="student_change_state_fx({{ $ck->id }},'{{ $update_state }}')">Change Status</a></span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Native Language</th>
                                                        <th>Country</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
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