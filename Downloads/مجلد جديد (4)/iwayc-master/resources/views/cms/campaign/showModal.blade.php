
    <div class="row">

        <div class="col-md-10 col-md-offset-1">



            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">عرض الحملات</h3>
                </div>
                <div class="panel-body form_view">
                    <form id="formID" class="formular form-horizontal ls_form">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="control-label">عنوان الحملة:* </label>
                                    <input type="text" value="{{$item->title}}" class="form-control" id="title"
                                           name="title" disabled>
                                </div>

                         <div class="col">
                                <label class=" control-label">تاريخ البداية:* </label>
                                    <input type="text" value="{{$item->start}}" class="form-control" id="start"
                                           name="start" disabled>
                                </div>

                        </div><br>


                        <div class="row">
                            <div class="col">
                                <label class="control-label">سنة الميلاد من:* </label>
                                    <input type="text" value="{{$b_from_view->filter_id}}" class="form-control" id="b_from"
                                           name="b_from" disabled>
                                </div>
                            <div class="col">
                                <label class="control-label">سنة الميلاد الي:* </label>
                                    <input type="text" value="{{$b_to_view->filter_id}}" class="form-control" id="b_to"
                                           name="b_to" disabled>
                                </div>

                        </div><br>


                        <div class="row">
                            <div class="col">
                                <label class="control-label">الجنس:* </label>
                                    @if(count($gender_veiws)>0)
                                        @foreach($gender_veiws as $gender_veiw)
                                            <span disabled class="tag tag-info"style=" font-size:17px;"> {{\App\Models\Option::find($gender_veiw->filter_id)->title}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="tag tag-danger">لم يتم اضافة اي فلتر</span>
                                    @endif
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المؤهل العلمي:* </label>
                                    @if(count($level_veiws)>0)
                                        @foreach($level_veiws as $level_veiw)
                                            <span disabled class="tag tag-orange tag-lg" style=" font-size:17px;"> {{\App\Models\Option::find($level_veiw->filter_id)->title}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="tag tag-danger">لم يتم اضافة اي فلتر</span>
                                    @endif
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المنطقة:* </label>
                                    @if(count($address_veiws)>0)
                                        @foreach($address_veiws as $address_veiw)
                                            <span disabled class="tag tag-blue"style=" font-size:17px;margin-top: 3px;"> {{\App\Models\Option::find($address_veiw->filter_id)->title}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="tag tag-danger">لم يتم اضافة اي فلتر</span>
                                    @endif
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">تصنيف الطالب:* </label>
                                    @if(count($classification_veiws)>0)
                                        @foreach($classification_veiws as $classification_veiw)
                                            <span disabled class="tag tag-purple"style=" font-size:17px;"> {{\App\Models\Option::find($classification_veiw->filter_id)->title}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="tag tag-danger">لم يتم اضافة اي فلتر</span>
                                    @endif
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الجنسية:* </label>
                                    @if(count($nationality_veiws)>0)
                                        @foreach($nationality_veiws as $nationality_veiw)
                                            <span disabled class="tag tag-indigo"style=" font-size:17px;"> {{\App\Models\Option::find($nationality_veiw->filter_id)->title}} </span>
                                        @endforeach
                                    @else
                                        <span disabled class="tag tag-danger">لم يتم اضافة اي فلتر</span>
                                    @endif
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">  تصنيف الدورات المسجلة للطالب:* </label>
                                    @if(count($course_veiws)>0)
                                        @foreach($course_veiws as $course_veiw)
                                           <?php $course= \App\Models\Option::find($course_veiw->filter_id);?>
                                            <span disabled class="tag tag-green"style=" font-size:17px;margin-top: 3px;"> {{$course->title}} </span>

                                        @endforeach
                                    @else
                                        <span disabled class="tag tag-danger">لم يتم اضافة اي فلتر</span>
                                    @endif
                                </div>
                            </div><br>


                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات:* </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">فعال: </label>
                                    <input type="text" value="{{$item->active?"فعال":"غير فعال"}}" class="form-control" id="active"
                                           name="active" disabled>
                                </div>
                            </div><br>




                    </form>

                </div>
            </div>
        </div>
    </div>

