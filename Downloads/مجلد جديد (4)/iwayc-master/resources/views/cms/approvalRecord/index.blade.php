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
<a class="btn btn-primary btn-md" href="{{ route('RecordDone.index') }}">ارشيف القرارات</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('home') }}">رجوع</a>
@stop
@endsection
@section('content')
@can('عرض موافقات الحركة ')



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
                        <th>القسم</th>
                        <th>الموظف المدخل</th>
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
@cannot('عرض موافقات الحركة ')
<div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    ليس لديك صلاحية يرجي مراجعة المسؤول
</div>
@endcannot
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section("js")

    <script>
        $(function () {
            var aTable = $('#users-table').DataTable({
                dom: 'Bfrtip',
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                buttons: [
                    {'extend': 'excel', 'text': 'أكسيل'},
                    {'extend': 'print', 'text': 'طباعة'},
                    {'extend': 'pdf', 'text': 'pdf'},
                    {'extend': 'pageLength', 'text': 'حجم العرض'},
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                },
                ajax: {
                    url: '/CMS/datatables/ApprovalRecord',
                    data: function (d) {
                        d.searchArchive = $('#users-table_filter input[type=search]').val();
                        d.subSectionId = $('select[name=sub_section_h]').val();
                        d.sectionId = $('select[name=section_h]').val();
                        d.activeId = $('select[name=active_h]').val();
                    }
                },
                columns: [
                    {data: 'section', name: 'section'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'date', name: 'date'},
                    {
                        "mRender": function (data, type, row) {
                            var show = '<a class="btn btn-xs btn-warning" href="/CMS/' + row.slug + '/' + row.row_id +'">عرض</a>';


                    
                            var approve = '<a class="btn btn-xs btn-info" href="/CMS/approve/ApprovalRecord/' + row.id + '">موافقة</a>';


                            var reject = '<a class="btn Confirm btn-xs btn-danger" href="/CMS/reject/ApprovalRecord/' + row.id + '">رفض</a>';
                            var ress = show + ' ' + approve + ' ' + reject;
                            return ress;
                        }
                        ,orderable: false
                    },
                ]
            });
            //filtering
            $('#sub_section_h').change(function () {
                aTable.draw();
            });
            $('#section_h').change(function () {
                aTable.draw();
            });
            $('#active_h').change(function () {
                aTable.draw();
            });
        });
    </script>
@endsection
