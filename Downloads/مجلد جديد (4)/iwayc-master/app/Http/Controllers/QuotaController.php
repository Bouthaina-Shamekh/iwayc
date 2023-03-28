<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Quota;
use App\Models\Course;
use App\Models\Option;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\CMSBaseController;

class QuotaController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $courses=Course::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('active',1)->orderBy('courseAR')->get();
        $days=Option::where('parent_id',204)->where('isdelete',0)->where('active',1)->get();
        $rooms=Option::where('parent_id',212)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $types=Option::where('parent_id',195)->where('isdelete',0)->where('active',1)->get();
        return view("cms.quota.index",compact("courses","days","rooms","types"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $parentTitle="اضافة موعد جديد";
        $title="ادارة جدول الحصص";
        $linkApp="/CMS/Quota/";
        $courses=Course::where('isdelete',0)->where('active',1)->where('m_year',$this->getMoneyYear())->orderBy('courseAR')->get();
        $days=Option::where('parent_id',204)->where('isdelete',0)->where('active',1)->get();
        $rooms=Option::where('parent_id',212)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $types=Option::where('parent_id',195)->where('isdelete',0)->where('active',1)->get();
        return view("cms.quota.add",compact("title","parentTitle","courses","days","rooms","types","linkApp"));
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
                'course_id' => 'required',
                'day' => 'required',
                'room' => 'required',
                'type' => 'required',
                'time' => 'required',
                'time_to' => 'required',
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);
        $quota = Quota::create([
            'm_year' => $request->input("edu_year_h"),
            'course_id' => $request->input("course_id"),
            'day' => $request->input("day"),
            'room' => $request->input("room"),
            'type' => $request->input("type"),
            'time' => $request->input("time"),
            'time_to' => $request->input("time_to"),
            'created_by' => $this->getId()
        ]);

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/Quota/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {

        $parentTitle="عرض الحصص ";
        $title="ادارة جدول الحصص";
        $item=Quota::where("id",$id)->where("isdelete",0)->first();
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Quota/");
        }
        return view("cms.quota.show",compact("title","item","id","parentTitle"));
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
        $title="ادارة الغياب والمغادرة";
        $linkApp="/CMS/Absence/";
        $item=Quota::where("id",$id)->where("isdelete",0)->first();

        $courses=Course::where('isdelete',0)->where('active',1)->where('m_year',$this->getMoneyYear())->orderBy('courseAR')->get();
        $days=Option::where('parent_id',204)->where('isdelete',0)->where('active',1)->get();
        $rooms=Option::where('parent_id',212)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $types=Option::where('parent_id',195)->where('isdelete',0)->where('active',1)->get();
    
        if($item==NULL){
           flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Quota/");
        }
        return view("cms.quota.edit",compact("title","item","id","courses","days","rooms","types","parentTitle","linkApp"));
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
                'course_id' => 'required',
                'day' => 'required',
                'room' => 'required',
                'type' => 'required',
                'time' => 'required',
                'time_to' => 'required',
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Quota::find($id);
        $item->course_id=$request->input("course_id");
        $item->day=$request->input("day");
        $item->room=$request->input("room");
        $item->type=$request->input("type");
        $item->time=$request->input("time");
        $item->time_to=$request->input("time_to");
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/Quota/");
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

        $courses=Course::where('isdelete',0)->where('active',1)->where('m_year',$this->getMoneyYear())->orderBy('courseAR')->get();
        return Response::json( $courses );
    }

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Quota::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Quota/");
    }
}
