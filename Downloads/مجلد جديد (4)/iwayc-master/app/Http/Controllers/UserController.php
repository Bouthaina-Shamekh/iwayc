<?php
namespace App\Http\Controllers;
use DB;
use Hash;
use App\Models\User;
use App\Models\User_link;
use App\Models\ColorTheme;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\CMSBaseController;

class UserController extends CMSBaseController
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
$data = User::orderBy('id','DESC')->get();
return view('users.show_users',compact('data'))
->with('i', ($request->input('page', 1) - 1) * 5);
}


/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
$roles = Role::pluck('name','name')->all();
$users = User::where('Status','مفعل')->get();
return view('users.Add_user',compact('roles','users'));

}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$this->validate($request, [
'name' => 'required',
'email' => 'required|email|unique:users,email',
'password' => 'required|same:confirm-password',
'roles_name' => 'required'
]);

$input = $request->all();


$input['password'] = Hash::make($input['password']);

$user = User::create($input);
$user->assignRole($request->input('roles_name'));
ColorTheme::create([
    'user_id'=> $user->id,
    'mode' =>'light'
]);
return redirect()->route('users.index')
->with('success','تم اضافة المستخدم بنجاح');
}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
$user = User::find($id);
return view('users.show',compact('user'));
}
/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
$user = User::find($id);
$roles = Role::pluck('name','name')->all();
$userRole = $user->roles->pluck('name','name')->all();
return view('users.edit',compact('user','roles','userRole'));
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
$this->validate($request, [
'name' => 'required',
'email' => 'required|email|unique:users,email,'.$id,
'password' => 'same:confirm-password',
'roles' => 'required'
]);
$input = $request->all();
if(!empty($input['password'])){
$input['password'] = Hash::make($input['password']);
}else{
$input = array_except($input,array('password'));
}
$user = User::find($id);
$user->update($input);
DB::table('model_has_roles')->where('model_id',$id)->delete();
$user->assignRole($request->input('roles'));
return redirect()->route('users.index')
->with('success','تم تحديث معلومات المستخدم بنجاح');
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy(Request $request)
{
    ColorTheme::where('user_id',$request->user_id)->delete();
    User::find($request->user_id)->delete();
    return redirect()->route('users.index')->with('success','تم حذف المستخدم بنجاح');
}




function getActive($id){
    $item=User::find($id);
    if($item->Status == "مفعل"){
        $item->Status="غير فعال";
        $item->save();
    }else{
        $item->Status="فعال";
        $item->save();
    }

    return response()->json(['status' => '1']);
}




function getPerm($id)
{
    $subtitle = "صلاحيات مستخدم ";
    $title = "الاعدادات";
    $item=User::where("id",$id)->where("isdelete",0)->first();
    $permission=Permission::get();
    $role=Role::get();
    if($item==NULL){
        Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
        return redirect("/CMS/User/");
    }
    return view("users.perm",compact("title","subtitle","item","id","permission","role"));
}
function postPerm(Request $request,$id)
{

    $permission=$request->input("perm");
    $perm=Permission::get();
    $user=User::where("id",$id)->first();
    $user->revokePermissionTo($perm);
    $user->givePermissionTo($permission);
    Session::flash("msg","عملية حفظ الصلاحيات تمت بنجاح");
    return redirect("/CMS/User/perm/".$id);
}

function postPermm(Request $request,$id)
{
    $role=$request->input("role");
    $user=User::where("id",$id)->first();
    $user->syncRoles($role);
    Session::flash("msg","عملية حفظ الصلاحيات تمت بنجاح");
    return redirect("/CMS/User/perm/".$id);
}


function getPermission($id)
{
    $title="صلاحيات المستخدمين ";
    $parentTitle="صلاحيات المستخدمين ";
    $item=User::where("id",$id)->where("isdelete",0)->first();
    if($item==NULL){
        Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
        return redirect("/CMS/User/");
    }

    $returnHTML= view("users.permission",compact("title","item","id","parentTitle"))->render();

    return response()->json(['html'=>$returnHTML]);
}

function postPermission(Request $request,$id)
    {
        $permission=$request->input("permission");
        User_link::where("user_id",$id)->delete();
        if ($permission != null){
            foreach($permission as $p)
            {
                User_link::insert(array("user_id"=>$id,"link_id"=>$p,"created_at"=>date('Y-m-d h:i:s'),"created_by"=>$this->getId()));
            }
        }
        Session::flash("msg","عملية حفظ الصلاحيات بنجاح");
        return redirect()->route('users.index');
    }

}
