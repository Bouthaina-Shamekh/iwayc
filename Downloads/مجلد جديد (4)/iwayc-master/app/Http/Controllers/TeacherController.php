<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Teacher;
use App\Models\Money_year;
use App\Models\Teacher_year;
use Illuminate\Http\Request;
use App\Events\NewNotification;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class TeacherController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle = "ادارة المعلمين";
        $title="سجل البيانات العامة";
        $items = Teacher::where('isdelete', 0)->paginate(10);
        $specs = Option::where('parent_id', 52)->where('isdelete', 0)->where('active', 1)->get();
        $addresses = Option::where('parent_id', 56)->where('isdelete', 0)->where('active', 1)->get();
        $classifications = Option::where('parent_id', 12)->where('isdelete', 0)->where('active', 1)->get();
        $nationalities = Option::where('parent_id', 55)->where('isdelete', 0)->where('active', 1)->get();
        return view("cms.teacher.index", compact("title", "subtitle", "items", "specs", "addresses", "classifications","nationalities"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle = "اضافة معلم جديد";
        $title = "ادارة المعلمين";

        $specs = Option::where('parent_id', 52)->where('isdelete', 0)->where('active', 1)->orderBy('title')->get();
        $addresses = Option::where('parent_id', 56)->where('isdelete', 0)->where('active', 1)->orderBy('title')->get();
        $classes = Option::where('parent_id', 12)->where('isdelete', 0)->where('active', 1)->orderBy('title')->get();
        $nationalities = Option::where('parent_id', 55)->where('isdelete', 0)->where('active', 1)->orderBy('title')->get();
        return view("cms.teacher.add", compact("title", "parentTitle", "specs", "addresses", "classes", "nationalities"));
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
            'name' => 'required|unique:teachers',
            'specialization' => 'required',
            'birthday' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'phone1' => 'required',
            'classification' => 'required'
        ],
        [
            "required" => "يجب ادخال هذا الحقل"
         ,"unique"=>"هذه البيانات مسجلة من قبل"
        ]);
    $name = $request->input("name");

    $isExists = Teacher::whereRaw("name='$name'")->count();
    if ($isExists > 0) {
        flash()->addWarning("الاسم موجود مسبقا");
        flash()->addError("alert-danger");
        return redirect("/CMS/Teacher/create")->withInput();
    }

    $teacher = Teacher::create([
        'name' => $request->input("name"),
        'specialization' => $request->input("specialization"),
        'birthday' => $request->input("birthday"),
        'nationality' => $request->input("nationality"),
        'address' => $request->input("address"),
        'phone1' => $request->input("phone1"),
        'phone2' => $request->input("phone2"),
        'email' => $request->input("email"),
        'classification' => $request->input("classification"),
        'notes' => $request->input("notes"),
        'created_by' => $this->getId()
    ]);

    if ($teacher) {
        $money_years = Money_year::get();
        foreach ($money_years as $money_year) {
            $teacher_year = new Teacher_year();
            $teacher_year->teacher_id = $teacher->id;
            $teacher_year->m_year = $money_year->year;
            if ($money_year->year == $this->getMoneyYear()) {
                $teacher_year->active = $request->input("active") ? 1 : 0;
            } else {
                $teacher_year->active = 0;
            }
            $teacher_year->created_by = $this->getId();
            $teacher_year->save();
        }
    }
    $data = [
        'user_id' => Auth::id(),
        //'name' => $request->input("name"),
        'user_name' => $request -> user_name ,



    ];
      event(new NewNotification($data));
      $flasher->addSuccess("تمت عملية الاضافة بنجاح");
    return redirect("/CMS/Teacher/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle = "عرض المعلم";
        $item = Teacher::where("id", $id)->where("isdelete", 0)->first();
        $tech_active=Teacher_year::where('teacher_id',$id)->where('m_year',$this->getMoneyYear())->first();

        $title = "ادارة المعلمين";

        if ($item == NULL) {
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Teacher/");
        }
        return view("cms.teacher.show", compact("title", "item",'tech_active', "id", "parentTitle"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle = "تعديل المعلمين ";
        $item = Teacher::where("id", $id)->where("isdelete", 0)->first();
        $tech_active=Teacher_year::where('teacher_id',$id)->where('m_year',$this->getMoneyYear())->first();

        $specs = Option::where('parent_id', 52)->where('isdelete', 0)->where('active', 1)->get();
        $addresses = Option::where('parent_id', 56)->where('isdelete', 0)->where('active', 1)->get();
        $classes = Option::where('parent_id', 12)->where('isdelete', 0)->where('active', 1)->get();
        $nationalities = Option::where('parent_id', 55)->where('isdelete', 0)->where('active', 1)->get();
        $title = "ادارة المعلمين";
        if ($item == NULL) {
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Teacher/");
        }
        return view("cms.teacher.edit", compact("title", "item","tech_active", "id", "specs", "addresses", "classes", "nationalities", "parentTitle"));
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
            'specialization' => 'required',
            'birthday' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'phone1' => 'required',
            'classification' => 'required'
        ],
        [
            "required" => "يجب ادخال هذا الحقل"
        ]);
    $item = Teacher::find($id);
    $name = $request->input("name");
    if ($item->name != $name) {
        $isExists = Teacher::whereRaw("name='$name'")->count();
        if ($isExists > 0) {
            flash()->addWarning("الاسم موجود مسبقا");
            flash()->addError("alert-danger");
            return redirect("/CMS/Teacher/create")->withInput();
        }
    }

    $item->name = $request->input("name");
    $item->specialization = $request->input("specialization");
    $item->birthday = $request->input("birthday");
    $item->nationality = $request->input("nationality");
    $item->address = $request->input("address");
    $item->phone1 = $request->input("phone1");
    $item->phone2 = $request->input("phone2");
    $item->email = $request->input("email");
    $item->classification = $request->input("classification");
    $item->active = $request->input("active") ? 1 : 0;
    $item->notes = $request->input("notes");
    $item->updated_by = $this->getId();
    $item->save();

    if ($item) {
        $isTeacher_year = Teacher_year::where('teacher_id', $item->id)->where('m_year', $this->getMoneyYear())->count();
        if ($isTeacher_year > 0) {
            $teacher_year = Teacher_year::where('teacher_id', $item->id)->where('m_year', $this->getMoneyYear())->first();
            $teacher_year->active = $request->input("active") ? 1 : 0;
            $teacher_year->updated_by = $this->getId();
            $teacher_year->save();
        }
    }

    $flasher->addSuccess("تمت عملية الحفظ بنجاح");
    return redirect("/CMS/Teacher/");
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
        $item = Teacher::find($id);
        $item->isdelete = 1;
        $item->deleted_by = $this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Teacher/");
    }
}
