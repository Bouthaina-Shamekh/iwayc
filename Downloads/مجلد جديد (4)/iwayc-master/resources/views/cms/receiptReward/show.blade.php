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
@can('عرض صرف مكافأة')
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
                                <label class="col control-label">النوع:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->type?'مكافأت':'خصومات'}}" class="form-control" id="type"
                                           name="type" disabled>
                                </div>
                                </div>

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
                                <label class="col control-label">الاضافة والخصم من شهر:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->receipts_rewards}}" class="form-control" id="receipts_rewards"
                                           name="receipts_rewards" disabled>
                                </div>
                                </div>

                              <div class="col">
                                <label class="col control-label">تصنيف السبب:* </label>

                                <div class="col">
                                    <input type="text" value="{{\App\Models\Option::find($item->reason)->title}}" class="form-control" id="reason"
                                           name="reason" disabled>
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
                                    @can('تعديل صرف مكافأة')
                                    <a href="/CMS/ReceiptReward/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/ReceiptReward/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>


        </div>
    </div>
</div>
<!-- row closed -->

@endcan
@cannot('عرض صرف مكافأة')
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
