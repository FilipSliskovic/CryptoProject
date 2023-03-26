
<!DOCTYPE html>
<html lang="en">
    @include('fixed.head')
    <body>
    {{--    Navigation--}}
    @include('fixed.navigation')
    {{--    Page content--}}
    @yield('content')
    {{--footer--}}
    @include('fixed.footer')
    {{--scripts--}}
    @include('fixed.scripts')

    @yield('additionalScripts')
    </body>
</html>
