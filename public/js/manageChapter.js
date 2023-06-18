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
