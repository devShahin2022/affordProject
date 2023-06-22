@extends('layouts.master')
@section('title',"add cq")
@section('content')
    <div class="container">
        <h1 class="bg-light p-2 mt-1 mb-3"><a  href="{{ route('getCq', ['statusReset'=>0]) }}">Back</a> Viewing cq no -{{$serial}}</h1>
        <div class="row">
            <div class="col-md-6 bg-light">
                @if ($currentData->uddipakPhoto != NULL)
                    <img src="{{$currentData->uddipakPhoto }}" class="w-100 mb-1" alt="">
                @endif
                <p class="lead"><?php echo "<span>".$currentData->uddipakText."</span>"; ?></p>
                <p class="lead">(ক) {{$currentData->question1 }}</p>
                <p class="lead">(খ) {{$currentData->question2 }}</p>
                <p class="lead">(গ) {{$currentData->question3 }}</p>
                @if($currentData->question4 != NULL || $currentData->question4)
                <p class="lead">(ঘ) {{$currentData->question4 }}</p>
                @endif
            </div>
            <div class="col-md-6">
                @if ($currentData->answerPhoto1 != NULL || $currentData->answerPhoto1 != 0)
                    <img src="{{$currentData->answerPhoto1 }}" class="w-100 mb-1" alt="">
                @endif
                (ক) <p class="lead"><?php echo '<span>'. $currentData->answerQuestion1 .'</span>' ?></p>



                @if ($currentData->answerPhoto2 != NULL || $currentData->answerPhoto2 != 0)
                <img src="{{$currentData->answerPhoto2 }}" class="w-100 mb-1" alt="">
                @endif
                (খ) <p class="lead"><?php echo '<span>'. $currentData->answerQuestion2 .'</span>' ?></p>



                @if ($currentData->answerPhoto3 != NULL || $currentData->answerPhoto3 != 0)
                <img src="{{$currentData->answerPhoto3 }}" class="w-100 mb-1" alt="">
                @endif
                (গ) <p class="lead"><?php echo '<span>'. $currentData->answerQuestion3 .'</span>' ?></p>
                
                @if ($currentData->answerPhoto4 != NULL || $currentData->answerPhoto4 != 0)
                <img src="{{$currentData->answerPhoto4 }}" class="w-100 mb-1" alt="">
                @endif

                
                @if ($currentData->answerQuestion4 != NULL || $currentData->answerQuestion4 != 0)
                (ঘ) <p class="lead"><?php echo '<span>'. $currentData->answerQuestion4 .'</span>' ?></p>
                @endif

            </div>
        </div>
    </div>
@endsection