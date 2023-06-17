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
                    <div class="col-6 mt-2">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাবজেক্ট নাম</span>
                       
                        <select name='subjectName' class="form-select" aria-label="Default select example">
                            <option value='0'>Select type </option>
                            @if(isset($mcq))
                                <option onclick="onClickSubject(1)"  @if($mcq->subject_name == 'পদার্থ') selected @endif value='পদার্থ' >পদার্থ</option>
                                <option onclick="onClickSubject(2)"  @if($mcq->subject_name == 'রসায়ন') selected @endif value='রসায়ন' >রসায়ন</option>
                                <option onclick="onClickSubject(3)"  @if($mcq->subject_name == 'সাধারণ গনিত') selected @endif value='সাধারণ গনিত' >সাধারণ গনিত</option>
                            @else
                                <option onclick="onClickSubject(1)"  value='পদার্থ' >পদার্থ</option>
                                <option  onclick="onClickSubject(2)" value='রসায়ন' >রসায়ন</option>
                                <option onclick="onClickSubject(3)"  value='সাধারণ গনিত' >সাধারণ গনিত</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-6 mt-2">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্ন ক্যাটাগরি</span>
                        <select name='question_cat' class="form-select" aria-label="Default select example">
                            <option value='0' >Select type </option>
                            @if (isset($mcq))
                                <option @if($mcq->question_cat == 1) selected @endif value='1' >বোর্ড প্রশ্ন</option>
                                <option @if($mcq->question_cat == 2) selected @endif value='2' >স্বনামধন্য স্কুল</option>
                                <option @if($mcq->question_cat == 3) selected @endif value='3' >বাই অ্যাফোরড</option> 
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
                            @if (isset($mcq))
                                @for ($i=2015; $i<=2023; $i++)
                                    <option @if($mcq->year == $i) selected @endif value='{{$i}}'>
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
                            @if(isset($mcq))
                                <option @if($mcq->question_type == 1) selected @endif value='1' >বহুপদী</option>
                                <option @if($mcq->question_type == 2) selected @endif value='2' >সাধারণ</option>
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
                            @if(isset($mcq))
                                @for ($i=1; $i<=10; $i++)
                                    <option @if($mcq->Board_name!=0 && $mcq->Board_name!=NULL &&  explode("-", $mcq->Board_name)[1] == $i) selected @endif value='board-{{$i}}'>
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
                            @if (isset($mcq))
                                <option value='{{$mcq->chapter_name}}'>{{$mcq->chapter_name}} Selected current</option>
                            @else
                                <option value='0'>First choose subject</option>
                            @endif
                        </select>
                    </div>

                    {{-- end --}}
                </div>
                <div>
                    <span class="mt-2 d-block">যদি উদ্দীপকে / প্রশ্নে  ফটো থাকে তাহলে এখানে দাও।</span>
                    @if ($mcq->photo_url !=NULL || $mcq->photo_url !=0)
                    <div class="card w-50">
                        <img class="w-100" src="@isset($mcq->photo_url){{$mcq->photo_url}}@endisset" alt="">
                    </div>
                    @endif
                    <input name="id" type="hidden" value="{{$mcq->id}}">
                    <input value="@isset($mcq->photo_url) {{$mcq->photo_url}} @endisset" type="file" name="file" class="form-control">
                    <span class="mt-2 d-block">যদি উদ্দীপকে লেখা থাকে তাহলে এখানে লেখ</span>
                    <textarea class="w-100" name="uddipak" id="" rows="4"> @isset($mcq->uddipak) {{$mcq->uddipak}} @endisset </textarea>
                    <span class="mt-5 mt-2"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>প্রশ্নটি লেখ</span>
                    <textarea class="w-100" name="question" id="" rows="4"> @isset($mcq->question) {{$mcq->question}} @endisset</textarea>
                    <span class=" mt-2 d-block"><span style="font-size: 1.6rem" class="text-danger me-1">*</span>অপশন লেখ এবং সঠিক উত্তরটি চিন্নিহিত কর।</span>
                    <div class="row">
                        @for ($i=1; $i<=4; $i++)
                            <?php $tmpData = ''; ?>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label style="cursor: pointer; height:34px;" for="flexCheckDefault{{$i}}" class="bg-light ps-0 user-select-none d-flex p-1 mb-1" id="basic-addon">
                                        <input style="width: 30px;" name="answer[]" class="form-check-input me-1" type="checkbox" value="{{$i}}" id="flexCheckDefault{{$i}}" 
                                        
                                        @if (sizeof(json_decode($mcq->answer))==1)
                                            @if(json_decode($mcq->answer)[0] == $i) checked  @endif 
                                        @else
                                            @for ($j=0; $j<sizeof(json_decode($mcq->answer)); $j++)
                                                @if(json_decode($mcq->answer)[$j] == $i) checked @endif                                               
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
                                    @isset($mcq)
                                        @if ($i==1)
                                        <?php $tmpData= $mcq->option1; echo   "<span class='ms-1 m-0 p-0 bg-secondary text-light bordered rounded w-100 d-block'>".$mcq->option1."</span>"; ?>
                                        @endif
                                        @if ($i==2)
                                        <?php $tmpData= $mcq->option2; echo   "<span class='ms-1 m-0 p-0 bg-secondary text-light bordered rounded w-100 d-block'>".$mcq->option2."</span>"; ?>
                                        @endif
                                        @if ($i==3)
                                        <?php $tmpData= $mcq->option3; echo   "<span class='ms-1 m-0 p-0 bg-secondary text-light bordered rounded  w-100 d-block'>".$mcq->option3."</span>"; ?>
                                        @endif
                                        @if ($i==4)
                                        <?php $tmpData= $mcq->option4; echo   "<span class='ms-1 m-0 p-0 bg-secondary text-light bordered rounded  w-100 d-block'>".$mcq->option4."</span>"; ?>
                                        @endif
                                    @endisset
                                    </label>
                                    <textarea class="w-100 form-control" name="option_{{$i}}" id="" rows="1">{{ $tmpData }}</textarea>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <span class=" mt-2 d-block">প্রশ্নের লিঙ্ক ID দাও (অপশনাল)</span>
                    <input name='questionLinkId' type="text d-block" class="form-control"> 
                    <span class=" mt-2 d-block">ব্যাখা লিখ (অপশনাল)</span>
                    <textarea name="explain_mcq" id="editor">@isset($mcq->explain) {{$mcq->explain}} @endisset</textarea>
                    <span class=" mt-2 d-block">সিমিলার প্রশ্ন লেখ (অপশনাল)</span>
                    <textarea name="similarAnswer" id="editorSimilar">@isset($mcq->similar_question) {{$mcq->similar_question}} @endisset</textarea>
                    <button type="submit" class="btn btn-danger mt-3 w-100">Update Question</button>
                </div>
            </form> 
        </div>
    </div>
</div>
@endsection