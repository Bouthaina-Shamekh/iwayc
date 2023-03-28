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
<a class="btn btn-primary btn-md" href="{{ route('CountWarning.index') }}">رجوع</a>
@stop
@endsection

@section('content')
     @can('عرض مطالبة قانونية')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الطالب:* </label>


                                    <input type="text" value="{{\App\Models\Student::find(\App\Models\Student_course::find($item->student_course_id)->student_id)->nameAR}}" class="form-control validate[required] text-input" id="student_course_id"
                                           name="student_course_id" disabled>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">طريقة المطالبة:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->how_claim)->title}}" class="form-control validate[required] text-input" id="type"
                                           name="type" disabled>
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
                            <div class="col-12 text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-12">
                                    @can('تعديل مطالبة قانونية')
                                    <a href="/CMS/CountWarning/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/CountWarning/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div><br>
                        </div>


        </div>
    </div>
</div>
<!-- row closed -->
    @endcan

    @cannot('عرض مطالبة قانونية')
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
