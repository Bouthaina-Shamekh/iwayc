@extends('layouts.master')
@section('css')
<style>
td{
font-size:14px !important;
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
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')

@can('عرض متابعة انجليزي')
<<<<<<< HEAD

=======
>>>>>>> abd1608af93bab2083f82e5feac7847391e34d06


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
                                    <select name="level_up_h" id="level_up_h" class="form-control">
                                        <option value=""> اختر مؤهل لمستوى.... </option>
                                        @foreach($levels as $level)
                                            <option {{old("level_up_h")==$level->id?"selected":""}} value="{{$level->id}}"> {{$level->title}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="type_h" id="type_h" class="form-control">
                                        <option value=""> اختر مدى الاستجابة.... </option>
                                        @foreach($types as $type)
                                            <option {{old("type_h")==$type->id?"selected":""}} value="{{$type->id}}"> {{$type->title}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="res_h" id="res_h" class="form-control">
                                        <option value=""> اختر القرار.... </option>
                                        <option {{old("res_h")=='0'?"selected":""}} value="0"> بلا </option>
                                        <option {{old("res_h")=='1'?"selected":""}} value="1"> متابعة </option>
                                        <option {{old("res_h")=='2'?"selected":""}} value="2"> محذوف </option>
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
                                <th>اسم الطالب</th>
                                <th>سنة الميلاد</th>
                                <th>المنطقة</th>
                                <th>المستويات المنجزة</th>
                                <th>علامة اخر مستوى</th>
                                <th>تاريخها</th>
                                <th class="scolor">مؤهل للمستوى</th>
                                <th>التصنيف</th>
                        {{--     <th>الملاحظات</th> --}}
                                <th width="40%">الهواتف</th>
                                <th>مدى الاستجابة</th>
                                <th width="35%">القرار</th>
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
                @cannot('عرض متابعة انجليزي')
<<<<<<< HEAD

=======
>>>>>>> abd1608af93bab2083f82e5feac7847391e34d06
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
                order: [ [8, 'asc'] ],
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
                    url: '/CMS/datatables/EnglishSal',
                    data: function (d) {
                        d.searchEnglishSal = $('#users-table_filter input[type=search]').val();
                        d.levelUpId = $('select[name=level_up_h]').val();
                        d.typeId = $('select[name=type_h]').val();
                        d.resId = $('select[name=res_h]').val();
                    }
                },
                columns: [
                    { data: 'student_name', name: 'student_name' },
                    { data: 'birthday', name: 'birthday' },
                    { data: 'region', name: 'region' },
                    { data: 'level', name: 'level' },
                    { data: 'mark', name: 'mark' },
                    { data: 'date', name: 'date' },
                    { data: 'up', name: 'up', class: 'scolor' },
                    { data: 'classification', name: 'classification' },
               {{--      { data: 'notes', name: 'notes' }, --}}
                    { data: 'phone', name: 'phone' },
                    { data: 'type', name: 'type'},
                    {"mRender": function ( data, type, row ) {
                            var sel = '<select onchange="myFunction(this)" id="'+row.id+'" name="print_e" class="form-control">';
                            var op1 = '<option value="0">بلا</option>';
                            if(row.resolution==0){
                                op1 = '<option selected value="0">بلا</option>';
                            }
                            var op2 = '<option value="1">متابعة</option>';
                            if(row.resolution==1){
                                op2 = '<option selected value="1">متابعة</option>';
                            }
                            var op3 = '<option value="2">حذف</option>';
                            if(row.resolution==2){
                                op3 = '<option selected value="2">حذف</option>';
                            }
                            var se = '</select>';

                            var all = sel + op1 + op2 + op3 + se;

                            return all;
                        }
                        ,orderable: false},
                    {"mRender": function ( data, type, row ) {
                            return '<a class="btn btn-sm btn-warning" href="/CMS/EnglishSal/'+row.id+'">عرض</a>' + '   ' +
                                '<a class="btn btn-sm btn-info" href="/CMS/EnglishSal/'+row.id+'/edit">تعديل</a>';}
                    }
                ]
            });
            //filtering
            $('#level_up_h').change(function() {
                cTable.draw();
            });
            $('#type_h').change(function() {
                cTable.draw();
            });
            $('#res_h').change(function() {
                cTable.draw();
            });
        });
        function myFunction(selectID) {
            var opt=selectID.value;
            var id=selectID.id;
            $.get("/CMS/EnglishSal/Res/"+id+"/"+opt);
        }
    </script>
    <style>
    .scolor{
        color: #d43f3a !important;
    }
</style>
@endsection
