

    <div class="row">

        <div class="col-md-10 col-md-offset-1">


            <div class="panel panel-default">

                <div class="panel-body form_view">
                    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/Task/ratio/{{$item->id}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">المرسل:* </label>
                                    <input type="text" value="{{\App\Models\User::find($item->sender)->name}}" class="form-control" id="sender"
                                           name="sender" disabled>

                            </div>
                                 <div class="col">
                                <label class="col-md-2 control-label">المستقبل:* </label>
                                    <input type="text" value="{{\App\Models\User::find($item->receiver)->name}}" class="form-control" id="receiver"
                                           name="receiver" disabled>

                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">

                                <label class="control-label">تقييم المهمة:* </label>
                           <div class="row">
                             <div class="col-10">
                                <input type="number" min="1" max="100" value="{{$item->evaluate}}" class="form-control validate[required] text-input" id="ratio"
                                           name="ratio" placeholder="أدخل تقييم المهمة">
                                    <div class="text-danger">{{$errors->first('ratio')}}</div>
                                </div>
                                 <div class="col">
                                <strong style="font-size: 26px" class="">%</strong>
                                </div>
                        </div>
                            </div>
                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-sm-10">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/End/Task/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>

                </div>
            </div>
        </div>
    </div>


