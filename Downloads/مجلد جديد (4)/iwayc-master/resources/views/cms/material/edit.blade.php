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
@can('اضافة صنف')
<a class="btn btn-primary btn-md" href="{{ route('Material.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة صنف جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Material.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('تعديل صنف')


<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


        <div class="card">
        <div class="card-body">
       <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Material/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الصنف:* </label>
                                    <input type="text" value="{{$item->name}}" class="form-control validate[required] text-input" id="name"
                                           name="name" placeholder="أدخل اسم الصنف">
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                </div>

                        </div><br>
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
                                <label class="control-label">القسم:* </label>
                                    <select name="section" id="section" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($sections as $section)
                                            <option {{$item->section==$section->id?"selected":""}} value="{{$section->id}}"> {{$section->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('section')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">العدد الاولي:* </label>
                                    <input type="number" value="{{$item->count_old}}" class="form-control text-input" id="count_old"
                                           name="count_old" placeholder="العدد الاولي">
                                    <div class="text-danger">{{$errors->first('count_old')}}</div>
                                </div>
                          <div class="col">
                                <label class="control-label">العدد المتوفر الان:* </label>
                                    <input type="number" value="{{$item->count_new}}" class="form-control validate[required] text-input" id="count_new"
                                           name="count_new" placeholder="أدخل العدد المضاف">
                                    <div class="text-danger">{{$errors->first('count_new')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">التكلفة الفردية:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->single_cost}}" class="form-control validate[required] text-input" id="single_cost"
                                           name="single_cost" placeholder="أدخل التكلفة الفردية">
                                    <div class="text-danger">{{$errors->first('single_cost')}}</div>
                                </div>
                          <div class="col">
                                <label class="control-label">سعر البيع فردي:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->single_pay}}" class="form-control text-input" id="single_pay"
                                           name="single_pay" placeholder="أدخل سعر البيع فردي">
                                    <div class="text-danger">{{$errors->first('single_pay')}}</div>
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
                                <label for="inputName" class="h4">فعال :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox" id="active" name="active"{{$item->active?"checked":""}}>
                            </div>
                        </div><br>

                        <div class="row last">
                            <div class="col-12 text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-12">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Material/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('تعديل صنف')
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
  <script>
        jQuery(document).ready(function($){
            $('#repository_id').change(function(){
                var id=$(this).val();
                $.get("/CMS/RSection/" + id,
                    function(data) {
                        var model = $('#section');
                        model.empty();
                        model.append("<option value=''>اختر اسم القسم.... </option>");

                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                        });
                    });
            });
        });
    </script>
@endsection
