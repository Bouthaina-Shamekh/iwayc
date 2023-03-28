@extends('layouts.master')
@section('css')

@section('title')
Iwayc System

@endsection

@section('title-page-header')
{{ $title }}

@endsection
@section('page-header')
الدورات المنتهيه
@endsection
@section('button1')
<a class="btn btn-primary btn-md" href="{{ route('EnglishReg.index') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>تسجيل دوره</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
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
                                        <option value=""> اختر المستوى الحالي.... </option>
                                        @foreach($levels as $level)
                                            <option {{old("level_h")==$level->id?"selected":""}} value="{{$level->id}}"> {{$level->title}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="level_up_h" id="level_up_h" class="form-control">
                                        <option value=""> اختر مؤهل لمستوى.... </option>
                                        @foreach($levels as $level)
                                            <option {{old("level_up_h")==$level->id?"selected":""}} value="{{$level->id}}"> {{$level->title}} </option>
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
									<table id="student-courses-table" class="table key-buttons text-md-nowrap">

										<thead>
									    <tr>
                                        <th>تاريخ التسجيل</th>
                                        <th>اسم الطالب</th>
                                        <th>سنة الميلاد</th>
                                        <th>الهاتف</th>
                                        <th>المستوى المنتهي</th>
                                        <th>الحالة</th>
                                        <th>المستخدم</th>
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
                   ],language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/EnglishRegEnd',
                    data: function (d) {
                        d.searchEnglishReg = $('#student-courses-table_filter input[type=search]').val();
                        d.studentId = $('select[name=student_h]').val();
                        d.levelId = $('select[name=level_h]').val();
                        d.StatusId = $('select[name=status_h]').val();
                    }
                },
                columns: [
                    { data: 'created_at', name: 'created_at',orderable: true },
                    { data: 'student_name', name: 'student_name',orderable: true },
                    { data: 'year', name: 'year',orderable: true },
                    { data: 'phone', name: 'phone',orderable: true },
                    { data: 'level_id', name: 'level_id',orderable: true },
                    { data: 'status', name: 'status',orderable: true },
                    { data: 'created_by', name: 'created_by',orderable: true }
                ]
            });
            //filtering
            $('#student_h').change(function() {
                sTable.draw();
            });
            $('#level_h').change(function() {
                sTable.draw();
            });
            $('#status_h').change(function() {
                sTable.draw();
            });
        });
    </script>
@endsection
