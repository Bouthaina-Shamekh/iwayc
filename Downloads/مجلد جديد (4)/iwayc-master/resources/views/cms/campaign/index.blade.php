@extends('layouts.master')
@section('css')
<style>
.modal{
    padding: 0 !important;
   }
   .modal-dialog {
     max-width: 70% !important;

     padding: 0;
     margin: 0;
   }

   .modal-content {
     border-radius: 0 !important;

     max-width: 100% !important;

   }
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
@can('اضافة حملة')
<a class="btn btn-primary btn-md" href="{{ route('Campaign.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة حملة جديدة</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض حملة')

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
                                <th>عنوان الحملة</th>
                                <th>تاريخ البداية</th>
                                <th>الحالة</th>
                                <th>تاريخ ووقت الطلب</th>
                                <th>اسم المستخدم</th>
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
<div class="modal fade" id="favoritesModal"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title"id="favoritesModalLabel">إدارة الحملات</h4>
        <button type="button" class="close"data-dismiss="modal"aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button"
           class="btn btn-default"
           data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
    @cannot('عرض حملة')
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
            var cTable = $('#users-table').DataTable({
                dom: 'Bfrtip',
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
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
                    url: '/CMS/datatables/Campaign',
                    data: function (d) {
                        d.searchCampaign = $('#users-table_filter input[type=search]').val();
                        /*d.teacherId = $('select[name=teacher_h]').val();
                        d.activeId = $('select[name=active_h]').val();
                        d.moneyId = $('select[name=money_id]').val();*/
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'start', name: 'start' },
                    {"mRender": function ( data, type, row ) {
                            var cbAct = '<input type="checkbox" value="0" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" />';
                            if(row.activeI==1){
                                cbAct = '<input type="checkbox" value="1" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" checked />';
                            }
                            return cbAct;
                        }
                        ,orderable: false},
                    { data: 'created_at', name: 'created_at' },
                    { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                            var rrr ='<a class="btn btn-sm btn-primary" href="/CMS/getAll/CampaignStudent/'+row.id+'"><i class="fa fa-search"></i></a>';
                            var show ='<a class="btn btn-sm btn-success showModal" id="'+row.id+'" onclick="showModal(this)">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Campaign/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Campaign/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض متابعة حملة')
                                ress=ress+' '+rrr;
                            @endcan
                            @can('عرض حملة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل حملة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف حملة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });

        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Campaign/active/" + id,
                complete: function (data) {
                      if (data.status==200){
                         not7();
                    }
                    else{not8()}
                }
            })
        }

        function showModal(selectID) {

            var id = selectID.id;
            console.log("hh"+id);
            $.ajax({
            url: "{{url('/CMS/Campaign/')}}" + "/" + id,
            type: "GET",
            success: function (data) {

                $(".modal-body").html(data.html);
                $('#favoritesModal').modal();
            },
            error: function () {
                alert("Error, Unable to bring up the creation dialog.");
            }
        })


        }


    </script>
@endsection
