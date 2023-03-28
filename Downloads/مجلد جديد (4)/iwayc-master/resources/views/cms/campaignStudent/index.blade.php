@extends('layouts.master')
@section('css')

<style>
.modal{
    padding: 0 !important;
   }
   .modal-dialog {
     max-width: 70% !important;

     padding: 0;
     margin: 0;
   }

   .modal-content {
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
@can('اضافة حملة')
<a class="btn btn-primary btn-md" id="{{$id}}"href="#" onclick="showModal(this)">تفاصيل الحملة</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('Campaign.index') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض حملة')

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
                                    <select name="response" id="response" class="form-control">
                                        <option value=""> اختر من القائمة.... </option>
                                        @foreach($res as $re)
                                            <option value="{{$re->id}}"> {{$re->title}} </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select name="resolution_h" id="resolution_h" class="form-control">
                                        <option value="">   القرار .... </option>
                                        <option {{old("resolution_h")=='0'?"selected":""}} value="0"> لم ينظر  </option>
                                        <option {{old("resolution_h")=='1'?"selected":""}} value="1"> متابعة  </option>
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
							  <div class="">
                    <h3 class="panel-title" style="margin: 20px;">{{$camTitle}}</h3>
                    <input type="hidden" value="{{$id}}" name="campaign_id" id="campaign_id">
                </div>
							<div class="card-body">
								<div class="table-responsive ls-table">
									<table id="users-table" class="table table-bordered table-striped table-hover">
                                  <thead>
                            <tr>
                                <th></th>
                                <th>الاسم</th>
                                <th>سنة الميلاد</th>
                                <th>المنطقة</th>
                                <th>الدورات</th>
                                <th>نوع الطالب</th>
                                <th>ملاحظات</th>
                                <th>الهواتف</th>
                                <th>مدي الاستجابة</th>
                                <th>القرار</th>
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
<div class="modal fade" id="favoritesModal"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"id="favoritesModalLabel">إدارة الحملات</h4>
        <button type="button" class="close"data-dismiss="modal"aria-label="Close">
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
    @cannot('عرض متابعة حملة')
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
                order: [ [9, 'asc'] ],
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
                    url: '/CMS/datatables/CampaignStudent',
                    data: function (d) {
                        d.searchCampaign = $('#users-table_filter input[type=search]').val();
                        d.uId = $('#campaign_id').val();
                         d.resId = $('select[name=response]').val();
                          d.resolution = $('select[name=resolution_h]').val();
                    }
                },
                fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if ( aData['resolution'] === "متابعة" )
                    {
                        $('td', nRow).css('background-color', 'rgb(64 188 205)');
                        $('td', nRow).css('color', 'White');
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'birthday', name: 'birthday' },
                    { data: 'address', name: 'address' },
                    { data: 'course_reg', name: 'course_reg' },
                    { data: 'type', name: 'type' },
                    { data: 'notes', name: 'notes' },
                    { data: 'phone', name: 'phone' },
                    { data: 'response', name: 'response' },
                    { data: 'resolution', name: 'resolution' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn Confirm btn-sm btn-success" href="/CMS/read/CampaignStudent/'+row.id+'">نظر</a>';
                            var edit ='<a class="btn btn-sm btn-primary" href="/CMS/CampaignStudent/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/CampaignStudent/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض متابعة حملة')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل متابعة حملة')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف متابعة حملة')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            //filtering
            $('#resolution_h').change(function() {
                cTable.draw();
            });
            $('#response').change(function() {
                cTable.draw();
            });

        });

        function showModal(selectID) {

            var id = selectID.id;
            console.log("hh"+id);
            $.ajax({
            url: "{{url('/CMS/Campaign/')}}" + "/" + id,
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
