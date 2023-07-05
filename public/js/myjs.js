try{
    _id("pushBoardNameId").innerHTML = '';
    boardName.forEach(element => {
        _id("pushBoardNameId").innerHTML += `
        <button onclick="getBoardNameData('${element.boardName}')" style="" class="btn btn-transparent btn-sm">${element.boardName}</button>
    `
    });
}catch(e){
    console.log(e);
}

try{
    let subjectName = [];
    let commonBooks = [];
    let allDeptBooks = [];
    const getDepartMentName = _id("getDepartMentName").value;
    for (let i = 0; i < SiteStaticData.length; i++) {
        if(SiteStaticData[i].departMent == getDepartMentName){
            for(let j=0; j<SiteStaticData[i].data.length; j++){
                subjectName.push(SiteStaticData[i].data[j].bookName);
            }
            break;
        }
    }
    for (let i = 0; i < SiteStaticData[SiteStaticData.length-1].data.length; i++) {
        commonBooks.push(SiteStaticData[3].data[i].bookName);
    }
    allDeptBooks = [...commonBooks, ...subjectName];
    _id("showChapterId").addEventListener("click",function(){
        _id("pushBooksNameId").innerHTML = '';
        allDeptBooks.forEach(book => {
            _id("pushBooksNameId").innerHTML += `
            <li onclick="fetchBoardData('${book}')"><a href="http://127.0.0.1:8000/premium/board-question/${book}" class="link-dark d-inline-flex text-decoration-none rounded">${book}</a></li>
            `
        });
    });

    _id("showKhutiNatiId").addEventListener("click",function(){
        _id('chapterKhutiNatiId').innerHTML = ``;
        allDeptBooks.forEach(book => {
            _id('chapterKhutiNatiId').innerHTML += `
                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">${book}</a></li>
            `;
        });
    });

    _id("showTopicsId").addEventListener("click",function(){
        _id('pushBooksId').innerHTML = ``;
        allDeptBooks.forEach(book => {
            _id('pushBooksId').innerHTML += `
                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">${book}</a></li>
            `;
        });
    });

    _id("showSchoolId").addEventListener("click",function(){
        _id('pushSchoolNameId').innerHTML = ``;
        famousSchoolName.forEach(school => {
            _id('pushSchoolNameId').innerHTML += `
                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">${school}</a></li>
            `;
        });
    });

    _id("showMcqShortCutId").addEventListener("click",function(){
        _id('pushMcqId').innerHTML = ``;
        allDeptBooks.forEach(book => {
            _id('pushMcqId').innerHTML += `
                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">${book}</a></li>
            `;
        });
    });

    // ----------------------------------
    // afford model test static data
    // ----------------------------------
    _id("showModelTestId").addEventListener("click",function(){
        _id('pushModelTestId').innerHTML = ``;
        allDeptBooks.forEach((book,index) => {
            _id('pushModelTestId').innerHTML += `
                <li>
                    <button id="" style="font-size: .8rem;" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#physicModel_${index}" aria-expanded="false">
                        ${book}
                    </button>
                    <div class="collapse ms-4" id="physicModel_${index}">
                    <ul id="" class="btn-toggle-nav list-unstyled fw-normal pb-1 small ">
                        <li class="">Model 1</li>
                        <li class="">Model 2</li>
                    </ul>
                    </div>
                </li>
            `;
        });
    });

}catch(e){
    console.log(e);
}

_id('pushYear').addEventListener('change',function(e){
    let bookName = _id('getBookName').value;
    if(_id('pushYear').value == '2018' ){
        _id("pushBoardNameId").innerHTML = `<button onclick="getBoardNameData('সকল বোর্ড')" style="" class="btn btn-transparent btn-sm">সকল বোর্ড</button>`;
    }else{
        _id("pushBoardNameId").innerHTML = '';
        boardName.forEach(element => {
            _id("pushBoardNameId").innerHTML += `
            <button onclick="getBoardNameData('${element.boardName}')" style="" class="btn btn-transparent btn-sm">${element.boardName}</button>
        `
        });
    }
    fetch(`http://127.0.0.1:8000/premium/fetch-board-question/${bookName}/${JSON.parse(e.target.value)}`)
    .then(response => response.json())
    .then(data => {
        boardData = data; // board data fetch from manage chapter js file
        getBoardNameData('দিনাজপুর বোর্ড');
        })
        .catch(error => {
            console.log('Error:', error);
        });

});


