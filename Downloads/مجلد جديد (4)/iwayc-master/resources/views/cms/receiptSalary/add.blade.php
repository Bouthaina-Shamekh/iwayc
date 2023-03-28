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
<a class="btn btn-primary btn-md" href="{{route('ReceiptSalary.index')}}">رجوع</a>
@stop
@endsection
@section('content')
@can('اضافة صرف راتب')
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
        <div class="card">
            <div class="card-body">
                    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/ReceiptSalary">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="hidden" value="{{$userL>0?$uY:$moneyWork->year}}" id="edu_year_h" name="edu_year_h">
                                <label class="col control-label">رقم السند الحاسوبي:* </label>

                                    <input type="number" min="{{$id}}" value="{{$id}}" class="form-control validate[required] text-input" id="id"
                                           name="id">
                                    <div class="text-danger">{{$errors->first('id')}}</div>

                                </div>

                                 <div class="col">
                                    <label class="control-label">رقم السند الورقي:* </label>
                                        <input type="number" min="0" value="{{$id_comp}}" class="form-control validate[required] text-input" id="id_comp"
                                               name="id_comp" autocomplete="off">
                                        <div class="text-danger">{{$errors->first('id_comp')}}</div>
                                </div>

                                  <div class="col">
                                <label class="control-label">تاريخ السند الورقي:* </label>
                                    <input type="text" value="{{date('Y-m-d')}}" class="form-control fc-datepicker " id="date"name="date">
                                    <div class="text-danger">{{$errors->first('date')}}</div>

                            </div>

                        </div><br>

                        <div class="row">

                       <div class="col">
                        <label class="control-label">الموظف:* </label>
                            <select name="employee_id" id="employee_id" class="form-control"required="">
                                <option value=""> اختر من القائمة.... </option>
                                @foreach($employees as $employee)
                                    <option {{old("employee_id")==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                                @endforeach
                            </select>
                            <div class="text-danger">{{$errors->first('employee_id')}}</div>

                        </div>

                              <div class="col">
                                <label class="control-label">الشهر:* </label>
                                    <select name="month" id="month" class="form-control"required="">
                                        <option value=""> اختر اسم الموظف اولا.... </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('month')}}</div>
                                </div>

                        </div><br>


                        <div class="row">
                        <div class="col">
                            <label class="control-label">المكافأت:* </label>
                                <input type="text"
                                value="{{old("rewards_h")}}"
                                name="rewards_h"
                                id="rewards_h"
                                class=" form-control disable"
                                onchange="setTwoNumberDecimal(this)"required="">
                                <div class="text-danger">{{$errors->first('rewards_h')}}</div>

                      </div>
                         <div class="col">
                                <label class="col control-label">الخصومات:* </label>

                                <div class="col">
                                    <input type="text"
                                    class=" form-control disable"
                                    value="{{old("receipts_h")}}"
                                    name="receipts_h"
                                    id="receipts_h"
                                    onchange="setTwoNumberDecimal(this)"required="">
                                    <div class="text-danger">{{$errors->first('receipts_h')}}</div>
                                </div>
                                </div>
                         <div class="col">
                                <label class="col control-label">صافي الراتب:* </label>
                                    <input type="text"
                                    class=" form-control disable"
                                    value="{{old("nets_h")}}"
                                    name="nets_h"
                                    id="nets_h"
                                    onchange="setTwoNumberDecimal(this)"required="">
                                    <div class="text-danger">{{$errors->first('nets_h')}}</div>
                                </div>
                        </div><br>

                        <div class="row">
                             <div class="col">
                            <label class="col control-label">مقبوضات الموظف:* </label>
                                <input type="text"
                                class=" form-control disable"
                                 value="{{old("salary_h")}}" name="salary_h"
                                id="salary_h"
                                onchange="setTwoNumberDecimal(this)"
                                required="">
                                <div class="text-danger">{{$errors->first('salary_h')}}</div>

                         </div>
                          <div class="col">
                            <label class="control-label">سداد ذمم:* </label>
                               <input type="text"
                               class="form-control"
                               name="advance_payment_h"
                               id="advance_payment_h"
                               onchange="setTwoNumberDecimal(this)"
                               value="{{old("advance_payment_h")}}"required="">
                            <div class="text-danger">{{$errors->first('advance_payment_h')}}
                                </div>

                                </div>

                           <div class="col">
                            <label class="control-label">باقي الراتب:* </label>
                                    <input type="text"
                                    class="form-control disable"
                                    value="{{old("remainder_h")}}"
                                    name="remainder_h"
                                    id="remainder_h"
                                    onchange="setTwoNumberDecimal(this)"required="">
                                    <div class="text-danger">{{$errors->first('remainder_h')}}</div>
                                </div>


                        </div><br>


                        <div class="row">
                             <div class="col">
                            <label class="col control-label">المبلغ:* </label>
                                <input type="text"class=" form-control" value="{{old("amount_h")}}" name="amount_h" step="any" min="0"max="0"id="amount_h"onchange="setTwoNumberDecimal(this)"required="">
                                <div class="text-danger">{{$errors->first('amount_h')}}</div>

                         </div>
                          <div class="col">
                            <label class="control-label">المبلغ الكلى:* </label>
                               <input type="text"
                               class="form-control"
                               name="total_amount"
                               id="total_amount"
                               onchange="setTwoNumberDecimal(this)"
                              value="{{old("amount_h")+old("advance_payment_h")}}" disabled>
                            <div class="text-danger">{{$errors->first('total_amount')}}
                                </div>

                                </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"placeholder="أدخل ملاحظات">{{old("notes")}}</textarea>
                                </div>

                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/ReceiptSalary/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div>

                    </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endcan

    @cannot('اضافة صرف راتب')
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
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<!-- Internal Form-validation js -->

