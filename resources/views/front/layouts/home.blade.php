@extends('front.app')

@section('content')

<div class="banner-sec">

    <svg id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 100" version="1.1"

        xmlns="http://www.w3.org/2000/svg">

        <defs>

            <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">

                <stop stop-color="rgba(243, 106, 62, 1)" offset="0%"></stop>

                <stop stop-color="rgba(255, 179, 11, 1)" offset="100%"></stop>

            </linearGradient>

        </defs>

        <path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)"

            d="M0,0L60,15C120,30,240,60,360,75C480,90,600,90,720,76.7C840,63,960,37,1080,28.3C1200,20,1320,30,1440,43.3C1560,57,1680,73,1800,80C1920,87,2040,83,2160,76.7C2280,70,2400,60,2520,50C2640,40,2760,30,2880,36.7C3000,43,3120,67,3240,75C3360,83,3480,77,3600,61.7C3720,47,3840,23,3960,23.3C4080,23,4200,47,4320,60C4440,73,4560,77,4680,65C4800,53,4920,27,5040,16.7C5160,7,5280,13,5400,23.3C5520,33,5640,47,5760,50C5880,53,6000,47,6120,50C6240,53,6360,67,6480,75C6600,83,6720,87,6840,81.7C6960,77,7080,63,7200,51.7C7320,40,7440,30,7560,23.3C7680,17,7800,13,7920,25C8040,37,8160,63,8280,65C8400,67,8520,43,8580,31.7L8640,20L8640,100L8580,100C8520,100,8400,100,8280,100C8160,100,8040,100,7920,100C7800,100,7680,100,7560,100C7440,100,7320,100,7200,100C7080,100,6960,100,6840,100C6720,100,6600,100,6480,100C6360,100,6240,100,6120,100C6000,100,5880,100,5760,100C5640,100,5520,100,5400,100C5280,100,5160,100,5040,100C4920,100,4800,100,4680,100C4560,100,4440,100,4320,100C4200,100,4080,100,3960,100C3840,100,3720,100,3600,100C3480,100,3360,100,3240,100C3120,100,3000,100,2880,100C2760,100,2640,100,2520,100C2400,100,2280,100,2160,100C2040,100,1920,100,1800,100C1680,100,1560,100,1440,100C1320,100,1200,100,1080,100C960,100,840,100,720,100C600,100,480,100,360,100C240,100,120,100,60,100L0,100Z">

        </path>

    </svg>

    @foreach($homeQuery as $hQuery)

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6 col-md-6">

                <h6>Knowledge First</h6>

                <h2><?php echo $hQuery->largest_collection_of_courses_name; ?></h2>                 

                <?php echo $hQuery->largest_collection_of_courses_paragraph_name; ?>

                <a href="{{ route('satirtha.preReg') }}">Register Now</a>

            </div>

            @if($hQuery->largest_collection_of_courses_img == "" || $hQuery->largest_collection_of_courses_img == null)

                @php $img1 = ""; @endphp

                @else

                    @php $change_path1 = str_replace('public','storage/app/public',$hQuery->largest_collection_of_courses_img); @endphp

                    @php $img1 = asset($change_path1); @endphp

            @endif

            <div class="col-lg-6 col-md-6">

                <div class="img-wrap">

                    <!-- <div class="sec1">

                        <h3><i class="fas fa-book-open"></i> 10K <span>Actice Students</span></h3>

                    </div> -->

                    <img src="{{ $img1 }}" alt="">

                    <!-- <div class="sec2">

                        <i class="fas fa-clipboard-check"></i>

                        <h5>Weekly Spent Hours</h5>

                        <h6>40 Hrs 30 mins</h6>

                        <img src="{{ asset('frontend/images/bar-img.svg') }}" alt="">

                    </div> -->

                </div>

            </div>

        </div>

    </div>

    @endforeach

</div>

@foreach($homeQuery as $hQuery)

<section class="body-cont1">

    <div class="container">

        <div class="row">

            <div class="col-lg-6 col-md-6">

                <div class="img-wrap">

                    <!-- <div class="sec1">

                        <h3><i class="far fa-users"></i> The Best Learn <span>150 Best Teachers</span></h3>

                    </div> -->

                    

                    @if($hQuery->welcome_to_kanani_image_name == "" || $hQuery->welcome_to_kanani_image_name == null)

                        @php $img2 = ""; @endphp

                        @else

                            @php 

                                $change_path2 = str_replace('public','storage/app/public',$hQuery->welcome_to_kanani_image_name); 

                            @endphp

                            @php $img2 = asset($change_path2); @endphp

                    @endif

                    <img src="{{ $img2 }}" alt="">

                    <!-- <div class="sec2">

                        <i class="fas fa-clipboard-check"></i>

                        <img src="{{ asset('frontend/images/thumb1.jpg') }}" alt="">

                        <h5>Anna Bell</h5>

                        <h6>Master of Education</h6>

                        <ul>

                            <li><i class="fas fa-star"></i></li>

                            <li><i class="fas fa-star"></i></li>

                            <li><i class="fas fa-star"></i></li>

                            <li><i class="fas fa-star"></i></li>

                            <li><i class="fas fa-star"></i></li>

                        </ul>

                    </div> -->

                </div>

            </div>

            <div class="col-lg-6 pl-lg-5 col-md-6">

                <h6>About Us</h6>

                <h2><?php echo $hQuery->welcome_to_kanani_name; ?></h2>

                <?php echo $hQuery->welcome_to_kanani_paragraph_name; ?>

                <a href="{{ route('satirtha.choose-us') }}">Know More</a>

            </div>

        </div>

    </div>

