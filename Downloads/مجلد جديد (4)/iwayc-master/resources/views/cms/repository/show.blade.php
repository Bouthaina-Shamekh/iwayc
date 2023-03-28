@extends('layouts.master')
@section('css')

@section('title')
Iwayc System

@endsection

@section('title-page-header')
{{ $title }}

@endsection
@section('page-header')
{{ $parentTitle }}

@endsection
@section('button1')
@can('اضافة مستودع')
<a class="btn btn-primary btn-md" href="{{ route("Repository.create") }}"><i class='fas fa-plus'style="margin-left: 10px">اضافة مستودع جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Repository.index') }}">رجوع</a>
@stop
@endsection

@section('content')

 @can('عرض مستودع')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                   <form id="formID" class="formular form-horizontal ls_form">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم المستودع:* </label>
                                    <input type="text" value="{{$item->name}}" class="form-control" id="name"
                                           name="name" disabled>
                                </div>
                            <div class="col">
                                <label class="control-label">اسم الصندوق:* </label>
                                    <input type="text" value="{{\App\Models\Box::find($item->box_id)->name}}" class="form-control" id="box_id"
                                           name="box_id" disabled>
                            </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">يظهر هذا المستودع لـ: </label>
                                    @if(count($repository_views)>0)
                                        @foreach($repository_views as $repository_view)
                                            <span disabled class="tag tag-orange"> {{\App\Models\User::find($repository_view->user_id)->name}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي مستخدم لعرض المستودع</span>
                                    @endif

                            </div>
                        </div><br>
                        <div class="row last">
                            <div class="col-12 text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-12">
                                    @can('تعديل مستودع')
                                    <a href="/CMS/Repository/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Repository/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div>

                    </form>
        </div>
    </div>
</div>
<!-- row closed -->

    @endcan
    @cannot('عرض مستودع')
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
