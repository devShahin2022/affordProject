@extends("layouts.master")
@section('title',"upload law")
@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>সুত্র আপলোড কর</h1>
            <a href="{{ route('getLaw',['status'=>0])}}"><button class="btn btn-primary">Reset</button></a>
            <a href="{{ route('getLaw',['status'=>1])}}"><button class="btn btn-danger">Restore</button></a>
              <form action="{{route('uploadLaw')}}" method="POST" >
                @csrf
                    <div class="row">
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
                </div>

                <span class=" mt-2 d-block">সুত্রটি লেখ </span>
                <textarea name="writeLaw" id="editor">{{old("writeLaw")}}</textarea>
                <span class=" mt-2 d-block">সুত্রের পরিচয়</span>
                <textarea class="w-100 form-control" rows="4" name="lawExplain" id="">{{old("lawExplain")}}</textarea>
                <span class=" mt-2 d-block">উদাহরণ লেখ</span>
                <textarea name="exampleLaw" id="editorSimilar">{{old("exampleLaw")}}</textarea>
                <button type="submit" class="btn btn-danger mt-3 w-100">Upload law</button>
            </form>
        </div>
        {{-- right panel --}}
        <div class="col-md-6">
            <h1>Previous uploaded law {{sizeof($currentData)}}</h1>
            @if (sizeof($currentData)>0)
                <p class="bg-dark text-white p-2 mt-3 mb-5">Law - {{sizeof($currentData)}}</p>
                <div class="card p-2">
                <h4 class="text-center">বই - {{$currentData[0]->subjectName}}</h4>
                <h5 class="mb-2 text-center">বিষয় -  {{$currentData[0]->chapterName}}</h5>
                @foreach ($currentData as $d)
                        <div class="accordion accordion-flush" id="accordion_{{$loop->index}}">
                            <div class="accordion-item">
                              <h2 class="accordion-header p-0 m-0" id="flush-headingOne">
                                <button class="accordion-button collapsed p-0 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne_{{$loop->index}}" aria-expanded="false" aria-controls="flush-collapseOne">
                                  <p class="d-flex align-center">সুত্র {{$loop->index + 1}} <?php echo "<span class='ms-2'>". $d->law ."</span>" ?></p>
                                </button>
                              </h2>
                              <div id="flush-collapseOne_{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordion_{{$loop->index}}">
                                <div class="accordion-body">
                                   <a href="{{route('getUpdateLaw',['id'=>$d->id])}}"><button class="btn btn-info btn-sm">Update</button></a> 
                                   <a href="{{route('lawDelete',['id'=>$d->id])}}"><button class="btn btn-danger btn-sm">delete</button></a> 
                                    <p class="text-info"><b>সুত্রের ব্যাখ্যা </b></p>
                                    <p class="d-flex align-center">
                                        <?php echo "<span>". $d->lawExplain ."</span>" ?>
                                    </p>
                                    <p class="text-info"><b>উদাহরণ </b></p>
                                    <p class="d-flex align-center">
                                        <?php echo "<span>". $d->example ."</span>" ?>
                                    </p>
                                </div>
                              </div>
                            </div>
                        </div>
                @endforeach
            </div>
            @else
                <h3>No data found!</h3>
            @endif
        </div>
    </div>
</div>

@endsection