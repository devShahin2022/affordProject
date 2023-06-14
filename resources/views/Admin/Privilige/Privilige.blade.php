@extends('layouts.master')
@section('title',"All users")
@section('content')
<div class="container">
    <h1 class="text-center my-4 bg-light p-4">Admin previlige</h1>
   <form method="GET" action="{{route('searchUser')}}">
      @csrf
      <input class="form-control my-3" name='search' type="search" placeholder='search here'>
      <button type="submit" class="btn btn-primary mb-2">Search</button>
   </form>
   @if (isset($isSearch))
      <h1 class="text-center mb-5 bg-light p-3">Result for searching `{{ $isSearch }}`- ({{ sizeof($users) }}) </h1>
   @else
      <h3 class="text-center mb-5 bg-light p-3">All admins data -  @if (isset($users)) {{sizeof($users)}} @endif</h3>
   @endif
   @if (isset($users) && sizeof($users) > 0)
   <table class="table table-striped-columns">
      @if (session('success'))
         <p class="lead alert alert-success">{{ session('success') }}</p>
      @endif
      @if (session('fail'))
         <p class="lead alert alert-danger">{{ session('fail') }}</p>
      @endif
      @if (session('error'))
         <p class="lead alert alert-danger">{{ session('error') }}</p>
      @endif
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Image</th>
          <th scope="col">Username</th>
          <th scope="col">Role</th>
          <th scope="col">Account type</th>
          <th scope="col">Status</th>
          <th scope="col">Power</th>
          <th scope="col">Action</th>
          <th scope="col">Privilige</th>
        </tr>
      </thead>
      <tbody>
         @if(isset($users))
            @foreach ($users as $user)
               <tr>
                  <th scope="row">{{ $loop->index + 1}}</th>
                  <td>Mark</td>
                  <td>{{ $user->username }}</td>
                  <td>
                     @if ($user->role == "student")
                        <span class="badge rounded-pill text-bg-danger">{{ $user->role }}</span></td>
                     @endif
                     @if ($user->role == "teacher")
                        <span class="badge rounded-pill text-bg-success">{{ $user->role }}</span></td>
                     @endif
                     @if ($user->role == "admin")
                        <span class="badge rounded-pill text-bg-secondary">{{ $user->role }}</span></td>
                     @endif
                     @if ($user->role == "superadmin")
                        <span class="badge rounded-pill text-bg-info">{{ $user->role }}</span></td>
                     @endif
                  <td>
                     @if ($user->account_type == 0)
                        <span class="badge rounded-pill text-bg-success">Free account</span>
                     @endif
                     @if ($user->account_type == 1)
                        <span class="badge rounded-pill text-bg-success">Prmium account</span>
                     @endif
                     @if ($user->account_type == 2)
                        <span class="badge rounded-pill text-bg-success">Admitted</span>
                     @endif
                  </td>
                  <td>
                     @if ($user->status == 1)
                        <span class="badge rounded-pill text-bg-success">active</span>
                     @else
                        <span class="badge rounded-pill text-bg-secondary">disabled</span>
                     @endif
                  </td>
                  <td>
                    @if ($user->privilige == NULL || $user->privilige == 0)
                       <span class="badge rounded-pill text-bg-info">Reading</span>
                    @endif
                    @if ($user->privilige == 1)
                       <span class="badge rounded-pill text-bg-secondary">create&update(p)</span>
                    @endif
                    @if ($user->privilige == 2)
                       <span class="badge rounded-pill text-bg-primary">create&update(All)</span>
                    @endif
                    @if ($user->privilige == 3)
                        <span class="badge rounded-pill text-bg-danger">update(p)</span>
                    @endif
                    @if ($user->privilige == 4)
                        <span class="badge rounded-pill text-bg-success">update(All)</span>
                    @endif
                    @if ($user->privilige == 5)
                        <span class="badge rounded-pill text-bg-danger">create</span>
                    @endif
                    @if ($user->privilige == 6)
                        <span class="badge rounded-pill text-bg-primary">delete(p)</span>
                    @endif
                    @if ($user->privilige == 7)
                        <span class="badge rounded-pill text-bg-secondary">delete(all)</span>
                    @endif
                    @if ($user->privilige == 8)
                        <span class="badge rounded-pill text-bg-success">powerfull</span>
                    @endif
                 </td>
                  <td>
                     @if ($user->role == 'superadmin')
                        <span class="badge rounded-pill text-bg-info">No action</span>
                     @else
                        <div class="dropdown">
                           <a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Action
                           </a>
                           <ul class="dropdown-menu">
                              {{
                                 session()->put('csrf', time())
                              }}
                              @if($user->status!=0)
                                 <li><a class="dropdown-item"  href="{{ route('changeRole', ['name'=>"disabled",'id'=>$user->id, 'csrf'=>time()])}}" >Disable account</a></li>
                              @endif
                              @if($user->status!=1)
                                 <li><a class="dropdown-item"  href="{{ route('changeRole', ['name'=>"active",'id'=>$user->id, 'csrf'=>time()])}}" >Active account</a></li>
                              @endif
                              @if($user->role!='teacher')
                                 <li><a class="dropdown-item" href="{{ route('changeRole', ['name'=>"teacher",'id'=>$user->id, 'csrf'=>time()])}}" >Make teacher</a></li>
                              @endif
                              @if($user->role!='student')
                                 <li><a class="dropdown-item" href="{{ route('changeRole', ['name'=>"student",'id'=>$user->id, 'csrf'=>time()])}}" >Make student</a></li>
                              @endif
                              @if($user->role!='admin')
                                 <li><a class="dropdown-item" href="{{ route('changeRole', ['name'=>"admin",'id'=>$user->id, 'csrf'=>time()])}}" >Make admin</a></li>
                              @endif
                           </ul>
                        </div>
                     @endif
                  </td>
                  <td>
                    @if ($user->role == 'superadmin')
                       <span class="badge rounded-pill text-bg-info">No action</span>
                    @else
                       <div class="dropdown">
                          <a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             Action
                          </a>
                          <ul class="dropdown-menu">
                            @if ($user->privilige != 0)
                            <form method="POST" action="{{ route('changePrivilige') }}">
                                @csrf
                                <input name="id" type="hidden" value="{{$user->id}}">
                                <input name="priviligeSlag" type="hidden" value="read">
                                <li><button class="dropdown-item"  type="submit">Read</button></li> {{-- privilige =0 || NULL --}}
                            </form>
                            @endif
                            @if ($user->privilige != 1)
                            <form method="POST" action="{{ route('changePrivilige') }}">
                                @csrf
                                <input name="id" type="hidden" value="{{$user->id}}">
                                <input name="priviligeSlag" type="hidden" value="createUpdatePart">
                                <li><button class="dropdown-item"  type="submit">Create and Update particular</button></li> {{-- privilige =0 || NULL --}}
                            </form>
                            @endif
                            @if ($user->privilige != 2)
                            <form method="POST" action="{{ route('changePrivilige') }}">
                                @csrf
                                <input name="id" type="hidden" value="{{$user->id}}">
                                <input name="priviligeSlag" type="hidden" value="createUpdateAll">
                                <li><button class="dropdown-item"  type="submit">Create and Update whole site</button></li> {{-- privilige =0 || NULL --}}
                            </form>
                            @endif
                            @if ($user->privilige != 3)
                            <form method="POST" action="{{ route('changePrivilige') }}">
                                @csrf
                                <input name="id" type="hidden" value="{{$user->id}}">
                                <input name="priviligeSlag" type="hidden" value="updatePart">
                                <li><button class="dropdown-item"  type="submit">Update particular</button></li> {{-- privilige =0 || NULL --}}
                            </form>
                            @endif
                            @if ($user->privilige != 4)
                            <form method="POST" action="{{ route('changePrivilige') }}">
                                @csrf
                                <input name="id" type="hidden" value="{{$user->id}}">
                                <input name="priviligeSlag" type="hidden" value="updateAll">
                                <li><button class="dropdown-item"  type="submit">Update whole site</button></li> {{-- privilige =0 || NULL --}}
                            </form>
                            @endif
                            @if ($user->privilige != 5)
                            <form method="POST" action="{{ route('changePrivilige') }}">
                                @csrf
                                <input name="id" type="hidden" value="{{$user->id}}">
                                <input name="priviligeSlag" type="hidden" value="create">
                                <li><button class="dropdown-item"  type="submit">Create</button></li> {{-- privilige =0 || NULL --}}
                            </form>
                            @endif
                            @if ($user->privilige != 6)
                            <form method="POST" action="{{ route('changePrivilige') }}">
                                @csrf
                                <input name="id" type="hidden" value="{{$user->id}}">
                                <input name="priviligeSlag" type="hidden" value="deletePart">
                                <li><button class="dropdown-item"  type="submit">Delete particular</button></li> {{-- privilige =0 || NULL --}}
                            </form>
                            @endif
                            @if ($user->privilige != 7)
                            <form method="POST" action="{{ route('changePrivilige') }}">
                                @csrf
                                <input name="id" type="hidden" value="{{$user->id}}">
                                <input name="priviligeSlag" type="hidden" value="deleteAll">
                                <li><button class="dropdown-item"  type="submit">Delete whole site</button></li> {{-- privilige =0 || NULL --}}
                            </form>
                            @endif
                            @if ($user->privilige != 8)
                            <form method="POST" action="{{ route('changePrivilige') }}">
                                @csrf
                                <input name="id" type="hidden" value="{{$user->id}}">
                                <input name="priviligeSlag" type="hidden" value="allPower">
                                <li><button class="dropdown-item"  type="submit">All power</button></li> {{-- privilige =0 || NULL --}}
                            </form> 
                            @endif
                          </ul>
                       </div>
                    @endif
                 </td>
             </tr>
            @endforeach
         @endif
      </tbody>
    </table>
   @else
      <h3 class="text-primary text-center my-5">No data found!</h3>
   @endif
</div>
@endsection