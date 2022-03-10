    <style>
        .profile-img-style{
            width: 50px;
        }
    </style>
    <header>
        <div class="container-fliud">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <form action="">
                        <input type="text" placeholder="Search...">
                    </form>
                </div>
                <div class="col-lg-6">
                    <ul class="user-login">
                        <li><a href="#"><i class="fas fa-bell"></i></a></li>
                        <li>
                            <a href="#"><img src="{{ asset('frontend/studentDashboard/images/no-user-img.jpg') }}" class="profile-img-style" alt="">{{ ucwords(Auth::guard('teacher')->user()->first_name) }} {{ ucwords(Auth::guard('teacher')->user()->last_name) }}<i class="fal fa-angle-down"></i></a>

                            <ul class="hover-profile">
                                <li><a href="javascript:;">My Profile</a></li>
                                <li><a href="javascript:;">Change Password</a></li>
                                <li><a href="{{ route('teacher.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a></li>
                                <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" style="display: none;">
                                    @csrf 
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>