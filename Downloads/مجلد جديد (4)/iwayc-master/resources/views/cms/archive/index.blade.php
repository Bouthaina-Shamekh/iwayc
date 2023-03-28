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
<a class="btn btn-primary btn-md" href="{{ route('Archive.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه ارشيف جديد</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض ارشيف')

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
                                    <select name="section_h" id="section_h" class="form-control">
                                        <option value=""> اختر القسم الرئيسي.... </option>
                                        @foreach($sections as $section)
                                            <option {{old("section_h")==$section->id?"selected":""}} value="{{$section->id}}"> {{$section->title}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="sub_section_h" id="sub_section_h" class="form-control">
                                        <option value=""> اختر القسم الرئيسي اولا.... </option>
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
                                <th>العنوان</th>
                                <th>القسم الرئيسي</th>
                                <th>القسم الفرعي</th>
                                <th>الحالة</th>
                                <th>تاريخ الانشاء</th>
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
                @endcan

                @cannot('عرض ارشيف')
        <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            ليس لديك صلاحية يرجي مراجعة المسؤول
        </div>
    @endcannot
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->

<div class="modal fade" id="favoritesModal2"tabindex="-1" role="dialog"aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog modaldialog" role="document">
    <div class="modal-content modalcontent" style="">
      <div class="modal-header">
        <h4 class="modal-title"id="favoritesModalLabel">سجل الارشيف العام </h4>
         <button aria-label="Close" class="close" data-dismiss="modal" type="button">
    <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body modalbody">

      </div>
      <div class="modal-footer">
        <button type="button"class="btn btn-default"data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
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
        window.onload = function() {
            var t = document.getElementsByClassName("note-toolbar")[0];
            t.style.display = "none";
        }
    </script>
    <script>
        jQuery(document).ready(function($){
            $('#section_h').change(function(){
                var id=$(this).val();
                $.get("/CMS/Section/" + id,
                    function(data) {
                        var model = $('#sub_section_h');
                        model.empty();
                        model.append('<option value=""> اختر القسم الفرعي.... </option>');

                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id +"'>" + element.title + "</option>");
                        });
                    });
            });
        });

        $(function() {
            var aTable = $('#users-table').DataTable({
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
                    url: '/CMS/datatables/Archive',
                    data: function (d) {
                        d.searchArchive = $('#users-table_filter input[type=search]').val();
                        d.subSectionId = $('select[name=sub_section_h]').val();
                        d.sectionId = $('select[name=section_h]').val();
                        d.activeId = $('select[name=active_h]').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'address', name: 'address' },
                    { data: 'section', name: 'section' },
                    { data: 'sub_section', name: 'sub_section' },
                    {"mRender": function ( data, type, row ) {
                            var cbAct = '<input type="checkbox" value="0" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" />';
                            if(row.activeI==1){
                                cbAct = '<input type="checkbox" value="1" class="form-control form-control-sm" id="'+row.id+'" onclick="fAct(this)" checked />';
                            }
                            return cbAct;
                        }
                        ,orderable: false},
                    { data: 'created_at', name: 'created_at' },
                    {"mRender": function ( data, type, row ) {
                            var show ='<a class="btn btn-sm btn-success showModal" id="'+row.id+'" onclick="showModal(this)">عرض</a>';
                            var edit ='<a class="btn btn-sm btn-primary" href="/CMS/Archive/'+row.id+'/edit">تعديل</a>';
                            var dele ='<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Archive/'+row.id+'">حذف</a>';
                            var ress ='';
                            @can('عرض ارشيف')
                                ress=ress+' '+show;
                            @endcan
                                    @can('تعديل ارشيف')
                                ress=ress+' '+edit;
                            @endcan
                                    @can('حذف ارشيف')
                                ress=ress+' '+dele;
                            @endcan
                            return ress;}
                    }
                ]
            });
            //filtering
            $('#sub_section_h').change(function() {
                aTable.draw();
            });
            $('#section_h').change(function() {
                aTable.draw();
            });
            $('#active_h').change(function() {
                aTable.draw();
            });
        });
        //Activation function
        function fAct(selectID) {
            var id=selectID.id;
            $.ajax({
                url: "/CMS/Archive/active/" + id,
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
            url: "{{url('/CMS/Archive/')}}" + "/" + id,
            type: "GET",
            success: function (data) {

                $(".modalbody").html(data.html);
                $('#favoritesModal2').modal();
                $('#summernote').summernote();
            },
            error: function (error) {
                 console.log(error);
            }
        })


        }
    </script>
@endsection
