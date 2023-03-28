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

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض انسحاب')


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
                                    <select name="student_3_h" id="student_3_h" class="form-control">
                                        <option value=""> اختر اسم الطالب.... </option>
                                        @foreach($students as $student)
                                            <option {{old("student_3_h")==$student->id?"selected":""}} value="{{$student->id}}"> {{$student->nameAR}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="course_3_h" id="course_3_h" class="form-control">
                                        <option value=""> اختر اسم الدورة.... </option>
                                        @foreach($courses as $course)
                                            <option {{old("course_3_h")==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->courseAR}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="teacher_3_h" id="teacher_3_h" class="form-control">
                                        <option value="">   اختر المعلم.... </option>
                                        @foreach($teachers as $student)
                                            <option {{old("teacher_3_h")==$student->id?"selected":""}} value="{{$student->id}}"> {{$student->name}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="user_3_h" id="user_3_h" class="form-control">
                                        <option value=""> اختر اسم المستخدم.... </option>
                                        @foreach($users as $user)
                                            <option {{old("user_3_h")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row ls_divider">
                        <div class="col-md-4 control-label">رسوم الدورات: <strong id="courseFee"></strong></div>
                        <div class="col-md-4 control-label">المدفوعات: <strong id="coursePay"></strong></div>
                        <div class="col-md-4 control-label">مرتجعات الطلاب: <strong id="courseRef"></strong></div>
                    </div>
                    <div class="row ls_divider">
                        <div class="col-md-4 control-label">اجور معلمين: <strong id="courseTea"></strong></div>
                        <div class="col-md-4 control-label">رصيد الانسحاب: <strong id="courseWit"></strong></div>
                        <div class="col-md-4 control-label">فرق رسوم الدورات: <strong id="courseMin"></strong></div>
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
								<div class="table-responsive ls-table">
						<table id="users-table" class="table table-bordered table-striped table-hover">
                   <thead>
                            <tr>
                                <th></th>
                                <th>اسم الطالب</th>
                                <th>الهواتف</th>
                                <th>اسم الدورة</th>
                               <th>اسم المعلم</th>
                                <th class="courseFee">رسوم الدورة</th>
                                <th class="coursePay">المبلغ المدفوع</th>
                                <th class="courseRef">المرتجع</th>
                                <th class="courseTea">اجور المعلم</th>
                                <th class="centerfees">نصيب المركز</th>
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

    @cannot('عرض انسحاب')
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
            var wTable = $('#users-table').DataTable({
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
                    url:'/CMS/datatables/Withdrawal',
                    data: function (d) {
                        d.searchWithdrawal = $('#users-table_filter input[type=search]').val();
                        d.moneyId = $('select[name=money_id]').val();
                        d.studentId = $('select[name=student_3_h]').val();
                        d.teacherId = $('select[name=teacher_3_h]').val();
                        d.courseId = $('select[name=course_3_h]').val();
                        d.userId = $('select[name=user_3_h]').val();
                    }
                },
                drawCallback: function () {
                    // var courseFee = this.api().column('.courseFee').data().sum();
                    // var coursePay = this.api().column('.coursePay').data().sum();
                    // var courseRef = this.api().column('.courseRef').data().sum();
                    // var courseTea = this.api().column('.courseTea').data().sum();
                    // var courseWit = coursePay - (courseRef + courseTea);
                    // var courseMin = courseFee - (courseWit + courseTea);
                    // $('#courseFee').replaceWith('<strong id="courseFee">'+courseFee+'</strong>')
                    // $('#coursePay').replaceWith('<strong id="coursePay">'+coursePay+'</strong>')
                    // $('#courseRef').replaceWith('<strong id="courseRef">'+courseRef+'</strong>')
                    // $('#courseTea').replaceWith('<strong id="courseTea">'+courseTea+'</strong>')
                    // $('#courseWit').replaceWith('<strong id="courseWit">'+courseWit+'</strong>')
                    // $('#courseMin').replaceWith('<strong id="courseMin">'+courseMin+'</strong>')
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'student_id', name: 'student_id' },
                    { data: 'phone', name: 'phone' },
                    { data: 'course_id', name: 'course_id' },
                    { data: 'teacher_name', name: 'teacher_name' },
                    { data: 'price', name: 'price' },
                    { data: 'payment', name: 'payment' },
                    { data: 'refund', name: 'refund' },
                    { data: 'teacher_fees', name: 'teacher_fees' },
                    { data: 'center_fees', name: 'center_fees' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/Withdrawal/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Withdrawal/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Withdrawal/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض انسحاب')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل انسحاب')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف انسحاب')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            $('#student_3_h').change(function() {
                wTable.draw();
            });
            $('#course_3_h').change(function() {
                wTable.draw();
            });
            $('#teacher_3_h').change(function() {
                wTable.draw();
            });
            $('#user_3_h').change(function() {
                wTable.draw();
            });
            $('#money_id').change(function() {
                wTable.draw();
            });
            wTable.on( 'xhr', function () {
                var json = wTable.ajax.json();
                $("#courseFee").replaceWith('<Strong id="courseFee">'+json.courseFee+'</Strong>');
                $("#coursePay").replaceWith('<Strong id="coursePay">'+json.coursePay+'</Strong>');
                $("#courseRef").replaceWith('<Strong id="courseRef">'+json.courseRef+'</Strong>');
                $("#courseTea").replaceWith('<Strong id="courseTea">'+json.courseTea+'</Strong>');
                $("#courseWit").replaceWith('<Strong id="courseWit">'+json.courseWit+'</Strong>');
                $("#courseMin").replaceWith('<Strong id="courseMin">'+json.courseMin+'</Strong>');

            });
        });
    </script>
@endsection
