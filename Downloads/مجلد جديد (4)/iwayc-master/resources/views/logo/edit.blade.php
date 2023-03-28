@extends('layouts.master')
@section('css')

@section('title')
تعديل  صور الشعارات
@stop

@endsection
@section('title-page-header')
الاعدادات
@endsection
@section('page-header')
الشعار
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
				<form method="POST" action="{{route('logo.update_image_icon1')}}" enctype="multipart/form-data">
					@csrf
					@method("PUT")
                    <div class="col-12 p-0 main-box shadow">
						<div class="col-12 px-0">
							<div class="col-12 px-3 py-3">
							 	<span class="bx bx-info-circle lg"></span>  الشعار الاساسي
							</div>
							<div class="col-12 divider" style="min-height: 2px;"></div>
						</div>
                         <div class="col-12 p-2">
                                <div class="col-12 pt-3">
                                    <div class="alert alert-warning">
                                      يفضل استخدام صوره كبيره مقاس  400 * 400
                                    </div>
                                </div>
                            </div>
						<div class="col-12 p-3">
							<div class="col-12 py-2 px-0 d-flex justify-content-center">
									<img src="{{ asset('uploads/logos/'.$logos->image_icon1) }}" style="width:150px;height:150px;border-radius:50%;border:1px solid;" id="getUserAvatar">
							</div>
                            <div class="col-12 p-2">
                                <div class="col-12">

                                </div>
                                <div class="col-12 pt-3">
                                    <input type="file"  name="image_icon1"class="form-control"  id="avatar-image"onchange="loadFile(event)">
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
				<form method="POST" action="{{route('logo.update_image_icon2')}}" enctype="multipart/form-data">
					@csrf
					@method("PUT")
                    <div class="col-12 p-0 main-box shadow">
						<div class="col-12 px-0">
							<div class="col-12 px-3 py-3">
							 	<span class="bx bx-info-circle lg"></span> الشعار الفرعي
							</div>
							<div class="col-12 divider" style="min-height: 2px;"></div>
						</div>
                         <div class="col-12 p-2">
                                <div class="col-12 pt-3">
                                    <div class="alert alert-warning">
                                      يفضل استخدام صوره صغيره مقاس  149 * 40
                                    </div>
                                </div>
                            </div>
						<div class="col-12 p-3">
							<div class="col-12 py-2 px-0 d-flex justify-content-center">
									<img src="{{ asset('uploads/logos/'.$logos->image_icon2) }}" style="width:150px;height:150px;border-radius:50%;border:1px solid;" id="getlogo">
							</div>
                            <div class="col-12 p-2">
                                <div class="col-12">

                                </div>
                                <div class="col-12 pt-3">
                                    <input type="file" name="image_icon2" class="form-control"  id="avatar-image"onchange="loadFile2(event)">
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
