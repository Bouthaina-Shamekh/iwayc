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
 @can('اضافة مستودع')
<a class="btn btn-primary btn-md" href="{{ route("Repository.create") }}"><i class='fas fa-plus'style="margin-left: 10px">إضافة مستودع جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
  @can('عرض مستودع')

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
                                <th>اسم المستودع</th>
                                <th>اسم الصندوق</th>
                                <th>الايرادات</th>
                                <th>المصروفات</th>
                                <th>الرصيد</th>
                                <th>الحالة</th>
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

    @cannot('عرض مستودع')
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
            var rTable = $('#users-table').DataTable({
                dom: 'Bfrtip',
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                "pageLength": 25,
                buttons: [
                    {'extend':'excel','text':'أكسيل'},
                    {'extend':'print','text':'طباعة'},
                    {'extend':'pdf','text':'pdf','exportOptions': {'orthogonal': "PDF"},customize: function ( doc ) {processDoc(doc); //fun in app.js
                    }},
                    {'extend':'pageLength','text':'حجم العرض'},
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                    columnDefs: [{
                        targets: '_all',
                        render: function(data, type, row) {
                            if (type === 'PDF') {
                                return String(data).split(' ').reverse().join('  ');
                            }  return data;} }
                   ],
                ajax: {
                    url: '/CMS/datatables/Repository',
                    data: function (d) {
                        d.searchRepository = $('#users-table_filter input[type=search]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    {"mRender": function ( data, type, row ) {

                    if(row.isDone == 1){
                                var show ='<form style="display: inline;"action="/CMS/InventoryRepo" method="post">@csrf <input type="hidden" value="'+row.id+'" name="repo"><input class="btn btn-md btn-success disable" type="submit" value="جرد" name="submit"></form>';
                             }else{
                                  var show ='<form style="display: inline;"action="/CMS/InventoryRepo" method="post">@csrf <input type="hidden" value="'+row.id+'" name="repo"><input class="btn btn-md btn-success" type="submit" value="جرد" name="submit"></form>';
                             }

                            return show;}
                    },
                    { data: 'name', name: 'name' },
                    { data: 'box_id', name: 'box_id' },
                    { data: 'repository_in', name: 'repository_in' },
                    { data: 'repository_out', name: 'repository_out' },
                    { data: 'total', name: 'total' },
                    {"mRender": function ( data, type, row ) {
                            var cbAct = '<input type="checkbox" value="0" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" />';
                            if(row.activeI==1){
                                cbAct = '<input type="checkbox" value="1" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" checked />';
                            }
                            return cbAct;
                        }
                        ,orderable: false},
                    {"mRender": function ( data, type, row ) {
                            var add ='<a class="btn btn-sm btn-primary" href="/CMS/RepositorySection/'+row.id+'">اضافه قسم</a>';
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/Repository/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Repository/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Repository/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض مستودع')
                                ress=ress+' '+show;
                            @endcan
                            @can('اضافة اقسام مستودع')
                                ress=ress+' '+add;
                            @endcan
                                    @can('تعديل مستودع')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف مستودع')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            $('#money_id').change(function() {
                rTable.draw();
            });
        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Repository/active/" + id,
                complete: function (data) {
                    if (data.status==200){
                         not7();
                    }
                    else{not8()}
                }
            })
        }
    </script>
@endsection
