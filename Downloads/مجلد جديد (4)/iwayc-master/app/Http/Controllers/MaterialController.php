<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Option;
use App\Models\Material;
use App\Models\Repository;
use App\Models\Rep_section;
use Illuminate\Http\Request;
use App\Models\Repository_year;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class MaterialController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="الاصناف والكميات";
        $title="المستودع";
        $items=Material::where('isdelete',0)->paginate(10);
        $repositories=Repository::leftJoin('repositories_year as rp', 'rp.repository_id','=','repositories.id')
            ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
            ->select([ 'repositories.id', 'repositories.name', 'rp.m_year', 'rp.active'])
            ->where('repositories.isdelete',0)->where('rp.active',1)->where('rp.m_year',$this->getMoneyYear())->orderBy('repositories.name')
            ->where('repository_view.user_id','=',Auth::user()->id)
            ->get();
        $materials=Material::where("isdelete",0)->get();
        return view("cms.material.index",compact("title","subtitle","items","repositories","materials"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة صنف جديد";
        $title="المستودع";

       $repositories=Repository::leftJoin('repositories_year', 'repositories_year.repository_id','=','repositories.id')
       ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
            ->select([ 'repositories.id', 'repositories.name', 'repositories_year.active'])
            ->where('repositories.isdelete','=','0')->where('repositories_year.active','=','1')->where('repositories_year.m_year',$this->getMoneyYear())->orderBy('repositories.name')
            ->where('repository_view.user_id','=',Auth::user()->id)->get();
        return view("cms.material.add",compact("title","parentTitle",/* "sections", */"repositories"));
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
                'name' => 'required',
                'repository_id' => 'required',
                'section' => 'required',
                'count_old' => 'required',
                'count_new_h' => 'required',
                'single_cost' => 'required',
                'single_pay' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);
        $material = Material::create([
            'name' => $request->input("name"),
            'repository_id' => $request->input("repository_id"),
            'section' => $request->input("section"),
            'count_old' => $request->input("count_old"),
            'count_new' => $request->input("count_new_h"),
            'single_cost' => $request->input("single_cost"),
            'single_pay' => $request->input("single_pay"),
            'notes' => $request->input("notes"),
            'active' => $request->input("active")?1:0,
            'isdelete' => $request->input("isdelete")?1:0,
            'created_by' => $this->getId()
        ]);

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");

        return redirect("/CMS/Material/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل الصنف ";
        $item=Material::where("id",$id)->where("isdelete",0)->first();
        $title="ادارة الاصناف والموارد";
        $linkApp="/CMS/Material/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Material/");
        }
        return view("cms.material.show",compact("title","item","id","parentTitle","linkApp"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل الصنف ";
        $title="المستودع";
        $item=Material::where("id",$id)->where("isdelete",0)->first();
        $boxes=Box::where('active',1)->where('isdelete',0)->get();
        $repositories=Repository::leftJoin('repositories_year', 'repositories_year.repository_id','=','repositories.id')
        ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
            ->select([ 'repositories.id', 'repositories.name', 'repositories_year.active'])
            ->where('repositories.isdelete','=','0')->where('repositories_year.active','=','1')->where('repositories_year.m_year',$this->getMoneyYear())->orderBy('repositories.name')
            ->where('repository_view.user_id','=',Auth::user()->id)->get();
        $sections=Rep_section::where('repository_id',$item->repository_id)->where('isdelete',0)->get();

        $linkApp="/CMS/Material/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Material/");
        }
        return view("cms.material.edit",compact("title","item","id","sections","parentTitle","linkApp","boxes","repositories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'repository_id' => 'required',
                'section' => 'required',
                'count_old' => 'required',
                'count_new' => 'required',
                'single_cost' => 'required',
                'single_pay' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Material::find($id);
        $item->name=$request->input("name");
        $item->repository_id=$request->input("repository_id");
        $item->section=$request->input("section");
        $item->count_old=$request->input("count_old");
        $item->count_new=$request->input("count_new");
        $item->single_cost=$request->input("single_cost");
        $item->single_pay=$request->input("single_pay");
        $item->notes=$request->input("notes");
        $item->active=$request->input("active")?1:0;
        $item->isdelete=$request->input("isdelete")?1:0;
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");

        return redirect("/CMS/Material/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Material::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Material/");
    }
}
