
@section('css')

@endsection


    @can('عرض ارشيف')

  <style>
      .note-editor .note-editable {

    font-size: 15px;
    font-weight: bold;
      }
  </style>
    <div class="row">
        <div class="col-md-12 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"> <strong style="color:#d43f3a;font-size: 18px;">{{$item->address}}</strong></h3>
                </div>
                <div class="panel-body form_view">
                    <form id="formID" class="formular form-horizontal ls_form">
                        <div class="row ls_divider">
                            <div class="col">
                                <label class=" control-label">القسم الرئيسي:
                                {{\App\Models\Option::find($item->section)->title}}
                                </label>
                           </div>
                           <div class="col">
                                <label class=" control-label">القسم الفرعي:
                                "{{\App\Models\Option::find($item->sub_section)->title}}
                                  </label>
                            </div>
                        </div><br>


                        <div class="row">
                            <div class="col">

                                       <textarea  class="animatedTextArea form-control summernote " id="summernote" name="details"disabled>{!! $item->details !!}</textarea>

                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">الصور: </label>
                                    @if(count($images)>0)
                                    <div class="ls-image-fluid-box">
                                    <div class="ls-fluid-box-gallery" style="display:-webkit-box !important;">

                                        @foreach($images as $image)
                                        <a class="col-md-2" href='{{ asset('images/userimage').'/'. $image->filename }}' title="" data-fluidbox class="col-2">
                                                <img src='{{ asset('images/userimage').'/'. $image->filename }}' alt="" title=""style="weight:90px;height:90px" />
                                            </a>

                                        @endforeach
                                        </div></div>
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي صورة لهذا الارشيف</span>
                                    @endif

                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">يظهر هذا المستند لـ: </label>


                                    @if(count($archive_veiws)>0)
                                        @foreach($archive_veiws as $archive_veiw)
                                            <span disabled class="tag tag-orange"> {{\App\Models\User::find($archive_veiw->user_id)->name}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي مستخدم لعرض الارشيف</span>
                                    @endif

                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">من يستطيع التعديل عليه: </label>


                                    @if(count($archive_edits)>0)
                                        @foreach($archive_edits as $archive_edit)
                                            <span disabled class="tag tag-orange"> {{\App\Models\User::find($archive_edit->user_id)->name}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي مستخدم لتعديل الارشيف</span>
                                    @endif

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
                                <label class="col-md-3 control-label">الفعالية: {{$item->active?'فعال':'غير فعال'}}</label>

                            </div>
                        </div><br>
                        <div class="row ">
                            <div class="col">
                                <label class="control-label"></label>
                                    @can('تعديل ارشيف')
                                    <a href="/CMS/Archive/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/Archive/" class="btn btn-danger"> إلغاء</a>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    @endcan
    @cannot('عرض ارشيف')
        <div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            ليس لديك صلاحية يرجي مراجعة المسؤول
        </div>
    @endcannot


@section('js')


@endsection
