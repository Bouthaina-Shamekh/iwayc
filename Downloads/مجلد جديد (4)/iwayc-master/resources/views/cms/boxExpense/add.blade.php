@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="/CMS/BoxIncomes/{{$id}}">رجوع</a>
@stop
@endsection
@section('content')
 @can('اضافة صادر صندوق')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
         <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/BoxExpense">
                        @csrf
                        <input type="hidden" value="{{$id}}" name="box_id" id="box_id">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم المصروف:* </label>
                                    <input type="text" value="{{old('name')}}" class="form-control validate[required] text-input" id="name"
                                           name="name" placeholder="أدخل اسم المصروف">
                                    <div class="text-danger">{{$errors->first('name')}}</div>

                            </div>
                        </div><br>

                        <div class="row ls_divider last">
                            <div class="col text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-12">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/BoxIncomes/{{$id}}" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div>

                    </form><br>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
 @endcan

    @cannot('اضافة صادر صندوق')
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
