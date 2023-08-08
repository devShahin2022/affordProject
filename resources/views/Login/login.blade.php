@extends("layouts.master")
@section("title","sign up")
@section("content")
    <div class="container">
        <h1 class="display-4 text-center">Login</h1>
        <div class="row">
            <div class="col-md-6">
                <img class="w-100 my-1" src={{asset('static_image/logingif.gif')}}>
            </div>
            <div class="col-md-6">
                @if (session('fail'))
                    <p class="text-danger">{{session('fail')}}</p>
                @endif
                @if (session('success'))
                    <p class="text-success">{{session('success')}}</p>
                @endif
                <form class="mt-5" action="{{ route('loginProcess') }}" method="POST">
                    @csrf
                    @method("POST")
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Username</label>
                      <input name="username"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @if ($errors->has('username'))
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input name="password" type="text" class="form-control" id="exampleInputPassword1">
                      @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                    <p class="text-muted">Don't have any account? <a href="/register" >Register now</a></p>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                  </form>
            </div>
        </div>
    </div>
@endsection