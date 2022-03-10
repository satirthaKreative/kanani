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
                    <li><a href="{{ Route('satirtha.home') }}">Home</a></li>
                    <li>Blogs</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="blog-page">
    <div class="container">
        <div class="row">
        <div class="col-lg-8 col-md-7 decp">
            @if(count($iQuery) > 0)
                @foreach($iQuery as $iQ)
                    @if($iQ->blog_imgs == "" || $iQ->blog_imgs == null)
                        @php $blog_img = "" @endphp
                        @else
                            @php $change_path = str_replace('public','storage/app/public',$iQ->blog_imgs); @endphp
                            @php $blog_img = asset($change_path); @endphp
                    @endif
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="img-wrap">
                                <img src="{{ $blog_img }}" alt="">
                                <div class="date"><?php echo date("d",strtotime($iQ->updated_at)) ?> <span><?php echo date("M",strtotime($iQ->updated_at)) ?></span></div>
                            </div>
                        </div>
                        @if(strlen($iQ->blog_details) > 199)
                            @php $blog_details = substr($iQ->blog_details,0,199)."..."; @endphp
                        @else
                            @php $blog_details = $iQ->blog_details; @endphp
                        @endif
                        <div class="col-lg-7">
                            <h2><a href="{{ route('satirtha.cms-blog-details',$iQ->id) }}"><?php echo $blog_details; ?></p>
                            <a href="{{ route('satirtha.cms-blog-details',$iQ->id) }}" class="more-but">Read More <span class="spin circle"><i class="far fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                @endforeach
            @endif
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
                    @if(count($iQuery) > 0)
                        @foreach($iQuery as $iQ)
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
    </div>
</section>
@endsection