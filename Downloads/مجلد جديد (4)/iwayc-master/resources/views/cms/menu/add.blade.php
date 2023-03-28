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
@if($parent_id!=0)
<a href="/CMS/Menu/{{$parent_id}}" class="btn btn-primary btn-md">عودة</a>
@else
<a class="btn btn-primary btn-md" href="/CMS/Menu/0">رجوع</a>
@endif
@stop
@endsection
@section('content')
     @can('اضافة قائمة')

<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <h3 class="panel-title">اضافة قائمة جديدة</h3>
            <div class="card-body">
                <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Menu/add/{{$parent_id}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">عنوان القائمة:* </label>
                                    <input type="text" value="{{old("title")}}" class="form-control validate[required] text-input" id="title"
                                           name="title" placeholder="أدخل عنوان القائمة">
                                    <div class="text-danger">{{$errors->first('title')}}</div>
                                </div>

                        </div><br>
                               <div class="row">

                            <div class="col">
                                <label class="control-label">رابط القائمة:* </label>
                                    <input placeholder="http://example.com" value="{{old("slug")}}"
                                           class="validate[required,custom[url]] form-control" type="text" name="slug"
                                           id="slug"/>
                                    <div class="text-danger">{{$errors->first('slug')}}</div>
                                </div>
                            <div class="col">
                                <label class="control-label">شكل الايقونه :* </label>
                                    <input placeholder="<i class='far fa-ICON_NAME'></i>" value="{{old("icone")}}"
                                           class="form-control" type="text" name="icone"required 
                                           id="icone"/>
                                    <div class="text-danger">{{$errors->first('icone')}}</div>
                                </div>
                        </div><br>
                     <div class="row ls_divider">

                            <div class="col">
                                <label for="inputName" class="h4">اظهار في القائمة :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox" id="show_menu" name="show_menu"
                               {{old("show_menu")?"checked":""}}>

                            </div>
                            <div class="col">
                                <label for="inputName" class="h4">فعال :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox" id="active" name="active"
                               {{old("active")?"checked":""}}>
                            </div>
                        </div><br>
                        <div class="row last">
                            <div class="col-12 text-center">
                                <label class="control-label"></label>

                                <div class="col-sm-12">
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

    @cannot('اضافة قائمة')
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
