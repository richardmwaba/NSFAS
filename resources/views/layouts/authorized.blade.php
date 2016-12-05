<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{URL::asset('../frontend/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{URL::asset('../frontend/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{URL::asset('../frontend/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
{{--<link href="{{URL::asset('../frontend/css/timeline.css')}}" rel="stylesheet">--}}

<!-- Custom Fonts -->
    <link href="{{URL::asset('../frontend/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css">

    <!-- Datatables CSS -->
    <link href="{{URL::asset('../frontend/css/bootstrap-table.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{URL::asset('../frontend/css/authorized.css')}}" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

<!--[if lt IE 9] >
             <script src="http://html5shiv.googlecode/svn/trunk/html5.js"></script>
             <script src="{{URL::asset('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
             <script src="{{URL::asset('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
             <script>$('div.alert').not('.alert_important').(300).slideUp(300)</script>
     <!][endif] -->

@section('page_css')
    @yield('css')
@show

<!--[if lt IE 9] >
             <script src="http://html5shiv.googlecode/svn/trunk/html5.js"></script>
             <script src="{{URL::asset('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
             <script src="{{URL::asset('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
             <script>$('div.alert').not('.alert_important').(300).slideUp(300)</script>
     <!][endif] -->
</head>

<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div>
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{URL::asset('home')}}">
                     UNIVERSITY OF ZAMBIA | Financial Accounting System
                </a>
            </div>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>
                    {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{url('my_profile')}}"><i class="fa fa-user fa-fw"></i>Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">
                    @section('sideMenu')@yield('menu')@show
                        @if(Auth::user()->access_level_id == 'SA')
                        <li>
                            <a href="#"><i class="fa fa-home fa-fw"></i>Add a user<span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::asset('/addAccountant')}}"><i class="fa fa-plus fa-fw"></i>Accountant</a>
                                </li>
                                <li>
                                    <a href="{{URL::asset('/addHod')}}"><i class="fa fa-plus fa-fw"></i>Head of Department</a>
                                </li>
                                <li>
                                    <a href="{{URL::asset('/addDos')}}"><i class="fa fa-plus fa-fw"></i>Dean of School</a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                        <!--future menus for other users can be included here-->

                        @if(Auth::user()->access_level_id=='DN' ||  Auth::user()->access_level_id == 'AC')

                            <li>
                                <a href="#"><i class="fa fa-"></i>projects<span
                                            class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::asset('/Info')}}"><i class="fa fa-home fa-fw"></i>information</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::asset('/projectExpenditures')}}"><i class="fa fa-info fa-fw"></i>Expenditures</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::asset('/approvalProjectBudget')}}"><i class="fa fa-money fa-fw"></i>budget</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-info fa-fw"></i>Incomes<span
                                                    class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="{{URL::asset('/projectIncomes')}}"><i class="fa fa-info fa-fw"></i>Income summary</a>
                                            </li>
                                        </ul>
                                        <!-- /.nav-third-level -->
                                    </li>
                                    {{--<li>--}}
                                        {{--<a href="{{URL::asset('/projectReport')}}"><i class="fa fa-gear fa-fw"></i>Generate Report</a>--}}
                                    {{--</li>--}}
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-"></i>Reports<span
                                            class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::asset('/viewProjectInfo')}}"><i class="fa fa-gear fa-fw"></i>budget</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-info fa-fw"></i>projects<span
                                                    class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="{{URL::asset('/projectReport')}}"><i class="fa fa-gear fa-fw"></i>individual Report</a>
                                            </li>
                                        </ul>
                                        <!-- /.nav-third-level -->
                                    </li>
                                    <li>
                                        <a href="{{URL::asset('/ProjectReport')}}"><i class="fa fa-gear fa-fw"></i>accounts</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-fa-fw"></i>Imprest<span
                                            class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::asset('/imprests/all')}}"><i class="fa fa-plus-circle fa-fw"></i>imprests</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->access_level_id == 'AC')

                            <li>
                                <a href="#"><i class="fa "></i>Accounts<span
                                            class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::asset('/accountsInfo')}}"><i class="fa fa-info fa-fw"></i>info</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::asset('/viewAccounts')}}"><i class="fa fa-table fa-fw"></i>view</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::asset('/addAccount')}}"><i class="fa fa-plus-circle fa-fw"></i>add</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-"></i>Requests<span
                                            class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::asset('/viewBudget')}}"><i class="fa fa-info fa-fw"></i>info</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::asset('/budgetProposal')}}"><i class="fa fa-plus-circle fa-fw"></i>budget proposal</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::asset('/budgetReport')}}"><i class="fa fa-gear fa-fw"></i>Generate Report</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        @endif
                        @if(Auth::user()->access_level_id == 'HD')
                            <li>
                                <a href="#"><i class="fa fa-"></i>Staff<span
                                                    class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="{{URL::asset('/viewStaff')}}"><i class="fa fa-table fa-fw"></i>view</a>
                                        </li>
                                        <li>
                                            <a href="{{URL::asset('/addStaff')}}"><i class="fa fa-plus-circle fa-fw"></i>add</a>
                                        </li>
                                    </ul>
                            <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-"></i>Projects<span
                                            class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::asset('/viewProjectInfo')}}"><i class="fa fa-info fa-fw"></i>information</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::asset('/projectExpenditures')}}"><i class="fa fa-info fa-fw"></i>Expenditures</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::asset('/addProject')}}"><i class="fa fa-plus-circle fa-fw"></i>add</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-info fa-fw"></i>Generate Reports<span
                                                    class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="{{URL::asset('/projectReport')}}"><i class="fa fa fa-fw"></i>Individual Report</a>
                                            </li>
                                        </ul>
                                        <!-- /.nav-third-level -->
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-"></i>Budget<span
                                            class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::asset('/viewBudget')}}"><i class="fa fa-info fa-fw"></i>info</a>
                                </li>
                                <li>
                                    <a href="{{URL::asset('/budgetProposal')}}"><i class="fa fa-plus-circle fa-fw"></i>budget proposal</a>
                                </li>
                                <li>
                                    <a href="{{URL::asset('/budgetReport')}}"><i class="fa fa-gear fa-fw"></i>Generate Report</a>
                                </li>
                               </ul>
                            <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fa-fw"></i>Imprest<span
                                            class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::asset('/imprests/all')}}"><i class="fa fa-plus-circle fa-fw"></i>imprests</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->access_level_id == 'OT')

                            <li>
                                <a href="#"><i class="fa fa-"></i>Projects<span
                                            class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::asset('/viewProjectInfo')}}"><i class="fa fa-info fa-fw"></i>information</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::asset('/projectExpenditures')}}"><i class="fa fa-info fa-fw"></i>Expenditures</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::asset('/addProject')}}"><i class="fa fa-plus-circle fa-fw"></i>add</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-info fa-fw"></i>Generate Reports<span
                                                    class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="{{URL::asset('/projectReport')}}"><i class="fa fa fa-fw"></i>Individual Report</a>
                                            </li>
                                        </ul>
                                        <!-- /.nav-third-level -->
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-"></i>Imprests<span
                                            class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::asset('/imprests/all')}}"><i class="fa fa-plus-circle fa-fw"></i>imprests</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <!-- /.nav-second-level -->
                <!--future menus for other users can be included here-->
                </ul>

            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                {{--<img class="center block  pull-right img-circle img-responsive" src="{{ URL::asset('frontend/img/logo.png') }}">--}}
                <h4 class="page-header">
                   <div class="pull-right">@section('departmentName')@yield('department')@show</div>
                    @section('page_title')@yield('heading')@show
                    @if(Session::has('flash_message'))
                        <div class="alert alert-danger {{session()->has('flash_message_important')? session('flash_message') : ''}}">
                            {{Session::get('flash_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            @if(session()->has('flash_message_important'))

                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            @endif
                        </div>
                    @endif
                </h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    @section('main_content')
        <!-- /.row -->
            <!-- content injected here -->
            @yield('content')
    </div>
    <!-- /#page-wrapper -->
    @show
</div>
<!-- /#wrapper -->

<!-- Footer -->
<footer class="footer footer-fixed-bottom">
    <div class="container" style="text-align:center">
        <p class="text-muted"><span class="glyphicon glyphicon-copyright-mark"></span> - 2016 The University of Zambia
            <br> All rights reserved.</p>
    </div>
</footer>
<!-- ./footer -->
<!-- jQuery -->
@section('scripts')

    <!-- jQuery -->
    <script src="{{URL::asset('../frontend/js/jquery-2.1.4.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{URL::asset('../frontend/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{URL::asset('../frontend/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{URL::asset('../frontend/js/sb-admin-2.js')}}"></script>

    <!-- Datatables JavaScript -->
    <script src="{{URL::asset('../frontend/js/bootstrap-table.js')}}"></script>

    <!-- Custom JavaScript -->
    <script src="{{URL::asset('../frontend/js/authorized.js')}}"></script>
    <script>
        $('div.alert').not('.alert-important').delay(6000).slideUp(300);
    </script>

@show

    <script>
        !function ($) {
            $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
                $(this).find('em:first').toggleClass("glyphicon-minus");
            });
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
        }(window.jQuery);

        $(window).on('resize', function () {
            if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
        });
        $(window).on('resize', function () {
            if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
        })

    </script>

@show
</body>
</html>
