@extends('layouts.master')
@section('css')

<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

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
<a class="btn btn-primary btn-md" href="{{ route('CatchReceiptBox.index') }}">رجوع</a>
@stop
@endsection
@section('content')

 @can('اضافة متابعة حملة')
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
             <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/CatchReceiptBox">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">رقم السند الحاسوبي:* </label>
                                <input type="hidden" value="{{$userL>0?$uY:$moneyWork->year}}" id="edu_year_h" name="edu_year_h">
                                    <input type="number" min="{{$id}}" value="{{$id}}" class="form-control validate[required] text-input" id="id"
                                           name="id">
                                    <div class="text-danger">{{$errors->first('id')}}</div>
                                </div>

                            <div class="col">
                                <label class="control-label">رقم السند الورقي:* </label>
                                    <input type="number" min="0" value="{{$id_comp}}" class="form-control validate[required] text-input" id="id_comp"
                                           name="id_comp">
                                    <div class="text-danger">{{$errors->first('id_comp')}}</div>
                                </div>

                          <div class="col">
                                <label class="control-label">تاريخ السند الورقي:* </label>
                                    <input type="text" value="{{(date('Y-m-d'))}}" class="form-control fc-datepicker" id="date"
                                           name="date">
                                    <div class="text-danger">{{$errors->first('date')}}</div>
                                </div>

                            </div><br>



                        <div class="row">
                            <div class="col">
                                <label class="control-label">الصندوق الفرعي:* </label>
                                    <select name="box_id" id="box_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($boxes as $box)
                                            <option {{old("box_id")==$box->id?"selected":""}} value="{{$box->id}}"> {{$box->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('box_id')}}</div>
                                </div>

                           <div class="col">
                                <label class="control-label">تصنيف الايراد:* </label>
                                    <select name="type" id="type" class="form-control">
                                        <option value=""> اختر اسم الصندوق اولا.... </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('type')}}</div>
                                </div>
                            </div><br>



                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الزبون:* </label>
                                    <input type="text" value="{{old("customer")}}" class="form-control validate[required] text-input" id="customer"
                                           name="customer" placeholder="ادخل اسم الزبون">
                                    <div class="text-danger">{{$errors->first('customer')}}</div>
                                </div>

                      <div class="col">
                                <label class="control-label">العدد:* </label>
                                    <input type="number" value="{{old("count")}}" class="form-control validate[required] text-input" id="count"
                                           name="count" placeholder="أدخل العدد">
                                    <div class="text-danger">{{$errors->first('count')}}</div>
                                </div>

                          <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" value="{{old("amount")}}" class="form-control validate[required] text-input" id="amount"
                                           name="amount" placeholder="أدخل المبلغ">
                                    <div class="text-danger">{{$errors->first('amount')}}</div>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{old("notes")}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>
                            </div><br>


                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
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

    @cannot('اضافة قبض صندوق')
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
    <script>
        jQuery(document).ready(function($){
            $('#box_id').change(function(){
                var id=$(this).val();
                $.get("/CMS/IncomeBox/" + id,
                    function(data) {
                        var model = $('#type');
                        model.empty();

                        model.append("<option value=''>اختر نوع الايراد ....</option>");

                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                        });
                    });
            });
        });
        window.onload = function() {
            if ($('#box_id').val()){
                var id=$('#box_id').val();
                $.get("/CMS/IncomeBox/" + id,
                    function(data) {
                        var model = $('#type');
                        model.empty();

                        $.each(data, function(index, element) {
                            <?php $m = "element.id;"?>
                            model.append("<option value='"+ element.id +"' {{old('type')==$m ?'selected':''}}>" + element.name + "</option>");
                        });
                    });
            }
        };
    </script>
@endsection
