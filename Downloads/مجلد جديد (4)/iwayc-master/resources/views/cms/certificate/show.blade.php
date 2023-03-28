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
<a class="btn btn-primary btn-md" href="{{ route('Certificate.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض شهادة')
<!-- row -->
<div class="row">

<?php
$redirect="";
if($item->type=="84"){
    $redirect="certificate";
}elseif($item->type=="85"){
    $redirect="sharing";
}elseif($item->type=="86"){
    $redirect="international";
}elseif($item->type=="87"){
    $redirect="appreciation";
}else{
    $redirect="old";
}
?>
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">


                    <div class="row">
                            <div class="col">
                                <label class="control-label">رقم الشهادة: </label>
                                    <input type="text" value="{{$item->uid}}" class="form-control" id="cert_id"
                                           name="cert_id" disabled>
                                </div>
                        <div class="col">
                                <label class="control-label">تصنيف الشهادة: </label>
                                    <input type="hidden" value="{{$item->type}}" id="type_h" name="type_h">
                                    <input type="text" value="{{\App\Models\Option::find($item->type)->title}}" class="form-control" id="type"
                                           name="type" disabled>
                                </div>
                         <div class="col">
                                <label class="control-label"> العام:* </label>
                                    <input type="text" value="{{$item->year}}" class="form-control" id="type"
                                           name="type" disabled>

                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col" id="student_id_d" style="display:none">
                                <label class="control-label">اسم الطالب:* </label>
                                    <?php $ss=\App\Models\Student::find($item->student_id);?>
                                    <input type="text" value="{{$ss->nameAR}} "
                                           class="form-control" id="student_id" name="student_id" disabled>
                                </div>
                      <div class="col"id="student_id_d2" style="display:none">
                                <label class="control-label">اسم الطالب (EN) : </label>
                                    <input type="text" value=" {{$ss->nameEN }}"
                                           class="form-control" id="student_id" name="student_id" disabled>
                                    <div class="text-danger">{{$errors->first('student_id2')}}</div>
                                </div>

                        </div><br>

                        <div class="row" >
                            <div class="col"id="nationality_d" style="display:none">
                                <label class="control-label">الجنسية:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->nationality)->title}}" class="form-control" id="nationality"
                                           name="nationality" disabled>
                                </div>
                         <div class="col"id="place_birth_d" style="display:none">
                                <label class="control-label">مكان الولادة:* </label>
                                    <input type="text" value="{{$item->place_birth?$item->place_birth:""}}" class="form-control" id="place_birth"
                                           name="place_birth" disabled>
                                </div>
                           <div class="col"id="birthday_d" style="display:none">
                                <label class="control-label">سنة الميلاد:* </label>
                                    <input type="text" value="{{$item->year_birth?$item->year_birth:""}}" class="form-control" id="birthday"
                                           name="birthday" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col" id="course_id_d" style="display:none">
                                <label class="control-label">اسم الدورة:* </label>
                                    <input type="text" value="{{$item->course_id?\App\Models\Option::find($item->course_id)->title:""}}"
                                           class="form-control" id="course_id" name="course_id" disabled>
                                </div>
                            <div class="col" id="total_hours_d" style="display:none">
                                <label class="control-label">عدد الساعات:* </label>
                                    <input type="text" value="{{$item->total_hours?$item->total_hours:""}}" class="form-control" id="total_hours"
                                           name="total_hours" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col" id="start_day_d" style="display:none">
                                <label class="control-label">المبتدئة بتاريخ:* </label>
                                    <input type="text" value="{{$item->start_day?\Illuminate\Support\str::limit($item->start_day, 10,''):""}}" class="form-control" id="start_day"
                                           name="start_day" disabled>
                                </div>
                        <div class="col"id="end_day_d" style="display:none">
                                <label class="control-label">المنتهية بتاريخ:* </label>
                                    <input type="text" value="{{$item->end_day?\Illuminate\Support\str::limit($item->end_day, 10,''):""}}" class="form-control" id="end_day"
                                           name="end_day" disabled>
                                </div>

                           <div class="col"id="appreciation_d" style="display:none">
                                <label class="control-label">التقدير:* </label>
                                    <input type="text" value="{{$item->appreciation?\App\Models\Option::find($item->appreciation)->title:""}}" class="form-control" id="appreciation"
                                           name="appreciation" disabled>
                                </div>

                        </div><br>

                        <div class="row" >
                            <div class="col"id="certificate_fees_d" style="display:none">
                                <label class="control-label">رسوم الشهادة:* </label>
                                    <input type="text" value="{{$item->certificate_fees?$item->certificate_fees:""}}" class="form-control" id="certificate_fees"
                                           name="certificate_fees" disabled>
                                </div>
                               <div class="col"id="catch_receipt_id_d" style="display:none">
                                <label class="control-label">رقم سند القبض:* </label>
                                    <input type="text" value="{{$item->catch_receipt_id?$item->catch_receipt_id:""}}" class="form-control" id="catch_receipt_id"
                                           name="catch_receipt_id" disabled>
                                </div>

                        </div><br>

                        <div class="row" >
                            <div class="col"id="release_date_d" style="display:none">
                                <label class="control-label">تاريخ الاصدار:* </label>
                                    <input type="text" value="{{$item->release_date?\Illuminate\Support\str::limit($item->release_date, 10,''):""}}" class="form-control" id="release_date"
                                           name="release_date" disabled>
                                </div>
                              <div class="col" id="student_name_d" style="display:none">
                                <label class="control-label">اسم الطالب / الهيئة :* </label>
                                    <input type="text" value="{{$item->student_name}}" class="form-control validate[required] text-input" id="place_birth"
                                           name="student_name" disabled/ >
                                    <div class="text-danger">{{$errors->first('student_name')}}</div>
                                </div>

                        </div><br>

                        <div class="row" id="description_d" style="display:none">
                            <div class="col">
                                <label class="control-label"> الوصف: </label>
                                    <textarea disabled name="description" style="width: 100%;height: auto;min-height: 150px;">{{$item->description}}</textarea>
                                    <div class="text-danger">{{$errors->first('description')}}</div>
                                </div>
                            </div>
                        </div><br>

                        <div class="row"id="print_execute_d"{{$item->release_date?" hidden":""}}>
                            <div class="col">
                                <label style="font-size:15px" class="col-md-3 control-label" id="print_execute"  name="print_execute">الطباعة: <span class="tag tag-purple"style="font-size:16px">{{$item->print_execute?'تم':'تحت التجهيز'}}</span></label>

                            </div>
                        </div><br>


                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    @can('تعديل شهادة')
                                    <a href="/CMS/Certificate/{{$item->id}}/edit#{{$redirect}}" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Certificate#{{$redirect}}" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>



        </div>
    </div>
