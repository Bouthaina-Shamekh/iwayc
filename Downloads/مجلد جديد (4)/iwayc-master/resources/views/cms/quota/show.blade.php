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
<a class="btn btn-primary btn-md" href="{{ route('Quota.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه جديد</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Quota.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض موعد حصة')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">


                    <div class="">
                              <div class="row">


                            <div class="col">
                                <label class="control-label">اسم المعلم والدورة:* </label>
                                    <input type="text" value="{{\App\Models\Course::find($item->course_id)->courseAR}} - {{\App\Models\Teacher::find(\App\Models\Course::find($item->course_id)->teacher_id)->name}}" class="form-control" id="course_id"
                                           name="course_id" disabled>
                                </div>
                                   <div class="col">
                                <label class="control-label">اليوم:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->day)->title}}" class="form-control" id="day"
                                           name="day" disabled>
                                </div>
                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم القاعة:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->room)->title}}" class="form-control" id="room"
                                           name="room" disabled>
                                </div>
                            <div class="col">
                                <label class="control-label">تصنيف الوقت:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->type)->title}}" class="form-control" id="type"
                                           name="type" disabled>
                                </div>

                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الوقت من:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->time)->title}}" class="form-control" id="time"
                                           name="time" disabled>
                                </div>
                                <div class="col">
                                <label class="control-label">الوقت الي:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->time_to)->title}}" class="form-control" id="time_to"
                                           name="time_to" disabled>
                                </div>

                        </div><br><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-sm-10">
                                    @can('تعديل موعد حصة')
                                    <a href="/CMS/Quota/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Quota/" class="btn btn-danger"> إلغاء</a>
                                </div>

                        </div><br><br>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endcan
    @cannot('عرض موعد حصة')
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
