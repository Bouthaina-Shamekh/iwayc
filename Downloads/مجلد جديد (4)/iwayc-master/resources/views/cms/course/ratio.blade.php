

    <div class="row">
        <div class="col-md-12 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-body form_view">
                    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Course/tratio/{{$item->id}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">المعلم:* </label>
                                    <input type="text" value="{{\App\Models\Teacher::find($item->teacher_id)->name}}" class="form-control" id="sender"
                                           name="teacher" disabled>
                                </div>

                        </div><br>
                            <div class="row">
                    <div class="col">
                                <label class="control-label">التقييم :* </label>
                         <div class="row">
                            <div class="col-10">
                            <input type="number" min="1" max="100" value="{{$item->ratio}}" class="form-control validate[required] text-input" id="ratio"
                                           name="ratio" placeholder="أدخل تقييم المعلم">
                                    <div class="text-danger">{{$errors->first('ratio')}}</div>
                                </div>
                                 <div class="col">
                                <strong style="font-size: 26px" class="">%</strong>
                            </div>
                          </div>
                       </div>
                        </div><br>


                        <div class="row">
                            <div class="col">
                                <label class="col-md-2 control-label">ملاحظات: </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="ratio_notes"
                                              placeholder="أدخل ملاحظات">{{$item->ratio_notes}}</textarea>
                                    <div class="text-danger">{{$errors->first('ratio_notes')}}</div>
                                </div>
                        </div><br>

                        <div class="row last">
                            <div class="col">
                            <label class="control-label"></label>
                            <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                            <a href="/CMS/Course/" class="btn btn-danger"> إلغاء</a>
                                </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


