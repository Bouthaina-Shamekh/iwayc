<!-- main-header opened -->
  <audio src="{{URL::asset('assets/sound/alarm.wav')}}" id="my_audio"></audio>
  <audio src="{{URL::asset('assets/sound/messenger.mp3')}}" id="my_audio2"></audio>
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left">
						<div class="responsive-logo">
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="dark-logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-2" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="dark-logo-2" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
						<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
							<input class="form-control" placeholder="Search for anything..." type="search"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
						</div>
					</div>
					<div class="main-header-right">
                             <ul class="light-icone">

                            <div class="main-layout">
                                <a class="new nav-link theme-layout nav-link-bg layout-setting">
                                @if(\App\Models\ColorTheme::first()->mode != 'dark')
                                <span class="light-layout">
                                        <i class="bx bx-moon fa-lg"></i>
                                    </span>
                                @else
                                <span class="light-layout">
                                    <i class="bx bx-sun fa-lg"></i>
                                </span>
                                @endif
                                </a>
                            </div>
                        </ul>


						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="nav-link" id="bs-example-navbar-collapse-1">
								<form class="navbar-form" role="search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times"></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
											</button>
										</span>
									</div>
								</form>
							</div>
@can('اشعارات')


                <div class="dropdown nav-item main-header-message ">
                    <a class="new nav-link" href="#"><span
                                style="color: red;font-size: 16px;right: -3px;position: absolute;font-weight: bold;top: -3px;"id="notifications_count2">{{ \App\Models\ChMessage::where('to_id',Auth::user()->id)->distinct('from_id')->where('seen',0)->count() }}</span><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                            </path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>{{-- <span class=" pulse-danger"></span> --}}</a>
                          <div id="unad">
                    <div class="dropdown-menu" id="unread2">
                        <div class="menu-header-content bg-primary text-right">
                            <div class="d-flex">
                                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">الرسائل</h6>
                            {{--     <span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All
                                    Read</span> --}}
                            </div>
                               @php
                                 $ChMessa = \App\Models\ChMessage::where('to_id',Auth::user()->id)->distinct('from_id')->where('seen',0)->count();
                             @endphp
                            <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">لديك  {{   $ChMessa }} رسائل غير مقروءه</p>
                        </div>
                        <div class="main-message-list chat-scroll">

                             @php
                                 $ChMessages = \App\Models\ChMessage::where('to_id',Auth::user()->id)->where('seen',0)->orderBy('created_at','desc')->get()->unique('from_id');
                             @endphp
                              @foreach ($ChMessages as $ChMessage)
                        <a href="/chatify/{{\App\Models\User::find($ChMessage->from_id)->id  }}" class="p-3 d-flex border-bottom">
                               <div class="notifyimg bg-warning" style="height: 60px !important;">
                                	<img src='{{ URL::asset('storage/users-avatar/'.\App\Models\User::find($ChMessage->from_id)->avatar) }}' alt="">
                                </div>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1 name">{{\App\Models\User::find($ChMessage->from_id)->name  }}</h5>
                                    </div>
                                    <p class="mb-0 desc">@if ($ChMessage->body == '')
                                      <span class="tag tag-warning">ارسل اليك مرفق</span>
                                      @else
                                           {{ $ChMessage->body}}
                                    @endif

                                    </p>
                                    <p class="time mb-0 text-left float-right mr-2 mt-2">{{ $ChMessage->created_at }}</p>
                                </div>
                            </a>
                              @endforeach



                        </div>
                        <div class="text-center dropdown-footer">
                            <a href="/chatify">مشاهده جميع الرسائل</a>
                        </div>
                    </div>
                </div>
            </div>

							<div class="dropdown nav-item main-header-message ">
                                <span
                                style="color:red;font-size: 16px;right:-1px;position: absolute; font-weight: bold;"id="notifications_count">{{ auth()->user()->unreadNotifications->count() }}</span><a class="new nav-link"  href="#"><i class="far fa-bell"></i></a>
								<div class="dropdown-menu  dropdown-menu2" id="unread">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">الاشعارات</h6>
											<span class="badge badge-pill badge-warning mr-auto my-auto float-left"><a href="{{ route('mark') }}">جعل الكل مقروء</a></span>
										</div>
		<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">
    لديك  {{ auth()->user()->unreadNotifications->count() }} اشعارات غير مقروءة </p>
									</div>
									<div class="main-message-list chat-scroll ">
							@foreach(auth()->user()->unreadNotifications as $notification)



