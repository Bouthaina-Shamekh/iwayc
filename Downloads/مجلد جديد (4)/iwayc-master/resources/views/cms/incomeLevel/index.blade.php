@extends('layouts.master')
@section('css')
<style>
.modal{
    padding: 0 !important;
   }
   .modal-dialog {
     max-width: 60% !important;

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

<a class="btn btn-primary btn-md" href="{{ route('IncomeLevel.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه مستوى دخل جديد </a>

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')

<div class="modal fade" id="favoritesModal"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title"
        id="favoritesModalLabel">إدارة مستويات الدخل</h4>
        <button type="button" class="close"
          data-dismiss="modal"
          aria-label="Close">
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
                                                <th>اسم المستوى</th>
                                                <th>من</th>
                                                <th>الى</th>
                                                <th>الايام المتبقية</th>
                                                <th>المصاريف المتوقعة</th>
                                                <th>رصيد المستوى</th>
                                                <th>المستوى1</th>
                                                <th>المستوى2</th>
                                                <th>المستوى3</th>
                                                <th>المستوى4</th>
                                                <th>المستوى5</th>
                                                <th>الحالة</th>
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



				<!-- row closed -->

			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection

@section("js")
    <script>
        $(function() {
            var eTable = $('#users-table').DataTable({
                dom: 'Bfrtip',
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                searching: false,
                lengthChange: false,
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
                    url: '/CMS/datatables/IncomeLevel',
                      data: function (d) {

                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'in_from', name: 'in_from' },
                    { data: 'in_to', name: 'in_to' },
                    { data: 'remaind', name: 'remaind' },
                    { data: 'expenses', name: 'expenses' },
                    { data: 'balance', name: 'balance' },
                    { data: 'level1', name: 'level1' },
                    { data: 'level2', name: 'level2' },
                    { data: 'level3', name: 'level3' },
                    { data: 'level4', name: 'level4' },
                    { data: 'level5', name: 'level5' },

                    {"mRender": function ( data, type, row ) {
                            var cbWork = '<input onclick="fAct(this)" type="radio" value="'+row.id+'" id="'+row.id+'" name="cbWorked" class="form-control">';
                            if(row.activeI==1){
                                cbWork = '<input onclick="fAct(this)" type="radio" value="'+row.id+'" id="'+row.id+'" name="cbWorked" class="form-control" checked="checked">';
                            }
                            return cbWork;
                        }
                        ,orderable: false},
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning showModal" id="'+row.id+'" onclick="showModal(this)">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/IncomeLevel/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/IncomeLevel/'+row.id+'">حذف</a>';
                            var ress =show+' '+edit+' '+dele;
                            {{--@can('عرض موظف')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل موظف')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف موظف')
                                ress=ress+' '+dele;
                            @endcan--}}
                            return ress;}
                        ,orderable: false}
                ]
            });
            $('#money_id').change(function() {
                eTable.draw();
            });
        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/IncomeLevel/active/" + id,
                complete: function (data) {
                    if (data.status==200 ){
                        alert('تمت العملية بنجاح')
                    }
                    else{alert('حدث خطأ اثناء تنفيذ العملية')}
                }
            })
        }
        function showModal(selectID) {

            var id = selectID.id;
            $.ajax({
            url: "{{url('/CMS/IncomeLevel/')}}" + "/" + id,
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

