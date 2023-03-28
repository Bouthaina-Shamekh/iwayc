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
<a class="btn btn-primary btn-md" href="{{ route('AbsenceT.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه اذن جديد لمعلم</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('StudentCourse.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('تعديل تسجيل  بالدورة')


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
       <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/StudentCourse/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">الطالب : </label>
                                    <input type="text" value="{{\App\Models\Student::find($item->student_id)->nameAR}} " class="form-control text-input" id="student_course_id"
                                           name="student_course_id" disabled>
                                           <div class="text-danger">{{$errors->first('student_course_id')}}</div>
                                </div>
                                 <div class="col">
                                <label class="control-label">السنة المالية:* </label>
                                    <select name="m_year" id="m_year" class="form-control">
                                        @foreach($moneyYears as $moneyYear)
                                            <option {{$item->m_year==$moneyYear->year?"selected":""}} value="{{$moneyYear->year}}"> {{$moneyYear->year}} </option>
                                        @endforeach

                                    </select>
                                    <div class="text-danger">{{$errors->first('m_year')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label"> اسم الدورة:* </label>
                                    <select name="course_id" id="course_id" class="form-control">
                                        @foreach($courses as $course)
                                            <option {{$course->id==$item->course_id?"selected":""}} value="{{$course->id}}"> {{$course->courseAR}} </option>
                                        @endforeach

                                    </select>
                                    <div class="text-danger">{{$errors->first('course_id')}}</div>
                                </div>

                                  <div class="col">
                                <label class="control-label">سعر الدورة:* </label>


                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->price}}" class="form-control validate[required] text-input" id="price"
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
                        </div>

                    </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endcan

@can('تعديل تسجيل  بالدورة')
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
