@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->

<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">


<style>
.modal{
    padding: 0 !important;
   }
   .modaldialog {
     max-width: 70% !important;

     padding: 0;
     margin: 0;
   }

   .modalcontent {
     border-radius: 0 !important;

     max-width: 100% !important;

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

<div class="mt-2">
@can('اضافات مهمات ')
<a class="btn btn-primary btn-md"  href="{{ route('Task.create') }}"><i class='fas fa-plus'style="margin-left: 10px">إضافة مهمة جديدة</a>
@endcan

@can('المهام العام')
<a href="/CMS/Sender/Task" class="btn btn-warning">قائمة المهام العام </a></div>
@endcan
@endsection
@section('button2')

<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')

@can('عرض مهمات')

  <div class="modal fade" id="favoritesModal"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog modaldialog" role="document">
    <div class="modal-content modalcontent">
      <div class="modal-header">
       <h4 class="modal-title"
        id="favoritesModalLabel"> عرض المهمة</h4>
        <button type="button" class="close"
          data-dismiss="modal"
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body modalbody">

      </div>
      <div class="modal-footer">
        <button type="button"
           class="btn btn-default"
           data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>


<div class="modal fade"id="favoritesModal2"tabindex="-1"role="dialog"
aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
              <h4 class="modal-title"id="favoritesModalLabel"> تقييم المهام</h4>

        <button type="button" class="close"data-dismiss="modal"aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body modalbody1">

      </div>
      <div class="modal-footer">
        <button type="button"
           class="btn btn-default"
           data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>

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
                                    <select name="sender_h" id="sender_h" class="form-control">
                                        <option value=""> اختر الموظف المرسل.... </option>
                                        @foreach($users as $sender)
                                            <option {{old("sender_h")==$sender->id?"selected":""}} value="{{$sender->id}}"> {{$sender->name}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="receiver_h" id="receiver_h" class="form-control">
                                        <option value=""> اختر الموظف المستلم.... </option>
                                        @foreach($users as $receiver)
                                            <option {{old("receiver_h")==$receiver->id?"selected":""}} value="{{$receiver->id}}"> {{$receiver->name}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="category_h" id="category_h" class="form-control">
                                        <option value=""> اختر تصنيف المهمة.... </option>
                                        @foreach($categories as $category)
                                            <option {{old("category_h")==$category->id?"selected":""}} value="{{$category->id}}"> {{$category->title}} </option>
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
								<div class="d-flex justify-content-between">

							</div>
							<div class="card-body">
								<div class="table-responsive ls-table">
									<table id="users-table" class="table table-bordered table-striped table-hover">

					 <thead>
                            <tr>
                                <th>من</th>
                                <th>الي</th>
                                <th>العنوان</th>
                                <th>التصنيف</th>
                                <th>تاريخ التفعيل </th>
                                <th>تاريخ الانجاز </th>
                                <th>مر عليها</th>
                                <th width="15%">التقيم</th>
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

    @cannot('عرض مهمات')
        <div class="col-md-offset-1 col-md-10 alert alert-danger" style="margin-bottom: 400px ;margin-top:10px"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            ليس لديك صلاحية يرجي مراجعة المسؤول
        </div>
    @endcannot

			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')

 <!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400,

    });
</script>


     <script>

        $(function() {
            var tTable = $('#users-table').DataTable({
                dom: 'Bfrtip',
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
                    url: '/CMS/datatables/EndTask',
                    data: function (d) {
                        d.searchTask = $('#users-table_filter input[type=search]').val();
                        d.senderId = $('select[name=sender_h]').val();
                        d.receiverId = $('select[name=receiver_h]').val();
                        d.categoryId = $('select[name=category_h]').val();
                    }
                },
                 fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if ( aData['evaluate'] ===null)
                    {
                        $('td', nRow).css('background-color', 'rgb(64 188 205)');
                        $('td', nRow).css('color', 'White');
                    }
                },
                drawCallback: function () {
                   var json= tTable.ajax.json();
                    $('#num_tasks').replaceWith('<strong id="num_tasks">'+json.total+'</strong>');
                    $('#evaluation').replaceWith('<strong id="evaluation">'+json.evaluations+' %</strong>');
                },
                columns: [
                    { data: 'sender', name: 'sender' },
                    { data: 'receiver', name: 'receiver' },
                    { data: 'title', name: 'title' },
                    { data: 'category', name: 'category' },
                    { data: 'start_date', name: 'start_date' },
                     { data: 'end_date', name: 'end_date' },
                    { data: 'rem', name: 'rem' },
                    {"mRender": function ( data, type, row ) {
                           if(row.evaluate!=null){
                             var bOut = '%'+row.evaluate +'';
                           }else{
                            var bOut = '';
                           }

                            if (row.sender_id == row.usr){
                             var bOut2 = '<a class="btn btn-sm btn-primary showModal" id="'+row.id+'" onclick="showModal2(this)">تقيم</a>';
                            }else{
                              var bOut2='';
                            }
                            return bOut2 + ' ' + bOut }
                    },
                      {"mRender": function ( data, type, row ) {
                            var show = '<a class="btn btn-sm btn-success showModal" id="'+row.id+'" onclick="showModal(this)">عرض</a>' ;
                                 var ress ='';
                              @can('عرض مهمات')
                               ress=show+' ';
                            @endcan

                            return ress;
                    }
                    },
                ]
            });
            //filtering
            $('#sender_h').change(function() {
                tTable.draw();
            });
            $('#receiver_h').change(function() {
                tTable.draw();
            });
            $('#category_h').change(function() {
                tTable.draw();
            });
        });

   function showModal2(selectID) {

            var id = selectID.id;
            $.ajax({
            url: "{{url('/CMS/Task/ratio')}}" + "/" + id,
            type: "GET",
            success: function (data) {

                $(".modalbody1").html(data.html);
                $('#favoritesModal2').modal();
            },
            error: function () {
                alert("Error, Unable to bring up the creation dialog.");
            }
        })

        }

           function showModal(selectID) {

            var id = selectID.id;
            $.ajax({
            url: "{{url('/CMS/Task/')}}" + "/" + id,
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
