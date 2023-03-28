<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Box_expense;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;

class BoxExpenseController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="ادارة الصناديق";
        $subtitle="";
        return view("cms.boxExpense.index",compact("title","subtitle"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة نوع مصروف جديد";
        $title="ادارة الصناديق";
        $linkApp="/CMS/BoxExpense/";
        return view("cms.boxExpense.add",compact("title","parentTitle","linkApp"));
    }
    public function getCreate($id)
    {
        $parentTitle="اضافة نوع مصروف جديد";
        $title="ادارة الصناديق";
        $linkApp="/CMS/BoxIncomes/".$id;
        return view("cms.boxExpense.add",compact("title","parentTitle","linkApp","id"));
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
                'name' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);
        $boxExpense = Box_expense::create([
            'name' => $request->input("name"),
            'box_id' => $request->input("box_id"),
            'created_by' => $this->getId()
        ]);

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");

        return redirect("/CMS/BoxIncomes/".$boxExpense->box_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Catch_receipt_box  $catch_receipt_box
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle = "عرض انواع مصروفات الصناديق ";
        $item = Box_expense::where("id", $id)->where("isdelete", 0)->first();
        $title="ادارة الصناديق";
        $linkApp="/CMS/BoxIncomes/".$id;
        if ($item == NULL) {
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/BoxIncomes/".$id);
        }
        return view("cms.boxExpense.show", compact("title", "item", "id","parentTitle","linkApp"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Catch_receipt_box  $catch_receipt_box
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل انواع مصروفات الصناديق ";
        $item=Box_expense::where("id",$id)->where("isdelete",0)->first();
        $title="ادارة الصناديق";
        $linkApp="/CMS/BoxIncomes/".$id;
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/BoxIncomes/".$id);
        }
        return view("cms.boxExpense.edit",compact("title","item","id","parentTitle","linkApp"));
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
                'name' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Box_expense::find($id);
        $item->name=$request->input("name");
        $item->box_id=$request->input("box_id");
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/BoxIncomes/".$item->box_id);
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
        $item=Box_expense::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/BoxIncomes/".$item->box_id);
    }
}
