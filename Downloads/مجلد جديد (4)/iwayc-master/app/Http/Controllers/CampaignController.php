<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Option;
use App\Models\Campaign;

use Illuminate\Http\Request;
use App\Models\Campaign_filter;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class CampaignController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="ادارة الحملات الهاتفية";
        $title="التسويق";
        return view("cms.campaign.index",compact("title","subtitle"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة حملة جديدة";
        $title="التسويق";

       $linkApp="/CMS/Campaign/";
       $genders=Option::where("parent_id",62)->where("isdelete","0")->orderBy("title","asc")->get();
       $levels=Option::where("parent_id",59)->where("isdelete","0")->orderBy("title","asc")->get();
       $addresses=Option::where("parent_id",56)->where("isdelete","0")->orderBy("title","asc")->get();
       $classifications=Option::where("parent_id",12)->where("isdelete","0")->orderBy("title","asc")->get();
       $nationalities=Option::where("parent_id",55)->where("isdelete","0")->orderBy("title","asc")->get();
       // $courses=Course::where("isdelete","0")->orderBy("courseAR","desc")->get();
       $courses=Option::where('parent_id',276)->where('isdelete',0)->where('active',1)->orderBy('title','asc')->get();
       return view("cms.campaign.add",compact("title","parentTitle","linkApp","genders","levels","addresses","classifications","nationalities","courses"));
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
            'title' => 'required',
            'start' => 'required',
            'b_from' => 'required',
            'b_to' => 'required',
            'gender' => 'required',
            'level' => 'required',
            'address' => 'required',
            'classification' => 'required',
            'nationality' => 'required',
            'course' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);

    $campaign = new Campaign();
    $campaign->title =$request->input("title");
    $campaign->start =$request->input("start");
    $campaign->active =$request->input("active")?1:0;
    $campaign->notes =$request->input("notes");
    $campaign->created_by =$this->getId();
    if ($campaign->save()){
        $b_from = $request->input("b_from");
        if ($b_from!=null){
            $campaignF = new Campaign_filter();
            $campaignF->campaign_id = $campaign->id;
            $campaignF->type_id = 1;
            $campaignF->filter_id = $request->input("b_from");
            $campaignF->created_by = $this->getId();
            $campaignF->save();
        }

        $b_to = $request->input("b_to");
        if ($b_to!=null){
            $campaignF = new Campaign_filter();
            $campaignF->campaign_id = $campaign->id;
            $campaignF->type_id = 8;
            $campaignF->filter_id = $request->input("b_to");
            $campaignF->created_by = $this->getId();
            $campaignF->save();
        }

        $genders = $request->input("gender");
        if ($genders!=null){
            if (in_array("all", $genders)){
                $genders=Option::where("parent_id",62)->where("isdelete","0")->get();
                foreach($genders as $gender){
                $campaignF = new Campaign_filter();
                $campaignF->campaign_id = $campaign->id;
                $campaignF->type_id = 2;
                $campaignF->filter_id = $gender->id;
                $campaignF->created_by = $this->getId();
                $campaignF->save();
            }

            }else{
            foreach($genders as $gender){
                $campaignF = new Campaign_filter();
                $campaignF->campaign_id = $campaign->id;
                $campaignF->type_id = 2;
                $campaignF->filter_id = $gender;
                $campaignF->created_by = $this->getId();
                $campaignF->save();
            }
            }
        }

        $levels = $request->input("level");
        if ($levels!=null){
            if (in_array("all", $levels)){
                $levels=Option::where("parent_id",59)->where("isdelete","0")->get();
                foreach($levels as $level){
                $campaignF = new Campaign_filter();
                $campaignF->campaign_id = $campaign->id;
                $campaignF->type_id = 3;
                $campaignF->filter_id = $level->id;
                $campaignF->created_by = $this->getId();
                $campaignF->save();
            }
            }else{
            foreach($levels as $level){
                $campaignF = new Campaign_filter();
                $campaignF->campaign_id = $campaign->id;
                $campaignF->type_id = 3;
                $campaignF->filter_id = $level;
                $campaignF->created_by = $this->getId();
                $campaignF->save();
            }
            }
        }

        $addresses = $request->input("address");
        if ($addresses!=null){
            if (in_array("all", $addresses)){
                $addresses=Option::where("parent_id",56)->where("isdelete","0")->get();
                foreach($addresses as $address){
                $campaignF = new Campaign_filter();
                $campaignF->campaign_id = $campaign->id;
                $campaignF->type_id = 4;
                $campaignF->filter_id = $address->id;
                $campaignF->created_by = $this->getId();
                $campaignF->save();
                }
            }else{
            foreach($addresses as $address){
                $campaignF = new Campaign_filter();
                $campaignF->campaign_id = $campaign->id;
                $campaignF->type_id = 4;
                $campaignF->filter_id = $address;
                $campaignF->created_by = $this->getId();
                $campaignF->save();
            }
            }
        }

        $classifications = $request->input("classification");
        if ($classifications!=null){
            if(in_array('all',$classifications)){
                $classifications=Option::where("parent_id",12)->where("isdelete","0")->get();
                foreach($classifications as $classification){
                $campaignF = new Campaign_filter();
                $campaignF->campaign_id = $campaign->id;
                $campaignF->type_id = 5;
                $campaignF->filter_id = $classification->id;
                $campaignF->created_by = $this->getId();
                $campaignF->save();
            }
            }else{
            foreach($classifications as $classification){
                $campaignF = new Campaign_filter();
                $campaignF->campaign_id = $campaign->id;
                $campaignF->type_id = 5;
                $campaignF->filter_id = $classification;
                $campaignF->created_by = $this->getId();
                $campaignF->save();
            }
            }
        }

        $nationalities = $request->input("nationality");
        if ($nationalities!=null){
            if(in_array('all',$nationalities)){
                $nationalities=Option::where("parent_id",55)->where("isdelete","0")->get();
                foreach($nationalities as $nationality){
                $campaignF = new Campaign_filter();
                $campaignF->campaign_id = $campaign->id;
                $campaignF->type_id = 6;
                $campaignF->filter_id = $nationality->id;
                $campaignF->created_by = $this->getId();
                $campaignF->save();
            }
            }else{
            foreach($nationalities as $nationality){
                $campaignF = new Campaign_filter();
                $campaignF->campaign_id = $campaign->id;
                $campaignF->type_id = 6;
                $campaignF->filter_id = $nationality;
                $campaignF->created_by = $this->getId();
                $campaignF->save();
            }
            }
        }

        $courses = $request->input("course");
        if ($courses!=null){
            if(in_array('all',$courses)){
                $courses=Option::where('parent_id',276)->where('isdelete',0)->where('active',1)->get();
                foreach($courses as $course){
                $campaignF = new Campaign_filter();
                $campaignF->campaign_id = $campaign->id;
                $campaignF->type_id = 7;
                $campaignF->filter_id = $course->id;
                $campaignF->created_by = $this->getId();
                $campaignF->save();
            }
            }else{
            foreach($courses as $course){
                $campaignF = new Campaign_filter();
                $campaignF->campaign_id = $campaign->id;
                $campaignF->type_id = 7;
                $campaignF->filter_id = $course;
                $campaignF->created_by = $this->getId();
                $campaignF->save();
            }
            }
        }
    }

    $flasher->addSuccess("تمت عملية الاضافة بنجاح");
    return redirect("/CMS/Campaign/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {

        $parentTitle=" ادارة الحملات الهاتفية";
        $title="التسويق";
        $linkApp="/CMS/Campaign/";
        $item=Campaign::where("id",$id)->where("isdelete",0)->first();
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Campaign/");
        }

        $genders=Option::where("parent_id",62)->where("isdelete","0")->orderBy("title","desc")->get();
        $gender_veiws=Campaign_filter::where("campaign_id",$item->id)->where("isdelete",0)->where("type_id",2)->get();
        $levels=Option::where("parent_id",59)->where("isdelete","0")->orderBy("title","desc")->get();
        $level_veiws=Campaign_filter::where("campaign_id",$item->id)->where("isdelete",0)->where("type_id",3)->get();
        $addresses=Option::where("parent_id",56)->where("isdelete","0")->orderBy("title","desc")->get();
        $address_veiws=Campaign_filter::where("campaign_id",$item->id)->where("isdelete",0)->where("type_id",4)->get();
        $classifications=Option::where("parent_id",12)->where("isdelete","0")->orderBy("title","desc")->get();
        $classification_veiws=Campaign_filter::where("campaign_id",$item->id)->where("isdelete",0)->where("type_id",5)->get();
        $nationalities=Option::where("parent_id",55)->where("isdelete","0")->orderBy("title","desc")->get();
        $nationality_veiws=Campaign_filter::where("campaign_id",$item->id)->where("isdelete",0)->where("type_id",6)->get();
        $courses=Course::where("isdelete","0")->orderBy("courseAR","desc")->get();
        $course_veiws=Campaign_filter::where("campaign_id",$item->id)->where("isdelete",0)->where("type_id",7)->get();
        $b_from_view=Campaign_filter::where("campaign_id",$id)->where("isdelete",0)->where("type_id",1)->first();
        $b_to_view=Campaign_filter::where("campaign_id",$id)->where("isdelete",0)->where("type_id",8)->first();


        $returnHTML = view("cms.campaign.showModal",compact("title","item","id","parentTitle","linkApp",
            "genders","gender_veiws","levels","level_veiws","addresses","address_veiws","classifications","classification_veiws",
            "nationalities","nationality_veiws","courses","course_veiws","b_from_view","b_to_view"))->render();
            return response()->json(['html'=>$returnHTML]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل الحملة";
        $title="التسويق";
        $linkApp="/CMS/Campaign/";
        $item=Campaign::where("id",$id)->where("isdelete",0)->first();
        $genders=Option::where("parent_id",62)->where("isdelete","0")->orderBy("title","asc")->get();
        $gender_veiws=Campaign_filter::where("campaign_id",$item->id)->where("isdelete",0)->where("type_id",2)->get();
        $levels=Option::where("parent_id",59)->where("isdelete","0")->orderBy("title","asc")->get();
        $level_veiws=Campaign_filter::where("campaign_id",$item->id)->where("isdelete",0)->where("type_id",3)->get();
        $addresses=Option::where("parent_id",56)->where("isdelete","0")->orderBy("title","asc")->get();
        $address_veiws=Campaign_filter::where("campaign_id",$item->id)->where("isdelete",0)->where("type_id",4)->get();
        $classifications=Option::where("parent_id",12)->where("isdelete","0")->orderBy("title","asc")->get();
        $classification_veiws=Campaign_filter::where("campaign_id",$item->id)->where("isdelete",0)->where("type_id",5)->get();
        $nationalities=Option::where("parent_id",55)->where("isdelete","0")->orderBy("title","asc")->get();
        $nationality_veiws=Campaign_filter::where("campaign_id",$item->id)->where("isdelete",0)->where("type_id",6)->get();
        $courses=Option::where('parent_id',276)->where('isdelete',0)->where('active',1)->orderBy('title','asc')->get();
        $course_veiws=Campaign_filter::where("campaign_id",$item->id)->where("isdelete",0)->where("type_id",7)->get();
        $b_from_view=Campaign_filter::where("campaign_id",$id)->where("isdelete",0)->where("type_id",1)->first();
        $b_to_view=Campaign_filter::where("campaign_id",$id)->where("isdelete",0)->where("type_id",8)->first();
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Campaign/");
        }
        return view("cms.campaign.edit",compact("title","item","id","parentTitle","linkApp",
            "genders","gender_veiws","levels","level_veiws","addresses","address_veiws","classifications","classification_veiws",
            "nationalities","nationality_veiws","courses","course_veiws","b_from_view","b_to_view"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        $this->validate($request,
        [
            'title' => 'required',
            'start' => 'required',
            'b_from' => 'required',
            'b_to' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);

    $item=Campaign::find($id);
    $item->title =$request->input("title");
    $item->start =$request->input("start");
    $item->active =$request->input("active")?1:0;
    $item->notes =$request->input("notes");
    $item->created_by =$this->getId();

    if ($item->save()){
        $b_from = $request->input("b_from");
        if ($b_from!=null){
            Campaign_filter::where("campaign_id",$id)->where("type_id",1)->delete();
            $campaign = new Campaign_filter();
            $campaign->campaign_id = $id;
            $campaign->type_id = 1;
            $campaign->filter_id = $request->input("b_from");
            $campaign->created_by = $this->getId();
            $campaign->save();
        }

        $b_to = $request->input("b_to");
        if ($b_to!=null){
            Campaign_filter::where("campaign_id",$id)->where("type_id",8)->delete();
            $campaign = new Campaign_filter();
            $campaign->campaign_id = $id;
            $campaign->type_id = 8;
            $campaign->filter_id = $request->input("b_to");
            $campaign->created_by = $this->getId();
            $campaign->save();
        }

        $genders = $request->input("gender");
        if ($genders!=null){
            Campaign_filter::where("campaign_id",$id)->where("type_id",2)->delete();
            foreach($genders as $gender){
                $campaign = new Campaign_filter();
                $campaign->campaign_id = $id;
                $campaign->type_id = 2;
                $campaign->filter_id = $gender;
                $campaign->created_by = $this->getId();
                $campaign->save();
            }
        }

        $levels = $request->input("level");
        if ($levels!=null){
            Campaign_filter::where("campaign_id",$id)->where("type_id",3)->delete();
            foreach($levels as $level){
                $campaign = new Campaign_filter();
                $campaign->campaign_id = $id;
                $campaign->type_id = 3;
                $campaign->filter_id = $level;
                $campaign->created_by = $this->getId();
                $campaign->save();
            }
        }

        $addresses = $request->input("address");
        if ($addresses!=null){
            Campaign_filter::where("campaign_id",$id)->where("type_id",4)->delete();
            foreach($addresses as $address){
                $campaign = new Campaign_filter();
                $campaign->campaign_id = $id;
                $campaign->type_id = 4;
                $campaign->filter_id = $address;
                $campaign->created_by = $this->getId();
                $campaign->save();
            }
        }

        $classifications = $request->input("classification");
        if ($classifications!=null){
            Campaign_filter::where("campaign_id",$id)->where("type_id",5)->delete();
            foreach($classifications as $classification){
                $campaign = new Campaign_filter();
                $campaign->campaign_id = $id;
                $campaign->type_id = 5;
                $campaign->filter_id = $classification;
                $campaign->created_by = $this->getId();
                $campaign->save();
            }
        }

        $nationalities = $request->input("nationality");
        if ($nationalities!=null){
            Campaign_filter::where("campaign_id",$id)->where("type_id",6)->delete();
            foreach($nationalities as $nationality){
                $campaign = new Campaign_filter();
                $campaign->campaign_id = $id;
                $campaign->type_id = 6;
                $campaign->filter_id = $nationality;
                $campaign->created_by = $this->getId();
                $campaign->save();
            }
        }

        $courses = $request->input("course");
        if ($courses!=null){
            Campaign_filter::where("campaign_id",$id)->where("type_id",7)->delete();
            foreach($courses as $course){
                $campaign = new Campaign_filter();
                $campaign->campaign_id = $id;
                $campaign->type_id = 7;
                $campaign->filter_id = $course;
                $campaign->created_by = $this->getId();
                $campaign->save();
            }
        }
    }

    $flasher->addSuccess("تمت عملية الحفظ بنجاح");
    return redirect("/CMS/Campaign/");
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

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Campaign::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        if ($item->save()){
            Campaign_filter::where("campaign_id",$id)->delete();
        }
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Campaign/");
    }
}
