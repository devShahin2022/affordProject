@extends('layouts.master')
@section('title',"add cq")
@section('content')
    <div class="container">
        <h1 class="bg-light p-2 mt-1 mb-3">Add a cq</h1>
        <div class="row">
            <div class="col-md-6">
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
                <a href="{{ route('getCq', ['statusReset'=> 1 ]) }}"><button class="btn btn-danger my-2">Reset form</button></a>
                <form action="{{route('storeCq')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>বিভাগ</span>
                        @if(isset($currentData))
                            <select name="departmentName" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData->departmentName}}" selected> {{$currentData->departmentName}} </option>
                            </select>
                        @else
                            <select id="pushDepartMentId" name="departmentName" class="form-select" aria-label="Default select example">

                            </select>
                        @endif
                        </div>
                        <div class="col-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাবজেক্ট নাম</span>
                            @if(isset($currentData))
                                <select name="subjectName" class="form-select" aria-label="Default select example">
                                    <option value="{{$currentData->subjectName}}" selected> {{$currentData->subjectName}} </option>
                                </select>
                            @else
                                <select id="pushSubjectNameId" name="subjectName" class="form-select" aria-label="Default select example">
                                </select>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>চেপ্টার নাম</span>
                            @if(isset($currentData))
                            <select name="chapterName" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData->chapterName}}" selected> {{$currentData->chapterName}} </option>
                            </select>
                            @else
                            <select id="pushChapterNameId" name="chapterName" class="form-select" aria-label="Default select example">
    
                            </select>
                            @endif
                        </div>
                        <div class="col-md-6">

                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্ন ক্যাটাগরি</span>
                            @if(isset($currentData))
                                <select name="questionCat" class="form-select" aria-label="Default select example">
                                    <option value="{{$currentData->questionCat}}" selected> {{$currentData->questionCat}} </option>
                                </select>
                            @else
                                <select id="pushQuesCatId" name="questionCat" class="form-select" aria-label="Default select example">
        
                                </select>
                            @endif
 
                        </div>
                        <div class="col-md-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>বোর্ড / স্কুল</span>
                            @if(isset($currentData))
                            <select name="boardOrSchoolName" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData->boardOrSchoolName}}" selected> {{$currentData->boardOrSchoolName}} </option>
                            </select>
                            @else
                            <select id="pushBoardOrSchoolId" name="boardOrSchoolName" class="form-select" aria-label="Default select example">
    
                            </select>
                            @endif

                        </div>
                        <div class="col-md-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাল</span>
                            @if(isset($currentData))
                            <select name="year" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData->year}}" selected> {{$currentData->year}} </option>
                            </select>
                            @else
                            <select id="pushYearId" name="year" class="form-select" aria-label="Default select example">
    
                            </select>
                            @endif
                        </div>
                    </div>
                    {{-- here start question information --}}
                    <div class="row">
                        <div class="col-12">
                            <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>যদি উদ্দীপকে ফটো থাকে...</span>
                            <input type="file" name="uddipakPhoto" class="form-control w-100">
                        </div>
                        <div class="col-12">
                            <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>যদি উদ্দীপকে লেখা থাকে...</span>
                            <textarea name="uddipakText" id="" class="w-100 form-control" rows="2"></textarea>
                        </div>
                        <p class="lead bg-dark p-2 mb-1 my-1 text-light">প্রশ্ন গুলো লিখ...</p>
                        <div class="col-6">
                            <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>ক নং প্রশ্ন-</span>
                            <textarea name="question1" id="" class="w-100 form-control" rows="2"></textarea>
                        </div>
                        <div class="col-6">
                            <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>খ নং প্রশ্ন-</span>
                            <textarea name="question2" id="" class="w-100 form-control" rows="2"></textarea>
                        </div>
                        <div class="col-12">
                            <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>গ নং প্রশ্ন-</span>
                            <textarea name="question3" id="" class="w-100 form-control" rows="2"></textarea>
                        </div>
                        <div class="col-12">
                            <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1"></span>ঘ নং প্রশ্ন-</span>
                            <textarea name="question4" id="" class="w-100 form-control" rows="2"></textarea>
                        </div>
                        <p class="lead bg-dark p-2 mb-1 my-1 text-light">উত্তর লিখ ( পরবর্তীতে লেখা যাবে )...</p>
                        <div class="col-12 mt-2">
                            <div class="border border-muted rounded p-2">
                                <span class="mt-5 mt-2">যদি ফটো থাকে...</span>
                                <input type="file" name="answerPhoto1" class="form-control w-100">
                                <span class="mt-5 mt-2">ক নং উত্তর-</span>
                                <textarea name="answerQuestion1" id="" class="w-100 form-control" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="border border-muted rounded p-2">
                                <span class="mt-5 mt-2">যদি ফটো থাকে...</span>
                                <input type="file" name="answerPhoto2" class="form-control w-100">
                                <span class="mt-5 mt-2">খ নং উত্তর-</span>
                                <textarea name="answerQuestion2" id="editorSimilar"></textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="border border-muted rounded p-2">
                                <span class="mt-5 mt-2">যদি ফটো থাকে...</span>
                                <input type="file" name="answerPhoto3" class="form-control w-100">
                                <span class="mt-5 mt-2">গ নং উত্তর-</span>
                                <textarea name="answerQuestion3" id="editor"></textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="border border-muted rounded p-2">
                                <span class="mt-5 mt-2">যদি ফটো থাকে...</span>
                                <input type="file" name="answerPhoto4" class="form-control w-100">
                                <span class="mt-5 mt-2">ঘ নং উত্তর-</span>
                                <textarea name="answerQuestion4" id="" class="w-100 form-control" rows="4"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 my-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection