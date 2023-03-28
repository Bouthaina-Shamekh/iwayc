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
@can('اضافة صنف')
<a class="btn btn-primary btn-md" href="{{ route('Material.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة صنف جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Material.index') }}">رجوع</a>
@stop
@endsection

@section('content')
  @can('عرض صنف')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                      <form id="formID" class="formular form-horizontal ls_form">

                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الصنف:* </label>
                                    <input type="text" value="{{$item->name}}" class="form-control" id="name"
                                           name="name" disabled>
                                </div>
                              <div class="col">
                                <label class="control-label">التاريخ:* </label>
                                    <input type="text" value="{{substr($item->created_at,0,10)}}" class="form-control" id="created_at"
                                           name="created_at" disabled>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم المستودع:* </label>
                                    <input type="text" value="{{\App\Models\Repository::find($item->repository_id)->name}}" class="form-control" id="repository_id"
                                           name="repository_id" disabled>
                                </div>
                         <div class="col">
                                <label class="control-label">القسم:* </label>
                                    <input type="text" value="{{\App\Models\Rep_section::find($item->section)->name}}" class="form-control" id="section"
                                           name="section" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">العدد الاولي:* </label>
                                    <input type="text" value="{{$item->count_old}}" class="form-control" id="count_old"
                                           name="count_old" disabled>
                                </div>
                             <div class="col">
                                <label class="control-label">العدد المتوفر الان:* </label>
                                    <input type="text" value="{{$item->count_new}}" class="form-control" id="count_new"
                                           name="count_new" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">التكلفة الفردية:* </label>
                                    <input type="text" value="{{$item->single_cost}}" class="form-control" id="single_cost"
                                           name="single_cost" disabled>
                                </div>
                             <div class="col">
                                <label class="control-label">سعر البيع فردي:* </label>
                                    <input type="text" value="{{$item->single_pay}}" class="form-control" id="single_pay"
                                           name="single_pay" disabled>
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
                                      @php
                                          if($item->active == 1){
                                                echo '<input class="form-control form-control-lg" value="فعال" disabled >';
                                          }else{
                                             echo '<input class="form-control form-control-lg" value="غير فعال" disabled >';
                                          }
                                      @endphp
                                </div>
                                </div><br>

                        <div class="row last">
                            <div class="col-12 text-center">
                                <label class="control-label"></label>

                                <div class="col-sm-12">
                                    @can('تعديل صنف')
                                    <a href="/CMS/Material/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Material/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>


        </div>
    </div>
</div>
<!-- row closed -->
    @endcan
    @cannot('عرض صنف')
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
