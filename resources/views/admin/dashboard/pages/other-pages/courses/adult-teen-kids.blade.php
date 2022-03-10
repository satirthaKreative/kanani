@extends('admin.layouts.app-dashboard')
 
@section('content')
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
                                                        <th>Role Type</th>
                                                        <th>Course Heading</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($chooseQuery) > 0)
                                                        @foreach($chooseQuery as $iQ)
                                                            @php $change_path3 = str_replace('public','storage/app/public',$iQ->blog_imgs); @endphp
                                                            @php $img_path3 = '<img src="'.asset($change_path3).'" alt="no image" width="100px" />'; @endphp
                                                            <tr>
                                                                <td>{{ $iQ->main_course_type }}</td>
                                                                <td>{{ $iQ->course_user_type }}</td>
                                                                <td>{{ $iQ->course_heading }}</td>
                                                                <td>
                                                                    <!-- <a href="javascript:;" class="text-danger" onclick="del_course_fx({{ $iQ->id }})"><i class="fa fa-trash"></i></a> -->
                                                                    <a href="{{ route('admin.cms-edit-adult-child-teen-course',$iQ->id) }}" class="text-info"><i class="fa fa-edit"></i></a> <a href="{{ route('admin.cms-course-structure',$iQ->id) }}" class="btn btn-info btn-sm">Course Structure</a></td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                    <tr>
                                                        <td colspan=4 class="text-danger"><center><i class="fa fa-times"></i> No CMS courses added yet</center></td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Course Type</th>
                                                        <th>Role Type</th>
                                                        <th>Course Heading</th>
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
                        <form action="{{ route('admin.cms-adult-child-teen-course-submit') }}" method="POST" enctype="multipart/form-data">
                            
                            @csrf
                            <div class="form-group">
                                <label for="courses-image-id">Main Course image</label>
                                <input type="file" class="form-control" name="main_img" id="courses-image-id"  />
                            </div>
                            <div class="image-show">
                                
                            </div>
                            <!-- <div class="form-group">
                                <label for="main-course-type-id">Main Courses Type</label> -->
                                <input type="hidden" class="form-control" name="main_course_type" id="main-course-type-id" placeholder="Main Courses Type" value="" required />
                            <!-- </div>
                            <div class="form-group">
                                <label for="total-chapters-id">Total Chapters</label> -->
                                <input type="hidden" class="form-control" name="total_chapters" id="total-chapters-id" placeholder="Total Chapters" value="" required />
                            <!-- </div>
                            <div class="form-group">
                                <label for="total-lessons-id">Total Lessons</label> -->
                                <input type="hidden" class="form-control" name="total_lessons" id="total-lessons-id" placeholder="Total Lessons" value="" required />
                            <!-- </div> -->
                            <div class="form-group">
                                <label for="course-heading-id">Course Heading</label>
                                <textarea class="form-control" id="course-heading-id" placeholder="Course Heading....." name="course_heading" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="course-description-id">Course Description</label>
                                <textarea class="form-control" id="course-description-id" placeholder="Course Heading....." name="course_description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="get-started-image-id">Get Started image</label>
                                <input type="file" class="form-control" name="get_started_img" id="get-started-image-id"  />
                            </div>
                            <div class="image-show">
                                
                            </div>
                            <div class="form-group">
                                <label for="get-started-video-link-id">Get Started Video Link</label>
                                <textarea class="form-control" id="get-started-video-link-id" placeholder="Course Video Link....." name="get_started_video_link" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="get-started-course-heading-id">Get Started Course Heading</label>
                                <textarea class="form-control" id="get-started-course-heading-id" placeholder="Course Heading....." name="get_started_heading" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="discounted-course-price-id">Get Started Discounted Course Price</label>
                                <input type="number" class="form-control" name="get_started_discount_price" id="discounted-course-price-id" placeholder="Discounted Course Price" value="" required />
                            </div>
                            <div class="form-group">
                                <label for="total-course-price-id">Get Started Total Course Price</label>
                                <input type="number" class="form-control" name="get_started_total_price" id="total-course-price-id" placeholder="Total Course Price" value="" required />
                            </div>
                            <div class="form-group">
                                <label for="get-started-percentage-price-id">Get Started Total Course Off Percentage</label>
                                <input type="number" class="form-control" name="get_started_percentage_price" id="get-started-percentage-price-id" placeholder="Price Off Percentage" value="" required />
                            </div>
                            <div class="form-group">
                                <label for="total-lessons-id">Total Lessons</label>
                                <input type="text" class="form-control" name="total_lessons" id="total-lessons-id" placeholder="Total Lessons" value="" required />
                            </div>
                            <div class="form-group">
                                <label for="this-course-includes-heading-id">Get Started "This course includes" Heading</label>
                                <input type="text" class="form-control" name="this_course_includes_heading" id="this-course-includes-heading-id" placeholder="This course includes....." value="" required />
                            </div>
                            <div class="form-group">
                                <label for="this-course-includes-paragraph-id">Get Started "This course includes" Details</label>
                                <textarea class="form-control" id="this-course-includes-paragraph-id" placeholder="This course includes....." name="this_course_includes_paragraph" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="lets-see-online-image-id">Let's See Online image</label>
                                <input type="file" class="form-control" name="lets_see_online_img" id="lets-see-online-image-id"  />
                            </div>
                            <div class="image-show">
                                
                            </div>
                            <div class="form-group">
                                <label for="lets-see-online-upper-heading-id">Let's See Online Upper Heading</label>
                                <input type="text" class="form-control" name="lets_see_online_upper_heading" id="lets-see-online-upper-heading-id" placeholder="Online Upper heading" value="" required />
                            </div>
                            <div class="form-group">
                                <label for="lets-see-online-heading-id">Let's See Online Heading</label>
                                <input type="text" class="form-control" name="lets_see_online_main_heading" id="lets-see-online-heading-id" placeholder="Online heading" value="" required />
                            </div>
                            <div class="form-group">
                                <label for="lets-see-online-paragraph-id">lets's See Online Details</label>
                                <textarea class="form-control" id="lets-see-online-paragraph-id" placeholder="Online Details ...." name="lets_see_online_main_paragraph" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="lets-see-online-heading-id">Course User Type</label>
                                <select class="form-control" name="course_user_type" id="course-user-type-id"  required>
                                    <option value="">Choose your user type</option>
                                    <option value="adult">Adult</option>
                                    <option value="teen">Teen</option>
                                    <option value="child">Child</option>
                                </select>
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
    CKEDITOR.replace( 'course_heading' );
    CKEDITOR.replace( 'course_description' );
    CKEDITOR.replace( 'get_started_heading' );
    
    CKEDITOR.replace( 'this_course_includes_paragraph' );
    CKEDITOR.replace( 'lets_see_online_main_paragraph' );
</script>
@endsection