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
@can('اضافة خيارات')
<a href="/CMS/Option/add/{{$parent_id}}" class="btn btn-primary btn-md"><i class='fas fa-plus'style="margin-left: 10px"></i> إضافة قائمة جديدة </a>
@endcan

@endsection
@section('button2')

<a class="btn btn-primary btn-md" href="/CMS/Option/0">رجوع</a>

@stop
@endsection

@section('content')

@can('عرض خيارات')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">عنوان الثابت: </label>
                                    <input type="text" value="{{$item->title}}" class="form-control text-input" id="title"
                                           name="title" disabled>
                                </div>
                                  <div class="col">
                                <label class="control-label">الفعالية: </label>
                                    <input value="{{$item->active?"فعال":"غير فعال"}}"
                                           class="form-control text-input"
                                           type="text" name="active" id="active" disabled="disabled"/>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col text-center">
                                <label class="control-label"></label>
                                    @can('تعديل خيارات')
                                    <a href="/CMS/Option/edit/{{$item->id}}" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Option/{{$parent_id}}" class="btn btn-danger"> إلغاء</a>
                                </div>
                        </div><br>
        </div>
    </div>
</div>
</div>
<!-- row closed -->
</div>
   @endcan
   @cannot('عرض خيارات')
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
