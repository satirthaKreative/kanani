@extends('admin.layouts.app-dashboard')
@section('content')
@php    $link_down = $_SERVER['REQUEST_URI'];    @endphp
@php    $link_array_down = explode('/',$link_down);   @endphp
@php    $page_down = end($link_array_down);   @endphp 
            
<div class="app-main" id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 m-b-30">
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Testimonials</h1>
                    </div>
                    <div class="ml-auto d-flex align-items-center">
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript:;"><i class="ti ti-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"> Tables</li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Testimonials Table</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <span></span>
                            </div>
                        </div>
                        <div class="datatable-wrapper table-responsive">
                            <table id="datatable" class="display compact table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Student Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($getComments as $ck)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $ck->customer_name }}</td>
                                        <td>@if(strlen($ck->customer_comment) > 49){{ substr($ck->customer_comment,0,49)."..." }} @else {{ $ck->customer_comment }} @endif</td>
                                        <td><a href="javascript:;" onclick="testimonials_del({{ $ck->id }})"><i class="fa fa-trash"></i></a> <a href="{{ route('admin.update-testimonials',$ck->id) }}" ><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Customers Name</th>
                                        <th>Customers Description</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- begin row -->
        <div class="row">
            <div class="col-xl-8">
                <div class="card card-statistics">
                    <div class="card-header">
                        <div class="card-heading">
                            <h4 class="card-title">Student Comments Form</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.cms.student.comments.submit') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="customer_id" value="0" />
                            <div class="form-group">
                                <label for="student-name-id">Student Name</label>
                                <input type="text" class="form-control" name="customer_name" id="student-name-id" placeholder="Enter Student Name" required>
                            </div>
                            <div class="form-group">
                                <label for="user-email-id">Student Email</label>
                                <input type="email" class="form-control" id="user-email-id" placeholder="Enter Student Email" name="customer_email" />
                            </div>
                            <div class="form-group">
                                <label for="student-designation-id">Student Designation</label>
                                <input type="text" class="form-control" id="student-designation-id" placeholder="Enter Student Designation" name="customer_post" />
                            </div>
                            <div class="form-group">
                                <label for="customer-comments-id">Student Comments</label>
                                <textarea class="form-control" name="customer_comment" id="customer-comments-id" placeholder="Customer Comments"  rows=6 require></textarea>
                            </div>
                            <div class="form-group">
                                <label for="customer-image-id">Student Image</label>
                                <input type="file" class="form-control" id="customer-image-id" name="customers_images" />
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                                            
                        </form>
                        <!-- <form id="testimonial-delete-form" action="" method="POST" style="display: none;">
                            @csrf
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
                        <!-- end row -->
    </div>
</div>

@endsection
@section('adminjsContent')
<script>
    function testimonials_del(id){
        var x = confirm('Are you sure to delete this comment?');
        if(x){
            $.ajax({
                url: "{{ route('admin.cms.student.comments.delete') }}",
                type: "GET",
                data: {id: id},
                dataType: "json",
                success: function(event){
                    if(event == "success"){ 
                        success_pass_alert_show_msg('Successfully deleted');
                        location.reload();
                    }else if(event == "error"){
                        error_pass_alert_show_msg('Something went wrong try again later');
                    }
                }, error: function(event){

                }
            });
        }
    }
</script>
@endsection