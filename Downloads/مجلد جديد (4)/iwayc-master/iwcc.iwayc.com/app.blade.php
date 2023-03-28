<?php
if(!isset($title))
    $title = "";
if(!isset($linkApp))
    $linkApp = "";
if(!isset($subtitle))
    $subtitle = "";
if(!isset($parentLink))
    $parentLink = "";
if(!isset($parentTitle))
    $parentTitle = "";
if(!isset($parentPTitle))
    $parentPTitle = "";
if(!isset($parentPLink))
    $parentPLink = "";

if(Session::get("msgClass")==NULL)
    $msgClass = "alert-info";
else
    $msgClass = Session::get("msgClass");
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Viewport metatags -->
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="320" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- iOS webapp metatags -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <!-- iOS webapp icons -->
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/ios/fickle-logo-72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/ios/fickle-logo-72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/ios/fickle-logo-114.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- TODO: Add a favicon -->
    <link rel="shortcut icon" href="{{ asset('images/ico/fab.ico') }}">

    <title>{{ config('app.name', 'Courses') }}</title>

    <!--Page loading plugin Start -->
    <link rel="stylesheet" href="{{ asset('css/rtl-css/plugins/pace-rtl.css') }}">
    <script src="{{ asset('js/pace.min.js') }}"></script>
    <!--Page loading plugin End   -->

    <!-- Plugin Css Put Here -->
    <link href="{{ asset('css/bootstrap-rtl.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/rtl-css/plugins/bootstrap-progressbar-3.1.1-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rtl-css/plugins/jquery-jvectormap-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rtl-css/plugins/jquery.datetimepicker-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rtl-css/plugins/fileinput-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('nprogress-master/nprogress.css') }}">

    <!--AmaranJS Css Start-->
    <link href="{{ asset('css/rtl-css/plugins/amaranjs/jquery.amaran-rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rtl-css/plugins/amaranjs/theme/all-themes-rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rtl-css/plugins/amaranjs/theme/awesome-rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rtl-css/plugins/amaranjs/theme/default-rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rtl-css/plugins/amaranjs/theme/blur-rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rtl-css/plugins/amaranjs/theme/user-rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rtl-css/plugins/amaranjs/theme/rounded-rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rtl-css/plugins/amaranjs/theme/readmore-rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rtl-css/plugins/amaranjs/theme/metro-rtl.css') }}" rel="stylesheet">
    <!--AmaranJS Css End -->

    <!-- Plugin Css End -->
    <!-- Custom styles Style -->
    <link href="{{ asset('css/rtl-css/style-rtl.css') }}" rel="stylesheet">
    <!-- Custom styles Style End-->

    <!-- Responsive Style For-->
    <link href="{{ asset('css/rtl-css/responsive-rtl.css') }}" rel="stylesheet">
    <!-- Responsive Style For-->

    <!-- Data table style -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.17/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.6/css/select.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/editor.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shCore.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/demo.css') }}">--}}
    <!-- Data table style -->

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        input[type=checkbox]
        {
            margin: 5px;
        }
    </style>
    @yield('css')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="">
