@extends('front.app')

@section('content')

<div class="inner-ban">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6 col-md-6">

                <h2 data-descr="Choose us">Why Choose us</h2>

            </div>

            <div class="col-lg-6 col-md-6">

                <ul>

                    <li><a href="{{ route('satirtha.home') }}">Home</a></li>

                    <li>Why Choose us</li>

                </ul>

            </div>

        </div>

    </div>

</div>

@if(count($iQuery) > 0)

@foreach($iQuery as $iQ)

@if($iQ->paragraph1_img == "" || $iQ->paragraph1_img == null)

    @php $img1 = ""; @endphp

    @else

        @php $change_path = str_replace('public','storage/app/public',$iQ->paragraph1_img); @endphp

        @php $img1 = asset($change_path); @endphp

@endif

<section class="Choose-page">

    <img src="{{ asset('frontend/images/choose-us3.png') }}" alt="" class="img2">

    <div class="container">

        <div class="row">

            <div class="col-lg-7 col-md-7">

                <h2><?php echo $iQ->heading1_name; ?></h2>

                <?php echo $iQ->paragraph1_name; ?>

                <!--<h6><?php echo $iQ->author_name; ?></h6>-->

            </div>

            <div class="col-lg-5 col-md-5">

                <div class="wrap">

                    <img src="{{ asset('frontend/images/choose-us2.png') }}" alt="" class="img1">

                    <img src="{{ $img1 }}" alt="">

                </div>

            </div>

        </div>

    </div>

</section>

@if($iQ->paragraph2_img == "" || $iQ->paragraph2_img == null)

    @php $img2 = ""; @endphp

    @else

        @php $change_path2 = str_replace('public','storage/app/public',$iQ->paragraph2_img); @endphp

        @php $img2 = asset($change_path2); @endphp

@endif

<section class="Choose-page2">

    <img src="{{ asset('frontend/images/choose-us4.png') }}" alt="" class="img2">

    <div class="container">

        <div class="row">

            <div class="col-lg-6">

                <div class="wrap">

                    <img src="{{ asset('frontend/images/choose-us2.png') }}" alt="" class="img1">

                    <img src="{{ $img2 }}" alt="" class="img3">

                </div>

            </div>

            <div class="col-lg-6">

                <h2><?php echo $iQ->heading2_name; ?></h2>

                <?php echo $iQ->paragraph2_name; ?>

            </div>

        </div>

    </div>

</section>



<section class="Choose-page3">

    <div class="container">

        <div class="row">

            <div class="col-lg-12 text-center">

                <h2><?php echo $iQ->heading3_name; ?></h2>

                <?php echo $iQ->paragraph3_name; ?>

            </div> 

            @if($iQ->section1_img == "" || $iQ->section1_img == null)

                @php $img4 = ""; @endphp

                @else

                    @php $change_path4 = str_replace('public','storage/app/public',$iQ->section1_img); @endphp

                    @php $img4 = asset($change_path4); @endphp

            @endif

            <div class="col-lg-4 col-md-4">
                <div class="wrap">

                    <img src="{{ $img4 }}" alt="">

                            <div class="decp">

                                <h3><?php echo $iQ->section1_name; ?></h3>

                                <?php echo $iQ->section1_paragraph; ?>

                            </div>

                    </div> 
            </div> 

            @if($iQ->section2_img == "" || $iQ->section2_img == null)

                @php $img5 = ""; @endphp

                @else

                    @php $change_path5 = str_replace('public','storage/app/public',$iQ->section2_img); @endphp

                    @php $img5 = asset($change_path5); @endphp

            @endif 

            <div class="col-lg-4 col-md-4">

                <div class="wrap">

                    <img src="{{ $img5 }}" alt="">

                    <div class="decp">

                        <h3><?php echo $iQ->section2_name; ?></h3>

                        <?php echo $iQ->section2_paragraph; ?>

                    </div>

                </div>

            </div> 

            @if($iQ->section3_img == "" || $iQ->section3_img == null)

                @php $img6 = ""; @endphp

                @else

                    @php $change_path6 = str_replace('public','storage/app/public',$iQ->section3_img); @endphp

                    @php $img6 = asset($change_path6); @endphp

            @endif

            <div class="col-lg-4 col-md-4">

                <div class="wrap">

                    <img src="{{ $img6 }}" alt="">

                    <div class="decp">

                        <h3><?php echo $iQ->section3_name; ?></h3>

                        <?php echo $iQ->section3_paragraph; ?>

                    </div>

                </div>

            </div>  
            
            
            @if($iQ->section4_img == "" || $iQ->section4_img == null)

                @php $img8 = ""; @endphp

                @else

                    @php $change_path8 = str_replace('public','storage/app/public',$iQ->section4_img); @endphp

                    @php $img8 = asset($change_path8); @endphp

            @endif

            <div class="col-lg-4 col-md-4">
                <div class="wrap">

                    <img src="{{ $img8 }}" alt="">

                            <div class="decp">

                                <h3><?php echo $iQ->section4_name; ?></h3>

                                <?php echo $iQ->section4_paragraph; ?>

                            </div>

                    </div> 
            </div> 

            @if($iQ->section5_img == "" || $iQ->section5_img == null)

                @php $img9 = ""; @endphp

                @else

                    @php $change_path9 = str_replace('public','storage/app/public',$iQ->section5_img); @endphp

                    @php $img9 = asset($change_path9); @endphp

            @endif 

            <div class="col-lg-4 col-md-4">

                <div class="wrap">

                    <img src="{{ $img9 }}" alt="">

                    <div class="decp">

                        <h3><?php echo $iQ->section5_name; ?></h3>

                        <?php echo $iQ->section5_paragraph; ?>

                    </div>

                </div>

            </div> 

        </div>
 
    </div>

</section>

@endforeach

@endif

@endsection