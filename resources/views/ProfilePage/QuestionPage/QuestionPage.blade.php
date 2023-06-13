@extends('layouts.master_profile')
@section('title',"profile-question")
@section('profileContent')
<h1 class="bg-primary p-5 w-100 text-center text-light">Add a new question</h1>
  @if (session('success'))
    <p class="text-success">{{ session('success') }}</p>
  @endif
  @if (session('fail'))
    <p class="text-danger">{{ session('fail') }}</p>
  @endif
  <form enctype="multipart/form-data" action="{{route('insertMsg')}}" method="POST">
    @csrf
      <p class="lead"><span>Your question name?</span></p>
      <textarea name="question" id="" class="w-100 form-control" rows="3"></textarea>
      @if ($errors->has('question'))
          <span class="text-danger">{{$errors->first('question')}}</span>
      @endif
      <p class="lead mt-4"><span>If image?</span></p>
      <input name=file type="file" class="form-control w-100">
      <button type="submit" class="btn btn-primary my-3">submit</button>
      <button type="reset" class="btn btn-primary my-3">Reset</button>
  </form>
  <div>
    <h1 class='my-3'>Pending question @if (isset($data))
      {{sizeof($data)}}
    @endif</h1>
    <div class="accordion" id="accordionPanelsStayOpenExample">
      @if (isset($data))
        @foreach ($data as $d)
        <div class="accordion-item">
          <h2 class="accordion-header" id="h{{$loop->index + 1}}">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-{{$loop->index + 1}}" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
              Question - {{$loop->index + 1}}
            </button>
          </h2>
          <div id="panelsStayOpen-{{$loop->index + 1}}" class="accordion-collapse collapse @if (($loop->index + 1)==1) show @endif" aria-labelledby="h{{$loop->index + 1}}">
            <div class="accordion-body">
              <p class="lead"><strong>Me : </strong>{{$d->question}}</p>
              <br>
              @if ($d->question_img !== null)
                <img style="width:100%;height:auto;" src="{{$d->question_img}}" alt="">
              @endif
            </div>
          </div>
        </div>
        @endforeach
      @endif
    </div>
  </div>
  <h1 class='my-3'>Previous answer question @if (isset($prevData)){{sizeof($prevData)}} @endif</h1>
    <div class="accordion" id="accordionPanelsStayOpenExample">
      <div class="accordion" id="accordionPanelsStayOpenExample">
        @if (isset($prevData))
          @foreach ($prevData as $d)
          <div class="accordion-item">
            <h2 class="accordion-header" id="prev-h{{$loop->index + 1}}">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#prev-panelsStayOpen-{{$loop->index + 1}}" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                Question - {{$loop->index + 1}}
              </button>
            </h2>
            <div id="prev-panelsStayOpen-{{$loop->index + 1}}" class="accordion-collapse collapse @if (($loop->index + 1)==1) show @endif" aria-labelledby="prev-h{{$loop->index + 1}}">
              <div class="accordion-body">
                <p class="lead"><strong>Me : </strong>{{$d->question}}</p>
                <br>
                @if ($d->question_img !== null)
                  <img style="width:100%;height:auto;" src="{{$d->question_img}}" alt="">
                @endif
                <br>
                <br>
                <p class="lead"><strong>From APC : </strong>{{$d->answer}}</p>
                <br>
                @if ($d->question_img !== null)
                  <img style="width:100%;height:auto;" src="{{$d->reply_img}}" alt="">
                @endif
              </div>
            </div>
          </div>
          @endforeach
        @endif
      </div>
    </div>
@endsection