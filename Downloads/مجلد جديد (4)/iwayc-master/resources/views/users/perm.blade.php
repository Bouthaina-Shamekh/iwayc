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
{{ $title }}
@endsection
@section('page-header')
{{ $subtitle }}

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
@can('اضافة صلاحية خاصة')


    <div class="row">
        <div class="col-md-12 col-md-offset-1">

            <div class="panel panel-default">

                    <h3 class="panel-title">اضافة صلاحيات للمستخدم :  {{$item->name}}</h3>

                <div class="panel-body form_view">
                    <form id="form" class="formular form-horizontal ls_form" method="post" action="/CMS/User/permm/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="name_f" id="name_f" value="{{$item->id}}" ><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label h4">صلاحيات خاصة:* </label>
                             </div>
                        </div><br>
                           <div class="row">
                                    @foreach ($role as $r)
                                        <label class="checkbox col-3 h5">
                                            <input {{$item->hasRole($r->name)?'checked':''}} class="icheck-green largerCheckbox"
                                                   type="checkbox" name="role[]" id="{{$r->id}}" value="{{$r->id}}">
                                          <span>  {{$r->name}} </span>
                                        </label>
                                    @endforeach
                        </div><br>

                        <div class="row ls_divider">
                            <div class="col text-center">
                                <label class="control-label"></label>

                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-danger"> إلغاء</a>

                            </div>
                        </div><br>


                    </form>
                    @endcan

                    @can('اضافة صلاحية')


                    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/User/perm/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="name_h" id="name_h" value="{{$item->id}}" >
                        <div class="row">
                            <div class="col">
                                <label class="control-label  h4">صلاحيات عامة:* </label>
                            </div>
                        </div><br>

                                 <div class="row">
                                    @foreach ($permission as $p)
                                        <label class="checkbox col-3  h5">
                                            <input {{$item->hasDirectPermission($p->name)?'checked':''}} class="icheck-green largerCheckbox"
                                                   type="checkbox" name="perm[]" id="{{$p->id}}" value="{{$p->id}}">
                                          <span> {{$p->name}} </span>
                                        </label>
                                    @endforeach
                                </div><br>


                        <div class="row ls_divider last">
                            <div class="col text-center">
                                <label class="control-label"></label>


                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-danger"> إلغاء</a>

                            </div>
                        </div>

                    </form>

                    @endcan
                    

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
