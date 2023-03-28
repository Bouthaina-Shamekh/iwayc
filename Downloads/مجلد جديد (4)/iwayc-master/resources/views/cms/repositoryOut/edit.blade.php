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
@can('اضافة صرف مستودع')
<a class="btn btn-primary btn-md" href="{{ route('RepositoryOut.create') }}"><i class='fas fa-plus'style="margin-left: 10px">صرف مستودع جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('RepositoryOut.index') }}">رجوع</a>
@stop
@endsection
@section('content')

   @can('تعديل صرف مستودع')
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">

        <div class="card">
        <div class="card-body">
     <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/RepositoryOut/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">

                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم المستودع:* </label>
                                    <select name="repository_id" id="repository_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($repositories as $repository)
                                            <option {{$item->repository_id==$repository->id?"selected":""}} value="{{$repository->id}}"> {{$repository->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('repository_id')}}</div>
                                </div>
                                    <div class="col">
                                <label class="control-label">رقم الورقي:* </label>
                                    <input type="text" value="{{$item->id_comp}}" class="form-control disable" id="id_comp"
                                           name="id_comp">
                                </div>

                        </div><br>
                        <div class="row">

                         <div class="col">
                                <label class="control-label">السنة المالية:* </label>
                                    <select name="m_year" id="m_year" class="form-control disable">
                                        @foreach($moneyYears as $moneyYear)
                                            <option {{$item->m_year==$moneyYear->year?"selected":""}} value="{{$moneyYear->year}}"> {{$moneyYear->year}} </option>
                                        @endforeach

                                    </select>
                                    <div class="text-danger">{{$errors->first('m_year')}}</div>
                                </div>
                            <div class="col">
                                <label class="control-label">اسم الزبون:* </label>
                                    <input type="text" value="{{$item->customer}}" class="form-control validate[required] text-input" id="customer"
                                           name="customer" placeholder="أدخل اسم الزبون">
                                    <div class="text-danger">{{$errors->first('customer')}}</div>
                                </div>


                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">البيان:* </label>
                                    <textarea class="animatedTextArea form-control" id="statement" name="statement"
                                              placeholder="أدخل البيان">{{$item->statement}}</textarea>
                                    <div class="text-danger">{{$errors->first('statement')}}</div>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->total}}" class="form-control text-input" id="total"
                                           name="total" placeholder="أدخل المبلغ">
                                    <div class="text-danger">{{$errors->first('total')}}</div>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{$item->notes}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>

                        </div><br>
                        <div class="row ">
                               <div class="col-1">

                            </div>
                            <div class="col">
                                <label for="inputName" class="h4">الطباعة :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox"id="print" name="print" {{$item->print?"checked":""}}>
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
                        </div>

                    </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->@endcan

    @cannot('تعديل صرف مستودع')
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
