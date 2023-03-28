<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Catch_receipt;
use App\Models\Student_course;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class StudentCourseController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title="شؤون الطلبه";
        $subtitle="تسجيل دوره";
        $students=Student_course::leftJoin('students', 'students.id','=','student_course.student_id')
            ->leftJoin('students_year', 'students_year.student_id','=','students.id')
            ->select(['students.id', 'students.nameAR'])
            ->where('students_year.m_year','=',$this->getMoneyYear())
            ->where('students_year.active','=',1)->where('students.isdelete','=',0)->orderBy('students.nameAR')->distinct('students.id')->get();

        $courses=Course::where("isdelete",0)->where('m_year',$this->getMoneyYear())->where("active",1)->orderBy('courseAR')->get();
        $student_courses=Student_course::get();
        $ss = [];
        foreach ($students as $student){
            foreach ($student_courses as $student_course) {
                if ($student->id == $student_course->student_id) {
                    array_push($ss, $student->id);
                }
            }
        }
        $s = array_unique($ss);
        $cc = [];
        foreach ($courses as $course){
            foreach ($student_courses as $student_course) {
                if ($course->id == $student_course->course_id) {
                    array_push($cc, $course->id);
                }
            }
        }
        $c = array_unique($cc);

        $teachers=Teacher::leftJoin('teachers_year', 'teachers_year.teacher_id','=','teachers.id')
            ->select(['teachers.id', 'teachers.name'])
            ->where('teachers_year.m_year','=',$this->getMoneyYear())
            ->where('teachers_year.active','=',1)->where('teachers.isdelete','=',0)
            ->orderBy('teachers.name')->get();

        return view("cms.studentCourse.index",compact("title","subtitle","students","courses","s","c","teachers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="تسجيل الطالب في الدورة";
        $title="ادارة الدورات";
        $linkApp="/CMS/StudentCourse/";
        $students=Student::leftJoin('students_year', 'students_year.student_id','=','students.id')
            ->select(['students.id', 'students.nameAR', 'students.birthday', 'oo.title as gender', 'o.title as address', 'students.phone1', 'students.whatsup', 'opt.title as level', 'op.title as classification', 'students_year.active', 'students.created_at'])
            ->where('students_year.m_year','=',$this->getMoneyYear())
            ->where('students_year.active','=',1)->where('students.isdelete','=',0)->orderBy('students.nameAR')->get();
        $courses=Course::where("isdelete",0)->where('m_year',$this->getMoneyYear())->where("active",1)->orderBy('courseAR')->get();
        return view("cms.studentCourse.add",compact("title","parentTitle","linkApp","students","courses"));
    }

    public function getYearFilter()
    {
        $students=Student::where("isdelete",0)->where('m_year',$this->getMoneyYear())->orderBy('nameAR')->where("active",1)->get();
        $courses=Course::where("isdelete",0)->where('m_year',$this->getMoneyYear())->where("active",1)->orderBy('courseAR')->get();

        return Response::json( $students,$courses );
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
            'student_id' => 'required',
            'price' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);

    $student_course = Student_course::create([
        'course_id' => $request->input("course_h"),
        'student_id' => $request->input("student_id"),
        'm_year' => $request->input("edu_year_h"),
        'year' => $request->input("year_h"),
        'price' => $request->input("price"),
        'payment' => $request->input("price"),
        'created_by' => $this->getId()
    ]);
    $course = Course::find($request->input("course_h"));
    $course->total_reg_student = $course->total_reg_student + 1;
    $course->save();

    $flasher->addSuccess("تمت عملية الاضافة بنجاح");
    return redirect("/CMS/StudentCourse/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل التسجيل بالدورة ";
        $item=Student_course::where("id",$id)->where("isdelete",0)->first();
        $courses=Course::where("isdelete",0)->where('m_year',$this->getMoneyYear())->where("active",1)->orderBy('courseAR')->get();
        $title="ادارة الدورات";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/StudentCourse/");
        }
        return view("cms.studentCourse.edit",compact("title","item","id","parentTitle","courses"));
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
                'price' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Student_course::find($id);
        $old_course=$item->course_id;
        $price = $item->price;
        $item->price=$request->input("price");
        $item->course_id=$request->input("course_id");
        $item->payment= $item->payment - ($price-$item->price);
        $item->updated_by=$this->getId();
        $item->m_year=$request->input("m_year");
        $item->save();
        if($old_course != $request->input("course_id") ){
            $old=Course::find($old_course);
            $totalReg=$old->total_reg_student;
            $old->total_reg_student=$totalReg-1;
            $old->save();

            $new=Course::find($request->input("course_id"));
            $totalReg=$new->total_reg_student;
            $new->total_reg_student=$totalReg+1;
            $new->save();


        }

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/StudentCourse/");
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

    public function isWithdrawal($id,FlasherInterface $flasher)
    {
        $item=Student_course::find($id);
        $item->iswithdrawal=1;
        $item->deleted_by=$this->getId();
        $item->save();

        $course = Course::find($item->course_id);
        $course->total_reg_student = $course->total_reg_student - 1;
        $course->total_withdrawn_student = $course->total_withdrawn_student + 1;
        $course->save();


        flash()->addWarning("تمت عملية الانسحاب بنجاح");
        return redirect("/CMS/StudentCourse/");
    }

    public function isDelete($id,FlasherInterface $flasher)
    {
        $msg = "لم تتم عملية الحذف";
        $item=Student_course::find($id);
        $catch_count=Catch_receipt::where('student_course_id',$id)->count();
        if ($item->payment == $item->price){
            $item->isdelete=1;
            $item->deleted_by=$this->getId();
            $item->save();
            $course = Course::find($item->course_id);
            $course->total_reg_student = $course->total_reg_student - 1;
            $course->save();
            $msg = "تمت عملية الحذف بنجاح مع عدم وجود دفعات سابقة";
        }elseif ($catch_count>0){
            $catch_receipt=Catch_receipt::where('student_course_id',$id)->get();
            $item->isdelete=1;
            $item->deleted_by=$this->getId();
            $item->save();
            foreach ($catch_receipt as $catch){
                $c=Catch_receipt::find($catch->id);
                $c->isdelete = 1;
                $c->save();
            }
            $course = Course::find($item->course_id);
            $course->total_reg_student = $course->total_reg_student - 1;
            $course->save();
            $msg = "تمت عملية الحذف بنجاح مع وجود دفعات سابقة";
        }
        flash()->addError($msg);

        return redirect("/CMS/StudentCourse/");
    }

    public function getStudent()
    {
        $title="ادارة الدورات";
        $subtitle="";
        $courses=Course::where("isdelete",0)->where('m_year',$this->getMoneyYear())->where("active",1)->orderBy('courseAR')->get();
        $teachers=Teacher::leftJoin('teachers_year', 'teachers_year.teacher_id','=','teachers.id')
            ->select(['teachers.id', 'teachers.name'])
            ->where('teachers_year.m_year','=',$this->getMoneyYear())
            ->where('teachers_year.active','=',1)->where('teachers.isdelete','=',0)
            ->orderBy('teachers.name')->get();
        // $student_courses=Student_course::get();
        // $cc = [];
        // foreach ($courses as $course){
        //     foreach ($student_courses as $student_course) {
        //         if ($course->id == $student_course->course_id) {
        //             array_push($cc, $course->id);
        //         }
        //     }
        // }
        // $c = array_unique($cc);
       // $teachers=Teacher::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('active',1)->orderBy('name')->get();


        return view("cms.studentCourse.course",compact("title","subtitle","teachers","courses"));
    }

}
