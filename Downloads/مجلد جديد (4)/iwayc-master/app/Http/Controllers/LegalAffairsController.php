<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Course;
use App\Models\Option;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User_year;
use App\Models\Money_year;
use App\Models\Count_claim;
use Illuminate\Http\Request;
use App\Models\Legal_affairs;
use App\Models\Student_course;
use Illuminate\Support\Carbon;
use App\Models\Collection_fees;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class LegalAffairsController extends CMSBaseController
{
    public function index()
    {
        $subtitle="الشؤون القانونية";
        $title="التحصل والشؤون القانونيه";

        $students=Student::where("isdelete",0)->orderBy('nameAR')->get();
        $student_courses=Student_course::get();
        $ss = [];
        foreach ($students as $student){
            foreach ($student_courses as $student_course) {
                if ($student->id == $student_course->student_id) {
                    array_push($ss, $student->id);
                }
            }
        }
        $s = array_unique($ss);
        $users=User::where("isdelete",0)->where("Status","مفعل")->orderBy('name')->get();
        $status=Option::where("parent_id",265)->where("isdelete",0)->where("active",1)->orderBy('title')->get();

        return view("cms.legalAffairs.index",compact("title","subtitle","s","users","status"));
    }

    public function getEnd()
    {
        $subtitle="السجلات المنتهية";
        $title="التحصل والشؤون القانونيه";
        return view("cms.legalAffairs.end",compact("title","subtitle"));
    }

    public function create()
    {

    }
    public function getAdd($id,FlasherInterface $flasher)
    {
        $subtitle="الشؤون القانونية";
        $title="التحصل والشؤون القانونيه";

        $type = Option::where('parent_id',265)->where('active',1)->get();
        $item = Collection_fees::find($id);

        $isCount_claim = Count_claim::where('collection_fees_id',$item->id)->count();
        if ($isCount_claim==0){

            flash()->addWarning("يرجي التأكد من الرابط المطلوب");
            flash()->addError("alert-danger");
            return redirect("/CMS/CollectionFees");
        }
        $count_claim = Count_claim::where('collection_fees_id',$item->id)->first();

        $start = Carbon::now();
        $end =  Carbon::parse($count_claim->created_at);
        $days = $end->diffInDays($start);

        return view("cms.legalAffairs.add",compact("title","subtitle","item","type","count_claim","days"));
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
        //dd($request->all());
        $this->validate($request,
            [
                'student_course_id_h' => 'required',
                'm_year_h' => 'required',
                'phone_h' => 'required',
                'fees_h' => 'required',
                'fees_owed_h' => 'required',
                'first_claim_h' => 'required',
                'count_day_h' => 'required',
                'fine_day' => 'required',
                'fine_delay_h' => 'required',
                'total_amount_h' => 'required',
                'type' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $collection_fees= Collection_fees::find($id);
        $legal_affairs = new Legal_affairs();
            $legal_affairs->m_year = $request->input("m_year_h");
            $legal_affairs->student_course_id= $request->input("student_course_id_h");
            $legal_affairs->phone = $request->input("phone_h");
            $legal_affairs->fees = $request->input("fees_h");
            $legal_affairs->fees_owed = $request->input("fees_owed_h");
            $legal_affairs->first_claim = $request->input("first_claim_h");
            $legal_affairs->count_day = $request->input("count_day_h");
            $legal_affairs->fine_day = $request->input("fine_day");
            $legal_affairs->fine_delay = $request->input("fine_delay_h");
            $legal_affairs->total_amount = $request->input("total_amount_h");
            $legal_affairs->warranty = 0;
            $legal_affairs->count = $collection_fees->count;
            $legal_affairs->count_warning = 0;
            $legal_affairs->status = $request->input("type");
            $legal_affairs->collect_notes = $request->input("notes");
            $legal_affairs->created_by = $this->getId();
        $legal_affairs->save();
        if ($legal_affairs){
            $collection_fees->isdelete = 1;
            $collection_fees->save();
        }

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/LegalAffairs/");
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
        $subtitle="الشؤون القانونية";
        $item=Legal_affairs::where("id",$id)->where("isdelete",0)->first();
        $title="التحصل والشؤون القانونيه";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/LegalAffairs/");
        }
        $returnHTML =  view("cms.legalAffairs.show",compact("title","item","id","subtitle"))->render();
        return response()->json(['html'=>$returnHTML]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $subtitle="الشؤون القانونية";
        $item=Legal_affairs::where("id",$id)->where("isdelete",0)->first();
        $title="التحصل والشؤون القانونيه";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/LegalAffairs/");
        }
        $type = Option::where('parent_id',265)->where('active',1)->get();
        return view("cms.legalAffairs.edit",compact("title","item","id","subtitle","type"));
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
                'fine_day' => 'required',
                'status' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Legal_affairs::find($id);
        $item->fine_day=$request->input("fine_day");
        $item->fine_delay=$request->input("fine_delay_h");
        $item->total_amount=$request->input("total_amount_h");
        $item->status=$request->input("status");
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/LegalAffairs/");
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

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Legal_affairs::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->deleted_at=date('Y-m-d h:i:s');
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/LegalAffairs/");
    }

    public function collectMoney($id,FlasherInterface $flasher){

    $item=Legal_affairs::find($id);
        $returnHTML =  view("cms.legalAffairs.collect",compact("item"))->render();
        return response()->json(['html'=>$returnHTML]);
    }
    public function postCollectMoney(Request $request,$id)
    {
        $this->validate($request,
            [
                'collect_amount' => 'required|numeric|min:1'
            ],
            [
                "ratio.min"=>"الرقم اقل من 1",
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Legal_affairs::find($id);
        $item->collect_amount=$item->collect_amount+$request->input("collect_amount");
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/LegalAffairs/");
    }
}
