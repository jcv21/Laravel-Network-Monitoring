<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    @include("layout.header")

    @yield('css')

</head>
<body class="nav-md">
    @include('vendor.lara-izitoast.toast')

    <div class="container body">
        <div class="main_container">

            @include("layout.sidebar")

            @include("layout.topbar")

            <div class="right_col" role="main" style="min-height: 100vh;">

                @yield("content")
                
            </div>
        
            @include("layout.footer")

        </div>
    </div>

    @yield('js')
</body>
</html>