<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\User;
use App\Models\Money_year;
use App\Models\Repository;
use Illuminate\Http\Request;
use App\Models\Repository_View;
use App\Models\Repository_year;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class RepositoryController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitle="ادارة المستودعات";
        $title="المستودع";
        $items=Repository::where('isdelete',0)->paginate(10);
        $boxes=Box::where('isdelete',0)->where('active',1)->get();
        return view("cms.repository.index",compact("title","subtitle","items","boxes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة مستودع";
        $title="المستودعات";
        $linkApp="/CMS/Repository/";
        $boxes=Box::where('repository_id',0)->where('type',148)->where('isdelete',0)->where('active',1)->get();
        $users = User::where('isdelete',0)->where('Status','مفعل')->orderBy('name')->get();
        return view("cms.repository.add",compact("title","parentTitle","linkApp","boxes",'users'));
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
                'name' => 'required',
                'box_id' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);
        $repository = Repository::create([
            'name' => $request->input("name"),
            'box_id' => $request->input("box_id"),
            'created_by' => $this->getId()
        ]);

        if ($repository){
            $repository_views = $request->input("user_show");
            if ($repository_views!=null){
                foreach($repository_views as $repository_view){
                    $rv = new Repository_View();
                    $rv->repository_id = $repository->id;
                    $rv->user_id = $repository_view;
                    $rv->created_by = $this->getId();
                    $rv->save();
                }
            }

            $rep = 0;
            $r = Repository::all();
            if (count($r)!=0){
                $r = Repository::latest()->first();
                $rep = $r->id;
            }
            if ($request->input("box_id")!=null || $request->input("box_id")!=0){
                $box = Box::find($request->input("box_id"));
                $box->repository_id = $rep;
                $box->save();
            }


            $isMoney=Money_year::where('isdelete',0)->count();
            if ($isMoney>0){
                $money=Money_year::where('isdelete',0)->get();
                foreach ($money as $m){
                    $repos=new Repository_year();
                    $repos->repository_id=$rep;
                    $repos->m_year=$m->year;
                    $repos->repository_in=0;
                    $repos->repository_out=0;
                    $repos->active=0;
                    $repos->save();
                }
            }
        }


    $flasher->addSuccess("تمت عملية الاضافة بنجاح");
        return redirect("/CMS/Repository/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="عرض المستودع ";
        $item=Repository::where("id",$id)->where("isdelete",0)->first();
        $repository_views = Repository_View::where('repository_id',$id)->get();
        $title="ادارة المستودعات";
        $linkApp="/CMS/Repository/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Repository/");
        }
        return view("cms.repository.show",compact("title","item","id","parentTitle",'repository_views',"linkApp"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل المستودع ";
        $item=Repository::where("id",$id)->where("isdelete",0)->first();
        $users = User::where('isdelete',0)->where('Status','مفعل')->orderBy('name')->get();
        $repository_views = Repository_View::where('repository_id',$id)->get();
        $boxes=Box::where('repository_id',0)->where('type',148)->where('isdelete',0)->where('active',1)->get();
        $boxess=Box::where('id',$item->box_id)->first();
        $title="ادارة المستودعات";
        $linkApp="/CMS/Repository/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Repository/");
        }
        return view("cms.repository.edit",compact("title","item","id","users","repository_views","boxes","boxess","parentTitle","linkApp"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'box_id' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Repository::find($id);
        $item->name=$request->input("name");
        $item->box_id=$request->input("box_id");
        $item->updated_by=$this->getId();
        $item->save();
        if ($item){
            $repository_views = $request->input("user_show");
            if ($repository_views != null){
                Repository_View::where("repository_id",$id)->delete();
                foreach($repository_views as $repository_view){
                    $rv = new Repository_View();
                    $rv->repository_id = $item->id;
                    $rv->user_id = $repository_view;
                    $rv->created_by = $this->getId();
                    $rv->save();
                }

            }
        }
        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/Repository/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Repository::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();

        if ($item->save()){
            $box = Box::find($item->box_id);
            if ($box!=null){
                $box->repository_id = 0;
                $box->save();
            }

        }

        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Repository/");
    }
}
