@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">


<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">

<!--Internal  Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
<!--Internal  treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css" />
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
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
@can('عرض نجاح انجليزي')
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
									<table id="users-table" class="table key-buttons text-md-nowrap">

										<thead>
									       <tr>
                                            <th>التاريخ</th>
                                            <th>اسم الطالب</th>
                                            <th>المستوى الحالي</th>
                                            <th>العلامة النهائية</th>
                                            <th>مؤهل للمستوى</th>
                                            <th>اسم المستخدم</th>
                                            <th>التاريخ والوقت للأدخال</th>
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

                @cannot('عرض نجاح انجليزي')
                    <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        ليس لديك صلاحية يرجي مراجعة المسؤول
                    </div>
                @endcannot
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection

@section('js')<!--<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>-->
<!--<script type="text/javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>-->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>

<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Owl Carousel js-->
<script src="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.js')}}"></script>
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
                    url: '/CMS/datatables/LevelUp',
                    data: function (d) {
                        d.searchLevelUp = $('#users-table_filter input[type=search]').val();
                        d.studentId = $('select[name=student_h]').val();
                        d.levelId = $('select[name=level_h]').val();
                        d.levelUpId = $('select[name=level_up_h]').val();
                    }
                },
                columns: [
                    { data: 'date', name: 'date' },
                    { data: 'student_name', name: 'student_name' },
                    { data: 'level', name: 'level' },
                    { data: 'total', name: 'total' },
                    { data: 'level_up', name: 'level_up' },
                    { data: 'created_by', name: 'created_by' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/LevelUp/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/LevelUp/'+row.id+'/edit">تعديل</a>';
                            var ress ='';
                            @can('عرض نجاح انجليزي')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل نجاح انجليزي')
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
            $('#level_h').change(function() {
                cTable.draw();
            });
            $('#level_up_h').change(function() {
                cTable.draw();
            });
        });
    </script>
@endsection