</section>

@endforeach

@foreach($homeQuery as $hQuery)

<section class="body-cont-2">

    <div class="container">

        <div class="row">

            <div class="col-lg-12 text-center">

                <i class="fal fa-book-open"></i>

                <h2>How it works</h2>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="wrap">

                    <img src="{{ asset('frontend/images/home-img2.svg') }}" alt="">

                    <h4>{{ $hQuery->install_zoom_heading_name }}</h4>

                    <p>{{ $hQuery->install_zoom_paragraph_name }}</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="wrap">

                    <img src="{{ asset('frontend/images/home-img3.svg') }}" alt="">

                    <h4>{{ $hQuery->join_a_trail_class_heading_name }}</h4>

                    <p>{{ $hQuery->join_a_trail_class_paragraph_name }}</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="wrap">

                    <img src="{{ asset('frontend/images/home-img4.svg') }}" alt="">

                    <h4>{{ $hQuery->select_a_course_class_heading_name }}</h4>

                    <p>{{ $hQuery->select_a_course_class_paragraph_name }}</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="wrap">

                    <img src="{{ asset('frontend/images/home-img5.svg') }}" alt="">

                    <h4>{{ $hQuery->start_your_journey_class_heading_name }}</h4>

                    <p>{{ $hQuery->start_your_journey_class_paragraph_name }}</p>

                </div>

            </div>

        </div>

    </div>

</section>

@endforeach



<section class="body-cont3 ">

    <div class="container">

        <div class="row">

            <div class="col-lg-8 decp">

                @foreach($courseQuery as $cQuery)

                <ul>

                    <li>

                        <h6>KIDS ENGLISH COURSE </h6>

                        <h2><a href="{{ route('satirtha.cms-child-courses') }}">KIDS ENGLISH COURSE</a></h2>

                        <?php echo $cQuery->kids_english_course_short_description; ?>

                        <h3>$<?php echo $cQuery->kids_price; ?> <a href="{{ route('satirtha.cms-child-courses') }}">View Details <i class="fal fa-long-arrow-right"></i></a></h3>

                    </li>

                    <li>

                        <h6>TEEN ENGLISH COURSE </h6>

                        <h2><a href="{{ route('satirtha.cms-teen-courses') }}">TEEN ENGLISH COURSE </a></h2>

                        <?php echo $cQuery->teen_english_course_short_description; ?>

                        <h3>$<?php echo $cQuery->teen_price; ?> <a href="{{ route('satirtha.cms-teen-courses') }}">View Details <i class="fal fa-long-arrow-right"></i></a></h3>

                    </li>

                    <li>

                        <h6>ADULT ENGLISH COURSE </h6>

                        <h2><a href="{{ route('satirtha.cms-adult-courses') }}">ADULT ENGLISH COURSE </a></h2>

                        <?php echo $cQuery->adult_english_course_short_description; ?>

                        <h3>$<?php echo $cQuery->adult_price; ?> <a href="{{ route('satirtha.cms-adult-courses') }}">View Details <i class="fal fa-long-arrow-right"></i></a></h3>

                    </li>

                    <!-- <li>

                        <h6></h6>

                        <h2></h2>

                        <p></p>

                        <h3></h3>

                    </li> -->

                    @endforeach

                </ul>

            </div>

            <div class="col-lg-4 side-bar">

                <img src="{{ asset('frontend/images/home-img6.png') }}" alt="">

                <h6>Our Courses</h6>

                @foreach($homeQuery as $hQuery)

                <h2>{{ $hQuery->our_courses_class_heading_name }}</h2>

                <?php echo $hQuery->our_courses_class_paragraph_name; ?> 

                <a href="{{ route('satirtha.cms-courses') }}">View All Courses</a>

                @endforeach

            </div>

        </div>

    </div>

</section>

@foreach($homeQuery as $hQuery)

