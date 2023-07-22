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
    <div class="@if (Auth::user() && Auth::user()->role == 'superadmin') container-fluid @else  container  @endif d-flex flex-wrap">
      <a class="navbar-brand" href="#"><span style="color:rgb(98, 194, 78);">AFFORT</span><small style="font-size:12px;color:rgb(98, 194, 78);" >private center</small></a>
      @if(Auth::user())
      <div>
        <button class="btn btn-sm btn-outline-primary me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptionscoaching" aria-controls="offcanvasWithBothOptionscoachingLabel">ক্লাসরুম</button>  
      </div>
      @endif
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link" aria-current="page" href="/">হোম</a>
          <a class="nav-link" aria-current="page" href="{{route('showAllQuestionAns')}}">প্রশ্ন/উত্তর </a>
          <a class="nav-link" href="{{route('showContact')}}">কন্টাক্ট-আস</a> 
          <a class="nav-link" aria-current="page" href="{{route("showFreeExam")}}">ফ্রি-এক্সাম</a>
          <a class="nav-link" aria-current="page"  href="{{ route('showAboutUsPage') }}">আমাদের সম্পর্কে</a>
          <a class="nav-link" aria-current="page"  href="{{ route('showCourseOutline') }}">আউটলাইন</a>
          <a class="nav-link" aria-current="page"  href="{{route("showFaqs")}}">সাধারণ প্রশ্ন-উত্তর</a>
          <a class="nav-link" aria-current="page"  href="{{route("getLeaderBoardData")}}">লিডারবোর্ড</a>
          @if (Auth::user())
            <a class="nav-link" href="{{route('showProfile')}}">প্রোফাইল</a>
          @endif
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
          <button class="btn btn-sm btn-danger me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptionsLabel">Content-setting</button>
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
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                প্রশ্ন উত্তর
              </button>
              <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="{{ route('addBoardMcqView', ['statusReset'=> 0 ]) }}" class="link-dark d-inline-flex text-decoration-none rounded">এমসিকিউ অ্যাড কর</a></li>
                  <li><a href="{{route('getCq', ['statusReset'=>0])}}" class="link-dark d-inline-flex text-decoration-none rounded">সিকিউ অ্যাড কর</a></li>
                  <li><a href="{{route('showMakeMcqQuesXm',['statusReset'=>0])}}" class="link-dark d-inline-flex text-decoration-none rounded">ক্রিয়েট এমসিকিউ এক্সাম কোয়েসচেন</a></li>
                  <li><a href="{{ route('cqExamQuestionView',['statusReset'=>0]) }}" class="link-dark d-inline-flex text-decoration-none rounded">ক্রিয়েট সিকিউ এক্সাম কোয়েসচেন</a></li>
                  <li><a href="{{ route('getAllMcq') }}" class="link-dark d-inline-flex text-decoration-none rounded">সকল এমসিকিউ কোয়েসচেন</a></li>
                  <li><a href="{{ route('getAllCq') }}" class="link-dark d-inline-flex text-decoration-none rounded">সকল সিকিউ কোয়েসচেন</a></li>
                  <li><a href="{{ route('addDynamicMcqQuestionGet',['statusReset'=>0]) }}" class="link-dark d-inline-flex text-decoration-none rounded">ডাইনামিক এমসিকিউ এক্সাম কোয়েসচেন সেট</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">ডাইনামিক সিকিউ এক্সাম কোয়েসচেন সেট</a></li>
                  <li><a href="{{ route('repotedMcq') }}" class="link-dark d-inline-flex text-decoration-none rounded">রিপোর্টেট কোয়েসচেন</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#allLaw" aria-expanded="false">
                সকল সুত্র প্যানেল
              </button>
              <div class="collapse" id="allLaw">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="{{ route('getLaw',['status'=>1])}}" class="link-dark d-inline-flex text-decoration-none rounded">সুত্র আপলোড</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">সকল সুত্র</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#chaptererKhutiNati" aria-expanded="false">
                চেপ্টারের খুটিনাটি সমাধান প্যানেল
              </button>
              <div class="collapse" id="chaptererKhutiNati">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li>
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#chaptererKhutiNati_submenu" aria-expanded="false">
                    খুটিনাটি সমাধান
                    </button>
                  <div class="collapse" id="chaptererKhutiNati_submenu">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                      <li><a  href="{{ route('uploadQuestionTypeGet',['status'=>1]) }}" class="link-dark d-inline-flex text-decoration-none rounded">প্রশ্ন ক্যাটেগরি আপলোড</a></li>
                      <li><a  href="{{ route('kajOonusiloni',['status'=>1]) }}" class="link-dark d-inline-flex text-decoration-none rounded">কাজ ও সাধারণ প্রশ্ন সমাধান</a></li>
                    </ul>
                  </div>
                </li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">বাংলা ২য়</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">ইংরেজি ১ম</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">ইংরেজি ২য়</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">সকল খুটিনাটি</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#topicsPorasona" aria-expanded="false">
                টপিকস ভিত্তিক পড়াশোনা ও নোটস প্যানেল
              </button>
              <div class="collapse" id="topicsPorasona">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">আপলোড পড়াশোনা</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">বাংলা ২য়</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">ইংরেজি ১ম</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">ইংরেজি ২য়</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">সকল পড়াশোনা</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#mcqBisleson" aria-expanded="false">
              এম সি কিউ বিশ্লেষণ প্যানেল
              </button>
              <div class="collapse" id="mcqBisleson">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">আপলোড পড়াশোনা</a></li>
                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">সকল বিশ্লেষণ</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </main>
    </div>
  </div>
  @endif
  @if (Auth::user())
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptionscoaching" aria-labelledby="offcanvasWithBothOptionscoachingLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">ক্লাসরুম</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <main class="d-flex overflow-auto">
          <div class="flex-shrink-0" style="width: 100%;">
            <ul class="list-unstyled ps-0">
              <li class="mb-1">
                {{-- hidden file for dynamically data load --}}
                <input id="getDepartMentName" type="hidden" value="{{Auth::user()->departmentName}}">
                <button id="showChapterId" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#boardQuestion" aria-expanded="false">
                  বোর্ড প্রশ্ন
                </button>
                <div class="collapse" id="boardQuestion">
                  <ul id="pushBooksNameId" class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    
                  </ul>
                </div>
              </li>
              <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#allLaw" aria-expanded="false">
                  সকল সুত্র
                </button>
                <div class="collapse" id="allLaw">
                  <ul id="pushLawSubjectName" class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    
                  </ul>
                </div>
              </li>
              <li class="mb-1">
                <button id="showKhutiNatiId" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#typemathsol" aria-expanded="false">
                  চেপ্টারের খুটিনাটি সমাধান
                </button>
                <div class="collapse" id="typemathsol">
                  <ul id="chapterKhutiNatiId" class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

                  </ul>
                </div>
              </li>
              <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#targetedExam" aria-expanded="false">
                  অনলাইন এক্সাম
                </button>
                <div class="collapse" id="targetedExam">
                  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a  href="#" class="link-dark d-inline-flex text-decoration-none rounded">এক্সাম রুটিন</a></li>
                    <li><a  href="{{ route('PremiumExamPanelView',["className"=>"নবম শ্রেণী"]) }}" class="link-dark d-inline-flex text-decoration-none rounded">নবম শ্রেণি</a></li>
                    <li><a  href="{{ route('PremiumExamPanelView',["className"=>"দশম শ্রেণী"]) }}" class="link-dark d-inline-flex text-decoration-none rounded">দশম শ্রেণি</a></li>
                    <li><a  href="{{ route('PremiumExamPanelView',["className"=>"পরীক্ষার্থী"]) }}" class="link-dark d-inline-flex text-decoration-none rounded">পরীক্ষার্থী</a></li>
                  </ul>
                </div>
              </li>
              <li class="mb-1">
                <button id="showTopicsId" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#topicsRead" aria-expanded="false">
                  টপিকস ভিত্তিক পড়াশোনা ও নোটস
                </button>
                <div class="collapse" id="topicsRead">
                  <ul id="pushBooksId" class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  </ul>
                </div>
              </li>
              <li class="mb-1">
                <button id="showSchoolId" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                  স্কুলের প্রশ্ন সমাধান
                </button>
                <div class="collapse" id="orders-collapse">
                  <ul id="pushSchoolNameId" class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

                  </ul>
                </div>
              </li>
              
              <li class="mb-1">
                <button id="showMcqShortCutId" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#mcqSpecial" aria-expanded="false">
                  এম সি কিউ বিশ্লেষণ ও সর্টকার্ট 
                </button>
                <div class="collapse" id="mcqSpecial">
                  <ul id="pushMcqId" class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

                  </ul>
                </div>
              </li>
              <button class="btn btn-primary w-100 mt-3" data-bs-toggle="collapse" data-bs-target="#customExam" aria-expanded="false">
                ইচ্ছেমতো পরীক্ষা দিব
              </button>
            </ul>
          </div>
        </main>
      </div>
    </div>
  @endif
