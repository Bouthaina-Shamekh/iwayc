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

@can('عرض عروض دورات')
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                             <div class="row">
                            <div class="col">
                                <label class="control-label">تاريخ العرض: </label>
                                    <input type="text" value="{{$item->date?$item->date:date('Y-d-m')}}"
                                           class="form-control datepicker" id="date" name="date" disabled>
                                </div>
                               <div class="col">
                                <label class="control-label">عنوان العرض:* </label>
                                    <input type="text" value="{{$item->title}}" class="form-control validate[required] text-input" id="title"
                                           name="title" disabled>
                                </div>
                            <div class="col">
                                <label class="control-label">التصنيف:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->type)->title}}" class="form-control validate[required] text-input" id="type"
                               name="type" disabled>
                                </div>

                        </div><br>


                         <div class="row">
                                <div class="col">
                                <div class="col-md-12 ls-group-input">
                                    <textarea class="animatedTextArea form-control" id="summernote"name="details" disabled>{{$item->details}}</textarea>
                                </div>
                            </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">الصورة: </label>
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

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">رسوم التسجيل:* </label>
                                    <input type="text" value="{{$item->fees_reg?$item->fees_reg:0}}" class="form-control text-input" id="fees_reg"
                                           name="fees_reg" disabled>
                                </div>
                        <div class="col">
                                <label class="control-label">اثمان حقيبة تعليمية:* </label>
                                    <input type="text" value="{{$item->fees_bag?$item->fees_bag:0}}" class="form-control text-input" id="fees_bag"
                                           name="fees_bag" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">رسوم الدورة:* </label>
                                    <input type="text" value="{{$item->fees_course?$item->fees_course:0}}" class="form-control text-input" id="fees_course"
                                           name="fees_course" disabled>
                                </div>

                              <div class="col">
                                <label class="control-label">الرسوم الكلي:* </label>
                                    <input type="text" value="{{$item->amount}}" class="form-control text-input" id="amount"
                                           name="amount" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">نسبة الخصم:* </label>
                                 <div class="row">
                                <div class="col-10">
                                    <input type="text" value="{{$item->discount_r}}" class="form-control text-input" id="discount_r"name="discount_r" disabled>
                                </div>
                                 <div class="col">
                                <strong style="font-size: 26px" class="">%</strong>
                            </div>
                          </div>
                           </div>
                      <div class="col">
                                <label class="control-label">قيمة الخصم:* </label>

                                    <input type="text" value="{{$item->discount_v}}" class="form-control text-input" id="discount_v"
                                           name="discount_v" disabled>
                                </div>
                         <div class="col">
                                <label class="control-label">الرسوم النهائية:* </label>
                                    <input type="text" value="{{$item->total}}" class="form-control text-input" id="total"name="total" disabled>
                                </div>
                        </div><br>


                        <div class="row">
                            <div class="col">
                                <label class="control-label">تفاصيل الرسوم والخصم المسموح به: </label>
                                <div class="col-md-10 ls-group-input">
                                    <textarea rows="5" cols="50" class="animatedTextArea form-control" id="desc_refund" name="desc_refund"
                                              disabled>{{$item->desc_refund}}</textarea>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                <div class="col-md-10 ls-group-input">
                                    <textarea class="animatedTextArea form-control" id="notes"  name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>
                            </div>
                        </div><br>

                           <div class="row">
                            <div class="col">

                                      @php
                                          if($item->active == 1){
                                                echo '<input class="form-control form-control-lg" value="فعال" disabled >';
                                          }else{
                                             echo '<input class="form-control form-control-lg" value="غير فعال" disabled >';
                                          }
                                      @endphp

                                </div>
                                </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    @can('تعديل عروض دورات')
                                    <a href="/CMS/Offer/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Offer/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

        </div>
    </div>
</div>
</div>
</div>
<!-- row closed -->
    @endcan
    @cannot('عرض عروض دورات')
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
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

<!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 300,

    });
    {{--    window.onload = function() {
            var t = document.getElementsByClassName("note-toolbar")[0];
            t.style.display = "none";
        } --}}

</script>
@endsection