<!--Navigation Top Bar Start-->
<nav class="navigation">
    <div class="container-fluid">
        <!--Logo text start-->
        <div class="header-logo">
            <a href="{{ url('/') }}" title="">
                <h1>{{ config('app.name', 'Courses') }}</h1>
            </a>
        </div>
        <!--Logo text End-->
        <div class="top-navigation">
            <!--Collapse navigation Link icon start -->
            <div class="Link-control hidden-xs">
                <a href="javascript:void(0)">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <div class="search-box">
                <ul>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                            <span class="fa fa-search"></span>
                        </a>
                        <div class="dropdown-Link  top-dropDown-1">
                            <h4>Search</h4>
                            <form>
                                <input type="search" placeholder="what you want to see ?">
                            </form>
                        </div>

                    </li>
                </ul>
            </div>

            <!--Collapse navigation Link icon end -->
            <!--Top Navigation Start-->

            <ul>
                <li class="dropdown">
                    <!--All task drop down start-->
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                        <span class="fa fa-tasks"></span>
                        <span class="badge badge-lightBlue">3</span>
                    </a>
                    <div class="dropdown-Link right top-dropDown-1">
                        <h4>All Task</h4>
                        <ul class="goal-item">
                            <li>
                                <a href="javascript:void(0)">
                                    <div class="goal-user-image">
                                        <img class="rounded" src="{{ asset('images/userimage/avatar3-80.png') }}" alt="user image" />
                                    </div>
                                    <div class="goal-content">
                                        Wordpress Theme
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar ls-light-blue-progress six-sec-ease-in-out" aria-valuetransitiongoal="100"></div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <div class="goal-user-image">
                                        <img class="rounded" src="{{ asset('images/userimage/avatar2-80.png') }}" alt="user image" />
                                    </div>
                                    <div class="goal-content">
                                        PSD Designe
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar ls-red-progress six-sec-ease-in-out" aria-valuetransitiongoal="40"></div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <div class="goal-user-image">
                                        <img class="rounded" src="{{ asset('images/userimage/avatar1-80.png') }}" alt="user image" />
                                    </div>
                                    <div class="goal-content">
                                        Wordpress PLugin
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar ls-light-green-progress six-sec-ease-in-out" aria-valuetransitiongoal="60"></div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="only-link">
                                <a href="javascript:void(0)">View All</a>
                            </li>
                        </ul>
                    </div>
                    <!--All task drop down end-->
                </li>
                <li class="dropdown">
                    <!--Notification drop down start-->
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                        <span class="fa fa-bell-o"></span>
                        <span class="badge badge-red">6</span>
                    </a>

                    <div class="dropdown-Link right top-notification">
                        <h4>Notification</h4>
                        <ul class="ls-feed">
                            <li>
                                <a href="javascript:void(0)">
                                        <span class="label label-red">
                                            <i class="fa fa-check white"></i>
                                        </span>
                                    You have 4 pending tasks.
                                    <span class="date">Just now</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                        <span class="label label-light-green">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </span>
                                    Finance Report for year 2013
                                    <span class="date">30 min</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                        <span class="label label-lightBlue">
                                            <i class="fa fa-shopping-cart"></i>
                                        </span>
                                    New order received with
                                    <span class="date">45 min</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                        <span class="label label-lightBlue">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    5 pending membership
                                    <span class="date">50 min</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                        <span class="label label-red">
                                            <i class="fa fa-bell"></i>
                                        </span>
                                    Server hardware upgraded
                                    <span class="date">1 hr</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                        <span class="label label-blue">
                                            <i class="fa fa-briefcase"></i>
                                        </span>
                                    IPO Report for
                                    <span class="lightGreen">2014</span>
                                    <span class="date">5 hrs</span>
                                </a>
                            </li>
                            <li class="only-link">
                                <a href="javascript:void(0)">View All</a>
                            </li>
                        </ul>
                    </div>
                    <!--Notification drop down end-->
                </li>
                <li class="dropdown">
                    <!--Email drop down start-->
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                        <span class="fa fa-envelope-o"></span>
                        <span class="badge badge-red">3</span>
                    </a>

                    <div class="dropdown-Link right email-notification">
                        <h4>Email</h4>
                        <ul class="email-top">
                            <li>
                                <a href="javascript:void(0)">
                                    <div class="email-top-image">
                                        <img class="rounded" src="{{ asset('images/userimage/avatar3-80.png') }}" alt="user image" />
                                    </div>
                                    <div class="email-top-content">
                                        John Doe <div>Sample Mail 1</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <div class="email-top-image">
                                        <img class="rounded" src="{{ asset('images/userimage/avatar2-80.png') }}" alt="user image" />
                                    </div>
                                    <div class="email-top-content">
                                        John Doe <div>Sample Mail 2</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <div class="email-top-image">
                                        <img class="rounded" src="{{ asset('images/userimage/avatar1-80.png') }}" alt="user image" />
                                    </div>
                                    <div class="email-top-content">
                                        John Doe <div> Sample Mail 4</div>
                                    </div>
                                </a>
                            </li>
                            <li class="only-link">
                                <a href="mail.html">View All</a>
                            </li>
                        </ul>
                    </div>
                    <!--Email drop down end-->
                </li>
                <li class="hidden-xs">
                    <a class="right-sidebar" href="javascript:void(0)">
                        <i class="fa fa-comment-o"></i>
                    </a>
                </li>
                <li class="hidden-xs">
                    <a class="right-sidebar-setting" href="javascript:void(0)">
                        <i class="fa fa-cogs"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-lock"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            </ul>
            <!--Top Navigation End-->
        </div>
    </div>
