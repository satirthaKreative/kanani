<!DOCTYPE html>
<html lang="en">
    @include('front.include.head')
    <body>
        @include('front.include.header')  
            @yield('content')
        @include('front.include.footer')
        @include('front.include.footer-js')
            @yield('jsContent')
    </body>
</html>