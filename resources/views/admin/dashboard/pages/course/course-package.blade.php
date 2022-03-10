@extends('admin.layouts.app-dashboard')
@section('content')
<div class="app-main" id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 m-b-30">
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Course Package</h1>
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
                                <li class="breadcrumb-item active text-primary" aria-current="page">Course Package</li>
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
                                    <a class="btn btn-success text-white" onclick="add_free_trail_modal_fx()">Add Course Package</a>
                                </span>
                            </div>
                        </div>
                        <div class="datatable-wrapper table-responsive">
                            <table id="datatable" class="display compact table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Course Package Details</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coursePackageQuery as $ck)
                                    <tr>
                                        <td>{{ ucwords($ck->main_course_name) }}</td>
                                        <td>{{ $ck->no_of_lessons_per_month }} Lessons a month {{ $ck->price_per_month }}$ </td>
                                        <td>
                                            <?php 
                                                if($ck->package_status == "active"){
                                                    $coun_state = "<b class='text-success'>Active</b>"; 
                                                }else if($ck->package_status == "inactive"){
                                                    $coun_state = "<b class='text-danger'>Inactive</b>"; 
                                                }
                                                echo $coun_state;
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if($ck->package_status == "active"){
                                                    $update_state = "inactive"; 
                                                }else if($ck->package_status == "inactive"){
                                                    $update_state = "active"; 
                                                }
                                            ?>
                                            <span class="text-info text-bold"><a href="javascript:;" onclick="course_package_edit_fx({{ $ck->id }})" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></span> <span class="text-danger text-bold"><a href="javascript:;" class="btn btn-sm btn-danger" onclick="course_package_del_fx({{ $ck->id }})"><i class="fa fa-trash"></i></a></span> <span class="text-info text-bold"><a href="javascript:;" class="btn btn-sm btn-success" onclick="course_package_change_state_fx({{ $ck->id }},'{{ $update_state }}')">Change Status</a></span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Course Package Details</th>
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
                    @foreach($mainCourse as $mainC)
                        <option value="{{ $mainC->id }}">{{ ucwords($mainC->main_course_name) }}</option>
                    @endforeach
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
</script>
@endsection