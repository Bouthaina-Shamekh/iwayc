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
@can('اضافة معلم')
<a class="btn btn-primary btn-md" href="{{ route('Teacher.create') }}"><i class='fas fa-plus'style="margin-left: 10px">اضافه معلم جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض معلم')

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
                                    <select name="specs_h" id="specs_h" class="form-control">
                                        <option value=""> اختر التخصص.... </option>
                                        @foreach($specs as $spec)
                                            <option {{old("specs_h")==$spec->id?"selected":""}} value="{{$spec->id}}"> {{$spec->title}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="address_h" id="address_h" class="form-control">
                                        <option value=""> اختر العنوان.... </option>
                                        @foreach($addresses as $address)
                                            <option {{old("address_h")==$address->id?"selected":""}} value="{{$address->id}}"> {{$address->title}} </option>
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
                                <td>
                                    <select name="classification_h" id="classification_h" class="form-control">
                                        <option value=""> اختر التصنيف.... </option>
                                        @foreach($classifications as $classification)
                                            <option {{old("classification_h")==$classification->id?"selected":""}} value="{{$classification->id}}"> {{$classification->title}} </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select name="nationality_h" id="nationality_h" class="form-control">
                                        <option value=""> اختر الجنسية.... </option>
                                        @foreach($nationalities as $nationality)
                                            <option {{old("nationality_h")==$nationality->id?"selected":""}} value="{{$nationality->id}}"> {{$nationality->title}} </option>
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
                                                    <th>الاسم</th>
                                                    <th>التخصص</th>
                                                    <th>تاريخ الطلب</th>
                                                    <th>العنوان</th>
                                                    <th>التصنيف</th>
                                                    <th>سنة الميلاد</th>
                                                    <th>الهاتف</th>
                                                    <th>الملاحظات</th>
                                                    <th>الحالة</th>
                                                    <th width="15%"></th>
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

                @cannot('عرض معلم')
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
            var tTable = $('#users-table').DataTable({
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
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/Teacher',
                    data: function (d) {
                        d.searchTeacher = $('#users-table_filter input[type=search]').val();
                        d.specsId = $('select[name=specs_h]').val();
                        d.addressId = $('select[name=address_h]').val();
                        d.classificationId = $('select[name=classification_h]').val();
                        d.nationalityId = $('select[name=nationality_h]').val();
                        d.activeId = $('select[name=active_h]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'specialization', name: 'specialization' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'address', name: 'address' },
                    { data: 'classification', name: 'classification' },
                    { data: 'birthday', name: 'birthday' },
                    { data: 'phone1', name: 'phone1' },
                    { data: 'notes', name: 'notes' },
                    {"mRender": function ( data, type, row ) {
                            var cbAct = '<input type="checkbox" value="0" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" />';
                            if(row.activeI==1){
                                cbAct = '<input type="checkbox" value="1" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" checked />';
                            }
                            return cbAct;
                        }
                        ,orderable: false},
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success" href="/CMS/Teacher/'+row.id+'">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-primary" href="/CMS/Teacher/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Teacher/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض معلم')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل معلم')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف معلم')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            //filtering
            $('#specs_h').change(function() {
                tTable.draw();
            });
            $('#address_h').change(function() {
                tTable.draw();
            });
            $('#active_h').change(function() {
                tTable.draw();
            });
            $('#classification_h').change(function() {
                tTable.draw();
            });
            $('#nationality_h').change(function() {
                tTable.draw();
            });
            $('#money_id').change(function() {
                tTable.draw();
            });
        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Teacher/active/" + id,
                complete: function (data) {
                if (data.status==200){
                         not7();
                    }
                    else{not8()}
                }
            })
        }
    </script>

@endsection
