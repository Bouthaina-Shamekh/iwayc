@extends('layouts.master')
@section('css')
<style>
.modal{
    padding: 0 !important;
   }
   .testdialog {
     max-width: 70% !important;

     padding: 0;
     margin: 0;
   }

   .testcontent {
     border-radius: 0 !important;

     max-width: 100% !important;

   }
</style>

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
<div class="modal fade" id="favoritesModal"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog testdialog" role="document">
    <div class="modal-content testcontent">
      <div class="modal-header">
      <h4 class="modal-title"
        id="favoritesModalLabel">إدارة سندات القبض والصرف</h4>
        <button type="button" class="close"
          data-dismiss="modal"
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button"
           class="btn btn-default"
           data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>



	                   <div class="card">
							<div class="card-body">
								<div class="tabs-menu ">
									<!-- Tabs -->
	<ul class="nav panel-tabs main-nav-line">
		<li class="nav-item">
			<a href="#crCourse" data-toggle="tab"class="nav-link active">قبض الدورات</a>
		</li>
		<li class="nav-item">
			<a href="#rCourse" data-toggle="tab"class="nav-link">صرف اجور معلم</a>
		</li>
        <li class="nav-item">
			<a href="#rSalary" data-toggle="tab"class="nav-link">صرف الرواتب</a>
		</li>
        <li class="nav-item">
		    <a href="#rAdvance" data-toggle="tab"class="nav-link">صرف سلفة</a>
		</li>
        <li class="nav-item">
			<a href="#rReward" data-toggle="tab" class="nav-link">صرف مكافأت</a>
		</li>
         <li class="nav-item">
			<a href="#rWarranty" data-toggle="tab"class="nav-link">صرف الضمان</a>
		</li>
        <li class="nav-item">
			<a href="#crBox" data-toggle="tab"class="nav-link">قبض صندوق مستقل</a>
		</li>
        <li class="nav-item">
		    <a href="#rBox" data-toggle="tab"class="nav-link">صرف صندوق مستقل</a>
		</li>
        <br><br>
	</ul>
								</div>
                  </div>
                </div>

			<div class="tab-content border-left border-bottom border-right border-top-0 p-4">

<!-- /////////////////////////////////////////////////////-->

