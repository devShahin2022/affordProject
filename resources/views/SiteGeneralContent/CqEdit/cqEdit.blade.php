@extends('layouts.master')
@section('title',"Update cq")
@section('content')
    <div class="container">
        <h1 class="bg-light p-2 mt-1 mb-3">Update your cq- {{$serial}}</h1>
        <div class="row">
            {{-- for uploading a cq information --}}
            <div class="col-md-12">
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
                    <p class="text-danger">{{session('fail')}}</p>
                @endif
                @if (session('success'))
                <p class="text-success">{{session('success')}}</p>
                @endif
                <form action="{{route('updateCq')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" value="{{$id}}" name="id">
                        <div class="col-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>বিভাগ - {{$currentData[0]->departmentName}}</span>
                            <select name="departmentName" class="form-select pushDepartMentId" aria-label="Default select example">

                            </select>
                        </div>
                        <div class="col-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাবজেক্ট নাম- {{$currentData[0]->subjectName}}</span>
                                <select name="subjectName" class="form-select pushSubjectNameId" aria-label="Default select example">
                                </select>
                        </div>
                        <div class="col-md-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>চেপ্টার নাম- {{$currentData[0]->chapterName}}</span>
                            <select name="chapterName" class="form-select pushChapterNameId" aria-label="Default select example">
    
                            </select>
                        </div>
                        <div class="col-md-6">

                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্ন ক্যাটাগরি- {{$currentData[0]->questionCat}}</span>
                                <select  name="questionCat" class="form-select pushQuesCatId" aria-label="Default select example">
        
                                </select>
                        </div>
                        <div class="col-md-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>বোর্ড / স্কুল-@if(isset($currentData[0]->boardOrSchoolName)) {{$currentData[0]->boardOrSchoolName}} @endif</span>
                            <select name="boardOrSchoolName" class="form-select pushBoardOrSchoolId" aria-label="Default select example">
    
                            </select>
                        </div>
                        <div class="col-md-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাল-@if(isset($currentData[0]->year)) {{$currentData[0]->year}} @endif</span>
                            <select  name="year" class="form-select pushYearId" aria-label="Default select example">
    
                            </select>
                        </div>
                    </div>
                    {{-- here start question information --}}
                    <div class="row">
                        <div class="col-md-6">
                            @if (isset($currentData[0]->uddipakPhoto))
                                <img src="{{$currentData[0]->uddipakPhoto}}" alt="" class="w-100 my-1" >
                            @endif
                        </div>
                        <div class="col-12">
                            <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>যদি উদ্দীপকে ফটো আপডেট করতে চাও...</span>
                            <input type="file" name="uddipakPhoto" class="form-control w-100">
                        </div>
                        <div class="col-12">
                            <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>যদি উদ্দীপকে লেখা থাকে...</span>
                            <textarea name="uddipakText" id="" class="w-100 form-control" rows="2">{{$currentData[0]->uddipakText}}</textarea>
                        </div>
                        <p class="lead bg-dark p-2 mb-1 my-1 text-light">প্রশ্ন গুলো লিখ...</p>
                        <div class="col-6">
                            <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>ক নং প্রশ্ন-</span>
                            <textarea name="question1" id="" class="w-100 form-control" rows="2">{{$currentData[0]->question1}}</textarea>
                        </div>
                        <div class="col-6">
                            <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>খ নং প্রশ্ন-</span>
                            <textarea name="question2" id="" class="w-100 form-control" rows="2">{{$currentData[0]->question2}}</textarea>
                        </div>
                        <div class="col-12">
                            <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>গ নং প্রশ্ন-</span>
                            <textarea name="question3" id="" class="w-100 form-control" rows="2">{{$currentData[0]->question3}}</textarea>
                        </div>
                        <div class="col-12">
                            <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1"></span>ঘ নং প্রশ্ন-</span>
                            <textarea name="question4" id="" class="w-100 form-control" rows="2"> @if(isset($currentData[0]->question4)) {{$currentData[0]->question4}} @endif</textarea>
                        </div>
                        <p class="lead bg-dark p-2 mb-1 my-1 text-light">(উত্তর আপডেট কর)...</p>
                        <div class="col-12 mt-2">
                            @if (isset($currentData[0]->answerPhoto1))
                                <div class="col-md-6">
                                    <img src="{{$currentData[0]->answerPhoto1}}" class="w-100" alt="">
                                </div>
                            @endif
                            <div class="border border-muted rounded p-2">
                                <span class="mt-5 mt-2">যদি ফটো থাকে...</span>
                                <input type="file" name="answerPhoto1" class="form-control w-100">
                                <span class="mt-5 mt-2">ক নং উত্তর-</span>
                                <textarea name="answerQuestion1" id="" class="w-100 form-control" rows="4">@if(isset($currentData[0]->answerQuestion1)) {{ $currentData[0]->answerQuestion1 }} @endif</textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            @if (isset($currentData[0]->answerPhoto2))
                            <div class="col-md-6">
                                <img src="{{$currentData[0]->answerPhoto2}}" class="w-100" alt="">
                            </div>
                            @endif
                            <div class="border border-muted rounded p-2">
                                <span class="mt-5 mt-2">যদি ফটো থাকে...</span>
                                <input type="file" name="answerPhoto2" class="form-control w-100">
                                <span class="mt-5 mt-2">খ নং উত্তর-</span>
                                <textarea name="answerQuestion2" id="editorSimilar">@if(isset($currentData[0]->answerQuestion2)) {{ $currentData[0]->answerQuestion2 }} @endif</textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            @if (isset($currentData[0]->answerPhoto3))
                            <div class="col-md-6">
                                <img src="{{$currentData[0]->answerPhoto3}}" class="w-100" alt="">
                            </div>
                            @endif
                            <div class="border border-muted rounded p-2">
                                <span class="mt-5 mt-2">যদি ফটো থাকে...</span>
                                <input type="file" name="answerPhoto3" class="form-control w-100">
                                <span class="mt-5 mt-2">গ নং উত্তর-</span>
                                <textarea name="answerQuestion3" id="editor">@if(isset($currentData[0]->answerQuestion3)) {{ $currentData[0]->answerQuestion3 }} @endif</textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            @if (isset($currentData[0]->answerPhoto4))
                            <div class="col-md-6">
                                <img src="{{$currentData[0]->answerPhoto4}}" class="w-100" alt="">
                            </div>
                            @endif
                            <div class="border border-muted rounded p-2">
                                <span class="mt-5 mt-2">যদি ফটো থাকে...</span>
                                <input type="file" name="answerPhoto4" class="form-control w-100">
                                <span class="mt-5 mt-2">ঘ নং উত্তর-</span>
                                <textarea name="answerQuestion4" id="" class="w-100 form-control" rows="4">@if(isset($currentData[0]->answerQuestion4)) {{ $currentData[0]->answerQuestion4 }} @endif</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 my-3">Update cq</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection