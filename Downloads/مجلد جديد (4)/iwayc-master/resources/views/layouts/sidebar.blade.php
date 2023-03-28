<!-- Sidebar-right-->
		<div class="sidebar sidebar-left sidebar-animate">
			<div class="panel panel-primary card mb-0 box-shadow">
				<div class="tab-menu-heading border-0 p-3">
					<div class="card-title mb-0">الشات</div>
					<div class="card-options mr-auto">
						<a href="#" class="sidebar-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
					<div class="tabs-menu ">
						<!-- Tabs -->
						<ul class="nav panel-tabs">
							<li><a href="#side3" data-toggle="tab"><i class="ion ion-md-contacts tx-18 ml-2"></i> المستخدمين</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane  active" id="side3">
							<div class="list-group list-group-flush ">
                            <?php $users= \App\Models\User::where('Status','مفعل')->where('id','!=',Auth::user()->id)->get();
                            ?>
                    @foreach ($users as $user)
								<div class="list-group-item d-flex  align-items-center">
									<div class="ml-2">
										<span class="avatar avatar-md brround cover-image" data-image-src="{{URL::asset('storage/users-avatar/'. $user->avatar)}}"><span class="avatar-status bg-success"></span></span>
									</div>
									<div class="">
										<div class="font-weight-semibold" {{-- data-toggle="modal" data-target="#chatmodel" --}}>{{ $user->name }}</div>
									</div>
									<div class="mr-auto">
										<a href="/chatify/{{$user->id}}" class="btn btn-sm btn-light" {{-- data-toggle="modal" data-target="#chatmodel" --}} ><i class="fab fa-facebook-messenger"></i></a>
									</div>
								</div>
                     @endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<!--/Sidebar-right-->

