@extends('layouts.master')
@section('css')
 <style>
    tr td:nth-child(10),tr td:nth-child(9) {
        font-weight: bold;
        color: red ;
    }
    tr td:nth-child(8),tr td:nth-child(7) {
        font-weight: bold;
    }
    tr th:nth-child(10),tr th:nth-child(9) {
        font-weight: bold;
        color: red !important;
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
@can('اضافة عروض دورات')
<a class="btn btn-primary btn-md" href="{{ route('Offer.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافة عرض جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
 @can('عرض عروض دورات')
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
                                    <select name="type_h" id="type_h" class="form-control">
                                        <option value=""> اختر التصنيف.... </option>
                                        @foreach($types as $type)
                                            <option {{old("type_h")==$type->id?"selected":""}} value="{{$type->id}}"> {{$type->title}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="active_h" id="active_h" class="form-control">
                                        <option value=""> اختر الفعالية.... </option>
                                        <option {{old("active_h")=='1'?"selected":""}} value="1"> ساري </option>
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
                                <th>عنوان العرض</th>
                                <th>التصنيف</th>
                                <th>ر. التسجيل</th>
                                <th>ر. حقيبة</th>
                                <th>ر. الدورة</th>
                                <th >الرسوم الكلي</th>
                                <th>نسبة الخصم</th>
                                <th id="b">قيمة الخصم</th>
                                <th >الرسوم النهائي</th>
                                <th>الحالة</th>
                                <th>اخر تعديل</th>
                                <th>اسم المستخدم</th>
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

    @cannot('عرض عروض دورات')
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
            var aTable = $('#users-table').DataTable({
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
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/Offer',
                    data: function (d) {
                        d.searchOffer = $('#users-table_filter input[type=search]').val();
                        d.typeId = $('select[name=type_h]').val();
                        d.activeId = $('select[name=active_h]').val();
                    }
                },
                columnDefs: [{
                        targets: '_all',
                        render: function(data, type, row) {
                            if (type === 'PDF') {
                                return String(data).split(' ').reverse().join('  ');
                            }  return data;} }
                   ],
                   columns: [
  { data: 'id', name: 'id' },
  { data: 'title', name: 'title' },
  { data: 'type', name: 'type' },
  { data: 'fees_reg', name: 'fees_reg' },
  { data: 'fees_bag', name: 'fees_bag' },
  { data: 'fees_course', name: 'fees_course' },
  { data: 'amount', name: 'amount', id: 'amount' },
  { data: 'discount_r' , name: 'discount_r',
  render: function(data, type, full, meta) {
  return '<span>' + data + '%' + '</span>';
}
},
  {
    data: 'discount_v',
    name: 'discount_v',

  },
  { data: 'total', name: 'total' },
  { data: 'activeI', name: 'activeI' },
  { data: 'created_at', name: 'created_at' },
  { data: 'created_by', name: 'created_by' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/Offer/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Offer/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Offer/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض عروض دورات')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل عروض دورات')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف عروض دورات')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            //filtering
            $('#type_h').change(function() {
                aTable.draw();
            });
            $('#active_h').change(function() {
                aTable.draw();
            });
        });
    </script>





<script>
    document.getElementById("users-table").style.textAlign = "center";
    </script>

@endsection
