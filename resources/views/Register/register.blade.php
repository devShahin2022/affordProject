@extends("layouts.master")
@section("title", "Register")
@section("content")
<div class="container">
    <h1 class="display-3 my-3 text-center">Register</h1>
    <div class="row">
        <div class="col-md-6">
            <img class="w-100 my-1" src={{asset('static_image/registergif.gif')}}>
        </div>
        <div class="col-md-6">
            @if(session('pswdmath'))
                <div class="alert alert-danger">
                    {{ session('pswdmath') }}
                    {{ session('prevData') }}
                </div>
            @endif
            @if(session('usernameExist'))
                <div class="alert alert-danger">
                    {{ session('usernameExist') }}
                </div>
            @endif
            @if(session('maxPhoneUser'))
                <div class="alert alert-danger">
                    {{ session('maxPhoneUser') }}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('fail'))
                <div class="alert alert-danger">
                    {{ session('fail') }}
                </div>
            @endif
            <form action="/register/processing" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Phone</label>
                  <input value="{{old('phone')}}"  type="phone" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{$errors->first('phone')}}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">User name</label>
                    <input  value="{{old('username')}}"  type="text" name="username" class="form-control" id="exampleInputPassword1">
                    @if ($errors->has('username'))
                    <span class="text-danger">{{$errors->first('username')}}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <select name="departmentName" class="form-select w-100" aria-label="Default select example">
                        <option value="0" >বিভাগ সিলেক্ট কর</option>
                        <option value="বিজ্ঞান বিভাগ">বিজ্ঞান বিভাগ</option>
                        <option value="মানবিক বিভাগ">মানবিক বিভাগ</option>
                    </select>
                </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword" class="form-label">Password</label>
                    <input value="{{old('psw')}}" type="text" name="psw" class="form-control" id="exampleInputPassword">
                    @if ($errors->has('psw'))
                    <span class="text-danger">{{$errors->first('psw')}}</span>
                    @endif
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Reapet Password</label>
                  <input value="{{old('repeatPassword')}}" type="text" name="repeatPassword" class="form-control" id="exampleInputPassword1">
                  @if ($errors->has('repeatPassword'))
                  <span class="text-danger">{{$errors->first('repeatPassword')}}</span>
                  @endif
                </div>
                <p class="text-muted">Already have an account? <a href="/login" >Login now</a></p>
                <button type="submit" class="btn btn-primary">Register</button>
              </form>
        </div>
    </div>
</div>
@endsection
