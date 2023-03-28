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
<a class="btn btn-primary btn-md" href="{{ route('Quota.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('اضافة موعد حصة')

    <?php $userL = \App\Models\User_year::where('user_id',Auth::user()->id)->count(); ?>
    @if ($userL>0)
        <?php
        $userY = \App\Models\User_year::where('user_id',Auth::user()->id)->first();
        $uY = $userY->year;
        ?>
    @else
        <?php $uY = null; ?>
    @endif

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
    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Quota">
                        @csrf
                        <input type="hidden" value="{{$userL>0?$uY:$moneyWork->year}}" id="edu_year_h" name="edu_year_h">
                        <div class="row">

                            

                            <div class="col">
                                <label class="control-label">اسم المعلم والدورة:* </label>
                                    <select name="course_id" id="course_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @if(count($courses)>0)
                                            @foreach($courses as $course)
                                            <?php $teacher= \App\Models\Teacher::find($course->teacher_id); ?>
                                                <option {{old("course_h")==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->courseAR}}-{{$teacher->name or ""}} </option>
                                            @endforeach
                                            @endif
                                    </select>
                                    <div class="text-danger">{{$errors->first('course_id')}}</div>
                                </div>
                        <div class="col">
                                <label class="control-label">اليوم:* </label>
                                    <select name="day" id="day" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($days as $day)
                                            <option {{old("day")==$day->id?"selected":""}} value="{{$day->id}}">{{$day->title}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('day')}}</div>
                                </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم القاعة:* </label>
                                    <select name="room" id="room" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($rooms as $room)
                                            <option {{old("room")==$room->id?"selected":""}} value="{{$room->id}}">{{$room->title}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('room')}}</div>
                                </div>
                          <div class="col">
                                <label class="control-label">تصنيف الوقت:* </label>
                                    <select name="type" id="type" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($types as $type)
                                            <option {{old("type")==$type->id?"selected":""}} value="{{$type->id}}">{{$type->title}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('type')}}</div>
                                </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الوقت من:* </label>
                                    <select name="time" id="time" class="form-control">
                                        <option value=""> اختر تصنيف الوقت اولا.... </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('time')}}</div>
                                </div>
                                 <div class="col">
                        <label class="control-label">الوقت الي:* </label>
                                    <select name="time_to" id="time_to" class="form-control">
                                        <option value=""> اختر تصنيف الوقت اولا.... </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('time_to')}}</div>
                                </div>
                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-sm-10">
                                    <button class="submit btn-primary btn text-center" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Course/" class="btn btn-danger"> إلغاء</a>
                                </div>

                        </div>


                    </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endcan

    @cannot('اضافة موعد حصة')
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
        jQuery(document).ready(function($){
            $('#type').change(function(){
                var id=$(this).val();
                $.get("/CMS/Section/" + id,
                    function(data) {
                        var model = $('#time');
                        var model_to = $('#time_to');
                        model.empty();
                        model_to.empty();

                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.title + "</option>");
                            model_to.append("<option value='"+ element.id +"'>" + element.title + "</option>");
                        });
                    });
            });
        });
        window.onload = function() {
            if ($('#type').val()!=null){
                var id=$('#type').val();
                $.get("/CMS/Section/" + id,
                    function(data) {
                        var model = $('#time');
                        var model_to = $('#time_to');
                        model.empty();
                        model_to.empty();

                        $.each(data, function(index, element) {
                            <?php $m = "element.id;"?>
                            model.append("<option value='"+ element.id +"' {{old('time')==$m ?'selected':''}}>" + element.title + "</option>");
                        });

                        $.each(data, function(index, element) {
                            <?php $b = "element.id;"?>
                            model_to.append("<option value='"+ element.id +"' {{old('time_to')==$m ?'selected':''}}>" + element.title + "</option>");
                        });
                    });
            }
        };
    </script>
@endsection
