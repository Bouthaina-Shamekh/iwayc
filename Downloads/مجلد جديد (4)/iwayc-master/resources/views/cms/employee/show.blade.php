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
<a class="btn btn-primary btn-md" href="{{ route("Employee.create") }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه موظف جديد </a>

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Employee.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض موظف')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                         <form id="formID" class="formular form-horizontal ls_form">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الموظف: </label>


                                    <input type="text" value="{{$item->name}}" class="form-control" id="name"
                                           name="name" disabled>
                                </div>
                               <div class="col">
                                <label class="control-label">الوظيفة المطلوبة: </label>


                                    <input type="text" value="{{\App\Models\Option::find($item->job_title)->title}}" class="form-control" id="job_title"
                                           name="job_title" disabled>
                                </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">تاريخ الطلب: </label>


                                    <input type="text" value="{{substr($item->created_at,0,10)}}" class="form-control" id="created_at"
                                           name="created_at" disabled>
                                </div>
                         <div class="col">
                                <label class="control-label">سنة الميلاد: </label>


                                    <input type="text" value="{{$item->birthday}}" class="form-control" id="birthday"
                                           name="birthday" disabled>
                                </div>

                           <div class="col">
                                <label class="control-label">الجنسية: </label>


                                    <input type="text" value="{{\App\Models\Option::find($item->nationality)->title}}" class="form-control" id="nationality"
                                           name="nationality" disabled>
                                </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الحالة الاجتماعية: </label>


                                    <input type="text" value="{{\App\Models\Option::find($item->status)->title}}" class="form-control" id="status"
                                           name="status" disabled>
                                </div>

                                <div class="col">
                                    <label class="control-label">المستوي التعليمي:* </label>
                                        <input type="text" value="{{\App\Models\Option::find($item->level)->title ?? ''}} "
                                          class="form-control" id="level"
                                               name="level" disabled>
                                    </div>
                                </div><br>

                                    <div class="row">


                        <div class="col">
                                <label class="control-label">العنوان: </label>


                                    <input type="text" value="{{\App\Models\Option::find($item->address)->title}}" class="form-control" id="address"
                                           name="address" disabled>
                                </div>


                        </div>

                        <div class="row">
                             <div class="col">
                                <label class="control-label">هاتف 1: </label>


                                    <input type="text" value="{{$item->phone1}}" class="form-control" id="phone1"
                                           name="phone1" disabled>
                                </div>
                            <div class="col">
                                <label class="control-label">هاتف 2: </label>
                                    <input type="text" value="{{$item->phone2}}" class="form-control" id="phone2"
                                           name="phone2" disabled>
                                </div>
                          <div class="col">
                                <label class="control-label">البريد الالكتروني: </label>


                                    <input value="{{$item->email}}" class="form-control" type="text" name="email"
                                           id="email" disabled/>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الحد الادني للراتب: </label>
                                    <input type="text" value="{{$item->salary_down}}" class="form-control" id="salary_down"
                                           name="salary_down" disabled>
                                </div>
                           <div class="col">
                                <label class="control-label">مهارات الموظف:* </label><br>
                                    @if(count($emp_skill)>0)
                                        @foreach($emp_skill as $emp_s)
                                            <span disabled class="tag tag-orange"> {{\App\Models\Option::find($emp_s->name)->title}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي مستخدم لعرض الارشيف</span>
                                    @endif
                                </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>

                        </div><br>

                        <div class="row">
                         <div class="col">
                                <label class="control-label">فعال: </label>
                                    <input type="text" value="{{$item->active?"فعال":"غير فعال"}}" class="form-control" id="active"
                                           name="active" disabled>
                                </div>
                            <div class="col">
                                <label class="control-label">مدخن: </label>
                                    <input type="text" value="{{$item->smoke?"مدخن":"غير مدخن"}}" class="form-control" id="smoke"
                                           name="smoke" disabled>
                                </div>
                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    @can('تعديل موظف')
                                    <a href="/CMS/Employee/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Employee/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div>

                    </form>


        </div>
    </div>
</div>
<!-- row closed -->
@endcan
    @cannot('عرض موظف')
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
