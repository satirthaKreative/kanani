@extends('admin.layouts.app-dashboard')
@section('content')
<div class="app-main" id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 m-b-30">
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Order Details</h1>
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
                                <li class="breadcrumb-item active text-primary" aria-current="page">Order Details</li>
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
                                <span>
                                    <!-- <a class="btn btn-success text-white" onclick="add_free_trail_modal_fx()">Add Order Details</a> -->
                                </span>
                            </div>
                        </div>
                        <div class="datatable-wrapper table-responsive">
                            <table id="datatable" class="display compact table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Id</th>
                                        <th>Course Name</th>
                                        <th>Level</th>
                                        <th>Total Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Pending Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($getQuery) > 0)
                                        @php $i = 1; @endphp
                                        @foreach($getQuery as $ck)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $ck->tokanId }}</td>
                                            <td>{{ ucwords($ck->course_name) }}</td>
                                            <td>{{ strtoupper($ck->topic_name) }}</td>
                                            <td>$ {{ $ck->total_payable_amount }}</td>
                                            <td>$ {{ $ck->paid_amount }}</td>
                                            <td>$ {{ $ck->pending_amount }}</td>
                                            <td>
                                                <?php
                                                    if($ck->booking_state == "active"){
                                                        $coun_state = "<b class='text-success'>Active</b>";
                                                    }else if($ck->booking_state == "inactive"){
                                                        $coun_state = "<b class='text-danger'>Inactive</b>";
                                                    }
                                                    echo $coun_state;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($ck->booking_state == "active"){
                                                        $update_state = "inactive";
                                                    }else if($ck->booking_state == "inactive"){
                                                        $update_state = "active";
                                                    }
                                                ?>
                                                <span class="text-info text-bold"><a href="javascript:;" onclick="course_order_full_booking_fx({{ $ck->id }})" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></span>
                                                {{-- <span class="text-info text-bold"><a href="javascript:;" onclick="course_package_edit_fx({{ $ck->id }})" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></span> --}}
                                                {{-- <span class="text-danger text-bold"><a href="javascript:;" class="btn btn-sm btn-danger" onclick="course_package_del_fx({{ $ck->id }})"><i class="fa fa-trash"></i></a></span> <span class="text-info text-bold"><a href="javascript:;" class="btn btn-sm btn-success" onclick="course_package_change_state_fx({{ $ck->id }},'{{ $update_state }}')">Change Status</a></span> --}}
                                            </td>
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan=9>
                                                <center class="text-danger"><i class="fa fa-times"></i> No orders yet</center>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Id</th>
                                        <th>Course Name</th>
                                        <th>Level</th>
                                        <th>Total Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Pending Amount</th>
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
    </div>
</div>
<!-- Modal -->
<div class="modal" id="add-free-trail-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Course Package</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.add-course-package') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="available-date-id">Main Course:</label>
                <select class="form-control" id="main-course-id" name="main_course_name" required>
                    <option value="">Choose Main Course</option>
                </select>
            </div>
            <div class="form-group">
                <label for="no-of-lesson-month-id">No of Lessons / month:</label>
                <input type="number" class="form-control" id="no-of-lesson-month-id" name="no_of_lesson_name" required/>
            </div>
            <div class="form-group">
                <label for="lesson-price-id">Price / month:</label>
                <input type="number" class="form-control" id="lesson-price-id" name="lesson_price_name" required/>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /model  -->
<div class="modal" id="orders-free-trail-modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">View Order Details Package</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body" id="order-details-modal-show">

        </div>
      </div>
    </div>
  </div>
@endsection
@section('adminjsContent')
<script>
    $(function () {
        $('#datetimepicker1').datetimepicker();
    });
    function add_free_trail_modal_fx(){
        $("#add-free-trail-modal").modal('show');
    }

    function from_free_trail_fx(){
        alert($("#avail-from-time-id").val());
    }

    function course_package_edit_fx(lang_val){
        $("#edit-course-package-modal").modal('show');
        $.ajax({
            url: "{{ route('admin.edit-course-package') }}",
            type: "GET",
            data: {id: lang_val},
            dataType: "json",
            success: function(event){
                $("#course-package-hidden-id").val(lang_val);
                $("#edit-main-course-id").html(event.main_courses);
                $("#edit-no-of-lesson-month-id").val(event.no_of_lessons_per_month);
                $("#edit-lesson-price-id").val(event.price_per_month);
            }, error: function(event){

            }
        })
    }

    function course_package_del_fx(lang_val){
        var x = confirm('Are you sure to delete this?');
        if(x){
            $.ajax({
                url: "{{ route('admin.delete-course-package') }}",
                type: "GET",
                data: {id: lang_val},
                dataType: "json",
                success: function(event){
                    if(event == "success"){
                        success_pass_alert_show_msg("Successfully delete this ");
                        location.reload();
                    }else if(event == "error"){
                        error_pass_alert_show_msg("Try again! Something went wrong");
                    }
                }, error: function(event){

                }
            })
        }
    }

    function course_package_change_state_fx(lang_val,update_state){
        $.ajax({
            url: "{{ route('admin.change-course-package') }}",
            type: "GET",
            data: {id: lang_val, new_state: update_state},
            dataType: "json",
            success: function(event){
                if(event == "success"){
                    success_pass_alert_show_msg("Successfully update the status");
                    location.reload();
                }else if(event == "error"){
                    error_pass_alert_show_msg("Try again! Something went wrong");
                }
            }, error: function(event){

            }
        })
    }

    function course_order_full_booking_fx(id){
        $.ajax({
            url: "{{ route('admin.order.single.show') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#order-details-modal-show").html(event);
            }, error: function(event){

            }
        })
        $("#orders-free-trail-modal").modal('show');
    }
</script>
@endsection
