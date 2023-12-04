<!DOCTYPE html>
<html lang="en">
  	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="icon" href="images/favicon.png" type="image/ico" />

    <title>PIAS</title>
    {{-- <link rel="icon" href="{{ asset('admin/logo.png')}}" type="image/icon type"> --}}


    <!-- Bootstrap -->
    <link href="{{asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('admin/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('admin/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('admin/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="{{asset('admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('admin/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    {{-- Datatables --}}
     <link href="{{asset('admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('admin/build/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/build/css/custom.css')}}" rel="stylesheet">
   
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('admin.dashboard')}}" class="site_title ">
                <img src="{{ asset('images/logo.jpeg')}}" height="50" style=" width: 90%;">
                
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              {{-- <div class="profile_pic">
                <img src="{{ asset('web/assets/images/user.png') }}" alt="..." class="img-circle profile_img">
              </div> --}}
              <div class="profile_info">
                <span>Welcome,<b>{{ Auth::user()->name }}</b></span>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li>
                    <a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Home </span></a>
                  </li>

                  @if (Auth::guard('admin')->user()->user_type == 1 || Auth::guard('admin')->user()->user_type == 2)
                  <li>
                    <a href="{{route('admin.user.list')}}"><i class="fa fa-institution"></i> Users </span></a>
                  </li>
                  @endif

                  <li>
                    <a href="{{route('admin.unregistered.user.list')}}"><i class="fa fa-institution"></i> Unregistered Users </span></a>
                  </li>

                  @if (Auth::guard('admin')->user()->user_type == 1)
                    <li>
                      <a href="{{route('admin.employee.list')}}"><i class="fa fa-institution"></i> Employee </span></a>
                    </li>                      
                  @endif

                  @if (Auth::guard('admin')->user()->user_type == 1 || Auth::guard('admin')->user()->user_type == 2)
                    <li>
                      <a href="{{route('admin.order.invoice.form')}}"><i class="fa fa-institution"></i> Make New Order </span></a>
                    </li>
                    <li>
                      <a href="{{route('admin.order.invoice.membership.form')}}"><i class="fa fa-institution"></i> New Membership </span></a>
                    </li>                    
                  @endif

                  @if (Auth::guard('admin')->user()->user_type == 1)
                    <li>
                      <a><i class="fa fa-gears" aria-hidden="true"></i> Products <span class="fa fa-chevron-down"></span></a>
                      
                      <ul class="nav child_menu">                       
                        <li class="sub_menu"><a href="{{route('admin.product.from')}}">Add Product</a></li>
                        <li class="sub_menu"><a href="{{route('admin.product.list')}}">List</a></li>
                        <li class="sub_menu"><a href="{{route('admin.size.list')}}">Sizes List</a></li>
                      </ul>
                    </li>               
                    
                    <li>
                      <a href="{{route('admin.refund_list')}}"><i class="fa fa-institution"></i> Refund Requests </span></a>
                    </li>
                  @endif

                  <li>
                    <a><i class="fa fa-gears" aria-hidden="true"></i> Orders <span class="fa fa-chevron-down"></span></a>
                    
                    <ul class="nav child_menu">
                      @if (Auth::guard('admin')->user()->user_type == 1 || Auth::guard('admin')->user()->user_type == 2)
                        <li class="sub_menu"><a href="{{ route('admin.order.new_list') }}">All Orders</a></li>
                        <li class="sub_menu"><a href="{{ route('admin.order.search_form') }}">Search</a></li>
                      @endif
                        <li class="sub_menu"><a href="{{ route('admin.bulk.order_list') }}">Bulk Orders</a></li>
                    </ul>

                  </li>
                  @if (Auth::guard('admin')->user()->user_type == 1 || Auth::guard('admin')->user()->user_type == 2)
                    <li>
                      <a href="{{route('admin.delivery.sheet.form')}}"><i class="fa fa-institution"></i> Delivery Sheet </span></a>
                    </li>
                    
                    <li>
                      <a><i class="fa fa-gears" aria-hidden="true"></i>Subscription Orders <span class="fa fa-chevron-down"></span></a>
                      
                      <ul class="nav child_menu">
                        <li class="sub_menu"><a href="{{route('admin.user.subscription.paid_list')}}">Paid List</a></li>
                        <li class="sub_menu"><a href="{{route('admin.user.subscription.un_paid_list')}}">Unpaid List</a></li>
                      </ul>
                    </li>
                  @endif
                  @if (Auth::guard('admin')->user()->user_type == 1)
                    <li><a><i class="fa fa-gears" aria-hidden="true"></i> Settings <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li class="sub_menu"><a href="{{route('admin.setting.brand_list')}}">Brands</a></li>
                        <li class="sub_menu"><a href="{{route('admin.setting.size_list')}}">Sizes</a></li>
                        <li class="sub_menu"><a href="{{route('admin.setting.slot_list')}}">Delivery Slots</a></li>
                        <li class="sub_menu"><a href="{{route('admin.setting.slider_list')}}">App Sliders</a></li>                   
                        <li class="sub_menu"><a href="{{route('admin.coupon_list')}}">Coupon List</a></li>
                        <li><a>Subscription Master <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="{{route('admin.setting.plan_master_list')}}">Masters</a></li>
                            <li class="sub_menu"><a href="{{route('admin.setting.plan_details_list')}}">Plans</a></li>
                          </ul>
                        </li>
                        <li><a>Location <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="{{route('admin.setting.main_area.list')}}">Main Area</a></li>
                            <li class="sub_menu"><a href="{{route('admin.setting.sub_area.list')}}">Sub Area</a></li>
                          </ul>
                        </li>
                        <li class="sub_menu"><a href="{{route('admin.invoice_form')}}">Invoice Setting</a></li>

                      </ul>
                    </li>
                  
                    
                    <li><a href="{{ route('admin.change_password_form') }}"><i class="fa fa-key" aria-hidden="true"></i>Change Password </span></a></li>
                  @endif
                  
                </ul>
              </div>

            </div>
          </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="#">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  {{-- <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">John Doe
                    <span class=" fa fa-angle-down"></span>
                  </a> --}}
                  {{-- <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul> --}}
                </li>

               
              <ul class="nav navbar-nav navbar-right">
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge bg-green"></span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        {{-- <span class="image"><img src="images/img.jpg" alt="Profile Image"></span> --}}
                        <span>
                          <span></span>
                          <span class="time"></span>
                        </span>
                        <span class="message" id="message">
                         
                        </span>
                      </a>
                    </li>
                  </ul>
                </li>
                <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
             <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->