<?php
use App\Models\User;
use Illuminate\Support\Facades\Auth;

$getUserData = User::where('id',Auth::user()->id)->first();
$userAccountType = $getUserData->account_type;
$userPhone = $getUserData->phone;


?>

@extends('layouts.master')
@section('title',"ভর্তি-এসএসসি-২০২৪")
@section('content')
    <div class="container">
        <h1 class="mt-4 mb-3">এসএসসি-২০২৪ ব্যাচ-১ এ ভর্তি হতে চাইলে, দ্রুত ফর্মটি পুরন করে ফেল</h1>
        <br>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    ভর্তি ফি কত?
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
            </div>
            </div>
            <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    কিভাবে ভর্তি হব? - (এক ঝলকে দেখে নাও)
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
            </div>
            </div>
            <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                ভর্তি কনফার্ম হয়েছে কিনা, কিভাবে বুঝবো?
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
            </div>
            </div>
        </div>
        @if ($userAccountType == "pending")
            <h3 class="text-info my-2">তোমার তথ্য গুলো জমা নেয়া হয়েছে । আমরা অতি দ্রুত তথ্য গুলো যাচাই করে তোমাকে জানিয়ে দেব। পাশে থাকার জন্য অনেক ধন্যবাদ ।</h3>
            <p class="lead">
                ভর্তি কনফার্ম হয়েছে কি না তা জানতে পারবে তোমার প্রোফাইল পেজ থেকে পাশাপাশি আমরা <span class="text-light bg-dark p-2">{{ $userPhone }}</span> নম্বরে জানিয়ে দেব ।
            </p>
        @endif
        @if ($userAccountType == 0)
        <form method="POST" action="{{route('storeAdmSSCExamBatch')}}" class="mt-5">
            @csrf
            <p class="lead">ভর্তি ফর্ম</p>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if(session('fail'))
                <div class="alert alert-danger">
                    {{ session('fail') }}
                </div>
            @endif
            <div class="row mt-4">
                <div class="col-sm-6">
                    <span class='mt-4 d-block'><span style="color:red;font-size:22px;" class="ms-1">*</span>তোমার নাম লিখ...</span>
                    <input value='{{old('name')}}' type="text" name="name" class="form-control mt-2">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <div class="col-sm-6">
                    <span class='mt-4 d-block'><span style="color:red;font-size:22px;" class="ms-1">*</span>কত টাকা পাঁঠিয়েছো...</span>
                    <input value='{{old('amtTaka')}}' type="text" name="amtTaka" class="form-control mt-2">
                    @if ($errors->has('amtTaka'))
                        <span class="text-danger">{{$errors->first('amtTaka')}}</span>
                    @endif
                </div>
                <div class="col-sm-6">
                    <span class='mt-4 d-block'><span style="color:red;font-size:22px;" class="ms-1">*</span>যে নম্বর থেকে টাকা পাঁঠিয়েছো তা লিখ...</span>
                    <input value='{{old('paymentNumber')}}' type="text" name="paymentNumber" class="form-control mt-2">
                    @if ($errors->has('paymentNumber'))
                        <span class="text-danger">{{$errors->first('paymentNumber')}}</span>
                    @endif
                </div>
                <div class="col-sm-6">
                    <span class='mt-4 d-block'><span style="color:red;font-size:22px;" class="ms-1">*</span>তোমার পেমেন্ট মেথডের নাম লেখ...</span>
                    <input value='{{old('paymentMethod')}}' type="text" name="paymentMethod" class="form-control mt-2">
                    @if ($errors->has('paymentMethod'))
                        <span class="text-danger">{{$errors->first('paymentMethod')}}</span>
                    @endif
                </div>
                <div class="col-sm-6">
                    <span class='mt-4 d-block'><span style="color:red;font-size:22px;" class="ms-1">*</span>TrxId টা হুবহু লিখে দাও...</span>
                    <input value='{{old('TnxId')}}' type="text" name="TnxId" class="form-control mt-2">
                    @if ($errors->has('TnxId'))
                        <span class="text-danger">{{$errors->first('TnxId')}}</span>
                    @endif
                </div>
                <div class="col-sm-6 mt-5">
                    <button type="submit" class="btn btn-dark w-100 text-center mt-2 mt-3">সাবমিট</button>
                </div>
            </div>
        </form>
        @endif
        @if ($userAccountType == 2)
        <h3 class="text-info my-2">অভিনন্দন!! তোমার ভর্তি প্রক্রিয়া সম্পূর্ণ হয়েছে এবং অ্যাকাউন্টটি প্রিমিয়াম হয়েছে। ইনজয় exciting ফিচার। পাশে থাকার জন্য অনেক ধন্যবাদ ।</h3>
        @endif
    </div>
@endsection