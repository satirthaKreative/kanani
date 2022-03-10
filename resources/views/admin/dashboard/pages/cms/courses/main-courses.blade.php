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
                                        <h1>Main Courses</h1>
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
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Main Courses Details</li>
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
                                            <h4 class="card-title">Main Courses Details Form</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.cms.main-course.submit') }}" method="POST">
                                            @if(count($chooseQuery) > 0)
                                                @foreach($chooseQuery as $chooseUsData)
                                                    @php $headline = $chooseUsData->headline;  @endphp
                                                    @php $main_description = $chooseUsData->main_description; @endphp
                                                    @php $kids_english_course = $chooseUsData->kids_english_course; @endphp
                                                    @php $kids_price = $chooseUsData->kids_price; @endphp
                                                    @php $teen_english_course = $chooseUsData->teen_english_course; @endphp
                                                    @php $teen_price = $chooseUsData->teen_price; @endphp
                                                    @php $adult_english_course = $chooseUsData->adult_english_course; @endphp
                                                    @php $adult_price = $chooseUsData->adult_price; @endphp
                                                    @php $lets_see_online_education = $chooseUsData->lets_see_online_education; @endphp
                                                    @php $lets_see_online_education_description = $chooseUsData->lets_see_online_education_description; @endphp
                                                    @php $kids_english_course_short_description = $chooseUsData->kids_english_course_short_description; @endphp
                                                    @php $teen_english_course_short_description = $chooseUsData->teen_english_course_short_description; @endphp
                                                    @php $adult_english_course_short_description = $chooseUsData->adult_english_course_short_description; @endphp
                                                @endforeach
                                            @else
                                                    @php $headline = "";  @endphp
                                                    @php $main_description = ""; @endphp
                                                    @php $kids_english_course = ""; @endphp
                                                    @php $kids_price = ""; @endphp
                                                    @php $teen_english_course = ""; @endphp
                                                    @php $teen_price = ""; @endphp
                                                    @php $adult_english_course = ""; @endphp
                                                    @php $adult_price = ""; @endphp
                                                    @php $lets_see_online_education = ""; @endphp
                                                    @php $lets_see_online_education_description = ""; @endphp
                                                    @php $kids_english_course_short_description = ""; @endphp
                                                    @php $teen_english_course_short_description = ""; @endphp
                                                    @php $adult_english_course_short_description = ""; @endphp
                                            @endif
                                            @csrf
                                            <div class="form-group">
                                                <label for="heading-id1">Headline</label>
                                                <input type="text" class="form-control" name="headline" id="heading-id1" placeholder="Headline" value="{{ $headline }}" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="paragraph-heading-id1">Main Description</label>
                                                <textarea class="form-control" id="paragraph-heading-id1" placeholder="Main Description" name="main_description" required><?php echo $main_description; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="kids-english-course-id">Kids English Courses Short Description</label>
                                                <textarea class="form-control" name="kids_english_course_short_description" id="kids-short-descripton-english-course-id"  rows=6 required><?php echo $kids_english_course_short_description; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="kids-english-course-id">Kids English Courses</label>
                                                <textarea class="form-control" name="kids_english_course" id="kids-english-course-id"  rows=6 required><?php echo $kids_english_course; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="kids-english-courses-price-id">Kids English Courses Price</label>
                                                <input type="number" class="form-control" name="kids_english_courses_price_name" id="kids-english-courses-price-id" value="{{ $kids_price }}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="kids-english-course-id">Teen English Courses Short Description</label>
                                                <textarea class="form-control" name="teen_english_course_short_description" id="teen-short-description-english-course-id"  rows=6 required><?php echo $teen_english_course_short_description; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="teen-english-course-id">Teen English Courses</label>
                                                <textarea class="form-control" name="teen_english_course" id="teen-english-course-id"  rows=6 required><?php echo $teen_english_course; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="teen-english-courses-price-id">Teen English Courses Price</label>
                                                <input type="number" class="form-control" name="teen_english_courses_price_name" id="teen-english-courses-price-id" value="{{ $teen_price }}"  />
                                            </div>
                                            <div class="form-group">
                                                <label for="kids-english-course-id">Adult English Courses Short Description</label>
                                                <textarea class="form-control" name="adult_english_course_short_description" id="adult-short-description-english-course-id"  rows=6 required><?php echo $adult_english_course_short_description; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="adult-english-course-id">Adult English Courses</label>
                                                <textarea class="form-control" name="adult_english_course" id="adult-english-course-id"  rows=6 required><?php echo $adult_english_course; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="adult-english-courses-price-id">Adult English Courses Price</label>
                                                <input type="number" class="form-control" name="adult_english_courses_price_name" id="adult-english-courses-price-id" value="{{ $adult_price }}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="lets-see-online-education-id">lets see online education heading</label>
                                                <input type="text" class="form-control" name="lets_see_online_education" id="lets-see-online-education-id" value="{{ $lets_see_online_education }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="lets-see-online-education-des-id">lets see online education description</label>
                                                <textarea class="form-control" name="lets_see_online_education_des" id="lets-see-online-education-des-id"  rows=6 required><?php echo $lets_see_online_education_description; ?></textarea>
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
    CKEDITOR.replace( 'main_description' );
    CKEDITOR.replace( 'kids_english_course' );
    CKEDITOR.replace( 'teen_english_course' );
    CKEDITOR.replace( 'adult_english_course' );
    CKEDITOR.replace( 'lets_see_online_education_des' );
    CKEDITOR.replace( 'kids_english_course_short_description' );
    CKEDITOR.replace( 'teen_english_course_short_description' );
    CKEDITOR.replace( 'adult_english_course_short_description' );

</script>
@endsection