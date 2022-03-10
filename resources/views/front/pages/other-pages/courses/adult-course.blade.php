@extends('front.app')

@section('content')



<div class="inner-ban" style="background: url(frontend/images/adult-english-inner.png);">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6 col-md-6">

                <h2 data-descr="adults">Adults english courses</h2>

            </div>

            <div class="col-lg-6 col-md-6">

                <ul>

                    <li><a href="{{ route('satirtha.home') }}">Home</a></li>

                    <li><a href="{{ route('satirtha.cms-courses') }}">courses</a></li>

                    <li>adults english courses</li>

                </ul>

            </div>

        </div>

    </div>

</div>



<section class="Adults-page">

    <img src="{{ asset('frontend/images/adults-img4.jpg') }}" alt="" class="img1">

    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-8 decp">

                <img src="{{ asset('frontend/images/adults-img1.jpg') }}" alt="">

                <div class="sec1">

                    <!-- <div class="row">

                        <div class="col-lg-6 col-md-6">

                            <h6>Adult’s English courses</h6>

                        </div>

                        <div class="col-lg-6 col-md-6 text-right">

                            <h6>8 Chapters | 50 Lessons</h6>

                        </div>

                    </div> -->

                    <h3>General and Extensive English Courses for Adults</h3>

                    <!-- <p>Speak English with confidence with the world’s English experts. Our English courses can help you

                        to achieve your goals. They can help you accelerate your career,  study improve your

                        social interactions.</p>

                    <p>Our expert, highly qualified teachers offer engaging, interactive face-to-face as well as online

                        English courses that will give you the confidence to use the English language in situations that

                        matter to you.</p>

                    <h5>Mauris sollicitudin cursus orci</h5>

                    <p>Fusce sit amet suscipit augue. Nulla in justo vitae arcu fermentum sodales ut a purus. Fusce

                        volutpat gravida augue eget hendrerit. Mauris sollicitudin cursus orci, vel pellentesque nisl

                        pretium vel. Ut sed augue malesuada, porttitor urna vel, cursus eros. Quisque luctus blandit

                        augue nec cursus.</p> -->

                    <ul>

                        <li>A communicative course that helps develop confident, fluent speakers who can successfully use English for socializing, traveling, further education and business.</li>

                        <li>It integrates a variety of regional, national, and non-native accents throughout the listening texts and in the video program.</li>

                        <li>The program is unique in including a cultural fluency syllabus in which students learn to navigate dealing with people of different languages and cultures.

                        </li>

                        <li>Language production and goal-focused lessons</li>

                        <li>Lessons include Communication Goals, Vocabulary, Grammar, Conversation strategies, Listening, Pronunciation, Reading and Writing.</li>

                    </ul>

                </div>

                <div class="sec2">

                    <h3>Course Structure</h3>

                    <div class="accordion">

                        <h4 class="accordion-toggle">Fundamental <span>14 Units | 44 Lessons | 60 minutes (above 18)</span></h4>

                        <div class="accordion-content">

                            <p>Each lesson begins with a clearly stated communication goal. All lesson activities are integrated with the goal and systematically build toward a final speaking activity in which students demonstrate achievement of the goal. Memorable conversation models provide essential and practical social language that students can use in real life. Students actively work with a rich vocabulary of high-frequency words. An explicit grammar syllabus is supported by charts containing clear grammar rules, relevant examples, and explanations of meaning and use. Focused pronunciation, rhythm, and intonation practice of each pronunciation point to the target language of the unit and facilitating comprehensible pronunciation.</p>

                        </div>



                        <h4 class="accordion-toggle">Level 1 <span>10 Units | 50 Lessons | 60 minutes (above 18)</h4>

                        <div class="accordion-content">

                            <p>

                            Each lesson begins with a clearly stated communication goal. All lesson activities are integrated with the goal and systematically build toward a final speaking activity in which students demonstrate achievement of the goal. Memorable conversation models provide essential and practical social language that students can use in real life. Students actively work with a rich vocabulary of high-frequency words. An explicit grammar syllabus is supported by charts containing clear grammar rules, relevant examples, and explanations of meaning and use. Focused pronunciation, rhythm, and intonation practice of each pronunciation point to the target language of the unit and facilitating comprehensible pronunciation.

                            </p>

                        </div>



                        <h4 class="accordion-toggle">Level 2 <span>10 Units | 50 Lessons | 60 minutes (above 18)</span></h4>

                        <div class="accordion-content">

                            <p>

                            Each lesson begins with a clearly stated communication goal. All lesson activities are integrated with the goal and systematically build toward a final speaking activity in which students demonstrate achievement of the goal. Memorable conversation models provide essential and practical social language that students can use in real life. Students actively work with a rich vocabulary of high-frequency words. An explicit grammar syllabus is supported by charts containing clear grammar rules, relevant examples, and explanations of meaning and use. Focused pronunciation, rhythm, and intonation practice of each pronunciation point to the target language of the unit and facilitating comprehensible pronunciation.

                            </p>

                        </div>

                        <h4 class="accordion-toggle">Level 3 <span>10 Units | 50 Lessons | 60 minutes (above 18)</span></h4>

                        <div class="accordion-content">

                            <p>

                            Each lesson begins with a clearly stated communication goal. All lesson activities are integrated with the goal and systematically build toward a final speaking activity in which students demonstrate achievement of the goal. Memorable conversation models provide essential and practical social language that students can use in real life. Students actively work with a rich vocabulary of high-frequency words. An explicit grammar syllabus is supported by charts containing clear grammar rules, relevant examples, and explanations of meaning and use. Focused pronunciation, rhythm, and intonation practice of each pronunciation point to the target language of the unit and facilitating comprehensible pronunciation.

                            </p>

                        </div>

                    </div>

                </div>

                <div class="sec3">

                    <div class="row align-items-center">

                        <div class="col-lg-6 col-md-6">

                            <h3>$160 <span> <del>$320 </del> 50% Off</span></h3>

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

                        <img src="{{ asset('frontend/images/adults-img2.jpg') }}" alt="">

                        <a href="#"><i class="fas fa-play-circle"></i></a>

                    </div>

                    <div class="col-lg-12">
                        <h6>Adults English Courses</h6>
                        <h3>$160 <span> <del>$320 </del> 50% Off</span></h3>

                        <a href="{{ route('satirtha.show-all-courses') }}" class="more-but">Get Started</a>

                        <h4>This course includes</h4>

                        <ul>

                            <li><a href="#"><i class="fas fa-play-circle"></i>Communication goals.</a></li>
                            <li><a href="#"><i class="fas fa-play-circle"></i>Speaking activities.</a></li>
                            <li><a href="#"><i class="fas fa-play-circle"></i>Memorable conversations.</a></li>
                            <li><a href="#"><i class="fas fa-play-circle"></i>Rich vocabulary of high-frequency words.</a></li>
                            <li><a href="#"><i class="fas fa-play-circle"></i>An explicit grammar syllabus.</a></li>
                            <li><a href="#"><i class="fas fa-play-circle"></i>Focused pronunciation.</a></li>

                        </ul>

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

    <img src="{{ asset('frontend/images/adults-img5.jpg') }}" alt="">

    <div class="wrap">

        <div class="container">

            <div class="row">

                <div class="col-lg-6 col-md-6">

                    <h6>We are Professional and Expert</h6>

                    <h2>Let’s See online Education</h2>

                    <ul>

                        <li>Our classes are dynamic and fun.</li>

                        <li>We’re flexible and open to change according to each student’s needs.</li>

                        <li>We are well-organized, dependable, and able to effectively manage the classroom. A properly managed classroom motivates student cooperation and teamwork.</li>

                        <li>Our lessons appeal to students’ interests and goals. Students should have the opportunity to use the language in genuine tasks and gain fluency.</li>

                    </ul>



                    <a href="{{ route('satirtha.childRegPage',base64_encode('adult')) }}">Register Now</a>

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