@extends('layouts.master')
@section('css')
<style>
.note-popover{
    display:none !important;
}
.note-toolbar {
       display:none !important;
}
</style>
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

<div class="mt-2">

    @can('اضافات مهمات ')
    <a class="btn btn-primary btn-md" href="{{ route('Task.create') }}"><i class='fas fa-plus'style="margin-left: 10px">إضافة مهمة جديدة</a>
    @endcan
    @can('مهماتي')
    <a href="/CMS/My/Task" class="btn btn-warning">مهماتي</a>
    @endcan
    @can('تقييم مهمات')


    <a href="/CMS/MyEnd/Task" class="btn btn-warning">طلبات تقيم المهام</a>
    @endcan
</div>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="CMS/My/Task">رجوع</a>

@stop
@endsection

@section('content')
@can('عرض مهمات')
 @if (  \App\Models\Task::where('id',$item->id)->first()->start_date != null &&\App\Models\Task::where('id',$item->id)->first()->end_date == null )

            <form method="POST" action="/CMS/Task/endTshow">@csrf
            <input type="hidden" value="{{ $item->id }}"name="task_id">
            <button  type="submit" class="btn btn-sm btn-danger tx-16" >انهاء المهمة</button><br><br><form>

@elseif (\App\Models\Task::where('id',$item->id)->first()->end_date != null &&\App\Models\Task::where('id',$item->id)->first()->start_date != null)
             <h5 class="tag tag-success tx-16">المهمه انتهت</h5>
@elseif (\App\Models\Task::where('id',$item->id)->first()->start_date == null)
             <h5 class="tag tag-danger tx-16">المهمه لم تفعل بعد</h5>
@endif
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="">


                           <div class="row">

                                 <div class="col">
                                <label class="control-label">عنوان المهمة:* </label>
                                    <input type="text" value="{{ $item->title }}" class="form-control disable">
                                </div>

                              <div class="col">
                                <label class="control-label">التصنيف:* </label>
                                     <input type="text" value="{{\App\Models\Option::find($item->category)->title}}" class="form-control disable">
                                </div>

                        </div><br>




                        <div class="row">
                            <div class="col">
                                       <label class="control-label">التفاصيل:* </label>
                                       <textarea  class="animatedTextArea form-control summernote " id="summernote" name="details"disabled>{!! $item->details !!}</textarea>

                            </div>
                        </div><br>


                       <div class="row">
                            <div class="col">
                                <label class=" control-label">ملاحظات: </label>

                                <div class="ls-group-input">
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>
                            </div>
                        </div><br>

                      <div class="row">
                            <div class="col">
                                <label class="col-md-3 control-label">الفعالية: </label>
                                 <input type="text" value="{{$item->active?'فعال':'غير فعال'}}" class="form-control disable">

                            </div>
                        </div><br>


                        </div><br>


        </div>
    </div>
</div>
<!-- row closed -->
@endcan

@cannot('عرض مهمات')
    <div class="col-md-offset-1 col-md-10 alert alert-danger" style="margin-bottom: 400px ;margin-top:10px"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        ليس لديك صلاحية يرجي مراجعة المسؤول
    </div>
@endcannot


</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
 <!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400,

    });
     $('#summernote').next().find(".note-editable").attr("contenteditable", false);
</script>

@endsection
