@extends('layouts.master')
@section('title',"Free exam")
@section('content')

  <div class="container">
    @if ($examData == null)
     <h2 class="text-center my-2 mb-4">আমাদের বল অধ্যায়ের পরীক্ষা দিয়ে প্রমাণ করে দাও তুমি কতটা বলবান!!! </h2>
    @else
      @if ($examData &&  $examData->isEndExam ==null)
      <h2 class="text-center my-2 mb-4">তোমার পরীক্ষাটি পেন্ডিং অবস্থায় আছে । ঝটপট নিচের বাটনটিতে ক্লিক করে পরীক্ষাটি সম্পন্ন করে ফেল!!!</h2>
      @else
       <h2 class="text-center my-2"> পরীক্ষায় অংশগ্রহণ করার জন্য ধন্যবাদ  </h2>
       <p class="mb-4 text-muted text-center mb-4">আমাদের কথা কি তোমার বন্ধুদেরকে জানিয়েছ ?</p>
      @endif
    @endif
    <div id="confirmationModal" class="row">
        <div class="col-md-6">
          @if ($examData && $examData->isEndExam != null)
            @if ($examData->isclickedSeeResult == 1)
              <a  href="{{ route('freeExam') }}"><button class="btn btn-info my-3">View question and download</button></a>
              <p class="lead mt-3 bg-light p-2 mb-2">এরকম আরো এক্সাইটিং পরীক্ষা দিতে চাইলে এখনি তোমার অ্যাকাউন্টটিকে প্রিমিয়াম করে নাও  - </p>
              <div class="bg-light">
                <h3 class="bg-primary text-white p-2 mb-3">তোমার ফলাফল</h3>
                <p><b>Correct answer :</b> {{$examData->correctAnswer}}</p>
                <p><b>Wrong answer :</b> {{$examData->wrongAnswer}}</p>
                <p><b>Skip answer :</b> {{$examData->untouch}}</p>
                <p><b>Time spent :</b> {{ json_decode($examData->isEndExam) - json_decode($examData->isStartExam) }}ms</p>
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
                          <?php echo "<span class='ms-2'>".$q->uddipak."</span>" ?>
                        </div>
                      @endisset
                      @if (is_array(json_decode($examData->yourAnswers)[$loop->index]))
                        @if (json_decode($examData->yourAnswers)[$loop->index][0] == json_decode($q->answer)[0])
                          <p class="mt-2 text-success">{{$loop->index + 1}}. <?php echo "<span class='ms-2'>".$q->question."</span>" ?> </p>
                          @for($i=0; $i<4; $i++)
                            @if (($i+1) == json_decode($q->answer)[0])
                              <div class="col-6 d-flex">
                                <p class="text-success">{{$optionTagArr4[$i]}}. <?php echo "<span class='ms-2'>".$optionArr4[$i]."</span>" ?> (Your answer correct)</p>
                              </div>
                            @else
                              <div class="col-6 d-flex">
                                <p class="">{{$optionTagArr4[$i]}}. <?php echo "<span class='ms-2'>".$optionArr4[$i]."</span>" ?></p>
                              </div>
                            @endif
                          @endfor
                        @else
                          <p class=" mt-2 text-danger">{{$loop->index + 1}}. <?php echo "<span class='ms-2'>".$q->question."</span>" ?> </p>
                          @for ($i=0; $i<4; $i++)
                            @if (json_decode($q->answer)[0] == $i+1)
                              <div class="col-6 d-flex">
                                <p class="text-success">{{$optionTagArr4[$i]}}.  <?php echo "<span class='ms-2'>".$optionArr4[$i]."</span>" ?> </p>
                              </div>
                            @elseif (json_decode($examData->yourAnswers)[$loop->index][0] == $i+1)
                              <div class="col-6 d-flex">
                                <p class="text-danger">{{$optionTagArr4[$i]}}. <?php echo "<span class='ms-2'>".$optionArr4[$i]."</span>" ?> (Your answer wrong)</p>
                              </div>
                            @else
                              <div class="col-6 d-flex">
                                <p class="">{{$optionTagArr4[$i]}}. <?php echo "<span class='ms-2'>".$optionArr4[$i]."</span>" ?></p>
                              </div>
                            @endif
                          @endfor
                        @endif
                      @else
                        <p class="mt-2 text-info">{{$loop->index + 1}}. <?php echo "<span class='ms-2'>".$q->question."</span>" ?></p>
                        @for($i=0; $i<4; $i++)
                          @if (($i+1) == json_decode($q->answer)[0])
                            <div class="col-6 d-flex">
                              <p class="text-success">{{$optionTagArr4[$i]}}. <?php echo "<span class='ms-2'>".$optionArr4[$i] ."</span>" ?> </p>
                            </div>
                          @else
                            <div class="col-6 d-flex">
                              <p class="">{{$optionTagArr4[$i]}}. <?php echo "<span class='ms-2'>".$optionArr4[$i] ."</span>" ?> </p>
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
                          <p class="mt-2 text-success">{{$loop->index + 1}}. <?php echo "<span class='ms-2'>".$q->question."</span>" ?> </p>
                          @for ($i=0; $i<3; $i++)
                            @if (json_decode($examData->yourAnswers)[$loop->index][$i] == json_decode($q->answer)[$i])
                              <div class="col-6 d-flex">
                                <p class="success">{{$optionTagArr4[$i]}}.<?php echo "<span class='ms-2'>".$optionArr4[$i]."</span>" ?></p>
                              </div>
                            @else
                              <div class="col-6 d-flex">
                                <p class="">{{$optionTagArr4[$i]}}. <?php echo "<span class='ms-2'>".$optionArr4[$i]."</span>" ?></p>
                              </div>
                            @endif
                          @endfor
                          <i>Your answer was correct</i>
                        @endif
                        @if ($flag == false)
                          <p class="mt-2 text-danger">{{$loop->index + 1}}. <?php echo "<span class='ms-2'>".$q->question."</span>" ?></p>
                          @for ($i=0; $i<3; $i++)
                            <div class="col-6 d-flex">
                              <p class="">{{$optionTagArr4[$i]}}.  <?php echo "<span class='ms-2'>".$optionArr4[$i]."</span>" ?></p>
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
                        <p class="mt-2 text-info">{{$loop->index + 1}}. <?php echo "<span class='ms-2'>".$q->question."</span>" ?></p>
                        @for ($i=0; $i<3; $i++)
                          <div class="col-6 d-flex">
                            <p class="">{{$optionTagArr4[$i]}}.<?php echo "<span class='ms-2'>".$optionArr4[$i]."</span>" ?></p>
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
                                <?php echo "<span class='ms-2'>".$q->explain."</span>" ?>
                              @endisset
                              @isset($q->similar_question)
                              <hr>
                              <p class="lead">কিছু সিমিলার উত্তর- </p>
                              <hr>
                                <?php echo "<span class='ms-2'>".$q->similar_question."</span>" ?>
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
              <p class="mb-4 lead">ফলাফল দেখতে নিচের বাটনটিতে ক্লিক করে ফেল</p>
              <form action="{{ route('seeFreeExamResult') }}" method="GET">
                @csrf
                  <button class="btn btn-primary w-100" type="submit">ফলাফল</button>
              </form>
              {{-- marketing info --}}
              <p class="lead mt-3">এরকম আরো এক্সাইটিং পরীক্ষা দিতে চাইলে এখনি তোমার অ্যাকাউন্টটিকে প্রিমিয়াম করে নাও  - </p>
            @endif
          @else
            {{-- new visitor view --}}
            <div id="newVisitorView">
              @if($examData != null)
              <button onclick="freeExamCall()" class="btn btn-dark">Continue Exam</button>
              @endif
                <h4 class=" my-2 text-info">মনোযোগ দিয়ে পড়ুন</h4>
                <p class="lead">পরিক্ষার বিষয়- সাধারণ গনিত </p>
                <p class="lead">পরিক্ষার অধ্যায়- সেট </p>
                <p class="lead">পরিক্ষার ধরণ- এমসিকিউ </p>
                <p class="lead">সময়- আনলিমিটেড</p>
                <p class="lead">মার্ক- ২৫</p>
                <ul>
                    <li>
                        আপনি কত মার্ক পেয়েছেন তার ওপর ভিত্তি করে আপনার মেধা তালিকা দেয়া হবে।
                    </li>
                    <li>
                        মার্ক সমান হলে সেক্ষেত্রে যার সবচেয়ে কম সময় লাগবে তাকে অগ্রাধিকার দেয়া হবে।
                    </li>
                    <li>
                        আপনি ফ্রিতে শুধু  একটি পরীক্ষা দিতে পারবেন । আরো পরীক্ষা দিতে চাইলে আপনার প্রোফাইল এ গিয়ে অ্যাকাউন্টটি প্রিমিয়াম করে নিন।
                    </li>
                    <li>
                        আপনি যদি পরিক্ষার জন্য প্রস্তুত থাকেন তাহলে নিচের বাটনে ক্লিক করে পরীক্ষা শুরু করুন । 
                        <p class="text-danger">সতর্কতা- বাটন টি একবার ক্লিক করলেই তোমার সময় গণনা শুরু হবে । এবং উত্তর সাবমিট করা পর্যন্ত সময় গণনা করা হবে।</p>
                    </li>
                    @if($examData == null)
                      <button onclick="freeExamCall()" class="btn btn-dark">Start Exam</button>
                    @endif
                </ul>
            </div>
          @endif
            {{--Exam question panel --}}
            <form id="submitExam" action="#">
              <div id="pushExamQuestionMcqId" class="border p-2 my-3 d-none">
              </div>
            </form>
          {{-- push result button with form --}}
          <div class="border p-2 d-none" id="pushResultFormId">
            <h3> আপনার পরীক্ষাটি সম্পন্ন হয়েছে।</h3>
            <form action="{{ route('seeFreeExamResult') }}" method="GET">
              @csrf
                <button class="btn btn-primary w-100" type="submit">ফলাফল</button>
            </form>
          </div>
        </div>
        {{-- right section --}}
        <div class="col-md-6">
            <h4>লিডারবোর্ড</h4>
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
  </div>







