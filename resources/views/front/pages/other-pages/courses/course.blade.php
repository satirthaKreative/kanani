@extends('front.app')
@section('content')

<div class="inner-ban">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <h2 data-descr="Courses">Courses</h2>
            </div>
            <div class="col-lg-6 col-md-6">
                <ul>
                    <li><a href="{{ route('satirtha.home') }}">Home</a></li>
                    <li>Courses</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@if(count($getQuery) > 0)
@foreach($getQuery as $gQuery)
<section class="Courses-page">
    <img src="{{ asset('frontend/images/course-img8.png') }}" alt="No Image" class="img1">
    <img src="{{ asset('frontend/images/course-img8.png') }}" alt="No Image" class="img2">
    <img src="{{ asset('frontend/images/course-img9.png') }}" alt="No Image" class="img3">
       <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center title-sec">
                <h2><?php echo $gQuery->headline; ?></h2>
                <?php echo $gQuery->main_description; ?>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="wrap">
                    <img src="{{ asset('frontend/images/course/Kids-english-courses.png') }}" alt="">
                    <h6>kids english courses</h6>
                    <?php echo $gQuery->kids_english_course; ?>
                    <h4>$<?php echo $gQuery->kids_price; ?> <a href="{{ route('satirtha.cms-child-courses') }}">View Details <i class="fal fa-long-arrow-right"></i></a></h4>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="wrap">
                    <img src="{{ asset('frontend/images/course/Teens-English-Courses.png') }}" alt="">
                    <h6>Teens english courses</h6>
                    <?php echo $gQuery->teen_english_course; ?>
                    <h4>$<?php echo $gQuery->teen_price; ?> <a href="{{ route('satirtha.cms-teen-courses') }}">View Details <i class="fal fa-long-arrow-right"></i></a></h4>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="wrap">
                    <img src="{{ asset('frontend/images/course/adult-english-courses.png') }}" alt="">
                    <h6>Adults english courses</h6>
                    <?php echo $gQuery->adult_english_course; ?>
                    <h4>$<?php echo $gQuery->adult_price; ?> <a href="{{ route('satirtha.cms-adult-courses') }}">View Details <i class="fal fa-long-arrow-right"></i></a></h4>
                </div>
            </div>            
        </div>
    </div>
</section>
<section class="body-cont4">
    <img src="{{ asset('frontend/images/course/main-course-banner.jpg') }}" alt="">
    <div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5">
                <h6><?php echo $gQuery->lets_see_online_education; ?></h6>
                <h2>Let’s See Online Education</h2>
                <?php echo $gQuery->lets_see_online_education_description; ?>
                <a href="#">Register Now</a>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="body-cont5">
    <div class="container">
       <div class="row">
           <div class="col-lg-12">
               <h2>What Our Students Say</h2>
               <div class="students-say owl-carousel">
                   <div class="item">
                       <div class="row align-items-center">
                           <div class="col-lg-5 col-md-5 pr-lg-5">
                               <div class="img-wrap">
                               <img src="{{ asset('frontend/images/home-img8.jpg') }}" alt="">
                               </div>
                           </div>
                           <div class="col-lg-7 col-md-7">
                               <p>Fusce sit amet suscipit augue. Nulla in justo vitae arcu fermentum sodales ut a purus. Fusce volutpat gravida augue eget hendrerit. Mauris sollicitudin cursus orci, vel pellentesque nisl pretium vel. sed augue malesuada, porttitor urna vel cursus eros.</p>
                               <h5>John Deo</h5>
                               <h6>Ui/Ux Design</h6>
                           </div>
                       </div>
                   </div>
                   <div class="item">
                       <div class="row align-items-center">
                       <div class="col-lg-5 col-md-5 pr-lg-5">
                               <div class="img-wrap">
                               <img src="{{ asset('frontend/images/home-img8.jpg') }}" alt="">
                               </div>
                           </div>
                           <div class="col-lg-7 col-md-7">
                               <p>Fusce sit amet suscipit augue. Nulla in justo vitae arcu fermentum sodales ut a purus. Fusce volutpat gravida augue eget hendrerit. Mauris sollicitudin cursus orci, vel pellentesque nisl pretium vel. sed augue malesuada, porttitor urna vel cursus eros.</p>
                               <h5>John Deo</h5>
                               <h6>Ui/Ux Design</h6>
                           </div>
                       </div>
                   </div>
                   <div class="item">
                       <div class="row align-items-center">
                       <div class="col-lg-5 col-md-5 pr-lg-5">
                               <div class="img-wrap">
                               <img src="{{ asset('frontend/images/home-img8.jpg') }}" alt="">
                               </div>
                           </div>
                           <div class="col-lg-7 col-md-7">
                               <p>Fusce sit amet suscipit augue. Nulla in justo vitae arcu fermentum sodales ut a purus. Fusce volutpat gravida augue eget hendrerit. Mauris sollicitudin cursus orci, vel pellentesque nisl pretium vel. sed augue malesuada, porttitor urna vel cursus eros.</p>
                               <h5>John Deo</h5>
                               <h6>Ui/Ux Design</h6>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </div>
</section>
@endforeach
@endif
@endsection