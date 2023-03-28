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
<a class="btn btn-primary btn-md" href="{{ route('ReceiptCourse.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافة سند صرف جديد</a>

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('ReceiptCourse.index') }}">رجوع</a>
@stop
@endsection

@section('content')

 @can('عرض صرف دورة')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                 <div class="row ">
                            <div class="col">
                                <label class="control-label">رقم السند الحاسوبي: </label>
                                    <input type="text" value="{{$item->id}}" class="form-control" id="id"
                                           name="id" disabled>
                                </div>
                           <div class="col">
                                <label class="control-label">رقم السند الورقي: </label>
                                    <input type="text" value="{{$item->id_comp}}" class="form-control" id="id_comp"
                                           name="id_comp" disabled>
                                </div>

                            <div class="col">
                                <label class="control-label">التاريخ: </label>
                                    <input type="text" value="{{$item->date}}" class="form-control" id="date"
                                           name="date" disabled>
                                </div>

                        </div><br>

                        {{--<div class="row ">
                            <div class="col">
                                <label class="control-label">تصنيف المصروف:* </label>
                                    <input type="text" value="{{$item->type}}" class="form-control" id="type"
                                           name="type" disabled>
                                </div>
                            </div>
                        </div><br>--}}

                        <div class="row ">
                            <div class="col">
                                <label class="control-label">المعلم:* </label>
                             <input type="text" value="{{\App\Models\Teacher::find(\App\Models\Course::find($item->course_id)->teacher_id)->name}}" class="form-control" id="teacher_id"
                                           name="teacher_id" disabled>
                                </div>
                              <div class="col">
                                <label class="control-label">الدورة:* </label>
                                    <input type="text" value="{{\App\Models\Course::find($item->course_id)->courseAR}}" class="form-control" id="course_id"
                                           name="course_id" disabled>
                                </div>

                        </div><br>

                        <div class="row ">
                            <div class="col">
                                <label class="control-label">نصيب المعلم من التحصيل:* </label>
                                    <input type="text" value="{{$item->teacher_ratio}}" class="form-control" id="teacher_ratio"
                                           name="teacher_ratio" disabled>
                                </div>

                             <div class="col">
                                <label class="control-label">مقبوضات المعلم من الدورة</label>
                                    <input type="text" value="{{$item->teacher_pay}}" class="form-control" id="teacher_pay"
                                           name="teacher_pay" disabled>
                                </div>
                          <div class="col">
                                <label class="control-label">باقي نصيب المعلم من التحصيل:* </label>
                                    <input type="text" value="{{$item->remainder}}" class="form-control" id="remainder"
                                           name="remainder" disabled>
                                </div>

                        </div><br>

                        <div class="row ">
                            <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input type="text" value="{{$item->amount}}" class="form-control" id="amount"
                                           name="amount" disabled>
                                </div>

                           <div class="col">
                                <label class="control-label">معلومات الشيك:* </label>
                                    <textarea class="animatedTextArea form-control" id="cheque_info" name="cheque_info"
                                              disabled>{{$item->cheque_info}}</textarea>
                                </div>
                        </div><br>

                        <div class="row ">
                            <div class="col">
                                <label class="control-label">ملاحظات:* </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>

                        </div><br>

                        <div class="row  last">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-10">
                                    @can('تعديل صرف دورة')
                                    <a href="/CMS/ReceiptCourse/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/ReceiptCourse/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>


        </div>
    </div>
</div>
<!-- row closed -->

    @endcan
    @cannot('عرض صرف دورة')
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
