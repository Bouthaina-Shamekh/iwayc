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
<a class="btn btn-primary btn-md" href="{{ route('Student.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه طالب جديد </a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Student.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('تعديل انسحاب')


<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


        <div class="card">
        <div class="card-body">

 <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Withdrawal/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
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
                                <label class="control-label">اسم الطالب والدورة: </label>
                                    <input type="hidden" value="{{$item->student_course_id}}" id="student_course_id_h" name="student_course_id_h">
                                    <input type="text" value="{{\App\Models\Student::find(\App\Models\Student_course::find($item->student_course_id)->student_id)->nameAR}} - {{\App\Models\Course::find(\App\Models\Student_course::find($item->student_course_id)->course_id)->courseAR}}" class="form-control validate[required] text-input"
                                           id="student_course_id" name="student_course_id" disabled>
                                    <div class="text-danger">{{$errors->first('student_course_id_h')}}</div>
                                </div>

                             <div class="col">
                                <label class="control-label">الهواتف:  </label>
                                    <input type="hidden" value="{{$item->phone}}" id="phone_h" name="phone_h">
                                    <input type="text" value="{{$item->phone}}" class="form-control validate[required] text-input"
                                           id="phone" name="phone" disabled>
                                    <div class="text-danger">{{$errors->first('phone_h')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">رسوم الدورة:  </label>
                                    <input type="hidden" value="{{$item->price}}" id="price_h" name="price_h">
                                    <input type="number" step="any" min="0" value="{{$item->price}}" class="form-control validate[required] text-input"
                                           id="price" name="price" disabled>
                                    <div class="text-danger">{{$errors->first('price')}}</div>
                                </div>

                                   <div class="col">
                                <label class="control-label">المبلغ المدفوع:  </label>
                                    <input type="hidden" value="{{$item->payment}}" id="payment_h" name="payment_h">
                                    <input type="number" step="any" min="0" value="{{$item->payment}}" class="form-control validate[required] text-input"
                                           id="payment" name="payment" disabled>
                                    <div class="text-danger">{{$errors->first('payment_h')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">غرامات الطالب:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->fines}}" class="form-control text-input" id="fines"
                                           name="fines" placeholder="أدخل غرامات الطالب">
                                    <div class="text-danger">{{$errors->first('fines')}}</div>
                                </div>

                             <div class="col">
                                <label class="control-label">المبلغ المرتجع:  </label>
                                    <input type="hidden" value="{{$item->refund}}" id="refund_h" name="refund_h">
                                    <input type="number" step="any" min="0" value="{{$item->refund}}" class="form-control text-input"
                                           id="refund" name="refund" disabled>
                                    <div class="text-danger">{{$errors->first('refund_h')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">اجور المعلم:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->teacher_fees}}" class="form-control text-input" id="teacher_fees"
                                           name="teacher_fees" placeholder="رسوم اجور المعلم">
                                    <div class="text-danger">{{$errors->first('teacher_fees')}}</div>
                                </div>

                              <div class="col">
                                <label class="control-label">حصة المركز:  </label>
                                    <input type="hidden" value="" id="center_fees_h" name="center_fees_h">
                                    <input type="number" step="any" min="0" value="{{$item->center_fees}}" class="form-control text-input"
                                           id="center_fees" name="center_fees" disabled>
                                    <div class="text-danger">{{$errors->first('center_fees_h')}}</div>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">سبب الانسحاب:* </label>
                                    <textarea class="animatedTextArea form-control" id="reason" name="reason"
                                              placeholder="أدخل سبب الانسحاب">{{$item->reason}}</textarea>
                                    <div class="text-danger">{{$errors->first('reason')}}</div>
                                </div>

                        </div><br>

                        <div class="row last">
                            <div class="col trxt-center">
                                <label class="control-label"></label>
                                <div class="col-sm-12">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Withdrawal/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('تعديل انسحاب')
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
        function fRefund () {
            var payment = parseFloat($("#payment").val());
            var fines = parseFloat($("#fines").val());
            var refund = payment - fines;
            $("#refund ").val(refund );
            $("#refund_h").val(refund );
        }
        function fCenterFees  () {
            var payment = parseFloat($("#payment").val());
            var refund = parseFloat($("#refund ").val());
            var teacher_fees = parseFloat($("#teacher_fees ").val());
            var center_fees = payment - refund - teacher_fees;
            $("#center_fees ").val(center_fees );
            $("#center_fees_h").val(center_fees );
        }
        window.onload = function() {
            fRefund();
            fCenterFees();
        };
        $('#fines').change(function() {
            fRefund();
            fCenterFees();
        });
        $('#teacher_fees').change(function() {
            fRefund();
            fCenterFees();
        });
    </script>
@endsection
