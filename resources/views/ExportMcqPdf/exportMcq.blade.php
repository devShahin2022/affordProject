<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kablammo&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <?php 
        if(sizeof($premiumCqQuestion) > 0){
           $hour = floor((sizeof($premiumCqQuestion)-1)*30/60);
           $min = ((sizeof($premiumCqQuestion)-1)*30%60) + sizeof($freeExamQuestion) ;
           $fullMark = (sizeof($premiumCqQuestion)-1)*10 + sizeof($freeExamQuestion);
        }else{
            $fullMark = sizeof($freeExamQuestion);
            $hour = 0;
            $min = sizeof($freeExamQuestion) ;
        }
    ?>
    <div class="container">
        <button class="btn btn-primary my-5" id="downloadpdf">Download</button>
        <a href="/"><button  class="btn btn-secondary my-5" id="downloadpdf">Back homepage</button></a>
        <div class="px-3" style="font-size:11px;" id="content">
            <div class="row bg-light text-dark p-1 border-0 border-bottom">
                <div class="col-4 text-start">
                    <p style="font-family: 'Kablammo', cursive; font-size:18px" class="m-0 p-0">SHAHINeduCare</p>
                    <p class="m-0 p-0">নামঃ_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ রোলঃ_ _ _ _</p>
                </div>
                <div class="col-3 text-start">
                    <p class="m-0 p-0">পূর্ণমান - {{$fullMark}}</p>
                    <p class="m-0 p-0">সময় - {{$hour}} ঘণ্টা {{$min}} মিনিট</p>
                </div>
                <div class="col-3 text-center">
                    <p class="m-0 p-0">বিষয় - {{ $freeExamQuestion[0]->subjectName }}</p>
                    <p class="m-0 p-0">অধ্যায় -  {{ $freeExamQuestion[0]->chapterName }}</p>
                </div>
                <div class="col-2 text-end">
                    <p class="m-0 p-0">প্রশ্ন সেট -  {{ $freeExamQuestion[0]->question_set }}</p>
                    <p class="m-0 p-0">প্রাপ্ত নম্বর - </p>
                </div>
            </div>

            <div class="row">
                @if(sizeof($premiumCqQuestion)>0)
                    <p class="lead">নিম্নের যেকোনো {{ sizeof($premiumCqQuestion)-1 }} টি প্রশ্নের উত্তর দাও । প্রত্যেক প্রশ্নের মান ১০</p>
                    @foreach ($premiumCqQuestion as $cq)
                        @if (($loop->index +1) == sizeof($premiumCqQuestion) && $loop->index % 2 == 0 )
                        <span style="font-weight: bold "  class="bg-dark text-white"> সৃজনশীল- {{ $loop->index + 1 }}</span><br>
                                <div class="col-12 d-flex">
                                    <div>
                                        @if (isset($cq->uddipakPhoto))
                                        <img src="{{$cq->uddipakPhoto}}" class="w-100" style="height:120px;" alt="">
                                        @endif
                                        @if (isset($cq->uddipakText))
                                        <div class="d-flex">
                                            <p>   <?php echo '<span>'. $cq->uddipakText .'</span>'; ?> </p>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="">
                                        <div class="d-flex">
                                            <p>(ক) <?php echo '<span>'. $cq->question1 .'</span>'; ?> </p>
                                        </div>
                                        <div class="d-flex">
                                            <p>(খ) <?php echo '<span>'. $cq->question2 .'</span>'; ?> </p>
                                        </div>
                                        <div class="d-flex">
                                            <p>(গ) <?php echo '<span>'. $cq->question3 .'</span>'; ?> </p>
                                        </div>
                                        @if ($cq->question4)
                                        <div class="d-flex">
                                            <p>(ঘ) <?php echo '<span>'. $cq->question4 .'</span>'; ?> </p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                        @else
                            <div class="col-6" style="font-size: 10px;">
                                <span style="font-weight: bold "  class="bg-dark text-white"> সৃজনশীল- {{ $loop->index + 1 }}</span><br>
                                @if (isset($cq->uddipakPhoto))
                                <img src="{{$cq->uddipakPhoto}}" class="w-50" style="height:120px;" alt="">
                                @endif
                                @if (isset($cq->uddipakText))
                                <div class="d-flex">
                                    <p>   <?php echo '<span>'. $cq->uddipakText .'</span>'; ?> </p>
                                </div>
                                @endif
                                <div class="d-flex">
                                    <p>(ক) <?php echo '<span>'. $cq->question1 .'</span>'; ?> </p>
                                </div>
                                <div class="d-flex">
                                    <p>(খ) <?php echo '<span>'. $cq->question2 .'</span>'; ?> </p>
                                </div>
                                <div class="d-flex">
                                    <p>(গ) <?php echo '<span>'. $cq->question3 .'</span>'; ?> </p>
                                </div>
                                @if ($cq->question4)
                                <div class="d-flex">
                                    <p>(ঘ) <?php echo '<span>'. $cq->question4 .'</span>'; ?> </p>
                                </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                    <hr class="my-1">
                @endif
                @if(sizeof($freeExamQuestion)> 0)
                    <div class="col-6">
                        @for ($i=0; $i<(sizeof($freeExamQuestion)/2)+1; $i++)
                            @if($freeExamQuestion[$i]->photo_url !=null)
                                <div>
                                    <img src="{{$freeExamQuestion[$i]->photo_url}}" style="width:50%;" alt="">
                                </div>
                            @endif
                            @if($freeExamQuestion[$i]->uddipak !=null)
                                <div class="d-flex">
                                    <?php echo "<span class='ms-2 '>".$freeExamQuestion[$i]->uddipak."</span>" ?>
                                </div>
                            @endif
                            @if ($freeExamQuestion[$i]->question_type == 1)
                                <div class="row">
                                    <div class="d-flex">
                                        <p class="m-0 p-0">{{ $i + 1 }}. <?php echo "<span>".$freeExamQuestion[$i]->question."</span>" ?></p>
                                    </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(a) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option1."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(b) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option2."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(c) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option3."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(d) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option4."</p>"; ?> </div>
                                </div>
                            @else
                            <div class="row">
                                <div class="d-flex">
                                    <p class="m-0 p-0">{{ $i + 1 }}. <?php echo "<span>".$freeExamQuestion[$i]->question."</span>" ?></p>
                                </div>
                                <div class="col-6 d-flex"> <span class="me-2 ">(i) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option1."</p>"; ?> </div>
                                <div class="col-6 d-flex"> <span class="me-2 ">(ii) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option2."</p>"; ?> </div>
                                <div class="col-6 d-flex"> <span class="me-2 ">(iii) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option3."</p>"; ?> </div>
                            </div>
                            @endif
                        @endfor
                    </div>
                    <div class="col-6">
                        @for ($i=(sizeof($freeExamQuestion)/2)+1; $i<sizeof($freeExamQuestion); $i++)
                            @if($freeExamQuestion[$i]->photo_url !=null)
                                <div>
                                    <img src="{{$freeExamQuestion[$i]->photo_url}}"  style="width:50%;"  alt="">
                                </div>
                            @endif
                            @if($freeExamQuestion[$i]->uddipak !=null)
                                <div>
                                    <?php echo "<span class='ms-2 '>".$freeExamQuestion[$i]->uddipak."</span>" ?>
                                </div>
                            @endif
                            @if ($freeExamQuestion[$i]->question_type == 1)
                                <div class="row">
                                    <div class="d-flex">
                                        <p class="m-0 p-0">{{ $i + 1 }}. <?php echo "<span>".$freeExamQuestion[$i]->question."</span>" ?></p>
                                    </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(a) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option1."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(b) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option2."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(c) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option3."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(d) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option4."</p>"; ?> </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="d-flex">
                                        <p class="m-0 p-0">{{ $i + 1 }}. <?php echo "<span>".$freeExamQuestion[$i]->question."</span>" ?></p>
                                    </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(i) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option1."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(ii) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option2."</p>"; ?> </div>
                                    <div class="col-6 d-flex"> <span class="me-2 ">(iii) </span> <?php echo "<p class='m-0 p-0'> ".$freeExamQuestion[$i]->option3."</p>"; ?> </div>
                                </div>
                            @endif
                        @endfor
                    </div>
                @endif
            </div>
            <p class=" my-1 mt-3 bg-light text-muted" style="font-size:10px;">
                <i>The question paper generates from Afford's official website. To get each mcq explanation and more questions please visit https://quarrelsome-taste.000webhostapp.com </i>
                 ||  <i> Website maintenance & developed by-<b>Md Shahin Alam</b>(a full-stack web & mobile app developer)</i>
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