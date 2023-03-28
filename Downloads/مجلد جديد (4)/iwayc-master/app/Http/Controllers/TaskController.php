<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Option;
use App\Events\MakeTask;
use App\Models\Money_year;
use App\Models\Reminder_task;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Notifications\NewLessonNotification;

class TaskController extends CMSBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $moneyYears = Money_year::where('active','1')->orderBy('year')->get();
        $moneyWork = Money_year::where('basic_work','1')->first();
        View::share('moneyYears', $moneyYears);
        View::share('moneyWork',$moneyWork);
    }

    public function index()
    {
        $title="ادارة المهام";
        $subtitle="سجل المهمات العام";
        $items=Task::where('isdelete',0)->paginate(10);
        $users=User::where('isdelete',0)->where('Status','مفعل')->get();
        $categories=Option::where('parent_id',149)->where('isdelete',0)->where('active',1)->get();
        return view("cms.task.index",compact("title","subtitle","items","users","categories"));
    }

    public function getUserTask()
    {
        $title="ادارة المهام";
        $subtitle="سجل المهمات العام";
        $items=Task::where('isdelete',0)->paginate(10);
        $users=User::where('isdelete',0)->where('Status','مفعل')->get();
        $categories=Option::where('parent_id',149)->where('isdelete',0)->where('active',1)->get();
        if(auth()->user()->hasRole('super admin')){
            return view("cms.task.admin",compact("title","subtitle","items","users","categories"));
        }
        return view("cms.task.sender",compact("title","subtitle","items","users","categories"));
    }
    public function getMyTask()
    {
        $title="ادارة المهام";
        $subtitle="مهماتي";
        $items=Task::where('isdelete',0)->paginate(10);
        $users=User::where('isdelete',0)->where('Status','مفعل')->get();
        $categories=Option::where('parent_id',149)->where('isdelete',0)->where('active',1)->get();
        if(auth()->user()->hasRole('super admin')){
            return view("cms.task.admin",compact("title","subtitle","items","users","categories"));
        }
        return view("cms.task.myTask",compact("title","subtitle","items","users","categories"));
    }

    public function showMyTask($id){
        $title= "مهماتي";
        $parentTitle="عرض مهماتي";
        $item=Task::where("id",$id)->where("isdelete",0)->first();

        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/My/Task");
        }
        return view("cms.task.show_My_Task",compact("title","parentTitle","item"));
    }

    public function getEndMyTask(){
        $title="صفحتي الشخصيه";
        $subtitle="طلبات تقيم المهام";
        $items=Task::where('isdelete',0)->paginate(10);
        $users=User::where('isdelete',0)->where('Status','مفعل')->get();
        $categories=Option::where('parent_id',149)->where('isdelete',0)->where('active',1)->get();
        if(auth()->user()->hasRole('super admin')){
            return view("cms.task.endadmin",compact("title","subtitle","items","users","categories"));
        }
        return view("cms.task.endMyTask",compact("title","subtitle","items","users","categories"));
    }

    public function getEndTask()
    {
        $title="ادارة المهام";
        $subtitle="ادارة المهام المنتهية";
        $items=Task::where('isdelete',0)->paginate(10);
        $users=User::where('isdelete',0)->where('Status','مفعل')->get();
        $categories=Option::where('parent_id',149)->where('isdelete',0)->where('active',1)->get();
        if(auth()->user()->hasRole('super admin')){
            return view("cms.task.endadmin",compact("title","subtitle","items","users","categories"));
        }
        return view("cms.task.end",compact("title","subtitle","items","users","categories"));
    }

    public function getRepTask()
    {
        $title="ادارة المهام";
        $subtitle="تقيم المهام المنجزة";
        $users=User::where('isdelete',0)->where('Status','مفعل')->get();
        return view("cms.task.report",compact("title","subtitle","users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle="اضافة مهمة جديدة";
        $title="ادارة المهام";
        $linkApp="/CMS/Sender/Task/";
        $users=User::where('isdelete',0)->where('Status','مفعل')->get();
        $categories=Option::where('parent_id',149)->where('isdelete',0)->where('active',1)->get();
        return view("cms.task.add",compact("title","parentTitle","linkApp","users","categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,FlasherInterface $flasher)
    {
        // event(new App\Events\MakeTask("ttest"));

        $this->validate($request,
            [
                'receiver' => 'required',
                'title' => 'required',
                'category' => 'required',
                'details' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);
        $task = Task::create([
            'sender' => $this->getId(),
            'receiver' => $request->input("receiver"),
            'title' => $request->input("title"),
            'category' => $request->input("category"),
            'details' => $request->input("details"),
            'active' => $request->input("active")?1:0,
            'reminders_num' => 0,
            'evaluate' => $request->input("evaluate"),
            'notes' => $request->input("notes"),
            'created_by' => $this->getId()
        ]);

      /*   $user = User::where('id','=',$request->input("receiver"))->first();
       \Notification::send($user,new NewLessonNotification(Task::latest('id')->first()->id,Task::latest('id')->first()->sender,Task::latest('id')->first()->title));

        MakeTask::dispatch(Task::latest('id')->first()->receiver); */

      $flasher->addSuccess("تمت عملية الاضافة بنجاح");
      return redirect("/CMS/Task/create");

    }

    public function notification()
    {
        return auth()->user()->unreadNotifications;
    }

    public function markAsRead(Request $r)
    {
        auth()->user()->unreadNotifications->find($r->not_id)->markAsRead();
    }

    public function readLesson($lesson_id)
    {
        $lesson = Task::find([$lesson_id]);
        return view('cms.task.show',compact('lesson'));
    }

    public function allMarkAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
    }

    public function readAllLesson()
    {
        $parentTitle="عرض المهام ";
        $title="ادارة المهام";
        $linkApp="/CMS/Task/";
        $lessons = auth()->user()->readNotifications;
        return view("cms.task.showAll",compact("title","lessons","id","parentTitle","linkApp"));
    }

    /*public function readLesson()
    {
        return auth()->user()->unreadNotifications;
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $lessons = auth()->user()->readNotifications->take(5)->sortBy('created_at');
        return view('lesson',compact('lessons'));
    }

    public function readNotificationById($not_id,$lesson_id)
    {
        auth()->user()->unreadNotifications->find($not_id)->markAsRead();
        $lesson = Task::find($lesson_id);
        dump($lesson);
    }

    public function showLesson()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return auth()->user()->readNotifications;
    }*/

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id,FlasherInterface $flasher)
    {
        $parentTitle="عرض المهمة ";
        $item=Task::where("id",$id)->where("isdelete",0)->first();
        $users=User::where('isdelete',0)->where('Status','مفعل')->get();
        $title="ادارة المهام";
        $linkApp="/CMS/Task/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Sender/Task/");
        }
        $returnHTML =  view("cms.task.show",compact("title","item","id","users","parentTitle","linkApp"))->render();
            return response()->json(['html'=>$returnHTML]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FlasherInterface $flasher)
    {
        $parentTitle="تعديل المهام ";
        $item=Task::where("id",$id)->where("isdelete",0)->first();
        $users=User::where('isdelete',0)->where('Status','مفعل')->get();
        $categories=Option::where('parent_id',149)->where('isdelete',0)->where('active',1)->get();
        $title="ادارة المهام";
        $linkApp="/CMS/Task/";
        if($item==NULL){
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/Sender/Task/");
        }
        return view("cms.task.edit",compact("title","item","id","users","parentTitle","linkApp","categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'receiver' => 'required',
                'title' => 'required',
                'category' => 'required',
                'details' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Task::find($id);
        $item->receiver=$request->input("receiver");
        $item->title=$request->input("title");
        $item->category=$request->input("category");
        $item->details=$request->input("details");
        $item->start_date=$request->input("start_date");
        $item->end_date=$request->input("end_date");
        $item->active=$request->input("active")?1:0;
        $item->evaluate=$request->input("evaluate");
        $item->notes=$request->input("notes");
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/Sender/Task/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelete($id,FlasherInterface $flasher)
    {
        $item=Task::find($id);
        $item->isdelete=1;
        $item->deleted_by=$this->getId();
        $item->save();
        flash()->addError("تمت عملية الحذف بنجاح");
        return redirect("/CMS/Sender/Task/");
    }

    public function getRatio($id)
    {
        $title="ادارة المهام المنتهية";
        $subtitle="";
        $item=Task::find($id);
        $returnHTML =  view("cms.task.ratio",compact("title","subtitle","item"))->render();
        return response()->json(['html'=>$returnHTML]);
    }

    public function postRatio(Request $request,$id,FlasherInterface $flasher)
    {
        $this->validate($request,
            [
                'ratio' => 'required|numeric|min:1|max:100'
            ],
            [
                "ratio.min"=>"الرقم اقل من 1",
                "ratio.max"=>"الرقم اكبر من 100",
                "required"=>"يجب ادخال هذا الحقل"
            ]);

        $item=Task::find($id);
        $item->evaluate=$request->input("ratio");
        $item->updated_by=$this->getId();
        $item->save();

        $flasher->addSuccess("تمت عملية الحفظ بنجاح");
        return redirect("/CMS/End/Task/");
    }

    public function getStart($id)
    {
        $item=Task::find($id);
        $item->start_date=date("Y-m-d h:i");
        $item->save();
        $date = Task::where('id',$id)->first(['start_date']);
        $user = User::where('id','=',$item->receiver)->first();
        \Notification::send($user,new NewLessonNotification($item->id,$item->sender,$item->title));
         MakeTask::dispatch($item->receiver);
        return Response::json($date);
    }

    public function getEnd($id)
    {
        $item=Task::find($id);
        $item->end_date=date("Y-m-d h:i");
        $item->save();
        $date = Task::where('id',$id)->first(['end_date']);
        return Response::json($date);
    }
    public function getEndnotify(Request $request)
    {

        $item=Task::find($request->task_id);
        $item->end_date=date("Y-m-d h:i");
        $item->save();
        auth()->user()->unreadNotifications->find($request->notify_id)->markAsRead();
        return back();
    }
    public function getEndshow(Request $request)
    {
        $item=Task::find($request->task_id);
        $item->end_date=date("Y-m-d h:i");
        $item->save();
        return back();
    }
    public function reminderTask(Request $request)
    {
        $task_id=Task::find($request->task_id);
    
        Reminder_task::create([
            'task_id' => $task_id->id,
        ]);
        auth()->user()->unreadNotifications->find($request->notify_id)->delete();
        return back();
    }
}
