@extends('layouts.master')
@section('css')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
@can('اضافة موظف')
<a class="btn btn-primary btn-md" href="{{ route("Archive.create") }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه موظف جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Archive.index') }}">رجوع</a>
@stop
@endsection
@section('content')

@can('تعديل مهمات')
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


      <div class="card">
      <div class="card-body">
 <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Task/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">المرسل:* </label>
                                    <input type="text" value="{{\App\Models\User::find($item->sender)->name}}" class="form-control" id="sender"
                                           name="sender" disabled>
                                </div>
                        <div class="col">
                                <label class="control-label">المستقبل:* </label>
                                    <select name="receiver" id="receiver" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($users as $user)
                                            <option {{$item->receiver==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('receiver')}}</div>
                                </div>

                        </div><br>
                        <div class="row">

                       <div class="col">
                                <label class="control-label">عنوان المهمة:* </label>
                                    <input type="text" value="{{$item->title}}" class="form-control validate[required] text-input" id="title"
                                           name="title" placeholder="أدخل عنوان المهمة">
                                    <div class="text-danger">{{$errors->first('title')}}</div>
                                </div>

                               <div class="col">
                                <label class="control-label">التصنيف:* </label>
                                    <select name="category" id="category" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($categories as $category)
                                            <option {{$item->category==$category->id?"selected":""}} value="{{$category->id}}"> {{$category->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('category')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                                    <div class="col">
                                <label class="control-label">التفاصيل:* </label>
                                    <textarea class="animatedTextArea form-control summernote" id="summernote" id="details" name="details"
                                              placeholder="With animation :)">{{$item->details}}</textarea>
                                    <div class="text-danger">{{$errors->first('details')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">وقت التفعيل:* </label>
                                    <input type="text" value="{{$item->start_date}}"
                                           class="form-control datepicker" id="start_date" name="start_date" placeholder="أدخل وقت التفعيل">
                                    <div class="text-danger">{{$errors->first('start_date')}}</div>
                                </div>
                                 <div class="col">
                                <label class="control-label">وقت الانتهاء:* </label>
                                    <input type="text" value="{{$item->end_date}}"
                                           class="form-control datepicker" id="end_date" name="end_date" placeholder="أدخل وقت الانتهاء">
                                    <div class="text-danger">{{$errors->first('end_date')}}</div>
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

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
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

    @cannot('تعديل مهمات')
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

<!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });

</script>

@endsection
