@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@section('title')
Iwayc System

@endsection

@section('title-page-header')
المستخدمين

@endsection
@section('page-header')
تعديل مستخدم

@endsection
@section('button1')
@can('اضافة مستخدم')
<a class="btn btn-primary btn-md" href="{{ route('users.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه مستخدم جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('users.index') }}">رجوع</a>
@stop
@endsection
@section('content')

@can('تعديل مستخدم')



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
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">

                    </div>
                </div><br>

                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <div class="">

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6" id="fnWrapper">
                            <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                            {!! Form::text('name', null, array('class' => 'form-control','required')) !!}
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                            {!! Form::text('email', null, array('class' => 'form-control','required')) !!}
                        </div>
                    </div>

                </div>

                <div class="row mg-b-20">
                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label>كلمة المرور: <span class="tx-danger">*</span></label>
                        {!! Form::password('password', array('class' => 'form-control','required')) !!}
                    </div>

                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                        {!! Form::password('confirm-password', array('class' => 'form-control','required')) !!}
                    </div>
                </div>

                <div class="row row-sm mg-b-20">
                    <div class="col-lg-6">
                        <label class="form-label">حالة المستخدم</label>
                        <select name="Status" id="select-beast" class="form-control  nice-select  custom-select">
                            @if ($user->Status == 'مفعل')
                                <option value="مفعل"selected>مفعل</option>
                                <option value="غير مفعل">غير مفعل</option>
                            @else
                                <option value="مفعل">مفعل</option>
                                <option value="غير مفعل"selected>غير مفعل</option>
                            @endif

                        </select>
                    </div>
                </div>

                <div class="row mg-b-20">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>نوع المستخدم</strong>
                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control form-control-lg select2','multiple'))
                            !!}
                        </div>
                    </div>
                </div>
                <div class="mg-t-30 text-center">
                    <button class="btn btn-main-primary pd-x-20" type="submit">تحديث</button>
                     <a class="btn btn-danger pd-x-20 "href="{{ route('users.index') }}">الغاء</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>




</div>
<!-- row closed -->
@endcan
@cannot('تعديل مستخدم')
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

<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection
