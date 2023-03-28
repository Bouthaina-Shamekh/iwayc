@extends('layouts.master')
@section('css')
<style>
.modal{
    padding: 0 !important;
   }
   .testdialog {
     max-width: 70% !important;

     padding: 0;
     margin: 0;
   }

   .testcontent {
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

@endsection
@section('button2')

@stop
@endsection
@section('content')
 <input type="hidden" id="box_id" name="box_id" value="{{$id}}">

<div class="card">
	<div class="card-body">
		<div class="tabs-menu ">
			<!-- Tabs -->
	        <ul class="nav panel-tabs main-nav-line">
		        <li class="nav-item">
			       <a href="#bIncome" data-toggle="tab"class="nav-link active">انواع ايرادات الصناديق</a>
		        </li>
		        <li class="nav-item">
			        <a href="#bExpense" data-toggle="tab"class="nav-link">انواع مصروفات الصناديق</a>
		        </li>

        <br>
	        </ul>
		</div>
    </div>
</div>

<div class="tab-content border-left border-bottom border-right border-top-0 p-4">

<!-- /////////////////////////////////////////////////////-->

<div class="tab-pane active" id="bIncome">
@can('عرض ايراد صندوق')
    <div class="row">
        <div class="col-md-10"></div>
            @can('اضافة ايراد صندوق')
            <div class="col-sm-2 text-right">
            <a href="/CMS/create/BoxIncome/{{$id}}" class="btn btn-primary btn-md">
            <i class="glyphicon glyphicon-plus">
            </i>اضافة نوع ايراد جديد </a>
            </div>
            @endcan
    </div><br>


                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive ls-table">

                                 <table class="table table-bordered table-striped table-hover"  id="boxIncome-table" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>اسم الايراد</th>
                                                <th>تاريخ الادخال</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
        </div>



                    @endcan

                        @cannot('عرض ايراد صندوق')
                            <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                ليس لديك صلاحية يرجي مراجعة المسؤول
                            </div>
                        @endcannot






<!-- /////////////////////////////////////////////////////-->


<div class="tab-pane" id="bExpense">
 @can('عرض صادر صندوق')
    <div class="row">
        <div class="col-md-10"></div>
        @can('اضافة صادر صندوق')
            <div class="col-sm-2 text-right">
            <a href="/CMS/create/BoxExpense/{{$id}}" class="btn btn-primary btn-md">
            <i class="glyphicon glyphicon-plus">
            </i> اضافة نوع مصروف جديد </a>
            </div>
            @endcan
    </div><br>


                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                 <table class="table table-bordered table-striped table-hover"  id="boxExpense-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>اسم المصروف</th>
                                            <th>تاريخ الادخال</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

                            @endcan

                            @cannot('عرض صادر صندوق')
                                <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    ليس لديك صلاحية يرجي مراجعة المسؤول
                                </div>
                            @endcannot
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
        setTimeout(function() {
            var id = $('#box_id').val();
            var crTable = $('#boxIncome-table').DataTable({
                dom: 'Bfrtip',
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                destroy: true,
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
                    url: '/CMS/datatables/BoxIncome/'+id,
                    data: function (d) {
                        d.searchBoxIncome = $('#boxIncome-table_filter input[type=search]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/BoxIncome/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/BoxIncome/'+row.id+'">حذف</a>';
                            var ress ='';
                                    @can('تعديل ايراد صندوق')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف ايراد صندوق')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
        },3000);

        setTimeout(function() {
            var id = $('#box_id').val();
            var crbTable = $('#boxExpense-table').DataTable({
                dom: 'Bfrtip',
                processing: true,
                serverSide: true,
                destroy: true,
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
                    url: '/CMS/datatables/BoxExpense/'+id,
                    data: function (d) {
                        d.searchBoxExpense = $('#boxExpense-table_filter input[type=search]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/BoxExpense/'+row.id+'/edit">تعديل</a>'
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/BoxExpense/'+row.id+'">حذف</a>'
                            var ress ='';
                                    @can('تعديل صادر صندوق')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف صادر صندوق')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
        },3000);
    </script>
@endsection
