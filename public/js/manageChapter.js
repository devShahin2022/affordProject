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
const LoadInitData = () =>{
    // dynamically push department
    document.getElementById("pushDepartMentId").innerHTML = '';
    document.getElementById("pushDepartMentId").innerHTML = `<option onclick='loadSubjectName(-1)' value='0'> select one </option>`;
    SiteStaticData.forEach((element,index) => {
        document.getElementById("pushDepartMentId").innerHTML += `<option onclick='loadSubjectName(${index})' value='${element.departMent}'> ${element.departMent} </option>`;
    });
    // dynamically load question category 
    document.getElementById('pushQuesCatId').innerHTML = '';
    document.getElementById('pushQuesCatId').innerHTML =  `<option onclick="loadBoardOrSchool(-1)" value='0'> select one </option>`;
    questionCategory.forEach((element,index) => {
        document.getElementById("pushQuesCatId").innerHTML += `<option onclick="loadBoardOrSchool(${index})" value='${element}'> ${element} </option>`;
    });
}

// Load subject name
function loadSubjectName (i){
    if(i == -1){
        document.getElementById('pushChapterNameId').innerHTML = '';
        document.getElementById('pushChapterNameId').innerHTML =  `<option value='0'> select one </option>`;
        document.getElementById('pushSubjectNameId').innerHTML = '';
        document.getElementById('pushSubjectNameId').innerHTML =  `<option onclick="loadChapter(-1,0)" value='0'> select one </option>`;
    }else{
        document.getElementById('pushSubjectNameId').innerHTML = '';
        document.getElementById('pushSubjectNameId').innerHTML =  `<option onclick="loadChapter(-1,0)" value='0'> select one </option>`;
        SiteStaticData[i].data.forEach((element,index) => {
            document.getElementById("pushSubjectNameId").innerHTML += `<option onclick="loadChapter(${i},${index})" value='${element.bookName}'> ${element.bookName} </option>`;
        });
    }
}

// load chapter
function loadChapter (dept, subjectIndex){
    if(dept == -1){
        document.getElementById('pushChapterNameId').innerHTML = '';
        document.getElementById('pushChapterNameId').innerHTML =  `<option value='0'> select one </option>`;
    }else{
        document.getElementById('pushChapterNameId').innerHTML = '';
        document.getElementById('pushChapterNameId').innerHTML =  `<option value='0'> select one </option>`;
        SiteStaticData[dept].data[subjectIndex].chapter.forEach((element,index) => {
            document.getElementById("pushChapterNameId").innerHTML += `<option value='${element}'> ${element} </option>`;
        });
    }
}
// load board or school name
function loadBoardOrSchool(i){
    if(i == -1 || i== 2){
        document.getElementById('pushYearId').innerHTML = '';
        document.getElementById('pushYearId').innerHTML =  `<option value='0'> select one </option>`;
        document.getElementById('pushBoardOrSchoolId').innerHTML = '';
        document.getElementById('pushBoardOrSchoolId').innerHTML =  `<option value='0'> select one </option>`;
    }
    if(i==0){
        document.getElementById('pushBoardOrSchoolId').innerHTML = '';
        document.getElementById('pushBoardOrSchoolId').innerHTML =  `<option onclick="loadYear(-1)" value='0'> select one </option>`;
        boardName.forEach((element,index) => {
            document.getElementById("pushBoardOrSchoolId").innerHTML += `<option onclick="loadYear(${index})" value='${element.boardName}'> ${element.boardName} </option>`;
        });
    }if(i==1){
        document.getElementById('pushBoardOrSchoolId').innerHTML = '';
        document.getElementById('pushBoardOrSchoolId').innerHTML =  `<option value='0'> select one </option>`;
        famousSchoolName.forEach((element,index) => {
            document.getElementById("pushBoardOrSchoolId").innerHTML += `<option value='${element}'> ${element} </option>`;
        });
    }
}

// load year
function loadYear(i){
    if(i == -1){
        document.getElementById('pushYearId').innerHTML = '';
        document.getElementById('pushYearId').innerHTML =  `<option value='0'> select one </option>`;
    }else{
        document.getElementById('pushYearId').innerHTML = '';
        document.getElementById('pushYearId').innerHTML =  `<option value='0'> select one </option>`;
        boardName[i].boardYear.forEach((element,index) => {
            document.getElementById("pushYearId").innerHTML += `<option value='${element}'> ${element} </option>`;
        });
    }
}