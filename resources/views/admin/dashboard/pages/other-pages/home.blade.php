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
                                        <h1>Home Page Cms</h1>
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
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Home Page Details</li>
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
                            <div class="col-xl-8">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Home Page Cms Details Form</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.cms.home.submit') }}" method="POST" enctype="multipart/form-data">
                                            @if(count($getHomeQuery) > 0)
                                                @foreach($getHomeQuery as $gHomeQ)

                                                @php $change_path1 = str_replace('public','storage/app/public',$gHomeQ->largest_collection_of_courses_img); @endphp
                                                @php $img_path1 = '<img src="'.asset($change_path1).'" alt="no image" width="100px" />'; @endphp
                                                @php $change_path2 = str_replace('public','storage/app/public',$gHomeQ->welcome_to_kanani_image_name); @endphp
                                                @php $img_path2 = '<img src="'.asset($change_path2).'" alt="no image" width="100px" />'; @endphp
                                                @php $change_path3 = str_replace('public','storage/app/public',$gHomeQ->lets_see_online_education_image); @endphp
                                                @php $img_path3 = '<img src="'.asset($change_path3).'" alt="no image" width="100px" />'; @endphp
                                                @php $largest_collection_of_courses_name = $gHomeQ->largest_collection_of_courses_name;  @endphp
                                                @php $largest_collection_of_courses_paragraph_name  = $gHomeQ->largest_collection_of_courses_paragraph_name; @endphp 
                                                @php $img1 = $img_path1; @endphp
                                                @php 
                                                $welcome_to_kanani_name = $gHomeQ->welcome_to_kanani_name; @endphp
                                                @php 
                                                $welcome_to_kanani_paragraph_name = $gHomeQ->welcome_to_kanani_paragraph_name; @endphp
                                                @php $img2 = $img_path2; @endphp 
                                                @php $lets_see_online_education_name  = $gHomeQ->lets_see_online_education_name; 
                                                @endphp 
                                                @php $lets_see_online_education_description_name  = $gHomeQ->lets_see_online_education_description_name; @endphp 
                                                @php $img3 = $img_path3; @endphp 
                                                @php $install_zoom_heading_name = $gHomeQ->install_zoom_heading_name; @endphp
                                                @php $install_zoom_paragraph_name = $gHomeQ->install_zoom_paragraph_name; @endphp
                                                @php $join_a_trail_class_heading_name = $gHomeQ->join_a_trail_class_heading_name; @endphp
                                                @php $join_a_trail_class_paragraph_name = $gHomeQ->join_a_trail_class_paragraph_name; @endphp
                                                @php $select_a_course_class_heading_name = $gHomeQ->select_a_course_class_heading_name; @endphp
                                                @php $select_a_course_class_paragraph_name = $gHomeQ->select_a_course_class_paragraph_name; @endphp 
                                                @php $start_your_journey_class_heading_name = $gHomeQ->start_your_journey_class_heading_name; @endphp
                                                @php $start_your_journey_class_paragraph_name = $gHomeQ->start_your_journey_class_paragraph_name; @endphp
                                                @php $blog_class_heading_name = $gHomeQ->blog_class_heading_name; @endphp
                                                @php $blog_class_paragraph_name = $gHomeQ->blog_class_paragraph_name; @endphp
                                                @php $our_courses_class_heading_name = $gHomeQ->our_courses_class_heading_name; @endphp
                                                @php $our_courses_class_paragraph_name = $gHomeQ->our_courses_class_paragraph_name; @endphp

                                                @endforeach

                                                @else


                                                    @php $largest_collection_of_courses_name = "";  @endphp
                                                    @php $largest_collection_of_courses_paragraph_name  = ""; @endphp
                                                    @php $img1 = ""; @endphp
                                                    @php $welcome_to_kanani_name = ""; @endphp
                                                    @php $welcome_to_kanani_paragraph_name = ""; @endphp
                                                    @php $img2 = ""; @endphp 
                                                    @php $lets_see_online_education_name  = ""; @endphp 
                                                    @php $lets_see_online_education_description_name = ""; @endphp 
                                                    @php $img3 = ""; @endphp 
                                                    @php $install_zoom_heading_name = ""; @endphp
                                                    @php $install_zoom_paragraph_name = ""; @endphp
                                                    @php $join_a_trail_class_heading_name = ""; @endphp;
                                                    @php $join_a_trail_class_paragraph_name = ""; @endphp
                                                    @php $select_a_course_class_heading_name = ""; @endphp
                                                    @php $select_a_course_class_paragraph_name = ""; @endphp 
                                                    @php $start_your_journey_class_heading_name = ""; @endphp
                                                    @php $start_your_journey_class_paragraph_name = ""; @endphp
                                                    @php $blog_class_heading_name = ""; @endphp
                                                    @php $blog_class_paragraph_name = ""; @endphp
                                                    @php $our_courses_class_heading_name = ""; @endphp
                                                    @php $our_courses_class_paragraph_name = ""; @endphp

                                            @endif
                                            @csrf
                                            <div class="form-group">
                                                <label for="largest-collection-of-courses-id">"Largest Collection of Courses" Heading</label>
                                                <input type="text" class="form-control" name="largest_collection_of_courses_name" id="largest-collection-of-courses-id" placeholder="Choose Us Heading" value="{{ $largest_collection_of_courses_name }}" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="largest-collection-of-courses-paragraph-id">"Largest Collection of Courses" Paragraph</label>
                                                <textarea class="form-control" id="largest-collection-of-courses-paragraph-id" placeholder="Paragraph" name="largest_collection_of_courses_paragraph_name" required><?php echo $largest_collection_of_courses_paragraph_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="largest-collection-of-courses-image-id">"Largest Collection of Courses" image</label>
                                                <input type="file" class="form-control" name="largest_collection_of_courses_img" id="largest-collection-of-courses-image-id" value="" />
                                            </div>
                                            <div class="image-show">
                                                <?php echo $img1; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="welcome-to-kanani-name-id">"Welcome to Kanani" heading</label>
                                                <input type="text" class="form-control" name="welcome_to_kanani_name" id="welcome-to-kanani-name-id" placeholder="heading"  value="{{ $welcome_to_kanani_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="welcome-to-kanani-paragraph-id">"Welcome to Kanani" Paragraph</label>
                                                <textarea class="form-control" name="welcome_to_kanani_paragraph_name" id="welcome-to-kanani-paragraph-id"  rows=6 required><?php echo $welcome_to_kanani_paragraph_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="welcome-to-kanani-image-name-id">"Welcome to Kanani" image</label>
                                                <input type="file" class="form-control" name="welcome_to_kanani_image_name" id="welcome-to-kanani-image-name-id"  />
                                            </div>
                                            <div class="image-show">
                                                <?php echo $img2; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="lets-see-online-education-name-id">"Let's See online Education" Heading</label>
                                                <input type="text" class="form-control" name="lets_see_online_education_name" id="lets-see-online-education-name-id" value="{{ $lets_see_online_education_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="lets-see-online-education-description-name-id">"Let's See online Education" Description</label>
                                                <textarea class="form-control" name="lets_see_online_education_description_name" id="lets-see-online-education-description-name-id" placeholder="Footer Content"  rows=6 required><?php echo $lets_see_online_education_description_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="lets-see-online-education-image-name-id">"Let's See online Education" image</label>
                                                <input type="file" class="form-control" name="lets_see_online_education_image" id="lets-see-online-education-description-name-id"  />
                                            </div>
                                            <div class="image-show">
                                                <?php echo $img3; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="install-zoom-heading-name-id">"Install Zoom" Heading</label>
                                                <input type="text" class="form-control" name="install_zoom_heading_name" id="install-zoom-heading-name-id" value="{{ $install_zoom_heading_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="install-zoom-paragraph-name-id">"Install Zoom" Paragraph</label>
                                                <textarea class="form-control" name="install_zoom_paragraph_name" id="install-zoom-paragraph-name-id" rows=6 required><?php echo $install_zoom_paragraph_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="join-a-trail-class-name-id">"Join a Trail Class" Heading</label>
                                                <input type="text" class="form-control" name="join_a_trail_class_heading_name" id="join-a-trail-class-name-id" value="{{ $join_a_trail_class_heading_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="join-a-trail-class-name-id">"Join a Trail Class" Paragraph</label>
                                                <textarea class="form-control" name="join_a_trail_class_paragraph_name" id="join-a-trail-class-name-id" rows=6 required><?php echo $join_a_trail_class_paragraph_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="select-a-course-class-name-id">"Select a Course" Heading</label>
                                                <input type="text" class="form-control" name="select_a_course_class_heading_name" id="select-a-course-class-name-id" value="{{ $select_a_course_class_heading_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="select-a-course-class-name-id">"Select a Course" Paragraph</label>
                                                <textarea class="form-control" name="select_a_course_class_paragraph_name" id="select-a-course-class-name-id" rows=6 required><?php echo $select_a_course_class_paragraph_name ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="start-your-journey-class-name-id">"Start your journey " Heading</label>
                                                <input type="text" class="form-control" name="start_your_journey_class_heading_name" id="start-your-journey-class-name-id" value="{{ $start_your_journey_class_heading_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="start-your-journey-paragraph-class-name-id">"Start your journey " Paragraph</label>
                                                <textarea class="form-control" name="start_your_journey_class_paragraph_name" id="start-your-journey-paragraph-class-name-id" rows=6 required><?php echo $start_your_journey_class_paragraph_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="blog-class-name-id">"Blog " Heading</label>
                                                <input type="text" class="form-control" name="blog_class_heading_name" id="blog-class-name-id" value="{{ $blog_class_heading_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="blog-paragraph-class-name-id">"Blog " Paragraph</label>
                                                <textarea class="form-control" name="blog_class_paragraph_name" id="blog-paragraph-class-name-id" rows=6 required><?php echo $blog_class_paragraph_name; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="our-courses-class-name-id">"Our Courses " Heading</label>
                                                <input type="text" class="form-control" name="our_courses_class_heading_name" id="our-courses-class-name-id" value="{{ $our_courses_class_heading_name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="our-courses-paragraph-class-name-id">"Our Courses " Paragraph</label>
                                                <textarea class="form-control" name="our_courses_class_paragraph_name" id="our-courses-paragraph-class-name-id" rows=6 required><?php echo $our_courses_class_paragraph_name; ?></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
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
<script>
    CKEDITOR.replace( 'largest_collection_of_courses_paragraph_name' );
    CKEDITOR.replace( 'welcome_to_kanani_paragraph_name' );
    CKEDITOR.replace( 'lets_see_online_education_description_name' );
    
    CKEDITOR.replace( 'blog_class_paragraph_name' );
    CKEDITOR.replace( 'our_courses_class_paragraph_name' );
</script>
@endsection