</nav>
<!--Navigation Top Bar End-->
<section id="main-container">

    <!--Left navigation section start-->
    <section id="left-navigation">
        <!--Left navigation user details start-->
        <div class="user-image">
            <img src="{{ asset('images/userimage/avatar2-80.png') }}" alt=""/>
            <div class="user-online-status"><span class="user-status is-online  "></span> </div>
        </div>
        @guest
            <h2 style="color: #fff;text-align: center;">guest</h2>
        @else
            <h4 style="color: #fff;text-align: center;">{{ Auth::user()->name }}</h4>
        @endguest

        <!--Left navigation user details end-->

        <!--Phone Navigation Link icon start-->
        <div class="phone-nav-box visible-xs">
            <a class="phone-logo" href="index.html" title="">
                <h1>Fickle</h1>
            </a>
            <a class="phone-nav-control" href="javascript:void(0)">
                <span class="fa fa-bars"></span>
            </a>
            <div class="clearfix"></div>
        </div>
        <!--Phone Navigation Link icon start-->

        <!--Left navigation start-->
        <ul class="mainNav">
            <li class="{{ Request::path() == '/' ? 'active' : '' }}">
                <a class="{{ Request::path() == '/' ? 'active' : '' }}" href="/">
                    <i class="fa fa-dashboard"></i> <span>الصفحة الرئيسية</span>
                </a>
            </li>

            <?php
            $adminid = Auth::id();
            $links = DB::table("links")->whereRaw("links.id in (select link_id from user_link where user_id=$adminid) ")->where("parent_id",0)
                ->where("show_menu",1)->where("active",1)->where("isdelete",0)->get();
            ?>
            @foreach($links as $link)
                <?php
                $sublinks = DB::table("links")->whereRaw("links.id in (select link_id from user_link where user_id=$adminid) ")->where("parent_id",$link->id)
                    ->where("show_menu",1)->where("active",1)->where("isdelete",0)->get();
                $subSlug = '';
                ?>
                <li class="nav-item{{ Request::is($subSlug) ? ' active' : '' }}">
                    <a href="{{$link->slug}}" class="nav-link nav-toggle{{ Request::is($subSlug) ? ' active' : '' }}">
                        <i class="fa fa-user"></i>
                        <span class="title">{{$link->title}}</span>
                        <span class="arrow"></span>
                    </a>
                    @if(count($sublinks)>0)
                        <ul class="sub-Link">
                            @foreach($sublinks as $sublink)
                                <?php $subSlug = '/'.$sublink->slug; ?>
                                <?php $sub2 = Request::segment(2); ?>
                                <li class="nav-item {{ strpos($subSlug,$sub2) ? 'active' : '' }}">
                                    <a href="{{$subSlug}}" class="nav-link {{ strpos($subSlug,$sub2) ? 'active' : '' }}">
                                        <i class="fa fa-user"></i>
                                        <span class="title">{{$sublink->title}}</span>
                                    </a>
                                </li>
                            @endforeach()
                        </ul>
                    @endif()
                </li>

            @endforeach()


        </ul>
        <!--Left navigation end-->
    </section>
    <!--Left navigation section end-->


    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header"> {{$title}}
                            <small>{{$subtitle}}</small>
                        </h3>
                        <!--Top header end -->

                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li>
                                <a href="/home">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            @if($parentTitle!="")
                                <li>
                                    <a href="{{$parentLink}}">{{$parentTitle}}</a>
                                </li>
                            @endif()
                            @if($linkApp!="")
                                <li><a href="{{$linkApp}}">{{$title}}</a></li>
                            @else
                                <li>{{$title}}</li>
                            @endif
                            @if($parentPLink!="")
                                <li><a href="{{$parentPLink}}">{{$parentPTitle}}</a></li>
                            @else
                                <li>{{$parentPTitle}}</li>
                            @endif
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Session::get("msg")!=NULL)
                            <div class="col-md-offset-1 col-md-10 alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{Session::get("msg")}}
                            </div>
                        @endif()
                    </div>
                </div>
            @yield('content')
                <!-- Main Content Element  End-->

            </div>
        </div>



    </section>
    <!--Page main section end -->
    <!--Right hidden  section start-->
    <section id="right-wrapper">
        <!--Right hidden  section close icon start-->
        <div class="close-right-wrapper">
            <a href="javascript:void(0)"><i class="fa fa-times"></i></a>
        </div>
        <!--Right hidden  section close icon end-->

        <!--Tab navigation start-->
        <ul class="nav nav-tabs" id="setting-tab">
            <li class="active"><a href="index.html#chatTab" data-toggle="tab"><i class="fa fa-comment-o"></i> Chat</a></li>
            <li><a href="index.html#settingTab" data-toggle="tab"><i class="fa fa-cogs"></i> Setting</a></li>
        </ul>
        <!--Tab navigation end -->

        <!--Tab content start-->
        <div class="tab-content">
            <div class="tab-pane active" id="chatTab">
                <div class="nano">
                    <div class="nano-content">
                        <div class="chat-group chat-group-fav">
                            <h3 class="ls-header">Favorites</h3>
                            <a href="javascript:void(0)">
                                <span class="user-status is-online"></span>
                                Catherine J. Watkins
                                <span class="badge badge-lightBlue">1</span>
                            </a>
                            <a href="javascript:void(0)">
                                <span class="user-status is-idle"></span>
                                Fernando G. Olson
                            </a>
                            <a href="javascript:void(0)">
                                <span class="user-status is-busy"></span>
                                Susan J. Best
                            </a>
                            <a href="javascript:void(0)">
                                <span class="user-status is-offline"></span>
                                Brandon S. Young
                            </a>
                        </div>
                        <div class="chat-group chat-group-coll">
                            <h3 class="ls-header">Colleagues</h3>
                            <a href="javascript:void(0)">
                                <span class="user-status is-offline"></span>
                                Brandon S. Young
                            </a>
                            <a href="javascript:void(0)">
                                <span class="user-status is-idle"></span>
                                Fernando G. Olson
                            </a>
                            <a href="javascript:void(0)">
                                <span class="user-status is-online"></span>
                                Catherine J. Watkins
                                <span class="badge badge-lightBlue">3</span>
                            </a>

                            <a href="javascript:void(0)">
                                <span class="user-status is-busy"></span>
                                Susan J. Best
                            </a>

                        </div>
                        <div class="chat-group chat-group-social">
                            <h3 class="ls-header">Social</h3>
                            <a href="javascript:void(0)">
                                <span class="user-status is-online"></span>
                                Catherine J. Watkins
                                <span class="badge badge-lightBlue">5</span>
                            </a>
                            <a href="javascript:void(0)">
                                <span class="user-status is-busy"></span>
                                Susan J. Best
                            </a>
                        </div>
                    </div>
                </div>

                <div class="chat-box">
                    <div class="chat-box-header">
                        <h5>
                            <span class="user-status is-online"></span>
                            Catherine J. Watkins
                        </h5>
                    </div>

                    <div class="chat-box-content">
                        <div class="nano nano-chat">
                            <div class="nano-content">

                                <ul>
                                    <li>
                                        <span class="user">Catherine</span>
                                        <p>Are you here?</p>
                                        <span class="time">10:10</span>
                                    </li>
                                    <li>
                                        <span class="user">Catherine</span>
                                        <p>Whohoo!</p>
                                        <span class="time">10:12</span>
                                    </li>
                                    <li>
                                        <span class="user">Catherine</span>
                                        <p>This message is pre-queued.</p>
                                        <span class="time">10:15</span>
                                    </li>
                                    <li>
                                        <span class="user">Catherine</span>
                                        <p>Do you like it?</p>
                                        <span class="time">10:20</span>
                                    </li>
                                    <li>
                                        <span class="user">Catherine</span>
                                        <p>This message is pre-queued.</p>
                                        <span class="time">11:00</span>
                                    </li>
                                    <li>
                                        <span class="user">Catherine</span>
                                        <p>Hi, you there ?</p>
                                        <span class="time">12:00</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="chat-write">
                    <textarea class="form-control autogrow" placeholder="Type your message"></textarea>
                </div>
            </div>

            <div class="tab-pane" id="settingTab">

                <div class="setting-box">
                    <h3 class="ls-header">Account Setting</h3>
                    <div class="setting-box-content">
                        <ul>
                            <li><span class="pull-left">Online status: </span><input type="checkbox" class="js-switch-red" checked/></li>
                            <li><span class="pull-left">Show offline contact: </span><input type="checkbox" class="js-switch-light-blue" checked/></li>
                            <li><span class="pull-left">Invisible mode: </span><input class="js-switch" type="checkbox" checked></li>
                            <li><span class="pull-left">Log all message:</span><input class="js-switch-light-green" type="checkbox" checked></li>
                        </ul>
                    </div>
                </div>
                <div class="setting-box">
                    <h3 class="ls-header">Maintenance</h3>
                    <div class="setting-box-content">
                        <div class="easy-pai-box">
                                <span class="easyPieChart" data-percent="90">
                                    <span class="easyPiePercent"></span>
                                </span>
                        </div>
                        <div class="easy-pai-box">
                            <button class="btn btn-xs ls-red-btn js_update">Update Data</button>
                        </div>
                    </div>
                </div>

                <div class="setting-box">
                    <h3 class="ls-header">Progress</h3>
                    <div class="setting-box-content">

                        <h5>File uploading</h5>
                        <div class="progress">
                            <div class="progress-bar ls-light-blue-progress six-sec-ease-in-out"
                                 aria-valuetransitiongoal="10"></div>
                        </div>

                        <h5>Plugin setup</h5>
                        <div class="progress progress-striped active">
                            <div class="progress-bar six-sec-ease-in-out ls-light-green-progress"
                                 aria-valuetransitiongoal="20"></div>
                        </div>
                        <h5>Post New Article</h5>
                        <div class="progress progress-striped active">
                            <div class="progress-bar ls-yellow-progress six-sec-ease-in-out"
                                 aria-valuetransitiongoal="80"></div>
                        </div>
                        <h5>Create New User</h5>
                        <div class="progress progress-striped active">
                            <div class="progress-bar ls-red-progress six-sec-ease-in-out"
                                 aria-valuetransitiongoal="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Tab content -->
    </section>
    <!--Right hidden  section end -->

    <div id="Confirm" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">تاكيد</h4>
                </div>
                <div class="modal-body">
                    <p>هل انت متأكد من الاستمرار في العملية؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء الأمر</button>
                    <a class="btn btn-danger">نعم, متأكد</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" id="IFrame" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
