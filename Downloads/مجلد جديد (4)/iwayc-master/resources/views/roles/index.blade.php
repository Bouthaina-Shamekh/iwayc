@extends('layouts.master')
@section('css')

@section('title')
Iwayc System

@endsection

@section('title-page-header')
المستخدمين

@endsection
@section('page-header')
صلاحيات المستخدمين

@endsection
@section('button1')
@can('اضافة صلاحية')
<a class="btn btn-primary btn-md" href="{{ route('roles.create') }}">إضافه صلاحيه جديده</a>
@endcan
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض صلاحية')



@if (session()->has('Add'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم اضافة الصلاحية بنجاح",
                type: "success"
            });
        }

    </script>
@endif

@if (session()->has('edit'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم تحديث بيانات الصلاحية بنجاح",
                type: "success"
            });
        }

    </script>
@endif

@if (session()->has('delete'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم حذف الصلاحية بنجاح",
                type: "error"
            });
        }

    </script>
@endif

<!-- row -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">



                        </div>
                    </div>
                    <br>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>

                                         @can('عرض صلاحية')
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('roles.show', $role->id) }}">عرض</a>
                                                @endcan

                                               @can('تعديل صلاحية')
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('roles.edit', $role->id) }}">تعديل</a>
                                                @endcan


                                        @if ($role->name !== 'owner')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',
                                                $role->id], 'style' => 'display:inline']) !!}
                                                {!! Form::submit('حذف', ['class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}

                                        @endif


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
</div>
<!-- row closed -->
@endcan
@cannot('عرض صلاحية')
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

@endsection
