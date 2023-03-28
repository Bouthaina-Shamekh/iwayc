<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Student;
use App\Models\Absence_s;
use Illuminate\Http\Request;
use App\Models\Student_course;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\CMSBaseController;

class AbsenceSController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title="ادارة الغياب والمغادرة";
        $subtitle="غياب - تأخير الطلاب";
        $students=Student::where("isdelete",0)->where("active",1)->orderBy('nameAR')->get();
        return view("cms.absenceS.index",compact("title","subtitle","students"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $parentTitle="إضافة غياب - تأخير";
        $title="غياب - تأخير الطلاب";

            $student_courses=Student_course::leftJoin('students', 'students.id', '=', 'student_course.student_id')
                ->leftJoin('catch_receipts', 'student_course.id','=','catch_receipts.student_course_id')
            ->leftJoin('courses', 'courses.id', '=', 'student_course.course_id')
            ->select(['student_course.id','student_course.m_year', 'courses.courseAR', 'students.nameAR', 'student_course.price', 'student_course.isdelete', 'student_course.iswithdrawal', 'student_course.created_at'])
            ->where('student_course.isdelete','=','0')->where('student_course.m_year','=',$this->getMoneyYear())->where('catch_receipts.isdelete','=','0')->where('catch_receipts.m_year','=',$this->getMoneyYear())->orderBy('students.nameAR', 'asc')->orderBy('courses.courseAR', 'asc')->distinct('courses.courseAR')->get();

        return view("cms.absenceS.add",compact("title","parentTitle","student_courses"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'date' => 'required',
                'student_course_id' => 'required',
                'type' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

       Absence_s::create([
            'm_year' => $request->input("edu_year_h"),
            'date' => $request->input("date"),
            'student_course_id' => $request->input("student_course_id"),
            'type' => $request->input("type"),
            'delay_time' => $request->input("delay_time"),
            'notes' => $request->input("notes"),
            'created_by' => $this->getId()
        ]);

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/AbsenceS/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="عرض الاذونات ";
        $title="غياب - تأخير الطلاب";
        $item=Absence_s::where("id",$id)->where("isdelete",0)->first();
        
        $student_id =\App\Models\Student::find(\App\Models\Student_course::find($item->student_course_id)->student_id)->id;

        $student_course = Student_course::where('student_id', $student_id)->get('id');

       $id_array = $student_course->pluck('id')->toArray();
              $absencess = Absence_s::whereIn('student_course_id', $id_array)
                        ->where('type', '=', '0')
                        ->count();

                        $absencesss = Absence_s::whereIn('student_course_id', $id_array)
                        ->where('type', '=', '1')
                        ->count();

                        $hour_absencess = Absence_s::whereIn('student_course_id', $id_array)
                        ->where('type', '=', '1')
                        ->sum('delay_time');

                        $hour_absencesss = $hour_absencess/60;




       // dd($hour_absencesss);
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/AbsenceS/");
        }
        return view("cms.absenceS.show",compact("title","item","id","parentTitle",'absencess','absencesss','hour_absencesss'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {

        $parentTitle="تعديل الاذونات ";
        $title="غياب - تأخير الطلاب";

        $item=Absence_s::where("id",$id)->where("isdelete",0)->first();
        $student_courses=Student_course::leftJoin('students', 'students.id', '=', 'student_course.student_id')
            ->leftJoin('courses', 'courses.id', '=', 'student_course.course_id')
            ->select(['student_course.id','student_course.m_year', 'courses.courseAR', 'students.nameAR', 'student_course.price', 'student_course.isdelete', 'student_course.iswithdrawal', 'student_course.created_at'])
            ->where('student_course.isdelete',0)->where('student_course.m_year',$this->getMoneyYear())->orderBy('students.nameAR', 'asc')->orderBy('courses.courseAR', 'asc')->get();
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/AbsenceS/");
        }
        return view("cms.absenceS.edit",compact("title","item","id","student_courses","parentTitle"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        $this->validate($request,
        [
            'date' => 'required',
            'student_course_id' => 'required',
            'type' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);

        $item=Absence_s::find($id);
        $item->date=$request->input("date");
        $item->student_course_id=$request->input("student_course_id");
        $item->type=$request->input("type");
        $item->delay_time=$request->input("delay_time");
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/AbsenceS/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getYearFilter()
    {
        $student_courses=Student_course::leftJoin('students', 'students.id', '=', 'student_course.student_id')
            ->leftJoin('courses', 'courses.id', '=', 'student_course.course_id')
            ->select(['student_course.id','student_course.m_year', 'courses.courseAR', 'students.nameAR', 'student_course.price', 'student_course.isdelete', 'student_course.iswithdrawal', 'student_course.created_at'])
            ->where('student_course.isdelete',0)->where('student_course.m_year',$this->getMoneyYear())->where('student_course.payment','>',0)->orderBy('students.nameAR', 'asc')->orderBy('courses.courseAR', 'asc')->get();


        return Response::json( $student_courses );
    }

   // public function calculate()
   // {
     //   $absencess = Absence_s::get->where('type','=','1')->count();

      //  return view("cms.absenceS.show",compact("absencess"));
   // }

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Absence_s::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/AbsenceS/");
    }

}
