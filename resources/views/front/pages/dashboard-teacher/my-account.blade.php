@extends('front.app-teacher')
@section('content')
            <div class="my-account-page teacher-account">
                <h2>Personal Information</h2>
                <form action="{{ route('satirtha.teacher-my-account-details-submit') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">First name</label>
                            <input type="text" name="first_name" placeholder="John" value="{{ ucwords(Auth::guard('teacher')->user()->first_name) }}" />
                        </div>
                        <div class="col-lg-6">
                            <label for="">Last name</label>
                            <input type="text" name="last_name" placeholder="Deo"  value="{{ ucwords(Auth::guard('teacher')->user()->last_name) }}" />
                        </div>
                        <div class="col-lg-6">
                            <label for="">Country</label>
                            <select name="country_name" id="">
                                <option value="">Select country</option>
                                @foreach($countryQuery as $countryName_codes)
                                    @php $selected = ""; @endphp 
                                    @foreach($tutorQuery as $tutor_country_id)
                                        @if($tutor_country_id->country_id == $countryName_codes->id)
                                            @php $selected = "selected"; @endphp 
                                        @endif
                                    @endforeach
                                    <option value="{{ $countryName_codes->id }}" {{ $selected }}>{{ ucwords($countryName_codes->country_name) }} ( {{ $countryName_codes->country_code }} )</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Email</label>
                            <input type="text" name="email_name" placeholder="Enter email address" readonly value="{{ Auth::guard('teacher')->user()->email }}" />
                        </div>
                        <div class="col-lg-6">
                            <label for="">Phone number</label>
                            <input type="text" name="phone_name" placeholder="Enter phone number" value="@foreach($tutorQuery as $tutor_name) {{ Auth::guard('teacher')->user()->phone_num }} @endforeach">
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" value="Save" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jsContent')

@endsection