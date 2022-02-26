<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fourth Force') }} - @yield('title')</title>

    <link href="{{ asset(config('app.publicurl')) }}dashboard/css/styles.css" rel="stylesheet">
	<link href="{{ asset(config('app.publicurl')) }}dashboard/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset(config('app.publicurl')) }}dashboard/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset(config('app.publicurl')) }}dashboard/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset(config('app.publicurl')) }}dashboard/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{ asset(config('app.publicurl')) }}dashboard/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset(config('app.publicurl')) }}dashboard/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset(config('app.publicurl')) }}dashboard/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset(config('app.publicurl')) }}dashboard/css/custom.min.css" rel="stylesheet">
	<link href="{{ asset(config('app.publicurl')) }}dashboard/css/jquery.notifyBar.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    

</head>

<style>
body{font-family:robotic;}
.font-red{color:red !important;}
.font-green{color:green !important;}
.font-default{color:#000 !important;}
.font-white{color:#FFF !important;}
.bg-blue{background-color:#007bff8c !important;}
.width90
{
	width:90%;
	margin:auto;
}
    .mb-3 {
        margin-top: 12px !important;
    }
	
	svg:not(:root).svg-inline--fa
	{
		width:27px;
	}
	.card
	{
		background-color: #F7F7F7;
	}
	.action_icon
	{
		height:25px;
	}
	.edit-icon
	{
		color:blue;
	}
	.delete-icon
	{
		color:red;
	}
	.menu-down-arrow
	{
		float:right;
	}
 
</style>


<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"> <span> Fourth Force </span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <!--div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name ?? 'Guest' }}</h2>
              </div>
            </div-->
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              @include('includes.template.sidenavaccordion')

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!--div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div-->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          @include('includes.template.navbar')
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
		
		<div id="layoutSidenav_content">
		@include('includes.common.alerts')
          <!-- top tiles -->
		  @yield('content')
          </div>
		  
		  </div>
		  
        <!-- /page content -->

        <!-- footer content -->
        <!--footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
		  
          <div class="clearfix"></div>
        </footer-->
        <!-- /footer content -->
      </div>
	  @include('includes.template.footer')
    </div>



    <!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset(config('app.publicurl')) }}dashboard/js/scripts.js"></script-->
	
	<script src="{{ asset(config('app.publicurl')) }}dashboard/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/Flot/jquery.flot.js"></script>
    <script src="{{ asset(config('app.publicurl')) }}dashboard/Flot/jquery.flot.pie.js"></script>
    <script src="{{ asset(config('app.publicurl')) }}dashboard/Flot/jquery.flot.time.js"></script>
    <script src="{{ asset(config('app.publicurl')) }}dashboard/Flot/jquery.flot.stack.js"></script>
    <script src="{{ asset(config('app.publicurl')) }}dashboard/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="{{ asset(config('app.publicurl')) }}dashboard/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="{{ asset(config('app.publicurl')) }}dashboard/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/jqvmap/dist/jquery.vmap.js"></script>
    <script src="{{ asset(config('app.publicurl')) }}dashboard/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="{{ asset(config('app.publicurl')) }}dashboard/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/moment/min/moment.min.js"></script>
    <script src="{{ asset(config('app.publicurl')) }}dashboard/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset(config('app.publicurl')) }}dashboard/js/custom.min.js"></script>
	<script src="{{ asset(config('app.publicurl')) }}dashboard/js/jquery.notifyBar.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	
</body>

</html>
