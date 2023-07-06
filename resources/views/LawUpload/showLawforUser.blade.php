@extends("layouts.master")
@section("title","law")
@section("content")
    <div class="container">
        <input id="getSubjectName" type="hidden" value="{{$subject}}">
        <nav class="sticky-top p-1 container m-auto bg-light">
            <div style="height: 2.2rem;" id="pushChapterName"  class="overflow-auto"></div>
        </nav>
        <div id="pushLawInfo">
            <div class="card p-2">
                <h4 class="text-center">বই - {{$subject}}</h4>
                <h5 class="mb-2 text-center">বিষয় -  {{$chapter}}</h5>
                @if (sizeof($currentData)>0)
                    @foreach ($currentData as $d)
                            <div class="accordion accordion-flush" id="accordion_{{$loop->index}}">
                                <div class="accordion-item">
                                <h2 class="accordion-header p-0 m-0" id="flush-headingOne">
                                    <button class="accordion-button collapsed p-0 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne_{{$loop->index}}" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <p class="d-flex align-center">সুত্র {{$loop->index + 1}} <?php echo "<span class='ms-2'>". $d->law ."</span>" ?></p>
                                    </button>
                                </h2>
                                <div id="flush-collapseOne_{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordion_{{$loop->index}}">
                                    <div class="accordion-body">
                                    <a href="{{route('getUpdateLaw',['id'=>$d->id])}}"><button class="btn btn-info btn-sm">Update</button></a> 
                                    <a href="{{route('lawDelete',['id'=>$d->id])}}"><button class="btn btn-danger btn-sm">delete</button></a> 
                                        <p class="text-info"><b>সুত্রের ব্যাখ্যা </b></p>
                                        <p class="d-flex align-center">
                                            <?php echo "<span>". $d->lawExplain ."</span>" ?>
                                        </p>
                                        <p class="text-info"><b>উদাহরণ </b></p>
                                        <p class="d-flex align-center">
                                            <?php echo "<span>". $d->example ."</span>" ?>
                                        </p>
                                    </div>
                                </div>
                                </div>
                            </div>
                    @endforeach
                @else
                    <h3>No data found!</h3>
                @endif
            </div>
        </div>
    </div>
@endsection