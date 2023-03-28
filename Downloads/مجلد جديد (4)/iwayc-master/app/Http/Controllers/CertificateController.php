<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Student;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\Catch_receipt;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class CertificateController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="ادارة الشهادات";
        $title="سجل البيانات العامه";

        $items=Certificate::where('isdelete',0)->paginate(10);
        $years=Option::where('parent_id',369)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $students=Student::leftJoin('certificates', 'students.id','=','certificates.student_id')->where('certificates.isdelete',0)->where('certificates.type','=','84')
            ->where('certificates.isdelete','=','0')->orderBy('students.nameAR')->select(['students.nameAR','students.id'])->get();
            $shstudents=Student::leftJoin('certificates', 'students.id','=','certificates.student_id')->where('certificates.isdelete',0)->where('certificates.type','=','85')
            ->where('certificates.isdelete','=','0')->orderBy('students.nameAR')->select(['students.nameAR','students.id'])->get();
            $ostudents=Student::leftJoin('certificates', 'students.id','=','certificates.student_id')->where('certificates.isdelete',0)->where('certificates.type','=','88')
            ->where('certificates.isdelete','=','0')->orderBy('students.nameAR')->select(['students.nameAR','students.id'])->get();
            $astudents=Student::leftJoin('certificates', 'students.id','=','certificates.student_id')->where('certificates.isdelete',0)->where('certificates.type','=','87')
            ->where('certificates.isdelete','=','0')->orderBy('students.nameAR')->select(['students.nameAR','students.id'])->get();
            $istudents=Student::leftJoin('certificates', 'students.id','=','certificates.student_id')->where('certificates.isdelete',0)->where('certificates.type','=','86')
            ->where('certificates.isdelete','=','0')->orderBy('students.nameAR')->select(['students.nameAR','students.id'])->get();
        $courses=Option::where('parent_id',53)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $shcourses=Option::where('parent_id',360)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $icourses=Option::where('parent_id',361)->where('isdelete',0)->where('active',1)->orderBy('title')->get();

        $ocourses=Option::where('parent_id',362)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        return view("cms.certificate.index2",compact("title","subtitle","items","years","students","shstudents","ostudents","astudents","istudents","courses","shcourses","icourses","ocourses"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $title="اضافة شهادة جديدة";
        $parentTitle="سجل البيانات العامه";

        $types=Option::where('parent_id',58)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $nationalities=Option::where('parent_id',55)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $appreciations=Option::where('parent_id',57)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $students=Student::where('isdelete',0)->where('active',1)->orderBy('nameAR')->get();
        $courses=Option::where('parent_id',53)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $catches=Catch_receipt::where('isdelete',0)->get();
        $years=Option::where('parent_id',369)->where('isdelete',0)->where('active',1)->orderBy('title')->get();

        return view("cms.certificate.add",compact("title","parentTitle","catches","types","nationalities","appreciations","students","courses","years"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,FlasherInterface $flasher)
    {
        if ($request->input("cer_type")=='84'){
            $this->validate($request,
                [
                    'cert_id' => 'required',
                    'cer_type' => 'required',
                    'year' => 'required',
                    'student_id' => 'required',
                    'nationality_h' => 'required',
                    'place_birth_h' => 'required',
                    'year_birth_h' => 'required',
                    'course_id' => 'required',
                    'total_hours' => 'required',
                    'start_day' => 'required',
                    'end_day' => 'required',
                    'appreciation' => 'required',
                    'certificate_fees' => 'required',
                    'catch_receipt_id' => 'required'
                ],
                [
                    "required"=>"يجب ادخال هذا الحقل"
                ]);
            $certificate = Certificate::create([
                'uid' => $request->input("cert_id"),
                'type' => $request->input("cer_type"),
                'year' => $request->input("year"),
                'student_id' => $request->input("student_id"),
                'nationality' => $request->input("nationality_h"),
                'place_birth' => $request->input("place_birth_h"),
                'year_birth' => $request->input("year_birth_h"),
                'course_id' => $request->input("course_id"),
                'total_hours' => $request->input("total_hours"),
                'start_day' => $request->input("start_day"),
                'end_day' => $request->input("end_day"),
                'appreciation' => $request->input("appreciation"),
                'certificate_fees' => $request->input("certificate_fees"),
                'catch_receipt_id' => $request->input("catch_receipt_id"),
                'print_execute' => $request->input("print_execute")?1:0,
                //'release_date' => date("Y-m-d"),
                'created_by' => $this->getId()
            ]);

            Session::flash("msg","تمت عملية الاضافة بنجاح");
            return redirect("/CMS/Certificate#certificate");
        }
        if ($request->input("cer_type")=='85'){
             $this->validate($request,
                [
                    'cert_id' => 'required',
                    'cer_type' => 'required',
                    'year' => 'required',
                    'student_id' => 'required',
                    'nationality_h' => 'required',
                    'place_birth_h' => 'required',
                    'year_birth_h' => 'required',
                    'course_id' => 'required',
                    'total_hours' => 'required',
                    'start_day' => 'required',
                    'end_day' => 'required',
                    'appreciation' => 'required',
                    'certificate_fees' => 'required',
                    'catch_receipt_id' => 'required'
                ],
                [
                    "required"=>"يجب ادخال هذا الحقل"
                ]);
            $certificate = Certificate::create([
                'uid' => $request->input("cert_id"),
                'type' => $request->input("cer_type"),
                'year' => $request->input("year"),
                'student_id' => $request->input("student_id"),
                'nationality' => $request->input("nationality_h"),
                'place_birth' => $request->input("place_birth_h"),
                'year_birth' => $request->input("year_birth_h"),
                'course_id' => $request->input("course_id"),
                'total_hours' => $request->input("total_hours"),
                'start_day' => $request->input("start_day"),
                'end_day' => $request->input("end_day"),
                'appreciation' => $request->input("appreciation"),
                'certificate_fees' => $request->input("certificate_fees"),
                'catch_receipt_id' => $request->input("catch_receipt_id"),
                'print_execute' => $request->input("print_execute")?1:0,
                //'release_date' => date("Y-m-d"),
                'created_by' => $this->getId()
            ]);


            $flasher->addSuccess("تمت عملية الاضافة بنجاح");
            return redirect("/CMS/Certificate#sharing");
        }

        if ($request->input("cer_type")=='86'){
            $this->validate($request,
                [
                    'cert_id' => 'required',
                    'cer_type' => 'required',
                    'year' => 'required',
                    'student_id' => 'required',
                    'nationality_h' => 'required',
                    'year_birth_h' => 'required',
                    'course_id' => 'required',
                    'total_hours' => 'required',
                    'start_day' => 'required',
                    'end_day' => 'required'
                ],
                [
                    "required"=>"يجب ادخال هذا الحقل"
                ]);
            $certificate = Certificate::create([
                'uid' => $request->input("cert_id"),
                'type' => $request->input("cer_type"),
                'year' => $request->input("year"),
                'student_id' => $request->input("student_id"),
                'nationality' => $request->input("nationality_h"),
                'year_birth' => $request->input("year_birth_h"),
                'course_id' => $request->input("course_id"),
                'total_hours' => $request->input("total_hours"),
                'start_day' => $request->input("start_day"),
                'end_day' => $request->input("end_day"),
                'print_execute' => $request->input("print_execute")?1:0,
                //'release_date' => date("Y-m-d"),
                'created_by' => $this->getId()
            ]);

            $flasher->addSuccess("تمت عملية الاضافة بنجاح");
            return redirect("/CMS/Certificate#international");
        }
        if ($request->input("cer_type")=='87'){
            $this->validate($request,
                [
                    'cert_id' => 'required',
                    'cer_type' => 'required',
                    'year' => 'required',
                    'student_name' => 'required'
                ],
                [
                    "required"=>"يجب ادخال هذا الحقل"
                ]);
            $certificate = Certificate::create([
                'uid' => $request->input("cert_id"),
                'type' => $request->input("cer_type"),
                'year' => $request->input("year"),
                'student_name' => $request->input("student_name"),
                'print_execute' => $request->input("print_execute")?1:0,
                //'release_date' => date("Y-m-d"),
                'description' => $request->input("description"),
                'created_by' => $this->getId()
            ]);

            $flasher->addSuccess("تمت عملية الاضافة بنجاح");
            return redirect("/CMS/Certificate#appreciation");
        }
        if ($request->input("cer_type")=='88'){
            $this->validate($request,
                [
                    'cert_id' => 'required',
                    'cer_type' => 'required',
                    'year' => 'required',
                    'student_id' => 'required',
                    'nationality_h' => 'required',
                    'place_birth_h' => 'required',
                    'year_birth_h' => 'required',
                    'course_id' => 'required',
                    'total_hours' => 'required',
                    'start_day' => 'required',
                    'end_day' => 'required',
                    'appreciation' => 'required',
                    'release_date' => 'required'
                ],
                [
                    "required"=>"يجب ادخال هذا الحقل"
                ]);
            $certificate = Certificate::create([
                'uid' => $request->input("cert_id"),
                'type' => $request->input("cer_type"),
                'year' => $request->input("year"),

                'student_id' => $request->input("student_id"),
                'nationality' => $request->input("nationality_h"),
                'place_birth' => $request->input("place_birth_h"),
                'year_birth' => $request->input("year_birth_h"),
                'course_id' => $request->input("course_id"),
                'total_hours' => $request->input("total_hours"),
                'start_day' => $request->input("start_day"),
                'end_day' => $request->input("end_day"),
                'appreciation' => $request->input("appreciation"),
                'release_date' => $request->input("release_date"),
                'print_execute' => 1,
                'created_by' => $this->getId()
            ]);

            $flasher->addSuccess("تمت عملية الاضافة بنجاح");
            return redirect("/CMS/Certificate#old");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $item=Certificate::where("id",$id)->where("isdelete",0)->first();
        $title="سجل البيانات العامه";
        $parentTitle="عرض الشهادات ";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Certificate/");
        }
        return view("cms.certificate.show",compact("title","item","id","parentTitle"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    { $item=Certificate::where("id",$id)->where("isdelete",0)->first();
        $types=Option::where('parent_id',58)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $nationalities=Option::where('parent_id',55)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $appreciations=Option::where('parent_id',57)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $students=Student::where('isdelete',0)->where('active',1)->orderBy('nameAR')->get();
        $courses=Option::where('parent_id',53)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $catches=Catch_receipt::where('isdelete',0)->get();
        $years=Option::where('parent_id',369)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $title="سجل البيانات العامه";
        $parentTitle="تعديل الشهادات ";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Certificate/");
        }
        return view("cms.certificate.edit",compact("title","item","id","catches","parentTitle","types","nationalities","appreciations","students","courses","years"));
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

        if ($request->input("cer_type")=='84' or $request->input("cer_type")=='85'){
            $this->validate($request,
                [
                    'cert_id' => 'required',
                    'cer_type' => 'required',
                    'year' => 'required',
                    'student_id' => 'required',
                    'nationality_h' => 'required',
                    'place_birth_h' => 'required',
                    'year_birth_h' => 'required',
                    'course_id' => 'required',
                    'total_hours' => 'required',
                    'start_day' => 'required',
                    'end_day' => 'required',
                    'appreciation' => 'required',
                    'certificate_fees' => 'required',
                    'catch_receipt_id' => 'required'
                ],
                [
                   // "required"=>"يجب ادخال هذا الحقل"
                ]);
            $item=Certificate::find($id);
            $item->uid=$request->input("cert_id");
            $item->year=$request->input("year");
            $item->type=$request->input("cer_type");
            $item->student_id=$request->input("student_id");
            $item->nationality=$request->input("nationality_h");
            $item->place_birth=$request->input("place_birth_h");
            $item->year_birth=$request->input("year_birth_h");
            $item->course_id=$request->input("course_id");
            $item->total_hours=$request->input("total_hours");
            $item->start_day=$request->input("start_day");
            $item->end_day=$request->input("end_day");
            $item->appreciation=$request->input("appreciation");
            $item->certificate_fees=$request->input("certificate_fees");
            $item->catch_receipt_id=$request->input("catch_receipt_id");
            $item->print_execute=$request->input("print_execute")?1:0;
           // $item->release_date=$request->input("release_date");
            $item->updated_by=$this->getId();
            $item->save();

            $flasher->addSuccess("تمت عملية الحفظ بنجاح");
            if ($request->input("cer_type")=='84'){
             return redirect("/CMS/Certificate#certificate");
            }elseif ($request->input("cer_type")=='85'){
                 return redirect("/CMS/Certificate#sharing");
            }
        }
        if ($request->input("cer_type")=='86'){
            $this->validate($request,
                [
                    'cert_id' => 'required',
                    'cer_type' => 'required',
                    'year' => 'required',
                    'student_id' => 'required',
                    'nationality_h' => 'required',
                    'year_birth_h' => 'required',
                    'course_id' => 'required',
                    'total_hours' => 'required',
                    'start_day' => 'required',
                    'end_day' => 'required'
                ],
                [
                   // "required"=>"يجب ادخال هذا الحقل"
                ]);
            $item=Certificate::find($id);
            $item->uid=$request->input("cert_id");
            $item->year=$request->input("year");
            $item->type=$request->input("cer_type");
            $item->student_id=$request->input("student_id");
            $item->nationality=$request->input("nationality_h");
            $item->year_birth=$request->input("year_birth_h");
            $item->course_id=$request->input("course_id");
            $item->total_hours=$request->input("total_hours");
            $item->start_day=$request->input("start_day");
            $item->end_day=$request->input("end_day");
            $item->print_execute=$request->input("print_execute")?1:0;
           // $item->release_date=$request->input("release_date");
            $item->updated_by=$this->getId();
            $item->save();

            $flasher->addSuccess("تمت عملية الحفظ بنجاح");
            return redirect("/CMS/Certificate#international");
        }
        if ($request->input("cer_type")=='87'){
            $this->validate($request,
                [
                    'cert_id' => 'required',
                    'cer_type' => 'required',
                    'year' => 'required',
                    'student_name' => 'required'
                ],
                [
                    //"required"=>"يجب ادخال هذا الحقل"
                ]);
            $item=Certificate::find($id);
            $item->uid=$request->input("cert_id");
            $item->year=$request->input("year");
            $item->type=$request->input("cer_type");
            $item->student_name=$request->input("student_name");
            $item->description=$request->input("description");
            $item->print_execute=$request->input("print_execute")?1:0;
            //$item->release_date=$request->input("release_date");
            $item->updated_by=$this->getId();
            $item->save();

            $flasher->addSuccess("تمت عملية الحفظ بنجاح");
            return redirect("/CMS/Certificate#appreciation");
        }
        if ($request->input("cer_type")=='88'){
            $this->validate($request,
                [
                    'cert_id' => 'required',
                    'cer_type' => 'required',
                    'year' => 'required',
                    'student_id' => 'required',
                    'nationality_h' => 'required',
                    'place_birth_h' => 'required',
                    'year_birth_h' => 'required',
                    'course_id' => 'required',
                    'total_hours' => 'required',
                    'start_day' => 'required',
                    'end_day' => 'required',
                    'appreciation' => 'required',
                    'release_date' => 'required'
                ],
                [
                   // "required"=>"يجب ادخال هذا الحقل"
                ]);
            $item=Certificate::find($id);
            $item->uid=$request->input("cert_id");
            $item->year=$request->input("year");
            $item->type=$request->input("cer_type");
            $item->student_id=$request->input("student_id");
            $item->nationality=$request->input("nationality_h");
            $item->place_birth=$request->input("place_birth_h");
            $item->year_birth=$request->input("year_birth_h");
            $item->course_id=$request->input("course_id");
            $item->total_hours=$request->input("total_hours");
            $item->start_day=$request->input("start_day");
            $item->end_day=$request->input("end_day");
            $item->appreciation=$request->input("appreciation");
            $item->release_date=$request->input("release_date");
            $item->updated_by=$this->getId();
            $item->print_execute=1;
            $item->save();

            $flasher->addSuccess("تمت عملية الحفظ بنجاح");
            return redirect("/CMS/Certificate#old");
        }
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
        $item=Certificate::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/Certificate/");
    }

    public function getYearFilter()
    {

        $students=Student::where('isdelete',0)->where('m_year',$this->getMoneyYear())->where('active',1)->orderBy('nameAR')->get();
        return Response::json( $students );
    }
}
