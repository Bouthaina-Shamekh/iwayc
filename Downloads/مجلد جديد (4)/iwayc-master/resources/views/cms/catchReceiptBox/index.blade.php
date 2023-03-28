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
  @can('اضافة قبض صندوق')
<a class="btn btn-primary btn-md" href="{{ route('CatchReceiptBox.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة سند قبض جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض قبض صندوق')


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
                                <th>الرقم الحاسوبي</th>
                                <th>الرقم الورقي</th>
                                <th>الصندوق الفرعي</th>
                                <th>تصنيف الايراد</th>
                                <th>اسم الزبون</th>
                                <th>العدد</th>
                                <th>المبلغ</th>
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



	  @endcan

    @cannot('عرض قبض صندوق')
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
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: '/CMS/datatables/CatchReceiptBox',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'id_comp', name: 'id_comp' },
                    { data: 'box_id', name: 'box_id' },
                    { data: 'type', name: 'type' },
                    { data: 'customer', name: 'customer' },
                    { data: 'count', name: 'count' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/CatchReceiptBox/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/CatchReceiptBox/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/CatchReceiptBox/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض قبض صندوق')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل قبض صندوق')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف قبض صندوق')
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
@endsection
