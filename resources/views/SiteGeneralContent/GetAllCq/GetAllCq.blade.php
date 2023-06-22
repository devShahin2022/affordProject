@extends('layouts.master')
@section('title', "all mcq")
@section('content')
<div class="container">
    <div class="container">
        <h1 class="bg-light p-2 mt-1 mb-3" >সকল সৃজনশীল প্রশ্ন</h1>
        @if ( sizeof($currentData)>0)
        <div class="row">
        @foreach ($currentData as $d)
            <div class="col-md-6">
                <p class="bg-light p-2">{{$loop->index + 1 }}</p>
                @isset($d->uddipakPhoto)
                    <img src="{{$d->uddipakPhoto}}" class="w-100 mb-1" alt="">
                @endisset
                <p><?php  echo "<span>".$d->uddipakText."</span>"; ?> </p>
                
                <p>(ক) <?php  echo "<span>".$d->question1."</span>"; ?> </p>
                <p>(খ) <?php  echo "<span>".$d->question2."</span>"; ?></p>
                <p>(গ) <?php  echo "<span>".$d->question3."</span>"; ?></p>
                @isset($d->question4)
                <p>(ঘ) <?php  echo "<span>".$d->question4."</span>"; ?></p>
                @endisset
                <div class="accordion accordion-flush border-top border-bottom border-light" id="accordionFlushExample_{{$loop->index}}">
                    <div class="accordion-item bg-light">
                      <h2 class="accordion-header" id="flush-headingOne_{{$loop->index}}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne_{{$loop->index}}" aria-expanded="false" aria-controls="flush-collapseOne">
                          উত্তর দেখতে ক্লিক করুন
                        </button>
                      </h2>
                      <div id="flush-collapseOne_{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne_{{$loop->index}}" data-bs-parent="#accordionFlushExample_{{$loop->index}}">
                        <div class="accordion-body">
                            <p>(ক) </p>
                            @isset($d->answerPhoto1)
                                <img src="{{$d->answerPhoto1}}" class="w-100 mb-1" alt="">
                            @endisset
                            @isset($d->answerQuestion1)
                                <p> <?php  echo "<span>".$d->answerQuestion1."</span>"; ?> </p>
                            @endisset
                            <p>(খ) </p>
                            @isset($d->answerPhoto2)
                                <img src="{{$d->answerPhoto2}}" class="w-100 mb-1" alt="">
                            @endisset
                            @isset($d->answerQuestion2)
                                <p><?php  echo "<span>".$d->answerQuestion2."</span>"; ?> </p>
                            @endisset
                            <p>(গ) </p>
                            @isset($d->answerPhoto3)
                                <img src="{{$d->answerPhoto3}}" class="w-100 mb-1" alt="">
                            @endisset
                            @isset($d->answerQuestion3)
                                <p><?php  echo "<span>".$d->answerQuestion3."</span>"; ?> </p>
                            @endisset
                            <p>(ঘ) </p>
                            @isset($d->answerPhoto4)
                                <img src="{{$d->answerPhoto4}}" class="w-100 mb-1" alt="">
                            @endisset
                            @isset($d->answerQuestion4)
                                <p><?php  echo "<span>".$d->answerQuestion4."</span>"; ?> </p>
                            @endisset
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        @endforeach   
        </div>

        @else
        <h3 class="text-center mt-4">No cq found!!</h3>
        @endif
    </div>
</div>
@endsection