@extends('front.app')
@section('content')
<style>
    .invalid-error-msg{
        padding: 10px 0px;
        background: #eee;
    }
</style>
<div class="inner-ban"></div>
<section class="register-page1">
        @if($decodeNewUserArr['role_type_data'] == "child")
            <img src="{{ asset('frontend/images/kids-img.png') }}" alt="" class="img1">
        @endif
        @if($decodeNewUserArr['role_type_data'] == "teen")
            <img src="{{ asset('frontend/images/teen-img.png') }}" alt="" class="img1">
        @endif
        @if($decodeNewUserArr['role_type_data'] == "adult")
            <img src="{{ asset('frontend/images/adult-img.png') }}" alt="" class="img1">
        @endif
    <img src="{{ asset('frontend/images/contact-img3.png') }}" alt="" class="img2">
    <div class="container">
        <div class="sec">
            <div class="row align-items-center">
               <div class="col-lg-6 col-md-6">
                   <h2>Create a {{ $decodeNewUserArr['role_type_data'] }} account</h2>
               </div>
               <div class="col-lg-6 col-md-6">
                   <h6>Already have an account? <a href="{{ route('login') }}">Log in</a></h6>
               </div>
               <div class="col-lg-12">
                   <h4>{{ ucwords($decodeNewUserArr['role_type_data']) }}’s information</h4>
               </div>               
            </div>
            <form action="{{ route('satirtha.childRegSubmit') }}" method="POST">
                @csrf
                   <div class="row">
                       <input type="hidden" name="type_hidden_role_name" id="type-hidden-role-id" value="{{ $decodeNewUserArr['role_type_id'] }}" />
                       <div class="col-lg-6">
                           <label for="child-first-id">{{ ucwords($decodeNewUserArr['role_type_data']) }}’s first name</label>
                           <input type="text" placeholder="First Name" id="child-first-id" name="child_first_name" required>
                       </div>
                       <div class="col-lg-6">
                           <label for="child-last-id">{{ ucwords($decodeNewUserArr['role_type_data']) }}’s last name</label>
                           <input type="text" name="child_last_name" placeholder="Last Name" id="child-last-id" required>
                       </div>
                       <div class="col-lg-6">
                           <label for="child-native-lang-id">Native language</label>
                           <select name="native_lang_name" id="child-native-lang-id" required>
                                <option value="">Select language</option>
                                @foreach($languageList as $lang)
                                    <option value="{{ $lang->id }}">{{ $lang->language_name }}</option>
                                @endforeach
                           </select>
                       </div>
                       <div class="col-lg-6">
                           <label for="child-country-id">Country</label>
                           <select name="country_name" id="child-country-id" required>
                               <option value="">Select country</option>
                                @foreach($countryList as $con)
                                    <option value="{{ $con->id }}">{{ $con->country_name }}</option>
                                @endforeach
                           </select>
                       </div>
                       <div class="col-lg-12">
                        <h4>Account information</h4>
                       </div>
                       <div class="col-lg-6">
                           <label for="child-user-id">Create username</label>
                           <input type="text" name="child_username" id="child-user-id" placeholder="@John434" autocomplete="off" required>
                       </div>
                       <div class="col-lg-6">
                           <label for="child-email-id">Parent/guardian email address</label>
                           <input type="text" name="child_useremail" id="child-email-id" placeholder="Enter email address" autocomplete="off" required>
                       </div>
                       <div class="col-lg-6">
                           <label for="child-pass-id">Create password</label>
                           <input type="password" required name="child_user_pass" id="child-pass-id" placeholder="*******" autocomplete="off">
                       </div>
                       <div class="col-lg-6">
                           <label for="child-cpass-id">Confirm password</label>
                           <input type="password" required name="child_user_cpass" id="child-cpass-id" placeholder="*******" autocomplete="off">
                       </div>
                       <div class="col-lg-12">
                           <h5> <input type="checkbox" checked required name="" id=""> By clicking Continue with or Sign up, you agree to kanani education <a href="#">Terms of Service and Privacy Policy</a></h5>
                           <h5> <input type="checkbox" checked required name="" id=""> Send me a monthly newsletter</h5>
                       </div>
                       <div class="col-lg-6 col-md-6">
                           <!-- <img src="{{ asset('frontend/images/recap.png') }}" alt=""> -->
                       </div>
                       <div class="col-lg-6 col-md-6">
                           <input type="submit" value="Create account">
                       </div>
                   </div>
                </form>
                @if (Session::has('status'))
                <div class="row">
                    <div class="col-lg-12 mt-3 text-danger invalid-error-msg">
                        <div class="alert alert-danger">
                            <center>Demo {{ session('status') }} </center>
                        </div>
                    </div>
                </div>
                @endif
        </div>

    </div>
</section>
@endsection