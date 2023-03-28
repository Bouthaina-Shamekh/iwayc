<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Box;
use DemeterChain\C;
use App\Models\Task;
use App\Models\User;
use App\Models\Offer;
use App\Models\Quota;
use App\Models\BoxPer;
use App\Models\Course;
use App\Models\Option;
use App\Models\Salary;
use App\Models\Absence;
use App\Models\Archive;
use App\Models\English;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Box_year;
use App\Models\Campaign;
use App\Models\Employee;
use App\Models\Level_up;
use App\Models\Material;
use App\Models\Quantity;
use App\Models\Absence_s;
use App\Models\Absence_t;
use App\Models\Level_eng;
use App\Models\User_year;
use App\Models\Box_income;
use App\Models\Income_box;
use App\Models\Money_year;
use App\Models\Query_user;
use App\Models\Repository;
use App\Models\Withdrawal;
use App\Models\Box_expense;
use App\Models\Certificate;
use App\Models\Count_claim;
use App\Models\English_reg;
use App\Models\English_sal;
use App\Models\Receipt_box;
use App\Models\Record_done;
use App\Models\Rep_section;
use App\Models\Student_year;
use App\Models\Teacher_year;
use Illuminate\Http\Request;
use App\Models\Catch_receipt;
use App\Models\Count_warning;
use App\Models\Http\Requests;
use App\Models\Income_levels;
use App\Models\Legal_affairs;
use App\Models\Rep_inventory;
use App\Models\Repository_in;
use App\Models\Inventory_repo;
use App\Models\Receipt_course;
use App\Models\Receipt_reward;
use App\Models\Receipt_salary;
use App\Models\Rep_inv_record;
use App\Models\Repository_out;
use App\Models\Student_course;
use App\Models\Approval_record;
use App\Models\Collection_fees;
use App\Models\Receipt_advance;
use App\Models\Receipt_student;
use App\Models\Repository_year;
use App\Models\Campaign_student;
use App\Models\Receipt_warranty;
use Yajra\DataTables\DataTables;
use App\Models\Catch_receipt_box;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\CMSBaseController;

