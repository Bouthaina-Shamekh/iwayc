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
<a class="btn btn-primary btn-md" href="{{ route('Teacher.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('اضافة معلم')

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
                 <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Teacher">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم المعلم:* </label>
                                <input type="hidden" value="{{$userL>0?$uY:$moneyWork->year}}" id="edu_year_h" name="edu_year_h">
                                    <input type="text" value="{{old('name')}}" class="form-control validate[required] text-input" id="name"
                                           name="name" placeholder="أدخل اسم المعلم">
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                </div>
                              <div class="col">
                                <label class="control-label">التخصص:* </label>
                                    <select name="specialization" id="specialization" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($specs as $spec)
                                            <option {{old("specialization")==$spec->id?"selected":""}} value="{{$spec->id}}"> {{$spec->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('specialization')}}</div>
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
                                <label class="control-label">العنوان:* </label>
                                    <select name="address" id="address" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($addresses as $address)
                                            <option {{old("address")==$address->id?"selected":""}} value="{{$address->id}}"> {{$address->title}} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div><br>


                        <div class="row">
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
                                <label class="control-label">تصنيف المعلم:* </label>
                                    <select name="classification" id="classification" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($classes as $class)
                                            <option {{old("classification")==$class->id?"selected":""}} value="{{$class->id}}"> {{$class->title}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="With animation :)">{{old("notes")}}</textarea>
                                </div>
                            </div><br>


                           <div class="row ls_divider">
                           <div class="col-1">

                            </div>
                            <div class="col">
                                <label for="inputName" class="h4">فعال :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox" id="active" name="active"
                               {{old("active")?"checked":""}}>
                            </div>
                        </div>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Teacher/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('اضافة معلم')
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
