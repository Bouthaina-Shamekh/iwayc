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
الصلاحيات

@endsection
@section('page-header')
تعديل الصلاحيات

@endsection
@section('button1')
<a class="btn btn-primary btn-md" href="{{ route('roles.create') }}">إضافه صلاحيه جديده</a>
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


{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    <div class="form-group">
                        <p>اسم الصلاحية :</p>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>

                   <!-- /col -->
                        <div class="row">
                            <div class="col">
                                <label class=" h5 control-label">صلاحيات</label>
                             </div>
                        </div><br>
                          <div class="row">

                                    @foreach ($permission as $value)
                                <label class="checkbox col-md-3 h5"style="">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'largerCheckbox',)) }}
                                  <span> {{$value->name}} </span>
                                </label>
                                    @endforeach
                        </div><br>



                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-main-primary">تحديث</button>
                    </div>
                    <!-- /col -->

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
