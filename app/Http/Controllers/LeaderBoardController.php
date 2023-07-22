<?php

namespace App\Http\Controllers;

use App\Models\LeaderBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderBoardController extends Controller
{
    public function getLeaderBoardData(){

        $monthName = $this->returnMonth(date('m'));
        
        $leaderBoardData = LeaderBoard::where('month',date('m'))->where('year',date('y'))->orderBy('totalMarks', 'desc')->get();
        $myPosition = $this->returnPosition($leaderBoardData);
        // prev 3 month leader board data

        $PrevPostionArr = [];
        $prevLeaderBoard = [];

        // prev 1st month
        $prevMonth1 = date("m") - 1 ;
        $prevMonth2 = date("m") - 2 ;
        $prevMonth3 = date("m") - 3 ;


        $leaderBoardData1 = LeaderBoard::where('month',$prevMonth1)->where('year',date('y'))->orderBy('totalMarks', 'desc')->get();
        $myPosition1 = $this->returnPosition($leaderBoardData1);

        $leaderBoardData2 = LeaderBoard::where('month',$prevMonth2)->where('year',date('y'))->orderBy('totalMarks', 'desc')->get();
        $myPosition2 = $this->returnPosition($leaderBoardData2);

        $leaderBoardData3 = LeaderBoard::where('month',$prevMonth3)->where('year',date('y'))->orderBy('totalMarks', 'desc')->get();
        $myPosition3 = $this->returnPosition($leaderBoardData3);


        if($prevMonth1 <= 0){
            $month = 12 + $prevMonth1;
            $year = date("y")-1;

            $leaderBoardData1 = LeaderBoard::where('month',$month)->where('year',$year)->orderBy('totalMarks', 'desc')->get();
            $myPosition1 = $this->returnPosition($leaderBoardData1);
        }
        if($prevMonth2 <= 0){
            $month = 12 + $prevMonth2;
            $year = date("y")-1;

            $leaderBoardData2 = LeaderBoard::where('month',$month)->where('year',$year)->orderBy('totalMarks', 'desc')->get();
            $myPosition2 = $this->returnPosition($leaderBoardData2);
        }
        if($prevMonth3 <= 0){
            $month = 12 + $prevMonth3;
            $year = date("y")-1;

            $leaderBoardData3 = LeaderBoard::where('month',$month)->where('year',$year)->orderBy('totalMarks', 'desc')->get();
            $myPosition3 = $this->returnPosition($leaderBoardData3);
        }

        array_push( $PrevPostionArr , $myPosition1,$myPosition2,$myPosition3 );
        array_push( $prevLeaderBoard ,$leaderBoardData1, $leaderBoardData2, $leaderBoardData3 );

        
        
        return view("leaderBoard.leaderBoard",[
            "leaderBoard"=>$leaderBoardData,
            "monthName"=>$monthName,
            "myPosition"=>$myPosition,
            "PrevPostionArr"=>$PrevPostionArr,
            "prevLeaderBoard"=>$prevLeaderBoard,
        ]);
    }
    // return me month name
    public function returnMonth($m){
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
        return  $monthName;
    }

    // return  position
    public function returnPosition($leaderBoardData){
        $myPosition = 0;
        if(Auth::user() !=null){
            for ($i=0; $i <sizeof($leaderBoardData) ; $i++) { 
                if($leaderBoardData[$i]->username == Auth::user()->username){
                    $myPosition = $i+1;
                    break;
                }
            }
        }
        return $myPosition;
    }
}
