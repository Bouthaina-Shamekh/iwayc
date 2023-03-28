<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Box_year;
use App\Models\Year_view;
use App\Models\Money_year;
use App\Models\Repository;
use App\Models\Student_year;
use App\Models\Teacher_year;
use Illuminate\Http\Request;
use App\Models\Repository_year;
use Illuminate\Support\Facades\Session;

class MoneyYearController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="السنوات المالية";
        $title="الاعدادات";
        $items=Money_year::where('isdelete',0)->paginate(10);
        return view("cms.money.index",compact("title","subtitle","items"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة سنة مالية جديدة";
        $title="الاعدادات";
        $linkApp="/CMS/Money/";
        $users = User::where('isdelete',0)->where('Status','مفعل')->orderBy('name')->get();

        return view("cms.money.add",compact("title","parentTitle","linkApp","users"));
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
                'year' => 'required|unique:money_years,year',
                'money_goal' => 'required',
                'first_time_balance' => 'required',
            ],
            [
                "required"=>"يجب ادخال هذا الحقل",
                "year.unique"=>"هذه السنه موجوده من قبل"
            ]);

        $year=$request->input("year");
        $isExist = Money_year::where('year',$year)->where('isdelete','=','0')->count();
        if ($isExist>0){
            Session::flash("msg","السنة المالية مضافة مسبقا");
            Session::flash("msgClass","alert-danger");
            return redirect("/CMS/Money/create")->withInput();
        }

        $money = Money_year::create([
            'year' => $request->input("year"),
            'start_year' => $request->input("year").'-01-01',
            'end_year' => $request->input("year").'-12-31',
            'money_goal' => $request->input("money_goal"),
            'first_time_balance' => $request->input("first_time_balance"),
            'active' => $request->input("active")?1:0,
            'basic_work' => 0,
            'created_by' => $this->getId()
        ]);

        if ($money){
            $boxes=Box::get();
            foreach ($boxes as $box){
                $box_year = Box_year::create([
                    'box_id' => $box->id,
                    'm_year' => $year,
                    'income' => 0,
                    'expense' => 0,
                    'calculator_first' => 0,
                    'created_by' => $this->getId()
                ]);
             
               
            }
            $year_views = $request->input("user_show");
            if ($year_views!=null){
                foreach($year_views as $year_view){
                    $yv = new Year_view();
                    $yv->year_id = $money->id;
                    $yv->user_id = $year_view;
                    $yv->created_by = $this->getId();
                    $yv->save();
                }
            }
            $repositories=Repository::get();
            foreach ($repositories as $repository){
                $repository_year = Repository_year::create([
                    'repository_id' => $repository->id,
                    'm_year' => $year,
                    'repository_in' => 0,
                    'repository_out' => 0,
                    'created_by' => $this->getId()
                ]);
            }
            $students=Student::get();
            foreach ($students as $student){
                $student_year = Student_year::create([
                    'student_id' => $student->id,
                    'active' => 0,
                    'm_year' => $year,
                    'created_by' => $this->getId()
                ]);
            }
            $teachers=Teacher::get();
            foreach ($teachers as $teacher){
                $teacher_year = Teacher_year::create([
                    'teacher_id' => $teacher->id,
                    'm_year' => $year,
                    'active' => 0,
                    'created_by' => $this->getId()
                ]);
            }
        }

        Session::flash("msg","تمت عملية الاضافة بنجاح");
        return redirect("/CMS/Money/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Money_year  $money_year
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parentTitle="عرض السنوات المالية ";
        $item=Money_year::where("id",$id)->where("isdelete",0)->first();
        $title="السنوات المالية";
        $linkApp="/CMS/Money/";
        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Money/");
        }
        return view("cms.money.show",compact("title","item","id","parentTitle","linkApp"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Money_year  $money_year
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parentTitle="تعديل السنوات المالية ";
        $item=Money_year::where("id",$id)->where("isdelete",0)->first();
        $year_views = Year_view::where('year_id',$id)->get();
        $users = User::where('isdelete',0)->where('Status','مفعل')->orderBy('name')->get();
        $title="السنوات المالية";
        $linkApp="/CMS/Money/";
        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Money/");
        }
        return view("cms.money.edit",compact("title","item","year_views","users","id","parentTitle","linkApp"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Money_year  $money_year
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'year' => 'required',
                'money_goal' => 'required',
                'first_time_balance' => 'required',
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $year=$request->input("year");
        $isExist = Money_year::where('year',$year)->where('isdelete','=','0')->count();
        if ($isExist>0){
         
            $y=Money_year::find($id)->year;
          
            $year_views = $request->input("user_show");
            Year_view::where("year_id",$id)->delete();
            if ($year_views!=null){
                foreach($year_views as $year_view){
                    $mv = new Year_view();
                    $mv->year_id = $id;
                    $mv->user_id = $year_view;
                    $mv->created_by = $this->getId();
                    $mv->save();
                }
            }
            if ($year==$y){
                $item=Money_year::find($id);
                $item->money_goal=$request->input("money_goal");
                $item->first_time_balance=$request->input("first_time_balance");
                $item->active=$request->input("active")?1:0;
                $item->updated_by=$this->getId();
                $item->save();
            }else{
                Session::flash("msg","السنة المالية مضافة مسبقا");
                Session::flash("msgClass","alert-danger");
                return redirect("/CMS/Money/create")->withInput();
            }
        }else{
            $item=Money_year::find($id);
            $yy=$item->year;
            $item->year=$request->input("year");
            $item->start_year=$request->input("start_year").'-01-01';
            $item->end_year=$request->input("end_year").'-12-31';
            $item->money_goal=$request->input("money_goal");
            $item->first_time_balance=$request->input("first_time_balance");
            $item->active=$request->input("active")?1:0;
            $item->updated_by=$this->getId();
            if ($item->save()){
                $boxes=Box_year::where('m_year',$yy)->get();
                foreach ($boxes as $box){
                    $box_year = Box_year::find($box->id);
                    $box_year->m_year = $year;
                    $box_year->save();
                }
                $repositories=Repository_year::where('m_year',$yy)->get();
                foreach ($repositories as $repository){
                    $repository_year = Repository_year::find($repository->id);
                    $repository_year->m_year = $year;
                    $repository_year->save();
                }
                $students=Student_year::where('m_year',$yy)->get();
                foreach ($students as $student){
                    $student_year = Student_year::find($student->id);
                    $student_year->m_year = $year;
                    $student_year->save();
                }
                $teachers=Teacher_year::where('m_year',$yy)->get();
                foreach ($teachers as $teacher){
                    $teacher_year = Teacher_year::find($teacher->id);
                    $teacher_year->m_year = $year;
                    $teacher_year->save();
                }
            }
        }


        Session::flash("msg","تمت عملية الحفظ بنجاح");
        return redirect("/CMS/Money/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Money_year  $money_year
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelete($id)
    {
        $item=Money_year::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        if ($item->save()){
            Box_year::where('m_year',$item->m_year)->delete();
            Repository_year::where('m_year',$item->m_year)->delete();
        }
        Session::flash("msg","تمت عملية الحذف بنجاح");
        return redirect("/CMS/Money/");
    }
}
