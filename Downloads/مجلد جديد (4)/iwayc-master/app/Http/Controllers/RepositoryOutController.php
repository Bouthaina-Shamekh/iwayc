<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\User;
use App\Models\Box_year;
use App\Models\Repository;
use Illuminate\Http\Request;
use App\Models\Repository_out;
use App\Models\Approval_record;
use App\Models\Repository_year;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RepositoryOutController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="صرف مستودع";
        $title="المستودع";
        $items=Repository_out::where('isdelete',0)->paginate(10);
        // $repositories=Repository::where('isdelete',0)->where('active',1)->get();
        $repositories=Repository::leftJoin('repositories_year as rp', 'rp.repository_id','=','repositories.id')
        ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
            ->select([ 'repositories.id', 'repositories.name', 'rp.m_year', 'rp.active'])
            ->where('repositories.isdelete',0)->where('rp.active',1)->where('rp.m_year',$this->getMoneyYear())->orderBy('repositories.name')
            ->where('repository_view.user_id','=',Auth::user()->id)
            ->get();
        $users=User::where("isdelete",0)->where("Status",'مفعل')->orderBy('name')->get();
        return view("cms.repositoryOut.index",compact("title","subtitle","items","users","repositories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="صرف مستودع جديد";
        $title="المستودع";
        $linkApp="/CMS/RepositoryOut/";
        $repositories=Repository::where('isdelete',0)
                ->leftJoin('repositories_year as rp', 'rp.repository_id','=','repositories.id')
                ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
                ->select([ 'repositories.id',  'repositories.name', 'rp.active'])
                ->where('rp.active','=','1')
                        ->where('rp.m_year','=',$this->getMoneyYear())
                        ->where('repository_view.user_id','=',Auth::user()->id)
                        ->get();
        return view("cms.repositoryOut.add",compact("title","parentTitle","linkApp","repositories"));
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
                'repository_id' => 'required',
                'id_comp' => 'required',
                'customer' => 'required',
                'statement' => 'required',
                'total' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $repository_id = $request->input("repository_id");

        $repository_out = Repository_out::create([
            'm_year' => $request->input("edu_year_h"),
            'repository_id' => $repository_id,
            'id_comp' => $request->input("id_comp"),
            'customer' => $request->input("customer"),
            'statement' => $request->input("statement"),
            'total' => $request->input("total"),
            'notes' => $request->input("notes"),
            'print' => $request->input("print")?1:0,
            'isdelete' => $request->input("isdelete")?1:0,
            'created_by' => $this->getId()
        ]);
        if ($repository_out){
            if(Auth::user()->responsible_id == null){
            $repository = Repository_year::where('repository_id',$repository_id)->where('m_year',$this->getMoneyYear())->first();
            $rep = Repository::where('id',$repository_id)->first();
            $repository->repository_out = $repository->repository_out+$request->input("total");
            if($repository->save()){
                $box = Box_year::where('box_id',$rep->box_id)->where('m_year',$this->getMoneyYear())->first();
                $box->expense = $repository->repository_out;
                $box->save();
                $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
                $primary->expense += $request->input("total");
                $primary->save();
            }

        }else{
        $Repository_out = Repository_out::latest()->first();
        $add = new Approval_record();
        $add->row_id=$Repository_out->id;
        $add->model_id='App\Mpdels\Repository_out';
        $add->slug='RepositoryOut';
        $add->section='صرف صندوق مستودع';
        $add->user_id=$Repository_out->created_by;
        $add->res_id=Auth::user()->responsible_id;
        $add->date=$Repository_out->created_at;
        $add->save();
        }
    }
        $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/RepositoryOut/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Repository_out  $repository_out
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="عرض الصادر ";
        $item=Repository_out::where("id",$id)->where("isdelete",0)->first();
        $title="صرف مستودع";
        $linkApp="/CMS/RepositoryOut/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/RepositoryOut/");
        }
        return view("cms.repositoryOut.show",compact("title","item","id","parentTitle","linkApp"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repository_out  $repository_out
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل الصادر ";
        $item=Repository_out::where("id",$id)->where("isdelete",0)->first();
$repositories=Repository::where('isdelete',0)
                ->leftJoin('repositories_year as rp', 'rp.repository_id','=','repositories.id')
                ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
                ->select([ 'repositories.id',  'repositories.name', 'rp.active'])
                ->where('rp.active','=','1')
                        ->where('rp.m_year','=',$this->getMoneyYear())
                        ->where('repository_view.user_id','=',Auth::user()->id)
                        ->get();
        $title="صرف مستودع";
        $linkApp="/CMS/RepositoryOut/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/RepositoryOut/");
        }
        return view("cms.repositoryOut.edit",compact("title","item","id","repositories","parentTitle","linkApp"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repository_out  $repository_out
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'repository_id' => 'required',
                'customer' => 'required',
                'statement' => 'required',
                'total' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Repository_out::find($id);
        $item->m_year=$request->input("m_year");
        $item->repository_id=$request->input("repository_id");
        $item->customer=$request->input("customer");
        $item->statement=$request->input("statement");
        $total =$item->total;
        $item->total=$request->input("total");
        $item->notes=$request->input("notes");
        $item->print = $request->input("print")?1:0;
        $item->isdelete=$request->input("isdelete")?1:0;
        $item->updated_by=$this->getId();
        if ($item->save()){
            $repository = Repository_year::where('repository_id',$request->input("repository_id"))->where('m_year',$this->getMoneyYear())->first();
            $rep = Repository::where('id',$request->input("repository_id"))->first();
            $repository->repository_out -= $total-$request->input("total");
            if ($repository->save()){
                $box = Box_year::where('box_id',$rep->box_id)->where('m_year',$this->getMoneyYear())->first();
                $box->expense = $repository->repository_out;
                $box->save();
                $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
                $primary->expense -= $total-$request->input("total");
                $primary->save();
            }
        }



        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/RepositoryOut/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repository_out  $repository_out
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Repository_out::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();

        if($item->save()){
            $repository = Repository_year::where('repository_id',$item->repository_id)->where('m_year',$this->getMoneyYear())->first();
            $rep = Repository::where('id',$item->repository_id)->first();
            $repository->repository_out -= $item->total;
            if ($repository->save()){
                $box = Box_year::where('box_id',$rep->box_id)->where('m_year',$this->getMoneyYear())->first();
                $box->expense = $repository->repository_out;
                $box->save();
                $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
                $primary->expense -= $item->total;
                $primary->save();
            }
        }

        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/RepositoryOut/");
    }
}
