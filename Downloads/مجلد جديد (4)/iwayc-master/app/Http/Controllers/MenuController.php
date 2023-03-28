<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use DB;
use App\Models\Link;
use Yajra\DataTables\DataTables;

class MenuController  extends CMSBaseController
{
    function getActive($id){
        $item=Link::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }
    function getShowMenu($id){
        $item=Link::find($id);
        $item->show_menu=1-$item->show_menu;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }
    function getAdd($parent_id=0)
    {
        $parentTitle="اضافة قائمة جديد";
        $title="ادارة القوائم";
        $linkApp="/CMS/Menu/$parent_id";
        return view("cms.menu.add",compact("title","parentTitle","linkApp","parent_id"));
    }


    function postAdd(Request $request,$parent_id){

        $this->validate($request,
            [
                'title' => 'required',
                'slug' => 'required',
                'icone' => 'required',
            ],
            [
                "title.required"=>"يجب ادخال هذا الحقل",
                "slug.required"=>"يجب ادخال هذا الحقل",
                "icone.required"=>"يجب ادخال هذا الحقل",
            ]);

        $title=$request->input("title");

        $isExists=Link::whereRaw("isdelete=0 and title='$title' and parent_id=$parent_id")->count();
        if($isExists>0)
        {
            Session::flash("msg","اسم القائمة موجود مسبقا");
            Session::flash("msgClass","alert-danger");
            return redirect("/CMS/Menu/add/$parent_id")->withInput();
        }

        $item=new Link();
        $item->parent_id=$parent_id;
        $item->title=$request->input("title");
        $item->slug=$request->input("slug");
        $item->icone=$request->input("icone");
        $item->show_menu=$request->input("show_menu")?1:0;
        $item->created_by=$this->getId();
        $item->active=$request->input("active")?1:0;
        if ($item->save()){
            $i=Link::find($item->id);
            $i->ordered=$i->id;
            $i->save();
        }

        Session::flash("msg","تمت عملية الاضافة بنجاح");
        return redirect("/CMS/Menu/$parent_id");
    }


    function getIndex($parent_id=0){
        $subtitle="ادارة القوائم";
        $title="الاعدادات";

        $items=Link::where('isdelete',0)->where('parent_id',$parent_id);
        if($parent_id !=0){
            $itemstitle=Link::where('isdelete',0)->where('id',$parent_id)->first()->title;
        }else{
            $itemstitle= "ادارة القوائم";
        }

        $ordered=Link::where('isdelete',0)->where('parent_id',$parent_id)->orderBy("ordered")->get();
        $items=$items->orderBy("ordered");
        $items=$items->paginate(10);

        return view("cms.menu.index",compact("title","subtitle","itemstitle","parent_id","items","ordered"));
    }

    function getDelete($id){
        $item=Link::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->deleted_at=date('Y-m-d h:i:s');
        $item->save();
        Session::flash("msg","تمت عملية الحذف بنجاح");
        return redirect("/CMS/Menu/$item->parent_id");
    }
    function getOrdered($id,$ord){
        $r=Link::where('id',$id)->first();
        $o=Link::where('ordered',$ord)->first();
        $rr=$r->ordered;
        $r->ordered=$ord;
        $o->ordered=$rr;
        $r->updated_by=$this->getId();
        $o->updated_by=$this->getId();
        if ($r->save()){
            $o->save();
        }

        return response()->json(['status' => '1']);
    }

    function getDeleted($id){
        $item=Link::find($id);
        $item->delete();
        Session::flash("msg","تمت عملية الحذف بنجاح");
        return redirect("/CMS/Menu/$item->parent_id");
    }


    function getEdit($id)
    {
        $title="تعديل القائمة ";
        $parentTitle="ادارة القوائم";
        $item=Link::where("id",$id)->first();
        $parent_id=$item->parent_id;
        $linkApp="/CMS/Menu/".$parent_id;
        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Menu/".$parent_id);
        }
        return view("cms.menu.edit",compact("title","item","id","parent_id","parentTitle","linkApp"));
    }

    function getShow($id)
    {

        $title="عرض القائمة ";
        $parentTitle="ادارة القوائم";
        $item=Link::where("id",$id)->first();
        $parent_id=$item->parent_id;
        $linkApp="/CMS/Menu/".$parent_id;
        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Menu/");
        }
        return view("cms.menu.show",compact("title","item","id","parent_id","parentTitle","linkApp"));
    }


    function postEdit(Request $request,$id)
    {
        $this->validate($request,
            [
                'title' => 'required',
                'slug' => 'required',
                'icone' => 'required',
            ],
            [
                "title.required"=>"يجب ادخال هذا الحقل",
                "slug.required"=>"يجب ادخال هذا الحقل",
                "icone.required"=>"يجب ادخال هذا الحقل",
            ]);
        $title=$request->input("title");
        $parent_id=$request->input("parent_id");
        $isExists=Link::whereRaw("isdelete=0 and title='$title' and parent_id=$parent_id and id!=$id")->count();
        if($isExists>0)
        {
            Session::flash("msg","اسم القائمة موجود مسبقا");
            Session::flash("msgClass","alert-danger");
            return redirect("/CMS/Menu/edit/$id")->withInput();
        }
        $item=Link::find($id);
        $item->title=$request->input("title");
        $item->slug=$request->input("slug");
        $item->icone=$request->input("icone");
        $item->show_menu=$request->input("show_menu")?1:0;
        $item->updated_by=$this->getId();
        $item->active=$request->input("active")?1:0;
        $item->save();

        Session::flash("msg","تمت عملية الحفظ بنجاح");
        return redirect("/CMS/Menu/$parent_id");
    }


}