<a class="d-flex p-3 border-bottom showModal" href="/CMS/ShowMy/Task/{{ $notification->data['task_id'] }}">
		<div class="notifyimg bg-warning" style="height: 60px !important;">
			<img src='{{ asset("storage/users-avatar/". \App\Models\User::find($notification->data['sender'])->avatar)}}' alt="">
		</div>
		<div class="mr-3">
         <h5 class="notification-label mb-1"> ارسل اليك <span class="tag tag-orange">{{\App\Models\User::find($notification->data['sender'])->name}}</span> </h5>

		    <h5 class="notification-label mb-2">مهمه : {{ $notification->data['title'] }}</h5>
		    <div class="notification-subtext mb-2"><h5 class="notification-label mb-1">{{ $notification->created_at->format('Y-m-d h:i') }}</h5>

            @if (  \App\Models\Task::where('id',$notification->data['task_id'])->first()->start_date != null &&\App\Models\Task::where('id',$notification->data['task_id'])->first()->end_date == null )

            <form method="POST" action="/CMS/Task/endTnotfy"style ='float: left; padding: 5px;'>@csrf
            <input type="hidden" value="{{ $notification->id }}"name="notify_id">
            <input type="hidden" value="{{ $notification->data['task_id'] }}"name="task_id">
            <button  type="submit" class="btn btn-sm btn-danger" >انهاء المهمة</button></form>

            <form method="POST" action="/CMS/Task/reminderTask"style ='float: left; padding: 5px;'>@csrf
            <input type="hidden" value="{{ $notification->id }}"name="notify_id">
            <input type="hidden" value="{{ $notification->data['task_id'] }}"name="task_id">
            <button  type="submit" class="btn btn-sm btn-danger" > التذكير لاحقا</button></form>

            @elseif (\App\Models\Task::where('id',$notification->data['task_id'])->first()->end_date != null &&\App\Models\Task::where('id',$notification->data['task_id'])->first()->start_date != null
            )
             <h5 class="tag tag-success">المهمه انتهت</h5>

            @elseif (\App\Models\Task::where('id',$notification->data['task_id'])->first()->start_date == null
            )
             <h5 class="tag tag-danger">المهمه لم تفعل بعد</h5>
            <form method="POST" action="/CMS/Task/reminderTask">@csrf
            <input type="hidden" value="{{ $notification->id }}"name="notify_id">
            <input type="hidden" value="{{ $notification->data['task_id'] }}"name="task_id">
            <button  type="submit" class="btn btn-sm btn-danger">التذكير لاحقا</button></form>
            @endif

          </div>
	    </div>
		<div class="mr-auto" >
		    <i class="las la-angle-left text-left text-muted"></i>
		</div>
	</a>

@endforeach
									</div>
									<div class="text-center dropdown-footer">
										<a class="text-center" href="/CMS/My/Task">مشاهده الكل</a>
									</div>
								</div>
							</div>

                            @endcan





							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><i class="ti-fullscreen"></i></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('storage/users-avatar/'. Auth::user()->avatar)}}"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="" src="{{URL::asset('storage/users-avatar/'. Auth::user()->avatar)}}" class=""></div>
											<div class="mr-3 my-auto">
												<h6>{{Auth::user()->name}}</h6><span>{{Auth::user()->email}}</span>
											</div>
										</div>
									</div>
							     <a class="dropdown-item" href="{{ route('profile.index') }}"><i class="bx bx-user-circle"></i>الملف الشخصي</a>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bx bx-cog"></i> تعديل الملف الشخصي</a>
                                <a class="dropdown-item" href="/CMS/My/Task"><i class="bx bxs-inbox"></i>مهماتي</a>
                                <a class="dropdown-item" href="{{ route('chatify') }}"><i class="bx bx-envelope"></i>الرسائل</a>
                               
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                        class="bx bx-log-out"></i>تسجيل خروج</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
								</div>
							</div>
							<div class="dropdown main-header-message right-toggle">
								<a class="nav-link pr-0" data-toggle="sidebar-left" data-target=".sidebar-left">
									<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>

								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->



