<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Box;
use App\Models\Task;
use App\Models\User;
use App\Models\Course;
use App\Models\English;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Campaign;
use App\Models\Employee;
use App\Models\Money_year;
use App\Models\Query_user;
use App\Models\Withdrawal;
use App\Models\Certificate;
use App\Models\English_reg;
use App\Models\Query_admin;
use App\Models\Query_money;
use App\Models\Receipt_box;
use Illuminate\Http\Request;
use App\Models\Catch_receipt;
use App\Models\Legal_affairs;
use App\Models\Query_teacher;
use App\Models\Repository_in;
use App\Models\Receipt_course;
use App\Models\Receipt_reward;
use App\Models\Receipt_salary;
use App\Models\Repository_out;
use App\Models\Student_course;
use App\Models\Box_year;
use App\Models\Receipt_advance;
use App\Models\Receipt_student;
use App\Models\Receipt_warranty;
use Yajra\DataTables\DataTables;
use App\Models\Catch_receipt_box;
use App\Http\Controllers\CMSBaseController;

class QueryRepController  extends CMSBaseController
{
    public function getUser()
    {
        $title="جديد 2019";
        $parentTitle=" متابعة اداء المستخدمين";
        $users=User::where('users.Status','=','مفعل')
            ->where('users.isdelete','=','0')->get();
        $statics=[
            'عدد تسجيل طلاب',
            'قيمة تحصيل رسوم',
            'عدد فحص المستوى',
            'عدد شهادات ذات الرسوم',
            'عدد المهام الجديدة',
            'عدد المهام المنجزة',
            'تقييم المهام المنجزة',
            'عدد المكافأت',
            'قيمة المكافأت',
            'عدد الخصومات',
            'قيمة الخصومات',
            'عدد حملات التسويق الهاتفي',
        ];
        $this->getAllUser();
        return view("cms.queriesRep.user",compact("title","parentTitle","statics","users"));
    }

