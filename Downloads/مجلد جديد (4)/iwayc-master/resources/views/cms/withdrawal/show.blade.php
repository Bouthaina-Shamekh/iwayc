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
<a class="btn btn-primary btn-md" href="{{ route('ReceiptStudent.index') }}">رجوع</a>
@stop
@endsection

@section('content')

 @can('عرض انسحاب')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
               <form id="formID" class="formular form-horizontal ls_form">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الطالب والدورة: </label>
                                    <input type="text" value="{{\App\Models\Student::find(\App\Models\Student_course::find($item->student_course_id)->student_id)->nameAR}} - {{\App\Models\Course::find(\App\Models\Student_course::find($item->student_course_id)->course_id)->courseAR}}" class="form-control validate[required] text-input"
                                           id="student_course_id" name="student_course_id" disabled>
                                </div>

                             <div class="col">
                                <label class="control-label">الهواتف: </label>
                                    <input type="text" value="{{$item->phone}}" class="form-control" id="phone"
                                           name="phone" disabled>
                                </div>

                              <div class="col">
                                <label class="control-label">التاريخ: </label>
                                    <input type="text" value="{{$item->created_at}}" class="form-control" id="created_at"
                                           name="created_at" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">رسوم الدورة: </label>
                                    <input type="text" value="{{$item->price}}" class="form-control" id="price"
                                           name="price" disabled>
                                </div>

                         <div class="col">
                                <label class="control-label">المبلغ المدفوع: </label>
                                    <input type="text" value="{{$item->payment}}" class="form-control" id="payment"
                                           name="payment" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">غرامات الطالب: </label>
                                    <input type="text" value="{{$item->fines}}" class="form-control" id="fines"
                                           name="fines" disabled>
                                </div>

                              <div class="col">
                                <label class="control-label">المبلغ المرتجع: </label>
                                    <input type="text" value="{{$item->refund}}" class="form-control" id="refund"
                                           name="refund" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">اجور المعلم: </label>
                                    <input type="text" value="{{$item->teacher_fees}}" class="form-control" id="teacher_fees"
                                           name="teacher_fees" disabled>
                                </div>

                                  <div class="col">
                                <label class="control-label">حصة المركز: </label>
                                    <input type="text" value="{{$item->center_fees}}" class="form-control" id="center_fees"
                                           name="center_fees" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">سبب الانسحاب: </label>
                                    <textarea class="animatedTextArea form-control" id="reason" name="reason" disabled>
                                        {{$item->reason}}
                                    </textarea>
                                </div>

                        </div><br>

                        <div class="row last">
                            <div class="col-12 text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-12">
                                    @can('تعديل انسحاب')
                                    <a href="/CMS/Withdrawal/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Withdrawal/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>



        </div>
    </div>
</div>
<!-- row closed -->

  @endcan
    @cannot('عرض انسحاب')
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