</div>
<!-- row closed -->
 @endcan
    @cannot('عرض شهادة')
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

        window.onload = function() {
             var url      = window.location.href;
            var tabs = url.split('#');
            var href = tabs[1];

            cert(href);
        };
        jQuery(document).ready(function($){

            $('#student_id').change(function(){
                var id=$(this).val();
                $.get("/CMS/RStudent/" + id,
                    function(data) {
                        var nameen = $('#nameEN');
                        var nat = $('#nationality');
                        var place = $('#place_birth');
                        var year = $('#year_birth');
                        var nat_h = $('#nationality_h');
                        var place_h = $('#place_birth_h');
                        var year_h = $('#year_birth_h');
                        nameen.empty();
                        nat.empty();
                        place.empty();
                        year.empty();
                        nat_h.empty();
                        place_h.empty();
                        year_h.empty();
                        nameen.val(data.nameEN);
                        nat.val(data.nat_title);
                        place.val(data.place_birth);
                        var y = data.birthday;
                        year.val(y.substr(0,4));
                        nat_h.val(data.nationality);
                        place_h.val(data.place_birth);
                        year_h.val(y.substr(0,4));
                    });
            });
        });
        function cert(href){
             $("#cancel_bt").attr("href", '/CMS/Certificate#'+ href);
            if (href=="certificate"){
                $('select[name=type]').val(84);
                $('input[name=cer_type]').val(84);
                $("#nameen").show();
                $("#student_id_d").show();
                 $("#student_id_d2").show();
                $("#nationality_d").show();
                $("#place_birth_d").show();
                $("#year_birth_d").show();
                $("#course_id_d").show();
                $("#total_hours_d").show();
                $("#start_day_d").show();
                $("#end_day_d").show();
                $("#appreciation_d").show();
                $("#certificate_fees_d").show();
                $("#catch_receipt_id_d").show();
                $("#print_d").show();
                 $.get("/CMS/TypeStudent/84",
                    function(data) {
                        var cert_id = $('#cert_id');
                        cert_id.empty();
                        cert_id.val(data);
                        $('#cert_id').attr('min',data);
                    });
                $.get("/CMS/Section/53",
                function(data) {
                    var model = $('#course_id');
                    model.empty();

                    $.each(data, function(index, element) {
                        model.append("<option value='"+ element.id +"'>" + element.title + "</option>");
                    });
                });

            }
            if (href=="sharing"){
                $('select[name=type]').val(85);
                $('input[name=cer_type]').val(85);
                 $("#nameen").show();
                $("#student_id_d").show();
                 $("#student_id_d2").show();
                $("#nationality_d").show();
                $("#place_birth_d").show();
                $("#year_birth_d").show();
                $("#course_id_d").show();
                $("#total_hours_d").show();
                $("#start_day_d").show();
                $("#end_day_d").show();
                $("#appreciation_d").show();
                $("#certificate_fees_d").show();
                $("#catch_receipt_id_d").show();
                $("#print_d").show();
                $.get("/CMS/TypeStudent/85",
                    function(data) {
                        var cert_id = $('#cert_id');
                        cert_id.empty();
                        cert_id.val(data);
                        $('#cert_id').attr('min',data);
                    });
                $.get("/CMS/Section/360",
                function(data) {
                    var model = $('#course_id');
                    model.empty();

                    $.each(data, function(index, element) {
                        model.append("<option value='"+ element.id +"'>" + element.title + "</option>");
                    });
                });
            }
            if (href=="international"){
                $('input[name=cer_type]').val(86);
                $('select[name=type]').val(86);
                 $("#nameen").show();
                $("#cert_id_d").show();
                $("#student_id_d").show();
                 $("#student_id_d2").show();
                $("#nationality_d").show();
                $("#place_birth_d").hide();
                $("#year_birth_d").show();
                $("#course_id_d").show();
                $("#total_hours_d").show();
                $("#start_day_d").show();
                $("#end_day_d").show();

                $("#print_d").show();
                $.get("/CMS/TypeStudent/86",
                    function(data) {
                        var cert_id = $('#cert_id');
                        cert_id.empty();
                        cert_id.val(data);
                        $('#cert_id').attr('min',data);
                    });
             $.get("/CMS/Section/361",
                function(data) {
                    var model = $('#course_id');
                    model.empty();

                    $.each(data, function(index, element) {
                        model.append("<option value='"+ element.id +"'>" + element.title + "</option>");
                    });
                });
            }
            if (href=="appreciation"){
                $('input[name=cer_type]').val(87);
                $('select[name=type]').val(87);
                $("#cert_id_d").show();
                $("#student_name_d").show();
                $("#description_d").show();
                $("#print_d").show();
                $.get("/CMS/TypeStudent/87",
                    function(data) {
                        var cert_id = $('#cert_id');
                        cert_id.empty();
                        cert_id.val(data);
                        $('#cert_id').attr('min',data);
                    });
            }
            if (href=="old"){
                $('input[name=cer_type]').val(88);
                $('select[name=type]').val(88);
                $("#nameen").show();
                $("#cert_id_d").show();
                $("#student_id_d").show();
                 $("#student_id_d2").show();
                $("#nationality_d").show();
                $("#place_birth_d").show();
                $("#year_birth_d").show();
                $("#course_id_d").show();
                $("#total_hours_d").show();
                $("#start_day_d").show();
                $("#end_day_d").show();
                $("#appreciation_d").show();
                $("#release_date_d").show();

                $.get("/CMS/TypeStudent/88",
                    function(data) {
                        var cert_id = $('#cert_id');
                        cert_id.empty();
                        cert_id.val(data);
                        $('#cert_id').attr('min',data);
                    });
                $.get("/CMS/Section/362",
                function(data) {
                    var model = $('#course_id');
                    model.empty();

                    $.each(data, function(index, element) {
                        model.append("<option value='"+ element.id +"'>" + element.title + "</option>");
                    });
                });
            }
        }
    </script>
@endsection
