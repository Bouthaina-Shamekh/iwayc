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
@section('button2')
<a class="btn btn-primary btn-md" href="{{route('Employee.index')}}">رجوع</a>
@stop
@endsection
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row ls_divider">
                    <div class="col-md-4 control-label">
                        <select name="employee_h" id="employee_h" class="form-control">
                            <option value=""> اختر الموظف.... </option>
                            @foreach($employees as $employee)
                                <option {{old("employee_h")==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 control-label">
                        <?php $months = range(1,12); ?>
                        <select name="month_h" id="month_h" class="form-control">
                            <option value=""> اختر الشهر المطلوب.... </option>
                            @foreach($months as $month)
                                <option {{old("month_h")==$month?"selected":""}} value="{{$month}}"> {{$month}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 control-label">اسم الموظف: <strong id="employeeName"></strong></div>
                </div>
                <br>
                <div class="row ls_divider">
                    <div class="col-md-4 control-label">مجموع سلف الموظف: (<strong id="employeeAdv">0</strong> دينار)</div>
                    <div class="col-md-4 control-label">مجموع سداد السلف: (<strong id="employeePay">0</strong> دينار)</div>
                    <div class="col-md-4 control-label">باقي ذمم السلف: (<strong id="employeeRec">0</strong> دينار)</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- row -->
<div class="row">
    <!--div-->
<div class="col-xl-12">
<div class="card mg-b-20">
    <div class="card-header pb-0">
        <div class="d-flex justify-content-between">

    </div>
    <div class="card-body">
        <div class="table-responsive ls-table">
            <table id="users-table" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="5%">الشهر</th>
                        <th width="5%">العام</th>
                        <th width="10%">الراتب الاساسي</th>
                        <th width="10%">الراتب الشامل</th>
                        <th width="5%">المكافأت</th>
                        <th width="5%">الخصومات</th>
                        <th width="10%">صافي الراتب</th>
                        <th width="10%">المقبوضات</th>
                        <th width="5%">  مستردات السلف</th>
                        <th width="10%">باقي الراتب</th>
                        <th width="10%">مدفوعات الضمان</th>
                        <th width="10%">امانات الضمان</th>
                        <th width="10%">مساهمات الضمان</th>
                    </tr>
                    </thead>



            </table>
        </div>
    </div>
</div>
</div>
<!--/div-->
</div>



<!-- row closed -->

</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section("js")
    <script>
        $('#employee_h').change(function(){
            var id=$(this).val();
            $.get("/CMS/salary/Emp/" + id,
                function(data) {
                    $('#employeeName').replaceWith('<strong id="employeeName">'+data.name+'</strong>');
                    $('#employeeAdv').replaceWith('<strong id="employeeAdv">'+data.adv+'</strong>');
                    $('#employeePay').replaceWith('<strong id="employeePay">'+data.recs+'</strong>');
                    $('#employeeRec').replaceWith('<strong id="employeeRec">'+data.rem+'</strong>');
                });
        });
        $(function() {
            var cTable = $('#users-table').DataTable({
                dom: 'Bfrtip',
                processing: true,
                serverSide: true,
                buttons: [
                    {'extend':'excel','text':'أكسيل'},
                    {'extend':'print','text':'طباعة'},
                    {'extend':'pdf','text':'pdf'},
                    {'extend':'pageLength','text':'حجم العرض'},
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/EmployeeS',
                    data: function (d) {
                        d.employeeId = $('select[name=employee_h]').val();
                        d.monthId = $('select[name=month_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'month', name: 'month' },
                    { data: 'year', name: 'year' },
                    { data: 'salary_warranty', name: 'salary_warranty' },
                    { data: 'salary', name: 'salary' },
                    { data: 'rew', name: 'rew' },
                    { data: 'rec', name: 'rec' },
                    { data: 'net', name: 'net' ,className: "blue-column"},
                    { data: 'recs', name: 'recs' },
                    { data: 'adv', name: 'adv' },
                    { data: 'rem', name: 'rem' ,className: "blue-column"},
                    { data: 'wan', name: 'wan' },
                    { data: 'warranty_secretariats', name: 'warranty_secretariats' },
                    { data: 'warranty_contributions', name: 'warranty_contributions' }
                ]
            });
            //filtering
            $('#employee_h').change(function() {
                cTable.draw();
            });
            $('#month_h').change(function() {
                cTable.draw();
            });
            $('#money_id').change(function() {
                cTable.draw();
            });
        });
    </script>
@endsection()

@section('css')
    <style>
        .blue-column {
            background-color: #428bca !important;
            color: white;
        }
    </style>

@endsection()