    public function getAllUser()
    {
        $statics=[
            'عدد تسجيل طلاب',
            'قيمة تحصيل رسوم',
            'عدد فحص المستوى',
            'عدد شهادات ذات الرسوم',
            'عدد المهام الجديدة',
            'عدد المهام المنجزة',
            'تقييم المهام المنجزة',
            'عدد المكافأت',
            'قيمة المكافأت',
            'عدد الخصومات',
            'قيمة الخصومات',
            'عدد حملات التسويق الهاتفي',
        ];
        $users=User::all();
        foreach ($users as $user){
            $isQueryUser=Query_user::where('user_id',$user->id)->count();
            if($isQueryUser>0){
                $query_user_del=Query_user::truncate();
            }
            foreach ($statics as $static){
                $query_user= new Query_user();
                $query_user->user_id=$user->id;
                $query_user->subject=$static;
                if($static=="عدد تسجيل طلاب"){
                    $query_user->day1=Student_course::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(1))->count();
                    $query_user->day7=Student_course::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(7))->count();
                    $query_user->day15=Student_course::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(15))->count();
                    $query_user->day30=Student_course::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(30))->count();
                    $query_user->day60=Student_course::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(60))->count();
                    $query_user->day90=Student_course::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(90))->count();
                    $query_user->day180=Student_course::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(180))->count();
                    $query_user->last1=Student_course::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-1)->count();
                    $query_user->last2=Student_course::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-2)->count();
                    $query_user->last3=Student_course::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-3)->count();
                    $query_user->count=Student_course::where('created_by',$user->id)->whereYear('created_at', '=', date('Y'))->count();
                    $query_user->save();
                }
                elseif($static=="قيمة تحصيل رسوم"){
                    $query_user->day1=Catch_receipt::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(1))->sum('amount');
                    $query_user->day7=Catch_receipt::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(7))->sum('amount');
                    $query_user->day15=Catch_receipt::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(15))->sum('amount');
                    $query_user->day30=Catch_receipt::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(30))->sum('amount');
                    $query_user->day60=Catch_receipt::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(60))->sum('amount');
                    $query_user->day90=Catch_receipt::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(90))->sum('amount');
                    $query_user->day180=Catch_receipt::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(180))->sum('amount');
                    $query_user->last1=Catch_receipt::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-1)->sum('amount');
                    $query_user->last2=Catch_receipt::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-2)->sum('amount');
                    $query_user->last3=Catch_receipt::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-3)->sum('amount');
                    $query_user->count=Catch_receipt::where('created_by',$user->id)->whereYear('created_at', '=', date('Y'))->sum('amount');
                    $query_user->save();
                }
                elseif($static=="عدد فحص المستوى"){
                    $query_user->day1=English::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(1))->count();
                    $query_user->day7=English::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(7))->count();
                    $query_user->day15=English::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(15))->count();
                    $query_user->day30=English::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(30))->count();
                    $query_user->day60=English::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(60))->count();
                    $query_user->day90=English::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(90))->count();
                    $query_user->day180=English::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(180))->count();
                    $query_user->last1=English::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-1)->count();
                    $query_user->last2=English::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-2)->count();
                    $query_user->last3=English::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-3)->count();
                    $query_user->count=English::where('created_by',$user->id)->whereYear('created_at', '=', date('Y'))->count();
                    $query_user->save();
                }
                elseif($static=="عدد شهادات ذات الرسوم"){
                    $query_user->day1=Certificate::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(1))->count();
                    $query_user->day7=Certificate::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(7))->count();
                    $query_user->day15=Certificate::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(15))->count();
                    $query_user->day30=Certificate::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(30))->count();
                    $query_user->day60=Certificate::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(60))->count();
                    $query_user->day90=Certificate::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(90))->count();
                    $query_user->day180=Certificate::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(180))->count();
                    $query_user->last1=Certificate::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-1)->count();
                    $query_user->last2=Certificate::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-2)->count();
                    $query_user->last3=Certificate::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-3)->count();
                    $query_user->count=Certificate::where('created_by',$user->id)->whereYear('created_at', '=', date('Y'))->count();
                    $query_user->save();
                }
                elseif($static=="عدد المهام الجديدة"){
                    $query_user->day1=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(1))->where('end_date',null)->count();
                    $query_user->day7=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(7))->where('end_date',null)->count();
                    $query_user->day15=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(15))->where('end_date',null)->count();
                    $query_user->day30=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(30))->where('end_date',null)->count();
                    $query_user->day60=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(60))->where('end_date',null)->count();
                    $query_user->day90=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(90))->where('end_date',null)->count();
                    $query_user->day180=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(180))->where('end_date',null)->count();
                    $query_user->last1=Task::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-1)->where('end_date',null)->count();
                    $query_user->last2=Task::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-2)->where('end_date',null)->count();
                    $query_user->last3=Task::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-3)->where('end_date',null)->count();
                    $query_user->count=Task::where('created_by',$user->id)->whereYear('created_at', '=', date('Y'))->where('end_date',null)->count();
                    $query_user->save();
                }
                elseif($static=="عدد المهام المنجزة"){
                    $query_user->day1=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(1))->where('end_date','!=',null)->count();
                    $query_user->day7=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(7))->where('end_date','!=',null)->count();
                    $query_user->day15=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(15))->where('end_date','!=',null)->count();
                    $query_user->day30=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(30))->where('end_date','!=',null)->count();
                    $query_user->day60=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(60))->where('end_date','!=',null)->count();
                    $query_user->day90=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(90))->where('end_date','!=',null)->count();
                    $query_user->day180=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(180))->where('end_date','!=',null)->count();
                    $query_user->last1=Task::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-1)->where('end_date','!=',null)->count();
                    $query_user->last2=Task::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-2)->where('end_date','!=',null)->count();
                    $query_user->last3=Task::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-3)->where('end_date','!=',null)->count();
                    $query_user->count=Task::where('created_by',$user->id)->whereYear('created_at', '=', date('Y'))->where('end_date','!=',null)->count();
                    $query_user->save();
                }
                elseif($static=="تقييم المهام المنجزة"){
                    $query_user->day1=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(1))->where('end_date','!=',null)->avg('evaluate');
                    $query_user->day7=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(7))->where('end_date','!=',null)->avg('evaluate');
                    $query_user->day15=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(15))->where('end_date','!=',null)->avg('evaluate');
                    $query_user->day30=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(30))->where('end_date','!=',null)->avg('evaluate');
                    $query_user->day60=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(60))->where('end_date','!=',null)->avg('evaluate');
                    $query_user->day90=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(90))->where('end_date','!=',null)->avg('evaluate');
                    $query_user->day180=Task::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(180))->where('end_date','!=',null)->avg('evaluate');
                    $query_user->last1=Task::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-1)->where('end_date','!=',null)->avg('evaluate');
                    $query_user->last2=Task::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-2)->where('end_date','!=',null)->avg('evaluate');
                    $query_user->last3=Task::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-3)->where('end_date','!=',null)->avg('evaluate');
                    $query_user->count=Task::where('created_by',$user->id)->whereYear('created_at', '=', date('Y'))->where('end_date','!=',null)->avg('evaluate');
                    $query_user->save();
                }
                elseif($static=="عدد المكافأت"){
                    $query_user->day1=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(1))->where('type',0)->count();
                    $query_user->day7=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(7))->where('type',0)->count();
                    $query_user->day15=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(15))->where('type',0)->count();
                    $query_user->day30=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(30))->where('type',0)->count();
                    $query_user->day60=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(60))->where('type',0)->count();
                    $query_user->day90=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(90))->where('type',0)->count();
                    $query_user->day180=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(180))->where('type',0)->count();
                    $query_user->last1=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-1)->where('type',0)->count();
                    $query_user->last2=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-2)->where('type',0)->count();
                    $query_user->last3=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-3)->where('type',0)->count();
                    $query_user->count=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y'))->where('type',0)->count();
                    $query_user->save();
                }
                elseif($static=="قيمة المكافأت"){
                    $query_user->day1=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(1))->where('type',0)->sum('amount');
                    $query_user->day7=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(7))->where('type',0)->sum('amount');
                    $query_user->day15=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(15))->where('type',0)->sum('amount');
                    $query_user->day30=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(30))->where('type',0)->sum('amount');
                    $query_user->day60=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(60))->where('type',0)->sum('amount');
                    $query_user->day90=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(90))->where('type',0)->sum('amount');
                    $query_user->day180=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(180))->where('type',0)->sum('amount');
                    $query_user->last1=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-1)->where('type',0)->sum('amount');
                    $query_user->last2=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-2)->where('type',0)->sum('amount');
                    $query_user->last3=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-3)->where('type',0)->sum('amount');
                    $query_user->count=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y'))->where('type',0)->sum('amount');
                    $query_user->save();
                }
                elseif($static=="عدد الخصومات"){
                    $query_user->day1=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(1))->where('type',1)->count();
                    $query_user->day7=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(7))->where('type',1)->count();
                    $query_user->day15=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(15))->where('type',1)->count();
                    $query_user->day30=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(30))->where('type',1)->count();
                    $query_user->day60=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(60))->where('type',1)->count();
                    $query_user->day90=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(90))->where('type',1)->count();
                    $query_user->day180=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(180))->where('type',1)->count();
                    $query_user->last1=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-1)->where('type',1)->count();
                    $query_user->last2=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-2)->where('type',1)->count();
                    $query_user->last3=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-3)->where('type',1)->count();
                    $query_user->count=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y'))->where('type',1)->count();
                    $query_user->save();
                }
                elseif($static=="قيمة الخصومات"){
                    $query_user->day1=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(1))->where('type',1)->sum('amount');
                    $query_user->day7=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(7))->where('type',1)->sum('amount');
                    $query_user->day15=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(15))->where('type',1)->sum('amount');
                    $query_user->day30=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(30))->where('type',1)->sum('amount');
                    $query_user->day60=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(60))->where('type',1)->sum('amount');
                    $query_user->day90=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(90))->where('type',1)->sum('amount');
                    $query_user->day180=Receipt_reward::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(180))->where('type',1)->sum('amount');
                    $query_user->last1=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-1)->where('type',1)->sum('amount');
                    $query_user->last2=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-2)->where('type',1)->sum('amount');
                    $query_user->last3=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-3)->where('type',1)->sum('amount');
                    $query_user->count=Receipt_reward::where('created_by',$user->id)->whereYear('created_at', '=', date('Y'))->where('type',1)->sum('amount');
                    $query_user->save();
                }
                elseif($static=="عدد حملات التسويق الهاتفي"){
                    $query_user->day1=Campaign::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(1))->count();
                    $query_user->day7=Campaign::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(7))->count();
                    $query_user->day15=Campaign::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(15))->count();
                    $query_user->day30=Campaign::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(30))->count();
                    $query_user->day60=Campaign::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(60))->count();
                    $query_user->day90=Campaign::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(90))->count();
                    $query_user->day180=Campaign::where('created_by',$user->id)->where('created_at','>',Carbon::now()->subDays(180))->count();
                    $query_user->last1=Campaign::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-1)->count();
                    $query_user->last2=Campaign::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-2)->count();
                    $query_user->last3=Campaign::where('created_by',$user->id)->whereYear('created_at', '=', date('Y')-3)->count();
                    $query_user->count=Campaign::where('created_by',$user->id)->whereYear('created_at', '=', date('Y'))->count();
                    $query_user->save();
                }
                $query_user->save();
            }
        }
    }

    public function getMoney()
    {
        $subtitle="احصائيات الوضع المالي";
        $title="جديد 2019";
        $this->getAllMoney();
        // $years=Money_year::where('isdelete',0)->where('basic_work',0)->orderBy('year','desc')->get();
        $years=Money_year::where('isdelete',0)->orderBy('year','desc')->get();
        return view("cms.queriesRep.money",compact("title","subtitle","years"));
    }

    public function anyQueryMoney(Request $request)
    {
        // $years=Money_year::where('isdelete',0)->where('basic_work',0)->orderBy('year','desc')->get();
        $years=Money_year::where('isdelete',0)->orderBy('year','desc')->get();
        $tasks =Box::leftJoin('box_year', 'boxes.id','=','box_year.box_id')->select([ 'boxes.id','boxes.type','boxes.parent_id', 'boxes.m_year', 'boxes.name', 'box_year.calculator_first', 'boxes.isdelete','boxes.repository_id'])
            ->where('boxes.isdelete','=','0')
            ->groupBy("boxes.id");
        $result= Datatables::of($tasks);
        $yearcols=['7'=>'7days','15'=>'15days','30'=>'1month','60'=>'2month','90'=>'3month','180'=>'6month'];
        $result->addColumn('day1', function ($tasks) {
                    if($tasks->id==1){
                        $boxes=Box::whereNotNull('parent_id')->get();
                        $expenses=0;
                        $incomes=0;
                        foreach($boxes as $box){
                            if($box->id==3){
                            $courses_receipt = Catch_receipt::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');

                            $incomes+=$courses_receipt;
                             $teacher_salaries = Receipt_course::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');
                            $receipt_students = Receipt_student::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');

                            $expenses +=$teacher_salaries + $receipt_students;

                        }
                        else if($box->id==4){
                            $advance_receipt = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('advance_payment');
                            $incomes+=$advance_receipt;
                             $salaries = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');
                            $warranties = Receipt_warranty::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');
                            $advances = Receipt_advance::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('advance_payment');
                            $expenses+=$salaries+$warranties+$advances;
                        }
                        else if($box->repository_id >0){
                            $incomes+= Repository_in::where('repository_id','=',$box->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('total');

                             $expenses+= Repository_out::where('repository_id','=',$box->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('total');

                        }
                        else if($box->type=="147"){
                            $incomes+= Catch_receipt_box::where('box_id','=',$box->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');
                             $expenses+= Receipt_box::where('box_id','=',$box->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');


                        }
                        }
                        return number_format($incomes-$expenses,2);
                    }
                    if($tasks->id==2){
                        $boxes=Box::where('parent_id',2)->get();
                        $expenses=0;
                        $incomes=0;
                        foreach($boxes as $box){
                            if($box->id==3){
                            $courses_receipt = Catch_receipt::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');

                            $incomes+=$courses_receipt;
                             $teacher_salaries = Receipt_course::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');
                            $receipt_students = Receipt_student::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');

                            $expenses +=$teacher_salaries + $receipt_students;

                        }
                        else if($box->id==4){
                            $advance_receipt = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('advance_payment');
                            $incomes+=$advance_receipt;
                             $salaries = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');
                            $warranties = Receipt_warranty::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');
                            $advances = Receipt_advance::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('advance_payment');
                            $expenses+=$salaries+$warranties+$advances;
                        }
                        else if($box->repository_id >0){
                            $incomes+= Repository_in::where('repository_id','=',$box->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('total');

                             $expenses+= Repository_out::where('repository_id','=',$box->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('total');

                        }
                        else if($box->type=="147"){
                            $incomes+= Catch_receipt_box::where('box_id','=',$box->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');
                             $expenses+= Receipt_box::where('box_id','=',$box->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');


                        }
                        }
                        return number_format($incomes-$expenses,2);
                    }

                if($tasks->id==3){
                    $courses_receipt = Catch_receipt::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');

                    $tasks->income=$courses_receipt;
                     $teacher_salaries = Receipt_course::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');
                    $receipt_students = Receipt_student::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');

                    $tasks->expense=$teacher_salaries + $receipt_students;

                }
                if($tasks->id==4){
                    $advance_receipt = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('advance_payment');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->update(array('income' => $advance_receipt));
                    $tasks->income=$advance_receipt;
                     $salaries = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');
                    $warranties = Receipt_warranty::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');
                    $advances = Receipt_advance::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('advance_payment');
                    $tasks->expense=$salaries+$warranties+$advances;
                }
                if($tasks->repository_id >0){
                    $tasks->income = Repository_in::where('repository_id','=',$tasks->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('total');

                     $tasks->expense= Repository_out::where('repository_id','=',$tasks->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('total');

                }
                if($tasks->type=="147"){
                    $tasks->income= Catch_receipt_box::where('box_id','=',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');
                     $tasks->expense= Receipt_box::where('box_id','=',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->whereDate('created_at', Carbon::today())->sum('amount');


                }
               $tot=$tasks->income-$tasks->expense;
                return number_format($tot,2);

            });
        foreach($yearcols as $key=>$value){
            $result->addColumn('day'.$key, function ($tasks) use($value,$key) {
                if($tasks->id==1){
                $boxes=Box::whereNotNull('parent_id')->get();
                $expenses=0;
                $incomes=0;
                foreach($boxes as $box){
                    if($box->id==3){
                    $courses_receipt = Catch_receipt::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');

                    $incomes+=$courses_receipt;
                     $teacher_salaries = Receipt_course::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');
                    $receipt_students = Receipt_student::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');

                    $expenses +=$teacher_salaries + $receipt_students;

                }
                else if($box->id==4){
                    $advance_receipt = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('advance_payment');
                    $incomes+=$advance_receipt;
                     $salaries = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');
                    $warranties = Receipt_warranty::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');
                    $advances = Receipt_advance::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('advance_payment');
                    $expenses+=$salaries+$warranties+$advances;
                }
                else if($box->repository_id >0){
                    $incomes+= Repository_in::where('repository_id','=',$box->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('total');

                     $expenses+= Repository_out::where('repository_id','=',$box->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('total');

                }
                else if($box->type=="147"){
                    $incomes+= Catch_receipt_box::where('box_id','=',$box->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');
                     $expenses+= Receipt_box::where('box_id','=',$box->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');


                }
                }
                return number_format($incomes-$expenses,2);
            }
              if($tasks->id==2){
                $boxes=Box::where('parent_id',2)->get();
                $expenses=0;
                $incomes=0;
                foreach($boxes as $box){
                    if($box->id==3){
                    $courses_receipt = Catch_receipt::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');

                    $incomes+=$courses_receipt;
                     $teacher_salaries = Receipt_course::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');
                    $receipt_students = Receipt_student::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');

                    $expenses +=$teacher_salaries + $receipt_students;

                }
                else if($box->id==4){
                    $advance_receipt = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('advance_payment');
                    $incomes+=$advance_receipt;
                     $salaries = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');
                    $warranties = Receipt_warranty::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');
                    $advances = Receipt_advance::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('advance_payment');
                    $expenses+=$salaries+$warranties+$advances;
                }
                else if($box->repository_id >0){
                    $incomes+= Repository_in::where('repository_id','=',$box->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('total');

                     $expenses+= Repository_out::where('repository_id','=',$box->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('total');

                }
                else if($box->type=="147"){
                    $incomes+= Catch_receipt_box::where('box_id','=',$box->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');
                     $expenses+= Receipt_box::where('box_id','=',$box->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');


                }
                }
                return number_format($incomes-$expenses,2);
            }
                if($tasks->id==3){
                    $courses_receipt = Catch_receipt::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');

                    $tasks->income=$courses_receipt;
                     $teacher_salaries = Receipt_course::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');
                    $receipt_students = Receipt_student::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');

                    $tasks->expense=$teacher_salaries + $receipt_students;

                }
                if($tasks->id==4){
                    $advance_receipt = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('advance_payment');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->update(array('income' => $advance_receipt));
                    $tasks->income=$advance_receipt;
                     $salaries = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');
                    $warranties = Receipt_warranty::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');
                    $advances = Receipt_advance::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('advance_payment');
                    $tasks->expense=$salaries+$warranties+$advances;
                }
                if($tasks->repository_id >0){
                    $tasks->income = Repository_in::where('repository_id','=',$tasks->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('total');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->update(array('income' => $tasks->income));
                     $tasks->expense= Repository_out::where('repository_id','=',$tasks->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('total');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->update(array('income' => $tasks->income));
                }
                if($tasks->type=="147"){
                    $tasks->income= Catch_receipt_box::where('box_id','=',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');
                     $tasks->expense= Receipt_box::where('box_id','=',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->sum('amount');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->where('created_at','>',Carbon::now()->subDays($key))->update(array('income' => $tasks->income));

                }
               $tot=$tasks->income-$tasks->expense;
                return number_format($tot,2);

            });

      }

      foreach($years as $year){
                $result->addColumn('total'.$year->year, function ($tasks) use($year) {
                if($tasks->id==1){
                    $boxes=Box::whereNotNull('parent_id')->get();
                    $expenses=0;
                    $incomes=0;
                    foreach($boxes as $box){
                        if($box->id==3){
                        $courses_receipt = Catch_receipt::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');

                        $incomes+=$courses_receipt;
                         $teacher_salaries = Receipt_course::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');
                        $receipt_students = Receipt_student::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');

                        $expenses+=$teacher_salaries + $receipt_students;

                    }
                    if($box->id==4){
                        $advance_receipt = Receipt_salary::where('isdelete','=','0')->where('m_year',$year->year)->sum('advance_payment');

                        $incomes+=$advance_receipt;
                         $salaries = Receipt_salary::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');
                        $warranties = Receipt_warranty::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');
                        $advances = Receipt_advance::where('isdelete','=','0')->where('m_year',$year->year)->sum('advance_payment');
                        $expenses+=$salaries+$warranties+$advances;
                    }
                    if($box->repository_id >0){
                        $incomes+= Repository_in::where('repository_id','=',$box->repository_id)->where('isdelete','=','0')->where('m_year',$year->year)->sum('total');

                         $expenses+= Repository_out::where('repository_id','=',$box->repository_id)->where('isdelete','=','0')->where('m_year',$year->year)->sum('total');

                    }
                    if($box->type=="147"){
                        $incomes+= Catch_receipt_box::where('box_id','=',$box->id)->where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');
                         $expenses+= Receipt_box::where('box_id','=',$box->id)->where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');

                    }
                }
                    $tasks->income=$incomes;
                    $tasks->expense=$expenses;
                }
                if($tasks->id==2){
                    $boxes=Box::where('parent_id',2)->get();
                    $expenses=0;
                    $incomes=0;
                    foreach($boxes as $box){
                        if($box->id==3){
                        $courses_receipt = Catch_receipt::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');

                        $incomes+=$courses_receipt;
                         $teacher_salaries = Receipt_course::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');
                        $receipt_students = Receipt_student::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');

                        $expenses+=$teacher_salaries + $receipt_students;

                    }
                    if($box->id==4){
                        $advance_receipt = Receipt_salary::where('isdelete','=','0')->where('m_year',$year->year)->sum('advance_payment');

                        $incomes+=$advance_receipt;
                         $salaries = Receipt_salary::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');
                        $warranties = Receipt_warranty::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');
                        $advances = Receipt_advance::where('isdelete','=','0')->where('m_year',$year->year)->sum('advance_payment');
                        $expenses+=$salaries+$warranties+$advances;
                    }
                    if($box->repository_id >0){
                        $incomes+= Repository_in::where('repository_id','=',$box->repository_id)->where('isdelete','=','0')->where('m_year',$year->year)->sum('total');

                         $expenses+= Repository_out::where('repository_id','=',$box->repository_id)->where('isdelete','=','0')->where('m_year',$year->year)->sum('total');

                    }
                    if($box->type=="147"){
                        $incomes+= Catch_receipt_box::where('box_id','=',$box->id)->where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');
                         $expenses+= Receipt_box::where('box_id','=',$box->id)->where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');

                    }
                }
                    $tasks->income=$incomes;
                    $tasks->expense=$expenses;
                }

                if($tasks->id==3){
                    $courses_receipt = Catch_receipt::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');

                    $tasks->income=$courses_receipt;
                     $teacher_salaries = Receipt_course::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');
                    $receipt_students = Receipt_student::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');

                    $tasks->expense=$teacher_salaries + $receipt_students;

                }
                if($tasks->id==4){
                    $advance_receipt = Receipt_salary::where('isdelete','=','0')->where('m_year',$year->year)->sum('advance_payment');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$year->year)->update(array('income' => $advance_receipt));
                    $tasks->income=$advance_receipt;
                     $salaries = Receipt_salary::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');
                    $warranties = Receipt_warranty::where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');
                    $advances = Receipt_advance::where('isdelete','=','0')->where('m_year',$year->year)->sum('advance_payment');
                    $tasks->expense=$salaries+$warranties+$advances;
                }
                if($tasks->repository_id >0){
                    $tasks->income = Repository_in::where('repository_id','=',$tasks->repository_id)->where('isdelete','=','0')->where('m_year',$year->year)->sum('total');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$year->year)->update(array('income' => $tasks->income));
                     $tasks->expense= Repository_out::where('repository_id','=',$tasks->repository_id)->where('isdelete','=','0')->where('m_year',$year->year)->sum('total');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$year->year)->update(array('income' => $tasks->income));
                }
                if($tasks->type=="147"){
                    $tasks->income= Catch_receipt_box::where('box_id','=',$tasks->id)->where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');
                     $tasks->expense= Receipt_box::where('box_id','=',$tasks->id)->where('isdelete','=','0')->where('m_year',$year->year)->sum('amount');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$year->year)->update(array('income' => $tasks->income));

                }
               $tot=$tasks->income-$tasks->expense;
               if($tasks->id ==1){
                    $money_year = Money_year::where('year',$this->getMoneyYear())->first();
                    if($money_year->first_time_balance !=0){
                    $calc= $tasks->calculator_first = $money_year->first_time_balance + $tasks->calculator_first;
                    }else{
                $calc= $tasks->calculator_first;
                }
                }else{
                $calc= $tasks->calculator_first;
                }

                return number_format($tot+$calc,2);

            });

      }

           return $result->make(true);
    }

    public function getAllMoney()
    {
        $isQueryMoney=Query_money::count();
        if($isQueryMoney>0){
            $query_money_del=Query_money::truncate();
        }
        $boxs=Box::where('isdelete',0)->get();
        foreach ($boxs as $box){
            $query_money= new Query_money();
            $query_money->box_id=$box->id;
            $query_money->day1=Box_year::where('box_id',$box->id)->where('created_at','>',Carbon::now()->subDays(1))->sum('total');
            $query_money->day7=Box_year::where('box_id',$box->id)->where('created_at','>',Carbon::now()->subDays(7))->sum('total');
            $query_money->day15=Box_year::where('box_id',$box->id)->where('created_at','>',Carbon::now()->subDays(15))->sum('total');
            $query_money->day30=Box_year::where('box_id',$box->id)->where('created_at','>',Carbon::now()->subDays(30))->sum('total');
            $query_money->day60=Box_year::where('box_id',$box->id)->where('created_at','>',Carbon::now()->subDays(60))->sum('total');
            $query_money->day90=Box_year::where('box_id',$box->id)->where('created_at','>',Carbon::now()->subDays(90))->sum('total');
            $query_money->day180=Box_year::where('box_id',$box->id)->where('created_at','>',Carbon::now()->subDays(180))->sum('total');
            $query_money->last1=Box_year::where('box_id',$box->id)->whereYear('created_at', '=', date('Y')-1)->sum('total');
            $query_money->last2=Box_year::where('box_id',$box->id)->whereYear('created_at', '=', date('Y')-2)->sum('total');
            $query_money->last3=Box_year::where('box_id',$box->id)->whereYear('created_at', '=', date('Y')-3)->sum('total');
            $query_money->count=Box_year::where('box_id',$box->id)->whereYear('created_at', '=', date('Y'))->sum('total');
            $query_money->save();
        }
    }

    public function getAdmin()
    {
        $subtitle="احصائيات الوضع الاداري";
        $title="جديد 2019";
        $this->getAllAdmin();
        return view("cms.queriesRep.admin",compact("title","subtitle"));
    }

    public function getAllAdmin()
    {
        $statics=[
            'عدد تسجيل الدورات',
            'عدد حركات الانسحاب',
            'عدد حركات المخالصات',
            'عدد الدورات الدراسية المفتوحة',
            'عدد التحويل للقسم القانوني',
            'عدد فحص المستوي',
            'عدد تسجيل دورات محادثة',
            'عدد بيانات الطلاب',
            'عدد الطلاب VIP',
            'عدد الطلاب Blist',
            'عدد حملات التسويق',
            'عدد الشهادات المصدقة',
            'عدد الشهادات المشاركة',
            'عدد الشهادات التقدير',
            'عدد الشهادات الدولية',
            'عدد الشهادات القديمة',
            'عدد الشهادات الكلي',
            'عدد بيانات الموظفين',
            'عدد بيانات المعلمين',
        ];
        $isQueryAdmin=Query_admin::count();
        if($isQueryAdmin>0){
            $query_admin_del=Query_admin::truncate();
        }
        foreach ($statics as $static){
            $query_user= new Query_admin();
            $query_user->subject=$static;
            if($static=="عدد تسجيل الدورات"){
                $query_user->day1=Student_course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Student_course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Student_course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Student_course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Student_course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Student_course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Student_course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Student_course::where('isdelete',0)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Student_course::where('isdelete',0)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Student_course::where('isdelete',0)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Student_course::where('isdelete',0)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد حركات الانسحاب"){
                $query_user->day1=Withdrawal::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Withdrawal::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Withdrawal::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Withdrawal::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Withdrawal::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Withdrawal::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Withdrawal::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Withdrawal::where('isdelete',0)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Withdrawal::where('isdelete',0)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Withdrawal::where('isdelete',0)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Withdrawal::where('isdelete',0)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد حركات المخالصات"){
                $query_user->day1=Receipt_student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Receipt_student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Receipt_student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Receipt_student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Receipt_student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Receipt_student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Receipt_student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Receipt_student::where('isdelete',0)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Receipt_student::where('isdelete',0)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Receipt_student::where('isdelete',0)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Receipt_student::where('isdelete',0)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد الدورات الدراسية المفتوحة"){
                $query_user->day1=Course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Course::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Course::where('isdelete',0)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Course::where('isdelete',0)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Course::where('isdelete',0)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Course::where('isdelete',0)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد التحويل للقسم القانوني"){
                $query_user->day1=Legal_affairs::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Legal_affairs::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Legal_affairs::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Legal_affairs::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Legal_affairs::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Legal_affairs::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Legal_affairs::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Legal_affairs::where('isdelete',0)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Legal_affairs::where('isdelete',0)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Legal_affairs::where('isdelete',0)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Legal_affairs::where('isdelete',0)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد فحص المستوي"){
                $query_user->day1=English::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=English::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=English::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=English::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=English::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=English::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=English::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=English::where('isdelete',0)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=English::where('isdelete',0)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=English::where('isdelete',0)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=English::where('isdelete',0)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد تسجيل دورات محادثة"){
                $query_user->day1=English_reg::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=English_reg::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=English_reg::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=English_reg::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=English_reg::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=English_reg::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=English_reg::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=English_reg::where('isdelete',0)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=English_reg::where('isdelete',0)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=English_reg::where('isdelete',0)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=English_reg::where('isdelete',0)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد بيانات الطلاب"){
                $query_user->day1=Student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Student::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Student::where('isdelete',0)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Student::where('isdelete',0)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Student::where('isdelete',0)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Student::where('isdelete',0)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد الطلاب VIP"){
                $query_user->day1=Student::where('isdelete',0)->where('classification',44)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Student::where('isdelete',0)->where('classification',44)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Student::where('isdelete',0)->where('classification',44)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Student::where('isdelete',0)->where('classification',44)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Student::where('isdelete',0)->where('classification',44)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Student::where('isdelete',0)->where('classification',44)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Student::where('isdelete',0)->where('classification',44)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Student::where('isdelete',0)->where('classification',44)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Student::where('isdelete',0)->where('classification',44)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Student::where('isdelete',0)->where('classification',44)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Student::where('isdelete',0)->where('classification',44)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد الطلاب Blist"){
                $query_user->day1=Student::where('isdelete',0)->where('classification',45)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Student::where('isdelete',0)->where('classification',45)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Student::where('isdelete',0)->where('classification',45)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Student::where('isdelete',0)->where('classification',45)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Student::where('isdelete',0)->where('classification',45)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Student::where('isdelete',0)->where('classification',45)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Student::where('isdelete',0)->where('classification',45)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Student::where('isdelete',0)->where('classification',45)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Student::where('isdelete',0)->where('classification',45)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Student::where('isdelete',0)->where('classification',45)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Student::where('isdelete',0)->where('classification',45)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد حملات التسويق"){
                $query_user->day1=Campaign::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Campaign::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Campaign::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Campaign::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Campaign::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Campaign::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Campaign::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Campaign::where('isdelete',0)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Campaign::where('isdelete',0)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Campaign::where('isdelete',0)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Campaign::where('isdelete',0)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد الشهادات المصدقة"){
                $query_user->day1=Certificate::where('isdelete',0)->where('type',84)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Certificate::where('isdelete',0)->where('type',84)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Certificate::where('isdelete',0)->where('type',84)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Certificate::where('isdelete',0)->where('type',84)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Certificate::where('isdelete',0)->where('type',84)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Certificate::where('isdelete',0)->where('type',84)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Certificate::where('isdelete',0)->where('type',84)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Certificate::where('isdelete',0)->where('type',84)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Certificate::where('isdelete',0)->where('type',84)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Certificate::where('isdelete',0)->where('type',84)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Certificate::where('isdelete',0)->where('type',84)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد الشهادات المشاركة"){
                $query_user->day1=Certificate::where('isdelete',0)->where('type',85)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Certificate::where('isdelete',0)->where('type',85)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Certificate::where('isdelete',0)->where('type',85)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Certificate::where('isdelete',0)->where('type',85)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Certificate::where('isdelete',0)->where('type',85)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Certificate::where('isdelete',0)->where('type',85)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Certificate::where('isdelete',0)->where('type',85)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Certificate::where('isdelete',0)->where('type',85)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Certificate::where('isdelete',0)->where('type',85)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Certificate::where('isdelete',0)->where('type',85)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Certificate::where('isdelete',0)->where('type',85)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد الشهادات التقدير"){
                $query_user->day1=Certificate::where('isdelete',0)->where('type',87)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Certificate::where('isdelete',0)->where('type',87)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Certificate::where('isdelete',0)->where('type',87)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Certificate::where('isdelete',0)->where('type',87)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Certificate::where('isdelete',0)->where('type',87)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Certificate::where('isdelete',0)->where('type',87)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Certificate::where('isdelete',0)->where('type',87)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Certificate::where('isdelete',0)->where('type',87)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Certificate::where('isdelete',0)->where('type',87)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Certificate::where('isdelete',0)->where('type',87)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Certificate::where('isdelete',0)->where('type',87)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد الشهادات الدولية"){
                $query_user->day1=Certificate::where('isdelete',0)->where('type',86)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Certificate::where('isdelete',0)->where('type',86)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Certificate::where('isdelete',0)->where('type',86)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Certificate::where('isdelete',0)->where('type',86)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Certificate::where('isdelete',0)->where('type',86)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Certificate::where('isdelete',0)->where('type',86)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Certificate::where('isdelete',0)->where('type',86)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Certificate::where('isdelete',0)->where('type',86)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Certificate::where('isdelete',0)->where('type',86)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Certificate::where('isdelete',0)->where('type',86)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Certificate::where('isdelete',0)->where('type',86)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد الشهادات القديمة"){
                $query_user->day1=Certificate::where('isdelete',0)->where('type',88)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Certificate::where('isdelete',0)->where('type',88)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Certificate::where('isdelete',0)->where('type',88)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Certificate::where('isdelete',0)->where('type',88)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Certificate::where('isdelete',0)->where('type',88)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Certificate::where('isdelete',0)->where('type',88)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Certificate::where('isdelete',0)->where('type',88)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Certificate::where('isdelete',0)->where('type',88)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Certificate::where('isdelete',0)->where('type',88)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Certificate::where('isdelete',0)->where('type',88)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Certificate::where('isdelete',0)->where('type',88)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد الشهادات الكلي"){
                $query_user->day1=Certificate::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Certificate::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Certificate::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Certificate::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Certificate::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Certificate::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Certificate::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Certificate::where('isdelete',0)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Certificate::where('isdelete',0)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Certificate::where('isdelete',0)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Certificate::where('isdelete',0)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد بيانات الموظفين"){
                $query_user->day1=Employee::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Employee::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Employee::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Employee::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Employee::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Employee::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Employee::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Employee::where('isdelete',0)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Employee::where('isdelete',0)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Employee::where('isdelete',0)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Employee::where('isdelete',0)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
            elseif($static=="عدد بيانات المعلمين"){
                $query_user->day1=Teacher::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(1))->count();
                $query_user->day7=Teacher::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(7))->count();
                $query_user->day15=Teacher::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(15))->count();
                $query_user->day30=Teacher::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(30))->count();
                $query_user->day60=Teacher::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(60))->count();
                $query_user->day90=Teacher::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(90))->count();
                $query_user->day180=Teacher::where('isdelete',0)->where('created_at','>',Carbon::now()->subDays(180))->count();
                $query_user->last1=Teacher::where('isdelete',0)->whereYear('created_at', '=', date('Y')-1)->count();
                $query_user->last2=Teacher::where('isdelete',0)->whereYear('created_at', '=', date('Y')-2)->count();
                $query_user->last3=Teacher::where('isdelete',0)->whereYear('created_at', '=', date('Y')-3)->count();
                $query_user->count=Teacher::where('isdelete',0)->whereYear('created_at', '=', date('Y'))->count();
                $query_user->save();
            }
        }
    }

    public function anyQueryAdmin(Request $request)
    {
        $tasks = Query_admin::select([ 'query_admin.id','query_admin.subject','query_admin.count','query_admin.day1','query_admin.day7','query_admin.day15','query_admin.day30','query_admin.day60','query_admin.day90','query_admin.day180','query_admin.last1','query_admin.last2','query_admin.last3']);
        return Datatables::of($tasks)
            ->make(true);
    }

    public function getTeacher()
    {
        $title="استعلام اداء المعلمين";
        $parentTitle="استعلام اداء المعلمين";
        $teachers=Teacher::where('isdelete',0)->get();
        $years=Money_year::where('isdelete',0)->orderBy('year','asc')->get();
        //$this->getAllTeacher();
        return view("cms.queriesRep.teacher",compact("title","parentTitle","teachers","years"));
    }

    public function anyQueryTeacher(Request $request)
    {
        $tasks = Course::leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->select([ 'courses.id','courses.m_year', 'teachers.name as teacher_id','courses.courseAR','courses.total_reg_student','courses.total_withdrawn_student','courses.ratio','courses.ratio_notes'])
            ->where('courses.isdelete',0);
        return Datatables::of($tasks)
            ->editColumn('ratio', function ($tasks) {
                return $tasks->ratio . ' %';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCourse') and $request->get('searchCourse') != "") {
                    $tasks->where('courses.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('teachers.name', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_withdrawn_student', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.ratio', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.ratio_notes', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_reg_student', 'like', "%{$request->get('searchCourse')}%");
                        });
                }
                if ($request->has('teacherId') and $request->get('teacherId') != "") {
                    $tasks->where('teachers.id','=',"{$request->get('teacherId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('courses.m_year','=',"{$request->get('moneyId')}");
                }
                if ($request->has('yearId') and $request->get('yearId') != "") {
                    $tasks->where('courses.m_year','=',"{$request->get('yearId')}");
                }
            })->with(['all_registered'=>function($tasks){
                return $tasks->sum('courses.total_reg_student');
            },'all_withdrawn'=>function($tasks){
                return $tasks->sum('courses.total_withdrawn_student');
            },'all_graduate'=>function($tasks){
                return $tasks->sum('courses.total_reg_student')-$tasks->sum('courses.total_withdrawn_student');
            },'ratios'=>function($tasks){
                $summ= $tasks->sum('courses.ratio');
                $cou = $tasks->count('courses.id');
                return number_format($summ/$cou,'1')."%";
            }])
            ->make(true);
    }


}
