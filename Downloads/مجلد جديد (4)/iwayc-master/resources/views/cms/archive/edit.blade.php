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
<a class="btn btn-primary btn-md" href="{{ route('Archive.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه ارشيف جديد</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Archive.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('تعديل ارشيف')


<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


      <div class="card">
      <div class="card-body">
 <form enctype="multipart/form-data" id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Archive/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">القسم الرئيسي:* </label>
                                    <select name="section" id="section" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($sections as $section)
                                            <option {{$item->section==$section->id?"selected":""}} value="{{$section->id}}"> {{$section->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('section')}}</div>
                                </div>
                             <div class="col">
                                <label class="control-label">القسم الفرعي:* </label>
                                    <select name="sub_section" id="sub_section" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($sub_sections as $sub_section)
                                            <option {{$item->sub_section==$sub_section->id?"selected":""}} value="{{$sub_section->id}}"> {{$sub_section->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('sub_section')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">العنوان:* </label>
                                    <input type="text" value="{{$item->address}}" class="form-control text-input" id="address"
                                           name="address" placeholder="أدخل العنوان">
                                    <div class="text-danger">{{$errors->first('address')}}</div>
                                </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-md-10 ls-group-input">
                                <textarea class="animatedTextArea form-control summernote" id="summernote" name="details" placeholder="With animation :)">{{old('details', $item->details)}}</textarea>
                                    <div class="text-danger">{{$errors->first('details')}}</div>
                                </div>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الصور: </label>
                                    <input type="file" class="form-control validate[required] text-input" id="image" name="image[]" multiple>


                           @if($images!=NULL)
                                        <br>
                                        <div class="ls-image-fluid-box">
                                    <div class="ls-fluid-box-gallery" style="display:-webkit-box !important;">
                                        @foreach($images as $image)

                                     <span class="removethis">
                                        <div class="imformationbox1" >
                                        <div class="col-md-2">
                                        <button type="button" class="deletebutton" id="" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <input type="hidden" value="{{$image->id}}" name="oldimages[]" />
                                         <a  href='{{ asset('images/userimage').'/'. $image->filename }}' title="" data-fluidbox class="col-2">
                                                <img  src='{{ asset('images/userimage').'/'. $image->filename }}' alt="" title="" />
                                            </a>
                                        </div>
                                        </div>
                                        </span>

                                        @endforeach
                                        </div></div>

                                    @endif
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">يظهر هذا المستند لـ:* </label>
                                    <select name="user_show[]" id="select-state" multiple class="form-control form-control-lg select2">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}"  @if(count($archive_veiws)>0)
                                        @foreach($archive_veiws as $archive_veiw) @if($archive_veiw->user_id==$user->id)selected @endif @endforeach @endif> {{$user->name}} </option>
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
                                            <option value="{{$user->id}}" @if(count($archive_edits)>0)
                                        @foreach($archive_edits as $archive_edit)@if($archive_edit->user_id==$user->id)selected @endif @endforeach @endif> {{$user->name}} </option>
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
                                              placeholder="With animation :)">{{$item->notes}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>
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

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Archive/" class="btn btn-danger"> إلغاء</a>

                            </div>
                        </div><br>

                    </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endcan

    @cannot('تعديل ارشيف')
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
    <script>
$(document).on('click',".deletebutton" ,function() {
 $(this).closest(".removethis" ).remove();
});
</script>
@endsection
