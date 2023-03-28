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
<a class="btn btn-primary btn-md" href="/CMS/Option/0">رجوع</a>
@else
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@endif
@stop
@endsection
@section('content')


@can('اضافة خيارات')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
          <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Option/add/{{$parent_id}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">عنوان الثابت:* </label>
                                    <input type="text" value="{{old("title")}}" class="form-control validate[required] text-input" id="title"
                                           name="title" placeholder="أدخل عنوان الثابت">
                                           <div class="text-danger">{{$errors->first('title')}}</div>
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

                        <div class="row">
                            <div class="col text-center">
                                <label class="control-label"></label>
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/Option/{{$parent_id}}" class="btn btn-danger"> إلغاء</a>
                                </div>

                        </div><br>

                    </form>

            </div>
        </div>
      @endcan

    @cannot('اضافة خيارات')
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
