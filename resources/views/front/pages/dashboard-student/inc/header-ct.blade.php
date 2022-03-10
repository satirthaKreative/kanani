    <style>

        .profile-img-style{

            width: 45px;

        }

    </style>

    <header>

        <div class="container-fliud">

            <div class="row align-items-center">
                <a href="javascript: ;" class="nav-line"><span></span></a>
                <div class="col-lg-6">

                    <form action="">

                        <input type="text" placeholder="Search...">

                    </form>

                </div>

                <div class="col-lg-6">

                    <ul class="user-login">

                        <li><a href="#"><i class="fas fa-bell"></i></a></li>

                        <li>

                            <a href="#"><img src="{{ asset('frontend/studentDashboard/images/no-user-img.jpg') }}" class="profile-img-style" alt="">{{ Auth::user()->name }} <i class="fal fa-angle-down"></i></a>

                            <ul class="hover-profile">

                                <li><a href="{{ route('satirtha.show-my-account-page') }}">My Profile</a></li>

                                <li><a href="{{ route('satirtha.show-my-account-page') }}#account-settings">Change Password</a></li>

                                <li><a  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a></li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                                    @csrf

                                </form>

                            </ul>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </header>