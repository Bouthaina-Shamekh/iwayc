@extends('layouts.master')
@section('css')
<link
      href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css"rel="stylesheet"/>

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
@can('اضافة اذن موظف')
<a class="btn btn-primary btn-md" href="{{ route('Absence.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه اذن جديد </a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض اذن موظف')

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
                                        <select name="employee_h" id="employee_h" class="form-control">
                                            <option value=""> اختر اسم الموظف.... </option>
                                            @foreach($employees as $employee)
                                                <option {{old("employee_h")==$employee->id?"selected":""}} value="{{$employee->id}}"> {{$employee->name}} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="type_h" id="type_h" class="form-control">
                                            <option value=""> اختر تصنيف المغادرة.... </option>
                                            @foreach($types as $type)
                                                <option {{old("type_h")==$type->id?"selected":""}} value="{{$type->id}}"> {{$type->title}} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="leaving_h" id="leaving_h" class="form-control">
                                            <option value=""> اختر غاية المغادرة.... </option>
                                            @foreach($leavings as $leaving)
                                                <option {{old("leaving_h")==$leaving->id?"selected":""}} value="{{$leaving->id}}"> {{$leaving->title}} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="region_h" id="region_h" class="form-control">
                                            <option value=""> اختر المنطقة.... </option>
                                            @foreach($regions as $region)
                                                <option {{old("region_h")==$region->id?"selected":""}} value="{{$region->id}}"> {{$region->title}} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                        <br>
                        <table class="table table-bordered table-striped table-hover">
                            <h5><strong>فرز بحسب تاريخ الطلب : </strong></h5>
                            <tbody>
                                <tr>
                                    <td>
                                        <input onchange="$('#to_h').val(this.value);document.getElementById('to_h').min=this.value;"
                                               type="text" value="{{old("from_h")}}"
                                               class="form-control fc-datepicker" id="from_h" name="from_h" placeholder="من....">
                                    </td>
                                    <td>
                                        <input type="text" value="{{old("to_h")}}"
                                               class="form-control fc-datepicker" id="to_h" name="to_h" placeholder="الي....">
                                    </td>
                                    <td>
                                        <a class="tag tag-orange" id="search_h" name="search_h">بحث</a>
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
     <h3 class="panel-title pull-left"> عدد المرات : <strong id="count_rows"></strong></h3>
</div>
<div class="col-2">
    <h3 class="panel-title pull-right"> مجموع المدة : <Strong id="sum_diff"></Strong></h3>
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
								   {!! $dataTable->table() !!}
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
				</div>


            </div>
				<!-- row closed -->
                @endcan

                @cannot('عرض اذن موظف')
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
   <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
      integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
     {!! $dataTable->scripts() !!}
    <script>

        $(document).ready(function () {

            let t = $('#dataTableBuilder');
            let table = t.DataTable();

            t.on('preXhr.dt', function ( e, settings, data ) {
                data.employee_h = $('#employee_h').val();
                data.type_h = $('#type_h').val();
                data.leaving_h = $('#leaving_h').val();
                data.region_h = $('#region_h').val();
                data.from_h = $('#from_h').val();
                data.to_h = $('#to_h').val();
                data.money_id = $('#money_id').val();
                data.search_h = $('#dataTableBuilder_filter input[type=search]').val();
            });
            //filtering
            $('#employee_h').change(function() {
                table.draw();
            });
            $('#type_h').change(function() {
                table.draw();
            });
            $('#leaving_h').change(function() {
                table.draw();
            });
            $('#region_h').change(function() {
                table.draw();
            });
            $('#search_h').click(function(e) {
                e.preventDefault();
                table.draw();
            });
            $('#money_id').change(function() {
                table.draw();
            });
            table.on( 'xhr', function () {
                var json = table.ajax.json();
                $("#count_rows").replaceWith('<Strong id="count_rows">'+json.count_rows+'</Strong>');
                $("#sum_diff").replaceWith('<Strong id="sum_diff">'+json.sum_diff+'</Strong>');

            });
        });

 var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();


        //hour-out function
        function fOut(selectID) {
            var id=selectID.id;
            var btn='btnIn'+id;
            $.ajax({
                url: "/CMS/Absence/Out/" + id,
                success: function (data) {
                    $(selectID).replaceWith(data['hour_out']);
                    $("button[name="+btn+"]").prop("disabled", false);
                    alert('تمت العملية بنجاح')
                }
            })
        }
        //hour-in function
        function fIn(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Absence/In/" + id,
                success: function (data) {
                    $(selectID).replaceWith(data['hour_in']);
                    alert('تمت العملية بنجاح')
                }
            })
        }
    </script>

@endsection
