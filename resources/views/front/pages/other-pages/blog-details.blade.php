@extends('front.app')
@section('content')
<div class="inner-ban">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 data-descr="Blogs">Blogs</h2>
            </div>
            <div class="col-lg-6">
                <ul>
                    <li><a href="{{ route('satirtha.home') }}">Home</a></li>
                    <li>Blogs</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="blog-page">
    <div class="container">
    @if(count($iQuery) > 0)
        @foreach($iQuery as $iQ)
            @if($iQ->blog_imgs == "" || $iQ->blog_imgs == null)
                @php $blog_img = "" @endphp
                @else
                    @php $change_path = str_replace('public','storage/app/public',$iQ->blog_imgs); @endphp
                    @php $blog_img = asset($change_path); @endphp
            @endif
        <div class="row">
            <div class="col-lg-8 col-md-7 blog-details-decp">
                <img src="{{ $blog_img }}" alt="" class="main-img">
                <h2><?php echo $iQ->blog_name; ?></h2>
                <h4><?php echo $iQ->author_name; ?>  |  <?php echo date("Y M d",strtotime($iQ->updated_at)) ?>  |  Online class</h4>
                <p><?php echo $iQ->blog_details; ?></p>
                <!-- <div class="sec1">
                    <img src="{{ asset('frontend/images/blog-details-img2.jpg') }}" alt="">
                   <h6> “This English Language course is ideal for anyone searching for more info on the following: English - English speaking”</h6>
                </div>
                <p>Derek is one of the top English language instructors in the world and I am proud to be teaching this course with him. He has the English and European sensibility down perfectly. And I have been living in and working in the United States my entire life. When you put us together, it is a powerful combination designed to help you become a master at English language and communication.</p>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <img src="{{ asset('frontend/images/blog-details-img3.jpg') }}" alt="">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <img src="{{ asset('frontend/images/blog-details-img4.jpg') }}" alt="">
                    </div>
                </div>
                <p>This English Language course is ideal for anyone searching for more info on the following: English - English speaking - spoken English - English course - spoken English course - English speaking course - learn English - English grammar. Plus, this course will be a great addition to anyone trying to build out their knowledge in the following areas: English grammar - English conversation - English pronunciation.</p> -->
                <!-- <div class="comment-sec">
                    <h3>Leave a comment</h3>
                    <form action="">
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="text" placeholder="Name">
                            </div>
                            <div class="col-lg-4">
                                <input type="text" placeholder="Email">
                            </div>
                            <div class="col-lg-4">
                                <input type="text" placeholder="Website">
                            </div>
                            <div class="col-lg-12">
                                <textarea name="" id=""  placeholder="Type your Message"></textarea>
                                <label ><input type="checkbox" name="" id=""> Save my name, email, and website in this browser for the next time I comment.</label>
                                <input type="submit" value="Post Comment">
                            </div>
                        </div>
                    </form>
                </div> -->
            </div>

            <div class="col-lg-4 col-md-5 side-bar">
                <div class="sec1">
                    @if(count($authorQuery) > 0)
                        @foreach($authorQuery as $aQuery)
                            @if($aQuery->author_img == "" || $aQuery->author_img == null)
                                @php $auth_img = "" @endphp
                                @else
                                    @php $change_path_author = str_replace('public','storage/app/public',$aQuery->author_img); @endphp
                                    @php $auth_img = asset($change_path_author); @endphp
                            @endif
                            <img src="{{ $auth_img }}" alt="no image">
                            <h4><?php echo $aQuery->author_name; ?></h4>
                            <p><?php echo $aQuery->author_quote; ?></p>
                            <ul class="social">
                                <li><a href="{{ $aQuery->fb_link }}"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{ $aQuery->insta_link }}"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="{{ $aQuery->tw_link }}"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="{{ $aQuery->yt_link }}"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        @endforeach
                    @endif
                </div>

                <div class="sec2">
                    <h3>Recent Post</h3>
                    <ul>
                    @if(count($iAllQuery) > 0)
                        @foreach($iAllQuery as $iQ)
                            @if($iQ->blog_imgs == "" || $iQ->blog_imgs == null)
                            @php $blog_img = ""; @endphp
                            @else
                                @php $change_path = str_replace('public','storage/app/public',$iQ->blog_imgs); @endphp
                                @php $blog_img = asset($change_path); @endphp
                            @endif
                        <li>
                           <a href="{{ route('satirtha.cms-blog-details',$iQ->id) }}">
                                <div class="img-wrap">
                                    <img src="{{ $blog_img }}" alt="No Image">
                                </div>
                                <div class="decp">
                                    <h4><?php echo $iQ->blog_name; ?></h4>
                                    <h5><?php echo date("Y M d",strtotime($iQ->updated_at)) ?></h5>
                                </div>
                           </a>
                        </li>
                        @endforeach
                    @endif
                    </ul>
                </div>
            </div>
            <!-- <div class="col-lg-12">
                <ul class="page-nav">
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                </ul>
            </div> -->
        </div>
        @endforeach
    @endif
    </div>
</section>

@endsection