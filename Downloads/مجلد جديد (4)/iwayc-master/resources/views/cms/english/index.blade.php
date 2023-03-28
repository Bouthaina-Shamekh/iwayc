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
@can('اضافة فحص انجليزي')
<a class="btn btn-primary btn-md" href="{{ route('english.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافة فحص جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض فحص انجليزي')

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
                        <table class="col-md-6 table table-bordered table-striped table-hover">
                            <tbody>
                            <tr>
                                <td>
                                    <select name="class_h" id="class_h" class="form-control">
                                        <option value=""> اختر تصنيف الطالب.... </option>
                                        @foreach($classes as $class)
                                            <option {{old("class_h")==$class->id?"selected":""}} value="{{$class->id}}"> {{$class->title}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="level_h" id="level_h" class="form-control">
                                        <option value=""> اختر نتيجة الطالب.... </option>
                                        @foreach($levels as $level)
                                            <option {{old("level_h")==$level->id?"selected":""}} value="{{$level->id}}"> {{$level->title}} </option>
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
                            </tr>
                            </tbody>
                        </table>
                    </div>
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
								<div class="table-responsive">
									<table id="users-table" class="table key-buttons text-md-nowrap">

										<thead>
									       <tr>
                                            <th></th>
                                            <th>تاريخ فحص المستوى</th>
                                            <th>اسم الطالب</th>
                                            <th>رقم سند القبض</th>
                                            <th>مجموع العلامات</th>
                                            <th>النتيجة</th>
                                            <th>التصنيف</th>
                                            <th>الحالة</th>
                                            <th>تاريخ ووقت الادخال</th>
                                            <th>اسم المستخدم</th>
                                            <th width="10%"></th>
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

                @cannot('عرض فحص انجليزي')
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
                    url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/English',
                    data: function (d) {
                        d.searchEnglish = $('#users-table_filter input[type=search]').val();
                        d.classId = $('select[name=class_h]').val();
                        d.levelId = $('select[name=level_h]').val();
                        d.activeId = $('select[name=active_h]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'date', name: 'date' },
                    { data: 'student_name', name: 'student_name' },
                    { data: 'cash_rec_id', name: 'cash_rec_id' },
                    { data: 'total', name: 'total' },
                    { data: 'level_pass', name: 'level_pass' },
                    { data: 'classification', name: 'classification' },
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
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/english/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/english/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/English/'+row.id+'">حذف</a>';
                            var ress ='';

                                ress=ress+' '+show;


                                ress=ress+' '+edit;


                                ress=ress+' '+dele;

                            return ress;}
                    }
                ]
            });
            //filtering
            $('#class_h').change(function() {
                eTable.draw();
            });
            $('#level_h').change(function() {
                eTable.draw();
            });
            $('#active_h').change(function() {
                eTable.draw();
            });
        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/English/active/" + id,
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
