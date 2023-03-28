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
 @can('اضافة قبض دورة')
<a class="btn btn-primary btn-md" href="{{ route('CatchReceipt.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة سند قبض جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('CatchReceipt.index') }}">رجوع</a>
@stop
@endsection
@section('content')

  @can('تعديل قبض دورة')
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


        <div class="card">
        <div class="card-body">
   <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/CatchReceipt/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">رقم السند الحاسوبي:* </label>
                                    <input type="number" min="{{$item->id}}" value="{{$item->id}}" class="form-control validate[required] text-input" id="id"
                                           name="id">
                                    <div class="text-danger">{{$errors->first('id')}}</div>
                                </div>

                               <div class="col">
                                <label class="control-label">رقم السند الورقي:* </label>
                                    <input type="number" min="0" value="{{$item->id_comp}}" class="form-control validate[required] text-input" id="id_comp"
                                           name="id_comp">
                                    <div class="text-danger">{{$errors->first('id_comp')}}</div>
                                </div>



                        </div><br>

                        <div class="row">

                          <div class="col">
                                <label class="control-label">تاريخ السند الورقي:* </label>
                                    <input type="text" value="" class="form-control datepicker" id="date"
                                           name="date">
                                    <div class="text-danger">{{$errors->first('date')}}</div>
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
                                <label class="control-label">اسم الطالب والدورة المسجلة:* </label>
                                    <select name="student_course_id" id="student_course_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($student_courses as $student_course)
                                            <option {{$item->student_course_id==$student_course->id?"selected":""}} value="{{$student_course->id}}">
                                                {{\App\Models\Student::find($student_course->student_id)->nameAR}} - {{\App\Models\Course::find($student_course->course_id)->courseAR}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('student_course_id')}}</div>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">المبلغ المتبقي علي الدورة:* </label>
                                    <input type="hidden" value="{{$item->remainder}}" id="remainder_h" name="remainder_h">
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" value="{{$item->remainder}}" class="form-control validate[required] text-input" id="remainder"
                                           name="remainder" disabled>
                                    <div class="text-danger">{{$errors->first('remainder_h')}}</div>
                                </div>

                           <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" value="{{$item->amount}}" class="form-control validate[required] text-input" id="amount"
                                           name="amount" placeholder="أدخل المبلغ">
                                    <div class="text-danger">{{$errors->first('amount')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">طريقة الدفع:* </label>
                                    <select name="pay_h" id="pay_h" class="form-control">
                                        <option {{$item->cheque_info==null?"selected":""}} value="0"> نقدي </option>
                                        <option {{$item->cheque_info!=null?"selected":""}} value="1"> شيك </option>
                                    </select>
                                </div>

                            <div class="col"id="cheque">
                                <label class="control-label">معلومات الشيك:* </label>
                                    <textarea class="animatedTextArea form-control" id="cheque_info" name="cheque_info"
                                              placeholder="أدخل معلومات الشيك">{{$item->cheque_info}}</textarea>
                                    <div class="text-danger">{{$errors->first('cheque_info')}}</div>
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

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/CatchReceipt/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('تعديل قبض دورة')
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
        jQuery(document).ready(function($){
            $('#student_course_id').change(function(){
                var id=$(this).val();
                $.get("/CMS/RStudentCourse/" + id,
                    function(data) {
                        var rem_h = $('#remainder_h');
                        var rem = $('#remainder');
                        rem_h.empty();
                        rem.empty();
                        rem_h.val(data.remainder_d);
                        rem.val(data.remainder_d);
                    });
            });
        });

        $('#pay_h').change(function() {
            if ($('select[name=pay_h]').val()=="0"){
                $("#cheque").hide();
            }
            if ($('select[name=pay_h]').val()=="1"){
                $("#cheque").show();
            }
        });

        window.onload = function() {
            if ($('select[name=pay_h]').val()=="0"){
                $("#cheque").hide();
            }
            if ($('select[name=pay_h]').val()=="1"){
                $("#cheque").show();
            }
            $(".datepicker").val('{{$item->date}}');
        };
    </script>
@endsection
