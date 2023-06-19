@extends('layouts.master')
@section('title',"add cq")
@section('content')
    <div class="container">
        <h1 class="bg-light p-2 mt-1 mb-3">Add a cq</h1>
        <div class="row">
            {{-- for uploading a cq information --}}
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
                <a href="{{ route('getCq', ['statusReset'=> 1 ]) }}"><button class="btn btn-outline-secondary my-2">Reset form</button></a>
                <a href="{{ route('getCq', ['statusReset'=> 0 ]) }}"><button class="btn btn-transparent my-2">Restore</button></a>
                <form action="{{route('storeCq')}}" method="POST" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-primary w-100 my-3">Submit cq</button>
                    </div>
                </form>
            </div>
            {{-- right section for find and search data ans show cq --}}
            <div class="col-md-6">
                <h2 class="bg-light my-1 mb-3 p-2">See your previous uploaded cq</h2>
                <form action="{{route('findCqData')}}" method="GET">
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
                            <a href="{{ route('getCq', ['statusReset'=> 1 ]) }}">Reset find</a>
                        </div>
                    </div>
                </form>
                {{-- search bar --}}
                <form action="{{route('findBuSearch')}}" method="GET">
                    @csrf
                    <div class="row mt-3" >
                        <div class="col-8 mt-2">
                            <input name="search" max="255" type="text" placeholder="Search by text..." class="form-control w-100">
                        </div>
                        <div class="col-sm-4 mt-2">
                            <button class="btn btn-info w-100">search</button>
                        </div>
                    </div>
                </form>
                @if(isset($currentData) && sizeof($currentData)>0 && !isset($searchText))
                <p class="lead bg-light p-2 mb-2"> total- {{sizeof($currentData)}}</p>
                @endif
                @if (isset($searchText))
                <p class="lead bg-light p-2 mb-2">searched result for `{{$searchText}}` total- {{sizeof($currentData)}} found</p>
                @endif
                @if (isset($currentData) && sizeof($currentData)>0)
                    <div class="d-flex flex-wrap sticky-top bg-dark text-light">
                        @for ($i=0; $i<sizeof($currentData); $i++)
                        <a href="#question_{{$i+1}}" class="nav-link p-1 m-1 text-decoration-underline">Question-{{$i + 1}}</a>
                        @endfor
                    </div>
                @endif
                <hr>
                {{-- show current uploaded data --}}
                @if (isset($currentData) && sizeof($currentData)>0)
                    @foreach ($currentData as $eahCq)
                    <div id="question_{{$loop->index+1}}" class="border border-dark my-2 p-2 border-rounded">
                        <p> সৃজনশীল- {{ $loop->index + 1 }}</p>
                        @if (isset($eahCq->uddipakPhoto))
                            <img src="{{$eahCq->uddipakPhoto}}" class="w-100" alt="">
                        @endif
                        @if (isset($eahCq->uddipakText))
                         <p>   <?php echo '<span>'. $eahCq->uddipakText .'</span>'; ?> </p>
                        @endif
                        <p>(ক) <?php echo '<span>'. $eahCq->question1 .'</span>'; ?> </p>
                        <p>(খ) <?php echo '<span>'. $eahCq->question2 .'</span>'; ?> </p>
                        <p>(গ) <?php echo '<span>'. $eahCq->question3 .'</span>'; ?> </p>
                        @if ($eahCq->question4)
                        <p>(ঘ) <?php echo '<span>'. $eahCq->question4 .'</span>'; ?> </p>
                        @endif
                        @if (isset($eahCq->answerPhoto1) || isset($eahCq->answerPhoto2) ||  isset($eahCq->answerPhoto3) || isset($eahCq->answerPhoto4) || 
                        isset($eahCq->answerQuestion1) ||isset($eahCq->answerQuestion2) ||isset($eahCq->answerQuestion3) ||isset($eahCq->answerQuestion4)
                        )
                            <h4 class="bg-light p-2">উত্তর সমুহ</h4>
                            <p class="lead">(ক)</p>
                            @if (isset($eahCq->answerPhoto1))
                            <img src="{{$eahCq->answerPhoto1}}" class="w-100" alt="">
                            @endif
                            @if(isset($eahCq->answerQuestion1))
                            <p class=""><?php echo '<span>'. $eahCq->answerQuestion1 .'</span>' ?></p>
                            @endif
                            <p class="lead">(খ)</p>
                            @if (isset($eahCq->answerPhoto2))
                            <img src="{{$eahCq->answerPhoto2}}" class="w-100" alt="">
                            @endif
                            @if(isset($eahCq->answerQuestion2))
                            <p class=""><?php echo '<span>'. $eahCq->answerQuestion2 .'</span>' ?></p>
                            @endif
                            <p class="lead">(গ)</p>
                            @if (isset($eahCq->answerPhoto3))
                            <img src="{{$eahCq->answerPhoto3}}" class="w-100" alt="">
                            @endif
                            @if(isset($eahCq->answerQuestion3))
                            <p class=""><?php echo '<span>'. $eahCq->answerQuestion3 .'</span>' ?></p>
                            @endif
                            @if (isset($eahCq->answerQuestion4) || isset($eahCq->answerPhoto4))
                                <p class="lead">(ঘ)</p>
                                @if (isset($eahCq->answerPhoto4))
                                <img src="{{$eahCq->answerPhoto4}}" class="w-100" alt="">
                                @endif
                                @if(isset($eahCq->answerQuestion4))
                                <p class=""><?php echo '<span>'. $eahCq->answerQuestion4 .'</span>' ?></p>
                                @endif  
                            @endif
                        @endif
                        
                        {{-- action section --}}
                        <div>
                            <div class="py-2 px-1 d-flex justify-content-end flex-wrap">
                                <form method="POST" action="{{route('deleteCq')}}">
                                    @csrf
                                    <input name="id" type="hidden"  value="{{$eahCq->id}}">
                                    <button title="click to delete" type="submit" class="btn btn-transparent"><span class="badge text-bg-danger">Delete it</span></button>
                                </form>
                                <form method="POST" action="{{route('activeOrDeactive')}}">
                                    @csrf
                                    @if ($eahCq->status == 1)
                                    <button title="click to make deactive" type="submit" class="btn btn-transparent"><span class="badge text-bg-success">it's active</span></button>
                                    @else
                                    <button title="click to make active" type="submit" class="btn btn-transparent"><span class="badge text-bg-secondary">it's deactive</span></button>
                                    @endif
                                    <input name="id" type="hidden" value="{{$eahCq->id}}">
                                </form>
                                <a  href="{{ route('viewSingleCq', ['serial'=>($loop->index+1),"id"=>$eahCq->id]) }}" class="active nav-link me-2"><button title="click to make active" type="submit" class="btn btn-transparent"><span class="badge text-bg-info">View</span></button></a>
                                <a href="" class="active nav-link me-2"><button title="click to make active" type="submit" class="btn btn-transparent"><span class="badge text-bg-primary">Edit</span></button></a>
                            </div>
                            <small class="text-muted text-end d-block"><i> - Added by : {{$eahCq->addedBy}}</i></small>
                        </div>
                    </div>
                    @endforeach
                @else
                <h4>OOPS! কোন ডাটা পাওয়া যায়নি।</h4>
                @endif
            </div>
        </div>
    </div>
@endsection