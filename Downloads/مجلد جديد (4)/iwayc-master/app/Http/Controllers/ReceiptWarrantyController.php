<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Salary;
use App\Models\Box_year;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Receipt_warranty;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;

class ReceiptWarrantyController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="ادارة الضمان الاجتماعي";
        $title="شوؤن الموظفين";
        return view("cms.receiptWarranty.index",compact("title","subtitle"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافه سند الضمان الاجتماعي";
        $title="شوؤن الموظفين";

        $id = 1;
        $id_comp = 1;
        $date = date('Y-m-d');
        $isReceipt = Receipt_warranty::count();
        if ($isReceipt>0){
            $receipt = Receipt_warranty::where('id_comp','!=',null)->orderBy('id','desc')->first();
            $id = $receipt->id + 1;

            $receiptss = Receipt_warranty::where('m_year',$this->getMoneyYear())->where('id_comp','!=',null)->orderBy('id','desc')->first();
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
        $salaries=Salary::where('isdelete',0)->get();
        return view("cms.receiptWarranty.add",compact("title","parentTitle","id","id_comp","date","employees","salaries"));
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
                'salary' => 'required',
                'amount_h' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);
        $receipt_warranty = Receipt_warranty::create([
            'id' => $request->input("id"),
            'id_comp' => $request->input("id_comp"),
            'm_year' => $request->input("edu_year_h"),
            'date' => $request->input("date"),
            'salary_id' => $request->input("salary"),
            'amount' => $request->input("amount_h"),
            'notes' => $request->input("notes"),
            'box_id' => 4,
            'created_by' => $this->getId()
        ]);

        if ($receipt_warranty){
            $box = Box_year::where('box_id',4)->where('m_year',$this->getMoneyYear())->first();
            $box->expense += $request->input("amount_h");
            $box->save();
            $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
            $center->expense += $request->input("amount_h");
            $center->save();
            $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
            $primary->expense += $request->input("amount_h");
            $primary->save();
        }

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/ReceiptWarranty/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receipt_warranty  $receipt_warranty
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {


        $parentTitle="عرض سند الضمان الاجتماعي";
        $item=Receipt_warranty::where("id",$id)->where("isdelete",0)->first();

        $title="شوؤن الموظفين";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/ReceiptWarranty/");
        }
        return view("cms.receiptWarranty.show",compact("title","item","id","parentTitle"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receipt_warranty  $receipt_warranty
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل سند الضمان الاجتماعي ";
        $item=Receipt_warranty::where("id",$id)->where("isdelete",0)->first();
        $employees=Employee::where('isdelete',0)->where('active',1)->get();
        $salaries=Salary::where('isdelete',0)->get();
        $title="شوؤن الموظفين";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/ReceiptWarranty/");
        }
        return view("cms.receiptWarranty.edit",compact("title","item","id","employees","salaries","parentTitle"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receipt_warranty  $receipt_warranty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'salary_id' => 'required',
                'amount' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Receipt_warranty::find($id);
        $item->id=$request->input("id");
        $item->id_comp=$request->input("id_comp");
        $item->m_year=$request->input("m_year");
        $item->salary_id=$request->input("salary_id");
        $amount = $item->amount;
        $item->amount=$request->input("amount");
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        if ($item->save()){
            $box = Box_year::where('box_id',4)->where('m_year',$this->getMoneyYear())->first();
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
        return redirect("/CMS/ReceiptWarranty/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receipt_warranty  $receipt_warranty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Receipt_warranty::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        if ($item->save()){
            $box = Box_year::where('box_id',4)->where('m_year',$this->getMoneyYear())->first();
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
        return redirect("/CMS/ReceiptWarranty/");
    }
}
