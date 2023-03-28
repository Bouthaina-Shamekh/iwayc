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
<a class="btn btn-primary btn-md" href="{{ route('ReceiptAdvance.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه سند صرف جديد جديد </a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('تعديل صرف سلفة')


<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


        <div class="card">
        <div class="card-body">
      <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/ReceiptAdvance/{{$item->id}}">
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
                                <label class="col control-label">تاريخ السند الورقي:* </label>

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
                                <label class="control-label">مكان الميلاد:* </label>
                                    <input type="text" value="{{$item->place_birth}}" class="form-control validate[required] text-input" id="place_birth"
                                           name="place_birth" placeholder="أدخل مكان الميلاد">
                                    <div class="text-danger">{{$errors->first('place_birth')}}</div>
                                </div>

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

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">مبلغ السلفة:* </label>

                                <div class="col">
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->advance_payment}}" class="form-control validate[required] text-input" id="advance_payment"
                                           name="advance_payment" placeholder="ادخل مبلغ السلفة">
                                    <div class="text-danger">{{$errors->first('advance_payment')}}</div>
                                </div>
                                </div>
                             <div class="col">
                                <label class="col control-label">عدد شهور السداد:* </label>

                                <div class="col">
                                    <input type="number" value="{{$item->month_count}}" class="form-control validate[required] text-input" id="month_count"
                                           name="month_count" placeholder="ادخل عدد شهور السداد">
                                    <div class="text-danger">{{$errors->first('month_count')}}</div>
                                </div>
                                </div>

                              <div class="col">
                                <label class="col control-label">دفعات السداد الشهري:* </label>

                                <div class="col">
                                    <input type="hidden" value="{{$item->month_payment}}" id="month_payment_h" name="month_payment_h">
                                    <input type="text" value="{{$item->month_payment}}" class="form-control validate[required] text-input" id="month_payment"
                                           name="month_payment" disabled>
                                    <div class="text-danger">{{$errors->first('month_payment_h')}}</div>
                                </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">يبدأ السداد من راتب شهر:* </label>

                                <div class="col">
                                    <select name="start_payment" id="start_payment" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        <option {{$item->start_payment=="01"?"selected":""}} value="01"> Jan - 01 </option>
                                        <option {{$item->start_payment=="02"?"selected":""}} value="02"> Fab - 02 </option>
                                        <option {{$item->start_payment=="03"?"selected":""}} value="03"> Mar - 03 </option>
                                        <option {{$item->start_payment=="04"?"selected":""}} value="04"> Apr - 04 </option>
                                        <option {{$item->start_payment=="05"?"selected":""}} value="05"> May - 05 </option>
                                        <option {{$item->start_payment=="06"?"selected":""}} value="06"> June - 06 </option>
                                        <option {{$item->start_payment=="07"?"selected":""}} value="07"> July - 07 </option>
                                        <option {{$item->start_payment=="08"?"selected":""}} value="08"> Aug - 08 </option>
                                        <option {{$item->start_payment=="09"?"selected":""}} value="09"> Sept - 09 </option>
                                        <option {{$item->start_payment=="10"?"selected":""}} value="10"> Oct - 10 </option>
                                        <option {{$item->start_payment=="11"?"selected":""}} value="11"> Nov - 11 </option>
                                        <option {{$item->start_payment=="12"?"selected":""}} value="12"> Dec - 12 </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('start_payment')}}</div>
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
                                    <a href="/CMS/ReceiptAdvance/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('تعديل صرف سلفة')
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
        function fSum() {
            var advance_payment = parseInt($("#advance_payment").val());
            var month_count = parseInt($("#month_count").val());
            var month_payment = advance_payment / month_count;
            if (month_count<1 || !month_count || advance_payment<0 || !advance_payment){
                month_payment = 0;
            }
            $("#month_payment").val(month_payment);
            $("#month_payment_h").val(month_payment);
        }
        window.onload = function() {
            fSum();
        };
        $('#advance_payment').change(function() {
            fSum();
        });
        $('#month_count').change(function() {
            fSum();
        });
    </script>
@endsection
