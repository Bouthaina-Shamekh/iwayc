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
<a class="btn btn-primary btn-md" href="{{ route('AbsenceT.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض طالب')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                         <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الطالب/عربي:* </label>
                                    <input type="text" value="{{$item->nameAR}}" class="form-control" id="nameAR"
                                           name="nameAR" disabled>
                                </div>
                                  <div class="col">
                                <label class="control-label">اسم الطالب/انجليزي:* </label>
                                    <input type="text" value="{{$item->nameEN}}" class="form-control" id="nameEN"
                                           name="nameEN" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">سنة الميلاد:* </label>


                                    <input type="text" value="{{$item->birthday}}" class="form-control" id="birthday"
                                           name="birthday" disabled>
                                </div>
                            <div class="col">
                                <label class="control-label">الجنس:* </label>


                                    <input type="text" value="{{\App\Models\Option::find($item->gender)->title}}" class="form-control" id="gender"
                                           name="gender" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">مكان الميلاد:* </label>
                                    <input type="text" value="{{$item->place_birth}}" class="form-control" id="place_birth"
                                           name="place_birth" disabled>
                                </div>
                        <div class="col">
                                <label class="control-label">الجنسية:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->nationality)->title}}" class="form-control" id="nationality"
                                           name="nationality" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">العنوان:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->address)->title}}" class="form-control" id="address"
                                           name="address" disabled>
                                </div>
                              <div class="col">
                                <label class="control-label">البريد الالكتروني:* </label>
                                    <input value="{{$item->email}}" class="form-control" type="text" name="email"
                                           id="email" disabled/>
                                </div>
                         <div class="col">
                                <label class="control-label">كيف سمعت عنا:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->how_listen)->title}}" class="form-control" id="how_listen"
                                           name="how_listen" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">هاتف 1:* </label>
                                    <input type="text" value="{{$item->phone1}}" class="form-control" id="phone1"
                                           name="phone1" disabled>
                                </div>
                         <div class="col">
                                <label class="control-label">هاتف 2:* </label>
                                    <input type="text" value="{{$item->phone2}}" class="form-control" id="phone2"
                                           name="phone2" disabled>
                                </div>
                       <div class="col">
                                <label class="control-label">هاتف 3 الواتساب:* </label>
                                    <input type="text" value="{{$item->whatsup}}" class="form-control" id="whatsup"
                                           name="whatsup" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المستوي التعليمي:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->level)->title}}" class="form-control" id="level"
                                           name="level" disabled>
                                </div>

                             <div class="col">
                                <label class="control-label">طبيعة العمل:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->work)->title}}" class="form-control" id="work"
                                           name="work" disabled>
                                </div>
                              <div class="col">
                                <label class="control-label">تصنيف الطالب:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->classification)->title}}" class="form-control" id="classification"
                                           name="classification" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات:* </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">

                                      @php
                                          if($std_active->active == 1){
                                                echo '<input class="form-control form-control-lg" value="فعال" disabled >';
                                          }else{
                                             echo '<input class="form-control form-control-lg" value="غير فعال" disabled >';
                                          }
                                      @endphp

                                </div>
                                </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    @can('تعديل طالب')
                                    <a href="/CMS/Student/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Student/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>


        </div>
    </div>
</div>
<!-- row closed -->
@endcan
    @cannot('عرض طالب')
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
