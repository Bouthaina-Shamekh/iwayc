<?php

namespace App\Http\Controllers\English;

use Carbon\Carbon;
use App\Models\Option;
use App\Models\English;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class EnglishController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="اللغه الانجليزيه";
        $subtitle="ادارة فحص الانجليزي";
        $items=English::where('isdelete',0)->paginate(10);
        $classes=Option::where('parent_id',12)->where('isdelete',0)->where('active',1)->get();
        $levels=Option::where('parent_id',13)->where('isdelete',0)->where('active',1)->get();
        return view("cms.english.index",compact("title","subtitle","items","classes","levels"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة فحص جديد";
        $title="اللغه الانجليزيه";

        $classes=Option::where('parent_id',12)->where('isdelete',0)->where('active',1)->get();
        $levels=Option::where('parent_id',13)->where('isdelete',0)->where('active',1)->get();
        $addresses = Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        return view("cms.english.add",compact("title","parentTitle","classes","levels","addresses"));
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
                'date' => 'required|date|date_format:Y-m-d',
                'student_name' => 'required|unique:englishes',
                'year' => 'required',
                'address' => 'required',
                'phone1' => 'required',
                'writing' => 'required',
                'reading' => 'required',
                'grammer' => 'required',
                'conversation' => 'required',
                'total_h' => 'required',
                'level_pass' => 'required',
                'classification' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل",
                "date.date_format"=>"يجب ادخال التاريخ بصيغة d-m-Y",
                "date.date"=>"يجب ادخال تاريخ صحيح",
            "unique"=>"هذه البيانات مسجلة من قبل"

            ]);
        $english = English::create([
            'date' => $request->input("date"),
            'student_name' => $request->input("student_name"),
            'year' => $request->input("year"),
            'address' => $request->input("address"),
            'phone1' => $request->input("phone1"),
            'phone2' => $request->input("phone2"),
            'cash_rec_id' => $request->input("cash_rec_id"),
            'writing' => $request->input("writing"),
            'reading' => $request->input("reading"),
            'grammer' => $request->input("grammer"),
            'conversation' => $request->input("conversation"),
            'total' => $request->input("total_h"),
            'level_pass' => $request->input("level_pass"),
            'classification' => $request->input("classification"),
            'active' => $request->input("active")?1:0,
            'notes' => $request->input("notes"),
            'created_by' => $this->getId()
        ]);

        Session::flash("msg","تمت عملية الاضافة بنجاح");
        return redirect()->route('english.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parentTitle="عرض فحص الانجليزي ";
        $item=English::where("id",$id)->where("isdelete",0)->first();
        $title="اللغه الانجليزيه";

        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/English/");
        }
        return view("cms.english.show",compact("title","item","id","parentTitle"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parentTitle="تعديل فحص الانجليزي ";
        $item=English::where("id",$id)->where("isdelete",0)->first();
        $classes=Option::where('parent_id',12)->where('isdelete',0)->where('active',1)->get();
        $levels=Option::where('parent_id',13)->where('isdelete',0)->where('active',1)->get();
        $addresses = Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $title="اللغه الانجليزيه";
        $linkApp="/English/";
        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/English/");
        }
        return view("cms.english.edit",compact("title","item","id","parentTitle","linkApp","classes","levels","addresses"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'student_name' => 'required',
                'year' => 'required',
                'address' => 'required',
                'phone1' => 'required',
                'writing' => 'required',
                'reading' => 'required',
                'grammer' => 'required',
                'conversation' => 'required',
                'total_h' => 'required',
                'level_pass' => 'required',
                'classification' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=English::find($id);
        $item->date=$request->input("date");
        $item->student_name=$request->input("student_name");
        $item->year=$request->input("year");
        $item->address=$request->input("address");
        $item->phone1=$request->input("phone1");
        $item->phone2=$request->input("phone2");
        $item->cash_rec_id=$request->input("cash_rec_id");
        $item->writing=$request->input("writing");
        $item->reading=$request->input("reading");
        $item->grammer=$request->input("grammer");
        $item->conversation=$request->input("conversation");
        $item->total=$request->input("total_h");
        $item->level_pass=$request->input("level_pass");
        $item->classification=$request->input("classification");
        $item->active=$request->input("active")?1:0;
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        $item->save();

        Session::flash("msg","تمت عملية الحفظ بنجاح");
        return redirect()->route('english.index');

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

    public function anyEnglish(Request $request)
    {
        $tasks = English::leftJoin('options as opt', 'opt.id','=','englishes.classification')
            ->leftJoin('options as op', 'op.id','=','englishes.level_pass')
            ->leftJoin('users as us', 'us.id','=','englishes.created_by')
            ->leftJoin('users as u', 'u.id','=','englishes.updated_by')
            ->select([ 'englishes.id', 'englishes.date', 'student_name', 'englishes.cash_rec_id', 'englishes.total', 'op.title as level_pass', 'opt.title as classification', 'englishes.active', 'englishes.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('englishes.isdelete','=','0');
        return Datatables::of($tasks)
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by?$tasks->updated_by:$tasks->created_by;
            })
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('date', function ($tasks) {
                return $tasks->date ? with(new Carbon($tasks->date))->format('d-m-Y') : '';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchEnglish') and $request->get('searchEnglish') != "") {
                    $tasks->where('englishes.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('student_name', 'like', "%{$request->get('searchEnglish')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchEnglish')}%")
                                ->orWhere('englishes.cash_rec_id', 'like', "%{$request->get('searchEnglish')}%")
                                ->orWhere('englishes.date', 'like', "%{$request->get('searchEnglish')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchEnglish')}%");
                        });
                }
                if ($request->has('classId') and $request->get('classId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('classId')}");
                }
                if ($request->has('levelId') and $request->get('levelId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('levelId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('englishes.active', '=', "{$request->get('activeId')}");
                }
            })
            ->make(true);
    }

    function getActiveEnglish($id){

        $employee = English::findOrFail($id);
        if($employee->active == 1){
            $employee->update([
                'active'=>null
               ]);
        }else{
            $employee->update([
                'active'=>1
               ]);
        }
        return response()->json(['status' => '1']);
    }
    public function getId(){
        $us = 'null';
        if (Auth::check()){
            $us = Auth::user()->id;
        }
        return $us;
    }

    public function getDelete($id)
    {
        $item=English::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        Session::flash("msg","تمت عملية الحذف بنجاح");
        return redirect("CMS/english/");
    }
}
