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

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="/CMS/RepositorySection/{{$id}}">رجوع</a>
@stop
@endsection
@section('content')
       @can('اضافة اقسام مستودع')

<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
               <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/RepositorySection/add/{{$id}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم القسم:* </label>
                                <input type="hidden" value="{{$id}}" name="repository_id" id="repository_id">
                                    <input type="text" value="{{old('name')}}" class="form-control validate[required] text-input" id="name"
                                           name="name" placeholder="أدخل اسم القسم">
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                </div>

                        </div>
                        <div class="row last">
                            <div class="col text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-10">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/RepositorySection/{{$id}}" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div>

                    </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
     @endcan

    @cannot('اضافة اقسام مستودع')
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
