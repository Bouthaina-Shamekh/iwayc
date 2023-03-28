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
<div class="mt-2">
    @can('المهام العام')
<a href="/CMS/Sender/Task" class="btn btn-warning">قائمة المهام العام </a>
@endcan

@can('المهام المنتهية')
<a class="btn btn-warning" href="/CMS/End/Task">قائمه المهام المنتهيه</a>
@endcan
</div>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
    @can('اضافات مهمات ')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
            <form id="formID" class="formular form-horizontal ls_form" method="POST" action="/CMS/Task">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">المستقبل:* </label>

                                    <select name="receiver" id="receiver" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($users as $user)
                                        <option {{old("receiver")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('receiver')}}</div>
                                </div>

                                 <div class="col">
                                <label class="control-label">عنوان المهمة:* </label>


                                    <input type="text" value="{{old("title")}}" class="form-control validate[required] text-input" id="title"
                                           name="title" placeholder="أدخل عنوان المهمة">
                                    <div class="text-danger">{{$errors->first('title')}}</div>
                                </div>

                              <div class="col">
                                <label class="control-label">التصنيف:* </label>
                                    <select name="category" id="category" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($categories as $category)
                                            <option {{old('category')==$category->id?"selected":""}} value="{{$category->id}}"> {{$category->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('category')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">التفاصيل:* </label>
                                    <textarea class="animatedTextArea form-control summernote" id="summernote" id="details" name="details"
                                              placeholder="With animation :)">{{old("details")}}</textarea>
                                    <div class="text-danger">{{$errors->first('details')}}</div>
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
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-10">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Sender/Task/" class="btn btn-danger"> إلغاء</a>
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

    @cannot('اضافات مهمات ')
        <div class="col-md-offset-1 col-md-10 alert alert-danger" style="margin-bottom: 400px ;margin-top:10px"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            ليس لديك صلاحية يرجي مراجعة المسؤول
        </div>
    @endcannot
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')

<!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });

</script>

    <script>
        $(document).ready(function(){
            $("#btnStart").click(function(event){
                event.preventDefault();
                $('#date_timepicker_start').val('');
            });
            $("#btnEnd").click(function(event){
                event.preventDefault();
                $('#date_timepicker_end').val('');
            });
        });
    </script>
@endsection
