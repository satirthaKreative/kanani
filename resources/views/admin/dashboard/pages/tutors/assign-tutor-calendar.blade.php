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
                        <h1>Tutors Available Time-table</h1>
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
                                <li class="breadcrumb-item active text-primary" aria-current="page">Assign Tutors Calendar Table</li>
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
                                    <!-- <a class="btn btn-success text-white" onclick="assign_tutor_modal_fx()">Assign Tutor</a> -->
                                </span>
                            </div>
                       </div>
                        <div class="datatable-wrapper table-responsive">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end row -->
    </div><!-- end container-fluid -->
</div>
<!-- The Add language Modal -->
<div class="modal" id="add-assign-tutor-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Assign Tutor</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('admin.assign-tutor-final-submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="last-name-text-modal">Choose Tutors:</label>
                <select required class="form-control" id="choose-course-with-tutors" name="choose_course_with_tutors">

                </select>
            </div>
            <input type="hidden" name="student_name" id="student-name-id" value="" />
            <input type="hidden" name="course_name" id="course-name-id" value="" />
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
    
</script>
@endsection