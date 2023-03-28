<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Box_year;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\Student_course;
use App\Models\Approval_record;
use App\Models\Receipt_student;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class ReceiptStudentController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subtitle="ادارة سندات الصرف - مخالصة";
        $title="الماليه";

        $students=Receipt_student::leftJoin('student_course', 'student_course.id','=','receipt_students.student_course_id')
            ->leftJoin('students', 'students.id','=','student_course.student_id')
            ->where('receipt_students.isdelete','=','0')
            ->where('receipt_students.m_year','=',$this->getMoneyYear())
            ->orderBy('students.nameAR')->get();
        $courses=Course::where("isdelete",0)->where('m_year',$this->getMoneyYear())->where("active",1)->orderBy('courseAR')->get();
        $users=User::where("isdelete",0)->where("Status","مفعل")->orderBy('name')->get();

        return view("cms.receiptStudent.index",compact("title","subtitle","students","courses","users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $parentTitle="اضافة سند صرف جديد - مخالصه";
        $title="الماليه";


        $id = 1;
        $id_comp = 1;
        $date = date('Y-m-d');
        $isReceipt = Receipt_student::count();
        if ($isReceipt>0){
            $receipt = Receipt_student::where('id_comp','!=',null)->orderBy('id','desc')->first();
            $id = $receipt->id + 1;

            $receiptss = Receipt_student::where('m_year',$this->getMoneyYear())->where('id_comp','!=',null)->orderBy('id','desc')->first();
            if(count(array($receiptss))){
            $id_comp = $receiptss->id_comp + 1;
            }else{
                 $id_comp = 1;
            }
        }else{
            $id = 1;
            $id_comp = 1;
        }

        $studentCourses=Student_course::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('payment','>',0)->get();

        return view("cms.receiptStudent.add",compact("title","parentTitle","id","id_comp","date","studentCourses"));
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
            'student_course_id_h' => 'required',
            'amount_h' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);

    $receipt_student = Receipt_student::create([
        'id' => $request->input("id"),
        'id_comp' => $request->input("id_comp"),
        'm_year' => $request->input("edu_year_h"),
        'student_course_id' => $request->input("student_course_id_h"),
        'date' => $request->input("date"),
        'amount' => $request->input("amount_h"),
        'notes' => $request->input("notes"),
        'box_id' => 3,
        'created_by' => $this->getId()
    ]);
    if ($receipt_student){
        if(Auth::user()->responsible_id == null){
        $student_course=Student_course::where('id',$request->input("student_course_id_h"))->where('isdelete',0)->first();
        $student_course->payment = 0;
        $student_course->save();
        $box = Box_year::where('box_id',3)->where('m_year',$this->getMoneyYear())->first();
        $box->expense += $request->input("amount_h");
        $box->save();
        $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
        $center->expense += $request->input("amount_h");
        $center->save();
        $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
        $primary->expense += $request->input("amount_h");
        $primary->save();
        }else{
            $Receipt_student = Receipt_student::latest()->first();
            $add = new Approval_record();
            $add->row_id=$Receipt_student->id;
            $add->model_id='App\Models\Receipt_student';
            $add->slug='Receipt_student';
            $add->section='انسحاب طالب';
            $add->user_id=$Receipt_student->created_by;
            $add->res_id=Auth::user()->responsible_id;
            $add->date=$Receipt_student->created_at;
            $add->save();
        }
    }

    $flasher->addSuccess("تمت عملية الاضافة بنجاح");
    return redirect("/CMS/StudentCourse");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل سندات الصرف - مخالصة ";
        $item=Receipt_student::where("id",$id)->where("isdelete",0)->first();
        $title="الماليه";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/ReceiptStudent/");
        }
        return view("cms.receiptStudent.show",compact("title","item","id","parentTitle"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل سندات الصرف - مخالصة ";
        $item=Receipt_student::where("id",$id)->where("isdelete",0)->first();
        $studentCourses=Student_course::where('isdelete',0)->where('m_year',$this->getMoneyYear())->get();
        $title="ادارة سندات الصرف - مخالصة";
        $linkApp="/CMS/Static/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/ReceiptStudent/");
        }
        return view("cms.receiptStudent.edit",compact("title","item","id","studentCourses","parentTitle","linkApp"));
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
            'student_course_id' => 'required',
            'amount' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);

    $item=Receipt_student::find($id);
    $item->id=$request->input("id");
    $item->id_comp=$request->input("id_comp");
    $item->m_year=$request->input("m_year");
    $item->date=$request->input("date");
    $item->student_course_id=$request->input("student_course_id");
    $amount=$item->amount;
    $item->amount=$request->input("amount");
    $item->notes=$request->input("notes");
    $item->updated_by=$this->getId();
    if ($item->save()){

        $box = Box_year::where('box_id',3)->where('m_year',$this->getMoneyYear())->first();
        $box->expense -= $amount - $request->input("amount");
        $box->save();
        $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
        $center->expense -= $amount - $request->input("amount");
        $center->save();
        $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
        $primary->expense -= $amount - $request->input("amount");
        $primary->save();
    }

    $flasher->addSuccess("تمت عملية الحفظ بنجاح");
    return redirect("/CMS/ReceiptStudent/");
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
        $item=Receipt_student::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        if ($item->save()){
            $box = Box_year::where('box_id',3)->where('m_year',$this->getMoneyYear())->first();
            $box->expense -= $item->amount;
            $box->save();
            $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
            $center->expense -= $item->amount;
            $center->save();
            $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
            $primary->expense -= $item->amount;
            $primary->save();
        }
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/ReceiptStudent/");
    }

    public function getCreate($std_id)
    {
        $parentTitle="اضافة سند صرف جديد - مخالصه";
        $title="الماليه";
        $id = 1;
        $id_comp = 1;
        $date = date('Y-m-d');
        $catch = Receipt_student::all();
        if (count($catch)!=0){
            $catch = Receipt_student::latest()->first();
            $id = $catch->id + 1;
            $id_comp = $catch->id_comp + 1;
        }

        $studentCourse=Student_course::where('id',$std_id)->where('m_year',$this->getMoneyYear())->where('isdelete',0)->first();
        $withdrawal=Withdrawal::where('student_course_id',$std_id)->where('isdelete',0)->first();

        return view("cms.receiptStudent.add",compact("title","parentTitle","id","withdrawal","id_comp","date","studentCourse"));
    }

    public function getYearFilter()
    {
        $studentCourses=Student_course::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('payment','>',0)->get();

        return Response::json( $studentCourses );
    }


}
