<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Option;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class OptionController  extends CMSBaseController
{


    function getActive($id){
        $item=Option::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getAdd($parent_id=0)
    {
        $parentTitle="اضافة ثابت جديد";
        $title="ادارة الثوابت";
        $linkApp="/CMS/Option/$parent_id";
        return view("cms.option.add",compact("title","parentTitle","linkApp","parent_id"));
    }

    function postAdd(Request $request,$parent_id,FlasherInterface $flasher){
        $this->validate($request,
            [
                'title' => 'required'
            ],
            [
                "title.required"=>"يجب ادخال هذا الحقل"
            ]);
        $title=$request->input("title");

        $isExists=Option::whereRaw("isdelete=0 and title='$title' and parent_id=$parent_id")->count();
        if($isExists>0)
        {
            flash()->addWarning("اسم القائمة موجود مسبقا");
            flash()->addError("alert-danger");
            return redirect("/CMS/Option/add/$parent_id")->withInput();
        }

        $item=new Option();
        $item->parent_id=$parent_id;
        $item->title=$request->input("title");
        $item->created_by=$this->getId();
        $item->active=$request->input("active")?1:0;
        $item->save();

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/Option/add/$parent_id");
    }


    function getIndex($parent_id=0){
        $title="الاعدادات";
        $subtitle="ادارة الثوابت";
        if ($parent_id != 0){
            $parentTitle=Option::find($parent_id)->title;
            $linkApp="/CMS/Option/0";
            $parentId=Option::find($parent_id)->parent_id;
            $parentLink="/CMS/Option/".$parentId;
            if ($parentId!=0){
                $parentTitle=Option::find($parentId)->title;
                $parentPTitle=Option::find($parent_id)->title;
            } else{
                $parentLink='';
                $parentPTitle='';
            }
        } else{
            $parentTitle='';
            $linkApp='';
            $parentPTitle='';
            $parentLink='';
            $parentId=0;
        }
        $items=Option::whereRaw("(id!=168 and isdelete=0 and parent_id =$parent_id)")->orderBy("id","desc")->paginate(10);
        $id=Option::where('id','=',$parent_id)->first();
        return view("cms.option.index",compact("title","subtitle","parent_id","parentId","items","parentTitle","linkApp","parentPTitle","parentLink","id"));
    }



    function getDelete($id,FlasherInterface $flasher){
        $item=Option::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->deleted_at=date('Y-m-d h:i:s');
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Option/$item->parent_id");
    }

    function getDeleted($id){
        $item=Option::find($id);
        $item->delete();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Option/$item->parent_id");
    }


    function getEdit($id,FlasherInterface $flasher)
    {   $title="الاعدادات";
        $parentTitle="تعديل الثوابت ";
        $item=Option::where("id",$id)->first();
        $parent_id=$item->parent_id;
        $linkApp="/CMS/Option/".$parent_id;
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Option/$parent_id");
        }
        return view("cms.option.edit",compact("title","item","id","parent_id",'parentTitle'));
    }

    function getShow($id,FlasherInterface $flasher)
    {
        $item=Option::where("id",$id)->first();
        if ($item->parent_id != 0){
            $parentTitle=Option::find($item->parent_id)->title;
            $parentPLink="/CMS/Option/$item->parent_id";
            $linkApp="/CMS/Option/0";
            $title="ادارة الثوابت ";
        } else{
            $parentTitle='';
            $parentPLink='';
            $linkApp='';
            $title="عرض الثابت ";
        }
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Option/");
        }
        $parent_id=$item->parent_id;
        return view("cms.option.show",compact("title","item","id","parent_id","parentTitle","linkApp","parentPLink"));
    }


    function postEdit(Request $request,$id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'title' => 'required'
            ],
            [
                "title.required"=>"يجب ادخال هذا الحقل"
            ]);
        $title=$request->input("title");
        $parent_id=$request->input("parent_id");
        $isExists=Option::whereRaw("isdelete=0 and title='$title' and parent_id=$parent_id and id!=$id")->count();
        if($isExists>0)
        {
            flash()->addWarning("اسم القائمة موجود مسبقا");
            flash()->addError("alert-danger");
            return redirect("/CMS/Menu/edit/$id")->withInput();
        }
        $item=Option::find($id);
        $item->title=$request->input("title");
        $item->updated_by=$this->getId();
        $item->active=$request->input("active")?1:0;
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/Option/$parent_id");
    }
}

