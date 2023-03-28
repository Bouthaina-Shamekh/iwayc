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
<a class="btn btn-warning btn-md" href="{{ route('AllInvenRepo') }}"> جرد مستودع وتسويه</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')


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
                                <th>رقم الجرد</th>
                                <th>اسم المستودع</th>
                                <th>طالب الجرد</th>
                                <th>تاريخ</th>
                                 <th>قيمه النقص</th>
                                <th>تاريخ الموافقة علي التسوية</th>
                                <th>اسم المشرف</th>
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
@section('js')
  <script>
        $(function() {
            var riTable = $('#users-table').DataTable({
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
                searching: false,
                ajax: {
                    url: '/CMS/datatables/RepInvRecord',
                },
                columns: [
                    { data: 'inventory_num', name: 'inventory_num' },
                    { data: 'repository_id', name: 'repository_id' },
                    { data: 'user_id', name: 'user_id' },
                    { data: 'date_inv', name: 'date_inv' },
                    { data: 'sum_remaind', name: 'sum_remaind' },
                    { data: 'date_done', name: 'date_done' },
                    { data: 'admin_id', name: 'admin_id' }
                ]
            });
        });
    </script>
@endsection
