<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template"/>
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template"/>
    <meta name="author" content="potenzaglobalsolutions.com"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.include.head')
</head>

<body>

<div class="wrapper">

    <!--=================================preloader -->

    <div id="pre-loader">
        <img src="assets/images/pre-loader/loader-01.svg" alt="">
    </div>

    <!--=================================preloader -->

    @include('layouts.include.main-header')

    @include('layouts.include.main-sidebar')

    <!--=================================
 Main content --><!-- main-content -->
    <div class="content-wrapper">

        @yield('page-header')
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">@yield('PageTitle')</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}"
                                                       class="default-color">{{trans('main-trans.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">@yield('PageTitle')</li>
                    </ol>
                </div>
            </div>

            @yield('content')

            <!--=================================  footer -->
            @include('layouts.include.footer')
        </div><!-- main content wrapper end-->
    </div>
    <!--================================= footer -->

@include('layouts.include.footer-scripts')

</body>

</html>
