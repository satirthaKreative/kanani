<!DOCTYPE html>
<html lang="en">
    @include('front.pages.dashboard-teacher.inc.header')
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 p-0">
                    <div class="side-bar">
                        @include('front.pages.dashboard-teacher.inc.side-bar-teacher')
                    </div>
                </div>
                <div class="col-lg-9 p-0 main-cont">
                    @include('front.pages.dashboard-teacher.inc.header-cont')
                    @yield('content')
                </div>
            </div>
        </div>
        @include('front.pages.dashboard-teacher.inc.footer')
            @yield('jsContent')
    </body>
</html>