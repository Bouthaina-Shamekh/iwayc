<?php

namespace App\Http\Controllers\English;


use App\Models\English;
use App\Models\English_reg;
use App\Models\Level_up;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;
class LevelUpController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="علامات المستوى والتأهيل";
        $parentTitle="المحادثة انجليزي";
        $students=English::where('isdelete',0)->where('active',1)->get();
        $levels = Option::where('isdelete',0)->where('parent_id',13)->where('active',1)->get();

        return view("cms.levelUp.index",compact("title","parentTitle","students","levels"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
    public function getAdd($id)
    {
        $title="اللغه الانجليزيه";
        $parentTitle="علامات المستوى والتأهيل";
        $item = English_reg::find($id);
        $level_up = Option::where('parent_id',13)->where('active',1)->get();

        return view("cms.levelUp.add",compact("title","parentTitle","item","level_up","id"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'date' => 'required',
                'student_id_h' => 'required',
                'level_h' => 'required',
                'total' => 'required',
                'level_up' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $level_up = Level_up::create([
            'date' => $request->input("date"),
            'student_id' => $request->input("student_id_h"),
            'level' => $request->input("level_h"),
            'total' => $request->input("total"),
            'level_up' => $request->input("level_up"),
            'notes' => $request->input("notes"),
            'created_by' => $this->getId()
        ]);

        if ($level_up){
            $uid=$request->input("id_h");

            $english_reg=English_reg::find($uid);
            $english_reg->ispass=1;
            $english_reg->status=2;
            $english_reg->deleted_by=$this->getId();
            $english_reg->save();
        }

        Session::flash("msg","تمت عملية الاضافة بنجاح");
        return redirect("/CMS/LevelUp/");
    }
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parentTitle="علامات المستوى والتأهيل";
        $item=Level_up::where("id",$id)->where("isdelete",0)->first();
        $title="اللغه الانجليزيه";
        $linkApp="/CMS/LevelUp/";
        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/LevelUp/");
        }
        return view("cms.levelUp.show",compact("title","item","id","parentTitle","linkApp"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parentTitle="علامات المستوى والتأهيل";
        $item=Level_up::where("id",$id)->where("isdelete",0)->first();
        $title="اللغه الانجليزيه";
        $linkApp="/CMS/LevelUp/";
        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/LevelUp/");
        }
        $level_up = Option::where('parent_id',13)->where('active',1)->get();
        return view("cms.levelUp.edit",compact("title","item","id","parentTitle","linkApp","level_up"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'date' => 'required',
                'student_id_h' => 'required',
                'level_h' => 'required',
                'total' => 'required',
                'level_up' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Level_up::find($id);
        $item->date=$request->input("date");
        $item->student_id=$request->input("student_id_h");
        $item->level=$request->input("level_h");
        $item->total=$request->input("total");
        $item->level_up=$request->input("level_up");
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        $item->save();

        Session::flash("msg","تمت عملية الحفظ بنجاح");
        return redirect("/CMS/LevelUp/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelete($id)
    {
        $item=Level_up::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        Session::flash("msg","تمت عملية الحذف بنجاح");
        return redirect("/CMS/LevelUp/");
    }
}
