<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Option;
use App\Models\Box_year;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Receipt_reward;
use App\Models\Approval_record;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReceiptRewardController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="صرف مكافأة - خصم";
        $title="شوؤن الموظفين";
        return view("cms.receiptReward.index",compact("title","subtitle"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة صرف مكافأة - خصم";
        $title="شوؤن الموظفين";

        $id = 1;
        $id_comp = 1;
        $date = date('Y-m-d');
        $isReceipt = Receipt_reward::count();
        if ($isReceipt>0){
            $receipt = Receipt_reward::where('id_comp','!=',null)->orderBy('id','desc')->first();
            $id = $receipt->id + 1;

            $receiptss = Receipt_reward::where('m_year',$this->getMoneyYear())->where('id_comp','!=',null)->orderBy('id','desc')->first();
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
        return view("cms.receiptReward.add",compact("title","parentTitle","id","id_comp","date","employees"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,FlasherInterface $flasher)
    {
        //dd($request->all());
        $this->validate($request,
            [
                'employee_id' => 'required',
                'type' => 'required',
                'amount' => 'required',
                'receipts_rewards' => 'required',
                'reason' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $receipt_salary = Receipt_reward::create([
            'id' => $request->input("id"),
            'id_comp' => $request->input("id_comp"),
            'm_year' => $request->input("edu_year_h"),
            'employee_id' => $request->input("employee_id"),
            'date' => $request->input("date"),
            'type' => $request->input("type"),
            'amount' => $request->input("amount"),
            'receipts_rewards' => $request->input("receipts_rewards"),
            'reason' => $request->input("reason"),
            'notes' => $request->input("notes"),
            'box_id' => 4,
            'created_by' => $this->getId()
        ]);

        if ($receipt_salary){
    if(Auth::user()->responsible_id == null){
            $box = Box_year::where('box_id',4)->where('m_year',$this->getMoneyYear())->first();
            $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
            $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
            if ($request->input("type")=='0'){
                $box->expense += $request->input("amount");
                $box->save();
                $center->expense += $request->input("amount");
                $center->save();
                $primary->expense += $request->input("amount");
                $primary->save();
            }
            if ($request->input("type")=='1'){
                $box->income += $request->input("amount");
                $box->save();
                $center->income += $request->input("amount");
                $center->save();
                $primary->income += $request->input("amount");
                $primary->save();
            }


    }else{
        $Receipt_reward = Receipt_reward::latest()->first();
        $add = new Approval_record();
        $add->row_id=$Receipt_reward->id;
        $add->model_id='App\Models\Receipt_reward';
        $add->slug='ReceiptReward';
        $add->section='صرف مكافأة - خصم';
        $add->user_id=$Receipt_reward->created_by;
        $add->res_id=Auth::user()->responsible_id;
        $add->date=$Receipt_reward->created_at;
        $add->save();
    }

}

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/ReceiptReward/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receipt_reward  $receipt_reward
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)

    {
        $parentTitle="عرض صرف مكافأة - خصم";
        $item=Receipt_reward::where("id",$id)->where("isdelete",0)->first();
        $title="شوؤن الموظفين";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Static/");
        }
        return view("cms.receiptReward.show",compact("title","item","id","parentTitle"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receipt_reward  $receipt_reward
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل صرف مكافأة - خصم";
        $item=Receipt_reward::where("id",$id)->where("isdelete",0)->first();
        $employees=Employee::where('isdelete',0)->where('active',1)->get();
        $title="شوؤن الموظفين";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Static/");
        }
        return view("cms.receiptReward.edit",compact("title","item","id","parentTitle","employees"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receipt_reward  $receipt_reward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'employee_id' => 'required',
                'type' => 'required',
                'amount' => 'required',
                'receipts_rewards' => 'required',
                //'reason' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);


        $item=Receipt_reward::find($id);
        $item->id=$request->input("id");
        $item->id_comp=$request->input("id_comp");
        $item->m_year=$request->input("m_year");
        $item->employee_id=$request->input("employee_id");
        $item->type=$request->input("type");
        $amount = $item->amount;
        $item->amount=$request->input("amount");
        $item->receipts_rewards=$request->input("receipts_rewards");
        //$item->reason=$request->input("reason");
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        if ($item->save()){
            $box = Box_year::where('box_id',4)->where('m_year',$this->getMoneyYear())->first();
            $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
            $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
            if ($request->input("type")=='0'){
                $box->expense -= $amount - $request->input("amount");
                $box->save();
                $center->expense -= $amount - $request->input("amount");
                $center->save();
                $primary->expense -= $amount - $request->input("amount");
                $primary->save();
            }
            if ($request->input("type")=='1'){
                $box->income -= $amount - $request->input("amount");
                $box->save();
                $center->income -= $amount - $request->input("amount");
                $center->save();
                $primary->income -= $amount - $request->input("amount");
                $primary->save();
            }
        }

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/ReceiptReward/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receipt_reward  $receipt_reward
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Receipt_reward::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        if ($item->save()){
            $box = Box_year::where('box_id',4)->where('m_year',$this->getMoneyYear())->first();
            $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
            $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
            if ($item->type=='0'){
                $box->expense -= $item->amount;
                $box->save();
                $center->expense -= $item->amount;
                $center->save();
                $primary->expense -= $item->amount;
                $primary->save();
            }
            if ($item->type=='1'){
                $box->income -= $item->amount;
                $box->save();
                $center->income -= $item->amount;
                $center->save();
                $primary->income -= $item->amount;
                $primary->save();
            }
        }
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("CMS/ReceiptReward/");
    }
}
