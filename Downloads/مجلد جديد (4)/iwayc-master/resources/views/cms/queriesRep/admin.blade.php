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
@section('content')
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
                        <th>الموضوع</th>
                        <th>العدد الكلي</th>
                        <th>اليوم</th>
                        <th>7 ايام</th>
                        <th>15 يوم</th>
                        <th>30 يوم</th>
                        <th>60 يوم</th>
                        <th>90 يوم</th>
                        <th>6 شهور</th>
                        <th>{{date('Y')-1}}</th>
                        <th>{{date('Y')-2}}</th>
                        <th>{{date('Y')-3}}</th>
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
@section("js")
    <script>
        $(function() {
            var qTable = $('#users-table').DataTable({
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
                searching: false,
                pageLength: 20,
                lengthChange: false,
                orderBy:[0,'desc'],
                ajax: {
                    url: '/CMS/datatables/QueryAdmin'
                },
                columns: [
                    { data: 'id', name: 'id', visible : false},
                    { data: 'subject', name: 'subject' },
                    { data: 'count', name: 'count' },
                    { data: 'day1', name: 'day1' },
                    { data: 'day7', name: 'day7' },
                    { data: 'day15', name: 'day15' },
                    { data: 'day30', name: 'day30' },
                    { data: 'day60', name: 'day60' },
                    { data: 'day90', name: 'day90' },
                    { data: 'day180', name: 'day180' },
                    { data: 'last1', name: 'last1' },
                    { data: 'last2', name: 'last2' },
                    { data: 'last3', name: 'last3' }
                ]
            });
        });
    </script>
@endsection
