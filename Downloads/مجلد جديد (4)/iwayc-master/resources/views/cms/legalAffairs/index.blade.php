@extends('layouts.master')
@section('css')
<style>
.spantag .tag{
    font-size:15px !important;
}
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
    .modaldialog2 {
     max-width: 50% !important;
     padding: 0;
     margin: 0;
   }

   .modalcontent2 {
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
<a class="btn btn-primary btn-md" href="/CMS/end/LegalAffairs">السجلات المنتهية</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')


<div class="modal fade" id="favoritesModal"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog modaldialog2" role="document">
    <div class="modal-content modalcontent2">
      <div class="modal-header">
      <h4 class="modal-title"
        id="favoritesModalLabel"> المبالغ المحصلة </h4>
        <button type="button" class="close"
          data-dismiss="modal"
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button"
           class="btn btn-default"
           data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="favoritesModal2"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog modaldialog" role="document">
    <div class="modal-content modalcontent">
      <div class="modal-header">
       <h4 class="modal-title"
        id="favoritesModalLabel">عرض الشئون القانونية</h4>
        <button type="button" class="close"
          data-dismiss="modal"
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body2">

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
                                    <select name="student_h" id="student_h" class="form-control">
                                        <option value=""> اختر اسم الطالب.... </option>
                                        @foreach($s as $st)
                                            <option {{old("student_h")==$st?"selected":""}} value="{{$st}}"> {{\App\Models\Student::find($st)->nameAR}} </option>
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
                                <td>
                                    <select name="active_h" id="active_h" class="form-control">
                                        <option value=""> اختر الحالة.... </option>
                                        @foreach($status as $s)
                                            <option {{old("active_h")==$s->id?"selected":""}} value="{{$s->id}}"> {{$s->title}} </option>
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

    <div class="row spantag">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row ls_divider">
                        <div class="col-md-4 control-label">مجموع المبالغ المطلوبة:
                        <span class="tag"><strong id="sum_teacher_fees"> 0 </strong> <span> دينار </div>
                        <div class="col-md-4 control-label">المبالغ المحصلة: <span class="tag"><strong id="receipt_teacher"> 0 </strong> <span>  دينار </div>
                        <div class="col-md-4 control-label">المبالغ المتبقية: <span class="tag"><strong id="remaind_teacher"> 0 </strong><span>  دينار </div>
                    </div>
                    <div class="row ls_divider">
                        <div class="col-md-4 control-label">عدد الطلاب : <span class="tag"><strong id="num">0</strong><span></div>
                        <div class="col-md-4 control-label">عدد مرات المطالبة: <span class="tag"><strong id="count_claim">0</strong><span></div>
                        <div class="col-md-4 control-label">عدد مرات التحذيرات:<span class="tag"> <strong id="count_warning">0</strong><span></div>
                    </div>
                </div>
            </div>
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
                                <th>اسم الطالب</th>
                                <th>اسم الدورة</th>
                                <th>الهواتف</th>
                                <th>السنة المالية</th>
                                <th class="receipt_teacher">الرسوم</th>
                                <th class="sum_teacher_fees" style="color: #d43f3a;">المستحق</th>
                                <th>اول مطالبة</th>
                               <th>أيام التأخير</th>
                                <th>غرامة اليوم</th>
                                <th>غرامة التأخير</th>
                                <th class="remaind_teacher" style="color: #d43f3a;">المبلغ الكلي</th>
                                <th>المبالغ المحصلة</th>
                                <th>ملاحظات التحصيل</th>
                                <th>الضمان</th>
                                <th class="count_claim">مرات المطالبة</th>
                                <th class="count_warning">مرات التحذير</th>
                                <th>**</th>
                                <th>الحالة</th>
                                <th>ملاحظات قانونية</th>
                                <th>المستخدم المُبلغ</th>
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
                    $('#sum_teacher_fees').replaceWith('<strong id="sum_teacher_fees">'+json.sum_teacher_fees+'</strong>');
                    $('#num').replaceWith('<strong id="num">'+json.num+'</strong>');

                    $('#receipt_teacher').replaceWith('<strong id="receipt_teacher">'+json.receipt_teacher+'</strong>');

                    $('#remaind_teacher').replaceWith('<strong id="remaind_teacher">'+json.remaind_teacher+'</strong>');

                    $('#count_claim').replaceWith('<strong id="count_claim">'+json.count_claim+'</strong>');

                    $('#count_warning').replaceWith('<strong id="count_warning">'+json.count_warning+'</strong>');
                },
                ajax: {
                    url: '/CMS/datatables/LegalAffairs',
                    data: function (d) {
                        d.searchLegalAffairs = $('#users-table_filter input[type=search]').val();
                        d.moneyId = $('select[name=money_id]').val();
                        d.studentId = $('select[name=student_h]').val();
                        d.userId = $('select[name=user_h]').val();
                        d.activeId = $('select[name=active_h]').val();
                    }
                },
                columns: [
                    { data: 'nameAR', name: 'nameAR' },
                    { data: 'courseAR', name: 'courseAR' },
                    { data: 'phone', name: 'phone' },
                    { data: 'm_year', name: 'm_year' },
                    { data: 'fees', name: 'fees' },
                    { data: 'fees_owed', name: 'fees_owed',class: 'upcolor' },
                    { data: 'first_claim', name: 'first_claim' },
                    { data: 'delay_dates', name: 'delay_dates' },
                    { data: 'fine_day', name: 'fine_day' },
                    { data: 'fine_delay', name: 'fine_delay' },
                    { data: 'total_amount', name: 'total_amount',class: 'upcolor' },
                    {"mRender": function ( data, type, row ) {
                            var cc = row.collect_amount+" "+'<a  class="btn btn-sm btn-primary showModal" id="'+row.id+'" onclick="showModal(this)"><i class="fa fa-plus"></i></a>';
                            return cc;
                    }
                    },
                     { data: 'collect_notes', name: 'collect_notes' },
                    {"mRender": function ( data, type, row ) {
                            var cbAct = '<input type="checkbox" value="0" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" />';
                            if(row.warranty==1){
                                cbAct = '<input type="checkbox" value="1" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" checked />';
                            }
                            return cbAct;
                        }
                        ,orderable: false},
                    { data: 'count', name: 'count' },
                    { data: 'count_warning', name: 'count_warning' },
                    {"mRender": function ( data, type, row ) {
                            var cc = '<a disabled class="btn btn-sm btn-primary" href="/CMS/add/CountWarning/'+row.id+'"><i class="fa fa-plus"></i></a>';
                            if (row.hour12>0) {
                                cc = '<a class="btn btn-sm btn-primary" href="/CMS/add/CountWarning/'+row.id+'"><i class="fa fa-plus"></i></a>';
                            }
                            return cc;}
                    },
                    { data: 'status', name: 'status' },
                    { data: 'notes', name: 'notes' },
                    { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a  class="btn btn-sm btn-warning showModal" id="'+row.id+'" onclick="showModal2(this)">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/LegalAffairs/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/LegalAffairs/'+row.id+'">حذف</a>';
                            return show + '   ' + edit + '   ' + dele;}
                    }
                ]
            });
            //filtering
            $('#money_id').change(function() {
                cTable.draw();
            });
            $('#student_h').change(function() {
                cTable.draw();
            });
            $('#user_h').change(function() {
                cTable.draw();
            });
            $('#active_h').change(function() {
                cTable.draw();
            });
        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/LegalAffairs/active/" + id,
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
            url: "{{url('/CMS/LegalAffairs/addCollect')}}" + "/" + id,
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
        function showModal2(selectID) {

            var id = selectID.id;
            $.ajax({
            url: "{{url('/CMS/LegalAffairs/')}}" + "/" + id,
            type: "GET",
            success: function (data) {

                $(".modal-body2").html(data.html);
                $('#favoritesModal2').modal();
            },
            error: function () {
                alert("Error, Unable to bring up the creation dialog.");
            }
        })

        }
    </script>
    <style>
    .upcolor{
        color: #d43f3a !important;
    }
</style>
@endsection
