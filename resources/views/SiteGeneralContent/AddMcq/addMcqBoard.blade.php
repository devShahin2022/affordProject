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
           <form method="POST" action="{{route('getMcq')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6 mt-2">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাবজেক্ট নাম</span>
                
                        <select name='subjectName' class="form-select" aria-label="Default select example">
                            <option value='0'>Select type </option>
                            @if(isset($mcqs[0]))
                                <option onclick="onClickSubject(1)"  @if($mcqs[0]->subject_name == 'পদার্থ') selected @endif value='পদার্থ' >পদার্থ</option>
                                <option onclick="onClickSubject(2)"  @if($mcqs[0]->subject_name == 'রসায়ন') selected @endif value='রসায়ন' >রসায়ন</option>
                                <option onclick="onClickSubject(3)"  @if($mcqs[0]->subject_name == 'সাধারণ গনিত') selected @endif value='সাধারণ গনিত' >সাধারণ গনিত</option>
                            @else
                                <option  onclick="onClickSubject(1)" value='পদার্থ' >পদার্থ</option>
                                <option onclick="onClickSubject(2)"  value='রসায়ন' >রসায়ন</option>
                                <option onclick="onClickSubject(3)"  value='সাধারণ গনিত' >সাধারণ গনিত</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-6 mt-2">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্ন ক্যাটাগরি</span>
                        <select name='question_cat' class="form-select" aria-label="Default select example">
                            <option value='0' >Select type </option>
                            @if (isset($mcqs[0]))
                                <option @if($mcqs[0]->question_cat == 1) selected @endif value='1' >বোর্ড প্রশ্ন</option>
                                <option @if($mcqs[0]->question_cat == 2) selected @endif value='2' >স্বনামধন্য স্কুল</option>
                                <option @if($mcqs[0]->question_cat == 3) selected @endif value='3' >বাই অ্যাফোরড</option> 
                            @else
                                <option value='1' >বোর্ড প্রশ্ন</option>
                                <option value='2' >স্বনামধন্য স্কুল</option>
                                <option value='3' >বাই অ্যাফোরড</option> 
                            @endif
                        </select>
                    </div>
                    <div class="col-6 mt-2">
                        <span class=" "><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাল</span>
                        <select name='year' class="form-select" aria-label="Default select example">
                            <option value='0'>Select year</option>
                            @if (isset($mcqs[0]))
                                @for ($i=2015; $i<=2023; $i++)
                                    <option @if($mcqs[0]->year == $i) selected @endif value='{{$i}}'>
                                        {{$i}}
                                    </option>
                                @endfor
                            @else
                                @for ($i=2015; $i<=2023; $i++)
                                <option value='{{$i}}'>
                                    {{$i}}
                                </option>
                                @endfor
                            @endif
                        </select>
                    </div>
                    <div class="col-6 mt-2">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্নের ধরন</span>
                        <select name='question_type' class="form-select" aria-label="Default select example">
                            <option value='0' >Select one</option>
                            @if(isset($mcqs[0]))
                                <option @if($mcqs[0]->question_type == 1) selected @endif value='1' >বহুপদী</option>
                                <option @if($mcqs[0]->question_type == 2) selected @endif value='2' >সাধারণ</option>
                            @else
                                <option value='1' >বহুপদী</option>
                                <option value='2' >সাধারণ</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-6 mt-2">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>বোর্ড সিলেক্ট</span>
                        <select name='board' class="form-select" aria-label="Default select example">
                            <option value='0'>Select board</option>
                            @if(isset($mcqs[0]))
                                @for ($i=1; $i<=10; $i++)
                                    <option @if($mcqs[0]->Board_name!=0 && $mcqs[0]->Board_name!=NULL &&  explode("-", $mcqs[0]->Board_name)[1] == $i) selected @endif value='board-{{$i}}'>
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
                            @else
                            @for ($i=1; $i<=10; $i++)
                            <option value='board-{{$i}}'>
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
                            @endif
                        </select>
                    </div>
                    {{-- new add --}}

                    <div class="col-6 mt-2">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সিলেক্ট  চেপ্টার</span>
                        <select id="pushChapterId" name='chapterName' class="form-select" aria-label="Default select example">
                            @if (isset($mcqs[0]))
                                <option value='{{$mcqs[0]->chapter_name}}'>{{$mcqs[0]->chapter_name}} Selected current</option>
                            @else
                                <option value='0'>First choose subject</option>
                            @endif
                        </select>
                    </div>

                    {{-- end --}}
                </div>
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
            <div class="bg-light py-2 px-1">
                <form method="GET" action="{{route('findMcqByOptions')}}">
                    @csrf
                    <div class="row">
                        <div class="col-3 mt-2">
                            <select name='subjectName' class="form-select" aria-label="Default select example">
                                <option value='0'>Select type </option>
                                @if (isset($mcqs[0]))
                                    <option @if($mcqs[0]->subject_name == 'পদার্থ') selected @endif value='পদার্থ' >পদার্থ</option>
                                    <option @if($mcqs[0]->subject_name == 'রসায়ন') selected @endif value='রসায়ন' >রসায়ন</option>
                                    <option @if($mcqs[0]->subject_name == 'সাধারণ গনিত') selected @endif value='সাধারণ গনিত' >সাধারণ গনিত</option>
                                @else
                                <option value='পদার্থ' >পদার্থ</option>
                                <option value='রসায়ন' >রসায়ন</option>
                                <option value='সাধারণ গনিত' >সাধারণ গনিত</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-3 mt-2">
                            <select name='question_cat' class="form-select" aria-label="Default select example">
                                <option value='0' >Select type </option>
                                @if (isset($mcqs[0]))
                                    <option @if($mcqs[0]->question_cat == 1) selected @endif value='1' >বোর্ড প্রশ্ন</option>
                                    <option @if($mcqs[0]->question_cat == 2) selected @endif value='2' >স্বনামধন্য স্কুল</option>
                                    <option @if($mcqs[0]->question_cat == 3) selected @endif value='3' >বাই অ্যাফোরড</option>
                                @else
                                    <option value='1' >বোর্ড প্রশ্ন</option>
                                    <option value='2' >স্বনামধন্য স্কুল</option>
                                    <option value='3' >বাই অ্যাফোরড</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-3 mt-2">
                            <select name='year' class="form-select" aria-label="Default select example">
                                <option value='0'>Select year</option>
                                @if (isset($mcqs[0]))
                                    @for ($i=2015; $i<=2023; $i++)
                                    <option @if($mcqs[0]->year == $i) selected @endif value='{{$i}}'>
                                        {{$i}}
                                    </option>
                                    @endfor
                                @else
                                    @for ($i=2015; $i<=2023; $i++)
                                    <option value='{{$i}}'>
                                        {{$i}}
                                    </option>
                                    @endfor
                                @endif
                            </select>
                        </div>
                        <div class="col-3 mt-2">
                            <select name='board' class="form-select" aria-label="Default select example">
                                <option value='0'>Select board</option>
                                @if (isset($mcqs[0]))
                                    @for ($i=1; $i<=10; $i++)
                                        <option @if($mcqs[0]->Board_name!=0 && $mcqs[0]->Board_name!=NULL &&  explode("-", $mcqs[0]->Board_name)[1] == $i) selected @endif value='board-{{$i}}'>
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
                                @else
                                    @for ($i=1; $i<=10; $i++)
                                    <option value='board-{{$i}}'>
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
                                @endif
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 my-2">Find data</button>
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
            <p class="lead bg-dark text-light py-3 px-1">All data show from - @if (isset($mcqs) && isset($size))
                {{sizeof($mcqs)}} of {{$size}}
            @endif</p>
            {{-- each mcq show --}}
            @if($mcqs && sizeof($mcqs)>0)
                <div style="background-image: linear-gradient(to bottom right, #dfdfdf, #b7b7b7); box-shadow: 0px 0px 32px #00000012;" class="px-1 py-3" style="width: 100%;">
                        @foreach ($mcqs as $mcq)
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
                                @if ($mcq->question_type == 2 && sizeof(json_decode($mcq->answer))==1)
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