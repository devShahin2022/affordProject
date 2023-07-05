@extends('layouts.master')
@section('title',"Free exam")
@section('content')
    <div class="container">
        @if ($currentExamSet == null)
            <h1 class="my-3">Currently no exam found!</h1>
        @else
            <div class="row">
                @if($examData ==null)
                    <div class="col-md-6">
                        {{-- exam complete message --}}
                        <div id="examSuccessId" class="d-none mt-3">
                            <h3> আপনার পরীক্ষাটি সম্পন্ন হয়েছে।</h3>
                            <p>ফলাফল দেখতে নিচের বাটনে ক্লিক কর</p>
                            <h3> আপনার পরীক্ষাটি সম্পন্ন হয়েছে।</h3>
                            <form action="{{ route('seePremExamResult') }}" method="GET">
                            @csrf
                                {{-- add some hidden file --}}
                                <input name="departmentName"  type="hidden" value="{{$examPaper[0]->departmentName}}">
                                <input name="subjectName"  type="hidden" value="{{$examPaper[0]->subjectName}}">
                                <input  name="chapterName" type="hidden" value="{{$examPaper[0]->chapterName}}">
                                <input name="question_set"  type="hidden" value="{{$examPaper[0]->question_set}}">
                                <input name="className"  type="hidden" value="{{$currentExamSet->targetClass}}">
                                <button class="btn btn-primary w-100" type="submit">ফলাফল</button>
                            </form>
                        </div>
                        <div id="pushExamQuestionMcqId">
                            <h1 class="mt-2 mb-3">লেটস পারটিসিপেট আওয়ার লেটেস্ট এক্সাম</h1>
                            <div class="bg-light p-2">
                                <p>বিষয়- {{$currentExamSet->subjectName}}</p>
                                <p>অধ্যায়- {{$currentExamSet->chapterName}}</p>
                                <p>সেট- {{$currentExamSet->question_set}}</p>
                                <p>মোট প্রশ্ন- {{sizeof($examPaper)}}</p>
                                <p>ডেড লাইন- {{$currentExamSet->deadLine}} দিন</p>
                                <p>মোট অংশগ্রহণকারী- {{sizeof($allExaminer)}}</p>
                                <hr>
                            </div>
                            @if ($currentExamSet !=  null)
                                @isset($examPaper)
                                    @if(sizeof($examPaper)>0)
                                    <form id="submitExamPre">
                                        {{-- hidden files --}}
                                        <input type="hidden" id="mcqSz" value="{{sizeof($examPaper)}}">
                                        {{-- essential hidden file --}}
                                        <input id="departmentName" type="hidden" value="{{$examPaper[0]->departmentName}}" >
                                        <input id="subjectName" type="hidden" value="{{$examPaper[0]->subjectName}}" >
                                        <input id="chapterName" type="hidden" value="{{$examPaper[0]->chapterName}}" >
                                        <input id="question_set" type="hidden" value="{{$examPaper[0]->question_set}}" >
            
                                        @foreach ($examPaper as $q)
                                            @if($q->question_type == 1)
                                                <div class="row">
                                                    <div class="col-12">
                                                    <h5 class="mb-2 mt-3">{{$loop->index + 1}}. {{$q->question}}</h5>
                                                    </div>
                                                    <div class="col-6 d-flex  d-flex mt-2">
                                                    <input value="1" type="radio" class="btn-check" name="options{{$loop->index + 1}}" id="options1_{{$loop->index + 1}}" autocomplete="">
                                                    <label class="btn btn-outline-secondary w-100 text-start" for="options1_{{$loop->index + 1}}">a. {{$q->option1}}</label>
                                                    </div>
                                                    <div class="col-6 d-flex  d-flex mt-2">
                                                    <input  value="2"  type="radio" class="btn-check" name="options{{$loop->index + 1}}" id="options2_{{$loop->index + 1}}" autocomplete="">
                                                    <label class="btn btn-outline-secondary w-100  text-start" for="options2_{{$loop->index + 1}}">b. {{$q->option2}}</label>
                                                    </div>
                                                    <div class="col-6 d-flex  d-flex mt-2">
                                                    <input  value="3"  type="radio" class="btn-check" name="options{{$loop->index + 1}}" id="options3_{{$loop->index + 1}}" autocomplete="">
                                                    <label class="btn btn-outline-secondary w-100  text-start" for="options3_{{$loop->index + 1}}">c. {{$q->option3}}</label>
                                                    </div>
                                                    <div class="col-6 d-flex  d-flex mt-2">
                                                    <input  value="4"  type="radio" class="btn-check" name="options{{$loop->index + 1}}" id="options_{{$loop->index + 1}}" autocomplete="">
                                                    <label class="btn btn-outline-secondary w-100  text-start" for="options_{{$loop->index + 1}}">d. {{$q->option4}}</label>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($q->question_type == 2)
                                                <div class="row">
                                                    <div class="col-12">
                                                    <h5 class="mb-2 mt-3">{{ $loop->index +1 }}. {{$q->question}}</h5>
                                                    </div>
                                                    <div class="col-6 d-flex  d-flex mt-2">
                                                    <input value="1" type="checkbox" class="btn-check" name="options{{ $loop->index +1 }}" id="options1_{{ $loop->index +1 }}" autocomplete="">
                                                    <label class="btn btn-outline-secondary w-100 text-start" for="options1_{{ $loop->index +1 }}">i. {{$q->option1}}</label>
                                                    </div>
                                                    <div class="col-6 d-flex  d-flex mt-2">
                                                    <input  value="2"  type="checkbox" class="btn-check" name="options{{ $loop->index +1 }}" id="options2_{{ $loop->index +1 }}" autocomplete="">
                                                    <label class="btn btn-outline-secondary w-100  text-start" for="options2_{{ $loop->index +1 }}">ii. {{$q->option2}}</label>
                                                    </div>
                                                    <div class="col-6 d-flex  d-flex mt-2">
                                                    <input  value="3"  type="checkbox" class="btn-check" name="options{{ $loop->index +1 }}" id="options3_{{ $loop->index +1 }}" autocomplete="">
                                                    <label class="btn btn-outline-secondary w-100  text-start" for="options3_{{ $loop->index +1 }}">iii. {{$q->option3}}</label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        <div class="col-12 mt-4 mb-2">
                                            <button type="submit" class="btn btn-primary w-100 mt-2">Submit exam paper</button>
                                        </div>
                                    </form>
                                    @else
                                        <h3>No exam question found!</h3>
                                    @endif
                                @endisset
                            @else
                                <h3>Currently no exam question found!</h3>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="col-md-6">
                        @if ($examData->isEndExam != null && $examData->isclickedSeeResult ==1)
                            <h1 class="mt-3 mb-3">আমাদের পরীক্ষায় অংশগ্রহণ করার জন্য ধন্যবাদ</h1>
                            <a  href="{{ route('premiumExam',[
                                'subject'=>$examData->subjectName,
                                'chapter'=>$examData->chapterName,
                                'set'=>$examData->set
                            ]) }}">View question and download</a>
                            {{-- see result --}}
                            <div class="bg-light mt-3 text-muted">
                                <h3 class="bg-primary text-white p-2 mb-3">তোমার ফলাফল</h3>
                                    <div class="row">
                                        <div class="col-6 ">
                                            <h5><b class="text-info">সঠিক উত্তর :</b> {{$examData->correctAnswer}}</h5>
                                            <p><b>ভুল উত্তর :</b> {{$examData->wrongAnswer}}</p>
                                            <p><b>স্কিপ প্রশ্ন :</b> {{$examData->untouch}}</p>
                                            <p><b>Time spent :</b> {{ json_decode($examData->isEndExam) - json_decode($examData->isStartExam) }}ms</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>শ্রেণী :</b> {{$currentExamSet->targetClass}}</p>
                                            <p><b>বিষয় :</b> {{$examData->subjectName}}</p>
                                            <p><b>অধ্যায় :</b> {{$examData->chapterName}}</p>
                                            <p><b>সেট :</b> {{$examData->set}}</p>
                                            <p><b>ফুল মার্ক :</b> {{$examData->totalQuestion}}</p>
                                        </div>
                                    </div>
                                <p><b>Feedback :</b> {{$examData->affordMsg}}</p>
                                <hr>
                                <h3 class="bg-primary text-white p-2 mb-3">ডিটেইলসে দেখ - {{$examData->totalQuestion}}</h3>
                        </div>
                        <div>
                            <div class="row">
                            <?php  $optionArr4 = array(); $optionTagArr4 = ["a","b","c","d"];
                            
                            
                            ?>
                            @foreach ($examPaper as $q)
                                @if ($q->question_type == 1)
                                <?php  
                                array_push($optionArr4,$q->option1, $q->option2,$q->option3,$q->option4);
                                ?>
                                {{-- show if image or uddipak exits --}}
                                @isset($q->photo_url)
                                    <div class="col-12">
                                    <img src="{{$q->photo_url}}" class="w-100" alt="">
                                    </div>
                                @endisset
                                @isset($q->uddipak)
                                    <div class="col-12">
                                    {{-- <p>{{$q->uddipak}}</p> --}}
                                    <?php echo "<span>".$q->uddipak."</span>" ?>
                                    </div>
                                @endisset
                                @if (is_array(json_decode($examData->yourAnswers)[$loop->index]))
                                    @if (json_decode($examData->yourAnswers)[$loop->index][0] == json_decode($q->answer)[0])
                                    <p class="mt-2 text-success">{{$loop->index + 1}}. <?php echo "<span>".$q->question."</span>" ?> </p>
                                    @for($i=0; $i<4; $i++)
                                        @if (($i+1) == json_decode($q->answer)[0])
                                        <div class="col-6 d-flex  d-flex">
                                            <p class="text-success">{{$optionTagArr4[$i]}}. <?php echo "<span>".$optionArr4[$i]."</span>" ?> (Your answer correct)</p>
                                        </div>
                                        @else
                                        <div class="col-6 d-flex  d-flex">
                                            <p class="">{{$optionTagArr4[$i]}}. <?php echo "<span>".$optionArr4[$i]."</span>" ?></p>
                                        </div>
                                        @endif
                                    @endfor
                                    @else
                                    <p class=" mt-2 text-danger">{{$loop->index + 1}}. <?php echo "<span>".$q->question."</span>" ?> </p>
                                    @for ($i=0; $i<4; $i++)
                                        @if (json_decode($q->answer)[0] == $i+1)
                                        <div class="col-6 d-flex  d-flex">
                                            <p class="text-success">{{$optionTagArr4[$i]}}.  <?php echo "<span>".$optionArr4[$i]."</span>" ?> </p>
                                        </div>
                                        @elseif (json_decode($examData->yourAnswers)[$loop->index][0] == $i+1)
                                        <div class="col-6 d-flex  d-flex">
                                            <p class="text-danger">{{$optionTagArr4[$i]}}. <?php echo "<span>".$optionArr4[$i]."</span>" ?> (Your answer wrong)</p>
                                        </div>
                                        @else
                                        <div class="col-6 d-flex  d-flex">
                                            <p class="">{{$optionTagArr4[$i]}}. <?php echo "<span>".$optionArr4[$i]."</span>" ?></p>
                                        </div>
                                        @endif
                                    @endfor
                                    @endif
                                @else
                                    <p class="mt-2 text-info">{{$loop->index + 1}}. <?php echo "<span>".$q->question."</span>" ?></p>
                                    @for($i=0; $i<4; $i++)
                                    @if (($i+1) == json_decode($q->answer)[0])
                                        <div class="col-6 d-flex  d-flex">
                                        <p class="text-success">{{$optionTagArr4[$i]}}. <?php echo "<span>".$optionArr4[$i] ."</span>" ?> </p>
                                        </div>
                                    @else
                                        <div class="col-6 d-flex  d-flex">
                                            <p class="">{{$optionTagArr4[$i]}}. <?php echo "<span>".$optionArr4[$i] ."</span>" ?> </p>
                                        </div>
                                    @endif
                                    @endfor
                                    <i>You skipped this question</i>
                                @endif
                                {{-- reasign array --}}
                                <?php $optionArr4 = array(); ?>
                                @else
                                <?php 
                                $optionArr4 = array(); $optionTagArr4 = ["i","ii","iii"];
                                array_push($optionArr4,$q->option1, $q->option2,$q->option3);
                                $flag = false;
                                ?>
                                @if (is_array(json_decode($examData->yourAnswers)[$loop->index]))
                                    @if (sizeof(json_decode($examData->yourAnswers)[$loop->index]) == sizeof(json_decode($q->answer)))
                                    @for ($i=0; $i<sizeof(json_decode($q->answer)); $i++)
                                        @if (json_decode($examData->yourAnswers)[$loop->index][$i] == json_decode($q->answer)[$i])
                                        <?php $flag = true ?>
                                        @else
                                        <?php $flag = false ?>
                                        @endif
                                    @endfor
                                    @endif
                                    @if ($flag == true)
                                    <p class="mt-2 text-success">{{$loop->index + 1}}. <?php echo "<span>".$q->question."</span>" ?> </p>
                                    @for ($i=0; $i<3; $i++)
                                        @if (json_decode($examData->yourAnswers)[$loop->index][$i] == json_decode($q->answer)[$i])
                                        <div class="col-6 d-flex  d-flex">
                                            <p class="success">{{$optionTagArr4[$i]}}.<?php echo "<span>".$optionArr4[$i]."</span>" ?></p>
                                        </div>
                                        @else
                                        <div class="col-6 d-flex  d-flex">
                                            <p class="">{{$optionTagArr4[$i]}}. <?php echo "<span>".$optionArr4[$i]."</span>" ?></p>
                                        </div>
                                        @endif
                                    @endfor
                                    <i>Your answer was correct</i>
                                    @endif
                                    @if ($flag == false)
                                    <p class="mt-2 text-danger">{{$loop->index + 1}}. <?php echo "<span>".$q->question."</span>" ?></p>
                                    @for ($i=0; $i<3; $i++)
                                        <div class="col-6 d-flex  d-flex">
                                        <p class="">{{$optionTagArr4[$i]}}.  <?php echo "<span>".$optionArr4[$i]."</span>" ?></p>
                                        </div>
                                    @endfor
                                    <i class="text-danger">Your answer was wrong :
                                    @for ($i=1; $i<= sizeof(json_decode($examData->yourAnswers)[$loop->index]);$i++)
                                        @if ($i < sizeof(json_decode($examData->yourAnswers)[$loop->index]))
                                        {{ json_decode($examData->yourAnswers)[$loop->index][$i-1]}},
                                        @else
                                        {{ json_decode($examData->yourAnswers)[$loop->index][$i-1]}}
                                        @endif
                                    @endfor
                                    </i>
                                    <i class="text-success">Correct answer:
                                        @for ($i=1; $i<= sizeof(json_decode($q->answer));$i++)
                                        @if ($i < sizeof(json_decode($q->answer)))
                                            {{ json_decode($q->answer)[$i-1]}},
                                        @else
                                            {{ json_decode($q->answer)[$i-1]}}
                                        @endif
                                        @endfor
                                    </i>
                                    @endif
                                @else
                                    {{--  If question skipped --}}
                                    <p class="mt-2 text-info">{{$loop->index + 1}}. <?php echo "<span>".$q->question."</span>" ?></p>
                                    @for ($i=0; $i<3; $i++)
                                    <div class="col-6 d-flex  d-flex">
                                        <p class="">{{$optionTagArr4[$i]}}.<?php echo "<span>".$optionArr4[$i]."</span>" ?></p>
                                    </div>
                                    @endfor
                                    <i class="">You skipped this question </i>
                                    <i class="text-success">Correct answer:
                                    @for ($i=1; $i<= sizeof(json_decode($q->answer));$i++)
                                        @if ($i < sizeof(json_decode($q->answer)))
                                        {{ json_decode($q->answer)[$i-1]}},
                                        @else
                                        {{ json_decode($q->answer)[$i-1]}}
                                        @endif
                                    @endfor
                                    </i>
                                @endif 
                                @endif
                                {{-- add extra features --}}
                                @if ($q->explain!=null || $q->similar_question!=null)
                                <div class="accordion accordion-flush" id="accordionFlushExample{{$loop->index}}">
                                    <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed border" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$loop->index}}" aria-expanded="false" aria-controls="flush-collapseOne">
                                        বিস্তারিত দেখতে ক্লিক কর...
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample{{$loop->index}}">
                                        <div class="accordion-body border">
                                        @isset($q->explain)
                                        <p class="lead">উত্তরের ব্যাখা - </p>
                                        <hr>
                                            <?php echo "<span>".$q->explain."</span>" ?>
                                        @endisset
                                        @isset($q->similar_question)
                                        <hr>
                                        <p class="lead">কিছু সিমিলার উত্তর- </p>
                                        <hr>
                                            <?php echo "<span>".$q->similar_question."</span>" ?>
                                        @endisset
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            </div>
                        </div>
                        @else
                            <h1 class="mt-3">তোমার পরীক্ষাটি সম্পন্ন হয়েছে । ফলাফল দেখতে নিচের বাটনটিতে ক্লিক কর</h1>
                            <form action="{{ route('seePremExamResult') }}" method="GET">
                                @csrf
                                    {{-- add some hidden file --}}
                                    <input name="departmentName"  type="hidden" value="{{$examPaper[0]->departmentName}}">
                                    <input name="subjectName"  type="hidden" value="{{$examPaper[0]->subjectName}}">
                                    <input  name="chapterName" type="hidden" value="{{$examPaper[0]->chapterName}}">
                                    <input name="question_set"  type="hidden" value="{{$examPaper[0]->question_set}}">
                                    <input name="className"  type="hidden" value="{{$currentExamSet->targetClass}}">
                                    <button class="btn btn-primary w-100" type="submit">ফলাফল</button>
                            </form>
                        @endif
                    </div>
                @endif
                {{-- right section --}}
                <div class="col-md-6 mt-4">
                    <h4 class="text-info">লিডারবোর্ড</h4>
                    <p class="lead">মোট অংশগ্রহণকারী - @if ($allExaminer != null)
                    {{sizeof($allExaminer)}}
                    @endif</p>
                    <p class="lead text-center">প্রথম ১০০ জনের অবস্থান</p>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Mark</th>
                            <th scope="col">Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($allExaminer != null)
                            @foreach ($allExaminer as $d)
                            @if (  $d->isEndExam !=null)
                            <tr>
                                <th scope="row">{{$loop->index +1}}</th>
                                <td>{{$d->username}}</td>
                                <td>{{$d->correctAnswer}}</td>
                                <td>Time: {{json_decode($d->isEndExam) - json_decode($d->isStartExam)}}</td>
                            </tr>
                            @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
             {{-- is exists extra question set this condition --}}
             <h3 class="mt-3 mb-5">এই অধ্যায়ের পূর্বের সকল পরীক্ষাসমুহ </h3>
             <hr>
             @if($prevExamSet !=null)
                 @if (sizeof($prevExamSet)>0)
                    <div class="row">
                        @foreach ($prevExamSet as $prevXm)
                            @if ( $isAlreadyExam[$loop->index] == false )
                                    <div class="col-3">
                                        <a  href="{{ route('customExamParticipate', ['className'=>$currentExamSet->targetClass,
                                            "subjectName" =>$prevXm->subjectName,
                                            'chapterName' => $prevXm->chapterName,
                                            'set'=>$prevXm->question_set
                                                ]) }}">
                                            <div class="bg-light p-2 my-2 rounded">
                                                <img class="h-auto" style="width:2.5rem;" src="{{asset("static_image/exclamation.png")}}" alt="">
                                                <p class="font-weight-bold text-muted mb-0 mt-2">ট্রাই দিস এক্সাম</p>
                                                <i class="text-muted">সেট-{{$prevXm->question_set}} </i>
                                            </div>
                                        </a>
                                    </div>

                            @else
                                <div class="col-3">
                                    <a class="text-decoration-none" href="{{ route('customExamParticipate', ['className'=>$currentExamSet->targetClass,
                                        "subjectName" =>$prevXm->subjectName,
                                        'chapterName' => $prevXm->chapterName,
                                        'set'=>$prevXm->question_set
                                            ]) }}">
                                        <div class="bg-light p-2 my-2 rounded">
                                            <img class="h-auto" style="width:2.5rem;" src="{{asset("static_image/checked.png")}}" alt="">
                                            <p class="font-weight-bold text-muted mb-0 mt-2">অলরেডি পরীক্ষাটি সম্পন্ন করেছ</p>
                                            <i class="text-muted">সেট-{{$prevXm->question_set}} </i>
                                            {{-- <p class="text-muted"><b>মার্ক- </b>
                                                @if ($examData->correctAnswer != NULL)
                                                    {{$examData->correctAnswer}}
                                                @endif 
                                            </p> --}}
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                 @else
                     <h5>No exams found!</h5>
                 @endif
             @endif
        @endif
    </div>



{{-- alert modal --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
  
          <h3> আপনার পরীক্ষাটি সম্পন্ন হয়েছে।</h3>
          @if ($currentExamSet != null)
            <form action="{{ route('seePremExamResult') }}" method="GET">
                @csrf
                    {{-- add some hidden file --}}
                    <input name="departmentName"  type="hidden" value="{{$examPaper[0]->departmentName}}">
                    <input name="subjectName"  type="hidden" value="{{$examPaper[0]->subjectName}}">
                    <input  name="chapterName" type="hidden" value="{{$examPaper[0]->chapterName}}">
                    <input name="question_set"  type="hidden" value="{{$examPaper[0]->question_set}}">
                    <input name="className"  type="hidden" value="{{$currentExamSet->targetClass}}">
                <button class="btn btn-primary w-100" type="submit">ফলাফল</button>
            </form>
          @endif
        </div>
      </div>
    </div>
  </div>


@endsection