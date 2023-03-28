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
<a class="btn btn-primary btn-md" href="{{ route('AbsenceT.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('اضافة  تسجيل بالدورة')

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
                    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/StudentCourse">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">الدورة:* </label>
                                    <input type="hidden" value="{{$id}}" name="course_h">
                                    <input type="hidden" value="{{$userL>0?$uY:$moneyWork->year}}" id="edu_year_h" name="edu_year_h">
                                    <input type="text" value="{{$item->courseAR}}" class="form-control" id="course_id"
                                           name="course_id" disabled>
                                           <div class="text-danger">{{$errors->first('course_h')}}</div>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">الطالب:* </label>
                                    <select name="student_id" id="student_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($s as $student)
                                            <option {{old("student_id")==$student?"selected":""}} value="{{$student}}"> {{\App\Models\Student::find($student)->nameAR}} </option>
                                        @endforeach
                                    </select>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">سعر الدورة:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->total_fees}}" class="form-control validate[required] text-input" id="price"
                                           name="price" placeholder="أدخل سعر الدورة">
                                    <div class="text-danger">{{$errors->first('price')}}</div>
                                </div>

                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-sm-10">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/StudentCourse/" class="btn btn-danger"> إلغاء</a>
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

@cannot('اضافة  تسجيل بالدورة')
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
