@extends('layouts.master')
@section('css')


@section('title')
 Iwayc System

@endsection

@section('title-page-header')
{{ $title }}
@endsection
@section('page-header')
جرد مستودع
@endsection
@section('button1')
<form method="post"action="/CMS/EndInventory">
  @csrf
<input type="hidden"name="sumId" id="sumId0"value="">
<input type="hidden"name="repo" id="sumId0"value="{{$repo->id}}">
<button class="submit btn-danger btn" type="submit" name="submit">انهاء الجرد</button>
</form>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('AllInvenRepo') }}">رجوع</a>

@stop
@endsection
@section('content')


<div class="modal fade" id="favoritesModal"tabindex="-1" role="dialog"aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" style="">
      <div class="modal-header">
        <h4 class="modal-title"id="favoritesModalLabel">جرد مستودع</h4>
         <button aria-label="Close" class="close" data-dismiss="modal" type="button">
    <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button"class="btn btn-default"data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>

 <div class="row">
        <div class="col-md-6">
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
                                    <select name="section_h" id="section_h" class="form-control">
                                        <option value=""> اختر القسم .... </option>
                                        @foreach ($sections as $section )
                                         <option value="{{ $section->id }}">{{ $section->name }} </option>
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


	<div class="row">
        <div class="col-8">
            <h3>{{$repo->name}}</h3>
        </div>
        <div class="col">
            <h3>مجموع قيمة النقص: (<strong id="sumId">0</strong> دينار)</h3>
        </div>
    </div><br>
		<!-- row -->
				<div class="row">
                			<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                          <input type="hidden" name="rep_id" id="rep_id" value="{{$repo->id}}" >
							</div>
							<div class="card-body">
								<div class="table-responsive ls-table">
									<table id="users-table" class="table table-bordered table-striped table-hover">
                           <thead>
                            <tr>
                                <th>القسم</th>
                                <th>الصنف</th>
                                <th>الكمية المباعة</th>
                                <th>اخر سعر فردي</th>
                                <th>مجموع المبيعات</th>
                                <th>العدد المتوفر</th>
                            <th style="background-color: rgb(64, 188, 205)">عدد جرد الموجود</th>
                                <th>عدد النقص</th>
                                <th class="sumId">قيمة النقص</th>
                                <th></th>
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



				<!-- row closed -->

			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
  <script>
        $(function() {
            var riTable = $('#users-table').DataTable({
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
                searching: true,
                drawCallback: function () {
                    var json = riTable.ajax.json();

                    $('#sumId').replaceWith('<strong id="sumId">'+json.total_rem_price+'</strong>')
                    $('#sumId0').replaceWith('<input type="hidden"name="sumId" id="sumId0"value="'+json.total_rem_price+'">')
                },
                ajax: {
                    url: '/CMS/datatables/RepInventory',
                      data: function (d) {
                        d.searchMaterial = $('#users-table_filter input[type=search]').val();
                        d.sectionId = $('select[name=section_h]').val();
                    }
                },
                fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if ( aData['count_inv'] < aData['count'] && aData['count_inv']!=null)
                    {
                      {{--   $('td:eq(6)', nRow).css('background-color', 'rgb(64, 188, 205)');
                        $('td:eq(6)', nRow).css('color', 'White'); --}}
                    }
                },
                columns: [
                    { data: 'section_id', name: 'section_id' },
                    { data: 'material_id', name: 'material_id' },
                    { data: 'pay_count', name: 'pay_count' },
                    { data: 'last_price', name: 'last_price' },
                    { data: 'sum_pay', name: 'sum_pay' },
                    { data: 'count', name: 'count' },
                    {"mRender": function ( data, type, row ) {
                            var edit ='<a class="btn btn-success btn-sm" id="'+row.id+'"onclick="showModal(this)">تعديل</a>';

                            if(row.count_inv == null){
                                return edit;
                            }else{
                                return row.count_inv + " " +edit;
                            }}
                    },

                    { data: 'remaind', name: 'remaind' },
                    { data: 'rem_price', name: 'rem_price' },
                    {"mRender": function ( data, type, row ) {
                            var edit ='<a class="btn btn-sm btn-info" href="/CMS/add/RepInventory/'+row.id+'">تعديل</a>';
                            return edit;}
                    }
                ]
            });


            $('#section_h').change(function() {
                riTable.draw();
            });

        });

           function showModal(selectID) {

            var id = selectID.id;
            $.ajax({
            url: "{{url('/CMS/count_inv/')}}" + "/" + id,
            type: "GET",
            success: function (data) {

                $(".modal-body").html(data.html);
                $('#favoritesModal').modal();
            },
            error: function (error) {
                 console.log(error);
            }
        })

        }



    </script>
@endsection
