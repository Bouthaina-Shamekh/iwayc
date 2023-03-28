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
@can('اضافة اذن طالب')
<a class="btn btn-primary btn-md" href="{{ route('AbsenceS.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه اذن جديد لطالب</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض اذن طالب')

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
                                        <select name="student_h" id="student_h" class="form-control">
                                            <option value=""> اختر اسم الطالب.... </option>
                                            @foreach($students as $student)
                                                <option {{old("student_h")==$student->id?"selected":""}} value="{{$student->id}}"> {{$student->nameAR}} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="course_h" id="course_h" class="form-control">
                                            <option value=""> اختر اسم الطالب اولا.... </option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="type_h" id="type_h" class="form-control">
                                            <option value=""> اختر النوع.... </option>
                                            <option {{old("type_h")=="0"?"selected":""}} value="0"> غياب </option>
                                            <option {{old("type_h")=="1"?"selected":""}} value="1"> تأخير </option>
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
                                            <th>التاريخ</th>
                                            <th>اسم الطالب</th>
                                            <th>اسم الدورة</th>
                                            <th>النوع</th>
                                            <th>دقائق التأخير</th>
                                            <th>اسم المستخدم</th>
                                            <th>التاريخ والوقت للادخال</th>
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

                @cannot('عرض اذن طالب')
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
            var abTable = $('#users-table').DataTable({
                dom: 'Bfrtip',
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                order:[[0,'desc']],
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
                    url: '/CMS/datatables/AbsenceS',
                    data: function (d) {
                        d.searchAbsence = $('#users-table_filter input[type=search]').val();
                        d.studentId = $('select[name=student_h]').val();
                        d.courseId = $('select[name=course_h]').val();
                        d.typeId = $('select[name=type_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'date', name: 'date' },
                    { data: 'student_id', name: 'student_id' },
                    { data: 'course_id', name: 'course_id' },
                    { data: 'type', name: 'type' },
                    { data: 'delay_time', name: 'delay_time' },
                    { data: 'created_by', name: 'created_by' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/AbsenceS/'+row.id+'">عرض</a>'
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/AbsenceS/'+row.id+'/edit">تعديل</a>'
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/AbsenceS/'+row.id+'">حذف</a>'
                            var ress ='';
                            @can('عرض اذن طالب')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل اذن طالب')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف اذن طالب')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                        ,orderable: false}
                ]
            });
            //filtering
            $('#student_h').change(function() {
                abTable.draw();
            });
            $('#course_h').change(function() {
                abTable.draw();
            });
            $('#type_h').change(function() {
                abTable.draw();
            });
            $('#money_id').change(function() {
                abTable.draw();
            });
        });
        $('#student_h').change(function(){
            var id=$(this).val();
            $.get("/CMS/SCourse/" + id,
                function(data) {
                    var model = $('#course_h');
                    model.empty();

                    model.append("<option value=''>اختر اسم الدورة ....</option>");

                    $.each(data, function(index, element) {
                        model.append("<option value='"+ element.id +"'>" + element.courseAR + "</option>");
                    });
                });
        });
    </script>
@endsection
