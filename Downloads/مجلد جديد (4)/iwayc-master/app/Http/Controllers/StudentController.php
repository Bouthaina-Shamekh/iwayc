<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Option;
use App\Models\Student;
use App\Models\Money_year;
use App\Models\Student_year;
use Illuminate\Http\Request;
use App\Models\Student_course;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class StudentController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="سجل البيانات العامة";
        $subtitle="بيانات الطلاب العام";
        $items=Student::where('isdelete',0)->paginate(10);
        $addresses=Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->get();
        $classes=Option::where('parent_id',12)->where('isdelete',0)->where('active',1)->get();
        $levels=Option::where('parent_id',59)->where('isdelete',0)->where('active',1)->get();
        return view("cms.student.index",compact("title","subtitle","items","addresses","classes","levels"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة طالب جديد";
        $title="ادارة الطلاب";
        $genders=Option::where('parent_id',62)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $addresses=Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $classes=Option::where('parent_id',12)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $nationalities=Option::where('parent_id',55)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $works=Option::where('parent_id',185)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $levels=Option::where('parent_id',59)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $hows=Option::where('parent_id',51)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        return view("cms.student.add",compact("title","parentTitle","hows","levels","works","genders","addresses","classes","nationalities"));
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
                'nameAR' => 'required|unique:students',
                'birthday' => 'required',
                'gender' => 'required',
                'place_birth' => 'required',
                'nationality' => 'required',
                'address' => 'required',
                'phone1' => 'required',
                'phone2' => 'required',
                'level' => 'required',
                'work' => 'required',
                'classification' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ,"unique"=>"هذا الطالب مسجل من قبل"
            ]);

        $student = Student::create([
            'm_year' => $request->input("edu_year_h"),
            'nameAR' => $request->input("nameAR"),
            'nameEN' => $request->input("nameEN"),
            'birthday' => $request->input("birthday"),
            'gender' => $request->input("gender"),
            'place_birth' => $request->input("place_birth"),
            'nationality' => $request->input("nationality"),
            'address' => $request->input("address"),
            'email' => $request->input("email"),
            'how_listen' => $request->input("how_listen"),
            'phone1' => $request->input("phone1"),
            'phone2' => $request->input("phone2"),
            'whatsup' => $request->input("whatsup"),
            'level' => $request->input("level"),
            'work' => $request->input("work"),
            'classification' => $request->input("classification"),
            'active' => $request->input("active")?1:0,
            'notes' => $request->input("notes"),
            'created_by' => $this->getId()
        ]);

        if ($student){
            $money_years=Money_year::where('isdelete',0)->where('active',1)->get();
            foreach ($money_years as $money_year){
                $isStudent_year=Student_year::where('student_id',$student->id)->where('m_year',$money_year->year)->count();
                if ($isStudent_year>0){
                    $student_year=Student_year::where('student_id',$student->id)->where('m_year',$money_year->year)->first();
                    if ($money_year->year == $this->getMoneyYear()){
                        $student_year->active=$request->input("active")?1:0;
                    }else{
                        $student_year->active=0;
                    }
                    $student_year->updated_by= $this->getId();
                    $student_year->save();
                }else{
                    $student_year= new Student_year();
                    $student_year->student_id=$student->id;
                    $student_year->m_year=$money_year->year;
                    if ($money_year->year == $this->getMoneyYear()){
                        $student_year->active=$request->input("active")?1:0;
                    }else{
                        $student_year->active=0;
                    }
                    $student_year->created_by= $this->getId();
                    $student_year->save();
                }
            }
        }

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/Student/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="عرض الطلاب ";
        $item=Student::where("id",$id)->where("isdelete",0)->first();
        $std_active=Student_year::where('student_id',$id)->where('m_year',$this->getMoneyYear())->first();
        $title="ادارة الطلاب";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Student/");
        }
        return view("cms.student.show",compact("title","item","id","parentTitle",'std_active'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {

        $parentTitle="تعديل الطلاب ";
        $item=Student::where("id",$id)->where("isdelete",0)->first();
        $std_active=Student_year::where('student_id',$id)->where('m_year',$this->getMoneyYear())->first();
        $genders=Option::where('parent_id',62)->where('isdelete',0)->where('active',1)->get();
        $addresses=Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->get();
        $classes=Option::where('parent_id',12)->where('isdelete',0)->where('active',1)->get();
        $nationalities=Option::where('parent_id',55)->where('isdelete',0)->where('active',1)->get();
        $works=Option::where('parent_id',185)->where('isdelete',0)->where('active',1)->get();
        $levels=Option::where('parent_id',59)->where('isdelete',0)->where('active',1)->get();
        $hows=Option::where('parent_id',51)->where('isdelete',0)->where('active',1)->get();
        $title="ادارة الطلاب";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Student/");
        }
        return view("cms.student.edit",compact("title","item","std_active","parentTitle","id","genders","addresses","classes","nationalities","works","levels","hows"));
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
            'nameAR' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'place_birth' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'phone1' => 'required',
            'phone2' => 'required',
            'level' => 'required',
            'work' => 'required',
            'classification' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);

    $item=Student::find($id);
    $item->nameAR=$request->input("nameAR");
    $item->nameEN=$request->input("nameEN");
    $item->birthday=$request->input("birthday");
    $item->gender=$request->input("gender");
    $item->place_birth=$request->input("place_birth");
    $item->nationality=$request->input("nationality");
    $item->address=$request->input("address");
    $item->email=$request->input("email");
    $item->how_listen=$request->input("how_listen");
    $item->phone1=$request->input("phone1");
    $item->phone2=$request->input("phone2");
    $item->whatsup=$request->input("whatsup");
    $item->level=$request->input("level");
    $item->work=$request->input("work");
    $item->classification=$request->input("classification");
    $item->active=$request->input("active")?1:0;
    $item->notes=$request->input("notes");
    $item->updated_by=$this->getId();
    $item->save();

    if ($item){
        $isStudent_year=Student_year::where('student_id',$item->id)->where('m_year',$this->getMoneyYear())->count();
        if ($isStudent_year>0){
            $student_year=Student_year::where('student_id',$item->id)->where('m_year',$this->getMoneyYear())->first();
            $student_year->active=$request->input("active")?1:0;
            $student_year->updated_by= $this->getId();
            $student_year->save();
        }

    }

    $flasher->addSuccess("تمت عملية الحفظ بنجاح");
    return redirect("/CMS/Student/");
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

    public function getStudent()
    {
        $subtitle="كشف حساب طالب";
        $title="شوؤن الطلبه";
        $students=Student::where("isdelete",0)->orderBy('nameAR')->get();
        $courses=Course::where("isdelete",0)->orderBy('courseAR')->get();
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
        $year=Money_year::where("isdelete",0)->orderBy('year')->get();
        return view("cms.student.student",compact("title","subtitle","s","c","year"));
    }

    public function getYearStudents()
    {
        $title="شؤون الطلبه";
        $subtitle=" طلاب العام الحالى";

        $items=Student::leftJoin('students_year', 'students_year.student_id','=','students.id')
            ->select(['students.id', 'students_year.m_year', 'students.nameAR', 'students.birthday', 'students.phone1', 'students.whatsup', 'students_year.active','students.isdelete', 'students.created_at'])
            ->where('students_year.m_year','=',$this->getMoneyYear())
            ->where('students_year.active','=',1)->where('students.isdelete','=',0)->get();
        $addresses=Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->get();
        $classes=Option::where('parent_id',12)->where('isdelete',0)->where('active',1)->get();
        $levels=Option::where('parent_id',59)->where('isdelete',0)->where('active',1)->get();
        return view("cms.student.yearStudents",compact("title","subtitle","items","addresses","classes","levels"));
    }
    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Student::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Student/");
    }

    public function getHowToHear(){
        $parentTitle="كيف سمعت عنا؟";
        $hows=Option::where('parent_id',51)->where('isdelete',0)->where('active',1)->get();
        $title="التسويق";


        return view("cms.student.howToHear",compact("hows",'title','parentTitle'));
    }

}
