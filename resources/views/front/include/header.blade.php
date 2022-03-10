<style>
.dropdown{display:inline-block;position:relative}.dropdown .dropdown-content{display:none;position:absolute;background-color:#fff;min-width:220px;box-shadow:0 0 10px #eee;right:0;z-index:9999999999}.dropdown .dropdown-content a{display:table;width:100%;text-align:left;padding:15px;border-bottom:1px solid #ddd;text-transform:capitalize;color:#222;letter-spacing:0.15px}.dropdown:hover .dropdown-content{display:block}
</style>
@php    $link = $_SERVER['REQUEST_URI'];    @endphp
@php    $link_array = explode('/',$link);   @endphp
@php    $page = end($link_array);   @endphp   
    <header>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-4 logo-sec">
                    <a href="{{ route('satirtha.home') }}"><img src="{{ asset('frontend/images/final-logo.png') }}" alt=""></a>
                </div>
                <div class="col-lg-9 col-8 menu-sec text-right">
                    <div id="navigation">
                        <nav>
                            <ul>
                                <li @if($page == "") class="current-menu-item" @endif><a href="{{ route('satirtha.home') }}">Home</a></li>
                                <li @if($page == "choose-us") class="current-menu-item" @endif><a href="{{ route('satirtha.choose-us') }}"> Why choose us</a></li>
                                <li @if($page == "courses" || $page == "child-courses" || $page == "teen-courses" || $page == "adult-courses") class="current-menu-item" @endif>
                                    <a href="{{ route('satirtha.cms-courses') }}">Courses <i class="fal fa-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('satirtha.cms-child-courses') }}">kids english courses </a></li>
                                        <li><a href="{{ route('satirtha.cms-teen-courses') }}">Teens english courses</a></li>
                                        <li><a href="{{ route('satirtha.cms-adult-courses') }}">adults english courses</a></li>
                                    </ul>
                                </li>
                                <li @if($page == "contact") class="current-menu-item" @endif><a href="{{ route('satirtha.contact') }}">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('satirtha.show-course-page') }}" class="login-but logged"><i class="fas fa-user"></i>Dashboard</a>
                        @else
                            <!-- <a href="">Login</a> -->
                            <div class="dropdown">
                                <a href="javascript:void(0)" class="login-but dropbtn"><i class="fas fa-user"></i> Login/Register</a>
                                <div class="dropdown-content">
                                    <a href="{{ route('teacher.login') }}">Log In As Teacher</a>
                                    <a href="{{ route('login') }}">Log In As Student</a>
                                </div>
                            </div>
                            <!-- <a href="{{ route('login') }}" class="login-but"><i class="fas fa-user"></i> Login/Register</a> -->
                            @if (Route::has('register'))
                                <!-- <a href="{{ route('register') }}">Register</a> -->
                            @endif
                        @endauth
                    @endif
                    
                </div>
            </div>
        </div>
    </header>