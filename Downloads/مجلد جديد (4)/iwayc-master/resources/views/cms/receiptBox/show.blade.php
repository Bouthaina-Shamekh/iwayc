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
@can('اضافة  صرف صندوق')
<a class="btn btn-primary btn-md" href="{{ route('ReceiptBox.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافة سند صرف جديد</a>
@endcan
@endsection
@section('button2')

<a class="btn btn-primary btn-md" href="{{ route('ReceiptBox.index') }}">رجوع</a>

@stop
@endsection

@section('content')

   @can('عرض  صرف صندوق')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                 <div class="row ">
                            <div class="col">
                                <label class="control-label">رقم السند الحاسوبي: </label>
                                    <input type="text" value="{{$item->id}}" class="form-control" id="id"
                                           name="id" disabled>
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

                        <div class="row ">
                            <div class="col">
                                <label class="control-label">الصندوق الفرعي:* </label>
                                    <input type="text" value="{{\App\Models\Box::find($item->box_id)->name}}" class="form-control" id="box_id"
                                           name="box_id" disabled>
                                </div>

                                     <div class="col">
                                <label class="control-label">تصنيف المصروف:* </label>
                                    <input type="text" value="{{\App\Models\Box_expense::find($item->type)->name}}" class="form-control" id="type"
                                           name="type" disabled>
                                </div>
                                  <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input type="text" value="{{$item->amount}}" class="form-control" id="amount"
                                           name="amount" disabled>
                                </div>

                        </div><br>

                        <div class="row ">
                            <div class="col">
                                <label class="control-label">ملاحظات:* </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>

                        </div><br>

                        <div class="row  last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    @can('تعديل  صرف صندوق')
                                    <a href="/CMS/ReceiptBox/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/ReceiptBox/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>

        </div>
    </div>
</div>
<!-- row closed -->

 @endcan
    @cannot('عرض  صرف صندوق')
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
