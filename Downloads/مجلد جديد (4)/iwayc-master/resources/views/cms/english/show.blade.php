@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
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
<a class="btn btn-primary btn-md" href="{{ route('english.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه جديد</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('english.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض فحص انجليزي')
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
                                <label class=" control-label">تاريخ فحص المستوى:* </label>
                                    <input type="text" value="{{$item->date}}" class="form-control" id="date"
                                           name="date" disabled>
                            </div>
                             <div class="col">
                                <label class=" control-label">اسم الطالب:* </label>
                                    <input type="text" value="{{$item->student_name}}" class="form-control form-control-lg" id="student_name"
                                           name="student_name" disabled>

                            </div>

                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class=" control-label">سنة الميلاد:* </label>


                                    <input type="text" value="{{$item->year}}" class="form-control form-control-lg" id="year"
                                           name="year" disabled>

                            </div>
                                     <div class="col">
                                <label class=" control-label">العنوان: </label>


                                    <input type="text" value="{{\App\Models\Option::find($item->address)->title}}" class="form-control form-control-lg" id="address"
                                           name="address" disabled>

                            </div>
                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class=" control-label">هاتف 1:* </label>
                                    <input type="text" value="{{$item->phone1}}" class="form-control form-control-lg" id="phone1"
                                           name="phone1" disabled>

                            </div><br><br>
                                  <div class="col">
                                <label class=" control-label">هاتف 2:* </label>
                                    <input type="text" value="{{$item->phone2}}" class="form-control form-control-lg" id="phone2"
                                           name="phone2" disabled>

                            </div>
                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class=" control-label">رقم سند القبض:* </label>
                                    <input type="text" value="{{$item->cash_rec_id}}" class="form-control form-control-lg" id="cash_rec_id"
                                           name="cash_rec_id" disabled>

                            </div><br><br>
                                <div class="col">
                                <label class=" control-label">علامة المفرادات والمعاني:* </label>
                                    <input type="text" value="{{$item->writing}}" class="form-control form-control-lg" id="writing"
                                           name="writing" disabled>

                            </div>
                        </div><br><br>
                        <div class="row">

                        </div><br><br>
                        <div class="row">
                            <div class="col">
                                <label class=" control-label">علامة القراءة والتحليل:* </label>
                                    <input type="text" value="{{$item->reading}}" class="form-control form-control-lg" id="reading"
                                           name="reading" disabled>
                            </div><br><br>
                            <div class="col">
                                <label class=" control-label">علامة القواعد والتراكيب:* </label>
                                    <input type="text" value="{{$item->grammer}}" class="form-control form-control-lg" id="grammer"
                                           name="grammer" disabled>

                            </div>
                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label class=" control-label">علامة الشفوي:* </label>
                                    <input type="text" value="{{$item->conversation}}" class="form-control form-control-lg" id="conversation"
                                           name="conversation" disabled>
                            </div>
                            <div class="col">
                                <label class=" control-label">مجموع العلامات:* </label>
                                    <input type="text" value="{{$item->total}}" class="form-control form-control-lg" id="total"
                                           name="total" disabled>

                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col">
                                <label class=" control-label">النتيجة(المستوى المطلوب):* </label>
                                    <input type="text" value="{{$item->level_pass}}" class="form-control form-control-lg" id="level_pass"
                                           name="level_pass" disabled>

                            </div>
                            <div class="col">
                                <label class=" control-label">التصنيف:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->classification)->title}}" class="form-control form-control-lg" id="classification"
                                           name="classification" disabled>
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col">
                                <label class=" control-label">ملاحظات:* </label>
                                    <textarea class="animatedTextArea form-control form-control-lg" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>

                            </div>
                        </div><br><br>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="h4">فعال :</label>
                                    <input class="largerCheckbox" type="checkbox" id="active" name="active"
                                            {{$item->active?"checked":""}}>
                            </div>
                        </div><br><br>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endcan
    @cannot('عرض فحص انجليزي')
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
@endsection