function getBoardNameData(b){
    let bookName = _id('getBookName').value;
    let mcq = []  ;  // first array mcq find;
    let cq = []  ; 
    boardData[0].forEach(element => {
        if(element.boardOrSchoolName == b){
            mcq.push(element);
        }
    });

    boardData[1].forEach(element => {
        if(element.boardOrSchoolName == b){
            cq.push(element);
        }
    });

    _id('pushMcq').innerHTML = '';
    _id('pushCqId').innerHTML = '';

    console.log(mcq);
    console.log(cq);


    _id('dynamicallyPushDataId').innerHTML = ``;

    if(mcq.length == 0){
        _id('dynamicallyPushDataId').innerHTML += `<h3> No data found! </h3>`;
    }else{
        // push dynamically mcq
        _id('dynamicallyPushDataId').innerHTML += `
            <div class="text-center mt-3 mb-4">
            <h5> ${mcq[0].boardOrSchoolName} - ${mcq[0].year}</h5>
            <p class="m-0 p-0">বহুনির্বাচনী প্রশ্ন - ${mcq.length}</p>
            <p class="m-0 p-0">বিষয় - ${bookName}</p>
            </div>
        `

        _id('pushMcq').innerHTML = '';
        let tmpdata = '';
        mcq.forEach((element,index) => {

            if(element.photo_url !=null){
                tmpdata += `<img src="${element.photo_url}" class="w-100" alt="">`
            }
            if(element.uddipak !=null){
                tmpdata += `<div>${element.uddipak}</div>`
            }
            if(element.question_type == 1){
                tmpdata += `
                
                <div>
                    <div class="d-flex">${index + 1}. <span class='ms-1'>${element.question}</span> </div>
                </div>

                <div class="row">
                    <div class="col-6 d-flex flex-wrap">(a) <span class='ms-1'>${element.option1}</span> </div>
                    <div class="col-6 d-flex flex-wrap">(b) <span class='ms-1'>${element.option2}</span></div>
                    <div class="col-6 d-flex flex-wrap">(c) <span class='ms-1'>${element.option3}</span></div>
                    <div class="col-6 d-flex flex-wrap">(d) <span class='ms-1'>${element.option4}</span></div>
                </div>
                <i class="">
                উত্তর - 
                `
                if(JSON.parse(element.answer)[0] == 1){
                    tmpdata += `a`
                }
                if(JSON.parse(element.answer)[0] == 2){
                    tmpdata += `b`
                }
                if(JSON.parse(element.answer)[0] == 3){
                    tmpdata += `c`
                }
                if(JSON.parse(element.answer)[0] == 4){
                    tmpdata += `d`
                }
                tmpdata += `</i>`

            }

            if(element.question_type ==2){
                tmpdata += `
                <div>
                    <div class="d-flex">${index + 1}. <span class='ms-1'>${element.question}</span> </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex flex-wrap">(i) <span class='ms-1'>${element.option1}</span> </div>
                    <div class="col-6 d-flex flex-wrap">(ii) <span class='ms-1'>${element.option2}</span> </div>
                    <div class="col-6 d-flex flex-wrap">(iii) <span class='ms-1'>${element.option3}</span> </div>
                </div>
                <i class="">
                উত্তর - 
                `
                for (let i = 0; i < JSON.parse(element.answer).length; i++) {
                    if(JSON.parse(element.answer).length -1 == i){
                        if(JSON.parse(element.answer)[i] == 1){
                            tmpdata += `i `
                        }
                        if(JSON.parse(element.answer)[i] == 2){
                            tmpdata += `ii `
                        }
                        if(JSON.parse(element.answer)[i] == 3){
                            tmpdata += `iii `
                        }
                    }else{
                        if(JSON.parse(element.answer)[i] == 1){
                            tmpdata += `i, `
                        }
                        if(JSON.parse(element.answer)[i] == 2){
                            tmpdata += `ii, `
                        }
                        if(JSON.parse(element.answer)[i] == 3){
                            tmpdata += `iii, `
                        }
                    } 
                }
                tmpdata += `</i>`;
            }
            if(element.explain !=null){
                tmpdata += `
                    <div class="accordion accordion-flush" id="body_id_${index}">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-explain_${index}" aria-expanded="false" aria-controls="flush-collapseOne">
                                    ব্যাখ্যা দেখতে ক্লিক কর
                                </button>
                            </h2>
                            <div id="flush-explain_${index}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#body_id_${index}">
                                <div class="accordion-body d-flex"> ${element.explain} </div>
                            </div>
                        </div>
                    </div>`
            }
            if (element.similar_question !=null){
                tmpdata += `
                    <div class="accordion accordion-flush" id="body_id_similar_${index}">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-similar${index}" aria-expanded="false" aria-controls="flush-collapseOne">
                                বেশ কিছু অনুরূপ প্রশ্ন
                            </button>
                        </h2>
                        <div id="flush-similar${index}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#body_id_similar_${index}">
                            <div class="accordion-body d-flex"> ${element.similar_question} </div>
                        </div>
                    </div>
                </div>
                `
            }

            _id('pushMcq').innerHTML += `
            <div class='col-md-6'>
                ${tmpdata}
            </div>
        `
            tmpdata = '';
        });

    }



    // push dynamically cq

    _id('cqBoardQuestionId').innerHTML = ``;
    if(cq.length == 0){
        _id('cqBoardQuestionId').innerHTML = `<h3> No data found! </h3>`;
        _id('cqNavBarId').innerHTML = ``;
        _id('pushCqId').innerHTML = '';
    }else{


        _id('cqNavBarId').innerHTML = ``;

        for (let i = 0; i < cq.length; i++) {
            
            _id('cqNavBarId').innerHTML += `<a class="mx-2" href="#id_${i}">সৃজনশীল - ${i+1}</a>`;
        }

        _id('cqBoardQuestionId').innerHTML += `
            <div class="text-center mt-3 mb-4">
            <h5> ${cq[0].boardOrSchoolName} - ${cq[0].year}</h5>
            <p class="m-0 p-0">সৃজনশীল প্রশ্ন -  ${cq.length}</p>
            <p class="m-0 p-0">বিষয় - ${bookName}</p>
            </div>
        `

        // push cq dynamically
        let tmpCqData = '';
        cq.forEach((element, index)=> {
            tmpCqData += `
                <div class="d-flex">
                <p class="me-1">${index + 1}.</p>
            `
            if(element.uddipakPhoto!=null){
                tmpCqData += `<img src="${element.uddipakPhoto}" class="w-100" alt="">`
            }
            if(element.uddipakText!=null){
                tmpCqData += `
                    <div class='d-flex flex-wrap'> ${element.uddipakText} </div>
                `
            }
            tmpCqData += `</div>`

            if (element.answerQuestion1 !=null){
                tmpCqData += `
                <div class="accordion accordion-flush" id="accordionFlushExample">
                <div style="background: #e6e6e6;"  class="accordion-item mb-1">
                        <p class="accordion-header p-1 m-0" id="flash_1_${index}">
                            <button style="background: #e6e6e6;" class="accordion-button collapsed p-1 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-1_${index}" aria-expanded="false" aria-controls="flush-collapseOne">
                                (a) <span class='ms-1' >${element.question1}</span>
                            </button>
                        </p>
                        <div id="flush-1_${index}" class="accordion-collapse collapse" aria-labelledby="flash_1_${index}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">`
                if (element.answerPhoto1 !=null){
                tmpCqData += `  <img src="${element.answerPhoto1}" class="w-100" alt="">`
                }

                tmpCqData += `<p class="d-flex flex-wrap">(a) উত্তর-  <span class='ms-1'>${element.answerQuestion1}</span> </p></div>
                            </div>
                        </div>
                    </div>`
            }else{
                tmpCqData += `
                <p class="d-flex">(a) <span class='ms-1' >${element.question1}</span> </p>
                `
            }


            if (element.answerQuestion2 !=null){
                tmpCqData += `
                <div class="accordion accordion-flush" id="accordionFlushExample">
                <div style="background: #e6e6e6;"  class="accordion-item mb-1">
                        <p class="accordion-header p-1 m-0" id="flash_2_${index}">
                            <button style="background: #e6e6e6;" class="accordion-button collapsed p-1 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-2_${index}" aria-expanded="false" aria-controls="flush-collapseOne">
                                (b) <span class='ms-1' >${element.question2}</span>
                            </button>
                        </p>
                        <div id="flush-2_${index}" class="accordion-collapse collapse" aria-labelledby="flash_2_${index}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">`

                if (element.answerPhoto2 !=null){
                    tmpCqData += `<img src="${element.answerPhoto2}" class="w-100" alt="">`
                }
                tmpCqData += `<p class="d-flex flex-wrap">(b) উত্তর-  <span class='ms-1'>${element.answerQuestion2}</span> </p></div>
                            </div>
                        </div>
                    </div>`

            }else{
                tmpCqData += `
                <p class="d-flex">(a) <span class='ms-1' >${element.question2}</span> </p>
                `
            }

            if (element.answerQuestion3 !=null){
                tmpCqData += `
                <div class="accordion accordion-flush" id="accordionFlushExample">
                <div style="background: #e6e6e6;"  class="accordion-item mb-1">
                        <p class="accordion-header p-1 m-0" id="flash_3_${index}">
                            <button style="background: #e6e6e6;" class="accordion-button collapsed p-1 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-3_${index}" aria-expanded="false" aria-controls="flush-collapseOne">
                                (c) <span class='ms-1' >${element.question3}</span>
                            </button>
                        </p>
                        <div id="flush-3_${index}" class="accordion-collapse collapse" aria-labelledby="flash_3_${index}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">`


                    if (element.answerPhoto3 !=null){
                        tmpCqData += ` <img src="${element.answerPhoto3}" class="w-100" alt="">`
                    }
                    tmpCqData += `<p class="d-flex flex-wrap">(c) উত্তর-  <span class='ms-1'>${element.answerQuestion3}</span> </p></div>
                                    </div>
                                </div>
                            </div>`
            }else{
                tmpCqData += `
                <p class="d-flex">(a) <span class='ms-1' >${element.question3}</span> </p>
                `
            }

            if (element.question4 !=null){
                if (element.answerQuestion4 !=null){
                    tmpCqData += `
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div style="background: #e6e6e6;"  class="accordion-item mb-1">
                            <p class="accordion-header p-1 m-0" id="flash_4_${index}">
                                <button style="background: #e6e6e6;" class="accordion-button collapsed p-1 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-4_${index}" aria-expanded="false" aria-controls="flush-collapseOne">
                                    (d) <span class='ms-1' >${element.question4}</span>
                                </button>
                            </p>
                            <div id="flush-4_${index}" class="accordion-collapse collapse" aria-labelledby="flash_4_${index}" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">`

                        if (element.answerPhoto4 !=null){
                            tmpCqData += `<img src="${element.answerPhoto4}" class="w-100" alt="">`
                        }
                        tmpCqData += `
                        <p class="d-flex flex-wrap">(d) উত্তর-  <span class='ms-1'>${element.answerQuestion4}</span> </p></div>
                                </div>
                            </div>
                        </div>
                        `
                }else{
                    tmpCqData += `
                    <p class="d-flex">(a) <span class='ms-1' >${element.question4}</span> </p>
                    `
                }
            }

            _id('pushCqId').innerHTML += `
                <div id="id_${index}" class='col-md-6'>${tmpCqData}</div>
            `
            tmpCqData = '';
        });

    }

}