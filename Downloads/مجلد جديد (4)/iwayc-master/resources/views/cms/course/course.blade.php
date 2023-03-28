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
<a class="btn btn-primary btn-md" href="{{ route('Course.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة دورة جديدة </a>
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
                            <label class=" control-label">العام:  </label>
                                <select name="year_h" id="year_h" class="form-control">
                                    <option value=""> اختر العام.... </option>
                                    @foreach($years as $year)
                                        <option {{old("year_h")==$year->m_year?"selected":""}} value="{{$year->m_year}}"> {{$year->m_year}}</option>
                                    @endforeach
                                </select>

                         </div>
                          <div class="col">
                             <label class=" control-label">التصنيف:  </label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">  اختر التصنيف.... </option>
                                    @foreach($categories as $category)
                                        <option {{old("category_id")==$category->id?"selected":""}} value="{{$category->id}}"> {{$category->title}}</option>
                                    @endforeach
                                </select>
                           </div>
                            <div class="col">
                        <label class="control-label">الدورة:  </label>
                                <select name="course_h" id="course_h" class="form-control">
                                    <option value=""> اختر اسم الدورة.... </option>
                                    @foreach($courses as $course)
                                        <option {{old("course_h")==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->courseAR}}</option>
                                    @endforeach
                                </select>
                           </div>
                            <div class="col">
                               <label class="control-label">المعلم:  </label>

                                <select name="teacher_h" id="teacher_h" class="form-control">
                                    <option value=""> اختر اسم المعلم.... </option>
                                    @foreach($teachers as $teacher)
                                        <option {{old("teacher_h")==$teacher->id?"selected":""}} value="{{$teacher->id}}"> {{$teacher->name}} </option>
                                    @endforeach
                                </select>
                           </div>
                        </div>
                    </div>


                    <div class="row ls_divider">
                        <div class="col-md-3 control-label">عدد المسجلين:  <span class="tag"><strong id="total_reg_student"></strong></span> طالب</div>
                        <div class="col-md-3 control-label"></span>عدد المنسحبين:  <span class="tag"><strong id="total_withdrawn_student"></strong></span> طالب</div>
                        <div class="col-md-3 control-label">مرتجعات الانسحابات : <span class="tag"><strong id="refunds"></strong> </span>دينار

                    </div>  </div><br>
                    <div class="row ls_divider">
                        <div class="col-md-3 control-label">رسوم التسجيل:  <span class="tag"><strong id="regFees"></strong></span> دينار</div>
                        <div class="col-md-3 control-label">رسوم المقررات:  <span class="tag"><strong id="docsFees"></strong></span> دينار</div>
                        <div class="col-md-3 control-label">رسوم الدورة:  <span class="tag"><strong id="courseFees"></strong></span> دينار</div>
                        <div class="col-md-3 control-label">الرسوم النهائية :  <span class="tag"><strong id="totalFees"></strong> </span>دينار</div>
                    </div><br>
                    <div class="row ls_divider">
                        <div class="col-md-3 control-label">الرسوم الكلية :  <span class="tag"><strong id="allFees"></strong></span> دينار</div>
                        <div class="col-md-3 control-label">مدفوعات الطلاب :  <span class="tag"><strong id="spayed"></strong></span> دينار</div>
                        <div class="col-md-3 control-label">ذمم الطلاب :  <span class="tag"><strong id="sremains"></strong></span> دينار</div>

                    </div><br>


                     <div class="row ls_divider">
                        <div class="col-md-3 control-label"> نصيب المعلم : <span class="tag"><strong id="teacher_fees"></strong></span> دينار</div>
                        <div class="col-md-3 control-label">مقبوضات المعلم  :  <span class="tag"><strong id="teacher_catches"></strong></span> دينار</div>
                        <div class="col-md-3 control-label">باقى نصيب المعلم  :  <span class="tag"><strong id="teacher_remains"></strong></span> دينار</div>

                    </div><br>
                     <div class="row ls_divider">
                        <div class="col-md-3 control-label"> نصيب المركز من التحصيل :  <span class="tag"><strong id="center_fees"></strong></span> دينار</div>
                        <div class="col-md-4 control-label"> نصيب المركز فى حالة التحصيل التام  :  <span class="tag"><strong id="all_center_fees"></strong></span> دينار</div>


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
                                <th>اسم الدورة</th>
                                <th>العام</th>
                                <th class="total_fees">الرسوم الكلى </th>
                                <th>اسم المعلم</th>
                                <th>نوع النسبة</th>
                                <th>المتفق عليه</th>
                                <th>النسبة</th>
                                <th>القيمة</th>
                                <th class="total_reg_student">عدد المسجلين</th>
                                <th class="total_withdrawn_student">عدد المنسحبين</th>
                                <th class="refunds">المرتجعات</th>
                                <th class="spays">المدفوعات</th>
                                <th class="sremains">الذمم</th>
                                <th class="teacher_fees">نصيب المعلم</th>

                                <th class="teacher_catches">مقبوضات المعلم</th>
                                <th class="teacher_remains">باقى المعلم </th>

                                <th class="center_fees">نصيب المركز </th>
                           <th class="all_center_fees">نصيب المركز الافتراضى</th>
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

