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
<a class="btn btn-primary btn-md" href="{{ route('CollectionFees.index') }}">رجوع</a>
@stop
@endsection

@section('content')
   @can('عرض متابعة طلاب')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
  <form id="formID" class="formular form-horizontal ls_form">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الدورة:* </label>
                                    <input type="text" value="{{\App\Models\Course::find(\App\Models\Student_course::find($item->student_course_id)->course_id)->courseAR}}" class="form-control" id="courseAR"
                                           name="courseAR" disabled>
                                </div>

                                 <div class="col">
                                <label class="control-label">اسم الطالب:* </label>
                                    <input type="text" value="{{\App\Models\Student::find(\App\Models\Student_course::find($item->student_course_id)->student_id)->nameAR}}" class="form-control" id="courseEN"
                                           name="courseEN" disabled>
                                </div>

                                   <div class="col">
                                <label class="control-label">الهواتف:* </label>
                                    <input type="text" value="{{$item->phone}}" class="form-control" id="edu_year"
                                           name="edu_year" disabled>
                                </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الرسوم:* </label>
                                    <input type="text" value="{{$item->fees}}" class="form-control" id="course_time"
                                           name="course_time" disabled>
                                </div>
                                 <div class="col">
                                <label class="control-label">المدفوع:* </label>
                                    <input type="text" value="{{$item->fees_pay}}" class="form-control" id="begin"
                                           name="begin" disabled>
                                </div>
                                <div class="col">
                                <label class="control-label">المستحق:* </label>
                                    <input type="text" value="{{$item->fees_owed}}" class="form-control" id="reg_fees"
                                           name="reg_fees" disabled>
                                </div>

                        </div>

                        {{--<div class="row">
                            <div class="col">
                                <label class="control-label">الضمان:* </label>

                                    <input type="text" value="{{$item->warranty==1?'':}}" class="form-control" id="decisions_fees"
                                           name="decisions_fees" disabled>
                                </div>
                            </div>
                        </div>--}}
                        <div class="row">
                            <div class="col">
                                <label class="control-label">مرات المطالبة:* </label>
                                    <input type="text" value="{{$item->count}}" class="form-control" id="course_fees"
                                           name="course_fees" disabled>
                                </div>
                                  <div class="col">
                                <label class="control-label">التهرب:* </label>
                                    <input type="text" value="{{$item->evasion==0?'لا':'نعم'}}" class="form-control" id="total_fees"
                                           name="total_fees" disabled>
                                </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الملاحظات:* </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>

                        </div>

                        <div class="row last">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <label class="control-label"></label>

                                <div class="col-sm-10">
                                    @can('تعديل متابعة طلاب')
                                    <a href="/CMS/CollectionFees/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/CollectionFees/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div>

                    </form>


        </div>
    </div>
</div>
<!-- row closed -->
    @endcan
    @cannot('عرض متابعة طلاب')
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