class ActiveMethodController  extends CMSBaseController
{
    function getActiveMoney($id){
        $item=Money_year::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }
    function getActiveIncomeLevel($id){
        Income_levels::query()->update(['active' => 0]);
        $item=Income_levels::find($id);
        $item->active=1;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getWorkMoney($id){
        Money_year::query()->update(['basic_work' => 0]);
        $item=Money_year::find($id);
        $item->basic_work=1;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getActiveTeacher($id){
        $item=Teacher::find($id);
        $teacher_year=Teacher_year::where('teacher_id',$item->id)->where('m_year',$this->getMoneyYear())->first();
        $teacher_year->active=1-$teacher_year->active;
        $teacher_year->updated_by=$this->getId();
        $teacher_year->save();
        return response()->json(['status' => '1']);
    }

    function getActiveEmployee($id){
        $item=Employee::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getSmokeEmployee($id){
        $item=Employee::find($id);
        $item->smoke=1-$item->smoke;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getActiveBox($id){
        $item=Box::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getActiveCourse($id){
        $item=Course::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getActiveCollectionFees($id){
        $item=Collection_fees::find($id);
        $item->warranty=1-$item->warranty;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getActiveLegalAffairs($id){
        $item=Legal_affairs::find($id);
        $item->warranty=1-$item->warranty;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getActiveOffer($id){
        $item=Offer::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getActiveCampaign($id){
        $item=Campaign::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getActiveEnglish($id){
        $item=English::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getActiveMaterial($id){
        $item=Material::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getActiveRepository($id){
        $item=Repository::find($id);
        $isRep=Repository_year::where('repository_id',$item->id)->where('m_year',$this->getMoneyYear())->count();
        if ($isRep>0){
            $repository_year=Repository_year::where('repository_id',$item->id)->where('m_year',$this->getMoneyYear())->first();
            $repository_year->active=1-$repository_year->active;
            $repository_year->updated_by=$this->getId();
            $repository_year->save();
        }
        return response()->json(['status' => '1']);
    }

    function getActiveRepositoryIn($id){
        $item=Repository_in::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getActiveRepositoryOut($id){
        $item=Repository_out::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getActiveStudent($id){
        $item=Student::find($id);

        $isStudent_year=Student_year::where('student_id',$item->id)->where('m_year',$this->getMoneyYear())->count();
        if ($isStudent_year>0){
            $student_year=Student_year::where('student_id',$item->id)->where('m_year',$this->getMoneyYear())->first();
            $student_year->active=1-$student_year->active;
            $student_year->updated_by= $this->getId();
            $student_year->save();


            $item=Student::find($id);
            $item->active=0;
            $item->save();
        }else{
            $student_year= new Student_year();
            $student_year->student_id=$item->id;
            $student_year->m_year=$this->getMoneyYear();
            $student_year->active=1;
            $student_year->created_by= $this->getId();
            $student_year->save();

            $item=Student::find($id);
            $item->active=1;
            $item->save();
        }


        return response()->json(['status' => '1']);
    }

    function getActiveTask($id){
        $item=Task::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getActiveArchive($id){
        $item=Archive::find($id);
        $item->active=1-$item->active;
        $item->updated_by=$this->getId();
        $item->save();
        return response()->json(['status' => '1']);
    }

    function getPrintCertificate($id,$opt){
        $item=Certificate::find($id);
        $item->print_execute=$opt;
        if($opt==1){
        $item->release_date=date("Y-m-d h:i:s");
        }
        $item->save();
        return response()->json(['status' => '1','date' =>$item->release_date]);
    }

    function getResEnglishSal($id,$opt){
        $item=English_sal::find($id);
        $item->resolution=$opt;
        $item->save();
        return response()->json(['status' => '1']);
    }

    // function getInAbsence($id){
    //     $item=Absence::find($id);
    //     $item->hour_in=date("Y-m-d h:i:s");
    //     $item->save();
    //     $date = Absence::where('id',$id)->first(['hour_in']);
    //     return Response::json($date);
    // }

    function getInAbsence($id){
        $item=Absence::find($id);
        $item->hour_in=date("Y-m-d h:i:s");
        $item->save();
        $absence = Absence::where('id', $id)->first(['hour_in', 'hour_out']);
        $hour_in = strtotime($absence->hour_in);
        $hour_out = strtotime($absence->hour_out);
        $diff = $hour_out - $hour_in;
        $duration = gmdate('h:i:s', $diff);

           return Response::json(['hour_in' => $absence->hour_in, 'hour_out' => $absence->hour_out, 'duration' => $duration]);

    }


    function getOutAbsence($id){
        $item=Absence::find($id);
        $item->hour_out=date("Y-m-d h:i:s");
        $item->save();
        $date = Absence::where('id',$id)->first(['hour_out']);
        return Response::json($date);
    }

    // function getAbsenceDuration($id) {
    //     $absence = Absence::findOrFail($id);
    //     $hourIn = strtotime($absence->hour_in);
    //     $hourOut = strtotime($absence->hour_out);
    //     $durationInSeconds = $hourOut - $hourIn;
    //     $duration = gmdate('h:i:s', $durationInSeconds);
    //     return Response::json(['duration' => $duration]);
    // }


    //[8:32 pm, 19/02/2023] Bouthaina👑: ->addColumn('hour_in', function ($tasks) {
      //  return $tasks->hour_in ? with(new Carbon($tasks->hour_in))->format('Y-m-d h:i') : //null;
   // })
  //  ->addColumn('hour_out', function ($tasks) {
    //    return $tasks->hour_out ? with(new Carbon($tasks->hour_out))->format('Y-m-d h:i') //: null;
    //})
//[8:32 pm, 19/02/2023] Eng:Ebrahem Alwish:

    function getStatic(){
        $subtitle="ادارة سندات القبض والصرف";
        $title="الماليه";
        $students=Student::leftJoin('students_year', 'students_year.student_id','=','students.id')
            ->select(['students.id', 'students.nameAR'])
            ->where('students_year.m_year','=',$this->getMoneyYear())
            ->where('students_year.active','=',1)->where('students.isdelete','=',0)
            ->orderBy('nameAR')->get();
        $courses=Course::where("isdelete",0)->where("active",1)->where('m_year','=',$this->getMoneyYear())->orderBy('courseAR')->get();
        $users=User::where("isdelete",0)->where("Status","مفعل")->orderBy('name')->get();
        $teachers=Teacher::leftJoin('teachers_year', 'teachers_year.teacher_id','=','teachers.id')->where('teachers.isdelete',0)->where('teachers_year.m_year','=',$this->getMoneyYear())->where('teachers_year.active',1)->orderBy('teachers.name')->get();
        $employees=Employee::where('isdelete',0)->where('active',1)->orderBy('name')->get();
        $boxes=Box::where('isdelete',0)->where('active',1)->where('type',147)->orderBy('name')->get();
        return view("cms.static.index",compact("title","subtitle","boxes","employees","teachers","students","courses","users"));
    }

    function getRSection($id){
        $data=Rep_section::where('repository_id',$id)->where('isdelete',0)->get(['id','name']);
        return Response::json( $data->toArray() );
    }

    function getRStudent($id){
        $data=Student::where('id',$id)->where('isdelete',0)->first();
        $data->nat_title=Option::find($data->nationality)->title;

        return Response::json( $data );
    }

    function getTypeStudent($type){
        $data = 1;
        $isCert = Certificate::where('type',$type)->get();
        if (count($isCert)!=0){
            $cert = Certificate::where('uid','!=',null)->where('type',$type)->orderBy('id','desc')->first();
            $data = $cert->uid + 1;
        }else{
            $data = 1;
        }

        return Response::json( $data );
    }

    function getRStudentCourse($id){
        $data=Student_course::where('id',$id)->where('isdelete',0)->first();
        $price=$data->price;
        $catches=Catch_Receipt::where('student_course_id',$id)->where('isdelete',0)->sum('amount');
        $data->remainder_d = $price-$catches;
        return Response::json( $data );
    }

    function getSection($id){
        $data=Option::where('parent_id',$id)->where('isdelete',0)->get(['id','title']);
        return Response::json( $data->toArray() );
    }

    function getIncomeBox($id){
        $data=Box_income::where('box_id',$id)->where('isdelete',0)->get(['id','name']);
        return Response::json( $data->toArray() );
    }

    function getExpenseBox($id){
        $data=Box_expense::where('box_id',$id)->where('isdelete',0)->get(['id','name']);
        return Response::json( $data->toArray() );
    }

    function getTCourse($id){
        $data=Course::where('teacher_id',$id)->where('isdelete',0)->where('m_year',$this->getMoneyYear())->get(['id','courseAR']);
        return Response::json( $data->toArray() );
    }

    function getSCourse($id){
        $student_courses = Student_course::where('student_id',$id)->where('isdelete',0)->get();
        $data = [];
        foreach ($student_courses as $student_course){
            array_push($data,Course::where('id',$student_course->course_id)->first(['id','courseAR']));
        }
        return Response::json( $data );
    }

    function getType($id){
        if($id == 1){
            $data=Option::where('parent_id','60')->where('isdelete',0)->get(['id','title']);
        }
        if($id == 0){
            $data=Option::where('parent_id','61')->where('isdelete',0)->get(['id','title']);
        }
        return Response::json( $data->toArray() );
    }

    function getRepSection($id){
        $data=Material::where('section',$id)->where('active',1)->where('isdelete',0)->get(['id','name']);
        return Response::json( $data->toArray() );
    }

    function getMonthSalary($id){
        $userL = User_year::where('user_id',$this->getId())->count();
        $userY = Money_year::where('basic_work','1')->first();
        if ($userL>0){
            $userY = User_year::where('user_id',$this->getId())->first();
        }
        $data=Salary::where('employee_id',$id)->where('remaind','!=',0)->where('year',$userY->year)->where('isdelete',0)
            ->orderBy('month')->get(['id','year','month']);
        return Response::json( $data->toArray() );
    }

    function getSetting($id){
        $setting = Setting::find('1');
        $setting->s_val=$id;
        $setting->save();
    }

    function getSettingLink($id){
        $setting = Setting::find('2');
        $setting->s_val=$id;
        $setting->save();
    }

    function getSettingSub($id){
        $setting = Setting::find('3');
        $setting->s_val=$id;
        $setting->save();
    }

    function getMenuSmall($id){
        $setting = Setting::find('4');
        $setting->s_val=1-$id;
        $setting->save();
    }

    function getRepMaterial($id){
        $data=Material::where('id',$id)->where('active',1)->where('isdelete',0)->first(['count_new','single_pay']);
        return Response::json( $data );
    }

    function getMSalary($id){
        $data=Salary::where('id',$id)->where('isdelete',0)->first(['id','salary_warranty','warranty_secretariats','warranty_contributions','salary_remaind']);
        return Response::json( $data );
    }

    function getYSalary($id){
        $years=Salary::where('employee_id',$id)->where('isdelete',0)->get();
        $yy = [];
        foreach ($years as $year){
            array_push($yy, $year->year);
        }
        $data = array_unique($yy);
        return Response::json( $data );
    }

    public function anyApprovalRecord(Request $request)
    {
        $tasks = Approval_record::leftJoin('users', 'users.id','=','approval_record.user_id')
        ->leftJoin('users as res', 'users.id','=','approval_record.res_id')
            ->select(['approval_record.id','approval_record.row_id','approval_record.slug','approval_record.model_id','approval_record.section','approval_record.date', 'users.name as user_id','res.name as res_id'])->where('res_id',Auth::user()->id);
        return Datatables::of($tasks)
        ->make(true);
    }

    public function anyCollectionFees(Request $request)
    {
        $fees=Collection_fees::where('isdelete','=','0')->get();
        $zero_fees=[];

        foreach($fees as $fee){
        $studentpay=Catch_receipt::where('student_course_id',$fee->student_course_id)->where('isdelete','=','0')->sum('amount');
        $owed=$fee->fees -$studentpay;
        if($owed >0){
            array_push($zero_fees,$fee->student_course_id);
        }
        }
        $tasks = Collection_fees::leftJoin('student_course as sc', 'sc.id','=','collection_fees.student_course_id')

            ->leftJoin('courses', 'courses.id','=','sc.course_id')
            ->leftJoin('students', 'students.id','=','sc.student_id')
            ->select(['collection_fees.id','collection_fees.student_course_id', 'collection_fees.m_year','courses.courseAR','students.nameAR','collection_fees.phone','collection_fees.fees','collection_fees.fees_pay','collection_fees.fees_owed','collection_fees.warranty','collection_fees.count','collection_fees.evasion','collection_fees.notes','collection_fees.isdelete','collection_fees.created_by','collection_fees.updated_by','collection_fees.created_at'])
            ->where('collection_fees.isdelete','=',0)->where('sc.isdelete','=',0)->whereIn('collection_fees.student_course_id',$zero_fees);
        return Datatables::of($tasks)
            ->editColumn('fees_pay', function ($tasks) {
                $studentpay=Catch_receipt::where('student_course_id',$tasks->student_course_id)->where('isdelete','=','0')->sum('amount');


        return number_format($studentpay,2);
            })
            ->editColumn('fees_owed', function ($tasks) {
                $studentpay=Catch_receipt::where('student_course_id',$tasks->student_course_id)->where('isdelete','=','0')->sum('amount');

           $fees_owed=$tasks->fees -$studentpay;

            return number_format($fees_owed,2);

            })
             ->editColumn('evasion', function ($tasks) {
                return $tasks->evasion==0?'لا':'نعم';
            })
            ->addColumn('hour12', function ($tasks) {
                $vv=0;
                if($tasks->count==0){
                    $vv=1;
                }else{
                    $count_claim = Count_claim::where('collection_fees_id',$tasks->id)->orderBy('id','desc')->first();
                    $start = Carbon::now();
                    $end =  Carbon::parse($count_claim->created_at);
                    $hours = $end->diffInHours($start);
                    if ($hours>=12){
                        $vv=1;
                    }
                }
                return $vv;
            })

            ->filter(function ($tasks) use ($request) {
            if ($request->has('searchCollectionFees') and $request->get('searchCollectionFees') != "") {
                $tasks->where('collection_fees.isdelete','=','0')
                    ->where(function ($tasks) use ($request) {
                        $tasks->where('courses.courseAR', 'like', "%{$request->get('searchCollectionFees')}%")
                            ->orWhere('students.nameAR', 'like', "%{$request->get('searchCollectionFees')}%")
                            ->orWhere('collection_fees.phone', 'like', "%{$request->get('searchCollectionFees')}%")
                            ->orWhere('collection_fees.fees', 'like', "%{$request->get('searchCollectionFees')}%")
                            ->orWhere('collection_fees.fees_pay', 'like', "%{$request->get('searchCollectionFees')}%")
                            ->orWhere('collection_fees.fees_owed', 'like', "%{$request->get('searchCollectionFees')}%")
                            ->orWhere('collection_fees.warranty', 'like', "%{$request->get('searchCollectionFees')}%")
                            ->orWhere('collection_fees.count', 'like', "%{$request->get('searchCollectionFees')}%");
                    });
            }
            if ($request->has('studentId') and $request->get('studentId') != "") {
                $tasks->where('students.id', '=', "{$request->get('studentId')}");
            }
            if ($request->has('courseId') and $request->get('courseId') != "") {
                $tasks->where('courses.id', '=', "{$request->get('courseId')}");
            }
            if ($request->has('warrantyId') and $request->get('warrantyId') != "") {
                $tasks->where('collection_fees.warranty', '=', "{$request->get('warrantyId')}");
            }
            if ($request->has('statusId') and $request->get('statusId') != "") {
                $tasks->where('collection_fees.evasion', '=', "{$request->get('statusId')}");
            }
            if ($request->has('moneyId') and $request->get('moneyId') != "") {
                $tasks->where('collection_fees.m_year', '=', "{$request->get('moneyId')}");
            }
        })
        ->with(['total_fees_owed'=> function($tasks){
           return number_format($tasks->sum('collection_fees.fees_owed'));
        }])
        ->make(true);
    }
     public function anyHowToHear(Request $request)
    {
        $tasks = Student::leftJoin('options', 'options.id','=','students.how_listen')
            ->select(['options.id','options.title as way','students.m_year','students.how_listen'])
            ->where('students.isdelete','=','0')
            ->whereNotNull('students.how_listen')
            ->groupBy('options.id');
        return Datatables::of($tasks)
            ->addColumn('total', function ($tasks) use($request) {
                 $counts=Student::where('isdelete','=','0')
            ->whereNotNull('how_listen')->where('how_listen',$tasks->id)->count('how_listen');
            if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                    $from=$request->get('fromId');
                    $to=$request->get('toId');
                    $counts=Student::where('isdelete','=','0')
            ->whereNotNull('how_listen')->where('how_listen',$tasks->id)->whereBetween('created_at',[$from,$to])->count('how_listen');
                }
                return $counts;
            })

            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchHow') and $request->get('searchHow') != "") {
                    $tasks->where('students.isdelete','=','0')
                        ->where(function ($tasks) use ($request) {
                            $tasks->where('options.title', 'like', "%{$request->get('searchHow')}%")
                                ;
                        });
                }
                if ($request->has('howId') and $request->get('howId') != "") {
                    $tasks->where('students.how_listen', '=', "{$request->get('howId')}");
                }
                // if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                //     $arrStart = explode("-", $request->get('fromId'));
                //     $arrEnd = explode("-", $request->get('toId'));
                //     $from = Carbon::create( $arrStart[0], $arrStart[1], $arrStart[2],0, 0, 0);
                //     $to = Carbon::create( $arrEnd[0], $arrEnd[1], $arrEnd[2],23, 59, 59);
                //     // $tasks ->where('students.created_at', '<=', $request->get('toId') )
                //     //         ->where('students.created_at', '>=',  $request->get('fromId'));
                //     $tasks->whereBetween('students.created_at',[$from,$to]);
                // }


            })
            //->addIndexColumn()
            ->make(true);
    }

    public function anyCountClaim(Request $request)
    {
        $tasks = Count_claim::leftJoin('student_course as sc', 'sc.id','=','count_claim.student_course_id')
            ->leftJoin('courses', 'courses.id','=','sc.course_id')
            ->leftJoin('students', 'students.id','=','sc.student_id')
            ->leftJoin('options', 'options.id','=','count_claim.how_claim')
            ->leftJoin('users', 'users.id','=','count_claim.created_by')
            ->select(['count_claim.id','courses.courseAR','students.nameAR','options.title as how_claim','count_claim.notes','count_claim.isdelete','users.name as created_by','count_claim.updated_by','count_claim.created_at'])
            ->where('count_claim.isdelete','=','0');
           // ->where('sc.m_year',$this->getMoneyYear());
        return Datatables::of($tasks)
        ->editColumn('created_at', function($tasks){
            return $tasks->created_at->format('Y-m-d h:i:s');
        })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCountClaim') and $request->get('searchCountClaim') != "") {
                    $tasks->where('count_claim.isdelete','=','0')
                        ->where(function ($tasks) use ($request) {
                            $tasks->where('students.nameAR', 'like', "%{$request->get('searchCountClaim')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchCountClaim')}%")
                                ->orWhere('options.title', 'like', "%{$request->get('searchCountClaim')}%")
                                ->orWhere('users.name', 'like', "%{$request->get('searchCountClaim')}%")
                                ->orWhere('count_claim.created_at', 'like binary', "%{$request->get('searchCountClaim')}%");
                        });
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                $tasks->where('sc.m_year', '=', "{$request->get('moneyId')}");
            }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('users.id', '=', "{$request->get('userId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
            })
            ->with(['tot'=> function($tasks){
               return  $tasks->count('count_claim.id');

            }])
            ->make(true);
    }

    public function anyCountWarning(Request $request)
    {
        $tasks = Count_warning::leftJoin('student_course as sc', 'sc.id','=','count_warning.student_course_id')
            ->leftJoin('courses', 'courses.id','=','sc.course_id')
            ->leftJoin('students', 'students.id','=','sc.student_id')
            ->leftJoin('options', 'options.id','=','count_warning.how_claim')
            ->leftJoin('users', 'users.id','=','count_warning.created_by')
            ->select(['count_warning.id','courses.courseAR','students.nameAR','options.title as how_claim','count_warning.notes','count_warning.isdelete','users.name as created_by','count_warning.updated_by','count_warning.created_at'])
            ->where('count_warning.isdelete','=','0');
        return Datatables::of($tasks)
        ->editColumn('created_at', function($tasks){
            return $tasks->created_at->format('Y-m-d h:i:s');
        })
        ->filter(function ($tasks) use ($request) {
            if ($request->has('searchCountWarning') and $request->get('searchCountWarning') != "") {
                $tasks->where('count_warning.isdelete','=','0')
                    ->where(function ($tasks) use ($request) {
                        $tasks->where('students.nameAR', 'like', "%{$request->get('searchCountWarning')}%")
                            ->orWhere('courses.courseAR', 'like', "%{$request->get('searchCountWarning')}%")
                            ->orWhere('options.title', 'like', "%{$request->get('searchCountWarning')}%")
                            ->orWhere('users.name', 'like', "%{$request->get('searchCountWarning')}%")
                            ->orWhere('count_warning.created_at', 'like binary', "%{$request->get('searchCountWarning')}%");
                    });
            }
            if ($request->has('studentId') and $request->get('studentId') != "") {
                $tasks->where('students.id', '=', "{$request->get('studentId')}");
            }
            if ($request->has('userId') and $request->get('userId') != "") {
                $tasks->where('users.id', '=', "{$request->get('userId')}");
            }
            if ($request->has('courseId') and $request->get('courseId') != "") {
                $tasks->where('courses.id', '=', "{$request->get('courseId')}");
            }
        })
        ->make(true);
    }

    public function anyLegalAffairs(Request $request)
    {
        $tasks = Legal_affairs::leftJoin('student_course as sc', 'sc.id','=','legal_affairs.student_course_id')
            ->leftJoin('courses', 'courses.id','=','sc.course_id')
            ->leftJoin('students', 'students.id','=','sc.student_id')
            ->leftJoin('users', 'users.id','=','legal_affairs.created_by')
            ->leftJoin('options', 'options.id','=','legal_affairs.status')
            ->select(['legal_affairs.id','legal_affairs.collect_amount','legal_affairs.collect_notes', 'legal_affairs.m_year','courses.courseAR','students.nameAR','legal_affairs.phone','legal_affairs.fees','legal_affairs.fees_owed','legal_affairs.first_claim','legal_affairs.count_day','legal_affairs.fine_day','legal_affairs.fine_delay','legal_affairs.total_amount','legal_affairs.warranty','legal_affairs.count','legal_affairs.count_warning','options.title as status','legal_affairs.notes','legal_affairs.isdelete','users.name as created_by','legal_affairs.updated_by','legal_affairs.created_at'])
            ->where('legal_affairs.isdelete','=','0');
        return Datatables::of($tasks)
            ->addColumn('hour12', function ($tasks) {
                $vv=0;
                if($tasks->count_warning==0){
                    $vv=1;
                }else{
                    $isCount_warning = Count_warning::where('legal_affairs_id',$tasks->id)->orderBy('id','desc')->count();
                    if ($isCount_warning>0){
                        $count_warning = Count_warning::where('legal_affairs_id',$tasks->id)->orderBy('id','desc')->first();
                        $start = Carbon::now();
                        $end =  Carbon::parse($count_warning->created_at);
                        $hours = $end->diffInHours($start);
                        if ($hours>=12){
                            $vv=1;
                        }
                    }
                }/**/
                return $vv;
            })
            ->editColumn('fine_delay', function($tasks){
                $diff = \Carbon\Carbon::parse($tasks->first_claim)->diffInDays(\Carbon\Carbon::parse(date('Y-m-d')));
                return $tasks->fine_day*$diff;
            })
            ->editColumn('total_amount', function($tasks){
                $diff = \Carbon\Carbon::parse($tasks->first_claim)->diffInDays(\Carbon\Carbon::parse(date('Y-m-d')));
                $delay=$tasks->fine_day*$diff;
                return $tasks->fees_owed+$delay;
            })
            ->addColumn('delay_dates', function($tasks){
                $diff = \Carbon\Carbon::parse($tasks->first_claim)->diffInDays(\Carbon\Carbon::parse(date('Y-m-d')));
                return $diff;
            })
        ->filter(function ($tasks) use ($request) {
            if ($request->has('searchLegalAffairs') and $request->get('searchLegalAffairs') != "") {
                $tasks->where('legal_affairs.isdelete','=','0')
                    ->where(function ($tasks) use ($request) {
                        $tasks->where('students.nameAR', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('courses.courseAR', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.phone', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.fees', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.fees_owed', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.first_claim', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.fine_delay', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.total_amount', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.count', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.count_warning', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.status', 'like', "%{$request->get('searchLegalAffairs')}%");
                    });
            }
            // if ($request->has('moneyId') and $request->get('moneyId') != "") {
            //     $tasks->where('legal_affairs.m_year', '=', "{$request->get('moneyId')}");
            // }
            if ($request->has('studentId') and $request->get('studentId') != "") {
                $tasks->where('students.id', '=', "{$request->get('studentId')}");
            }
            if ($request->has('userId') and $request->get('userId') != "") {
                $tasks->where('users.id', '=', "{$request->get('userId')}");
            }
            if ($request->has('activeId') and $request->get('activeId') != "") {
                $tasks->where('options.id', '=', "{$request->get('activeId')}");
            }
        })
        ->with(['sum_teacher_fees'=>function($tasks){
            return $tasks->sum('legal_affairs.fees_owed');
        },'receipt_teacher'=>function($tasks){
            return $tasks->sum('legal_affairs.collect_amount');
        },'remaind_teacher'=>function($tasks){
            return $tasks->sum('legal_affairs.fees_owed')-$tasks->sum('legal_affairs.collect_amount');
        },'count_claim'=>function($tasks){
            return $tasks->sum('legal_affairs.count');
        },'count_warning'=>function($tasks){
            return $tasks->sum('legal_affairs.count_warning');
        },'num'=>function($tasks){
            return $tasks->count('legal_affairs.id');
        },])
        ->make(true);
    }

    public function anyLegalAffairsEnd(Request $request)
    {
        $tasks = Legal_affairs::leftJoin('student_course as sc', 'sc.id','=','legal_affairs.student_course_id')
            ->leftJoin('courses', 'courses.id','=','sc.course_id')
            ->leftJoin('students', 'students.id','=','sc.student_id')
            ->leftJoin('users', 'users.id','=','legal_affairs.created_by')
            ->leftJoin('users as u', 'u.id','=','legal_affairs.deleted_by')
            ->leftJoin('options', 'options.id','=','legal_affairs.status')
            ->select(['legal_affairs.id', 'legal_affairs.m_year','courses.courseAR','students.nameAR','legal_affairs.phone','legal_affairs.fees','legal_affairs.fees_owed','legal_affairs.first_claim','legal_affairs.count_day','legal_affairs.fine_day','legal_affairs.fine_delay','legal_affairs.total_amount','legal_affairs.warranty','legal_affairs.count','legal_affairs.count_warning','options.title as status','legal_affairs.notes','legal_affairs.isdelete','users.name as created_by','legal_affairs.updated_by','legal_affairs.created_at','u.name as deleted_by','legal_affairs.deleted_at'])
            ->where('legal_affairs.isdelete','=','1');
        return Datatables::of($tasks)
            ->addColumn('hour12', function ($tasks) {
                $vv=0;
                if($tasks->count_warning==0){
                    $vv=1;
                }else{
                    $isCount_warning = Count_warning::where('legal_affairs_id',$tasks->id)->orderBy('id','desc')->count();
                    if ($isCount_warning>0){
                        $count_warning = Count_warning::where('legal_affairs_id',$tasks->id)->orderBy('id','desc')->first();
                        $start = Carbon::now();
                        $end =  Carbon::parse($count_warning->created_at);
                        $hours = $end->diffInHours($start);
                        if ($hours>=12){
                            $vv=1;
                        }
                    }
                }/**/
                return $vv;
            })
        ->filter(function ($tasks) use ($request) {
            if ($request->has('searchLegalAffairs') and $request->get('searchLegalAffairs') != "") {
                $tasks->where('legal_affairs.isdelete','=','0')
                    ->where(function ($tasks) use ($request) {
                        $tasks->where('students.nameAR', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('courses.courseAR', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.phone', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.fees', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.fees_owed', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.first_claim', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.fine_delay', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.total_amount', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.count', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.count_warning', 'like', "%{$request->get('searchLegalAffairs')}%")
                            ->orWhere('legal_affairs.status', 'like', "%{$request->get('searchLegalAffairs')}%");
                    });
            }
            if ($request->has('moneyId') and $request->get('moneyId') != "") {
                $tasks->where('legal_affairs.m_year', '=', "{$request->get('moneyId')}");
            }
        })
        ->make(true);
    }

    public function anyTask(Request $request)
    {
        $tasks = Task::leftJoin('users as us', 'us.id','=','tasks.sender')
            ->leftJoin('users as u', 'u.id','=','tasks.receiver')
            ->leftJoin('options', 'options.id','=','tasks.category')
            ->select(['tasks.id', 'us.name as sender', 'u.name as receiver', 'tasks.title', 'options.title as category', 'tasks.start_date', 'tasks.end_date', 'tasks.active', 'tasks.reminders_num', 'tasks.evaluate','tasks.category as tcat'])
            ->where('tasks.isdelete','=','0')
            ->where('tasks.end_date','=',null)
            ->orderBy('tasks.category','asc');
        return Datatables::of($tasks)
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchTask') and $request->get('searchTask') != "") {
                    $tasks->where('tasks.isdelete','=','0')
                        ->where('tasks.end_date','=',null)
                        ->where(function ($tasks) use ($request) {
                            $tasks->where('us.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('tasks.title', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('options.title', 'like', "%{$request->get('searchTask')}%");
                        });
                }
                if ($request->has('senderId') and $request->get('senderId') != "") {
                    $tasks->where('us.id', '=', "{$request->get('senderId')}");
                }
                if ($request->has('receiverId') and $request->get('receiverId') != "") {
                    $tasks->where('u.id', '=', "{$request->get('receiverId')}");
                }
                if ($request->has('categoryId') and $request->get('categoryId') != "") {
                    $tasks->where('options.id', '=', "{$request->get('categoryId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('tasks.active', '=', "{$request->get('activeId')}");
                }
            })

            ->with(['total'=>function($tasks){
                return $tasks->count('tasks.id');
            }])
            ->make(true);

    }

    public function anyUserTask(Request $request)
    {
        $tasks = Task::leftJoin('users as us', 'us.id','=','tasks.sender')
            ->leftJoin('users as u', 'u.id','=','tasks.receiver')
            ->leftJoin('options', 'options.id','=','tasks.category')
            ->select(['tasks.id', 'tasks.sender as sender_id', 'tasks.receiver as receiver_id', 'us.name as sender', 'u.name as receiver', 'tasks.title', 'options.title as category', 'tasks.start_date', 'tasks.end_date', 'tasks.active', 'tasks.reminders_num', 'tasks.evaluate'])
            ->where('tasks.isdelete','=','0')
            ->where('tasks.end_date','=',null)
            ->where(function ($tasks) use ($request) {
                $tasks->where('us.id', '=', $this->getId())
                ->orWhere(function($q){
                    $q->where('u.id', '=', $this->getId());
                    $q->where('tasks.active', 1);
                });
                    //->orWhere('u.id', '=', $this->getId());
            })
            ->orderBy('tasks.category','asc');
        return Datatables::of($tasks)

            ->addColumn('usr', function ($tasks) {
                return $this->getId();
            })
          /*   ->editColumn('start_date', function ($tasks){
                return date('y/m/d H:m', strtotime($tasks->start_date) );
            }) */
            ->addColumn('rem', function ($tasks) {
                $day = \Carbon\Carbon::parse($tasks->start_date)->diffInDays(\Carbon\Carbon::parse(date('Y-m-d h:s')));
                $hours = \Carbon\Carbon::parse($tasks->start_date)->diffInHours(\Carbon\Carbon::parse(date('Y-m-d h:s')));
                $hour=$hours-($day*24);
                $rem=$day . ' يوم ' . $hour . ' ساعة';
                return $rem;
            })
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchTask') and $request->get('searchTask') != "") {
                    $tasks->where('tasks.isdelete','=','0')
                        ->where('tasks.end_date','=',null)
                        ->where(function ($tasks) use ($request) {
                            $tasks->where('us.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('tasks.title', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('options.title', 'like', "%{$request->get('searchTask')}%");
                        });
                }
                if ($request->has('senderId') and $request->get('senderId') != "") {
                    $tasks->where('us.id', '=', "{$request->get('senderId')}");
                }
                if ($request->has('receiverId') and $request->get('receiverId') != "") {
                    $tasks->where('u.id', '=', "{$request->get('receiverId')}");
                }
                if ($request->has('categoryId') and $request->get('categoryId') != "") {
                    $tasks->where('options.id', '=', "{$request->get('categoryId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('tasks.active', '=', "{$request->get('activeId')}");
                }
            })
            ->with(['total'=>function($tasks){
                return $tasks->count('tasks.id');
            }])
            ->make(true);
    }

    public function myTask(Request $request)
    {
        $tasks = Task::leftJoin('users as us', 'us.id','=','tasks.sender')
            ->leftJoin('users as u', 'u.id','=','tasks.receiver')
            ->leftJoin('options', 'options.id','=','tasks.category')
            ->select(['tasks.id', 'tasks.sender as sender_id', 'tasks.receiver as receiver_id', 'us.name as sender', 'u.name as receiver', 'tasks.title', 'options.title as category', 'tasks.start_date', 'tasks.end_date', 'tasks.active', 'tasks.reminders_num', 'tasks.evaluate'])
            ->where('tasks.isdelete','=','0')
            ->where('tasks.end_date','=',null)
            ->where('receiver','=',$this->getId())

            ->orderBy('tasks.category','asc');
        return Datatables::of($tasks)
            ->addColumn('usr', function ($tasks) {
                return $this->getId();
            })

            ->addColumn('rem', function ($tasks) {
                $day = \Carbon\Carbon::parse($tasks->start_date)->diffInDays(\Carbon\Carbon::parse(date('Y-m-d h:s')));
                $hours = \Carbon\Carbon::parse($tasks->start_date)->diffInHours(\Carbon\Carbon::parse(date('Y-m-d h:s')));
                $hour=$hours-($day*24);
                $rem=$day . ' يوم ' . $hour . ' ساعة';
                return $rem;
            })
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchTask') and $request->get('searchTask') != "") {
                    $tasks->where('tasks.isdelete','=','0')
                        ->where('tasks.end_date','=',null)
                        ->where(function ($tasks) use ($request) {
                            $tasks->where('us.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('tasks.title', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('options.title', 'like', "%{$request->get('searchTask')}%");
                        });
                }
                if ($request->has('senderId') and $request->get('senderId') != "") {
                    $tasks->where('us.id', '=', "{$request->get('senderId')}");
                }
                if ($request->has('receiverId') and $request->get('receiverId') != "") {
                    $tasks->where('u.id', '=', "{$request->get('receiverId')}");
                }
                if ($request->has('categoryId') and $request->get('categoryId') != "") {
                    $tasks->where('options.id', '=', "{$request->get('categoryId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('tasks.active', '=', "{$request->get('activeId')}");
                }
            })
            ->with(['total'=>function($tasks){
                return $tasks->count('tasks.id');
            }])
            ->make(true);
    }

    public function allUserTask(Request $request)
    {
        $tasks = Task::leftJoin('users as us', 'us.id','=','tasks.sender')
            ->leftJoin('users as u', 'u.id','=','tasks.receiver')
            ->leftJoin('options', 'options.id','=','tasks.category')
            ->select(['tasks.id', 'tasks.sender as sender_id', 'tasks.receiver as receiver_id', 'us.name as sender', 'u.name as receiver', 'tasks.title', 'options.title as category', 'tasks.start_date', 'tasks.end_date', 'tasks.active', 'tasks.reminders_num', 'tasks.evaluate'])
            ->where('tasks.isdelete','=','0')
            ->where('tasks.end_date','=',null)
            ->orderBy('tasks.category','asc');
        return Datatables::of($tasks)
            ->addColumn('usr', function ($tasks) {
                return $this->getId();
            })
            ->addColumn('rem', function ($tasks) {
                $day = \Carbon\Carbon::parse($tasks->start_date)->diffInDays(\Carbon\Carbon::parse(date('Y-m-d h:s')));
                $hours = \Carbon\Carbon::parse($tasks->start_date)->diffInHours(\Carbon\Carbon::parse(date('Y-m-d h:s')));
                $hour=$hours-($day*24);
                $rem=$day . ' يوم ' . $hour . ' ساعة';
                return $rem;
            })
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchTask') and $request->get('searchTask') != "") {
                    $tasks->where('tasks.isdelete','=','0')
                        ->where('tasks.end_date','=',null)
                        ->where(function ($tasks) use ($request) {
                            $tasks->where('us.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('tasks.title', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('options.title', 'like', "%{$request->get('searchTask')}%");
                        });
                }
                if ($request->has('senderId') and $request->get('senderId') != "") {
                    $tasks->where('us.id', '=', "{$request->get('senderId')}");
                }
                if ($request->has('receiverId') and $request->get('receiverId') != "") {
                    $tasks->where('u.id', '=', "{$request->get('receiverId')}");
                }
                if ($request->has('categoryId') and $request->get('categoryId') != "") {
                    $tasks->where('options.id', '=', "{$request->get('categoryId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('tasks.active', '=', "{$request->get('activeId')}");
                }
            })
            ->with(['total'=>function($tasks){
                return $tasks->count('tasks.id');
            }])
            ->make(true);
    }

    public function anyEndTask(Request $request)
    {
        $tasks = Task::leftJoin('users as us', 'us.id','=','tasks.sender')
            ->leftJoin('users as u', 'u.id','=','tasks.receiver')
            ->leftJoin('options', 'options.id','=','tasks.category')
            ->select(['tasks.id', 'us.name as sender', 'us.id as sender_id', 'u.name as receiver', 'tasks.title', 'options.title as category', 'tasks.start_date', 'tasks.end_date', 'tasks.active', 'tasks.reminders_num', 'tasks.evaluate'])->where(function($query) {
                $query ->where('us.id', '=', $this->getId())
                ->orwhere('u.id', '=', $this->getId());
        })->where('tasks.end_date','!=',null)->orderBy('tasks.evaluate','asc');
        return Datatables::of($tasks)
        ->addColumn('usr', function ($tasks) {
            return $this->getId();
        })

            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->addColumn('rem', function ($tasks) {
                $day = \Carbon\Carbon::parse($tasks->start_date)->diffInDays(\Carbon\Carbon::parse($tasks->end_date));
                $hours = \Carbon\Carbon::parse($tasks->start_date)->diffInHours(\Carbon\Carbon::parse($tasks->end_date));
                $hour=$hours-($day*24);
                $rem=$day . ' يوم ' . $hour . ' ساعة';
                return $rem;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchTask') and $request->get('searchTask') != "") {
                    $tasks->where('tasks.isdelete','=','0')
                        ->where('tasks.end_date','!=',null)
                        ->where(function ($tasks) use ($request){
                            $tasks->where('us.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('tasks.title', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('options.title', 'like', "%{$request->get('searchTask')}%");
                        });
                }
                if ($request->has('senderId') and $request->get('senderId') != "") {
                    $tasks->where('us.id', '=', "{$request->get('senderId')}");
                }
                if ($request->has('receiverId') and $request->get('receiverId') != "") {
                    $tasks->where('u.id', '=', "{$request->get('receiverId')}");
                }
                if ($request->has('categoryId') and $request->get('categoryId') != "") {
                    $tasks->where('options.id', '=', "{$request->get('categoryId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('tasks.active', '=', "{$request->get('activeId')}");
                }
            })
            ->with(['total'=>function($tasks){
                return $tasks->count('tasks.id');
            },'evaluations'=>function($tasks){
                $count=$tasks->whereColumn('tasks.sender', '!=','tasks.receiver')->whereNotNull('tasks.evaluate')->count('tasks.id');
                if($count>0){
                return number_format($tasks->whereColumn('tasks.sender', '!=','tasks.receiver')->sum('tasks.evaluate')/$count,2);
                }else{
                    return 0;
                }
            }])
            ->make(true);
    }
    public function anyMyEndTask(Request $request)
    {
        $tasks = Task::leftJoin('users as us', 'us.id','=','tasks.sender')
            ->leftJoin('users as u', 'u.id','=','tasks.receiver')
            ->leftJoin('options', 'options.id','=','tasks.category')
            ->select(['tasks.id', 'us.name as sender', 'us.id as sender_id', 'u.name as receiver', 'tasks.title', 'options.title as category', 'tasks.start_date', 'tasks.end_date', 'tasks.active', 'tasks.reminders_num', 'tasks.evaluate'])
            ->where('tasks.isdelete','=','0')
            ->where('tasks.end_date','!=',null)
            ->where('us.id', '=', $this->getId())->orderBy('tasks.evaluate','asc');
        return Datatables::of($tasks)
        ->addColumn('usr', function ($tasks) {
            return $this->getId();
        })

            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->addColumn('rem', function ($tasks) {
                $day = \Carbon\Carbon::parse($tasks->start_date)->diffInDays(\Carbon\Carbon::parse($tasks->end_date));
                $hours = \Carbon\Carbon::parse($tasks->start_date)->diffInHours(\Carbon\Carbon::parse($tasks->end_date));
                $hour=$hours-($day*24);
                $rem=$day . ' يوم ' . $hour . ' ساعة';
                return $rem;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchTask') and $request->get('searchTask') != "") {
                    $tasks->where('tasks.isdelete','=','0')
                        ->where('tasks.end_date','!=',null)
                        ->where(function ($tasks) use ($request){
                            $tasks->where('us.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('tasks.title', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('options.title', 'like', "%{$request->get('searchTask')}%");
                        });
                }

                if ($request->has('receiverId') and $request->get('receiverId') != "") {
                    $tasks->where('u.id', '=', "{$request->get('receiverId')}");
                }
                if ($request->has('categoryId') and $request->get('categoryId') != "") {
                    $tasks->where('options.id', '=', "{$request->get('categoryId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('tasks.active', '=', "{$request->get('activeId')}");
                }
            })
            ->with(['total'=>function($tasks){
                return $tasks->count('tasks.id');
            },'evaluations'=>function($tasks){
                $count=$tasks->whereColumn('tasks.sender', '!=','tasks.receiver')->whereNotNull('tasks.evaluate')->count('tasks.id');
                if($count>0){
                return number_format($tasks->whereColumn('tasks.sender', '!=','tasks.receiver')->sum('tasks.evaluate')/$count,2);
                }else{
                    return 0;
                }
            }])
            ->make(true);
    }
    public function allEndTask(Request $request)
    {
        $tasks = Task::leftJoin('users as us', 'us.id','=','tasks.sender')
            ->leftJoin('users as u', 'u.id','=','tasks.receiver')
            ->leftJoin('options', 'options.id','=','tasks.category')
            ->select(['tasks.id', 'us.name as sender', 'u.name as receiver', 'tasks.title', 'options.title as category', 'tasks.start_date', 'tasks.end_date', 'tasks.active', 'tasks.reminders_num', 'tasks.evaluate'])
            ->where('tasks.isdelete','=','0')
            ->where('tasks.end_date','!=',null);
        return Datatables::of($tasks)
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->addColumn('rem', function ($tasks) {
                $day = \Carbon\Carbon::parse($tasks->start_date)->diffInDays(\Carbon\Carbon::parse($tasks->end_date));
                $hours = \Carbon\Carbon::parse($tasks->start_date)->diffInHours(\Carbon\Carbon::parse($tasks->end_date));
                $hour=$hours-($day*24);
                $rem=$day . ' يوم ' . $hour . ' ساعة';
                return $rem;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchTask') and $request->get('searchTask') != "") {
                    $tasks->where('tasks.isdelete','=','0')
                        ->where('tasks.end_date','!=',null)
                        ->where(function ($tasks) use ($request){
                            $tasks->where('us.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('tasks.title', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('options.title', 'like', "%{$request->get('searchTask')}%");
                        });
                }
                if ($request->has('senderId') and $request->get('senderId') != "") {
                    $tasks->where('us.id', '=', "{$request->get('senderId')}");
                }
                if ($request->has('receiverId') and $request->get('receiverId') != "") {
                    $tasks->where('u.id', '=', "{$request->get('receiverId')}");
                }
                if ($request->has('categoryId') and $request->get('categoryId') != "") {
                    $tasks->where('options.id', '=', "{$request->get('categoryId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('tasks.active', '=', "{$request->get('activeId')}");
                }
            })
            ->with(['total'=>function($tasks){
                return $tasks->count('tasks.id');
            },'evaluations'=>function($tasks){
                $count=$tasks->whereColumn('tasks.sender', '!=','tasks.receiver')->whereNotNull('tasks.evaluate')->count('tasks.id');
                if($count>0){
                return number_format($tasks->whereColumn('tasks.sender', '!=','tasks.receiver')->sum('tasks.evaluate')/$count,2);
                }else{
                    return 0;
                }
            }])
            ->make(true);
    }

    public function anyRepTask(Request $request)
    {
        $tasks = Task::leftJoin('users as us', 'us.id','=','tasks.sender')
            ->leftJoin('users as u', 'u.id','=','tasks.receiver')
            ->select(['tasks.id', 'us.name as sender', 'u.name as receiver', 'tasks.sender as sen','tasks.receiver as rec', 'tasks.title', 'tasks.start_date', 'tasks.end_date', 'tasks.active', 'tasks.reminders_num', 'tasks.evaluate'])
            ->where('tasks.active','=','1')
            ->where('tasks.isdelete','=','0');

        return Datatables::of($tasks)
                        ->addColumn('operations', function ($tasks) use($request){
                            if ($request->has('userId') and $request->get('userId') != "") {
                    $count=Task::where('tasks.isdelete','=','0')->where('active',1)->where('tasks.end_date','!=',null)->where('tasks.receiver', '=', "{$request->get('userId')}")->where('tasks.sender','=',$tasks->sen)->whereNotNull('evaluate')->count();

                }else{
                $count=Task::where('isdelete','=','0')->where('end_date','!=',null)->whereColumn('sender', '!=','receiver')->whereNotNull('evaluate')->where('tasks.sender','=',$tasks->sen)->where('tasks.receiver','=',$tasks->rec)->count();
                }
                if ($count>0){
                    if ($request->has('userId') and $request->get('userId') != "") {
                    $ratios=Task::where('tasks.isdelete','=','0')->where('tasks.end_date','!=',null)->where('tasks.receiver', '=', "{$request->get('userId')}")->where('tasks.sender','=',$tasks->sen)->whereNotNull('evaluate')->sum('tasks.evaluate');
                }else{
                $ratios=Task::where('isdelete','=','0')->where('active','=','1')->where('end_date','!=',null)->whereColumn('sender', '!=','receiver')->whereNotNull('evaluate')->where('tasks.sender','=',$tasks->sen)->where('tasks.receiver','=',$tasks->rec)->sum('tasks.evaluate');
                }

                   $rat=$ratios/$count;
                }else{
                    $rat=0;
                }
                if($rat>70){
                        $html='
                        <div class="progress progress-style progress-sm">
                        <div class="progress-bar bg-success-gradient" role="progressbar"style="width:'.$rat.'%" aria-valuenow="'.$rat.'" aria-valuemin="0" aria-valuemax="'.$rat.'"></div>
                    </div>
';
}elseif($rat>35){
    $html='<div class="progress progress-style progress-sm">
    <div class="progress-bar bg-warning-gradient" role="progressbar"style="width:'.$rat.'%" aria-valuenow="'.$rat.'" aria-valuemin="0" aria-valuemax="'.$rat.'"></div>
</div>';
}elseif($rat<35){
    $html='<div class="progress progress-style progress-sm">
    <div class="progress-bar bg-danger-gradient" role="progressbar"style="width:'.$rat.'%" aria-valuenow="'.$rat.'" aria-valuemin="0" aria-valuemax="'.$rat.'"></div>
</div>';
}
return $html;
})

            ->addColumn('countRun', function ($tasks) use($request) {
                return $tasks->where('tasks.end_date','=',null)->whereNotNull('start_date')->where('tasks.sender','=',$tasks->sen)->where('tasks.receiver','=',$tasks->rec)->count();
            })
            ->addColumn('countDone', function ($tasks) use($request) {
                if ($request->has('userId') and $request->get('userId') != "") {
                    $count=$tasks->where('tasks.isdelete','=','0')->where('tasks.end_date','!=',null)->whereNotNull('evaluate')->where('tasks.receiver', '=', "{$request->get('userId')}")->where('tasks.sender','=',$tasks->sen)->count();

                }else{
                $count=$tasks->where('tasks.isdelete','=','0')->where('tasks.end_date','!=',null)->whereNotNull('evaluate')->where('tasks.sender','=',$tasks->sen)->where('tasks.receiver','=',$tasks->rec)->count();
                }
                return $count;
            })
            ->addColumn('ratioDone', function ($tasks) use($request) {
                if ($request->has('userId') and $request->get('userId') != "") {
                    $count=Task::where('tasks.isdelete','=','0')->where('tasks.end_date','!=',null)->where('tasks.receiver', '=', "{$request->get('userId')}")->where('tasks.sender','=',$tasks->sen)->whereNotNull('evaluate')->count();

                }else{
                $count=Task::where('isdelete','=','0')->where('active','=','1')->where('end_date','!=',null)->whereColumn('sender', '!=','receiver')->whereNotNull('evaluate')->where('tasks.sender','=',$tasks->sen)->where('tasks.receiver','=',$tasks->rec)->count();
                }
                if ($count>0){
                    if ($request->has('userId') and $request->get('userId') != "") {
                    $ratios=Task::where('tasks.isdelete','=','0')->where('tasks.end_date','!=',null)->where('tasks.receiver', '=', "{$request->get('userId')}")->where('tasks.sender','=',$tasks->sen)->whereNotNull('evaluate')->sum('tasks.evaluate');
                }else{
                $ratios=Task::where('isdelete','=','0')->where('active','=','1')->where('end_date','!=',null)->whereColumn('sender', '!=','receiver')->whereNotNull('evaluate')->where('tasks.sender','=',$tasks->sen)->where('tasks.receiver','=',$tasks->rec)->sum('tasks.evaluate');
                }

                    return number_format($ratios/$count,1)."%";
                }else{
                    return "0%";
                }


            })
            ->rawColumns(['operations'])
            ->escapeColumns(['operations'])
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchTask') and $request->get('searchTask') != "") {
                    $tasks->where('tasks.isdelete','=','0')
                        ->where('tasks.end_date','!=',null)
                        ->where(function ($tasks) use ($request){
                            $tasks->where('us.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('tasks.title', 'like', "%{$request->get('searchTask')}%")
                                ->orWhere('options.title', 'like', "%{$request->get('searchTask')}%");
                        });
                }

                if ($request->has('userId') and $request->get('userId') != "") {

                        $tasks->where('u.id', '=', "{$request->get('userId')}")->groupBy('tasks.sender');

                }else{
                    $tasks->groupBy(['tasks.sender','tasks.receiver']);
                }

            })
            ->make(true);
    }

    public function anyEmployee(Request $request)
    {
        $tasks = Employee::leftJoin('options as opt', 'opt.id','=','employees.job_title')
            ->leftJoin('options as op', 'op.id','=','employees.address')
            ->leftJoin('options as opn', 'opn.id','=','employees.nationality')
            ->leftJoin('options as optee', 'optee.id','=','employees.status')
            ->leftJoin('options as opteee', 'opteee.id','=','employees.level')
            ->select(['employees.id', 'employees.name', 'opt.title as job', 'employees.birthday','employees.status', 'employees.status', 'op.title as address', 'opn.title as nationality', 'employees.phone1', 'opteee.title as level', 'employees.phone2', 'employees.email', 'employees.salary_down', 'employees.smoke', 'employees.updated_at', 'employees.notes', 'employees.active', 'employees.isdelete', 'employees.created_at'])

            ->where('employees.isdelete','=','0');
        return Datatables::of($tasks)
            ->addColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('birthday', function ($tasks) {
                return $tasks->birthday ? with(new Carbon($tasks->birthday))->format('Y') : '';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->updated_at ? with(new Carbon($tasks->updated_at))->format('Y-m-d') : with(new Carbon($tasks->created_at))->format('Y-m-d');
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchEmployee') and $request->get('searchEmployee') != "") {
                    $tasks->where('employees.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('name', 'like', "%{$request->get('searchEmployee')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchEmployee')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchEmployee')}%")
                                ->orWhere('opn.title', 'like', "%{$request->get('searchEmployee')}%")
                                ->orWhere('birthday', 'like', "%{$request->get('searchEmployee')}%")
                                ->orWhere('phone1', 'like', "%{$request->get('searchEmployee')}%");
                        });
                }
                if ($request->has('jobId') and $request->get('jobId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('jobId')}");
                }
                if ($request->has('addressId') and $request->get('addressId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('addressId')}");
                }

                if ($request->has('nationality_h') and $request->get('nationality_h') != "") {
                    $tasks->where('opn.id', $request->get('nationality_h'));
                }

                if ($request->has('statusId') and $request->get('statusId') != "") {
                    $tasks->where('optee.id', '=', "{$request->get('statusId')}");
                }
                if ($request->has('levelId') and $request->get('levelId') != "") {
                    $tasks->where('opteee.id', '=', "{$request->get('levelId')}");
                }

                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('employees.active', '=', "{$request->get('activeId')}");
                }
            })
            ->make(true);
    }

    public function anyBoxIncome(Request $request,$id)
    {
        $tasks = Box_income::leftJoin('boxes', 'boxes.id','=','box_income.box_id')
            ->select(['box_income.id', 'box_income.name', 'boxes.name as box_id', 'box_income.created_at'])
            ->where('box_income.isdelete','=','0')
            ->where('box_income.box_id','=',$id);
        return Datatables::of($tasks)
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request,$id) {
                if ($request->has('searchBoxIncome') and $request->get('searchBoxIncome') != "") {
                    $tasks->where('box_income.isdelete','=','0')
                        ->where('box_income.box_id','=',$id)
                        ->where(function ($tasks) use ($request){
                            $tasks->where('box_income.name', 'like', "%{$request->get('searchBoxIncome')}%")
                                ->orWhere('box_income.created_at', 'like binary', "%{$request->get('searchBoxIncome')}%");
                        });
                }
            })
            ->make(true);
    }



    public function anyBoxExpense(Request $request,$id)
    {
        $tasks = Box_expense::leftJoin('boxes', 'boxes.id','=','box_expense.box_id')
            ->select(['box_expense.id', 'box_expense.name', 'boxes.name as box_id', 'box_expense.created_at'])
            ->where('box_expense.isdelete','=','0')
            ->where('box_expense.box_id','=',$id);
        return Datatables::of($tasks)
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request,$id) {
                if ($request->has('searchBoxExpense') and $request->get('searchBoxExpense') != "") {
                    $tasks->where('box_expense.isdelete','=','0')
                        ->where('box_expense.box_id','=',$id)
                        ->where(function ($tasks) use ($request){
                            $tasks->where('box_expense.name', 'like', "%{$request->get('searchBoxExpense')}%")
                                ->orWhere('box_expense.created_at', 'like binary', "%{$request->get('searchBoxExpense')}%");
                        });
                }
            })
            ->make(true);
    }



    public function anyTeacher(Request $request)
    {
        $tasks = Teacher::leftJoin('options as opt', 'opt.id','=','teachers.specialization')
            ->leftJoin('options as op', 'op.id','=','teachers.classification')
            ->leftJoin('options as o', 'o.id','=','teachers.address')
            ->leftJoin('options as opte', 'opte.id','=','teachers.nationality')
            ->select(['teachers.id', 'teachers.name', 'opt.title as specialization', 'teachers.birthday', 'nationality', 'o.title as address', 'teachers.phone1', 'teachers.phone2', 'teachers.email', 'op.title as classification', 'teachers.notes', 'teachers.active', 'teachers.isdelete', 'teachers.created_at'])
            ->where('teachers.isdelete','=','0');
        return Datatables::of($tasks)
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchTeacher') and $request->get('searchTeacher') != "") {
                    $tasks->where('teachers.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('name', 'like', "%{$request->get('searchTeacher')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchTeacher')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchTeacher')}%")
                                ->orWhere('teachers.birthday', 'like', "%{$request->get('searchTeacher')}%")
                                ->orWhere('teachers.phone1', 'like', "%{$request->get('searchTeacher')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchTeacher')}%");
                        });
                }
                if ($request->has('specsId') and $request->get('specsId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('specsId')}");
                }
                if ($request->has('addressId') and $request->get('addressId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('addressId')}");
                }

                if ($request->has('classificationId') and $request->get('classificationId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('classificationId')}");
                }

                if ($request->has('nationalityId') and $request->get('nationalityId') != "") {
                    $tasks->where('opte.id', '=', "{$request->get('nationalityId')}");
                }


                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->leftJoin('teachers_year', 'teachers_year.teacher_id','=','teachers.id')
                        ->select(['teachers.id', 'teachers.name', 'opt.title as specialization', 'teachers.birthday', 'nationality', 'o.title as address', 'teachers.phone1', 'teachers.phone2', 'teachers.email', 'op.title as classification', 'teachers.notes', 'teachers_year.active', 'teachers.isdelete', 'teachers.created_at'])
                        ->where('teachers_year.m_year','=',$request->get('moneyId'));
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('teachers_year.active', '=', "{$request->get('activeId')}");
                }
            })
            ->make(true);
    }

