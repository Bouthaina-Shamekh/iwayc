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
<a class="btn btn-primary btn-md" href="{{ route('Archive.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('اضافة ارشيف')



<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">


        <div class="card">
            <div class="card-body">
           <form enctype="multipart/form-data" id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Archive">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">القسم الرئيسي:* </label>
                                    <select name="section" id="section" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($sections as $section)
                                            <option {{old("section")==$section->id?"selected":""}} value="{{$section->id}}"> {{$section->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('section')}}</div>
                                </div>
                      <div class="col">
                                <label class="control-label">القسم الفرعي:* </label>
                                    <select name="sub_section" id="sub_section" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('sub_section')}}</div>
                                </div>
                            </div><br>


                        <div class="row">
                            <div class="col">
                                <label class="control-label">العنوان:* </label>
                                    <input type="text" value="{{old("address")}}" class="form-control text-input" id="address"
                                           name="address" placeholder="أدخل العنوان">
                                    <div class="text-danger">{{$errors->first('address')}}</div>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <textarea class="form-control" name="details" id="summernote"></textarea>
                                <div class="text-danger">{{$errors->first('details')}}</div>
                            </div>
                        </div><br>


                        <div class="row">
                            <div class="col">
                                <label class="control-label">الصور: </label>
                                    <input type="file" value="{{old("image")}}" class="form-control text-input" id="image"
                                           name="image[]" multiple>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">يظهر هذا المستند لـ:* </label>
                                    <select name="user_show[]" id="select-state" multiple class="form-control form-control-lg select2">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($users as $user)
                                            <option {{old("user_show")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('user_show')}}</div>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">من يستطيع التعديل عليه:* </label>


                                    <select id="select-state2" name="user_update[]" multiple class="form-control form-control-lg select2">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($users as $user)
                                            <option {{old("user_update")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('user_update')}}</div>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>

                                <div class="col-md-10 ls-group-input">
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="With animation :)">{{old("notes")}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>
                            </div>
                        </div><br>

                           <div class="row ls_divider">
                           <div class="col-1">

                            </div>
                            <div class="col">
                        <label for="inputName" class="h4">فعال :</label>
                        <input type="checkbox"value="1"   class="largerCheckbox" id="active" name="active"
                               {{old("active")?"checked":""}}>
                            </div>
                        </div><br>


                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Absence/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('اضافة ارشيف')
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
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

<!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });

</script>

 <script>
        jQuery(document).ready(function($){
            $('#section').change(function(){
                var id=$(this).val();
                $.get("/CMS/Section/" + id,
                function(data) {
                    var model = $('#sub_section');
                    model.empty();

                    $.each(data, function(index, element) {
                        model.append("<option value='"+ element.id +"'>" + element.title + "</option>");
                    });
                });
            });
        });
        window.onload = function() {
            if ($('#section').val()!=null){
                var id=$('#section').val();
                $.get("/CMS/Section/" + id,
                    function(data) {
                        var model = $('#sub_section');
                        model.empty();

                        $.each(data, function(index, element) {
                            <?php $m = "element.id;"?>
                            model.append("<option value='"+ element.id +"' {{old('sub_section')==$m ?'selected':''}}>" + element.title + "</option>");
                        });
                    });
            }
        };


    </script>


@endsection
