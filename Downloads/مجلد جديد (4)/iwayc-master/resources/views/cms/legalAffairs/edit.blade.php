@extends('layouts.master')
@section('css')
@section('title')
Iwayc System

@endsection

@section('title-page-header')
{{ $title }}

@endsection
@section('page-header')
{{ $subtitle }}

@endsection
@section('button1')
<a class="btn btn-primary btn-md" href="{{ route('Student.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه طالب جديد </a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Student.index') }}">رجوع</a>
@stop
@endsection
@section('content')
    @can('تعديل شؤون قانونية')


<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


        <div class="card">
        <div class="card-body">
<form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/LegalAffairs/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الطالب:* </label>
                                    <input type="hidden" value="{{$item->student_course_id}}" name="student_course_id_h" id="student_course_id_h">
                                    <input type="text" value="{{\App\Models\Student::find(\App\Models\Student_course::find($item->student_course_id)->student_id)->nameAR}} - {{\App\Models\Course::find(\App\Models\Student_course::find($item->student_course_id)->course_id)->courseAR}}" class="form-control validate[required] text-input" id="student_course_id"
                                           name="student_course_id" disabled>
                                    <div class="text-danger">{{$errors->first('student_course_id_h')}}</div>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">المبلغ المستحق:* </label>
                                    <input type="hidden" value="{{$item->fees_owed}}" name="fees_owed_h" id="fees_owed_h">
                                    <input type="text" value="{{$item->fees_owed}}" class="form-control validate[required] text-input" id="fees_owed"
                                           name="fees_owed" disabled>
                                    <div class="text-danger">{{$errors->first('fees_owed_h')}}</div>
                                </div>
                          <div class="col">
                                <label class="control-label">عدد ايام التأخير:* </label>
                                    <input type="hidden" value="{{$item->count_day}}" name="count_day_h" id="count_day_h">
                                    <input type="text" value="{{$item->count_day}}" class="form-control validate[required] text-input" id="count_day"
                                           name="count_day" disabled>
                                    <div class="text-danger">{{$errors->first('count_day_h')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">غرامة اليوم:* </label>
                                    <input type="text" value="{{$item->fine_day?$item->fine_day:0}}" class="form-control validate[required] text-input" id="fine_day"
                                           name="fine_day">
                                    <div class="text-danger">{{$errors->first('fine_day')}}</div>
                                </div>
                           <div class="col">
                                <label class="control-label">غرامة التأخير:* </label>
                                    <input type="hidden" value="{{$item->fine_delay}}" name="fine_delay_h" id="fine_delay_h">
                                    <input type="text" value="{{$item->fine_delay?$item->fine_delay:0}}" class="form-control validate[required] text-input" id="fine_delay"
                                           name="fine_delay" disabled>
                                    <div class="text-danger">{{$errors->first('fine_delay_h')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المبلغ الكلي المستحق:* </label>
                                    <input type="hidden" value="{{$item->total_amount}}" name="total_amount_h" id="total_amount_h">
                                    <input type="text" value="{{$item->total_amount}}" class="form-control validate[required] text-input" id="total_amount"
                                           name="total_amount" disabled>
                                    <div class="text-danger">{{$errors->first('total_amount')}}</div>
                                </div>

                           <div class="col">
                                <label class="control-label">الحالة:* </label>
                                    <select name="status" id="type" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($type as $t)
                                            <option {{$item->status==$t->id?"selected":""}} value="{{$t->id}}"> {{$t->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('status')}}</div>
                                </div>
                        </div><br>
                        {{--<div class="row">
                            <div class="col">
                                <label class="control-label">الضمان:* </label>
                                    <input type="text" value="{{$item->warranty}}" class="form-control validate[required] text-input" id="warranty"
                                           name="warranty">
                                    <div class="text-danger">{{$errors->first('warranty')}}</div>
                                </div>
                            </div>
                        </div>--}}

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{$item->notes}}</textarea>
                                </div>
                        </div><br>

                        <div class="row last">
                            <div class="col-12 text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-12">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/LegalAffairs/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('تعديل شؤون قانونية')
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
 <script>
        function fSum() {
            var count_day = parseFloat($("#count_day").val());
            var fine_day = parseFloat($("#fine_day").val());
            var fees_owed = parseFloat($("#fees_owed").val());
            var fine_delay = count_day * fine_day;
            var total_amount = fine_delay + fees_owed;
            $("#fine_delay").val(fine_delay);
            $("#fine_delay_h").val(fine_delay);
            $("#total_amount").val(total_amount);
            $("#total_amount_h").val(total_amount);
        }
        window.onload = function() {
            fSum();
        };
        $('#fine_day').change(function() {
            fSum();
        });
    </script>
@endsection