    public function anyStudent(Request $request)
    {
         $tasks = Student::leftJoin('options as opt', 'opt.id','=','students.level')
            ->leftJoin('options as op', 'op.id','=','students.classification')
            ->leftJoin('options as o', 'o.id','=','students.address')
            ->leftJoin('options as oo', 'oo.id','=','students.gender')
            ->select(['students.id', 'students.nameAR', 'students.birthday', 'oo.title as gender', 'o.title as address', 'students.phone1', 'students.phone2','students.updated_at', 'opt.title as level', 'op.title as classification', 'students.active', 'students.created_at'])
            ->where('students.isdelete','=','0')->distinct()->orderBy('id','desc');
        return Datatables::of($tasks)
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
         ->editColumn('created_at', function ($tasks) {
                 return $tasks->updated_at ? with(new Carbon($tasks->updated_at))->format('Y-m-d') : with(new Carbon($tasks->created_at))->format('Y-m-d');
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchStudent') and $request->get('searchStudent') != "") {
                    $tasks->where('students.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('nameAR', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('students.birthday', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('students.phone1', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('students.phone2', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchStudent')}%");
                        });
                }
                if ($request->has('classId') and $request->get('classId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('classId')}");
                }
                if ($request->has('addressId') and $request->get('addressId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('addressId')}");
                }
                if ($request->has('levelId') and $request->get('levelId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('levelId')}");
                }
                if ($request->has('genderId') and $request->get('genderId') != "") {
                    $tasks->where('oo.id', '=', "{$request->get('genderId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('students_year.active','=',$request->get('activeId'));
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->leftJoin('students_year', 'students_year.student_id','=','students.id')
                         ->select(['students.id', 'students.nameAR', 'students.birthday', 'oo.title as gender', 'o.title as address', 'students.phone1', 'students.phone2', 'opt.title as level', 'op.title as classification', 'students_year.active','students.updated_at', 'students.created_at'])
                        ->where('students_year.m_year','=',$request->get('moneyId'));
                }
            })
            ->make(true);
    }

    public function anyYearStudent(Request $request)
    {
        $tasks = Student::leftJoin('options as opt', 'opt.id','=','students.level')
            ->leftJoin('options as op', 'op.id','=','students.classification')
            ->leftJoin('options as o', 'o.id','=','students.address')
            ->leftJoin('options as oo', 'oo.id','=','students.gender')
            ->leftJoin('students_year', 'students_year.student_id','=','students.id')
            ->select(['students.id', 'students.nameAR', 'students.birthday', 'oo.title as gender', 'o.title as address', 'students.phone1', 'students.phone2', 'opt.title as level', 'op.title as classification', 'students.active', 'students.created_at'])
            ->where('students.isdelete','=','0')
            ->where('students_year.active','=','1')
            ->where('students_year.m_year','=',$this->getMoneyYear());
        return Datatables::of($tasks)
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchStudent') and $request->get('searchStudent') != "") {
                    $tasks->where('students.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('nameAR', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('students.birthday', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('students.phone1', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('students.whatsup', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchStudent')}%");
                        });
                }
                if ($request->has('classId') and $request->get('classId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('classId')}");
                }
                if ($request->has('addressId') and $request->get('addressId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('addressId')}");
                }
                if ($request->has('levelId') and $request->get('levelId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('levelId')}");
                }
                if ($request->has('genderId') and $request->get('genderId') != "") {
                    $tasks->where('oo.id', '=', "{$request->get('genderId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('students_year.active','=',$request->get('activeId'));
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->leftJoin('students_year', 'students_year.student_id','=','students.id')
                        ->select(['students.id', 'students.nameAR', 'students.birthday', 'oo.title as gender', 'o.title as address', 'students.phone1', 'students.whatsup', 'opt.title as level', 'op.title as classification', 'students_year.active', 'students.created_at'])
                        ->where('students_year.m_year','=',$request->get('moneyId'));
                }
            })
            ->make(true);
    }

    public function anyCourse(Request $request)
    {
        $tasks = Course::leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->select([ 'courses.id',  'courses.m_year',  'courses.courseAR','courses.ratio_type','courses.ratio',  'courses.total_withdrawn_student',  'courses.course_time', 'teachers.name as teacher_id',  'courses.total_fees',  'courses.total_reg_student',  'courses.active', 'courses.created_at', 'courses.isdelete'])
            ->where('courses.isdelete','=','0');
        return Datatables::of($tasks)
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('ratio', function ($tasks) {
                return $tasks->ratio . " %";
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {

                if ($request->has('searchCourse') and $request->get('searchCourse') != "") {
                    $tasks->where('courses.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('teachers.name', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_withdrawn_student', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.course_time', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_fees', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_reg_student', 'like', "%{$request->get('searchCourse')}%");
                        });
                }
                if ($request->has('teacherId') and $request->get('teacherId') != "") {
                    $tasks->where('teachers.id', '=', "{$request->get('teacherId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('courses.active', '=', "{$request->get('activeId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('courses.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with(['all_registered'=>function($tasks){
                return $tasks->sum('courses.total_reg_student');
            },'all_withdrawn'=>function($tasks){
                return $tasks->sum('courses.total_withdrawn_student');
            },'all_graduate'=>function($tasks){
                return $tasks->sum('courses.total_reg_student')-$tasks->sum('courses.total_withdrawn_student');
            },'ratios'=>function($tasks){
                $summ= $tasks->sum('courses.ratio');
                $cou = $tasks->count('courses.id');
                if($cou >0){
                return number_format($summ/$cou,'1')."%";
                }else{
                    return "0%";
                }
            }])
            ->make(true);
    }

    public function anyCampaign(Request $request)
    {
        $tasks = Campaign::leftJoin('users as us', 'us.id','=','campaigns.created_by')
            ->leftJoin('users as u', 'u.id','=','campaigns.updated_by')
            ->select([ 'campaigns.id',  'campaigns.title',  'campaigns.start',  'campaigns.active', 'campaigns.created_at', 'us.name as created_by', 'u.name as updated_by', 'campaigns.isdelete'])
            ->where('campaigns.isdelete','=','0');
        return Datatables::of($tasks)
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('Y-m-d') : '';
            })
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by ? $tasks->updated_by : $tasks->created_by;
            })
            /*->filter(function ($tasks) use ($request) {
                if ($request->has('searchCourse') and $request->get('searchCourse') != "") {
                    $tasks->where('courses.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('teachers.name', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_withdrawn_student', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.course_time', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_fees', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_reg_student', 'like', "%{$request->get('searchCourse')}%");
                        });
                }
                if ($request->has('teacherId') and $request->get('teacherId') != "") {
                    $tasks->where('teachers.id', '=', "{$request->get('teacherId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('courses.active', '=', "{$request->get('activeId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('courses.m_year', '=', "{$request->get('moneyId')}");
                }
            })*/
            ->make(true);
    }

    public function anyCampaignStudent(Request $request)
    {
        $tasks = Campaign_student::leftJoin('users as us', 'us.id','=','campaign_student.created_by')
            ->leftJoin('users as u', 'u.id','=','campaign_student.updated_by')
            ->leftJoin('students', 'students.id','=','campaign_student.name')
            ->leftJoin('courses', function($join){
               $join->whereIn('courses.id',explode(',', 'campaign_student.course_reg'));
            })
            ->leftJoin('options as o', 'o.id','=','campaign_student.address')
            ->leftJoin('options as op', 'op.id','=','campaign_student.type')
            ->leftJoin('options as opt', 'opt.id','=','campaign_student.response')

            ->select([ 'campaign_student.id', 'campaign_student.campaign_id','campaign_student.response as res_id', 'campaign_student.course_reg',  'students.nameAR as name',  'campaign_student.birthday',  'o.title as address',  'op.title as type',  'campaign_student.notes',  'campaign_student.phone',  'opt.title as response',  'campaign_student.resolution', 'campaign_student.created_at', 'us.name as created_by', 'u.name as updated_by', 'campaign_student.isdelete'])
            ->where('campaign_student.isdelete','=','0');
        return Datatables::of($tasks)
        ->editColumn('course_reg', function ($tasks) {
                $course_reg='';
                $myArray = explode(',', $tasks->course_reg);
                if(count($myArray)>0){
                foreach($myArray as $co){
                    $course=Course::find($co);
                    $course_reg .=$course->courseAR.",";
                }
                }else{
                    $course=Course::find($tasks->course_reg);
                    $course_reg .=$course->courseAR;
                }
                return $course_reg;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('Y-m-d') : '';
            })
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by ? $tasks->updated_by : $tasks->created_by;
            })
            ->editColumn('resolution', function ($tasks) {
                return $tasks->resolution==1 ? 'متابعة' : 'لم ينظر';
            })
            ->editColumn('notes', function ($tasks) {
                return \Illuminate\Support\Str::limit($tasks->notes,50);
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCampaign') and $request->get('searchCampaign') != "") {
                    // $tasks->where('courses.isdelete','=','0')
                        $tasks->where(function ($tasks) use ($request){
                            $tasks->where('students.nameAR', 'like', "%{$request->get('searchCampaign')}%")
                                ->orWhere('campaign_student.birthday', 'like', "%{$request->get('searchCampaign')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchCampaign')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchCampaign')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchCampaign')}%")
                                 ->orWhere('courses.courseAR', 'like', "%{$request->get('searchCampaign')}%")
                                //  ->orWhere(function ($tasks) use ($request){
                                //      $tasks->leftJoin('courses', function ($j) use ($tasks,$request){
                                //          $j->on('courses.id', 'in', DB::raw('('.implode(',',$tasks->course_reg).')'));;
                                //      });

                                //  })
                                ->orWhere('campaign_student.notes', 'like', "%{$request->get('searchCampaign')}%")
                                ->orWhere('campaign_student.phone', 'like', "%{$request->get('searchCampaign')}%");
                        });
                }
                if ($request->has('resId') and $request->get('resId') != "") {
                    $tasks->where('campaign_student.response', '=', "{$request->get('resId')}");
                }
                if ($request->has('resolution') and $request->get('resolution') != "") {
                    $tasks->where('campaign_student.resolution', '=', "{$request->get('resolution')}");
                }
                if ($request->has('uId') and $request->get('uId') != "") {
                    $tasks->where('campaign_student.campaign_id', '=', "{$request->get('uId')}");
                }
            })
            ->make(true);
    }

    public function anyCourseReg(Request $request)
    {
        $tasks = Course::leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->select([ 'courses.id','courses.m_year',  'courses.courseAR',  'courses.courseEN',  'courses.course_time', 'teachers.name as teacher_id',  'courses.total_fees',  'courses.total_reg_student',  'courses.active', 'courses.created_at', 'courses.isdelete'])
            ->where('courses.isdelete','=','0')
            ->where('courses.active','=','1');
        return Datatables::of($tasks)
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCourse') and $request->get('searchCourse') != "") {
                    $tasks->where('courses.isdelete','=','0')
                        ->where('courses.active','=','1')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('teachers.name', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.course_time', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_fees', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_reg_student', 'like', "%{$request->get('searchCourse')}%");
                        });
                }
                if ($request->has('teacherId') and $request->get('teacherId') != "") {
                    $tasks->where('teachers.id', '=', "{$request->get('teacherId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('courses.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->make(true);
    }

    public function anyCertificate(Request $request)
    {
        $tasks = Certificate::leftJoin('options as opt', 'opt.id','=','certificates.type')
            ->leftJoin('options as op', 'op.id','=','certificates.appreciation')
            ->leftJoin('options as o', 'o.id','=','certificates.course_id')
            ->leftJoin('options as opti', 'opti.id','=','certificates.nationality')
            ->leftJoin('students', 'students.id','=','certificates.student_id')
            ->select([ 'certificates.id','certificates.uid','certificates.year', 'opt.title as type', 'students.nameAR as studentAR','opti.title as nationality', 'o.title as courseAR', 'certificates.place_birth', 'certificates.year_birth', 'certificates.start_day', 'certificates.end_day','certificates.total_hours as hours', 'op.title as appreciation', 'certificates.certificate_fees', 'certificates.catch_receipt_id', 'certificates.print_execute', 'certificates.release_date'])
            ->where('certificates.type','=','84')
            ->where('certificates.isdelete','=','0')
              ->orderByDesc('certificates.id');
        return Datatables::of($tasks)
            // ->editColumn('created_at', function ($tasks) {
            //     return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d') : '';
            // })
            ->editColumn('release_date', function ($tasks) {
                return $tasks->release_date ? with(new Carbon($tasks->release_date))->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCertificate') and $request->get('searchCertificate') != "") {
                    $tasks->where('certificates.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('opt.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('students.nameAR', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('students.nameEN', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.place_birth', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.year_birth', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.start_day', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.end_day', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.catch_receipt_id', 'like', "%{$request->get('searchCertificate')}%");
                        });
                }
                if ($request->has('yearId') and $request->get('yearId') != "") {
                    $tasks->where('certificates.year', '=', "{$request->get('yearId')}");
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('statusId') and $request->get('statusId') != "") {
                    $tasks->where('certificates.print_execute', '=', "{$request->get('statusId')}");
                }
            })
            ->with(['total'=>function($tasks){
                return $tasks->count('certificates.id');
            }])
            ->make(true);
    }
     public function anySharingCertificate(Request $request)
    {
        $tasks = Certificate::leftJoin('options as opt', 'opt.id','=','certificates.type')
            ->leftJoin('options as op', 'op.id','=','certificates.appreciation')
            ->leftJoin('options as o', 'o.id','=','certificates.course_id')
            ->leftJoin('options as opti', 'opti.id','=','certificates.nationality')
            ->leftJoin('students', 'students.id','=','certificates.student_id')
            ->select([ 'certificates.id','certificates.uid','certificates.year', 'opt.title as type', 'students.nameAR as studentAR','opti.title as nationality', 'o.title as courseAR', 'certificates.place_birth', 'certificates.year_birth', 'certificates.start_day', 'certificates.end_day','certificates.total_hours as hours', 'op.title as appreciation', 'certificates.certificate_fees', 'certificates.catch_receipt_id', 'certificates.print_execute', 'certificates.release_date'])
            ->where('certificates.type','=','85')
            ->where('certificates.isdelete','=','0')
            ->orderBy('certificates.id','desc');
        return Datatables::of($tasks)
            // ->editColumn('created_at', function ($tasks) {
            //     return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d') : '';
            // })
            ->editColumn('release_date', function ($tasks) {
                return $tasks->release_date ? with(new Carbon($tasks->release_date))->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCertificate') and $request->get('searchCertificate') != "") {
                    $tasks->where('certificates.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('opt.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('students.nameAR', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('students.nameEN', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.place_birth', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.year_birth', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.start_day', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.end_day', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.catch_receipt_id', 'like', "%{$request->get('searchCertificate')}%");
                        });
                }
                if ($request->has('yearId') and $request->get('yearId') != "") {
                    $tasks->where('certificates.year', '=', "{$request->get('yearId')}");
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('statusId') and $request->get('statusId') != "") {
                    $tasks->where('certificates.print_execute', '=', "{$request->get('statusId')}");
                }
            })
            ->with(['total'=>function($tasks){
                return $tasks->count('certificates.id');
            }])
            ->make(true);}
     public function anyOldCertificate(Request $request)
     {
        $tasks = Certificate::leftJoin('options as opt', 'opt.id','=','certificates.type')
            ->leftJoin('options as op', 'op.id','=','certificates.appreciation')
            ->leftJoin('options as o', 'o.id','=','certificates.course_id')
            ->leftJoin('options as opti', 'opti.id','=','certificates.nationality')
            ->leftJoin('students', 'students.id','=','certificates.student_id')
            ->select([ 'certificates.id','certificates.uid','certificates.year', 'opt.title as type', 'students.nameAR as studentAR','opti.title as nationality', 'o.title as courseAR', 'certificates.place_birth', 'certificates.year_birth', 'certificates.start_day', 'certificates.end_day','certificates.total_hours as hours', 'op.title as appreciation', 'certificates.print_execute', 'certificates.release_date'])
            ->where('certificates.type','=','88')
            ->where('certificates.isdelete','=','0')
            ->orderBy('certificates.id','desc');
        return Datatables::of($tasks)

            ->editColumn('release_date', function ($tasks) {
                return $tasks->release_date ? with(new Carbon($tasks->release_date))->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCertificate') and $request->get('searchCertificate') != "") {
                    $tasks->where('certificates.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('opt.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('students.nameAR', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('students.nameEN', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.place_birth', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.year_birth', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.start_day', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.end_day', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.catch_receipt_id', 'like', "%{$request->get('searchCertificate')}%");
                        });
                }
                if ($request->has('yearId') and $request->get('yearId') != "") {
                    $tasks->where('certificates.year', '=', "{$request->get('yearId')}");
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('statusId') and $request->get('statusId') != "") {
                    $tasks->where('certificates.print_execute', '=', "{$request->get('statusId')}");
                }
            })
            ->with(['total'=>function($tasks){
                return $tasks->count('certificates.id');
            }])
            ->make(true);}
     public function anyAppreciationCertificate(Request $request)
    {
        $tasks = Certificate::select([ 'certificates.id','certificates.uid', 'certificates.student_name', 'certificates.description', 'certificates.year','certificates.print_execute', 'certificates.release_date'])
            ->where('certificates.type','=','87')
            ->where('certificates.isdelete','=','0')
            ->orderBy('certificates.id','desc');
        return Datatables::of($tasks)

            ->editColumn('release_date', function ($tasks) {
                return $tasks->release_date ? with(new Carbon($tasks->release_date))->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCertificate') and $request->get('searchCertificate') != "") {
                    $tasks->where('certificates.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('opt.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.description', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.studentname', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.year', 'like', "%{$request->get('searchCertificate')}%");
                        });
                }
                if ($request->has('yearId') and $request->get('yearId') != "") {
                    $tasks->where('certificates.year', '=', "{$request->get('yearId')}");
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }

                if ($request->has('statusId') and $request->get('statusId') != "") {
                    $tasks->where('certificates.print_execute', '=', "{$request->get('statusId')}");
                }
            })
            ->with(['total'=>function($tasks){
                return $tasks->count('certificates.id');
            }])
            ->make(true);
    }
     public function anyInternationalCertificate(Request $request)
    {
        $tasks = Certificate::leftJoin('options as opt', 'opt.id','=','certificates.type')
            ->leftJoin('options as o', 'o.id','=','certificates.course_id')
            ->leftJoin('options as opti', 'opti.id','=','certificates.nationality')
            ->leftJoin('students', 'students.id','=','certificates.student_id')
            ->select([ 'certificates.id','certificates.uid','certificates.year', 'opt.title as type', 'students.nameEN as studentEN','opti.title as nationality', 'o.title as courseAR', 'certificates.place_birth', 'certificates.year_birth', 'certificates.start_day', 'certificates.end_day','certificates.total_hours as hours', 'certificates.print_execute', 'certificates.release_date'])
            ->where('certificates.type','=','86')
            ->where('certificates.isdelete','=','0')
            ->orderBy('certificates.id','desc');
        return Datatables::of($tasks)

            ->editColumn('release_date', function ($tasks) {
                return $tasks->release_date ? with(new Carbon($tasks->release_date))->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCertificate') and $request->get('searchCertificate') != "") {
                    $tasks->where('certificates.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('opt.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('students.nameAR', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('students.nameEN', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.place_birth', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.year_birth', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.start_day', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.end_day', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.catch_receipt_id', 'like', "%{$request->get('searchCertificate')}%");
                        });
                }
                if ($request->has('yearId') and $request->get('yearId') != "") {
                    $tasks->where('certificates.year', '=', "{$request->get('yearId')}");
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('statusId') and $request->get('statusId') != "") {
                    $tasks->where('certificates.print_execute', '=', "{$request->get('statusId')}");
                }
            })
            ->with(['total'=>function($tasks){
                return $tasks->count('certificates.id');
            }])
            ->make(true);}

    public function anyBox(Request $request)
    {
        $tasks = Box::leftJoin('options', 'options.id','=','boxes.type')
            ->leftJoin('boxes as b', 'b.id','=','boxes.parent_id')
            ->leftJoin('repositories as rep', 'rep.id','=','boxes.repository_id')
            ->select([ 'boxes.id', 'boxes.m_year', 'boxes.name', 'rep.name as repository_id', 'options.title as type', 'boxes.calculator_first','b.name as parent_id','boxes.income','boxes.expense','boxes.type as btype','boxes.active', 'boxes.created_at', 'boxes.isdelete'])
            ->where('boxes.isdelete','=','0');
        return Datatables::of($tasks)
            ->editColumn('calculator_first', function ($tasks) {
                if($tasks->id ==1){
                    $money_year = Money_year::where('year',$this->getMoneyYear())->first();
                    if($money_year->first_time_balance !=0){
                    return $tasks->calculator_first = $money_year->first_time_balance + $tasks->calculator_first;
                    }else{
                return $tasks->calculator_first;
                }
                }else{
                return $tasks->calculator_first;
                }
            })
            ->editColumn('income', function ($tasks) {

                if($tasks->id==3){
                    $courses_receipt = Catch_receipt::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->update(array('income' => $courses_receipt));
                    $tasks->income=$courses_receipt;
                }
                if($tasks->id==4){
                    $advance_receipt = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('advance_payment');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->update(array('income' => $advance_receipt));
                    $tasks->income=$advance_receipt;
                }
                if($tasks->repository_id >0){
                    $tasks->income = Repository_in::where('repository_id','=',$tasks->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('total');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->update(array('income' => $tasks->income));
                }
                if($tasks->type=="مستقل"){
                    $tasks->income = Catch_receipt_box::where('box_id','=',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');

                }

                return number_format($tasks->income,2);
            })
            ->editColumn('expense', function ($tasks) {
                if($tasks->id==3){
                    $teacher_salaries = Receipt_course::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');
                    $receipt_students = Receipt_student::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');

                    $tasks->expense=$teacher_salaries + $receipt_students;
                }
                if($tasks->id==4){
                    $salaries = Receipt_salary::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');
                    $warranties = Receipt_warranty::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');
                    $advances = Receipt_advance::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('advance_payment');
                    $tasks->expense=$salaries+$warranties+$advances;


                }
                if($tasks->repository_id >0){
                    $tasks->expense = Repository_out::where('repository_id','=',$tasks->repository_id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('total');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->update(array('income' => $tasks->income));
                }
                if($tasks->type=="مستقل"){
                    $tasks->expense = Receipt_box::where('box_id','=',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');
                    Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->update(array('income' => $tasks->income));
                }
                return number_format($tasks->expense,2);
            })
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('parent_id', function ($tasks) {
                return $tasks->parent_id!=null ? $tasks->parent_id:'بلا';
            })

            ->addColumn('repository_id', function ($tasks) {
                return $tasks->repository_id!=null?$tasks->repository_id:'بلا' ;
            })
            ->addColumn('per', function ($tasks) {
                $isPer=BoxPer::where('box_id',$tasks->id)->count();
                $ppppp=[];
                if ($isPer>0){
                    $per=BoxPer::where('box_id',$tasks->id)->get();
                    foreach ($per as $p){
                        $user=User::find($p->user_id)->id;
                        array_push($ppppp,$user);
                    }
                }
                return $ppppp;
            })
            ->addColumn('lock', function ($tasks) {
                $isPer=Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->count();
                $lock=0;
                if ($isPer>0){
                    $per=Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->first();
                    $lock=$per->islock;
                }
                return $lock;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchBox') && $request->get('searchBox') != "") {
                    $tasks->where('boxes.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('options.title', 'like', "%{$request->get('searchBox')}%")
                                ->orWhere('boxes.name', 'like', "%{$request->get('searchBox')}%")
                                ->orWhere('b.name', 'like', "%{$request->get('searchBox')}%");
                        });
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->leftJoin('box_year', 'box_year.box_id','=','boxes.id')
                        ->select([ 'boxes.id', 'boxes.m_year', 'boxes.name', 'rep.name as repository_id', 'options.title as type', 'box_year.calculator_first','b.name as parent_id','box_year.income','box_year.expense','boxes.active', 'boxes.created_at', 'boxes.isdelete'])
                        ->where('box_year.m_year','=',"{$request->get('moneyId')}");
                }
                // if ($this->getId()!=null) {
                //     $tasks->leftJoin('box_per', 'box_per.box_id','=','boxes.id')
                //         ->select([ 'boxes.id', 'boxes.m_year', 'boxes.name', 'rep.name as repository_id', 'options.title as type', 'box_year.calculator_first','b.name as parent_id','box_year.income','box_year.expense','boxes.active', 'boxes.created_at', 'boxes.isdelete'])
                //         ->where('box_per.user_id','=',"{$this->getId()}");
                // }
            })


            ->make(true);
    }

    public function anyBoxPer()
    {
        $tasks = Box::leftJoin('repositories as rep', 'rep.id','=','boxes.repository_id')
            ->select([ 'boxes.id','boxes.name','rep.name as repository_id','boxes.isdelete'])
            ->where('boxes.isdelete','=','0');
        return Datatables::of($tasks)
            ->addColumn('repository_id', function ($tasks) {
                return $tasks->repository_id!=null?$tasks->repository_id:'بلا' ;
            })
            ->addColumn('per', function ($tasks) {
                $isPer=BoxPer::where('box_id',$tasks->id)->count();
                $ppppp=[];
                if ($isPer>0){
                    $per=BoxPer::where('box_id',$tasks->id)->get();
                    foreach ($per as $p){
                        $user=User::find($p->user_id)->name;
                        array_push($ppppp,$user);
                    }
                }
                return $ppppp;
            })
            ->make(true);
    }

    public function anyMoney(Request $request)
    {
        $tasks = Money_year::select([ 'id', 'year', 'start_year', 'end_year', 'money_goal','first_time_balance','active','basic_work', 'created_at']);
        return Datatables::of($tasks->whereRaw("(isdelete=0)"))
            ->addColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('start_year', function ($tasks) {
                return $tasks->start_year ? with(new Carbon($tasks->start_year))
                    ->format('Y-m-d') : '';
            })
            ->editColumn('end_year', function ($tasks) {
                return $tasks->end_year ? with(new Carbon($tasks->end_year))
                    ->format('Y-m-d') : '';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchMoney') && $request->get('searchMoney') != "") {
                    $tasks->where('isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('money_goal', 'like', "%{$request->get('searchMoney')}%")
                                ->orWhere('first_time_balance', 'like', "%{$request->get('searchMoney')}%")
                                ->orWhere('start_year', 'like', "%{$request->get('searchMoney')}%")
                                ->orWhere('end_year', 'like', "%{$request->get('searchMoney')}%")
                                ->orWhere('created_at', 'like binary', "%{$request->get('searchMoney')}%");
                        });
                }
            })
            ->make(true);
    }

    public function anySalary(Request $request)
    {
        $tasks = Salary::leftJoin('employees', 'employees.id','=','salaries.employee_id')
            ->select([ 'salaries.id', 'employees.name as employee_id', 'salaries.year', 'salaries.month', 'salaries.salary','salaries.salary_warranty','salaries.warranty_secretariats','salaries.warranty_contributions', 'salaries.created_at'])
            ->where('salaries.isdelete','=','0');
        return Datatables::of($tasks)
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchSalary') && $request->get('searchSalary') != "") {
                    $tasks->where('salaries.isdelete','=','0')
                    ->where(function ($tasks) use ($request){
                        $tasks->where('employees.name', 'like', "%{$request->get('searchSalary')}%")
                            ->orWhere('salaries.year', 'like', "%{$request->get('searchSalary')}%")
                            ->orWhere('salaries.month', 'like', "%{$request->get('searchSalary')}%")
                            ->orWhere('salaries.salary', 'like', "%{$request->get('searchSalary')}%")
                            ->orWhere('salaries.salary_warranty', 'like', "%{$request->get('searchSalary')}%")
                            ->orWhere('salaries.warranty_secretariats', 'like', "%{$request->get('searchSalary')}%")
                            ->orWhere('salaries.warranty_contributions', 'like', "%{$request->get('searchSalary')}%")
                            ->orWhere('salaries.created_at', 'like binary', "%{$request->get('searchSalary')}%");
                    });
                }
                if ($request->has('employeeId') and $request->get('employeeId') != "") {
                    $tasks->where('employees.id', '=', "{$request->get('employeeId')}");
                }
                if ($request->has('monthId') and $request->get('monthId') != "") {
                    $tasks->where('salaries.month', '=', "{$request->get('monthId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('salaries.year', '=', "{$request->get('moneyId')}");
                }
            })
            ->make(true);
    }

    public function anyEmployeeSalary(Request $request)
    {
        $tasks = Salary::leftJoin('employees', 'employees.id','=','salaries.employee_id')
            ->select([ 'salaries.id', 'employees.name as employee_id', 'employees.id as emp_id', 'salaries.year', 'salaries.month', 'salaries.salary','salaries.salary_warranty','salaries.warranty_secretariats','salaries.warranty_contributions', 'salaries.created_at'])
            ->where('salaries.isdelete','=','0');
        return Datatables::of($tasks)

            ->addColumn('rew', function ($tasks) {
                $rew=0;
                $isReceipt_reward=Receipt_reward::where('employee_id',$tasks->emp_id)->where('type',0)->where('receipts_rewards',$tasks->month)->where('isdelete',0)->where('m_year',$tasks->year)->count();
                if ($isReceipt_reward>0){
                    $receipt_rewards=Receipt_reward::where('employee_id',$tasks->emp_id)->where('type',0)->where('receipts_rewards',$tasks->month)->where('isdelete',0)->where('m_year',$tasks->year)->get();
                    foreach ($receipt_rewards as $receipt_reward){
                        $rew += $receipt_reward->amount;
                    }
                }
                return $rew;
            })
            ->addColumn('rec', function ($tasks) {
                $rec=0;
                $isReceipt_reward=Receipt_reward::where('employee_id',$tasks->emp_id)->where('type',1)->where('receipts_rewards',$tasks->month)->where('isdelete',0)->where('m_year',$tasks->year)->count();
                if ($isReceipt_reward>0){
                    $receipt_rewards=Receipt_reward::where('employee_id',$tasks->emp_id)->where('type',1)->where('receipts_rewards',$tasks->month)->where('isdelete',0)->where('m_year',$tasks->year)->get();
                    foreach ($receipt_rewards as $receipt_reward){
                        $rec += $receipt_reward->amount;
                    }
                }
                return $rec;
            })
            ->addColumn('net', function ($tasks) {
                $net=0;
                $rec=0;
                $rew=0;
                $isReceipt_reward=Receipt_reward::where('employee_id',$tasks->emp_id)->where('type',0)->where('receipts_rewards',$tasks->month)->where('isdelete',0)->where('m_year',$tasks->year)->count();
                if ($isReceipt_reward>0){
                    $receipt_rewards=Receipt_reward::where('employee_id',$tasks->emp_id)->where('type',0)->where('receipts_rewards',$tasks->month)->where('isdelete',0)->where('m_year',$tasks->year)->get();
                    foreach ($receipt_rewards as $receipt_reward){
                        $rew += $receipt_reward->amount;
                    }
                }
                $isReceipt_receipt=Receipt_reward::where('employee_id',$tasks->emp_id)->where('type',1)->where('receipts_rewards',$tasks->month)->where('isdelete',0)->where('m_year',$tasks->year)->count();
                if ($isReceipt_receipt>0){
                    $receipt_receipts=Receipt_reward::where('employee_id',$tasks->emp_id)->where('type',1)->where('receipts_rewards',$tasks->month)->where('isdelete',0)->where('m_year',$tasks->year)->get();
                    foreach ($receipt_receipts as $receipt_receipt){
                        $rec += $receipt_receipt->amount;
                    }
                }
                $net = $tasks->salary + $rew - $rec;
                return $net;
            })
            ->addColumn('recs', function ($tasks) {
                $recs=0;
                $isReceipt_salary=Receipt_salary::where('employee_id',$tasks->emp_id)->where('month',$tasks->month)->where('m_year',$tasks->year)->where('isdelete',0)->count();
                if ($isReceipt_salary>0){
                    $receipt_salarys=Receipt_salary::where('employee_id',$tasks->emp_id)->where('month',$tasks->month)->where('m_year',$tasks->year)->where('isdelete',0)->get();
                    foreach ($receipt_salarys as $receipt_salary){
                        $recs += $receipt_salary->amount;
                    }
                }
                return $recs;
            })
            ->addColumn('adv', function ($tasks) {
                $adv=0;
                $isReceipt_advance=Receipt_advance::where('employee_id',$tasks->emp_id)->where('m_year',$tasks->year)->where('isdelete',0)->count();
                if ($isReceipt_advance>0){
                    $receipt_advances=Receipt_advance::where('employee_id',$tasks->emp_id)->where('m_year',$tasks->year)->where('isdelete',0)->get();
                    foreach ($receipt_advances as $receipt_advance){
                        $nn=$receipt_advance->start_payment;
                        $mm=$receipt_advance->start_payment+$receipt_advance->month_count;
                        for ($i=$nn;$i<$mm;$i++){
                            if ($tasks->month == $i){
                                $adv = $receipt_advance->month_payment;
                            }
                        }
                    }
                }
                return number_format($adv,2);
            })
            ->addColumn('rem', function ($tasks) {
                $rem=0;

                $net=0;
                $rec=0;
                $rew=0;
                $isReceipt_reward=Receipt_reward::where('employee_id',$tasks->emp_id)->where('type',0)->where('receipts_rewards',$tasks->month)->where('m_year',$tasks->year)->count();
                if ($isReceipt_reward>0){
                    $receipt_rewards=Receipt_reward::where('employee_id',$tasks->emp_id)->where('type',0)->where('receipts_rewards',$tasks->month)->where('isdelete',0)->where('m_year',$tasks->year)->get();
                    foreach ($receipt_rewards as $receipt_reward){
                        $rew += $receipt_reward->amount;
                    }
                }
                $isReceipt_receipt=Receipt_reward::where('employee_id',$tasks->emp_id)->where('type',1)->where('receipts_rewards',$tasks->month)->where('m_year',$tasks->year)->where('isdelete',0)->count();
                if ($isReceipt_receipt>0){
                    $receipt_receipts=Receipt_reward::where('employee_id',$tasks->emp_id)->where('type',1)->where('receipts_rewards',$tasks->month)->where('m_year',$tasks->year)->where('isdelete',0)->get();
                    foreach ($receipt_receipts as $receipt_receipt){
                        $rec += $receipt_receipt->amount;
                    }
                }
                $net = $tasks->salary + $rew - $rec;

                $recs=0;
                $isReceipt_salary=Receipt_salary::where('employee_id',$tasks->emp_id)->where('month',$tasks->month)->where('isdelete',0)->where('m_year',$tasks->year)->count();
                if ($isReceipt_salary>0){
                    $receipt_salarys=Receipt_salary::where('employee_id',$tasks->emp_id)->where('month',$tasks->month)->where('isdelete',0)->where('m_year',$tasks->year)->get();
                    foreach ($receipt_salarys as $receipt_salary){
                        $recs += $receipt_salary->amount;
                    }
                }

                $adv=0;
                $isReceipt_advance=Receipt_advance::where('employee_id',$tasks->emp_id)->where('m_year',$tasks->year)->where('isdelete',0)->count();
                if ($isReceipt_advance>0){
                    $receipt_advances=Receipt_advance::where('employee_id',$tasks->emp_id)->where('isdelete',0)->where('m_year',$tasks->year)->get();
                    foreach ($receipt_advances as $receipt_advance){
                        $nn=$receipt_advance->start_payment;
                        $mm=$receipt_advance->start_payment+$receipt_advance->month_count;
                        for ($i=$nn;$i<$mm;$i++){
                            if ($tasks->month == $i){
                                $adv = $receipt_advance->month_payment;
                            }
                        }
                    }
                }

                $rem=$net-($recs+$adv);
                return number_format($rem,2);
            })
            ->addColumn('wan', function ($tasks) {
                $wan=0;
                $isReceipt_warranty=Receipt_warranty::where('salary_id',$tasks->id)->where('m_year',$tasks->year)->count();
                if ($isReceipt_warranty>0){
                    $receipt_warrantys=Receipt_warranty::where('salary_id',$tasks->id)->where('isdelete',0)->where('m_year',$tasks->year)->get();
                    foreach ($receipt_warrantys as $receipt_warranty){
                        $wan += $receipt_warranty->amount;
                    }
                }
                return number_format($wan,2);
            })
            /*->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('Y-m-d') : '';
            })*/
            ->filter(function ($tasks) use ($request) {
                if ($request->has('employeeId') and $request->get('employeeId') != "") {
                    $tasks->where('employees.id', '=', "{$request->get('employeeId')}");
                }
                if ($request->has('monthId') and $request->get('monthId') != "") {
                    $tasks->where('salaries.month', '=', "{$request->get('monthId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('salaries.year', '=', "{$request->get('moneyId')}");
                }
            })
            ->make(true);
    }

    public function anyWithdrawal(Request $request)
    {
        $tasks = Withdrawal::leftJoin('student_course as sc', 'sc.id','=','withdrawals.student_course_id')
            ->leftJoin('students', 'students.id','=','sc.student_id')
            ->leftJoin('courses', 'courses.id','=','sc.course_id')
            ->leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->select([ 'withdrawals.id','withdrawals.m_year', 'students.nameAR as student_id', 'withdrawals.phone', 'courses.courseAR as course_id', 'withdrawals.price', 'withdrawals.payment','withdrawals.refund','withdrawals.teacher_fees', 'withdrawals.created_at','teachers.name as teacher_name'])
            ->where('withdrawals.isdelete', '=', '0');
        return Datatables::of($tasks)
        ->addColumn('center_fees', function($tasks){
            $center_fees =  $tasks->refund + $tasks->teacher_fees;
            return number_format($tasks->payment-$center_fees,2);
        })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchWithdrawal') and $request->get('searchWithdrawal') != "") {
                    $tasks->where('withdrawals.isdelete', '=', '0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('courses.courseAR', 'like', "%{$request->get('searchWithdrawal')}%")
                                ->orWhere('students.nameAR', 'like', "%{$request->get('searchWithdrawal')}%")
                                ->orWhere('withdrawals.id', 'like', "%{$request->get('searchWithdrawal')}%")
                                ->orWhere('withdrawals.phone', 'like', "%{$request->get('searchWithdrawal')}%");
                        });
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('withdrawals.m_year', '=', "{$request->get('moneyId')}");
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('teacherId') and $request->get('teacherId') != "") {
                    $tasks->where('teachers.id', '=', "{$request->get('teacherId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('withdrawals.created_by', '=', "{$request->get('userId')}");
                }

            })


            ->with(['courseFee'=> function($tasks){
               return  number_format($tasks->sum('withdrawals.price'),2);

            },'coursePay'=> function($tasks){
               return  number_format($tasks->sum('withdrawals.payment'),2);

            },'courseRef'=> function($tasks){
               return  number_format($tasks->sum('withdrawals.refund'),2);

            },'courseTea'=> function($tasks){
               return  number_format($tasks->sum('withdrawals.teacher_fees'),2);

            },'courseWit'=> function($tasks){
               return  number_format(($tasks->sum('withdrawals.payment')-($tasks->sum('withdrawals.refund')+$tasks->sum('withdrawals.teacher_fees'))),2);

            },'courseMin'=> function($tasks){
               return  number_format(($tasks->sum('withdrawals.price')-(($tasks->sum('withdrawals.payment')-($tasks->sum('withdrawals.refund')+$tasks->sum('withdrawals.teacher_fees')))+$tasks->sum('withdrawals.teacher_fees'))),2);

            }])
            ->make(true);
    }

    public function anyCatchReceipt(Request $request)
    {
        $tasks = Catch_receipt::leftJoin('student_course as sc', 'sc.id','=','catch_receipts.student_course_id')
            ->leftJoin('students', 'students.id','=','sc.student_id')
            ->leftJoin('courses', 'courses.id','=','sc.course_id')
            ->leftJoin('users as us', 'us.id','=','catch_receipts.created_by')
            ->leftJoin('users as u', 'u.id','=','catch_receipts.updated_by')
            ->select([ 'catch_receipts.id','catch_receipts.id_comp','catch_receipts.date','catch_receipts.m_year', 'courses.courseAR as courseAR', 'students.nameAR as studentAR', 'catch_receipts.amount', 'catch_receipts.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('catch_receipts.isdelete','=','0');
        return Datatables::of($tasks)
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCatchReceipt') and $request->get('searchCatchReceipt') != "") {
                    $tasks->where('catch_receipts.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('courses.courseAR', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('students.nameAR', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('catch_receipts.id', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('catch_receipts.id_comp', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('catch_receipts.date', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('catch_receipts.amount', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('catch_receipts.created_at', 'like binary', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchCatchReceipt')}%");
                        });
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('us.id', '=', "{$request->get('userId')}");
                }
                if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                    $arrStart = explode("-", $request->get('fromId'));
                    $arrEnd = explode("-", $request->get('toId'));
                    $from = Carbon::create( $arrStart[0], $arrStart[1], $arrStart[2],0, 0, 0);
                    $to = Carbon::create( $arrEnd[0], $arrEnd[1], $arrEnd[2],23, 59, 59);
                    $tasks->whereBetween('catch_receipts.created_at',[$from,$to]);
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('catch_receipts.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with(['tot'=>function($tasks){
                return number_format($tasks->sum('catch_receipts.amount'),2);
                }])
            ->make(true);
    }

    public function anyQuota(Request $request)
    {
        $tasks = Quota::leftJoin('options as opti', 'opti.id','=','quota.day')
            ->leftJoin('options as opt', 'opt.id','=','quota.room')
            ->leftJoin('options as op', 'op.id','=','quota.type')
            ->leftJoin('options as o', 'o.id','=','quota.time')
            ->leftJoin('options as oo', 'oo.id','=','quota.time_to')
            ->leftJoin('courses', 'courses.id','=','quota.course_id')
            ->leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->leftJoin('users as us', 'us.id','=','quota.created_by')
            ->leftJoin('users as u', 'u.id','=','quota.updated_by')
            ->select([ 'quota.id','quota.m_year','opti.title as day','opt.title as room','op.title as type','o.title as time','oo.title as time_to', 'courses.courseAR as course_id', 'teachers.name as teacher_id', 'quota.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('quota.isdelete','=','0');
        return Datatables::of($tasks)
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchQuota') and $request->get('searchQuota') != "") {
                    $tasks->where('quota.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('courses.courseAR', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('teachers.name', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('opti.title', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('oo.title', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('quota.created_at', 'like binary', "%{$request->get('searchQuota')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchQuota')}%");
                        });
                }
                if ($request->has('dayId') and $request->get('dayId') != "") {
                    $tasks->where('opti.id', '=', "{$request->get('dayId')}");
                }
                if ($request->has('roomId') and $request->get('roomId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('roomId')}");
                }
                if ($request->has('typeId') and $request->get('typeId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('typeId')}");
                }
                if ($request->has('timeId') and $request->get('timeId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('timeId')}");
                }
                if ($request->has('timeToId') and $request->get('timeToId') != "") {
                    $tasks->where('oo.id', '=', "{$request->get('timeToId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('quota.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->make(true);
    }

    public function anyCatchReceiptBox(Request $request)
    {
        $tasks = Catch_receipt_box::leftJoin('boxes', 'boxes.id','=','catch_receipt_boxes.box_id')
            ->leftJoin('box_income', 'box_income.id','=','catch_receipt_boxes.type')
            ->leftJoin('users as us', 'us.id','=','catch_receipt_boxes.created_by')
            ->leftJoin('users as u', 'u.id','=','catch_receipt_boxes.updated_by')
            ->select([ 'catch_receipt_boxes.id','catch_receipt_boxes.id_comp','catch_receipt_boxes.date','catch_receipt_boxes.m_year','boxes.name as box_id', 'box_income.name as type', 'catch_receipt_boxes.customer', 'catch_receipt_boxes.count', 'catch_receipt_boxes.amount', 'catch_receipt_boxes.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('catch_receipt_boxes.isdelete','=','0');
        return Datatables::of($tasks)
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCatchReceiptBox') and $request->get('searchCatchReceiptBox') != "") {
                    $tasks->where('catch_receipt_boxes.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('box_income.name', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.customer', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.id', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.id_comp', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.date', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.count', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('boxes.name', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.amount', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.created_at', 'like binary', "%{$request->get('searchCatchReceiptBox')}%");
                        });
                }
                if ($request->has('boxId') and $request->get('boxId') != "") {
                    $tasks->where('boxes.id', '=', "{$request->get('boxId')}");
                }
                if ($request->has('incomeId') and $request->get('incomeId') != "") {
                    $tasks->where('box_income.id', '=', "{$request->get('incomeId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('catch_receipt_boxes.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                    $arrStart = explode("-", $request->get('fromId'));
                    $arrEnd = explode("-", $request->get('toId'));
                    $from = Carbon::create( $arrStart[0], $arrStart[1], $arrStart[2],0, 0, 0);
                    $to = Carbon::create( $arrEnd[0], $arrEnd[1], $arrEnd[2],23, 59, 59);
                    $tasks->whereBetween('catch_receipt_boxes.created_at',[$from,$to]);
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('catch_receipt_boxes.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with(['tot'=>function($tasks){
                return number_format($tasks->sum('catch_receipt_boxes.amount'),2);

            }])
            ->make(true);
    }

    public function anyReceiptCourse(Request $request)
    {
        $tasks = Receipt_course::leftJoin('courses', 'courses.id','=','receipt_courses.course_id')
            ->leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->leftJoin('users as us', 'us.id','=','receipt_courses.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_courses.updated_by')
            ->select([ 'receipt_courses.id','receipt_courses.id_comp','receipt_courses.date','receipt_courses.m_year', 'receipt_courses.type', 'teachers.name as teacher', 'courses.courseAR', 'receipt_courses.teacher_ratio', 'receipt_courses.amount', 'receipt_courses.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('receipt_courses.isdelete','=','0');
        return Datatables::of($tasks)
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptCourse') and $request->get('searchReceiptCourse') != "") {
                    $tasks->where('receipt_courses.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('teachers.name', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.type', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.id', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.id_comp', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.date', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.teacher_ratio', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.amount', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.created_at', 'like binary', "%{$request->get('searchReceiptCourse')}%");
                        });
                }
                if ($request->has('teacherId') and $request->get('teacherId') != "") {
                    $tasks->where('teachers.id', '=', "{$request->get('teacherId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_courses.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                    $arrStart = explode("-", $request->get('fromId'));
                    $arrEnd = explode("-", $request->get('toId'));
                    $from = Carbon::create( $arrStart[0], $arrStart[1], $arrStart[2],0, 0, 0);
                    $to = Carbon::create( $arrEnd[0], $arrEnd[1], $arrEnd[2],23, 59, 59);
                    $tasks->whereBetween('receipt_courses.created_at',[$from,$to]);
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_courses.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with(['tot'=>function($tasks){
                return number_format($tasks->sum('receipt_courses.amount'),2);
                }])
            ->make(true);
    }

    public function anyReceiptStudent(Request $request)
    {
        $tasks = Receipt_student::leftJoin('student_course', 'student_course.id','=','receipt_students.student_course_id')
            ->leftJoin('courses', 'courses.id','=','student_course.course_id')
            ->leftJoin('students', 'students.id','=','student_course.student_id')
            ->leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->leftJoin('users as us', 'us.id','=','receipt_students.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_students.updated_by')
            ->select([ 'receipt_students.id','receipt_students.id_comp','receipt_students.date','receipt_students.m_year', 'teachers.name as teacherAR', 'students.nameAR as studentAR', 'courses.courseAR', 'receipt_students.amount', 'receipt_students.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('receipt_students.isdelete','=','0')->where('receipt_students.m_year',$this->getMoneyYear());
        return Datatables::of($tasks)
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptStudent') and $request->get('searchReceiptStudent') != "") {
                    $tasks->where('receipt_students.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('students.nameAR', 'like', "%{$request->get('searchReceiptStudent')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchReceiptStudent')}%")
                                ->orWhere('receipt_students.id', 'like', "%{$request->get('searchReceiptStudent')}%")
                                ->orWhere('receipt_students.id_comp', 'like', "%{$request->get('searchReceiptStudent')}%")
                                ->orWhere('receipt_students.date', 'like', "%{$request->get('searchReceiptStudent')}%")
                                ->orWhere('receipt_students.amount', 'like', "%{$request->get('searchReceiptStudent')}%")
                                ->orWhere('receipt_students.created_at', 'like binary', "%{$request->get('searchReceiptStudent')}%");
                        });
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_students.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_students.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with(['tot'=>function($tasks){
                return number_format($tasks->sum('receipt_students.amount'),2);
                }])
            ->make(true);
    }

    public function anyReceiptSalary(Request $request)
    {
        $tasks = Receipt_salary::leftJoin('employees', 'employees.id','=','receipt_salaries.employee_id')
            ->leftJoin('boxes', 'boxes.id','=','receipt_salaries.box_id')
            ->leftJoin('users as us', 'us.id','=','receipt_salaries.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_salaries.updated_by')
            ->leftJoin('salaries', 'salaries.id','=','receipt_salaries.month')
            ->select([ 'receipt_salaries.id','receipt_salaries.id_comp','receipt_salaries.date','receipt_salaries.m_year','boxes.name as box_id', 'employees.name as employee_id', 'salaries.month', 'salaries.year', 'receipt_salaries.advance_payment', 'receipt_salaries.amount', 'receipt_salaries.created_at', 'us.name as created_by', 'u.name as updated_by'])
//            ->where('receipt_salaries.isdelete','=','0')->where('receipt_salaries.isAdmin','=','1');
            ->where('receipt_salaries.isdelete','=','0');
        return Datatables::of($tasks)
            ->addColumn('month', function ($tasks) {
                return $tasks->month."-".$tasks->year;
            })
            ->addColumn('total_amount', function ($tasks) {
                return number_format($tasks->amount+$tasks->advance_payment,2);
            })
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptSalary') and $request->get('searchReceiptSalary') != "") {
                    $tasks->where('receipt_salaries.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('employees.name', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.id', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.id_comp', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.date', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.month', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.remainder', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.amount', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.created_at', 'like binary', "%{$request->get('searchReceiptSalary')}%");
                        });
                }
                if ($request->has('employeeId') and $request->get('employeeId') != "") {
                    $tasks->where('employees.id', '=', "{$request->get('employeeId')}");
                }
                if ($request->has('monthId') and $request->get('monthId') != "") {
                    $tasks->where('receipt_salaries.month', '=', "{$request->get('monthId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_salaries.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_salaries.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with(['tot' => function($tasks)
                {
                     return $tasks->sum('receipt_salaries.amount');
                },'tot2' => function($tasks)
                {
                     return $tasks->sum('receipt_salaries.advance_payment');
                }])

            ->make(true);
    }

    public function anyReceiptReward(Request $request)
    {
        $tasks = Receipt_reward::leftJoin('employees', 'employees.id','=','receipt_rewards.employee_id')
            ->leftJoin('boxes', 'boxes.id','=','receipt_rewards.box_id')
            ->leftJoin('options as op', 'op.id','=','receipt_rewards.type')
            ->leftJoin('options as ops', 'ops.id','=','receipt_rewards.reason')
            ->leftJoin('users as us', 'us.id','=','receipt_rewards.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_rewards.updated_by')
            ->select([ 'receipt_rewards.id','receipt_rewards.id_comp','receipt_rewards.date','receipt_rewards.m_year', 'employees.name as employee_id','boxes.name as box_id', 'receipt_rewards.type', 'receipt_rewards.receipts_rewards', 'receipt_rewards.amount', 'receipt_rewards.created_at', 'us.name as created_by', 'u.name as updated_by','ops.title as reason'])
            ->where('receipt_rewards.isdelete','=','0');
        return Datatables::of($tasks)
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->editColumn('type', function ($tasks) {
                return $tasks->type==0?'مكافأت':'خصومات';
            })
            ->editColumn('created_by', function ($tasks) {
                return $tasks->created_by==null?'لا يوجد':$tasks->created_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptReward') and $request->get('searchReceiptReward') != "") {
                    $tasks->where('receipt_rewards.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('op.title', 'like', "%{$request->get('searchReceiptReward')}%")
                            ->orWhere('ops.title', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('employees.name', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.id', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.id_comp', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.date', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.receipts_rewards', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.amount', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.created_at', 'like binary', "%{$request->get('searchReceiptReward')}%");
                        });
                }
                if ($request->has('employeeId') and $request->get('employeeId') != "") {
                    $tasks->where('employees.id', '=', "{$request->get('employeeId')}");
                }
                if ($request->has('monthId') and $request->get('monthId') != "") {
                    $tasks->where('receipt_rewards.receipts_rewards', '=', "{$request->get('monthId')}");
                }
                if ($request->has('typeId') and $request->get('typeId') != "") {
                    $tasks->where('receipt_rewards.type', '=', "{$request->get('typeId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_rewards.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_rewards.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with(['deductions'=>function($tasks)
                {
                     $deductions= $tasks->where('receipt_rewards.type','=','1')->sum('receipt_rewards.amount');
                     return number_format($deductions,2);
                },'rewards'=>function($tasks) use ($request)
                {
                  $rewards= Receipt_reward::leftJoin('employees', 'employees.id','=','receipt_rewards.employee_id')
            ->leftJoin('options', 'options.id','=','receipt_rewards.type')
            ->where('receipt_rewards.isdelete','=','0')->where('receipt_rewards.type','=','0');

                  if ($request->has('searchReceiptReward') and $request->get('searchReceiptReward') != "") {

                  $rewards= $rewards->where(function ($rewards) use ($request){
                        $rewards->where('options.title', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('employees.name', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.id', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.id_comp', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.date', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.receipts_rewards', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.amount', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.created_at', 'like binary', "%{$request->get('searchReceiptReward')}%");
                        });
                }
                 if ($request->has('employeeId') and $request->get('employeeId') != "") {
                   $rewards= $rewards->where('employees.id', '=', "{$request->get('employeeId')}");
                }
                if ($request->has('monthId') and $request->get('monthId') != "") {
                   $rewards= $rewards->where('receipt_rewards.receipts_rewards', '=', "{$request->get('monthId')}");
                }
                if ($request->has('typeId') and $request->get('typeId') != "") {
                   $rewards= $rewards->where('receipt_rewards.type', '=', "{$request->get('typeId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                  $rewards=  $rewards->where('receipt_rewards.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                  $rewards=  $rewards->where('receipt_rewards.m_year', '=', "{$request->get('moneyId')}");
                }

                $rewards=$rewards->sum('receipt_rewards.amount');
                 return number_format($rewards,2);
                }])

            ->make(true);
    }

    public function anyReceiptWarranty(Request $request)
    {
        $tasks = Receipt_warranty::leftJoin('salaries', 'salaries.id','=','receipt_warranties.salary_id')

            ->leftJoin('employees', 'employees.id','=','salaries.employee_id')
            ->leftJoin('users as us', 'us.id','=','receipt_warranties.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_warranties.updated_by')
            ->select([ 'receipt_warranties.id','receipt_warranties.id_comp','receipt_warranties.date','receipt_warranties.m_year', 'employees.name as employee_id', 'salaries.month', 'salaries.year', 'salaries.salary_warranty as salary_id', 'receipt_warranties.amount', 'receipt_warranties.created_at', 'us.name as created_by','u.name as updated_by'])
            ->where('receipt_warranties.isdelete','=','0');
        return Datatables::of($tasks)
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->editColumn('monthYear', function ($tasks) {
                return $tasks->month."-".$tasks->year;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptWarranty') and $request->get('searchReceiptWarranty') != "") {
                    $tasks->where('receipt_warranties.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('salaries.salary', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('employees.name', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('receipt_warranties.id', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('receipt_warranties.id_comp', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('receipt_warranties.date', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('salaries.month', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('receipt_warranties.amount', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('receipt_warranties.created_at', 'like binary', "%{$request->get('searchReceiptWarranty')}%");
                        });
                }
                if ($request->has('employeeId') and $request->get('employeeId') != "") {
                    $tasks->where('employees.id', '=', "{$request->get('employeeId')}");
                }
                if ($request->has('monthId') and $request->get('monthId') != "") {
                    $tasks->where('salaries.month', '=', "{$request->get('monthId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_warranties.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_warranties.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with(['tot'=>function($tasks){
                return number_format($tasks->sum('receipt_warranties.amount'),2);
                }])
            ->make(true);
    }

    public function anyReceiptAdvance(Request $request)
    {
         $tasks = Receipt_advance::leftJoin('employees', 'employees.id','=','receipt_advances.employee_id')
            ->leftJoin('boxes', 'boxes.id','=','receipt_advances.box_id')
            ->leftJoin('users as us', 'us.id','=','receipt_advances.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_advances.updated_by')
            ->select([ 'receipt_advances.id','receipt_advances.id_comp','receipt_advances.date','boxes.name as box_id','receipt_advances.m_year', 'employees.name as employee_id', 'receipt_advances.advance_payment', 'receipt_advances.month_count', 'receipt_advances.month_payment', 'receipt_advances.start_payment', 'receipt_advances.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('receipt_advances.isdelete','=','0');
        return Datatables::of($tasks)
        ->editColumn('month_payment', function ($tasks) {
                return number_format($tasks->month_payment,2);
            })
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptAdvance') and $request->get('searchReceiptAdvance') != "") {
                    $tasks->where('receipt_advances.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('receipt_advances.id', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.id_comp', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.date', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('employees.name', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.advance_payment', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.month_count', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.month_payment', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.start_payment', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.created_at', 'like binary', "%{$request->get('searchReceiptAdvance')}%");
                        });
                }
                if ($request->has('employeeId') and $request->get('employeeId') != "") {
                    $tasks->where('employees.id', '=', "{$request->get('employeeId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_advances.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_advances.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with(['tot'=>function($tasks){
                return number_format($tasks->sum('receipt_advances.advance_payment'),2);
                }])
            ->make(true);
    }

    public function anyReceiptBox(Request $request)
    {
        $tasks = Receipt_box::leftJoin('boxes', 'boxes.id','=','receipt_boxes.box_id')
            ->leftJoin('box_expense', 'box_expense.id','=','receipt_boxes.type')
            ->leftJoin('users as us', 'us.id','=','receipt_boxes.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_boxes.updated_by')
            ->select([ 'receipt_boxes.id','receipt_boxes.id_comp','receipt_boxes.date','receipt_boxes.m_year','boxes.name as box_id', 'box_expense.name as type', 'receipt_boxes.amount', 'receipt_boxes.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('receipt_boxes.isdelete','=','0');
        return Datatables::of($tasks)
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptBox') and $request->get('searchReceiptBox') != "") {
                    $tasks->where('receipt_boxes.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('box_expense.name', 'like', "%{$request->get('searchReceiptBox')}%")
                                ->orWhere('receipt_boxes.date', 'like', "%{$request->get('searchReceiptBox')}%")
                                ->orWhere('receipt_boxes.id', 'like', "%{$request->get('searchReceiptBox')}%")
                                ->orWhere('receipt_boxes.id_comp', 'like', "%{$request->get('searchReceiptBox')}%")
                                ->orWhere('receipt_boxes.amount', 'like', "%{$request->get('searchReceiptBox')}%")
                                ->orWhere('boxes.name', 'like', "%{$request->get('searchReceiptBox')}%")
                                ->orWhere('receipt_boxes.created_at', 'like binary', "%{$request->get('searchReceiptBox')}%");
                        });
                }
                if ($request->has('boxId') and $request->get('boxId') != "") {
                    $tasks->where('boxes.id', '=', "{$request->get('boxId')}");
                }
                if ($request->has('expenseId') and $request->get('expenseId') != "") {
                    $tasks->where('box_expense.id', '=', "{$request->get('expenseId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_boxes.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                    $arrStart = explode("-", $request->get('fromId'));
                    $arrEnd = explode("-", $request->get('toId'));
                    $from = Carbon::create( $arrStart[0], $arrStart[1], $arrStart[2],0, 0, 0);
                    $to = Carbon::create( $arrEnd[0], $arrEnd[1], $arrEnd[2],23, 59, 59);
                    $tasks->whereBetween('receipt_boxes.created_at',[$from,$to]);
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_boxes.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with(['tot'=>function($tasks){
                return number_format($tasks->sum('receipt_boxes.amount'),2);
            }])
            ->make(true);
    }

    public function anyQueryUser(Request $request)
     {
        $tasks = Query_user::leftJoin('users', 'users.id','=','query_user.user_id')
            ->select([ 'query_user.id', 'users.name as user_id','query_user.subject','query_user.count','query_user.day1','query_user.day7','query_user.day15','query_user.day30','query_user.day60','query_user.day90','query_user.day180','query_user.last1','query_user.last2','query_user.last3'])
            ->where('users.Status','=','مفعل')
            ->where('users.isdelete','=','0');
        return Datatables::of($tasks)
            ->editColumn('count', function ($tasks) {
                if(is_numeric( $tasks->count ) && floor( $tasks->count ) != $tasks->count){
                $tasks->count= number_format($tasks->count, 2, '.', '');
                }
                return $tasks->count;
            })
            ->editColumn('day1', function ($tasks) {
                if(is_numeric( $tasks->day1 ) && floor( $tasks->day1 ) != $tasks->day1){
                $tasks->day1= number_format($tasks->day1, 2, '.', '');
                }
                return $tasks->day1;
            })
            ->editColumn('day7', function ($tasks) {
                if(is_numeric( $tasks->day7 ) && floor( $tasks->day7 ) != $tasks->day7){
                $tasks->day7= number_format($tasks->day7, 2, '.', '');
                }
                return $tasks->day7;
            })
            ->editColumn('day15', function ($tasks) {
                if(is_numeric( $tasks->day15 ) && floor( $tasks->day15 ) != $tasks->day15){
                $tasks->day15= number_format($tasks->day15, 2, '.', '');
                }
                return $tasks->day15;
            })
            ->editColumn('day30', function ($tasks) {
                if(is_numeric( $tasks->day30 ) && floor( $tasks->day30 ) != $tasks->day30){
                $tasks->day30= number_format($tasks->day30, 2, '.', '');
                }
                return $tasks->day30;
            })
            ->editColumn('day60', function ($tasks) {
                if(is_numeric( $tasks->day60 ) && floor( $tasks->day60 ) != $tasks->day60){
                $tasks->day60= number_format($tasks->day60, 2, '.', '');
                }
                return $tasks->day60;
            })
            ->editColumn('day90', function ($tasks) {
                if(is_numeric( $tasks->day90 ) && floor( $tasks->day90 ) != $tasks->day90){
                $tasks->day90= number_format($tasks->day90, 2, '.', '');
                }
                return $tasks->day90;
            })
            ->editColumn('day180', function ($tasks) {
                if(is_numeric( $tasks->day180 ) && floor( $tasks->day180 ) != $tasks->day180){
                $tasks->day180= number_format($tasks->day180, 2, '.', '');
                }
                return $tasks->day180;
            })
            ->editColumn('last1', function ($tasks) {
                if(is_numeric( $tasks->last1 ) && floor( $tasks->last1 ) != $tasks->last1){
                $tasks->last1= number_format($tasks->last1, 2, '.', '');
                }
                return $tasks->last1;
            })
            ->editColumn('last2', function ($tasks) {
                if(is_numeric( $tasks->last2 ) && floor( $tasks->last2 ) != $tasks->last2){
                $tasks->last2= number_format($tasks->last2, 2, '.', '');
                }
                return $tasks->last2;
            })
            ->editColumn('last3', function ($tasks) {
                if(is_numeric( $tasks->last3 ) && floor( $tasks->last3 ) != $tasks->last3){
                $tasks->last3= number_format($tasks->last3, 2, '.', '');
                }
                return $tasks->last3;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('users.id','=',"{$request->get('userId')}");
                }
                if ($request->has('subjectId') and $request->get('subjectId') != "") {
                    $tasks->where('query_user.subject','=',"{$request->get('subjectId')}");
                }
            })
            ->make(true);
    }

    public function anyIncomeLevel(Request $request)
    {
        $tasks = Income_levels::where('isdelete',0);
        return Datatables::of($tasks)
        ->addColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('balance', function ($tasks) {
                $common_boxes=Income_box::where('income_id',$tasks->id)->get();
                $balance=0;
                foreach($common_boxes as $common_box){
                $box= Box::find($common_box->box_id);
                if($box){
                  $arrStart = explode("-", $tasks->in_from);
                        $arrEnd = explode("-", $tasks->in_to);
                        $from = Carbon::create( $arrStart[0], $arrStart[1], $arrStart[2],0, 0, 0);
                        $to = Carbon::create( $arrEnd[0], $arrEnd[1], $arrEnd[2],23, 59, 59);
                    if($box->id==3){
                        $courses_receipt = Catch_receipt::where('isdelete','=','0')->whereBetween('date',[$from,$to])->sum('amount');

                        $balance+=$courses_receipt;
                    }
                    if($box->id==4){
                        $advance_receipt = Receipt_salary::where('isdelete','=','0')->whereBetween('date',[$from,$to])->sum('advance_payment');

                        $balance+=$advance_receipt;
                    }
                    if($box->repository_id >0){
                        $rep = Repository_in::where('repository_id','=',$box->repository_id)->where('isdelete','=','0')->whereBetween('created_at',[$from,$to])->sum('total');
                        $balance+=$rep;
                    }
                    if($box->type=="مستقل"){
                        $rtype = Catch_receipt_box::where('box_id','=',$box->id)->where('isdelete','=','0')->whereBetween('date',[$from,$to])->sum('amount');
                        $balance+=$rtype;
                    }
                }
                }
                $update=Income_levels::where('id',$tasks->id)->first();
                $update->balance=$balance;
                $update->save();
                return number_format($balance,2);
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('m_year', '=', "{$request->get('moneyId')}");
                }
            })
        ->make(true);
    }

    public function anyRepository(Request $request)
    {

        $tasks = Repository::leftJoin('boxes', 'boxes.id','=','repositories.box_id')
        ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
            ->select([ 'repositories.id', 'boxes.name as box_id', 'repositories.name', 'repositories.repository_out', 'repositories.repository_in', 'repositories.active','repositories.isDone'])
            ->where('repositories.isdelete','=','0')
            ->where('repository_view.user_id','=',Auth::user()->id);
        return Datatables::of($tasks)
            ->addColumn('total', function ($tasks) {
                return number_format($tasks->repository_in-$tasks->repository_out,2) ;
            })
            ->editColumn('repository_in', function ($tasks) {
                return number_format($tasks->repository_in,2) ;
            })
            ->editColumn('repository_out', function ($tasks) {
                return number_format($tasks->repository_out,2) ;
            })
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('isDoneI', function ($tasks) {
                return $tasks->isDone;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchRepository') and $request->get('searchRepository') != "") {
                    $tasks->where('repositories.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('boxes.name', 'like', "%{$request->get('searchRepository')}%")
                                ->orWhere('repositories.name', 'like', "%{$request->get('searchRepository')}%");
                        });
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->leftJoin('repositories_year as rp', 'rp.repository_id','=','repositories.id')
                        ->select([ 'repositories.isDone','repositories.id', 'boxes.name as box_id', 'repositories.name', 'rp.repository_out', 'rp.repository_in', 'rp.active'])
                        ->where('rp.m_year','=',"{$request->get('moneyId')}");
                }
            })
            ->make(true);

    }

    public function anyMaterial(Request $request)
    {
        $tasks = Material::leftJoin('rep_sections', 'rep_sections.id','=','materials.section')
            ->leftJoin('repositories', 'repositories.id','=','materials.repository_id')
            ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
            ->leftJoin('users as us', 'us.id','=','materials.created_by')
            ->leftJoin('users as u', 'u.id','=','materials.updated_by')
            ->select([ 'materials.id', 'materials.name', 'rep_sections.name as section', 'repositories.name as repository_id', 'materials.count_old', 'materials.count_new', 'materials.single_cost', 'materials.single_pay', 'materials.active', 'us.name as created_by', 'u.name as updated_by'])
            ->where('materials.isdelete','=','0')
            ->where('repository_view.user_id','=',Auth::user()->id);
        return Datatables::of($tasks)
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchMaterial') and $request->get('searchMaterial') != "") {
                    $tasks->where('materials.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('materials.name', 'like', "%{$request->get('searchMaterial')}%")
                                ->orWhere('rep_sections.name', 'like', "%{$request->get('searchMaterial')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchMaterial')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchMaterial')}%")
                                ->orWhere('repositories.name', 'like', "%{$request->get('searchMaterial')}%");
                        });
                }
                if ($request->has('repositoryId') and $request->get('repositoryId') != "") {
                    $tasks->where('repositories.id', '=', "{$request->get('repositoryId')}");
                }
                if ($request->has('sectionId') and $request->get('sectionId') != "") {
                    $tasks->where('rep_sections.id', '=', "{$request->get('sectionId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('materials.active', '=', "{$request->get('activeId')}");
                }
            })
            ->make(true);
    }

    public function anyRepInventory(Request $request)
   {
        $tasks = Rep_inventory::leftJoin('rep_sections', 'rep_sections.id','=','rep_inventory.section_id')
            ->leftJoin('materials', 'materials.id','=','rep_inventory.material_id')
            ->select([ 'rep_inventory.id', 'rep_inventory.repository_id', 'rep_sections.name as section_id', 'materials.name as material_id', 'rep_inventory.pay_count', 'rep_inventory.last_price', 'rep_inventory.sum_pay', 'rep_inventory.count', 'rep_inventory.count_inv', 'rep_inventory.remaind', 'rep_inventory.rem_price'])
             ->where('materials.isdelete','=','0')
            ->where('rep_inventory.isdelete','=','0');

        return Datatables::of($tasks)
            ->filter(function ($tasks) use ($request) {

                if ($request->has('searchMaterial') and $request->get('searchMaterial') != "") {
                    $tasks->where('rep_sections.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('rep_sections.name', 'like', "%{$request->get('searchMaterial')}%")
                                ->orWhere('materials.name', 'like', "%{$request->get('searchMaterial')}%");
                        });
                }

                if ($request->has('sectionId') and $request->get('sectionId') != "") {
                    $tasks->where('rep_sections.id', '=', "{$request->get('sectionId')}");
                }
            })
            ->with(['total_rem_price' => function($tasks){
               return $tasks->sum('rep_inventory.rem_price');
                }])
            ->make(true);
    }

    public function anyRepInvRecord(Request $request)
    {
        $tasks = Rep_inv_record::leftJoin('repositories', 'repositories.id','=','rep_inv_record.repository_id')
            ->leftJoin('users as us', 'us.id','=','rep_inv_record.user_id')
            ->leftJoin('users as u', 'u.id','=','rep_inv_record.admin_id')
            ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
            ->select([ 'rep_inv_record.id', 'repositories.name as repository_id','rep_inv_record.inventory_num', 'us.name as user_id', 'u.name as admin_id', 'rep_inv_record.date_inv', 'rep_inv_record.date_done', 'rep_inv_record.sum_remaind'])
            ->where('repository_view.user_id','=',Auth::user()->id);
        return Datatables::of($tasks)
        ->addColumn('date_done', function ($tasks) {
            return $tasks->date_done ? with(new Carbon($tasks->date_done))->format('Y-m-d') : '';
        })
        ->addColumn('date_inv', function ($tasks) {
            return $tasks->date_inv ? with(new Carbon($tasks->date_inv))->format('Y-m-d') : '';
        })

            ->make(true);
    }

    public function anyRecordDone(Request $request)
    {
        $tasks = Record_done::leftJoin('users as create', 'create.id','=','record_done.created_by')
            ->leftJoin('users as res', 'res.id','=','record_done.res')
            ->select([ 'record_done.id','record_done.title','record_done.type','record_done.row_id','record_done.slug','record_done.isdelete','record_done.created_at','record_done.updated_at','create.name as created_by','res.name as res']);
        return Datatables::of($tasks)
        ->editColumn('created_at', function($tasks){
            return $tasks->created_at->format('Y-m-d h:i');
        })
        ->addColumn('type', function ($tasks) {
            if($tasks->type == 1){
                return 'موافق';
            }else{
                return 'رفض';
            }
        })
            ->make(true);
    }

    public function anyQuantity(Request $request)
    {
        $tasks = Quantity::leftJoin('rep_sections', 'rep_sections.id','=','quantities.section')
            ->leftJoin('repositories', 'repositories.id','=','quantities.repository_id')
            ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
            ->leftJoin('materials', 'materials.id','=','quantities.material_id')
            ->leftJoin('users as us', 'us.id','=','quantities.created_by')
            ->leftJoin('users as u', 'u.id','=','quantities.updated_by')
            ->select([ 'quantities.id','quantities.m_year', 'materials.name as material_id', 'rep_sections.name as section', 'repositories.name as repository_id', 'quantities.count', 'quantities.count_old', 'quantities.count_new', 'quantities.single_cost', 'quantities.single_pay', 'quantities.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('quantities.isdelete','=','0')
            ->where('repository_view.user_id','=',Auth::user()->id);
        return Datatables::of($tasks)
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })

            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchQuantity') and $request->get('searchQuantity') != "") {
                    $tasks->where('quantities.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('materials.name', 'like', "%{$request->get('searchQuantity')}%")
                                ->orWhere('rep_sections.name', 'like', "%{$request->get('searchQuantity')}%")
                                ->orWhere('repositories.name', 'like', "%{$request->get('searchQuantity')}%");
                        });
                }
                if ($request->has('repositoryId') and $request->get('repositoryId') != "") {
                    $tasks->where('repositories.id', '=', "{$request->get('repositoryId')}");
                }
                if ($request->has('sectionId') and $request->get('sectionId') != "") {
                    $tasks->where('rep_sections.id', '=', "{$request->get('sectionId')}");
                }
                if ($request->has('materialId') and $request->get('materialId') != "") {
                    $tasks->where('materials.id', '=', "{$request->get('materialId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('quantities.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->make(true);
    }

    public function anyRepositoryIn(Request $request)
    {
        $tasks = Repository_in::leftJoin('repositories', 'repositories.id','=','repository_ins.repository_id')
            ->leftJoin('rep_sections', 'rep_sections.id','=','repository_ins.section')
            ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
            ->leftJoin('users as us', 'us.id','=','repository_ins.created_by')
            ->leftJoin('users as u', 'u.id','=','repository_ins.updated_by')
            ->leftJoin('materials', 'materials.id','=','repository_ins.material_id')
            ->select([ 'repository_ins.id','repository_ins.m_year', 'materials.name as material_id', 'rep_sections.name as section', 'repositories.name as repository_id', 'repository_ins.quantity', 'repository_ins.total','repository_ins.notes', 'repository_ins.created_at', 'repository_ins.id_comp', 'repository_ins.customer','us.name as created_by', 'u.name as updated_by'])
            ->where('repository_ins.isdelete','=','0')
            ->where('repository_view.user_id','=',Auth::user()->id);
        return Datatables::of($tasks)
            ->addColumn('userName', function ($tasks) {
                return $tasks->updated_by!=null?$tasks->updated_by:$tasks->created_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->editColumn('total', function ($tasks) {
                 return number_format($tasks->total,2);
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchRepositoryIn') and $request->get('searchRepositoryIn') != "") {
                    $tasks->where('repository_ins.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('materials.name', 'like', "%{$request->get('searchRepositoryIn')}%")
                                ->orWhere('rep_sections.name', 'like', "%{$request->get('searchRepositoryIn')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchRepositoryIn')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchRepositoryIn')}%")
                                ->orWhere('repository_ins.notes', 'like', "%{$request->get('searchRepositoryIn')}%")
                                ->orWhere('repositories.name', 'like', "%{$request->get('searchRepositoryIn')}%");
                        });
                }
                if ($request->has('repositoryId') and $request->get('repositoryId') != "") {
                    $tasks->where('repositories.id', '=', "{$request->get('repositoryId')}");
                }
                if ($request->has('sectionId') and $request->get('sectionId') != "") {
                    $tasks->where('rep_sections.id', '=', "{$request->get('sectionId')}");
                }
                if ($request->has('materialId') and $request->get('materialId') != "") {
                    $tasks->where('materials.id', '=', "{$request->get('materialId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('us.id', '=', "{$request->get('userId')}");
                }
                if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                    $from=$request->get('fromId');
                    $to=$request->get('toId');
                    $tasks->whereBetween('repository_ins.created_at',[$from,$to]);
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('repository_ins.m_year', '=', "{$request->get('moneyId')}");
                }
            })

            ->with(['tot' => function($tasks)
                {
                     return number_format($tasks->sum('repository_ins.total'),2);
                },'qua' => function($tasks)
                {
                     return $tasks->sum('repository_ins.quantity');
                }])


            ->make(true);
    }

    public function anyRepositoryOut(Request $request)
    {
        $tasks = Repository_out::leftJoin('repositories', 'repositories.id','=','repository_outs.repository_id')
            ->leftJoin('users as us', 'us.id','=','repository_outs.created_by')
            ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
            ->leftJoin('users as u', 'u.id','=','repository_outs.updated_by')
            ->select([ 'repository_outs.id','repository_outs.m_year', 'repositories.name as repository_id', 'repository_outs.customer', 'repository_outs.statement', 'repository_outs.id_comp', 'repository_outs.total', 'repository_outs.created_at', 'us.name as created_by', 'u.name as updated_by'])
            // ->where("repository_outs.isdelete",'=','0')->where("repository_outs.isAdmin",'=','1');
            ->where("repository_outs.isdelete",'=','0')
            ->where('repository_view.user_id','=',Auth::user()->id);
        return Datatables::of($tasks)
            ->addColumn('userName', function ($tasks) {
                $tasks->updated_by != null?$tasks->updated_by:$tasks->created_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->editColumn('total', function ($tasks) {
                 return number_format($tasks->total,2);
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchRepositoryOut') and $request->get('searchRepositoryOut') != "") {
                    $tasks->where('repository_outs.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('repository_outs.customer', 'like', "%{$request->get('searchRepositoryOut')}%")
                                ->orWhere('repository_outs.statement', 'like', "%{$request->get('searchRepositoryOut')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchRepositoryOut')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchRepositoryOut')}%")
                                ->orWhere('repositories.name', 'like', "%{$request->get('searchRepositoryOut')}%");
                        });
                }
                if ($request->has('repositoryId') and $request->get('repositoryId') != "") {
                    $tasks->where('repositories.id', '=', "{$request->get('repositoryId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('us.id', '=', "{$request->get('userId')}")->orWhere('u.id', '=', "{$request->get('userId')}");
                }
                if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                    $from=$request->get('fromId');
                    $to=$request->get('toId');
                    $tasks->whereBetween('repository_outs.created_at',[$from,$to]);
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('repository_outs.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with(['tot' => function($tasks)
                {
                     return number_format($tasks->sum('repository_outs.total'),2);
                }])
            ->make(true);
    }

    public function anyRepositoryInventory(Request $request)
    {
        $tasks = Inventory_repo::leftJoin('repositories', 'repositories.id','=','inventoryrepos.repository_id')
            ->leftJoin('users as us', 'us.id','=','inventoryrepos.created_by')
            ->leftJoin('users as ur', 'ur.id','=','inventoryrepos.resUser_id')
            ->leftJoin('repository_view', 'repository_view.repository_id','=','repositories.id')
            /* ->leftJoin('users as u', 'u.id','=','inventoryrepos.updated_by') */
            ->select([ 'inventoryrepos.id','inventoryrepos.inventory_num', 'repositories.name as repository_id','repositories.id as rep_id', 'inventoryrepos.rem_price','inventoryrepos.is_end','inventoryrepos.is_accept','inventoryrepos.created_at','ur.name as resUser_id','us.name as created_by'/* ,'u.name as updated_by' */])
            ->where("inventoryrepos.isdelete",'=','0')->where('is_accept','0')
            ->where('repository_view.user_id','=',Auth::user()->id);
        return Datatables::of($tasks)
            /* ->addColumn('userName', function ($tasks) {
                $tasks->updated_by != null?$tasks->updated_by:$tasks->created_by;
            }) */
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })


            ->make(true);
    }


    public function anyEnglish(Request $request)
    {
        $tasks = English::leftJoin('options as opt', 'opt.id','=','englishes.classification')
            ->leftJoin('options as op', 'op.id','=','englishes.level_pass')
            ->leftJoin('users as us', 'us.id','=','englishes.created_by')
            ->leftJoin('users as u', 'u.id','=','englishes.updated_by')
            ->select([ 'englishes.id', 'englishes.date', 'student_name', 'englishes.cash_rec_id', 'englishes.total', 'op.title as level_pass', 'opt.title as classification', 'englishes.active', 'englishes.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('englishes.isdelete','=','0');
        return Datatables::of($tasks)
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by?$tasks->updated_by:$tasks->created_by;
            })
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('date', function ($tasks) {
                return $tasks->date ? with(new Carbon($tasks->date))->format('Y-m-d') : '';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchEnglish') and $request->get('searchEnglish') != "") {
                    $tasks->where('englishes.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('student_name', 'like', "%{$request->get('searchEnglish')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchEnglish')}%")
                                ->orWhere('englishes.cash_rec_id', 'like', "%{$request->get('searchEnglish')}%")
                                ->orWhere('englishes.date', 'like', "%{$request->get('searchEnglish')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchEnglish')}%");
                        });
                }
                if ($request->has('classId') and $request->get('classId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('classId')}");
                }
                if ($request->has('levelId') and $request->get('levelId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('levelId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('englishes.active', '=', "{$request->get('activeId')}");
                }
            })
            ->make(true);
    }

    public function anyArchive(Request $request)
    {
        $tasks = Archive::leftJoin('options as opt', 'opt.id','=','archives.section')
            ->leftJoin('options as op', 'op.id','=','archives.sub_section')
            ->leftJoin('archive_view', 'archive_view.archive_id','=','archives.id')
            ->select([ 'archives.id', 'opt.title as section', 'op.title as sub_section', 'archives.address', 'archives.active', 'archives.created_at'])
            ->where('archives.isdelete','=','0')
            ->where('archive_view.user_id','=',Auth::user()->id);

        return Datatables::of($tasks)
            ->addColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchArchive') and $request->get('searchArchive') != "") {
                    $tasks->where('archives.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('opt.title', 'like', "%{$request->get('searchArchive')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchArchive')}%")
                                ->orWhere('address', 'like', "%{$request->get('searchArchive')}%");
                        });
                }
                if ($request->has('sectionId') and $request->get('sectionId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('sectionId')}");
                }
                if ($request->has('subSectionId') and $request->get('subSectionId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('subSectionId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('archives.active', '=', "{$request->get('activeId')}");
                }
            })
            ->make(true);
    }

    public function anyOffer(Request $request)
    {
        $tasks = Offer::leftJoin('options', 'options.id','=','offers.type')
            ->leftJoin('users as us', 'us.id','=','offers.created_by')
            ->leftJoin('users as u', 'u.id','=','offers.updated_by')
            ->select([ 'offers.id', 'offers.date', 'offers.title', 'options.title as type', 'offers.fees_reg', 'offers.fees_bag', 'offers.fees_course', 'offers.amount', 'offers.discount_r', 'offers.discount_v', 'offers.total', 'offers.active', 'offers.created_at', 'offers.updated_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('offers.isdelete','=','0');
        return Datatables::of($tasks)
            ->addColumn('activeI', function ($tasks) {
                return $tasks->active==1?'ساري':'غير فعال';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->updated_at ? with(new Carbon($tasks->updated_at))->format('Y-m-d') : with(new Carbon($tasks->created_at))->format('Y-m-d');
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchOffer') and $request->get('searchOffer') != "") {
                    $tasks->where('offers.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('offers.title', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('options.title', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('offers.amount', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('offers.discount_r', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('offers.discount_v', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('offers.total', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('offers.created_at', 'like binary', "%{$request->get('searchOffer')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchOffer')}%");
                        });
                }
                if ($request->has('typeId') and $request->get('typeId') != "") {
                    $tasks->where('options.id', '=', "{$request->get('typeId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('offers.active', '=', "{$request->get('activeId')}");
                }
            })
            ->make(true);
    }
