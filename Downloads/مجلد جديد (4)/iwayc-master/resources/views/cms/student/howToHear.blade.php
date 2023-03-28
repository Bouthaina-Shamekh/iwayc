@extends('layouts.master')
@section('css')


@section('title')
 Iwayc System

@endsection

@section('title-page-header')
{{ $title }}
@endsection
@section('page-header')
{{ $parentTitle }}

@endsection
@section('button1')

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')

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
                                    <select name="how_id" id="how_id" class="form-control">
                                        <option value=""> اختر الطريقة .... </option>
                                        @foreach($hows as $how)
                                            <option {{old("how_id")==$how->id?"selected":""}} value="{{$how->id}}"> {{$how->title}} </option>
                                        @endforeach
                                    </select>
                                </td>

                                        <td>
                                            <input type="text" value="{{old("from_1_h")}}"class="form-control text-input fc-datepicker" id="from_1_h" name="from_1_h" placeholder="من....">
                                        </td>
                                        <td>
                                            <input type="text" value="{{old("to_1_h")}}"class="form-control text-input fc-datepicker" id="to_1_h" name="to_1_h" placeholder="الي...">
                                        </td>
                                        <td>
                                        <a class="btn btn-primary" id="search_1_h" name="search_1_h">بحث</a>
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
                                <!--<th></th>--->
                                <th>طريقة كيف سمعت عنا</th>
                                <th>مجموع التعداد</th>

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
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')

<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>



 <script>
var date = $('.fc-datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
        $(function() {
            var hTable = $('#users-table').DataTable({
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
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                columnDefs: [{
                        targets: '_all',
                        render: function(data, type, row) {
                            if (type === 'PDF') {
                                return String(data).split(' ').reverse().join('  ');
                            }  return data;} }
                   ],

                ajax: {
                    url: '/CMS/datatables/HowHear',
                    data: function (d) {
                        d.searchHow = $('#users-table_filter input[type=search]').val();
                        d.howId = $('select[name=how_id]').val();
                        d.fromId = $('#from_1_h').val();
                        d.toId = $('#to_1_h').val();

                    }
                },
                columns: [
                   /* {data: 'DT_Row_Index',name: 'DT_Row_Index', orderable: false, searchable: false},
                   { data: 'id', name: 'id' },*/
                    { data: 'way', name: 'way' },
                    { data: 'total', name: 'total'},

                ]
            });
            //filtering
            $('#how_id').change(function() {
                hTable.draw();

        });
        $('#search_1_h').click(function(e) {
                e.preventDefault();
                hTable.draw();
            });
        });

        $(function() {
            $(".datepicker1").datepicker(
                {
                    dateFormat: 'yy-mm-dd'
                });
            $(".datepicker1").val('');
        });

    </script>

@endsection
