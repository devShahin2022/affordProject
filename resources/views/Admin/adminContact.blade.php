@extends('layouts.master')
@section('title','admin-contact')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                  <h1 class='my-3'>Pending contacts @if (isset($pendingData)) {{sizeof($pendingData)}} @endif</h1>
                    @if (session('success'))
                        <li class="text-success">{{session('success')}}</li>
                    @endif
                    @if (session('fail'))
                        <li class="text-danger">{{session('fail')}}</li>
                    @endif
                    @if (session('err'))
                        <li class="text-danger">{{session('err')}}</li>
                    @endif
                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                  @if (isset($pendingData))
                    @foreach ($pendingData as $d)
                    <form action="{{route('approvedContact')}}" method="POST">
                        @csrf
                        <div class="bg-light p-2 my-3 border rounded">
                            <div class="d-flex justify-content-between w-100">
                                <h3>{{$loop->index + 1}}</h3>
                                <small>Date : {{$d->created_at}}</small>
                            </div>
                            <p class="lead mb-2"><strong class="text-info">Name : </strong>{{$d->name}}</p>
                            <p class="lead mb-2"><strong class="text-info">School name : </strong>{{$d->school}}</p>
                            <p class="lead mb-2"><strong class="text-info">Phone or Email : </strong>{{$d->reply_phone_email}}</p>
                            <p class="lead mb-2"><strong class="text-info">Message : </strong>{{$d->message}}</p>
                        
                            <div class="d-flex justify-between">
                                <input name='id' type="hidden" value="{{$d->id}}">
                                <input name='text' placeholder="write approved" type="text" class="form-control w-80">
                                <button type="submit" class="btn btn-dark w-20">Answer message</button>
                            </div>
                        </div>
                    </form>
                    @endforeach
                @endif
            </div>

            <div class="col-md-6">
                <h1 class='my-3'>Delivered contacts @if (isset($deliveredData)) {{sizeof($deliveredData)}} @endif</h1>
              @if (isset($deliveredData))
                  @foreach ($deliveredData as $d)
                  <div class="bg-light p-2 my-3 border rounded">
                    <div class="d-flex justify-content-between w-100">
                        <h3>{{$loop->index + 1}}</h3>
                        <small>Date : {{$d->updated_at}}</small>
                    </div>
                    <p class="lead mb-2"><strong class="text-info">Name : </strong>{{$d->name}}</p>
                    <p class="lead mb-2"><strong class="text-info">School name : </strong>{{$d->school}}</p>
                    <p class="lead mb-2"><strong class="text-info">Phone or Email : </strong>{{$d->reply_phone_email}}</p>
                    <p class="lead mb-2"><strong class="text-info">Message : </strong>{{$d->message}}</p>
                </div>
                @endforeach
              @endif
          </div>
        </div>
    </div>
@endsection