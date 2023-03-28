<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Absence;
use App\Models\Employee;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use App\DataTables\AbsenceDataTable;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;
use App\Http\Controllers\ActiveMethodController;
use Illuminate\Support\Facades\Response;


class AbsenceController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AbsenceDataTable $dataTable)
    {
        $title="ادارة الغياب والمغادرة";
        $subtitle="حضور الموظفيين";
        $items=Absence::where('isdelete',0)->paginate(10);
        $employees=Employee::where('isdelete',0)->where('active',1)->orderBy('name')->get();
        $types=Option::where('parent_id',123)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $leavings=Option::where('parent_id',63)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $regions=Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        return $dataTable->render("cms.absence.index",compact("title","subtitle","items","employees","types","leavings","regions"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title="ادارة الغياب والمغادرة";
        $parentTitle="حضور الموظفيين";
        $employees=Employee::where('isdelete',0)->where('active',1)->orderBy('name')->get();
        $types=Option::where('parent_id',123)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $leavings=Option::where('parent_id',63)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $regions=Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        return view("cms.absence.add",compact("title","parentTitle","employees","types","leavings","regions"));
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
            'type' => 'required',
            'employee_id' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);
    $absence = Absence::create([
        'm_year' => $request->input("edu_year_h"),
        'type' => $request->input("type"),
        'center_car' => $request->input("center_car"),
        'region' => $request->input("region"),
        'leaving' => $request->input("leaving"),
        'notes' => $request->input("notes"),
        'hours' => $request->input("hours"),
        'minutes' => $request->input("minutes"),
        'employee_id' => $request->input("employee_id"),
        'created_by' => $this->getId()
    ]);

    $flasher->addSuccess("تمت عملية الاضافة بنجاح");

    return redirect("/CMS/Absence/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function getAbsenceDuration($id) {
//         $absence = Absence::findOrFail($id);
//         $hourIn = strtotime($absence->hour_in);
//         $hourOut = strtotime($absence->hour_out);
//         $durationInSeconds = $hourOut - $hourIn;
//         $duration = gmdate('h:i:s', $durationInSeconds);
//         return Response::json(['duration' => $duration]);
//     }

    public function show($id,FlasherInterface $flasher)
    {

        $title="ادارة الغياب والمغادرة";
        $parentTitle="حضور الموظفيين";
        $item=Absence::where("id",$id)->where("isdelete",0)->first();
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Absence/");
        }

        $absence = Absence::where('id', $id)->first(['hour_in', 'hour_out']);
        $hour_in = strtotime($absence->hour_in);
        $hour_out = strtotime($absence->hour_out);
        $diff = $hour_out - $hour_in;
        $duration = gmdate('h:i:s', $diff);
        // return Response::json(['hour_in' => $absence->hour_in, 'hour_out' => $absence->hour_out, 'duration' => $duration]);
        // dd($duration);

      /*   dd($item); */

        return view("cms.absence.show",compact("title","item","id","parentTitle",'duration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="غياب الموظفيين";
        $title="ادارة الغياب والمغادرة";

        $item=Absence::where("id",$id)->where("isdelete",0)->first();
        $employees=Employee::where('isdelete',0)->where('active',1)->orderBy('name')->get();
        $types=Option::where('parent_id',123)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $leavings=Option::where('parent_id',63)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $regions=Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->orderBy('title')->get();

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Absence/");
        }
        return view("cms.absence.edit",compact("title","item","id","employees","types","leavings","regions","parentTitle"));
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
            'type' => 'required',
            'employee_id' => 'required'
        ],
        [
            "required"=>"يجب ادخال هذا الحقل"
        ]);

    $item=Absence::find($id);
    $item->type=$request->input("type");
    $item->center_car=$request->input("center_car")?1:0;
    $item->region=$request->input("region");
    $item->leaving=$request->input("leaving");
    $item->notes=$request->input("notes");
    $item->employee_id=$request->input("employee_id");
    $item->hours=$request->input("hours");
    $item->minutes=$request->input("minutes");
    $item->hour_in=$request->input("hour_in");
    $item->hour_out=$request->input("hour_out");
    $item->absence_date=$request->input("absence_date");
    $item->updated_by=$this->getId();
    $item->save();

    $flasher->addSuccess("تمت عملية الحفظ بنجاح");
    return redirect("/CMS/Absence/");
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
        $item=Absence::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();

        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Absence/");
    }
}
