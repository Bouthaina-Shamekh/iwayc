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
<a class="btn btn-primary btn-md" href="{{ route('ReceiptWarranty.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه سند صرف جديد</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('تعديل صرف ضمان')


<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


        <div class="card">
        <div class="card-body">
      <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/ReceiptWarranty/{{$item->id}}">
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
                                <label class="col control-label">الموظف:* </label>

                                <div class="col">
                                    <select name="salary_id" id="employee_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($employees as $employee)
                                            <option {{\App\Models\Salary::find($item->salary_id)->employee_id ==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('salary_id')}}</div>
                                </div>
                                </div>

                        <div class="col">
                            <label class="col control-label">الشهر والسنة:* </label>

                            <div class="col">
                                <select name="month" id="month" class="form-control"required="">
                                    <option value=""> اختر اسم الموظف اولا.... </option>
                                </select>
                                <div class="text-danger">{{$errors->first('month')}}</div>
                            </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">الراتب في الضمان:* </label>

                                <div class="col">
                                    <input type="hidden" id="salary" name="salary" value="">
                                    <input type="text" value="" class="form-control text-input" id="salary_warranty"
                                           name="salary_warranty" disabled>
                                    <div class="text-danger">{{$errors->first('salary_warranty')}}</div>
                                </div>
                                </div>

                             <div class="col">
                                <div class="form-group">
                                    <label class="col control-label">امانات الضمان:* </label>

                                    <div class="col">
                                        <input type="text" value="" class="form-control text-input" id="warranty_secretariats"
                                               name="warranty_secretariats" disabled>
                                        <div class="text-danger">{{$errors->first('warranty_secretariats')}}</div>
                                    </div>
                                </div>
                                </div>

                              <div class="col">
                                <label class="col control-label">مساهمات الضمان:* </label>

                                <div class="col">
                                    <input type="text" value="" class="form-control text-input" id="warranty_contributions"
                                           name="warranty_contributions" disabled>
                                    <div class="text-danger">{{$errors->first('warranty_contributions')}}</div>
                                </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">المبلغ الكلي:* </label>

                                <div class="col">
                                    <input type="text" class="disable form-control"value="" id="amount" name="amount">

                                    <div class="text-danger">{{$errors->first('amount')}}</div>
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
                                    <a href="/CMS/ReceiptWarranty/" class="btn btn-danger"> إلغاء</a>
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

@cannot('تعديل صرف ضمان')
    <div class="col-md-offset-1 col alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
            $.get("/CMS/MSalary/" + id,
                function(data) {
                    $('#salary').val(data.id);
                    $('#salary_warranty').val(data.salary_warranty);
                    $('#warranty_secretariats').val(data.warranty_secretariats);
                    $('#warranty_contributions').val(data.warranty_contributions);
                    $('#amount').val((parseFloat(data.warranty_contributions)+parseFloat(data.warranty_secretariats)).toFixed(2));
                    $('#amount').val((parseFloat(data.warranty_contributions)+parseFloat(data.warranty_secretariats)).toFixed(2));
                });
        });
    });
    window.onload = function() {
        if ($('#employee_id').val()!=null){
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
        }
        if ($('#month').val()!=null){
            var id=$('#month').val();
            $.get("/CMS/MSalary/" + id,
                function(data) {
                    $('#salary').val(data.id);
                    $('#salary_warranty').val(data.salary_warranty);
                    $('#warranty_secretariats').val(data.warranty_secretariats);
                    $('#warranty_contributions').val(data.warranty_contributions);
                    $('#amount').val((parseFloat(data.warranty_contributions)+parseFloat(data.warranty_secretariats)).toFixed(2));
                    $('#amount').val((parseFloat(data.warranty_contributions)+parseFloat(data.warranty_secretariats)).toFixed(2));
                });
        }
    };
</script>
@endsection
