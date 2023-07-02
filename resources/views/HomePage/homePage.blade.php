@extends('layouts.master')
@section('title',"Home page")
@section('content')
    <div class="w-100 h-auto position-relative">
        <img class="w-100 h-auto"src="{{asset("static_image/1.jpg")}}" alt="1">
        <div style="background-color: #00000086" class="position-absolute top-0 left-0 w-100 h-auto bottom-0 right-0">
            <div style="margin-top:10%;">
                <h1 class="text-light text-center">স্বাগতম! অ্যাফোর্ড প্রাইভেট সেন্টারে</h1>
                <p class="lead text-center text-light">চেষ্টা । ধৈর্য । সাফল্য</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mt-4 mb-5">কেন তুমি আমাদের এখানে পড়বে ?</h3>
                <div class="">
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">প্রত্যেক চেপ্টারের কোর কনসেপ্টগুলোকে ভালভাবে শেখানো হয়। পাশাপাশি রিলেভেন্ট টপিক্স গুলোকে (আউট অফ সিলেবাস) শেখানো হয় যা তোমাকে পরবর্তী লেভেলে সবার থেকে একধাপ এগিয়ে রাখবে। </span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">কলেজ লেভেলের বেসিক ধারণা সাথে ভার্সিটি স্ট্যান্ডার্ড অনুসারে পোড়ানো যা তোমার কনফিডেন্স বাড়িয়ে দিবে।</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">অবশ্যই বোর্ড প্রশ্ন মেইন টেইন করে পড়ানো হবে এবং প্রশ্ন এনালাইসিস, স্বনামধন্য স্কুলের প্রশ্ন সহজ ভাবে সমাধান করানো হয়।</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">টাইপ ভিত্তিক ম্যাথ সল্যুশন , অধ্যায়ের খুটিনাটি সব বিষয়ে বিস্তারিত আলোচনা, ১৫০+ ম্যাথ সল্যুশন প্রত্যেক চেপ্টার । যা তোমার কনসেপ্ট গুলোকে ১০০% ক্লিয়ার করে দিবে।</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">তুমি যতই দুর্বল হও না কেন , তোমার আগ্রহ থাকলে আমরা আমাদের সর্বোচ্চ দিয়ে চেষ্টা করব ।</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">পাশাপাশি আমাদের ওয়েবসাইটে অফুরন্ত পরীক্ষা দেওয়ার সুযোগ পাবে। যার বিনিময়ে তোমাকে কিছু পয়েন্টস দেওয়া হবে ,পয়েন্টস এর ভিত্তিতে মাস শেষে শীর্ষ ১০ জনকে আকর্ষণীয় পুরষ্কার দেওয়া হবে।</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">আমাদের মেন্টরসগণ ভার্সিটি স্টুডেন্ট সুতরাং তোমাদের পড়াশোনার কোয়ালিটির কোনো অভাব হবে না।</span>
                    </div> 
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">নিয়মিত পরীক্ষা ব্যবস্থা এবং পুরষ্কারের মাধ্যমে স্টুডেন্টসদের অনুপ্রাণিত করা।</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">প্রতিযোগিতা মুলক দুনিয়ায় একাডেমিক পড়াশোনার পাশাপাশি ভার্সিটির ভর্তি পরীক্ষায় ভালো কিছু করার জন্য তোমার বেসিক ১০০% ক্লিয়ার থাকতে হবে। যার ১০০% ই আমরা তোমাদেরকে দিব ।</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">গুরুত্বপূর্ণ নোটস ও সাজেসন সরবরাহ করা হবে</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">পিছিয়ে পরা স্টুডেন্টসদের জন্য থাকবে অতিরিক্ত ক্লাসের বাবস্থা</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">এছাড়াও আরো এক্সাইটিং বিষয়তো থাকছেই। </span>
                    </div> 
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{asset("static_image/undraw.png")}}" class="w-100 mt-5" alt="">
                <h3 class="text-primary">তুমি যদি তোমার বেসিক ক্লিয়ার করে ভার্সিটি ভর্তি যুদ্ধে একধাপ নিজেকে এগিয়ে রাখতে চাও তাহলে আজই আমাদের সাথে যুক্ত হও</h3>
                <ol>
                    <li>তুমি অনলাইনে ভর্তির আবেদন করতে পারবে।</li>
                    <li>সরাসরি আমাদের অফিসে এসে যোগাযোগ করতে পারবে।</li>
                </ol>
            </div>
            <div class="col-md-6">
                <img src="{{asset("static_image/undraw2.png")}}" class="w-100" alt="">
                <button class="btn btn-primary mt-3 mb-4 w-100">ইনরোল প্রিমিয়াম ফিচার (৩০০ ৳)</button>
            </div>
            <div class="col-md-6">
                <h3 class="mt-4 mb-5">৩০০ টাকার বিনিময়ে তুমি কি কি পাবে ( প্রিমিয়াম অ্যাকাউন্ট )</h3>
                <div class="">
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">আনলিমিটেড এক্সাম , পছন্দমত পরীক্ষা দেওয়ার সুব্যবস্থা ।</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">প্রত্যেক বোর্ড প্রশ্ন সমাধান । ব্যাখ্যা , বিশ্লেষণ , অনুরুপ প্রশ্ন সাজানো গুছানো উপায়ে শেখানো</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">কোনো প্রশ্নের উত্তর বুঝতে না পারলে অথবা কোনো টপিক্সে প্রবলেম হলে সরাসরি প্রশ্নের ব্যবস্থা</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">সকল প্রয়োজনীয় সুত্র </span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">প্রত্যেক অধ্যায়ের কাজ , অনুশীলনীর প্রশ্নের সমাধান সাথে ভিডিওর ব্যবস্থা ।</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">প্রত্যেক চেপ্টারের হ্যান্ড নোটস</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">অধ্যায়ের টাইপ ভিত্তিক ম্যাথ সল্যুশন । সাথে প্রচুর ম্যাথ সমাধানসহ</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">বিভিন্ন স্কুলের প্রশ্ন সমাধান</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">অ্যাফোর্ড এর পক্ষ থেকে মডেল টেস্ট</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">থাকবে কুইজ ও প্রচুর এক্সামের ব্যবস্থা । তোমার মেধাতালিকা দেওয়া হবে</span>
                    </div>
                    <div class="mt-2">
                        <img class="mb-1  me-1" style="width:20px; " src="{{asset("static_image/check.png")}}" alt="">
                        <span class="mt-3 d-block-inline lead">তুমি ইচ্ছেমত পরীক্ষা দিতে পারবে যার বিনিময়ে তোমাকে পয়েন্টস দেওয়া হবে । মাস শেষে যাদের পয়েন্টস বেশী হবে তাদেরকে পুরস্কৃত করা হবে।</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection