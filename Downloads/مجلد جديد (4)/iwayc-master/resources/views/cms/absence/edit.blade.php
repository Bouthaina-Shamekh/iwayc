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
<a class="btn btn-primary btn-md" href="{{ route('Absence.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه اذن جديد </a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('تعديل اذن موظف')


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
        <form id="formID" class=" ls_form" method="post" action="/CMS/Absence/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col"><br>
                                <label class="control-label">اسم الموظف:* </label>
                                    <select name="employee_id" id="employee_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($employees as $employee)
                                            <option {{$item->employee_id==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
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
                                            <option {{$item->type==$type->id?"selected":""}} value="{{$type->id}}"> {{$type->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('type')}}</div>
                                </div>

                        </div>
                        <div class="row" id="center_car_d" style="display: none">
                            <div class="col"><br>
                                <label class="control-label">باستخدام سيارة المركز:* </label>
                                    <select name="center_car" id="center_car" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        <option {{$item->center_car==1?"selected":""}} value="Yes"> نعم </option>
                                        <option {{$item->center_car==0?"selected":""}} value="No"> لا </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('center_car')}}</div>
                                </div>

                        </div>
                        <div class="row" id="region_d" style="display: none">
                            <div class="col-8"><br>
                                <label class="control-label">المنطقة:* </label>
                                    <select name="region" id="region" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($regions as $region)
                                            <option {{$item->region==$region->id?"selected":""}} value="{{$region->id}}"> {{$region->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('region')}}</div>
                                </div>

                        </div>
                        <div class="row" id="leaving_d" style="display: none">
                            <div class="col"><br>
                                <label class="control-label">غاية المغادرة:* </label>
                                    <select name="leaving" id="leaving" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($leavings as $leaving)
                                            <option {{$item->leaving==$leaving->id?"selected":""}} value="{{$leaving->id}}"> {{$leaving->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('leaving')}}</div>
                                </div>

                        </div>
                         <div class="row" id="hoursandmin" style="display:none">
                            <div class="col"><br>
                                <label class="control-label">عدد الساعات: </label>

                                <div class="col-md-4 ls-group-input">
                                    <input name="hours" type="text" value="{{old("hours",$item->hours)}}" placeholder="00" class="form-control"/>
                                    <div class="text-danger">{{$errors->first('hours')}}</div>
                                </div>
                            </div>
                            <div class="col"><br>
                                <label class="control-label">عدد الدقائق: </label>
                                <div class="col-md-4 ls-group-input">
                                <input name="minutes" type="text" value="{{old("minutes",$item->minutes)}}" class="form-control" placeholder="00" />
                                <div class="text-danger">{{$errors->first('minutes')}}</div>
                            </div>
                            </div>
                        </div>
                        <div class="row" id="inandout" style="display:none">
                            <div class="col"><br>
                                <label class="control-label">المغادرة : </label>

                                <div class="col-md-4 ls-group-input">
                                    <input name="hour_out" type="text" value="{{old("hour_out",$item->hour_out)}}"  class="form-control dateTimePicker"/>
                                    <div class="text-danger">{{$errors->first('hour_out')}}</div>
                                </div>
                             </div>
                            <div class="col"><br>
                            <label class="control-label"> العودة: </label>
                            <div class="col-md-4 ls-group-input">
                                    <input name="hour_in" type="text" value="{{old("hour_in",$item->hour_in)}}" class="form-control dateTimePicker"  />
                                    <div class="text-danger">{{$errors->first('hour_in')}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="absence_date" style="display:none">
                            <div class="col-8"><br>
                                <label class="control-label">تاريخ الغياب : </label>

                                <div class="col-md-10 ls-group-input">
                                    <input name="absence_date" type="text" value="{{old("absence_date",$item->absence_date)}}"  class="form-control datePicker" id="absencedate"/>
                                    <div class="text-danger">{{$errors->first('absence_date')}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"><br>
                                <label class="control-label">ملاحظات: </label>

                                <div class="ls-group-input">
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="With animation :)">{{$item->notes}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>

                        </div>
                      </div>

                        <div class="row">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Course/" class="btn btn-danger"> إلغاء</a>
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

@cannot('تعديل اذن موظف')
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
        $('#type').change(function() {
            cert();
        });
        window.onload = function() {
            cert();
        };
        function cert(){
            if ($('select[name=type]').val()=="124"){
                $("#absence_date").show();
                $("#center_car_d").hide();
                $("#region_d").hide();
                $("#leaving_d").hide();
                $("#inandout").hide();

            }
            if ($('select[name=type]').val()=="342"){
                $("#center_car_d").hide();
                $("#region_d").hide();
                $("#leaving_d").hide();
                $("#inandout").hide();
                $("#absence_date").hide();
            }
            if ($('select[name=type]').val()=="125"){
                $("#center_car_d").show();
                $("#inandout").show();
                $("#region_d").hide();
                $("#leaving_d").hide();
                $("#absence_date").hide();
            }
            if ($('select[name=type]').val()=="126" || $('select[name=type]').val()=="127"){
                $("#center_car_d").show();
                $("#region_d").show();
                $("#leaving_d").show();
                $("#inandout").hide();
                $("#absence_date").hide();
            }
            if ($('select[name=type]').val()=="336"){
                $("#center_car_d").hide();
                $("#region_d").hide();
                $("#leaving_d").hide();
                $("#hoursandmin").show();
                $("#inandout").hide();
                $("#absence_date").hide();
            }else{
                $("#hoursandmin").hide();
            }
        }
        $("#absencedate").datepicker({ dateFormat: 'yy-mm-dd' });
    </script>
@endsection
