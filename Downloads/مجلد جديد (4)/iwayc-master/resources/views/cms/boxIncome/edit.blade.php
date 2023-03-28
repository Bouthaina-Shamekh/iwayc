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
@can('اضافة ايراد صندوق')
<a class="btn btn-primary btn-md" href="/CMS/create/BoxIncome/{{$item->box_id}}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة نوع ايراد جديد </a>
  @endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="/CMS/BoxIncomes/{{$item->box_id}}">رجوع</a>
@stop
@endsection
@section('content')

    @can('تعديل ايراد صندوق')

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
                    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/BoxIncome/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col-8">
                                <label class="control-label">اسم الايراد:* </label>

                                    <input type="hidden" value="{{$item->box_id}}" name="box_id" id="box_id">
                                    <input type="text" value="{{$item->name}}" class="form-control validate[required] text-input" id="name"
                                           name="name" placeholder="أدخل اسم الايراد">
                                    <div class="text-danger">{{$errors->first('name')}}</div>

                            </div>
                        </div><br>

                        <div class="row last">
                            <div class="col-12 text-center">
                                <label class="control-label"></label>
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/BoxIncomes/{{$item->box_id}}" class="btn btn-danger"> إلغاء</a>
                            </div>
                        </div><br>
                    </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
    @endcan

    @cannot('تعديل ايراد صندوق')
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
