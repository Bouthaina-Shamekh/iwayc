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
<a class="btn btn-primary btn-md" href="{{ route('ReceiptReward.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه سند صرف جديد </a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('ReceiptReward.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('تعديل صرف مكافأة')


<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


        <div class="card">
        <div class="card-body">
      <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/ReceiptReward/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="col control-label">رقم السند الحاسوبي:* </label>

                                <div class="col">
                                    <input type="number" min="{{$item->id}}" value="{{$item->id}}" class="form-control validate[required] text-input" id="id"
                                           name="id">
                                    <div class="text-danger">{{$errors->first('id')}}</div>
                                </div>
                                </div>

                               <div class="col">
                                <label class="col control-label">رقم السند الورقي:* </label>

                                <div class="col">
                                    <input type="number" min="0" value="{{$item->id_comp}}" class="form-control validate[required] text-input" id="id_comp"
                                           name="id_comp">
                                    <div class="text-danger">{{$errors->first('id_comp')}}</div>
                                </div>
                                </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="colcontrol-label">تاريخ السند الورقي:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->date}}" class="form-control fc-datepicker" id="date"
                                           name="date">
                                    <div class="text-danger">{{$errors->first('date')}}</div>
                                </div>
                                </div>

                         <div class="col">
                            <label class="col control-label">السنة المالية:* </label>

                            <div class="col">
                                <select name="m_year" id="m_year" class="form-control">
                                    @foreach($moneyYears as $moneyYear)
                                        <option {{$item->m_year==$moneyYear->year?"selected":""}} value="{{$moneyYear->year}}"> {{$moneyYear->year}} </option>
                                    @endforeach

                                </select>
                                <div class="text-danger">{{$errors->first('m_year')}}</div>
                            </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">الموظف:* </label>

                                <div class="col">
                                    <select name="employee_id" id="employee_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($employees as $employee)
                                            <option {{$item->employee_id==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('employee_id')}}</div>
                                </div>
                                </div>

                        <div class="col">
                            <label class="col control-label">النوع:* </label>

                            <div class="col">
                                <select name="type" id="type" class="form-control">
                                    <option value=""> اختر من القائمة.... </option>
                                    <option {{$item->type=="0"?"selected":""}} value="0"> مكافأت </option>
                                    <option {{$item->type=="1"?"selected":""}} value="1"> خصومات </option>
                                </select>
                                <div class="text-danger">{{$errors->first('type')}}</div>
                            </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">المبلغ:* </label>

                                <div class="col">
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->amount}}" class="form-control validate[required] text-input" id="amount"
                                           name="amount" placeholder="أدخل المبلغ">
                                    <div class="text-danger">{{$errors->first('amount')}}</div>
                                </div>
                                </div>

                             <div class="col">
                                <label class="col control-label">الاضافة والخصم من شهر:* </label>

                                <div class="col">
                                    <select name="receipts_rewards" id="receipts_rewards" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        <option {{$item->receipts_rewards=="1"?"selected":""}} value="1"> Jan - 01 </option>
                                        <option {{$item->receipts_rewards=="2"?"selected":""}} value="2"> Fab - 02 </option>
                                        <option {{$item->receipts_rewards=="3"?"selected":""}} value="3"> Mar - 03 </option>
                                        <option {{$item->receipts_rewards=="4"?"selected":""}} value="4"> Apr - 04 </option>
                                        <option {{$item->receipts_rewards=="5"?"selected":""}} value="5"> May - 05 </option>
                                        <option {{$item->receipts_rewards=="6"?"selected":""}} value="6"> June - 06 </option>
                                        <option {{$item->receipts_rewards=="7"?"selected":""}} value="7"> July - 07 </option>
                                        <option {{$item->receipts_rewards=="8"?"selected":""}} value="8"> Aug - 08 </option>
                                        <option {{$item->receipts_rewards=="9"?"selected":""}} value="9"> Sept - 09 </option>
                                        <option {{$item->receipts_rewards=="10"?"selected":""}} value="10"> Oct - 10 </option>
                                        <option {{$item->receipts_rewards=="11"?"selected":""}} value="11"> Nov - 11 </option>
                                        <option {{$item->receipts_rewards=="12"?"selected":""}} value="12"> Dec - 12 </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('receipts_rewards')}}</div>
                                </div>
                                </div>

                              <div class="col">
                                <label class="col control-label">تصنيف السبب:* </label>

                                <div class="col">
                                    <select name="reason" id="reason" class="form-control">
                                        <option value=""> اختر النوع اولا.... </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('reason')}}</div>
                                </div>
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

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/ReceiptReward/" class="btn btn-danger"> إلغاء</a>
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
@cannot('تعديل صرف مكافأة')
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
    <script>
        jQuery(document).ready(function($){
            $('#type').change(function(){
                var id=$(this).val();
                $.get("/CMS/Type/" + id,
                    function(data) {
                        var model = $('#reason');
                        model.empty();

                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.title + "</option>");
                        });
                    });
            });
        });
        window.onload = function() {
            if ($('#type').val()!=null){
                var id=$('#type').val();
                $.get("/CMS/Type/" + id,
                    function(data) {
                        var model = $('#reason');
                        model.empty();

                        $.each(data, function(index, element) {
                            <?php $m = "element.id;"?>
                            model.append("<option value='"+ element.id +"' {{old('sub_section')==$m ?'selected':''}}>" + element.title + "</option>");
                        });
                    });
            }
        };
    </script>
@endsection

