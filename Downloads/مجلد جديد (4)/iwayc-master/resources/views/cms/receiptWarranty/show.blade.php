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
<a class="btn btn-primary btn-md" href="{{ route('ReceiptWarranty.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه سند صرف جديد </a>

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('AbsenceT.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض صرف ضمان')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                         <div class="row">
                            <div class="col">
                                <label class="col control-label">رقم السند الحاسوبي: </label>

                                <div class="col">
                                    <input type="text" value="{{$item->id}}" class="form-control" id="id"
                                           name="id" disabled>
                                </div>
                                </div>

                                  <div class="col">
                                    <label class="col control-label">رقم السند الورقي: </label>

                                    <div class="col">
                                        <input type="text" value="{{$item->id_comp}}" class="form-control" id="id_comp"
                                               name="id_comp" disabled>
                                    </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">التاريخ: </label>

                                <div class="col">
                                    <input type="text" value="{{$item->date}}" class="form-control" id="date"
                                           name="date" disabled>
                                </div>
                                </div>

                            <div class="col">
                                <div class="form-group">
                                    <label class="col control-label">الموظف:* </label>

                                    <div class="col">
                                        <input type="text" value="{{\App\Models\Employee::find(\App\Models\Salary::find($item->salary_id)->employee_id)->name}}" class="form-control" id="employee_id"
                                               name="employee_id" disabled>
                                    </div>
                                </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">الشهر والسنة:* </label>

                                <div class="col">
                                    <input type="text" value="{{\App\Models\Salary::find($item->salary_id)->month}} - {{\App\Models\Salary::find($item->salary_id)->year}}" class="form-control" id="month"
                                           name="month" disabled>
                                </div>
                                </div>

                        <div class="col">
                            <label class="col control-label">الراتب في الضمان:* </label>

                            <div class="col">
                                <input type="text" value="{{\App\Models\Salary::find($item->salary_id)->salary_warranty}}" class="form-control text-input" id="salary_warranty"
                                       name="salary_warranty" disabled>
                            </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">امانات الضمان:* </label>

                                <div class="col">
                                    <input type="text" value="{{\App\Models\Salary::find($item->salary_id)->warranty_secretariats}}" class="form-control text-input" id="warranty_secretariats"
                                           name="warranty_secretariats" disabled>
                                </div>
                                </div>

                                <div class="col">
                                    <label class="col control-label">مساهمات الضمان:* </label>

                                    <div class="col">
                                        <input type="text" value="{{\App\Models\Salary::find($item->salary_id)->warranty_contributions}}" class="form-control text-input" id="warranty_contributions"
                                               name="warranty_contributions" disabled>
                                    </div>
                                    </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">المبلغ الكلي:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->amount}}" class="form-control" id="amount"
                                           name="amount" disabled>
                                </div>
                                </div>

                        </div><br>



                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات:* </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>

                        </div><br>



                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    @can('تعديل صرف ضمان')
                                    <a href="/CMS/ReceiptWarranty/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/ReceiptWarranty/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>


        </div>
    </div>
</div>
<!-- row closed -->
@endcan
@cannot('عرض صرف ضمان')
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

@endsection
