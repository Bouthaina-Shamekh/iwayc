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
@can('اضافة صرف راتب')
<a class="btn btn-primary btn-md" href="{{ route('ReceiptSalary.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه سند صرف جديد  </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض صرف راتب')
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
                                                <th>الصندوق الفرعي</th>
                                                <th>الموظف</th>
                                                <th>الشهر</th>
                                                <th> سداد ذمم</th>
                                                <th>المبلغ</th>
                                               <th>المبلغ الكلى</th>
                                                <th>تاريخ الطلب</th>
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
                </div>
				<!-- row closed -->

                @endcan
    @cannot('عرض صرف راتب')
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

   <script>
        $(function() {
            $('#users-table').DataTable({
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                ajax: '/CMS/datatables/ReceiptSalary',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'box_id', name: 'box_id' },
                    { data: 'employee_id', name: 'employee_id' },
                    { data: 'month', name: 'month' },
                    { data: 'advance_payment', name: 'advance_payment' },
                    { data: 'amount', name: 'amount' },
                    { data: 'total_amount', name: 'total_amount' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/ReceiptSalary/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-primary" href="/CMS/ReceiptSalary/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger"href="/CMS/delete/ReceiptSalary/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض صرف راتب')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل صرف راتب')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف صرف راتب')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ],
                 language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
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
@endsection