<section class="body-cont4">



                @if($hQuery->lets_see_online_education_image == "" || $hQuery->lets_see_online_education_image == null)

                        @php $img3 = ""; @endphp

                        @else

                            @php 

                                $change_path3 = str_replace('public','storage/app/public',$hQuery->lets_see_online_education_image); 

                            @endphp

                            @php $img3 = asset($change_path3); @endphp

                    @endif

    <img src="{{ $img3 }}" alt="">

    <div class="wrap">

    <div class="container">

        <div class="row">

            <div class="col-lg-6 col-md-6">

                <h6>We Are Professional And Expert</h6>

                <h2>{{ $hQuery->lets_see_online_education_name }}</h2>

                <?php echo $hQuery->lets_see_online_education_description_name; ?>

                <a href="{{ route('satirtha.preReg') }}">Register Now</a>

            </div>

        </div>

    </div>

    </div>

</section>

@endforeach

<section class="body-cont5">

    <div class="container">

       <div class="row">

           <div class="col-lg-12">

               <h2>What Our Students Say</h2>

               <div class="students-say owl-carousel">
                @if(count($getComments) > 0)
                    @foreach($getComments as $getC)
                        @if($getC->customers_images != "" || $getC->customers_images != null)
                            @php $change_path4 = str_replace('public','storage/app/public',$getC->customers_images); @endphp
                            @php $img_path4 = '<img src="'.asset($change_path4).'" alt="no image" width="100px" />'; @endphp
                        @else
                            @php $img_path4 = '<img src='.asset("frontend/images/facebook-no-profile-picture-ic.jpg").' alt="no image" />'; @endphp
                        @endif
                        @php $customer_id = $getC->id; @endphp
                        @php $customer_name = $getC->customer_name; @endphp
                        @php $customer_email = $getC->customer_email; @endphp
                        @php $customer_post = $getC->customer_post; @endphp
                        @php $customer_comment = $getC->customer_comment; @endphp
                                
                    <div class="item">
                       <div class="row align-items-center">
                           <div class="col-lg-5 col-md-5 pr-lg-5">
                               <div class="img-wrap">
                                    <?php echo $img_path4; ?>
                               </div>
                           </div>
                           <div class="col-lg-7 col-md-7">
                               <p><?php echo $customer_comment; ?></p>
                               <h5>{{ ucwords($customer_name) }}</h5>
                               <h6>{{ ucwords($customer_post) }}</h6>
                           </div>
                       </div>
                    </div>
                   @endforeach
                @endif
                   <!-- end loop -->

               </div>

           </div>

       </div>

    </div>

</section>

<section class="body-cont6">

    <div class="container">

        <div class="row">

            <div class="col-lg-12 title-sec text-center">

            @foreach($homeQuery as $hQuery)

                <h6>Blogs</h6>

                <h2>{{ $hQuery->blog_class_heading_name }}</h2>

                <?php echo $hQuery->blog_class_paragraph_name; ?>

            @endforeach

            </div>

            <div class="col-lg-6 col-md-7 sec1">

                @if(count($singleBlogQuery) > 0)

                        @foreach($singleBlogQuery as $iQ)

                            @if($iQ->blog_imgs == "" || $iQ->blog_imgs == null)

                            @php $blog_img = ""; @endphp

                            @else

                                @php $change_path = str_replace('public','storage/app/public',$iQ->blog_imgs); @endphp

                                @php $blog_img = asset($change_path); @endphp

                            @endif

                    <div class="img-wrap">

                        <img src="{{ $blog_img }}" alt="">

                        <div class="decp">

                            <h3><?php echo $iQ->blog_name; ?></h3>

                            <h4><?php echo date("Y M d",strtotime($iQ->updated_at)) ?> <a href="{{ route('satirtha.cms-blog-details',$iQ->id) }}">View Details <i class="fal fa-long-arrow-right"></i></a></h4>

                        </div>

                    </div>

                    @endforeach

                @endif

            </div>

            <div class="col-lg-6 col-md-5 sec2">

                @if(count($blogQuery) > 0)

                        @foreach($blogQuery as $iQ)

                            @if($iQ->blog_imgs == "" || $iQ->blog_imgs == null)

                            @php $blog_img1 = ""; @endphp

                            @else

                                @php $change_path = str_replace('public','storage/app/public',$iQ->blog_imgs); @endphp

                                @php $blog_img1 = asset($change_path); @endphp

                            @endif

                            <div class="row">

                                <div class="col-lg-4">

                                    <img src="{{ $blog_img1 }}" alt="">

                                </div>

                                <div class="col-lg-8">

                                    <h4><?php echo $iQ->blog_name; ?></h4>

                                    <h5><?php echo date("Y M d",strtotime($iQ->updated_at)) ?> <a href="{{ route('satirtha.cms-blog-details',$iQ->id) }}">View Details <i class="fal fa-long-arrow-right"></i></a></h5>

                                </div>

                            </div>

                        @endforeach

                @endif

            </div>

        </div>

    </div>

</section>

@endsection