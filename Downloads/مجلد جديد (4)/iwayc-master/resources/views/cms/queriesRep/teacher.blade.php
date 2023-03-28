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
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    <select name="teacher_s" id="teacher_s" class="form-control">
                                        <option value="">ااختر اسم المعلم.... </option>
                                        @foreach($teachers as $teacher)
                                            <option {{old("teacher_s")==$teacher->id?"selected":""}} value="{{$teacher->id}}"> {{$teacher->name}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                     <select name="year_h" id="year_h" class="form-control">

                                    <option value=""> اختر العام الدراسي.... </option>
                                    @foreach($years as $y)
                                        <option {{old("year_h")==$y->year?"selected":""}} value="{{$y->year}}">{{$y->year}}</option>
                                    @endforeach
                                </select>

                         </div>

                        </div>


                    </div>

                    <div class="row ls_divider col-md-12">
                        <div class="col-md-4 control-label">عدد المسجلين : <span class="tag"><strong id="all_registered"></strong></span></div>
                        <div class="col-md-4 control-label">عدد المنسحبين : <span class="tag"><strong id="all_withdrawn"></strong></span></div>
                        <div class="col-md-4 control-label"> عدد الخريجين :
                        <span class="tag"><strong id="all_graduate"></strong></span></div>
                    </div><br/>
                   <div class="row ls_divider col-md-12">
                        <div class="col-md-4 control-label" style="color:#d43f3a;">التقييم العام : <span class="tag"><strong id="ratios"></strong></span></div>
                        </div>
                        <br/>

                </div>
            </div>
        </div>

<br><br>


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
                                                <th>العام</th>
                                                <th>المعلم</th>
                                                <th>الدورة</th>
                                                <th>المسجلين</th>
                                                <th>المنسحبين</th>
                                                <th style="color:#d43f3a;">التقييم</th>
                                            <th>ملاحظات</th>
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
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection

@section('js')
    <script>

        $(function() {
            var qTable = $('#users-table').DataTable({
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
                pageLength: 12,
                lengthChange: false,
                ajax: {
                    url: '/CMS/datatables/QueryTeacher',
                    data: function (d) {
                        d.searchCourse = $('#users-table_filter input[type=search]').val();
                        d.teacherId = $('select[name=teacher_s]').val();
                        d.moneyId = $('select[name=money_id]').val();
                        d.yearId = $('select[name=year_h]').val();
                    }
                },
                columns: [
                    { data: 'm_year', name: 'm_year'},
                    { data: 'teacher_id', name: 'teacher_id' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'total_reg_student', name: 'total_reg_student' },
                    { data: 'total_withdrawn_student', name: 'total_withdrawn_student' },
                    { data: 'ratio', name: 'ratio',class: 'rcolored' },
                    { data: 'ratio_notes', name: 'ratio_notes' }
                ]
            });
            $('#teacher_s').change(function() {
                qTable.draw();
            });
            $('#year_h').change(function() {
                qTable.draw();
            });
            qTable.on( 'xhr', function () {
                var json = qTable.ajax.json();
                $("#ratios").replaceWith('<Strong id="ratios">'+json.ratios+'</Strong>');
                $("#all_registered").replaceWith('<Strong id="all_registered">'+json.all_registered+'</Strong>');
                $("#all_withdrawn").replaceWith('<Strong id="all_withdrawn">'+json.all_withdrawn+'</Strong>');
                $("#all_graduate").replaceWith('<Strong id="all_graduate">'+json.all_graduate+'</Strong>');


            });
        });
    </script>
    <style>
       .rcolored{
           color: #d43f3a !important;
       }
    </style>

@endsection
