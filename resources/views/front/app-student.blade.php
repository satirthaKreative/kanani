<!DOCTYPE html>
<html lang="en">
    @include('front.pages.dashboard-student.inc.head')
    <body>
        <div class="container-fluid">
            <div class="row">  
                <div class="col-lg-3 p-0">
                    <div class="side-bar">
                    @include('front.pages.dashboard-student.inc.side-bar')
                    </div>
                </div>
                <div class="col-lg-9 p-0 main-cont">
                    @include('front.pages.dashboard-student.inc.header-ct')
                    @yield('content')
                </div>
            </div>
        </div>
        @include('front.pages.dashboard-student.inc.footer')
        @include('front.pages.dashboard-student.inc.footer-js')
            @yield('jsContent')
    </body>
</html>