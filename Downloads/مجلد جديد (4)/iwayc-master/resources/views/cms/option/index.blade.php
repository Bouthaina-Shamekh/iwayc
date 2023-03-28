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
@can('اضافة خيارات')
<a href="/CMS/Option/add/{{$parent_id}}" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> إضافة قائمة جديدة </a>
@endcan
@endsection
@section('button2')
@if($parent_id!=0)
<a class="btn btn-primary btn-md" href="/CMS/Option/{{$id->parent_id}}">رجوع</a>
@else
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@endif
@stop
@endsection
@section('content')

    @can('عرض خيارات')
    <div class="row">


    </div>

    <br>

    @if($items->count() > 0)
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">

                    <h3 class="panel-title">
                        @if($parentPTitle!="")
                            {{$parentPTitle}}
                        @else
                            @if($parentTitle!="")
                                {{$parentTitle}}
                            @else
                                ادارة الثوابت
                            @endif()
                        @endif()
                    </h3>

                <div class="panel-body">
                    <!--Table Wrapper Start-->
                    <div class="table-responsive ls-table">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th width="40%">عنوان الثابت</th>
                                <th width="20%">تاريخ الانشاء</th>
                                <th width="10%">الفعالية</th>
                                <th width="20%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $a)
                            <tr>
                                <td>{{$a->title}}</td>
                                <td>{{$a->created_at->format('Y-m-d')}}</td>
                                <td><input type="checkbox" value="{{$a->id}}" class="cbActive form-control form-control-sm"
                                            {{$a->active?"checked":""}}  /></td>
                                <td class="text-center">
                                    @can('عرض خيارات')
                                    @if($parent_id==0 or $parentId==0)
                                        <a class="btn btn-sm btn-primary" href="/CMS/Option/{{$a->id}}"><i class="fa fa-list"></i></a>
                                    @endif()
                                    @endcan
                                    @can('عرض خيارات')
                                    <a class="btn btn-sm btn-success" href="/CMS/Option/show/{{$a->id}}">عرض</a>
                                        @endcan
                                        @can('تعديل خيارات')
                                    <a class="btn btn-sm btn-info" href="/CMS/Option/edit/{{$a->id}}">تعديل</a>
                                            @endcan
                                            @can('حذف خيارات')
                                    <a class="btn Confirm btn-sm btn-danger" href="/CMS/Option/delete/{{$a->id}}">حذف</a>
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
    </div>
    @else
        <div class="alert alert-warning" > لا يوجد عناصر لعرضها </div>
    @endif()
    @endcan

    @cannot('عرض خيارات')
        <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            ليس لديك صلاحية يرجي مراجعة المسؤول
        </div>
    @endcannot
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->

@endsection

@section("js")

    <script>
        $(function(){
            $(".cbActive").click(function(){
                var id=$(this).val();
                //$.get("/CMS/Option/active/"+id);
                $.ajax(
                    {
                        url:"/CMS/Option/active/"+id,
                        success:function(){

                         not7();

                        }
                    });
            });
        });
    </script>
@endsection()
