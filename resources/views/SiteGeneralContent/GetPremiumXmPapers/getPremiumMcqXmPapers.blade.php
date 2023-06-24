@extends('layouts.master')
@section('title', "add mcq")
@section('content')
    <div class="container">
        <h1 class="my-2">See your all previous exam question paper</h1>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('fail'))
                <p class="lead alert alert-danger ">{{ session('fail')}} </p>
            @endif
            @if (session('success'))
            <p class="lead alert alert-success ">{{ session('success')}} </p>
            @endif
        <div class="row mt-3">
            <div class="col-md-6">
                <h3 class="bg-primary p-2 my-2 text-light mb-3" >Current exams</h3>
                @if (sizeof($activeExams) > 0)
                <table class="table table-hover border">
                    <thead>
                        <tr>
                        <th scope="col" width="20%">Class</th>
                        <th scope="col">DepartMent</th>
                        <th scope="col">Examspaper</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td rowspan="2" width="20%" scope="row"> নবম শ্রেণী</td>
                        <td>বিজ্ঞান বিভাগ</td>
                        <td>
                            @if (is_array($activeExams[0]))
                                No exam found!
                            @else
                                <span class="badge rounded-pill text-bg-primary">sub:{{$activeExams[0]->subjectName}}</span>
                                <span class="badge rounded-pill text-bg-primary">set:{{$activeExams[0]->question_set}}</span>
                                <span class="badge rounded-pill text-bg-primary">chapter:{{$activeExams[0]->chapterName}}</span>
                                <span class="badge rounded-pill text-bg-primary">{{$activeExams[0]->whichSection}}</span>
                                <a  href="{{ route('deleteMcqExam', ['id'=>$activeExams[0]->id]) }}" >
                                    <span class="badge rounded-pill text-bg-danger">Remove</span></a>
                            @endif
                        </td>
                        </tr>
                        <tr>
                        <td>মানবিক</td>
                        <td>
                            @if (is_array($activeExams[1]))
                                No exam found!
                            @else
                                <span class="badge rounded-pill text-bg-primary">sub:{{$activeExams[1]->subjectName}}</span>
                                <span class="badge rounded-pill text-bg-primary">set:{{$activeExams[1]->question_set}}</span>
                                <span class="badge rounded-pill text-bg-primary">chapter:{{$activeExams[1]->chapterName}}</span>
                                <span class="badge rounded-pill text-bg-primary">{{$activeExams[1]->whichSection}}</span>
                                <a  href="{{ route('deleteMcqExam', ['id'=>$activeExams[1]->id]) }}" >
                                    <span class="badge rounded-pill text-bg-danger">Remove</span></a>
                            @endif
                        </td>
                        </tr>
                        <tr>
                        <td rowspan="2" width="20%" scope="row"> দশম শ্রেণী</td>
                        <td>বিজ্ঞান বিভাগ</td>
                        <td>
                            @if (is_array($activeExams[2]))
                                No exam found!
                            @else
                                <span class="badge rounded-pill text-bg-primary">sub:{{$activeExams[2]->subjectName}}</span>
                                <span class="badge rounded-pill text-bg-primary">set:{{$activeExams[2]->question_set}}</span>
                                <span class="badge rounded-pill text-bg-primary">chapter:{{$activeExams[2]->chapterName}}</span>
                                <span class="badge rounded-pill text-bg-primary">{{$activeExams[2]->whichSection}}</span>
                                <a  href="{{ route('deleteMcqExam', ['id'=>$activeExams[2]->id]) }}" >
                                    <span class="badge rounded-pill text-bg-danger">Remove</span></a>
                            @endif
                        </td>
                        </tr>
                        <tr>
                        <td>মানবিক</td>
                        <td>
                            @if (is_array($activeExams[3]))
                                No exam found!
                            @else
                                <span class="badge rounded-pill text-bg-primary">sub:{{$activeExams[3]->subjectName}}</span>
                                <span class="badge rounded-pill text-bg-primary">set:{{$activeExams[3]->question_set}}</span>
                                <span class="badge rounded-pill text-bg-primary">chapter:{{$activeExams[3]->chapterName}}</span>
                                <span class="badge rounded-pill text-bg-primary">{{$activeExams[3]->whichSection}}</span>
                                <a  href="{{ route('deleteMcqExam', ['id'=>$activeExams[3]->id]) }}" >
                                    <span class="badge rounded-pill text-bg-danger">Remove</span></a>
                            @endif
                        </td>
                        </tr>
                        <tr>
                        <td rowspan="2" width="20%" scope="row"> পরীক্ষার্থী </td>
                        <td>বিজ্ঞান বিভাগ</td>
                        <td>
                            @if (is_array($activeExams[4]))
                                No exam found!
                            @else
                                <span class="badge rounded-pill text-bg-primary">sub:{{$activeExams[4]->subjectName}}</span>
                                <span class="badge rounded-pill text-bg-primary">set:{{$activeExams[4]->question_set}}</span>
                                <span class="badge rounded-pill text-bg-primary">chapter:{{$activeExams[4]->chapterName}}</span>
                                <span class="badge rounded-pill text-bg-primary">{{$activeExams[4]->whichSection}}</span>
                                <a  href="{{ route('deleteMcqExam', ['id'=>$activeExams[4]->id]) }} ">
                                    <span class="badge rounded-pill text-bg-danger">Remove</span></a>
                            @endif
                        </td>
                        </tr>
                        <tr>
                        <td>মানবিক</td>
                        <td>
                            @if (is_array($activeExams[5]))
                                No exam found!
                            @else
                                <span class="badge rounded-pill text-bg-primary">sub:{{$activeExams[5]->subjectName}}</span>
                                <span class="badge rounded-pill text-bg-primary">set:{{$activeExams[5]->question_set}}</span>
                                <span class="badge rounded-pill text-bg-primary">chapter:{{$activeExams[5]->chapterName}}</span>
                                <span class="badge rounded-pill text-bg-primary">{{$activeExams[5]->whichSection}}</span>
                                <a  href="{{ route('deleteMcqExam', ['id'=>$activeExams[5]->id]) }}" >
                                    <span class="badge rounded-pill text-bg-danger">Remove</span></a>
                            @endif
                        </td>
                        </tr>
                    </tbody>
                    </table>
                @else
                    <h4>currently no exam found!</h4>
                @endif
            </div>
            <div class="col-md-6">



                <form action="{{route('findMcqExamQuesSet')}}" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-3 mt-2">
                            @if(isset($currentData)  && sizeof($currentData)>0)
                            <select name="departmentName" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData[0]->departmentName}}" selected> {{$currentData[0]->departmentName}} </option>
                            </select>
                            @else
                                <select name="departmentName" class="form-select pushDepartMentId" aria-label="Default select example">

                                </select>
                            @endif
                        </div>
                        <div class="col-3 mt-2">
                            @if(isset($currentData) && sizeof($currentData)>0)
                                <select name="subjectName" class="form-select" aria-label="Default select example">
                                    <option value="{{$currentData[0]->subjectName}}" selected> {{$currentData[0]->subjectName}} </option>
                                </select>
                            @else
                                <select name="subjectName" class="form-select pushSubjectNameId" aria-label="Default select example">
                                </select>
                            @endif
                        </div>
                        <div class="col-3 mt-2">
                            @if(isset($currentData) && sizeof($currentData)>0)
                            <select name="chapterName" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData[0]->chapterName}}" selected> {{$currentData[0]->chapterName}} </option>
                            </select>
                            @else
                            <select name="chapterName" class="form-select pushChapterNameId" aria-label="Default select example">
    
                            </select>
                            @endif
                        </div>
                        <div class="col-3 mt-2 d-none">
                            @if(isset($currentData) && sizeof($currentData)>0)
                                <select name="questionCat" class="form-select" aria-label="Default select example">
                                    <option value="{{$currentData[0]->questionCat}}" selected> {{$currentData[0]->questionCat}} </option>
                                </select>
                            @else
                                <select name="questionCat" class="form-select pushQuesCatId" aria-label="Default select example">
        
                                </select>
                            @endif
                        </div>
                        <div class="col-sm-3 mt-2">
                            <button type="submit" class="btn btn-primary w-100">Find data</button>
                        </div>
                        <div class="col-sm-3 mt-2">
                            <a href="{{ route('addDynamicMcqQuestionGet',['statusReset'=>1]) }}">Reset form</a>
                        </div>
                    </div>
                </form>





                <h3 class="bg-dark p-2 my-2 text-light">All questions set- @isset($totalSet)
                    {{$totalSet}}
                @endisset</h3>
                <?php $tmp =1; ?>
                @if ($currentData != null)
                    @if (sizeof($currentData)>0)
                    {{-- {{sizeof($currentData)}} --}}
                        @for ($i=1; $i<=$totalSet;$i++)
                            @for ($j=0; $j<sizeof($currentData); $j++)
                                @if ($i == $currentData[$j]->question_set)
                                    <div class="row mt-2">
                                        <p class="bg-info text-white p-2 mb-3 mt-1">Exam set : {{ $i }}</p>
                                        <div class="col-md-6">
                                            <p class="text-muted"><b>DepartMent:</b> {{ $currentData[$j]->departmentName }}</p>
                                            <p class="text-muted"><b>Exam :</b> {{ $currentData[$j]->subjectName }}</p>
                                            <p class="text-muted"><b>Chapter :</b> {{ $currentData[$j]->chapterName }}</p>
                                            <p class="text-muted"><b>Set :</b>  {{ $currentData[$j]->question_set }}</p>
                                            <p class="text-muted"><b>Total marks :</b> {{ $currentData[$j]->max_capacity }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <form action="{{route("uploadExamPapers")}}" method="POST">
                                                @csrf
                                                {{-- hidden field for uplaoding exams data --}}
                                                <input type="hidden" name="departmentName" value="{{$currentData[$j]->departmentName}}">
                                                <input type="hidden" name="subjectName" value="{{$currentData[$j]->subjectName}}">
                                                <input type="hidden" name="chapterName" value="{{$currentData[$j]->chapterName}}">
                                                <input type="hidden" name="question_set" value="{{$currentData[$j]->question_set}}">
                                                <label for="">Please type your exam title...</label>
                                                <textarea name="examTitle" id="" class="w-100 form-control my-2" rows="1"></textarea>
                                                <select name="targetClass" class="form-select mt-2" aria-label="Default select example">
                                                    <option value="0" >শ্রেণী</option>
                                                    <option  value="নবম শ্রেণী">নবম শ্রেণী</option>
                                                    <option value="দশম শ্রেণী">দশম শ্রেণী</option>
                                                    <option value="পরীক্ষার্থী">পরীক্ষার্থী</option>
                                                </select>
                                                <select name="whichSection" class="form-select mt-2" aria-label="Default select example">
                                                    <option  value="0">Select segment</option>
                                                    <option value="কোচিং">কোচিং</option>
                                                    <option value="প্রিমিয়াম অ্যাকাউন্ট">প্রিমিয়াম অ্যাকাউন্ট</option>
                                                </select>
                                                <label class="mt-2" for="">End time</label>
                                                <select name="examDeadLine" class="form-select mt-2" aria-label="Default select example">
                                                    <option  value="0">select deadline</option>
                                                    <option value="1">1 day</option>
                                                    <option value="3">3 days</option>
                                                    <option value="5">5 days</option>
                                                    <option value="7">7 days</option>
                                                </select>
                                                <button type="submit" class="btn btn-info text-white btn-sm mt-3 mb-2">Upload exam</button>
                                            </form>
                                        </div>
                                    </div>
                                    @break
                                @endif
                            @endfor
                            <div class="mb-3">
                                @isset($isBeforePub)
                                    @if (sizeof($isBeforePub)>0)
                                        @for ($k = 0; $k<sizeof($isBeforePub);$k++)
                                            @if($tmp == $isBeforePub[$k]->question_set)
                                                @if (($isBeforePub[$k]->isCurrent == 1))
                                                    <span class="badge rounded-pill text-bg-primary">active at {{$isBeforePub[$k]->whichSection}} </span>
                                                @else
                                                    <span class="badge rounded-pill text-bg-secondary">already published at {{$isBeforePub[$k]->whichSection}} </span>
                                                @endif
                                            @endif
                                        @endfor
                                    @endif
                                @endisset
                            </div>
                            <div class="col-12"><hr></div>
                            <?php $tmp++; ?>
                        @endfor
                    @else
                        <h4 class="my-3">No data found!!</h4>
                    @endif
                @else
                    <h4 class="my-3">No data found!!</h4>
                @endif
            </div>
        </div>
    </div>
@endsection