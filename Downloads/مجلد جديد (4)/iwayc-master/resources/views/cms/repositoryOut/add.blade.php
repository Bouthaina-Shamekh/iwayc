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

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('RepositoryOut.index') }}">رجوع</a>
@stop
@endsection
@section('content')
    @can('اضافة صرف مستودع')
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
             <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/RepositoryOut">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم المستودع:* </label>
                                <input type="hidden" value="{{$userL>0?$uY:$moneyWork->year}}" id="edu_year_h" name="edu_year_h">

                                    <select name="repository_id" id="repository_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($repositories as $repository)
                                            <option {{old("repository_id")==$repository->id?"selected":""}} value="{{$repository->id}}"> {{$repository->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('repository_id')}}</div>
                                </div>



                        </div><br>
                           <div class="row">

                             <div class="col">
                                    <label class="control-label">رقم الورقي:* </label>
                                        <input type="number" min="0" value="" class="form-control validate[required] text-input" id="id_comp"
                                               name="id_comp" autocomplete="off">
                                        <div class="text-danger">{{$errors->first('id_comp')}}</div>
                                </div>
                              <div class="col">
                                <label class="control-label">الاسم:* </label>
                                    <input type="text" value="{{old('customer')}}" class="form-control validate[required] text-input" id="customer"
                                           name="customer" placeholder="أدخل الاسم">
                                    <div class="text-danger">{{$errors->first('customer')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">البيان:* </label>
                                    <textarea class="animatedTextArea form-control" id="statement" name="statement"
                                              placeholder="أدخل البيان">{{old("statement")}}</textarea>
                                    <div class="text-danger">{{$errors->first('statement')}}</div>
                                </div>
                             <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{old("total")==null?0:old("total")}}" class="form-control text-input" id="total"
                                           name="total" placeholder="أدخل المبلغ">
                                    <div class="text-danger">{{$errors->first('total')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{old("notes")}}</textarea>
                                </div>

                        </div><br>
                       <div class="row">
                        <div class="col-1">

                        </div>
                        <div class="col">
                        <label for="inputName" class="h4">الطباعة :</label>
                        <input type="checkbox" class="largerCheckbox" id="print" name="print"
                               {{old("print")?"checked":""}}>
                            </div>
                        </div><br>

                        <div class="row last">
                            <div class="col text-center">
                                <label class="control-label"></label>

                                <div class="col-sm-12">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/RepositoryOut/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('اضافة صرف مستودع')
        <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            ليس لديك صلاحية يرجي مراجعة المسؤول
        </div>
    @endcannot
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
