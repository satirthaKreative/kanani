@extends('front.app-student')
@section('content')
<div class="my-account-page">
                <h2>Personal Information</h2>
                <form action="{{ route('satirtha.update-my-account') }}" method="POST">
                    @csrf
                    <input type="hidden" name="update_my_account_hidden_id" value="{{ Auth::user()->id }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">First name</label>
                            <input type="text" name="first_name" placeholder="John" value="{{ Auth::user()->first_name }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Last name</label>
                            <input type="text" name="last_name" placeholder="Deo" value="{{ Auth::user()->last_name }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="my-account-native-lang-id">Native language</label>
                            <select name="native_language_name" id="my-account-native-lang-id">
                                <option value="">Select language</option>
                                @foreach($getCountryQuery as $country) 
                                    <?php $languageActualName = $country->native_language; ?>
                                @endforeach
                                @foreach($languageList as $langList)
                                    <option value="{{ $langList->id }}" @if($langList->id == $languageActualName) selected @endif>{{ ucwords($langList->language_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="my-account-country-id">Country</label>
                            <select name="country_name" id="my-account-country-id">
                                <option value="">Select country</option>
                                @foreach($getCountryQuery as $country) 
                                    <?php $countryActualName = $country->country_name; ?>
                                @endforeach
                                @foreach($countryList as $counList)
                                    <option value="{{ $counList->id }}" @if($counList->id == $countryActualName) selected @endif>{{ $counList->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Email</label>
                            <input type="email" placeholder="Enter email address" value="{{ Auth::user()->email }}" name="user_email" readonly>
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" value="Updated">
                        </div>
                    </div>
                </form>
                
                    <h2 id="account-settings">Account Settings</h2>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Change Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Change Email</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Delete Account</a>
                        </li>
                    </ul><!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <form action="{{ route('satirtha.update-my-account-password') }}" method="POST">
                            @csrf
                            <input type="hidden" name="update_my_account_hidden_id" value="{{ Auth::user()->id }}">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Create password</label>
                                    <input type="password" name="create_password_name" placeholder="***********">
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Confirm password</label>
                                    <input type="password" name="confirm_password_name" placeholder="***********">
                                </div>
                                <div class="col-lg-12">
                                    <input type="submit" value="Updated">
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <form action="{{ route('satirtha.update-my-account-email') }}" method="POST">
                            @csrf
                            <input type="hidden" name="update_my_account_hidden_id" value="{{ Auth::user()->id }}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">New Email Address</label>
                                    <input type="email" name="new_email_address_name" placeholder="@example.com">
                                </div>
                                <!-- <div class="col-lg-6">
                                    <label for="">Password</label>
                                    <input type="password" name="password" placeholder="***********">
                                </div> -->
                                <div class="col-lg-12">
                                    <input type="submit" value="Updated">
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <form action="{{ route('satirtha.delete-my-account') }}" id="delete-my-form" method="POST">
                            @csrf
                            <input type="hidden" name="update_my_account_hidden_id" value="{{ Auth::user()->id }}">
                            <div class="row">                                
                                <div class="col-lg-12">
                                    <h3>Delete your Account</h3>
                                    <input type="submit" id="delete-account-submit-id"  value="Delete Account">
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>


            </div>
@endsection
@section('jsContent')
<script>
    $("#delete-account-submit-id").click(function(e){
        e.preventDefault();
        var x = confirm('Are you sure to delete your account? ');
        if(x)
        {
            document.getElementById("delete-my-form").submit();
        }
    });
</script>
@endsection