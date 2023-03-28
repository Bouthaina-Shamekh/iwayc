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
<a class="btn btn-primary btn-md" href="{{ route('ReceiptAdvance.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه سند صرف جديد </a>

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="#">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض صرف سلفة')
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
                                <label class="control-label">سنة الميلاد:* </label>


                                    <input type="text" value="{{$item->birthday}}" class="form-control" id="birthday"
                                           name="birthday" disabled>
                                </div>
                            <div class="col">
                                <label class="col control-label">التاريخ: </label>

                                <div class="col">
                                    <input type="text" value="{{$item->date}}" class="form-control" id="date"
                                           name="date" disabled>
                                </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">الموظف:* </label>

                                <div class="col">
                                    <input type="text" value="{{\App\Models\Employee::find($item->employee_id)->name}}" class="form-control" id="employee_id"
                                           name="employee_id" disabled>
                                </div>
                                </div>

                        <div class="col">
                            <label class="col control-label">مبلغ السلفة:* </label>

                            <div class="col">
                                <input type="text" value="{{$item->advance_payment}}" class="form-control" id="advance_payment"
                                       name="advance_payment" disabled>
                            </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">عدد شهور السداد:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->month_count}}" class="form-control" id="month_count"
                                           name="month_count" disabled>
                                </div>
                                </div>
                              <div class="col">
                                <label class="col control-label">دفعات السداد الشهري:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->month_payment}}" class="form-control" id="month_payment"
                                           name="month_payment" disabled>
                                </div>
                                </div>
                         <div class="col">
                            <label class="col control-label">يبدأ السداد من راتب شهر:* </label>

                            <div class="col">
                                <input type="text" value="{{$item->start_payment}}" class="form-control" id="start_payment"
                                       name="advance_payment" disabled>
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
                                    @can('تعديل صرف سلفة')
                                    <a href="/CMS/ReceiptAdvance/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/ReceiptAdvance/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>


        </div>
    </div>
</div>
<!-- row closed -->
@endcan
    @cannot('عرض صرف سلفة')
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
