<?php

namespace App\Http\Controllers\English;

use App\Models\Option;
use App\Models\English;
use App\Models\English_reg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class EnglishRegController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="اللغه الانجليزيه";
        $subtitle="ادارة دورات المحادثة";


        $students=English::where("isdelete",0)->where("active",1)->orderBy('student_name')->get();
        $levels=Option::where("parent_id",13)->where("isdelete",0)->where("active",1)->get();
        return view("cms.englishReg.index",compact("title","subtitle","students","levels"));
    }
    public function getEnd()
    {
        $title="ادارة دورات المحادثة";
        $subtitle="";
        $students=English::where("isdelete",0)->where("active",1)->orderBy('student_name')->get();
        $levels=Option::where("parent_id",13)->where("isdelete",0)->where("active",1)->get();
        return view("cms.englishReg.end",compact("title","subtitle","students","levels"));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'student_id' => 'required',
            'level_id_h' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);

    $english_reg = English_reg::create([
        'level_id' => $request->input("level_id_h"),
        'student_id' => $request->input("student_id"),
        'created_by' => $this->getId()
    ]);

    Session::flash("msg","تمت عملية الاضافة بنجاح");
    return redirect("/CMS/EnglishReg/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function isWithdrawal($id)
    {
        $item=English_reg::find($id);
        $item->iswithdrawal=1;
        $item->status=1;
        $item->deleted_by=$this->getId();
        $item->save();

        Session::flash("msg","تمت عملية الانسحاب بنجاح");
        return redirect("/CMS/EnglishReg/");
    }
    public function isDelete($id)
    {
        $item=English_reg::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();

        Session::flash("msg","تمت عملية الحذف بنجاح");
        return redirect("/CMS/EnglishReg/");
    }
    public function getEnglishReg($id)
    {
        $title="تسجيل طالب في الدورة";
        $item=Option::where("id",$id)->where("isdelete",0)->first();
        $students=English::where("isdelete",0)->where("active",1)->orderBy('student_name')->get();
        $parentTitle="ادارة الدورات";
        $parentLink="/CMS/EnglishReg/";
        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/EnglishReg/");
        }
        return view("cms.englishReg.add",compact("title","item","id","students","parentTitle","parentLink"));
    }
}
