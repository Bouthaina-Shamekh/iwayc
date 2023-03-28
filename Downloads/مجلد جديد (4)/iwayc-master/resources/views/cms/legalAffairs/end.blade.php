@extends('layouts.master')
@section('css')
<style>
.spantag .tag{
    font-size:15px !important;
}
.modal{
    padding: 0 !important;
   }
  .modaldialog {
     max-width: 70% !important;

     padding: 0;
     margin: 0;
   }

   .modalcontent {
     border-radius: 0 !important;

     max-width: 100% !important;

   }
    .modaldialog2 {
     max-width: 50% !important;
     padding: 0;
     margin: 0;
   }

   .modalcontent2 {
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
<a class="btn btn-primary btn-md" href="/CMS/LegalAffairs">الشؤون القانونية</a>
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
                                <th>اسم الطالب</th>
                                <th>اسم الدورة</th>
                                <th>الهواتف</th>
                                <th>السنة المالية</th>
                                <th>الرسوم</th>
                                <th>المستحق</th>
                                <th>اول مطالبة</th>
                                <th>غرامة التأخير</th>
                                <th>المبلغ الكلي</th>
                                <th>مرات المطالبة</th>
                                <th>مرات التحذير</th>
                                <th>**</th>
                                <th>تاريخ الحذف</th>
                                <th>اسم المستخدم</th>
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
                    url: '/CMS/datatables/end/LegalAffairs',
                    data: function (d) {
                        d.searchLegalAffairs = $('#users-table_filter input[type=search]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'nameAR', name: 'nameAR' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'phone', name: 'phone' },
                    { data: 'm_year', name: 'm_year' },
                    { data: 'fees', name: 'fees' },
                    { data: 'fees_owed', name: 'fees_owed' },
                    { data: 'first_claim', name: 'first_claim' },
                    { data: 'fine_delay', name: 'fine_delay' },
                    { data: 'total_amount', name: 'total_amount' },
                    { data: 'count', name: 'count' },
                    { data: 'count_warning', name: 'count_warning' },
                    { data: 'status', name: 'status' },
                    { data: 'deleted_at', name: 'deleted_at' },
                    { data: 'deleted_by', name: 'deleted_by' },
                ]
            });
            //filtering
            $('#money_id').change(function() {
                cTable.draw();
            });
        });
    </script>
@endsection
