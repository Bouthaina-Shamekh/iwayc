@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

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
@can('اضافة فحص انجليزي')
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

                      <form id="formID" class="formular form-horizontal ls_form" method="post" action="{{ route('english.store') }}">
                        @csrf
                        <div class="row ls_divider">
                               <div class="col">
                                <label class="control-label">تاريخ فحص المستوى:* </label>
                                    <input type="text" value="{{old('date')?old("date"):date('Y-m-d')}}"
                                           class="form-control validate[required] fc-datepicker" id="date" name="date">
                                    <div class="text-danger">{{$errors->first('date')}}</div>
                                </div>
                                <div class="col">
                                       <label class="col control-label">الطالب:* </label>
                                    <input type="text" value="{{old('student_name')}}" class="form-control validate[required] text-input" id="student_name"
                                           name="student_name" placeholder="أدخل اسم الطالب">
                                    <div class="text-danger">{{$errors->first('student_name')}}</div>
                                </div>
                        </div><br><br>

                        <div class="row ls_divider">
                         <div class="col">
                                <label class="control-label">سنة الميلاد:* </label>
                                    <input type="number" value="{{old("year")}}" class="form-control validate[required] text-input" id="year"
                                           name="year" placeholder="أدخل سنة الميلاد" min="1950" max="{{date('Y')}}">
                                    <div class="text-danger">{{$errors->first('year')}}</div>
                            </div>
                             <div class="col">
                        <label class=" control-label">العنوان:* </label>
                                    <select name="address" id="address" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($addresses as $address)
                                            <option {{old("address")==$address->id?"selected":""}} value="{{$address->id}}"> {{$address->title}} </option>
                                        @endforeach
                                    </select>
                                </div>
                        </div><br><br>

                        <div class="row ls_divider">
                            <div class="col">
                                <label class=" control-label">هاتف 1:* </label>
                                    <input type="text" value="{{old("phone1")}}" class="form-control text-input" id="phone1"
                                           name="phone1" placeholder="أدخل رقم الهاتف">
                                    <div class="text-danger">{{$errors->first('phone1')}}</div>
                            </div>
                            <div class="col">
                            <label class=" control-label">هاتف 2: </label>
                                    <input type="text" value="{{old("phone2")}}" class="form-control text-input" id="phone2"
                                           name="phone2" placeholder="أدخل رقم الهاتف">
                            <div class="text-danger">{{$errors->first('phone2')}}</div>
                            </div>

                        </div><br><br>

                        <div class="row ls_divider">
                            <div class="col">
                                <label class="control-label">رقم سند القبض: </label>
                                    <input type="number" value="{{old("cash_rec_id")}}" class="form-control text-input" id="cash_rec_id"
                                           name="cash_rec_id" placeholder="أدخل رقم سند القبض">
                                    <div class="text-danger">{{$errors->first('cash_rec_id')}}</div>

                            </div>
                        </div><br><br>
                        <div class="row ls_divider">
                            <div class="col">
                                <label class=" control-label">علامة المفرادات والمعاني:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{old("writing")!=null?old("writing"):''}}" class="form-control text-input" id="writing"
                                           name="writing" placeholder="أدخل علامة المفرادات والمعاني">
                                    <div class="text-danger">{{$errors->first('writing')}}</div>
                            </div>
                                  <div class="col">
                                <label class=" control-label">علامة القراءة والتحليل:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{old("reading")!=null?old("reading"):''}}" class="form-control text-input" id="reading"
                                           name="reading" placeholder="أدخل علامة القراءة والتحليل">
                                    <div class="text-danger">{{$errors->first('reading')}}</div>

                            </div>

                        </div><br><br>

                        <div class="row ls_divider">
                            <div class="col">
                                <label class=" control-label">علامة القواعد والتراكيب:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{old("grammer")!=null?old("grammer"):''}}" class="form-control text-input" id="grammer"
                                           name="grammer" placeholder="أدخل علامة القواعد والتراكيب">
                                    <div class="text-danger">{{$errors->first('grammer')}}</div>
                            </div>
                               <div class="col">
                                <label class=" control-label">علامة الشفوي:* </label>
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="{{old("conversation")!=null?old("conversation"):''}}" class="form-control text-input" id="conversation"
                                           name="conversation" placeholder="أدخل علامة الشفوي">
                                    <div class="text-danger">{{$errors->first('conversation')}}</div>

                            </div>
                        </div><br><br>

                        <div class="row ls_divider">
                            <div class="col">
                                <label class=" control-label">مجموع العلامات:* </label>
                                    <input type="hidden" value="" id="total_h" name="total_h">
                                    <input type="number" onchange="setTwoNumberDecimal(this)" step="any" min="0" value="" class="form-control text-input" id="total"
                                           name="total" placeholder="أدخل مجموع العلامات" disabled>
                                    <div class="text-danger">{{$errors->first('total')}}</div>
                            </div>
                            <div class="col">
                                <label class=" control-label">النتيجة(المستوى المطلوب):* </label>
                                    <select name="level_pass" id="level_pass" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($levels as $level)
                                            <option {{old("level_pass")==$level->id?"selected":""}} value="{{$level->id}}"> {{$level->title}} </option>
                                        @endforeach
                                    </select>
                                </div>
                         <div class="col">
                                <label class=" control-label">تصنيف الطالب:* </label>
                                    <select name="classification" id="classification" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($classes as $class)
                                            <option {{old('classification')==$class->id?"selected":""}} value="{{$class->id}}"> {{$class->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('classification')}}</div>
                            </div>
                        </div><br><br>

                        <div class="row ls_divider">
                            <div class="col">
                                <label class=" control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{old("notes")}}</textarea>
                                </div>
                            </div>
                        </div><br><br>

                        <div class="row ls_divider">
                           <div class="col-1">

                            </div>
                            <div class="col">
                                <label for="inputName" class="h4">فعال :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox" id="active" name="active"
                               {{old("active")?"checked":""}}>
                            </div>
                        </div>


                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-main-primary pd-x-20" type="submit">تاكيد</button>
                    </div><br>

                    </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endcan

    @cannot('اضافة فحص انجليزي')
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

 <script>
        function fSum() {
            var writing = parseFloat($("#writing").val());
            var reading = parseFloat($("#reading").val());
            var grammer = parseFloat($("#grammer").val());
            var conversation = parseFloat($("#conversation").val());
            var total = writing + reading + grammer + conversation;
            $("#total").val(total);
            $("#total_h").val(total);
        }
        window.onload = function() {
            fSum();
        };
        $('#writing').change(function() {
            fSum();
        });
        $('#reading').change(function() {
            fSum();
        });
        $('#grammer').change(function() {
            fSum();
        });
        $('#conversation').change(function() {
            fSum();
        });
    </script>
@endsection
