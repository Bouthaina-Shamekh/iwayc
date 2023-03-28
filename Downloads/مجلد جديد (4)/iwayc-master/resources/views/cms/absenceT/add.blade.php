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
<a class="btn btn-primary btn-md" href="{{ route('AbsenceT.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('اضافة اذن معلم')

   <?php $userL = \App\Models\User_year::where('user_id',Auth::user()->id)->count(); ?>
    @if ($userL>0)
        <?php
        $userY = \App\Models\User_year::where('user_id',Auth::user()->id)->first();
        $uY = $userY->year;
        ?>
    @else
        <?php $uY = null; ?>
    @endif

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
                @foreach ($errors->all() as $error)ol
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/AbsenceT">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">التاريخ:* </label>
                                <input type="hidden" value="{{$userL>0?$uY:$moneyWork->year}}" id="edu_year_h" name="edu_year_h">

                                    <input type="text" value="{{(date('Y-m-d'))}}" class="form-control fc-datepicker" id="date"
                                           name="date">
                                    <div class="text-danger">{{$errors->first('date')}}</div>
                                </div>
                          <div class="col">
                                <label class="control-label">اسم المعلم والدورة:* </label>
                                    <select name="course_id" id="course_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($courses as $course)
                                            <option {{old("course_id")==$course->id?"selected":""}} value="{{$course->id}}">
                                                {{\App\Models\Teacher::find($course->teacher_id)->name}} - {{$course->courseAR}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('course_id')}}</div>
                                </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">النوع:* </label>
                                    <select name="type" id="type" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        <option {{old("type")=="0"?"selected":""}} value="0"> غياب </option>
                                        <option {{old("type")=="1"?"selected":""}} value="1"> تأخير </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('type')}}</div>
                                </div>
                            <div class="col"id="delay_time_d" style="display:none">
                                <label class="control-label">مدة التأخير:* </label>
                                <div class="row">
                                <div class="col-10">
                                    <input type="number" value="{{old("delay_time")==null?0:old("delay_time")}}" class="form-control text-input"
                                           id="delay_time" name="delay_time" placeholder="أدخل العدد" min="0">
                                    <div class="text-danger">{{$errors->first('delay_time')}}</div>
                                </div>
                                <div class="col">
                                <strong style="font-size: 22px" class="col-md-1 text-left">دقيقة</strong>
                              </div>
                            </div>
                          </div>
                    </div><br>


                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>

                                <div class="col-md-10 ls-group-input">
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="With animation :)">{{old("notes")}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>
                            </div>
                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-sm-10">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/AbsenceT/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('اضافة اذن معلم')
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
        $('#type').change(function() {
            cert();
        });
        window.onload = function() {
            cert();
        };
        function cert(){
            if ($('select[name=type]').val()=="1"){
                $("#delay_time_d").show();
            }
            if ($('select[name=type]').val()=="0"){
                $("#delay_time_d").hide();
            }
        }
        $('#money_id').change(function(){
            if ($(this).val()!='0') {
                $.get("/CMS/AbsenceSFilter/",
                    function(data) {
                        var model = $('#student_course_id');
                        model.empty();
                        model.append("<option value=''>اختر اسم الطالب والدورة المسجلة ....</option>");
                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.nameAR+"-"+element.courseAR + "</option>");
                        });
                    });
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
