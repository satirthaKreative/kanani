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
                                        <h1>Courses</h1>
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
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Course Table</li>
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
                                            <div class="col-lg-12">
                                                <span>
                                                    <a class="btn btn-success text-white" onclick="add_all_courses_modal_fx()">Add Course</a>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="datatable" class="display compact table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Main Course</th>
                                                        <th>Sub Course</th>
                                                        <th>Topic Name</th>
                                                        <th>Age Scale</th>
                                                        <th>No Of Units</th>
                                                        <th>No of lessons</th>
                                                        <th>Times in minutes</th>
                                                        <th>Total Amount</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($courseAllQuery as $ck)
                                                    <tr>
                                                        <td>{{ ucwords($ck->main_course_name) }}</td>
                                                        <td>{{ ucwords($ck->course_name) }}</td>
                                                        <td>{{ ucwords($ck->topic_name) }}</td>
                                                        <td>{{ $ck->age_from }} to {{ $ck->age_to }} years</td>
                                                        <td>{{ $ck->no_of_units }}</td>
                                                        <td>{{ $ck->no_of_lessons }}</td>
                                                        <td>{{ $ck->times_in_minutes }}</td>
                                                        <td>${{ $ck->course_total_price }}</td>
                                                        <td>
                                                            <?php 
                                                                if($ck->course_status == "active"){
                                                                    $coun_state = "<b class='text-success'>Active</b>"; 
                                                                }else if($ck->course_status == "inactive"){
                                                                    $coun_state = "<b class='text-danger'>Inactive</b>"; 
                                                                }
                                                                echo $coun_state;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($ck->course_status == "active"){
                                                                    $update_state = "inactive"; 
                                                                }else if($ck->course_status == "inactive"){
                                                                    $update_state = "active"; 
                                                                }
                                                            ?>
                                                            <span class="text-info text-bold"><a href="javascript:;" onclick="course_change_edit_fx({{ $ck->id }})" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></span> <span class="text-danger text-bold"><a href="javascript:;" class="btn btn-sm btn-danger" onclick="course_change_del_fx({{ $ck->id }})"><i class="fa fa-trash"></i></a></span> <span class="text-info text-bold"><a href="javascript:;" class="btn btn-sm btn-success" onclick="course_change_state_fx({{ $ck->id }},'{{ $update_state }}')">Change Status</a></span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Main Course</th>
                                                        <th>Sub Course</th>
                                                        <th>Topic Name</th>
                                                        <th>Age Scale</th>
                                                        <th>No Of Units</th>
                                                        <th>No of lessons</th>
                                                        <th>Times in minutes</th>
                                                        <th>Total Amount</th>
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

                        <!-- main course -->
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-md-12 m-b-30">
                                <!-- begin page title -->
                                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                                    <div class="page-title mb-2 mb-sm-0">
                                        <h1>Main Courses</h1>
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
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Main Courses Table</li>
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
                                            <div class="col-lg-12">
                                                <span>
                                                    <a class="btn btn-success text-white" onclick="add_main_course_modal_fx()">Add main Course</a>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="datatable1" class="display compact table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Course Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($mainCourseQuery as $main_ck)
                                                    <tr>
                                                        <td>{{ ucwords($main_ck->main_course_name) }}</td>
                                                        <td>
                                                            <span class="text-info text-bold"><a onclick="main_course_edit_popup({{ $main_ck->id }})" href="javascript:;" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></span> <span class="text-danger text-bold"><a onclick="main_course_delete_popup({{ $main_ck->id }})" href="javascript:;" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a></span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Course Name</th>
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
                        <!-- end main course -->

                        <!-- Age course -->
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-md-12 m-b-30">
                                <!-- begin page title -->
                                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                                    <div class="page-title mb-2 mb-sm-0">
                                        <h1>Age Courses</h1>
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
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Age of Courses Table</li>
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
                                            <div class="col-lg-12">
                                                <span>
                                                    <a class="btn btn-success text-white" onclick="add_age_modal_fx()">Add Age Of Course</a>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="datatable2" class="display compact table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>From Age</th>
                                                        <th>To Age</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($mainAgeQuery as $age_ck)
                                                    <tr>
                                                        <td>{{ strtolower($age_ck->age_from) }} Years</td>
                                                        <td>{{ strtolower($age_ck->age_to) }} Years</td>
                                                        <td>
                                                            <?php echo date('d M,Y',strtotime($age_ck->updated_at)); ?>
                                                        </td>
                                                        <!-- <td>
                                                            <span class="text-info text-bold"><a href="javascript:;" onclick="tutor_edit_fx({{ $age_ck->id }})" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></span> <span class="text-danger text-bold"><a href="javascript:;" class="btn btn-sm btn-danger" onclick="tutor_del_fx({{ $age_ck->id }})"><i class="fa fa-trash"></i></a></span>
                                                        </td> -->
                                                        <td>
                                                            <span class="text-info text-bold"><a href="javascript:;" onclick="edit_age_modal_fx({{ $age_ck->id }})" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></span> <span class="text-danger text-bold"><a href="javascript:;" onclick="delete_age_modal_fx({{ $age_ck->id }})" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a></span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>From Age</th>
                                                        <th>To Age</th>
                                                        <th>Date</th>
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
                        <!-- end age course -->
                    </div>
                    <!-- end container-fluid -->
                </div>

