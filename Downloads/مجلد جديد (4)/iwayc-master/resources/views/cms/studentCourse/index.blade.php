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
@can('اضافة تسجيل بالدورة')
<a class="btn btn-primary btn-md" href="{{ route('english.create') }}"><i class='fas fa-plus'style="margin-left: 10px">  إضافة اختبار مستوى جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض  تسجيل بالدورة')
<style>
    .scolor{
        color: #d43f3a !important;
    }
</style>

	<div class="card">
							<div class="card-body">
								<div class="tabs-menu ">
									<!-- Tabs -->
									<ul class="nav nav-tabs profile navtab-custom panel-tabs">
										<li >
											<a href="#home"class="active" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">الدورات المتاحة</span> </a>
										</li>

										<li class="">
											<a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span> <span class="hidden-xs">الدورات المسجلة</span> </a>
										</li><br><br>
									</ul>
								</div>
				<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
							<div class="tab-pane active" id="home">
										  <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                       <div class="collapse" id="collapseExample">
                    <div class="table-responsive ls-table">
                        <table class="col-md-6 table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    <select name="teacher_h" id="teacher_h" class="form-control">
                                        <option value=""> اختر اسم المعلم.... </option>
                                        @foreach($teachers as $teacher)
                                        <option {{old("teacher_h")==$teacher->id?"selected":""}} value="{{$teacher->id}}"> {{$teacher->name}} </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                </div>
                                    <div class="panel-body">
                                        <!--Table Wrapper Start-->
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-hover"  id="courses-table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>الاسم الدورة</th>
                                                        <th>مدة الدورة</th>
                                                        <th>اسم المعلم</th>
                                                        <th>الرسوم</th>
                                                        <th>عدد المسجلين</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>

<div class="tab-pane" id="settings">
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
                                        <select name="student_h" id="student_h" class="form-control">
                                            <option value=""> اختر اسم الطالب.... </option>
                                        @foreach($students as $st)
                                            <option {{old("student_h")==$st?"selected":""}} value="{{$st->id}}"> {{$st->nameAR}} </option>
                                        @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="course_h" id="course_h" class="form-control">
                                            <option value=""> اختر اسم الدورة.... </option>
                                            @foreach($c as $co)
                                            <option {{old("course_h")==$co?"selected":""}} value="{{$co}}"> {{\App\Models\Course::find($co)->courseAR}} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="status_h" id="status_h" class="form-control">
                                            <option value=""> اختر الحالة.... </option>
                                            <option {{old("status_h")=='0'?"selected":""}} value="0"> مسجل </option>
                                            <option {{old("status_h")=='1'?"selected":""}} value="1"> منسحب </option>
                                            <option {{old("status_h")=='2'?"selected":""}} value="2"> محذوف </option>
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

                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">

                                    <div class="panel-body">
                                        <!--Table Wrapper Start-->
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-hover"  id="student-courses-table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>اسم الطالب</th>
                                                        <th>اسم الدورة</th>
                                                        <th>الرسوم</th>
                                                        <th>المبلغ المدفوع</th>
                                                        <th>السنة الدراسية</th>
                                                        <th>تاريخ التسجيل</th>
                                                        <th>الحالة</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan

                            @cannot('عرض  تسجيل بالدورة')
                                <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    ليس لديك صلاحية يرجي مراجعة المسؤول
                                </div>
                            @endcannot
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
</div>


<br>






			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    <script>
        $(function() {
            var cTable = $('#courses-table').DataTable({
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
                    url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/CourseReg',
                    data: function (d) {
                        d.searchCourse = $('#courses-table_filter input[type=search]').val();
                        d.teacherId = $('select[name=teacher_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id',orderable: true },
                    { data: 'courseAR', name: 'courseAR',orderable: true },
                    { data: 'course_time', name: 'course_time',orderable: true },
                    { data: 'teacher_id', name: 'teacher_id',orderable: true },
                    { data: 'total_fees', name: 'total_fees',orderable: true },
                    { data: 'total_reg_student', name: 'total_reg_student',orderable: true },
                    {"mRender": function ( data, type, row ) {
                            var add ='<a class="btn btn-sm btn-success" href="/CMS/add/StudentCourse/'+row.id+'">تسجيل</a>';
                            var ress ='';
                            @can('اضافة  تسجيل بالدورة')
                                ress=ress+' '+add;
                            @endcan
                            return ress;}
                        ,orderable: false}
                ]
            });
            //filtering
            $('#teacher_h').change(function() {
                cTable.draw();
            });
            $('#money_id').change(function() {
                cTable.draw();
            });
        });
        $(function() {
            var sTable = $('#student-courses-table').DataTable({
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
                    url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/StudentCourse',
                    data: function (d) {
                        d.searchStudent = $('#student-courses-table_filter input[type=search]').val();
                        d.courseId = $('select[name=course_h]').val();
                        d.studentId = $('select[name=student_h]').val();
                        d.statusId = $('select[name=status_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id',orderable: true },
                    { data: 'nameAR', name: 'nameAR',orderable: true },
                    { data: 'courseAR', name: 'courseAR',orderable: true },
                    { data: 'price', name: 'price',orderable: true },
                    { data: 'pay', name: 'pay',orderable: true },
                    { data: 'm_year', name: 'm_year',orderable: true },
                    { data: 'created_at', name: 'created_at',orderable: true },
                    { data: 'status', name: 'status',orderable: true },
                    {"mRender": function ( data, type, row ) {
                            var withdraw = '<a class="btn btn-sm btn-danger" href="/CMS/add/Withdrawal/'+row.id+'">انسحاب</a>';
                            var receipt = '<a disabled class="btn btn-sm btn-danger disabled" href="/CMS/add/ReceiptStudent/'+row.id+'">صرف</a>';
                            var deleted = '<a class="btn btn-sm btn-danger Confirm" href="/CMS/delete/StudentCourse/'+row.id+'">حذف</a>';
                            var edit = '<a class="btn btn-sm btn-danger" href="/CMS/StudentCourse/'+row.id+'/edit">تعديل</a>';
                            if(row.status=="منسحب"){
                                withdraw = '<a disabled class="btn btn-sm btn-danger disabled" href="/CMS/add/Withdrawal/'+row.id+'">انسحاب</a>';
                                deleted = '<a disabled class="btn btn-sm btn-danger Confirm disabled" href="/CMS/delete/StudentCourse/'+row.id+'">حذف</a>';
                                edit = '<a disabled class="btn btn-sm btn-danger disabled" href="/CMS/StudentCourse/'+row.id+'/edit">تعديل</a>';
                            }
                            if(row.pay==0){
                                withdraw = '<a disabled class="btn btn-sm btn-danger disabled" href="/CMS/add/Withdrawal/'+row.id+'">انسحاب</a>';
                            }
                            if(row.refund>0){
                                receipt = '<a class="btn btn-sm btn-danger" href="/CMS/add/ReceiptStudent/'+row.id+'">صرف</a>';
                            }
                            if(row.done==1){
                                receipt = '<a disabled class="btn btn-sm btn-danger disabled" href="/CMS/add/ReceiptStudent/'+row.id+'">صرف</a>';
                                /*deleted = '<a class="btn btn-sm btn-danger Confirm" href="/CMS/delete/StudentCourse/'+row.id+'">حذف</a>';*/
                                edit = '<a disabled class="btn btn-sm btn-danger disabled" href="/CMS/StudentCourse/'+row.id+'/edit">تعديل</a>';
                            }
                            if(row.status=="محذوف"){
                                withdraw = '<a disabled class="btn btn-sm btn-danger disabled" href="/CMS/add/Withdrawal/'+row.id+'">انسحاب</a>';
                                deleted = '<a disabled class="btn btn-sm btn-danger Confirm disabled" href="/CMS/delete/StudentCourse/'+row.id+'">حذف</a>';
                                edit = '<a disabled class="btn btn-sm btn-danger disabled" href="/CMS/StudentCourse/'+row.id+'/edit">تعديل</a>';
                            }
                            var ress ='';
                            @can('اضافة انسحاب')
                                ress=ress+' '+withdraw;
                            @endcan
                            @can('اضافة صرف مخالصة')
                                ress=ress+' '+receipt;
                            @endcan
                            @can('تعديل  تسجيل بالدورة')
                                ress=ress+' '+edit;
                            @endcan
                            @can('حذف  تسجيل بالدورة')
                                ress=ress+' '+deleted;
                            @endcan
                            return ress;}
                        ,orderable: false}
                ]
            });

            //filtering
            $('#student_h').change(function(e) {
                sTable.draw();
            });
            $('#course_h').change(function(e) {
                sTable.draw();
            });
            $('#status_h').change(function(e) {
                sTable.draw();
            });
            $('#money_id').change(function() {
                sTable.draw();
            });
        });
    </script>
@endsection
