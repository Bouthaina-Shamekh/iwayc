<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;
use App\Models\Inventory_repo;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class InventoryReposController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function endInventory(Request $request){
        $subtitle="جرد مستودع وتسويه";
        $title="المستودع";
     $repoID = $request->repo;
     $sumId = $request->sumId;
     $Inventory_repo = Inventory_repo::where('repository_id',$repoID)->latest()->first();

      $Inventory_repo->resUser_id=Auth::user()->id;
      $Inventory_repo->rem_price=$sumId;
      $Inventory_repo->is_end=1;
      $Inventory_repo->save();
      return view('cms.InventoryRepos.index',compact("title","subtitle"));


    }
    public function AllInvenRepo(){
        $subtitle="جرد مستودع وتسويه";
        $title="المستودع";
        return view('cms.InventoryRepos.index',compact("title","subtitle"));
    }

    public function InvenRepo(Request $request){
        $subtitle="جرد مستودع وتسويه";
        $title="المستودع";
        $id=$request->repo;
        $isRepository=Repository::where('id',$id)->count();
        if ($isRepository>0){
            $repository=Repository::where('id',$id)->first();
            $repository->isDone=1;
            $repository->save();
            $isInventory_repo=Inventory_repo::where('repository_id',$repository->id)->where('isdelete','0')->where('is_accept','1')->count();
            if ($isInventory_repo >0){
                $Inventory_repo=Inventory_repo::where('repository_id',$repository->id)->where('isdelete','0')->where('is_accept','1')->latest()->first();
                Inventory_repo::create([
                    'inventory_num'=>($Inventory_repo->inventory_num)+1,
                    'repository_id' =>$repository->id,
                    'created_by'=>Auth::user()->id,
                ]);
            }else{
             Inventory_repo::create([
                'inventory_num'=>1,
                'repository_id' =>$repository->id,
                'created_by'=>Auth::user()->id,
            ]);
            }
        }

        return redirect()->route('AllInvenRepo');

    }

    public function isAccept($id){
    $subtitle="جرد مستودع وتسويه";
    $title="المستودع";
    $Inventory_repo=Inventory_repo::where('id',$id)->where('isdelete','0')->first();
    $repository=Repository::where('id',$Inventory_repo->repository_id)->first();
    $repository->isDone=0;
    $repository->save();
    $Inventory_repo->update([
                    'is_accept'=>1,
                ]);

                return redirect()->route('AllInvenRepo');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
        $item=Inventory_repo::find($id);
        $item->isdelete=1;
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect()->route('AllInvenRepo');

    }


}