</section>

<!--Right hidden  section end -->
<div id="change-color">
    <div id="change-color-control">
        <a href="javascript:void(0)"><i class="fa fa-magic"></i></a>
    </div>
    <div class="change-color-box">
        <ul>
            <li class="default active"></li>
            <li class="red-color"></li>
            <li class="blue-color"></li>
            <li class="light-green-color"></li>
            <li class="black-color"></li>
            <li class="deep-blue-color"></li>
        </ul>
    </div>
</div>

<!--Layout Script start -->
<script type="text/javascript" src="{{ asset('js/color.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/jquery-1.11.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
{{--<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>--}}
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/multipleAccordion.js') }}"></script>

<!--easing Library Script Start -->
<script src="{{ asset('js/lib/jquery.easing.js') }}"></script>
<!--easing Library Script End -->

<!--Nano Scroll Script Start -->
<script src="{{ asset('js/jquery.nanoscroller.min.js') }}"></script>
<!--Nano Scroll Script End -->

<!--switchery Script Start -->
<script src="{{ asset('js/switchery.min.js') }}"></script>
<!--switchery Script End -->

<!--bootstrap switch Button Script Start-->
<script src="{{ asset('js/bootstrap-switch.js') }}"></script>
<!--bootstrap switch Button Script End-->

