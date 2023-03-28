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
@can('اضافة خيارات')
<a href="/CMS/Option/add/{{$parent_id}}" class="btn btn-primary btn-md"><i class='fas fa-plus'style="margin-left: 10px"></i> إضافة قائمة جديدة </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="/CMS/Option/0">رجوع</a>
@stop
@endsection
@section('content')

@can('تعديل خيارات')
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">
      <div class="card">
      <div class="card-body">
  <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Option/edit/{{$item->id}}">
                        @csrf
                        <input type="hidden" value="{{$item->parent_id}}" name="parent_id"/>
                        <div class="row">
                            <div class="col-6">
                                <label class="control-label">عنوان الثابت:* </label>

                                    <input type="text" value="{{$item->title}}" class="form-control validate[required] text-input" id="title"
                                           name="title" placeholder="أدخل عنوان الثابت">
                                    <div class="text-danger">{{$errors->first('title')}}</div>
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
                            <div class="col text-center">
                                <label class="control-label"></label>
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Option/{{$parent_id}}" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        <br>

                    </form>

            </div>
        </div>
    </div>
</div>
 @endcan

    @cannot('تعديل خيارات')
        <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            ليس لديك صلاحية يرجي مراجعة المسؤول
        </div>
    @endcannot
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')

@endsection
