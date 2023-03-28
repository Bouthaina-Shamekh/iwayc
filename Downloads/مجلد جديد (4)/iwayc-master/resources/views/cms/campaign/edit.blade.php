@extends('layouts.master')
@section('css')
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
<a class="btn btn-primary btn-md" href="{{ route('Campaign.index') }}">رجوع</a>
@stop
@endsection
@section('content')

   <?php $userL = \App\Models\User_year::where('user_id',Auth::user()->id)->count(); ?>
    @if ($userL>0)
        <?php
        $userY = \App\Models\User_year::where('user_id',Auth::user()->id)->first();
        $uY = $userY->year;
        ?>
    @else
        <?php $uY = null; ?>
    @endif

<!-- row -->
<div class="row">
@can('تعديل حملة')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                   <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Campaign/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">عنوان الحملة:* </label>
                                    <input type="text" value="{{$item->title}}" class="form-control validate[required] text-input" id="title"
                                           name="title" placeholder="عنوان الحملة">
                                    <div class="text-danger">{{$errors->first('title')}}</div>
                                </div>

                         <div class="col">
                                <label class="control-label">تاريخ البداية: </label>
                                    <input type="text" min="{{date('Y-m-d')}}" value="{{$item->start}}"
                                           class="form-control fc-datepicker" id="start" name="start">
                                    <div class="text-danger">{{$errors->first('start')}}</div>
                                </div>

                        </div><br>


                        <div class="row">
                            <div class="col">
                                <label class="control-label">سنة الميلاد من:* </label>
                                    <input type="number" value="{{$b_from_view->filter_id}}" class="form-control" id="b_from"
                                           name="b_from" placeholder="أدخل سنة الميلاد" min="1900" max="{{date('Y')}}">
                                </div>
                                  <div class="col">
                                <label class="control-label">سنة الميلاد الي:* </label>
                                    <input type="number" value="{{$b_to_view->filter_id}}" class="form-control" id="b_to"
                                           name="b_to" placeholder="أدخل سنة الميلاد" min="1900" max="{{date('Y')}}">
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الجنس:* </label>
                                    @if(count($gender_veiws)>0)
                                        @foreach($gender_veiws as $gender_veiw)
                                            <span disabled class="tag tag-info"style=" font-size:17px;"> {{\App\Models\Option::find($gender_veiw->filter_id)->title}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي فلتر</span>
                                    @endif
                                    <br><br>
                                    <select name="gender[]" id="select-gender" multiple class="form-control form-control-lg select2">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($genders as $gender)
                                            <option {{(collect(old("gender"))->contains($gender->id))?"selected":""}} value="{{$gender->id}}"> {{$gender->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('gender')}}</div>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">المؤهل العلمي:* </label>
                                    @if(count($level_veiws)>0)
                                        @foreach($level_veiws as $level_veiw)
                                            <span disabled class="tag tag-orange tag-lg"style=" font-size:17px;"> {{\App\Models\Option::find($level_veiw->filter_id)->title}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي فلتر</span>
                                    @endif
                                    <br><br>
                                    <select name="level[]" id="select-level" multiple class="form-control form-control-lg select2">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($levels as $level)
                                            <option {{(collect(old("level"))->contains($level->id))?"selected":""}} value="{{$level->id}}"> {{$level->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('level')}}</div>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">المنطقة:* </label>
                                    @if(count($address_veiws)>0)
                                        @foreach($address_veiws as $address_veiw)
                                            <span disabled class="tag tag-blue"style=" font-size:17px;margin-top: 3px;"> {{\App\Models\Option::find($address_veiw->filter_id)->title}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي فلتر</span>
                                    @endif
                                    <br><br>
                                    <select name="address[]" id="select-address" multiple class="form-control form-control-lg select2">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($addresses as $address)
                                            <option {{(collect(old("address"))->contains($address->id))?"selected":""}} value="{{$address->id}}"> {{$address->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('address')}}</div>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">تصنيف الطالب:* </label>
                                    @if(count($classification_veiws)>0)
                                        @foreach($classification_veiws as $classification_veiw)
                                            <span disabled class="tag tag-purple"style=" font-size:17px;"> {{\App\Models\Option::find($classification_veiw->filter_id)->title}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي فلتر</span>
                                    @endif
                                    <br><br>
                                    <select name="classification[]" id="select-classification" multiple class="form-control form-control-lg select2">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($classifications as $classification)
                                            <option {{(collect(old("classification"))->contains($classification->id))?"selected":""}} value="{{$classification->id}}"> {{$classification->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('classification')}}</div>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">الجنسية:* </label>
                                    @if(count($nationality_veiws)>0)
                                        @foreach($nationality_veiws as $nationality_veiw)
                                            <span disabled class="tag tag-indigo"style=" font-size:17px;"> {{\App\Models\Option::find($nationality_veiw->filter_id)->title}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي فلتر</span>
                                    @endif
                                    <br><br>
                                    <select name="nationality[]" id="select-nationality" multiple class="form-control form-control-lg select2">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($nationalities as $nationality)
                                            <option {{(collect(old("nationality"))->contains($nationality->id))?"selected":""}} value="{{$nationality->id}}"> {{$nationality->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('nationality')}}</div>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">  تصنيف الدورات المسجلة للطالب:* </label>
                                    @if(count($course_veiws)>0)
                                        @foreach($course_veiws as $course_veiw)
                                         <?php $option=\App\Models\Option::find($course_veiw->filter_id);?>
                                            <span disabled class="tag tag-green"style=" font-size:17px;margin-top: 3px;">

                                                {{$option->title}} </span>

                                        @endforeach
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي فلتر</span>
                                    @endif
                                    <br><br>
                                    <select name="course[]" id="select-course" multiple class="form-control form-control-lg select2">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($courses as $course)
                                            <option {{(collect(old("course"))->contains($course->id))?"selected":""}} value="{{$course->id}}"> {{$course->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('course')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>


                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{$item->notes}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>

                        </div><br>
                          <div class="row ">
                               <div class="col-1">

                            </div>
                            <div class="col">
                                <label for="inputName" class="h4">فعال :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox" id="active" name="active"{{$item->active?"checked":""}}>
                            </div>
                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Campaign/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->

    @endcan

    @cannot('تعديل حملة')
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>




    <script>
    var date = $('.fc-datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();

        jQuery(document).ready(function() {
            select_gender_call();
            select_level_call();
            select_address_call();
            select_classification_call();
            select_nationality_call();
            select_course_call();
        });
        function select_gender_call(){$("#select-gender").selectize({maxItems:10,create:false})}
        function select_level_call(){$("#select-level").selectize({maxItems:10,create:false})}
        function select_address_call(){$("#select-address").selectize({maxItems:20,create:false})}
        function select_classification_call(){$("#select-classification").selectize({maxItems:10,create:false})}
        function select_nationality_call(){$("#select-nationality").selectize({maxItems:10,create:false})}
        function select_course_call(){$("#select-course").selectize({maxItems:20,create:false})}
    </script>

@endsection
