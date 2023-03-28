@extends('layouts.master')
@section('css')


@section('title')
 Iwayc System

@endsection

@section('title-page-header')
{{ $title }}
@endsection
@section('page-header')
{{ $subtitle }}

@endsection
@section('button1')
@can('اضافة اقسام مستودع')
<a class="btn btn-primary btn-md" href="/CMS/RepositorySection/add/{{$id}}"><i class='fas fa-plus'style="margin-left: 10px">إضافة قسم جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Repository.index') }}">رجوع</a>
@stop
@endsection
@section('content')
 @can('عرض اقسام مستودع')

   @if($items->count() > 0)
		<!-- row -->
				<div class="row">
                			<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">

							</div>
							<div class="card-body">
							  <div class="table-responsive ls-table">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="50%">اسم القسم</th>
                                    <th width="20%">تاريخ الانشاء</th>
                                    <th width="20%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $a)
                                    <tr>
                                        <td>{{$a->name}}</td>
                                        <td>{{$a->created_at->format('Y-m-d')}}</td>
                                        <td class="text-center">
                                            @can('تعديل اقسام مستودع')
                                            <a class="btn btn-sm btn-info" href="/CMS/RepositorySection/edit/{{$a->id}}">تعديل</a>
                                            @endcan
                                            @can('حذف اقسام مستودع')
                                            <a class="btn Confirm btn-sm btn-danger" href="/CMS/RepositorySection/delete/{{$a->id}}">حذف</a>
                                                @endcan
                                        </td>
                                    </tr>
                                @endforeach()
                                </tbody>
                            </table>
                        </div>
                        {{$items->links()}}
							</div>
						</div>
					</div>
					<!--/div-->
				</div>



    @else
        <div class="alert alert-warning" > لا يوجد عناصر لعرضها </div>
    @endif()
    @endcan

    @cannot('عرض اقسام مستودع')
        <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            ليس لديك صلاحية يرجي مراجعة المسؤول
        </div>
    @endcannot
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')

@endsection
