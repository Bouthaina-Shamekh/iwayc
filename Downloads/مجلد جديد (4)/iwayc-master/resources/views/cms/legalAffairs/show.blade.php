

    <div class="row">
        <div class="col-md-12 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-body form_view">
                    <form id="formID" class="formular form-horizontal ls_form">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم الطالب:* </label>
                                    <input type="text" value="{{\App\Models\Student::find(\App\Models\Student_course::find($item->student_course_id)->student_id)->nameAR}} - {{\App\Models\Course::find(\App\Models\Student_course::find($item->student_course_id)->course_id)->courseAR}}" class="form-control validate[required] text-input" id="student_course_id"
                                           name="student_course_id" disabled>
                                </div>

                            <div class="col">
                                <label class="control-label">الهواتف المتوفرة:* </label>
                                    <input type="text" value="{{$item->phone}}" class="form-control validate[required] text-input" id="phone"
                                           name="phone" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">الرسوم:* </label>
                                    <input type="text" value="{{$item->fees}}" class="form-control validate[required] text-input" id="fees"
                                           name="fees" disabled>
                                </div>
                            <div class="col">
                                <label class="control-label">المبلغ المستحق:* </label>
                                    <input type="text" value="{{$item->fees_owed}}" class="form-control validate[required] text-input" id="fees_owed"
                                           name="fees_owed" disabled>
                                </div>
                              <div class="col">
                                <label class="control-label">تاريخ اول مطالبة:* </label>
                                    <input type="text" value="{{$item->first_claim}}" class="form-control validate[required] text-input" id="first_claim"
                                           name="first_claim" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">عدد ايام التأخير:* </label>
                                    <input type="text" value="{{$item->count_day}}" class="form-control validate[required] text-input" id="count_day"
                                           name="count_day" disabled>
                                </div>
                          <div class="col">
                                <label class="control-label">غرامة اليوم:* </label>
                                    <input type="text" value="{{$item->fine_day}}" class="form-control validate[required] text-input" id="fine_day"
                                           name="fine_day" disabled>
                                </div>
                          <div class="col">
                                <label class="control-label">غرامة التأخير:* </label>
                                    <input type="text" value="{{$item->fine_delay}}" class="form-control validate[required] text-input" id="fine_delay"
                                           name="fine_delay" disabled>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المبلغ الكلي المستحق:* </label>
                                    <input type="text" value="{{$item->total_amount}}" class="form-control validate[required] text-input" id="total_amount"
                                           name="total_amount" disabled>
                                </div>

                         <div class="col">
                                <label class="control-label">الحالة:* </label>
                                    <input type="text" value="{{\App\Models\Option::find($item->status)->title}}" class="form-control validate[required] text-input" id="status"
                                           name="status" disabled>
                                </div>

                        </div><br>
                        {{--<div class="row">
                            <div class="col">
                                <label class="control-label">الضمان:* </label>


                                    <input type="text" value="{{$item->warranty}}" class="form-control validate[required] text-input" id="warranty"
                                           name="warranty" disabled>
                                </div>
                            </div>
                        </div>--}}

                        <div class="row">
                            <div class="col">
                                <label class="control-label">ملاحظات:* </label>
                                    <textarea class="animatedTextArea form-control" id="notes" name="notes"
                                              disabled>{{$item->notes}}</textarea>
                                </div>

                        </div><br>

                        <div class="row last">
                            <div class="col text-center">
                                <label class="control-label"></label>
                                <div class="col-sm-12">
                                    @can('تعديل شؤون قانونية')
                                    <a href="/CMS/LegalAffairs/{{$item->id}}/edit" class="submit btn-primary btn" type="submit" name="submit">تعديل</a>
                                    @endcan
                                    <a href="/CMS/LegalAffairs/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>

                </div>
            </div>
        </div>
    </div>

