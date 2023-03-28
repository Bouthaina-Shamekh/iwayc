@extends('layouts.master')
@section('css')
<style>
@import url('https://fonts.cdnfonts.com/css/scheherazade');
</style>
<link href="https://fonts.cdnfonts.com/css/scheherazade" rel="stylesheet">
@section('title')
 Iwayc System

@endsection

@section('title-page-header')
الحضور الغياب الحصص
@endsection
@section('page-header')
ادارة جدول الحصص

@endsection
@section('button1')
@can('اضافة موعد حصة')
<a class="btn btn-primary btn-md" href="{{ route('Quota.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه موعد جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض موعد حصة')

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
                                        <select name="course_h" id="course_h" class="form-control">
                                            <option value=""> اختر اسم المعلم والدورة.... </option>
                                            @if(count($courses)>0)
                                            @foreach($courses as $course)
                                            <?php $teacher= \App\Models\Teacher::find($course->teacher_id); ?>
                                                <option {{old("course_h")==$course->id?"selected":""}} value="{{$course->id}}"> {{$course->courseAR}}-{{$teacher->name or ""}} </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <select name="room_h" id="room_h" class="form-control">
                                            <option value=""> اختر اسم القاعة.... </option>
                                            @if(count($rooms)>0)
                                            @foreach($rooms as $room)
                                                <option {{old("room_h")==$room->id?"selected":""}} value="{{$room->id}}"> {{$room->title}} </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <select name="day_h" id="day_h" class="form-control">
                                            <option value=""> اختر اليوم.... </option>
                                            @foreach($days as $day)
                                                <option {{old("day_h")==$day->id?"selected":""}} value="{{$day->id}}"> {{$day->title}} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="type_h" id="type_h" class="form-control">
                                            <option value=""> اختر التصنيف.... </option>
                                            @foreach($types as $type)
                                                <option {{old("type_h")==$type->id?"selected":""}} value="{{$type->id}}"> {{$type->title}} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="time_h" id="time_h" class="form-control">
                                            <option value=""> اختر تصنيف الوقت اولا.... </option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="time_to_h" id="time_to_h" class="form-control">
                                            <option value=""> اختر تصنيف الوقت اولا.... </option>
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
								<div class="table-responsive ls-table">
									<table id="users-table" class="table table-bordered table-striped table-hover">

										<thead>
                                        <tr>
                                            <th></th>

                                            <th>اسم الدورة</th>
                                            <th>اسم المعلم</th>
                                            <th>اليوم</th>
                                            <th>اسم القاعة</th>
                                            <th>تصنيف الوقت</th>
                                            <th>الوقت من</th>
                                            <th>الوقت الي</th>
                                            <th>اسم المستخدم</th>
                                            <th>التاريخ والوقت للادخال</th>
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

                @cannot('عرض موعد حصة')
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

        jQuery(document).ready(function($){

            $('#type_h').change(function(){
                var id=$(this).val();
                $.get("/CMS/Section/" + id,
                    function(data) {
                        var model = $('#time_h');
                        var model_to = $('#time_to_h');
                        model.empty();
                        model_to.empty();
                        model.append('<option value="">  اختر الوقت من.... </option>');
                        model_to.append('<option value=""> اختر الوقت الي.... </option>');

                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.title + "</option>");
                            model_to.append("<option value='"+ element.id +"'>" + element.title + "</option>");
                        });
                    });
            });
        });

        $(function() {
            var abTable = $('#users-table').DataTable({
                dom: 'Bfrtip',
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                buttons: [
                    {'extend':'excel','text':'أكسيل'},
                    {'extend':'print','text':'طباعة'},
                    {'extend':'pdf','text':'pdf' ,'exportOptions': {'orthogonal': "PDF"},customize: function ( doc ) {processDoc(doc); //fun in app.js
                    }
                    },
                    {'extend':'pageLength','text':'حجم العرض'},

                   ],
                    columnDefs: [{
                        targets: '_all',
                        render: function(data, type, row) {
                            if (type === 'PDF') {
                                return String(data).split(' ').reverse().join(' ');
                            }  return data;} }
                   ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/Quota',
                    data: function (d) {
                        d.searchQuota = $('#users-table_filter input[type=search]').val();
                        d.courseId = $('select[name=course_h]').val();
                        d.dayId = $('select[name=day_h]').val();
                        d.roomId = $('select[name=room_h]').val();
                        d.typeId = $('select[name=type_h]').val();
                        d.timeId = $('select[name=time_h]').val();
                        d.timeToId = $('select[name=time_to_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },

                    { data: 'course_id', name: 'course_id' },
                    { data: 'teacher_id', name: 'teacher_id' },
                    { data: 'day', name: 'day' },
                    { data: 'room', name: 'room' },
                    { data: 'type', name: 'type' },
                    { data: 'time', name: 'time' },
                    { data: 'time_to', name: 'time_to' },
                    { data: 'created_by', name: 'created_by' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-warning" href="/CMS/Quota/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Quota/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Quota/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض موعد حصة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل موعد حصة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف موعد حصة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                        ,orderable: false}
                ]
            });
            //filtering
            $('#course_h').change(function() {
                abTable.draw();
            });
            $('#day_h').change(function() {
                abTable.draw();
            });
            $('#room_h').change(function() {
                abTable.draw();
            });
            $('#type_h').change(function() {
                abTable.draw();
            });
            $('#time_h').change(function() {
                abTable.draw();
            });
            $('#time_to_h').change(function() {
                abTable.draw();
            });
            $('#money_id').change(function() {
                abTable.draw();
            });
        });

    </script>
@endsection
