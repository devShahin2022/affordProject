@extends('layouts.master')
@section('title','admin-messages')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                  <h1 class='my-3'>Pending question @if (isset($data)) {{sizeof($data)}} @endif</h1>
                  @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                    @if (session('success'))
                        <span class="text-success">{{ session('success') }}</span>
                    @endif
                    @if (session('fail'))
                        <span class="text-danger">{{ session('fail') }}</span>
                    @endif
                    @if (isset($data))
                    @foreach ($data as $d)
                    <div class="bg-light p-2 my-3 border rounded">
                        <p class="lead mb-2"><strong class="text-info">Question {{$loop->index + 1}} : </strong>{{$d->question}}</p>
                        @if ($d->question_img !== null)
                            <img src="{{$d->question_img}}" class="w-100 h-auto" alt="img here">
                        @endif
                        <h3>Answer now </h3>
                        <form class="mb-2" action="{{route('submitAnswer')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <textarea placeholder="write your answer" name="answer" id="" class='w-100' rows="4"></textarea>
                            <span>need photos?</span>    
                            <div class="row">
                                    <div class="col-9">
                                        <input name="file" type="file" name="file" class="form-control my-1">
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-success btn-sm ms-2 mt-2">send answer</button>
                                    </div>
                                    <input type="hidden" name='actionId' value='{{$d->id}}'>
                                </div>
                        </form>
                      </div>
                    @endforeach
                @endif
            </div>

            <div class="col-md-6">
                <h1 class='my-3'>Previous answer @if (isset($prevData)) {{sizeof($prevData)}} @endif</h1>
              @if (isset($prevData))
                  @foreach ($prevData as $d)
                  <div class="bg-light p-2 my-3 border rounded">
                      <p class="lead mb-1"><strong class="text-info">Question {{$loop->index + 1}} : </strong>{{$d->question}}</p>
                      @if ($d->question_img !== null)
                          <img src="{{$d->question_img}}" class="w-100 h-auto" alt="">
                      @endif
                      <hr class="w-50">
                      <p class="lead mb-1"><strong class="text-info">answer : </strong>{{$d->answer}}</p>
                      @if ($d->question_img !== null)
                          <img src="{{$d->reply_img}}" class="w-100 h-auto" alt="">
                      @endif
                    </div>
                  @endforeach
              @endif
          </div>
        </div>
    </div>
@endsection