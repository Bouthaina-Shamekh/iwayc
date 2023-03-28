@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

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
@can('اضافة اقسام مستودع')
<a class="btn btn-primary btn-md" href="/CMS/RepositorySection/add/{{$id}}"><i class='fas fa-plus'style="margin-left: 10px">إضافة قسم جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="/CMS/RepositorySection/{{$id}}">رجوع</a>
@stop
@endsection
@section('content')

    @can('تعديل اقسام مستودع')
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">

        <div class="card">
        <div class="card-body">
                <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/RepositorySection/edit/{{$item->id}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم القسم:* </label>
                                    <input type="text" value="{{$item->name}}" class="form-control validate[required] text-input" id="name"
                                           name="name" placeholder="أدخل اسم القسم">
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                </div>
                            </div><br>

                        <div class="row last">
                            <div class="col text-center">
                                <label class="control-label"></label>
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/RepositorySection/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div><br>
                    </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->

    @endcan

    @cannot('تعديل اقسام مستودع')
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
