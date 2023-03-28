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
@can('إضافة اختبار مستوى جديد ')
<a class="btn btn-primary btn-md" href="{{ route('english.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>  إضافة اختبار مستوى جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض  تسجيل انجليزي')


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
										<li>
											<a href="#home" class="active" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">الدورات المتاحة</span> </a>
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

                                    <div class="panel-body">
                                        <!--Table Wrapper Start-->
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-hover"  id="courses-table">
                                                <thead>
                                                    <tr>
                                                        <th>المستويات المتاحة</th>
                                                        <th class="sum1">عدد المسجلين</th>
                                                        <th class="sum2">عدد الناجحين</th>
                                                        <th class="sum3">عدد غير المكملين</th>
                                                        <th class="sum4" style="color: #d43f3a;">عدد المسجلين الان</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>المجموع</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>

                                                    </tr>
                                                </tfoot>
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
                                            @foreach($students as $student)
                                            <option {{old("student_h")==$student->id?"selected":""}} value="{{$student->id}}"> {{$student->student_name}} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="level_h" id="level_h" class="form-control">
                                            <option value=""> اختر المستوى.... </option>
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
                                                        <th>تاريخ التسجيل</th>
                                                        <th>اسم الطالب</th>
                                                        <th>سنة الميلاد</th>
                                                        <th>الهاتف</th>
                                                        <th>المستوى المسجل الان</th>
                                                        <th>الحالة</th>
                                                        <th>المستخدم</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan

                            @cannot('عرض  تسجيل انجليزي')
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

    $(function () {
        var cTable = $('#courses-table').DataTable({
                    dom: 'Bfrtip',
                    order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                searching: false,
                   paginate:true,
                 pageLength: 10,
                lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            buttons: [
                {'extend': 'excel', 'text': 'أكسيل'},
                {'extend': 'print', 'text': 'طباعة'},
                {'extend': 'pdf', 'text': 'pdf','exportOptions': {'orthogonal': "PDF"},customize: function ( doc ) {processDoc(doc); //fun in app.js
                    }},
                {'extend': 'pageLength', 'text': 'حجم العرض'},
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
                url: '/CMS/datatables/EnglishLevel'
            },
            columns: [
                {data: 'title', name: 'title', orderable: true},
                {data: 'reg', name: 'reg', orderable: true},
                {data: 'pass', name: 'pass', orderable: true},
                {data: 'with', name: 'with', orderable: true},
                {data: 'regNow', name: 'regNow', class: 'scolor', orderable: true},
                {"mRender": function (data, type, row) {
                        var add = '<a class="btn btn-sm btn-success" href="/CMS/add/EnglishReg/' + row.id + '">تسجيل</a>'
                        var ress = '';


                                ress = ress + ' ' + add;

                                return ress;
                    }
                    , orderable: false}
            ],
            "initComplete": function (settings, json) {
this.api().columns('.sum1').every(function () {
var column = this;
var sum1 = column
.data()
.reduce(function (a, b) {
return parseInt(a, 10) + parseInt(b, 10);
});
$(column.footer()).html(sum1);
});
this.api().columns('.sum2').every(function () {
var column = this;
var sum2 = column
.data()
.reduce(function (a, b) {
return parseInt(a, 10) + parseInt(b, 10);
});
$(column.footer()).html(sum2);
});
this.api().columns('.sum3').every(function () {
var column = this;
var sum3 = column
.data()
.reduce(function (a, b) {
return parseInt(a, 10) + parseInt(b, 10);
});
$(column.footer()).html(sum3);
});
this.api().columns('.sum4').every(function () {
var column = this;
var sum4 = column
.data()
.reduce(function (a, b) {
return parseInt(a, 10) + parseInt(b, 10);
});
$(column.footer()).html(sum4);
});
}

        });

    });
    $(function () {
        var sTable = $('#student-courses-table').DataTable({
        processing: true,
                serverSide: true,

                language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                   },
                ajax: {
                url: '/CMS/datatables/EnglishReg',
                        data: function (d) {
                            d.searchEnglishReg = $('#student-courses-table_filter input[type=search]').val();
                            d.studentId = $('select[name=student_h]').val();
                            d.levelId = $('select[name=level_h]').val();
                        }
                },
                columns: [
                { data: 'created_at', name: 'created_at', orderable: true },
                { data: 'student_name', name: 'student_name', orderable: true },
                { data: 'year', name: 'year', orderable: true },
                { data: 'phone', name: 'phone', orderable: true },
                { data: 'level_id', name: 'level_id', orderable: true },
                { data: 'status', name: 'status', orderable: true },
                { data: 'created_by', name: 'created_by', orderable: true },
                {"mRender": function (data, type, row) {
                    var ress = '';
                    var pass = '<a class="btn btn-sm btn-success" href="/CMS/add/LevelUp/' + row.id + '">ناجح</a>';
                    var withdraw = '<a class="btn btn-sm btn-warning Confirm" href="/CMS/withdrawal/EnglishReg/' + row.id + '">انسحاب</a>';
                    var deleted = '<a class="btn btn-sm btn-danger Confirm" href="/CMS/delete/EnglishReg/' + row.id + '">حذف</a>';
                    if (row.ispass == 1 || row.iswithdrawal == 1 || row.isdelete == 1) {
                    pass = '<a disabled class="btn btn-sm btn-success" href="/CMS/add/LevelUp/' + row.id + '">ناجح</a>';
                            withdraw = '<a disabled class="btn btn-sm btn-warning Confirm" href="/CMS/withdrawal/EnglishReg/' + row.id + '">انسحاب</a>';
                            deleted = '<a disabled class="btn btn-sm btn-danger Confirm" href="/CMS/delete/EnglishReg/' + row.id + '">حذف</a>';
                    }
                  ('اضافة نجاح انجليزي')
                            ress = ress + ' ' + pass;

                    ('انسحاب تسجيل انجليزي')
                            ress = ress;

                   ('حذف تسجيل انجليزي')
                            ress = ress + ' ' + deleted;

                            return ress + ' ' + withdraw;
                    }
                    , orderable: false}
                    ]
        });
                //filtering
                $('#student_h').change(function () {
            sTable.draw();
        });
        $('#level_h').change(function () {
            sTable.draw();
        });
    });

</script>
<style>
    .scolor{
        color: #d43f3a !important;
    }
</style>
@endsection
