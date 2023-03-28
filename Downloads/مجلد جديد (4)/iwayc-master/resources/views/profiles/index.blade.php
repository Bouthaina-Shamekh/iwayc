@extends('layouts.master')
@section('css')

@section('title')
 الملف الشخصي
@stop

@endsection
@section('title-page-header')
الاعدادات
@endsection
@section('page-header')
 الملف الشخصي
@endsection
@section('content')


				<!-- row -->
				<div class="row">

<div class="col-12 py-3">
	<div class="container">
		<div class="p-3 main-box mx-auto" style="width:600px;max-width: 100%;">
			<div class="d-flex align-items-center justify-content-center py-4">
			 	<div class="col-12 d-flex justify-content-center align-items-center mx-auto " style="width:100%">
			 		<div class="col-12 p-0 text-center">
				 		<img src="{{URL::asset('storage/users-avatar/'.Auth::user()->avatar)}}" style="width:150px;height:150px;border-radius: 50%;" class="d-inline-block">
				 		<div class="col-12 font-3 text-center py-2">
				 			{{ Auth::user()->name }}
				 		</div>
			 		</div>
			 	</div>
			</div>
			<div class="col-12 p-0">
				<table class="table table-bordered table-striped rounded table-hover">
					<tbody>
						<tr>
							<td> البريد الالكتروني</td>
							<td>{{ Auth::user()->email }}</td>
						</tr>
						<tr>
							<td>نوع الحساب</td>
							<td>
                            @if (!empty(Auth::user()->getRoleNames()))
                            @foreach (Auth::user()->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                            @endif
                            </td>
						</tr>
						<tr>
							<td>فعال</td>
							<td>
                            @if(Auth::user()->Status == 'مفعل')
                            <span class="fas fa-check-circle text-success">
                            @else
                             <span class="fas fa-check-circle text-error">
                            </span></td>
                            @endif
						</tr>
						<tr>
							<td>تحكم</td>
							<td><a href="{{ route('profile.edit') }}" class="rounded-0 btn btn-success btn-sm border"><span class="bx bx-cog fa-lg"></span> تعديل </a></td>
						</tr>
					</tbody>
				</table>
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
