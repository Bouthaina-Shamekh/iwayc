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
<a class="btn btn-primary btn-md" href="{{ route('Employee.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('اضافة موظف')

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
            <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Employee">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الموظف:* </label>
                                    <input type="text" value="{{old('name')}}" class="form-control validate[required] text-input" id="name"
                                           name="name" placeholder="أدخل اسم الموظف">
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                </div>
                        <div class="col">
                                <label class="control-label">الوظيفة المطلوبة:* </label>
                                    <select name="job_title" id="job_title" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($jobs as $job)
                                            <option {{old("job_title")==$job->id?"selected":""}} value="{{$job->id}}"> {{$job->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('job_title')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">سنة الميلاد:* </label>
                                    <input type="number" min="1950" max="{{date("Y")}}" value="{{old('birthday')}}" class="form-control validate[required] text-input" id="birthday"
                                           name="birthday" placeholder="أدخل سنة الميلاد">
                                    <div class="text-danger">{{$errors->first('birthday')}}</div>
                                </div>
                        <div class="col">
                                <label class="control-label">الجنسية:* </label>
                                    <select name="nationality" id="nationality" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($nationalities as $nationality)
                                            <option {{old("nationality")==$nationality->id?"selected":""}} value="{{$nationality->id}}"> {{$nationality->title}} </option>
                                        @endforeach
                                    </select>
                                </div>

                               <div class="col">
                                <label class="control-label">الحالة الاجتماعية:* </label>
                                    <select name="status" id="status" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($statuses as $status)
                                            <option {{old("status")==$status->id?"selected":""}} value="{{$status->id}}"> {{$status->title}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <label class="control-label">المستوي التعليمي:* </label>


                                        <select name="level" id="level" class="form-control">
                                            <option value=""> اختر من القائمة.... </option>
                                            @foreach($levels as $level)
                                                <option {{old("level")==$level->id?"selected":""}} value="{{$level->id}}"> {{$level->title}} </option>
                                            @endforeach
                                        </select>
                                         <div class="text-danger">{{$errors->first('level')}}</div>
                                    </div> 

                        </div><br>


                        <div class="row">
                            <div class="col">
                                <label class="control-label">العنوان:* </label>
                                    <select name="address" id="address" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($addresses as $address)
                                            <option {{old("address")==$address->id?"selected":""}} value="{{$address->id}}"> {{$address->title}} </option>
                                        @endforeach
                                    </select>
                                </div>
                             <div class="col">
                                <label class="control-label">هاتف 1:* </label>
                                    <input type="text" value="{{old("phone1")}}" class="validate[required,custom[phone]] form-control" id="phone1"
                                           name="phone1" placeholder="أدخل رقم الهاتف">
                                           <div class="text-danger">{{$errors->first('phone1')}}</div>
                                </div>

                          <div class="col">
                                <label class="control-label">هاتف 2: </label>
                                    <input type="text" value="{{old("phone2")}}" class="validate[required,custom[phone]] form-control" id="phone2"
                                           name="phone2" placeholder="أدخل رقم الهاتف">
                                           <div class="text-danger">{{$errors->first('phone2')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">البريد الالكتروني: </label>
                                    <input placeholder="email@example.com" value="{{old("email")}}"
                                           class="validate[required,custom[email]] form-control" type="text" name="email"
                                           id="email"/>
                                           <div class="text-danger">{{$errors->first('email')}}</div>

                                </div>
                           <div class="col">
                                <label class="control-label">الحد الادني للراتب: </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{old("salary_down")}}" class="form-control text-input" id="salary_down"
                                           name="salary_down" placeholder="أدخل الحد الادني للراتب">
                                           <div class="text-danger">{{$errors->first('salary_down')}}</div>

                                </div>

                        </div><br>

                        <div class="row">
                           <div class="col">
                                <label class="control-label">مهارات الموظف:* </label>
                                    <select id="select-state" name="skills[]" multiple placeholder="اختر المهارات المطلوبة..."class="form-control form-control-lg select2">
                                        <option value="">اختر المهارات المطلوبة...</option>
                                        @foreach($skills as $skill)
                                            <option {{(collect(old('skills'))->contains($skill->id)) ? 'selected':''}} value="{{$skill->id}}"> {{$skill->title}} </option>
                                        @endforeach
                                    </select>
                                    <span class="help_text">يرجي اختيار المهارات المطلوبة كحد اقصي 10 مهارات</span>
                                    <div class="text-danger">{{$errors->first('skills')}}</div>
                                </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{old("notes")}}</textarea>
                                </div>

                        </div><br>

                    {{-- 6 --}}
                            <div class="row">
                                 <div class="col text-md-center">
                                      <label for="inputName" class="control-label"><strong>فعال :</strong></label>
                                      <input class="largerCheckbox" type="checkbox"value="1"name="active"{{old("active")?"checked":""}}>
                                </div>

                                 <div class="col ">
                                      <label for="inputName" class="control-label"><strong>مدخن :</strong></label>
                                      <input type="checkbox"class="largerCheckbox" value="1"name="smoke"{{old("smoke")?"checked":""}}>
                                </div>
                           </div><br>



                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Employee/" class="btn btn-danger"> إلغاء</a>
                                </div>

                        </div><br>
                    </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endcan

@cannot('اضافة موظف')
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
