@extends('layouts.master')
@section('css')


@section('title')
 Iwayc System

@endsection

@section('title-page-header')
{{ $title }}
@endsection
@section('page-header')
{{ $parentTitle }}

@endsection
@section('button1')
<a class="btn btn-primary btn-md" href="/CMS/Course">الدورات الدراسيه</a>
@endsection
@section('button2')

@stop
@endsection
@section('content')


   <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">

                    <div class="row">
                        <div class="col">
                            <select name="course_id_h" id="course_id_h" class="form-control">
                                <option value=""> اختر اسم الدورة.... </option>
                                @foreach($courses as $course)
                                    <option {{old("course_id_h")==$course->id?"selected":""}} value="{{$course->id}}">{{$course->name}} - {{$course->courseAR}} </option>
                                @endforeach
                            </select>
                         </div>
                            <div class="col">
                         <div class="control-label">اسم المعلم: <strong id="teacherName"></strong></div>
                         </div>
                           <div class="col">
                          <div class="control-label">اسم الدورة: <strong id="teacherCourse"></strong></div>
                         </div>
                        </div>


                    </div>


                    <div class="row ls_divider">

                        <div class="col-md-3 control-label">عدد المسجلين: <span class="tag"><strong id="courseReg"></strong></span> طالب</div>
                        <div class="col-md-3 control-label">بداية الدورة: <span class="tag"><strong id="courseStart"></strong></span></div>
                        <div class="col-md-3 control-label">نوع نسبة المعلم: <span class="tag"><strong style="color:red;" id="teacherRatio"></strong></span></div>
                        <div class="col-md-3 control-label"> الرسوم مع المعلم:<span class="tag"><strong id="agreed_teacher_fees"></strong></span> دينار</div>
                    </div><br>

              <div id="ttt"> </div>

                    <div class="row ls_divider">
                        <div class="col-md-4 control-label"><span id="teacher_fees_title">
                        مجموع نصيب المعلم:<span class="tag"><strong id="teacher_fees"></strong></span> دينار</div>
                        <div class="col-md-4 control-label" style="font-weight: bold;"> مقبوضات المعلم : <span class="tag"><strong id="teacher_catch"></strong></span> دينار</div>

                        <div class="col-md-4 control-label" style="font-weight: bold;">باقي نصيب المعلم:<span class="tag"><strong id="teacher_remain"></strong></span> دينار</div>

                    </div><br>


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
                                <th>اسم الطالب</th>
                                <!--<th>رسوم الطالب عند التسجيل</th>-->
                                <!--<th>فرق الرسوم</th>-->
                                <!--<th>مجموع مدفوعات الطالب </th>-->
                                <th class="pay_filter">المدفوع</th>
                                <!--<th>المتبقى</th>-->
                                <th class="per_filter">نصيب المعلم من التحصيل</th>
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
        $('#course_id_h').change(function(){
            var id=$(this).val();
            $.ajax({
                url: "/CMS/course/StudentCourseRep/" + id,
                success: function (data) {
                    if (data.status==1){
                        $('#teacherCourse').replaceWith('<strong id="teacherCourse">'+data.courseName+'</strong>');
                        $('#teacherName').replaceWith('<strong id="teacherName">'+data.teacherName+'</strong>');
                        $('#courseReg').replaceWith('<strong id="courseReg">'+data.courseReg+'</strong>');

                        $('#courseStart').replaceWith('<strong id="courseStart">'+data.courseStart+'</strong>');


                        $('#teacherRatio').replaceWith('<strong style="color:red;" id="teacherRatio">'+data.teacherRatio+'</strong>');

                        $('#teacher_fees').replaceWith('<strong id="teacher_fees">'+data.teacher_fees+'</strong>');

                        $('#teacher_catch').replaceWith('<strong id="teacher_catch">'+data.teacher_catch+'</strong>');
                        $('#teacher_remain').replaceWith('<strong id="teacher_remain">'+data.teacher_remain+'</strong>');
                if (data.ratio==29){
                    $('#agreed_teacher_fees').replaceWith('<strong id="agreed_teacher_fees">'+data.agreed_teacher_fees+'</strong>');
                            $('#ttt').replaceWith('<div id="ttt" class="row ls_divider">' +
                                '<div class="col-md-4 control-label">نسبة المعلم: '+data.percentage+'%</div></div><br>');
                        }else{
                            $('#agreed_teacher_fees').replaceWith('<strong id="agreed_teacher_fees">'+data.value_sum+'</strong>');
                            $('#ttt').removeClass("row ls_divider");
                            $('#ttt').html('');
                        }


                    }
                    else{alert('حدث خطأ اثناء تنفيذ العملية');}
                }

            })
        });
        $(function() {
            var cTable = $('#users-table').DataTable({
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
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                drawCallback: function () {

                var json = cTable.ajax.json();

                },
                ajax: {
                    url: '/CMS/datatables/TeacherC',
                    data: function (d) {
                        d.searchStudent = $('#users-table_filter input[type=search]').val();
                        d.courseId = $('#course_id_h').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'nameAR', name: 'nameAR' },
                    { data: 'payCatched', name: 'pay' },
                    { data: 'per', name: 'per' },
                    { data: 'stat', name: 'stat' }
                ]
            });

            //filtering
            $('#course_id_h').change(function() {
                cTable.draw();
            });
            $('#money_id').change(function() {
                cTable.draw();
            });

        });
    </script>

@endsection
