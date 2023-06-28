<?php 
    use Illuminate\Support\Facades\Auth;

    // return me month name
    function returnMonth($m){
        if($m == 1){
            $monthName = "জানুয়ারি"; 
        }else if($m == 2){
            $monthName = "ফেব্রুয়ারি"; 
        }
        else if($m == 3){
            $monthName = "মার্চ"; 
        }
        else if($m == 4){
            $monthName = "এপ্রিল"; 
        }
        else if($m == 5){
            $monthName = "মে"; 
        }
        else if($m == 6){
            $monthName = "জুন"; 
        }
        else if($m == 7){
            $monthName = "জুলাই"; 
        }
        else if($m == 8){
            $monthName = "আগস্ট"; 
        }
        else if($m == 9){
            $monthName = "সেপ্টেম্বর"; 
        }
        else if($m == 10){
            $monthName = "অক্টোবর"; 
        }
        else if($m == 11){
            $monthName = "নভেম্বর"; 
        }
        else if($m == 12){
            $monthName = "ডিসেম্বর"; 
        }
        return  $monthName;
    }

?>
@extends('layouts.master')
@section('title',"লিডারবোর্ড")
@section('content')
    <div class="container">
        <h1 class="mt-2 mb-4 text-center text-muted">প্রত্যেক মাসের লিডারবোর্ড এর তালিকা </h1>
        <div class="row">
            <div class="col-md-6">
                <h3 class="my-2 text-info">চলতি মাসের তালিকা</h3>
                <div class="border rounded w-100 bg-light p-3 my-4">
                    <div class="row">
                            @if (Auth::user() != null)
                                <div class="col-6">
                                    <p>ইউজার নেইম - </p>
                                    <p>অংশগ্রহণকৃত পরীক্ষা -</p>
                                    <p>মোট মার্কস -</p>
                                    <p>অ্যাভারেজ মার্কস -</p>
                                    <p class="text-danger"><b>পজিসন -</b></p>
                                </div>
                            @else
                                <div class="col-12">
                                <p class="text-danger"> তুমি কি আমাদের সাইটে নতুন এসেছ ? তাহলে <a href="{{ route('signUp') }}">এখানে ক্লিক</a> করে সাইন আপ করে নাও  </p>
                                </div>
                            @endif
                        @if (Auth::user() != null)
                            <div class="col-6 text-end">
                                <p>{{ Auth::user()->username }}</p>
                                <p>{{ Auth::user()->totalExams }}</p>
                                @if ($myPosition !=0)
                                    <p class="text-muted">{{$leaderBoard[$myPosition-1]->totalExams}}</p>
                                    <p class="text-muted">{{$leaderBoard[$myPosition-1]->totalMarks}}</p>
                                    <p class="text-muted">{{$leaderBoard[$myPosition-1]->totalMarks /$leaderBoard[$myPosition-1]->totalExams}}</p>
                                @else
                                    <p>কোন পরীক্ষা দাও নি</p>
                                @endif
                                <p class="text-danger"><b>@if ($myPosition == 0)
                                    কোন পরীক্ষা দাও নি
                                @else
                                    {{$myPosition}} 
                                @endif</b></p>
                            </div>
                        @endif
                    </div>
                </div>
                <p class="lead p-2 bg-primary text-white">{{$monthName}} মাস (20{{ date('y') }}) - {{date('d')}} তম দিন / {{cal_days_in_month(CAL_GREGORIAN, date('m'), date('y'))}} </p>
                <div class="table-responsive">
                    <table class="table border table-hover text-muted">
                        <thead>
                        <tr>
                            <th scope="col">পজিসন</th>
                            <th scope="col">ইউজার নেইম</th>
                            <th scope="col">মোট এক্সামস</th>
                            <th scope="col">মোট মার্কস</th>
                            <th scope="col">অ্যাভারেজ মার্কস</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if (sizeof($leaderBoard)>0)
                                @foreach ($leaderBoard as $d)
                                    @if ($loop->index + 1 <=5)
                                        <tr class="bg-light text-dark">
                                            <th scope="row">{{$loop->index + 1}}</th>
                                            <td>{{ $d->username }}</td>
                                            <td>{{ $d->totalExams }}</td>
                                            <td>{{ $d->totalMarks }}</td>
                                            <td>{{ $d->totalMarks/$d->totalExams }}</td>
                                        </tr> 
                                    @else
                                        <tr>
                                            <th scope="row">{{$loop->index + 1}}</th>
                                            <td>{{ $d->username }}</td>
                                            <td>{{ $d->totalExams }}</td>
                                            <td>{{ $d->totalMarks }}</td>
                                            <td>{{ $d->totalMarks/$d->totalExams }}</td>
                                        </tr> 
                                    @endif
                                @endforeach
                            @else
                                <p>No data found!</p>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="mt-5 mb-3 text-muted text-info">বিগত তিন মাসের তালিকাসমুহ</h3>
                @for ($i=0; $i<3; $i++)
                    @if (sizeof($prevLeaderBoard[$i]) > 0)
                        <p class="lead p-2 bg-secondary text-white"><?php echo returnMonth($prevLeaderBoard[$i][0]->month); ?> মাস (20{{$prevLeaderBoard[$i][0]->year }}) - {{cal_days_in_month(CAL_GREGORIAN, $prevLeaderBoard[$i][0]->month, $prevLeaderBoard[$i][0]->year)}} দিন </p>
                        <p class="lead">
                            @if ($PrevPostionArr[$i] != 0)
                                <p class="text-muted"><b>তোমার পজিশন - </b>{{ $PrevPostionArr[$i] }} </p>
                            @else
                                <p class="text-muted">এই মাসে তুমি কোনো পরীক্ষায় অংশগ্রহণ করনি </p>
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table border table-hover text-muted">
                                <thead>
                                <tr>
                                    <th scope="col">পজিসন</th>
                                    <th scope="col">ইউজার নেইম</th>
                                    <th scope="col">মোট এক্সামস</th>
                                    <th scope="col">মোট মার্কস</th>
                                    <th scope="col">অ্যাভারেজ মার্কস</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if (sizeof($prevLeaderBoard[$i])>0)
                                        @foreach ($prevLeaderBoard[$i] as $d)
                                            @if ($loop->index + 1 <=5)
                                                <tr class="bg-light text-dark">
                                                    <th scope="row">{{$loop->index + 1}}</th>
                                                    <td>{{ $d->username }}</td>
                                                    <td>{{ $d->totalExams }}</td>
                                                    <td>{{ $d->totalMarks }}</td>
                                                    <td>{{ $d->totalMarks/$d->totalExams }}</td>
                                                </tr> 
                                            @else
                                                <tr>
                                                    <th scope="row">{{$loop->index + 1}}</th>
                                                    <td>{{ $d->username }}</td>
                                                    <td>{{ $d->totalExams }}</td>
                                                    <td>{{ $d->totalMarks }}</td>
                                                    <td>{{ $d->totalMarks/$d->totalExams }}</td>
                                                </tr> 
                                            @endif
                                        @endforeach
                                    @else
                                        <p>No data found!</p>
                                    @endif
                                </tbody>
                            </table>
                            <div class="my-4"></div>
                        </div>
                        <div class="my-5"></div>
                    @else
                        {{-- <h4 class="my-3">No data found!</h4> --}}
                    @endif
                @endfor
            </div>
        </div>
    </div>
@endsection