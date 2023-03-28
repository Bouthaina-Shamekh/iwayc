<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Absence;
use App\Models\Box_year;
use App\Models\Receipt_box;
use App\Models\Record_done;
use App\Models\Receipt_reward;
use App\Models\Receipt_salary;
use App\Models\Rep_inv_record;
use App\Models\Repository_out;
use App\Models\Student_course;
use App\Models\Approval_record;
use App\Models\Receipt_advance;
use App\Models\Receipt_student;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CMSBaseController;

class ApprovalRecordController extends CMSBaseController
{
    public function index()
    {
        $subtitle=  "طلب موافقه الحركه";
        $title="صفحتي الشخصيه";
    /*     $this->getData(); */
        return view("cms.approvalRecord.index",compact("title","subtitle"));
    }

    public function getData()
    {
      /*   $approvalRecordReceiptSalary=Approval_record::where("slug",'ReceiptSalary')->pluck('row_id');
        $receiptSalary=Receipt_salary::where("isdelete",0)->where("isAdmin",0)->pluck('id');
        $diff1 = collect($receiptSalary)->diff(collect($approvalRecordReceiptSalary));
        foreach ($diff1 as $d) {
            $data=Receipt_salary::where("id",$d)->first();
            $add = new Approval_record();
            $add->row_id=$data->id;
            $add->model_id='App\Receipt_salary';
            $add->slug='ReceiptSalary';
            $add->section='صرف رواتب';
            $add->user_id=$data->created_by;
            $add->date=$data->created_at;
            $add->save();
        } */

   /*      $approvalRecordWithdrawal=Approval_record::where("slug",'Withdrawal')->pluck('row_id');
        $withdrawal=Withdrawal::where("isdelete",0)->where("isAdmin",0)->pluck('id');
        $diff1 = collect($withdrawal)->diff(collect($approvalRecordWithdrawal));
        foreach ($diff1 as $d) {
            $data=Withdrawal::where("id",$d)->first();
            $add = new Approval_record();
            $add->row_id=$data->id;
            $add->model_id='App\Withdrawal';
            $add->slug='Withdrawal';
            $add->section='انسحاب طالب';
            $add->user_id=$data->created_by;
            $add->date=$data->created_at;
            $add->save();
        } */

       /*  $approvalRecordReceiptReward=Approval_record::where("slug",'ReceiptReward')->pluck('row_id');
        $receiptReward=Receipt_reward::where("isdelete",0)->where("isAdmin",0)->pluck('id');
        $diff1 = collect($receiptReward)->diff(collect($approvalRecordReceiptReward));
        foreach ($diff1 as $d) {
            $data=Receipt_reward::where("id",$d)->first();
            $add = new Approval_record();
            $add->row_id=$data->id;
            $add->model_id='App\Receipt_reward';
            $add->slug='ReceiptReward';
            $add->section='صرف مكافأة - خصم';
            $add->user_id=$data->created_by;
            $add->date=$data->created_at;
            $add->save();
        } */

   /*      $approvalRecordReceiptAdvance=Approval_record::where("slug",'ReceiptAdvance')->pluck('row_id');
        $receiptAdvance=Receipt_advance::where("isdelete",0)->where("isAdmin",0)->pluck('id');
        $diff1 = collect($receiptAdvance)->diff(collect($approvalRecordReceiptAdvance));
        foreach ($diff1 as $d) {
            $data=Receipt_advance::where("id",$d)->first();
            $add = new Approval_record();
            $add->row_id=$data->id;
            $add->model_id='App\Receipt_advance';
            $add->slug='ReceiptAdvance';
            $add->section='صرف سلفة';
            $add->user_id=$data->created_by;
            $add->date=$data->created_at;
            $add->save();
        } */

    /*     $approvalRecordReceiptBox=Approval_record::where("slug",'ReceiptBox')->pluck('row_id');
        $receiptBox=Receipt_box::where("isdelete",0)->where("isAdmin",0)->pluck('id');
        $diff1 = collect($receiptBox)->diff(collect($approvalRecordReceiptBox));
        foreach ($diff1 as $d) {
            $data=Receipt_box::where("id",$d)->first();
            $add = new Approval_record();
            $add->row_id=$data->id;
            $add->model_id='App\Receipt_box';
            $add->slug='ReceiptBox';
            $add->section='صرف صندوق مستقل';
            $add->user_id=$data->created_by;
            $add->date=$data->created_at;
            $add->save();
        } */

  /*       $approvalRecordRepositoryOut=Approval_record::where("slug",'RepositoryOut')->pluck('row_id');
        $repositoryOut=Repository_out::where("isdelete",0)->where("isAdmin",0)->pluck('id');
        $diff1 = collect($repositoryOut)->diff(collect($approvalRecordRepositoryOut));
        foreach ($diff1 as $d) {
            $data=Repository_out::where("id",$d)->first();
            $add = new Approval_record();
            $add->row_id=$data->id;
            $add->model_id='App\Repository_out';
            $add->slug='RepositoryOut';
            $add->section='صرف صندوق مستودع';
            $add->user_id=$data->created_by;
            $add->date=$data->created_at;
            $add->save();
        } */

     /*    $approvalRecordRepInvRecord=Approval_record::where("slug",'RepInvRecord')->pluck('row_id');
        $repInvRecord=Rep_inv_record::where("isAdmin",0)->pluck('id');
        $diff1 = collect($repInvRecord)->diff(collect($approvalRecordRepInvRecord));
        foreach ($diff1 as $d) {
            $data=Rep_inv_record::where("id",$d)->first();
            $add = new Approval_record();
            $add->row_id=$data->id;
            $add->model_id='App\Rep_inv_record';
            $add->slug='RepInvRecord';
            $add->section='جرد وتسوية مستودع';
            $add->user_id=$data->user_id;
            $add->date=$data->created_at;
            $add->save();
        } */

  /*       $approvalRecordAbsence=Approval_record::where("slug",'Absence')->pluck('row_id');
        $absence=Absence::where("isdelete",0)->where("isAdmin",0)->pluck('id');
        $diff1 = collect($absence)->diff(collect($approvalRecordAbsence));
        foreach ($diff1 as $d) {
            $data=Absence::where("id",$d)->first();
            $add = new Approval_record();
            $add->row_id=$data->id;
            $add->model_id='App\Absence';
            $add->slug='Absence';
            $add->section='غياب ومغادرات المستخدمين';
            $add->user_id=$data->created_by;
            $add->date=$data->created_at;
            $add->save();
        } */

    }

