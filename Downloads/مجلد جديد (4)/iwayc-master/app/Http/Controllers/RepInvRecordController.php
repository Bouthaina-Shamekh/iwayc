<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CMSBaseController;

class RepInvRecordController extends CMSBaseController
{
    public function getIndex()
    {
        $subtitle="سجلات الجرد والتسوية";
        $title="ادارة المستودعات";
        $linkApp="/CMS/Repository/";
        return view("cms.repInvRecord.index",compact("title","subtitle","linkApp"));
    }
}
