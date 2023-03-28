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
@can('اضافة صرف سلفة')
<a class="btn btn-primary btn-md" href="{{ route('ReceiptAdvance.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه سند صرف جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض صرف سلفة')


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
                                                <th>الصندوق الفرعي</th>
                                                <th>الموظف</th>
                                                <th>مبلغ السلفة</th>
                                                <th>عدد شهور السداد</th>
                                                <th>دفعات السداد الشهري</th>
                                                <th>يبدأ السداد من راتب شهر</th>
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



				<!-- row closed -->
                @endcan

                @cannot('عرض صرف سلفة')
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
                ajax: '/CMS/datatables/ReceiptAdvance',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'box_id', name: 'box_id' },
                    { data: 'employee_id', name: 'employee_id' },
                    { data: 'advance_payment', name: 'advance_payment' },
                    { data: 'month_count', name: 'month_count' },
                    { data: 'month_payment', name: 'month_payment' },
                    { data: 'start_payment', name: 'start_payment' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/ReceiptAdvance/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-primary" href="/CMS/ReceiptAdvance/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/ReceiptAdvance/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض صرف سلفة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل صرف سلفة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف صرف سلفة')
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
