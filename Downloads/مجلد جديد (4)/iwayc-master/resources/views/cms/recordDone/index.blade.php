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
<a class="btn btn-primary btn-md" href="/CMS/ApprovalRecord">طلب موافقه حركات</a>
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
                                                <th>التاريخ والوقت</th>
                                                <th>صادر عن المستخدم</th>
                                                 <th>المستخدم المسؤول</th>
                                                <th>عنوان السجل/القسم</th>
                                                 <th>القرار</th>
                                                <th>العرض</th>

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
                searching: false,
                ajax: '/CMS/datatables/RecordDone',
                columns: [
                    { data: 'created_at', name: 'created_at' },
                    { data: 'res', name: 'res' },
                    { data: 'created_by', name: 'created_by' },
                    { data: 'title', name: 'title' },
                    { data: 'type', name: 'type' },
                    {"mRender": function ( data, type, row ) {
                         var show ="";
                        if(row.type == "موافق"){
                          show ='<a class="btn btn-sm btn-warning" href="/CMS/' + row.slug + '/' + row.row_id + '">عرض</a>';

                        }else{
                            show="";
                        }
                         return show;
                            }
                    }
                ]
            });
        });
    </script>
@endsection
