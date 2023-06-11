@extends('layouts.master')
@section('title',"Profile")
@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col-md-4 bg-light mt-5">
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <div style="border-radius:50%;width:100px;height:100px; margin-top:-2rem;" class="border border-3 border-white">
                        <img style="width:100px; height:100px; border-radius:50%;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyKpQUy8JP90MAZxFjU0P9bPqkUWL35fd8Ag&usqp=CAU" alt="avatar">
                    </div>
                    <button class="btn btn-primary btn-sm my-2">Edit photo</button>
                </div>
                <div class="my-4">
                    <button class="btn btn-danger w-100 my-2">questions</button>
                    <button class="btn btn-danger w-100 my-2">See current rank</button>
                    <button class="btn btn-danger w-100 my-2">Attendace</button>
                    <button class="btn btn-danger w-100 my-2">Payment history</button>
                    <button class="btn btn-danger w-100 my-2">Personal information</button>
                    <button class="btn btn-danger w-100 my-2">Check result</button>
                    <button class="btn btn-danger w-100 my-2">Your blogs</button>
                    <button class="btn btn-danger w-100 my-2">Add review</button>
                </div>
            </div>
            <div class="col-md-8">
                <h1>Add a new question</h1>
                @if (session('success'))
                  <p class="text-success">{{ session('success') }}</p>
                @endif
                @if (session('fail'))
                  <p class="text-danger">{{ session('fail') }}</p>
                @endif
                <form enctype="multipart/form-data" action="{{route('insertMsg')}}" method="POST">
                  @csrf
                    <p class="lead"><span>Your question name?</span></p>
                    <input type="text" name="question" class="form-control w-100">
                    @if ($errors->has('question'))
                        <span class="text-danger">{{$errors->first('question')}}</span>
                    @endif
                    <p class="lead mt-4"><span>If image?</span></p>
                    <input name=file type="file" class="form-control w-100">
                    <button type="submit" class="btn btn-primary my-3">submit</button>
                    <button type="reset" class="btn btn-primary my-3">Reset</button>
                </form>
                <div>
                <a href="{{route('showPendingQuestion')}}">
                  <h1 class='my-3'>Pending question @if (isset($data))
                    {{sizeof($data)}}
                  @endif</h1>
                </a>
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
                              <img style="width:100%;height:auto;" src="{{$d->question_img}}" alt="image">
                            @endif
                          </div>
                        </div>
                      </div>
                      @endforeach
                    @endif
                  </div>
                </div>
                <a href="{{route('showPrevQuestion')}}"><h1 class='my-3'>Previous answer question @if (isset($prevData)){{sizeof($prevData)}} @endif</h1></a>
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
                                <img style="width:100%;height:auto;" src="{{$d->question_img}}" alt="image">
                              @endif
                              <br>
                              <br>
                              <p class="lead"><strong>From APC : </strong>{{$d->answer}}</p>
                              <br>
                              @if ($d->question_img !== null)
                                <img style="width:100%;height:auto;" src="{{$d->reply_img}}" alt="image">
                              @endif
                            </div>
                          </div>
                        </div>
                        @endforeach
                      @endif
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection