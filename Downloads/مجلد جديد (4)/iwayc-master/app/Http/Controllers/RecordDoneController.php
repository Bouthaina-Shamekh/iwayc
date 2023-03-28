<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Box_year;
use App\Models\Employee;
use App\Models\Receipt_warranty;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RecordDoneController extends CMSBaseController
{
    public function index()
    {
        $subtitle="ارشيف القرارات";
        $title="جديد 2019";
        return view("cms.recordDone.index",compact("title","subtitle"));
    }
}
