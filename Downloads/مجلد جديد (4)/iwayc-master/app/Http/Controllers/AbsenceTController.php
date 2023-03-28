<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Absence_t;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\CMSBaseController;

class AbsenceTController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="ادارة الغياب والمغادرة";
        $subtitle="غياب - تأخير المعلمين";

        $teachers=Course::where('isdelete',0)->where('active',1)->groupBy('teacher_id')->get();
        return view("cms.absenceT.index",compact("title","subtitle","teachers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="إضافة غياب - تأخير";
        $title="غياب - تأخير المعلمين";
        $courses=Course::where("isdelete",0)->where('m_year',$this->getMoneyYear())->where("active",1)->orderBy('courseAR')->get();
        return view("cms.absenceT.add",compact("title","parentTitle","courses"));
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
            'course_id' => 'required',
            'type' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);

    Absence_t::create([
        'm_year' => $request->input("edu_year_h"),
        'date' => $request->input("date"),
        'course_id' => $request->input("course_id"),
        'type' => $request->input("type"),
        'delay_time' => $request->input("delay_time"),
        'notes' => $request->input("notes"),
        'created_by' => $this->getId()
    ]);

    $flasher->addSuccess("تمت عملية الاضافة بنجاح");
    return redirect("/CMS/AbsenceT/");
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
        $title="غياب - تأخير المعلمين";
        $item=Absence_t::where("id",$id)->where("isdelete",0)->first();

        $course_id =\App\Models\Course::find($item->course_id)->id;
        $absencet = Absence_t::where('course_id', $course_id)
        ->where('type', '=', '0')
        ->count();

        $absencet_d = Absence_t::where('course_id', $course_id)
        ->where('type', '=', '1')
        ->count();

        $h_absencet = Absence_t::where('course_id', $course_id)
        ->where('type', '=', '1')
        ->sum('delay_time');

        $h_absencet_d = $h_absencet/60;


        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/AbsenceT/");
        }
        return view("cms.absenceT.show",compact("title","item","id","parentTitle","absencet",'absencet_d','h_absencet_d'));
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
        $title="غياب - تأخير المعلمين";
        $item=Absence_t::where("id",$id)->where("isdelete",0)->first();
        $courses=Course::where("isdelete",0)->where('m_year',$this->getMoneyYear())->where("active",1)->orderBy('courseAR')->get();
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/AbsenceT/");
        }
        return view("cms.absenceT.edit",compact("title","item","id","courses","parentTitle"));
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
                'course_id' => 'required',
                'type' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Absence_t::find($id);
        $item->date=$request->input("date");
        $item->course_id=$request->input("course_id");
        $item->type=$request->input("type");
        $item->delay_time=$request->input("delay_time");
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/AbsenceT/");
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
        $item=Absence_t::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/AbsenceT/");
    }
    public function getYearFilter()
    {
        $courses=Course::where("isdelete",0)->where('m_year',$this->getMoneyYear())->where("active",1)->orderBy('courseAR')->get();

        return Response::json( $courses );
    }
}
