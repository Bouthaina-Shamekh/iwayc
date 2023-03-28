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
<a class="btn btn-primary btn-md" href="{{ route('Box.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه صندوق جديد </a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Box.index') }}">رجوع</a>
@stop
@endsection
@section('content')
  @can('تعديل صندوق')


<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


      <div class="card">
      <div class="card-body">
    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Box/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الصندوق:* </label>
                                    <input type="text" value="{{$item->name}}" class="form-control validate[required] text-input" id="name"
                                           name="name" placeholder="أدخل اسم الصندوق">
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                </div>
                        <div class="col">
                                <label class="control-label">السنة المالية:* </label>
                                    <select name="m_year" id="m_year" class="form-control">
                                        @foreach($moneyYears as $moneyYear)
                                            <option {{$item->m_year==$moneyYear->year?"selected":""}} value="{{$moneyYear->year}}"> {{$moneyYear->year}} </option>
                                        @endforeach

                                    </select>
                                    <div class="text-danger">{{$errors->first('m_year')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">نوع الصندوق:* </label>
                                    <select name="type" id="type" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($types as $type)
                                            <option {{$item->type==$type->id?"selected":""}} value="{{$type->id}}"> {{$type->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('type')}}</div>
                                </div>

                                   <div class="col">
                                <label class="control-label">حساب اول المدة:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" value="{{$box_year->calculator_first}}" class="form-control text-input" id="calculator_first"
                                           name="calculator_first" placeholder="أدخل حساب اول المدة">
                                    <div class="text-danger">{{$errors->first('calculator_first')}}</div>
                                </div>
                       <div class="col">
                                <label class="control-label">الصندوق التابع:* </label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        <option {{$item->parent_id==1?"selected":""}} value="1"> الصندوق الرئيسي </option>
                                        <option {{$item->parent_id==2?"selected":""}} value="2"> صندوق المركز </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('parent_id')}}</div>
                                </div>

                        </div><br>
                          <div class="row ">
                               <div class="col-1">

                            </div>
                            <div class="col">
                                <label for="inputName" class="h4">فعال :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox" id="active" name="active"{{$item->active?"checked":""}}>
                            </div>
                        </div><br>
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

    @cannot('تعديل صندوق')
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
