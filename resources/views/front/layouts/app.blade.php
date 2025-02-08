<!DOCTYPE html>
<html lang="ar">

<head>
    @include('front.layouts._head_script')
</head>

<body>
    <div class="page-wrapper rtl">

        @include('front.layouts._header')

        @yield('content')

        <!-- Main Footer -->
        @include('front.layouts._footer')
        <!-- End Footer -->



    </div>

    <!--End pagewrapper-->


@include('front.layouts._footer_script')

</body>
</html>
