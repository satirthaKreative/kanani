@extends('admin.layouts.app-dashboard')
@section('content')
<div class="app-main" id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 m-b-30">
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Student Booking Slot</h1>
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
                                <li class="breadcrumb-item active text-primary" aria-current="page">Student Booking Slot</li>
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
                                    <!-- <a class="btn btn-success text-white" href="javascript:;">Add Student Booking Slot</a> -->
                                </span>
                            </div>
                        </div>
                        <div class="datatable-wrapper table-responsive">
                            <table id="datatable" class="display compact table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Student Details</th>
                                        <th>Course Package Details</th>
                                        <th>Booking Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mainQuery as $ck)
                                    <tr>
                                        <td>Name: {{ ucwords($ck->first_name) }} {{ ucwords($ck->last_name) }} <br/>Email: {{ ucwords($ck->email) }}</td>
                                        <td>Course Name: {{ ucwords($ck->main_course_name) }} <br/>Course Price: {{ $ck->paypal_package_price_name }}$</td>
                                        <td>
                                            <?php 
                                                if($ck->student_booking_status == "active"){
                                                    $coun_state = "<b class='text-success'>Active</b>"; 
                                                }else if($ck->student_booking_status == "inactive"){
                                                    $coun_state = "<b class='text-danger'>Inactive</b>"; 
                                                }
                                                echo $coun_state;
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if($ck->student_booking_status == "active"){
                                                    $update_state = "inactive"; 
                                                }else if($ck->student_booking_status == "inactive"){
                                                    $update_state = "active"; 
                                                }
                                            ?>
                                            <span class="text-info text-bold"><a href="{{ route('admin.booking-single-details',['any_id' => base64_encode($ck->id)]) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a></span> <span class="text-danger text-bold"><a href="javascript:;" onclick="config_del_fx({{ $ck->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></span> <span class="text-info text-bold"><a href="javascript:;" class="btn btn-sm btn-success" onclick="config_change_state_fx({{ $ck->id }},'{{ $update_state }}')">Change Status</a></span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Student Details</th>
                                        <th>Course Package Details</th>
                                        <th>Booking Status</th>
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
<!-- The Add free trail Modal -->
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
<!-- /The Add free trail Modal -->
<!-- The edit free trail Modal -->
<div class="modal" id="edit-course-package-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Free Trail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.update-course-package') }}" method="POST">
            @csrf
            <input type="hidden" name="course_package_hidden_name" id="course-package-hidden-id" value="0">
            <div class="form-group">
                <label for="available-date-id">Main Course:</label>
                <select class="form-control" id="edit-main-course-id" name="main_course_name" required>
                    <option value="">Choose Main Course</option>
                </select>
            </div>
            <div class="form-group">
                <label for="no-of-lesson-month-id">No of Lessons / month:</label>
                <input type="number" class="form-control" id="edit-no-of-lesson-month-id" name="no_of_lesson_name" required/>
            </div>
            <div class="form-group">
                <label for="lesson-price-id">Price / month:</label>
                <input type="number" class="form-control" id="edit-lesson-price-id" name="lesson_price_name" required/>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /The edit free trail Modal -->
<!-- student booking view -->
<!-- The Modal -->
<div class="modal" id="student-booking-modal-id">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Student Booking</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <table class="table table-dark table-striped">
            <thead>
                <tr><th>Name: </th><td id="booking-user-name-id"></td></tr>
            </thead>
            <tbody>
                <tr><th>Email : </th><td id="booking-user-email-id"></td></tr>
                <tr><th>User Role : </th><td id="booking-user-role-id"></td></tr>
                <tr><th>Course Name : </th><td id="booking-course-name-id"></td></tr>
                <tr><th>Course Price : </th><td id="booking-course-price-id"></td></tr>
                <tr><th>Package Details : </th><td id="booking-package-details-id"></td></tr>
                <tr><th>Package Price : </th><td id="booking-package-price-id"></td></tr>
                <tr><th>Booking dates : </th><td id="booking-dates-id"></td></tr>
                <tr><th>Booking slots time : </th><td id="booking-slots-name-id"></td></tr>
                <tr><th>Booking Message : </th><td id="booking-message-id"></td></tr>
            </tbody>
        </table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- /student booking view -->
@endsection
@section('adminjsContent')
<script>
    $(function () {
        $('#datetimepicker1').datetimepicker();
    });

    function student_booking_modal_fx(id)
    {
        $("#student-booking-modal-id").modal('show');
        $.ajax({
            url: "{{ route('admin.student-booking-getting-data') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#booking-user-name-id").html(event.user_name);
                $("#booking-user-email-id").html(event.user_email);
                $("#booking-user-role-id").html(event.user_role);
                $("#booking-course-name-id").html(event.course_name);
                $("#booking-course-price-id").html("$"+event.course_price);
                $("#booking-package-price-id").html("$"+event.package_price);
                $("#booking-dates-id").html(event.user_name);
                $("#booking-slots-name-id").html(event.user_name);
                $("#booking-message-id").html(event.package_details);
            }, error: function(event){

            }
        })
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

    function config_del_fx(lang_val){
        var x = confirm('Are you sure to delete this?');
        if(x){
            $.ajax({
                url: "{{ route('admin.student-booking-slot-delete') }}",
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

    function config_change_state_fx(lang_val,update_state){
        $.ajax({
            url: "{{ route('admin.student-booking-slot-change-status') }}",
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
</script>
@endsection