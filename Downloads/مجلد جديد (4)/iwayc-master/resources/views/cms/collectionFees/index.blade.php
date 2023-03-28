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
 @can('عرض متابعة طلاب')
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
                                        @foreach($students as $student)
                                            <option {{old("student_h")==$student->id?"selected":""}} value="{{$student->id}}"> {{$student->nameAR}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="course_h" id="course_h" class="form-control">
                                        <option value=""> اختر اسم الدورة.... </option>
                                        @foreach($courses as $course)
                                            <option {{old("course_h")==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->courseAR}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="warranty_h" id="warranty_h" class="form-control">
                                        <option value=""> اختر حالة الضمان.... </option>
                                        <option {{old("warranty_h")=='0'?"selected":""}} value="0"> لا </option>
                                        <option {{old("warranty_h")=='1'?"selected":""}} value="1"> نعم </option>
                                    </select>
                                </td>
                                <td>
                                    <select name="status_h" id="status_h" class="form-control">
                                        <option value=""> اختر حالة التهرب.... </option>
                                        <option {{old("status_h")=='0'?"selected":""}} value="0"> لا </option>
                                        <option {{old("status_h")=='1'?"selected":""}} value="1"> نعم </option>
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
								<div class="d-flex justify-content-between">

							</div>
							<div class="card-body">
								<div class="table-responsive ls-table">
									<table id="users-table" class="table table-bordered table-striped table-hover">
                   <thead>
                            <tr>
                                <th width="6%"></th>
                                <th width="10%">اسم الدورة</th>
                                <th width="10%">اسم الطالب</th>
                                <th width="10%">الهواتف</th>
                                <th width="6%">الرسوم</th>
                                <th width="6%">المدفوع</th>
                                <th class="fees_owed" width="6%">المستحق</th>
                                <th width="6%">الضمان</th>
                                <th width="6%">مرات المطالبة</th>
                                <th width="6%">مطالبة</th>
                                <th width="6%">التهرب</th>
                                <th width="6%">تحويل قانوني</th>
                                <th width="10%">ملاحظات</th>
                                <th width="6%"></th>
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

    @cannot('عرض متابعة طلاب')
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
                drawCallback: function () {
                    var json = cTable.ajax.json();
                    $('#sumId').replaceWith('<strong id="sumId">'+json.total_fees_owed+'</strong>')
                },
                ajax: {
                    url: '/CMS/datatables/CollectionFees',
                    data: function (d) {
                        d.searchCollectionFees = $('#users-table_filter input[type=search]').val();
                        d.studentId = $('select[name=student_h]').val();
                        d.courseId = $('select[name=course_h]').val();
                        d.warrantyId = $('select[name=warranty_h]').val();
                        d.statusId = $('select[name=status_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'nameAR', name: 'nameAR' },
                    { data: 'phone', name: 'phone' },
                    { data: 'fees', name: 'fees' },
                    { data: 'fees_pay', name: 'fees_pay' },
                    { data: 'fees_owed', name: 'fees_owed' },
                    {"mRender": function ( data, type, row ) {
                            var cbAct = '<input type="checkbox" value="0" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" />';
                            if(row.warranty==1){
                                cbAct = '<input type="checkbox" value="1" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" checked />';
                            }
                            return cbAct;
                        }
                        ,orderable: false},
                    { data: 'count', name: 'count' },
                    {"mRender": function ( data, type, row ) {
                            var cc='';
                        @can('اضافة مطالبة')
                            cc = '<a disabled class="btn btn-sm btn-primary" href="/CMS/add/CountClaim/'+row.id+'"><i class="fa fa-plus"></i></a>';
                            if (row.hour12>0) {
                                cc = '<a class="btn btn-sm btn-primary" href="/CMS/add/CountClaim/'+row.id+'"><i class="fa fa-plus"></i></a>';
                            }
                        @endcan
                        return cc;}
                    },
                    { data: 'evasion', name: 'evasion' },
                    {"mRender": function ( data, type, row ) {
                            var ss ='';
                        @can('اضافة شؤون قانونية')
                        ss = '<a disabled class="btn btn-sm btn-primary" href="/CMS/add/LegalAffairs/'+row.id+'"><i class="fa fa-check"></i></a>';
                        if (row.count>0) {
                            ss = '<a class="btn btn-sm btn-primary" href="/CMS/add/LegalAffairs/'+row.id+'"><i class="fa fa-check"></i></a>';
                        }
                        @endcan
                        return ss;}
                    },
                    { data: 'notes', name: 'notes' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/CollectionFees/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/CollectionFees/'+row.id+'/edit">تعديل</a>';
                            var ress ='';
                            @can('عرض متابعة طلاب')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل متابعة طلاب')
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
            $('#course_h').change(function() {
                cTable.draw();
            });
            $('#warranty_h').change(function() {
                cTable.draw();
            });
            $('#status_h').change(function() {
                cTable.draw();
            });
            $('#money_id').change(function() {
                cTable.draw();
                fSum($('#money_id').val());
            });
        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/CollectionFees/active/" + id,
                complete: function (data) {
                     if (data.status==200){
                         not7();
                    }
                    else{not8()}
                }
            })
        }
    </script>
@endsection
