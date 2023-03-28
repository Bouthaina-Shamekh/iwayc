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
 @can('اضافة صرف مستودع')
<a class="btn btn-primary btn-md" href="{{ route('RepositoryOut.create') }}"><i class='fas fa-plus'style="margin-left: 10px">صرف مستودع جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض صرف مستودع')

 <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="">
                    <h3 class="panel-title">
                    <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-success" data-toggle="collapse" href="#collapseExample" role="button">قائمة الفرز والفلترة</a>
                    </h3>
                </div>
                <div class="collapse" id="collapseExample">
                    <div class="table-responsive ls-table">
                     <table class="col-md-10 table table-bordered table-striped table-hover">
                            <tbody>
                            <tr>
                                <td>
                                    <select name="repository_s" id="repository_s" class="form-control">
                                        <option value=""> اختر اسم المستودع.... </option>
                                        @foreach($repositories as $repository)
                                            <option {{old("repository_s")==$repository->id?"selected":""}} value="{{$repository->id}}"> {{$repository->name}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="user_h" id="user_h" class="form-control">
                                        <option value=""> اختر اسم المستخدم.... </option>
                                        @foreach($users as $user)
                                            <option {{old("user_h")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <table class="table table-bordered table-striped table-hover">
                            <h5><strong>فرز بحسب تاريخ الطلب : </strong></h5>
                            <tbody>
                            <tr>
                                <td>
                                    <input onchange="$('#to_h').val(this.value);document.getElementById('to_h').min=this.value;"
                                           type="text" value="{{old("from_h")}}"
                                           class="form-control text-input fc-datepicker" id="from_h" name="from_h" placeholder="من....">
                                </td>
                                <td>
                                    <input type="text" value="{{old("to_h")}}"
                                           class="form-control text-input fc-datepicker" id="to_h" name="to_h" placeholder="الي....">
                                </td>
                                <td>
                                    <a class="btn btn-primary" id="search_h" name="search_h">بحث</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <h3 class="panel-title text-left">المجموع: (<Strong id="total_filter"></Strong> دينار)</h3>
    <br>
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
                                <th>رقم ورقي</th>
                                <th>اسم المستودع</th>
                                <th>الاسم</th>
                                <th>البيان</th>
                                <th class="total_filter">المبلغ</th>
                                <th>اسم المستخدم</th>
                                <th>تاريخ ووقت الادخال</th>
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

    @cannot('عرض صرف مستودع')
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
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
                drawCallback: function () {
                    // var total_filter = this.api().column('.total_filter').data().sum();
                    // $('#total_filter').replaceWith('<strong id="total_filter">'+total_filter+'</strong>')
                },
                ajax: {
                    url: '/CMS/datatables/RepositoryOut',
                    data: function (d) {
                        d.searchRepositoryOut = $('#users-table_filter input[type=search]').val();
                        d.repositoryId = $('select[name=repository_s]').val();
                        d.userId = $('select[name=user_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                        d.fromId = $('#from_h').val();
                        d.toId = $('#to_h').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'id_comp', name: 'id_comp' },
                    { data: 'repository_id', name: 'repository_id' },
                    { data: 'customer', name: 'customer' },
                    { data: 'statement', name: 'statement' },
                    { data: 'total', name: 'total' },
                    { data: 'created_by', name: 'created_by' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/RepositoryOut/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/RepositoryOut/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/RepositoryOut/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض صرف مستودع')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل صرف مستودع')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف صرف مستودع')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
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
