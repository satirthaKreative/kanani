@extends('front.app')
@section('content')

<div class="inner-ban">
    
</div>

<section class="login-page">
    <img src="{{ asset('frontend/images/login-img2.png') }}" alt="" class="img1">
    <img src="{{ asset('frontend/images/contact-img3.png') }}" alt="" class="img2">
    <div class="container">
        <div class="sec">
            <div class="row align-items-center">
                <div class="col-lg-5 p-0">
                
                    <div class="decp">
                        <img src="{{ asset('frontend/images/login-img1.png') }}" alt="">
                        <h2>Welcome Back</h2>
                        <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form action="">
                        <h3>Forgot <span> Password?</span></h3>
                        <label for="">Please enter your email address below</label>
                        <input type="text" placeholder="johndeo@gmail.com" name="email_address_name" required />    
                        <label for="">Please enter your new password</label>
                        <input type="password" placeholder="******" name="password" required />                  
                        <label for="">Please re-enter your password</label>
                        <input type="password" placeholder="******" name="confirm_password" required />
                       <input type="submit" value="Send">
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection