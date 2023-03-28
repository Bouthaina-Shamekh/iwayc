


    <div class="row">
        <div class="col-md-12 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-body form_view">
                    <form id="formID" class="formular form-horizontal ls_form">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">رقم السند الحاسوبي: </label>
                                    <input type="text" value="{{$item->id}}" class="form-control" id="id"
                                           name="id" disabled>
                                </div>

                                <div class="col">
                                <label class="control-label">رقم السند الورقي: </label>
                                    <input type="text" value="{{$item->id_comp}}" class="form-control" id="id_comp"
                                           name="id_comp" disabled>
                                </div>
                              <div class="col">
                                <label class="control-label">التاريخ: </label>
                                    <input type="text" value="{{$item->date}}" class="form-control" id="date"
                                           name="date" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الطالب والدورة المسجلة:* </label>
                                    <input type="text" value="{{\App\Models\Student::find(\App\Models\Student_course::find($item->student_course_id)->student_id)->nameAR}}" class="form-control" id="student_course_id"
                                           name="student_course_id" disabled>
                                </div>
                                 <div class="col">
                                <label class="control-label">الدورة:* </label>
                                    <input type="text" value="{{\App\Models\Course::find(\App\Models\Student_course::find($item->student_course_id)->course_id)->courseAR}}" class="form-control" id="student_course_id"
                                           name="student_course_id" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المبلغ المتبقي علي الدورة:* </label>
                                    <input type="text" value="{{$item->remainder}}" class="form-control" id="remainder"
                                           name="remainder" disabled>
                                </div>
                                 <div class="col">
                                <label class="control-label">المبلغ:* </label>
                                    <input type="text" value="{{$item->amount}}" class="form-control" id="amount"
                                           name="amount" disabled>
                                </div>

                             <div class="col" {{$item->cheque_info?"":"hidden"}}>
                                <label class="control-label">معلومات الشيك:* </label>
                                    <textarea class="animatedTextArea form-control" id="cheque_info" name="cheque_info" disabled>{{$item->cheque_info}}</textarea>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات:* </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes" disabled>{{$item->notes}}</textarea>
                                </div>

                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    @can('تعديل قبض دورة')
                                    <a href="/CMS/CatchReceipt/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/CatchReceipt/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>

                </div>
            </div>
        </div>
    </div>

