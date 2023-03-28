<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Box_year;
use Illuminate\Http\Request;
use App\Models\Receipt_course;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class ReceiptCourseController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="شؤون المعلمين";
        $subtitle="ادارة سندات الصرف";

        return view("cms.receiptCourse.index",compact("title","subtitle"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة سند صرف جديد";
        $title="شؤون المعلمين";
        $linkApp="/CMS/Static/";

        $id = 1;
        $id_comp = 1;
        $date = date('Y-m-d');
        $isReceipt = Receipt_course::where('id_comp','!=',null)->count();
        if ($isReceipt>0){
            $receipt = Receipt_course::orderBy('id','desc')->first();
            $id = $receipt->id + 1;
            $receiptss = Receipt_course::where('m_year',$this->getMoneyYear())->where('id_comp','!=',null)->orderBy('id','desc')->first();
            if(is_countable($receiptss) && count($receiptss)){
            $id_comp = $receiptss->id_comp + 1;
            }else{
                 $id_comp = 1;
            }
        }else{
            $id = 1;
            $id_comp = 1;
        }

        $courses=Course::where('isdelete',0)->where('active',1)->where('m_year',$this->getMoneyYear())->orderBy('courseAR')->get();
        return view("cms.receiptCourse.add",compact("title","parentTitle","linkApp","id","id_comp","date","courses"));
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
            'teacher_ratio_h' => 'required',
            'teacher_pay_h' => 'required',
            'remainder_h' => 'required',
            'amount' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);
    $receipt_course = Receipt_course::create([
        'id' => $request->input("id"),
        'id_comp' => $request->input("id_comp"),
        'm_year' => $request->input("edu_year_h"),
        'course_id' => $request->input("course_id"),
        'date' => $request->input("date"),
        'teacher_ratio' => $request->input("teacher_ratio_h"),
        'teacher_pay' => $request->input("teacher_pay_h"),
        'remainder' => $request->input("remainder_h"),
        'amount' => $request->input("amount"),
        'cheque_info' => $request->input("cheque_info"),
        'notes' => $request->input("notes"),
        'box_id' => 3,
        'created_by' => $this->getId()
    ]);

    if ($receipt_course){
        $box = Box_year::where('box_id',3)->where('m_year',$this->getMoneyYear())->first();
        $box->expense += $request->input("amount");
        $box->save();
        $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
        $center->expense += $request->input("amount");
        $center->save();
        $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
        $primary->expense += $request->input("amount");
        $primary->save();
    }

    $flasher->addSuccess("تمت عملية الاضافة بنجاح");
    return redirect("/CMS/ReceiptCourse");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $title="شؤون المعلمين";
        $parentTitle="عرض سندات الصرف - دورات ";
        $item=Receipt_course::where("id",$id)->where("isdelete",0)->first();
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/ReceiptCourse/");
        }
        return view("cms.receiptCourse.show",compact("title","item","id","parentTitle"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل سندات الصرف - دورات ";
        $item=Receipt_course::where("id",$id)->where("isdelete",0)->first();
        $courses=Course::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('active',1)->get();
        $title="شؤون المعلمين";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/ReceiptCourse/");
        }
        return view("cms.receiptCourse.edit",compact("title","item","id","parentTitle","courses"));
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
            'teacher_ratio_h' => 'required',
            'teacher_pay_h' => 'required',
            'remainder_h' => 'required',
            'amount' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);

    $item=Receipt_course::find($id);
    $item->id=$request->input("id");
    $item->id_comp=$request->input("id_comp");
    $item->date=$request->input("date");
    $item->m_year=$request->input("m_year");
    $item->course_id=$request->input("course_id");
    $item->teacher_ratio=$request->input("teacher_ratio_h");
    $item->teacher_pay=$request->input("teacher_pay_h");
    $item->remainder=$request->input("remainder_h");
    $amount = $item->amount;
    $item->amount=$request->input("amount");
    $item->cheque_info=$request->input("cheque_info");
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
    return redirect("/CMS/ReceiptCourse/");
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
        $item=Receipt_course::find($id);
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
        return redirect("/CMS/ReceiptCourse");
    }


    public function getYearFilter()
    {
        $courses=Course::where('isdelete',0)->where('active',1)->where('m_year',$this->getMoneyYear())->get(['id','courseAR','teacher_id']);
        $arr=[];
        foreach ($courses as $course){
            array_push($arr,['teacher_id'=>Teacher::find($course->teacher_id)->name,'courseAR'=>$course->courseAR]);
        }
        return Response::json( $arr );
    }


}
