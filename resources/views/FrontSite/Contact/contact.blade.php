@extends('layouts.master')
@section('title','admin-messages')
@section('content')
    <div class="container">
        <h1 class="text-center mt-5">ফিল ফ্রি টু কন্টাক্ট আস</h1>
        <p class="text-center lead">আমাদের টিম খুবই বন্ধুত্ব পরায়ণ, তোমার সকল প্রশ্নের উত্তর তারা দিবে ।।</p>
        <p class="text-center lead mb-5">তোমার কোনো কিছু জানার থাকলে আমাদেরকে জানাতে পার, আমরা অক্লান্ত চেষ্টা করব ।।</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d7166.152215851381!2d88.5629735381906!3d26.096434156844197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m5!1s0x39e49690bddfdb8d%3A0xded71cbbbb255bc7!2z4Kak4KeB4Kaw4KeB4KaV4Kaq4Kal4Ka-IOCmrOCmvuCmnOCmvuCmsCwgNTEwMA!3m2!1d26.097888599999997!2d88.567233!4m3!3m2!1d26.0941099!2d88.5694894!5e0!3m2!1sbn!2sbd!4v1686592384193!5m2!1sbn!2sbd" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div style="" class="m-auto bg-light p-3 border-rounded">
            <p class="text-center lead">ঠাকুরগাঁও ...... ভুল্লি থানা ...... তুরুকপথা বাজার ...... (৫০০মিটার দক্ষিণে)লাউথুতি মাদ্রাসা</p>
            
            @if ($errors->any())
            <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <p class="text-success">{{session('success')}}</p>
            @endif
            @if (session('fail'))
                <p class="text-danger">{{session('fail')}}</p>
            @endif
            <form action="{{route('sendContact')}}" method="POST">
                @csrf
                <div class="row mt-2">
                    <div class="col-md-6 mt-3">
                        <input name="name" type="text" placeholder="তোমার নাম লিখ..." class="form-control">
                    </div>
                    <div class="col-md-6 mt-3">
                        <input name="schoolName" type="text" placeholder="তোমার স্কুলের নাম লিখ..." class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <input name="replyEmailOrPhone" type="text" class="form-control" placeholder="রিপ্লাই কোথায় নিতে চাও (ইমেইল/মোবাইল নং)...">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <textarea name="message" placeholder="আমাদেরকে লিখ..." class="w-100 form-control" name="" id="" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-dark">পাঠাও</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection