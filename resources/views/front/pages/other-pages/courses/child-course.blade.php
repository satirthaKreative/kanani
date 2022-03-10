@extends('front.app')

@section('content')



<div class="inner-ban" style="background: url(frontend/images/kids-courses-img1.jpg);">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6 col-md-6">

                <h2 data-descr="Kids">Kids english courses</h2>

            </div>

            <div class="col-lg-6 col-md-6">

                <ul>

                    <li><a href="{{ route('satirtha.home') }}">Home</a></li>

                    <li><a href="{{ route('satirtha.cms-courses') }}">courses</a></li>

                    <li>kids english courses</li>

                </ul>

            </div>

        </div>

    </div>

</div>



<section class="Adults-page">

    <img src="{{ asset('frontend/images/kids-courses-img5.jpg') }}" alt="" class="img1">

    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-8 decp">
                @foreach($getQuery as $iQ)
                    @if($iQ->get_started_img == "" || $iQ->get_started_img == null)
                        @php $get_started_img = ""; @endphp
                        @else
                            @php $get_started_img_path = str_replace('public','storage/app/public',$iQ->get_started_img); @endphp
                            @php $get_started_img = asset($get_started_img_path); @endphp
                    @endif  
                    @if($iQ->main_img == "" || $iQ->main_img == null)
                        @php $main_img = ""; @endphp
                        @else
                            @php $main_img_path = str_replace('public','storage/app/public',$iQ->main_img); @endphp
                            @php $main_img = asset($main_img_path); @endphp
                    @endif 
                    @if($iQ->lets_see_online_img == "" || $iQ->lets_see_online_img == null)
                        @php $lets_see_online_img = ""; @endphp
                        @else
                            @php $lets_see_online_img_path = str_replace('public','storage/app/public',$iQ->lets_see_online_img); @endphp
                            @php $lets_see_online_img = asset($lets_see_online_img_path); @endphp
                    @endif
                    @if($iQ->get_started_video_link == "" || $iQ->get_started_video_link == null)
                        @php $get_started_video_link = ""; @endphp
                        @else
                            @php $get_started_video_link = '<iframe width="349" height="250" src="'.$iQ->get_started_video_link.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'; @endphp
                    @endif  
                    @if($iQ->course_heading == "" || $iQ->course_heading == null)
                        @php $course_heading = ""; @endphp
                        @else
                            @php $course_heading = $iQ->course_heading; @endphp
                    @endif
                    @if($iQ->course_description == "" || $iQ->course_description == null)
                        @php $course_description = ""; @endphp
                        @else
                            @php $course_description = $iQ->course_description; @endphp
                    @endif 
                    @if($iQ->get_started_heading == "" || $iQ->get_started_heading == null)
                        @php $get_started_heading = ""; @endphp
                        @else
                            @php $get_started_heading = $iQ->get_started_heading; @endphp
                    @endif  
                    @if($iQ->get_started_discount_price == "" || $iQ->get_started_discount_price == null)
                        @php $get_started_discount_price = ""; @endphp
                        @else
                            @php $get_started_discount_price = $iQ->get_started_discount_price; @endphp
                    @endif  
                    @if($iQ->get_started_total_price == "" || $iQ->get_started_total_price == null)
                        @php $get_started_total_price = ""; @endphp
                        @else
                            @php $get_started_total_price = $iQ->get_started_total_price; @endphp
                    @endif  
                    @if($iQ->get_started_percentage_price == "" || $iQ->get_started_percentage_price == null)
                        @php $get_started_percentage_price = ""; @endphp
                        @else
                            @php $get_started_percentage_price = $iQ->get_started_percentage_price; @endphp
                    @endif
                    @if($iQ->this_course_includes_heading == "" || $iQ->this_course_includes_heading == null)
                        @php $this_course_includes_heading = ""; @endphp
                        @else
                            @php $this_course_includes_heading = $iQ->this_course_includes_heading; @endphp
                    @endif
                    @if($iQ->this_course_includes_paragraph == "" || $iQ->this_course_includes_paragraph == null)
                        @php $this_course_includes_paragraph = ""; @endphp
                        @else
                            @php $this_course_includes_paragraph = $iQ->this_course_includes_paragraph; @endphp
                    @endif
                    @if($iQ->lets_see_online_upper_heading == "" || $iQ->lets_see_online_upper_heading == null)
                        @php $lets_see_online_upper_heading = ""; @endphp
                        @else
                            @php $lets_see_online_upper_heading = $iQ->lets_see_online_upper_heading; @endphp
                    @endif
                    @if($iQ->lets_see_online_main_heading == "" || $iQ->lets_see_online_main_heading == null)
                        @php $lets_see_online_main_heading = ""; @endphp
                        @else
                            @php $lets_see_online_main_heading = $iQ->lets_see_online_main_heading; @endphp
                    @endif
                    @if($iQ->lets_see_online_main_paragraph == "" || $iQ->lets_see_online_main_paragraph == null)
                        @php $lets_see_online_main_paragraph = ""; @endphp
                        @else
                            @php $lets_see_online_main_paragraph = $iQ->lets_see_online_main_paragraph; @endphp
                    @endif
                @endforeach
                <img src="{{ $main_img }}" alt="">

                <div class="sec1">

                    <!-- <div class="row">

                        <div class="col-lg-6 col-md-6">

                            <h6>english conversation course</h6>

                        </div>

                        <div class="col-lg-6 col-md-6 text-right">

                            <h6>8 Chapters | 18 Lessons</h6>

                        </div>

                    </div> -->

                    <h3><?php echo $course_heading; ?></h3>

                    <?php echo $course_description; ?>

                    <!-- <div class="improved-sec">

                        <h6>An improved learning experience</h6>

                        <div class="row align-items-center">

                            <div class="col-lg-4 col-md-4">

                                <img src="{{ asset('frontend/images/kids-courses-img3.jpg') }}" alt="">

                            </div>

                            <div class="col-lg-8 col-md-8">

                                <p>As a parent, you may want to improve your own level of English so that you can help

                                    and support your child’s learning. Whatever your motivation or level, our highly

                                    qualified English teachers are by your side and provide you with the right tools to

                                    help you interact confidently in the real world and achieve.</p>

                            </div>

                        </div>

                    </div> -->

                </div>

                <div class="sec2">

                    <h3>Course Structure</h3>

                    <div class="accordion">
                    @foreach($getQuery1 as $gQ)
                        <h4 class="accordion-toggle">{{ $gQ->course_type }} <span>{{ $gQ->course_lessons }} | {{ $gQ->course_units }} {{ $gQ->course_duration }} | {{ $gQ->age_type	 }}</span></h4>

                        <div class="accordion-content">
                            <?php echo $gQ->course_details; ?>
                        </div>
                    @endforeach

                    </div>

                </div>

                <div class="sec3">

                    <div class="row align-items-center">

                        <div class="col-lg-6 col-md-6">

                            <h3>$<?php echo $get_started_discount_price; ?> <span> <del>$<?php echo $get_started_total_price; ?> </del> <?php echo $get_started_percentage_price; ?>% Off</span></h3>

                        </div>

                        <div class="col-lg-6 col-md-6">

                            <a href="{{ route('satirtha.show-all-courses') }}" class="more-but">Get Started</a>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-4 col-md-4 side-bar">

                <div class="sec1">

                    <div class="img-wrap">

                    <?php echo $get_started_video_link; ?> 

                    </div>

                    <div class="col-lg-12">
                        <h6><?php echo $get_started_heading; ?></h6>
                        <h3>$<?php echo $get_started_discount_price; ?> <span> <del>$<?php echo $get_started_total_price; ?> </del> <?php echo $get_started_percentage_price; ?>% Off</span></h3>

                        <a href="{{ route('satirtha.show-all-courses') }}" class="more-but">Get Started</a>

                        <h4><?php echo $this_course_includes_heading; ?></h4>

                        <?php echo $this_course_includes_paragraph; ?>

                    </div>

                    <div class="img-wrap">

                        <img src="{{ $get_started_img }}" alt="">

                        <!-- <a href="#"><i class="fas fa-play-circle"></i></a> -->

                    </div>

                </div>

                <!-- <div class="sec2">

                    <div class="img-wrap">

                        <img src="images/adults-img2.jpg" alt="">

                        <a href="#"><i class="fas fa-play-circle"></i></a>

                    </div>

                    <h3>Watch this video and learn more about our English courses for adults </h3>

                </div> -->

            </div>

        </div>

    </div>

