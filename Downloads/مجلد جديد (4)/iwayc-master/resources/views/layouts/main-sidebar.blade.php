<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
                <?php
                $logos = \App\Models\Logo::first();

                ?>
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='home') }}"><img src="{{ asset('uploads/logos/' . $logos->image_icon2) }}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='home') }}"><img src="{{ asset('uploads/logos/' . $logos->image_icon2) }}" class="main-logo dark-theme" alt="logo"></a>
			{{-- 	<a class="logo-icon mobile-logo icon-light icon-dark active" href="{{ url('/' . $page='home') }}"><img src="{{ asset('assets/logo/small.jpeg') }}" class="logo-icon" alt="logo"></a> --}}
				<a class="logo-icon mobile-logo active" href="{{ url('/' . $page='home') }}"><img src="{{ asset('assets/logo/small.jpeg') }}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu main-sidemenu1">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('storage/users-avatar/'. Auth::user()->avatar)}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::user()->name }}</h4>
							<span class="mb-0 text-muted">{{Auth::user()->email }}</span>
						</div>
					</div>
				</div>
				<ul class="side-menu iconelinke">
					<li class="side-item side-item-category">Main</li>

                    @can('الصفحة الرئيسية')


					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='home') }}"><i style="font-size:20px"class="la la-home"></i><span class="side-menu__label">الصفحة الرئيسية</span></a>
					</li>
                    @endcan

 <?php  $adminid = Auth::id();
        $links = DB::table("links")->whereRaw("links.id in (select link_id from user_link where user_id=$adminid) ")
                    ->where("parent_id", 0)->where("show_menu", 1)->where("active", 1)->where("isdelete", 0)->orderBy('ordered')->get();
  ?>
                @foreach($links as $link)
                    <?php $sublinks = DB::table("links")->whereRaw("links.id in (select link_id from user_link where user_id=$adminid) ")
                        ->where("parent_id", $link->id)->where("show_menu", 1)->where("active", 1)->where("isdelete", 0)->orderBy('ordered')->get();;
                    $subSlug = '';?>
					<li class="slide">
						<a class="side-menu__item iconelinke" data-toggle="slide" href="{{ url('/' . $page='#') }}">

                        <?php
                            echo  " " . $link->icone . " ";
                            ?>
                        <span class="side-menu__label">

                       {{$link->title}}

                        </span><i class="angle fe fe-chevron-down"></i></a>
                    @if(count($sublinks)>0)
						<ul class="slide-menu">
                        @foreach($sublinks as $sublink)


						  <li><a class="slide-item" href="/{{$sublink->slug}}">{{$sublink->title}}</a></li>

                        @endforeach()
						</ul>
                    @endif()
					</li>


                @endforeach()

				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
