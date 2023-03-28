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
                      <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Withdrawal">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الطالب والدورة المنسحب منها:* </label>
                                    <input type="hidden" value="{{$userL>0?$uY:$moneyWork->year}}" id="edu_year_h" name="edu_year_h">
                                    <input type="hidden" value="{{$item->id}}" id="student_course_id_h" name="student_course_id_h">
                                    <input type="text" value="{{\App\Models\Student::find($item->student_id)->nameAR}} - {{\App\Models\Course::find($item->course_id)->courseAR}}" class="form-control validate[required] text-input"
                                           id="student_course_id" name="student_course_id" disabled>
                                    <div class="text-danger">{{$errors->first('student_id_h')}}</div>
                        </div>
                     <div class="col">
                                <label class="control-label">الهواتف:* </label>
                                    <input type="hidden" value="{{\App\Models\Student::find($item->student_id)->phone1}}" id="phone_h" name="phone_h">
                                    <input type="text" value="{{\App\Models\Student::find($item->student_id)->phone1}}" class="form-control validate[required] text-input"
                                           id="phone" name="phone" disabled>
                                    <div class="text-danger">{{$errors->first('phone_h')}}</div>
                        </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">رسوم الدورة:* </label>


                                    <input type="hidden" value="{{$item->price}}" id="price_h" name="price_h">
                                    <input type="number" step="any" min="0" value="{{$item->price}}" class="form-control validate[required] text-input"
                                           id="price" name="price" disabled>
                                    <div class="text-danger">{{$errors->first('price')}}</div>
                                </div>
                             <div class="col">
                                <label class="control-label">المبلغ المدفوع:* </label>
                                    <input type="hidden" value="{{$item->price - $item->payment}}" id="payment_h" name="payment_h">
                                    <input type="number" step="any" min="0" value="{{$item->price - $item->payment}}" class="form-control validate[required] text-input"
                                           id="payment" name="payment" disabled>
                                    <div class="text-danger">{{$errors->first('payment_h')}}</div>
                                </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">غرامات الطالب:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{old("fines")?old("fines"):0}}" class="form-control text-input" id="fines"
                                           name="fines" placeholder="أدخل غرامات الطالب">
                                    <div class="text-danger">{{$errors->first('fines')}}</div>
                                </div>
                        <div class="col">
                                <label class="control-label">المبلغ المرتجع:* </label>
                                    <input type="hidden" value="" id="refund_h" name="refund_h">
                                    <input type="number" step="any" min="0" value="{{old("refund")?old("refund"):0}}" class="form-control text-input"
                                           id="refund" name="refund" disabled>
                                    <div class="text-danger">{{$errors->first('refund_h')}}</div>
                                </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">اجور المعلم:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{old("teacher_fees")?old("teacher_fees"):0}}" class="form-control text-input" id="teacher_fees"
                                           name="teacher_fees" placeholder="رسوم اجور المعلم">
                                    <div class="text-danger">{{$errors->first('teacher_fees')}}</div>
                                </div>
                              <div class="col">
                                <label class="control-label">حصة المركز:* </label>
                                    <input type="hidden" value="" id="center_fees_h" name="center_fees_h">
                                    <input type="number" step="any" min="0" value="{{old("center_fees")?old("center_fees"):0}}" class="form-control text-input"
                                           id="center_fees" name="center_fees" disabled>
                                    <div class="text-danger">{{$errors->first('center_fees_h')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">سبب الانسحاب:* </label>
                                    <textarea class="animatedTextArea form-control" id="reason" name="reason"
                                              placeholder="أدخل سبب الانسحاب">{{old("reason")}}</textarea>
                                    <div class="text-danger">{{$errors->first('reason')}}</div>
                                </div>

                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-sm-10">
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
