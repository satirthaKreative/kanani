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
                            @if(count($chooseQuery) > 0)
                                @foreach($chooseQuery as $chooseUsData)
                                    @php $change_path1 = str_replace('public','storage/app/public',$chooseUsData->main_img); @endphp
                                    @php $main_img = '<img src="'.asset($change_path1).'" alt="no image" width="100px" />'; @endphp
                                    @php $change_path2 = str_replace('public','storage/app/public',$chooseUsData->get_started_img); @endphp
                                    @php $get_started_img = '<img src="'.asset($change_path2).'" alt="no image" width="100px" />'; @endphp
                                    @php $change_path3 = str_replace('public','storage/app/public',$chooseUsData->lets_see_online_img); @endphp
                                    @php $img_path3 = '<img src="'.asset($change_path3).'" alt="no image" width="100px" />'; @endphp
                                    
                                    @php $main_course_type = $chooseUsData->main_course_type;  @endphp
                                    @php $total_chapters = $chooseUsData->total_chapters; @endphp
                                    @php $total_lessons = $chooseUsData->total_lessons; @endphp
                                    @php $course_heading = $chooseUsData->course_heading; @endphp
                                    @php $course_description = $chooseUsData->course_description; @endphp
                                    @php $get_started_heading = $chooseUsData->get_started_heading; @endphp
                                    @php $get_started_discount_price = $chooseUsData->get_started_discount_price; @endphp
                                    @php $get_started_total_price = $chooseUsData->get_started_total_price; @endphp
                                    @php $get_started_percentage_price = $chooseUsData->get_started_percentage_price; @endphp
                                    @php $this_course_includes_heading = $chooseUsData->this_course_includes_heading; @endphp
                                    @php $this_course_includes_paragraph = $chooseUsData->this_course_includes_paragraph; @endphp
                                    @php $lets_see_online_upper_heading = $chooseUsData->lets_see_online_upper_heading; @endphp
                                    @php $lets_see_online_main_heading = $chooseUsData->lets_see_online_main_heading; @endphp
                                    @php $lets_see_online_main_paragraph = $chooseUsData->lets_see_online_main_paragraph; @endphp
                                    @php $course_user_type = $chooseUsData->course_user_type; @endphp
                                    @php $img1 = $main_img; @endphp
                                    @php $img2 = $get_started_img; @endphp
                                    @php $img3 = $img_path3; @endphp
                                    @if($chooseUsData->course_user_type =="adult")
                                        @php $course_user_type_check = "adult"; @endphp
                                    @elseif($chooseUsData->course_user_type =="teen")
                                        @php $course_user_type_check = "teen"; @endphp
                                    @elseif($chooseUsData->course_user_type =="child")
                                        @php $course_user_type_check = "child"; @endphp
                                    @endif
                                    @php $get_started_video_link = $chooseUsData->get_started_video_link; @endphp
                                @endforeach
                                @else
                                    @php $main_course_type = "";  @endphp
                                    @php $total_chapters = ""; @endphp
                                    @php $total_lessons = ""; @endphp
                                    @php $course_heading = ""; @endphp
                                    @php $course_description = ""; @endphp
                                    @php $get_started_heading = ""; @endphp
                                    @php $get_started_discount_price = ""; @endphp
                                    @php $get_started_total_price = ""; @endphp
                                    @php $get_started_percentage_price = ""; @endphp
                                    @php $this_course_includes_heading = ""; @endphp
                                    @php $this_course_includes_paragraph = ""; @endphp
                                    @php $lets_see_online_upper_heading = ""; @endphp
                                    @php $lets_see_online_main_heading = ""; @endphp
                                    @php $lets_see_online_main_paragraph = ""; @endphp
                                    @php $course_user_type = ""; @endphp
                                    @php $img1 = ""; @endphp
                                    @php $img2 = ""; @endphp
                                    @php $img3 = ""; @endphp
                                    @php $get_started_video_link = ""; @endphp
                            @endif
                            @csrf
                            <div class="form-group">
                                <label for="courses-image-id">Main Course image</label>
                                <input type="file" class="form-control" name="main_img" id="courses-image-id"  />
                            </div>
                            <div class="image-show">
                                <?php echo $img1; ?>
                            </div>
                            <!-- <div class="form-group">
                                <label for="main-course-type-id">Main Courses Type</label> -->
                                <input type="hidden" class="form-control" name="main_course_type" id="main-course-type-id" placeholder="Main Courses Type" value="{{ $main_course_type }}" required />
                            <!-- </div>
                            <div class="form-group">
                                <label for="total-chapters-id">Total Chapters</label> -->
                                <input type="hidden" class="form-control" name="total_chapters" id="total-chapters-id" placeholder="Total Chapters" value="{{ $total_chapters }}" required />
                            <!-- </div>
                            <div class="form-group">
                                <label for="total-lessons-id">Total Lessons</label> -->
                                <input type="hidden" class="form-control" name="total_lessons" id="total-lessons-id" placeholder="Total Lessons" value="{{ $total_lessons }}" required />
                            <!-- </div> -->
                            <div class="form-group">
                                <label for="course-heading-id">Course Heading</label>
                                <textarea class="form-control" id="course-heading-id" placeholder="Course Heading....." name="course_heading" required><?php echo $course_heading; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="course-description-id">Course Description</label>
                                <textarea class="form-control" id="course-description-id" placeholder="Course Heading....." name="course_description" required><?php echo $course_description; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="get-started-image-id">Get Started image</label>
                                <input type="file" class="form-control" name="get_started_img" id="get-started-image-id"  />
                            </div>
                            <div class="image-show">
                                <?php echo $img2; ?>
                            </div>
                            <div class="form-group">
                                <label for="get-started-video-link-id">Get Started Video Link</label>
                                <textarea class="form-control" id="get-started-video-link-id" placeholder="Course Video Link....." name="get_started_video_link" required><?php echo $get_started_video_link; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="get-started-course-heading-id">Get Started Course Heading</label>
                                <textarea class="form-control" id="get-started-course-heading-id" placeholder="Course Heading....." name="get_started_heading" required><?php echo $get_started_heading; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="discounted-course-price-id">Get Started Discounted Course Price</label>
                                <input type="number" class="form-control" name="get_started_discount_price" id="discounted-course-price-id" placeholder="Discounted Course Price" value="{{ $get_started_discount_price }}" required />
                            </div>
                            <div class="form-group">
                                <label for="total-course-price-id">Get Started Total Course Price</label>
                                <input type="number" class="form-control" name="get_started_total_price" id="total-course-price-id" placeholder="Total Course Price" value="{{ $get_started_total_price }}" required />
                            </div>
                            <div class="form-group">
                                <label for="get-started-percentage-price-id">Get Started Total Course Off Percentage</label>
                                <input type="number" class="form-control" name="get_started_percentage_price" id="get-started-percentage-price-id" placeholder="Price Off Percentage" value="{{ $get_started_percentage_price }}" required />
                            </div>
                            <div class="form-group">
                                <label for="total-lessons-id">Total Lessons</label>
                                <input type="text" class="form-control" name="total_lessons" id="total-lessons-id" placeholder="Total Lessons" value="{{ $total_lessons }}" required />
                            </div>
                            <div class="form-group">
                                <label for="this-course-includes-heading-id">Get Started "This course includes" Heading</label>
                                <input type="text" class="form-control" name="this_course_includes_heading" id="this-course-includes-heading-id" placeholder="This course includes....." value="{{ $this_course_includes_heading }}" required />
                            </div>
                            <div class="form-group">
                                <label for="this-course-includes-paragraph-id">Get Started "This course includes" Details</label>
                                <textarea class="form-control" id="this-course-includes-paragraph-id" placeholder="This course includes....." name="this_course_includes_paragraph" required><?php echo $this_course_includes_paragraph; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="lets-see-online-image-id">Let's See Online image</label>
                                <input type="file" class="form-control" name="lets_see_online_img" id="lets-see-online-image-id"  />
                            </div>
                            <div class="image-show">
                                <?php echo $img3; ?>
                            </div>
                            <div class="form-group">
                                <label for="lets-see-online-upper-heading-id">Let's See Online Upper Heading</label>
                                <input type="text" class="form-control" name="lets_see_online_upper_heading" id="lets-see-online-upper-heading-id" placeholder="Online Upper heading" value="{{ $lets_see_online_upper_heading }}" required />
                            </div>
                            <div class="form-group">
                                <label for="lets-see-online-heading-id">Let's See Online Heading</label>
                                <input type="text" class="form-control" name="lets_see_online_main_heading" id="lets-see-online-heading-id" placeholder="Online heading" value="{{ $lets_see_online_main_heading }}" required />
                            </div>
                            <div class="form-group">
                                <label for="lets-see-online-paragraph-id">lets's See Online Details</label>
                                <textarea class="form-control" id="lets-see-online-paragraph-id" placeholder="Online Details ...." name="lets_see_online_main_paragraph" required><?php echo $lets_see_online_main_paragraph; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="lets-see-online-heading-id">Course User Type</label>
                                <select class="form-control" name="course_user_type" id="course-user-type-id"  required>
                                    <option value="">Choose your user type</option>
                                    <option @if($course_user_type_check == "adult") selected @endif value="adult">Adult</option>
                                    <option @if($course_user_type_check == "teen") selected @endif value="teen">Teen</option>
                                    <option @if($course_user_type_check == "child") selected @endif value="child">Child</option>
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