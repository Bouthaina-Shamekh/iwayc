<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Option;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User_year;
use App\Models\Money_year;
use Illuminate\Http\Request;
use App\Models\Count_warning;
use App\Models\Legal_affairs;
use App\Models\Student_course;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;

class CountWarningController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="الشؤون القانونية";
        $title="التحصل والشؤون القانونيه";

        $students=Student::where("isdelete",0)->orderBy('nameAR')->get();
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
        $users=User::where("isdelete",0)->where("Status","مفعل")->orderBy('name')->get();
        $courses=Course::where("isdelete",0)->where("active",1)->orderBy('courseAR')->get();

        return view("cms.countWarning.index",compact("title","subtitle","s","users","courses"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
    public function getAdd($id)
    {
        $parentTitle="اضافة تحذير جديد";
        $title="التحصل والشؤون القانونيه";

        $type = Option::where('parent_id',270)->where('active',1)->get();
        $item = Legal_affairs::find($id);

        return view("cms.countWarning.add",compact("title","parentTitle","item","type"));
    }

    public function getYearFilter()
    {
        $teachers=Teacher::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('active',1)->orderBy('name')->get();
        return Response::json( $teachers );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postAdd(Request $request,$id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'student_course_id_h' => 'required',
                'legal_affairs_id_h' => 'required',
                'type' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $count_claim = Count_warning::create([
            'student_course_id' => $request->input("student_course_id_h"),
            'legal_affairs_id' => $request->input("legal_affairs_id_h"),
            'how_claim' => $request->input("type"),
            'notes' => $request->input("notes"),
            'created_by' => $this->getId()
        ]);
        if ($count_claim){
            $legal_affairs = Legal_affairs::find($id);
            $legal_affairs->count_warning += 1;
            $legal_affairs->save();
        }

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/LegalAffairs/");
    }
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
        $parentTitle="عرض التحذير";
        $item=Count_warning::where("id",$id)->where("isdelete",0)->first();
        $title="التحصل والشؤون القانونيه";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/CountWarning/");
        }
        return view("cms.countWarning.show",compact("title","item","id","parentTitle"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل التحذير";
        $title="التحصل والشؤون القانونيه";
        $item=Count_warning::where("id",$id)->where("isdelete",0)->first();
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/CountWarning/");
        }
        $type = Option::where('parent_id',270)->where('active',1)->get();
        return view("cms.countWarning.edit",compact("title","item","id","parentTitle","type"));
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
        $this->validate($request,
            [
                'type' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Count_warning::find($id);
        $item->how_claim=$request->input("type");
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/CountWarning/");
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
