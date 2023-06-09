<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link" aria-current="page" href="/">Home</a>
          @if (Auth::user())
          <form action="{{route('logout')}}" method="POST">
            @csrf
            <button class='nav-link btn-sm border-0 btn-light' type="submit">Logout</button>
          </form>
          @else
          <a class="nav-link"  href="{{ route('signUp') }}">Sigh up</a>
          <a class="nav-link"  href="{{ route('login') }}">Login</a>
          @endif
          @if (Auth::user())
          <a class="nav-link" href="{{route('showProfile')}}">Profile</a> 
          @endif
        </div>
      </div>
    </div>
  </nav>