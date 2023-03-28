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
<a class="btn btn-primary btn-md" href="{{ route('english.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('اضافة نجاح انجليزي')
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
 <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/add/LevelUp">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">التاريخ:* </label>
                                    <input type="text" value="{{date('Y-m-d')}}" class="form-control fc-datepicker" id="date"
                                           name="date">
                                    <div class="text-danger">{{$errors->first('date')}}</div>
                                </div>

                            <div class="col">
                                <label class="control-label">اسم الطالب:* </label>
                                    <input type="hidden" value="{{$item->student_id}}" name="student_id_h" id="student_id_h">
                                    <input type="hidden" value="{{$id}}" name="id_h" id="id_h">
                                    <input type="text" value="{{\App\Models\English::find($item->student_id)->student_name}}" class="form-control validate[required] text-input" id="student_id"
                                           name="student_id" disabled>
                                    <div class="text-danger">{{$errors->first('student_id_h')}}</div>
                                </div>
                        </div><br><br>

                        <div class="row ">
                            <div class="col">
                                <label class="control-label">المستوى الحالي:* </label>
                                    <input type="hidden" value="{{$item->level_id}}" name="level_h" id="level_h">
                                    <input type="text" value="{{\App\Models\Option::find($item->level_id)->title}}" class="form-control validate[required] text-input" id="level"
                                           name="level" disabled>
                                    <div class="text-danger">{{$errors->first('level_h')}}</div>
                                </div>
                                   <div class="col">
                                <label class="control-label">العلامة النهائية:* </label>
                                    <input type="number" min="0" value="0" class="form-control validate[required] text-input" id="total"
                                           name="total" placeholder="ادخل العلامة النهائية">
                                    <div class="text-danger">{{$errors->first('total')}}</div>
                                </div>
                        </div><br><br>
                        <div class="row ">
                            <div class="col">
                                <label class="control-label">مؤهل للمستوى:* </label>
                                    <select name="level_up" id="level_up" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($level_up as $level)
                                            <option {{$level->id==old('level_up')?"selected":""}} value="{{$level->id}}"> {{$level->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('level_up')}}</div>
                                </div>
                        </div><br><br>
                        <div class="row ">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{old("notes")}}</textarea>
                                </div>
                        </div><br><br>
                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                        <button class="btn btn-main-primary pd-x-20" type="submit">تاكيد</button>
                    </div><br>

                    </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endcan

@cannot('اضافة نجاح انجليزي')
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


<!-- Internal Nice-select js-->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>

<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<!--Internal  pickerjs js -->
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>

<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

@endsection
