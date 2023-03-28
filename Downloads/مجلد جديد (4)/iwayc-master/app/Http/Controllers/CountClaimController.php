<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Option;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User_year;
use App\Models\Money_year;
use App\Models\Count_claim;
use Illuminate\Http\Request;
use App\Models\Student_course;
use App\Models\Collection_fees;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class CountClaimController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="رصد المطالبات";
        $title="التحصل والشؤون القانونيه";

        $students=Count_claim::leftJoin('student_course as sc', 'sc.id','=','count_claim.student_course_id')
            ->leftJoin('students', 'students.id','=','sc.student_id')
            ->select(['students.id','students.nameAR'])
            ->where('students.active',1)
            ->where('count_claim.isdelete',0)
            ->where('sc.m_year',$this->getMoneyYear())
            ->distinct('students.id')
            ->orderBy('students.nameAR')
            ->get();


        $users=User::where("isdelete",0)->where("Status","مفعل")->orderBy('name')->get();
        $courses=Course::where("isdelete",0)->where("active",1)->where('m_year',$this->getMoneyYear())->orderBy('courseAR')->get();

        return view("cms.countClaim.index",compact("title","subtitle","students","users","courses"));
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
        $parentTitle="اضافة مطالبة جديدة";
        $title="التحصل والشؤون القانونيه";
        $type = Option::where('parent_id',258)->where('active',1)->get();
        $item = Collection_fees::find($id);

        return view("cms.countClaim.add",compact("title","parentTitle","item","type"));
    }

    public function getYearFilter()
    {
        $teachers=Teacher::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('active',1)->orderBy('name')->get();
        return Response::json( $teachers );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function postAdd(Request $request,$id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'student_course_id_h' => 'required',
                'collection_fees_id_h' => 'required',
                'type' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $count_claim = Count_claim::create([
            'student_course_id' => $request->input("student_course_id_h"),
            'collection_fees_id' => $request->input("collection_fees_id_h"),
            'how_claim' => $request->input("type"),
            'notes' => $request->input("notes"),
            'created_by' => $this->getId()
        ]);
        if ($count_claim){
            $collection_fees = Collection_fees::find($id);
            $collection_fees->count += 1;
            $collection_fees->save();
        }

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/CollectionFees/");
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
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="عرض المطالبة";
        $item=Count_claim::where("id",$id)->where("isdelete",0)->first();
        $title="التحصل والشؤون القانونيه";
        $linkApp="/CMS/CountClaim/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/CountClaim/");
        }
        return view("cms.countClaim.show",compact("title","item","id","parentTitle","linkApp"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل مطالبة";
        $title="التحصل والشؤون القانونيه";
        $item=Count_claim::where("id",$id)->where("isdelete",0)->first();
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/CountClaim/");
        }
        $type = Option::where('parent_id',258)->where('active',1)->get();
        return view("cms.countClaim.edit",compact("title","item","id","parentTitle","type"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'type' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Count_claim::find($id);
        $item->how_claim=$request->input("type");
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/CountClaim/");
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

    }
}