<!-- add main course modal -->
<div class="modal" id="add-main-course-Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Main Course Modal</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.course-main-add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="from-age-id">Course Name:</label>
                <input type="text" required class="form-control" placeholder="Course Name" id="from-age-id" name="main_course_name">
            </div>
            <div class="form-group">
                <label for="main-course-user-role-id">User Role:</label>
                <select required class="form-control" id="main-course-user-age-id" name="user_role">
                    <option value="">Choose user role</option>
                    <option value="1">Child</option>
                    <option value="2">Teen</option>
                    <option value="3">Adult</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- edit main course modal -->
<div class="modal" id="edit-main-course-Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Main Course Modal</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.course-main-update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="edit_main_course_hidden_name" value="" id="edit-main-course-hidden-name-id">
            <div class="form-group">
                <label for="from-age-id">Course Name:</label>
                <input type="text" required class="form-control" placeholder="Course Name" id="edit-from-main-course-id" name="edit_main_course_name">
            </div>
            <div class="form-group">
                <label for="edit-main-course-user-role-id">User Role:</label>
                <select required class="form-control" id="edit-main-course-user-age-id" name="edit_user_role">
                    <option value="">Choose user role</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- add age group modal -->
<div class="modal" id="add-age-Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Age Modal</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.course-age-add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="from-age-id">From Age:</label>
                <input type="number" required class="form-control" placeholder="From Age" id="from-age-id" name="from_age_name">
            </div>
            <div class="form-group">
                <label for="to-age-id">To Age:</label>
                <input type="number" required class="form-control" placeholder="To Age" id="to-age-id" name="to_age_name">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- edit age group modal -->
<div class="modal" id="edit-age-Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Age Modal</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.course-age-update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="course_age_hidden_name" id="course-age-hidden-id" value=""> 
            <div class="form-group">
                <label for="edit-from-age-id">From Age:</label>
                <input type="number" required class="form-control" placeholder="From Age" id="edit-from-age-id" name="edit_from_age_name">
            </div>
            <div class="form-group">
                <label for="edit-to-age-id">To Age:</label>
                <input type="number" required class="form-control" placeholder="To Age" id="edit-to-age-id" name="edit_to_age_name">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- The Add Student Modal -->
