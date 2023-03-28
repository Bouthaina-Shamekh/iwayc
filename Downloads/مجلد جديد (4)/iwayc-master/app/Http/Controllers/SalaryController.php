<?php

namespace App\Http\Controllers;


use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;

class SalaryController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="ادارة الرواتب";
        $title="شوؤن الموظفين";

        $employees=Employee::where("isdelete",0)->where("active",1)->orderBy("id","desc")->get();
        return view("cms.salary.index",compact("title","subtitle","employees"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة راتب جديد";
        $title="شوؤن الموظفين";
        $employees=Employee::where('isdelete',0)->where('active',1)->get();
        return view("cms.salary.add",compact("title","parentTitle","employees"));
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
            'employee_id' => 'required',
            'month' => 'required',
            'salary' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);

    $msg1 = "تم حفظ";
    $msg2 = "لم يتم حفظ";
    $monthes = $request->input('month');
    $year = $this->getMoneyYear();
    $employee_id = $request->input("employee_id");
    $salaries = $request->input('salary');
    $salary_warranty = $request->input('salary_warranty');
    $warranty_secretariats = $request->input('warranty_secretariats');
    $warranty_contributions = $request->input('warranty_contributions');
    foreach($monthes as $month){
        $isExists=Salary::where("employee_id",$employee_id)->where("month",$month)->where("year",$year)->count();
        if($isExists>0)
        {
            $salary_month_id=Salary::where("employee_id",$employee_id)->where("month",$month)->where("year",$year)->first();
            $msg2 .= ' ' . $salary_month_id->month . '-' . $salary_month_id->year . ', ';
        }else{
            $salary = new Salary();
            $salary->month = $month;
            $salary->employee_id = $employee_id;
            $salary->year = $year;
            $salary->salary = $salaries;
            $salary->salary_remaind = $salaries - ($salary_warranty+$warranty_secretariats+$warranty_contributions);
            $salary->remaind = $salaries - ($salary_warranty+$warranty_secretariats+$warranty_contributions);
            $salary->salary_warranty = $salary_warranty;
            $salary->warranty_secretariats = $warranty_secretariats;
            $salary->warranty_contributions = $warranty_contributions;
            $salary->created_by = $this->getId();
            $salary->save();

            $msg1 .= ' ' . $salary->month . '-' . $salary->year . ', ';
        }
    }
    if ($msg2 == "لم يتم حفظ"){
        $msg2 = "";
    }
    if ($msg1 == "تم حفظ"){
        $msg1 = "";
    }
    $flasher->addSuccess($msg1 . $msg2);
   // Session::flash("msg",$msg1 . $msg2);
    return redirect("/CMS/Salary/");
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {

        $parentTitle="عرض الرواتب ";
        $item=Salary::where("id",$id)->where("isdelete",0)->first();
        $title="شوؤن الموظفين";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Salary/");
        }
        return view("cms.salary.show",compact("title","item","id","parentTitle"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل الرواتب ";
        $item=Salary::where("id",$id)->where("isdelete",0)->first();
        $employees=Employee::where('isdelete',0)->where('active',1)->get();
        $title="شوؤن الموظفين";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Salary/");
        }
        return view("cms.salary.edit",compact("title","item","id","employees","parentTitle"));
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
                'employee_id' => 'required',
                'month' => 'required',
                'salary' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Salary::find($id);
        $item->employee_id=$request->input("employee_id");
        $item->month=$request->input("month");
        $item->salary=$request->input("salary");
        $item->salary_warranty=$request->input("salary_warranty");
        $item->warranty_secretariats=$request->input("warranty_secretariats");
        $item->warranty_contributions=$request->input("warranty_contributions");
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/Salary/");
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
        $item=Salary::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Salary/");
    }
}
