<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Option;
use App\Models\Student;
use App\Models\Campaign;
use App\Models\Rep_section;
use Illuminate\Http\Request;
use App\Models\Student_course;
use App\Models\Campaign_filter;
use App\Models\Campaign_student;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class CampaignStudentController extends CMSBaseController
{
    function getIndex($id){
        $subtitle="متابعة حملات التسويق الهاتفي";
        $title="التسويق";
        $linkApp="/CMS/Campaign/";
        $parentTitle="ادارة الحملات";

        $this->getAll($id);

        $camTitle=Campaign::find($id)->title;
        $res=Option::where('parent_id',246)->where('isdelete',0)->where('active',1)->get();
        $camLink="/CMS/Campaign/".$id;

        return view("cms.campaignStudent.index",compact("title","subtitle","camTitle","camLink","id","parentTitle","linkApp",'res'));
    }

    function getAll($id)
    {
        $student_courses=Student_course::where('isdelete',0)->get();
        $f_from=Campaign_filter::where('campaign_id',$id)->where('type_id',1)->first();

        $f_to=Campaign_filter::where('campaign_id',$id)->where('type_id',8)->first();

        $f_gender=Campaign_filter::where('campaign_id',$id)->where('type_id',2)->pluck('filter_id')->toArray();

        $f_level=Campaign_filter::where('campaign_id',$id)->where('type_id',3)->pluck('filter_id')->toArray();
        $f_address=Campaign_filter::where('campaign_id',$id)->where('type_id',4)->pluck('filter_id')->toArray();
        $f_classification=Campaign_filter::where('campaign_id',$id)->where('type_id',5)->pluck('filter_id')->toArray();
        $f_nationality=Campaign_filter::where('campaign_id',$id)->where('type_id',6)->pluck('filter_id')->toArray();
        $f_course=Campaign_filter::where('campaign_id',$id)->where('type_id',7)->pluck('filter_id')->toArray();
        $isExist=Campaign_student::where('campaign_id',$id)->count();


            $ustudents=array();
            if ($student_courses && $f_from && $f_to){
                foreach ($student_courses as $student_course){

                    $student=Student::where('id',$student_course->student_id)->first();


                        $oldst=Campaign_student::where('campaign_id',$id)->where('name',$student->id)->where('isdelete',0)->count();
                   if($oldst>0){
                       break;
                   }else{
                    $course=Course::where('id',$student_course->course_id)->first();
                    if ($f_from->filter_id<=$student->birthday && $f_to->filter_id>=$student->birthday){


                            if (in_array($student->gender,$f_gender)) {

                                    if (in_array($student->level,$f_level)) {

                                            if (in_array($student->address,$f_address)) {

                                            if (in_array( $student->classification,$f_classification)) {

                                        if (in_array($student->nationality,$f_nationality)) {

                                if (in_array($course->category_id,$f_course)) {
                                    if (in_array($student->id,$ustudents)){

                                            $campaignStudent = Campaign_student::where('name',$student->id)->first();

                                            $oldcourses= $campaignStudent->course_reg;                           $campaignStudent->course_reg = $oldcourses.",". $student_course->course_id;
                                                                                $campaignStudent->save();
                                        }else{
                                           array_push($ustudents,$student->id);                           $campaignStudent = new Campaign_student();
                                                                        $campaignStudent->campaign_id = $id;
                                                                        $campaignStudent->name = $student->id;
                                                                        $campaignStudent->birthday = $student->birthday;
                                                                        $campaignStudent->address = $student->address;
                                                                        $campaignStudent->course_reg = $student_course->course_id;
                                                                        $campaignStudent->type = $student->classification;
                                                                        $campaignStudent->phone = $student->phone1;
                                                                        $campaignStudent->save();
                                        }
                                                                    }

                                                            }

                                                    }

                                            }

                                    }

                            }

                    }
                }
                }
            }
            return redirect("/CMS/CampaignStudent/".$id);

    }

    function getEdit($id,FlasherInterface $flasher)
    {
        $title="تعديل المتابعة ";
        $item=Campaign_student::find($id);
        $res=Option::where('parent_id',246)->where('isdelete',0)->where('active',1)->get();
        $parentTitle="ادارة الحملات";
        $linkApp="/CMS/Campaign/";
        $parentPTitle="ادارة المتابعة";
        $parentLink="/CMS/CampaignStudent/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/CampaignStudent/");
        }
        return view("cms.campaignStudent.edit",compact("title","item","res","id","parentTitle","parentLink","linkApp","parentPTitle"));
    }

    public function postEdit(Request $request, $id ,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'response' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Campaign_student::find($id);
        $item->response=$request->input("response");
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        if($item->save()) {
            $student=Student::where('id',$item->name)->first();
            $student->notes=$request->input("notes");
            $student->save();
        }

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/CampaignStudent/".$item->campaign_id);
    }

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Campaign_student::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->deleted_at=date("Y-m-d h:i:s");
        $item->save();
        Session::flash("msg","تمت عملية الحذف بنجاح");
        return redirect()->back();
    }

    public function getRead($id,FlasherInterface $flasher)
    {

        $item=Campaign_student::find($id);

        $item->resolution=1;
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect()->back();
    }
}
