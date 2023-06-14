<?php 
use App\Models\questionModel;
use App\Models\Contact;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

$dataPending = questionModel::where('status',0)->get();
$pendingContact = Contact::where('status',0)->get();
$pendingAdmissionReq = Payment::where('status',0)->get();
if(Auth::user()){
  $getUserData = User::where('id',Auth::user()->id)->first();
  $userRole = $getUserData->role;
  $userAccountType = $getUserData->account_type;
}

?>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="@if (Auth::user() && Auth::user()->role == 'superadmin') container-fluid @else  container  @endif">
      <a class="navbar-brand" href="#"><span style="color:rgb(98, 194, 78);">AFFORT</span><small style="font-size:12px;color:rgb(98, 194, 78);" >private center</small></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link" aria-current="page" href="/">হোম</a>
          <a class="nav-link" aria-current="page" href="{{route('showAllQuestionAns')}}">প্রশ্ন/উত্তর </a>
          <a class="nav-link" href="{{route('showContact')}}">কন্টাক্ট-আস</a> 
          <a class="nav-link" aria-current="page" href="#">ফ্রি-এক্সাম</a>
          @if (Auth::user())
            <a class="nav-link" href="{{route('showProfile')}}">প্রোফাইল</a>
            @if ($userAccountType == 2 || $userRole === 'superadmin')
            <a class="nav-link" aria-current="page" href="#">কোচিং-প্যানেল</a>
            <a class="nav-link" aria-current="page" href="{#">ক্লাসরুম</a>
            @endif
            @if ($userAccountType == 1)
            <a class="nav-link" aria-current="page" href="{#">ক্লাসরুম</a>
            @endif 
          @endif
          <a class="nav-link" aria-current="page" href="#">সাধারণ প্রশ্ন-উত্তর</a>
          @if (Auth::user())
            <form action="{{route('logout')}}" method="POST">
              @csrf
              <button class='nav-link btn-sm border-0 btn-light' type="submit">লগ-আউট</button>
            </form>
            @else
            <a class="nav-link"  href="{{ route('signUp') }}">সাইন-আপ</a>
            <a class="nav-link"  href="{{ route('login') }}">লগ-ইন</a>
          @endif
        </div>
      </div>
    </div>
  </nav>
{{-- this is section for admin sections --}}
@if (Auth::user() && Auth::user()->role == 'superadmin')
  <nav class="navbar navbar-expand-lg bg-dark p-0">
    <div class="@if (Auth::user() && Auth::user()->role == 'superadmin') container-fluid @else  container  @endif">
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link text-light" aria-current="page" href="/">Dashboard</a>
          <a class="nav-link text-light" aria-current="page" href="{{route('getAllUsers')}}">All users</a>
          <a class="nav-link text-light" aria-current="page" href="{{route('privilige')}}">Admin Previlige</a>
          <a class="nav-link text-light" aria-current="page" href="/">Attendece</a>
          <a class="nav-link text-light" aria-current="page" href="/">Payment</a>
          <a class="nav-link text-light" aria-current="page" href="{{route('getAdminContacts')}}"><button type="" class="nav-link border-0 bg-transparent text-light p-0 position-relative">
            Contacts
              @if (sizeof($pendingContact) > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{sizeof($pendingContact)}} 
                  <span class=""></span>
                </span>
              @endif
          </button></a>
          <a class="nav-link text-light" aria-current="page" href="{{route('showAllPendingQuestion')}}">   <button type="" class="nav-link border-0 bg-transparent text-light p-0 position-relative">
            Questions
              @if (sizeof($dataPending) > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{sizeof($dataPending)}} 
                  <span class=""></span>
                </span>
              @endif
          </button></a>
          <a class="nav-link text-light" aria-current="page" href="{{route('getsscXmReq')}}"><button type="" class="nav-link border-0 bg-transparent text-light p-0 position-relative">
            Addmission request
              @if (sizeof($pendingAdmissionReq) > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{sizeof($pendingAdmissionReq)}} 
                  <span class=""></span>
                </span>
              @endif
          </button></a>
          <a class="nav-link text-light" aria-current="page" href="/">Site-content</a>
        </div>
      </div>
    </div>
  </nav>
@endif