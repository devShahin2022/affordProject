@extends('layouts.master')
@section("title","add question type")
@section("content")
    <div class="container">
        <h1>Uplaod কাজ অথবা সাধারন প্রশ্ন</h1>
        <div class="row">
            <div class="col-md-5 mb-3">
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
                <a href="{{ route('uploadQuestionTypeGet',['status'=>0]) }}"><button class="btn btn-outline-secondary my-2">Reset form</button></a>
                <a href="{{ route('uploadQuestionTypeGet',['status'=>1]) }}"><button class="btn btn-transparent my-2">Restore</button></a>
               <form method="POST" action="{{route('storeCat')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                                <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>বিভাগ</span>
                            @if(isset($currentData[0]))
                                <select name="departmentName" class="form-select" aria-label="Default select example">
                                    <option value="{{$currentData[0]->departmentName}}" selected> {{$currentData[0]->departmentName}} </option>
                                </select>
                            @else
                                <select name="departmentName" class="form-select pushDepartMentId" aria-label="Default select example">
    
                                </select>
                            @endif
                        </div>
                        <div class="col-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাবজেক্ট নাম</span>
                            @if(isset($currentData[0]))
                                <select name="subjectName" class="form-select" aria-label="Default select example">
                                    <option value="{{$currentData[0]->subjectName}}" selected> {{$currentData[0]->subjectName}} </option>
                                </select>
                            @else
                                <select name="subjectName" class="form-select pushSubjectNameId" aria-label="Default select example">
                                </select>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>চেপ্টার নাম</span>
                            @if(isset($currentData) && sizeof($currentData)>0)
                            <select name="chapterName" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData[0]->chapterName}}" selected> {{$currentData[0]->chapterName}} </option>
                            </select>
                            @else
                            <select name="chapterName" class="form-select pushChapterNameId" aria-label="Default select example">
    
                            </select>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>টাইপ</span>
                            @if(isset($currentData) && sizeof($currentData)>0)
                            <select name="type" class="form-select" aria-label="Default select example">
                                <option value="{{$currentData[0]->type}}" selected> {{$currentData[0]->type}} </option>
                            </select>
                            @else
                            <select name="type" class="form-select" aria-label="Default select example">
                                <option value="কাজ">কাজ</option>
                                <option value="সাধারণ প্রশ্ন">সাধারণ প্রশ্ন</option>
                            </select>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1"></span>অনুশীলনী</span>
                            <input name="onusiloni" type="text" class="form-control my-1">
                        </div>

                        <div class="col-md-6">
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1"></span>কাজ নং</span>
                            <input name="kajNo" type="text" class="form-control my-1">
                        </div>
                    </div>
                    {{-- here start question information --}}
                   <hr>
                    <p class="lead"> Information </p>
                   <hr>
                    <div>
                        <span class=" mt-2 d-block">Question</span>
                        <span class=" mt-2 d-block">If image?</span>
                        <input value="{{old('questionImage')}}" name="questionImage" type="file" class="form-control">
                        <textarea value="{{old('typeQuestion')}}" name="typeQuestion" id="editor"></textarea>
                        <span class=" mt-2 d-block">Answer</span>
                        <span class=" mt-2 d-block">If image?</span>
                        <input name="answerImage" type="file" class="form-control">
                        <textarea value="{{old('typeAnswer')}}" name="typeAnswer" id="editorSimilar"></textarea>
                        <span class=" mt-2 d-block">Just write answer</span>
                        <input value="{{old('justAnswer')}}" name="justAnswer" type="text" class="form-control">
                        <button type="submit" class="btn btn-danger mt-3 w-100">Add Question Type</button>
                    </div>
                </form>
            </div>
            {{-- right panel --}}
            <div class="col-md-7">
                <h2>Uploaded Information</h2>
                
                {{-- data --}}
                <div class="card p-1 mt-2">
                    @if (sizeof($currentData)>0)
                    <h4 class="text-center">{{ $currentData[0]->subjectName }}</h4>
                    <p class="text-center mb-3">{{ $currentData[0]->chapterName }}</p>
                    @for ($i=0; $i<$currentData[0]->cat_no; $i++)
                        @foreach ($currentData as $d)
                            @if ($d->cat_no == ($i+1))
                            <h5 class="text-info"># {{$i+1}} {{$d->quesTypeTitle}}</h5>  
                            @break
                            @endif
                        @endforeach
                        <?php  $serial = 1; ?>
                        @foreach ($currentData as $d)
                            @if ($d->cat_no == ($i+1))
                                @if ( $serial == 1)
                                <div>
                                    <a href="{{ route('deleteType', ['id'=>$d->id]) }}"><span class="badge text-bg-danger">Delete</span></a>
                                    <div class="d-flex">
                                        <p class="">{{$serial}}- <?php echo "<span class='me-2'>". $d->question ."</span>" ?></p>
                                    </div>
                                    <div class="flex">
                                        <p class="">Answer : <?php echo "<span class='me-2'>". $d->answer ."</span>" ?></p>
                                    </div>
                                    <p class="lead">Some similar question</p>
                                @else
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item my-1">
                                      <h2 class="accordion-header p-0 m-0" id="headingOnecollapseOne_{{$i}}_{{$loop->index}}">
                                        <button class="accordion-button m-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_{{$i}}_{{$loop->index}}" aria-expanded="true" aria-controls="collapseOne">
                                            <div class="d-flex">
                                                {{$serial}}- <?php echo "<span class='me-1'>". $d->question ."</span>" ?> <i>[ANS: <?php echo "<span>". $d->justAnswer ."<span>" ?>]</i>
                                            </div>
                                        </button>
                                      </h2>
                                      <div id="collapseOne_{{$i}}_{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="headingOnecollapseOne_{{$i}}_{{$loop->index}}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div>
                                                <a href="{{ route('deleteType', ['id'=>$d->id]) }}"><span class="badge text-bg-danger">Delete</span></a>
                                            </div>
                                            <?php echo "<span>". $d->answer ."</span>" ?>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endif
                                <?php  $serial++; ?>
                            @endif
                        @endforeach
                    @endfor
                    @else
                        <p class="my-4 mb-2">No data found!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection