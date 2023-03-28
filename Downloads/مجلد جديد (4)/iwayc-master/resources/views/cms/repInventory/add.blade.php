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
<a class="btn btn-primary btn-md" href="/CMS/Rep/Inventory/{{$item->repository_id}}">رجوع</a>
@stop
@endsection
@section('content')

<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
            <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/add/RepInventory/{{$id}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">المستودع:* </label>

                                    <input type="text" value="{{\App\Models\Repository::find($item->repository_id)->name}}" class="form-control text-input" id="repository_id"
                                           name="repository_id" disabled>
                                    <div class="text-danger">{{$errors->first('repository_id_h')}}</div>
                                </div>
                           <div class="col">
                                <label class="control-label">القسم:* </label>
                                    <input type="text" value="{{\App\Models\Rep_section::find($item->section_id)->name}}" class="form-control text-input" id="section_id"
                                           name="section_id" disabled>
                                    <div class="text-danger">{{$errors->first('section_id_h')}}</div>
                                </div>
                                 <div class="col">
                                <label class="control-label">الصنف:* </label>
                                    <input type="text" value="{{\App\Models\Material::find($item->material_id)->name}}" class="form-control text-input" id="material_id"
                                           name="material_id" disabled>
                                    <div class="text-danger">{{$errors->first('material_id_h')}}</div>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الكمية المباعة:* </label>
                                    <input type="text" value="{{$item->pay_count}}" class="form-control text-input" id="pay_count"
                                           name="pay_count" disabled>
                                    <div class="text-danger">{{$errors->first('pay_count_h')}}</div>
                                </div>
                               <div class="col">
                                <label class="control-label">اخر سعر فردي:* </label>
                                    <input type="text" value="{{$item->last_price}}" class="form-control text-input" id="last_price"
                                           name="last_price" disabled>
                                    <div class="text-danger">{{$errors->first('last_price_h')}}</div>
                                </div>
                            </div><br>


                        <div class="row">
                         <div class="col">
                                <label class="control-label">مجموع المبيعات:* </label>
                                    <input type="text" value="{{$item->sum_pay}}" class="form-control text-input" id="sum_pay"
                                           name="sum_pay" disabled>
                                    <div class="text-danger">{{$errors->first('sum_pay_h')}}</div>
                                </div>
                            <div class="col">
                                <label class="control-label">العدد المتوفر:* </label>
                                    <input type="text" value="{{$item->count}}" class="form-control text-input" id="count"
                                           name="count" disabled>
                                    <div class="text-danger">{{$errors->first('count_h')}}</div>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">عدد جرد الموجود:* </label>
                                    <input type="number" min="0" value="{{$item->count_inv??old('count_inv')??0}}" class="form-control text-input" id="count_inv"
                                           name="count_inv" placeholder="ادخل عدد جرد الموجود">
                                    <div class="text-danger">{{$errors->first('count_inv')}}</div>
                                </div>
                            <div class="col">
                                <label class="control-label">عدد النقص:* </label>
                                    <input type="hidden" name="remaind_h" id="remaind_h" >
                                    <input type="text" value="{{old('remaind')??0}}" class="form-control text-input" id="remaind"
                                           name="remaind" disabled>
                                    <div class="text-danger">{{$errors->first('remaind_h')}}</div>
                                </div>
                                    <div class="col">
                                <label class="control-label">قيمة النقص:* </label>
                                    <input type="hidden" name="rem_price_h" id="rem_price_h" >
                                    <input type="text" value="{{old('rem_price')??0}}" class="form-control text-input" id="rem_price"
                                           name="rem_price" disabled>
                                    <div class="text-danger">{{$errors->first('rem_price_h')}}</div>
                                </div>
                            </div><br>

                        <div class="row last">
                            <div class="col text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-12">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Rep/Inventory/{{$item->repository_id}}" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>



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
 <script>
        function fSum() {
            var count_inv = parseFloat($("#count_inv").val());
            var count = parseFloat($("#count").val());
            var last_price = parseFloat($("#last_price").val());
            var remaind = count - count_inv;
            var rem_price = remaind * last_price;
            $("#remaind").val(remaind);
            $("#remaind_h").val(remaind);
            $("#rem_price_h").val(rem_price);
            $("#rem_price").val(rem_price);
        }
        window.onload = function() {
            fSum();
        };
        $('#count_inv').change(function() {
            fSum();
        });
    </script>

@endsection
