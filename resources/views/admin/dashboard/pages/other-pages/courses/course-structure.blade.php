@extends('admin.layouts.app-dashboard')
 
@section('content')
@php    $link1 = $_SERVER['REQUEST_URI'];    @endphp
@php    $link_array1 = explode('/',$link1);   @endphp
@php    $page1 = end($link_array1);   @endphp 
<div class="app-main" id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 m-b-30">
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>All Courses Cms</h1>
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
                                <li class="breadcrumb-item active text-primary" aria-current="page">All Courses Cms Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- begin row -->
        <div class="row">
                            
                            <div class="col-lg-12">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-lg-12">
                                                <span>
                                                    
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="datatable" class="display compact table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Course Type</th>
                                                        <th>Age Range</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($courseStructureQuery) > 0)
                                                        @foreach($courseStructureQuery as $iQ)
                                                            <tr>
                                                                <td>{{ $iQ->course_type }}</td>
                                                                <td>{{ $iQ->age_type }}</td>
                                                                <td>
                                                                    <a href="{{ route('admin.edit-cms-course-structure',$iQ->id) }}" class="text-info"><i class="fa fa-edit"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                    <tr>
                                                        <td colspan=3 class="text-danger"><center><i class="fa fa-times"></i> No  courses sturcture added yet</center></td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Course Type</th>
                                                        <th>Age Range</th>
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
        <div class="row">
            <div class="col-xl-8">
                <div class="card card-statistics">
                    <div class="card-header">
                        <div class="card-heading">
                            <h4 class="card-title">All Courses Details Form</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.cms-course-structure-submit') }}" method="POST" enctype="multipart/form-data">
                            
                            @csrf
                            <input type="hidden" name="course_structure_name" value="{{ $page1 }}" />
                            <div class="form-group">
                                <label for="main-course-type-id">Courses Type</label>
                                <input type="text" class="form-control" name="course_type" id="main-course-type-id" placeholder="Main Courses Type" value="" required />
                            </div>
                            <div class="form-group">
                                <label for="total-chapters-id">Course Units</label>
                                <input type="text" class="form-control" name="course_units" id="total-chapters-id" placeholder="Total Chapters" value="" required />
                            </div>
                            <div class="form-group">
                                <label for="total-lessons-id">Course Lessons</label>
                                <input type="text" class="form-control" name="course_lessons" id="total-lessons-id" placeholder="Total Lessons" value="" required />
                            </div>
                            <div class="form-group">
                                <label for="total-lessons-id">Course Duration</label>
                                <input type="text" class="form-control" name="course_duration" id="total-lessons-id" placeholder="Total Lessons" value="" required />
                            </div>
                            <div class="form-group">
                                <label for="total-lessons-id">Age</label>
                                <input type="text" class="form-control" name="age_type" id="total-lessons-id" placeholder="Total Lessons" value="" required />
                            </div>
                            <div class="form-group">
                                <label for="course-heading-id">Course Details</label>
                                <textarea class="form-control" id="course-heading-id" placeholder="Course Heading....." name="course_details" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('adminjsContent')
<script>
    CKEDITOR.replace( 'course_details' );
</script>
@endsection