@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->

<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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
<a class="btn btn-primary btn-md" href="{{ route('ReceiptCourse.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافة سند صرف جديد</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')

 @can('عرض صرف دورة')
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
                                {{-- <th>الصندوق الفرعي</th>
                                <th>تصنيف المصروف</th>--}}
                                <th>المعلم</th>
                                <th>الدورة</th>
                                <th>المبلغ</th>
                                <th>نصيب المعلم</th>
                                <th>تاريخ الطلب</th>
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

    @cannot('عرض صرف دورة')
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
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                ajax: '/CMS/datatables/ReceiptCourse',
                columns: [
                    { data: 'id', name: 'id' },
                   {{--  { data: 'box_id', name: 'box_id' },
                    { data: 'type', name: 'type' },--}}
                    { data: 'teacher', name: 'teacher' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'amount', name: 'amount' },
                    { data: 'teacher_ratio', name: 'teacher_ratio' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/ReceiptCourse/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/ReceiptCourse/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/ReceiptCourse/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض صرف دورة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل صرف دورة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف صرف دورة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ],
                 language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
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
    </script>
@endsection
