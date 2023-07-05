@extends("layouts.master")
@section('title',"upload law")
@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Update a law</h1>
                <h3 class="text-center">subject : {{$currentData->subjectName}}</h3>
                <h3 class="text-center">chpter : {{$currentData->chapterName}}</h3>


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
                            <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>বিভাগ - {{$currentData->departmentName}}</span>
                            <select name="departmentName" class="form-select pushDepartMentId" aria-label="Default select example">
            
                            </select>
                    </div>
                    <div class="col-6">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>সাবজেক্ট নাম-  {{$currentData->subjectName}}</span>
                            <select name="subjectName" class="form-select pushSubjectNameId" aria-label="Default select example">
                            </select>

                    </div>
                    <div class="col-md-6">
                        <span class=""><span style="font-size: 1.6rem" class="text-danger me-1">*</span>চেপ্টার নাম-  {{$currentData->chapterName}}</span>
                        <select name="chapterName" class="form-select pushChapterNameId" aria-label="Default select example">

                        </select>
                    </div>
                </div>

                {{-- send hidden file for backend --}}
                <input type="hidden" name="tarid" value="{{$currentData->id}}">

                <span class=" mt-2 d-block">সুত্রটি লেখ </span>
                <textarea name="writeLaw" id="editor">{{old("writeLaw")}}<?php echo "<span>". $currentData->law ."<span>" ?></textarea>
                <span class=" mt-2 d-block">সুত্রের পরিচয়</span>
                <textarea class="w-100 form-control" rows="4" name="lawExplain" id="">{{old("lawExplain")}} <?php echo "<span>". $currentData->lawExplain ."<span>" ?></textarea>
                <span class=" mt-2 d-block">উদাহরণ লেখ</span>
                <textarea name="exampleLaw" id="editorSimilar">{{old("exampleLaw")}} <?php echo "<span>". $currentData->example ."<span>" ?></textarea>
                <button type="submit" class="btn btn-danger mt-3 w-100">Upload law</button>
            </form>
        </div>
    </div>
</div>

@endsection