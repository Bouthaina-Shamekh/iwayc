<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Box_year;
use App\Models\Material;
use App\Models\Money_year;
use App\Models\Repository;
use App\Models\Rep_section;
use Illuminate\Http\Request;
use App\Models\Rep_inventory;
use App\Models\Repository_in;
use App\Models\Inventory_repo;
use App\Models\Rep_inv_record;
use App\Models\Repository_year;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class RepInventoryController extends CMSBaseController
{

    public function getIndex($id)
    {

        $parentTitle="جرد المستودع والتسوية";
        $title="ادارة المستودعات";
        $linkApp="/CMS/Repository/";
        $repo=Repository::where('id',$id)->first();
        $isInventory_repo=Inventory_repo::where('repository_id',$repo->id)->latest()->first();
        $isInventory_repo->resUser_id=Auth::user()->id;
        $isInventory_repo->save();
        $this->getAll($id);
        $sections=Rep_section::where('repository_id',$repo->id)->where('isdelete',0)->get();
        return view("cms.repInventory.index",compact("title","parentTitle","linkApp","sections","repo"));
    }


    function getAll($id)
    {
        $isRepository=Repository::where('id',$id)->count();
        if ($isRepository>0){
            $repository=Repository::where('id',$id)->first();
            $isInventory_repo=Inventory_repo::where('repository_id',$repository->id)->latest()->first();
            $isSection=Rep_section::where('repository_id',$repository->id)->where('isdelete',0)->count();
            if ($isSection>0){
                $sections=Rep_section::where('repository_id',$repository->id)->where('isdelete',0)->get();
                foreach ($sections as $section){
                    $isMaterial=Material::where('repository_id',$repository->id)->where('section',$section->id)->where('isdelete',0)->count();
                    if ($isMaterial>0){
                        $materials=Material::where('repository_id',$repository->id)->where('section',$section->id)->where('isdelete',0)->get();
                        foreach ($materials as $material){

                                $isRep_inventory=Rep_inventory::where('repository_id',$repository->id)->where('section_id',$section->id)->where('material_id',$material->id)->where('isdelete',0)->count();
                                if($isRep_inventory>0){
                                    $quan=0;$tot=0;
                                    $rep=Rep_inventory::where('repository_id',$repository->id)->where('section_id',$section->id)->where('material_id',$material->id)->where('isdelete',0)->first();
                                    $rep->last_price = $material->single_pay;
                                    $repository_ins = Repository_in::where('repository_id', $repository->id)->where('section', $section->id)->where('material_id', $material->id)->where('isdelete', 0)->get();
                                    if(count($repository_ins)>0){
                                    foreach ($repository_ins as $repository_in) {
                                        $quan += $repository_in->quantity;
                                        $tot += $repository_in->total;
                                    }
                                    }
                                    $rep->pay_count = $quan;
                                    $rep->sum_pay = $tot;
                                    $rep->count = $material->count_new;
                                    $rep->save();
                                }else{
                                    $quan=0;$tot=0;
                                    $rep= new Rep_inventory();
                                    $rep->repository_id = $repository->id;
                                    $rep->inventory_id = $isInventory_repo->id;
                                    $rep->section_id = $section->id;
                                    $rep->material_id = $material->id;
                                    $rep->last_price = $material->single_pay;
                                    $repository_ins = Repository_in::where('repository_id', $repository->id)->where('section', $section->id)->where('material_id', $material->id)->where('isdelete', 0)->get();
                                    foreach ($repository_ins as $repository_in) {
                                        $quan += $repository_in->quantity;
                                        $tot += $repository_in->total;
                                    }
                                    $rep->pay_count = $quan;
                                    $rep->sum_pay = $tot;
                                    $rep->count = $material->count_new;
                                    $rep->created_by=$this->getId();
                                    $rep->save();
                                }

                        }
                    }
                }
            }
        }else{
            Session::flash("msg","لا يوجد سجلات لجردها");
            Session::flash("msgClass","alert-danger");
            return redirect("/CMS/Repository");
        }
    }

    public function getAdd($id)
    {
        $title="اضافة الجرد";
        $parentTitle="ادارة المستودعات";
        $linkApp="/CMS/Repository/";
        $parentPTitle="جرد المستودعات";
        $parentLink="/CMS/Rep/Inventory/".$id;
        $item=Rep_inventory::find($id);
        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Rep/Inventory/".$id);
        }
        return view("cms.repInventory.add",compact("title","item","id","parentTitle","parentLink","linkApp","parentPTitle"));
    }

    public function postAdd(Request $request,$id)
    {
        $this->validate($request,
            [
                'count_inv' => 'required',
                'remaind_h' => 'required',
                'rem_price_h' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $rep = Rep_inventory::find($id);
        if($rep){
            $rep->count_inv=$request->input("count_inv");
            $rep->remaind=$request->input("remaind_h");
            $rep->rem_price=$request->input("rem_price_h");
            $rep->save();
            $inventoryrepo = Inventory_repo::where('repository_id',$rep->repository_id)->latest()->first();
            $inventoryrepo->rem_price += $request->input("rem_price_h");
            $inventoryrepo->save();
            $msg="تمت عملية الاضافة بنجاح";
        }else{
            $msg="حدثت مشكلة اثناء عملية الاضافة";
        }

        Session::flash("msg",$msg);
        return redirect("/CMS/Rep/Inventory/".$rep->repository_id);
    }

    public function getDone($id)
    {
        $rep = Repository::find($id);
        if($rep){
            $rep->isDone=1;
            $rep->save();
            $msg="تمت عملية طلب الجرد بنجاح";
        }else{
            $msg="حدثت مشكلة اثناء عملية طلب الجرد";
        }

        Session::flash("msg",$msg);
        return redirect("/CMS/Rep/Inventory/".$id);
    }

    public function getSuccess($id)
    {
        $rep = Repository::find($id);
        if($rep){
            $rep->isDone=1;
            $rep->save();
            $msg="تمت عملية طلب الجرد بنجاح";
        }else{
            $msg="حدثت مشكلة اثناء عملية طلب الجرد";
        }

        Session::flash("msg",$msg);
        return redirect("/CMS/Rep/Inventory/".$id);
    }

    public function getAccept($id)
    {

        $isRepository=Repository::where('id',$id)->count();
        if ($isRepository>0){
            $repository=Repository::where('id',$id)->first();
            $isInventory_repo=Inventory_repo::where('repository_id',$repository->id)->latest()->first();
            $repository->isDone=0;
            $repository->save();
            $isInventory_repo->update([
                            'is_accept'=>1,
                        ]);
            $isSection=Rep_section::where('repository_id',$repository->id)->where('isdelete',0)->count();
            if ($isSection>0){
                $sections=Rep_section::where('repository_id',$repository->id)->where('isdelete',0)->get();
                foreach ($sections as $section){
                    $isMaterial=Material::where('repository_id',$repository->id)->where('section',$section->id)->where('isdelete',0)->count();
                    if ($isMaterial>0){
                        $materials=Material::where('repository_id',$repository->id)->where('section',$section->id)->where('isdelete',0)->get();
                        foreach ($materials as $material){
                            $isRep=Rep_inventory::where('repository_id',$repository->id)->where('section_id',$section->id)->where('material_id',$material->id)->where('isdelete',0)->count();
                            if ($isRep>0){
                                $rep=Rep_inventory::where('repository_id',$repository->id)->where('section_id',$section->id)->where('material_id',$material->id)->where('isdelete',0)->first();
                                if ($rep->remaind!=0){
                                    $last_rep_in=Repository_in::latest()->first();
                                    $rep_in=new Repository_in();
                                    $rep_in->m_year=$this->getMoneyYear();
                                    $rep_in->repository_id=$repository->id;
                                    $rep_in->customer="زبون";
                                    $rep_in->id_comp=($last_rep_in->id_comp + 1);
                                    $rep_in->section=$section->id;
                                    $rep_in->created_by=Auth::user()->id;
                                    $rep_in->material_id=$material->id;
                                    $rep_in->count=$rep->count;
                                    $rep_in->single_pay=$rep->last_price;
                                    $rep_in->notes="جرد";
                                    $rep_in->quantity=$rep->remaind;
                                    $rep_in->total=$rep->rem_price;

                                    if ($rep_in->save()){
                                        $rep_year = Repository_year::where('repository_id',$repository->id)->where('m_year',$this->getMoneyYear())->first();
                                        $rep_year->repository_in = $rep_year->repository_in+$rep->rem_price;
                                        if ($rep_year->save()){
                                            $box = Box_year::where('box_id',$repository->box_id)->where('m_year',$this->getMoneyYear())->first();
                                            $box->income = $rep_year->repository_in;
                                            $box->save();
                                            $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
                                            $primary->income += $rep->rem_price;
                                            $primary->save();
                                        }



                                        $material->count_old = $rep->count_inv;
                                        $material->count_new = $rep->count_inv;
                                        $material->save();
                                        $repository->isDone=0;
                                        $repository->save();
                                    }
                                }
                                $rep->isdelete=1;
                                $rep->save();

                            }
                        }
                    }
                }
            }
            $rep_inv_record = new Rep_inv_record();
            $rep_inv_record->repository_id = $repository->id;
            $rep_inv_record->inventory_num = $isInventory_repo->inventory_num;
            $rep_inv_record->user_id = $isInventory_repo->resUser_id;
            $rep_inv_record->date_inv = $isInventory_repo->created_at;
            $rep_inv_record->sum_remaind = $isInventory_repo->rem_price;
            $rep_inv_record->date_done = date('Y-m-d');
            $rep_inv_record->admin_id = $isInventory_repo->created_by;
            $rep_inv_record->save();
        }else{
            Session::flash("msg","حدثت مشكلة اثناء عملية الجرد");
            Session::flash("msgClass","alert-danger");
            return redirect("CMS/InventoryRepo");
        }

        Session::flash("msg",'تم عملية الجرد بنجاح');
        return redirect("CMS/InventoryRepo");
    }

    public function count_inv($id){
        $parentTitle="عرض الارشيف ";
        $rep = Rep_inventory::find($id);

        $title="سجل الارشيف العام ";

        if($rep==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Archive/");
        }

        $returnHTML= view("cms.repInventory.showModal",compact("title","rep","id","parentTitle"))->render();

            return response()->json(['html'=>$returnHTML]);
    }
}