</section>



<section class="body-cont4">

    <img src="{{ $lets_see_online_img }}" alt="">

    <div class="wrap">

        <div class="container">

            <div class="row">

                <div class="col-lg-6 col-md-6">

                    <h6><?php echo $lets_see_online_upper_heading; ?></h6>

                    <h2><?php echo $lets_see_online_main_heading; ?></h2>

                    <?php echo $lets_see_online_main_paragraph; ?>

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

                                <p>Fusce sit amet suscipit augue. Nulla in justo vitae arcu fermentum sodales ut a

                                    purus. Fusce volutpat gravida augue eget hendrerit. Mauris sollicitudin cursus orci,

                                    vel pellentesque nisl pretium vel. sed augue malesuada, porttitor urna vel cursus

                                    eros.</p>

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

                                <p>Fusce sit amet suscipit augue. Nulla in justo vitae arcu fermentum sodales ut a

                                    purus. Fusce volutpat gravida augue eget hendrerit. Mauris sollicitudin cursus orci,

                                    vel pellentesque nisl pretium vel. sed augue malesuada, porttitor urna vel cursus

                                    eros.</p>

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

                                <p>Fusce sit amet suscipit augue. Nulla in justo vitae arcu fermentum sodales ut a

                                    purus. Fusce volutpat gravida augue eget hendrerit. Mauris sollicitudin cursus orci,

                                    vel pellentesque nisl pretium vel. sed augue malesuada, porttitor urna vel cursus

                                    eros.</p>

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



@endsection