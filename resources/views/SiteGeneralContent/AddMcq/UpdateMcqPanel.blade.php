@extends('layouts.master')
@section('title', "add mcq")
@section('content')
<div class="container">
    <h3 class="p-3 bg-light mb-3 mt-1">Update MCQ N0- ({{$mcqNo}})</h3>
    <div class="row">
        <div class="col-md-12 mb-3">
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
                    <div class="col-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>বিভাগ - {{$currentData->departmentName}}</span>
                            <select name="departmentName" class="form-select pushDepartMentId" aria-label="Default select example">

                            </select>
                    </div>
                    <div class="col-6">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাবজেক্ট নাম - {{$currentData->subjectName}}</span>
                            <select name="subjectName" class="form-select pushSubjectNameId" aria-label="Default select example">
                            </select>
                    </div>
                    <div class="col-md-6">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>চেপ্টার নাম - {{$currentData->chapterName}}</span>
                        <select name="chapterName" class="form-select pushChapterNameId" aria-label="Default select example">

                        </select>
                    </div>
                    <div class="col-md-6">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্ন ক্যাটাগরি - {{$currentData->questionCat}}</span>
                            <select  name="questionCat" class="form-select pushQuesCatId" aria-label="Default select example">
    
                            </select>
                    </div>
                    <div class="col-md-6">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>বোর্ড / স্কুল - {{$currentData->boardOrSchoolName}}</span>
                        <select name="boardOrSchoolName" class="form-select pushBoardOrSchoolId" aria-label="Default select example">

                        </select>
                    </div>
                    <div class="col-md-6">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্নের ধরণ - 
                        @if ($currentData->question_type == 1)

                        সাধারণ
                        @endif
                        @if ($currentData->question_type ==2)
                        বহুপদী
                        @endif</span>
                            <select class="form-select" name="question_type" id="">
                                <option value="0">select one</option>
                                <option value="1">সাধারণ</option>
                                <option value="2">বহুপদী</option>
                            </select>
                    </div>
                    <div class="col-md-6">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাল - {{$currentData->year}}</span>
                        <select  name="year" class="form-select pushYearId" aria-label="Default select example">

                        </select>
                    </div>
                </div>
                <div>
                    <div class="col-md-6">
                        @if ($currentData->photo_url !=NULL || $currentData->photo_url !=0)
                        <div class="card w-50">
                            <img class="w-100" src="@isset($currentData->photo_url){{$currentData->photo_url}}@endisset" alt="">
                        </div>
                    </div>
                    <span class="mt-2 d-block">উদ্দীপকে / প্রশ্নে  ফটো পরিবর্তন...</span>
                    @endif
                    <input name="id" type="hidden" value="{{$currentData->id}}">
                    <input value="@isset($currentData->photo_url) {{$currentData->photo_url}} @endisset" type="file" name="file" class="form-control mt-2">
                    <span class="mt-2 d-block">যদি উদ্দীপকে লেখা থাকে তাহলে এখানে লেখ</span>
                    <textarea class="w-100" name="uddipak" id="" rows="4"> @isset($currentData->uddipak) {{$currentData->uddipak}} @endisset </textarea>
                    <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্নটি লেখ</span>
                    <textarea class="w-100" name="question" id="" rows="4"> @isset($currentData->question) {{$currentData->question}} @endisset</textarea>
                    <span class=" mt-2 d-block"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>অপশন লেখ এবং সঠিক উত্তরটি চিন্নিহিত কর।</span>
                    <div class="row">
                        @for ($i=1; $i<=4; $i++)
                            <?php $tmpData = ''; ?>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label style="cursor: pointer; height:34px;" for="flexCheckDefault{{$i}}" class="bg-light ps-0 user-select-none d-flex p-1 mb-1" id="basic-addon">
                                        <input style="width: 30px;" name="answer[]" class="form-check-input me-1" type="checkbox" value="{{$i}}" id="flexCheckDefault{{$i}}" 
                                        
                                        @if (sizeof(json_decode($currentData->answer))==1)
                                            @if(json_decode($currentData->answer)[0] == $i) checked  @endif 
                                        @else
                                            @for ($j=0; $j<sizeof(json_decode($currentData->answer)); $j++)
                                                @if(json_decode($currentData->answer)[$j] == $i) checked @endif                                               
                                            @endfor   
                                        @endif
                                        >
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
                                    @isset($currentData)
                                        @if ($i==1)
                                        <?php $tmpData= $currentData->option1; echo   "<span class='ms-1 m-0 p-0 bg-secondary text-light bordered rounded w-100 d-block'>".$currentData->option1."</span>"; ?>
                                        @endif
                                        @if ($i==2)
                                        <?php $tmpData= $currentData->option2; echo   "<span class='ms-1 m-0 p-0 bg-secondary text-light bordered rounded w-100 d-block'>".$currentData->option2."</span>"; ?>
                                        @endif
                                        @if ($i==3)
                                        <?php $tmpData= $currentData->option3; echo   "<span class='ms-1 m-0 p-0 bg-secondary text-light bordered rounded  w-100 d-block'>".$currentData->option3."</span>"; ?>
                                        @endif
                                        @if ($i==4)
                                        <?php $tmpData= $currentData->option4; echo   "<span class='ms-1 m-0 p-0 bg-secondary text-light bordered rounded  w-100 d-block'>".$currentData->option4."</span>"; ?>
                                        @endif
                                    @endisset
                                    </label>
                                    <textarea class="w-100 form-control" name="option_{{$i}}" id="" rows="1">{{ $tmpData }}</textarea>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <span class=" mt-2 d-block">ব্যাখা লিখ (অপশনাল)</span>
                    <textarea name="explain_mcq" id="editor">@isset($currentData->explain) {{$currentData->explain}} @endisset</textarea>
                    <span class=" mt-2 d-block">সিমিলার প্রশ্ন লেখ (অপশনাল)</span>
                    <textarea name="similarAnswer" id="editorSimilar">@isset($currentData->similar_question) {{$currentData->similar_question}} @endisset</textarea>
                    <button type="submit" class="btn btn-danger mt-3 w-100">Update Question</button>
                </div>
            </form> 
        </div>
    </div>
</div>
@endsection