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
@can('اضافة صرف ضمان')
<a class="btn btn-primary btn-md" href="{{ route('ReceiptWarranty.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه سند صرف جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض صرف ضمان')


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
                                                <th>الموظف</th>
                                                <th>الشهر</th>
                                                <th>الراتب</th>
                                                <th>المبلغ</th>
                                                <th>تاريخ الطلب</th>
                                                <th>اسم المستخدم</th>
                                                <th></th>
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

    @cannot('عرض صرف ضمان')
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
            $('#users-table').DataTable({
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                ajax: '/CMS/datatables/ReceiptWarranty',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'employee_id', name: 'employee_id' },
                    { data: 'monthYear', name: 'monthYear' },
                    { data: 'salary_id', name: 'salary_id' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/ReceiptWarranty/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-primary" href="/CMS/ReceiptWarranty/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/ReceiptWarranty/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض صرف ضمان')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل صرف ضمان')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف صرف ضمان')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.footer()).empty())
                            .on('change', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                    });
                }
            });
        });
    </script>
@endsection()
