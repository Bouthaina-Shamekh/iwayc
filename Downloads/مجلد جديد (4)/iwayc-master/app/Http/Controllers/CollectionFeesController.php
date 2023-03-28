<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Option;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User_year;
use App\Models\Money_year;
use Illuminate\Http\Request;
use App\Models\Student_course;
use App\Models\Collection_fees;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class CollectionFeesController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="تحصيل الرسوم";
        $title="التحصل والشؤون القانونيه";
        $fees_owed=0;
        $isCols=Collection_fees::where('isdelete','0')->count();
        if ($isCols>0) {
            $collection_fees = Collection_fees::where('isdelete','0')->get();
            foreach ($collection_fees as $collection_fee){
                $fees_owed+=$collection_fee->fees_owed;
            }
        }
        $students=Student::leftJoin('students_year', 'students_year.student_id','=','students.id')
            ->select(['students.id', 'students.nameAR', 'students.nameEN'])
            ->where('students_year.m_year','=',$this->getMoneyYear())
            ->where('students_year.active','=',1)->where('students.isdelete','=',0)
            ->orderBy('nameAR')->get();
        $courses=Course::where("isdelete",0)->where("active",1)->where('m_year','=',$this->getMoneyYear())->orderBy('courseAR')->get();
        $this->getAll();
        return view("cms.collectionFees.index",compact("title","subtitle","fees_owed","students","courses"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    function getAll()
    {
        $isExist=Student_course::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('iswithdrawal',0)->count();
        if ($isExist>0) {
            $student_c = Student_course::where('isdelete', 0)->where('m_year',$this->getMoneyYear())->where('iswithdrawal', 0)->get();
            $isCols=Collection_fees::count();
            if ($isCols>0) {
                $collection_fees = Collection_fees::where('m_year',$this->getMoneyYear())->get();
                foreach ($collection_fees as $collection_fee) {
                    $isCol=Collection_fees::where('isdelete',0)->where('id',$collection_fee->id)->count();
                    if ($isCol>0){
                        $isStu=Student_course::where('isdelete',0)->where('id',$collection_fee->student_course_id)->where('m_year',$this->getMoneyYear())->where('iswithdrawal',0)->count();
                        if ($isStu>0){
                            $stu=Student_course::where('isdelete',0)->where('id',$collection_fee->student_course_id)->where('m_year',$this->getMoneyYear())->where('iswithdrawal',0)->first();
                            $col=Collection_fees::where('isdelete',0)->where('id',$collection_fee->id)->first();
                            $col->fees=$stu->price;
                            $col->fees_pay=$stu->price - $stu->payment;
                            $col->fees_owed=$stu->payment;
                            $col->save();
                        }

                    }
                }
                $ss1 = [];
                foreach ($student_c as $studentc) {
                    array_push($ss1, $studentc->id);
                }
                $ss2 = [];
                foreach ($collection_fees as $collection_fee) {
                    array_push($ss2, $collection_fee->student_course_id);
                }

                $sss = array_diff($ss1,$ss2);
                if(count($sss)>0){
                    foreach ($sss as $s1){
                        $scs=Student_course::where('id',$s1)->where('payment',"!=",0)->where('m_year',$this->getMoneyYear())->count();
                        if ($scs>0) {
                            $sc = Student_course::where('id', $s1)->where('payment', "!=", 0)->first();
                            $s=Student::where('id',$sc->student_id)->first();
                            $cf=new Collection_fees();
                            $cf->m_year = $sc->m_year;
                            $cf->student_course_id = $sc->id;
                            $cf->phone = $s->phone1 . " - " . $s->phone2;
                            $cf->fees = $sc->price;
                            $cf->fees_pay = $sc->price - $sc->payment;
                            $cf->fees_owed = $sc->payment;
                            $cf->count = 0;
                            $cf->evasion = 0;
                            $cf->save();
                        }
                    }
                }
            }else{
                foreach ($student_c as $s1){
                    $scs=Student_course::where('id',$s1->id)->where('payment',"!=",0)->count();
                    if ($scs>0) {
                        $sc = Student_course::where('id', $s1->id)->where('payment', "!=", 0)->first();
                        $s=Student::where('id',$sc->student_id)->first();
                        $cf=new Collection_fees();
                        $cf->m_year = $sc->m_year;
                        $cf->student_course_id = $sc->id;
                        $cf->phone = $s->phone1 . " - " . $s->phone2;
                        $cf->fees = $sc->price;
                        $cf->fees_pay = $sc->price - $sc->payment;
                        $cf->fees_owed = $sc->payment;
                        $cf->count = 0;
                        $cf->evasion = 0;
                        $cf->save();
                    }
                }
            }
        }else{
           /*  flash()->addWarning("لا يوجد طلاب مسجلين حاليا");
            flash()->addError("alert-danger"); */
            return redirect("/CMS/CollectionFees");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل بيانات التحصيل";
        $item=Collection_fees::where("id",$id)->where("isdelete",0)->first();
        $title="لوحة تحصيل الرسوم";
        $linkApp="/CMS/CollectionFees/";
        if($item==NULL){
            flash()->addWarning("لا يوجد طلاب مسجلين حاليا");
            return redirect("/CMS/CollectionFees/");
        }
        return view("cms.collectionFees.show",compact("title","item","id","parentTitle","linkApp"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل بيانات التحصيل";
        $item=Collection_fees::where("id",$id)->where("isdelete",0)->first();
        $title="لوحة تحصيل الرسوم";
        $linkApp="/CMS/CollectionFees/";
        if($item==NULL){
            flash()->addWarning("لا يوجد طلاب مسجلين حاليا");
            return redirect("/CMS/CollectionFees/");
        }
        return view("cms.collectionFees.edit",compact("title","item","id","parentTitle","linkApp"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        $item=Collection_fees::find($id);
        $item->evasion=$request->input("evasion")?1:0;
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/CollectionFees/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
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
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Course/");
    }
}
