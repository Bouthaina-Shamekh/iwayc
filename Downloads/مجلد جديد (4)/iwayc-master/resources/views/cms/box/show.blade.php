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

  @can('اضافة صندوق')
  <a class="btn btn-primary btn-md" href="{{ route('Box.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة صندوق جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Box.index') }}">رجوع</a>
@stop
@endsection

@section('content')
  @can('عرض صندوق')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
            <div class="row">
                        <div class="col">
                                <label class="control-label">اسم الصندوق:* </label>
                                    <input type="text" value="{{$item->name}}" class="form-control" id="name"
                                           name="name" disabled>
                                </div>

                           <div class="col">
                                <label class="control-label">نوع الصندوق:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->type)->title}}" class="form-control" id="type"
                                           name="type" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">حساب اول المدة:* </label>
                                    <input type="text" value="{{$item->calculator_first}}" class="form-control" id="calculator_first"
                                           name="calculator_first" disabled>
                                </div>

                          <div class="col">
                                <label class="control-label">الصندوق التابع:* </label>
                                    <input type="text" value="{{$item->parent_id!=null?\App\Models\Box::find($item->parent_id)->name:'غير تابع لصندوق'}}" class="form-control" id="parent_id"
                                           name="parent_id" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الايرادات:* </label>
                                    <input type="text" value="{{$income}}" class="form-control" id="income"
                                           name="income" disabled>
                                </div>

                              <div class="col">
                                <label class="control-label">المصروفات:* </label>
                                    <input type="text" value="{{$expense}}" class="form-control" id="expense"
                                           name="expense" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الفعالية:* </label>
                                    <input type="text" value="{{$item->active?'فعال':'غير فعال'}}" class="form-control" id="active"
                                           name="active" disabled>
                                </div>

                        </div><br>

                        <div class="row last">
                            <div class="col text-center">
                                <label class="control-label"></label>

                                <div class="col-sm-12">
                                    @can('تعديل صندوق')
                                    <a href="/CMS/Box/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                        <a href="/CMS/Box/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                </div>
            </div>
        </div>
    </div>



        </div>
    </div>
</div>
<!-- row closed -->


    @endcan
    @cannot('عرض صندوق')
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
