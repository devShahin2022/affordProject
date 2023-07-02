<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>

    <div class="container">
        <button class="btn btn-primary my-5" id="downloadpdf">Download</button>
        <a href="/"><button  class="btn btn-secondary my-5" id="downloadpdf">Back homepage</button></a>
        <div class="px-3" style="font-size:13px;" id="content">
            <div class="row bg-light text-dark p-1 border-0 border-bottom">
                <div class="col-4 text-start">
                    <p class="m-0 p-0">পূর্ণমান - {{sizeof($freeExamQuestion)}}</p>
                    <p class="m-0 p-0">সময় - ২০ মিনিট</p>
                </div>
                <div class="col-4 text-center">
                    <p class="m-0 p-0">বিষয় - {{ $freeExamQuestion[0]->subjectName }}</p>
                    <p class="m-0 p-0">অধ্যায় -  {{ $freeExamQuestion[0]->chapterName }}</p>
                </div>
                <div class="col-4 text-end">
                    <p class="m-0 p-0">প্রশ্ন সেট -  {{ $freeExamQuestion[0]->question_set }}</p>
                    <p class="m-0 p-0">প্রাপ্ত নম্বর - </p>
                </div>
            </div>
            <div class="row">
                @if(sizeof($freeExamQuestion)> 0)
                    <div class="col-6">
                        @for ($i=0; $i<sizeof($freeExamQuestion)/2; $i++)
                            @if($freeExamQuestion[$i]->photo_url !=null)
                                <div>
                                    <img src="{{$freeExamQuestion[$i]->photo_url}}" class="w-100" alt="">
                                </div>
                            @endif
                            @if($freeExamQuestion[$i]->uddipak !=null)
                                <div>
                                <p>{{ $freeExamQuestion[$i]->uddipak }}</p>
                                </div>
                            @endif
                            @if ($freeExamQuestion[$i]->question_type == 1)
                                <div class="row">
                                    <p class="m-0 p-0">{{ $i + 1 }}. {{$freeExamQuestion[$i]->question}}</p>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(a) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option1."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(b) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option2."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(c) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option3."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(d) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option4."</p>"; ?> </div>
                                </div>
                            @else
                            <div class="row">
                                <p class="m-0 p-0">{{ $i + 1 }}. {{$freeExamQuestion[$i]->question}}</p>
                                <div class="col-6 d-flex"> <span class="me-2 ">(i) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option1."</p>"; ?> </div>
                                <div class="col-6 d-flex"> <span class="me-2 ">(ii) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option2."</p>"; ?> </div>
                                <div class="col-6 d-flex"> <span class="me-2 ">(iii) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option3."</p>"; ?> </div>
                            </div>
                            @endif
                        @endfor
                    </div>
                    <div class="col-6">
                        @for ($i=ceil(sizeof($freeExamQuestion)/2); $i<sizeof($freeExamQuestion); $i++)
                            @if($freeExamQuestion[$i]->photo_url !=null)
                                <div>
                                    <img src="{{$freeExamQuestion[$i]->photo_url}}" class="w-100" alt="">
                                </div>
                            @endif
                            @if($freeExamQuestion[$i]->uddipak !=null)
                                <div>
                                   <p>{{ $freeExamQuestion[$i]->uddipak }}</p>
                                </div>
                            @endif
                            @if ($freeExamQuestion[$i]->question_type == 1)
                                <div class="row">
                                    <p class="m-0 p-0">{{ $i + 1 }}. {{$freeExamQuestion[$i]->question}}</p>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(a) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option1."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(b) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option2."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(c) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option3."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(d) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option4."</p>"; ?> </div>
                                </div>
                            @else
                                <div class="row">
                                    <p class="m-0 p-0">{{ $i + 1 }}. {{$freeExamQuestion[$i]->question}}</p>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(i) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option1."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(ii) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option2."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(iii) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option3."</p>"; ?> </div>
                                </div>
                            @endif
                        @endfor
                    </div>
                @endif
            </div>
            <p class=" my-1 mt-3 bg-light text-muted" style="font-size:12px;">
                <i>The question paper generates from Afford's official website. To get each mcq explanation and more questions please visit https://www.affordPrivate.edu</i>
            </p>
        </div>
    
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="{{asset("js/printThis.js")}}"></script>
    <script>
        $(document).ready(function(){
            $('#downloadpdf').click(function(){
                $('#content').printThis();
            })
        })
    </script>
</body>
</html>