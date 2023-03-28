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
@can('تعديل دورة')

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
        <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Course/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الدورة/عربي:* </label>
                                    <input type="text" value="{{$item->courseAR}}" class="form-control validate[required] text-input" id="courseAR"
                                           name="courseAR" placeholder="أدخل اسم الدورة/عربي">
                                    <div class="text-danger">{{$errors->first('courseAR')}}</div>
                                </div>
                        <div class="col">
                                <label class="control-label">اسم الدورة/انجليزي: </label>
                                    <input type="text" value="{{$item->courseEN}}" class="form-control validate[required] text-input" id="courseEN"
                                           name="courseEN" placeholder="أدخل اسم الدورة/انجليزي">
                                    <div class="text-danger">{{$errors->first('courseEN')}}</div>
                        </div>
                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">تصنيف الدورة:* </label>
                                    <select name="course_cate" id="course_cate" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($categories as $category)
                                            <option {{$item->category_id==$category->id?"selected":""}} value="{{$category->id}}"> {{$category->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('course_cate')}}</div>
                                </div>


                        </div><br><br>

                        <div class="row">
                         <div class="col">
                                <label class="control-label">مدة الدورة بالساعات:* </label>
                                    <input type="number" value="{{$item->course_time!=null?$item->course_time:0}}" class="form-control validate[required] text-input" id="course_time"
                                           name="course_time" placeholder="أدخل مدة الدورة بالساعات">
                                    <div class="text-danger">{{$errors->first('course_time')}}</div>
                                </div>
                            <div class="col">
                                <label class="control-label">تاريخ بداية الدورة: </label>
                                    <input type="text" min="{{date('Y-m-d')}}" value="{{\Carbon\Carbon::parse($item->begin)->format('Y-m-d')}}" class="form-control fc-datepicker" id="begin"
                                           name="begin">
                                    <div class="text-danger">{{$errors->first('begin')}}</div>
                                </div>

                        </div><br><br>

                        <div class="row">

                           <div class="col">
                                <label class="control-label">رسوم التسجيل:* </label>
                                    <input type="number" step="any" value="{{$item->reg_fees!=null?$item->reg_fees:0}}" class="form-control text-input" id="reg_fees"
                                           name="reg_fees" placeholder="أدخل رسوم التسجيل">
                                    <div class="text-danger">{{$errors->first('reg_fees')}}</div>
                                </div>
                            <div class="col">
                                <label class="control-label">رسوم المقررات:* </label>
                                    <input type="number" step="any" value="{{$item->decisions_fees!=null?$item->decisions_fees:0}}" class="form-control text-input" id="decisions_fees"
                                           name="decisions_fees" placeholder="أدخل رسوم المقررات">
                                    <div class="text-danger">{{$errors->first('decisions_fees')}}</div>
                                </div>


                        </div><br><br>

                        <div class="row">
                           <div class="col">
                                <label class="control-label">رسوم الدورة:* </label>
                                    <input type="number" step="any" value="{{$item->course_fees!=null?$item->course_fees:0}}" class="form-control text-input" id="course_fees"
                                           name="course_fees" placeholder="ادخل رسوم الدورة">
                                    <div class="text-danger">{{$errors->first('course_fees')}}</div>
                            </div>
                            <div class="col">
                                <label class="control-label">الرسوم النهائية:* </label>
                                    <input type="hidden" value="" id="total_fees_h" name="total_fees_h">
                                    <input type="number" step="any" value="{{$item->total_fees!=null?$item->total_fees:0}}" class="form-control text-input" id="total_fees"
                                           name="total_fees" placeholder="أدخل الرسوم النهائية" readonly>
                                    <div class="text-danger">{{$errors->first('total_fees')}}</div>
                                </div>


                        </div><br><br>

                        <div class="row">
                             <div class="col">
                                <label class="control-label">المعلم:* </label>
                                    <select name="teacher_id" id="teacher_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($teachers as $teacher)
                                            <option {{$item->teacher_id==$teacher->id?"selected":""}} value="{{$teacher->id}}"> {{$teacher->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('teacher_id')}}</div>
                                </div>
                            <div class="col">
                                <label class="control-label">نوع نسبة المعلم:* </label>
                                    <select name="ratio_type" id="ratio_type" class="form-control">
                                        @foreach($ratios as $ratio)
                                            <option {{$item->ratio_type==$ratio->id?"selected":""}} value="{{$ratio->id}}"> {{$ratio->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('ratio_type')}}</div>
                                </div>

                        </div><br><br>
                        <div class="row" >
                            <div class="col"id="teacher_fees_sec">
                                <label class="control-label">الرسوم المتفق عليها مع المعلم:* </label>
                                    <input type="number" step="any" value="{{$item->teacher_fees!=null?$item->teacher_fees:0}}" class="form-control text-input" id="teacher_fees"
                                           name="teacher_fees" placeholder="أدخل الرسوم المتفق عليها مع المعلم">
                                    <div class="text-danger">{{$errors->first('teacher_fees')}}</div>
                                </div>

                         <div class="col"id="percentage_sec">
                                <label class="control-label">نسبة المعلم:* </label>
                                 <div class="row">
                                <div class="col-10">
                                    <input type="number" step="0.01" value="{{$item->percentage?$item->percentage:0}}" class="form-control text-input" id="percentage"
                                           name="percentage" placeholder="أدخل نسبة المعلم">
                                    <div class="text-danger">{{$errors->first('percentage')}}</div>
                                </div>
                                <div class="col">
                                <strong style="font-size: 26px" class="col-md-1">%</strong>
                           </div>
                        </div>
                        </div>
                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">القيمة:* </label>
                                    <input type="hidden" value="{{$item->value_sum}}" id="value_sum_h" name="value_sum_h">
                                    <input type="number" step="any" value="{{$item->value_sum}}" class="form-control text-input" id="value_sum"
                                           name="value_sum" placeholder="أدخل القيمة" disabled>
                                    <div class="text-danger">{{$errors->first('value_sum')}}</div>
                                </div>

                     <div class="col">
                                <label class="control-label">تقييم المعلم:* </label>
                                 <div class="row">
                                <div class="col-10">
                                    <input type="number" min="0" value="{{$item->ratio?$item->ratio:0}}" class="form-control text-input" id="ratio"
                                           name="ratio" placeholder="أدخل تقييم المعلم">
                                    <div class="text-danger">{{$errors->first('ratio')}}</div>
                                </div>
                                <div class="col">
                                <strong style="font-size: 26px" class="col-md-1">%</strong>
                                </div>
                        </div>
                        </div>
                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{$item->notes}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>
                        </div><br><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-sm-10">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Course/" class="btn btn-default"> إلغاء</a>
                                </div>
                            </div>
                        </div><br><br>

                    </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endcan

    @cannot('تعديل دورة')
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
            teacher_type();
            fSum();
        };
        $('#reg_fees').change(function() {
            fSum();
            fRatio();
        });
        $('#decisions_fees').change(function() {
            fSum();
            fRatio();
        });
        $('#course_fees').change(function() {
            fSum();
            fRatio();
        });
        function fRatio() {
            var teacher_fees = parseFloat($("#teacher_fees").val());
            var ratio_type = $('select[name=ratio_type]').val();
            var percentage = parseFloat($("#percentage").val());
            var ratio = 0;
            if (ratio_type == 29){
                ratio = teacher_fees / 100;
                ratio = ratio * percentage;
                $("#value_sum_h").val(ratio);
                $("#value_sum").val(ratio);
            }

        }
        $('#ratio_type').change(function() {
            fSum();
            fRatio();
            teacher_type();
        });
        $('#teacher_fees').change(function() {
            fSum();
            fRatio();
        });
        $('#percentage').change(function() {
            fSum();
            fRatio();
        });

        function teacher_type(){
            if ($('select[name=ratio_type]').val()=="29"){
                $("#teacher_fees_sec").show();
                $("#percentage_sec").show();
                $("#value_sum").attr("disabled",true);
            }
            if ($('select[name=ratio_type]').val()=="18" || $('select[name=ratio_type]').val()=="15"){
                $("#teacher_fees_sec").hide();
                $("#percentage_sec").hide();
                $("#value_sum").attr("disabled",false);
            }
        }
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
