let boardData = '';


// class make short
function _class(d){
    return document.getElementsByClassName(d);
}

function _id(d){
    return document.getElementById(d);
}




const LoadInitData = () =>{

    try{
        let bookName = _id('getBookName').value;
        fetch(`http://127.0.0.1:8000/premium/fetch-board-question/${bookName}/2022`)
        .then(response => response.json())
        .then(data => {
            boardData = data;
            })
            .catch(error => {
                console.log('Error:', error);
            });
    }catch(e){
        console.log(e);
    }

// dynamically push department
    for (let i = 0; i < 2; i++) {
        _class("pushDepartMentId")[i].innerHTML = '';
        _class("pushDepartMentId")[i].innerHTML = `<option onclick='loadSubjectName(-1)' value='0'> select one </option>`;
        SiteStaticData.forEach((element,index) => {
            _class("pushDepartMentId")[i].innerHTML += `<option onclick='loadSubjectName(${index})' value='${element.departMent}'> ${element.departMent} </option>`;
        });
        // dynamically load question category 
        _class('pushQuesCatId')[i].innerHTML = '';
        _class('pushQuesCatId')[i].innerHTML =  `<option onclick="loadBoardOrSchool(-1)" value='0'> select one </option>`;
        questionCategory.forEach((element,index) => {
            _class("pushQuesCatId")[i].innerHTML += `<option onclick="loadBoardOrSchool(${index})" value='${element}'> ${element} </option>`;
        });
    }
}

// Load subject name
function loadSubjectName (i){
    for (let start = 0; start < 2; start++) {
        if(i == -1){
            _class('pushChapterNameId')[start].innerHTML = '';
            _class('pushChapterNameId')[start].innerHTML =  `<option value='0'> select one </option>`;
            _class('pushSubjectNameId')[start].innerHTML = '';
            _class('pushSubjectNameId')[start].innerHTML =  `<option onclick="loadChapter(-1,0)" value='0'> select one </option>`;
        }else{
            _class('pushSubjectNameId')[start].innerHTML = '';
            _class('pushSubjectNameId')[start].innerHTML =  `<option onclick="loadChapter(-1,0)" value='0'> select one </option>`;
            SiteStaticData[i].data.forEach((element,index) => {
                _class("pushSubjectNameId")[start].innerHTML += `<option onclick="loadChapter(${i},${index})" value='${element.bookName}'> ${element.bookName} </option>`;
            });
        }
    }
}



// load chapter
function loadChapter (dept, subjectIndex){
    for (let start = 0; start < 2; start++) {
    if(dept == -1){
        _class('pushChapterNameId')[start].innerHTML = '';
        _class('pushChapterNameId')[start].innerHTML =  `<option value='0'> select one </option>`;
    }else{
        _class('pushChapterNameId')[start].innerHTML = '';
        _class('pushChapterNameId')[start].innerHTML =  `<option value='0'> select one </option>`;
        SiteStaticData[dept].data[subjectIndex].chapter.forEach((element,index) => {
            _class("pushChapterNameId")[start].innerHTML += `<option value='${element}'> ${element} </option>`;
        });
    }
    }

}
// load board or school name
function loadBoardOrSchool(i){
    for (let start = 0; start < 2; start++) {
    if(i == -1 || i== 2){
        _class('pushYearId')[start].innerHTML = '';
        _class('pushYearId')[start].innerHTML =  `<option value='0'> select one </option>`;
        _class('pushYearId')[start].innerHTML = '';
        _class('pushYearId')[start].innerHTML =  `<option value='0'> select one </option>`;
        _class('pushBoardOrSchoolId')[start].innerHTML = '';
        _class('pushBoardOrSchoolId')[start].innerHTML =  `<option value='0'> select one </option>`;
    }
    if(i==0){
        _class('pushBoardOrSchoolId')[start].innerHTML = '';
        _class('pushBoardOrSchoolId')[start].innerHTML =  `<option onclick="loadYear(-1)" value='0'> select one </option>`;
        boardName.forEach((element,index) => {
            _class("pushBoardOrSchoolId")[start].innerHTML += `<option onclick="loadYear(${index})" value='${element.boardName}'> ${element.boardName} </option>`;
        });
    }if(i==1){
        _class('pushYearId')[start].innerHTML = '';
        _class('pushYearId')[start].innerHTML =  `<option value='0'> select one </option>`;
        _class('pushBoardOrSchoolId')[start].innerHTML = '';
        _class('pushBoardOrSchoolId')[start].innerHTML =  `<option value='0'> select one </option>`;
        famousSchoolName.forEach((element,index) => {
            _class("pushBoardOrSchoolId")[start].innerHTML += `<option value='${element}'> ${element} </option>`;
        });
    }
    }

}

