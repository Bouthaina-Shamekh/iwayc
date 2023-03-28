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
<a class="btn btn-primary btn-md" href="{{ route('AbsenceS.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه اذن جديد لطالب</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('AbsenceS.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض اذن طالب')
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
                    <div class="">
                          <div class="row">
                            <div class="col">
                                <label class="control-label">التاريخ:* </label>

                                    <input type="text" value="{{$item->date}}" class="form-control datepicker" id="date"
                                           name="date" disabled>
                                </div>
                           <div class="col">
                                <label class="control-label">اسم الطالب والدورة المسجلة:* </label>
                                    <input type="text" value="{{\App\Models\Student::find(\App\Models\Student_course::find($item->student_course_id)->student_id)->nameAR}} - {{\App\Models\Course::find(\App\Models\Student_course::find($item->student_course_id)->course_id)->courseAR}}" class="form-control" id="student_course_id"
                                           name="student_course_id" disabled>
                        </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">النوع:* </label>
                                    <input type="text" value="{{$item->type?'تأخير':'غياب'}}" class="form-control" id="type"
                                           name="type" disabled>
                                </div>
                        <div class="col"id="delay_time_d" style="display:none">
                                <label class="control-label">مدة التأخير:* </label>
                                <div class="col-md-9">
                                    <input type="text" value="{{$item->delay_time}}" class="form-control text-input"
                                           id="delay_time" name="delay_time" disabled>
                                </div><strong style="font-size: 22px" class="col-md-1 text-left">دقيقة</strong>
                        </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">عدد مرات التأخير* </label>
                                    <input type="number" value="{{$absencesss}}" class="form-control" id="type"
                                           name="type" disabled>
                                </div>

                                <div class="col">

                                    <label class="control-label">اوقات التاخير بالساعات*</label>
                                    <input type="number" value="{{$hour_absencesss}}" class="form-control" id="type" name="type" disabled>

                                    </div>

                                <div class="col"id="delay_time_d" >
                                    <label class="control-label">عدد ايام الغياب* </label>
                                    <div class="col-md-9">
                                  <input type="number" value="{{$absencess}}" class="form-control text-input"
                                               id="delay_time" name="delay_time" disabled>
                                    </div>
                            </div>


                            </div><br>



                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                <div class="col-md-10 ls-group-input">
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>
                            </div>
                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-sm-10">
                                    @can('تعديل اذن طالب')
                                    <a href="/CMS/AbsenceS/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/AbsenceS/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>


        </div>
    </div>
</div>
<!-- row closed -->
@endcan

    @cannot('عرض اذن طالب')
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