<!--easypie Library Script Start -->
<script src="{{ asset('js/jquery.easypiechart.min.js') }}"></script>
<!--easypie Library Script Start -->

<!--bootstrap-progressbar Library script Start-->
<script src="{{ asset('js/bootstrap-progressbar.min.js') }}"></script>
<!--bootstrap-progressbar Library script End-->

<!--FLoat library Script Start -->
<script type="text/javascript" src="{{ asset('js/chart/flot/jquery.flot.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/chart/flot/jquery.flot.pie.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/chart/flot/jquery.flot.resize.js') }}"></script>
<!--FLoat library Script End -->

<script type="text/javascript" src="{{ asset('js/pages/layout.js') }}"></script>
<!--Layout Script End -->

<!--Upload button Script Start-->
<script type="text/javascript" src="{{ asset('js/fileinput.min.js') }}"></script>
<!--Upload button Script End-->
<!--Auto resize  text area Script Start-->
<script type="text/javascript" src="{{ asset('js/jquery.autosize.js') }}"></script>
<!--Auto resize  text area Script Start-->
<script type="text/javascript" src="{{ asset('js/pages/sampleForm.js') }}"></script>

<!-- Date & Time Picker Library Script Start -->
<script type="text/javascript" src="{{ asset('js/jquery.datetimepicker.js') }}"></script>
<!-- Date & Time Picker Library Script End -->

