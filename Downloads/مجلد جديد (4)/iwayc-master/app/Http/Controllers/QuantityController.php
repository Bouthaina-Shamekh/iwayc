<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Models\Option;
use App\Models\Material;
use App\Models\Quantity;
use App\Models\Repository;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class QuantityController  extends CMSBaseController
{
    function getIndex()
    {
        $subtitle="سجل اضافة الكميات";
        $title="المستودع";
        $sections=Option::where('parent_id',64)->where('isdelete',0)->orderBy('title')->get();
        $materials=Material::where('isdelete',0)->orderBy('name')->get();
        $repositories=Repository::leftJoin('repositories_year as rp', 'rp.repository_id','=','repositories.id')
            ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
            ->select([ 'repositories.id', 'repositories.name', 'rp.m_year', 'rp.active'])
            ->where('repositories.isdelete',0)
            ->where('rp.active',1)
            ->where('rp.m_year',$this->getMoneyYear())
            ->where('repository_view.user_id','=',Auth::user()->id)
            ->orderBy('repositories.name')
            ->get();
        return view("cms.quantity.index",compact("title","subtitle","sections","materials","repositories"));
    }

    function getAdd($id,FlasherInterface $flasher)
    {
        $parentTitle="اضافة كمية";
        $title="ادارة الاصناف";
        $parentLink="/CMS/Material/";
        $item=Material::where("id",$id)->where("isdelete",0)->first();
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Material/");
        }
        return view("cms.quantity.add",compact("title","item","id","parentTitle","parentLink"));
    }

    function postAdd(Request $request,$id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'material_id_h' => 'required',
                'repository_id_h' => 'required',
                'section_h' => 'required',
                'count_old_h' => 'required',
                'count_new' => 'required',
                'single_cost' => 'required',
                'count_h' => 'required',
                'single_pay' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);
        $quantity = Quantity::create([
            'm_year' => $request->input("edu_year_h"),
            'material_id' => $request->input("material_id_h"),
            'repository_id' => $request->input("repository_id_h"),
            'section' => $request->input("section_h"),
            'count_old' => $request->input("count_old_h"),
            'count_new' => $request->input("count_new"),
            'single_cost' => $request->input("single_cost"),
            'count' => $request->input("count_h"),
            'single_pay' => $request->input("single_pay"),
            'notes' => $request->input("notes"),
            'created_by' => $this->getId()
        ]);
        if ($quantity!=null) {
            $item = Material::where('id',$quantity->material_id)->first();
            $item->count_new = $request->input("count_h");
            $item->single_cost = $request->input("single_cost");
            $item->single_pay = $request->input("single_pay");
            $item->updated_by = $this->getId();
            $item->save();
        }

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/Material/");
    }

    function getEdit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل الكمية ";
        $item=Quantity::where("id",$id)->where("isdelete",0)->first();
        $title="المستودع";
        $linkApp="/CMS/Quantity/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Quantity/");
        }
        return view("cms.quantity.edit",compact("title","item","id","parentTitle","linkApp"));
    }

    function postEdit(Request $request,$id,FlasherInterface $flasher)
    {

        $this->validate($request,
            [
                'count_new' => 'required',
                'single_cost' => 'required',
                'single_pay' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Quantity::find($id);

        $item->count_new=$request->input("count_new");
        $item->m_year=$request->input("m_year");
        $item->count=$request->input("count_h");
        $item->single_cost=$request->input("single_cost");
        $item->single_pay=$request->input("single_pay");
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();

        if ($item->save()) {
            $item = Material::where('id',$item->material_id)->first();
            $item->count_new = $request->input("count_h");
            $item->single_cost = $request->input("single_cost");
            $item->single_pay = $request->input("single_pay");
            $item->updated_by = $this->getId();
            $item->save();
        }

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/Quantity/");
    }

    function getDelete($id,FlasherInterface $flasher){
        $item=Quantity::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();

        if ($item->save()) {
            $material = Material::where('id',$item->material_id)->first();
            $material->count_new = $material->count_new - $item->count_new;
            $material->updated_by = $this->getId();
            $material->save();
        }

        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Quantity/");
    }
}
