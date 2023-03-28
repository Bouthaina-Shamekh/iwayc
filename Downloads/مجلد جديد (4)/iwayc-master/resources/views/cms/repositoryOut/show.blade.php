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
@can('اضافة صرف مستودع')
<a class="btn btn-primary btn-md" href="{{ route('RepositoryOut.create') }}"><i class='fas fa-plus'style="margin-left: 10px">صرف مستودع جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('RepositoryOut.index') }}">رجوع</a>
@stop
@endsection

@section('content')

   @can('عرض صرف مستودع')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                 <form id="formID" class="formular form-horizontal ls_form">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم المستودع:* </label>
                                    <input type="text" value="{{\App\Models\Repository::find($item->repository_id)->name}}" class="form-control" id="repository_id"
                                           name="repository_id" disabled>
                                </div>

                        </div><br>
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
                                <label class="control-label">البيان:* </label>
                                    <textarea class="animatedTextArea form-control" id="statement" name="statement"
                                              disabled>{{$item->statement}}</textarea>
                                </div>

                        </div><br>
                        <div class="row">
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
                                    @can('تعديل صرف مستودع')
                                    <a href="/CMS/RepositoryOut/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/RepositoryOut/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div>

                    </form>
        </div>
    </div>
</div>
<!-- row closed -->
  @endcan
    @cannot('عرض صرف مستودع')
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
