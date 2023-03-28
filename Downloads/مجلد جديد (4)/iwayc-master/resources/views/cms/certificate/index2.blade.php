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

@stop
@endsection
@section('content')
@can('اضافة شهادة')


	                   <div class="card">
							<div class="card-body">
								<div class="tabs-menu ">
									<!-- Tabs -->
									<ul class="nav panel-tabs main-nav-line">
										<li class="nav-item">
											<a href="#certificate" data-toggle="tab"class="nav-link active">المصدقة</a>
										</li>

										<li class="nav-item">
											<a href="#sharing" data-toggle="tab"class="nav-link">المشاركة</a>
										</li>
                                        <li class="nav-item">
											<a href="#old" data-toggle="tab"class="nav-link">القديمة</a>
										</li>
                                        <li class="nav-item">
											<a href="#appreciation" data-toggle="tab"class="nav-link">التقدير</a>
										</li>
                                        <li class="nav-item">
											<a href="#international" data-toggle="tab" class="nav-link">الدولية</a>
										</li><br><br>
									</ul>
								</div>
			<div class="tab-content border-left border-bottom border-right border-top-0 p-4">

            <div class="tab-pane active" id="certificate">
                 <div class="row">
                                <div class="col-md-10"></div>
                                @can('اضافة شهادة')
                                    <div class="col-sm-2 text-right"><a href="/CMS/Certificate/create#certificate" class="btn btn-primary btn-md"><i class="glyphicon glyphicon-plus"></i> <i class='fas fa-plus'style="margin-left: 10px"></i>إضافة شهادة جديدة </a></div>
                                @endcan
                </div><br>

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
                                            <table class="col-md-8 table table-bordered table-striped table-hover">
                                            <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="year_h" id="year_h" class="form-control">
                                                                <option value=""> اختر العام.... </option>
                                                                @foreach($years as $year)
                                                                    <option {{old("year_h")==$year->title?"selected":""}} value="{{$year->title}}"> {{$year->title}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="student_h" id="student_h" class="form-control">
                                                                <option value=""> اختر اسم الطالب.... </option>
                                                                @foreach($students as $student)
                                                                    <option {{old("student_h")==$student->id?"selected":""}} value="{{$student->id}}"> {{$student->nameAR}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="course_h" id="course_h" class="form-control">
                                                                <option value=""> اختر اسم الدورة.... </option>
                                                                @foreach($courses as $course)
                                                                    <option {{old("course_h")==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->title}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="status_h" id="status_h" class="form-control">
                                                                <option value="">  اختر الحالة .... </option>
                                                                <option {{old("status_h")=='0'?"selected":""}} value="0"> تحت التنفيذ </option>
                                                                <option {{old("status_h")=='1'?"selected":""}} value="1"> تم الطباعة </option>
                                                           <option {{old("istatus_h")=='2'?"selected":""}} value="2"> تم التسليم </option>

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
                            <h3 class="panel-title text-left">العدد: (<Strong id="total_1_filter"></Strong>)</h3>
                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <!--Table Wrapper Start-->
                                                            <div class="table-responsive ls-table">
                                                                <table class="table table-bordered table-striped table-hover"  id="certificate-table" style="width:100%">
                                                <thead>
                                                        <tr>
                                                        <th></th>
                                                        <th>العام </th>
                                                        <th>اسم الطالب (ع)</th>
                                                        <th> الجنسية</th>
                                                        <th>مكان الولادة</th>
                                                        <th>سنة الميلاد</th>
                                                        <th>اسم الدورة</th>
                                                        <th>الساعات</th>
                                                        <th>المبتدئة</th>
                                                        <th>المنتهية</th>
                                                        <th>التقدير</th>
                                                        <th>الرسوم</th>
                                                        <th> رقم الوصل</th>
                                                        <th>الحالة</th>
                                                        <th>تاريخ الاصدار</th>
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



            <div class="tab-pane" id="sharing">
               <div class="row">
                                <div class="col-md-10"></div>
                                @can('اضافة شهادة')
                                    <div class="col-sm-2 text-right"><a href="/CMS/Certificate/create#sharing" class="btn btn-primary btn-md"><i class="glyphicon glyphicon-plus"></i> إضافة شهادة جديدة </a></div>
                                @endcan
                </div><br>
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
                                            <table class="col-md-8 table table-bordered table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="shyear_h" id="shyear_h" class="form-control">
                                                                <option value=""> اختر العام.... </option>
                                                                @foreach($years as $year)
                                                                    <option {{old("shyear_h")==$year->title?"selected":""}} value="{{$year->title}}"> {{$year->title}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="shstudent_h" id="shstudent_h" class="form-control">
                                                                <option value=""> اختر اسم الطالب.... </option>
                                                                @foreach($shstudents as $student)
                                                                    <option {{old("shstudent_h")==$student->id?"selected":""}} value="{{$student->id}}"> {{$student->nameAR}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="shcourse_h" id="shcourse_h" class="form-control">
                                                                <option value=""> اختر اسم الدورة.... </option>
                                                                @foreach($shcourses as $course)
                                                                    <option {{old("shcourse_h")==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->title}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="shstatus_h" id="shstatus_h" class="form-control">
                                                                <option value="">   اختر الحالة.... </option>
                                                                <option {{old("shstatus_h")=='0'?"selected":""}} value="0"> تحت التنفيذ </option>
                                                                <option {{old("shstatus_h")=='1'?"selected":""}} value="1"> تم الطباعة </option>
                                                            <option {{old("istatus_h")=='2'?"selected":""}} value="2"> تم التسليم </option>

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
                            <h3 class="panel-title text-left">العدد: (<Strong id="total_filter"></Strong>)</h3>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <!--Table Wrapper Start-->
                                                            <div class="table-responsive ls-table">
                                                                <table class="table table-bordered table-striped table-hover"  id="sharing-table" style="width:100%">
                                                                   <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th>العام </th>
                                                                            <th>اسم الطالب (ع)</th>
                                                                            <th> الجنسية</th>
                                                                            <th>مكان الولادة</th>
                                                                            <th>سنة الميلاد</th>
                                                                            <th>اسم الدورة</th>
                                                                            <th>الساعات</th>
                                                                            <th>المبتدئة</th>
                                                                            <th>المنتهية</th>
                                                                            <th>التقدير</th>
                                                                            <th>الرسوم</th>
                                                                            <th> رقم الوصل</th>
                                                                            <th>الحالة</th>
                                                                            <th>تاريخ الاصدار</th>
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



            <div class="tab-pane" id="old">
               <div class="row">
                                <div class="col-md-10"></div>
                                @can('اضافة شهادة')
                                    <div class="col-sm-2 text-right"><a href="/CMS/Certificate/create#old" class="btn btn-primary btn-md"><i class="glyphicon glyphicon-plus"></i> إضافة شهادة جديدة </a></div>
                                @endcan
                </div><br>
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
                                            <table class="col-md-8 table table-bordered table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="oyear_h" id="oyear_h" class="form-control">
                                                                <option value=""> اختر العام.... </option>
                                                                @foreach($years as $year)
                                                                    <option {{old("oyear_h")==$year->title?"selected":""}} value="{{$year->title}}"> {{$year->title}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="ostudent_h" id="ostudent_h" class="form-control">
                                                                <option value=""> اختر اسم الطالب.... </option>
                                                                @foreach($ostudents as $student)
                                                                    <option {{old("ostudent_h")==$student->id?"selected":""}} value="{{$student->id}}"> {{$student->nameAR}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="shcourse_h" id="shcourse_h" class="form-control">
                                                                <option value=""> اختر اسم الدورة.... </option>
                                                                @foreach($ocourses as $course)
                                                                    <option {{old("ocourse_h")==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->title}} </option>
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

                            <br>
                            <h3 class="panel-title text-left">العدد: (<Strong id="total_2_filter"></Strong>)</h3>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <!--Table Wrapper Start-->
                                                            <div class="table-responsive ls-table">
                                             <table class="table table-bordered table-striped table-hover"  id="old-table" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>العام </th>
                                                        <th>اسم الطالب (ع)</th>
                                                        <th> الجنسية</th>
                                                        <th>مكان الولادة</th>
                                                        <th>سنة الميلاد</th>
                                                       <th>اسم الدورة</th>
                                                       <th>الساعات</th>
                                                        <th>المبتدئة</th>
                                                        <th>المنتهية</th>
                                                        <th>التقدير</th>
                                                        <th>تاريخ الاصدار</th>
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



            <div class="tab-pane" id="appreciation">
               <div class="row">
                                <div class="col-md-10"></div>
                                @can('اضافة شهادة')
                                    <div class="col-sm-2 text-right"><a href="/CMS/Certificate/create#appreciation" class="btn btn-primary btn-md"><i class="glyphicon glyphicon-plus"></i> إضافة شهادة جديدة </a></div>
                                @endcan
                </div><br>
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
                                            <table class="col-md-8 table table-bordered table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                           <select name="ayear_h" id="ayear_h" class="form-control">
                                                                <option value=""> اختر العام.... </option>
                                                                @foreach($years as $year)
                                                                    <option {{old("ayear_h")==$year->title?"selected":""}} value="{{$year->title}}"> {{$year->title}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>


                                                        <td>
                                                            <select name="astatus_h" id="astatus_h" class="form-control">
                                                                <option value="">   اختر الحالة.... </option>
                                                                <option {{old("astatus_h")=='0'?"selected":""}} value="0"> تحت التنفيذ </option>
                                                                <option {{old("astatus_h")=='1'?"selected":""}} value="1"> تم الطباعة </option>
                                                            <option {{old("istatus_h")=='2'?"selected":""}} value="2"> تم التسليم </option>

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
                            <h3 class="panel-title text-left">العدد: (<Strong id="total_4_filter"></Strong>)</h3>
                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <!--Table Wrapper Start-->
                                                            <div class="table-responsive ls-table">
                                                                <table class="table table-bordered table-striped table-hover"  id="appreciation-table" style="width:100%">
                                                                   <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>العام</th>
                                                        <th> الاسم</th>
                                                        <th> الوصف</th>
                                                        <th>الحالة</th>
                                                        <th>تاريخ الاصدار</th>
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




            <div class="tab-pane" id="international">
               <div class="row">
                                <div class="col-md-10"></div>
                                @can('اضافة شهادة')
                                    <div class="col-sm-2 text-right"><a href="/CMS/Certificate/create#international" class="btn btn-primary btn-md"><i class="glyphicon glyphicon-plus"></i> إضافة شهادة جديدة </a></div>
                                @endcan
                </div><br>
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
                                            <table class="col-md-8 table table-bordered table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                           <select name="iyear_h" id="iyear_h" class="form-control">
                                                                <option value=""> اختر العام.... </option>
                                                                @foreach($years as $year)
                                                                    <option {{old("iyear_h")==$year->title?"selected":""}} value="{{$year->title}}"> {{$year->title}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="istudent_h" id="istudent_h" class="form-control">
                                                                <option value=""> اختر اسم الطالب.... </option>
                                                                @foreach($istudents as $student)
                                                                    <option {{old("istudent_h")==$student->id?"selected":""}} value="{{$student->id}}"> {{$student->nameAR}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="icourse_h" id="icourse_h" class="form-control">
                                                                <option value=""> اختر اسم الدورة.... </option>
                                                                @foreach($icourses as $course)
                                                                    <option {{old("icourse_h")==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->title}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="istatus_h" id="istatus_h" class="form-control">
                                                                <option value="">   اختر الحالة.... </option>
                                                                <option {{old("istatus_h")=='0'?"selected":""}} value="0"> تحت التنفيذ </option>
                                                                <option {{old("istatus_h")=='1'?"selected":""}} value="1"> تم الطباعة </option>
                                                            <option {{old("istatus_h")=='2'?"selected":""}} value="2"> تم التسليم </option>

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
                            <h3 class="panel-title text-left ">العدد: (<Strong id="total_5_filter"></Strong>)</h3>
                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <!--Table Wrapper Start-->
                                                            <div class="table-responsive ls-table">
                                                                <table class="table table-bordered table-striped table-hover"  id="international-table" style="width:100%">
                                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>العام </th>
                                                        <th>اسم الطالب (EN)</th>
                                                        <th> الجنسية</th>
                                                        <th>سنة الميلاد</th>
                                                       <th> اسم الدورة</th>
                                                       <th>الساعات</th>
                                                        <th>المبتدئة</th>
                                                        <th>المنتهية</th>
                                                        <th >الحالة</th>
                                                        <th>تاريخ الاصدار</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endcan

                                                @cannot('اضافة شهادة')
                                        <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            ليس لديك صلاحية يرجي مراجعة المسؤول
                                        </div>
                                    @endcannot
                                            </div> <!-- row closed -->
                </div>



                </div>
            </div>
        </div> <!-- card closed -->
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
    /**************** certificates *****************/
     $(function() {

            var cTable = $('#certificate-table').DataTable({
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
                    url: '/CMS/datatables/Certificate',
                    data: function (d) {
                        d.searchCertificate = $('#certificate-table_filter input[type=search]').val();
                        d.yearId = $('select[name=year_h]').val();
                        d.studentId = $('select[name=student_h]').val();
                        d.courseId = $('select[name=course_h]').val();
                        d.statusId = $('select[name=status_h]').val();
                    }
                },

                columns: [
                    { data: 'uid', name: 'uid' },
                    { data: 'year', name: 'year' },
                    { data: 'studentAR', name: 'studentAR' },
                    { data: 'nationality', name: 'nationality' },
                    { data: 'place_birth', name: 'place_birth' },
                    { data: 'year_birth', name: 'year_birth' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'hours', name: 'hours' },
                    { data: 'start_day', name: 'start_day' },
                    { data: 'end_day', name: 'end_day' },
                    { data: 'appreciation', name: 'appreciation' },
                    { data: 'certificate_fees', name: 'certificate_fees' },
                    { data: 'catch_receipt_id', name: 'catch_receipt_id' },
                    {"mRender": function ( data, type, row ) {
                            var sel = '<select style="width:120px" onchange="myFunction(this)" id="'+row.id+'" name="print_e" class="form-control">';
                            var op1 = '<option value="0">تحت التنفيذ</option>';
                            if(row.print_execute==0){
                                op1 = '<option selected value="0">تحت التنفيذ</option>';
                            }
                            var op2 = '<option value="1">تم الطباعة</option>';
                            if(row.print_execute==1){
                                op2 = '<option selected value="1">تم الطباعة</option>';
                            }

                            var op3 = '<option value="2"> تم التسليم</option>';
                            if(row.print_execute==2){
                                op3 = '<option selected value="2">تم التسليم </option>';
                            }
                            var se = '</select>';

                            var all = sel + op1 + op2 + op3 + se;

                            return all;
                        }
                        ,orderable: false},
                    { data: 'release_date', name: 'release_date' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/Certificate/'+row.id+'#certificate">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Certificate/'+row.id+'/edit#certificate">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Certificate/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض شهادة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل شهادة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف شهادة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                        ,orderable: false}
                ],




            });
            //filtering
            $('#year_h').change(function() {
                cTable.draw();
            });
            $('#student_h').change(function() {
                cTable.draw();
            });
            $('#course_h').change(function() {
                cTable.draw();
            });
            $('#status_h').change(function() {
                cTable.draw();
            });
            cTable.on( 'xhr', function () {
                var json = cTable.ajax.json();
                    $('#total_1_filter').replaceWith('<strong id="total_1_filter">'+json.total+'</strong>')
            });
      });

        /**************** sharing certificates *****************/
       setTimeout(function() {
            var shTable = $('#sharing-table').DataTable({
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
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/sharingCertificate',
                    data: function (d) {
                        d.searchCertificate = $('#sharing-table_filter input[type=search]').val();
                        d.yearId = $('select[name=shyear_h]').val();
                        d.studentId = $('select[name=shstudent_h]').val();
                        d.courseId = $('select[name=shcourse_h]').val();
                        d.statusId = $('select[name=shstatus_h]').val();
                    }
                },
                    columnDefs: [{
                        targets: '_all',
                        render: function(data, type, row) {
                            if (type === 'PDF') {
                                return String(data).split(' ').reverse().join('  ');
                            }  return data;} }
                   ],
                columns: [
                    { data: 'uid', name: 'uid' },
                    { data: 'year', name: 'year' },
                    { data: 'studentAR', name: 'studentAR' },
                    { data: 'nationality', name: 'nationality' },
                    { data: 'place_birth', name: 'place_birth' },
                    { data: 'year_birth', name: 'year_birth' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'hours', name: 'hours' },
                    { data: 'start_day', name: 'start_day' },
                    { data: 'end_day', name: 'end_day' },
                    { data: 'appreciation', name: 'appreciation' },
                    { data: 'certificate_fees', name: 'certificate_fees' },
                    { data: 'catch_receipt_id', name: 'catch_receipt_id' },
                    {"mRender": function ( data, type, row ) {
                            var sel = '<select style="width:120px" onchange="myFunction(this)" id="'+row.id+'" name="print_e" class="form-control">';
                            var op1 = '<option value="0">تحت التنفيذ</option>';
                            if(row.print_execute==0){
                                op1 = '<option selected value="0">تحت التنفيذ</option>';
                            }
                            var op2 = '<option value="1">تم الطباعة</option>';
                            if(row.print_execute==1){
                                op2 = '<option selected value="1">تم الطباعة</option>';
                            }
                            var op3 = '<option value="2"> تم التسليم</option>';
                            if(row.print_execute==2){
                                op3 = '<option selected value="2">تم التسليم </option>';
                            }
                            var se = '</select>';

                            var all = sel + op1 + op2 + op3 + se;

                            return all;
                        }
                        ,orderable: false},
                    { data: 'release_date', name: 'release_date' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/Certificate/'+row.id+'#sharing">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Certificate/'+row.id+'/edit#sharing">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Certificate/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض شهادة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل شهادة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف شهادة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                        ,orderable: false}
                ]
            });
            //filtering
            $('#shyear_h').change(function() {
                shTable.draw();
            });
            $('#shstudent_h').change(function() {
                shTable.draw();
            });
            $('#shcourse_h').change(function() {
                shTable.draw();
            });
            $('#shstatus_h').change(function() {
                shTable.draw();
            });
            shTable.on( 'xhr', function () {
                var json = shTable.ajax.json();
                    $('#total_filter').replaceWith('<strong id="total_filter">'+json.total+'</strong>')
            });
       },400);

        /**************** old certificates *****************/
       setTimeout(function() {
            var oTable = $('#old-table').DataTable({
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
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/oldCertificate',
                    data: function (d) {
                        d.searchCertificate = $('#old-table_filter input[type=search]').val();
                        d.yearId = $('select[name=oyear_h]').val();
                        d.studentId = $('select[name=ostudent_h]').val();
                        d.courseId = $('select[name=ocourse_h]').val();
                        d.statusId = $('select[name=ostatus_h]').val();
                    }
                },
                    columnDefs: [{
                        targets: '_all',
                        render: function(data, type, row) {
                            if (type === 'PDF') {
                                return String(data).split(' ').reverse().join('  ');
                            }  return data;} }
                   ],
                columns: [
                    { data: 'uid', name: 'uid' },
                    { data: 'year', name: 'year' },
                    { data: 'studentAR', name: 'studentAR' },
                    { data: 'nationality', name: 'nationality' },
                    { data: 'place_birth', name: 'place_birth' },
                    { data: 'year_birth', name: 'year_birth' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'hours', name: 'hours' },
                    { data: 'start_day', name: 'start_day' },
                    { data: 'end_day', name: 'end_day' },
                    { data: 'appreciation', name: 'appreciation' },
                    { data: 'release_date', name: 'release_date' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/Certificate/'+row.id+'#old">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Certificate/'+row.id+'/edit#old">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Certificate/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض شهادة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل شهادة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف شهادة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                        ,orderable: false}
                ]
            });
            //filtering
            $('#oyear_h').change(function() {
                oTable.draw();
            });
            $('#ostudent_h').change(function() {
                oTable.draw();
            });
            $('#ocourse_h').change(function() {
                oTable.draw();
            });
            $('#ostatus_h').change(function() {
                oTable.draw();
            });
             oTable.on( 'xhr', function () {
                var json = oTable.ajax.json();
                    $('#total_2_filter').replaceWith('<strong id="total_2_filter">'+json.total+'</strong>')
            });
       },800);

        /**************** appreciation certificates *****************/
       setTimeout(function() {
            var aTable = $('#appreciation-table').DataTable({
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

                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/appreciationCertificate',
                    data: function (d) {
                        d.searchCertificate = $('#appreciation-table_filter input[type=search]').val();
                        d.yearId = $('select[name=ayear_h]').val();
                        d.studentId = $('select[name=astudent_h]').val();
                        d.courseId = $('select[name=acourse_h]').val();
                        d.statusId = $('select[name=astatus_h]').val();
                    }
                },
                    columnDefs: [{
                        targets: '_all',
                        render: function(data, type, row) {
                            if (type === 'PDF') {
                                return String(data).split(' ').reverse().join('  ');
                            }  return data;} }
                   ],
                columns: [
                    { data: 'uid', name: 'uid' },
                    { data: 'year', name: 'year' },
                    { data: 'student_name', name: 'student_name' },
                    { data: 'description', name: 'description' },

                    {"mRender": function ( data, type, row ) {
                            var sel = '<select style="width:120px" onchange="myFunction(this)" id="'+row.id+'" name="print_e" class="form-control">';
                            var op1 = '<option value="0">تحت التنفيذ</option>';
                            if(row.print_execute==0){
                                op1 = '<option selected value="0">تحت التنفيذ</option>';
                            }
                            var op2 = '<option value="1">تم الطباعة</option>';
                            if(row.print_execute==1){
                                op2 = '<option selected value="1">تم الطباعة</option>';
                            }
                            var op3 = '<option value="2"> تم التسليم</option>';
                            if(row.print_execute==2){
                                op3 = '<option selected value="2">تم التسليم </option>';
                            }
                            var se = '</select>';

                            var all = sel + op1 + op2 + op3 + se;

                            return all;
                        }
                        ,orderable: false},
                    { data: 'release_date', name: 'release_date' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/Certificate/'+row.id+'#appreciation">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Certificate/'+row.id+'/edit#appreciation">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Certificate/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض شهادة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل شهادة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف شهادة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                        ,orderable: false}
                ]
            });
            //filtering
            $('#ayear_h').change(function() {
                aTable.draw();
            });
            $('#astudent_h').change(function() {
                aTable.draw();
            });

            $('#astatus_h').change(function() {
                aTable.draw();
            });
             aTable.on( 'xhr', function () {
                var json = aTable.ajax.json();
                    $('#total_4_filter').replaceWith('<strong id="total_4_filter">'+json.total+'</strong>')
            });
       },1000);



        /**************** international certificates *****************/
       setTimeout(function() {
            var iTable = $('#international-table').DataTable({
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
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/internationalCertificate',
                    data: function (d) {
                        d.searchCertificate = $('#international-table_filter input[type=search]').val();
                        d.yearId = $('select[name=iyear_h]').val();
                        d.studentId = $('select[name=istudent_h]').val();
                        d.courseId = $('select[name=icourse_h]').val();
                        d.statusId = $('select[name=istatus_h]').val();
                    }
                },
                    columnDefs: [{
                        targets: '_all',
                        render: function(data, type, row) {
                            if (type === 'PDF') {
                                return String(data).split(' ').reverse().join('  ');
                            }  return data;} }
                   ],
                columns: [
                    { data: 'uid', name: 'uid' },
                    { data: 'year', name: 'year' },
                    { data: 'studentEN', name: 'studentEN' },
                    { data: 'nationality', name: 'nationality' },
                    { data: 'year_birth', name: 'year_birth' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'hours', name: 'hours' },
                    { data: 'start_day', name: 'start_day' },
                    { data: 'end_day', name: 'end_day' },

                    {"mRender": function ( data, type, row ) {
                            var sel = '<select style="width:120px" onchange="myFunction(this)" id="'+row.id+'" name="print_e" class="form-control">';
                            var op1 = '<option value="0">تحت التنفيذ</option>';
                            if(row.print_execute==0){
                                op1 = '<option selected value="0">تحت التنفيذ</option>';
                            }
                            var op2 = '<option value="1">تم الطباعة</option>';
                            if(row.print_execute==1){
                                op2 = '<option selected value="1">تم الطباعة</option>';
                            }
                            var op3 = '<option value="2"> تم التسليم</option>';
                            if(row.print_execute==2){
                                op3 = '<option selected value="2">تم التسليم </option>';
                            }
                            var se = '</select>';

                            var all = sel + op1 + op2 + op3 + se;

                            return all;
                        }
                        ,orderable: false},
                    { data: 'release_date', name: 'release_date',class: 'printCol' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/Certificate/'+row.id+'#international">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Certificate/'+row.id+'/edit#international">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Certificate/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض شهادة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل شهادة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف شهادة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                        ,orderable: false}
                ]
            });
            //filtering
            $('#iyear_h').change(function() {
                iTable.draw();
            });
            $('#istudent_h').change(function() {
                iTable.draw();
            });
            $('#icourse_h').change(function() {
                iTable.draw();
            });
            $('#istatus_h').change(function() {
                iTable.draw();
            });

             iTable.on( 'xhr', function () {
                var json = iTable.ajax.json();
                    $('#total_5_filter').replaceWith('<strong id="total_5_filter">'+json.total+'</strong>')
            });
       },1200);

        function myFunction(selectID) {
            var opt=selectID.value;
            var id=selectID.id;
            // var dd =$.datepicker.formatDate('yy/mm/dd', new Date());
            // var rrr =$(this).find('td.printCol').text(dd);
            $.get("/CMS/Certificate/Print/"+id+"/"+opt);
               not7();


        }
        $(document).ready(function(){
            var url      = window.location.href;
            var tabs = url.split('#');
            var href = tabs[1];

           $('#myTabs a[href="#'+href+'"]').tab('show');


});
    </script>
@endsection
