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
 @can('اضافة سنة مالية')
<a class="btn btn-primary btn-md" href="{{ route('Money.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه سنه ماليه جديده</a>
@endcan
@endsection
@section('button2')

<a class="btn btn-primary btn-md" href="{{ route('Money.index') }}">رجوع</a>

@stop
@endsection

@section('content')

   @can('عرض سنة مالية')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <h3 class="panel-title">عرض السنوات المالية</h3>
            <div class="card-body">
                    <div class="">
              <form id="formID" class="formular form-horizontal ls_form">
                        <div class="row ">
                            <div class="col">
                                <label class="control-label">العام:* </label>
                                    <input type="text" value="{{$item->year}}" class="form-control" id="year"
                                           name="year" disabled>
                                </div>
                                  <div class="col">
                                <label class="control-label">بداية العام:* </label>
                                    <input type="text" value="{{$item->start_year}}" class="form-control" id="start_year"
                                           name="start_year" disabled>
                                </div>
                             <div class="col">
                                <label class="control-label">نهاية العام:* </label>
                                    <input type="text" value="{{$item->end_year}}" class="form-control" id="end_year"
                                           name="end_year" disabled>
                                </div>

                        </div><br>


                        <div class="row ">
                            <div class="col">
                                <label class="control-label">الهدف المالي:* </label>
                                    <input type="text" value="{{$item->money_goal}}" class="form-control" id="money_goal"
                                           name="money_goal" disabled>
                                </div>
                             <div class="col">
                                <label class="control-label">رصيد اول المدة للصندوق الرئيسي:* </label>
                                    <input type="text" value="{{$item->first_time_balance}}" class="form-control" id="first_time_balance"
                                           name="first_time_balance" disabled>
                                </div>

                        </div><br>
                              <div class="row">
                            <div class="col">
                                <label class="control-label">يظهر هذا العام لـ: </label>
                                    @if(count($year_veiws)>0)
                                        @foreach($year_veiws as $year_veiw)
                                            <span disabled class="tag tag-orange"> {{\App\Models\User::find($year_veiw->user_id)->name}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي مستخدم لعرض العام</span>
                                    @endif

                            </div>
                        </div><br>

                        <div class="row ">
                            <div class="col">
                                <label class="control-label">الفعالية: </label>
                                    <input value="{{$item->active?"فعال":"غير فعال"}}"
                                           class="form-control text-input"
                                           type="text" name="active" id="active" disabled/>
                                </div>
                                   <div class="col">
                                <label class="control-label">الاساسي: </label>
                                    <input value="{{$item->basic_work?"نعم":"لا"}}"
                                           class="form-control text-input"
                                           type="text" name="basic_work" id="basic_work" disabled/>
                                </div>

                        </div><br>


                        <div class="row  last">
                            <div class="col text-center">
                                <label class="control-label"></label>

                                <div class="col">
                                    @can('تعديل سنة مالية')
                                    <a href="/CMS/Money/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Money/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>
        </div>
    </div>
</div>
<!-- row closed -->

 @endcan
    @cannot('عرض  صرف صندوق')
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