// load year
function loadYear(i){
    for (let start = 0; start < 2; start++) {
    if(i == -1){
        _class('pushYearId')[start].innerHTML = '';
        _class('pushYearId')[start].innerHTML =  `<option value='0'> select one </option>`;
    }else{
        _class('pushYearId')[start].innerHTML = '';
        _class('pushYearId')[start].innerHTML =  `<option value='0'> select one </option>`;
        boardName[i].boardYear.forEach((element,index) => {
            _class("pushYearId")[start].innerHTML += `<option value='${element}'> ${element} </option>`;
        });
    }
    }
}

try{
    _id("pushLawSubjectName").innerHTML = ``;
    SiteStaticData[0].data.forEach((element,index) => {
        if(element.bookName == 'পদার্থবিজ্ঞান' || element.bookName == 'রসায়ন' || element.bookName == 'সাধারণ গণিত'){
            _id("pushLawSubjectName").innerHTML += `
            <li onclick="loadDataChapter('${element.bookName}')" ><a  href="/premium/law/${element.bookName}/${SiteStaticData[0].data[index].chapter[0]}" class="link-dark d-inline-flex text-decoration-none rounded">${element.bookName}</a></li>
            `
        }
    });
}catch(e){

}

// load chapter name
    try{
        let subjectName = _id("getSubjectName").value;
        for (let i = 0; i <  SiteStaticData[0].data.length; i++) {
            if(SiteStaticData[0].data[i].bookName == subjectName){
                for (let j = 0; j < SiteStaticData[0].data[i].chapter.length; j++) {
                    _id("pushChapterName").innerHTML += ` <button onclick="fetchData('${SiteStaticData[0].data[i].chapter[j]}')" class="btn btn-transparent btn-sm"> ${SiteStaticData[0].data[i].chapter[j]} </button>`;
                }
                break;
            } 
        }
    }catch(e){

    }

function fetchData(chapter){
    let subjectName = _id("getSubjectName").value;
        fetch(`http://127.0.0.1:8000/premium/fetch-law-data-json/${subjectName}/${chapter}`)
        .then(response => response.json())
        .then(data => {
            if(data.length == 0){
                _id("pushLawInfo").innerHTML = `
                    <div class="card p-2">
                     <h4 class="text-center">বই - ${subjectName}</h4>
                     <h5 class="mb-2 text-center">বিষয় -  ${chapter}</h5>
                     <h3 class='mt-4'>No data found!</h3>
                    </div>
                    
                `
            }else{
                _id("pushLawInfo").innerHTML = ``;
                _id("pushLawInfo").innerHTML = `
                    <div class="card p-2 mb-4">
                     <h4 class="text-center">বই - ${subjectName}</h4>
                     <h5 class="mb-2 text-center">বিষয় -  ${chapter}</h5>
                    </div>
                    
                `
                data.forEach((element,index) => {
                    _id("pushLawInfo").innerHTML += `
                    
                        <div class="accordion accordion-flush" id="accordion_${index}">
                            <div class="accordion-item">
                              <h2 class="accordion-header p-0 m-0" id="flush-headingOne">
                                <button class="accordion-button collapsed p-0 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne_${index}" aria-expanded="false" aria-controls="flush-collapseOne">
                                  <p class="d-flex align-center"><span class='me-2'>সুত্র-</span> ${index + 1}  ${element.law} </p>
                                </button>
                              </h2>
                              <div id="flush-collapseOne_${index}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordion_${index}">
                                <div class="accordion-body">
                                    <p class="text-info"><b>সুত্রের ব্যাখ্যা </b></p>
                                    <p class="d-flex align-center">
                                         ${element.lawExplain}
                                    </p>
                                    <p class="text-info"><b>উদাহরণ </b></p>
                                    <p class="d-flex align-center">
                                         ${element.example}
                                    </p>
                                </div>
                              </div>
                            </div>
                        </div>
                    
                    `
                });
            }
            })
            .catch(error => {
                console.log('Error:', error);
            });
}
