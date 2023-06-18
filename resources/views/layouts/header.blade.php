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
      <button class="btn btn-sm btn-outline-danger me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptionsLabel">Content-setting</button>
      <button class="btn btn-sm btn-outline-dark me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptionsclassroom" aria-controls="offcanvasWithBothOptionsclassroomLabel">ক্লাসরুম</button>
      <button class="btn btn-sm btn-outline-primary me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptionscoaching" aria-controls="offcanvasWithBothOptionscoachingLabel">কোচিং প্যানেল</button>
      
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
        </div>
      </div>
    </div>
  </nav>

  <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">সাইটের ডাটা সেটিংস</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <main class="d-flex flex-nowrap">
        <div class="flex-shrink-0" style="width: 100%;">
          <ul class="list-unstyled ps-0"> 
            <p class="bg-light p-2">সাধারণ কন্টেন্ট</p>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                প্রশ্ন উত্তর
              </button>
              <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="{{route('addBoardMcqView')}}" class="link-dark d-inline-flex text-decoration-none rounded">এমসিকিউ অ্যাড কর</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">সিকিউ অ্যাড কর</a></li>
                  <li><a href="{{route('showMakeMcqQuesXm')}}" class="link-dark d-inline-flex text-decoration-none rounded">ক্রিয়েট এমসিকিউ এক্সাম কোয়েসচেন</a></li>
                  <li><a href="" class="link-dark d-inline-flex text-decoration-none rounded">ক্রিয়েট সিকিউ এক্সাম কোয়েসচেন</a></li>
                  <li><a href="" class="link-dark d-inline-flex text-decoration-none rounded">সকল এমসিকিউ কোয়েসচেন</a></li>
                  <li><a href="" class="link-dark d-inline-flex text-decoration-none rounded">সকল সিকিউ কোয়েসচেন</a></li>
                  <li><a href="" class="link-dark d-inline-flex text-decoration-none rounded">রিপোর্টেট কোয়েসচেন</a></li>
                </ul>
              </div>
            </li>
            <p class="bg-light p-2">কোচিং কন্টেন্ট</p>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                Home
              </button>
              <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Overview</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Updates</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Reports</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                Dashboard
              </button>
              <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Overview</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Weekly</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Monthly</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Annually</a></li>
                </ul>
              </div>
            </li>
            <p class="bg-light p-2">প্রিমিয়াম কন্টেন্ট</p>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                Orders
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <p class="bg-light p-2">অন্যান্য তথ্যাবলি</p>
            <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">রিপোর্ট প্রশ্ন</a></li>
          </ul>
        </div>
      </main>
    </div>
  </div>
  <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptionsclassroom" aria-labelledby="offcanvasWithBothOptionsclassroomLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">ক্লাস প্যানেল</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <main class="d-flex flex-nowrap">
        <div class="flex-shrink-0" style="width: 100%;">
          <ul class="list-unstyled ps-0">
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                লাইভ পরিক্ষার সময়সুচি 
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                বই পরবো
              </button>
              <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Overview</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Updates</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Reports</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                বোর্ড প্রশ্নাবলী
              </button>
              <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Overview</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Updates</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Reports</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                কিছু স্কুলের প্রশ্নাবলী
              </button>
              <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Overview</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Weekly</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Monthly</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Annually</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                অ্যাফোরট প্রশ্নাবলী
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                পরীক্ষা দিব
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                কুইজ
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                প্রাকটিস প্রবলেম 
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                হট টপিক্স
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                গুরুত্বপূর্ণ সাজেশন
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                লাইভ চ্যালেঞ্জ 
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                তোমার ফিডব্যাক
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </main>
    </div>
  </div>
  <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptionscoaching" aria-labelledby="offcanvasWithBothOptionscoachingLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">কোচিং প্যানেল</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <main class="d-flex flex-nowrap">
        <div class="flex-shrink-0" style="width: 100%;">
          <ul class="list-unstyled ps-0">
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                টেন্টিটিভ আউটলাইন
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                কোর্স ইন্সট্রাক্টর
              </button>
              <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Overview</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Updates</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Reports</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                নোট্‌স
              </button>
              <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Overview</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Updates</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Reports</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                অনলাইন এক্সাম
              </button>
              <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Overview</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Weekly</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Monthly</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Annually</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                প্রাক্টিস প্রবলেম
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                আজকের কুইজ
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                প্রাকটিস প্রবলেম 
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                গুরুত্বপূর্ণ সাজেশন
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                তোমার ফিডব্যাক
              </button>
              <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </main>
    </div>
  </div>

@endif