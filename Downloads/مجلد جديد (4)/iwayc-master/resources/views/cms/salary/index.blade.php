@extends('layouts.master')
@section('css')


@section('title')
 Iwayc System

@endsection

@section('title-page-header')
{{ $title }}
@endsection
@section('page-header')
{{ $subtitle }}

@endsection
@section('button1')
@can('اضافة راتب')
<a class="btn btn-primary btn-md" href="{{ route('Salary.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه راتب جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض راتب')

 <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="">
                    <h3 class="panel-title">
                    <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-success" data-toggle="collapse" href="#collapseExample" role="button">قائمة الفرز والفلترة</a>
                    </h3>
                </div>
                <div class="collapse" id="collapseExample">
                    <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    <select name="employee_h" id="employee_h" class="form-control">
                                        <option value=""> اختر اسم الموظف.... </option>
                                        @foreach($employees as $employee)
                                            <option {{old("employee_h")==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <?php $months = range(1,12); ?>
                                    <select name="month_h" id="month_h" class="form-control">
                                        <option value=""> اختر الشهر المطلوب.... </option>
                                        @foreach($months as $month)
                                            <option {{old("month_h")==$month?"selected":""}} value="{{$month}}"> {{$month}} </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br><br>

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
                                                <th></th>
                                                <th>اسم الموظف</th>
                                                <th>العام</th>
                                                <th>الشهر</th>
                                                <th>الراتب الشامل</th>
                                                <th>الراتب الاساسي</th>
                                                <th>امانات الضمان</th>
                                                <th>مساهمات الضمان</th>
                                                <th>تاريخ الطلب</th>
                                                <th width="15%"></th>
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

@section("js")
    <script>
        $(function() {
            var sTable = $('#users-table').DataTable({
                dom: 'Bfrtip',
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                buttons: [
                    {'extend':'excel','text':'أكسيل'},
                    {'extend':'print','text':'طباعة'},
                    {'extend':'pdf','text':'pdf'},
                    {'extend':'pageLength','text':'حجم العرض'},
                ],
                 paginate:true,
                 pageLength: 10,
                lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/Salary',
                    data: function (d) {
                        d.searchSalary = $('#users-table_filter input[type=search]').val();
                        d.employeeId = $('select[name=employee_h]').val();
                        d.monthId = $('select[name=month_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'employee_id', name: 'employee_id' },
                    { data: 'year', name: 'year' },
                    { data: 'month', name: 'month' },
                    { data: 'salary', name: 'salary' },
                    { data: 'salary_warranty', name: 'salary_warranty' },
                    { data: 'warranty_secretariats', name: 'warranty_secretariats' },
                    { data: 'warranty_contributions', name: 'warranty_contributions' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/Salary/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-primary" href="/CMS/Salary/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Salary/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض راتب')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل راتب')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف راتب')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });

            //filtering
            $('#employee_h').change(function() {
                sTable.draw();
            });
            $('#month_h').change(function() {
                sTable.draw();
            });
            $('#money_id').change(function() {
                sTable.draw();
            });
        });
    </script>
@endsection()
