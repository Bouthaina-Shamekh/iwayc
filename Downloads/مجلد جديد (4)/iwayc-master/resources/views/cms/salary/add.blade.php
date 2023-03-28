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

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Salary.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('اضافة راتب')

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


        <div class="card">
            <div class="card-body">
                    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Salary">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الموظف:* </label>
                                    <select name="employee_id" id="employee_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($employees as $employee)
                                            <option {{old("employee_id")==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('employee_id')}}</div>
                                </div>


                        <div class="col">
                                        <label class="control-label">الشهر:* </label>
                                        <select name="month[]" id="select-state" multiple class="form-control form-control-lg select2" size="1" placeholder="اختر الشهور المطلوبة...">
                                            <option {{(collect(old('month'))->contains("1")) ? 'selected':''}} value="1"> Jan - 01 </option>
                                            <option {{(collect(old('month'))->contains("2")) ? 'selected':''}} value="2"> Fab - 02 </option>
                                            <option {{(collect(old('month'))->contains("3")) ? 'selected':''}} value="3"> Mar - 03 </option>
                                            <option {{(collect(old('month'))->contains("4")) ? 'selected':''}} value="4"> Apr - 04 </option>
                                            <option {{(collect(old('month'))->contains("5")) ? 'selected':''}} value="5"> May - 05 </option>
                                            <option {{(collect(old('month'))->contains("6")) ? 'selected':''}} value="6"> Jun - 06 </option>
                                            <option {{(collect(old('month'))->contains("7")) ? 'selected':''}} value="7"> Jul - 07 </option>
                                            <option {{(collect(old('month'))->contains("8")) ? 'selected':''}} value="8"> Aug - 08 </option>
                                            <option {{(collect(old('month'))->contains("9")) ? 'selected':''}} value="9"> Sep - 09 </option>
                                            <option {{(collect(old('month'))->contains("10")) ? 'selected':''}} value="10"> Oct - 10 </option>
                                            <option {{(collect(old('month'))->contains("11")) ? 'selected':''}} value="11"> Nov - 11 </option>
                                            <option {{(collect(old('month'))->contains("12")) ? 'selected':''}} value="12"> Dec - 12 </option>
                                            </select>

                                            <div class="text-danger">{{$errors->first('month')}}</div>
                                </div>

                            </div><br>


                        <div class="row">
                            <div class="col">
                                <label class="col control-label">الراتب الشامل:* </label>
                                <div class="col">
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{old("salary")}}" class="form-control validate[required] text-input" id="salary"
                                           name="salary" placeholder="ادخل الراتب الشامل">
                                    <div class="text-danger">{{$errors->first('salary')}}</div>
                                </div>
                                </div>

                       <div class="col">
                        <label class="col control-label">الراتب الاساسي:* </label>

                        <div class="col">
                            <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{old("salary_warranty")}}" class="form-control validate[required] text-input" id="salary_warranty"
                                   name="salary_warranty" placeholder="أدخل الراتب الاساسي">
                            <div class="text-danger">{{$errors->first('salary_warranty')}}</div>
                        </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">امانات الضمان:* </label>

                                <div class="col">
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{old("warranty_secretariats")}}" class="form-control validate[required] text-input" id="warranty_secretariats"
                                           name="warranty_secretariats" placeholder="أدخل امانات الضمان">
                                    <div class="text-danger">{{$errors->first('warranty_secretariats')}}</div>
                                </div>
                                </div>
                        <div class="col">
                            <label class="col control-label">مساهمات الضمان:* </label>

                            <div class="col">
                                <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{old("warranty_contributions")}}" class="form-control validate[required] text-input" id="warranty_contributions"
                                       name="warranty_contributions" placeholder="أدخل مساهمات الضمان">
                                <div class="text-danger">{{$errors->first('warranty_contributions')}}</div>
                            </div>
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
                        </div>

                    </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endcan
@cannot('اضافة راتب')
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
