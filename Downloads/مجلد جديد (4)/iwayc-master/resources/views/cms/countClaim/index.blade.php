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
@can('عرض مطالبة')
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
                                    <select name="student_h" id="student_h" class="form-control">
                                        <option value=""> اختر اسم الطالب.... </option>
                                        @foreach($students as $st)
                                            <option {{old("student_h")==$st->id?"selected":""}} value="{{$st->id}}"> {{$st->nameAR}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="course_h" id="course_h" class="form-control">
                                        <option value=""> اختر اسم الدورة.... </option>
                                        @foreach($courses as $course)
                                            <option {{old("course_h")==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->courseAR}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="user_h" id="user_h" class="form-control">
                                        <option value=""> اختر اسم المستخدم.... </option>
                                        @foreach($users as $user)
                                            <option {{old("user_h")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}} </option>
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
<br><br>



		<!-- row -->
				<div class="row">
                			<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
                            <h3>سجل رصد المطالبات</h3>
								<div class="d-flex justify-content-between">

							</div>
							<div class="card-body">
								<div class="table-responsive ls-table">
									<table id="users-table" class="table table-bordered table-striped table-hover">
                  <thead>
                            <tr>
                                <th></th>
                                <th>اسم الطالب</th>
                                <th>اسم الدورة</th>
                                <th>طريقة المطالبة</th>
                                <th>التاريخ والوقت</th>
                                <th>اسم المُبلغ</th>
                                <th>ملاحظة</th>
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

    @cannot('عرض مطالبة')
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
            var cTable = $('#users-table').DataTable({
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
                    url: '/CMS/datatables/CountClaim',
                    data: function (d) {
                        d.searchCountClaim = $('#users-table_filter input[type=search]').val();
                        d.studentId = $('select[name=student_h]').val();
                        d.userId = $('select[name=user_h]').val();
                        d.courseId = $('select[name=course_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },drawCallback: function () {
                   var json= cTable.ajax.json();
                    $('#count_claims').replaceWith('<strong id="count_claims">'+json.tot+'</strong>');
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nameAR', name: 'nameAR' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'how_claim', name: 'how_claim' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'created_by', name: 'created_by' },
                    { data: 'notes', name: 'notes' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/CountClaim/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/CountClaim/'+row.id+'/edit">تعديل</a>';
                            var ress ='';
                            @can('عرض مطالبة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل مطالبة')
                                ress=ress+' '+edit;
                            @endcan
                            return ress;}
                    }
                ]
            });
            //filtering
            $('#student_h').change(function() {
                cTable.draw();
            });
            $('#user_h').change(function() {
                cTable.draw();
            });
            $('#course_h').change(function() {
                cTable.draw();
            });
            $('#money_id').change(function() {
                cTable.draw();
            });
        });
        //Activation function
        /*function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Course/active/" + id,
                complete: function (data) {
                    if (data.status==200){
                        alert('تمت العملية بنجاح')
                    }
                    else{alert('حدث خطأ اثناء تنفيذ العملية')}
                }
            })
        }*/
    </script>
@endsection
