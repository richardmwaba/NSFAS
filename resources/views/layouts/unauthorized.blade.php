<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf_token" content="{!! csrf_field() !!}
        <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{URL::asset('../frontend/bootstrap-3.3.7/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{URL::asset('../frontend/css/index.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{URL::asset('../frontend/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <style>@yield('custom_styles')</style>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

<!--[if lt IE 9] >
             <script src="http://html5shiv.googlecode/svn/trunk/html5.js"></script>
             <script src="{{URL::asset('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
             <script src="{{URL::asset('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
             <script>$('div.alert').not('.alert_important').(300).slideUp(300)</script>
        <!][endif] -->
</head>
<body>
    <div class="main_content">
        @section('main_content')
            @yield('content')
        @show
    </div>


    <!-- Footer -->
    <footer class="footer footer-fixed-bottom">
        <div class="container" style="text-align:center">
            <p class="text-muted"><span class="glyphicon glyphicon-copyright-mark"></span> - 2016 The University of Zambia
                <br> All rights reserved.</p>
        </div>
    </footer>
    <!-- ./footer -->


    <!-- jQuery -->
    <script src="{{URL::asset('../frontend/js/jquery-2.1.4.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{URL::asset('../frontend/bootstrap-3.3.7/js/bootstrap.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    {{--<script src="{{URL::asset('../frontend/metisMenu/dist/metisMenu.min.js')}}"></script>--}}

    <!-- Custom Script for Schools and Departments -->
    <script src="{{URL::asset('../frontend/dist/js/custom.js')}}"></script>
</body>
</html>
