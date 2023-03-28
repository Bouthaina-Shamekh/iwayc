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
<a class="btn btn-warning btn-md" href="/CMS/RepInvRecord">سجلات الجرد</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Repository.index') }}">رجوع</a>
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
                                <th></th>
                                <th>جرد</th>
                                <th>رقم الجرد</th>
                                <th>اسم المستودع</th>
                                <th>طالب الجرد</th>
                                <th>مسوؤل الجرد</th>
                                <th>قيمه النقص</th>
                                <th>تاريخ</th>
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

			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')

  <script>
        $(function() {
            var roTable = $('#users-table').DataTable({
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

                ajax: {
                    url: '/CMS/datatables/RepositoryInventory',
                    {{-- data: function (d) {
                        d.searchRepositoryOut = $('#users-table_filter input[type=search]').val();
                        d.repositoryId = $('select[name=repository_s]').val();
                        d.userId = $('select[name=user_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                        d.fromId = $('#from_h').val();
                        d.toId = $('#to_h').val();
                    } --}}
                },
                columns: [
                    { data: 'id', name: 'id' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-primary" href="/CMS/Rep/Inventory/'+row.rep_id+'"><i class="fa fa-list-alt"></i></a>';
                            return show;}
                    },
                    { data: 'inventory_num', name: 'inventory_num' },
                    { data: 'repository_id', name: 'repository_id' },
                    { data: 'created_by', name: 'created_by' },
                    { data: 'resUser_id', name: 'resUser_id' },
                    { data: 'rem_price', name: 'rem_price' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {

                {{-- var edit ='<a class="btn btn-sm btn-info" href="/CMS/RepositoryOut/'+row.id+'">تعديل</a>'; --}}

                var done ='<a class="btn btn-sm btn-success" href="/CMS/Accept/Inventory/'+row.rep_id+'">موافقه علي تسويه</a>';
                var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/InventoryRepos/'+row.id+'">حذف</a>';

                var ress ='';

                {{-- ress=ress+' '+edit; --}}

                var my_var = <?php echo json_encode(Auth::user()->name); ?>;
                if(row.created_by == my_var &&row.is_end=='1'){ress=ress+' '+done;}

                ress=ress+' '+dele;

                    return ress;
                 }
                    }
                ]
            });
            $('#repository_s').change(function() {
                roTable.draw();
            });
            $('#user_h').change(function() {
                roTable.draw();
            });
            $('#search_h').click(function(e) {
                e.preventDefault();
                roTable.draw();
            });
            $('#money_id').change(function() {
                roTable.draw();
            });
            roTable.on( 'xhr', function () {
                var json = roTable.ajax.json();
                $("#total_filter").replaceWith('<Strong id="total_filter">'+json.tot+'</Strong>');
            });
        });
        $(function() {
            $(".fc-datepicker").datepicker(
                {
                    dateFormat: 'yy-mm-dd'
                });
            $(".fc-datepicker").val('');
        });
    </script>
@endsection
