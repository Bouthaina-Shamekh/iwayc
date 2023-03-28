<!-- Title -->
<title>@yield('title')</title>
<!-- Favicon -->
<meta charset='utf-8'>




<link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
<!-- Sidemenu css -->
<link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@yield('css')


<!--- Style css -->
<link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">
<!--- Dark-mode css -->
@auth
@if(\App\Models\ColorTheme::where('user_id',Auth::user()->id)->first()->mode == 'dark')
<link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet">
@endif
@endauth

<!---Skinmodes css-->
<link href="{{URL::asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet">

<!--- app css -->
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">


 <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script>
 @auth
var JSvar = "<?= Auth::user()->id?>";
 @endauth
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('781f8f90926b7f8f25f4', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('status-liked');
    channel.bind('noyify', function(data) {
        if(data.username == JSvar){
        $("#notifications_count").load(window.location.href + " #notifications_count");
        $("#unread").load(window.location.href + " #unread");
        document.getElementById("my_audio").play();
        }else{

        }


    });

     var channel2 = pusher.subscribe('chatify');
    channel2.bind('chat', function(data) {
        if(data.username == JSvar){
        $("#notifications_count2").load(window.location.href + " #notifications_count2");
        $("#unread2").load(window.location.href + " #unread2");
        document.getElementById("my_audio2").play();
        }else{

        }


    });

  </script>
