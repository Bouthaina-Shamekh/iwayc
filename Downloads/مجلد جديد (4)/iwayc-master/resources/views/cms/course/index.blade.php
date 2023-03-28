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
@can('اضافة دورة')
<a class="btn btn-primary btn-md" href="{{ route('Course.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة دورة جديدة </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض دورة')


<div class="modal fade" id="favoritesModal"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

    <div class="modal-header">
	<h6 class="modal-title">تقييم المعلم</h6>
    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
    <span aria-hidden="true">&times;</span></button>
	</div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button"class="btn btn-default"data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
    <br>
    <br>
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
                                    <select name="teacher_h" id="teacher_h" class="form-control">
                                        <option value=""> اختر اسم المعلم.... </option>
                                        @foreach($teachers as $teacher)
                                            <option {{old("teacher_h")==$teacher->id?"selected":""}} value="{{$teacher->id}}"> {{$teacher->name}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="active_h" id="active_h" class="form-control">
                                        <option value=""> اختر الفعالية.... </option>
                                        <option {{old("active_h")=='1'?"selected":""}} value="1"> فعال </option>
                                        <option {{old("active_h")=='0'?"selected":""}} value="0"> غير فعال </option>
                                    </select>
                                </td>
                              </tr>
                            </tbody>
                    <tbody>
                    <div class="row ls_divider col-md-12">
                        <div class="col-md-4 control-label">عدد المسجلين : <strong id="all_registered"></strong></div>
                        <div class="col-md-4 control-label">عدد المنسحبين : (<strong id="all_withdrawn"></strong>)</div>
                        <div class="col-md-4 control-label"> عدد الخريجين :
                        (<strong id="all_graduate"></strong>)</div>
                    </div>
                    <div class="row ls_divider col-md-12">
                        <div class="control-label">متوسط تقييم المعلمين : <strong id="ratios"></strong>
                        </div>
                    </div>
                        <br/>
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
                                                <th></th>
                                                <th>اسم الدورة</th>
                                                <th>مدة الدورة</th>
                                                <th>اسم المعلم</th>
                                                <th>عدد المسجلين</th>
                                                <th>عدد المنسحبين</th>
                                                <th>تقييم المعلم</th>
                                                <th>الحالة</th>
                                                <th>تاريخ الطلب</th>
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



				<!-- row closed -->
                @endcan

                @cannot('عرض دورة')
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

<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

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
                    url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/Course',
                    data: function (d) {
                        d.searchCourse = $('#users-table_filter input[type=search]').val();
                        d.teacherId = $('select[name=teacher_h]').val();
                        d.activeId = $('select[name=active_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'course_time', name: 'course_time' },
                    { data: 'teacher_id', name: 'teacher_id' },
                    { data: 'total_reg_student', name: 'total_reg_student',width: '1px' },
                    { data: 'total_withdrawn_student', name: 'total_withdrawn_student',width: '1px' },
                   /* { data: 'ratio', name: 'ratio' },*/
                    {"mRender": function ( data, type, row ) {
                              var  bOut ='<a class="btn btn-sm btn-primary showModal" id="'+row.id+'" onclick="showModal(this)">تقيم </a> ' + row.ratio;


                            return bOut; }
                    },
                    {"mRender": function ( data, type, row ) {
                            var cbAct = '<input type="checkbox" value="0" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" />';
                            if(row.activeI==1){
                                cbAct = '<input type="checkbox" value="1" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" checked />';
                            }
                            return cbAct;
                        }
                        ,orderable: false},
                    { data: 'created_at', name: 'created_at',width: '100px' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/Course/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Course/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Course/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض دورة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل دورة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف دورة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                   ,width: '100px' }
                ]
            });
            //filtering
            $('#teacher_h').change(function() {
                cTable.draw();
            });
            $('#active_h').change(function() {
                cTable.draw();
            });
            $('#money_id').change(function() {
                cTable.draw();
            });
            cTable.on( 'xhr', function () {
                var json = cTable.ajax.json();
                $("#ratios").replaceWith('<Strong id="ratios">'+json.ratios+'</Strong>');
                $("#all_registered").replaceWith('<Strong id="all_registered">'+json.all_registered+'</Strong>');
                $("#all_withdrawn").replaceWith('<Strong id="all_withdrawn">'+json.all_withdrawn+'</Strong>');
                $("#all_graduate").replaceWith('<Strong id="all_graduate">'+json.all_graduate+'</Strong>');


            });
        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Course/active/" + id,
                complete: function (data) {
                     if (data.status==200){
                         not7();
                    }
                    else{not8()}
                }
            })
        }
        function showModal(selectID) {

            var id = selectID.id;
            $.ajax({
            url: "{{url('/CMS/Course/tratio')}}" + "/" + id,
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