<!--Demo for Date, Time Color Picker Script Start -->
<script type="text/javascript" src="{{ asset('js/pages/pickerTool.js') }}"></script>
<!--Demo for Date, Time Color Picker Script End -->

<!-- data table script -->

{{--<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.17/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.17/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.6/js/dataTables.select.min.js"></script>
<script type="text/javascript" language="javascript" src="{{ asset('js/dataTables.editor.min.js') }}"></script>
<script type="text/javascript" language="javascript" src="{{ asset('js/editor.bootstrap.min.js') }}"></script>
<script type="text/javascript" language="javascript" src="{{ asset('js/shCore.js') }}"></script>
<script type="text/javascript" language="javascript" src="{{ asset('js/demo.js') }}"></script>
<script type="text/javascript" language="javascript" src="{{ asset('js/editor-demo.js') }}"></script>--}}
<!-- data table script -->

<!-- skycons script start -->
<script src="{{ asset('js/skycons.js') }}"></script>
<!-- skycons script end   -->

<!--Vector map library start-->
<script src="{{ asset('js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('js/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!--Vector map library end-->

<!--AmaranJS library script Start -->
<script src="{{ asset('js/jquery.amaran.js') }}"></script>
<script src="{{ asset('nprogress-master/nprogress.js') }}"></script>

<script>
    $(function(){
        //لو تم الضغط على اي حدا كلاسه Confirm
        $(document).on("click",".Confirm",function(){
            //شغلي المودال الي اسمه Confirm
            $("#Confirm").modal("show");
            //تغيير الرابط تاع زر التأكيد الى الرابط تاع الزر الي انضغط عليه
            $("#Confirm .btn-danger").attr("href",$(this).attr("href"));
            //ما تكمل وتحذف عن جد
            return false;
        });

        //لو تم الضغط على اي حدا كلاسه IFrame
        $(document).on("click",".IFrame",function(){
            //شغلي المودال الي اسمه IFrame
            $("#IFrame").modal("show");
            //تغيير العنوان تبع الموديل على هوى التايتل تاع اللينك
            $("#IFrame .modal-title").html($(this).attr("title"));

            $("#IFrame .modal-body").html(
                "<iframe src='"+$(this).attr("href")
                +"' frameborder=0 width=100% height=500 ></iframe>");
            //ما تكمل وتحذف عن جد
            return false;
        });


        $( document ).ajaxStart(function() {
            NProgress.start()
        });
        $( document ).ajaxStop(function() {
            NProgress.done()
        });
        $( document ).ajaxError(function() {
            NProgress.done()
        });
    });

</script>

@yield('js')

</body>
</html>