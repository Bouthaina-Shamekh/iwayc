@extends('layouts.master')
@section('css')

<style>
.modal{
    padding: 0 !important;
   }
   .modal-dialog {
    height:80% !important;
     padding: 0;
     margin: 0;
   }

   .modal-content {
     border-radius: 0 !important;
   height:75% !important;
   }
  .bs-popover-left{
    margin-left: 30px !important;
   }
   .popover-body p img{
    height:200px;
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

<div class="mt-2">@can('اضافة مهمة')
<a class="btn btn-primary btn-md" href="{{ route('Task.create') }}">إضافة مهمة جديدة</a>
@endcan<a href="/CMS/End/Task" class="btn btn-warning">قائمة المهام المنتهية </a></div>
@endsection
@section('button2')

<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>

@endsection
@section('button2')
<div class="col-sm-2 text-right"><a href="/CMS/End/Task" class="btn btn-warning"><i class="fa fa-list"></i> قائمة المهام المنتهية </a></div>
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')



 <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            <div class="row">

                <div class="col-2"><h5><strong>تقييم مهـام المستخدم</strong></h5>
                </div>
                <div class="col-4">
                    <select name="user_h" id="user_h" class="form-control">
                        <option value=""> اختر اسم المستخدم.... </option>
                        <option  value=""> الكل</option>
                        @foreach($users as $user)
                        <option {{old("user_h")==$user->id?"selected":""}} value="{{$user->id}}"> {{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div><br>

                    <div class="row">
                        <div class="col-md-4 control-label">تقييم مهام المستخدم :<span class="tag"><strong id="taskName"></strong></span></div>
                        <div class="col-md-4 control-label">عدد المهام المنجزة :<span class="tag"><strong id="taskDone"></strong></span></div>
                        <div class="col-md-4 control-label">عدد المهام قيدة الانجاز :
                         <span class="tag"><strong id="taskRun"></strong></span></div>
                    </div><br>

                    <div class="row">
                        <div class="col-md-4 control-label" style="font-size:18px;color:#3ac6d4;">متوسط تقييم المهام المنجزة العام :
                             <span class="tag"><strong id="taskRatio"></strong></span></div>

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
									<table id="task-table" class="table table-bordered table-striped table-hover">

					                      <thead>
                            <tr>
                                <th>من المستخدم</th>
                                <th>الى المستخدم </th>
                                <th>قيد الانجاز</th>
                                <th>المنجزة</th>
                                <th>متوسط التقييم</th>
                                 <th>المؤشر الصوري</th>
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

			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
 <script>
        $(function() {
            var sTable = $('#task-table').DataTable({
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
                   ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/RepTask',
                    data: function (d) {
                        d.searchStudent = $('#student-courses-table_filter input[type=search]').val();

                        d.userId = $('select[name=user_h]').val();
                    }
                },
                columns: [
                    { data: 'sender', name: 'sender',orderable: true },
                    { data: 'receiver', name: 'receiver',orderable: true },
                    { data: 'countRun', name: 'countRun',orderable: true },
                    { data: 'countDone', name: 'countDone',orderable: true },
                    { data: 'ratioDone', name: 'ratioDone',orderable: true },
                    { data: 'operations', name: 'operations',orderable: false },/*
                    { data: 'payment', name: 'payment',orderable: true },
                    { data: 'stat', name: 'stat',orderable: true },
                    { data: 'count', name: 'count',orderable: true },
                    { data: 'notes', name: 'notes',orderable: true }*/
                ],unique:'sender'
            });

            //filtering
            $('#user_h').change(function(e) {
                sTable.draw();
            });

        });

        $('#user_h').change(function(id) {

            var id = $('select[name=user_h]').val();
            if(id === ''){
                id=0;
            }


                $.ajax({
                    url: "/CMS/Report/Task/" + id,
                    success: function (data) {
                        if (data.status==1){
                             $('#taskRatio').replaceWith('<strong id="taskRatio">'+data.taskRatio+' %</strong>');
                            $('#taskName').replaceWith('<strong id="taskName">'+data.taskName+'</strong>');
                            $('#taskDone').replaceWith('<strong id="taskDone">'+data.taskDone+'</strong>');
                            $('#taskRun').replaceWith('<strong id="taskRun">'+data.taskRun+'</strong>');
                        }
                        else{alert('حدث خطأ اثناء تنفيذ العملية');}
                    }

                })
          window.onload = (event) => {
                id=0;
                $.ajax({
                    url: "/CMS/Report/Task/" + id,
                    success: function (data) {
                        if (data.status==1){
                   $('#taskRatio').replaceWith('<strong id="taskRatio">'+data.taskRatio+' %</strong>');
                            $('#taskName').replaceWith('<strong id="taskName">'+data.taskName+'</strong>');
                            $('#taskDone').replaceWith('<strong id="taskDone">'+data.taskDone+'</strong>');
                            $('#taskRun').replaceWith('<strong id="taskRun">'+data.taskRun+'</strong>');
                        }
                        else{alert('حدث خطأ اثناء تنفيذ العملية');}
                    }

                })
                };

        });

    </script>
@endsection
