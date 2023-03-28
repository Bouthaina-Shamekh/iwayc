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
<a class="btn btn-primary btn-md"   href="{{ route('Task.create') }}"><i class='fas fa-plus' style="margin-left: 10px"></i>إضافة مهمة جديدة</a>
@endcan

@can('المهام المنتهية')
<a href="/CMS/End/Task" class="btn btn-warning">قائمة المهام المنتهية </a></div>
@endcan
@endsection
@section('button2')

<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('المهام العام')

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
                                <td>
                                    <select name="active_h" id="active_h" class="form-control">
                                        <option value=""> اختر الفعالية.... </option>
                                        <option {{old("active_h")=='1'?"selected":""}} value="1"> فعال </option>
                                        <option {{old("active_h")=='0'?"selected":""}} value="0"> غير فعال </option>
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
<div class="row">
<div class="col-10">

</div>
<div class="col">
<h3 class="panel-title"> عدد المهمات <span class="tag tag-gray"style="font-size:16px"><Strong id="num_tasks"></Strong></span></h3>
</div>
</div>

<br>

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
                                <th>من</th>
                                <th>الي</th>
                                <th>العنوان</th>
                                <th>التصنيف</th>
                                <th>تفعيل المهمة</th>
                                <th>انتهاء المهمة</th>
                                <th>الحالة</th>
                                <th>مر عليها</th>
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
                    url: '/CMS/datatables/UserTask',
                    data: function (d) {
                        d.searchTask = $('#users-table_filter input[type=search]').val();
                        d.senderId = $('select[name=sender_h]').val();
                        d.receiverId = $('select[name=receiver_h]').val();
                        d.activeId = $('select[name=active_h]').val();
                        d.categoryId = $('select[name=category_h]').val();
                    }
                },
                fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if ( aData['category'] === "A. هام وعاجل" )
                    {
                        $('td', nRow).css('background-color', 'rgb(64 188 205)');
                        $('td', nRow).css('color', 'White');
                    }
                },
                drawCallback: function () {
                   var json= tTable.ajax.json();
                    $('#num_tasks').replaceWith('<strong id="num_tasks">'+json.total+'</strong>');
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'sender', name: 'sender' },
                    { data: 'receiver', name: 'receiver' },
                    { data: 'title', name: 'title' },
                    { data: 'category', name: 'category' },
                    {"mRender": function ( data, type, row ) {
                            var bOut ="";
                            if(row.start_date === null){
                               if (row.sender_id==row.usr) {
                                    bOut = '<button class="btn btn-sm btn-primary pos" id="'+row.id+'" onclick="fOut(this)">تفعيل المهمة</button>';

                            }else {
                                bOut = '<button disabled class="btn btn-sm btn-primary pos" id="'+row.id+'" onclick="fOut(this)">تفعيل المهمة</button>';
                            }
                            }else{
                                bOut = row.start_date;
                            }


                            return bOut;
                        }
                        ,orderable: false},
                    {"mRender": function ( data, type, row ) {
                               var bIn = '<button name="btnIn'+row.id+'" class="btn btn-sm btn-primary pos2" id="'+row.id+'" onclick="fIn(this)" disabled>انهاء المهمة</button>';
                            if (row.receiver_id==row.usr) {
                                if(row.end_date==null && row.start_date!=null){
                                    bIn = '<button name="btnIn'+row.id+'" class="btn btn-sm btn-primary pos2" id="'+row.id+'" onclick="fIn(this)">انهاء المهمة</button>';
                                }
                                if(row.end_date!=null){
                                    bIn = row.end_date;
                                }
                            }

                            return bIn;
                        }
                        ,orderable: false},
                    {"mRender": function ( data, type, row ) {
                            var cbAct = '<input type="checkbox" value="0" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" />';
                            if(row.activeI==1){
                                if (row.sender_id==row.usr) {
                                cbAct = '<input type="checkbox" value="1" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" checked />';
                                }else{
                                    cbAct = '<input disabled="disabled" type="checkbox" value="1" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" checked />';
                                }
                            }
                            return cbAct;
                        }
                        ,orderable: false},
                    { data: 'rem', name: 'rem' },
                    {"mRender": function ( data, type, row ) {
                            var show = '<a class="btn btn-sm btn-success showModal" id="'+row.id+'" onclick="showModal(this)">عرض</a>' ;

                               var edit = '<a class="btn btn-sm btn-primary" href="/CMS/Task/'+row.id+'/edit">تعديل</a>';
                               var dele = '<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Task/'+row.id+'">حذف</a>';
                        var ress ='';
                           if (row.sender_id==row.usr) {

                            @can('عرض مهمات')
                                ress=ress+' '+show;
                            @endcan
                            @can('تعديل مهمات')
                                ress=ress+' '+edit;
                            @endcan
                             @can('حذف مهمات')
                                ress=ress+' '+dele;
                            @endcan
                           }else{
                            @can('عرض مهمات')
                               ress=show+' ';
                            @endcan
                           }
                            return ress;
                    }

                    }
                ]
            });
            //filtering
            $('#sender_h').change(function() {
                tTable.draw();
            });
            $('#receiver_h').change(function() {
                tTable.draw();
            });
            $('#active_h').change(function() {
                tTable.draw();
            });
            $('#category_h').change(function() {
                tTable.draw();
            });
        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Task/active/" + id,
                complete: function (data) {
                   if (data.status==200){
                         not7();
                    }
                    else{not8()}
                }
            })
        }
        //start task function
        function fOut(selectID) {
            var id=selectID.id;
            var btn='btnIn'+id;
            $.ajax({
                url: "/CMS/Task/startT/" + id,
                success: function (data) {
                    $(selectID).replaceWith(data['start_date']);
                    $("button[name="+btn+"]").prop("disabled", false);
                    alert('تمت العملية بنجاح')
                }
            })
        }
        //end task function
        function fIn(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Task/endT/" + id,
                success: function (data) {
                    /*$(selectID).replaceWith(data['end_date']);*/
                    $('#users-table').dataTable().fnDraw();
                    alert('تمت العملية بنجاح')
                }
            })
        }
        function showModal(selectID) {

            var id = selectID.id;
            $.ajax({
            url: "{{url('/CMS/Task/')}}" + "/" + id,
            type: "GET",
            success: function (data) {

                $(".modalbody").html(data.html);
                $('#favoritesModal').modal();
            },
            error: function () {
                alert("Error, Unable to bring up the creation dialog.");
            }
        })


        }

    </script>
@endsection
