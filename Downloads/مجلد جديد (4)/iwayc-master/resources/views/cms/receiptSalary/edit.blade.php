@extends('layouts.master')
@section('css')
<style>
.disable{
pointer-events:none;
background-color: #dde2ef !important;

}
</style>
@section('title')
Iwayc System

@endsection


@section('page-header')
{{ $parentTitle }}

@endsection
@section('button1')
@can('اضافة صرف راتب')
<a class="btn btn-primary btn-md" href="{{ route('ReceiptSalary.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه سند صرف جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('ReceiptSalary.index')}}">رجوع</a>
@stop
@endsection
@section('content')
@can('تعديل صرف راتب')


<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


        <div class="card">
        <div class="card-body">
        <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/ReceiptSalary/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">رقم السند الحاسوبي:* </label>
                                    <input type="number" min="{{$item->id}}" value="{{$item->id}}" class="form-control validate[required] text-input" id="id"
                                           name="id">
                                    <div class="text-danger">{{$errors->first('id')}}</div>
                                </div>
                       <div class="col">
                                <label class="control-label">رقم السند الورقي:* </label>
                                    <input type="number" min="0" value="{{$item->id_comp}}" class="form-control validate[required] text-input" id="id_comp"
                                           name="id_comp">
                                    <div class="text-danger">{{$errors->first('id_comp')}}</div>
                                </div>
                           <div class="col">
                                <label class="control-label">تاريخ السند الورقي:* </label>


                                    <input type="text" value="{{$item->date}}" class="form-control fc-datepicker" id="date"
                                           name="date">
                                    <div class="text-danger">{{$errors->first('date')}}</div>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الموظف:* </label>
                                    <input type="hidden" value="{{$item->employee_id}}" name="employee_id_h" id="employee_id_h">
                                    <select name="employee_id" id="employee_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($employees as $employee)
                                            <option {{$item->employee_id==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('employee_id')}}</div>
                                </div>
                            <div class="col">
                                <label class="control-label">الشهر:* </label>
                                    <input type="hidden" value="{{$item->month}}" name="month_h" id="month_h">
                                    <select name="month" id="month" class="form-control">
                                        <option value=""> اختر اسم الموظف اولا.... </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('month')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المكافأت:* </label>
                                    <input
                                    type="text"
                                    value="{{$item->rewards}}"
                                    name="rewards_h"
                                    id="rewards_h"
                                    onchange="setTwoNumberDecimal(this)"
                                    required=""
                                    class=" form-control disable">

                                    <div class="text-danger">{{$errors->first('rewards_h')}}</div>
                                </div>
                               <div class="col">
                                <label class="control-label">الخصومات:* </label>
                                    <input
                                    type="text"
                                   value="{{$item->receipts}}"
                                    name="receipts_h"
                                    id="receipts_h"
                                    onchange="setTwoNumberDecimal(this)"
                                    required=""
                                    class=" form-control disable">

                                    <div class="text-danger">{{$errors->first('receipts_h')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">صافي الراتب:* </label>
                                    <input type="text"
                                     value="{{$item->nets}}"
                                     name="nets_h"
                                     id="nets_h"
                                     onchange="setTwoNumberDecimal(this)"
                                    required=""
                                    class=" form-control disable">

                                    <div class="text-danger">{{$errors->first('nets_h')}}</div>
                                </div>
                             <div class="col">
                                <label class="control-label">مقبوضات الموظف:* </label>
                                    <input type="text"
                                    value="{{$item->salary}}"
                                    name="salary_h"
                                    id="salary_h"
                                    onchange="setTwoNumberDecimal(this)"
                                    required=""
                                    class=" form-control disable">

                                    <div class="text-danger">{{$errors->first('salary_h')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">سداد ذمم:* </label>
                                    <input type="hidden"
                                    value="{{$item->advance_payment}}"
                                    name="advance_payment_h"
                                    id="advance_payment_h"
                                    onchange="setTwoNumberDecimal(this)"
                                    required=""
                                    class=" form-control">

                                    <div class="text-danger">{{$errors->first('advance_payment_h')}}</div>
                                </div>
                                 <div class="col">
                                <label class="control-label">باقي الراتب:* </label>
                                    <input type="hidden"
                                    value="{{$item->remainder}}"
                                    name="remainder_h"
                                    id="remainder_h"
                                    onchange="setTwoNumberDecimal(this)"
                                    required=""
                                    class=" form-control disable">

                                    <div class="text-danger">{{$errors->first('remainder_h')}}</div>
                                </div>


                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input
                                    type="number"
                                    onchange="setTwoNumberDecimal(this)"
                                    step="any"
                                    min="0"

                                    value="{{$item->amount}}"
                                    class="form-control validate[required] text-input"
                                    id="amount"
                                    name="amount"
                                    placeholder="أدخل المبلغ">
                                    <div class="text-danger">{{$errors->first('amount')}}</div>
                                </div>
                            <div class="col">
                                <label class="control-label">المبلغ الكلى:* </label>
                                    <input disabled type="text"  value="{{$item->amount+$item->advance_payment}}" class="form-control  text-input" id="total_amount"
                                           name="total_amount" placeholder="أدخل المبلغ الكلى">
                                    <div class="text-danger">{{$errors->first('total_amount')}}</div>
                                </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{$item->notes}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>

                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-sm-10 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Static/" class="btn btn-danger"> إلغاء</a>
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

@cannot('تعديل صرف راتب')
    <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        ليس لديك صلاحية يرجي مراجعة المسؤول
    </div>
@endcannot
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js') <script>
        window.onload = function(){
            var id=$('#employee_id_h').val();
            $.get("/CMS/MonthSalary/" + id,
                function(data) {
                    var model = $('#month');
                    model.empty();
                    model.append("<option value=''>اختر اسم الشهر والسنة.... </option>");

                    $.each(data, function(index, element) {
                        var nn=$('#month_h').val();
                        if(element.id ==nn ){
                            model.append("<option selected value='"+ element.id +"'>" + element.month + " - " + element.year + "</option>");
                        }else {
                            model.append("<option value='"+ element.id +"'>" + element.month + " - " + element.year + "</option>");
                        }
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
                       // $('#salary').val(data.recs);
                        $('#salary_h').val(data.recs);
                       // $('#advance_payment').val(data.adv);
                        $('#advance_payment_h').val(data.adv);
                       // $('#remainder').val(data.rem);
                        $('#remainder_h').val(data.rem);
                        $('#amount').val(0);
                        $('#total_amount').val(data.adv);
                        $("#amount").attr('max',data.rem);
                    });
            });
            $("#advance_payment_h").on('change',function(e){
                var advance =$(this).val();
               // $('#advance_payment_h').val(advance);
                var net = $("#nets_h").val();
                var salary = $('#salary_h').val();
                var rem = net - salary - advance;
                var amount=$('#amount').val();
                var total=parseFloat(amount)+parseFloat(advance);
                $('#total_amount').val(total);
                $('#remainder').val(rem);
                        $('#remainder_h').val(rem);
            })
            $("#amount").on('change',function(e){
                var amount=$(this).val();
                var advance=$('#advance_payment_h').val();
                var total=parseFloat(amount)+parseFloat(advance);
                $('#total_amount').val(total);

            })
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
