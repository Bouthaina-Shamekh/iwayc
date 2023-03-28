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
@can('اضافة  قبض مستودع')
<a class="btn btn-primary btn-md" href="{{ route("RepositoryIn.create") }}"><i class='fas fa-plus'style="margin-left: 10px">قبض مستودع جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('RepositoryIn.index') }}">رجوع</a>
@stop
@endsection

@section('content')

 @can('عرض  قبض مستودع')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                   <form id="formID" class="formular form-horizontal ls_form">
                    <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الزبون:* </label>
                                    <input type="text" value="{{$item->customer}}" class="form-control" id="customer"
                                           name="customer" disabled>
                                </div>
                                <div class="col">
                                <label class="control-label">رقم الورقي:* </label>
                                    <input type="text" value="{{$item->id_comp}}" class="form-control" id="id_comp"
                                           name="id_comp" disabled>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم المستودع:* </label>
                                    <input type="text" value="{{\App\Models\Repository::find($item->repository_id)->name}}" class="form-control" id="repository_id"
                                           name="repository_id" disabled>
                                </div>
                        <div class="col">
                                <label class="control-label">اسم القسم:* </label>
                                    <input type="text" value="{{\App\Models\Rep_section::find($item->section)->name}}" class="form-control" id="section"
                                           name="section" disabled>
                                </div>
                           <div class="col">
                                <label class="control-label">اسم الصنف:* </label>
                                    <input type="text" value="{{\App\Models\Material::find($item->material_id)->name}}" class="form-control" id="name"
                                           name="name" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">العدد المتوفر:* </label>
                                    <input type="text" value="{{$item->count}}" class="form-control" id="count"
                                           name="count" disabled>
                                </div>

                              <div class="col">
                                <label class="control-label">سعر البيع فردي:* </label>
                                    <input type="text" value="{{$item->single_pay}}" class="form-control" id="single_pay"
                                           name="single_pay" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">العدد:* </label>
                                    <input type="text" value="{{$item->quantity}}" class="form-control" id="quantity"
                                           name="quantity" disabled>
                                </div>
                          <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input type="text" value="{{$item->total}}" class="form-control" id="total"
                                           name="total" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات:* </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>

                        </div><br>

                          <div class="row">
                            <div class="col">
                                <label style="font-size:15px" class="col-md-3 control-label" id="print"  name="print">الطباعة: <span class="tag tag-purple"style="font-size:16px">{{$item->print?'فعال':'غير فعال'}}</span></label>

                            </div>
                        </div><br>
                        <div class="row last">
                            <div class="col text-center">
                                <label class="control-label"></label>

                                <div class="col-sm-12">
                                    @can('تعديل  قبض مستودع')
                                    <a href="/CMS/RepositoryIn/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/RepositoryIn/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>
                    </form>
        </div>
    </div>
</div>
<!-- row closed -->

 @endcan
    @cannot('عرض  قبض مستودع')
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