/*
    public function anyAbsence(Request $request)
    {
        $tasks = Absence::leftJoin('employees', 'employees.id','=','absences.employee_id')
            ->leftJoin('options as opt', 'opt.id','=','absences.region')
            ->leftJoin('options as op', 'op.id','=','absences.type')
            ->leftJoin('options as o', 'o.id','=','absences.leaving')
            ->select([ 'absences.id', 'absences.m_year', 'employees.name as employee_id', 'absences.hour_out', 'absences.hour_in', 'op.title as type', 'absences.center_car', 'opt.title as region', 'o.title as leaving', 'absences.created_at'])
            ->where('absences.isdelete','=','0')->where('absences.isAdmin','=','1');
        return Datatables::of($tasks)
            ->editColumn('center_car', function ($tasks) {
                return $tasks->center_car ? 'نعم' : 'لا';
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d h:i') : '';
            })
            ->addColumn('hour_in', function ($tasks) {
                return $tasks->hour_in ? with(new Carbon($tasks->hour_in))->format('Y-m-d h:i') : null;
            })
            ->addColumn('hour_out', function ($tasks) {
                return $tasks->hour_out ? with(new Carbon($tasks->hour_out))->format('Y-m-d h:i') : null;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchAbsence') and $request->get('searchAbsence') != "") {
                    $tasks->where('absences.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('opt.title', 'like', "%{$request->get('searchAbsence')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchAbsence')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchAbsence')}%")
                                ->orWhere('employees.name', 'like', "%{$request->get('searchAbsence')}%");
                        });
                }
                if ($request->has('employeeId') and $request->get('employeeId') != "") {
                    $tasks->where('employees.id', '=', "{$request->get('employeeId')}");
                }
                if ($request->has('regionId') and $request->get('regionId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('regionId')}");
                }
                if ($request->has('typeId') and $request->get('typeId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('typeId')}");
                }
                if ($request->has('leavingId') and $request->get('leavingId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('leavingId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('absences.m_year', '=', "{$request->get('moneyId')}");
                }
                 if ($request->has('from_h') and $request->has('to_h') and $request->get('from_h') != "" and $request->get('to_h') != "") {
                    $arrStart = explode("-", $request->get('from_h'));
                    $arrEnd = explode("-", $request->get('to_h'));
                    $from = Carbon::create( $arrStart[0], $arrStart[1], $arrStart[2],0, 0, 0);
                    $to = Carbon::create( $arrEnd[0], $arrEnd[1], $arrEnd[2],23, 59, 59);
                    $tasks->whereBetween('absences.created_at',[$from,$to]);
                }
                if ($request->has('from_h') and $request->has('to_h') and $request->get('from_h') != "" and $request->get('to_h') != "") {
                    $from=$request->get('from_h');
                    $to=$request->get('to_h');
                    $tasks->whereBetween('absences.created_at',[$from,$to]);
                }
            })
            ->make(true);
    }
 */
    public function anyAbsenceS(Request $request)
    {
        $tasks = Absence_s::leftJoin('student_course', 'student_course.id','=','absences_s.student_course_id')
            ->leftJoin('courses', 'courses.id','=','student_course.course_id')
            ->leftJoin('students', 'students.id','=','student_course.student_id')
            ->leftJoin('users as us', 'us.id','=','absences_s.created_by')
            ->leftJoin('users as u', 'u.id','=','absences_s.updated_by')
            ->select([ 'absences_s.id','absences_s.date','absences_s.m_year', 'students.nameAR as student_id', 'courses.courseAR as course_id', 'absences_s.type', 'absences_s.delay_time', 'absences_s.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('absences_s.isdelete','=','0');
        return Datatables::of($tasks)
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by?$tasks->updated_by:$tasks->created_by;
            })
            ->editColumn('type', function ($tasks) {
                return $tasks->type ? 'تأخير' : 'غياب';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchAbsence') and $request->get('searchAbsence') != "") {
                    $tasks->where('absences_s.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('students.nameAR', 'like', "%{$request->get('searchAbsence')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchAbsence')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchAbsence')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchAbsence')}%");
                        });
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('typeId') and $request->get('typeId') != "") {
                    $tasks->where('absences_s.type', '=', "{$request->get('typeId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('absences_s.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->make(true);
    }

    public function anyAbsenceT(Request $request)
    {
        $tasks = Absence_t::leftJoin('courses', 'courses.id','=','absences_t.course_id')
            ->leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->leftJoin('users as us', 'us.id','=','absences_t.created_by')
            ->leftJoin('users as u', 'u.id','=','absences_t.updated_by')
            ->select([ 'absences_t.id','absences_t.m_year','absences_t.date', 'teachers.name as teacher_id', 'courses.courseAR as course_id', 'absences_t.type', 'absences_t.delay_time', 'absences_t.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('absences_t.isdelete','=','0');
        return Datatables::of($tasks)
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by?$tasks->updated_by:$tasks->created_by;
            })
            ->editColumn('type', function ($tasks) {
                return $tasks->type ? 'تأخير' : 'غياب';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchAbsence') and $request->get('searchAbsence') != "") {
                    $tasks->where('absences_t.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('teachers.name', 'like', "%{$request->get('searchAbsence')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchAbsence')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchAbsence')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchAbsence')}%");
                        });
                }
                if ($request->has('teacherId') and $request->get('teacherId') != "") {
                    $tasks->where('teachers.id', '=', "{$request->get('teacherId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('typeId') and $request->get('typeId') != "") {
                    $tasks->where('absences_t.type', '=', "{$request->get('typeId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('absences_t.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->make(true);
    }

    public function anyStudentCourse(Request $request)
    {
        $tasks = Student_course::leftJoin('students', 'students.id','=','student_course.student_id')
            ->leftJoin('courses', 'courses.id','=','student_course.course_id')
            ->leftJoin('withdrawals', 'withdrawals.student_course_id','=','student_course.id')
            ->select(['student_course.id','withdrawals.refund','student_course.m_year', 'courses.courseAR', 'students.nameAR', 'student_course.price', 'student_course.payment', 'student_course.isdelete', 'student_course.iswithdrawal', 'student_course.created_at'])
            ->where('student_course.m_year', '=', $this->getMoneyYear());
        return Datatables::of($tasks)
            ->addColumn('pay', function ($tasks) {

                $studentpay=Catch_receipt::where('student_course_id',$tasks->id)->where('isdelete','=','0')->sum('amount');


        return number_format($studentpay,2);
            })
            ->addColumn('done', function ($tasks) {
                $done = '';
                $receipt = Receipt_student::where('student_course_id',$tasks->id)->where('isdelete',0)->first();
                if($receipt != null){$done = 1;}
                else{$done = 0;}
                return $done;
            })
            ->addColumn('status', function ($tasks) {
                $status = '';
                if($tasks->isdelete == 1){$status = 'محذوف';}
                elseif($tasks->iswithdrawal == 1){$status = 'منسحب';}
                else{$status = 'مسجل';}
                return $status;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchStudent') and $request->get('searchStudent') != "") {
                    $tasks->where('nameAR', 'like', "%{$request->get('searchStudent')}%")
                        ->orWhere('courseAR', 'like', "%{$request->get('searchStudent')}%");
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('student_course.m_year', '=', "{$request->get('moneyId')}");
                }
                if ($request->has('statusId') and $request->get('statusId') != "") {
                    if ($request->get('statusId') == 1){
                        $tasks->where('student_course.iswithdrawal', '=', "1")
                            ->where('student_course.isdelete', '=', "0");
                    }elseif ($request->get('statusId') == 2){
                        $tasks->where('student_course.isdelete', '=', "1");
                    }else{
                        $tasks->where('student_course.isdelete', '=', "0")
                            ->where('student_course.iswithdrawal', '=', "0");
                    }
                }
            })
            ->make(true);
    }

    public function anyStudentCourseRep(Request $request)
    {
        $tasks = Student_course::leftJoin('students', 'students.id','=','student_course.student_id')
            ->leftJoin('courses', 'courses.id','=','student_course.course_id')
            ->leftJoin('withdrawals', 'withdrawals.student_course_id','=','student_course.id')
            ->select(['student_course.id', 'courses.teacher_fees', 'courses.total_reg_student', 'courses.ratio_type', 'courses.value_sum', 'courses.percentage','withdrawals.refund','withdrawals.payment as wpayment','withdrawals.teacher_fees as t_fees','student_course.m_year', 'courses.courseAR', 'students.nameAR','students.phone1','students.phone2', 'student_course.price', 'student_course.payment', 'student_course.isdelete', 'student_course.iswithdrawal', 'student_course.created_at'])
            ->where('student_course.m_year',$this->getMoneyYear())
            ->where('student_course.isdelete','=','0');
        $response= Datatables::of($tasks)
            ->addColumn('phone', function ($tasks) {
                return $tasks->phone1 .' - '. $tasks->phone2;
            })
            ->addColumn('rem', function ($tasks) {
                if ($tasks->iswithdrawal==1){
                        return $tasks->wpayment;
                    }else{
                $studentpay=Catch_receipt::where('student_course_id',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');

                return $studentpay;
                    }
            })
            ->editColumn('payment', function($tasks){
                if ($tasks->iswithdrawal==1){
                        $rem=$tasks->wpayment;
                    }else{
                $rem=Catch_receipt::where('student_course_id',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');

                    }
                return $tasks->price - $rem;
            })
            ->addColumn('per', function ($tasks) {
               if ($tasks->ratio_type==29){
                    if ($tasks->iswithdrawal==1){
                        $per=$tasks->t_fees;
                    }else{
                        //payed
                        $studentpay=Catch_receipt::where('student_course_id',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');
                        $per= $studentpay * $tasks->percentage / 100;
                    }
                }elseif ($tasks->ratio_type==18){
                    if ($tasks->iswithdrawal==1){
                        $per=$tasks->t_fees;
                    }else{
                        $per=$tasks->value_sum;
                    }

                    }else{

                            if ($tasks->total_reg_student == 0){
                                $per=$tasks->value_sum;
                            }else{
                                $per=$tasks->value_sum / $tasks->total_reg_student;
                            }

                    }
                return number_format($per,2);
            })
            ->addColumn('center', function ($tasks) {
                $refund=0;
                if ($tasks->ratio_type==29){
                    if ($tasks->iswithdrawal==1){
                        $per=$tasks->t_fees;
                        $refund=$tasks->refund;
                    }else{
                        //payed
                        $studentpay=Catch_receipt::where('student_course_id',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');
                        $per= $studentpay * $tasks->percentage / 100;
                    }
                }elseif ($tasks->ratio_type==18){
                    if ($tasks->iswithdrawal==1){
                        $per=$tasks->t_fees;
                        $refund=$tasks->refund;
                    }else{
                        $per=$tasks->value_sum;
                    }
                    }else{
                            if ($tasks->total_reg_student == 0){
                                $per=$tasks->value_sum;
                            }else{
                                $per=$tasks->value_sum / $tasks->total_reg_student;
                            }
                    }
                    if ($tasks->iswithdrawal==1){
                        $pay=$tasks->wpayment;
                        $refund=$tasks->refund;
                    }else{
                $pay=Catch_receipt::where('student_course_id',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');

                    }

                $center=$pay-$refund-$per;

                return $center;
            })
            ->addColumn('stat', function ($tasks) {
                if ($tasks->iswithdrawal==1){
                    $stat='منسحب';
                }
                else{
                    $rem=Catch_receipt::where('student_course_id',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');



                if ($tasks->price==$rem){
                    $stat='مسدد';
                }
                else{
                    $stat='غير مسدد';
                }
                }

                return $stat;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchStudent') and $request->get('searchStudent') != "") {
                    $tasks->where('nameAR', 'like', "%{$request->get('searchStudent')}%")
                        ->orWhere('phone1', 'like', "%{$request->get('searchStudent')}%")
                        ->orWhere('phone2', 'like', "%{$request->get('searchStudent')}%");

                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('yearId') and $request->get('yearId') != "") {
                    $tasks->where('student_course.m_year', '=', "{$request->get('yearId')}");
                }
            })
            ->make(true);
return $response;

    }

    public function anyCourseReport(Request $request)
    {
        $tasks = Course::leftJoin('options', 'options.id','=','courses.ratio_type')

            // ->leftJoin('student_course', 'courses.id','=','student_course.course_id')
            ->leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->select(['courses.id','teachers.name as teacher_name','courses.course_time','options.title', 'courses.total_reg_student', 'courses.ratio_type', 'courses.value_sum', 'courses.percentage','courses.reg_fees','courses.decisions_fees','courses.course_fees','courses.teacher_fees as teacher_agreed_fees','courses.m_year','courses.total_withdrawn_student', 'courses.courseAR', 'courses.created_at'])->where('courses.isdelete','=','0');

        return Datatables::of($tasks)
        ->addColumn('price', function($tasks){
            $scourses=Student_course::where('course_id',$tasks->id)->where('isdelete',0)->sum('price');
            return $scourses;
        })
        ->editColumn('value_sum', function($tasks){

            return number_format($tasks->value_sum,2);
        })
        ->addColumn('refund', function ($tasks) {
            $refund=0;
            $scourses=Student_course::where('course_id',$tasks->id)->where('isdelete',0)->get();
        if(count($scourses)>0){
            foreach($scourses as $scourse){
                    if ($scourse->iswithdrawal==1){
                        $swithdrawal=Withdrawal::where('student_course_id',$scourse->id)->where('isdelete','=','0')->first();
                        if ($tasks->ratio_type !=15){
                        $refund+=$swithdrawal->refund;
                        }
                    }
                    }
            }
            return $refund;

        })
        ->addColumn('teacher_fees', function ($tasks) {
            $teacher_fees=0;
            $courseStu=$tasks->total_reg_student+$tasks->total_withdrawn_student;
            $scourses=Student_course::where('course_id',$tasks->id)->where('isdelete',0)->get();
            if(count($scourses)>0){
                foreach($scourses as $scourse){
                    $studentpay=Catch_receipt::where('student_course_id',$scourse->id)->where('isdelete','=','0')->sum('amount');

                        if ($scourse->iswithdrawal==1){
                            $swithdrawal=Withdrawal::where('student_course_id',$scourse->id)->where('isdelete','=','0')->first();
                            if ($tasks->ratio_type !=15){
                            $teacher_fees +=$swithdrawal->teacher_fees;
                            }
                        }else{
                            if ($tasks->ratio_type==29){
                            $tfees= $studentpay * $tasks->percentage / 100;
                            $teacher_fees +=$tfees;
                            }
                        }

                }
            }
           if($tasks->ratio_type==18){
            $teacher_fees=$tasks->value_sum*$courseStu;
            }
            else if($tasks->ratio_type==15){
            $teacher_fees=$tasks->value_sum;
            }
        return number_format($teacher_fees,2);
        })
        ->addColumn('spays', function ($tasks) {
           $spayed=0;
           $scourses=Student_course::where('course_id',$tasks->id)->where('isdelete',0)->get();
        if(count($scourses)>0){
            foreach($scourses as $scourse){
                $studentpay=Catch_receipt::where('student_course_id',$scourse->id)->where('isdelete','=','0')->sum('amount');
                $spayed +=$studentpay;

            }
        }
        return number_format($spayed,2);
        })
        ->addColumn('sremains', function ($tasks) {
            $sremain=0;
            $spayed=0;
            $stotal_fees=0;
            $scourses=Student_course::where('course_id',$tasks->id)->where('isdelete',0)->get();
            if(count($scourses)>0){
                foreach($scourses as $scourse){
                    $stotal_fees +=$scourse->price;
                    $studentpay=Catch_receipt::where('student_course_id',$scourse->id)->where('isdelete','=','0')->sum('amount');
                    $spayed +=$studentpay;

                }
            }

            $sremain=$stotal_fees-$spayed;
          return number_format($sremain,2);

        })
        ->addColumn('teacher_catches', function ($tasks) {
            $teacher_catch=Receipt_course::where('course_id',$tasks->id)->where('isdelete','=','0')->sum('amount');
            return number_format($teacher_catch,2);
        })
        ->addColumn('teacher_remains', function ($tasks) {
           $teacher_remain=0;
           $teacher_fees=0;
            $courseStu=$tasks->total_reg_student+$tasks->total_withdrawn_student;
            $scourses=Student_course::where('course_id',$tasks->id)->where('isdelete',0)->get();
            if(count($scourses)>0){
                foreach($scourses as $scourse){
                    $studentpay=Catch_receipt::where('student_course_id',$scourse->id)->where('isdelete','=','0')->sum('amount');

                        if ($scourse->iswithdrawal==1){
                            $swithdrawal=Withdrawal::where('student_course_id',$scourse->id)->where('isdelete','=','0')->first();
                            if ($tasks->ratio_type !=15){
                            $teacher_fees +=$swithdrawal->teacher_fees;
                            }
                        }else{
                            if ($tasks->ratio_type==29){
                            $tfees= $studentpay * $tasks->percentage / 100;
                            $teacher_fees +=$tfees;
                            }
                        }

                }
            }
           if($tasks->ratio_type==18){
                $teacher_fees=$tasks->value_sum*$courseStu;
            }
            else if($tasks->ratio_type==15){
                $teacher_fees=$tasks->value_sum;
            }
           $teacher_catch=Receipt_course::where('course_id',$tasks->id)->where('isdelete','=','0')->sum('amount');
           if ($tasks->ratio_type==29){
                $teacher_remain=$teacher_fees-$teacher_catch;
            }else if($tasks->ratio_type==18){
                $all_teacher_fees=$tasks->value_sum*$courseStu;
                $teacher_remain=$all_teacher_fees-$teacher_catch;
            }
            else if($tasks->ratio_type==15){
                $teacher_fees=$tasks->value_sum;
                $teacher_remain=$teacher_fees-$teacher_catch;
            }
            return number_format($teacher_remain,2);
        })
        ->addColumn('center_fees', function ($tasks) {
            $center_fees=0;
            $spayed=0;
            $teacher_fees=0;
            $courseStu=$tasks->total_reg_student+$tasks->total_withdrawn_student;
            $scourses=Student_course::where('course_id',$tasks->id)->where('isdelete',0)->get();
        if(count($scourses)>0){
            foreach($scourses as $scourse){
                $studentpay=Catch_receipt::where('student_course_id',$scourse->id)->where('isdelete','=','0')->sum('amount');
                $spayed +=$studentpay;
                    if ($scourse->iswithdrawal==1){
                        $swithdrawal=Withdrawal::where('student_course_id',$scourse->id)->where('isdelete','=','0')->first();
                       if ($tasks->ratio_type !=15){
                            $teacher_fees +=$swithdrawal->teacher_fees;
                            }
                        $center_fees +=$swithdrawal->center_fees;
                    }else{
                        if ($tasks->ratio_type==29){
                        $tfees= $studentpay * $tasks->percentage / 100;
                        $center_fees +=$studentpay-$tfees;
                        $teacher_fees +=$tfees;
                        }
                    }
            }
        }
        if($tasks->ratio_type==18){
            $teacher_fees=$tasks->value_sum*$courseStu;
             $center_fees=$center_fees+$spayed-$teacher_fees;
        }
        else if($tasks->ratio_type==15){
            $teacher_fees=$tasks->value_sum;
             $center_fees=$center_fees+$spayed-$teacher_fees;
        }
        return number_format($center_fees,2);
        })
        ->addColumn('all_center_fees', function ($tasks) {
            $all_center_fees=0;
            $teacher_fees=0;
            $stotal_fees=0;
            $all_teacher_fees=0;
            $courseStu=$tasks->total_reg_student+$tasks->total_withdrawn_student;
            $scourses=Student_course::where('course_id',$tasks->id)->where('isdelete',0)->get();
            if(count($scourses)>0){
                foreach($scourses as $scourse){
                    $stotal_fees +=$scourse->price;
                    $studentpay=Catch_receipt::where('student_course_id',$scourse->id)->where('isdelete','=','0')->sum('amount');

                        if ($scourse->iswithdrawal==1){
                            $swithdrawal=Withdrawal::where('student_course_id',$scourse->id)->where('isdelete','=','0')->first();
                            if ($tasks->ratio_type !=15){
                            $teacher_fees +=$swithdrawal->teacher_fees;
                            }
                        }else{
                            if ($tasks->ratio_type==29){
                            $tfees= $studentpay * $tasks->percentage / 100;
                            $teacher_fees +=$tfees;
                            }
                        }

                }
            }
            if ($tasks->ratio_type==29){
                $all_t_fees=$tasks->teacher_agreed_fees*$courseStu;
                $all_teacher_fees=$all_t_fees*$tasks->percentage /100;
            }else if($tasks->ratio_type==18){
                 $teacher_fees=$tasks->value_sum*$courseStu;
                 $all_teacher_fees=$teacher_fees;
            }
            else if($tasks->ratio_type==15){
                $teacher_fees=$tasks->value_sum;
                $all_teacher_fees=$teacher_fees/$courseStu;
            }
            if($tasks->ratio_type==15){
            $all_center_fees=$stotal_fees-$teacher_fees;
        }else{
         $all_center_fees=$stotal_fees-$all_teacher_fees;
        }
            return number_format($all_center_fees,2);
        })

            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCourse') and $request->get('searchCourse') != "") {
                    $tasks->where('courses.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('teachers.name', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_withdrawn_student', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.course_time', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_fees', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_reg_student', 'like', "%{$request->get('searchCourse')}%");
                        });
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('teacherId') and $request->get('teacherId') != "") {
                    $tasks->where('teachers.id', '=', "{$request->get('teacherId')}");
                }
                if ($request->has('yearId') and $request->get('yearId') != "") {
                    $tasks->where('courses.m_year', '=', "{$request->get('yearId')}");
                }
                if ($request->has('categoryId') and $request->get('categoryId') != "") {
                    $tasks->where('courses.category_id', '=', "{$request->get('categoryId')}");
                }
            })
           ->with(['all_total_reg'=>function($tasks) {
                return $tasks->sum('courses.total_reg_student');
           },'all_total_withdrawan'=>function($tasks) {
                return $tasks->sum('courses.total_withdrawn_student');
           },'all_calcs'=>function($tasks) {
              $courses=$tasks->distinct('courses.id')->get('courses');

                $stotal_fees=0;
                $spayed=0;
                $sremain=0;
                $center_fees=0;
                $teacher_fees=0;
                $teacher_catch=0;
                $teacher_remain=0;
                $all_center_fees=0;
                $all_teacher_fees=0;
                $refunds=0;
                $dif=0;
        foreach($courses as $course){
            $agreed_tfees=$course->teacher_fees;
            $percentage=$course->percentage;
            $courseStu= $course->total_reg_student+$course->total_withdrawn_student;
                $scourses=Student_course::where('course_id',$course->id)->where('isdelete',0)->get();
                $teacher_catch+=Receipt_course::where('course_id',$course->id)->where('isdelete','=','0')->sum('amount');
                if(count($scourses)>0){
                    foreach($scourses as $scourse){
                        $stotal_fees +=$scourse->price;
                        $studentpay=Catch_receipt::where('student_course_id',$scourse->id)->where('isdelete','=','0')->sum('amount');
                        $spayed +=$studentpay;

                            if ($scourse->iswithdrawal==1){
                                $swithdrawal=Withdrawal::where('student_course_id',$scourse->id)->where('isdelete','=','0')->first();
                                if ($course->ratio_type !=15){
                                $teacher_fees +=$swithdrawal->teacher_fees;
                                $refunds +=$swithdrawal->refund;
                                }
                                $center_fees +=$swithdrawal->center_fees;
                            }else{
                                if ($course->ratio_type==29){
                                $tfees= $studentpay * $percentage / 100;
                                $teacher_fees +=$tfees;
                                }
                            }


                    }
                }


                if ($course->ratio_type==29){
                    $all_t_fees=$agreed_tfees*$courseStu;
                    $tt=$all_t_fees*$percentage /100;
                    $all_teacher_fees+=$tt;

                }else if($course->ratio_type==18){
                    $total=$course->value_sum*$courseStu;
                    $all_teacher_fees+=$total;
                    $teacher_fees+=$total;

                }
                else if($course->ratio_type==15){
                    $vsum=$course->value_sum;
                $teacher_fees+=$vsum;
                $divi=$vsum/$courseStu;
                $all_teacher_fees+=$vsum/$courseStu;
                $dif+=$vsum-$divi;

                }


        }
        $center_fees=$spayed-$teacher_fees;
        $sremain=$stotal_fees-$spayed;
        $teacher_remain=$teacher_fees-$teacher_catch;
        $all_center_fees=$stotal_fees-$teacher_fees-$dif;

        return['refunds'=>$refunds,'teacher_fees'=>number_format($teacher_fees,2),'center_fees'=>number_format($center_fees,2),'all_center_fees'=>number_format($all_center_fees,2),'all_sremain'=>number_format($sremain,2),'all_teacher_remain'=>number_format($teacher_remain,2),'all_spays'=>number_format($spayed,2),'all_prices'=>number_format($stotal_fees,2),'teacher_catches'=>number_format($teacher_catch,2),'teacher_remains'=>number_format($teacher_remain,2)];

           },'all_reg_fees'=>function($tasks){return $tasks->sum('courses.reg_fees');},
           'all_descitions_fees'=>function($tasks){return $tasks->sum('courses.decisions_fees');},
           'all_courses_fees'=>function($tasks){return $tasks->sum('courses.course_fees');},
           'all_total_fees'=>function($tasks){return $tasks->sum('courses.total_fees');}])
            ->make(true);
    }

    public function anyStudentRep(Request $request)
    {
        $tasks = Student_course::leftJoin('students', 'students.id','=','student_course.student_id')

            ->leftJoin('courses', 'courses.id','=','student_course.course_id')
            ->leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->leftJoin('withdrawals', 'withdrawals.student_course_id','=','student_course.id')
            ->leftJoin('collection_fees', 'collection_fees.student_course_id','=','student_course.id')
            ->select(['student_course.id', 'teachers.name', 'collection_fees.count', 'collection_fees.notes', 'courses.teacher_fees', 'courses.begin', 'courses.total_reg_student', 'courses.ratio_type', 'courses.value_sum', 'courses.percentage','withdrawals.refund','withdrawals.teacher_fees as t_fees','student_course.m_year', 'courses.courseAR', 'students.nameAR','students.phone1','students.phone2', 'student_course.price', 'student_course.payment', 'student_course.isdelete', 'student_course.iswithdrawal', 'student_course.created_at'])->where('student_course.isdelete','=','0');
        return Datatables::of($tasks)
        ->editColumn('amount', function ($tasks) {
            if ($tasks->iswithdrawal==1){
                return 0;
            }else{
            $amount=Catch_receipt::where('isdelete','=','0')->where('m_year','=',$tasks->m_year)->where('student_course_id',$tasks->id)->sum('amount');

               return number_format($amount,2);
            }
            })
           ->editColumn('payment', function ($tasks) {
               if ($tasks->iswithdrawal==1){
                return 0;
            }else{
               $amount=Catch_receipt::where('isdelete','=','0')->where('m_year','=',$tasks->m_year)->where('student_course_id',$tasks->id)->sum('amount');
               return $amounts=$tasks->price-$amount;
            }
            })
           ->editColumn('count', function ($tasks) {
               return $tasks->count?$tasks->count:0;
            })
           ->editColumn('notes', function ($tasks) {
               return $tasks->notes?$tasks->notes:'لا يوجد';
            })
            ->addColumn('stat', function ($tasks) {
                if ($tasks->iswithdrawal==1){
                    $stat='منسحب';
                }
                elseif ($tasks->payment==0){
                    $stat='مسدد';
                }
                else{
                    $stat='غير مسدد';
                }

                return $stat;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchStudent') and $request->get('searchStudent') != "") {
                    $tasks->where('name', 'like', "%{$request->get('searchStudent')}%")

                        ->orWhere('nameAR', 'like', "%{$request->get('searchStudent')}%")
                        ->orWhere('courseAR', 'like', "%{$request->get('searchStudent')}%")
                        // ->orWhere('m_year', 'like', "%{$request->get('searchStudent')}%")
                        ->orWhere('begin', 'like', "%{$request->get('searchStudent')}%");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('yearId') and $request->get('yearId') != "") {
                    $tasks->where('student_course.m_year','=',"{$request->get('yearId')}");
                }
                if ($request->has('statusId') and $request->get('statusId') != "") {
                    if ($request->get('statusId') == 1){
                        $tasks->where('student_course.iswithdrawal', '=', "1");
                    }elseif ($request->get('statusId') == 2){
                        $tasks->where('student_course.payment', '=', "0")
                            ->where('student_course.iswithdrawal', '=', "0");
                    }else{
                        $tasks->where('student_course.payment', '>', "0")
                            ->where('student_course.iswithdrawal', '=', "0");
                    }
                }
            })
            ->with(['allprice'=>function($tasks){
                 return $tasks->sum('student_course.price');

            },'allrec'=>function($tasks) use($request){
                 $amount= Catch_receipt::leftJoin('student_course as sc', 'sc.id','=','catch_receipts.student_course_id')
               ->leftJoin('students', 'students.id','=','sc.student_id')
            ->leftJoin('teachers', 'teachers.id','=','sc.teacher_id')
            ->leftJoin('courses', 'courses.id','=','sc.course_id')->where('catch_receipts.isdelete','=','0');
            // ->where('catch_receipts.m_year','=','sc.m_year');
                     if ($request->has('searchCourse') and $request->get('searchCourse') != "") {
                        $amount->where('courses.isdelete','=','0')
                        ->where(function ($amount) use ($request){
                            $amount->where('teachers.name', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('students.nameAR', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.begin', 'like', "%{$request->get('searchCourse')}%")
                                ;
                        });
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $amount->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('teacherId') and $request->get('teacherId') != "") {
                    $amount->where('teachers.id', '=', "{$request->get('teacherId')}");
                }
                if ($request->has('yearId') and $request->get('yearId') != "") {
                    $amount->where('sc.m_year', '=', "{$request->get('yearId')}");
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $amount->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('statusId') and $request->get('statusId') != "") {
                    if ($request->get('statusId') == 1){
                        $amount->where('sc.iswithdrawal', '=', "1");
                    }elseif ($request->get('statusId') == 2){
                        $amount->where('sc.payment', '=', "0")
                            ->where('sc.iswithdrawal', '=', "0");
                    }else{
                        $amount->where('sc.payment', '>', "0")
                            ->where('sc.iswithdrawal', '=', "0");
                    }
                }
                $amount=$amount->get();
                $amounts=0;
               foreach($amount as $am){
                $sc=Student_course::where('student_id',$am->student_id)->where('course_id',$am->course_id)->where('isdelete',0)->first();
                if($sc->iswithdrawal !=1){
                    $amounts +=$am->amount;
                }
               }
                    return number_format($amounts,2);

            },'allpayment'=>function($tasks) use($request){

                  $amount= Catch_receipt::leftJoin('student_course as sc', 'sc.id','=','catch_receipts.student_course_id')
              ->leftJoin('students', 'students.id','=','sc.student_id')
            ->leftJoin('teachers', 'teachers.id','=','sc.teacher_id')
            ->leftJoin('courses', 'courses.id','=','sc.course_id')->where('catch_receipts.isdelete','=','0');
            // ->where('catch_receipts.m_year','=','sc.m_year');
                     if ($request->has('searchCourse') and $request->get('searchCourse') != "") {
                        $amount->where('courses.isdelete','=','0')
                        ->where(function ($amount) use ($request){
                            $amount->where('teachers.name', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('students.nameAR', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.begin', 'like', "%{$request->get('searchCourse')}%")
                                ;
                        });
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $amount->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('teacherId') and $request->get('teacherId') != "") {
                    $amount->where('teachers.id', '=', "{$request->get('teacherId')}");
                }
                if ($request->has('yearId') and $request->get('yearId') != "") {
                    $amount->where('sc.m_year', '=', "{$request->get('yearId')}");
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $amount->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('statusId') and $request->get('statusId') != "") {
                    if ($request->get('statusId') == 1){
                        $amount->where('sc.iswithdrawal', '=', "1");
                    }elseif ($request->get('statusId') == 2){
                        $amount->where('sc.payment', '=', "0")
                            ->where('sc.iswithdrawal', '=', "0");
                    }else{
                        $amount->where('sc.payment', '>', "0")
                            ->where('sc.iswithdrawal', '=', "0");
                    }
                }
                $amount=$amount->get();
                $result=0;
               foreach($amount as $am){
                $sc=Student_course::where('student_id',$am->student_id)->where('course_id',$am->course_id)->where('isdelete',0)->first();
                if($sc->iswithdrawal !=1){
                    $amounts =$am->amount;
                    $result +=$tasks->sum('student_course.price') - $amounts;
                }
               }

                return $result;
            }
            ])
            ->make(true);
    }

    public function anyTeacherC(Request $request)
    {
        $tasks = Student_course::leftJoin('students', 'students.id','=','student_course.student_id')
            ->leftJoin('courses', 'courses.id','=','student_course.course_id')
            ->leftJoin('withdrawals', 'withdrawals.student_course_id','=','student_course.id')
            ->select(['student_course.id','withdrawals.refund','withdrawals.teacher_fees as t_fees','student_course.m_year', 'courses.courseAR', 'courses.teacher_fees', 'courses.value_sum','courses.total_reg_student', 'courses.percentage', 'students.nameAR', 'student_course.price', 'student_course.payment', 'student_course.isdelete','courses.ratio_type', 'student_course.iswithdrawal', 'student_course.created_at'])
            // ->where('courses.ratio_type',29)
            ->where('student_course.m_year', '=', "{$request->get('moneyId')}")->where('student_course.isdelete','=','0');


        return Datatables::of($tasks)

            ->addColumn('payCatched', function ($tasks) {

                    $studentpay=Catch_receipt::where('student_course_id',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');
                    $tfees=$tasks->teacher_fees;
                    if($studentpay > $tfees){
                        $studentpay=$tfees;
                    }
                    if ($tasks->iswithdrawal==1){
                        return 00;
                    }else{
                return $studentpay;
                    }
            })

            ->addColumn('per', function ($tasks) {
                if ($tasks->ratio_type==29){
                    if ($tasks->iswithdrawal==1){
                        $per=$tasks->t_fees;
                    }else{
                        //payed
                        $studentpay=Catch_receipt::where('student_course_id',$tasks->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');
                        $per= $studentpay * $tasks->percentage / 100;
                    }
                }elseif ($tasks->ratio_type==18){
                    if ($tasks->iswithdrawal==1){
                        $per=$tasks->t_fees;
                    }else{
                        $per=$tasks->value_sum;
                    }

                    }else{

                            if ($tasks->total_reg_student == 0){
                                $per=$tasks->value_sum;
                            }else{
                                $per=$tasks->value_sum / $tasks->total_reg_student;
                            }

                    }
                return number_format($per,2);
            })
            ->addColumn('stat', function ($tasks) {
                if ($tasks->iswithdrawal==1){
                    $stat='منسحب';
                }
                elseif ($tasks->payment==0){
                    $stat='مسدد';
                }
                else{
                    $stat='غير مسدد';
                }

                return $stat;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->when($request->get('courseId'), function ($query, $role) {
                            return $query->where('student_course.course_id', '=', $role)
                                ->where(function ($tasks){
                                    $tasks->where('student_course.iswithdrawal','!=', 1)
                                        ->orWhere('withdrawals.teacher_fees','!=', 0);
                                });
                        });
                }if ($request->has('searchStudent') and $request->get('searchStudent') != "") {
                    $tasks->where('nameAR', 'like', "%{$request->get('searchStudent')}%")
                        ;
                }

            })
            ->with(['totalteacherpay'=>function($tasks)  use ($request)
            {
                if ($request->has('courseId') and $request->get('courseId') != "") {
                $totalpay=Receipt_course::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('course_id', '=', "{$request->get('courseId')}")->sum('amount');
                }else{
                    $totalpay=Receipt_course::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');
                }
                return number_format($totalpay,2);
            },'test'=>function ($tasks) use($request)
            {
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $course = Course::find($request->get('courseId'));
            $per=0;
                $amounts=0;

            $student_courses = Student_course::where('course_id',$course->id)->where('m_year', '=', "{$request->get('moneyId')}")->where('isdelete','=','0')->get();

            foreach ($student_courses as $student_course) {
                if ($student_course->iswithdrawal==0){
                    $isCatch_receipt=Catch_receipt::where('student_course_id',$student_course->id)->where('m_year', '=', "{$request->get('moneyId')}")->count();
                    if ($isCatch_receipt){
                        $amounts=Catch_receipt::where('student_course_id',$student_course->id)->where('m_year', '=', "{$request->get('moneyId')}")->sum('amount');
                        $per += $amounts * $course->percentage / 100;
                        $pay=0;
                        $amounts=0;
                    }
                }
                else{
                    $isWithdrawal=Withdrawal::where('student_course_id',$student_course->id)->count();
                    if ($isWithdrawal>0) {
                        $withdrawals = Withdrawal::where('student_course_id', $student_course->id)->get();
                        $am = 0;
                        foreach ($withdrawals as $withdrawal) {
                            $am += $withdrawal->teacher_fees;
                        }
                        $per += $am;
                    }
                }
            }

            }else{
                $cources = Course::where('ratio_type',29)->where('m_year', '=', "{$request->get('moneyId')}")->where('isdelete','=','0')->get();
            $per=0;
                $amounts=0;
            foreach($cources as $course){
            $student_courses = Student_course::where('course_id',$course->id)->where('m_year', '=', "{$request->get('moneyId')}")->where('isdelete','=','0')->get();

            foreach ($student_courses as $student_course) {
                if ($student_course->iswithdrawal==0){
                    $isCatch_receipt=Catch_receipt::where('student_course_id',$student_course->id)->where('m_year', '=', "{$request->get('moneyId')}")->count();
                    if ($isCatch_receipt){
                        $amounts=Catch_receipt::where('student_course_id',$student_course->id)->where('m_year', '=', "{$request->get('moneyId')}")->sum('amount');
                        $per += $amounts * $course->percentage / 100;
                        $pay=0;
                        $amounts=0;
                    }
                }
                else{
                    $isWithdrawal=Withdrawal::where('student_course_id',$student_course->id)->count();
                    if ($isWithdrawal>0) {
                        $withdrawals = Withdrawal::where('student_course_id', $student_course->id)->get();
                        $am = 0;
                        foreach ($withdrawals as $withdrawal) {
                            $am += $withdrawal->teacher_fees;
                        }
                        $per += $am;
                    }
                }
            }
            }
            }
            return $per;
            },'ratio'=>function($tasks){
                return $tasks->sum('courses.ratio_type');
            }])

            ->make(true);


    }

    public function anyEnglishLevel(Request $request)
    {
              $tasks = Option::select(['options.id','options.title','options.parent_id'])
            ->where('options.parent_id',13)
            ->where('options.active',1)
            ->where('options.isdelete',0);
        return Datatables::of($tasks)
            ->addColumn('reg', function ($tasks) {
                $isEnglish_reg = English_reg::where('level_id',$tasks->id)->where('isdelete','0')->count();
                return $isEnglish_reg>0?$isEnglish_reg:0;
            })
            ->addColumn('pass', function ($tasks) {
                $isEnglish_reg = English_reg::where('level_id',$tasks->id)->where('isdelete','0')->where('iswithdrawal','0')->where('ispass','1')->count();
                return $isEnglish_reg>0?$isEnglish_reg:0;
            })
            ->addColumn('with', function ($tasks) {
                $isEnglish_reg = English_reg::where('level_id',$tasks->id)->where('isdelete','0')->where('iswithdrawal','1')->where('ispass','0')->count();
                return $isEnglish_reg>0?$isEnglish_reg:0;
            })
            ->addColumn('regNow', function ($tasks) {
                $reg = English_reg::where('level_id',$tasks->id)->where('isdelete','0')->count();
                $reg = $reg>0?$reg:0;
                $pass = English_reg::where('level_id',$tasks->id)->where('isdelete','0')->where('iswithdrawal','0')->where('ispass','1')->count();
                $pass = $pass>0?$pass:0;
                $with = English_reg::where('level_id',$tasks->id)->where('isdelete','0')->where('iswithdrawal','1')->where('ispass','0')->count();
                $with = $with>0?$with:0;
                $regNow = $reg - ($pass+$with);
                return $regNow;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchEnglish') and $request->get('searchEnglish') != "") {
                    $tasks->where('options.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('options.title', 'like', "%{$request->get('searchEnglish')}%");
                        });
                }
            })
            ->make(true);
    }

    public function anyEnglishReg(Request $request)
    {
        $tasks = English_reg::leftJoin('englishes', 'englishes.id','=','english_reg.student_id')
            ->leftJoin('options', 'options.id','=','english_reg.level_id')
            ->leftJoin('users', 'users.id','=','english_reg.created_by')
            ->select(['english_reg.id','english_reg.ispass','english_reg.isdelete','english_reg.iswithdrawal','english_reg.status','english_reg.created_at','users.name as created_by','options.title as level_id','englishes.student_name','englishes.phone1','englishes.phone2','englishes.year'])
            ->where('english_reg.isdelete',0)->where('english_reg.iswithdrawal',0)->where('english_reg.ispass',0);
        return Datatables::of($tasks)
        ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('m/d/Y') : '';
            })
            ->addColumn('phone',function ($tasks){
                $phone='';
                if ($tasks->phone1 != null){
                    $phone = $phone.$tasks->phone1;
                }
                if ($tasks->phone2 != null){
                    $phone =$phone.'-'.$tasks->phone2;
                }
                return $phone;
            })
            ->editColumn('status', function ($tasks) {
                if ($tasks->status==0){
                    return 'فعال';
                }elseif ($tasks->status==1){
                    return 'منسحب';
                }else{
                    return 'ناجح';
                }
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchEnglishReg') and $request->get('searchEnglishReg') != "") {
                    $tasks->where('english_reg.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('options.title', 'like', "%{$request->get('searchEnglishReg')}%")
                                ->orWhere('englishes.student_name', 'like', "%{$request->get('searchEnglishReg')}%");
                        });
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('englishes.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('levelId') and $request->get('levelId') != "") {
                    $tasks->where('options.id', '=', "{$request->get('levelId')}");
                }
            })
            ->make(true);
    }

    public function anyEnglishRegEnd(Request $request)
    {
        $tasks = English_reg::leftJoin('englishes', 'englishes.id','=','english_reg.student_id')
            ->leftJoin('options', 'options.id','=','english_reg.level_id')
            ->leftJoin('users', 'users.id','=','english_reg.created_by')
            ->select(['english_reg.id','english_reg.ispass','english_reg.isdelete','english_reg.iswithdrawal','english_reg.status','english_reg.created_at','users.name as created_by','options.title as level_id','englishes.student_name','englishes.phone1','englishes.phone2','englishes.year'])
            ->where('english_reg.isdelete',0)->where('english_reg.status','!=','0');
        return Datatables::of($tasks)
            ->addColumn('phone',function ($tasks){
                $phone='';
                if ($tasks->phone1 != null){
                    $phone = $phone.$tasks->phone1;
                }
                if ($tasks->phone2 != null){
                    $phone =$phone.'-'.$tasks->phone2;
                }
                return $phone;
            })
            ->editColumn('status', function ($tasks) {
                if ($tasks->status==0){
                    return 'فعال';
                }elseif ($tasks->status==1){
                    return 'منسحب';
                }else{
                    return 'ناجح';
                }
            })
            ->editColumn('created_at', function ($tasks) {
                return date("Y-m-d", strtotime($tasks->created_at));
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchEnglishReg') and $request->get('searchEnglishReg') != "") {
                    $tasks->where('english_reg.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('options.title', 'like', "%{$request->get('searchEnglishReg')}%")
                                ->orWhere('englishes.student_name', 'like', "%{$request->get('searchEnglishReg')}%");
                        });
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('englishes.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('levelId') and $request->get('levelId') != "") {
                    $tasks->where('options.id', '=', "{$request->get('levelId')}");
                }
                if ($request->has('StatusId') and $request->get('StatusId') != "") {
                    $tasks->where('english_reg.status', '=', "{$request->get('StatusId')}");
                }
            })
            ->make(true);
    }

    public function anyLevelUp(Request $request)
    {
        $tasks = Level_up::leftJoin('englishes', 'englishes.id','=','level_ups.student_id')
            ->leftJoin('options as opt', 'opt.id','=','level_ups.level')
            ->leftJoin('options as op', 'op.id','=','level_ups.level_up')
            ->leftJoin('users as us', 'us.id','=','level_ups.created_by')
            ->leftJoin('users as u', 'u.id','=','level_ups.updated_by')
            ->select(['level_ups.id','level_ups.date','level_ups.total','opt.title as level','op.title as level_up','englishes.student_name','level_ups.created_at','us.name as created_by','u.name as updated_by'])
            ->where('level_ups.isdelete',0);
        return Datatables::of($tasks)
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by?$tasks->updated_by:$tasks->created_by;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchLevelUp') and $request->get('searchLevelUp') != "") {
                    $tasks->where('level_ups.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('opt.title', 'like', "%{$request->get('searchLevelUp')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchLevelUp')}%")
                                ->orWhere('englishes.student_name', 'like', "%{$request->get('searchLevelUp')}%");
                        });
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('englishes.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('levelId') and $request->get('levelId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('levelId')}");
                }
                if ($request->has('levelUpId') and $request->get('levelUpId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('levelUpId')}");
                }
            })
            ->make(true);
    }

    public function anyEnglishSal(Request $request)
    {
        $tasks = English_sal::leftJoin('englishes', 'englishes.id','=','english_sal.student_id')
            ->leftJoin('options as opti', 'opti.id','=','english_sal.level_up')
            ->leftJoin('options as opt', 'opt.id','=','english_sal.classification')
            ->leftJoin('options as op', 'op.id','=','english_sal.region')
            ->leftJoin('options as o', 'o.id','=','english_sal.type')
            ->leftJoin('users as us', 'us.id','=','english_sal.created_by')
            ->leftJoin('users as u', 'u.id','=','english_sal.updated_by')
            ->select(['english_sal.id','english_sal.student_id','englishes.student_name','english_sal.birthday','opti.title as up','opt.title as classification','op.title as region','english_sal.notes','english_sal.phone','o.title as type','english_sal.resolution','english_sal.created_at','us.name as created_by','u.name as updated_by'])
            ->where('english_sal.isdelete',0)
            ->where('englishes.isdelete',0)
            ->where('englishes.active',1);
        return Datatables::of($tasks)
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by?$tasks->updated_by:$tasks->created_by;
            })
            ->editColumn('phone', function ($tasks) {
                $phone= str_replace('-','<br />',$tasks->phone);
                return $phone;
            })
            ->addColumn('level', function ($tasks) {
                $lev='';
                $isLevel_eng=Level_eng::where('eng_id',$tasks->id)->count();
                if ($isLevel_eng>0) {
                    $level_engs=Level_eng::where('eng_id',$tasks->id)->get();
                    foreach ($level_engs as $level_eng){

                        $lev = $lev.Option::find($level_eng->level_id)->title ."-" ;

                    }
                }else{
                    $lev='فحص المستوى';
                }
                return $lev;
            })
            ->addColumn('mark', function ($tasks) {
                $lev='';
                $isLevel_up=Level_up::where('student_id',$tasks->student_id)->count();
                if ($isLevel_up>0) {
                    $level_ups=Level_up::where('student_id',$tasks->student_id)->orderBy('id','desc')->first();
                    $lev=$level_ups->total;
                }else{
                    $english=English::where('id',$tasks->student_id)->first();
                    $lev=$english->total;
                }
                return $lev;
            })
            ->addColumn('date', function ($tasks) {
                $lev='';
                $isLevel_up=Level_up::where('student_id',$tasks->student_id)->count();
                if ($isLevel_up>0) {
                    $level_ups=Level_up::where('student_id',$tasks->student_id)->orderBy('id','desc')->first();
                    $lev=$level_ups->date;
                }else{
                    $english=English::where('id',$tasks->student_id)->first();
                    $lev=$english->date;
                }
                return $lev;
            })
            ->rawColumns(['phone'])
            ->escapeColumns(['phone'])
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchEnglishSal') and $request->get('searchEnglishSal') != "") {
                    $tasks->where('english_sal.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('opt.title', 'like', "%{$request->get('searchEnglishSal')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchEnglishSal')}%")
                                ->orWhere('englishes.student_name', 'like', "%{$request->get('searchEnglishSal')}%");
                        });
                }
                if ($request->has('levelUpId') and $request->get('levelUpId') != "") {
                    $tasks->where('opti.id', '=', "{$request->get('levelUpId')}");
                }
                if ($request->has('typeId') and $request->get('typeId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('typeId')}");
                }
                if ($request->has('resId') and $request->get('resId') != "") {
                    $tasks->where('english_sal.resolution', '=', "{$request->get('resId')}");
                }
            })
            ->make(true);
    }

    public function anyAvailable()
    {
        $tasks = Student_course::select([ 'id', 'course_id', 'student_id', 'created_at'])
            ->where('isdelete','=','0');
        return Datatables::of($tasks)
            ->addColumn('courseAR', function ($tasks) {
                return Course::find($tasks->course_id)->courseAR;
            })
            ->addColumn('studentAR', function ($tasks) {
                return Student::find($tasks->student_id)->nameAR;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d') : '';
            })
            ->make(true);
    }

    public function getStudentCourse($id)
    {
        $userL = User_year::where('user_id',$this->getId())->count();
        $userY = Money_year::where('basic_work','1')->first();
        if ($userL>0){
            $userY = User_year::where('user_id',$this->getId())->first();
        }
        $parentTitle="تسجيل طالب في الدورة";
        $title="شؤون الطلبه";

        $item=Course::where("id",$id)->where("isdelete",0)->first();
        $students=Student::leftJoin('students_year', 'students_year.student_id','=','students.id')
            ->select(['students.id', 'students_year.m_year', 'students.nameAR', 'students.birthday', 'students.phone1', 'students.whatsup', 'students_year.active','students.isdelete', 'students.created_at'])
            ->where('students_year.m_year','=',$this->getMoneyYear())
            ->where('students_year.active','=',1)->where('students.isdelete','=',0)->orderBy('students.nameAR')->get();
        /*$students=Student::where("isdelete",0)->where("m_year",$userY->year)->where("active",1)->get();*/
        $student_courses=Student_course::where("isdelete",0)->get();
        $ss = [];
        $sc_s = [];
        foreach ($student_courses as $student_course) {
            if ($student_course->course_id == $id){
                array_push($sc_s,$student_course->student_id);
            }
        }
        $scs_s = array_unique($sc_s);
        foreach ($students as $student){
            array_push($ss, $student->id);
        }
        $s = array_diff($ss,$scs_s);

        if($item==NULL){
            Session::flash("msg","الرجاء التأكد من الرابط المطلوب");
            return redirect("/CMS/StudentCourse/");
        }
        return view("cms.studentCourse.add",compact("title","item","id","students","id","s","scs_s","parentTitle"));
    }/*

    public function postStudentCourse(Request $request)
    {
        $this->validate($request,
            [
                'student_id' => 'required'
            ],
            [
                "required"=>"يجب ادخال هذا الحقل"
            ]);
        $student_course = Student_course::create([
            'course_id' => $request->input("course_h"),
            'student_id' => $request->input("student_id"),
            'created_by' => $this->getId()
        ]);
        Session::flash("msg","تمت عملية الاضافة بنجاح");
        return redirect("/CMS/StudentCourse/");
    }*/

    function getUserYear($id){
        $isFind=User_year::where('user_id',$this->getId())->count();
        if ($isFind>0){
            $item=User_year::where('user_id',$this->getId())->first();
            $item->year=$id;
            $item->save();
        }else{
            $item= new User_year();
            $item->user_id= $this->getId();
            $item->year= $id;
            $item->save();
        }
        $data=User_year::where('user_id',$this->getId())->first();
        $year = $data->year;
        return response()->json(['status' => '1','year' => $year]);
    }

    function getMMSalary($id){
        $rew=0;
        $rec=0;
        $recs=0;
        $adv=0;

        $salary=Salary::where('id',$id)->where('isdelete',0)->first();
        $remaind=$salary->remaind;

        $isReceipt_reward=Receipt_reward::where('employee_id',$salary->employee_id)->where('receipts_rewards',$salary->month)->where('m_year',$salary->year)->where('isdelete',0)->count();
        if ($isReceipt_reward>0){
            $receipt_rewards=Receipt_reward::where('employee_id',$salary->employee_id)->where('isdelete',0)->where('receipts_rewards',$salary->month)->where('m_year',$salary->year)->get();
            foreach ($receipt_rewards as $receipt_reward){
                if ($receipt_reward->type==0){
                    $rew += $receipt_reward->amount;
                }
                if ($receipt_reward->type==1){
                    $rec += $receipt_reward->amount;
                }
            }
        }

        $net=$salary->salary + $rew - $rec;

        $isReceipt_salary=Receipt_salary::where('employee_id',$salary->employee_id)->where('month',$salary->id)->where('isdelete',0)->where('m_year',$salary->year)->count();
        if ($isReceipt_salary>0){
            $receipt_salarys=Receipt_salary::where('employee_id',$salary->employee_id)->where('isdelete',0)->where('month',$salary->id)->where('m_year',$salary->year)->get();
            foreach ($receipt_salarys as $receipt_salary){
                $recs += $receipt_salary->amount+$receipt_salary->advance_payment;
            }
        }

        $isReceipt_advance=Receipt_advance::where('employee_id',$salary->employee_id)->where('m_year',$salary->year)->where('isdelete',0)->count();
        if ($isReceipt_advance>0){
            $receipt_advances=Receipt_advance::where('employee_id',$salary->employee_id)->where('m_year',$salary->year)->where('isdelete',0)->get();
            foreach ($receipt_advances as $receipt_advance){
                $nn=$receipt_advance->start_payment;
                $mm=$receipt_advance->start_payment+$receipt_advance->month_count;
                for ($i=$nn;$i<$mm;$i++){
                    if ($salary->month == $i){
                        $adv += $receipt_advance->month_payment;
                    }
                }
            }
        }

        $rem=$net-($recs+$adv);

        return response()->json([
            'status' => '1',
            'remaind' => $remaind,
            'rew' => $rew,
            'rec' => $rec,
            'net' => $net,
            'recs' => $recs,
            'adv' => number_format($adv,2),
            'rem' => number_format($rem,2),
        ]);
    }

    function getRTeacher($id){
        if(is_numeric($id)){
        $course=Course::find($id);
        $value_sum=0;
        $total_amount=0;
        $total_remaind=0;

        if ($course->ratio_type==29){

      $per=0;
    $amounts=0;

            $student_courses = Student_course::where('course_id',$course->id)->where('m_year', '=', $this->getMoneyYear())->where('isdelete','=','0')->get();

            foreach ($student_courses as $student_course) {
                if ($student_course->iswithdrawal==0){
                    $isCatch_receipt=Catch_receipt::where('student_course_id',$student_course->id)->where('m_year', '=', $this->getMoneyYear())->count();
                    if ($isCatch_receipt){
                        $amounts=Catch_receipt::where('student_course_id',$student_course->id)->where('m_year', '=', $this->getMoneyYear())->sum('amount');
                        $per += $amounts * $course->percentage / 100;
                        $pay=0;
                        $amounts=0;
                    }
                }
                else{
                    $isWithdrawal=Withdrawal::where('student_course_id',$student_course->id)->count();
                    if ($isWithdrawal>0) {
                        $withdrawals = Withdrawal::where('student_course_id', $student_course->id)->get();
                        $am = 0;
                        foreach ($withdrawals as $withdrawal) {
                            $am += $withdrawal->teacher_fees;
                        }
                        $per += $am;
                    }
                }
            }
            $value_sum=number_format($per,2);
        }else{
$value_sum=$course->value_sum;

}
 $total_amount=Receipt_course::where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->where('course_id', '=', $id)->sum('amount');
        $total_remaind=$value_sum-$total_amount;

        return response()->json(['status' => '1','value_sum' => $value_sum,'total_amount' => $total_amount,'total_remaind' => $total_remaind]);
        }
    }

    function getCourseRep($id){
        $course=Course::find($id);
        $courseName=$course->courseAR;
        $courseReg=$course->total_reg_student;
        $courseWith=$course->total_withdrawn_student;
        $courseStart=$course->begin;
        $regFees=$course->reg_fees;
        $docsFees=$course->decisions_fees;
        $courseFees=$course->course_fees;
        $totalFees=$course->total_fees;
        $value_sum=$course->value_sum;
        $courseStu=$courseWith+$courseReg;

        $teacher=Teacher::find($course->teacher_id);
        $teacherName=$teacher->name;
        $teacherPhone=$teacher->phone1 .' - ' . $teacher->phone2;
        $ratio=$course->ratio_type;
        $percentage=$course->percentage;
        $agreed_tfees=$course->teacher_fees;
        $teacherRatio=Option::find($course->ratio_type)->title;

        $stotal_fees=0;
        $spayed=0;
        $sremain=0;
        $center_fees=0;
        $teacher_fees=0;
        $teacher_catch=0;
        $teacher_remain=0;
        $all_center_fees=0;
        $all_teacher_fees=0;
        $refunds=0;
        $scourses=Student_course::where('course_id',$id)->where('isdelete',0)->where('m_year',$this->getMoneyYear())->get();
        if(count($scourses)>0){
            foreach($scourses as $scourse){
                $stotal_fees +=$scourse->price;
                $studentpay=Catch_receipt::where('student_course_id',$scourse->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');
                $spayed +=$studentpay;

                    if ($scourse->iswithdrawal==1){
                        $swithdrawal=Withdrawal::where('student_course_id',$scourse->id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->first();
                        if ($course->ratio_type !=15){
                        $teacher_fees +=$swithdrawal->teacher_fees;
                        $refunds +=$swithdrawal->refund;
                        }
                        $center_fees +=$swithdrawal->center_fees;
                    }else{
                        if ($course->ratio_type==29){
                        $tfees= $studentpay * $course->percentage / 100;
                        $center_fees +=$studentpay-$tfees;
                        $teacher_fees +=$tfees;
                        }
                    }

            }
        }
        $teacher_catch=Receipt_course::where('course_id',$id)->where('isdelete','=','0')->where('m_year',$this->getMoneyYear())->sum('amount');

        if ($course->ratio_type==29){
            $teacher_remain=$teacher_fees-$teacher_catch;
        $all_t_fees=$agreed_tfees*$courseStu;
        $all_teacher_fees=$all_t_fees*$percentage /100;
        }else if($course->ratio_type==18){
        $all_teacher_fees=$course->value_sum*$courseStu;
        $teacher_fees=$all_teacher_fees;
        $teacher_remain=$all_teacher_fees-$teacher_catch;
         $center_fees=$center_fees+$spayed-$teacher_fees;
        }
        else if($course->ratio_type==15){

        $teacher_fees=$course->value_sum;
        $all_teacher_fees=$teacher_fees/$courseStu;
        $teacher_remain=$teacher_fees-$teacher_catch;
         $center_fees=$center_fees+$spayed-$teacher_fees;
        }
        if($course->ratio_type==15){
            $all_center_fees=$stotal_fees-$teacher_fees;
            $sremain=$stotal_fees-$spayed;
          // $colums=$stotal_fees+$spayed+$sremain+$center_fees;
        }else{
         $all_center_fees=$stotal_fees-$all_teacher_fees;
        $sremain=$stotal_fees-$spayed;
       //$colums=$stotal_fees+$spayed+$sremain+$center_fees+$teacher_fees;
        }
       return response()->json([
            'status' => '1',
            'courseName' => $courseName,
            'courseReg' => $courseReg,
            'courseWith' => $courseWith,
            'courseStart' => $courseStart,
            'regFees' => $regFees,
            'docsFees' => $docsFees,
            'courseFees' => $courseFees,
            'totalFees' => $totalFees,
            'teacherName' => $teacherName,
            'teacherPhone' => $teacherPhone,
            'teacherRatio' => $teacherRatio,
            'ratio' => $ratio,
            'percentage' => $percentage,
            'agreed_teacher_fees' => $agreed_tfees,
            'stotal_fees' => number_format($stotal_fees,2),
            'spayed' => number_format($spayed,2),
            'sremain' => number_format($sremain,2),
            'center_fees' => number_format($center_fees,2),
            'teacher_fees' => number_format($teacher_fees,2),
            'refunds' => number_format($refunds,2),
            'teacher_catch' => number_format($teacher_catch,2),
            'teacher_remain' => number_format($teacher_remain,2),
            'all_teacher_fees' => number_format($all_teacher_fees,2),
            'all_center_fees' => number_format($all_center_fees,2),
            'value_sum' => $value_sum

        ]);
    }



    function getCourseReport($id){
        $course=Course::find($id);
        $courseName=$course->courseAR;
        $courseReg=$course->total_reg_student;
        $courseWith=$course->total_withdrawn_student;
        $regFees=$course->reg_fees;
        $docsFees=$course->decisions_fees;
        $courseFees=$course->course_fees;
        $totalFees=$course->total_fees;
        $recCourse=0;
        $recTeacher=0;
        $totalSum=0;

        $isSC=Student_course::where('course_id',$course->id)->where('isdelete','=','0')->count();
        if ($isSC>0){
            $scs=Student_course::where('course_id',$course->id)->where('isdelete','=','0')->get();
            foreach ($scs as $sc){
                $isCR=Catch_receipt::where('student_course_id',$sc->id)->count();
                if ($isCR>0){
                    $crs=Catch_receipt::where('student_course_id',$sc->id)->get();
                    foreach ($crs as $cr){
                        $recCourse+=$cr->amount;
                    }
                }
            }
        }

        $isRC=Receipt_course::where('course_id',$course->id)->count();
        if ($isRC>0){
            $rcs=Receipt_course::where('course_id',$course->id)->get();
            foreach ($rcs as $rc){
                $recTeacher+=$rc->amount;
            }
        }
        $totalSum=$recCourse-$recTeacher;

        return response()->json([
            'status' => '1',
            'courseName' => $courseName,
            'courseReg' => $courseReg,
            'courseWith' => $courseWith,
            'regFees' => $regFees,
            'docsFees' => $docsFees,
            'courseFees' => $courseFees,
            'totalFees' => $totalFees,
            'recCourse' => $recCourse,
            'recTeacher' => $recTeacher,
            'totalSum' => $totalSum
        ]);
    }

    function getStudentRep($id){
        $student=Student::find($id);

        $studentName=$student->nameAR;
        $studentPhone=$student->phone1.' - '.$student->phone2;
        $studentType=Option::find($student->classification)->title;
        $totalSum=0;
        $receiptSum=0;
        $isStudent_course=Student_course::where('student_id',$student->id)->where('isdelete','=','0')->count();
        if ($isStudent_course>0) {
            $student_courses = Student_course::leftJoin('catch_receipts', 'catch_receipts.student_course_id','=','student_course.id')->where('student_course.student_id', $student->id)->where('student_course.isdelete','=','0')->where('catch_receipts.isdelete','=','0')->get();
            foreach ($student_courses as $student_course) {
                $totalSum += $student_course->price;
                $receiptSum += $student_course->amount;
            }
        }
        $remaindSum=$totalSum-$receiptSum;

        return response()->json([
            'status' => '1',
            'studentName' => $studentName,
            'studentPhone' => $studentPhone,
            'studentType' => $studentType,
            'totalSum' => $totalSum,
            'receiptSum' => $receiptSum,
            'remaindSum' => $remaindSum
        ]);
    }

    function getTaskRep($id){
        if($id == "0"){
            $users=User::where('isdelete',0)->where('Status','مفعل')->get();
            $taskName="الكل";
          $arr=[];
          foreach($users as $user){
            array_push($arr, $user->id);
          }
            $taskDone=Task::whereIn('receiver',$arr)->where('isdelete',0)->where('active',1)->where('evaluate','!=',null)->where('end_date','!=',null)->count();
            $taskRun=Task::whereIn('receiver',$arr)->where('isdelete',0)->where('active',1)->where('start_date','!=',null)->where('end_date','=',null)->count();
            $ratio=array();
            foreach($users as $user){
                $count=Task::whereIn('receiver',$arr)->where('isdelete',0)->where('active',1)->where('evaluate','!=',null)->where('end_date','!=',null)->whereColumn('sender', '!=','receiver')->whereIn('sender',$arr)->count();
            if ($count>0){
                $ratios=Task::whereIn('receiver',$arr)->whereIn('sender',$arr)->where('isdelete',0)->where('active',1)->where('evaluate','!=',null)->where('end_date','!=',null)->whereColumn('sender', '!=','receiver')->sum('evaluate');
                if($count==0){$taskRatio = 0;
                }else{ $taskRatio = number_format($ratios/$count,2);}
                array_push($ratio,$taskRatio);
            }else{

                $taskRatio=0;
            }

            }

            $allratios=array_sum($ratio);
            $allcount=count($ratio);
            $alltaskRatio= number_format($allratios/$allcount,2);

            return response()->json([
                'status' => '1',
                'taskRatio' => number_format($alltaskRatio,1),
                'taskName' => $taskName,
                'taskDone' => $taskDone,
                'taskRun' => $taskRun
            ]);
        }else{
        $user=User::find($id);
        $taskName=$user->name;

        $taskDone=Task::where('receiver',$id)->where('isdelete',0)->where('active',1)->whereNotNull('evaluate')->where('end_date','!=',null)->count();
        $taskRun=Task::where('receiver',$id)->where('isdelete',0)->where('active',1)->where('start_date','!=',null)->where('end_date','=',null)->count();
        $users=User::where('Status','مفعل')->where('isdelete',0)->get();
        $ratio=array();
        foreach($users as $user){
            $count=Task::where('receiver',$id)->where('isdelete',0)->where('active',1)->where('evaluate','!=',null)->where('end_date','!=',null)->whereColumn('sender', '!=','receiver')->where('sender',$user->id)->count();
        if ($count>0){
            $ratios=Task::where('receiver',$id)->where('sender',$user->id)->where('isdelete',0)->where('active',1)->where('evaluate','!=',null)->where('end_date','!=',null)->whereColumn('sender', '!=','receiver')->sum('evaluate');
            if($count==0){$taskRatio = 0;
            }else{ $taskRatio = number_format($ratios/$count,2);}
            array_push($ratio,$taskRatio);
        }else{

            $taskRatio=0;
        }

        }

        $allratios=array_sum($ratio);
        $allcount=count($ratio);
        $alltaskRatio= number_format($allratios/$allcount,2);

        return response()->json([
            'status' => '1',
            'taskRatio' => number_format($alltaskRatio,1),
            'taskName' => $taskName,
            'taskDone' => $taskDone,
            'taskRun' => $taskRun
        ]);
    }

    function getUserYearD($id){
        $isFind=User_year::where('user_id',$id)->count();
        if ($isFind>0){
            $item=User_year::where('user_id',$id)->where('isdelete',0)->first();
            $item->delete();
        }

        return response()->json(['status' => '1']);
    }
    }
}
