<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Box;
use App\Models\Skill;
use App\Models\Option;
use App\Models\Box_year;
use App\Models\Employee;

use App\Models\Income_box;
use Illuminate\Http\Request;
use App\Models\Income_levels;
use Illuminate\Http\Response;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;

class IncomeLevelController extends CMSBaseController
{

    public function index()
    {
        $subtitle="ادارة مستويات الدخل";
        $title="جديد 2019";
        return view("cms.incomeLevel.index",compact("title","subtitle"));
    }

    public function create()
    {
        $parentTitle="اضافة مستوى دخل جديد";
        $title="مستوى دخل جديد";
        $linkApp="/CMS/IncomeLevel/";
        $boxes = Box::where("isdelete",0)->where("active",1)->get();
        return view("cms.incomeLevel.add",compact("title","parentTitle","linkApp","boxes"));
    }

    public function store(Request $request,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'in_from' => 'required',
                'in_to' => 'required',
                'expenses' => 'required',
                'level1' => 'required',
                'level2' => 'required',
                'level3' => 'required',
                'level4' => 'required',
                'level5' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل",
            ]);

        $name=$request->input("name");

        $isExists=Income_levels::where('name',$name)->count();
        if($isExists>0)
        {
            flash()->addWarning("الاسم موجود مسبقا");
            flash()->addError("alert-danger");
            return redirect("/CMS/IncomeLevel/create")->withInput();
        }

        $income_levels = Income_levels::create([
            'name' => $request->input("name"),
            'm_year' => $this->getMoneyYear(),
            'in_from' => $request->input("in_from"),
            'in_to' => $request->input("in_to"),
            'expenses' => $request->input("expenses"),
            'level1' => $request->input("level1"),
            'level2' => $request->input("level2"),
            'level3' => $request->input("level3"),
            'level4' => $request->input("level4"),
            'level5' => $request->input("level5"),
            'active' => $request->input("active")?1:0,
            'created_by' => $this->getId()
        ]);
        $total=0;
        $in_boxes = $request->input('in_boxes');
        foreach($in_boxes as $in_box){
            $in_b = new Income_box();
            $in_b->box_id = $in_box;
            $in_b->income_id = $income_levels->id;
            $in_b->save();
            $total+=Box_year::where('box_id',$in_box)->where('m_year',$this->getMoneyYear())->sum('total');
        }

        $ee=$request->input("in_to");
        $created = new Carbon($ee);
        $now = Carbon::now();
        $interval =$now->diff($created);
        $days = $interval->format('%a');

        $income_levels->balance=$total;
        $income_levels->remaind=$days;
        $income_levels->save();

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/IncomeLevel/create");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="عرض مستوى الدخل ";
        $item=Income_levels::where("id",$id)->where("isdelete",0)->first();
        $in_boxes=Income_box::where("income_id",$id)->get();
        $title="ادارة مستويات الدخل";
        $linkApp="/CMS/IncomeLevel/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/IncomeLevel/");
        }
        $returnHTML = view("cms.incomeLevel.show",compact("title","item","id","parentTitle","linkApp","in_boxes"))->render();
            return response()->json(['html'=>$returnHTML]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل مستوى الدخل ";
        $boxes = Box::get();
        $item=Income_levels::where("id",$id)->where("isdelete",0)->first();
        $in_boxes=Income_box::where("income_id",$id)->get();
        $title="ادارة مستويات الدخل";
        $linkApp="/CMS/IncomeLevel/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/IncomeLevel/");
        }
        return view("cms.incomeLevel.edit",compact("title","item","id","parentTitle","linkApp","in_boxes","boxes"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'in_from' => 'required',
                'in_to' => 'required',
                'expenses' => 'required',
                'level1' => 'required',
                'level2' => 'required',
                'level3' => 'required',
                'level4' => 'required',
                'level5' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل",
                "email.email"=>"يجب ادخال بريد الكتروني صحيح",
            ]);

        $item=Income_levels::find($id);
        $name=$request->input("name");
        if ($item->name != $name){
            $isExists=Income_levels::where('name',$name)->count();
            if($isExists>0)
            {
                flash()->addWarning("الاسم موجود مسبقا");
                flash()->addError("alert-danger");
                return redirect("/CMS/IncomeLevel/".$id."edit")->withInput();
            }
        }

        $item->name=$request->input("name");
        $item->in_from=$request->input("in_from");
        $item->in_to=$request->input("in_to");
        $item->remaind=$request->input("remaind_h");
        $item->expenses=$request->input("expenses");
        $item->balance=$request->input("balance_h");
        $item->level1=$request->input("level1");
        $item->level2=$request->input("level2");
        $item->level3=$request->input("level3");
        $item->level4=$request->input("level4");
        $item->level5=$request->input("level5");
        $item->active=$request->input("active")?1:0;
        $item->updated_by=$this->getId();
        $item->save();

        $total=0;
        $in_boxes = $request->input('in_boxes');
        if ($in_boxes!=null){
            Income_box::where('income_id',$id)->delete();
            foreach($in_boxes as $in_box){
                $in_b = new Income_box();
                $in_b->box_id = $in_box;
                $in_b->income_id = $id;
                $in_b->save();
                $total+=Box_year::where('box_id',$in_box)->where('m_year',$this->getMoneyYear())->sum('total');
            }
        }

        $ee=$request->input("in_to");
        $created = new Carbon($ee);
        $now = Carbon::now();
        $interval =$now->diff($created);
        $days = $interval->format('%a');

        $item->balance=$total;
        $item->remaind=$days;
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/IncomeLevel/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Income_levels::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/IncomeLevel/");
    }
}
