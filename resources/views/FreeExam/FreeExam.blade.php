@extends('layouts.master')
@section('title',"Home page")
@section('content')

  <div class="container">
    <h1 class="text-center my-2">আমাদের ফ্রি এক্সাম দিয়ে নিজেকে যাচাই করুন। </h1>
    <div id="confirmationModal" class="row">
        <div class="col-md-6">
            {{-- new visitor view --}}
            <div id="newVisitorView">
                <h4 class=" my-2 text-info">মনোযোগ দিয়ে পড়ুন</h4>
                <p class="lead">পরিক্ষার বিষয়- সাধারণ গনিত </p>
                <p class="lead">পরিক্ষার অধ্যায়- সেট </p>
                <p class="lead">পরিক্ষার ধরণ- এমসিকিউ </p>
                <p class="lead">সময়- আনলিমিটেড</p>
                <p class="lead">মার্ক- ২৫</p>
                <ul>
                    <li>
                        আপনি কত মার্ক পেয়েছেন তার ওপর ভিত্তি করে আপনার মেধা তালিকা দেয়া হবে।
                    </li>
                    <li>
                        মার্ক সমান হলে সেক্ষেত্রে যার সবচেয়ে কম সময় লাগবে তাকে অগ্রাধিকার দেয়া হবে।
                    </li>
                    <li>
                        আপনি ফ্রিতে শুধু  একটি পরীক্ষা দিতে পারবেন । আরো পরীক্ষা দিতে চাইলে আপনার প্রোফাইল এ গিয়ে অ্যাকাউন্টটি প্রিমিয়াম করে নিন।
                    </li>
                    <li>
                        আপনি যদি পরিক্ষার জন্য প্রস্তুত থাকেন তাহলে নিচের বাটনে ক্লিক করে পরীক্ষা শুরু করুন । 
                        <p class="text-danger">সতর্কতা- বাটন টি একবার ক্লিক করলেই তোমার সময় গণনা শুরু হবে । এবং উত্তর সাবমিট করা পর্যন্ত সময় গণনা করা হবে।</p>
                    </li>
                    <button onclick="freeExamCall()" class="btn btn-dark">Start Exam</button>
                </ul>
            </div>
            {{--Exam question panel --}}
            <form id="submitExam" action="#">
              <div id="pushExamQuestionMcqId" class="border p-2 my-3 d-none">
              </div>
            </form>
          {{-- push result button with form --}}
          <div class="border p-2 d-none" id="pushResultFormId">

          </div>
        </div>
        {{-- right section --}}
        <div class="col-md-6">
            <h4>পরিক্ষার ফলাফল</h4>
            <p class="lead">মোট অংশগ্রহণকারী - </p>
            <p class="lead text-center">প্রথম ১০০ জনের মার্ক</p>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
            <p class="lead">আপনার উত্তর মিলিয়ে নিন - </p>
        </div>
    </div>
  </div>

{{-- default opening modal --}}
<div class="modal fade "  id="exampleModalToggle"  aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel">গুরুত্বপূর্ণ নির্দেশনা</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4 class="text-center my-2 text-info">মনোযোগ দিয়ে পড়ুন</h4>
          <p class="lead">পরিক্ষার বিষয়- সাধারণ গনিত </p>
          <p class="lead">পরিক্ষার অধ্যায়- সেট </p>
          <p class="lead">পরিক্ষার ধরণ- এমসিকিউ </p>
          <p class="lead">সময়- আনলিমিটেড</p>
          <p class="lead">মার্ক- ২৫</p>
          
          <ul>
            <li>
                আপনি কত মার্ক পেয়েছেন তার ওপর ভিত্তি করে আপনার মেধা তালিকা দেয়া হবে।
            </li>
            <li>
                মার্ক সমান হলে সেক্ষেত্রে যার সবচেয়ে কম সময় লাগবে তাকে অগ্রাধিকার দেয়া হবে।
            </li>
            <li>
                আপনি ফ্রিতে শুধু  একটি পরীক্ষা দিতে পারবেন । আরো পরীক্ষা দিতে চাইলে আপনার প্রোফাইল এ গিয়ে অ্যাকাউন্টটি প্রিমিয়াম করে নিন।
            </li>
            <li>
                আপনি যদি পরিক্ষার জন্য প্রস্তুত থাকেন তাহলে নিচের বাটনে ক্লিক করে পরীক্ষা শুরু করুন । 
                <p class="text-danger">সতর্কতা- বাটন টি একবার ক্লিক করলেই তোমার সময় গণনা শুরু হবে । এবং উত্তর সাবমিট করা পর্যন্ত সময় গণনা করা হবে।</p>
            </li>
            <button  onclick="freeExamCall()" class="btn btn-dark">Start Exam</button>
          </ul>
        </div>
      </div>
    </div>
  </div>



{{-- alert modal --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <h3> আপনার পরীক্ষাটি সম্পন্ন হয়েছে।</h3>
        <form action="#">
            <button class="btn btn-primary w-100" type="submit">ফলাফল</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection