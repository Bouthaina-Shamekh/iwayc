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
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')


   <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">

                    <div class="row">
                        <div class="col">
                                <select name="teacher_h" id="teacher_h" class="form-control">
                                    <option value=""> اختر اسم المعلم.... </option>
                                    @foreach($teachers as $teacher)
                                    <option {{old("teacher_h")==$teacher->id?"selected":""}} value="{{$teacher->id}}"> {{$teacher->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col">
                                <select name="course_h" id="course_h" class="form-control">
                                    <option value=""> اختر اسم الدورة.... </option>
                                    @foreach($courses as $course)
                                        <option {{old("course_h")==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->courseAR}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div><br>



                     <div class="row ls_divider">
                        <div class="col-md-3 control-label">اسم الدورة: <span class="tag"><strong id="courseName"></strong></span></div>
                        <div class="col-md-2 control-label">عدد المسجلين: <span class="tag"><strong id="courseReg"></strong></span> طالب</div>
                        <div class="col-md-2 control-label">عدد المنسحبين: <span class="tag"><strong id="courseWith"></strong></span> طالب</div>
                        <div class="col-md-3 control-label">مرتجع الانسحابات: <span class="tag"><strong id="refunds"></strong></span> دينار</div>
                        <div class="col-md-2 control-label">بداية الدورة: <span class="tag"><strong id="courseStart"></strong></span></div>
                    </div><br>
                    <div class="row ls_divider">
                        <div class="col-md-3 control-label">رسوم التسجيل: <span class="tag"><strong id="regFees"></strong></span> دينار</div>
                        <div class="col-md-3 control-label">رسوم المقررات: <span class="tag"><strong id="docsFees"></strong></span> دينار</div>
                        <div class="col-md-3 control-label">رسوم الدورة: <span class="tag"><strong id="courseFees"></strong></span> دينار</div>
                        <div class="col-md-3 control-label">الرسوم النهائية : <span class="tag"><strong id="totalFees"></strong></span> دينار</div>
                    </div><br>

                    <div class="row ls_divider">
                        <div class="col-md-4 control-label">اسم المعلم: <span class="tag"><strong id="teacherName"></strong></span></div>
                        <div class="col-md-4 control-label">هواتف المعلم: <span class="tag"><strong id="teacherPhone"></strong></span></div>
                        <div class="col-md-4 control-label">نوع نسبة المعلم: <span class="tag"><strong style="color:red;" id="teacherRatio"></strong></span></div>
                    </div><br>
                    <div id="tt"></div>
                    <div class="row ls_divider">
                        <div class="col-md-3 control-label">الرسوم الكلى: <span class="tag"><strong id="stotal_fees"></strong></span> دينار</div>
                        <div class="col-md-3 control-label"> مدفوعات الطلاب: <span class="tag"><strong id="spayed"></strong></span> دينار</div>

                        <div class="col-md-3 control-label">ذمم الطلاب: <span class="tag"><strong id="sremain"></strong></span> دينار</div>
                        <div class="col-md-3 control-label">نصيب المركز من التحصيل: <span class="tag"><strong id="center_fees"></strong></span> دينار</div>

                    </div><br>
                    <div class="row ls_divider">
                        <div class="col-md-4 control-label"><span id="teacher_fees_title">
                             نصيب المعلم من التحصيل:
                            </span> <span class="tag"><strong id="teacher_fees"></strong></span> دينار</div>
                        <div class="col-md-4 control-label" style="font-weight: bold;"> مقبوضات المعلم : <span class="tag"><strong id="teacher_catch"></strong></span> دينار</div>

                        <div class="col-md-4 control-label" style="font-weight: bold;">باقى مستحقات المعلم من التحصيل : <span class="tag"><strong id="teacher_remain"></strong></span> دينار</div>

                    </div><br>
                    <div class="row ls_divider">

                        <div class="col-md-4 control-label" style="font-weight: bold;"> نصيب المركز فى حالة التحصيل التام : <span class="tag"><strong id="all_center_fees"></strong></span> دينار</div>

                        <div class="col-md-4 control-label" style="font-weight: bold;"><span id="all_teacher_fees_title">
                            نصيب المعلم فى حالة التحصيل التام:
                            </span><span class="tag"><strong id="all_teacher_fees"></strong></span> دينار</div>

                    </div><br>

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
									<table id="student-courses-table" class="table table-bordered table-striped table-hover">

                             <thead>
                                    <tr>
                                        <th></th>
                                        <th>اسم الطالب</th>
                                        <th>الهواتف المتوفرة</th>
                                        <th>الرسوم</th>
                                        <th>المدفوع</th>
                                        <th>المتبقي</th>
                                        <th>نصيب المعلم</th>
                                        <th>نصيب المركز</th>
                                        <th>الحالة</th>
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
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    <script>
        $(function() {
            var sTable = $('#student-courses-table').DataTable({
                dom: 'Bfrtip',
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
                    url: '/CMS/datatables/StudentCourseRep',
                    data: function (d) {
                        d.searchStudent = $('#student-courses-table_filter input[type=search]').val();
                       d.courseId = $('select[name=course_h]').val();
                        d.teacherId = $('select[name=teacher_h]').val();
                        d.yearId = $('select[name=year_h]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id',orderable: true },
                    { data: 'nameAR', name: 'nameAR',orderable: true },
                    { data: 'phone', name: 'phone',orderable: true },
                    { data: 'price', name: 'price',orderable: true },
                    { data: 'rem', name: 'rem',orderable: true },
                    { data: 'payment', name: 'payment',orderable: true },
                    { data: 'per', name: 'per',orderable: true },
                    { data: 'center', name: 'center',orderable: true },
                    { data: 'stat', name: 'stat',orderable: true }
                ]
            });

            //filtering
           $('#course_h').change(function() {
                sTable.draw();
            });
            $('#teacher_h').change(function() {
                sTable.draw();
            });
            $('#year_h').change(function() {
                sTable.draw();
            });
        });


            $('#teacher_h').change(function(){
                var id = $('select[name=teacher_h]').val();
                $.get("/CMS/TCourse/" + id,
                     function(data) {
                    var model = $('#course_h');
                    model.empty();

                    model.append("<option value=''>اختر اسم الدورة ....</option>");

                    $.each(data, function(index, element) {
                        model.append("<option value='"+ element.id +"'>" + element.courseAR + "</option>");
                    });
                });
            });

        $('#course_h').change(function() {
            var id = $('select[name=course_h]').val();
            $.ajax({
                url: "/CMS/course/StudentCourseRep/" + id,
                success: function (data) {
                    if (data.status==1){
                        $('#courseName').replaceWith('<strong id="courseName">'+data.courseName+'</strong>');
                        $('#courseReg').replaceWith('<strong id="courseReg">'+data.courseReg+'</strong>');
                        $('#courseWith').replaceWith('<strong id="courseWith">'+data.courseWith+'</strong>');
                        $('#courseStart').replaceWith('<strong id="courseStart">'+data.courseStart+'</strong>');
                        $('#regFees').replaceWith('<strong id="regFees">'+data.regFees+'</strong>');
                        $('#docsFees').replaceWith('<strong id="docsFees">'+data.docsFees+'</strong>');
                        $('#courseFees').replaceWith('<strong id="courseFees">'+data.courseFees+'</strong>');
                        $('#totalFees').replaceWith('<strong id="totalFees">'+data.totalFees+'</strong>');
                        $('#totalSum').replaceWith('<strong id="totalSum">'+data.center_pp+'</strong>');
                        $('#receiptSum').replaceWith('<strong id="receiptSum">'+data.receiptSum+'</strong>');
                        $('#remaindSum').replaceWith('<strong id="remaindSum">'+data.remaindSum+'</strong>');
                        $('#teacherName').replaceWith('<strong id="teacherName">'+data.teacherName+'</strong>');
                        $('#teacherPhone').replaceWith('<strong id="teacherPhone">'+data.teacherPhone+'</strong>');
                        $('#teacherRatio').replaceWith('<strong style="color:red;" id="teacherRatio">'+data.teacherRatio+'</strong>');
                        $('#stotal_fees').replaceWith('<strong id="stotal_fees">'+data.stotal_fees+'</strong>');
                        $('#spayed').replaceWith('<strong id="spayed">'+data.spayed+'</strong>');
                        $('#sremain').replaceWith('<strong id="sremain">'+data.sremain+'</strong>');
                        $('#center_fees').replaceWith('<strong id="center_fees">'+data.center_fees+'</strong>');
                        $('#teacher_fees').replaceWith('<strong id="teacher_fees">'+data.teacher_fees+'</strong>');
                        $('#refunds').replaceWith('<strong id="refunds">'+data.refunds+'</strong>');
                        $('#teacher_catch').replaceWith('<strong id="teacher_catch">'+data.teacher_catch+'</strong>');
                        $('#teacher_remain').replaceWith('<strong id="teacher_remain">'+data.teacher_remain+'</strong>');
                        $('#all_teacher_fees').replaceWith('<strong id="all_teacher_fees">'+data.all_teacher_fees+'</strong>');
                        $('#all_center_fees').replaceWith('<strong id="all_center_fees">'+data.all_center_fees+'</strong>');



                        if (data.ratio==29){
                            $('#tt').replaceWith('<div id="tt" class="row ls_divider">' +
                                '<div class="col-md-4 control-label">نسبة المعلم: '+data.percentage+'%</div>' +
                                '<div class="col-md-8 control-label">الرسوم المتفق عليها مع المعلم : ('+data.agreed_teacher_fees+' دينار) من الدورات الدراسية</div>' +
                                '</div><br>');
                                $('#all_teacher_fees_title').replaceWith('<span id="all_teacher_fees_title">نصيب المعلم في حالة التحصيل التام</spa>')
                            $('#teacher_fees_title').replaceWith('<span id="teacher_fees_title">نصيب المعلم من التحصيل</span>');
                        }

                       if (data.ratio==18){
                            $('#tt').replaceWith(
                                '<div id="tt" class="row ls_divider">'+
                                '<div class="col-md-4 control-label">القيمة علي الطالب: ('+data.value_sum+' دينار)</div>' +
                                '</div>'
                            );
                            $('#teacher_fees_title').replaceWith('<span id="teacher_fees_title">نصيب المعلم الكلى</span>');
                            $('#all_teacher_fees_title').replaceWith('<span id="all_teacher_fees_title">نصيب المعلم في حالة التحصيل التام</span>')
                        }
                          if (data.ratio==15){
                            $('#tt').empty();
                            $('#all_teacher_fees_title').replaceWith('<span id="all_teacher_fees_title">نصيب المعلم الافتراضى عن كل طالب</span>');

                            $('#teacher_fees_title').replaceWith('<span id="teacher_fees_title">نصيب المعلم الثابت على الدورة</span>');
                        }
                    }
                    else{alert('حدث خطأ اثناء تنفيذ العملية');}
                }

            })
        });
    </script>

@endsection
