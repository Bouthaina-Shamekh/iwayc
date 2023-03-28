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
<a class="btn btn-primary btn-md" href="{{ route('ReceiptCourse.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافة سند صرف جديد</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('ReceiptCourse.index') }}">رجوع</a>
@stop
@endsection
@section('content')

  @can('تعديل صرف دورة')
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">

        <div class="card">
        <div class="card-body">
    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/ReceiptCourse/{{$item->id}}">
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

                         <div class="col">
                                <label class="control-label">تاريخ السند الورقي:* </label>
                                    <input type="text" value="{{$item->date}}" class="form-control fc-datepicker" id="date"
                                           name="date">
                                    <div class="text-danger">{{$errors->first('date')}}</div>
                                </div>


                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">السنة المالية:* </label>
                                    <select name="m_year" id="m_year" class="form-control">
                                        @foreach($moneyYears as $moneyYear)
                                            <option {{$item->m_year==$moneyYear->year?"selected":""}} value="{{$moneyYear->year}}"> {{$moneyYear->year}} </option>
                                        @endforeach

                                    </select>
                                    <div class="text-danger">{{$errors->first('m_year')}}</div>
                                </div>

                           <div class="col">
                                <label class="control-label">معلم الدورة:* </label>
                                    <select name="course_id" id="course_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($courses as $course)
                                            <option {{$item->course_id==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->courseAR}} - {{\App\Models\Teacher::find($course->teacher_id)->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('course_id')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">نصيب المعلم من التحصيل:* </label>
                                    <input type="hidden" value="" name="teacher_ratio_h" id="teacher_ratio_h">
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->teacher_ratio}}" class="form-control validate[required] text-input" id="teacher_ratio"
                                           name="teacher_ratio" disabled>
                                    <div class="text-danger">{{$errors->first('teacher_ratio')}}</div>
                                </div>
                           <div class="col">
                                <label class="control-label">مقبوضات المعلم من الدورة</label>
                                    <input type="hidden" value="" name="teacher_pay_h" id="teacher_pay_h">
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->teacher_pay}}" class="form-control validate[required] text-input" id="teacher_pay"
                                           name="teacher_pay" disabled>
                                    <div class="text-danger">{{$errors->first('teacher_pay')}}</div>
                                </div>

                        <div class="col">
                                <input type="hidden" value="" name="remainder_h" id="remainder_h">
                                <label class="control-label">باقي نصيب المعلم من التحصيل:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->remainder}}" class="form-control validate[required] text-input" id="remainder"
                                           name="remainder" disabled>
                                    <div class="text-danger">{{$errors->first('remainder')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->amount}}" class="form-control validate[required] text-input" id="amount"
                                           name="amount" placeholder="أدخل المبلغ">
                                    <div class="text-danger">{{$errors->first('amount')}}</div>
                                </div>
                          <div class="col">
                                <label class="control-label">طريقة الدفع:* </label>
                                    <select name="pay_h" id="pay_h" class="form-control">
                                        <option {{$item->cheque_info==null?"selected":""}} value="0"> نقدي </option>
                                        <option {{$item->cheque_info!=null?"selected":""}} value="1"> شيك </option>
                                    </select>
                                </div>

                        <div class="col" id="cheque">
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
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-10">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/ReceiptCourse/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('تعديل صرف دورة')
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

            var id = $('select[name=course_id]').val();
            $.ajax({
                url: "/CMS/RTeacher/" + id,
                success: function (data) {
                    if (data.status==1){
                        $('#teacher_ratio').val(data.value_sum);
                        $('#teacher_pay').val(data.total_amount);
                        $('#remainder').val(data.total_remaind);
                        $('#teacher_ratio_h').val(data.value_sum);
                        $('#teacher_pay_h').val(data.total_amount);
                        $('#remainder_h').val(data.total_remaind);
                    }
                    else{alert('حدث خطأ اثناء تنفيذ العملية');}
                }

            });
        };
        $('#money_id').change(function(){
            if ($(this).val()!='0') {
                $.get("/CMS/ReceiptCourseFilter/",
                    function(data) {
                        var model = $('#course_id');
                        model.empty();
                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.courseAR+"-"+element.teacher_id + "</option>");
                        });
                    });
            }
        });
        $('#course_id').change(function() {
            if($(this).val()!='0'){
                var id = $('select[name=course_id]').val();
                $.ajax({
                    url: "/CMS/RTeacher/" + id,
                    success: function (data) {
                        if (data.status==1){
                            $('#teacher_ratio').val(data.value_sum);
                            $('#teacher_pay').val(data.total_amount);
                            $('#remainder').val(data.total_remaind);
                            $('#teacher_ratio_h').val(data.value_sum);
                            $('#teacher_pay_h').val(data.total_amount);
                            $('#remainder_h').val(data.total_remaind);
                        }
                        else{alert('حدث خطأ اثناء تنفيذ العملية');}
                    }

                })
            }
        });
    </script>

    <!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
@endsection