<div class="tab-pane active" id="crCourse">
 @can('عرض قبض دورة')
    <div class="row">
        <div class="col-8"></div>
        <div class="col-2"></div>
            @can('اضافة قبض دورة')
            <div class="">
            <a href="/CMS/CatchReceipt/create" class="btn btn-primary btn-md">
            <i class="glyphicon glyphicon-plus">
            </i>إضافة سند قبض جديد </a>
            </div>
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
                        <table class="col-md-12 table table-bordered table-striped table-hover">
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="student_1_h" id="student_1_h" class="form-control">
                                        <option value=""> اختر اسم الطالب.... </option>
                                        @foreach($students as $student)
                                        <option {{old("student_1_h")==$student->id?"selected":""}} value="{{$student->id}}"> {{$student->nameAR}} </option>
                                        @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="course_1_h" id="course_1_h" class="form-control">
                                        <option value=""> اختر اسم الدورة.... </option>
                                        @foreach($courses as $course)
                                        <option {{old("course_1_h")==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->courseAR}} </option>
                                        @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="user_1_h" id="user_1_h" class="form-control">
                                        <option value=""> اختر اسم المستخدم.... </option>
                                        @foreach($users as $user)
                                        <option {{old("user_1_h")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
                                        @endforeach
                                        </select>
                                    </td>
                                </tr>
                        </tbody>
                </table><br>
                <table class="table table-bordered table-striped table-hover">
                    <h5><strong>فرز بحسب تاريخ الطلب : </strong></h5>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text"
                                value="{{old("from_1_h")}}"
                                class="form-control text-input datepicker1" id="from_1_h" name="from_1_h"
                                placeholder="من....">
                            </td>
                        <td>
                                <input type="text"
                                value="{{old("to_1_h")}}"
                                class="form-control text-input datepicker1" id="to_1_h" name="to_1_h"
                                placeholder="الي....">
                            </td>
                        <td>
                                <a class="btn btn-primary"
                                id="search_1_h"
                                name="search_1_h">بحث</a>
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
                            <h3 class="panel-title text-left">المجموع: <span class="tag"><Strong id="total_1_filter"></Strong><span> دينار</h3>
                            <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-hover"  id="catch-receipt-table" style="width:100%">
                                    <thead>
                                        <tr>
                                                        <th>الرقم الحاسوبي</th>
                                                        <th>الرقم الورقي</th>
                                                        <th>التاريخ</th>
                                                        <th>اسم الطالب</th>
                                                        <th>اسم الدورة</th>
                                                        <th class="total_1_filter">المبلغ</th>
                                                        <th>التاريخ والوقت للادخال</th>
                                                        <th>اسم المستخدم</th>
                                                        <th></th>
                                        </tr>
                                    </thead>
                                    </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                        @endcan

                        @cannot('عرض قبض دورة')
                            <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                ليس لديك صلاحية يرجي مراجعة المسؤول
                            </div>
                        @endcannot

</div>
<!-- /////////////////////////////////////////////////////-->



<div class="tab-pane" id="rCourse">
@can('عرض صرف دورة')
    <div class="row">
          <div class="col-8"></div>
        <div class="col-2"></div>
             @can('عرض صرف دورة')
            <div class="">
            <a href="/CMS/ReceiptCourse" class="btn btn-primary btn-md">
            <i class="glyphicon glyphicon-plus">
            </i>اضافة سند صرف معلم </a>
            </div>
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
                  <table class="col-md-6 table table-bordered table-striped table-hover">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="teacher_2_h" id="teacher_2_h" class="form-control">
                                                                <option value=""> اختر اسم المعلم.... </option>
                                                                @foreach($teachers as $teacher)
                                                                    <option {{old("teacher_2_h")==$teacher->id?"selected":""}} value="{{$teacher->id}}"> {{$teacher->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="course_2_h" id="course_2_h" class="form-control">
                                                                <option value=""> اختر اسم الدورة.... </option>
                                                                @foreach($courses as $course)
                                                                    <option {{old("course_2_h")==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->courseAR}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="user_2_h" id="user_2_h" class="form-control">
                                                                <option value=""> اختر اسم المستخدم.... </option>
                                                                @foreach($users as $user)
                                                                    <option {{old("user_2_h")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table><br>
                                                <table class="table table-bordered table-striped table-hover">
                                                    <h5><strong>فرز بحسب تاريخ الطلب : </strong></h5>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <input onchange="$('#to_2_h').val(this.value);document.getElementById('to_2_h').min=this.value;"
                                                                   type="text" value="{{old("from_2_h")}}"
                                                                   class="form-control text-input datepicker1" id="from_2_h" name="from_2_h" placeholder="من....">
                                                        </td>
                                                        <td>
                                                            <input type="text" value="{{old("to_2_h")}}"
                                                                   class="form-control text-input datepicker1" id="to_2_h" name="to_2_h" placeholder="الي....">
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-primary" id="search_2_h" name="search_2_h">بحث</a>
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
                            <h3 class="panel-title text-left">المجموع: <span class="tag"><Strong id="total_2_filter"></Strong><span> دينار</h3>
                            <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-hover"  id="receipt-course-table" style="width:100%">
                                       <thead>
                                                    <tr>
                                                        <th>الرقم الحاسوبي</th>
                                                        <th>الرقم الورقي</th>
                                                        <th>التاريخ</th>
                                                        <th>المعلم</th>
                                                        <th>الدورة</th>
                                                        <th class="total_2_filter">المبلغ</th>
                                                        <th>تاريخ ووقت الادخال</th>
                                                        <th>اسم المستخدم</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                    </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



@endcan

                            @cannot('عرض صرف دورة')
                                <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    ليس لديك صلاحية يرجي مراجعة المسؤول
                                </div>
                            @endcannot

</div>
<!-- /////////////////////////////////////////////////////-->


<div class="tab-pane" id="rSalary">
@can('عرض صرف راتب')
    <div class="row">
          <div class="col-8"></div>
        <div class="col-2"></div>
            @can('اضافة صرف راتب')
            <div class="">
            <a href="/CMS/ReceiptSalary/create" class="btn btn-primary btn-md">
            <i class="glyphicon glyphicon-plus">
            </i> إضافة سند صرف جديد </a>
            </div>
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
                 <table class="col-md-6 table table-bordered table-striped table-hover">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="employee_4_h" id="employee_4_h" class="form-control">
                                                                <option value=""> اختر اسم الموظف.... </option>
                                                                @foreach($employees as $employee)
                                                                    <option {{old("employee_4_h")==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="month_4_h" id="month_4_h" class="form-control">
                                                                <option value=""> اختر من الشهر.... </option>
                                                                <option {{old("month_4_h")=="01"?"selected":""}} value="01"> Jan - 01 </option>
                                                                <option {{old("month_4_h")=="02"?"selected":""}} value="02"> Fab - 02 </option>
                                                                <option {{old("month_4_h")=="03"?"selected":""}} value="03"> Mar - 03 </option>
                                                                <option {{old("month_4_h")=="04"?"selected":""}} value="04"> Apr - 04 </option>
                                                                <option {{old("month_4_h")=="05"?"selected":""}} value="05"> May - 05 </option>
                                                                <option {{old("month_4_h")=="06"?"selected":""}} value="06"> June - 06 </option>
                                                                <option {{old("month_4_h")=="07"?"selected":""}} value="07"> July - 07 </option>
                                                                <option {{old("month_4_h")=="08"?"selected":""}} value="08"> Aug - 08 </option>
                                                                <option {{old("month_4_h")=="09"?"selected":""}} value="09"> Sept - 09 </option>
                                                                <option {{old("month_4_h")=="10"?"selected":""}} value="10"> Oct - 10 </option>
                                                                <option {{old("month_4_h")=="11"?"selected":""}} value="11"> Nov - 11 </option>
                                                                <option {{old("month_4_h")=="12"?"selected":""}} value="12"> Dec - 12 </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="user_4_h" id="user_4_h" class="form-control">
                                                                <option value=""> اختر اسم المستخدم.... </option>
                                                                @foreach($users as $user)
                                                                    <option {{old("user_4_h")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
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
 <div class="row">
    <div class="col-5">
         <h3 class="">مجموع مستردات السلف: <span class="tag">
        <strong id="tot2_filter"></strong> </span> دينار  </h3>
 </div>
  <div class="col">
       <h3 class="" style=""> مجموع الرواتب :<span class="tag">
        <strong id="tot3_filter"></strong> </span> دينار</h3>
 </div>
  <div class="col">
   <h3 class="">المجموع الكلى:<span class="tag">
        <Strong id="total_4_filter"></Strong> </span>دينار</h3>
 </div>
 </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-hover"  id="receipt-salary-table" style="width:100%">
                                       <thead>
                                                    <tr>
                                                        <th>الرقم الحاسوبي</th>
                                                        <th>الرقم الورقي</th>
                                                        <th>التاريخ</th>
                                                        <th>الموظف</th>
                                                        <th>الشهر</th>
                                                        <th> سداد ذمم</th>
                                                        <th class="total_4_filter">المبلغ</th>
                                                        <th>المبلغ الكلى</th>
                                                        <th>تاريخ ووقت الادخال</th>
                                                        <th>اسم المستخدم</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                    </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



@endcan

                            @cannot('عرض صرف راتب')
                                <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    ليس لديك صلاحية يرجي مراجعة المسؤول
                                </div>
                            @endcannot

</div>

<!-- /////////////////////////////////////////////////////-->


<div class="tab-pane" id="rAdvance">
@can('عرض صرف سلفة')
    <div class="row">
         <div class="col-8"></div>
        <div class="col-2"></div>
           @can('اضافة صرف سلفة')
            <div class="">
            <a href="/CMS/ReceiptAdvance/create" class="btn btn-primary btn-md">
            <i class="glyphicon glyphicon-plus">
            </i> إضافة سند صرف جديد </a>
            </div>
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
                             <table class="col-md-6 table table-bordered table-striped table-hover">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="employee_5_h" id="employee_5_h" class="form-control">
                                                                <option value=""> اختر اسم الموظف.... </option>
                                                                @foreach($employees as $employee)
                                                                    <option {{old("employee_5_h")==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="user_5_h" id="user_5_h" class="form-control">
                                                                <option value=""> اختر اسم المستخدم.... </option>
                                                                @foreach($users as $user)
                                                                    <option {{old("user_5_h")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
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
                            <h3 class="panel-title text-left">المجموع: <span class="tag"><Strong id="total_5_filter"></Strong></span> دينار</h3>
                            <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-hover"  id="receipt-advance-table" style="width:100%">
                                       <thead>
                                                    <tr>
                                                        <th>الرقم الحاسوبي</th>
                                                        <th>الرقم الورقي</th>
                                                        <th>التاريخ</th>
                                                        <th>الموظف</th>
                                                        <th class="total_5_filter">مبلغ السلفة</th>
                                                        <th>عدد شهور السداد</th>
                                                        <th>دفعات السداد الشهري</th>
                                                        <th>يبدأ السداد من راتب شهر</th>
                                                        <th>تاريخ ووقت الادخال</th>
                                                        <th>اسم المستخدم</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                    </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



@endcan

                            @cannot('عرض صرف سلفة')
                                <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    ليس لديك صلاحية يرجي مراجعة المسؤول
                                </div>
                            @endcannot
</div>
<!-- /////////////////////////////////////////////////////-->


<div class="tab-pane" id="rReward">
 @can('عرض صرف مكافأة')
    <div class="row">
        <div class="col-8"></div>
        <div class="col-2"></div>
         @can('اضافة صرف مكافأة')
            <div class="">
            <a href="/CMS/ReceiptReward/create" class="btn btn-primary btn-md">
            <i class="glyphicon glyphicon-plus">
            </i> إضافة سند صرف جديد </a>
            </div>
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
                            <table class="col-md-6 table table-bordered table-striped table-hover">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="employee_6_h" id="employee_6_h" class="form-control">
                                                                <option value=""> اختر اسم الموظف.... </option>
                                                                @foreach($employees as $employee)
                                                                    <option {{old("employee_6_h")==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="month_6_h" id="month_6_h" class="form-control">
                                                                <option value=""> اختر من الشهر.... </option>
                                                                <option {{old("month_6_h")=="1"?"selected":""}} value="1"> Jan - 01 </option>
                                                                <option {{old("month_6_h")=="2"?"selected":""}} value="2"> Fab - 02 </option>
                                                                <option {{old("month_6_h")=="3"?"selected":""}} value="3"> Mar - 03 </option>
                                                                <option {{old("month_6_h")=="4"?"selected":""}} value="4"> Apr - 04 </option>
                                                                <option {{old("month_6_h")=="5"?"selected":""}} value="5"> May - 05 </option>
                                                                <option {{old("month_6_h")=="6"?"selected":""}} value="6"> June - 06 </option>
                                                                <option {{old("month_6_h")=="7"?"selected":""}} value="7"> July - 7 </option>
                                                                <option {{old("month_6_h")=="8"?"selected":""}} value="8"> Aug - 08 </option>
                                                                <option {{old("month_6_h")=="9"?"selected":""}} value="9"> Sept - 09 </option>
                                                                <option {{old("month_6_h")=="10"?"selected":""}} value="10"> Oct - 10 </option>
                                                                <option {{old("month_6_h")=="11"?"selected":""}} value="11"> Nov - 11 </option>
                                                                <option {{old("month_6_h")=="12"?"selected":""}} value="12"> Dec - 12 </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="type_6_h" id="type_6_h" class="form-control">
                                                                <option value=""> اختر من النوع.... </option>
                                                                <option {{old("type_6_h")=="0"?"selected":""}} value="0"> مكافأت </option>
                                                                <option {{old("type_6_h")=="1"?"selected":""}} value="1"> خصومات </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="user_6_h" id="user_6_h" class="form-control">
                                                                <option value=""> اختر اسم المستخدم.... </option>
                                                                @foreach($users as $user)
                                                                    <option {{old("user_6_h")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
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



<div class="row">
    <div class="col">
          <h3 class="panel-title">الصافى : <span class="tag"><Strong id="total_6_safi_filter"></Strong></span> دينار</h3>
 </div>
  <div class="col">
       <h3 class="" style=""> مجموع الرواتب :<span class="tag">
        <strong id="tot3_filter"></strong> </span> دينار</h3>
 </div>
  <div class="col">
   <h3 class="panel-title">مجموع الخصومات:<span class="tag"><Strong id="total_6_receipt_filter"></Strong></span> دينار</h3>
 </div>
 </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-hover"  id="receipt-reward-table" style="width:100%">
                                       <thead>
                                                    <tr>
                                                        <th>الرقم الحاسوبي</th>
                                                        <th>الرقم الورقي</th>
                                                        <th>التاريخ</th>
                                                        <th>الموظف</th>
                                                        <th class="total_6_type_filter">النوع</th>
                                                        <th>السبب</th>
                                                        <th class="total_6_filter">المبلغ</th>
                                                        <th>من شهر</th>
                                                        <th>اسم المستخدم</th>
                                                        <th>تاريخ ووقت الادخال</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                    </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



@endcan

                            @cannot('عرض صرف مكافأة')
                                <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    ليس لديك صلاحية يرجي مراجعة المسؤول
                                </div>
                            @endcannot

</div>
<!-- /////////////////////////////////////////////////////-->


<div class="tab-pane" id="rWarranty">
@can('عرض صرف ضمان')
    <div class="row">
       <div class="col-8"></div>
        <div class="col-2"></div>
         @can('اضافة صرف ضمان')
            <div class="">
            <a href="/CMS/ReceiptWarranty/create" class="btn btn-primary btn-md">
            <i class="glyphicon glyphicon-plus">
            </i> إضافة سند صرف جديد </a>
            </div>
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
                           <table class="col-md-6 table table-bordered table-striped table-hover">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="employee_7_h" id="employee_7_h" class="form-control">
                                                                <option value=""> اختر اسم الموظف.... </option>
                                                                @foreach($employees as $employee)
                                                                    <option {{old("employee_7_h")==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="month_7_h" id="month_7_h" class="form-control">
                                                                <option value=""> اختر من الشهر.... </option>
                                                                <option {{old("month_7_h")=="01"?"selected":""}} value="01"> Jan - 01 </option>
                                                                <option {{old("month_7_h")=="02"?"selected":""}} value="02"> Fab - 02 </option>
                                                                <option {{old("month_7_h")=="03"?"selected":""}} value="03"> Mar - 03 </option>
                                                                <option {{old("month_7_h")=="04"?"selected":""}} value="04"> Apr - 04 </option>
                                                                <option {{old("month_7_h")=="05"?"selected":""}} value="05"> May - 05 </option>
                                                                <option {{old("month_7_h")=="06"?"selected":""}} value="06"> June - 06 </option>
                                                                <option {{old("month_7_h")=="07"?"selected":""}} value="07"> July - 07 </option>
                                                                <option {{old("month_7_h")=="08"?"selected":""}} value="08"> Aug - 08 </option>
                                                                <option {{old("month_7_h")=="09"?"selected":""}} value="09"> Sept - 09 </option>
                                                                <option {{old("month_7_h")=="10"?"selected":""}} value="10"> Oct - 10 </option>
                                                                <option {{old("month_7_h")=="11"?"selected":""}} value="11"> Nov - 11 </option>
                                                                <option {{old("month_7_h")=="12"?"selected":""}} value="12"> Dec - 12 </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="user_7_h" id="user_7_h" class="form-control">
                                                                <option value=""> اختر اسم المستخدم.... </option>
                                                                @foreach($users as $user)
                                                                    <option {{old("user_7_h")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
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
                            <h3 class="panel-title text-left">المجموع:<span class="tag"><Strong id="total_7_filter"></Strong></span> دينار</h3>
                            <br>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="table-responsive ls-table">
                                   <table class="table table-bordered table-striped table-hover"  id="receipt-warranty-table" style="width: 100%;">
                                                    <thead>
                                                    <tr>
                                                        <th>الرقم الحاسوبي</th>
                                                        <th>الرقم الورقي</th>
                                                        <th>التاريخ</th>
                                                        <th>الموظف</th>
                                                        <th>الشهر</th>
                                                        <th>الراتب</th>
                                                        <th class="total_7_filter">المبلغ</th>
                                                        <th>تاريخ ووقت الادخال</th>
                                                        <th>اسم المستخدم</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


 @endcan

                            @cannot('عرض صرف ضمان')
                                <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    ليس لديك صلاحية يرجي مراجعة المسؤول
                                </div>
                            @endcannot


</div>
<!-- /////////////////////////////////////////////////////-->


<div class="tab-pane" id="crBox">
@can('عرض قبض صندوق')
    <div class="row">
          <div class="col-8"></div>
        <div class="col-2"></div>
        @can('اضافة قبض صندوق')
            <div class="">
            <a href="/CMS/CatchReceiptBox/create" class="btn btn-primary btn-md">
            <i class="glyphicon glyphicon-plus">
            </i> إضافة سند قبض جديد </a>
            </div>
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
                                           <table class="col-md-6 table table-bordered table-striped table-hover">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="box_8_h" id="box_8_h" class="form-control">
                                                                <option value=""> اختر اسم الصندوق.... </option>
                                                                @foreach($boxes as $box)
                                                                    <option {{old("box_8_h")==$box->id?"selected":""}} value="{{$box->id}}"> {{$box->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="income_8_h" id="income_8_h" class="form-control">
                                                                <option value=""> اختر اسم الصندوق اولا.... </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="user_8_h" id="user_8_h" class="form-control">
                                                                <option value=""> اختر اسم المستخدم.... </option>
                                                                @foreach($users as $user)
                                                                    <option {{old("user_8_h")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table><br>
                                                <table class="table table-bordered table-striped table-hover">
                                                    <h5><strong>فرز بحسب تاريخ الطلب : </strong></h5>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <input onchange="$('#to_8_h').val(this.value);document.getElementById('to_8_h').min=this.value;"
                                                                   type="text" value="{{old("from_8_h")}}"
                                                                   class="form-control text-input datepicker1" id="from_8_h" name="from_8_h" placeholder="من....">
                                                        </td>
                                                        <td>
                                                            <input type="text" value="{{old("to_8_h")}}"
                                                                   class="form-control text-input datepicker1" id="to_8_h" name="to_8_h" placeholder="الي....">
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-primary" id="search_8_h" name="search_8_h">بحث</a>
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
                            <h3 class="panel-title text-left">المجموع: <span class="tag"><Strong id="total_8_filter"></Strong></span> دينار</h3>
                            <br>


                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="table-responsive ls-table">
                                <table class="table table-bordered table-striped table-hover"  id="catch-receipt-box-table" style="width: 100%;">
                                                    <thead>
                                                    <tr>
                                                        <th>الرقم الحاسوبي</th>
                                                        <th>الرقم الورقي</th>
                                                        <th>التاريخ</th>
                                                        <th>الصندوق الفرعي</th>
                                                        <th>تصنيف الايراد</th>
                                                        <th>اسم الزبون</th>
                                                        <th>العدد</th>
                                                        <th class="total_8_filter">المبلغ</th>
                                                        <th>تاريخ ووقت الادخال</th>
                                                        <th>اسم المستخدم</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


  @endcan

                            @cannot('عرض قبض صندوق')
                                <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    ليس لديك صلاحية يرجي مراجعة المسؤول
                                </div>
                            @endcannot

</div>
<!-- /////////////////////////////////////////////////////-->


<div class="tab-pane" id="rBox">
 @can('عرض  صرف صندوق')
    <div class="row">
        <div class="col-8"></div>
        <div class="col-2"></div>
       @can('اضافة صرف صندوق')
            <div class="">
            <a href="/CMS/ReceiptBox/create" class="btn btn-primary btn-md">
            <i class="glyphicon glyphicon-plus">
            </i> إضافة سند صرف جديد </a>
            </div>
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
                                         <table class="col-md-6 table table-bordered table-striped table-hover">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="box_9_h" id="box_9_h" class="form-control">
                                                                <option value=""> اختر اسم الصندوق.... </option>
                                                                @foreach($boxes as $box)
                                                                    <option {{old("box_9_h")==$box->id?"selected":""}} value="{{$box->id}}"> {{$box->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="expense_9_h" id="expense_9_h" class="form-control">
                                                                <option value=""> اختر اسم الصندوق اولا.... </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="user_9_h" id="user_9_h" class="form-control">
                                                                <option value=""> اختر اسم المستخدم.... </option>
                                                                @foreach($users as $user)
                                                                    <option {{old("user_9_h")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table><br>
                                                <table class="table table-bordered table-striped table-hover">
                                                    <h5><strong>فرز بحسب تاريخ الطلب : </strong></h5>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <input onchange="$('#to_9_h').val(this.value);document.getElementById('to_9_h').min=this.value;"
                                                                   type="text" value="{{old("from_9_h")}}"
                                                                   class="form-control text-input datepicker1" id="from_9_h" name="from_9_h" placeholder="من....">
                                                        </td>
                                                        <td>
                                                            <input type="text" value="{{old("to_9_h")}}"
                                                                   class="form-control text-input datepicker1" id="to_9_h" name="to_9_h" placeholder="الي....">
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-primary" id="search_9_h" name="search_9_h">بحث</a>
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
                            <h3 class="panel-title text-left">المجموع: <span class="tag"><Strong id="total_9_filter"></Strong></span> دينار</h3>
                            <br>


                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="table-responsive ls-table">
                                <table class="table table-bordered table-striped table-hover"  id="receipt-box-table" style="width: 100%;">
                                                    <thead>
                                                    <tr>
                                                        <th>الرقم الحاسوبي</th>
                                                        <th>الرقم الورقي</th>
                                                        <th>التاريخ</th>
                                                        <th>الصندوق الفرعي</th>
                                                        <th>تصنيف المصروف</th>
                                                        <th class="total_9_filter">المبلغ</th>
                                                        <th>تاريخ ووقت الادخال</th>
                                                        <th>اسم المستخدم</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


@endcan
@cannot('عرض  صرف صندوق')
<div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
ليس لديك صلاحية يرجي مراجعة المسؤول
</div>
@endcannot
</div>
</div>
				<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')


     <script>
        setTimeout(function() {
            var crTable = $('#catch-receipt-table').DataTable({
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

                },
                ajax: {
                    url: '/CMS/datatables/CatchReceipt',
                    data: function (d) {
                        d.searchCatchReceipt = $('#catch-receipt-table_filter input[type=search]').val();
                        d.studentId = $('select[name=student_1_h]').val();
                        d.courseId = $('select[name=course_1_h]').val();
                        d.userId = $('select[name=user_1_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                        d.fromId = $('#from_1_h').val();
                        d.toId = $('#to_1_h').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'id_comp', name: 'id_comp' },
                    { data: 'date', name: 'date' },
                    { data: 'studentAR', name: 'studentAR' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning showModal" id="CMS/CatchReceipt/'+row.id+'"  onclick="showModal(this)">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/CatchReceipt/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/CatchReceipt/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض قبض دورة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل قبض دورة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف قبض دورة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            //filtering
            $('#student_1_h').change(function() {
                crTable.draw();
            });
            $('#course_1_h').change(function() {
                crTable.draw();
            });
            $('#user_1_h').change(function() {
                crTable.draw();
            });
            $('#search_1_h').click(function(e) {
                e.preventDefault();
                crTable.draw();
            });
            $('#money_id').change(function() {
                crTable.draw();
            });
            crTable.on( 'xhr', function () {
                var json = crTable.ajax.json();
                    $('#total_1_filter').replaceWith('<strong id="total_1_filter">'+json.tot+'</strong>')
            });
        },200);

        setTimeout(function() {
            var crbTable = $('#catch-receipt-box-table').DataTable({
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
                    var json = crbTable.ajax.json();

                    $('#total_8_filter').replaceWith('<strong id="total_8_filter">'+json.tot+'</strong>')
                },
                ajax: {
                    url: '/CMS/datatables/CatchReceiptBox',
                    data: function (d) {
                        d.searchCatchReceiptBox = $('#catch-receipt-box-table_filter input[type=search]').val();
                        d.boxId = $('select[name=box_8_h]').val();
                        d.incomeId = $('select[name=income_8_h]').val();
                        d.userId = $('select[name=user_8_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                        d.fromId = $('#from_8_h').val();
                        d.toId = $('#to_8_h').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'id_comp', name: 'id_comp' },
                    { data: 'date', name: 'date' },
                    { data: 'box_id', name: 'box_id' },
                    { data: 'type', name: 'type' },
                    { data: 'customer', name: 'customer' },
                    { data: 'count', name: 'count' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/CatchReceiptBox/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/CatchReceiptBox/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/CatchReceiptBox/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض قبض صندوق')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل قبض صندوق')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف قبض صندوق')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            //filtering
            $('#box_8_h').change(function() {
                crbTable.draw();
            });
            $('#income_8_h').change(function() {
                crbTable.draw();
            });
            $('#user_8_h').change(function() {
                crbTable.draw();
            });
            $('#search_8_h').click(function(e) {
                e.preventDefault();
                crbTable.draw();
            });
            $('#money_id').change(function() {
                crbTable.draw();
            });
        },400);

        setTimeout(function() {
            var rcTable = $('#receipt-course-table').DataTable({
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
                   var json= rcTable.ajax.json();
                    $('#total_2_filter').replaceWith('<strong id="total_2_filter">'+json.tot+'</strong>')
                },
                ajax: {
                    url: '/CMS/datatables/ReceiptCourse',
                    data: function (d) {
                        d.searchReceiptCourse = $('#receipt-course-table_filter input[type=search]').val();
                        d.teacherId = $('select[name=teacher_2_h]').val();
                        d.courseId = $('select[name=course_2_h]').val();
                        d.userId = $('select[name=user_2_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                        d.fromId = $('#from_2_h').val();
                        d.toId = $('#to_2_h').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'id_comp', name: 'id_comp' },
                    { data: 'date', name: 'date' },
                    { data: 'teacher', name: 'teacher' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/ReceiptCourse/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/ReceiptCourse/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/ReceiptCourse/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض صرف دورة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل صرف دورة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف صرف دورة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            //filtering
            $('#teacher_2_h').change(function() {
                rcTable.draw();
            });
            $('#course_2_h').change(function() {
                rcTable.draw();
            });
            $('#user_2_h').change(function() {
                rcTable.draw();
            });
            $('#search_2_h').click(function(e) {
                e.preventDefault();
                rcTable.draw();
            });
            $('#money_id').change(function() {
                rcTable.draw();
            });
        },600);

        setTimeout(function() {
            var rsaTable = $('#receipt-salary-table').DataTable({
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

                },
                ajax: {
                    url: '/CMS/datatables/ReceiptSalary',
                    data: function (d) {
                        d.searchReceiptSalary = $('#receipt-salary-table_filter input[type=search]').val();
                        d.employeeId = $('select[name=employee_4_h]').val();
                        d.monthId = $('select[name=month_4_h]').val();
                        d.userId = $('select[name=user_4_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'id_comp', name: 'id_comp' },
                    { data: 'date', name: 'date' },
                    { data: 'employee_id', name: 'employee_id' },
                    { data: 'month', name: 'month' },
                    { data: 'advance_payment', name: 'advance_payment' },
                    { data: 'amount', name: 'amount' },
                    { data: 'total_amount', name: 'total_amount' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/ReceiptSalary/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/ReceiptSalary/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/ReceiptSalary/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض صرف راتب')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل صرف راتب')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف صرف راتب')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            //filtering
            $('#employee_4_h').change(function() {
                rsaTable.draw();
            });
            $('#month_4_h').change(function() {
                rsaTable.draw();
            });
            $('#user_4_h').change(function() {
                rsaTable.draw();
            });
            $('#money_id').change(function() {
                rsaTable.draw();
            });
            rsaTable.on( 'xhr', function () {
                var json = rsaTable.ajax.json();
                var all = parseInt(json.tot2) + parseInt(json.tot);
                $("#tot2_filter").replaceWith('<Strong id="tot2_filter">'+json.tot2+'</Strong>');
                $("#tot3_filter").replaceWith('<Strong id="tot3_filter">'+json.tot+'</Strong>');
                $("#total_4_filter").replaceWith('<Strong id="total_4_filter">'+all+'</Strong>');
            });
        },1000);

        setTimeout(function() {
            var rrTable = $('#receipt-reward-table').DataTable({
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
                ajax: {
                    url: '/CMS/datatables/ReceiptReward',
                    data: function (d) {
                        d.searchReceiptReward = $('#receipt-reward-table_filter input[type=search]').val();
                        d.employeeId = $('select[name=employee_6_h]').val();
                        d.monthId = $('select[name=month_6_h]').val();
                        d.typeId = $('select[name=type_6_h]').val();
                        d.userId = $('select[name=user_6_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'id_comp', name: 'id_comp' },
                    { data: 'date', name: 'date' },
                    { data: 'employee_id', name: 'employee_id' },
                    { data: 'type', name: 'type' },
                    { data: 'reason', name: 'reason' },
                    { data: 'amount', name: 'amount' },
                    { data: 'receipts_rewards', name: 'receipts_rewards' },
                    { data: 'created_by', name: 'created_by' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/ReceiptReward/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/ReceiptReward/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/ReceiptReward/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض صرف مكافأة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل صرف مكافأة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف صرف مكافأة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            //filtering
            $('#employee_6_h').change(function() {
                rrTable.draw();
            });
            $('#month_6_h').change(function() {
                rrTable.draw();
            });
            $('#type_6_h').change(function() {
                rrTable.draw();
            });
            $('#user_6_h').change(function() {
                rrTable.draw();
            });
            $('#money_id').change(function() {
                rrTable.draw();
            });
             rrTable.on( 'xhr', function () {
                var json = rrTable.ajax.json();
                $("#total_6_receipt_filter").replaceWith('<Strong id="total_6_receipt_filter">'+json.deductions+'</Strong>');
                $("#total_6_reward_filter").replaceWith('<Strong id="total_6_reward_filter">'+json.rewards+'</Strong>');
                var rewards=json.rewards.replace(',','');
                var deductions=json.deductions.replace(',','');
                        var safi = parseFloat(rewards) - parseFloat(deductions);
                        $("#total_6_safi_filter").replaceWith('<Strong id="total_6_safi_filter">'+safi.toFixed(2)+'</Strong>');
            });
        },1200);

        setTimeout(function() {
            var rwTable = $('#receipt-warranty-table').DataTable({
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
                    var json = rwTable.ajax.json();
                    $('#total_7_filter').replaceWith('<strong id="total_7_filter">'+json.tot+'</strong>')
                },
                ajax: {
                    url: '/CMS/datatables/ReceiptWarranty',
                    data: function (d) {
                        d.searchReceiptWarranty = $('#receipt-warranty-table_filter input[type=search]').val();
                        d.employeeId = $('select[name=employee_7_h]').val();
                        d.monthId = $('select[name=month_7_h]').val();
                        d.userId = $('select[name=user_7_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'id_comp', name: 'id_comp' },
                    { data: 'date', name: 'date' },
                    { data: 'employee_id', name: 'employee_id' },
                    { data: 'month', name: 'month' },
                    { data: 'salary_id', name: 'salary_id' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                             var show ='<a class="btn btn-sm btn-success" href="/CMS/ReceiptWarranty/'+row.id+'">عرض</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/ReceiptWarranty/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض صرف ضمان')
                                ress=ress+' '+show;
                            @endcan
                                    @can('حذف صرف ضمان')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            //filtering
            $('#employee_7_h').change(function() {
                rwTable.draw();
            });
            $('#month_7_h').change(function() {
                rwTable.draw();
            });
            $('#user_7_h').change(function() {
                rwTable.draw();
            });
            $('#money_id').change(function() {
                rwTable.draw();
            });
        },1400);

        setTimeout(function() {
            var raTable = $('#receipt-advance-table').DataTable({
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
                    var total_5_filter = this.api().column('.total_5_filter').data().sum();
                    $('#total_5_filter').replaceWith('<strong id="total_5_filter">'+total_5_filter+'</strong>')
                },
                ajax: {
                    url: '/CMS/datatables/ReceiptAdvance',
                    data: function (d) {
                        d.searchReceiptAdvance = $('#receipt-advance-table_filter input[type=search]').val();
                        d.employeeId = $('select[name=employee_5_h]').val();
                        d.userId = $('select[name=user_5_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'id_comp', name: 'id_comp' },
                    { data: 'date', name: 'date' },
                    { data: 'employee_id', name: 'employee_id' },
                    { data: 'advance_payment', name: 'advance_payment' },
                    { data: 'month_count', name: 'month_count' },
                    { data: 'month_payment', name: 'month_payment' },
                    { data: 'start_payment', name: 'start_payment' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                           var show ='<a class="btn btn-sm btn-success" href="/CMS/ReceiptAdvance/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/ReceiptAdvance/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/ReceiptAdvance/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض صرف سلفة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل صرف سلفة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف صرف سلفة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            //filtering
            $('#employee_5_h').change(function() {
                raTable.draw();
            });
            $('#user_5_h').change(function() {
                raTable.draw();
            });
            $('#money_id').change(function() {
                raTable.draw();
            });
        },1600);

        setTimeout(function() {
            var rbTable = $('#receipt-box-table').DataTable({
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
                    var json= rbTable.ajax.json();
                    $('#total_9_filter').replaceWith('<strong id="total_9_filter">'+json.tot+'</strong>')
                },
                ajax: {
                    url: '/CMS/datatables/ReceiptBox',
                    data: function (d) {
                        d.searchReceiptBox = $('#receipt-box-table_filter input[type=search]').val();
                        d.boxId = $('select[name=box_9_h]').val();
                        d.expenseId = $('select[name=expense_9_h]').val();
                        d.userId = $('select[name=user_9_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                        d.fromId = $('#from_9_h').val();
                        d.toId = $('#to_9_h').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'id_comp', name: 'id_comp' },
                    { data: 'date', name: 'date' },
                    { data: 'box_id', name: 'box_id' },
                    { data: 'type', name: 'type' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                             var show ='<a class="btn btn-sm btn-warning" href="/CMS/ReceiptBox/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/ReceiptBox/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/ReceiptBox/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض  صرف صندوق')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل  صرف صندوق')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف  صرف صندوق')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            //filtering
            $('#box_9_h').change(function() {
                rbTable.draw();
            });
            $('#expense_9_h').change(function() {
                rbTable.draw();
            });
            $('#user_9_h').change(function() {
                rbTable.draw();
            });
            $('#search_9_h').click(function(e) {
                e.preventDefault();
                rbTable.draw();
            });
            $('#money_id').change(function() {
                rbTable.draw();
            });
        },1800);

        jQuery(document).ready(function($){
            $('#box_8_h').change(function(){
                var id=$(this).val();
                $.get("/CMS/IncomeBox/" + id,
                    function(data) {
                        var model = $('#income_8_h');
                        model.empty();

                        model.append("<option value=''>اختر نوع الايراد ....</option>");

                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                        });
                    });
            });
            $('#box_9_h').change(function(){
                var id=$(this).val();
                $.get("/CMS/ExpenseBox/" + id,
                    function(data) {
                        var model = $('#expense_9_h');
                        model.empty();

                        model.append("<option value=''>اختر نوع المصروف ....</option>");

                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                        });
                    });
            });
            $('#student_1_h').change(function(){
                var id=$(this).val();
                $.get("/CMS/SCourse/" + id,
                    function(data) {
                        var model = $('#course_1_h');
                        model.empty();

                        model.append("<option value=''>اختر اسم الدورة ....</option>");

                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.courseAR + "</option>");
                        });
                    });
            });
            $('#teacher_2_h').change(function(){
                var id=$(this).val();
                $.get("/CMS/TCourse/" + id,
                    function(data) {
                        var model = $('#course_2_h');
                        model.empty();

                        model.append("<option value=''>اختر اسم الدورة ....</option>");

                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.courseAR + "</option>");
                        });
                    });
            });
        });
        window.onload = function() {
            if ($('#box_8_h').val()){
                var id=$('#box_8_h').val();
                $.get("/CMS/IncomeBox/" + id,
                    function(data) {
                        var model = $('#income_8_h');
                        model.empty();

                        $.each(data, function(index, element) {
                            <?php $m = "element.id;"?>
                            model.append("<option value='"+ element.id +"' {{old('income_8_h')==$m ?'selected':''}}>" + element.name + "</option>");
                        });
                    });
            }
            if ($('#box_9_h').val()){
                var id=$('#box_9_h').val();
                $.get("/CMS/ExpenseBox/" + id,
                    function(data) {
                        var model = $('#expense_9_h');
                        model.empty();

                        $.each(data, function(index, element) {
                            <?php $m = "element.id;"?>
                            model.append("<option value='"+ element.id +"' {{old('expense_9_h')==$m ?'selected':''}}>" + element.name + "</option>");
                        });
                    });
            }
            if ($('#student_1_h').val()){
                var id=$('#student_1_h').val();
                $.get("/CMS/SCourse/" + id,
                    function(data) {
                        var model = $('#course_1_h');
                        model.empty();

                        $.each(data, function(index, element) {
                            <?php $m = "element.course_id;"?>
                            model.append("<option value='"+ element.course_id +"' {{old('course_1_h')==$m ?'selected':''}}>" + element.course_id + "</option>");
                        });
                    });
            }
            if ($('#teacher_2_h').val()){
                var id=$('#teacher_2_h').val();
                $.get("/CMS/TCourse/" + id,
                    function(data) {
                        var model = $('#course_2_h');
                        model.empty();

                        $.each(data, function(index, element) {
                            <?php $m = "element.id;"?>
                            model.append("<option value='"+ element.id +"' {{old('course_2_h')==$m ?'selected':''}}>" + element.courseAR + "</option>");
                        });
                    });
            }
        };
        $(function() {
            $(".datepicker1").datepicker(
                {
                    dateFormat: 'yy-mm-dd'
                });
            $(".datepicker1").val('');
        });
        $(document).ready(function(){
            var url      = window.location.href;
            var tabs = url.split('#');
            var href = tabs[1];

           $('#myTabs a[href="#'+href+'"]').tab('show');


});
function showModal(selectID) {

            var id = selectID.id;
            $.ajax({
            url: "{{url('/')}}" + "/" + id,
            type: "GET",
            success: function (data) {

                $(".modal-body").html(data.html);
                $('#favoritesModal').modal();
            },
            error: function () {
                alert("Error, Unable to bring up the creation dialog.");
            }
        })


        }

    </script>
@endsection
