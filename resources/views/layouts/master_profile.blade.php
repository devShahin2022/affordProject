<?php
use App\Models\User;
use Illuminate\Support\Facades\Auth;

$getUserData = User::where('id',Auth::user()->id)->first();
$userAccountType = $getUserData->account_type;

?>

@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row my-4">
        <div class="col-md-4 bg-light mt-5">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <div style="border-radius:50%;width:100px;height:100px; margin-top:-2rem;" class="border border-3 border-white">
                    <img style="width:100px; height:100px; border-radius:50%;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyKpQUy8JP90MAZxFjU0P9bPqkUWL35fd8Ag&usqp=CAU" alt="avatar">
                </div>
                <button class="btn btn-primary btn-sm my-2">Edit photo</button>
            </div>
            <div class="my-4">
                <div class="d-flex justify-content-between">
                  @if ($userAccountType == 2)
                   <button class="btn btn-sm btn-info mt-2">WOW!! অ্যাকাউন্ট Premium</button>  
                  @else
                   <button class="btn btn-sm btn-dark mt-2">Make Premium</button>
                  @endif
                  @if ($userAccountType == 'pending')
                  <a href="{{route('getSscExamForm')}}"><button class="btn btn-sm btn-success mt-2">তোমার ভর্তি Pending...</button></a>
                  @endif
                  @if ($userAccountType == 0)
                  <a href="{{route('getSscExamForm')}}"><button class="btn btn-sm btn-success mt-2">এসএসসি ব্যাচ-১ ভর্তি হব</button></a>
                  @endif
                  @if ($userAccountType == 2)
                  <a href="{{route('getSscExamForm')}}"><button class="btn btn-sm btn-success mt-2">অভিনন্দন!!! ব্যাচ-১ ভর্তি সম্পূর্ণ</button></a>
                  @endif
                </div>
                <a href="{{route('showQuestionPage')}}"><button class="btn btn-danger w-100 my-2">questions</button></a>
                <button class="btn btn-danger w-100 my-2">See current rank</button>
                <button class="btn btn-danger w-100 my-2">Attendace</button>
                <button class="btn btn-danger w-100 my-2">Payment history</button>
                <button class="btn btn-danger w-100 my-2">Personal information</button>
                <button class="btn btn-danger w-100 my-2">Check result</button>
                <button class="btn btn-danger w-100 my-2">Your blogs</button>
                <button class="btn btn-danger w-100 my-2">Add review</button>
                <button class="btn btn-danger w-100 my-2">অভিযোগ করুন</button>
            </div>
        </div>
        <div class="col-md-8">
            @yield('profileContent')
        </div>
    </div>
</div>
@endsection