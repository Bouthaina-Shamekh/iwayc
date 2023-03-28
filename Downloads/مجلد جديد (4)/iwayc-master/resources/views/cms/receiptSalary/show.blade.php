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
@can('عرض صرف راتب')
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
                                <label class="col control-label">الموظف:* </label>

                                <div class="col">
                                    <input type="text" value="{{\App\Models\Employee::find($item->employee_id)->name}}" class="form-control" id="employee_id"
                                           name="employee_id" disabled>
                                </div>

                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">الشهر:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->month}}" class="form-control" id="month"
                                           name="month" disabled>
                                </div>
                                </div>
                        <div class="col">
                            <label class="col control-label">مكافأت الموظف:* </label>

                            <div class="col">
                                <input type="text" value="{{$item->rewards}}" class="form-control" id="rewards"
                                       name="rewards" disabled>
                            </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">خصومات الموظف:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->receipts}}" class="form-control" id="receipts"
                                           name="receipts" disabled>
                                </div>
                                </div>

                              <div class="col">
                                <label class="col control-label">صافي الراتب:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->nets}}" class="form-control" id="nets"
                                           name="nets" disabled>
                                </div>
                                </div>

                         <div class="col">
                            <label class="col control-label">مقبوضات الموظف:* </label>

                            <div class="col">
                                <input type="text" value="{{$item->salary}}" class="form-control" id="salary"
                                       name="salary" disabled>
                            </div>
                        </div>


                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">سداد ذمم:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->advance_payment}}" class="form-control" id="advance_payment"
                                           name="advance_payment" disabled>
                                </div>
                                </div>
                         <div class="col">
                            <label class="col control-label">باقي الراتب:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->remainder}}" class="form-control" id="remainder"
                                           name="remainder" disabled>
                                </div>
                                </div>


                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">المبلغ:* </label>

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
                                    @can('تعديل طالب')
                                    <a href="/CMS/ReceiptSalary/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/ReceiptSalary/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>


        </div>
    </div>
</div>
<!-- row closed -->
@endcan
    @cannot('عرض صرف راتب')
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

@endsection
