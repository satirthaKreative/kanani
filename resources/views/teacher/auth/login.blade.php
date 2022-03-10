@extends('front.app')
@section('content')
<style>
.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 80%;
    color: #dc3545;
}
.is-invalid {
    border-color: #dc3545 !important;
    background-repeat: no-repeat;
    background-position: center right calc(0.375em + 0.1875rem);
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}
</style>
<div class="inner-ban"></div>
<section class="login-page">
    <img src="{{ asset('frontend/images/login-img2.png') }} " alt="" class="img1">
    <img src="{{ asset('frontend/images/contact-img3.png') }}" alt="" class="img2">
    <div class="container">
        <div class="sec">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-5 p-0">
                
                    <div class="decp">
                        <img src="{{ asset('frontend/images/login-img1.png') }}" alt="">
                        <h2>Welcome Back Tutor</h2>
                        <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <form method="POST" action="{{ route('teacher.login') }}">
                    @csrf
                        <!-- <h5>Don’t have an account?  <a href="{{ route('satirtha.preReg') }}">Student Sign up</a></h5> -->
                        <h3>Log in to <span>Kanani</span></h3>
                        <label for="">Email Address</label>
                        <input id="email" type="text" class="@error('email') is-invalid @enderror" autocomplete="off" placeholder="example@gmail.com" name="email" value="{{ old('email') }}" required autofocus />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="">Password</label>
                        <input id="password" type="password" class="@error('password') is-invalid @enderror" autocomplete="off" placeholder="**********" name="password" required />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                       <input type="submit" value="Log In">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection