@extends('layouts.master')
@section('css')

<style>
 .modal{
    padding: 0 !important;
   }
.testdialog {
     max-width: 70% !important;

     padding: 0;
     margin: 0;
   }

.testcontent {
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
 @can('اضافة قبض دورة')
<a class="btn btn-primary btn-md" href="{{ route('CatchReceipt.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة سند قبض جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
  @can('عرض قبض دورة')
<div class="modal fade" id="favoritesModal"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog testdialog" role="document">
    <div class="modal-content testcontent">
      <div class="modal-header">
         <h4 class="modal-title" id="favoritesModalLabel">إدارة سندات القبض والصرف</h4>
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
                                    <th>اسم الطالب</th>
                                    <th>اسم الدورة</th>
                                    <th>المبلغ</th>
                                    <th>التاريخ والوقت للادخال</th>
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



	    @endcan

    @cannot('عرض قبض دورة')
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
                ajax: '/CMS/datatables/CatchReceipt',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'id_comp', name: 'id_comp' },
                    { data: 'studentAR', name: 'studentAR' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning showModal" id="CMS/CatchReceipt/'+row.id+'"  onclick="showModal(this)">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/CatchReceipt/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/CatchReceipt/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض قبض دورة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل قبض دورة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف قبض دورة')
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
        function showModal(selectID) {

            var id = selectID.id;
            $.ajax({
            url: "{{url('/')}}" + "/" + id,
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
