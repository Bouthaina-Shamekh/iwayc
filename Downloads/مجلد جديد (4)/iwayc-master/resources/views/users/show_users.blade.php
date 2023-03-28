@extends('layouts.master')
@section('css')
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

<!-- Internal Data table css -->

<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@section('title')
Iwayc System

@endsection

@section('title-page-header')
المستخدمين
@endsection
@section('page-header')
قائمة المستخدمين
@endsection
@section('button1')
@can('اضافة مستخدم')
<a class="btn btn-primary btn-md" href="{{ route('users.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه مستخدم جديد</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('users.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض مستخدم')




@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="col-sm-1 col-md-2">

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">اسم المستخدم</th>
                                <th class="wd-20p border-bottom-0">البريد الالكتروني</th>
                                <th class="wd-15p border-bottom-0">حالة المستخدم</th>
                                <th class="wd-15p border-bottom-0">نوع المستخدم</th>
                                <th class="wd-10p border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td>
                                        @if ($user->Status == 'مفعل')
                                           <input type="checkbox" value="{{$user->id}}" class="cbActive form-control form-control-sm" checked/>
                                        @else
                                            <input type="checkbox" value="{{$user->id}}" class="cbActive form-control form-control-sm" />
                                        @endif
                                    </td>

                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>

                                    <td>
                                        @can('صلاحيات المستخدم')
                                      <a title="صلاحيات المستخدم - {{$user->name}}" class="btn btn-sm IFrame btn-warning-gradient" href="/CMS/User/perm/{{$user->id}}"><i class="fa fa-lock"></i></a>
                                      @endcan

                                      @can('صلاحيات القوائم')
                                        <a title="صلاحيات القوائم - {{$user->name}}" class="btn btn-sm IFrame btn-warning  showModal" id="{{$user->id}}" onclick="showModal(this)"><i class="fa fa-list-alt"></i></a>
                                        @endcan


                                           @can('عرض مستخدم')
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info"
                                                title="عرض">عرض</a>
                                            @endcan


                                          @can('تعديل مستخدم')
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info"
                                                title="تعديل">تعديل</a>
                                                @endcan

                                              @can('حذف مستخدم')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-user_id="{{ $user->id }}" data-username="{{ $user->name }}"
                                                data-toggle="modal" href="#modaldemo8" title="حذف">حذف</a>
                                                @endcan

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->

   <!-- Modal effects -->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف المستخدم</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('users.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="user_id" id="user_id" value="">
                        <input class="form-control" name="username" id="username" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

<div class="modal fade" id="favoritesModal"tabindex="-1" role="dialog"aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog modaldialog" role="document">
    <div class="modal-content modalcontent" style="">
      <div class="modal-header">
        <h4 class="modal-title"id="favoritesModalLabel">صلاحيات المستخدم</h4>
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



</div>

</div>
<!-- /row -->
@endcan
@cannot('عرض مستخدم')
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

<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var user_id = button.data('user_id')
        var username = button.data('username')
        var modal = $(this)
        modal.find('.modal-body #user_id').val(user_id);
        modal.find('.modal-body #username').val(username);
    })



    function showModal(selectID) {

            var id = selectID.id;
            $.ajax({
            url: "{{url('/CMS/User/permission/')}}" + "/" + id,
            type: "GET",
            success: function (data) {

                $(".modal-body").html(data.html);
                $('#favoritesModal').modal();
                $('#summernote').summernote();
            },
            error: function (error) {
                 console.log(error);
            }
        })

        }


</script>

        <script>
        $(function(){
            $(".cbActive").click(function(){
                var id=$(this).val();
                $.get("/CMS/User/active/"+id);
                         not7();

            });
        });

    </script>

@endsection
