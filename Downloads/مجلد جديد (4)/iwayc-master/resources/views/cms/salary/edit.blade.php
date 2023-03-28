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
<a class="btn btn-primary btn-md" href="{{ route('Salary.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه  راتب جديد </a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('تعديل راتب')


<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


        <div class="card">
        <div class="card-body">
      <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Salary/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الموظف:* </label>
                                    <select name="employee_id" id="employee_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($employees as $employee)
                                            <option {{$item->employee_id==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('employee_id')}}</div>
                                </div>


                               <div class="col">
                                <label class="col control-label">الشهر:* </label>
                                    <select name="month" id="month" class="form-control form-control-lg select2"multiple>
                                        <option value=""> اختر من القائمة.... </option>
                                        <option {{$item->month=="1"?"selected":""}} value="1"> Jan - 01 </option>
                                        <option {{$item->month=="2"?"selected":""}} value="2"> Fab - 02 </option>
                                        <option {{$item->month=="3"?"selected":""}} value="3"> Mar - 03 </option>
                                        <option {{$item->month=="4"?"selected":""}} value="4"> Apr - 04 </option>
                                        <option {{$item->month=="5"?"selected":""}} value="5"> May - 05 </option>
                                        <option {{$item->month=="6"?"selected":""}} value="6"> June - 06 </option>
                                        <option {{$item->month=="7"?"selected":""}} value="7"> July - 07 </option>
                                        <option {{$item->month=="8"?"selected":""}} value="8"> Aug - 08 </option>
                                        <option {{$item->month=="9"?"selected":""}} value="9"> Sept - 09 </option>
                                        <option {{$item->month=="10"?"selected":""}} value="10"> Oct - 10 </option>
                                        <option {{$item->month=="11"?"selected":""}} value="11"> Nov - 11 </option>
                                        <option {{$item->month=="12"?"selected":""}} value="12"> Dec - 12 </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('month')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الراتب الشامل:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->salary}}" class="form-control validate[required] text-input" id="salary"
                                           name="salary" placeholder="أدخل الراتب الشامل">
                                    <div class="text-danger">{{$errors->first('salary')}}</div>
                                </div>


                         <div class="col">
                            <label class="control-label">الراتب الاساسي:* </label>


                                <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->salary_warranty}}" class="form-control text-input" id="salary_warranty"
                                       name="salary_warranty" placeholder="أدخل الراتب الاساسي">
                                <div class="text-danger">{{$errors->first('salary_warranty')}}</div>
                            </div>


                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">امانات الضمان:* </label>


                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->warranty_secretariats}}" class="form-control validate[required] text-input" id="warranty_secretariats"
                                           name="warranty_secretariats" placeholder="أدخل امانات الضمان">
                                    <div class="text-danger">{{$errors->first('warranty_secretariats')}}</div>
                                </div>


                        <div class="col">
                            <label class="control-label">مساهمات الضمان:* </label>


                                <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->warranty_contributions}}" class="form-control validate[required] text-input" id="warranty_contributions"
                                       name="warranty_contributions" placeholder="أدخل مساهمات الضمان">
                                <div class="text-danger">{{$errors->first('warranty_contributions')}}</div>
                            </div>


                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Salary/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@cannot('تعديل راتب')
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
