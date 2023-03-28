@extends('layouts.master')
@section('css')

@section('title')
تعديل الملف الشخصي
@stop

@endsection
@section('title-page-header')
الاعدادات
@endsection
@section('page-header')
تعديل الملف الشخصي
@endsection

@section('content')


				<!-- row -->
<div class="row">
    @if (session()->has('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('errors') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
<div class="col-12 py-3">
	<div class="container">
		<div class=" d-flex row m-0">
			<div class="col-12 col-lg-6 my-2">
				<form method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
					@csrf
					@method("PUT")
                    <div class="col-12 p-0 main-box shadow">
						<div class="col-12 px-0">
							<div class="col-12 px-3 py-3">
							 	<span class="bx bx-info-circle lg"></span> البيانات الأساسية
							</div>
							<div class="col-12 divider" style="min-height: 2px;"></div>
						</div>
						<div class="col-12 p-3">
							<div class="col-12 py-2 px-0 d-flex justify-content-center">
									<img src="{{URL::asset('storage/users-avatar/'.Auth::user()->avatar)}}" style="width:150px;height:150px;border-radius:50%;" id="getUserAvatar">
							</div>
                            <div class="col-12 p-2">
                                <div class="col-12">
                                    الصورة الشخصية
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="file" name="user_img" class="form-control"  id="avatar-image"onchange="loadFile(event)">
                            </div>
                            </div>
							<div class="col-12 p-2">
								<div class="col-12">
									اسم المستخدم
								<span style="color:red;font-size:16px">*</span></div>
								<div class="col-12 pt-3">
									<input type="text" name="name" required="" min="3" max="190" class="form-control" value="{{ Auth::user()->name }}" accept="image/*">
								</div>
							</div>

							<div class="col-12 p-2">
								<div class="col-12 pt-3">
									<button class="btn btn-primary">حفظ البيانات</button>

								</div>
							</div>
						</div>
					</div>
				</form>
			</div>

            <div class="col-12 col-lg-6 my-2">
                <form method="POST" action="{{route('profile.update-phone')}}">
                     @csrf
                    @method("PUT")
                    <div class="col-12 p-0 main-box shadow">
                        <div class="col-12 px-0">
                            <div class="col-12 px-3 py-3">
                                <span class="bx bx-phone fa-lg"></span> تغيير البريد الالكتروني
                            </div>
                            <div class="col-12 divider" style="min-height: 2px;"></div>
                        </div>
                        <div class="col-12 p-3">
                            <div class="col-12 p-2">
                                <div class="col-12">
                                البريد الالكتروني الحالي
                                <span style="color:red;font-size:16px">*</span></div>
                                <div class="col-12 pt-3">
                                    <input type="email" name="old_email" class="form-control" required="" value="{{ Auth::user()->email }}">
                                </div>
                            </div>

                            <div class="col-12 p-2">
                                <div class="col-12">
                                    البريد الالكتروني الجديد
                                <span style="color:red;font-size:16px">*</span></div>
                                <div class="col-12 pt-3">
                                    <input type="email" name="email" class="form-control " required="">
                                </div>
                            </div>
                            <div class="col-12 p-2">
                                <div class="col-12">
                                    تأكيدالبريد الالكتروني الجديد
                                <span style="color:red;font-size:16px">*</span></div>
                                <div class="col-12 pt-3">
                                    <input type="email" name="email_confirmation" class="form-control" required="">
                                </div>
                            </div>

                            <div class="col-12 p-2">
                                <div class="col-12 pt-3">
                                    <button class="btn btn-primary"> تغير البريد الالكتروني </button>

                                </div>
                            </div>


                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 col-lg-6 my-2">
                <form method="POST" action="{{route('profile.update-password')}}">
                     @csrf
                    @method("PUT")
                     <div class="col-12 p-0 main-box shadow">
                        <div class="col-12 px-0">
                            <div class="col-12 px-3 py-3">
                                <span class="bx bx-key fa-lg"></span>  كلمة المرور
                            </div>
                            <div class="col-12 divider" style="min-height: 2px;"></div>
                        </div>
                        <div class="col-12 p-3">
                            <div class="col-12 p-2">
                                <div class="col-12 pt-3">
                                    <div class="alert alert-warning">
                                        يفضل إستخدام كلمة مرور مكونة من أحرف وأرقام وعلامات خاصة مثل ( % $ # @ )
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 p-2">
                                <div class="col-12">
                                    كلمة المرور الحالية
                                <span style="color:red;font-size:16px">*</span></div>
                                <div class="col-12 pt-3">
                                    <input type="password" name="old_password" class="form-control" required="" minlength="8" maxlength="190">
                                </div>
                            </div>

                            <div class="col-12 p-2">
                                <div class="col-12">
                                    كلمة المرور الجديدة
                                <span style="color:red;font-size:16px">*</span></div>
                                <div class="col-12 pt-3">
                                    <input type="password" name="password" class="form-control" required="" minlength="8" maxlength="190">
                                </div>
                            </div>
                            <div class="col-12 p-2">
                                <div class="col-12">
                                    تأكيد المرور الجديدة
                                <span style="color:red;font-size:16px">*</span></div>
                                <div class="col-12 pt-3">
                                    <input type="password" name="password_confirmation" class="form-control" required="" minlength="8" maxlength="190">
                                </div>
                            </div>

                            <div class="col-12 p-2">
                                <div class="col-12 pt-3">
                                    <button class="btn btn-primary">تغيير كلمة المرور</button>

                                </div>
                            </div>


                        </div>
                    </div>
                </form>
            </div>

		</div>
	</div>
</div>



</div>




				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')


@endsection
