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
<a class="btn btn-primary btn-md" href="/CMS/EnglishSal">رجوع</a>
@stop
@endsection
@section('content')

 @can('تعديل متابعة انجليزي')
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">
      <div class="card">
      <div class="card-body">
 <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/EnglishSal/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الطالب:* </label>
                                    <input type="hidden" value="{{$item->student_id}}" name="student_id_h" id="student_id_h">
                                    <input type="text" value="{{\App\Models\English::find($item->student_id)->student_name}}" class="form-control validate[required] text-input" id="student_id_h"
                                           name="student_id" disabled>
                                    <div class="text-danger">{{$errors->first('student_id_h')}}</div>
                                </div>
                               <div class="col">
                                <label class="control-label">تصنيف الطالب:* </label>
                                    <select name="classification" id="classification" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($classification as $c)
                                            <option {{$item->classification==$c->id?"selected":""}} value="{{$c->id}}"> {{$c->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('classification')}}</div>
                                </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{$item->notes}}</textarea>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">مدي الاستجابة:* </label>

                                    <select name="type" id="type" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($type as $t)
                                            <option {{$item->type==$t->id?"selected":""}} value="{{$t->id}}"> {{$t->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('type')}}</div>
                                </div>
                            </div><br>


                        <div class="row last">
                            <div class="col text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-10">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/EnglishSal/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>

            </div>
        </div>
    </div>
</div>
  @endcan

    @cannot('تعديل متابعة انجليزي')
        <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            ليس لديك صلاحية يرجي مراجعة المسؤول
        </div>
    @endcannot
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
  <script>
        function fSum() {
            var count_day = parseFloat($("#count_day").val());
            var fine_day = parseFloat($("#fine_day").val());
            var fees_owed = parseFloat($("#fees_owed").val());
            var fine_delay = count_day * fine_day;
            var total_amount = fine_delay + fees_owed;
            $("#fine_delay").val(fine_delay);
            $("#fine_delay_h").val(fine_delay);
            $("#total_amount").val(total_amount);
            $("#total_amount_h").val(total_amount);
        }
        window.onload = function() {
            fSum();
        };
        $('#fine_day').change(function() {
            fSum();
        });
    </script>
@endsection
