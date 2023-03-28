@extends('layouts.master')
@section('css')
  <style>
      .note-editor .note-editable {

    font-size: 15px;
    font-weight: bold;
      }


  </style>

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
<a class="btn btn-primary btn-md" href="{{ route('Offer.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('اضافة عروض دورات')

<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">


        <div class="card">
            <div class="card-body">
                    <form enctype="multipart/form-data" id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Offer">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">تاريخ العرض: </label>
                                    <input type="text" min="{{date('Y-m-d')}}" value="{{old("date")?old("date"):date('Y-m-d')}}"class="form-control fc-datepicker" placeholder="MM/DD/YYYY" id="date" name="date">
                                    <div class="text-danger">{{$errors->first('date')}}</div>
                                </div>
                           <div class="col">
                                <label class="control-label">عنوان العرض:* </label>
                                    <input type="text" value="{{old('title')}}" class="form-control validate[required] text-input" id="title"
                                           name="title" placeholder="أدخل عنوان الحملة">
                                    <div class="text-danger">{{$errors->first('title')}}</div>
                                </div>

                                  <div class="col">
                                <label class="control-label">التصنيف:* </label>
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
                                <div class="col-md-12 ls-group-input">
                                    <textarea class="animatedTextArea form-control summernote"id="summernote" id="details" name="details"
                                              placeholder="With animation :)">{{old("details")}}</textarea>
                                    <div class="text-danger">{{$errors->first('details')}}</div>
                                </div>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الصورة: </label>
                                    <input type="file" value="{{old("image")}}" class="form-control text-input" id="image"
                                           name="image">
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">رسوم التسجيل:* </label>
                                    <input type="number" min="0" step="any" value="{{old("fees_reg")?old("fees_reg"):0}}" class="form-control text-input" id="fees_reg"
                                           name="fees_reg" placeholder="أدخل رسوم التسجيل">
                                    <div class="text-danger">{{$errors->first('fees_reg')}}</div>
                                </div>
                              <div class="col">
                                <label class="control-label">اثمان حقيبة تعليمية:* </label>
                                    <input type="number" min="0" step="any" onchange="setTwoNumberDecimal(this)" value="{{old("fees_bag")?old("fees_bag"):0}}" class="form-control text-input" id="fees_bag"
                                           name="fees_bag" placeholder="اثمان حقيبة تعليمية">
                                    <div class="text-danger">{{$errors->first('fees_bag')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">رسوم الدورة:* </label>
                                    <input type="number" min="0" step="any" onchange="setTwoNumberDecimal(this)" value="{{old("fees_course")?old("fees_course"):0}}" class="form-control text-input" id="fees_course"
                                           name="fees_course" placeholder="رسوم الدورة">
                                    <div class="text-danger">{{$errors->first('fees_course')}}</div>
                                </div>
                      <div class="col">
                                <label class="control-label">الرسوم الكلي:* </label>
                                    <input type="hidden" min="0" step="any" onchange="setTwoNumberDecimal(this)" value="" id="amount_h" name="amount_h">
                                    <input type="number" min="0" step="any" onchange="setTwoNumberDecimal(this)" value="{{old("amount")}}" class="form-control text-input" id="amount"
                                           name="amount" disabled>
                                    <div class="text-danger">{{$errors->first('amount')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">نسبة الخصم:* </label>
                                <div class="row">
                                <div class="col-10">
                                    <input type="number" min="0" step="any" onchange="setTwoNumberDecimal(this)" value="{{old("discount_r")?old("discount_r"):0}}" class="form-control text-input" id="discount_r"
                                           name="discount_r" placeholder="نسبة الخصم">
                                    <div class="text-danger">{{$errors->first('discount_r')}}</div>
                                </div>
                                 <div class="col">
                                <strong style="font-size: 26px" class="">%</strong>
                            </div>
                            </div>
                             </div>
                               <div class="col">
                                <label class="control-label">قيمة الخصم:* </label>
                                    <input type="hidden" min="0" step="any" onchange="setTwoNumberDecimal(this)" value="" id="discount_v_h" name="discount_v_h">
                                    <input type="number" min="0" step="any" onchange="setTwoNumberDecimal(this)" value="{{old("discount_v")?old("discount_v"):0}}" class="form-control text-input" id="discount_v"
                                           name="discount_v" disabled>
                                    <div class="text-danger">{{$errors->first('discount_v')}}</div>
                                </div>
                         <div class="col">
                                <label class="control-label">الرسوم النهائية:* </label>
                                    <input type="hidden" min="0" step="any" onchange="setTwoNumberDecimal(this)" value="" id="total_h" name="total_h">
                                    <input type="number" min="0" step="any" onchange="setTwoNumberDecimal(this)" value="{{old("total")}}" class="form-control text-input" id="total"
                                           name="total" disabled>
                                    <div class="text-danger">{{$errors->first('total')}}</div>
                                </div>


                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">تفاصيل الرسوم والخصم المسموح به: </label>
                                <div class="col-md-10 ls-group-input">
                                    <textarea rows="5" cols="50" class="animatedTextArea form-control" id="desc_refund" name="desc_refund"
                                              placeholder="تفاصيل الرسوم والخصم المسموح به">{{old("desc_refund")}}</textarea>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                <div class="col-md-10 ls-group-input">
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="ملاحظات">{{old("notes")}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>
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
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-10">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Offer/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('اضافة عروض دورات')
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

<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>


<!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
var date = $('.fc-datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
    $('#summernote').summernote({
        height: 300,

    });
    {{--    window.onload = function() {
            var t = document.getElementsByClassName("note-toolbar")[0];
            t.style.display = "none";
        } --}}

</script>
    <script>
        function setTwoNumberDecimal(event) {
            event.value = parseFloat(event.value).toFixed(2);
        }

        function fSum() {
            var fees_reg = parseFloat($("#fees_reg").val());
            var fees_bag = parseFloat($("#fees_bag").val());
            var fees_course = parseFloat($("#fees_course").val());
            var discount_r = parseFloat($("#discount_r").val());
            var amount = fees_reg + fees_bag + fees_course;
            var discount_v = discount_r * fees_course / 100;
            var total = amount - discount_v;
            $("#discount_v").val(discount_v.toFixed(2));
            $("#discount_v_h").val(discount_v.toFixed(2));
            $("#amount").val(amount.toFixed(2));
            $("#amount_h").val(amount.toFixed(2));
            $("#total").val(total.toFixed(2));
            $("#total_h").val(total.toFixed(2));
        }
        window.onload = function() {
            fSum();
        };
        $('#discount_r').change(function() {
            fSum();
        });
        $('#discount_v').change(function() {
            fSum();
        });
        $('#fees_reg').change(function() {
            fSum();
        });
        $('#fees_bag').change(function() {
            fSum();
        });
        $('#fees_course').change(function() {
            fSum();
        });
    </script>
@endsection
