@extends('layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
                <!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
<div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/logo/fab.ico')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">ID<span>EA</span>LWAY</h1></div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2 >مرحبا بعودتك <!DOCTYPE html>
                                                <html lang="en">
                                                <head>
                                                    <meta charset="UTF-8">
                                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                                                    <title>Document</title>
                                                </head>
                                                <body>

                                                </body>
                                                </html>!</h2>

												<form method="POST" action="{{ route('login') }}">
                                                    @csrf

													<div class="form-group">
														<label>البريد الالكتروني</label>
                                        <input class="form-control" placeholder="ادخل البريد الالكتروني" type="email" name="email" :value="old('email')" required autofocus />
													</div>

													<div class="form-group">
														<label>كلمة المرور</label>
 <input class="form-control" placeholder="ادخل كلمة المرور" type="password" value="__('Password')" name="password" required autocomplete="current-password" />
									</div>
                 <button class="btn btn-main-primary btn-block">تسجيل دخول</button>


                                                    <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('تذكرني') }}</span>
                </label>
            </div>


												</form>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
				<!-- The image half -->
                  <?php
                $logos = \App\Models\Logo::first();
                ?>
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{ asset('uploads/logos/' . $logos->image_icon1) }}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
						</div>
					</div>
				</div>

			</div>
		</div>
@endsection
@section('js')
@endsection
