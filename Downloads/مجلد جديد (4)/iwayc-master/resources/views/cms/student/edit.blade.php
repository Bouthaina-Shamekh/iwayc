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
@can('اضافة طالب')
<a class="btn btn-primary btn-md" href="{{ route('Student.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه طالب جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Student.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('تعديل طالب')


<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


        <div class="card">
        <div class="card-body">
      <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Student/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الطالب/عربي:* </label>
                                    <input type="text" value="{{$item->nameAR}}" class="form-control validate[required] text-input" id="nameAR"
                                           name="nameAR" placeholder="أدخل اسم الطالب/عربي">
                                    <div class="text-danger">{{$errors->first('nameAR')}}</div>
                                </div>
                               <div class="col">
                                <label class="control-label">اسم الطالب/انجليزي: </label>
                                    <input type="text" value="{{$item->nameEN}}" class="form-control validate[required] text-input" id="nameEN"
                                           name="nameEN" placeholder="أدخل اسم الطالب/انجليزي">
                                    <div class="text-danger">{{$errors->first('nameEN')}}</div>
                                </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">سنة الميلاد:* </label>
                                    <input type="text" value="{{$item->birthday?$item->birthday:date('Y')}}" class="form-control" id="birthday"
                                           name="birthday" placeholder="أدخل سنة الميلاد" min="1900" max="{{date('Y')}}">
                                    <div class="text-danger">{{$errors->first('birthday')}}</div>
                                </div>
                         <div class="col">
                                <label class="control-label">الجنس:* </label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($genders as $gender)
                                            <option {{$item->gender==$gender->id?"selected":""}} value="{{$gender->id}}"> {{$gender->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('gender')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">مكان الميلاد:* </label>
                                    <input type="text" value="{{$item->place_birth}}" class="form-control validate[required] text-input" id="place_birth"
                                           name="place_birth" placeholder="أدخل مكان الميلاد">
                                    <div class="text-danger">{{$errors->first('place_birth')}}</div>
                                </div>

                        <div class="col">
                                <label class="control-label">الجنسية:* </label>
                                    <select name="nationality" id="nationality" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($nationalities as $nationality)
                                            <option {{$item->nationality==$nationality->id?"selected":""}} value="{{$nationality->id}}"> {{$nationality->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('nationality')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">العنوان:* </label>
                                    <select name="address" id="address" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($addresses as $address)
                                            <option {{$item->address==$address->id?"selected":""}} value="{{$address->id}}"> {{$address->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('address')}}</div>
                                </div>
                             <div class="col">
                                <label class="control-label">البريد الالكتروني: </label>
                                    <input placeholder="email@example.com" value="{{$item->email}}"
                                           class="validate[required,custom[email]] form-control" type="text" name="email"
                                           id="email"/>
                                    <div class="text-danger">{{$errors->first('email')}}</div>
                                </div>
                              <div class="col">
                                <label class="control-label">كيف سمعت عنا:* </label>
                                    <select name="how_listen" id="how_listen" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($hows as $how)
                                            <option {{$item->how_listen==$how->id?"selected":""}} value="{{$how->id}}"> {{$how->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('how_listen')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">هاتف 1:* </label>
                                    <input type="text" value="{{$item->phone1}}" class="form-control text-input" id="phone1"
                                           name="phone1" placeholder="أدخل رقم الهاتف">
                                    <div class="text-danger">{{$errors->first('phone1')}}</div>
                                </div>
                               <div class="col">
                                <label class="control-label">هاتف 2:* </label>


                                    <input type="text" value="{{$item->phone2}}" class="form-control text-input" id="phone2"
                                           name="phone2" placeholder="أدخل رقم الهاتف">
                                    <div class="text-danger">{{$errors->first('phone2')}}</div>
                                </div>
                              <div class="col">
                                <label class="control-label">هاتف 3 الواتساب: </label>


                                    <input type="text" value="{{$item->whatsup}}" class="form-control text-input" id="whatsup"
                                           name="whatsup" placeholder="أدخل رقم الهاتف">
                                    <div class="text-danger">{{$errors->first('whatsup')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المستوي التعليمي:* </label>
                                    <select name="level" id="level" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($levels as $level)
                                            <option {{$item->level==$level->id?"selected":""}} value="{{$level->id}}"> {{$level->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('level')}}</div>
                                </div>
                               <div class="col">
                                <label class="control-label">طبيعة العمل:* </label>
                                    <select name="work" id="work" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($works as $work)
                                            <option {{$item->work==$work->id?"selected":""}} value="{{$work->id}}"> {{$work->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('work')}}</div>
                                </div>
                           <div class="col">
                                <label class="control-label">تصنيف الطالب:* </label>


                                    <select name="classification" id="classification" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($classes as $class)
                                            <option {{$item->classification==$class->id?"selected":""}} value="{{$class->id}}"> {{$class->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('classification')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{$item->notes}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>

                        </div><br>
                           <div class="row ">
                               <div class="col-1">

                            </div>
                            <div class="col">
                                <label for="inputName" class="h4">فعال :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox" id="active" name="active"{{$std_active->active?"checked":""}}>
                            </div>
                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Student/" class="btn btn-danger"> إلغاء</a>
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

@cannot('تعديل طالب')
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
