@extends('layouts.master')
@section('title', "add mcq")
@section('content')
<div class="container">
    <h3 class="p-3 bg-light mb-3 nt-1">Create board Mcq</h3>
    <div class="row">
        <div class="col-md-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('fail'))
                <p class="lead alert alert-danger ">{{ session('fail')}} </p>
            @endif
            @if (session('success'))
            <p class="lead alert alert-success ">{{ session('success')}} </p>
            @endif
           <form method="POST" action="{{route('getMcq')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6 mt-2">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্ন ক্যাটাগরি</span>
                        <select name='question_cat' class="form-select" aria-label="Default select example">
                            <option value='0' selected>Select type </option>
                            <option value='1' selected>বোর্ড প্রশ্ন</option>
                            <option value='2' selected>স্বনামধন্য স্কুল</option>
                            <option value='3' selected>বাই অ্যাফোরড</option>
                            <option value='0' selected>Select type </option>
                        </select>
                    </div>
                    <div class="col-6 mt-2">
                        <span class=" "><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাল</span>
                        <select name='year' class="form-select" aria-label="Default select example">
                            <option value='0' selected>Select year</option>
                            @for ($i=2015; $i<=2022; $i++)
                                <option value='{{$i}}' selected>
                                    {{$i}}
                                </option>
                            @endfor
                            <option value='0' selected>Select year</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mt-2">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্নের ধরন</span>
                        <select name='question_type' class="form-select" aria-label="Default select example">
                            <option value='0' selected>Select one</option>
                            <option value='1' selected>বহুপদী</option>
                            <option value='2' selected>সাধারণ</option>
                            <option value='0' selected>Select one</option>
                        </select>
                    </div>
                    <div class="col-6 mt-2">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>বোর্ড সিলেক্ট</span>
                        <select name='board' class="form-select" aria-label="Default select example">
                            <option value='0' selected>Select board</option>
                            @for ($i=1; $i<=10; $i++)
                                <option value='bord-{{$i}}' selected>
                                    @if ($i==1) dhaka board  @endif
                                    @if ($i==2) Rajshahi board  @endif
                                    @if ($i==3) Comila board  @endif
                                    @if ($i==4) Dinajpur board  @endif
                                    @if ($i==5) Barisal board  @endif
                                    @if ($i==6) Sylhet board  @endif
                                    @if ($i==7) Jessore board  @endif
                                    @if ($i==8) Chittagong board  @endif
                                    @if ($i==9)  Madrasah board @endif
                                    @if ($i==10) All board(2018)   @endif
                                </option>
                            @endfor
                            <option value='0' selected>Select board</option>
                        </select>
                    </div>
                </div>
                <div>
                    <span class="mt-2 d-block">যদি উদ্দীপকে / প্রশ্নে  ফটো থাকে তাহলে এখানে দাও।</span>
                    <input type="file" name="file" class="form-control">
                    <span class="mt-2 d-block">যদি উদ্দীপকে লেখা থাকে তাহলে এখানে লেখ</span>
                    <textarea class="w-100" name="uddipak" id="" rows="4"></textarea>
                    <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্নটি লেখ</span>
                    <textarea class="w-100" name="question" id="" rows="4"></textarea>
                    <span class=" mt-2 d-block"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>অপশন লেখ এবং সঠিক উত্তরটি চিন্নিহিত কর।</span>
                    <div class="row">
                        @for ($i=1; $i<=4; $i++)
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label style="cursor: pointer;" for="flexCheckDefault{{$i}}" class="input-group-text ps-0 user-select-none" id="basic-addon">
                                        <input name="answer[]" class="form-check-input me-1" type="checkbox" value="{{$i}}" id="flexCheckDefault{{$i}}">
                                    @if ($i==1)
                                        a/i
                                    @endif
                                    @if ($i==2)
                                        b/ii
                                    @endif
                                    @if ($i==3)
                                        c/iii
                                    @endif
                                    @if ($i==4)
                                        d
                                    @endif
                                    </label>
                                    <input name="option_{{$i}}" value="" type="text" class="form-control" placeholder="option-{{$i}}" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        @endfor
                    </div>
                    <span class=" mt-2 d-block">প্রশ্নের লিঙ্ক ID দাও (অপশনাল)</span>
                    <input name='questionLinkId' type="text d-block" class="form-control"> 
                    <span class=" mt-2 d-block">ব্যাখা লিখ (অপশনাল)</span>
                    <textarea name="explain_mcq" id="editor"></textarea>
                    <span class=" mt-2 d-block">সিমিলার প্রশ্ন লেখ (অপশনাল)</span>
                    <textarea name="similarAnswer" id="editorSimilar"></textarea>
                    <button type="submit" class="btn btn-danger mt-3 w-100">Add Question</button>
                </div>
            </form> 
        </div>
        <div class="col-md-7">

        </div>
    </div>
</div>
@endsection