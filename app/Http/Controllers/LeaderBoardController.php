<?php

namespace App\Http\Controllers;

use App\Models\LeaderBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderBoardController extends Controller
{
    public function getLeaderBoardData(){
        // $year = date('Y');
        // $month = date('m');
        // $day = date('d');
        // dd($day);
        // $year = 2023; // Set the desired year
        // $month = 2; // Set the desired month (June)

        // $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        // dd($numberOfDays);
        $monthName = '';
        if(date('m') == 1){
            $monthName = "জানুয়ারি"; 
        }else if(date('m') == 2){
            $monthName = "ফেব্রুয়ারি"; 
        }
        else if(date('m') == 3){
            $monthName = "মার্চ"; 
        }
        else if(date('m') == 4){
            $monthName = "এপ্রিল"; 
        }
        else if(date('m') == 5){
            $monthName = "মে"; 
        }
        else if(date('m') == 6){
            $monthName = "জুন"; 
        }
        else if(date('m') == 7){
            $monthName = "জুলাই"; 
        }
        else if(date('m') == 8){
            $monthName = "আগস্ট"; 
        }
        else if(date('m') == 9){
            $monthName = "সেপ্টেম্বর"; 
        }
        else if(date('m') == 10){
            $monthName = "অক্টোবর"; 
        }
        else if(date('m') == 11){
            $monthName = "নভেম্বর"; 
        }
        else if(date('m') == 12){
            $monthName = "ডিসেম্বর"; 
        }

        $myPosition = 0;

        $leaderBoardData = LeaderBoard::orderBy('totalMarks', 'desc')->get();
        if(Auth::user() !=null){
            for ($i=0; $i <sizeof($leaderBoardData) ; $i++) { 
                if($leaderBoardData[$i]->username == Auth::user()->username){
                    $myPosition = $i+1;
                    break;
                }
            }
        }
        return view("leaderBoard.leaderBoard",["leaderBoard"=>$leaderBoardData,"monthName"=>$monthName,"myPosition"=>$myPosition]);
    }
}
