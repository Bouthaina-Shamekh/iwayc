<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Http\traits\ImageTrait;
use Illuminate\Support\Facades\Storage;
use Hash;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */

     use ImageTrait;

     public function index(Request $request)
     {
         return view('profiles.index');
     }
     public function edit(Request $request)
     {
         return view('profiles.edit');
     }


    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user= User::where('id',auth()->id())->firstOrFail();
        $request->validate([
            'name'=>"required|min:3|max:190",
        ]);
        $user->update([
            'name'=>$request->name,
        ]);

        if($request->file('user_img')){

             if(Auth::user()->avatar != 'avatar.png'){
                Storage::disk('users-avatar')->delete(Auth::user()->avatar);
              }
        $dataimage = $this->insertImage(Auth::user()->id,$request->user_img,'storage/users-avatar/');

        $user->update([
                    'avatar' => $dataimage,
                ]);

             }

        //toastr()->success('تمت العملية بنجاح');
        //emotify('info','تمت العملية بنجاح');
           return redirect()->route('profile.index');
    }

    public function update_email(Request $request){

        $request->validate([
        'email_phone'=>"required",
        'email'=>"required|email|confirmed|unique:users,email,".auth()->user()->id

        ]);
        auth()->user()->update([
            'email'=>$request->email
        ]);

      //  toastr()->success('تمت عملية تغيير الهاتف بنجاح','عملية ناجحة');
      return redirect()->route('profile.index');
    }

    public function update_password(Request $request){
        $request->validate([
            'old_password'=>"required|string|min:8|max:190",
            'password'=>"required|string|confirmed|min:8|max:190"
        ]);
        if(Hash::check($request->old_password, auth()->user()->password)){
            auth()->user()->update([
                'password'=>Hash::make($request->password)
            ]);
           // toastr()->success('تم تغيير كلمة المرور بنجاح','عملية ناجحة');
           return redirect()->route('profile.index');

        }else{
            //flash()->error('كلمة المرور الحالية التي أدخلتها غير صحيحة','عملية غير ناجحة');
            return redirect()->back();
        }
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
