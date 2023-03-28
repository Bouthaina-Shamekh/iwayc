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

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('LegalAffairs.index') }}">رجوع</a>
@stop
@endsection
@section('content')
  @can('اضافة شؤون قانونية')

<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12" >
        <div class="card">
            <div class="card-body">
                    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/add/LegalAffairs/{{$item->id}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class=" control-label">اسم الطالب:* </label>

                                    <input type="hidden" value="{{$item->student_course_id}}" name="student_course_id_h" id="student_course_id_h">
                                    <input type="hidden" value="{{$item->m_year}}" name="m_year_h" id="m_year_h">
                                    <input type="text" value="{{\App\Models\Student::find(\App\Models\Student_course::find($item->student_course_id)->student_id)->nameAR}} - {{\App\Models\Course::find(\App\Models\Student_course::find($item->student_course_id)->course_id)->courseAR}}" class="form-control validate[required] text-input" id="student_course_id"
                                           name="student_course_id" disabled>
                                    <div class="text-danger">{{$errors->first('student_course_id_h')}}</div>
                                </div>

                                <div class="col">
                                <label class=" control-label">الهواتف المتوفرة:* </label>
                                    <input type="hidden" value="{{$item->phone}}" name="phone_h" id="phone_h">
                                    <input type="text" value="{{$item->phone}}" class="form-control validate[required] text-input" id="phone"
                                           name="phone" disabled>
                                    <div class="text-danger">{{$errors->first('phone_h')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class=" control-label">الرسوم:* </label>
                                    <input type="hidden" value="{{$item->fees}}" name="fees_h" id="fees_h">
                                    <input type="text" value="{{$item->fees}}" class="form-control validate[required] text-input" id="fees"
                                           name="fees" disabled>
                                    <div class="text-danger">{{$errors->first('fees_h')}}</div>
                                </div>
                         <div class="col">
                                <label class=" control-label">المبلغ المستحق:* </label>
                                    <input type="hidden" value="{{$item->fees_owed}}" name="fees_owed_h" id="fees_owed_h">
                                    <input type="text" value="{{$item->fees_owed}}" class="form-control validate[required] text-input" id="fees_owed"
                                           name="fees_owed" disabled>
                                    <div class="text-danger">{{$errors->first('fees_owed_h')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class=" control-label">تاريخ اول مطالبة:* </label>
                                    <input type="hidden" value="{{substr($count_claim->created_at,0,10)}}"ةmin="{{date('Y-m-d')}}" name="first_claim_h" id="first_claim_h">
                                    <input type="text" value="{{substr($count_claim->created_at,0,10)}}" class="form-control validate[required] text-input" id="first_claim"
                                           name="first_claim" disabled>
                                    <div class="text-danger">{{$errors->first('first_claim_h')}}</div>
                                </div>

                             <div class="col">
                                <label class=" control-label">عدد ايام التأخير:* </label>
                                    <input type="hidden" value="{{$days}}" name="count_day_h" id="count_day_h">
                                    <input type="text" value="{{$days}}" class="form-control validate[required] text-input" id="count_day"
                                           name="count_day">
                                    <div class="text-danger">{{$errors->first('count_day_h')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class=" control-label">غرامة اليوم:* </label>
                                    <input type="text" value="{{old('fine_day')?old('fine_day'):0}}" class="form-control validate[required] text-input" id="fine_day"
                                           name="fine_day">
                                    <div class="text-danger">{{$errors->first('fine_day')}}</div>
                                </div>

                           <div class="col">
                                <label class=" control-label">غرامة التأخير:* </label>
                                    <input type="hidden" value="" name="fine_delay_h" id="fine_delay_h">
                                    <input type="text" value="0" class="form-control validate[required] text-input" id="fine_delay"
                                           name="fine_delay" disabled>
                                    <div class="text-danger">{{$errors->first('fine_delay_h')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class=" control-label">المبلغ الكلي المستحق:* </label>
                                    <input type="hidden" value="" name="total_amount_h" id="total_amount_h">
                                    <input type="text" value="" class="form-control validate[required] text-input" id="total_amount"
                                           name="total_amount" disabled>
                                    <div class="text-danger">{{$errors->first('total_amount')}}</div>
                                </div>

                             <div class="col">
                                <label class=" control-label">الحالة:* </label>
                                    <select name="type" id="type" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($type as $t)
                                            <option {{$item->status==$t->id?"selected":""}} value="{{$t->id}}"> {{$t->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('type')}}</div>
                                </div>

                        </div><br>
                        {{--<div class="row">
                            <div class="col">
                                <label class=" control-label">الضمان:* </label>


                                    <input type="text" value="" class="form-control validate[required] text-input" id="warranty"
                                           name="warranty">
                                    <div class="text-danger">{{$errors->first('warranty')}}</div>
                                </div>
                            </div>
                        </div>--}}

                        <div class="row">
                            <div class="col">
                                <label class=" control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{old("notes")}}</textarea>
                                </div>

                        </div><br>

                        <div class="row last">
                            <div class="col text-center">
                                <label class=" control-label"></label>
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

    @cannot('اضافة شؤون قانونية')
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
