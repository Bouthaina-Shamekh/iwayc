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
<a class="btn btn-primary btn-md" href="{{ route('CollectionFees.index') }}">رجوع</a>
@stop
@endsection
@section('content')
 @can('تعديل متابعة طلاب')


<!-- row -->
<div class="row">

    <div class="col-lg-10 col-md-12">


        <div class="card">
        <div class="card-body">
       <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/CollectionFees/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col-10">
                                <label class="control-label">التهرب: </label>
                                    <select name="evasion" id="evasion" class="form-control">
                                        <option value="">اختر من القائمة....</option>
                                        <option {{$item->evasion==0?"selected":""}} value="0">لا</option>
                                        <option {{$item->evasion==1?"selected":""}} value="1">نعم</option>
                                    </select>
                                    <div class="text-danger">{{$errors->first('evasion')}}</div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-10">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{$item->notes}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-12 text-center">
                                <label class="control-label"></label>
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/CollectionFees/" class="btn btn-danger"> إلغاء</a>
                            </div>
                        </div>

                    </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
 @endcan

    @cannot('تعديل متابعة طلاب')
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
