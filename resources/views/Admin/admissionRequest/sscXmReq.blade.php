@extends('layouts.master')
@section('title',"admission request")
@section('content')
    <div class="container-fluid">
        <div class="row mt-1">
            <div class="col-md-4">
                <h4 class="bg-dark text-light p-4 mt-0 mb-3">New admission request  @if (isset($newReq))
                    {{sizeof($newReq)}}
                @endif </h4>
                @if (session('success'))
                    <p class="text-success">{{ session('success') }}</p>
                @endif
                @if (session('fail'))
                    <p class="text-danger">{{ session('fail') }}</p>
                @endif
                @foreach ($newReq as $d)
                <div class="w-100 bg-light p-2 border-rounded my-2">
                    <div class="row">
                        <p class="mb-0 text-light bg-info">#{{ $loop->index +1 }}</p>
                        <div class="col-6">
                            <span>Name : </span>
                            <input type="text" readonly value="{{$d->std_name}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <span>Payment Method : </span>
                            <input type="text" readonly value="{{$d->payment_method}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <span>Payment number : </span>
                            <input type="text" readonly value="{{$d->payment_number}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <span>Amount taka : </span>
                            <input type="text" readonly value="{{$d->amt_taka}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <span>TrxId : </span>
                            <input type="text" readonly value="{{$d->trx_id}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <div class="mt-4 d-flex justify-content-between">
                                <form method="POST" action="{{route('approvedAddmissionReq')}}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approved</button> 
                                    <input name='id' type="hidden" value="{{$d->id}}">
                                </form>
                                <form method="POST" action="{{route('UnapprovedAddmissionReq')}}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-secondary">Deapproved</button>
                                    <input name='id' type="hidden" value="{{$d->id}}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-4">
                <h4 class="bg-success text-light p-4 mt-0">Successfully approved @if (isset($approvedReq))
                    {{sizeof($approvedReq)}}
                @endif</h4>
            @foreach ($approvedReq as $d)
                <div class="w-100 bg-light p-2 border-rounded my-2">
                    <div class="row">
                        <p class="mb-0 text-light bg-success">#{{ $loop->index +1 }}</p>
                        <div class="col-6">
                            <span>Name : </span>
                            <input type="text" readonly value="{{$d->std_name}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <span>Payment Method : </span>
                            <input type="text" readonly value="{{$d->payment_method}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <span>Payment number : </span>
                            <input type="text" readonly value="{{$d->payment_number}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <span>Amount taka : </span>
                            <input type="text" readonly value="{{$d->amt_taka}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <span>TrxId : </span>
                            <input type="text" readonly value="{{$d->trx_id}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <div class="mt-4">
                                <form method="POST" action="{{route('UnapprovedAddmissionReq')}}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-secondary">Deapproved</button>
                                    <input name='id' type="hidden" value="{{$d->id}}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-4">
                <h4 class="bg-danger text-light p-4 mt-0">Got invalid information @if (isset($unapprovedReq))
                    {{sizeof($unapprovedReq)}}
                @endif</h4>
            @foreach ($unapprovedReq as $d)
                <div class="w-100 bg-light p-2 border-rounded my-2">
                    <div class="row">
                        <p class="mb-0 text-light bg-danger">#{{ $loop->index +1 }}</p>
                        <div class="col-6">
                            <span>Name : </span>
                            <input type="text" readonly value="{{$d->std_name}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <span>Payment Method : </span>
                            <input type="text" readonly value="{{$d->payment_method}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <span>Payment number : </span>
                            <input type="text" readonly value="{{$d->payment_number}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <span>Amount taka : </span>
                            <input type="text" readonly value="{{$d->amt_taka}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <span>TrxId : </span>
                            <input type="text" readonly value="{{$d->trx_id}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <div class="mt-4 d-flex justify-content-between">
                                <form method="POST" action="{{route('approvedAddmissionReq')}}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approved</button> 
                                    <input name='id' type="hidden" value="{{$d->id}}">
                                </form>
                                <form method="POST" action="{{route('deleteUnapprovedReq')}}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    <input name='id' type="hidden" value="{{$d->id}}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection