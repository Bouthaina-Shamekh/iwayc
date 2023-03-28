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
<a class="btn btn-primary btn-md" href="{{ route('Course.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة دورة جديدة </a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Course.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض دورة')
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
                                <label class="control-label">اسم الدورة/عربي:* </label>
                                    <input type="text" value="{{$item->courseAR}}" class="form-control" id="courseAR"
                                           name="courseAR" disabled>
                                </div>

                        <div class="col" style="display:none;" {{$item->courseEN == null?"style=display:none;":""}}>
                                <label class="control-label">اسم الدورة/انجليزي:* </label>
                                    <input type="text" value="{{$item->courseEN}}" class="form-control" id="courseEN"
                                           name="courseEN" disabled>
                        </div>
                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">تصنيف الدورة: </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->category_id)->title}}" class="form-control" id="course_cate"
                                           name="course_cate" disabled>
                                </div>

                            <div class="col">
                                <label class="control-label">السنة الدراسية والمالية:* </label>
                                    <input type="text" value="{{$item->m_year}}" class="form-control" id="edu_year"
                                           name="edu_year" disabled>
                            </div>

                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">مدة الدورة بالساعات:* </label>
                                    <input type="text" value="{{$item->course_time}}" class="form-control" id="course_time"
                                           name="course_time" disabled>
                                </div>
                            <div class="col">
                                <label class="control-label">تاريخ بداية الدورة:* </label>
                                <input type="text" value="{{$item->begin}}" class="form-control" id="begin"
                                           name="begin" disabled>
                            </div>

                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">رسوم التسجيل:* </label>
                                    <input type="text" value="{{$item->reg_fees}}" class="form-control" id="reg_fees"
                                           name="reg_fees" disabled>
                            </div>
                            <div class="col">
                                <label class="control-label">رسوم المقررات:* </label>
                                <input type="text" value="{{$item->decisions_fees}}" class="form-control" id="decisions_fees"
                                           name="decisions_fees" disabled>
                            </div>

                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">رسوم الدورة:* </label>
                                    <input type="text" value="{{$item->course_fees}}" class="form-control" id="course_fees"
                                           name="course_fees" disabled>
                                </div>
                          <div class="col">
                                <label class="control-label">الرسوم النهائية:* </label>
                                    <input type="text" value="{{$item->total_fees}}" class="form-control" id="total_fees"
                                           name="total_fees" disabled>
                                </div>

                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المعلم:* </label>
                                    <input type="text" value="{{\App\Models\Teacher::find($item->teacher_id)->name}}" class="form-control" id="teacher_id"
                                           name="teacher_id" disabled>
                                </div>
                             <div class="col">
                                <label class="control-label">نوع نسبة المعلم: </label>
                                    <input type="hidden" value="{{$item->ratio_type}}" id="ratio_type_h" name="ratio_type_h">
                                    <input type="text" value="{{\App\Models\Option::find($item->ratio_type)->title}}" class="form-control" id="ratio_type"
                                           name="ratio_type" disabled>
                                </div>

                        </div><br><br>

                        <div class="row">
                            <div class="col" id="teacher_fees_sec">
                                <label class="control-label">الرسوم المتفق عليها مع المعلم: </label>
                                <input type="text" value="{{$item->teacher_fees}}" class="form-control" id="teacher_fees"
                                           name="teacher_fees" disabled>
                                </div>
                      <div class="col" id="percentage_sec">
                                <label class="control-label">نسبة المعلم: </label>
                                 <div class="row">
                                <div class="col-10">
                                    <input type="text" value="{{$item->percentage}}" class="form-control" id="percentage"name="percentage" disabled>
                                </div>
                                <div class="col">
                                <strong style="font-size: 26px" class="col-md-1">%</strong>
                            </div>
                        </div>
                        </div>
                        </div>
                             @php
                                 if($item->percentage == null){

                                 }else{
                                    echo "<br><br>";
                                 }
                             @endphp
                        <div class="row">
                            <div class="col">
                                <label class="control-label">القيمة:* </label>
                                    <input type="text" value="{{$item->value_sum}}" class="form-control text-input" id="value_sum"name="value_sum" disabled>
                                </div>

                        </div><br><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">عدد الطلاب المسجلين:* </label>
                                    <input type="text" value="{{$item->total_reg_student}}" class="form-control" id="total_reg_student"
                                           name="total_reg_student" disabled>
                                </div>

                        </div><br><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">عدد الطلاب المنسحبين:* </label>
                                    <input type="text" value="{{$item->total_withdrawn_student}}" class="form-control" id="total_withdrawn_student"
                                           name="total_withdrawn_student" disabled>
                                </div>

                             <div class="col">
                                <label class="control-label">تقييم المعلم: </label>
                            <div class="row">
                                <div class="col-10">
                                    <input type="text" value="{{$item->ratio}}" class="form-control" id="ratio"
                                           name="ratio" disabled>
                                </div>
                                  <div class="col">
                                <strong style="font-size: 26px" class="col-md-1">%</strong>
                            </div>
                            </div>
                        </div>
                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات:* </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col-2">
                                <label class="control-label">فعال: </label>
                                    <input type="text" value="{{$item->active?"فعال":"غير فعال"}}" class="form-control" id="active"name="active" disabled>
                                </div>
                        </div><br><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-sm-10">
                                    @can('تعديل دورة')
                                    <a href="/CMS/Course/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Course/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br><br>


        </div>
    </div>
</div>
<!-- row closed -->
@endcan
@cannot('عرض دورة')
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
            var reg_fees = parseFloat($("#reg_fees").val());
            var decisions_fees = parseFloat($("#decisions_fees").val());
            var course_fees = parseFloat($("#course_fees").val());
            var total_fees = reg_fees + decisions_fees + course_fees;
            $("#total_fees").val(total_fees);
            $("#total_fees_h").val(total_fees);
        }
        window.onload = function() {
            /*fSum();
            fRatio();*/
            teacher_type();
        };
        function fRatio() {
            var teacher_fees = parseFloat($("#teacher_fees").val());
            var ratio_type = $('select[name=ratio_type]').val();
            var percentage = parseFloat($("#percentage").val());
            var ratio = 0;
            if (ratio_type == 29){
                ratio = teacher_fees / 100;
                ratio = ratio * percentage;
            }
            $("#value_sum_h").val(ratio);
            $("#value_sum").val(ratio);
        }

        function teacher_type(){
            if ($('#ratio_type_h').val()=="29"){
                $("#teacher_fees_sec").show();
                $("#percentage_sec").show();
                $("#value_sum").attr("disabled",true);
            }
            if ($('#ratio_type_h').val()=="18" || $('#ratio_type_h').val()=="15"){
                $("#teacher_fees_sec").hide();
                $("#percentage_sec").hide();
                $("#value_sum").attr("disabled",true);
            }
        }
    </script>
@endsection
