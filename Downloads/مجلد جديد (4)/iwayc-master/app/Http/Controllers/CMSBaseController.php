<?php

namespace App\Http\Controllers;

use App\Models\Money_year;
use App\Models\User_year;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CMSBaseController extends Controller
{
    public function __construct()
    {
        $moneyYears = Money_year::where('active','1')->orderBy('year')->get();
        $moneyWork = Money_year::where('basic_work','1')->first();
        View::share('moneyYears', $moneyYears);
        View::share('moneyWork',$moneyWork); 
    }

    public function getId(){
        $us = 'null';
        if (Auth::check()){
            $us = Auth::user()->id;
        }
        return $us;
    }

    public function getMoneyYear(){
        if (Auth::check()){
            $isUs = User_year::where('user_id',Auth::user()->id)->count();
            if ($isUs>0){
                $us = User_year::where('user_id',Auth::user()->id)->first();
            }else{
                $us = Money_year::where('basic_work',1)->first();
            }
            $us=$us->year;
        }
        return $us;
    }
}
