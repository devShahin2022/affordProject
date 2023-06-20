<?php 

if($currentData->question_type == NULL){
    print_r($currentData);
}
 
?>


@extends('layouts.master')
@section('title', "add mcq")
@section('content')
<div class="container">
    <h3 class="p-3 bg-light mb-3 mt-1"><a href="{{ route('addBoardMcqView', ['statusReset'=> 0 ]) }}"> Back </a> You a specific mcq No- ({{$mcqNo}})</h3>
    <div class="row">
        <div class="col-md-6">
            <div>
                <div class="card-body">
                    @isset($currentData->photo_url)
                        <img src="{{$currentData->photo_url}}" alt="" class="w-100">
                    @endisset
                @isset($currentData->uddipak)
                    <p >{{$currentData->uddipak}}</p>
                @endisset
                @isset($currentData->question)
                    <p class=""><?php echo '<span>'. $currentData->question.'</span>'; ?></p>
                @endisset
                <div class="row">
                    @if ($currentData->question_type == 1 && sizeof(json_decode($currentData->answer))==1)
                    <div class="col-6 d-flex">
                        @if($currentData->option1)
                            <p class="d-flex align-items-center"><span class='me-1 @if (json_decode($currentData->answer)[0] == 1) mcq_circle @else mcq_circle mcq_circle_border @endif' style="">a</span> <?php echo '<span>'.$currentData->option1.'</span>' ?></p>
                        @endif
                    </div>
                    <div class="col-6 d-flex">
                        @if($currentData->option2)
                        <p class="d-flex align-items-center"><span class='me-1 @if (json_decode($currentData->answer)[0] == 2) mcq_circle @else mcq_circle mcq_circle_border @endif' style="">b</span> <?php echo '<span>'.$currentData->option2.'</span>' ?></p>
                        @endif
                    </div>
                    <div class="col-6 d-flex">
                        @if($currentData->option3)
                        <p class="d-flex align-items-center"><span class='me-1 @if (json_decode($currentData->answer)[0] == 3) mcq_circle @else mcq_circle mcq_circle_border @endif' style="">c</span> <?php echo '<span>'.$currentData->option3.'</span>' ?></p>
                        @endif
                    </div>
                    <div class="col-6 d-flex">
                        @if($currentData->option4)
                        <p class="d-flex align-items-center"><span class='me-1 @if (json_decode($currentData->answer)[0] == 4) mcq_circle @else mcq_circle mcq_circle_border @endif' style="">d</span> <?php echo '<span>'.$currentData->option4.'</span>' ?></p>
                        @endif
                    </div>
                @else
                    <div class="col-6 d-flex">
                        @if($currentData->option1)
                            <p >i. <?php echo '<span>'.$currentData->option1.'</span>' ?></p>
                        @endif
                    </div>
                    <div class="col-6 d-flex">
                        @if($currentData->option2)
                            <p >ii. <?php echo '<span>'.$currentData->option2.'</span>' ?></p>
                        @endif
                    </div>
                    <div class="col-6 d-flex">
                        @if($currentData->option3)
                            <p >iii. <?php echo '<span>'.$currentData->option3.'</span>' ?></p>
                        @endif
                    </div>
                        <p class="text-secondary">Answer : 
                            @foreach (json_decode($currentData->answer) as $ans)
                                @if($loop->index == (sizeof(json_decode($currentData->answer))-1))
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
                        <input name="id" type="hidden" value="{{$currentData->id}}">
                        <button title="click to delete" type="submit" class="btn btn-transparent"><span class="badge text-bg-danger">Delete it</span></button>
                    </form>
                    <form method="POST" action="{{route('changeMcqStatus')}}">
                        @csrf
                        <input name="id" type="hidden" value="{{$currentData->id}}">
                        <input name="status_val" type="hidden" value="{{$currentData->status}}">
                        @if($currentData->status == 1)
                            <button title="click to make deactive" type="submit" class="btn btn-transparent"><span class="badge text-bg-success">it's active</span></button>
                        @else
                            <button title="click to make active" type="submit" class="btn btn-transparent"><span class="badge text-bg-secondary">it's deactive</span></button>
                        @endif
                    </form>
                    <a href="{{ route('McqUpdate', ['id'=>$currentData->id,'mcqNo'=>$mcqNo ]) }}" class="active nav-link me-2"><button title="click to make active" type="submit" class="btn btn-transparent"><span class="badge text-bg-primary">Edit</span></button></a>
                </div>
                <small class="text-muted text-end d-block"><i> - Added by : {{$currentData->uploaded_by}} </i></small>
            </div>
            </div> 
        </div>
        @if ($currentData->explain || $currentData->similar_question)
            <div class="col-md-6">
                @if ($currentData->explain)
                    <h4>See answer explanation</h4>
                    <div class="card p-2">
                        <?php echo  '<span>'.$currentData->explain.'</span>' ?>
                    </div>
                @endif
                @if ($currentData->similar_question)
                    <h4>See Similar answer</h4>
                    <div class="card p-2">
                        <?php echo  '<span>'.$currentData->similar_question.'</span>' ?>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection