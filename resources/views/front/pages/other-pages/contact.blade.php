@extends('front.app')
@section('content')

@foreach($contactQuery as $cQuery)
<div class="inner-ban">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <h2 data-descr="Contact">Contact Us</h2>
            </div>
            <div class="col-lg-6 col-md-6">
                <ul>
                    <li><a href="{{ route('satirtha.home') }}">Home</a></li>
                    <li>Contact</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="contact-page">
    <img src="{{ asset('frontend/images/contact-img2.png') }}" alt="" class="img1">
    <img src="{{ asset('frontend/images/contact-img3.png') }}" alt="" class="img2">
    <div class="container">
        <div class="sec">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-5 p-0">
                <img src="{{ asset('frontend/images/contact/contact-img1.jpg') }}" alt="">
                    <div class="decp">
                        <h2>{{ $cQuery->quote_name }}</h2>
                        <h6><a href="tel:{{ $cQuery->contact_number }}"><i class="fas fa-phone-alt"></i> {{ $cQuery->contact_number }}</a></h6>
                        <h6><a href="mailto:{{ $cQuery->contact_email }}"><i class="fas fa-envelope"></i> {{ $cQuery->contact_email }}</a></h6>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <form action="{{ route('satirtha.contact-mail-send') }}" method="post">
                        @csrf
                        <p>{{ $cQuery->short_description }}</p>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="contact_name" placeholder="Name" id="user-name-id" required>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="contact_email" placeholder="Email" id="user-email-id" required>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="contact_phone" placeholder="Phone" id="user-phone-id" required>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="contact_subject" placeholder="Subject" id="user-subject-id" required>
                            </div>
                            <div class="col-lg-12">
                                <textarea name="contact_msg" id="user-msg-id" placeholder="Type your Message" required></textarea>
                                <input type="submit" value="Send">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
@endforeach
@endsection