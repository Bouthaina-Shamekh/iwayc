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
@can('اضافة قائمة')
<a class="btn btn-primary btn-md" href="/CMS/Menu/add/{{$parent_id}}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة خيار جديد </a>
@endcan
@endsection
@section('button2')

<a class="btn btn-primary btn-md" href="/CMS/Menu/0">رجوع</a>
@stop
@endsection
@section('content')

 @can('تعديل قائمة')
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


        <div class="card">
          <h3 class="panel-title">تعديل القائمة</h3>
        <div class="card-body">
                 <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Menu/edit/{{$item->id}}">
                        @csrf
                        <input type="hidden" value="{{$item->parent_id}}" name="parent_id"/>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">عنوان القائمة:* </label>
                                    <input type="text" value="{{$item->title}}" class="form-control validate[required] text-input" id="title"
                                           name="title" placeholder="أدخل عنوان القائمة">
                                    <div class="text-danger">{{$errors->first('title')}}</div>
                                </div>

                        </div><br>

                           <div class="row">
                            <div class="col">
                                <label class="control-label">رابط القائمة:* </label>
                                    <input placeholder="http://example.com" value="{{$item->slug}}"
                                           class="validate[required,custom[url]] form-control" type="text" name="slug"
                                           id="slug"/>
                                    <div class="text-danger">{{$errors->first('slug')}}</div>
                                </div>

                         <div class="col">
                                <label class="control-label">شكل الايقونه :*</label>
                                    <input placeholder="<i class='far fa-ICON_NAME'></i>" value="{{$item->icone}}"
                                           class="form-control" type="text" name="icone"required
                                           id="icone"/>
                                    <div class="text-danger">{{$errors->first('icone')}}</div>
                                </div>

                        </div><br>

                           <div class="row ">
                                  <div class="col">
                                <label for="inputName" class="h4"> اظهار في القائمة :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox" id="show_menu" name="show_menu"{{$item->show_menu?"checked":""}}>
                            </div>
                            <div class="col">
                                <label for="inputName" class="h4">فعال :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox" id="active" name="active"{{$item->active?"checked":""}}>
                            </div>
                        </div><br>
                        <div class="row last">
                            <div class="col text-center">
                                <label class="control-label"></label>

                                <div class="col-sm-10">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Menu/{{$parent_id}}" class="btn btn-danger"> إلغاء</a>
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

    @cannot('تعديل قائمة')
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
@endsection
