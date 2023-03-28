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
@can('اضافة صرف مكافأة')
<a class="btn btn-primary btn-md" href="{{ route('ReceiptReward.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه سند صرف جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض صرف مكافأة')



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
                                                <th>النوع</th>
                                                <th>المبلغ</th>
                                                <th>من شهر</th>
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

                @cannot('عرض صرف مكافأة')
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
            var rrTable = $('#users-table').DataTable({
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/CMS/datatables/ReceiptReward',
                    data: function (d) {
                        d.searchReceiptReward = $('input[name=searchReceiptReward]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'box_id', name: 'box_id' },
                    { data: 'employee_id', name: 'employee_id' },
                    { data: 'type', name: 'type' },
                    { data: 'receipts_rewards', name: 'receipts_rewards' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/ReceiptReward/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-primary" href="/CMS/ReceiptReward/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/ReceiptReward/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض صرف مكافأة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل صرف مكافأة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف صرف مكافأة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            $('#searchReceiptReward').keyup(function(e) {
                rrTable.draw();
            });
        });
        window.onload = function() {
            $("#users-table_filter").remove();
        };
    </script>
@endsection()