    public function approve($id,FlasherInterface $flasher)
    {
        $approvalRecord=Approval_record::find($id);
        if($approvalRecord->slug == 'ReceiptSalary'){
            $item=Receipt_salary::where("id",$approvalRecord->row_id)->where("isdelete",0)->first();
            if($item){

                $box = Box_year::where('box_id',4)->where('m_year',$this->getMoneyYear())->first();
                $box->expense += $item->amount;
    //            $box->income += $request->input("advance_payment");
                $box->save();
                $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
                $center->expense += $item->amount;
    //            $center->income += $request->input("advance_payment");
                $center->save();
                $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
                $primary->expense += $item->amount;
    //            $primary->income += $request->input("advance_payment");
                $primary->save();
                $isSalary=Salary::where('id',$item->month)->count();
                if ($isSalary>0){
                    $salary=Salary::where('id',$item->month)->first();
                    $rr=$salary->remaind;
                    $salary->remaind = $rr-$item->amount;
                    $salary->save();
                }

            }else{
                flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
                return back();
            }

        }elseif($approvalRecord->slug == 'Receipt_student'){

            $item=Receipt_student::where("id",$approvalRecord->row_id)->where("isdelete",0)->first();
            if($item){
                $student_course=Student_course::where('id',$item->student_course_id)->where('isdelete',0)->first();
                $student_course->payment = 0;
                $student_course->save();
                $box = Box_year::where('box_id',3)->where('m_year',$this->getMoneyYear())->first();
                $box->expense += $item->amount;
                $box->save();
                $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
                $center->expense += $item->amount;
                $center->save();
                $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
                $primary->expense += $item->amount;
                $primary->save();

            }else{
                flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
                return back();
            }

        }elseif($approvalRecord->slug == 'ReceiptReward'){

            $item=Receipt_reward::where("id",$approvalRecord->row_id)->where("isdelete",0)->first();
            if($item){
                $box = Box_year::where('box_id',4)->where('m_year',$this->getMoneyYear())->first();
                $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
                $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
            if ($item->type=='0'){
                $box->expense += $item->amount;
                $box->save();
                $center->expense += $item->amount;
                $center->save();
                $primary->expense += $item->amount;
                $primary->save();
            }
            if ($item->type=='1'){
                $box->income += $item->amount;
                $box->save();
                $center->income += $item->amount;
                $center->save();
                $primary->income += $item->amount;
                $primary->save();
            }

            }else{
                flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
                return back();
            }
        }elseif($approvalRecord->slug == 'ReceiptAdvance'){

            $item=Receipt_advance::where("id",$approvalRecord->row_id)->where("isdelete",0)->first();
            if($item){

                $box = Box_year::where('box_id',4)->where('m_year',$this->getMoneyYear())->first();
                $box->expense += $item->advance_payment;
                $box->save();
                $center = Box_year::where('box_id',2)->where('m_year',$this->getMoneyYear())->first();
                $center->expense += $item->advance_payment;
                $center->save();
                $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
                $primary->expense += $item->advance_payment;
                $primary->save();


            }else{
                flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
                return back();
            }

        }elseif($approvalRecord->slug == 'ReceiptBox'){

            $item=Receipt_box::where("id",$approvalRecord->row_id)->where("isdelete",0)->first();
            if($item){

                $box = Box_year::where('box_id',$item->box_id)->where('m_year',$this->getMoneyYear())->first();
            $box->expense += $item->amount;
            $box->save();
            $isCenter = Box_year::where('box_id',$box->parent_id)->where('m_year',$this->getMoneyYear())->count();
            if ($isCenter>0){
                $center = Box_year::where('box_id',$box->parent_id)->where('m_year',$this->getMoneyYear())->first();
                $center->expense += $item->amount;
                $center->save();
            }
            $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
            $primary->expense += $item->amount;
            $primary->save();

            }else{
                flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
                return back();
            }

        }elseif($approvalRecord->slug == 'RepositoryOut'){
            $item=Repository_out::where("id",$approvalRecord->row_id)->where("isdelete",0)->first();
            if($item){
                $repository = Repository_year::where('repository_id',$item->repository_id)->where('m_year',$this->getMoneyYear())->first();
                $rep = Repository::where('id',$item->repository_id)->first();
                $repository->repository_out = $repository->repository_out+$item->total;
                if($repository->save()){
                    $box = Box_year::where('box_id',$rep->box_id)->where('m_year',$this->getMoneyYear())->first();
                    $box->expense = $repository->repository_out;
                    $box->save();
                    $primary = Box_year::where('box_id',1)->where('m_year',$this->getMoneyYear())->first();
                    $primary->expense += $item->total;
                    $primary->save();
                }
            }else{
                flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
                return back();
            }
        }else{
            flash()->addWarning("الرجاء التأكد من الرابط المطلوب");
            return back();
        }
        $model = $approvalRecord->model_id;
        $data = $model::find($approvalRecord->row_id);
        $data->isAdmin = 1;
        if ($data->save()){
            $Record_done = Record_done::create([
            'title' => $approvalRecord->section,
            'type' =>1,
            'res' =>$approvalRecord->user_id,
            'slug' =>$approvalRecord->slug,
            'row_id' =>$approvalRecord->row_id,
            'created_by'=>Auth::user()->id,
            ]);
            $approvalRecord->delete();
        }
        $flasher->addSuccess("تمت عمليه الموافقه بنجاح");
        return redirect()->route('RecordDone.index');
    }

    public function reject($id,FlasherInterface $flasher)
    {
        $approvalRecord=Approval_record::find($id);
        $model = $approvalRecord->model_id;
        $data = $model::find($approvalRecord->row_id);
        $data->isdelete = 1;
        if ($data->save()){
            $Record_done = Record_done::create([
                'title' => $approvalRecord->section,
                'type' =>0,
                'res' =>$approvalRecord->user_id,
                'slug' =>$approvalRecord->slug,
                'row_id' =>$approvalRecord->row_id,
                'created_by'=>Auth::user()->id,
                ]);
            $approvalRecord->delete();
        }
        $flasher->addError("تمت عمليه الرفض بنجاح");
        return redirect()->route('RecordDone.index');
    }
}
