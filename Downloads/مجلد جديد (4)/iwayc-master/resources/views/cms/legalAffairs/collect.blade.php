

    <div class="row">
        <div class="col-md-12 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-body form_view">
                    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/LegalAffairs/addCollect/{{$item->id}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">المبالغ المحصلة:* </label>
                                    <input type="text" value="{{$item->collect_amount}}" class="form-control" id="sender" name="oldcollect_amount" disabled>

                            </div>
                             <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input type="text" value="{{$item->collect_amount}}" class="form-control" id="sender" name="collect_amount">

                            </div>
                        </div>


                        <div class="row">
                            <div class="col text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-12">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/LegalAffairs/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


