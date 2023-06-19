const onClickSubject = (sub_code) =>{
    document.getElementById("pushChapterId").innerHTML = '';
    document.getElementById("pushChapterId").innerHTML = `<option value='0'> select one </option>`;
    chapterData[sub_code-1].chapter.forEach((element,index) => {
        document.getElementById("pushChapterId").innerHTML += `<option value='${sub_code}_${index+1}'> ${element} </option>`;
    });
}
// its for make xm panel
const onClickSubjectMakeXm = (sub_code) =>{
    document.getElementById("pushChapterIdMakeXm").innerHTML = '';
    document.getElementById("pushChapterIdMakeXm").innerHTML = `<option value='0'> select one </option>`;
    chapterData[sub_code-1].chapter.forEach((element,index) => {
        document.getElementById("pushChapterIdMakeXm").innerHTML += `<option value='${sub_code}_${index+1}'> ${element} </option>`;
    });
}


// Automatic load call from onload functin
// const LoadInitData = () =>{
//     // dynamically push department
//     document.getElementById("pushDepartMentId").innerHTML = '';
//     document.getElementById("pushDepartMentId").innerHTML = `<option onclick='loadSubjectName(-1)' value='0'> select one </option>`;
//     SiteStaticData.forEach((element,index) => {
//         document.getElementById("pushDepartMentId").innerHTML += `<option onclick='loadSubjectName(${index})' value='${element.departMent}'> ${element.departMent} </option>`;
//     });
//     // dynamically load question category 
//     document.getElementById('pushQuesCatId').innerHTML = '';
//     document.getElementById('pushQuesCatId').innerHTML =  `<option onclick="loadBoardOrSchool(-1)" value='0'> select one </option>`;
//     questionCategory.forEach((element,index) => {
//         document.getElementById("pushQuesCatId").innerHTML += `<option onclick="loadBoardOrSchool(${index})" value='${element}'> ${element} </option>`;
//     });
// }



// class make short
function _class(d){
    return document.getElementsByClassName(d);
}


const LoadInitData = () =>{
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
