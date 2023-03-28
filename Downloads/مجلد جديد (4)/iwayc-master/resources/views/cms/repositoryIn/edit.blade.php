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
@can('اضافة  قبض مستودع')
<a class="btn btn-primary btn-md" href="{{ route("RepositoryIn.create") }}"><i class='fas fa-plus'style="margin-left: 10px">قبض مستودع جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('RepositoryIn.index') }}">رجوع</a>
@stop
@endsection
@section('content')

@can('تعديل  قبض مستودع')
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">

        <div class="card">
        <div class="card-body">
    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/RepositoryIn/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                            <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الزبون:* </label>
                                    <input type="text" value="{{$item->customer}}" class="form-control" id="customer"
                                           name="customer">
                                </div>
                                <div class="col">
                                <label class="control-label">رقم الورقي:* </label>
                                    <input type="text" value="{{$item->id_comp}}" class="form-control disable" id="id_comp"
                                           name="id_comp">
                                </div>
                              <div class="col">
                                <label class="control-label">السنة المالية:* </label>
                                    <select name="m_year" id="m_year" class="form-control disable">
                                        @foreach($moneyYears as $moneyYear)
                                            <option {{$item->m_year==$moneyYear->year?"selected":""}} value="{{$moneyYear->year}}"> {{$moneyYear->year}} </option>
                                        @endforeach

                                    </select>
                                    <div class="text-danger">{{$errors->first('m_year')}}</div>
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
                                <label class="control-label">اسم القسم:* </label>
                                    <select name="section" id="section" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($sections as $section)
                                            <option {{$item->section==$section->id?"selected":""}} value="{{$section->id}}"> {{$section->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('section')}}</div>
                                </div>
                          <div class="col">
                                <label class="control-label">اسم الصنف:* </label>
                                    <select name="material_id" id="material_id" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($materials as $material)
                                            <option {{$item->material_id==$material->id?"selected":""}} value="{{$material->id}}"> {{$material->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('material_id')}}</div>
                                </div>

                        </div><br>


                        <div class="row">
                            <div class="col">
                                <label class="control-label">العدد المتوفر:* </label>
                                    <input type="hidden" id="count_h" name="count_h" value="0">
                                    <input type="number" value="{{$item->count}}" class="form-control text-input" id="count"
                                           name="count" placeholder="العدد المتوفر" disabled>
                                    <div class="text-danger">{{$errors->first('count')}}</div>
                                </div>
                         <div class="col">
                                <label class="control-label">سعر البيع فردي:* </label>
                                    <input style="background-color: #eee" type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->single_pay}}" class="form-control text-input" id="single_pay"
                                           name="single_pay" placeholder="أدخل سعر البيع فردي">
                                    <div class="text-danger">{{$errors->first('single_pay')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">العدد:* </label>
                                    <input type="number" value="{{$item->quantity}}" class="form-control text-input" id="quantity"
                                           name="quantity" placeholder="أدخل العدد">
                                    <div class="text-danger">{{$errors->first('quantity')}}</div>
                                </div>
                              <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input type="hidden" id="total_h" name="total_h" value="{{$item->total}}">
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{$item->total}}" class="form-control text-input" id="total"
                                           name="total" disabled>
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
                                    <a href="/CMS/RepositoryIn/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('تعديل  قبض مستودع')
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
        function fSum () {
            var qty = parseFloat($("#single_pay").val());
            var price = parseFloat($("#quantity").val());
            var total=qty* price;
            $("#total").val(total);
            $("#total_h").val(total);
        }
        function fRSection () {
            var id=$('#repository_id').val();
            $.get("/CMS/RSection/" + id,
                function(data) {
                    var model = $('#section');
                    model.empty();
                    model.append("<option value=''>اختر اسم القسم.... </option>");

                    $.each(data, function(index, element) {
                        model.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                    });
                });
        }
        function fRepSection () {
            var id=$('#section').val();
            $.get("/CMS/RepSection/" + id,
                function(data) {
                    var model = $('#material_id');
                    model.empty();
                    model.append("<option value=''>اختر اسم الصنف.... </option>");

                    $.each(data, function(index, element) {
                        model.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                    });
                });
        }
        function fRepMaterial () {
            var id=$('#material_id').val();
            $.get("/CMS/RepMaterial/" + id,
                function(data) {
                    $('#count').val(data.count_new);
                    $('#single_pay').val(data.single_pay);
                    $('#count_h').val(data.count_new);
                    $('#quantity').attr('max',data.count_new);
                });
        }
        $(document).ready(function(){
            $("#single_pay").change(function(){
                fSum();
            });
            $("#quantity").change(function(){
                fSum();
            });
            $('#repository_id').change(function(){
                fRSection();
            });
            $('#section').change(function(){
                fRepSection();
            });
            $('#material_id').change(function(){
                fRepMaterial();
            });
        });
    </script>
@endsection
