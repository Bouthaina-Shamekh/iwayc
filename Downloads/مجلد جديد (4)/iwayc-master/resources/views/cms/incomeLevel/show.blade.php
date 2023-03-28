

    <div class="row">
        <div class="col-md-12 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-body form_view">
                    <form id="formID" class="formular form-horizontal ls_form">

                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم مستوى الدخل:* </label>
                                    <input type="text" value="{{$item->name}}" class="form-control validate[required] text-input" id="name"
                                           name="name" disabled>
                                </div>
                        <div class="col">
                                <label class="control-label">الفترة من:* </label>
                                    <input type="text" value="{{$item->in_from}}" class="form-control datepicker" id="in_from"
                                           name="in_from" disabled>
                                </div>
                                 <div class="col">
                                <label class="control-label">الفترة الي:* </label>
                                    <input type="text" value="{{$item->in_to}}" class="form-control datepicker" id="in_to"
                                           name="in_to" disabled>
                                </div>
                            </div>

                        <div class="row">

                       <div class="col">
                                <label class="control-label">باقي من الايام:* </label>
                                    <input type="text" value="{{$item->remaind}}" class="form-control validate[required] text-input" id="remaind"
                                           name="remaind" disabled>
                                </div>
                                <div class="col">
                                <label class="control-label">المصاريف المتوقعة:* </label>
                                    <input type="text" value="{{$item->remaind}}" class="form-control validate[required] text-input" id="remaind"
                                           name="remaind" disabled>
                                </div>
                            </div><br>


                        <div class="row">
                            <div class="col">
                                <label class="control-label">مهارات الموظف:* </label>
                                    @if(count($in_boxes)>0)
                                        @foreach($in_boxes as $in_box)
                                            <?php $bb=\App\Models\Box::find($in_box->box_id);
                                        if($bb){
                                        ?>
                                            <span disabled class="tag tag-info"> {{$bb->name}} </span>
                                            <?php }?>
                                        @endforeach
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي صندوق</span>
                                    @endif
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">رصيد مستوى الدخل:* </label>
                                    <input type="text" value="{{$item->balance}}" class="form-control validate[required] text-input" id="balance"
                                           name="balance" disabled>
                                </div>
                            </div>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المستوي 1: </label>
                                    <input type="number" min="0" value="{{$item->level1}}" class="form-control text-input" id="level1"
                                           name="level1" disabled>
                                </div>
                            <div class="col">
                                <label class="control-label">المستوي 2: </label>
                                    <input type="number" min="0" value="{{$item->level2}}" class="form-control text-input" id="level2"
                                           name="level2" disabled>
                                </div>
                            <div class="col">
                                <label class="control-label">المستوي 3: </label>
                                    <input type="number" min="0" value="{{$item->level3}}" class="form-control text-input" id="level3"
                                           name="level3" disabled>
                                </div>

                            </div>




                        <div class="row">

                             <div class="col">
                                <label class="control-label">المستوي 4: </label>
                                    <input type="number" min="0" value="{{$item->level4}}" class="form-control text-input" id="level4"
                                           name="level4" disabled>
                                </div>
                                <div class="col">
                                <label class="control-label">المستوي 5: </label>
                                    <input type="number" min="0" value="{{$item->level5}}" class="form-control text-input" id="level5"
                                           name="level5" disabled>
                                </div>
                            </div>





                        <div class="row">
                            <div class="col">
                                <label class="control-label">فعال: </label>
                                    <input type="text" value="{{$item->active?"فعال":"غير فعال"}}" class="form-control" id="active"
                                           name="active" disabled>
                                </div>
                            </div>


                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-sm-10 text-center">
                                    {{--@can('تعديل موظف')--}}
                                    <a href="/CMS/IncomeLevel/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    {{--@endcan--}}
                                    <a href="/CMS/IncomeLevel/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