<script>
    window.onload = function(){
        var id=$('#employee_id').val();
        $.get("/CMS/MonthSalary/" + id,
            function(data) {
                var model = $('#month');
                model.empty();
                model.append("<option value=''>اختر اسم الشهر والسنة.... </option>");

                $.each(data, function(index, element) {
                    model.append("<option value='"+ element.id +"'>" + element.month + " - " + element.year + "</option>");
                });
            });
    };
    $(document).ready(function(){
        $('#employee_id').change(function(){
            var id=$(this).val();
            $.get("/CMS/MonthSalary/" + id,
                function(data) {
                    var model = $('#month');
                    model.empty();
                    model.append("<option value=''>اختر اسم الشهر والسنة.... </option>");

                    $.each(data, function(index, element) {
                        model.append("<option value='"+ element.id +"'>" + element.month + " - " + element.year + "</option>");
                    });
                });
        });
        $('#month').change(function(){
            var id=$(this).val();
            $.get("/CMS/MMSalary/" + id,
                function(data) {
                   // $('#rewards').val(data.rew);
                    $('#rewards_h').val(data.rew);
                   // $('#receipts').val(data.rec);
                    $('#receipts_h').val(data.rec);
                   // $('#nets').val(data.net);
                    $('#nets_h').val(data.net);
                    //$('#salary').val(data.recs);
                    $('#salary_h').val(data.recs);
                    //$('#advance_payment').val(data.adv);
                    $('#advance_payment_h').val(data.adv);
                   // $('#remainder').val(data.rem);
                    $('#remainder_h').val(data.rem);
                    $("#amount_h").attr('max',data.rem);
                });
        });
        $("#advance_payment_h").on('change',function(e){
            var advance =$(this).val();
           // $('#advance_payment_h').val(advance);
            var net = $("#nets_h").val();
            var salary = $('#salary_h').val();
            var rem = net - salary - advance;
            $('#remainder_h').val(rem);

        })
        $("#amount_h").on('change',function(e){
            var amount=$(this).val();
            var advance=$('#advance_payment_h').val();
            var total=parseFloat(amount)+parseFloat(advance);
            $('#total_amount').val(total);

        })
    });
</script>



@endsection
