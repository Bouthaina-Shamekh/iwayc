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

@can('عرض خيارات')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
           <h3 class="panel-title">عرض القائمة</h3>
            <div class="card-body">
                    <div class="">
                     <form id="formID" class="formular form-horizontal ls_form">
                        <div class="row ">
                            <div class="col">
                                <label class="control-label">عنوان القائمة: </label>
                                <input type="text" value="{{$item->title}}" class="form-control" id="title"
                                           name="title" disabled>
                                </div>
                            <div class="col">
                                <label class="control-label">رابط القائمة: </label>
                                    <input value="{{$item->slug}}"class="form-control" type="text" name="slug" id="slug" disabled/>
                                </div>

                        </div><br>
                          <div class="row ">
                             <div class="col">
                                <label class="control-label">رابط القائمة: </label>
                                    <input value="{{$item->slug}}"class="form-control" type="text" name="slug" id="slug" disabled/>
                                </div>
                            <div class="col">
                                <label class="control-label">شكل الايقونه :</label>
                                    <input value="{{$item->icone}}"class="form-control" type="text" name="icone" id="icone" disabled/>
                                </div>

                        </div><br>
                     <div class="row">
                            <div class="col">

                              <input value="{{$item->active?"فعال":"غير فعال"}}"
                                           class="form-control text-input"
                                           type="text" name="active" id="active" disabled="disabled"/>

                                </div>
                                  <div class="col">

                                     <input value="{{$item->show_menu?"ظاهر":"غير ظاهر"}}"
                                           class="form-control text-input"
                                           type="text" name="showLink" id="showLink" disabled="disabled"/>

                                </div>
                                </div><br>


                        <div class="row  last">
                            <div class="col text-center">
                                <label class="control-label"></label>

                                <div class="col-sm-12">
                                    @can('تعديل قائمة')
                                    <a href="/CMS/Menu/edit/{{$item->id}}" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Menu/{{$item->parent_id}}" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>
        </div>
    </div>
</div>
</div>
<!-- row closed -->
</div>
   @endcan
   @cannot('عرض خيارات')
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
