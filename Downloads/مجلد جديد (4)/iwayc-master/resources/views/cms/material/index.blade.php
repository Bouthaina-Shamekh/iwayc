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
<div class="mt-2">
@can('اضافة صنف')
<a class="btn btn-primary btn-md" href="{{ route('Material.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة صنف جديد</a>
@endcan<a href="/CMS/Quantity" class="btn btn-warning">سجل الكميات المضافة </a></div>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض صنف')

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
                                    <select name="repository_h" id="repository_h" class="form-control">
                                        <option value=""> اختر اسم المستودع.... </option>
                                        @foreach($repositories as $repository)
                                            <option {{old("repository_h")==$repository->id?"selected":""}} value="{{$repository->id}}"> {{$repository->name}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="section_h" id="section_h" class="form-control">
                                        <option value=""> اختر المستودع اولا.... </option>
                                    </select>
                                </td>
                                <td>
                                    <select name="active_h" id="active_h" class="form-control">
                                        <option value=""> اختر الفعالية.... </option>
                                        <option {{old("active_h")=='1'?"selected":""}} value="1"> فعال </option>
                                        <option {{old("active_h")=='0'?"selected":""}} value="0"> غير فعال </option>
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
									<table id="users-table" class="table table-bordered table-striped table-hover">
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

    @cannot('عرض صنف')
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
            var mTable = $('#users-table').DataTable({
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
                    url: '/CMS/datatables/Material',
                    data: function (d) {
                        d.searchMaterial = $('#users-table_filter input[type=search]').val();
                        d.activeId = $('select[name=active_h]').val();
                        d.repositoryId = $('select[name=repository_h]').val();
                        d.sectionId = $('select[name=section_h]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'section', name: 'section' },
                    { data: 'repository_id', name: 'repository_id' },
                    { data: 'count_old', name: 'count_old' },
                    { data: 'count_new', name: 'count_new' },
                    { data: 'single_cost', name: 'single_cost' },
                    { data: 'single_pay', name: 'single_pay' },
                    {"mRender": function ( data, type, row ) {
                            var cbAct = '<input type="checkbox" value="0" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" />';
                            if(row.activeI==1){
                                cbAct = '<input type="checkbox" value="1" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" checked />';
                            }
                            return cbAct;
                        }
                        ,orderable: false},
                    { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/Material/'+row.id+'">عرض صنف</a>';
                            var add ='<a class="btn btn-sm btn-success" href="/CMS/Quantity/'+row.id+'/add">اضافة كميات</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Material/'+row.id+'/edit">تعديل صنف</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Material/'+row.id+'">حذف صنف</a>';
                            var ress ='';
                            @can('عرض صنف')
                                ress=ress+' '+show;
                            @endcan
                            @can('اضافة كميات')
                                ress=ress+' '+add;
                            @endcan
                                    @can('تعديل صنف')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف صنف')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                        ,orderable: false}
                ]
            });
            $('#active_h').change(function() {
                mTable.draw();
            });
            $('#repository_h').change(function() {
                mTable.draw();
            });
            $('#section_h').change(function() {
                mTable.draw();
            });
        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Material/active/" + id,
                complete: function (data) {
                 if (data.status==200){
                         not7();
                    }
                    else{not8()}
                }
            })
        }
        jQuery(document).ready(function($){
            $('#repository_h').change(function(){
                var id=$(this).val();
                $.get("/CMS/RSection/" + id,
                    function(data) {
                        var model = $('#section_h');
                        model.empty();
                        model.append("<option value=''>اختر اسم القسم.... </option>");

                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                        });
                    });
            });
        });
    </script>
@endsection
