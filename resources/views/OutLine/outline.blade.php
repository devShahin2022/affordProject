@extends('layouts.master')
@section('title',"outline")
@section('content')
    <div class="w-100 h-auto position-relative">
        <img class="w-100 h-auto"src="{{asset("static_image/1.jpg")}}" alt="1">
        <div style="background-color: #00000086" class="position-absolute top-0 left-0 w-100 h-auto bottom-0 right-0">
            <div style="margin-top:10%;">
                <h1 class="text-light text-center">কোর্সের আউটলাইন</h1>
                <p class="lead text-center text-light">আমরা কিভাবে তোমাদের কোর্স টি সম্পন্ন করব ? </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mt-3 mb-4">আমাদের অফলাইন কারিকুলাম</h3>
            </div>
            <div class="col-md-6">
                <h3 class="mt-3 mb-4">কোর্স শুরুর সময়</h3>
            </div>
        </div>
    </div>
@endsection

 
