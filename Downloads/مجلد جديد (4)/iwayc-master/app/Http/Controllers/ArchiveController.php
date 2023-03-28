<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Option;
use App\Models\Archive;
use App\Models\Archive_edit;
use App\Models\Archive_view;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class ArchiveController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="سجل البيانات العامه";
        $subtitle="سجل الارشيف العام";
        $items=Archive::where('isdelete',0)->paginate(10);
        $sections=Option::where('parent_id',128)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $sub_sections=Option::where('parent_id',133)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        return view("cms.archive.index",compact("title","subtitle","items","sections","sub_sections"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة ارشيف جديدة";
        $title="سجل الارشيف العام ";

        $sections=Option::where('parent_id',128)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $sub_sections=Option::where('parent_id',133)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $addresses = Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->orderBy('title')->get();


        $users = User::where('isdelete',0)->where('Status','مفعل')->orderBy('name')->get();

        return view("cms.archive.add",compact("title","parentTitle","sections","users","sub_sections","addresses"));
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
                'section' => 'required',
                'sub_section' => 'required',
                'address' => 'required',
                'details' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل",
                "image.image"=>"لم يتم ادخال صورة بشكل صحيح"
            ]);

        $archive = new Archive();
        $archive->image = '0000888';
        $archive->section = $request->input("section");
        $archive->sub_section = $request->input("sub_section");
        $archive->address = $request->input("address");
        $archive->details = $request->input("details");
        $archive->active = $request->input("active")?1:0;
        $archive->notes = $request->input("notes");
        $archive->created_by = $this->getId();
        $archive->save();

        $msg = ' وتم حفظ الارشيف';

        if ($archive){
            $archive_views = $request->input("user_show");
            if ($archive_views!=null){
                foreach($archive_views as $archive_view){
                    $av = new Archive_view();
                    $av->archive_id = $archive->id;
                    $av->user_id = $archive_view;
                    $av->created_by = $this->getId();
                    $av->save();
                }
            }
            $archive_edits = $request->input("user_update");
            if ($archive_edits!=null) {
                foreach ($archive_edits as $archive_edit) {
                    $ae = new Archive_edit();
                    $ae->archive_id = $archive->id;
                    $ae->user_id = $archive_edit;
                    $ae->created_by = $this->getId();
                    $ae->save();
                }
            }
            if($request->hasFile('image'))
            {
                $allowedfileExtension=['jpeg','jpg','png','bmp'];
                $files = $request->file('image');
                foreach($files as $file){
                    $extension = $file->getClientOriginalExtension();
                    $name = time(). uniqid() .'.'.$extension;
                    $destinationPath = base_path('/public/images/userimage');

                    $check=in_array($extension,$allowedfileExtension);
                    if($check)
                    {
                        $file->move($destinationPath, $name);
                        Image::create([
                            'filename' => $name,
                            'archive_id' => $archive->id,
                        ]);
                        $msg = "تمت عملية الاضافة بنجاح";
                    }
                    else
                    {
                        $msg = "لم تتم الاضافة";
                    }
                }
            }
            $msg = "تمت عملية الاضافة بنجاح";
        }
        $msg = "تمت عملية الاضافة بنجاح";
        $flasher->addSuccess("$msg");
      //  Session::flash("msg",$msg);
        return redirect("/CMS/Archive");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="عرض الارشيف ";
        $item=Archive::where("id",$id)->where("isdelete",0)->first();
        $archive_veiws = Archive_view::where('archive_id',$id)->get();
        $archive_edits = Archive_edit::where('archive_id',$id)->get();
        $images = Image::where('archive_id',$id)->get();
        $title="سجل الارشيف العام ";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Archive/");
        }

        $returnHTML= view("cms.archive.showModal",compact("title","item","id","images","archive_veiws","archive_edits","parentTitle"))->render();

            return response()->json(['html'=>$returnHTML]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل الارشيف ";
        $item=Archive::where("id",$id)->where("isdelete",0)->first();
        $sections=Option::where('parent_id',128)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $sub_sections=Option::where('parent_id',133)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $addresses = Option::where('parent_id',56)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $users = User::where('isdelete',0)->where('Status','مفعل')->orderBy('name')->get();
        $images = Image::where('archive_id',$id)->get();
        $archive_veiws = Archive_view::where('archive_id',$id)->get();

        $archive_edits = Archive_edit::where('archive_id',$id)->get();
        $title="سجل الارشيف العام ";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");

            return redirect("/CMS/Archive/");
        }
        return view("cms.archive.edit",compact("title","item","id","images","archive_veiws","archive_edits","parentTitle","sections","users","sub_sections","addresses"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        //dd($request->all());

        $this->validate($request,
            [
                'section' => 'required',
                'sub_section' => 'required',
                'address' => 'required',
                'details' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Archive::find($id);

        $item->section=$request->input("section");
        $item->sub_section=$request->input("sub_section");
        $item->address=$request->input("address");
        $item->details=$request->input("details");
        $item->active=$request->input("active")?1:0;
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        $item->save();

        $msg = 'تم حفظ الارشيف';

        if ($item){
            $archive_views = $request->input("user_show");
            if ($archive_views != null){
                Archive_view::where("archive_id",$id)->delete();
                foreach($archive_views as $archive_view){
                    $av = new Archive_view();
                    $av->archive_id = $item->id;
                    $av->user_id = $archive_view;
                    $av->created_by = $this->getId();
                    $av->save();
                }
                $msg = $msg . ' وتم حفظ من يمكنه رؤية الارشيف';
            }
            $archive_edits = $request->input("user_update");
            if ($archive_edits != null){
                Archive_edit::where("archive_id",$id)->delete();
                foreach($archive_edits as $archive_edit){
                    $av = new Archive_edit();
                    $av->archive_id = $item->id;
                    $av->user_id = $archive_edit;
                    $av->created_by = $this->getId();
                    $av->save();
                }
                $msg = $msg . ' وتم حفظ من يمكنه تعديل الارشيف';
            }
            if($request->has('oldimages'))
            {
                $old=$request->input('oldimages');
                Image::whereNotIn('id', $old)->delete();
            }else{
                Image::where("archive_id",$id)->delete();
            }

            if($request->hasFile('image'))
            {
                // Image::where("archive_id",$id)->delete();
                $allowedfileExtension=['jpeg','jpg','png','bmp'];
                $files = $request->file('image');
                foreach($files as $file){
                    $extension = $file->getClientOriginalExtension();
                    $name = time(). uniqid() .'.'.$extension;
                    $destinationPath = base_path('/public/images/userimage');

                    $check=in_array($extension,$allowedfileExtension);
                    if($check)
                    {
                        $file->move($destinationPath, $name);
                        Image::create([
                            'filename' => $name,
                            'archive_id' => $item->id,
                        ]);
                        $msg = "تمت عملية الاضافة بنجاح";
                    }
                    else
                    {
                        $msg = "لم تتم الاضافة";
                    }
                }
            }
            $msg = $msg . ' وتم حفظ صور الارشيف';
        }
        $flasher->addSuccess("$msg");
      //  Session::flash("msg",$msg);
        return redirect("/CMS/Archive/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Archive::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Archive/");
    }
}
