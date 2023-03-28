@extends('layouts.master')
@section('css')
<style>

</style>
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
 @can('اضافة سنة مالية')
<a class="btn btn-primary btn-md" href="{{ route('Money.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه سنه ماليه جديده</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')



    @can('عرض سنة مالية')


		<!-- row -->
				<div class="row">
                			<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							 <h3 class="panel-title"> ادارة السنوات المالية </h3>
							<div class="card-body">
								<div class="table-responsive ls-table">
									<table id="users-table" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>العام</th>
                                <th>بداية العام</th>
                                <th>نهاية العام</th>
                                <th>الهدف المالي</th>
                                <th>رصيد اول المدة</th>
                                <th>الحالة</th>
                                <th>العام الاساسي</th>
                                <th>تاريخ الطلب</th>
                                <th width="15%"></th>
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

    @cannot('عرض سنة مالية')
        <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            ليس لديك صلاحية يرجي مراجعة المسؤول
        </div>
    @endcannot

			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')<script>
        $(function() {
            let mTable = $('#users-table').DataTable({
                dom: 'Bfrtip',
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                order: [ [6, 'desc'] ],
                buttons: [
                    {'extend':'excel','text':'أكسيل'},
                    {'extend':'print','text':'طباعة'},
                    {'extend':'pdf','text':'pdf','exportOptions': {'orthogonal': "PDF"},customize: function ( doc ) {processDoc(doc); //fun in app.js
                    }},
                    {'extend':'pageLength','text':'حجم العرض'},
                ],

                 columnDefs: [{
                        targets: '_all',
                        render: function(data, type, row) {
                            if (type === 'PDF') {
                                return String(data).split(' ').reverse().join('  ');
                            }  return data;} }
                   ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/Money',
                    data: function (d) {
                        d.searchMoney = $('#users-table_filter input[type=search]').val();
                        /*d.activeId = $('select[name=active_h]').val();*/
                    }
                },
                fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if ( aData['active'] == "1" )
                    {
                        $('td', nRow).css('background-color', 'rgb(64, 188, 205)');
                        $('td', nRow).css('color', 'snow');
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'year', name: 'year' },
                    { data: 'start_year', name: 'start_year' },
                    { data: 'end_year', name: 'end_year' },
                    { data: 'money_goal', name: 'money_goal' },
                    { data: 'first_time_balance', name: 'first_time_balance' },
                    {"mRender": function ( data, type, row ) {
                            var cbAct = '<input onclick="fAct(this)" type="checkbox" value="'+row.id+'" id="'+row.id+'" name="cbActive" class="form-control">';
                            if(row.activeI==1){
                                cbAct = '<input onclick="fAct(this)" type="checkbox" value="'+row.id+'" id="'+row.id+'" name="cbActive" class="form-control" checked>';
                            }
                            return cbAct;
                        }
                    },
                    {"mRender": function ( data, type, row ) {
                            var cbWork = '<input onclick="fWork(this)" type="radio" value="'+row.id+'" id="'+row.id+'" name="cbWorked" class="form-control">';
                            if(row.basic_work==1){
                                cbWork = '<input onclick="fWork(this)" type="radio" value="'+row.id+'" id="'+row.id+'" name="cbWorked" class="form-control" checked="checked">';
                            }
                            return cbWork;
                        }
                        ,orderable: false},
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/Money/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Money/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Money/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض سنة مالية')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل سنة مالية')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف سنة مالية')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                        ,orderable: false}
                ]
            });/*
            $('#active_h').change(function() {
                mTable.draw();
            });*/
        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Money/active/" + id,
                complete: function (data) {
               if (data.status==200){
                         not7();
                    }
                    else{not8()}
                }
            })
        }
        //Basic Work function
        function fWork(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Money/work/" + id,
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
