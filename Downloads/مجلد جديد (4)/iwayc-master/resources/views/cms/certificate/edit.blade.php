@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
<a class="btn btn-primary btn-md" href="{{ route("Archive.create") }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه موظف جديد </a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Archive.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('تعديل شهادة')


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
<form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Certificate/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" value="" name="cer_type" />
                        <div class="row">
                            <div class="col">
                                <label class="control-label">تصنيف الشهادة:* </label>
                                    <select name="type" id="type" class="form-control" disabled>
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($types as $type)
                                            <option {{$item->type==$type->id?"selected":""}} value="{{$type->id}}"> {{$type->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('type')}}</div>
                                </div>
                            <div class="col" id="cert_id_d">
                                <label class="control-label">رقم الشهادة:* </label>
                                    <input type="number" value="{{$item->uid}}" class="form-control validate[required] text-input" id="cert_id"
                                           name="cert_id" placeholder="أدخل رقم الشهادة" min="">
                                    <div class="text-danger">{{$errors->first('cert_id')}}</div>
                                </div>
                          <div class="col">
                                <label class="control-label"> العام:* </label>
                                    <select name="year" id="year" class="form-control" >
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($years as $year)
                                            <option {{old('year',$item->year)==$year->title?"selected":""}} value="{{$year->title}}"> {{$year->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('year')}}</div>
                                </div>

                        </div><br>


                        <div class="row" >
                            <div class="col"id="student_id_d" style="display:none">
                                <label class="control-label"> اسم الطالب (ع):* </label>
                                    <select name="student_id" id="student_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($students as $student)
                                            <option {{$item->student_id==$student->id?"selected":""}} value="{{$student->id}}">
                                                {{$student->nameAR}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('student_id')}}</div>
                                </div>

                                 <div class="col"id="student_id_d2" style="display:none">
                                <label class="control-label">اسم الطالب (EN) : </label>
                                    <select name="student_id" id="nameEN" class="form-control" disabled>
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($students as $student)
                                            <option {{$item->student_id==$student->id?"selected":""}} value="{{$student->id}}">
                                                 {{$student->nameEN}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('student_id')}}</div>
                                </div>

                        </div><br>

                        <div class="row" >
                            <div class="col"id="nationality_d" style="display:none">
                                <label class="control-label">الجنسية:* </label>
                                    <input type="hidden" value="{{$item->nationality?$item->nationality:0}}" name="nationality_h" id="nationality_h">
                                    <input type="text" value="{{$item->nationality?\App\Models\Option::find($item->nationality)->title:0}}" class="form-control validate[required] text-input" id="nationality"
                                           name="nationality" placeholder="أدخل اسم الطالب اولا" disabled>
                                    <div class="text-danger">{{$errors->first('nationality_h')}}</div>
                                </div>

                            <div class="col"id="place_birth_d" style="display:none">
                                <label class="control-label">مكان الولادة:* </label>
                                    <input type="hidden" value="{{$item->place_birth?$item->place_birth:0}}" name="place_birth_h" id="place_birth_h">
                                    <input type="text" value="{{$item->place_birth?$item->place_birth:0}}" class="form-control validate[required] text-input" id="place_birth"
                                           name="place_birth" placeholder="أدخل اسم الطالب اولا" disabled>
                                    <div class="text-danger">{{$errors->first('place_birth_h')}}</div>
                                </div>
                                 <div class="col" id="year_birth_d" style="display:none">
                                <label class="control-label">سنة الميلاد:* </label>
                                    <input type="hidden" value="{{$item->year_birth?$item->year_birth:0}}" name="year_birth_h" id="year_birth_h">
                                    <input type="text" value="{{$item->year_birth?$item->year_birth:0}}" class="form-control validate[required] text-input" id="year_birth"
                                           name="year_birth" placeholder="أدخل اسم الطالب اولا" disabled>
                                    <div class="text-danger">{{$errors->first('year_birth_h')}}</div>
                                </div>

                        </div><br>


                        <div class="row">
                            <div class="col" id="course_id_d" style="display:none">
                                <label class="control-label">اسم الدورة:* </label>
                                    <select name="course_id" id="course_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($courses as $course)
                                            <option {{$item->course_id==$course->id?"selected":""}} value="{{$course->id}}">
                                                {{$course->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('course_id')}}</div>
                                </div>
                         <div class="col"id="total_hours_d" style="display:none">
                                <label class="control-label">عدد الساعات:* </label>
                                    <input type="number" value="{{$item->total_hours?$item->total_hours:0}}" class="form-control text-input" id="total_hours"
                                           name="total_hours" placeholder="أدخل عدد الساعات">
                                    <div class="text-danger">{{$errors->first('total_hours')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col" id="start_day_d" style="display:none">
                                <label class="control-label">المبتدئة بتاريخ:* </label>
                                    <input type="text" min="{{date('Y-m-d')}}" value="{{$item->start_day?$item->start_day:0}}"
                                           class="form-control fc-datepicker" id="start_day" name="start_day">
                                    <div class="text-danger">{{$errors->first('start_day')}}</div>
                                </div>

                           <div class="col"id="end_day_d" style="display:none">
                                <label class="control-label">المنتهية بتاريخ:* </label>
                                    <input type="text" min="{{date('Y-m-d')}}" value="{{$item->end_day?$item->end_day:0}}"
                                           class="form-control fc-datepicker" id="end_day" name="end_day">
                                    <div class="text-danger">{{$errors->first('end_day')}}</div>
                                </div>

                                 <div class="col"id="appreciation_d" style="display:none">
                                <label class="control-label">التقدير:* </label>
                                    <select name="appreciation" id="appreciation" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($appreciations as $appreciation)
                                            <option {{$item->appreciation==$appreciation->id?"selected":""}} value="{{$appreciation->id}}">
                                                {{$appreciation->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('appreciation')}}</div>
                                </div>

                        </div><br>


                        <div class="row" >
                            <div class="col"id="certificate_fees_d" style="display:none">
                                <label class="control-label">رسوم الشهادة:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" value="{{$item->certificate_fees?$item->certificate_fees:0}}" class="form-control text-input" id="certificate_fees"
                                           name="certificate_fees" placeholder="أدخل رسوم الشهادة">
                                    <div class="text-danger">{{$errors->first('certificate_fees')}}</div>
                                </div>

                              <div class="col"id="catch_receipt_id_d" style="display:none">
                                <label class="control-label">رقم سند القبض:* </label>
                                    <input type="number" value="{{$item->catch_receipt_id?$item->catch_receipt_id:0}}" class="form-control text-input" id="catch_receipt_id"
                                           name="catch_receipt_id" placeholder="أدخل رقم سند القبض">
                                    <div class="text-danger">{{$errors->first('catch_receipt_id')}}</div>
                                </div>

                        </div><br>

                        <div class="row" >
                            <div class="col"id="release_date_d" style="display:none">
                                <label class="control-label"> تاريخ الاصدار:* </label>
                                    <input type="text" min="{{date('Y-m-d')}}" value="{{$item->release_date}}"
                                           class="form-control fc-datepicker" id="release_date2" name="release_date">
                                    <div class="text-danger">{{$errors->first('release_date')}}</div>
                                </div>

                              <div class="col"id="student_name_d" style="display:none">
                                <label class="control-label">اسم الطالب / الهيئة :* </label>
                                    <input type="text" value="{{old("student_name",$item->student_name)}}" class="form-control validate[required] text-input" id="place_birth"
                                           name="student_name" / >
                                    <div class="text-danger">{{$errors->first('student_name')}}</div>
                                </div>

                        </div><br>

                        <div class="row" id="description_d" style="display:none">
                            <div class="col">
                                <label class="control-label"> الوصف: </label>
                            <textarea name="description" style="width: 100%;height: auto;min-height: 150px;">{{old("description",$item->description)}}</textarea>
                                    <div class="text-danger">{{$errors->first('description')}}</div>
                                </div>

                        </div><br>

                           <div class="row ">
                               <div class="col-1">

                            </div>
                            <div class="col"id="print_execute_d">
                                <label for="inputName" class="h4">الطباعة :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox"id="print_execute" name="print_execute" {{$item->print_execute?"checked":""}}>
                            </div>
                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Certificate/" class="btn btn-danger"> إلغاء</a>
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

@cannot('تعديل شهادة')
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
