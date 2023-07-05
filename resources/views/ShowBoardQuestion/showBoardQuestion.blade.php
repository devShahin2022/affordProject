@extends("layouts.master")
@section("title","board question")
@section("content")

    <nav class="sticky-top p-1 container m-auto bg-light">
        <div class="row">
            <div class="col-3">
                <?php $start = 2022; ?>
                <select id="pushYear" class="form-select" aria-label="Default select example">
                    @for ($i=0; $i<8; $i++)
                        <option>{{ $start-$i }}</option>
                    @endfor
                </select>
            </div>
            <input type="hidden" value="{{$book}}" id='getBookName'>
            <div class="col-9">
                <div style="height: 2.2rem;" id="pushBoardNameId"  class="overflow-auto"></div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div id='dynamicallyPushDataId' class="row bg-light mt-2">
            <div class="col-12 text-center mt-3 mb-4">
                <h5>দিনাজপুর বোর্ড - 2022</h5>
                <p class="m-0 p-0">বহুনির্বাচনী প্রশ্ন - {{sizeof($mcq)}}</p>
                <p class="m-0 p-0">বিষয় - {{$book}}</p>
            </div>
        </div>
            @if (sizeof($mcq)>0)
            <div id="pushMcq" class="row bg-light p-2">
                @foreach ($mcq as $d)
                    <div id="pushcolmd6" class="col-md-6 colmd6Clear">
                        @if ($d->photo_url !=null)
                            <img src="{{$d->photo_url}}" class="w-100" alt="">
                        @endif
                        @if ($d->uddipak !=null)
                            <div><?php echo "<span>". $d->uddipak ."</span>"?></div>
                        @endif
                        @if ($d->question_type == 1)
                            {{-- this scop for general mcq --}}
                            <div>
                                <div class="d-flex">{{$loop->index + 1}}. <?php echo "<span class='ms-1'>". $d->question ."</span>"?></div>
                            </div>
                            <div class="row">
                                <div class="col-6 d-flex">(a)<?php echo "<span class='ms-2'>". $d->option1 ."</span>"?></div>
                                <div class="col-6 d-flex">(b)<?php echo "<span class='ms-2'>". $d->option2 ."</span>"?></div>
                                <div class="col-6 d-flex">(c)<?php echo "<span class='ms-2'>". $d->option3 ."</span>"?></div>
                                <div class="col-6 d-flex">(d)<?php echo "<span class='ms-2'>". $d->option4 ."</span>"?></div>
                            </div>
                            <i class="">
                                উত্তর - 
                                @if (json_decode($d->answer)[0] == 1)
                                    a
                                @endif
                                @if (json_decode($d->answer)[0] == 2)
                                    b
                                @endif
                                @if (json_decode($d->answer)[0] == 3)
                                    c
                                @endif
                                @if (json_decode($d->answer)[0] == 4)
                                    d
                                @endif
                            </i>
                        @else
                            {{-- this scop for bohupodi mcq --}}
                            <div>
                                <div class="d-flex">{{$loop->index + 1}}. <?php echo "<span class='ms-1'>". $d->question ."</span>"?></div>
                            </div>
                            <div class="row">
                                <div class="col-6 d-flex">(i)<?php echo "<span class='ms-2'>". $d->option1 ."</span>"?></div>
                                <div class="col-6 d-flex">(ii)<?php echo "<span class='ms-2'>". $d->option2 ."</span>"?></div>
                                <div class="col-6 d-flex">(iii)<?php echo "<span class='ms-2'>". $d->option3 ."</span>"?></div>
                            </div>
                            <i class="">
                                উত্তর - 
                                @for ($i=0; $i<sizeof(json_decode($d->answer)); $i++)
                                    @if (sizeof(json_decode($d->answer))-1 == $i)
                                        @if (json_decode($d->answer)[$i] == 1)
                                            i
                                        @endif
                                        @if (json_decode($d->answer)[$i] == 2)
                                            ii
                                        @endif
                                        @if (json_decode($d->answer)[$i] == 3)
                                            iii
                                        @endif
                                    @else
                                        @if (json_decode($d->answer)[$i] == 1)
                                            i, 
                                        @endif
                                        @if (json_decode($d->answer)[$i] == 2)
                                            ii, 
                                        @endif
                                        @if (json_decode($d->answer)[$i] == 3)
                                            iii, 
                                        @endif
                                    @endif
                                @endfor
                            </i>
                        @endif
                            @if ($d->explain !=null)
                                <div class="accordion accordion-flush" id="body_id_{{$loop->index}}">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-explain_{{$loop->index}}" aria-expanded="false" aria-controls="flush-collapseOne">
                                                ব্যাখ্যা দেখতে ক্লিক কর
                                            </button>
                                        </h2>
                                        <div id="flush-explain_{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#body_id_{{$loop->index}}">
                                            <div class="accordion-body d-flex"><?php echo "<span>". $d->explain ."</span>"; ?></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($d->similar_question !=null)
                                <div class="accordion accordion-flush" id="body_id_similar_{{$loop->index}}">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-similar{{$loop->index}}" aria-expanded="false" aria-controls="flush-collapseOne">
                                                বেশ কিছু অনুরূপ প্রশ্ন
                                            </button>
                                        </h2>
                                        <div id="flush-similar{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#body_id_similar_{{$loop->index}}">
                                            <div class="accordion-body d-flex"><?php echo "<span>". $d->similar_question ."</span>"; ?></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                    </div>
                @endforeach
            </div>
        @else
            <h3>No data found!</h3>
        @endif
    </div>
    <div id="cqNavBarId" class="container mt-3 d-flex flex-wrap sticky-top bg-white text-primary p-2">
        @for ($i=0; $i<sizeof($cq); $i++)
            <a class="mx-2" href="#id_{{$i}}">সৃজনশীল - {{$i+1}}</a>
        @endfor
    </div>
    <div style="background:#e6e6e6" class="container mt-3 p-2">
        <div id="cqBoardQuestionId" class="text-center mt-3 mb-4">
            <h5>দিনাজপুর বোর্ড - 2022</h5>
            <p class="m-0 p-0">সৃজনশীল প্রশ্ন - {{sizeof($cq)}}</p>
            <p class="m-0 p-0">বিষয় - {{$book}}</p>
        </div>
        <div id='pushCqId' class="row">
            @if (sizeof($cq)>0)
                @foreach ($cq as $d)
                    <div id="id_{{$loop->index}}" class="col-md-6">
                        <div class="d-flex">
                            <p class="me-1">{{$loop->index+1}}.</p>
                            @if ($d->uddipakPhoto !=null)
                                <img src="{{$d->uddipakPhoto}}" class="w-100" alt="">
                            @endif
                            @if ($d->uddipakText !=null)
                                <div class="d-flex"><?php echo "<span>". $d->uddipakText ."</span>" ?></div>
                            @endif
                        </div>



                        @if ($d->answerQuestion1 !=null)
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div style="background: #e6e6e6;"  class="accordion-item mb-1">
                                    <p class="accordion-header p-1 m-0" id="flash_1_{{$loop->index}}">
                                        <button style="background: #e6e6e6;" class="accordion-button collapsed p-1 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-1_{{$loop->index}}" aria-expanded="false" aria-controls="flush-collapseOne">
                                            (a) <?php echo "<span class='ms-1'>". $d->question1 ."</span>" ?>
                                        </button>
                                    </p>
                                    <div id="flush-1_{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="flash_1_{{$loop->index}}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            @if ($d->answerPhoto1 !=null)
                                                <img src="{{$d->answerPhoto1}}" class="w-100" alt="">
                                            @endif
                                            <p class="d-flex flex-wrap">(a) উত্তর- <?php echo "<span class='ms-1'>". $d->answerQuestion1 ."</span>" ?></p></div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="d-flex">(a) <?php echo "<span class='ms-1'>". $d->question1 ."</span>" ?></p>
                        @endif


                        @if ($d->answerQuestion2 !=null)
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div style="background: #e6e6e6;"  class="accordion-item mb-1">
                                    <p class="accordion-header p-1 m-0" id="flash_2_{{$loop->index}}">
                                        <button style="background: #e6e6e6;" class="accordion-button collapsed p-1 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-2_{{$loop->index}}" aria-expanded="false" aria-controls="flush-collapseOne">
                                            (b) <?php echo "<span class='ms-1'>". $d->question2 ."</span>" ?>
                                        </button>
                                    </p>
                                    <div id="flush-2_{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="flash_2_{{$loop->index}}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            @if ($d->answerPhoto2 !=null)
                                            <img src="{{$d->answerPhoto2}}" class="w-100" alt="">
                                            @endif
                                            <p class="d-flex flex-wrap">(b) উত্তর- <?php echo "<span class='ms-1'>". $d->answerQuestion2 ."</span>" ?></p></div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="d-flex">(b) <?php echo "<span class='ms-1'>". $d->question2 ."</span>" ?></p>
                        @endif



                        @if ($d->answerQuestion3 !=null)
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div style="background: #e6e6e6;"  class="accordion-item mb-1">
                                    <p class="accordion-header p-1 m-0" id="flash_3_{{$loop->index}}">
                                        <button style="background: #e6e6e6;" class="accordion-button collapsed p-1 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-3_{{$loop->index}}" aria-expanded="false" aria-controls="flush-collapseOne">
                                            (c) <?php echo "<span class='ms-1'>". $d->question3 ."</span>" ?>
                                        </button>
                                    </p>
                                    <div id="flush-3_{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="flash_3_{{$loop->index}}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            @if ($d->answerPhoto3 !=null)
                                            <img src="{{$d->answerPhoto3}}" class="w-100" alt="">
                                            @endif
                                            <p class="d-flex flex-wrap">(c) উত্তর- <?php echo "<span class='ms-1'>". $d->answerQuestion3 ."</span>" ?></p></div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="d-flex">(c) <?php echo "<span class='ms-1'>". $d->question3 ."</span>" ?></p>
                        @endif



                        @if ($d->question4 !=null)
                            @if ($d->answerQuestion4 !=null)
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div style="background: #e6e6e6;"  class="accordion-item mb-1">
                                        <p class="accordion-header p-1 m-0" id="flash_4_{{$loop->index}}">
                                            <button style="background: #e6e6e6;" class="accordion-button collapsed p-1 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-4_{{$loop->index}}" aria-expanded="false" aria-controls="flush-collapseOne">
                                                (d) <?php echo "<span class='ms-1'>". $d->question4 ."</span>" ?>
                                            </button>
                                        </p>
                                        <div id="flush-4_{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="flash_4_{{$loop->index}}" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                @if ($d->answerPhoto4 !=null)
                                                <img src="{{$d->answerPhoto4}}" class="w-100" alt="">
                                                @endif
                                                <p class="d-flex flex-wrap">(d) উত্তর- <?php echo "<span class='ms-1'>". $d->answerQuestion4 ."</span>" ?></p></div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p class="d-flex">(d) <?php echo "<span class='ms-1'>". $d->question4 ."</span>" ?></p>
                            @endif
                        @endif
                    </div>
                @endforeach
            @else
                <h3>No cq found!!</h3>
            @endif
        </div>
    </div>
    
@endsection