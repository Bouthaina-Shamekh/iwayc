@extends('layouts.master')
@section('css')
<!--Internal  Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal  treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview-rtl.css')}}" rel="stylesheet" type="text/css" />

@section('title')
Iwayc System

@endsection

@section('title-page-header')
الصلاحيات

@endsection
@section('page-header')
عرض الصلاحيات

@endsection
@section('button1')
<a class="btn btn-primary btn-md" href="{{ route('roles.create') }}">إضافه صلاحيه جديده</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('roles.index') }}">رجوع</a>
@stop
@endsection
@section('content')

<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">

                <div class="row">
                    <!-- col -->
                    <div class="col-lg-4 h5">
                        <ul id="treeview1">
                            <li><a href="#">{{ $role->name }}</a>
                                <ul>
                                    @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $v)
                                    <li>{{ $v->name }}</li>
                                    @endforeach
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /col -->
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
@endsection
@section('js')
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>

@endsection
