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
<a class="btn btn-primary btn-md" href="{{ route('Quota.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافة اذن جديد</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Quota.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض اذن موظف')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                    <div class="">
                              <div class="row">
                            <div class="col-8">
                                <label class="control-label">اسم الموظف:* </label>
                                    <input type="text" value="{{\App\Models\Employee::find($item->employee_id)->name}}" class="form-control" id="employee_id"
                                           name="employee_id" disabled>
                                </div>

                        </div>
                        <div class="row" id="hour_out_d" style="display: none">
                            <div class="col-8"><br>
                                <label class="control-label">وقت المغادرة:* </label>
                                    <input type="text" value="{{substr($item->hour_out,0,16)}}" class="form-control" id="hour_out"
                                           name="hour_out" disabled>
                                </div>

                        </div>
                        <div class="row" id="hour_in_d" style="display: none">
                            <div class="col-8"><br>
                                <label class="control-label">وقت العودة:* </label>
                                    <input type="text" value="{{substr($item->hour_in,0,16)}}" class="form-control" id="hour_in"
                                           name="hour_in" disabled>
                                </div>

                        </div>
                        <div class="row">
                            <div class="col-8"><br>
                                <label class="control-label">تصنيف المغادرة:* </label>
                                    <input type="hidden" id="type_h" value="{{$item->type}}">
                                    <input type="text" value="{{\App\Models\Option::find($item->type)->title}}" class="form-control" id="type"
                                           name="type" disabled>
                                </div>

                        </div>
                        <div class="row" id="center_car_d" style="display: none">
                            <div class="col-8"><br>
                                <label class="control-label">باستخدام سيارة المركز:* </label>
                                    <input type="text" value="{{$item->center_car==1?"نعم":"لا"}}" class="form-control" id="center_car"
                                           name="center_car" disabled>
                                </div>

                        </div>
                        <div class="row" id="region_d" style="display: none">
                            <div class="col-8"><br>
                                <label class="control-label">المنطقة:* </label>
                            <input type="text" value="<?php if(isset($item->region))echo \App\Models\Option::find($item->region)->title;?>" class="form-control" id="region"name="region" disabled>
                                </div>



                        </div>
                        <div class="row" id="leaving_d" style="display: none">
                            <div class="col-8"><br>
                                <label class="control-label">غاية المغادرة:* </label>
                                    <input type="text" value="<?php if(isset($item->leaving))echo \App\Models\Option::find($item->leaving)->title;?>" class="form-control" id="leaving"
                                           name="leaving" disabled>
                                </div>

                        </div><br>






                        <div class="row">
                            <div class="col-8">
                                <label class="control-label">ملاحظات: </label>

                                <div class="col-md-10 ls-group-input">
                                    <textarea class="form-control" id="notes" name="notes" disabled>
                                        {{$item->notes}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>
                      </div>
                        </div>

                             <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-sm-10">
                                    @can('تعديل موعد حصة')
                                    <a href="/CMS/Absence/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Absence/" class="btn btn-danger"> إلغاء</a>
                                </div>

                        </div>
                         </div><br><br>
        </div>
    </div>
</div>
<!-- row closed -->
@endcan
    @cannot('عرض اذن موظف')
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
 <script>
        window.onload = function() {
            if ($('#type_h').val()=="124"){
                $("#center_car_d").hide();
                $("#region_d").hide();
                $("#leaving_d").hide();
                $("#hour_in_d").hide();
                $("#hour_out_d").hide();
            }
            if ($('#type_h').val()=="125"){
                $("#center_car_d").show();
                $("#region_d").hide();
                $("#leaving_d").hide();
                $("#hour_in_d").show();
                $("#hour_out_d").show();
            }
            if ($('#type_h').val()=="126" || $('#type_h').val()=="127"){
                $("#center_car_d").show();
                $("#region_d").show();
                $("#leaving_d").show();
                $("#hour_in_d").show();
                $("#hour_out_d").show();
            }
        };
    </script>
@endsection
