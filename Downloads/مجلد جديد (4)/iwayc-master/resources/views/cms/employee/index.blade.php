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
@can('اضافة موظف')
<a class="btn btn-primary btn-md" href="{{ route('Employee.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه موظف جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض موظف')

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
                                    <select name="job_h" id="job_h" class="form-control">
                                        <option value=""> اختر الوظيفة.... </option>
                                        @foreach($jobs as $job)
                                            <option {{old("job_h")==$job->id?"selected":""}} value="{{$job->id}}"> {{$job->title}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="address_h" id="address_h" class="form-control">
                                        <option value=""> اختر العنوان.... </option>
                                        @foreach($addresses as $address)
                                            <option {{old("address_h")==$address->id?"selected":""}} value="{{$address->id}}"> {{$address->title}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="nationality_h" id="nationality_h" class="form-control">
                                        <option value=""> اختر الجنسيه.... </option>
                                        @foreach($nationalitys as $nationality)
                                            <option {{old("nationality_h")==$nationality->id?"selected":""}} value="{{$nationality->id}}"> {{$nationality->title}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="active_h" id="active_h" class="form-control">
                                        <option value=""> اختر الفعالية.... </option>
                                        <option {{old("active_h")=='1'?"selected":""}} value="1"> فعال </option>
                                        <option {{old("active_h")=='0'?"selected":""}} value="0"> غير فعال </option>
                                    </select>
                                </td>

                                <td>
                                    <select name="status_h" id="status_h" class="form-control">
                                        <option value=""> اختر الحالة الاجتماعية .... </option>
                                        @foreach($statuses as $status)
                                            <option {{old("status_h")==$status->id?"selected":""}} value="{{$status->id}}"> {{$status->title}} </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select name="level_h" id="level_h" class="form-control">
                                        <option value=""> اختر المستوي التعليمي.... </option>
                                        @foreach($levels as $level)
                                            <option {{old("level_h")==$level->id?"selected":""}} value="{{$level->id}}"> {{$level->title}} </option>
                                        @endforeach
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
                                <th></th>
                                <th>الاسم</th>
                                <th>الوظيفة</th>
                                <th>تاريخ الطلب</th>
                                <th>العنوان</th>
                                <th>الجنسيه</th>
                                <th>سنة الميلاد</th>
                                <th>الهاتف</th>
                                <th>الحد الادنى للراتب</th>
                                <th>ملاحظات</th>
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
                @endcan

                @cannot('عرض موظف')
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
            var eTable = $('#users-table').DataTable({
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
                    url: '/CMS/datatables/Employee',
                    data: function (d) {
                        d.searchEmployee = $('#users-table_filter input[type=search]').val();
                        d.jobId = $('select[name=job_h]').val();
                        d.addressId = $('select[name=address_h]').val();
                        d.nationality_h = $('select[name=nationality_h]').val();
                        d.statusId = $('select[name=status_h]').val();
                        d.levelId = $('select[name=level_h]').val();
                        d.activeId = $('select[name=active_h]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'job', name: 'job' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'address', name: 'address' },
                    { data: 'nationality', name: 'nationality'},
                    { data: 'birthday', name: 'birthday' },
                    { data: 'phone1', name: 'phone1' },
                    { data: 'salary_down', name: 'salary_down' },
                    { data: 'notes', name: 'notes' },



                    {"mRender": function ( data, type, row ) {
                            var cbAct = '<input type="checkbox" value="0" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" />';
                            if(row.activeI==1){
                                cbAct = '<input type="checkbox" value="1" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" checked />';
                            }
                            return cbAct;
                        }
                        ,orderable: false},
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/Employee/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-primary" href="/CMS/Employee/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Employee/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض موظف')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل موظف')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف موظف')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                        ,orderable: false}
                ]
            });
            //filtering
            $('#job_h').change(function() {
                eTable.draw();
            });
            $('#address_h').change(function() {
                eTable.draw();
            });
              $('#nationality_h').change(function() {
                eTable.draw();

            $('#status_h').change(function() {
                tTable.draw();
            });
            $('#level_h').change(function() {
                sTable.draw();
            });

            });
            $('#active_h').change(function() {
                eTable.draw();
            });
        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Employee/active/" + id,
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
