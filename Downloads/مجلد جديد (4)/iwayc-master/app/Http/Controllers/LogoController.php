<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\File;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


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
    public function edit(Request $request)
    {
        $logos = Logo::first();
        return view('logo.edit',compact('logos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

  public function update_image_icon1(Request $request,FlasherInterface $flasher )
  {
    $request->validate([
        'image_icon1' => 'required|mimes:jpeg,png,jpg,gif',
    ]);

    $logos = Logo::first();
    if($request->hasfile('image_icon1'))
    {
       $destination = 'uploads/logos/'.$logos->image_icon1;
      // dd($destination);

       if(File::exists($destination))
       {

        File::delete($destination);

       }
       $file = $request->file('image_icon1');
       $extention = $file->getClientOriginalExtension();
       $filename = time().'.'.$extention;
       $file->move('uploads/logos/', $filename);
       $logos->image_icon1 =  $filename;

    }



    $logos->update();
    $flasher->addSuccess("تم حفظ الصورة بنجاح");
    return redirect()->back();
  }

  public function update_image_icon2(Request $request,FlasherInterface $flasher )
  {
    $request->validate([
        'image_icon2' => 'required|mimes:jpeg,png,jpg,gif',
    ]);
    
    $logos = Logo::first();
    if($request->hasfile('image_icon2'))
    {
       $destination = 'uploads/logos/'.$logos->image_icon2;
      // dd($destination);

       if(File::exists($destination))
       {

        File::delete($destination);

       }
       $file = $request->file('image_icon2');
       $extention = $file->getClientOriginalExtension();
       $filename = time().'.'.$extention;
       $file->move('uploads/logos/', $filename);
       $logos->image_icon2 =  $filename;

    }


    $logos->update();
    $flasher->addSuccess("تم حفظ الصورة بنجاح");
    return redirect()->back();
  }






    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  //  public function destroy($id,FlasherInterface $flasher)
 //   {
  //      $logo = Logo::findOrFail($id);

  //      File::delete(public_path('uploads/logos/'.$logo->image_icon1));
   //     $logo->delete();

  //      File::delete(public_path('uploads/logos/'.$logo->image_icon2));
     //   $logo->delete();

     //   $flasher->addSuccess("تمت عملية الاضافة بنجاح");
     //   return redirect()->route('logo.index');

  //  }
}