<div class="modal" id="add-all-course-Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Course</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.add-course') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="main-role-id">User Role:</label>
                <select required class="form-control" id="main-role-id" name="main_role_name" required>
                    <option value="">Choose a user role</option>
                    <option value="1">Child</option>
                    <option value="2">Teen</option>
                    <option value="3">Adult</option>
                </select>
            </div>
            <div class="form-group">
                <label for="main-course-id">Main Courses:</label>
                <select required class="form-control" id="main-course-id" name="main_course_name" required>
                    <option value="">Choose a main course</option>
                    @foreach($mainCourseQuery as $mCourseQ)
                        <option value="{{ $mCourseQ->id }}">{{ $mCourseQ->main_course_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sub-course-name-id">Sub Course:</label>
                <input type="text" class="form-control" placeholder="Enter sub course name" id="sub-course-name-id" name="sub_course_name">
            </div>
            <div class="form-group">
                <label for="main-age-id">Age Scale:</label>
                <select required class="form-control" id="main-age-id" name="main_age_name" required>
                    <option value="">Choose a age scale</option>
                    @foreach($mainAgeQuery as $mAgeQ)
                        <option value="{{ $mAgeQ->id }}">{{ $mAgeQ->age_from }} to {{ $mAgeQ->age_to }} years</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="topics-id">Sub courses topic name:</label>
                <input type="text" required class="form-control" placeholder="Enter topics name" id="topics-id" name="topics_name">
            </div>
            <div class="form-group">
                <label for="no-of-unit-id">No of units:</label>
                <input type="number" required class="form-control" placeholder="Enter no. of unit" id="no-of-unit-id" name="no_unit_name">
            </div>
            <div class="form-group">
                <label for="no-of-unit-id">No of lessons:</label>
                <input type="number" required class="form-control" placeholder="Enter no. of lessons" id="no-of-lessons-id" name="no_lessons_name">
            </div>
            <div class="form-group">
                <label for="no-of-course-duration-id">Class Duration (in minute):</label>
                <input type="number" required class="form-control" placeholder="Enter class duration" id="no-of-course-duration-id" name="no_of_course_duration_name">
            </div>
            <div class="form-group" style="display: none;">
                <label for="no-of-month-duration-id">Course Duration (in month):</label>
                <input type="number" required class="form-control" placeholder="Enter course duration" id="no-of-month-duration-id" name="no_of_month_duration_name" value="0">
            </div>
            <div class="form-group">
                <label for="total-amount-of-course-id">Course Total Amount:</label>
                <input type="number" required class="form-control" placeholder="Enter course total amount" id="total-amount-of-course-id" name="total_course_amount" min="0" max="999999999999" value="0">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- The Edit language Modal -->
<div class="modal" id="edit-all-course-Modal">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Edit Course</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{ route('admin.update-course') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="course_edit_hidden_id_name" value="" id="course-edit-hidden-id">
                <div class="form-group">
                    <label for="edit-main-role-id">User Role:</label>
                    <select required class="form-control" id="edit-main-role-id" name="main_role_name" required>
                        <option value="">Choose a user role</option>
                        <option value="1">Child</option>
                        <option value="2">Teen</option>
                        <option value="3">Adult</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit-main-course-id">Main Courses:</label>
                    <select required class="form-control" id="edit-main-course-id" name="main_course_name" required>
                        <option value="">Choose a main course</option>
                        @foreach($mainCourseQuery as $mCourseQ)
                            <option value="{{ $mCourseQ->id }}">{{ $mCourseQ->main_course_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sub-course-name-id">Sub Course:</label>
                    <input type="text" class="form-control" placeholder="Enter sub course name" id="edit-sub-course-name-id" name="sub_course_name">
                </div>
                <div class="form-group">
                    <label for="main-age-id">Age Scale:</label>
                    <select required class="form-control" id="edit-main-age-id" name="main_age_name" required>
                        <option value="">Choose a age scale</option>
                        @foreach($mainAgeQuery as $mAgeQ)
                            <option value="{{ $mAgeQ->id }}">{{ $mAgeQ->age_from }} to {{ $mAgeQ->age_to }} years</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="topics-id">Sub courses topic name:</label>
                    <input type="text" required class="form-control" placeholder="Enter topics name" id="edit-topics-id" name="topics_name">
                </div>
                <div class="form-group">
                    <label for="no-of-unit-id">No of units:</label>
                    <input type="number" required class="form-control" placeholder="Enter no. of unit" id="edit-no-of-unit-id" name="no_unit_name">
                </div>
                <div class="form-group">
                    <label for="no-of-unit-id">No of lessons:</label>
                    <input type="number" required class="form-control" placeholder="Enter no. of lessons" id="edit-no-of-lessons-id" name="no_lessons_name">
                </div>
                <div class="form-group">
                    <label for="no-of-course-duration-id">Class Duration (in minute):</label>
                    <input type="number" required class="form-control" placeholder="Enter class duration" id="edit-no-of-course-duration-id" name="no_of_course_duration_name">
                </div>
                <div class="form-group" style="display: none;">
                    <label for="no-of-month-duration-id">Course Duration (in month):</label>
                    <input type="number" required class="form-control" placeholder="Enter course duration" id="edit-no-of-month-duration-id" name="no_of_month_duration_name" value="0">
                </div>
                <div class="form-group">
                    <label for="edit-total-amount-of-course-id">Course Total Amount:</label>
                    <input type="number" required class="form-control" placeholder="Enter course total amount" id="edit-total-amount-of-course-id" name="total_course_amount" min="0" max="999999999999" value="0">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </form>
        </div>
        </div>
  </div>
</div>
@endsection
@section('adminjsContent')
<script>
    function main_course_delete_popup(id)
    {
        var x = confirm('Are you sure to delete course ?');
        if(x)
        {
            $.ajax({
                url: "{{ route('admin.course-main-delete') }}",
                type: "GET",
                data: {id: id},
                dataType: "json",
                success: function(event){
                    if(event == "success"){
                        success_pass_alert_show_msg("Successfully delete this main course");
                        location.reload();
                    }else if(event == "error"){
                        error_pass_alert_show_msg("Try again! Something went wrong");
                    }
                }, error: function(event){

                }
            })
        }
    }

    function main_course_edit_popup(id)
    {
        $("#edit-main-course-Modal").modal('show');
        $.ajax({
            url: "{{ route('admin.course-main-edit') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#edit-from-main-course-id").val(event.main_course);
                $("#edit-main-course-hidden-name-id").val(id);
                $("#edit-main-course-user-age-id").html(event.user_role)
            }, error: function(event){

            }
        })
    }

    function add_main_course_modal_fx()
    {
        $("#add-main-course-Modal").modal('show');
    }

    function delete_age_modal_fx(id)
    {
        var x = confirm('Are you sure to delete this age scale ?');
        if(x)
        {
            $.ajax({
                url: "{{ route('admin.course-age-delete') }}",
                type: "GET",
                data: {id: id},
                dataType: "json",
                success: function(event){
                    if(event == "success"){
                        success_pass_alert_show_msg("Successfully delete that age scale");
                        location.reload();
                    }else if(event == "error"){
                        error_pass_alert_show_msg("Try again! Something went wrong");
                    }
                }, error: function(event){

                }
            })
        }
    }

    function add_age_modal_fx()
    {
        $("#add-age-Modal").modal('show');
    }

    function edit_age_modal_fx(id)
    {
        $("#edit-age-Modal").modal('show');
        $.ajax({
            url: "{{ route('admin.course-age-edit') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#course-age-hidden-id").val(id);
                $("#edit-from-age-id").val(event.from_age);
                $("#edit-to-age-id").val(event.to_age);
            }, error: function(event){

            }
        })
    }

    function add_all_courses_modal_fx()
    {
        $("#add-all-course-Modal").modal('show');
    }

    function course_change_state_fx(id, update_state)
    {
        $.ajax({
            url: "{{ route('admin.course-status-change') }}",
            type: "GET",
            data: {id: id, update_state: update_state},
            dataType: "json",
            success: function(event){
                    if(event == "success"){
                        success_pass_alert_show_msg("Successfully updated");
                        location.reload();
                    }else if(event == "error"){
                        error_pass_alert_show_msg("Try again! Something went wrong");
                    }
            }, error: function(event){

            }
        })
    }

    function course_change_del_fx(id)
    {
        var x = confirm('Are you sure to delete course ?');
        if(x)
        {
            $.ajax({
                url: "{{ route('admin.course-delete') }}",
                type: "GET",
                data: {id: id},
                dataType: "json",
                success: function(event){
                    if(event == "success"){
                        success_pass_alert_show_msg("Successfully delete this main course");
                        location.reload();
                    }else if(event == "error"){
                        error_pass_alert_show_msg("Try again! Something went wrong");
                    }
                }, error: function(event){

                }
            })
        }
    }

    function course_change_edit_fx(id)
    {
        $("#edit-all-course-Modal").modal('show');
        $.ajax({
            url: "{{ route('admin.edit-course') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#course-edit-hidden-id").val(id);
                $("#edit-main-course-id").html(event.main_course_name);
                $("#edit-main-role-id").html(event.user_role);
                $("#edit-sub-course-name-id").val(event.sub_course_name);
                $("#edit-main-age-id").html(event.age_course_name);
                $("#edit-topics-id").val(event.topic_name);
                $("#edit-no-of-unit-id").val(event.no_of_units);
                $("#edit-no-of-lessons-id").val(event.no_of_lessons);
                $("#edit-no-of-course-duration-id").val(event.times_in_minutes);
                $("#edit-no-of-month-duration-id").val(event.course_in_month);
                $("#edit-total-amount-of-course-id").val(event.course_total_price);
            }, error: function(event){

            }
        })
    }
</script>
@endsection