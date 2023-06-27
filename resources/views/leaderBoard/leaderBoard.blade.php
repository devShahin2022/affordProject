<?php 
    use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.master')
@section('title',"লিডারবোর্ড")
@section('content')
    <div class="container">
        <h1 class="mt-2 mb-4 text-center">প্রত্যেক মাসের লিডারবোর্ড এর তালিকা </h1>
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
                    <table class="table border table-hover">
                        <thead>
                        <tr>
                            <th scope="col">পজিসন</th>
                            <th scope="col">ইউজার ন্যাম</th>
                            <th scope="col">মোট এক্সামস</th>
                            <th scope="col">মোট মার্কস</th>
                            <th scope="col">অ্যাভারেজ মার্কস</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if (sizeof($leaderBoard)>0)
                                @foreach ($leaderBoard as $d)
                                    @if ($loop->index + 1 <=5)
                                        <tr class="bg-success text-white">
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
                <h3 class="my-2 text-muted">বিগত মাসের তালিকাসমুহ</h3>
            </div>
        </div>
    </div>
@endsection