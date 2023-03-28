<?php

namespace App\Http\Controllers;

use App\Models\Rep_section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RepSectionController extends CMSBaseController
{
    function getIndex($id){
        $subtitle="ادارة المستودعات";
        $title="المستودع";
        $linkApp="/CMS/Repository/";
        $parentTitle="ادارة الاقسام";

        $items=Rep_section::where("repository_id",$id)->where("isdelete","0")->orderBy("id","desc")->paginate(10);
        return view("cms.repSection.index",compact("title","subtitle","id","items","parentTitle","linkApp"));
    }

    function getAdd($id)
    {
        $parentTitle="اضافة قسم جديد";
        $title="المستودعات";
        $linkApp="/CMS/Repository/";
        $parentPTitle="ادارة الاقسام";
        $parentLink="/CMS/RepositorySection/";
        return view("cms.repSection.add",compact("title","parentTitle","id","parentLink","linkApp","parentPTitle"));
    }

    function postAdd(Request $request,$id){
        $this->validate($request,
            [
                'name' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);
        $repSection = Rep_section::create([
            'name' => $request->input("name"),
            'repository_id' => $request->input("repository_id"),
            'created_by' => $this->getId()
        ]);

        Session::flash("msg","تمت عملية الاضافة بنجاح");
        return redirect("/CMS/RepositorySection/".$id);
    }

    function getEdit($id)
    {
        $title="تعديل الاقسام ";
        $item=Rep_section::where("id",$id)->where("isdelete",0)->first();
        $parentTitle="ادارة المستودعات";
        $linkApp="/CMS/Repository/";
        $parentPTitle="ادارة الاقسام";
        $parentLink="/CMS/RepositorySection/";
        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/RepositorySection/");
        }
        return view("cms.repSection.edit",compact("title","item","id","parentTitle","parentLink","linkApp","parentPTitle"));
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Rep_section::find($id);
        $item->name=$request->input("name");
        $item->updated_by=$this->getId();
        $item->save();

        Session::flash("msg","تمت عملية الحفظ بنجاح");
        return redirect("/CMS/RepositorySection/".$item->repository_id);
    }

    public function getDelete($id)
    {
        $item=Rep_section::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->deleted_at=date("Y-m-d h:i:s");
        $item->save();
        Session::flash("msg","تمت عملية الحذف بنجاح");
        return redirect()->back();
    }
}