<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

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
                    url: '/CMS/datatables/CourseReport',
                    data: function (d) {
                        d.searchCourse = $('#student-courses-table_filter input[type=search]').val();
                        d.courseId = $('select[name=course_h]').val();
                        d.teacherId = $('select[name=teacher_h]').val();
                        d.yearId = $('select[name=year_h]').val();
                        d.categoryId = $('select[name=category_id]').val();
                    }
                },
                drawCallback: function () {

                },
                columns: [
                    { data: 'id', name: 'id',orderable: true },
                    { data: 'courseAR', name: 'courseAR',orderable: true },
                   { data: 'm_year', name: 'm_year',orderable: true },
                    { data: 'price', name: 'price',orderable: true },
                    { data: 'teacher_name', name: 'teacher_name',orderable: true },
                    { data: 'title', name: 'title',orderable: true },
                    { data: 'teacher_agreed_fees', name: 'teacher_agreed_fees',orderable: true },
                    { data: 'percentage', name: 'percentage',orderable: true },

                    { data: 'value_sum', name: 'value_sum',orderable: true },
                    { data: 'total_reg_student', name: 'total_reg_student',orderable: true },
                    { data: 'total_withdrawn_student', name: 'total_withdrawn_student',orderable: true },
                    { data: 'refund', name: 'refund',orderable: true },
                    { data: 'spays', name: 'spays',orderable: true },
                    { data: 'sremains', name: 'sremains',orderable: true },
                    { data: 'teacher_fees', name: 'teacher_fees',orderable: true },
                    { data: 'teacher_catches', name: 'teacher_catches',orderable: true },
                    { data: 'teacher_remains', name: 'teacher_remains',orderable: true },
                    { data: 'center_fees', name: 'center_fees',orderable: true },
                    { data: 'all_center_fees', name: 'all_center_fees',orderable: true },
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
            $('#category_id').change(function() {
                sTable.draw();
            });
             sTable.on( 'xhr', function () {
                 var json = sTable.ajax.json();
                    // var total_rcourse = json.total_rcourse.replace(',','');
                    // var total_rteacher = json.total_rteacher.replace(',','');

                    // var net = parseFloat(total_rcourse) - parseFloat(total_rteacher);

                    $('#total_reg_student').replaceWith('<strong id="total_reg_student">'+json.all_total_reg+'</strong>');

                    $('#total_withdrawn_student').replaceWith('<strong id="total_withdrawn_student">'+json.all_total_withdrawan+'</strong>');
                    $('#refunds').replaceWith('<strong id="refunds">'+json.all_calcs.refunds+'</strong>');
                    $('#courseFees').replaceWith('<strong id="course_fees">'+json.all_courses_fees+'</strong>');

                    $('#regFees').replaceWith('<strong id="reg_fees">'+json.all_reg_fees+'</strong>');

                    $('#docsFees').replaceWith('<strong id="decisions_fees">'+json.all_descitions_fees+'</strong>');

                    $('#totalFees').replaceWith('<strong id="total_fees">'+json.all_total_fees+'</strong>');
                    $('#allFees').replaceWith('<strong id="allFees">'+json.all_calcs.all_prices+'</strong>');
                    $('#spayed').replaceWith('<strong id="spayed">'+json.all_calcs.all_spays+'</strong>');
                      $('#teacher_fees').replaceWith('<strong id="teacher_fees">'+json.all_calcs.teacher_fees+'</strong>');
                      $('#teacher_catches').replaceWith('<strong id="teacher_catches">'+json.all_calcs.teacher_catches+'</strong>');
                      $('#teacher_remains').replaceWith('<strong id="teacher_remains">'+json.all_calcs.teacher_remains+'</strong>');
                    $('#sremains').replaceWith('<strong id="sremains">'+json.all_calcs.all_sremain+'</strong>');
                    $('#center_fees').replaceWith('<strong id="center_fees">'+json.all_calcs.center_fees+'</strong>');
                    $('#all_center_fees').replaceWith('<strong id="all_center_fees">'+json.all_calcs.all_center_fees+'</strong>');
                    // $('#net').replaceWith('<strong id="net">'+net+'</strong>')
             });
        });
    </script>
@endsection
