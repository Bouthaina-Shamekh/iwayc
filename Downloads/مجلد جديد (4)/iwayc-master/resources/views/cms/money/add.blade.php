@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">


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
<a class="btn btn-primary btn-md" href="{{ route('Money.index') }}">رجوع</a>
@stop
@endsection
@section('content')
    @can('اضافة سنة مالية')

<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12" >
        <div class="card">
           <h3 class="panel-title">اضافة سنة مالية جديدة</h3>
            <div class="card-body">
                    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Money">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">العام:* </label>
                                    <input required type="number" value="{{old('year')}}" class="form-control" id="year"
                                           name="year" min="1950" >
                                    <div class="text-danger">{{$errors->first('year')}}</div>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الهدف المالي:* </label>
                                    <input required type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{old("money_goal")}}" class="form-control validate[required] text-input" id="money_goal"
                                           name="money_goal" placeholder="الهدف المالي">
                                    <div class="text-danger">{{$errors->first('money_goal')}}</div>
                                </div>
                        <div class="col">
                                <label class="control-label">رصيد اول المدة للصندوق الرئيسي:* </label>
                                    <input required type="number" onchange="setTwoNumberDecimal(this)" step="any"  value="{{old("first_time_balance")}}" class="form-control validate[required] text-input" id="first_time_balance"
                                           name="first_time_balance" placeholder="أدخل رصيد اول المدة للصندوق الرئيسي">
                                    <div class="text-danger">{{$errors->first('first_time_balance')}}</div>
                                </div>

                        </div><br>
                             <div class="row">
                            <div class="col">
                                <label class="control-label">يظهر هذا العام لـ:* </label>
                                    <select required name="user_show[]" id="select-state" multiple class="form-control form-control-lg select2">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($users as $user)
                                            <option {{old("user_show")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('user_show')}}</div>
                                </div>
                            </div><br>

                    <div class="row ls_divider">
                           <div class="col-1">

                            </div>
                            <div class="col">
                                <label for="inputName" class="h4">فعال :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox" id="active" name="active"
                               {{old("active")?"checked":""}}>
                            </div>
                        </div><br>

                        <div class="row last">
                            <div class="col text-center">
                                <label class="control-label"></label>
                                <div class="col">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Money/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
 @endcan

    @cannot('اضافة سنة مالية')
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
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

@endsection
