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
@can('اضافة عروض دورات')
<a class="btn btn-primary btn-md" href="{{ route('Offer.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافة عرض جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Offer.index') }}">رجوع</a>
@stop
@endsection
@section('content')

@can('تعديل عروض دورات')
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


        <div class="card">
        <div class="card-body">
                   <form enctype="multipart/form-data" id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Offer/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">تاريخ العرض: </label>
                                    <input type="text" value="{{$item->date?$item->date:date('Y-d-m')}}"
                                           class="form-control fc-datepicker" id="date" name="date">
                                    <div class="text-danger">{{$errors->first('date')}}</div>
                                </div>
                         <div class="col">
                                <label class="control-label">عنوان العرض:* </label>
                                    <input type="text" value="{{$item->title}}" class="form-control validate[required] text-input" id="title"
                                           name="title" placeholder="أدخل عنوان الحملة">
                                    <div class="text-danger">{{$errors->first('title')}}</div>
                                </div>

                             <div class="col">
                                <label class="control-label">التصنيف:* </label>
                                    <select name="type" id="type" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($types as $type)
                                            <option {{$item->type==$type->id?"selected":""}} value="{{$type->id}}"> {{$type->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('type')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <div class="col-md-12 ls-group-input">
                                    <textarea class="animatedTextArea form-control  summernote"id="summernote"id="details" name="details" placeholder="With animation :)">{{$item->details}}</textarea>
                                    <div class="text-danger">{{$errors->first('details')}}</div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">

                                <div class="col ">
                                    <label class="control-label" style="margin-top:20px;">الصورة: </label>
                                    <div class="col-md-10" style="margin-top:20px;">
                                    <input type="file" value="{{$item->img}}" class="form-control text-input" id="image" name="image"><br/>
                                    @if($item->img!=NULL)
                                <div class="ls-image-fluid-box">
                                    <div class="ls-fluid-box-gallery" style="display:-webkit-box !important;">
                                        <div class="imformationbox1" >
                                        <div class="col-md-2">
                                         <a  href='{{ asset('images/userimage').'/'. $item->img }}' title="" data-fluidbox class="col-2">
                                                <img  src='{{ asset('images/userimage').'/'. $item->img }}' alt="" title="" />
                                            </a>
                                        </div>
                                        </div>
                                        </div></div>
                                         @endif
                                 </div>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">رسوم التسجيل:* </label>
                                    <input type="number" min="0" step="any" value="{{$item->fees_reg?$item->fees_reg:0}}" class="form-control text-input" id="fees_reg"
                                           name="fees_reg" placeholder="أدخل رسوم التسجيل">
                                    <div class="text-danger">{{$errors->first('fees_reg')}}</div>
                                </div>
                              <div class="col">
                                <label class="control-label">اثمان حقيبة تعليمية:* </label>
                                    <input type="number" min="0" step="any" value="{{$item->fees_bag?$item->fees_bag:0}}" class="form-control text-input" id="fees_bag"
                                           name="fees_bag" placeholder="اثمان حقيبة تعليمية">
                                    <div class="text-danger">{{$errors->first('fees_bag')}}</div>
                                </div>


                        </div><br>


                        <div class="row">
                         <div class="col">
                                <label class="control-label">رسوم الدورة:* </label>
                                    <input type="number" min="0" step="any" value="{{$item->fees_course?$item->fees_course:0}}" class="form-control text-input" id="fees_course"
                                           name="fees_course" placeholder="رسوم الدورة">
                                    <div class="text-danger">{{$errors->first('fees_course')}}</div>
                                </div>
                            <div class="col">
                                <label class="control-label">الرسوم الكلي:* </label>
                                    <input type="hidden" min="0" step="any" value="{{$item->amount}}" id="amount_h" name="amount_h">
                                    <input type="number" min="0" step="any" value="{{$item->amount}}" class="form-control text-input" id="amount"
                                           name="amount" disabled>
                                    <div class="text-danger">{{$errors->first('amount_h')}}</div>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">نسبة الخصم:* </label>
                             <div class="row">
                                <div class="col-10">
                                    <input type="number" min="0" step="any" value="{{$item->discount_r}}" class="form-control text-input" id="discount_r"
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
                                    <input type="hidden" min="0" step="any" value="{{$item->discount_v}}" id="discount_v_h" name="discount_v_h">
                                    <input type="number" min="0" step="any" value="{{$item->discount_v}}" class="form-control text-input" id="discount_v"
                                           name="discount_v" disabled>
                                    <div class="text-danger">{{$errors->first('discount_v')}}</div>
                                </div>

                         <div class="col">
                                <label class="control-label">الرسوم النهائية:* </label>
                                    <input type="hidden" min="0" step="any" value="{{$item->total}}" id="total_h" name="total_h">
                                    <input type="number" min="0" step="any" value="{{$item->total}}" class="form-control text-input" id="total"
                                           name="total" disabled>
                                    <div class="text-danger">{{$errors->first('total')}}</div>
                                </div>

                          </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">تفاصيل الرسوم والخصم المسموح به: </label>
                                <div class="col-md-10 ls-group-input">
                                    <textarea rows="5" cols="50" class="animatedTextArea form-control" id="desc_refund" name="desc_refund"
                                              placeholder="تفاصيل الرسوم والخصم المسموح به">{{$item->desc_refund}}</textarea>
                                    <div class="text-danger">{{$errors->first('desc_refund')}}</div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>

                                <div class="col-md-10 ls-group-input">
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="With animation :)">{{$item->notes}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>
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
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
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

    @cannot('تعديل عروض دورات')
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
@endsection