{{-- default opening modal --}}
@if ($examData == null)
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
@else
<div class="modal fade" id="" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
@endif
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel">গুরুত্বপূর্ণ নির্দেশনা</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4 class="text-center my-2 text-info">মনোযোগ দিয়ে পড়ুন</h4>
          <p class="lead">পরিক্ষার বিষয়- সাধারণ গনিত </p>
          <p class="lead">পরিক্ষার অধ্যায়- সেট </p>
          <p class="lead">পরিক্ষার ধরণ- এমসিকিউ </p>
          <p class="lead">সময়- আনলিমিটেড</p>
          <p class="lead">মার্ক- ২৫</p>
          
          <ul>
            <li>
                আপনি কত মার্ক পেয়েছেন তার ওপর ভিত্তি করে আপনার মেধা তালিকা দেয়া হবে।
            </li>
            <li>
                মার্ক সমান হলে সেক্ষেত্রে যার সবচেয়ে কম সময় লাগবে তাকে অগ্রাধিকার দেয়া হবে।
            </li>
            <li>
                আপনি ফ্রিতে শুধু  একটি পরীক্ষা দিতে পারবেন । আরো পরীক্ষা দিতে চাইলে আপনার প্রোফাইল এ গিয়ে অ্যাকাউন্টটি প্রিমিয়াম করে নিন।
            </li>
            <li>
                আপনি যদি পরিক্ষার জন্য প্রস্তুত থাকেন তাহলে নিচের বাটনে ক্লিক করে পরীক্ষা শুরু করুন । 
                <p class="text-danger">সতর্কতা- বাটন টি একবার ক্লিক করলেই তোমার সময় গণনা শুরু হবে । এবং উত্তর সাবমিট করা পর্যন্ত সময় গণনা করা হবে।</p>
            </li>
            <button  onclick="freeExamCall()" class="btn btn-dark">Start Exam</button>
          </ul>
        </div>
      </div>
    </div>
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
        <form action="{{ route('seeFreeExamResult') }}" method="GET">
          @csrf
            <button class="btn btn-primary w-100" type="submit">ফলাফল</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection