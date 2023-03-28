<?php

namespace App\Http\Controllers;


use App\Models\Box_year;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Approval_record;
use App\Models\Receipt_advance;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReceiptAdvanceController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="سند صرف راتب";
        $title="شوؤن الموظفين";
        return view("cms.receiptAdvance.index",compact("title","subtitle"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $parentTitle="اضافة سند صرف سلفه";
        $title="شوؤن الموظفين";


        $id = 1;
        $id_comp = 1;
        $date = date('Y-m-d');
        $isReceipt = Receipt_advance::count();
        if ($isReceipt>0){
            $receipt = Receipt_advance::where('id_comp','!=',null)->orderBy('id','desc')->first();
            $id = $receipt->id + 1;
            $receiptss = Receipt_advance::where('m_year',$this->getMoneyYear())->where('id_comp','!=',null)->orderBy('id','desc')->first();
            if(count((is_countable($receiptss)?$receiptss:[]))){
            $id_comp = $receiptss->id_comp + 1;
            }else{
                 $id_comp = 1;
            }
        }else{
            $id = 1;
            $id_comp = 1;
        }

        $employees=Employee::where('isdelete',0)->where('active',1)->get();
        return view("cms.receiptAdvance.add",compact("title","parentTitle","id","id_comp","date","employees"));
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
                'employee_id' => 'required',
                'advance_payment' => 'required',
                'month_count' => 'required',
                'month_payment_h' => 'required',
                'start_payment' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);
        $receipt_advance = Receipt_advance::create([
            'id' => $request->input("id"),
            'id_comp' => $request->input("id_comp"),
            'm_year' => $request->input("edu_year_h"),
            'employee_id' => $request->input("employee_id"),
            'date' => $request->input("date"),
            'advance_payment' => $request->input("advance_payment"),
            'month_count' => $request->input("month_count"),
            'month_payment' => $request->input("month_payment_h"),
            'start_payment' => $request->input("start_payment"),
            'notes' => $request->input("notes"),
            'box_id' => 4,
            'created_by' => $this->getId()
        ]);

        if ($receipt_advance){
            if(Auth::user()->responsible_id == null){
            $box = Box_year::where('box_id',4)->where('m_year',$this->getMoneyYear())->first();
            $box->expense += $request->input("advance_payment");
            $box->save();
            $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
            $center->expense += $request->input("advance_payment");
            $center->save();
            $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
            $primary->expense += $request->input("advance_payment");
            $primary->save();

    }else{
        $Receipt_advance = Receipt_advance::latest()->first();
        $add = new Approval_record();
        $add->row_id=$Receipt_advance->id;
        $add->model_id='App\Models\Receipt_advance';
        $add->slug='ReceiptAdvance';
        $add->section='صرف سلفة';
        $add->user_id=$Receipt_advance->created_by;
        $add->res_id=Auth::user()->responsible_id;
        $add->date=$Receipt_advance->created_at;
        $add->save();
    }
}
        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/ReceiptAdvance/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {

        $parentTitle="عرض سندات الصرف - سلفة ";
        $item=Receipt_advance::where("id",$id)->where("isdelete",0)->first();
        $title="شوؤن الموظفين";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Static/");
        }
        return view("cms.receiptAdvance.show",compact("title","item","id","parentTitle"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل سندات الصرف - سلفة ";
        $item=Receipt_advance::where("id",$id)->where("isdelete",0)->first();
        $employees=Employee::where('isdelete',0)->where('active',1)->get();
        $title="شوؤن الموظفين";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Static/");
        }
        return view("cms.receiptAdvance.edit",compact("title","item","id","parentTitle","employees"));
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
                'employee_id' => 'required',
                'advance_payment' => 'required',
                'month_count' => 'required',
                'month_payment_h' => 'required',
                'start_payment' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Receipt_advance::find($id);
        $item->id=$request->input("id");
        $item->id_comp=$request->input("id_comp");
        $item->date=$request->input("date");
        $item->m_year=$request->input("m_year");
        $item->employee_id=$request->input("employee_id");
        $amount = $item->advance_payment;
        $item->advance_payment=$request->input("advance_payment");
        $item->month_count=$request->input("month_count");
        $item->month_payment=$request->input("month_payment_h");
        $item->start_payment=$request->input("start_payment");
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        if ($item->save()){
            $box = Box_year::where('box_id',4)->where('m_year',$this->getMoneyYear())->first();
            $box->expense -= $amount - $request->input("advance_payment");
            $box->save();
            $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
            $center->expense -= $amount - $request->input("advance_payment");
            $center->save();
            $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
            $primary->expense -= $amount - $request->input("advance_payment");
            $primary->save();
        }

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/ReceiptAdvance/");
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
        $item=Receipt_advance::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        if ($item->save()){
            $box = Box_year::where('box_id',4)->where('m_year',$this->getMoneyYear())->first();
            $box->expense -= $item->advance_payment;
            $box->save();
            $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
            $center->expense -= $item->advance_payment;
            $center->save();
            $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
            $primary->expense -= $item->advance_payment;
            $primary->save();
        }
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/ReceiptAdvance/");
    }
}
