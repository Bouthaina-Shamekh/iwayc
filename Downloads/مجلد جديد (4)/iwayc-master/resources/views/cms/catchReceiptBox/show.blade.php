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
  @can('اضافة قبض صندوق')
<a class="btn btn-primary btn-md" href="{{ route('CatchReceiptBox.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة سند قبض جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('CatchReceiptBox.index') }}">رجوع</a>
@stop
@endsection

@section('content')
    @can('عرض قبض صندوق')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                        <form id="formID" class="formular form-horizontal ls_form">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">رقم السند الحاسوبي: </label>
                                    <input type="text" value="{{$item->id}}" class="form-control" id="id"name="id" disabled>
                                </div>

                                 <div class="col">
                                <label class="control-label">رقم السند الورقي: </label>
                                    <input type="text" value="{{$item->id_comp}}" class="form-control" id="id_comp"
                                           name="id_comp" disabled>
                                </div>

                              <div class="col">
                                <label class="control-label">التاريخ: </label>
                                    <input type="text" value="{{$item->date}}" class="form-control" id="date"
                                           name="date" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الصندوق الفرعي:* </label>
                                    <input type="text" value="{{\App\Models\Box::find($item->box_id)->name}}" class="form-control" id="box_id"
                                           name="box_id" disabled>
                                </div>
                                  <div class="col">
                                <label class="control-label">تصنيف الايراد:* </label>
                                    <input type="text" value="{{\App\Models\Box_income::find($item->type)->name}}" class="form-control" id="type"
                                           name="type" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الزبون:* </label>
                                    <input type="text" value="{{$item->customer}}" class="form-control" id="customer"
                                           name="customer" disabled>
                                </div>
                               <div class="col">
                                <label class="control-label">العدد:* </label>
                                    <input type="text" value="{{$item->count}}" class="form-control" id="count"
                                           name="count" disabled>
                                </div>

                                      <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input type="text" value="{{$item->amount}}" class="form-control" id="amount"
                                           name="amount" disabled>
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
                                    @can('تعديل قبض صندوق')
                                    <a href="/CMS/CatchReceiptBox/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Static/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>



        </div>
    </div>
</div>
<!-- row closed -->

 @endcan
    @cannot('عرض قبض صندوق')
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
