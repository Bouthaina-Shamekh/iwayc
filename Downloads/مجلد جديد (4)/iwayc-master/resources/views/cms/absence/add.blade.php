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
@can('اضافة اذن موظف')

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
                @foreach ($errors->all() as $error)ol
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Absence">
                        @csrf
                        <div class="row">
                            <div class="col"><br>
                                <label class="control-label">اسم الموظف:* </label>
                                <input type="hidden" value="{{$userL>0?$uY:$moneyWork->year}}" id="edu_year_h" name="edu_year_h">
                                <div class="text-danger">{{$errors->first('edu_year_h')}}</div>


                                    <select name="employee_id" id="employee_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($employees as $employee)
                                            <option {{old("employee_id")==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('employee_id')}}</div>
                                </div>

                        </div>
                        <div class="row">
                            <div class="col"><br>
                                <label class="control-label">تصنيف المغادرة:* </label>


                                    <select name="type" id="type" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($types as $type)
                                            <option {{old("type")==$type->id?"selected":""}} value="{{$type->id}}"> {{$type->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('type')}}</div>
                                </div>

                        </div>
                        <div class="row" id="center_car_d" style="display:none">
                            <div class="col"><br>
                                <label class="control-label">باستخدام سيارة المركز:* </label>


                                    <select name="center_car" id="center_car" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>

                                        <option {{old("center_car")=="نعم"?"selected":""}} value="1"> نعم </option>
                                        <option {{old("center_car")=="لا"?"selected":""}} value="0"> لا </option>

                                    </select>
                                    <div class="text-danger">
                                    </div>
                                </div>

                        </div>
                        <div class="row" id="region_d" style="display:none">
                            <div class="col"><br>
                                <label class="control-label">المنطقة:* </label>


                                    <select name="region" id="region" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($regions as $region)
                                            <option {{old("region")==$region->id?"selected":""}} value="{{$region->id}}"> {{$region->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('region')}}</div>
                                </div>

                        </div>
                        <div class="row" id="leaving_d" style="display:none">
                            <div class="col"><br>
                                <label class="control-label">غاية المغادرة:* </label>


                                    <select name="leaving" id="leaving" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($leavings as $leaving)
                                            <option {{old("leaving")==$leaving->id?"selected":""}} value="{{$leaving->id}}"> {{$leaving->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('leaving')}}</div>
                                </div>

                        </div>
                        <div class="row" id="hoursandmin" style="display:none">
                            <div class="col"><br>
                                <label class="control-label">عدد الساعات: </label>
                                <div class="col-md-4 ls-group-input">
                                    <input name="hours" type="text" value="{{old("hours")}}" placeholder="00" class="form-control"/>
                                    <div class="text-danger">{{$errors->first('hours')}}</div>
                                </div>
                            </div>
                            <div class="col"><br>
                                <label class="control-label">عدد الدقائق: </label>
                                <div class="col-md-4 ls-group-input">
                                    <input name="minutes" type="text" value="{{old("minutes")}}" class="form-control" placeholder="00" />
                                    <div class="text-danger">{{$errors->first('minutes')}}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8"><br>
                                <label class="control-label">ملاحظات: </label>
                                <div class="col-md-10 ls-group-input">
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="With animation :)">{{old("notes")}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>
                            </div>
                        </div>


                        <div class="row last">
                            <div class="col text-center"><br>
                                <label class="control-label"></label>
                                <div class="col">
                                <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Absence/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('اضافة اذن موظف')
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
@section('js')
    <script>
        $('#type').change(function() {
            cert();
        });
        window.onload = function() {
            cert();
        };
        function cert(){
            if ($('select[name=type]').val()=="124"){
                $("#center_car_d").hide();
                $("#region_d").hide();
                $("#leaving_d").hide();
            }
            if ($('select[name=type]').val()=="342"){
                $("#center_car_d").hide();
                $("#region_d").hide();
                $("#leaving_d").hide();
            }
            if ($('select[name=type]').val()=="125"){
                $("#center_car_d").show();
                $("#region_d").hide();
                $("#leaving_d").hide();
            }
            if ($('select[name=type]').val()=="126" || $('select[name=type]').val()=="127"){
                $("#center_car_d").show();
                $("#region_d").show();
                $("#leaving_d").show();
            }
            if ($('select[name=type]').val()=="336"){
                $("#center_car_d").hide();
                $("#region_d").hide();
                $("#leaving_d").hide();
                $("#hoursandmin").show();
            }else{
                $("#hoursandmin").hide();
            }
        }
    </script>
@endsection
