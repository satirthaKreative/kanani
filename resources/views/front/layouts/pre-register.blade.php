@extends('front.app')
@section('content')
<div class="inner-ban"></div>
<section class="register-page">
    <img src="{{ asset('frontend/images/login-img2.png') }}" alt="" class="img1">
    <img src="{{ asset('frontend/images/contact-img3.png') }}" alt="" class="img2">
    <div class="container">
        <div class="sec">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Choose Account type</h2>
                </div>
                <div class="col-lg-4 col-md-4 ">                
                    <div class="decp">
                        <img src="{{ asset('frontend/images/reg-img1.svg') }}" alt="">
                        <h4>Child account</h4>
                        <p>For parents or guardians registering on behalf of a child</p>
                        <a href="{{ route('satirtha.childRegPage',base64_encode('child')) }}">Create a child account</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 ">                
                    <div class="decp">
                        <img src="{{ asset('frontend/images/reg-img2.svg') }}" alt="">
                        <h4>Teen account</h4>
                        <p>For teen learners</p>
                        <a href="{{ route('satirtha.childRegPage',base64_encode('teen')) }}">Create a Teen account</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 ">                
                    <div class="decp">
                        <img src="{{ asset('frontend/images/reg-img3.svg') }}" alt="">
                        <h4>adult account</h4>
                        <p>For adult learners</p>
                        <a href="{{ route('satirtha.childRegPage',base64_encode('adult')) }}">Create an adult account</a>
                    </div>
                </div>
               
            </div>
        </div>

    </div>
</section>
@endsection