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
@can('اضافة صادر صندوق')
<a class="btn btn-primary btn-md" href="/CMS/create/BoxExpense/{{$item->box_id}}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة نوع مصروف جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="/CMS/BoxIncomes/{{$item->box_id}}">رجوع</a>
@stop
@endsection
@section('content')
    @can('تعديل صادر صندوق')

<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
        <div class="card-body">
                   <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/BoxExpense/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class=" control-label">اسم المصروف:* </label>
                                    <input type="hidden" value="{{$item->box_id}}" name="box_id" id="box_id">
                                    <input type="text" value="{{$item->name}}" class="form-control validate[required] text-input" id="name"
                                           name="name" placeholder="أدخل اسم المصروف">
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                </div>
                            </div><br>


                        <div class="row ls_divider last">
                            <div class="col text-center">
                                <label class="control-label"></label>

                                <div class="col-sm-12">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/BoxIncomes/{{$item->box_id}}" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div>

                    </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
     @endcan

    @cannot('تعديل صادر صندوق')
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
