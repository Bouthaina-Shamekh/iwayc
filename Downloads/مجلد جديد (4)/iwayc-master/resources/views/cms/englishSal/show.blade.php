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

 @can('عرض متابعة انجليزي')

<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
         <h3 class="panel-title">{{$parentTitle}}</h3>
            <div class="card-body">
                    <div class="">
                        <form id="formID" class="formular form-horizontal ls_form">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الطالب:* </label>
                                    <input type="text" value="{{\App\Models\English::find($item->student_id)->student_name}}" class="form-control validate[required] text-input" id="student_id_h"
                                           name="student_id" disabled>
                                </div>
                             <div class="col">
                                <label class="control-label">تصنيف الطالب:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->classification)->title}}" class="form-control validate[required] text-input" id="classification"
                                           name="classification" disabled>
                                </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات:* </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">مدي الاستجابة:* </label>
                                    <input type="text" value="{{$item->type==null?'':\App\Models\Option::find($item->type)->title}}" class="form-control validate[required] text-input" id="type"
                                           name="type" disabled>
                                </div>
                            </div>
                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-sm-12">
                                    @can('تعديل متابعة انجليزي')
                                    <a href="/CMS/EnglishSal/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/EnglishSal/" class="btn btn-danger"> إلغاء</a>
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

    @endcan
    @cannot('عرض متابعة انجليزي')

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
