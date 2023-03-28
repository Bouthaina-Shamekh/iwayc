<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Box_year;
use Illuminate\Http\Request;
use App\Models\Catch_receipt_box;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;

class CatchReceiptBoxController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="ادارة سندات القبض - صناديق";
        $title="شوؤن الموظفين";
        $items=Catch_receipt_box::where('isdelete',0)->paginate(10);
        return view("cms.catchReceiptBox.index",compact("title","subtitle","items"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle=" اضافة سند قبض جديد - صناديق";
        $title="شوؤن الموظفين";


        $id = 1;
        $id_comp = 1;
        $date = date('Y-m-d');
        $isCatch = Catch_receipt_box::count();
        if ($isCatch>0){
            $catch = Catch_receipt_box::where('id','!=',null)->orderBy('id','desc')->first();
            $id = $catch->id + 1;
            $catchss = Catch_receipt_box::where('m_year',$this->getMoneyYear())->where('id_comp','!=',null)->orderBy('id','desc')->first();
            if(count(array($catchss))){
            $id_comp = $catchss->id_comp + 1;
            }else{
                 $id_comp = 1;
            }

        }else{
            $id = 1;
            $id_comp = 1;
        }

        $boxes=Box::where('type',147)->where('active',1)->where('isdelete',0)->orderBy('name')->get();
        return view("cms.catchReceiptBox.add",compact("title","parentTitle","id","id_comp","date","boxes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'type' => 'required',
                'box_id' => 'required',
                'customer' => 'required',
                'count' => 'required',
                'amount' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);
        $catchReceiptBox = Catch_receipt_box::create([
            'id' => $request->input("id"),
            'id_comp' => $request->input("id_comp"),
            'box_id' => $request->input("box_id"),
            'm_year' => $request->input("edu_year_h"),
            'date' => $request->input("date"),
            'type' => $request->input("type"),
            'customer' => $request->input("customer"),
            'count' => $request->input("count"),
            'amount' => $request->input("amount"),
            'notes' => $request->input("notes"),
            'created_by' => $this->getId()
        ]);

        if ($catchReceiptBox){
            $box = Box_year::where('box_id',$request->input("box_id"))->where('m_year',$this->getMoneyYear())->first();
            $box->income += $request->input("amount");
            $box->save();
            $isCenter = Box_year::where('box_id',$box->parent_id)->where('m_year',$this->getMoneyYear())->count();
            if ($isCenter>0){
                $center = Box_year::where('box_id',$box->parent_id)->where('m_year',$this->getMoneyYear())->first();
                $center->income += $request->input("amount");
                $center->save();
            }
            $primary = Box_year::where('box_id','1')->where('m_year',$this->getMoneyYear())->first();
            $primary->income += $request->input("amount");
            $primary->save();
        }

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/CatchReceiptBox/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Catch_receipt_box  $catch_receipt_box
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle = "عرض سندات القبض - الصناديق ";
        $item = Catch_receipt_box::where("id", $id)->where("isdelete", 0)->first();
        $title="شوؤن الموظفين";

        if ($item == NULL) {
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Static/");
        }
        return view("cms.catchReceiptBox.show", compact("title", "item", "id","parentTitle"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Catch_receipt_box  $catch_receipt_box
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل سندات القبض - الصناديق ";
        $item=Catch_receipt_box::where("id",$id)->where("isdelete",0)->first();
        $boxes=Box::where('type',147)->where('active',1)->where('isdelete',0)->orderBy('name')->get();
        $title="شوؤن الموظفين";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Static/");
        }
        return view("cms.catchReceiptBox.edit",compact("title","item","id","parentTitle","boxes"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Catch_receipt_box  $catch_receipt_box
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'type' => 'required',
                'box_id' => 'required',
                'customer' => 'required',
                'count' => 'required',
                'amount' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Catch_receipt_box::find($id);
        $item->id=$request->input("id");
        $item->id_comp=$request->input("id_comp");
        $item->m_year=$request->input("m_year");
        $item->date=$request->input("date");
        $item->box_id=$request->input("box_id");
        $item->type=$request->input("type");
        $item->customer=$request->input("customer");
        $item->count=$request->input("count");
        $amount = $item->amount;
        $item->amount=$request->input("amount");
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();

        if ($item->save()){
            $box = Box_year::where('box_id',$request->input("box_id"))->where('m_year',$this->getMoneyYear())->first();
            $box->income -= $amount - $request->input("amount");
            $box->save();
            $isCenter = Box_year::where('box_id',$box->parent_id)->where('m_year',$this->getMoneyYear())->count();
            if ($isCenter>0){
                $center = Box_year::where('box_id',$box->parent_id)->where('m_year',$this->getMoneyYear())->first();
                $center->income -= $amount - $request->input("amount");
                $center->save();
            }
            $primary = Box_year::where('box_id','1')->where('m_year',$this->getMoneyYear())->first();
            $primary->income -= $amount - $request->input("amount");
            $primary->save();
        }

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/CatchReceiptBox/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Catch_receipt_box  $catch_receipt_box
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Catch_receipt_box::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        if ($item->save()){
            $box = Box_year::where('box_id',$item->box_id)->where('m_year',$this->getMoneyYear())->first();
            $box->income -= $item->amount;
            $box->save();
            $isCenter = Box_year::where('box_id',$box->parent_id)->where('m_year',$this->getMoneyYear())->count();
            if ($isCenter>0){
                $center = Box_year::where('box_id',$box->parent_id)->where('m_year',$this->getMoneyYear())->first();
                $center->income -= $item->amount;
                $center->save();
            }
            $primary = Box_year::where('box_id','1')->where('m_year',$this->getMoneyYear())->first();
            $primary->income -= $item->amount;
            $primary->save();
        }
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/CatchReceiptBox/");
    }
}
