@extends('layouts.master')
@section('title',"Home page")
@section('content')
    <div class="w-100 h-auto position-relative">
        <img class="w-100 h-auto"src="{{asset("static_image/1.jpg")}}" alt="1">
        <div style="background-color: #00000086" class="position-absolute top-0 left-0 w-100 h-auto bottom-0 right-0">
            <div style="margin-top:10%;">
                <h1 class="text-light text-center">Faqs</h1>
                <p class="lead text-center text-light">Your general question and answer</p>
            </div>
        </div>
    </div>
@endsection