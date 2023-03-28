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

  @can('عرض صرف مخالصة')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
               <form id="formID" class="formular form-horizontal ls_form">
                        <div class="row">
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
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الطالب والدورة المنسحب منها:* </label>
                                    <input type="text" value="{{\App\Models\Student::find(\App\Models\Student_course::find($item->student_course_id)->student_id)->nameAR}} - {{\App\Models\Course::find(\App\Models\Student_course::find($item->student_course_id)->course_id)->courseAR}}" class="form-control" id="student_id"
                                           name="student_id" disabled>
                                </div>

                        <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input type="text" value="{{$item->amount}}" class="form-control" id="amount"
                                           name="amount" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات:* </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>

                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-sm-10">
                                    @can('تعديل صرف مخالصة')
                                    {{--<a href="/CMS/ReceiptStudent/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>--}}
                                    @endcan
                                    <a href="/CMS/ReceiptStudent/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>


        </div>
    </div>
</div>
<!-- row closed -->


    @endcan
    @cannot('عرض صرف مخالصة')
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
