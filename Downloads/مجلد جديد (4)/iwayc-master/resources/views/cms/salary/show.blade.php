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
<a class="btn btn-primary btn-md" href="{{ route('Salary.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه راتب جديد </a>

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('AbsenceT.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض راتب')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">
                         <div class="row">
                            <div class="col">
                                <label class="col-md-2 control-label">اسم راتب:* </label>

                                <div class="col-md-10">
                                    <input type="text" value="{{\App\Models\Employee::find($item->employee_id)->name}}" class="form-control" id="employee_id"
                                           name="employee_id" disabled>
                                </div>
                                </div>

                                  <div class="col">
                                    <label class="col-md-2 control-label">الشهر:* </label>

                                    <div class="col-md-10">
                                        <input type="text" value="{{$item->month}}" class="form-control" id="month"
                                               name="month" disabled>
                                     </div>
                                </div>


                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">الراتب الشامل:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->salary}}" class="form-control" id="salary"
                                           name="salary" disabled>
                                </div>
                                </div>

                            <div class="col">
                                <label class="col control-label">الراتب الاساسي:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->salary_warranty}}" class="form-control" id="salary_warranty"
                                           name="salary_warranty" disabled>
                                </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="col control-label">امانات الضمان:* </label>

                                <div class="col">
                                    <input type="text" value="{{$item->warranty_secretariats}}" class="form-control" id="warranty_secretariats"
                                           name="warranty_secretariats" disabled>
                                </div>
                                </div>

                        <div class="col">
                            <label class="colcontrol-label">مساهمات الضمان:* </label>

                            <div class="col">
                                <input type="text" value="{{$item->warranty_contributions}}" class="form-control" id="warranty_contributions"
                                       name="warranty_contributions" disabled>
                                    </div>
                                </div>

                        </div><br>










                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    @can('تعديل راتب')
                                    <a href="/CMS/Salary/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Salary/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>


        </div>
    </div>
</div>
<!-- row closed -->
@endcan
    @cannot('عرض راتب')
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
