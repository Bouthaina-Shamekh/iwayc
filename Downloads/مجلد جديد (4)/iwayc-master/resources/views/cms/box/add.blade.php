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
<a class="btn btn-primary btn-md" href="/CMS/Box">رجوع</a>
@stop
@endsection
@section('content')

  @can('اضافة صندوق')

    <?php $userL = \App\Models\User_year::where('user_id',Auth::user()->id)->count(); ?>
    @if ($userL>0)
        <?php
        $userY = \App\Models\User_year::where('user_id',Auth::user()->id)->first();
        $uY = $userY->year;
        ?>
    @else
        <?php $uY = null; ?>
    @endif

<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">


        <div class="card">
            <div class="card-body">
                           <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Box">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الصندوق:* </label>
                                <input type="hidden" value="{{$userL>0?$uY:$moneyWork->year}}" id="edu_year_h" name="edu_year_h">
                                    <input type="text" value="{{old('name')}}" class="form-control validate[required] text-input" id="name"
                                           name="name" placeholder="أدخل اسم الصندوق">
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                </div>
                        <div class="col">
                                <label class="control-label">نوع الصندوق:* </label>
                                    <select name="type" id="type" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($types as $type)
                                            <option {{old("type")==$type->id?"selected":""}} value="{{$type->id}}"> {{$type->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('type')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">حساب اول المدة:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" value="{{old("calculator_first")?old("calculator_first"):0}}" class="form-control validate[required] text-input" id="calculator_first"
                                           name="calculator_first" placeholder="أدخل حساب اول المدة">
                                    <div class="text-danger">{{$errors->first('calculator_first')}}</div>
                                </div>

                        <div class="col">
                                <label class="control-label">الصندوق التابع له:* </label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        <option {{old("parent_id")==1?"selected":""}} value="1"> الصندوق الرئيسي </option>
                                        <option {{old("parent_id")==2?"selected":""}} value="2"> صندوق المركز </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('parent_id')}}</div>
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
                        </div>

                        <div class="row last">
                            <div class="col-12 text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-12">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Box/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('اضافة صندوق')
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
