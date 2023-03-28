@extends('layouts.master')
@section('css')

<style>
input .largerCheckbox {
    width : 50px;
    height :50px;
}
label span{
    position: absolute;
    bottom: 10px !important;
    right: 54px;
}
</style>

@section('title')
Iwayc System

@endsection

@section('title-page-header')
الاعدادات / الصلاحيات

@endsection
@section('page-header')
اضافة نوع مستخدم

@endsection
@section('button1')

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('roles.index') }}">رجوع</a>
@stop
@endsection

@section('content')

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




{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    <div class="col-xs-7 col-sm-7 col-md-7">
                        <div class="form-group">
                            <p>اسم الصلاحية :</p>
                            {!! Form::text('name', null, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>

                    <!-- /col -->
                      <div class="row">
                            <div class="col">
                                <label class=" h4 control-label">صلاحيات</label>
                                 </div>
                        </div><br>
                                  <div class="row">
                                    @foreach ($permission as $value)
                                <label class="checkbox  col-3  h5"style="">
                                <input class="icheck-green largerCheckbox"type="checkbox" name="permission[]" id="{{$value->id}}" value="{{$value->id}}">
                                <span> {{$value->name}}</span>
                                </label>
                                    @endforeach
                               </div><br>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-main-primary">تاكيد</button>
                    </div>
            </div>
        </div>
    </div>

</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->

{!! Form::close() !!}
@endsection
@section('js')

@endsection
