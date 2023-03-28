<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\Student_course;
use App\Models\Receipt_student;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;

class WithdrawalController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="سجل الانسحاب";
        $title="الماليه";
        $items=Withdrawal::where('isdelete',0)->paginate(10);
        $students=Receipt_student::leftJoin('student_course', 'student_course.id','=','receipt_students.student_course_id')
            ->leftJoin('students', 'students.id','=','student_course.student_id')
            ->where('receipt_students.isdelete','=','0')
            ->where('receipt_students.m_year','=',$this->getMoneyYear())
            ->orderBy('students.nameAR')->get();
        $courses=Course::where("isdelete",0)->where('m_year',$this->getMoneyYear())->where("active",1)->orderBy('courseAR')->get();
        $users=User::where("isdelete",0)->where("Status","مفعل")->orderBy('name')->get();
        $teachers=Teacher::leftJoin('teachers_year', 'teachers_year.teacher_id','=','teachers.id')
            ->select(['teachers.id', 'teachers.name'])
            ->where('teachers_year.active',1)->where('teachers_year.m_year',$this->getMoneyYear())->where('teachers.isdelete',0)->orderBy('teachers.name')->get();

        return view("cms.withdrawal.index",compact("title","subtitle","items","students","courses","users","teachers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة طلب انسحاب جديد";
        $title="الماليه";
        $students=Student::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('active',1)->get();
        $courses=Course::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('active',1)->get();
        return view("cms.withdrawal.add",compact("title","parentTitle","students","courses"));
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
                'price_h' => 'required',
                'payment_h' => 'required',
                'fines' => 'required',
                'refund_h' => 'required',
                'teacher_fees' => 'required',
                'center_fees_h' => 'required',
                'reason' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $student_course_id = $request->input("student_course_id_h");

        $isExist = Withdrawal::where('student_course_id',$student_course_id)->count();
        if ($isExist>0){
            $withdrawal = Withdrawal::where('student_course_id',$student_course_id)->first();
            $withdrawal->phone=$request->input("phone_h");
            $withdrawal->m_year=$request->input("edu_year_h");
            $withdrawal->price=$request->input("price_h");
            $withdrawal->payment=$request->input("payment_h");
            $withdrawal->fines=$request->input("fines");
            $withdrawal->refund=$request->input("refund_h");
            $withdrawal->teacher_fees=$request->input("teacher_fees");
            $withdrawal->center_fees=$request->input("center_fees_h");
            $withdrawal->reason=$request->input("reason");
            $withdrawal->created_by=$this->getId();
            $withdrawal->updated_by=null;
            $withdrawal->isdelete=0;
            $withdrawal->deleted_by=null;
        }
        else{
            $withdrawal = new Withdrawal;
            $withdrawal->student_course_id=$student_course_id;
            $withdrawal->phone=$request->input("phone_h");
            $withdrawal->m_year=$request->input("edu_year_h");
            $withdrawal->price=$request->input("price_h");
            $withdrawal->payment=$request->input("payment_h");
            $withdrawal->fines=$request->input("fines");
            $withdrawal->refund=$request->input("refund_h");
            $withdrawal->teacher_fees=$request->input("teacher_fees");
            $withdrawal->center_fees=$request->input("center_fees_h");
            $withdrawal->reason=$request->input("reason");
            $withdrawal->updated_by=$this->getId();
        }

        if ($withdrawal->save()){
            $student_course = Student_course::find($student_course_id);
            $student_course->iswithdrawal = 1;
            $student_course->payment = 0;
            $student_course->save();

            $course = Course::find($student_course->course_id);
            $course->total_reg_student = $course->total_reg_student - 1;
            $course->total_withdrawn_student = $course->total_withdrawn_student + 1;
            $course->save();
        }

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/StudentCourse/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="عرض طلب الانسحاب ";
        $item=Withdrawal::where("id",$id)->where("isdelete",0)->first();
        $title="ادارة طلبات الانسحاب";
        $linkApp="/CMS/Withdrawal/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Withdrawal/");
        }
        return view("cms.withdrawal.show",compact("title","item","id","parentTitle","linkApp"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل طلبات الانسحاب ";
        $item=Withdrawal::where("id",$id)->where("isdelete",0)->first();
        $title="ادارة طلبات الانسحاب";
        $linkApp="/CMS/Withdrawal/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Withdrawal/");
        }
        return view("cms.withdrawal.edit",compact("title","item","id","parentTitle","linkApp"));
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
                'student_course_id_h' => 'required',
                'price_h' => 'required',
                'payment_h' => 'required',
                'fines' => 'required',
                'refund_h' => 'required',
                'teacher_fees' => 'required',
                'center_fees_h' => 'required',
                'reason' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Withdrawal::find($id);
        $item->student_course_id=$request->input("student_course_id_h");
        $item->phone=$request->input("phone_h");
        $item->m_year=$request->input("m_year");
        $item->price=$request->input("price_h");
        $item->payment=$request->input("payment_h");
        $item->fines=$request->input("fines");
        $item->refund=$request->input("refund_h");
        $item->teacher_fees=$request->input("teacher_fees");
        $item->center_fees=$request->input("center_fees_h");
        $item->reason=$request->input("reason");
        $item->updated_by=$this->getId();
        $item->save();
        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/Withdrawal/");
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
        $item=Withdrawal::find($id);
        $receipt_student = Receipt_student::where('student_course_id',$item->student_course_id)->where('isdelete',0)->first();

        if($receipt_student!=null){
            $msg = 'لم تتم عملية حذف الانسحاب لأنه تم صرف المستحقات للطالب يرجي مراجعة الادارة او حذف سند الصرف';
        }else{
            $item->isdelete=1;
            $item->deleted_by=$this->getId();
            if ($item->save()) {
                $student_course = Student_course::find($item->student_course_id);
                $student_course->iswithdrawal = 0;
                $student_course->isdelete = 0;
                $student_course->payment = $item->price-$item->payment;
                $student_course->save();

                $course = Course::find($student_course->course_id);
                $course->total_withdrawn_student = $course->total_withdrawn_student - 1;
                $course->total_reg_student = $course->total_reg_student + 1;
                $course->save();

                $msg = "تمت عملية الحذف بنجاح";
            }else{
                $msg = 'تم حذف سجل الانسحاب ولكن لم يتم اعادة سجل الطالب في الدورة يرجي مراجعة الادارة';
            }
        }
        $flasher->addSuccess($msg);

        return redirect("/CMS/Withdrawal/");
    }
    public function getAdd($id)
    {
        $item = Student_course::find($id);
        $parentTitle="اضافة طلب انسحاب جديد";
        $title="ادارة طلبات الانسحاب";
        return view("cms.withdrawal.add",compact("title","parentTitle","item","id"));
    }
    public function getYearFilter()
    {
        $students=Student::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('active',1)->get();
        $courses=Course::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('active',1)->get();

        return Response::json( $students,$courses );
    }




}
