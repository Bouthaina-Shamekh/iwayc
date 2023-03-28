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
@can('اضافة مستودع')
<a class="btn btn-primary btn-md" href="{{ route("Repository.create") }}"><i class='fas fa-plus'style="margin-left: 10px">اضافة مستودع جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Repository.index') }}">رجوع</a>
@stop
@endsection
@section('content')

   @can('تعديل مستودع')
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">

        <div class="card">
        <div class="card-body">
                <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Repository/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم المستودع:* </label>
                                    <input type="text" value="{{$item->name}}" class="form-control validate[required] text-input" id="name"
                                           name="name" placeholder="أدخل اسم المستودع">
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                </div>

                              <div class="col">
                                <label class="control-label">اسم الصندوق:* </label>
                                    <select name="box_id" id="box_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($boxes as $box)
                                            <option value="{{$box->id}}"> {{$box->name}} </option>
                                        @endforeach
                                        <option selected value="{{$boxess->id}}"> {{$boxess->name}} </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('box_id')}}</div>
                                </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">يظهر هذا المستودع لـ:* </label>
                                    <select name="user_show[]" id="select-state" multiple class="form-control form-control-lg select2">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}"  @if(count($repository_views)>0)
                                        @foreach($repository_views as $repository_view) @if($repository_view->user_id==$user->id)selected @endif @endforeach @endif> {{$user->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('user_show')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-12">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Repository/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
 @endcan

    @cannot('تعديل مستودع')
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
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endsection
