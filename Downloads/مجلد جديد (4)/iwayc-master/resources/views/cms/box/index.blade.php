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
  @can('اضافة صندوق')
  <a class="btn btn-primary btn-md" href="{{ route('Box.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة صندوق جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض صندوق')


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
                                <th>قفل</th>
                                <th>اسم الصندوق</th>
                                <th>نوع الصندوق</th>
                                <th>اسم المستودع</th>
                                <th>حساب اول العام</th>
                                <th>الصندوق التابع له</th>
                                <th>الايرادات</th>
                                <th>المصروفات</th>
                                <th>الرصيد</th>
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

</div>

 @endcan

    @cannot('عرض صندوق')
        <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            ليس لديك صلاحية يرجي مراجعة المسؤول
        </div>
    @endcannot
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection

 {{--  <a class="btn btn-sm btn-warning" href="/CMS/Box/'+row.id+'">عرض</a>'; --}}
@section('js')
 <script>
        $(function() {
            var bTable = $('#users-table').DataTable({
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
                },drawCallback: function () {
                   var basic_income = 0;
                var basic_expense = 0;
                var center_income = 0;
                var center_expense = 0;

                var centerfirstcalc =0;
                var basicfirstcalc =0;
                this.api().rows().every(function (rowIdx, tableLoop, rowLoop) {
                    var d = this.data();

                    if (d.parent_id == "صندوق المركز")
                    {
                        d.income=d.income.replace(',','');
                        center_income = parseFloat(center_income) + parseFloat(d.income);
                        d.expense=d.expense.replace(',','');
                        center_expense = parseFloat(center_expense) + parseFloat(d.expense);
                    }else{
                    if(d.id==1){
                        d.calculator_first=d.calculator_first.toString().replace(',','');
                           basicfirstcalc=d.calculator_first;
                       }else if(d.id==2){
                        d.calculator_first=d.calculator_first.toString().replace(',','');  centerfirstcalc=d.calculator_first;
                       }else{
                           d.income=d.income.replace(',','');
                           d.expense=d.expense.replace(',','');
                           basic_income = parseFloat(basic_income) + parseFloat(d.income);
                        basic_expense = parseFloat(basic_expense) + parseFloat(d.expense);
                       }
                   }

                });
                var centertotal= parseFloat(centerfirstcalc) + parseFloat(center_income)- parseFloat(center_expense);

                var basicin = parseFloat(basic_income) + parseFloat(center_income);
                //console.log(basicin);
                var basicex = parseFloat(basic_expense) + parseFloat(center_expense);
                var basictotal= parseFloat(basicfirstcalc) + parseFloat(basicin)- parseFloat(basicex);
                $(".allincomes:eq(2)").html(center_income.toFixed(2));
                $(".allexpenses:eq(2)").html(center_expense.toFixed(2));
                $(".alltotals:eq(2)").html(centertotal.toFixed(2));

                $(".allincomes:eq(1)").html(basicin.toFixed(2));
                $(".allexpenses:eq(1)").html(basicex.toFixed(2));
                $(".alltotals:eq(1)").html(basictotal.toFixed(2));
                },
                ajax: {
                    url: '/CMS/datatables/Box',
                    data: function (d) {
                        d.searchBox = $('#users-table_filter input[type=search]').val();
                        d.moneyId = $('select[name=money_id]').val();
                    }
                },
                columns: [
                    {"mRender": function ( data, type, row ) {
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/lock/Box/'+row.id+'"><i class="fa fa-lock"></i></a>';
                            if (row.lock==1) {
                                dele ='<a  class="btn Confirm btn-sm btn-danger" href="/CMS/lock/Box/'+row.id+'"><i class="fa fa-unlock"></i></a>';
                            }
                            return dele;}
                    },
                    { data: 'name', name: 'name' },
                    { data: 'type', name: 'type' },
                    { data: 'repository_id', name: 'repository_id' },
                    { data: 'calculator_first', name: 'calculator_first' },
                    { data: 'parent_id', name: 'parent_id' },
                    { data: 'income', name: 'income' , class: 'allincomes' },
                    { data: 'expense', name: 'expense' , class: 'allexpenses' },
                    { data: 'total', render: function (data, type, row) {
                        var total = parseFloat(row.calculator_first.toString().replace(',','')) + parseFloat(row.income.replace(',','')) - parseFloat(row.expense.replace(',',''));
                return total.toFixed(2);
            }, name: 'total', class: 'alltotals' },
                    {"mRender": function ( data, type, row ) {
                            var cbAct = '<input type="checkbox" value="0" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" />';
                            if(row.activeI==1){
                                cbAct = '<input type="checkbox" value="1" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" checked />';
                            }
                            if (row.lock==1) {
                                cbAct = 'مقفل';
                            }
                            return cbAct;
                        }
                        ,orderable: false},
                    {"mRender": function ( data, type, row ) {
                            var show ='<form style="display: inline;"action="/CMS/Box/'+row.id+'" method="post">@csrf <input type="hidden" value="'+row.income+'" name="income"><input type="hidden" value="'+row.expense+'" name="expense"><input class="btn btn-sm btn-success" type="submit" value="عرض" name="submit"></form>'
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/Box/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Box/'+row.id+'">حذف</a>';
                            var ress ='';
                        var boxInEx = '<a class="btn btn-sm btn-primary disabled" href="/CMS/BoxIncomes/'+row.id+'" ><i class="fa fa-plus"></i></a>';
                        if (row.type == 'مستقل') {
                            boxInEx = '<a class="btn btn-sm btn-primary" href="/CMS/BoxIncomes/'+row.id+'"><i class="fa fa-plus"></i></a>';
                        }
                            @can('عرض صندوق')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل صندوق')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف صندوق')
                                ress=ress+' '+dele;
                            @endcan
                                ress=boxInEx+' '+ress;
                            if (row.lock==1) {
                                ress = 'مقفل';
                            }
                            return ress;}
                    }
                ]
            });
            $('#money_id').change(function() {
                bTable.draw();
            });
        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Box/active/" + id,
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
