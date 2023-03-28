<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Option;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Receipt_salary;
use App\Models\Receipt_advance;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class EmployeeController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="سجل البيانات العامه";
        $subtitle="اداره الموظفين";
        $items=Employee::where('isdelete',0)->paginate(10);
        $jobs = Option::where('parent_id',2)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $addresses = Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $nationalitys = Option::where('parent_id',55)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $statuses = Option::where('parent_id',24)->where('isdelete',0)->where('active',1)->get();
        $levels=Option::where('parent_id',59)->where('isdelete',0)->where('active',1)->get();
        $salary_down = Employee::select('salary_down')->get();
        return view("cms.employee.index",compact("title","subtitle","nationalitys","statuses","levels","salary_down","items","jobs","addresses"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة موظف جديد";
        $title="ادارة الموظفين";

        $jobs = Option::where('parent_id',2)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $nationalities = Option::where('parent_id',55)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $statuses = Option::where('parent_id',24)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $addresses = Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $skills = Option::where('parent_id',50)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $levels=Option::where('parent_id',59)->where('isdelete',0)->where('active',1)->orderBy('title')->get();

        return view("cms.employee.add",compact("title","parentTitle","jobs","nationalities","skills","statuses","addresses","levels"));
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
                'name' => 'required|unique:employees',
                'job_title' => 'required',
                'birthday' => 'required',
                'nationality' => 'required',
                'status' => 'required',
                'address' => 'required',
                'phone1' => 'required',
                'skills' => 'required',
                'level' => 'required',
            ],
            [
            "required"=>"يجب ادخال هذا الحقل",
           "unique"=>"هذه البيانات مسجلة من قبل"

            ]);

        $name=$request->input("name");

        $isExists=Employee::whereRaw("name='$name'")->count();
        if($isExists>0)
        {
            flash()->addWarning("الاسم موجود مسبقا");
            flash()->addError("alert danger");
            return redirect("/CMS/Employee/create")->withInput();
        }

        $employee = Employee::create([
            'name' => $request->input("name"),
            'job_title' => $request->input("job_title"),
            'birthday' => $request->input("birthday"),
            'nationality' => $request->input("nationality"),
            'status' => $request->input("status"),
            'address' => $request->input("address"),
            'phone1' => $request->input("phone1"),
            'phone2' => $request->input("phone2"),
            'email' => $request->input("email"),
            'level'=> $request->input("level"),
            'salary_down' => $request->input("salary_down"),
            'smoke' => $request->input("smoke")?1:0,
            'active' => $request->input("active")?1:0,
            'notes' => $request->input("notes"),
            'created_by' => $this->getId()
        ]);

        $skills = $request->input('skills');
        foreach($skills as $skill){
            $ss = new Skill();
            $ss->name = $skill;
            $ss->employee_id = $employee->id;
            $ss->created_by = $this->getId();
            $ss->save();
        }

        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/Employee");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="عرض الموظف ";
        $item=Employee::where("id",$id)->where("isdelete",0)->first();
        $emp_skill = Skill::where('employee_id',$id)->where('isdelete',0)->orderBy('name')->get();
        $title="ادارة الموظفين";


        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Employee/");
        }
        return view("cms.employee.show",compact("title","item","id","parentTitle","emp_skill"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {

        $parentTitle="تعديل الموظفين ";
        $item=Employee::where("id",$id)->where("isdelete",0)->first();
        $jobs = Option::where('parent_id',2)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $nationalities = Option::where('parent_id',55)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $statuses = Option::where('parent_id',24)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $addresses = Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $skills = Option::where('parent_id',50)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $emp_skill = Skill::where('employee_id',$id)->where('isdelete',0)->orderBy('name')->get();
        $title="ادارة الموظفين";

        $levels=Option::where('parent_id',59)->where('isdelete',0)->where('active',1)->get();

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Employee/");
        }
        return view("cms.employee.edit",compact("title","item","id","parentTitle","skills","emp_skill","jobs","nationalities","statuses","addresses","levels"));
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
                'name' => 'required',
                'job_title' => 'required',
                'birthday' => 'required',
                'nationality' => 'required',
                'status' => 'required',
                'address' => 'required',
                'phone1' => 'required',
                //'skills' => 'required'
                'level' => 'required',
            ],
            [
                "required"=>"يجب ادخال هذا الحقل",
                "email.email"=>"يجب ادخال بريد الكتروني صحيح",
            ]);

        $item=Employee::find($id);
        $name=$request->input("name");
        if ($item->name != $name){
            $isExists=Employee::whereRaw("name='$name'")->count();
            if($isExists>0)
            {
                flash()->addWarning("الاسم موجود مسبقا");
                flash()->addError("alert-danger");
                return redirect("/CMS/Employee/create")->withInput();
            }
        }

        $item->name=$request->input("name");
        $item->address=$request->input("address");
        $item->job_title=$request->input("job_title");
        $item->birthday=$request->input("birthday");
        $item->nationality=$request->input("nationality");
        $item->phone1=$request->input("phone1");
        $item->phone2=$request->input("phone2");
        $item->email=$request->input("email");
        $item->level=$request->input("level");
        $item->salary_down=$request->input("salary_down");
        $item->smoke=$request->input("smoke")?1:0;
        $item->active=$request->input("active")?1:0;
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        $item->save();

        if($request->input("skills")){

        $ss = Skill::where('employee_id',$item->id)->get();
        foreach($ss as $s){
            $s->isdelete = 1;
            $s->deleted_by = $this->getId();
            $s->save();
        }

        $skills = $request->input('skills');
        foreach($skills as $skill){
            $ss = new Skill();
            $ss->name = $skill;
            $ss->employee_id = $item->id;
            $ss->created_by = $this->getId();
            $ss->save();
        }
        }

       // $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/Employee/");
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
        $item=Employee::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Employee/");
    }


    public function getEmployeeSalary()
    {
        $parentTitle="كشف حساب راتب";
        $title="شوؤن الموظفين";
        $linkApp="/CMS/Employee/";

        $employees=Employee::where('isdelete',0)->where('active',1)->get();
        $levels=Option::where('parent_id',59)->where('isdelete',0)->where('active',1)->get();

        return view("cms.employee.salary",compact("title","parentTitle","linkApp","employees","levels"));
    }

    function getEmpSalary($id){
        $employee= Employee::find($id);
        $year=$this->getMoneyYear();

        $advance=0;
        $isReceipt_advance=Receipt_advance::where('employee_id',$employee->id)->where('m_year',$year)->where('isdelete',0)->count();
        if ($isReceipt_advance>0){
            $receipt_advances=Receipt_advance::where('employee_id',$employee->id)->where('m_year',$year)->where('isdelete',0)->get();
            foreach ($receipt_advances as $receipt_advance){
                $advance += $receipt_advance->advance_payment;
            }
        }

        $recs=0;
        $isReceipt_salary=Receipt_salary::where('employee_id',$employee->id)->where('isdelete',0)->where('m_year',$year)->count();
        if ($isReceipt_salary>0){
            $receipt_salarys=Receipt_salary::where('employee_id',$employee->id)->where('m_year',$year)->where('isdelete',0)->get();
            foreach ($receipt_salarys as $receipt_salary){
                $recs += $receipt_salary->advance_payment;
            }
        }

        return response()->json([
            'status' => '1',
            'name' => $employee->name,
            'adv' => $advance,
            'recs' => $recs,
            'rem' => $advance - $recs,
        ]);
    }

}
