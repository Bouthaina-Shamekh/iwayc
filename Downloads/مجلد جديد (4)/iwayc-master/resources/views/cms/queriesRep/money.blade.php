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
                                <th>اسم الصندوق</th>
                                <th>اليوم</th>
                                <th>7 ايام</th>
                                <th>15 يوم</th>
                                <th>30 يوم</th>
                                <th>60 يوم</th>
                                <th>90 يوم</th>
                                <th>6 شهور</th>
                                @foreach($years as $year)
                                <th>{{$year->year}}</th>
                                @endforeach
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
                searching: false,
                pageLength: 12,
                lengthChange: false,
                orderBy:[0,'desc'],
                ajax: {
                    url: '/CMS/datatables/QueryMoney'
                },
                columns: [
                    { data: 'id', name: 'id', visible : false},
                    { data: 'name', name: 'name' },
                    { data: 'day1', name: 'day1' },
                    { data: 'day7', name: 'day7' },
                    { data: 'day15', name: 'day15' },
                    { data: 'day30', name: 'day30' },
                    { data: 'day60', name: 'day60' },
                    { data: 'day90', name: 'day90' },
                    { data: 'day180', name: 'day180' },
                    { data: 'total2025', name: 'total2025'}, // new
                    { data: 'total2020', name: 'total2020' }, // new
                    { data: 'total2019', name: 'total2019' },
                    { data: 'total2018', name: 'total2018' },
                    { data: 'total2017', name: 'total2017' },
                    { data: 'total2015', name: 'total2015' },
                    { data: 'total2014', name: 'total2014' },
                    { data: 'total2013', name: 'total2013' }, // new
                ]
            });
        });
    </script>
@endsection
