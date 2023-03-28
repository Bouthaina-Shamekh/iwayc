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
<a class="btn btn-primary btn-md" href="{{ route('Teacher.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه معلم جديد </a>

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Teacher.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض معلم')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم المعلم: </label>
                                    <input type="text" value="{{$item->name}}" class="form-control" id="name"
                                           name="name" disabled>
                                </div>
                           <div class="col">
                                <label class="control-label">التخصص: </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->specialization)->title}}" class="form-control" id="specialization"
                                           name="specialization" disabled>
                                </div>
                            </div><br>


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
                            </div><br>



                        <div class="row">
                            <div class="col">
                                <label class="control-label">العنوان: </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->address)->title}}" class="form-control" id="address"
                                           name="address" disabled>
                                </div>
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
                            </div><br>



                        <div class="row">
                            <div class="col">
                                <label class="control-label">البريد الالكتروني: </label>
                                    <input value="{{$item->email}}" class="form-control" type="text" name="email"
                                           id="email" disabled/>
                                </div>

                             <div class="col">
                                <label class="control-label">تصنيف المعلم: </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->classification)->title}}" class="form-control" id="classification"
                                           name="classification" disabled>
                                </div>
                            </div><br>



                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes" disabled>
                                        {{$item->notes}}
                                    </textarea>
                                </div>
                            </div><br>

                            <div class="row">
                            <div class="col">
                                      @php
                                          if($tech_active->active == 1){
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
                                    @can('تعديل معلم')
                                    <a href="/CMS/Teacher/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Teacher/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div>



        </div>
    </div>
</div>
<!-- row closed -->
@endcan
    @cannot('عرض معلم')
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
