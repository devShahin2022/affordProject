@extends('layouts.master')
@section('title',"question/answer")
@section('content')
    <div class="container">
        <h1 class="text-center my-3">পূর্বের সকল প্রশ্ন এবং উত্তর</h1>
        <div class="row">
            @if (isset($data))
                @if (sizeof($data) > 0)
                    @foreach ($data as $d)
                        <div class="col-md-4">
                            <div class="bg-light p-2 my-3 border rounded">
                                <p class="lead mb-1"><strong class="text-info">Question {{$loop->index + 1}} : </strong>{{$d->question}}</p>
                                @if ($d->question_img !== null)
                                    <img src="{{$d->question_img}}" class="w-100 h-auto" alt="">
                                @endif
                                <hr class="w-50">
                                <p class="lead mb-1"><strong class="text-info">answer : </strong>{{$d->answer}}</p>
                                @if ($d->question_img !== null)
                                    <img src="{{$d->reply_img}}" class="w-100 h-auto" alt="">
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3 class="mt-5 text-center">দুঃখিত কোনো ডাটা পাওয়া যায়নি!</h3>
                @endif
            @endif
        </div>
    </div>
@endsection