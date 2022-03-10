@php    $link = $_SERVER['REQUEST_URI'];    @endphp
@php    $link_array = explode('/',$link);   @endphp
@php    $page = end($link_array);   @endphp                
                <aside class="app-navbar">
                    <!-- begin sidebar-nav -->
                    <div class="sidebar-nav scrollbar scroll_light">
                        <ul class="metismenu " id="sidebarNav">
                            <li class="nav-static-title">Personal</li>
                            <li class="@if($page == 'admin') active @endif">
                                <a href="{{ route('admin.home') }}" aria-expanded="false">
                                    <i class="nav-icon ti ti-rocket"></i>
                                    <span class="nav-title">Dashboards</span>
                                </a>
                            </li>
                            <li class="@if($page == 'language') active @endif">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-text"></i><span class="nav-title">Languages</span></a>
                                <ul aria-expanded="false">
                                    <li class="@if($page == 'language') active @endif"> <a href="{{ route('admin.language') }}">View languages</a> </li>
                                </ul>
                            </li>
                            <li class="@if($page == 'country') active @endif">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-flag"></i><span class="nav-title">Country</span></a>
                                <ul aria-expanded="false">
                                    <li class="@if($page == 'country') active @endif"> <a href="{{ route('admin.country') }}">View Countries</a> </li>
                                </ul>
                            </li>
                            <li class="@if($page == 'orders') active @endif">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-shopping-cart"></i><span class="nav-title">Order Details</span></a>
                                <ul aria-expanded="false">
                                    <li class="@if($page == 'orders') active @endif"> <a href="{{ route('admin.order.show') }}">View Order Details</a> </li>
                                </ul>
                            </li>
                            <li class="@if($page == 'tutor') active @endif">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-blackboard"></i><span class="nav-title">Tutors</span></a>
                                <ul aria-expanded="false">
                                    <li class="@if($page == 'tutor') active @endif"> <a href="{{ route('admin.tutor') }}">View Tutors</a> </li>
                                    <li class="@if($page == 'assign-tutor') active @endif"> <a href="{{ route('admin.assign-tutor-show') }}">Assign Tutors</a> </li>
                                    <li class="@if($page == 'assign-tutor-calendar') active @endif"> <a href="{{ route('admin.assign-tutor-calendar') }}">Tutors Calendar</a> </li>
                                </ul>
                            </li>
                            <li class="@if($page == 'free-trail' || $page == 'free-trail-config') active @endif">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-comment-alt"></i><span class="nav-title">Free Trail</span></a>
                                <ul aria-expanded="false">
                                    <li class="@if($page == 'free-trail-config') active @endif"> <a href="{{ route('admin.show-config-free-trail') }}">Config Of Free Trail</a> </li>
                                    <li class="@if($page == 'free-trail') active @endif"> <a href="{{ route('admin.show-free-trail') }}">View Free Trail</a> </li>
                                </ul>
                            </li>
                            <li class="@if($page == 'student' || $page == 'student-booking' || $page == 'student-available-slot' || $page == 'student-available-interval-slot') active @endif">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-pencil"></i><span class="nav-title">Student</span></a>
                                <ul aria-expanded="false">
                                    <li class="@if($page == 'student') active @endif"> <a href="{{ route('admin.student') }}">View Students</a> </li>
                                    <li class="@if($page == 'student-booking') active @endif"> <a href="{{ route('admin.student-booking') }}">View Booking</a> </li>
                                    <li class="@if($page == 'student-available-slot') active @endif"> <a href="{{ route('admin.student-available-slot') }}">View Available Slot</a> </li>
                                    <li class="@if($page == 'student-available-interval-slot') active @endif"> <a href="{{ route('admin.student-available-interval-slot') }}">Config Available Slot</a> </li>
                                    <li class="@if($page == 'student-message') active @endif"> <a href="{{ route('admin.student-message') }}">Messages</a> </li>
                                </ul>
                            </li>
                            <li class="@if($page == 'course' || $page == 'course-package') active @endif">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-book"></i><span class="nav-title">Course</span></a>
                                <ul aria-expanded="false">
                                    <li class="@if($page == 'course') active @endif"> <a href="{{ route('admin.course') }}">View Course</a> </li>
                                    <li class="@if($page == 'course-package') active @endif"> <a href="{{ route('admin.course-package') }}">Course Package</a> </li>
                                </ul>
                            </li>
                            <li class="@if($page == 'profile' || $page == 'contact') active @endif">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-user"></i><span class="nav-title">Profile</span></a>
                                <ul aria-expanded="false">
                                    <li class="@if($page == 'profile') active @endif"> <a href="{{ route('admin.profile') }}">View Profile</a> </li>
                                    <li class="@if($page == 'contact') active @endif"> <a href="{{ route('admin.contact') }}">View Contact Details</a> </li>
                                </ul>
                            </li>
                            <li class="@if($page == 'choose-us') active @endif">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-check"></i><span class="nav-title">Choose Us</span></a>
                                <ul aria-expanded="false">
                                    <li class="@if($page == 'choose-us') active @endif"> <a href="{{ route('admin.choose-us') }}">View Choose Us</a> </li>
                                </ul>
                            </li>
                            <li class="@if($page == 'subscribe') active @endif">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-envelope"></i><span class="nav-title">Subscribe</span></a>
                                <ul aria-expanded="false">
                                    <li class="@if($page == 'subscribe') active @endif"> <a href="{{ route('admin.subscribe') }}">View Subscribers</a> </li>
                                </ul>
                            </li>
                            <li class="@if($page == 'subscribe' || $page == 'blogs' || $page == 'courses' || $page == 'home-cms') active @endif">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-pencil"></i><span class="nav-title">CMS</span></a>
                                <ul aria-expanded="false">
                                    <li class="@if($page == 'contact-details') active @endif"> <a href="{{ route('admin.contact-details') }}">Contact Details</a> </li>
                                    <li class="@if($page == 'blogs') active @endif"> <a href="{{ route('admin.cms-blog') }}">Blogs</a> </li>
                                    <li class="@if($page == 'home-cms') active @endif"> <a href="{{ route('admin.home-cms') }}">Cms Home</a> </li>
                                    <li class="@if($page == 'courses') active @endif"> <a href="{{ route('admin.cms-courses') }}">Main Courses</a> </li>
                                    <li class="@if($page == 'adult-child-teen-courses') active @endif"> <a href="{{ route('admin.cms-adult-child-teen-course') }}">Cms All Courses</a> </li>
                                    <li class="@if($page == 'testimonials') active @endif"> <a href="{{ route('admin.testimonials') }}">Cms Testimonials</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- end sidebar-nav -->
                </aside>