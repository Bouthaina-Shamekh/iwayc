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
<a class="btn btn-primary btn-md" href="{{ route('AbsenceT.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه اذن جديد لمعلم</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('AbsenceT.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض اذن معلم')
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
                                <label class="colcontrol-label">التاريخ:* </label>
                                    <input type="text" value="{{$item->date}}" class="form-control datepicker" id="date"
                                           name="date" disabled>
                                </div>
                            <div class="col">
                                <label class="colcontrol-label">اسم المعلم والدورة:* </label>
                                    <input type="text" value="{{\App\Models\Course::find($item->course_id)->courseAR}} - {{\App\Models\Teacher::find(\App\Models\Course::find($item->course_id)->teacher_id)->name}}" class="form-control" id="course_id"
                                           name="course_id" disabled>
                        </div>
                        </div><br>
                    <div class="row">
                           <div class="col">
                                <label class="colcontrol-label">النوع:* </label>
                                    <input type="text" value="{{$item->type?'تأخير':'غياب'}}" class="form-control" id="type"
                                           name="type" disabled>
                            </div>
                            <div class="col" id="delay_time_d" style="display:none">
                                <label class="colcontrol-label">مدة التأخير:* </label>
                                <div class="row">
                                    <div class="col-10">
                                        <input type="text" value="{{$item->delay_time}}" class="form-control text-input"id="delay_time" name="delay_time" disabled>
                                    </div>
                                    <div class="col">
                                        <strong style="font-size: 22px" class="col-md-1 text-left">دقيقة</strong>
                                    </div>
                                </div>
                          </div>
                    </div><br>

                    <div class="row">
                    <div class="col"id="delay_time_d" >
                        <label class="control-label">عدد ايام الغياب* </label>
                        <div class="col-md-9">
                      <input type="number" value="{{$absencet}}" class="form-control text-input"
                                   id="delay_time" name="delay_time" disabled>
                        </div>
                </div>

                <div class="col"id="delay_time_d" >
                    <label class="control-label">عدد مرات التاخير* </label>
                    <div class="col-md-9">
                  <input type="number" value="{{$absencet_d}}" class="form-control text-input"
                               id="delay_time" name="delay_time" disabled>
                    </div>
            </div>

            <div class="col">

                <label class="control-label">اوقات التأخير* </label>
                <input type="number" value="{{$h_absencet_d}}" class="form-control" id="type" name="type" disabled>

                </div>

            </div><br>

                        <div class="row">
                            <div class="col">
                            <label class="colcontrol-label">ملاحظات: </label>
                             <div class="col ls-group-input">
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                            </div>
                        </div>
                        </div><br>
                        <div class="row last">
                            <div class="col">
                                <label class="colcontrol-label"></label>
                                <div class="col-sm-10">
                                    @can('تعديل اذن معلم')
                                    <a href="/CMS/AbsenceT/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/AbsenceT/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

        </div>
    </div>
</div>
<!-- row closed -->
@endcan

@cannot('اضافة اذن معلم')
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
    <script>
        window.onload = function() {
            cert();
        };
        function cert(){
            if ($('#type').val()=="تأخير"){
                $("#delay_time_d").show();
            }
            if ($('#type').val()=="غياب"){
                $("#delay_time_d").hide();
            }
        }
    </script>
@endsection
