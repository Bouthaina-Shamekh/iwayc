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
<a class="btn btn-primary btn-md" href="{{ route('CountClaim.index') }}">رجوع</a>
@stop
@endsection
@section('content')
    @can('تعديل مطالبة')


<!-- row -->
<div class="row">

    <div class="col-lg-10 col-md-12">


        <div class="card">
        <div class="card-body">
       <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/CountClaim/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الطالب:* </label>

                                    <input type="text" value="{{\App\Models\Student::find(\App\Models\Student_course::find($item->student_course_id)->student_id)->nameAR}}" class="form-control validate[required] text-input" id="student_course_id"
                                           name="student_course_id" disabled>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">طريقة المطالبة:* </label>


                                    <select name="type" id="type" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($type as $t)
                                            <option {{$item->how_claim==$t->id?"selected":""}} value="{{$t->id}}"> {{$t->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('type')}}</div>
                                </div>

                        </div><br>
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

                                <div class="col-sm-10">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/CountClaim/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('تعديل مطالبة')
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
            fSum();
            fRatio();
            teacher_type();
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
@endsection
