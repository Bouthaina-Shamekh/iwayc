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
<a class="btn btn-primary btn-md" href="{{ route('Material.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('اضافة كميات')


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
         <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Quantity/{{$item->id}}/add">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">الصنف/المستودع/القسم: </label>
                                    <input type="hidden" value="{{$userL>0?$uY:$moneyWork->year}}" id="edu_year_h" name="edu_year_h">
                                    <input type="hidden" value="{{$item->id}}" id="material_id_h" name="material_id_h" >
                                    <input type="hidden" value="{{$item->repository_id}}" id="repository_id_h" name="repository_id_h" >
                                    <input type="hidden" value="{{$item->section}}" id="section_h" name="section_h" >
                                    <input type="text" value="{{$item->name}} - {{\App\Models\Repository::find($item->repository_id)->name}} - {{\App\Models\Rep_section::find($item->section)->name}}"
                                           class="form-control validate[required] text-input" id="material_id" name="material_id" disabled>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">العدد السابق: </label>
                                <input type="hidden" value="{{$item->count_new}}" id="count_old_h" name="count_old_h" >
                                <input type="number" value="{{$item->count_new}}" class="form-control text-input" id="count_old"
                                           name="count_old" disabled>
                                </div>
                            <div class="col">
                                <label class="control-label">العدد المضاف:* </label>
                                <input type="number" value="{{old("count_new")?old("count_new"):0}}" class="form-control validate[required] text-input" id="count_new"
                                           name="count_new" placeholder="أدخل العدد المتوفر الان">
                                    <div class="text-danger">{{$errors->first('count_new')}}</div>
                                </div>
                              <div class="col">
                                <label class="control-label">العدد الكلي: </label>
                                    <input type="hidden" value="{{$item->count}}" id="count_h" name="count_h" >
                                    <input type="number" value="{{old("count")}}" class="form-control text-input" id="count"
                                           name="count" disabled>
                                    <div class="text-danger">{{$errors->first('count')}}</div>
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
                                              placeholder="أدخل ملاحظات">{{old("notes")}}</textarea>
                                </div>

                        </div><br>

                        <div class="row last">
                            <div class="col text-center">
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

    @cannot('اضافة كميات')
        <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            ليس لديك صلاحية يرجي مراجعة المسؤول
        </div>
    @endcannot
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js') <script>
        function fSum() {
            var count_old = parseInt($("#count_old_h").val());
            var count_new = parseInt($("#count_new").val());
            var total = count_old + count_new;
            $("#count").val(total);
            $("#count_h").val(total);
        }
        window.onload = function() {
            fSum();
        };
        $('#count_new').change(function() {
            fSum();
        });
    </script>
@endsection
