<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Option;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class OfferController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="التسويق";
        $subtitle="عروض الدورات";
        $types=Option::where('parent_id',251)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        return view("cms.offer.index",compact("title","subtitle","types"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة عرض جديد";
        $title="التسويق";
        $types=Option::where('parent_id',251)->where('isdelete',0)->where('active',1)->orderBy('title')->get();

        return view("cms.offer.add",compact("title","parentTitle","types"));
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
                'date' => 'required',
                'title' => 'required',
                'details' => 'required',
                'fees_reg' => 'required',
                'fees_bag' => 'required',
                'fees_course' => 'required',
                'amount_h' => 'required',
                'discount_r' => 'required',
                'discount_v_h' => 'required',
                'total_h' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $offer = new Offer();
        $offer->date = $request->input("date");
        $offer->title = $request->input("title");
        $offer->type = $request->input("type");
        $offer->details = $request->input("details");

        if($request->hasFile('image'))
        {
            $allowedfileExtension=['jpeg','jpg','png','bmp'];
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $name = time(). uniqid() .'.'.$extension;
            $destinationPath = base_path('/public/images/userimage');

            $check=in_array($extension,$allowedfileExtension);
            if($check) {
                $file->move($destinationPath, $name);
                $offer->img = $name;
            }else{
                Session::flash("msg","يرجي ادخال صورة بصيغة jpeg,jpg,png,bmp");
                Session::flash("msgClass","alert-danger");
                return redirect("/CMS/Offer/");
            }
        }


        $offer->fees_reg = $request->input("fees_reg");
        $offer->fees_bag = $request->input("fees_bag");
        $offer->fees_course = $request->input("fees_course");
        $offer->amount = $request->input("amount_h");
        $offer->discount_r = $request->input("discount_r");
        $offer->discount_v = $request->input("discount_v_h");
        $offer->total = $request->input("total_h");
        $offer->desc_refund = $request->input("desc_refund");
        $offer->active = $request->input("active")?1:0;
        $offer->notes = $request->input("notes");
        $offer->created_by = $this->getId();
        $offer->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/Offer/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="اسعار وعروض ";
        $item=Offer::where("id",$id)->where("isdelete",0)->first();
        $title="التسويق";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Offer/");
        }
        return view("cms.offer.show",compact("title","item","id","parentTitle"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {

        $parentTitle="تعديل الارشيف ";
        $item=Offer::where("id",$id)->where("isdelete",0)->first();
        $types=Option::where('parent_id',251)->where('isdelete',0)->where('active',1)->orderBy('title')->get();
        $title="التسويق";

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Offer/");
        }
        return view("cms.offer.edit",compact("title","item","id","parentTitle","types"));
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
                'date' => 'required',
                'title' => 'required',
                'details' => 'required',
                'fees_reg' => 'required',
                'fees_bag' => 'required',
                'fees_course' => 'required',
                'amount_h' => 'required'
                //'active' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Offer::find($id);

        $item->date=$request->input("date");
        $item->title=$request->input("title");
        $item->type=$request->input("type");
        $item->details=$request->input("details");

        if($request->hasFile('image'))
        {
            $allowedfileExtension=['jpeg','jpg','png','bmp'];
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $name = time(). uniqid() .'.'.$extension;
            $destinationPath = base_path('/public/images/userimage');

            $check=in_array($extension,$allowedfileExtension);
            if($check) {
                $file->move($destinationPath, $name);
                $item->img = $name;
            }else{
                flash()->addWarning("يرجي ادخال صورة بصيغة jpeg,jpg,png,bmp");
                flash()->addError("alert-danger");
                return redirect("/CMS/Offer/");
            }
        }

        $item->fees_reg=$request->input("fees_reg");
        $item->fees_bag=$request->input("fees_bag");
        $item->fees_course=$request->input("fees_course");
        $item->amount=$request->input("amount_h");
        $item->discount_r = $request->input("discount_r");
        $item->discount_v = $request->input("discount_v_h");
        $item->total = $request->input("total_h");
        $item->desc_refund=$request->input("desc_refund");
        if($request->has('active')){
        $item->active=1;
        }else{
            $item->active=0;
        }
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/Offer/");
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
        $item=Offer::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Offer/");
    }
}
