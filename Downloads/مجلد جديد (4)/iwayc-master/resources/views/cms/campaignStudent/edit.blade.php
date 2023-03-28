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
<a class="btn btn-primary btn-md" href="{{ route('Campaign.index') }}">رجوع</a>
@stop
@endsection
@section('content')

@can('تعديل متابعة حملة')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                   <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/CampaignStudent/{{$item->id}}/edit">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">مدي الاستجابة:* </label>
                                    <select name="response" id="response" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($res as $re)
                                            <option {{$item->response==$re->id?"selected":""}} value="{{$re->id}}"> {{$re->title}} </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{$errors->first('response')}}</div>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              placeholder="أدخل ملاحظات">{{$item->notes}}</textarea>
                                    <div class="text-danger">{{$errors->first('notes')}}</div>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/CampaignStudent/{{$item->campaign_id}}" class="btn btn-danger"> إلغاء</a>
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

    @cannot('تعديل متابعة حملة')
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
