<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Option;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Receipt_course;
use App\Models\Student_course;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class CourseController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="شؤون الطلبه";
        $subtitle="الدورات الدراسيه";
        $items=Course::where('isdelete',0)->paginate(10);
        $teachers=Teacher::leftJoin('teachers_year', 'teachers_year.teacher_id','=','teachers.id')
            ->select(['teachers.id', 'teachers.name'])
            ->where('teachers_year.m_year','=',$this->getMoneyYear())
            ->where('teachers_year.active','=',1)->where('teachers.isdelete','=',0)->orderBy('teachers.name')->get();
        return view("cms.course.index",compact("title","subtitle","items","teachers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة دورة جديدة";
        $title="ادارة الدورات";
        $teachers=Teacher::leftJoin('teachers_year', 'teachers_year.teacher_id','=','teachers.id')
            ->select(['teachers.id', 'teachers.name', 'teachers.specialization', 'teachers.birthday', 'teachers.nationality', 'teachers.address', 'teachers.phone1', 'teachers.phone2', 'teachers.email', 'teachers.classification', 'teachers.notes', 'teachers_year.active', 'teachers.isdelete', 'teachers.created_at'])
            ->where('teachers_year.m_year','=',$this->getMoneyYear())
            ->where('teachers_year.active','=',1)->where('teachers.isdelete','=',0)->get();
        $ratios=Option::where('parent_id',5)->where('isdelete',0)->where('active',1)->orderBy('title','desc')->get();
        $categories=Option::where('parent_id',276)->where('isdelete',0)->where('active',1)->orderBy('title','desc')->get();
        $currentYear =$this->getMoneyYear();

        return view("cms.course.add",compact("title","parentTitle","teachers","ratios","categories","currentYear"));
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
            'courseAR' => 'required',
            'course_cate' => 'required',
            'begin' => 'required|date|date_format:Y-m-d',
            'course_time' => 'required',
            'reg_fees' => 'required',
            'decisions_fees' => 'required',
            'course_fees' => 'required',
            'total_fees_h' => 'required',
            'teacher_id' => 'required',
            'ratio_type' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل",
            "begin.date_format"=>"يجب ادخال التاريخ بصيغة d-m-Y",
            "begin.date"=>"يجب ادخال تاريخ صحيح",
        ]);

    $ratio_type = $request->input("ratio_type");
    $value_sum = $request->input("value_sum");
    if ($ratio_type == '29'){
        $value_sum = $request->input("value_sum_h");
    }

    $course = Course::create([
        'courseAR' => $request->input("courseAR"),
        'courseEN' => $request->input("courseEN"),
        'category_id' => $request->input("course_cate"),
        'm_year' => $request->input("edu_year_h"),
        'course_time' => $request->input("course_time"),
        'begin' => $request->input("begin"),
        'reg_fees' => $request->input("reg_fees"),
        'decisions_fees' => $request->input("decisions_fees"),
        'course_fees' => $request->input("course_fees"),
        'total_fees' => $request->input("total_fees_h"),
        'teacher_id' => $request->input("teacher_id"),
        'teacher_fees' => $request->input("teacher_fees"),
        'ratio_type' => $ratio_type,
        'ratio' => $request->input("ratio"),
        'percentage' => $request->input("percentage"),
        'value_sum' => $value_sum,
        'total_reg_student' => 0,
        'total_withdrawn_student' => 0,
        'active' => $request->input("active")?1:0,
        'notes' => $request->input("notes"),
        'created_by' => $this->getId()
    ]);

    $flasher->addSuccess("تمت عملية الاضافة بنجاح");
    return redirect("/CMS/Course/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="الدورات الدراسيه";
        $item=Course::where("id",$id)->where("isdelete",0)->first();
        $title="شؤون الطلبه";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Course/");
        }
        return view("cms.course.show",compact("title","item","id","parentTitle"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل الدورات ";
        $item=Course::where("id",$id)->where("isdelete",0)->first();
        $teachers=Teacher::leftJoin('teachers_year', 'teachers_year.teacher_id','=','teachers.id')
            ->select(['teachers.id', 'teachers.name', 'teachers.specialization', 'teachers.birthday', 'teachers.nationality', 'teachers.address', 'teachers.phone1', 'teachers.phone2', 'teachers.email', 'teachers.classification', 'teachers.notes', 'teachers_year.active', 'teachers.isdelete', 'teachers.created_at'])
            ->where('teachers_year.m_year','=',$this->getMoneyYear())->where('teachers_year.active','=',1)->get();
        $ratios=Option::where('parent_id',5)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $title="ادارة الدورات";
        $reg=Student_course::where('course_id',$id)->where('iswithdrawal',0)->count();
        $sCourse=Student_course::where('course_id',$id)->count();
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Course/");
        }
        $categories=Option::where('parent_id',276)->where('isdelete',0)->where('active',1)->orderBy('title','desc')->get();
        return view("cms.course.edit",compact("title","item","id","parentTitle","teachers","categories","ratios","reg","sCourse"));
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
            'courseAR' => 'required',
            'course_cate' => 'required',
            'begin' => 'required|date|date_format:Y-m-d',
            'course_time' => 'required',
            'reg_fees' => 'required',
            'decisions_fees' => 'required',
            'course_fees' => 'required',
            'total_fees_h' => 'required',
            'teacher_id' => 'required',
            'ratio_type' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل",
            "begin.date_format"=>"يجب ادخال التاريخ بصيغة d-m-Y",
            "begin.date"=>"يجب ادخال تاريخ صحيح",
        ]);

    $item=Course::find($id);
    $item->courseAR=$request->input("courseAR");
    $item->courseEN=$request->input("courseEN");
    $item->category_id=$request->input("course_cate");
    //$item->m_year=$request->input("m_year");
    $item->course_time=$request->input("course_time");
    $item->begin=$request->input("begin");
    $item->reg_fees=$request->input("reg_fees");
    $item->decisions_fees=$request->input("decisions_fees");
    $item->course_fees=$request->input("course_fees");
    $item->total_fees=$request->input("total_fees_h");
    $item->teacher_id=$request->input("teacher_id");
    $item->teacher_fees=$request->input("teacher_fees");
    $item->ratio_type=$request->input("ratio_type");
    $item->ratio=$request->input("ratio");
    $item->percentage=$request->input("percentage");
    $item->value_sum=$request->input("value_sum");
    $item->notes=$request->input("notes");
    $item->updated_by=$this->getId();
    $item->save();

    $flasher->addSuccess("تمت عملية الحفظ بنجاح");
    return redirect("/CMS/Course/");
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

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Course::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        Session::flash("msg","تمت عملية الحذف بنجاح");
        return redirect("/CMS/Course/");
    }

    public function getTeacherRatio($id){
        $item=Course::find($id);
       $returnHTML =  view("cms.course.ratio",compact("item"))->render();
       return response()->json(['html'=>$returnHTML]);
   }

   public function postTeacherRatio(Request $request,$id,FlasherInterface $flasher)
   {
       $this->validate($request,
           [
               'ratio' => 'required|numeric|min:1|max:100'
           ],
           [
               "ratio.min"=>"الرقم اقل من 1",
               "ratio.max"=>"الرقم اكبر من 100",
               "required"=>"يجب ادخال هذا الحقل"
           ]);

       $item=Course::find($id);
       $item->ratio=$request->input("ratio");
       $item->ratio_notes=$request->input("ratio_notes");
       $item->updated_by=$this->getId();
       $item->save();

       $flasher->addSuccess("تمت عملية الحفظ بنجاح");
       return redirect("/CMS/Course/");
   }
   public function getTeacherCo($id)
   {
       $course=Course::find($id);
       $teacher=Teacher::find($course->teacher_id);
       $amounts=0;
       $pay=0;
       $rem=0;
       $per=0;

       $isStudent_course=Student_course::where('course_id',$course->id)->count();
       if ($isStudent_course>0) {
           $student_courses = Student_course::where('course_id', $course->id)->get();
           if($course->ratio_type==29){
           foreach ($student_courses as $student_course) {
               if ($student_course->iswithdrawal==0){
                  // $minas = $student_course->price - $course->teacher_fees;
                   $isCatch_receipt=Catch_receipt::where('student_course_id',$student_course->id)->where('m_year',$this->getMoneyYear())->count();
                   if ($isCatch_receipt){
                       $amounts=Catch_receipt::where('student_course_id',$student_course->id)->where('m_year',$this->getMoneyYear())->sum('amount');
                       $per += $amounts * $course->percentage / 100;
                       $pay=0;
                       $amounts=0;
                   }
               }
               else{
                   $isWithdrawal=Withdrawal::where('student_course_id',$student_course->id)->count();
                   if ($isWithdrawal>0) {
                       $withdrawals = Withdrawal::where('student_course_id', $student_course->id)->get();
                       $am = 0;
                       foreach ($withdrawals as $withdrawal) {
                           $am += $withdrawal->teacher_fees;
                       }
                       $per += $am;
                   }
               }
           }
           }elseif($course->ratio_type==18){

           }else{

           }
       }

       $teacher_pay = 0;
       $isReceipt=Receipt_course::where('course_id',$course->id)->where('m_year',$this->getMoneyYear())->count();
       if ($isReceipt>0){
           $teacher_pay=Receipt_course::where('course_id',$course->id)->where('m_year',$this->getMoneyYear())->sum('amount');

       }

       return response()->json([
           'status' => '1',
           'teacherName' => $teacher->name,
           'teacherCourse' => $course->courseAR,
           'teacherFees' => number_format($course->teacher_fees,2),
           'value_sum' => number_format($course->value_sum,2),
           'teacherPerc' => $course->percentage,
           'teacherBegin' => $course->begin,
           'students'=> $course->total_reg_student,
           'ratio'=> $course->ratio_type,
           'teacherPer' => number_format($per,2),
           'teacherPay' => number_format($teacher_pay,2),
           'teacherRem' => number_format($per-$teacher_pay,2),
       ]);
   }

   public function getYearFilter()
   {
       $teachers=Teacher::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('active',1)->orderBy('name')->get();
       return Response::json( $teachers );
   }

   public function getCourseReport()
   {
       $title=" الماليه";
       $subtitle="حساب دورات العام";
       $courses=Course::where("isdelete",0)->where("active",1)->orderBy('courseAR')->get();
       $years = Course::where("isdelete",0)->where("active",1)->distinct()->get(['m_year']);
       $categories=Option::where('parent_id',276)->where('isdelete',0)->where('active',1)->orderBy('title','desc')->get();

       $teachers=Teacher::where('isdelete',0)->orderBy('name')->get();

       return view("cms.course.course",compact("title","subtitle","teachers","courses","years","categories"));
   }

   public function getTeacherFees()
   {
       $parentTitle="كشف حساب معلم";
       $title="شؤون المعلمين";

       $courses=Course::leftJoin('teachers', 'courses.teacher_id','=','teachers.id')->select(['teachers.name', 'courses.id', 'courses.courseAR'])
       ->where('courses.isdelete',0)->where('courses.m_year',$this->getMoneyYear())->orderBy('teachers.name')->get();

       return view("cms.course.teacher",compact("title","parentTitle","courses"));
   }

}
