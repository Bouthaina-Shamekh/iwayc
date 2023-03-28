<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\User;
use App\Models\BoxPer;
use App\Models\Option;
use App\Models\Box_year;
use App\Models\Money_year;
use App\Models\Repository;
use Illuminate\Http\Request;
use App\Models\Catch_receipt;
use App\Models\Repository_in;
use App\Models\Receipt_salary;
use App\Models\Catch_receipt_box;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Utilities\Request as YajraRequest;

class BoxController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="ادارة الصناديق";
        $title="الماليه";
        return view("cms.box.index",compact("title","subtitle"));
    }
    public function getIndex()
    {
        $subtitle="صلاحيات ظهور الصناديق";
        $title="الماليه";
        return view("cms.boxPer.index",compact("title","subtitle"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة صندوق جديد";
        $title="ادارة الصناديق";
        $linkApp="/CMS/Box/";
        $types=Option::where('parent_id',146)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        return view("cms.box.add",compact("title","parentTitle","linkApp","types"));
    }
    public function getAdd($id)
    {
        $parentTitle="صلاحيات الصناديق";
        $title="ارصدة الصناديق";
        $linkApp="/CMS/BoxPer/";
        $users=User::where('isdelete',0)->where("Status","مفعل")->orderBy('name')->get();
        $boxPers=BoxPer::where('box_id',$id)->get();
        return view("cms.boxPer.add",compact("title","parentTitle","linkApp","users","boxPers","id"));
    }

    public function postAdd(Request $request, $id,FlasherInterface $flasher)
    {
        $boxPers = $request->input("user_show");
        if ($boxPers!=null){
            BoxPer::where("box_id",$id)->delete();
            foreach($boxPers as $boxPer){
                $bp = new BoxPer();
                $bp->box_id = $id;
                $bp->user_id = $boxPer;
                $bp->save();
            }
        }

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/BoxPer/");
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
                'type' => 'required',
                'calculator_first' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);
        $box = Box::create([
            'name' => $request->input("name"),
            'type' => $request->input("type"),
            'm_year' => $request->input("edu_year_h"),
            'parent_id' => $request->input("parent_id"),
            'income' => 0,
            'expense' => 0,
            'repository_id' => 0,
            'active' => $request->input("active")?1:0,
            'isdelete' => $request->input("isdelete")?1:0,
            'created_by' => $this->getId()
        ]);

        if ($box){
            $isMoney_year=Money_year::where('isdelete',0)->count();
            if ($isMoney_year>0){
                $money_years=Money_year::where('isdelete',0)->get();
                foreach ($money_years as $money_year){
                    $box_year= new Box_year();
                    $box_year->m_year=$money_year->year;
                    $box_year->box_id=$box->id;
                    if ($money_year->year == $this->getMoneyYear()){
                        $box_year->calculator_first=$request->input("calculator_first");
                    }else{
                        $box_year->calculator_first=0;
                    }
                    $box_year->income=0;
                    $box_year->expense=0;
                    $box_year->save();
                }
            }
        }

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/Box");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id,FlasherInterface $flasher)
    {

        $parentTitle="تعديل الصناديق ";
        $item=Box::where("id",$id)->where("isdelete",0)->first();
        $title="ادارة الصناديق";
        $linkApp="/CMS/Box/";
        if($id == 1 ||$id ==2){
            $income ="غير معروف";
            $expense ="غير معروف";
        }else{
            $income =$request->income;
            $expense =$request->expense;
        }

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Box/");
        }

        return view("cms.box.show",compact("title","item","id","income",'expense',"parentTitle","linkApp"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {

        $item=Box::where("id",$id)->where("isdelete",0)->first();
        $box_year= Box_year::where('box_id',$item->id)->where('m_year',$this->getMoneyYear())->first();

        if ($item->type==168){
            Session::flash("msg","لا يمكن التعديل علي هذا السجل يرجي مراجعة المسؤول");
            return redirect("/CMS/Box/");
        }
        $parentTitle="تعديل الصناديق ";
        $types=Option::where('parent_id',146)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $title="ادارة الصناديق";
        $linkApp="/CMS/Box/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Box/");
        }

        return view("cms.box.edit",compact("title","item","id","parentTitle","linkApp","types","box_year"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'type' => 'required',
                'calculator_first' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        if ($id==1 or $id==2 or $id==3){
            Session::flash("msg","لا يمكن التعديل علي هذا الصندوق يرجي مراجعة المسؤول");
            return redirect("/CMS/Box/");
        }

        $yy=$request->input("m_year");

        $item=Box::find($id);
        $item->name=$request->input("name");
        $item->m_year=$yy;
        $item->type=$request->input("type");
        $item->parent_id=$request->input("parent_id");
        $item->active=$request->input("active")?1:0;
        $item->updated_by=$this->getId();

        if ($item->save()){
            $box_year= Box_year::where('box_id',$item->id)->where('m_year',$yy)->first();
            $box_year->calculator_first=$request->input("calculator_first");
            $box_year->save();
        }

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/Box/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Box::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Box/");
    }

    public function getLock($id,FlasherInterface $flasher)
    {
        $item=Box::find($id);

        $box_year= Box_year::where('box_id',$item->id)->where('m_year',$this->getMoneyYear())->first();
        $stat=$box_year->islock;
        $box_year->islock=1-$stat;
        $box_year->save();
        if($stat==0){
        flash()->addSuccess("تمت عملية القفل بنجاح");
        }else{
            flash()->addSuccess("تم التراجع عن القفل بنجاح");
        }
        return redirect("/CMS/Box/");
    }

}
