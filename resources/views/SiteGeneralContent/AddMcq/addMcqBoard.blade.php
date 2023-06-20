@extends('layouts.master')
@section('title', "add mcq")
@section('content')
<div class="container">
    <h3 class="p-3 bg-light mb-3 mt-1">Create a MCQ</h3>
    <div class="row">
        <div class="col-md-5 mb-3">
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
            <a href="{{ route('addBoardMcqView', ['statusReset'=> 1 ]) }}"><button class="btn btn-outline-secondary my-2">Reset form</button></a>
            <a href="{{ route('addBoardMcqView', ['statusReset'=> 0 ]) }}"><button class="btn btn-transparent my-2">Restore</button></a>
           <form method="POST" action="{{route('getMcq')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>বিভাগ</span>
                        @if(isset($currentData[0]))
                            <select name="departmentName" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData[0]->departmentName}}" selected> {{$currentData[0]->departmentName}} </option>
                            </select>
                        @else
                            <select name="departmentName" class="form-select pushDepartMentId" aria-label="Default select example">

                            </select>
                        @endif
                    </div>
                    <div class="col-6">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাবজেক্ট নাম</span>
                        @if(isset($currentData[0]))
                            <select name="subjectName" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData[0]->subjectName}}" selected> {{$currentData[0]->subjectName}} </option>
                            </select>
                        @else
                            <select name="subjectName" class="form-select pushSubjectNameId" aria-label="Default select example">
                            </select>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>চেপ্টার নাম</span>
                        @if(isset($currentData) && sizeof($currentData)>0)
                        <select name="chapterName" class="form-select" aria-label="Default select example">
                            <option value="{{$currentData[0]->chapterName}}" selected> {{$currentData[0]->chapterName}} </option>
                        </select>
                        @else
                        <select name="chapterName" class="form-select pushChapterNameId" aria-label="Default select example">

                        </select>
                        @endif
                    </div>
                    <div class="col-md-6">

                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্ন ক্যাটাগরি</span>
                        @if(isset($currentData[0]))
                            <select name="questionCat" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData[0]->questionCat}}" selected> {{$currentData[0]->questionCat}} </option>
                            </select>
                        @else
                            <select  name="questionCat" class="form-select pushQuesCatId" aria-label="Default select example">
    
                            </select>
                        @endif

                    </div>
                    <div class="col-md-6">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>বোর্ড / স্কুল</span>
                        @if(isset($currentData) && sizeof($currentData)>0)
                        <select name="boardOrSchoolName" class="form-select" aria-label="Default select example">
                            <option value="{{$currentData[0]->boardOrSchoolName}}" selected> {{$currentData[0]->boardOrSchoolName}} </option>
                        </select>
                        @else
                        <select name="boardOrSchoolName" class="form-select pushBoardOrSchoolId" aria-label="Default select example">

                        </select>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্নের ধরণ</span>
                        @if(isset($currentData) && sizeof($currentData)>0)
                            <select name="question_type" class="form-select" aria-label="Default select example">
                                @if ($currentData[0]->question_type == 1)
                                <option value="1" selected>সাধারণ</option>
                                @endif
                                @if ($currentData[0]->question_type ==2)
                                <option value="2" selected>বহুপদী</option>
                                @endif
                            </select>
                        @else
                            <select class="form-select" name="question_type" id="">
                                <option value="0">select one</option>
                                <option value="1">সাধারণ</option>
                                <option value="2">বহুপদী</option>
                            </select>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাল</span>
                        @if(isset($currentData)  && sizeof($currentData)>0)
                        <select name="year" class="form-select" aria-label="Default select example">
                            <option value="{{$currentData[0]->year}}" selected> {{$currentData[0]->year}} </option>
                        </select>
                        @else
                        <select  name="year" class="form-select pushYearId" aria-label="Default select example">

                        </select>
                        @endif
                    </div>
                </div>
                {{-- here start question information --}}
                <div>
                    <input name="id" type="hidden" value="0">
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
                    <span class=" mt-2 d-block">ব্যাখা লিখ (অপশনাল)</span>
                    <textarea name="explain_mcq" id="editor"></textarea>
                    <span class=" mt-2 d-block">সিমিলার প্রশ্ন লেখ (অপশনাল)</span>
                    <textarea name="similarAnswer" id="editorSimilar"></textarea>
                    <button type="submit" class="btn btn-danger mt-3 w-100">Add Question</button>
                </div>
            </form> 
        </div>
        <div class="col-md-7">
            <div class="bg-light py-2 px-1">
                <form action="{{route('findMcqByOptions')}}" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-3 mt-2">
                            @if(isset($currentData)  && sizeof($currentData)>0)
                            <select name="departmentName" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData[0]->departmentName}}" selected> {{$currentData[0]->departmentName}} </option>
                            </select>
                            @else
                                <select name="departmentName" class="form-select pushDepartMentId" aria-label="Default select example">

                                </select>
                            @endif
                        </div>
                        <div class="col-3 mt-2">
                            @if(isset($currentData) && sizeof($currentData)>0)
                                <select name="subjectName" class="form-select" aria-label="Default select example">
                                    <option value="{{$currentData[0]->subjectName}}" selected> {{$currentData[0]->subjectName}} </option>
                                </select>
                            @else
                                <select name="subjectName" class="form-select pushSubjectNameId" aria-label="Default select example">
                                </select>
                            @endif
                        </div>
                        <div class="col-3 mt-2">
                            @if(isset($currentData) && sizeof($currentData)>0)
                            <select name="chapterName" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData[0]->chapterName}}" selected> {{$currentData[0]->chapterName}} </option>
                            </select>
                            @else
                            <select name="chapterName" class="form-select pushChapterNameId" aria-label="Default select example">
    
                            </select>
                            @endif
                        </div>
                        <div class="col-3 mt-2">
                            @if(isset($currentData) && sizeof($currentData)>0)
                                <select name="questionCat" class="form-select" aria-label="Default select example">
                                    <option value="{{$currentData[0]->questionCat}}" selected> {{$currentData[0]->questionCat}} </option>
                                </select>
                            @else
                                <select name="questionCat" class="form-select pushQuesCatId" aria-label="Default select example">
        
                                </select>
                            @endif
                        </div>
                        <div class="col-3 mt-2">
                            @if(isset($currentData) && sizeof($currentData)>0)
                            <select name="boardOrSchoolName" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData[0]->boardOrSchoolName}}" selected> {{$currentData[0]->boardOrSchoolName}} </option>
                            </select>
                            @else
                            <select  name="boardOrSchoolName" class="form-select pushBoardOrSchoolId" aria-label="Default select example">
    
                            </select>
                            @endif
                        </div>
                        <div class="col-3 mt-2">
                            @if(isset($currentData) && sizeof($currentData)>0)
                            <select name="year" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData[0]->year}}" selected> {{$currentData[0]->year}} </option>
                            </select>
                            @else
                            <select name="year" class="form-select pushYearId" aria-label="Default select example">
    
                            </select>
                            @endif
                        </div>
                        <div class="col-sm-3 mt-2">
                            <button type="submit" class="btn btn-primary w-100">Find data</button>
                        </div>
                        <div class="col-sm-3 mt-2">
                            <a href="{{ route('addBoardMcqView', ['statusReset'=> 1 ]) }}">Reset form</a>
                        </div>
                    </div>
                </form>
                <form method="GET" action="{{route('serachMcq')}}">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-9">
                            <input value="@if (isset($searchText)) {{ $searchText }} @endif" placeholder="Search by question name..." name="searchValue" type="search" class="form-control">
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-secondary w-100">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            @if (isset($searchText))
                <p class="lead bg-dark text-light py-3 px-1">search result `{{$searchText}}` for - @if (isset($currentData))
                    {{sizeof($currentData)}} 
                @endif</p>
            @else
                <p class="lead bg-dark text-light py-3 px-1">All data show from - @if (isset($currentData))
                    {{sizeof($currentData)}} 
                @endif</p>
            @endif
            {{-- each mcq show --}}
            @if($currentData && sizeof($currentData)>0)
                <div style="background-image: linear-gradient(to bottom right, #dfdfdf, #b7b7b7); box-shadow: 0px 0px 32px #00000012;" class="px-1 py-3" style="width: 100%;">
                        @foreach ($currentData as $mcq)
                        <div>
                            <div class="card-body">
                            @if($mcq->photo_url)
                                <img src="{{$mcq->photo_url}}" alt="" class="w-100">
                            @endif
                            @if($mcq->uddipak)
                                <p >{{$mcq->uddipak}}</p>
                            @endif
                            @if($mcq->question)
                                <p class="">{{ $loop->index + 1 }}. <?php echo '<span>'.$mcq->question.'</span>'; ?></p>
                            @endif
                            <div class="row">
                                @if ($mcq->question_type == 1 && sizeof(json_decode($mcq->answer))==1)
                                    <div class="col-6 d-flex">
                                        @if($mcq->option1)
                                            <p class="d-flex align-items-center"><span class='me-1 @if (json_decode($mcq->answer)[0] == 1) mcq_circle @else mcq_circle mcq_circle_border @endif' style="">a</span> <?php echo '<span>'.$mcq->option1.'</span>' ?></p>
                                        @endif
                                    </div>
                                    <div class="col-6 d-flex">
                                        @if($mcq->option2)
                                        <p class="d-flex align-items-center"><span class='me-1 @if (json_decode($mcq->answer)[0] == 2) mcq_circle @else mcq_circle mcq_circle_border @endif' style="">b</span> <?php echo '<span>'.$mcq->option2.'</span>' ?></p>
                                        @endif
                                    </div>
                                    <div class="col-6 d-flex">
                                        @if($mcq->option3)
                                        <p class="d-flex align-items-center"><span class='me-1 @if (json_decode($mcq->answer)[0] == 3) mcq_circle @else mcq_circle mcq_circle_border @endif' style="">c</span> <?php echo '<span>'.$mcq->option3.'</span>' ?></p>
                                        @endif
                                    </div>
                                    <div class="col-6 d-flex">
                                        @if($mcq->option4)
                                        <p class="d-flex align-items-center"><span class='me-1 @if (json_decode($mcq->answer)[0] == 4) mcq_circle @else mcq_circle mcq_circle_border @endif' style="">d</span> <?php echo '<span>'.$mcq->option4.'</span>' ?></p>
                                        @endif
                                    </div>
                                @else
                                    <div class="col-6 d-flex">
                                        @if($mcq->option1)
                                            <p >i. <?php echo '<span>'.$mcq->option1.'</span>' ?></p>
                                        @endif
                                    </div>
                                    <div class="col-6 d-flex">
                                        @if($mcq->option2)
                                            <p >ii. <?php echo '<span>'.$mcq->option2.'</span>' ?></p>
                                        @endif
                                    </div>
                                    <div class="col-6 d-flex">
                                        @if($mcq->option3)
                                            <p >iii. <?php echo '<span>'.$mcq->option3.'</span>' ?></p>
                                        @endif
                                    </div>
                                    <p class="text-secondary">Answer : 
                                        @foreach (json_decode($mcq->answer) as $ans)
                                            @if($loop->index == (sizeof(json_decode($mcq->answer))-1))
                                                <span class="my-1">
                                                    @if ($ans == 1)
                                                        i
                                                    @endif
                                                    @if ($ans == 2)
                                                        ii
                                                    @endif
                                                    @if ($ans == 3)
                                                        iii
                                                    @endif
                                                </span>
                                            @else
                                                <span class="my-1">
                                                    @if ($ans == 1)
                                                        i
                                                    @endif
                                                    @if ($ans == 2)
                                                        ii
                                                    @endif
                                                    @if ($ans == 3)
                                                        iii
                                                    @endif
                                                </span>,
                                            @endif
                                        @endforeach
                                    </p>
                                @endif
                            </div>
                            <div class="py-2 px-1 d-flex justify-content-end">
                                <form method="POST" action="{{route('deleteMcq')}}">
                                    @csrf
                                    <input name="id" type="hidden" value="{{$mcq->id}}">
                                    <button title="click to delete" type="submit" class="btn btn-transparent"><span class="badge text-bg-danger">Delete it</span></button>
                                </form>
                                <form method="POST" action="{{route('changeMcqStatus')}}">
                                    @csrf
                                    <input name="id" type="hidden" value="{{$mcq->id}}">
                                    <input name="status_val" type="hidden" value="{{$mcq->status}}">
                                    @if($mcq->status == 1)
                                        <button title="click to make deactive" type="submit" class="btn btn-transparent"><span class="badge text-bg-success">it's active</span></button>
                                    @else
                                        <button title="click to make active" type="submit" class="btn btn-transparent"><span class="badge text-bg-secondary">it's deactive</span></button>
                                    @endif
                                </form>

                                <a href="{{ route('singleMcqView', ['id'=>$mcq->id,'mcqNo'=>($loop->index + 1)]) }}" class="active nav-link me-2"><button title="click to make active" type="submit" class="btn btn-transparent"><span class="badge text-bg-info">View</span></button></a>
                                <a href="{{ route('McqUpdate', ['id'=>$mcq->id,'mcqNo'=>($loop->index + 1)]) }}" class="active nav-link me-2"><button title="click to make active" type="submit" class="btn btn-transparent"><span class="badge text-bg-primary">Edit</span></button></a>
                            </div>
                            <small class="text-muted text-end d-block"><i> - Added by : {{$mcq->uploaded_by}} </i></small>
                            </div>
                        </div> 
                    @endforeach
                </div>
            @else
             <h3 class ="text-center mt-4 text-center"> No mcq found !</h3>
            @endif
        </div>
    </div>
</div>
@endsection