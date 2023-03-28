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
<a class="btn btn-primary btn-md" href="{{ route('Material.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض كميات')

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
                    <table class="table table-bordered table-striped table-hover">
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
                                    <select name="section_s" id="section_s" class="form-control">
                                        <option value=""> اختر المستودع اولا.... </option>
                                    </select>
                                </td>
                                <td>
                                    <select name="material_s" id="material_s" class="form-control">
                                        <option value=""> اختر اسم القسم اولا.... </option>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br><br>



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
									<table id="users-table" class="table table-bordered table-striped table-hover"style="width: 100%;">
                            <thead>
                                    <thead>
                            <tr>
                                <th></th>
                                <th>الصنف</th>
                                <th>القسم</th>
                                <th>اسم المستودع</th>
                                <th>العدد الاولي</th>
                                <th>العدد المتوفر</th>
                                <th>التكلفة فردي</th>
                                <th>سعر البيع فردي</th>
                                <th>الحالة</th>
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



				<!-- row closed -->
     @endcan

    @cannot('عرض كميات')
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
            var qTable = $('#users-table').DataTable({
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
                ajax: {
                    url: '/CMS/datatables/Quantity',
                    data: function (d) {
                        d.searchQuantity = $('#users-table_filter input[type=search]').val();
                        d.materialId = $('select[name=material_s]').val();
                        d.repositoryId = $('select[name=repository_s]').val();
                        d.sectionId = $('select[name=section_s]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'material_id', name: 'material_id' },
                    { data: 'section', name: 'section' },
                    { data: 'repository_id', name: 'repository_id' },
                    { data: 'count_old', name: 'count_old' },
                    { data: 'count_new', name: 'count_new' },
                    { data: 'count', name: 'count' },
                    { data: 'single_cost', name: 'single_cost' },
                    { data: 'single_pay', name: 'single_pay' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Quantity/edit/'+row.id+'">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/Quantity/delete/'+row.id+'">حذف</a>';
                            var ress ='';
                                    @can('تعديل كميات')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف كميات')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                        ,orderable: false}
                ]
            });
            $('#material_s').change(function() {
                qTable.draw();
            });
            $('#repository_s').change(function() {
                qTable.draw();
            });
            $('#section_s').change(function() {
                qTable.draw();
            });
            $('#money_id').change(function() {
                qTable.draw();
            });
        });
        jQuery(document).ready(function($){
            $('#repository_s').change(function(){
                var id=$(this).val();
                $.get("/CMS/RSection/" + id,
                    function(data) {
                        var model = $('#section_s');
                        model.empty();
                        model.append("<option value=''>اختر اسم القسم.... </option>");

                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                        });
                    });
            });

            $('#section_s').change(function(){
                var id=$(this).val();
                $.get("/CMS/RepSection/" + id,
                    function(data) {
                        var model = $('#material_s');
                        model.empty();
                        model.append("<option value=''>اختر اسم الصنف.... </option>");

                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                        });
                    });
            });
        });
    </script>
@endsection
