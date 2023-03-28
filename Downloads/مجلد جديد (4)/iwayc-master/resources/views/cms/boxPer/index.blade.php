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
                                <th></th>
                                <th>اسم الصندوق</th>
                                <th>اسم المستودع</th>
                                <th>صلاحيات العرض</th>
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
                searching:false,
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
                    url: '/CMS/datatables/BoxPer',
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'repository_id', name: 'repository_id' },
                    {"mRender": function ( data, type, row ) {
                            var cc ='';
                            if(row.per.length > 0){
                                $.each(row.per , function (i,val) {
                                    cc =cc+' <span disabled class="btn btn-info">'+row.per[i]+'</span> ';
                                });
                            }else {
                                cc ='<span disabled class="btn btn-danger">لم يتم اضافة مستخدمين</span>';
                            }
                            return cc;}
                    },
                    {"mRender": function ( data, type, row ) {
                            var per ='<a class="btn btn-xs btn-primary" href="/CMS/BoxPer/'+row.id+'"><i class="fa fa-list-alt"></i></a>';
                            return per;}
                    }
                ]
            });
        });
    </script>
@endsection
