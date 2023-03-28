<?php

namespace App\Http\Controllers\English;

use App\Models\Option;
use App\Models\English;
use App\Models\Level_up;
use App\Models\Level_eng;
use App\Models\English_sal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class EnglishSalController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="متابعة طلبة المحادثة";
        $title="اللغه الانجليزيه";

        $this->getAll();
        $levels = Option::where('isdelete',0)->where('parent_id',13)->where('active',1)->get();
        $types = Option::where('isdelete',0)->where('parent_id',246)->where('active',1)->get();

        return view("cms.englishSal.index",compact("title","subtitle","levels","types"));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parentTitle="متابعة طلبة المحادثة";
        $item=English_sal::where("id",$id)->where("isdelete",0)->first();
        $title="متابعة طلبة المحادثة";
        $linkApp="/CMS/EnglishSal/";
        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/EnglishSal/");
        }
        return view("cms.englishSal.show",compact("title","item","id","parentTitle","linkApp"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parentTitle="متابعة طلبة المحادثة";
        $item=English_sal::where("id",$id)->where("isdelete",0)->first();
        $title="متابعة طلبة المحادثة";
        $linkApp="/CMS/EnglishSal/";
        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/EnglishSal/");
        }
        $type=Option::where('parent_id',246)->where('isdelete',0)->where('active',1)->get();
        $classification=Option::where('parent_id',12)->where('isdelete',0)->where('active',1)->get();

        return view("cms.englishSal.edit",compact("title","item","id","parentTitle","linkApp","type","classification"));
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
        $item=English_sal::find($id);
        $item->classification=$request->input("classification");
        $item->notes=$request->input("notes");
        $item->type=$request->input("type");
        $item->updated_by=$this->getId();
        $item->save();

        $english = English::find($item->student_id);
        $english->classification=$request->input("classification");
        $english->notes=$request->input("notes");
        $english->save();

        Session::flash("msg","تمت عملية الحفظ بنجاح");
        return redirect("/CMS/EnglishSal/");
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

    function getAll()
    {
        $isEnglish=English::where('isdelete',0)->count();
        if ($isEnglish>0) {
            $englishs = English::where('isdelete', 0)->get();
            foreach ($englishs as $english){
                $isEnglish_sal=English_sal::where('student_id',$english->id)->count();
                if ($isEnglish_sal>0) {
                    $english_sal=English_sal::where('student_id',$english->id)->first();
                    $english_sal->student_id=$english->id;
                    $english_sal->birthday=$english->year;
                    $english_sal->region=$english->address;
                    $english_sal->classification=$english->classification;
                    $english_sal->phone=$english->phone1.'-'.$english->phone2;
                    if($english_sal->save()){
                        $isLevel_eng=Level_eng::where('eng_id',$english_sal->id)->count();
                        if ($isLevel_eng>0) {
                            $level_engs=Level_eng::where('eng_id',$english_sal->id)->delete();
                            $isLevel_up=Level_up::where('student_id',$english->id)->where('isdelete',0)->count();
                            if ($isLevel_up>0) {
                                $level_ups=Level_up::where('student_id',$english->id)->where('isdelete',0)->get();
                                foreach ($level_ups as $level_up){
                                    $level_eng=new Level_eng();
                                    $level_eng->eng_id=$english_sal->id;
                                    $level_eng->level_id=$level_up->level;
                                    $level_eng->save();
                                }
                                $lev=Level_up::where('student_id',$english->id)->orderBy('id','desc')->first();
                                $english_sal->level_up=$lev->level_up;
                                $english_sal->save();
                            }else{
                                $english_sal->level_up=$english->level_pass;
                                $english_sal->save();
                            }
                        }else{
                            $isLevel_up=Level_up::where('student_id',$english->id)->where('isdelete',0)->count();
                            if ($isLevel_up>0) {
                                $level_ups=Level_up::where('student_id',$english->id)->where('isdelete',0)->get();
                                foreach ($level_ups as $level_up){
                                    $level_eng=new Level_eng();
                                    $level_eng->eng_id=$english_sal->id;
                                    $level_eng->level_id=$level_up->level;
                                    $level_eng->save();
                                }
                                $lev=Level_up::where('student_id',$english->id)->orderBy('id','desc')->first();
                                $english_sal->level_up=$lev->level_up;
                                $english_sal->save();
                            }else{
                                $english_sal->level_up=$english->level_pass;
                                $english_sal->save();
                            }
                        }
                    }else{
                        Session::flash("msg","لم يتم الحفط يرجي تحديث الصفحة");
                        Session::flash("msgClass","alert-danger");
                        return redirect("/CMS/EnglishSal");
                    }
                }
                else{
                    $english_sal= new English_sal();
                    $english_sal->student_id=$english->id;
                    $english_sal->birthday=$english->year;
                    $english_sal->region=$english->address;
                    $english_sal->classification=$english->classification;
                    $english_sal->phone=$english->phone1.'-'.$english->phone2;
                    if($english_sal->save()){
                        $isLevel_up=Level_up::where('student_id',$english->id)->where('isdelete',0)->count();
                        if ($isLevel_up>0) {
                            $level_ups=Level_up::where('student_id',$english->id)->where('isdelete',0)->get();
                            foreach ($level_ups as $level_up){
                                $level_eng=new Level_eng();
                                $level_eng->eng_id=$english_sal->id;
                                $level_eng->level_id=$level_up->level;
                                $level_eng->save();
                            }
                            $lev=Level_up::where('student_id',$english->id)->orderBy('id','desc')->first();
                            $english_sal->level_up=$lev->level_up;
                            $english_sal->save();
                        }else{
                            $english_sal->level_up=$english->level_pass;
                            $english_sal->save();
                        }
                    }
                }
            }
        }else{
            Session::flash("msg","لا يوجد طلاب مسجلين حاليا");
            Session::flash("msgClass","alert-danger");
            return redirect("/CMS/EnglishSal");
        }
    }

    public function isDelete($id)
    {
        $item=English_sal::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        Session::flash("msg","تمت عملية الحذف بنجاح");
        return redirect("/CMS/EnglishSal/");
    }
}
