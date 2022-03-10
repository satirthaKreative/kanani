<!DOCTYPE html>
<html lang="en">
@include('admin.dashboard.include.head')
<body>
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            <!-- begin pre-loader -->
            <div class="loader">
                <div class="h-100 d-flex justify-content-center">
                    <div class="align-self-center">
                        <img src="{{ asset('backend/assets/img/loader/loader.svg') }}" alt="loader"></div>
                </div>
            </div>
            @include('admin.dashboard.include.header')
            <!-- begin app-container -->
            <div class="app-container">
                @include('admin.dashboard.include.nav')
                @yield('content')
            <!-- end app-main -->
            </div>
            @include('admin.dashboard.include.footer')
            <!-- end footer -->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->
    @include('admin.dashboard.include.footer-js')
	@yield('adminjsContent')
</body>
</html>
