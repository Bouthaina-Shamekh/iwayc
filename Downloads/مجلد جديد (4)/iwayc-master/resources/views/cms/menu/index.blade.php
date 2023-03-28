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
@can('اضافة قائمة')
<a class="btn btn-primary btn-md" href="/CMS/Menu/add/{{$parent_id}}"><i class='fas fa-plus'style="margin-left: 10px"></i>إضافة خيار جديد </a>
@endcan
@endsection
@section('button2')
@if($parent_id!=0)
    <a href="/CMS/Menu/0" class="btn btn-primary btn-md">عودة</a>
    @else
    <a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@endif

@stop
@endsection
@section('content')
@can('عرض قائمة')
		<!-- row -->
        @if($items->count() > 0)
				<div class="row">
                			<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">

                    <h3 class="panel-title">{{ $itemstitle}}</h3>

							</div>
							<div class="card-body">
								  <div class="table-responsive ls-table">
                        <table class="table text-md-nowrap" id="example1">
                       <thead>
                            <tr>
                                <th width="8%"></th>
                                <th width="20%">عنوان القائمة</th>
                                <th width="2%">رابط القائمة</th>
                                <th width="10%">تاريخ الانشاء</th>
                                <th width="7.5%">الفعالية</th>
                                <th width="7.5%">الظهور في القائمة</th>
                                <th width="17%"></th>
                            </tr>
                            </thead>
                             <tbody>
                            @foreach($items as $a)
                            <tr>
                                <td>
                                    <select name="order_id" id="{{$a->id}}" class="form-control">
                                        <?php $i = 1; ?>
                                        @foreach($ordered as $order)
                                            <option {{$order->ordered==$a->ordered?"selected":""}} value="{{$order->ordered}}"> {{$i++}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>{{$a->title}}</td>
                                <td>{{$a->slug}}</td>
                                <td>{{$a->created_at->format('Y-m-d')}}</td>
                                <td><input type="checkbox" value="{{$a->id}}" class="cbActive form-control form-control-sm"
                                            {{$a->active?"checked":""}}  /></td>
                                <td><input type="checkbox" value="{{$a->id}}" class="cbShow form-control form-control-sm"
                                            {{$a->show_menu?"checked":""}}  /></td>
                                <td class="text-center">
                                    @can('عرض قائمة')
                                    @if($parent_id==0)
                                        <a class="btn btn-sm btn-primary" href="/CMS/Menu/{{$a->id}}"><i class="fa fa-list"></i></a>
                                    @endif()
                                    @endcan
                                    @can('عرض قائمة')
                                    <a class="btn btn-sm btn-success" href="/CMS/Menu/show/{{$a->id}}">عرض</a>
                                        @endcan
                                        @can('تعديل قائمة')
                                    <a class="btn btn-sm btn-info" href="/CMS/Menu/edit/{{$a->id}}">تعديل</a>
                                        @endcan
                                        @can('حذف قائمة')
                                    <a class="btn Confirm btn-sm btn-danger" href="/CMS/Menu/delete/{{$a->id}}">حذف</a>
                                        @endcan
                                </td>
                            </tr>
                            @endforeach()
                            </tbody>
                        </table>
                    </div>
                    {{$items->links()}}
							</div>
						</div>
					</div>
					<!--/div-->
				</div>


               </div>
				<!-- row closed -->
    @else
        <div class="alert alert-warning" > لا يوجد عناصر لعرضها </div>
    @endif()
    @endcan

    @cannot('عرض قائمة')
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

        $('select[name=order_id]').change(function() {
            var ord = $(this).val();
            var id = $(this).attr("id");
            $.ajax({
                url: "/CMS/Menu/ordered/"+id+"/"+ord,
                success: function (data) {
                    if (data.status==1)
                    {location.reload();
                     not7();
                    }
                    else{not8();}
                }

            })
        });

        $(function(){
            $(".cbActive").click(function(){
                var id=$(this).val();

                $.get("/CMS/Menu/active/"+id);
                     not7();

            });
        });
        $(function(){
            $(".cbShow").click(function(){
                var id=$(this).val();
                $.get("/CMS/Menu/showMenu/"+id);
                  not7();
            });
        });
    </script>
@endsection
