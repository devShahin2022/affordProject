try{
  function showdynamicallyModal(){
    var myModal = new bootstrap.Modal(document.getElementById('exampleModalToggle'))
    myModal.show();
  }
showdynamicallyModal();
}catch(error){

}

// start exam time 
let currentTimeInMillisecondsStart = '';
// question answer collect from database...
let correctAnswer = [];
let questionData = [];

function freeExamCall(){
    _id("newVisitorView").classList.add('d-none');
    _id("pushExamQuestionMcqId").classList.remove('d-none');
    try{
      const truck_modal = document.getElementById('exampleModalToggle');
      const modal = bootstrap.Modal.getInstance(truck_modal);    
      modal.hide();
    }catch(error){
      console.log(error);
    }
    // up all settings done let's push mcq question
    fetch('http://127.0.0.1:8000/profile/free-exam-question-fetch')
    .then(response => response.json())
    .then(data => {
        _id("pushExamQuestionMcqId").innerHTML = '';
        data.forEach((element,index) => {
            correctAnswer.push(JSON.parse(element.answer));
            questionData.push(element);
            if(element.question_type == 1){
                _id("pushExamQuestionMcqId").innerHTML += `
                <div class="row">
                <div class="col-12">
                  <h5 class="mb-2 mt-3">${index+1}. ${element.question}</h5>
                </div>
                <div class="col-6 mt-2">
                  <input value="1" type="radio" class="btn-check" name="options${index+1}" id="options1_${index+1}" autocomplete="">
                  <label class="btn btn-outline-secondary w-100 text-start" for="options1_${index+1}">a. ${element.option1}</label>
                </div>
                <div class="col-6 mt-2">
                  <input  value="2"  type="radio" class="btn-check" name="options${index+1}" id="options2_${index+1}" autocomplete="">
                  <label class="btn btn-outline-secondary w-100  text-start" for="options2_${index+1}">b. ${element.option2}</label>
                </div>
                <div class="col-6 mt-2">
                  <input  value="3"  type="radio" class="btn-check" name="options${index+1}" id="options3_${index+1}" autocomplete="">
                  <label class="btn btn-outline-secondary w-100  text-start" for="options3_${index+1}">c. ${element.option2}</label>
                </div>
                <div class="col-6 mt-2">
                  <input  value="4"  type="radio" class="btn-check" name="options${index+1}" id="options_${index+1}" autocomplete="">
                  <label class="btn btn-outline-secondary w-100  text-start" for="options_${index+1}">d. ${element.option2}</label>
                </div>
              </div>
                `
            }else{
                _id("pushExamQuestionMcqId").innerHTML += `
                <div class="row">
                <div class="col-12">
                  <h5 class="mb-2 mt-3">${index+1}. ${element.question}</h5>
                </div>
                <div class="col-6 mt-2">
                  <input value="1" type="checkbox" class="btn-check" name="options${index+1}" id="options1_${index+1}" autocomplete="">
                  <label class="btn btn-outline-secondary w-100 text-start" for="options1_${index+1}">i. ${element.option1}</label>
                </div>
                <div class="col-6 mt-2">
                  <input  value="2"  type="checkbox" class="btn-check" name="options${index+1}" id="options2_${index+1}" autocomplete="">
                  <label class="btn btn-outline-secondary w-100  text-start" for="options2_${index+1}">ii. ${element.option2}</label>
                </div>
                <div class="col-6 mt-2">
                  <input  value="3"  type="checkbox" class="btn-check" name="options${index+1}" id="options3_${index+1}" autocomplete="">
                  <label class="btn btn-outline-secondary w-100  text-start" for="options3_${index+1}">iii. ${element.option2}</label>
                </div>
              </div>
                `
            }
        });
        _id("pushExamQuestionMcqId").innerHTML +=`<input type="hidden" value=${data.length} id="mcqSize" >`;
        _id("pushExamQuestionMcqId").innerHTML +=`<button class="btn btn-dark my-3">Submit answer</button>`;

        //  exam start call
            // exam end time
            currentTimeInMillisecondsStart = new Date().getTime();

            const csrfToken1 = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
              const data1 = {
                  examStartTime: currentTimeInMillisecondsStart,
                  examPaperData : questionData
              };
              

            // Options for the POST request
            const options = {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken1
              },
              body: JSON.stringify(data1)
            };
            // Send the POST request
            fetch('http://127.0.0.1:8000/profile/free-exam-data-store', options)
              .then(response => response.json())
              .then(data => {
                  console.log('user clicked');
              })
              .catch(error => {
                console.error('Error:', error);
              });


        })
        .catch(error => {
            console.log('Error:', error);
        });
}

let pushTmpData = [];
let options4 = ["a","b","c","d"];
let options3 = ["i","ii","iii"];

// exam data collect
function examDataCollect(e){
    console.log(e.target());
}

const form = _id('submitExam');
form.addEventListener('submit', function(event) {
    event.preventDefault(); 
    let mcqSize = _id("mcqSize").value;
    let userAnswers = [];
    for(let i=0; i<mcqSize; i++){
        const selectedRadioButtons = form.querySelectorAll(`input[name="options${i+1}"]:checked`);
        if (selectedRadioButtons.length > 0) {
            const selectedValues = Array.from(selectedRadioButtons).map(radioButton => radioButton.value);
                userAnswers.push(selectedValues);
            } else {
                userAnswers.push(0);
        }
    }
    // showing result in front end
    _id("pushExamQuestionMcqId").innerHTML = ''; // first null the mcq panel
    _id("pushExamQuestionMcqId").classList.add('d-none');
    let countUntouchMcq = 0;
    let countCorrectMcq = 0;
    let countWrongMcq = 0;
    let isMatchAns = true;
    // calculate user exam result
    for(let i=0; i<userAnswers.length; i++){
        // console.log(userAnswers[i],questionData[i].answer);
        if(userAnswers[i] == 0){
            countUntouchMcq++;
        }else if(userAnswers[i].length == JSON.parse(questionData[i].answer).length){
            if(userAnswers[i].length == 1 && JSON.parse(questionData[i].answer).length ==1){
                if(userAnswers[i][0] == JSON.parse(questionData[i].answer)[0]){
                    countCorrectMcq++;
                }else{
                    countWrongMcq++;
                }
            }else{
                for(let j=0; j<userAnswers[i].length; j++){
                    if(userAnswers[i][j] != JSON.parse(questionData[i].answer)[j]){
                        isMatchAns = false;
                    }
                }
                if(isMatchAns){
                    countCorrectMcq++;
                }else{
                    countWrongMcq++;
                }
            }
        }else{ // defenately wrong answer
            countWrongMcq++;
        }
    }

    console.log(countUntouchMcq, countCorrectMcq, countWrongMcq);




    // exam end time
    let currentTimeInMillisecondsEnd = new Date().getTime();


// data store in database
// Data to be sent in the request body

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const data = {
    answer: userAnswers,
    examStartTime: currentTimeInMillisecondsStart,
    examEndTime: currentTimeInMillisecondsEnd,
    examPaperData : questionData,
    correctAnswer : countCorrectMcq,
    wrongAnswer : countWrongMcq,
    untouch : countUntouchMcq,
  };
  
  // Options for the POST request
  const options = {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify(data)
  };
  
  // Send the POST request
  fetch('http://127.0.0.1:8000/profile/free-exam-data-store', options)
    .then(response => response.json())
    .then(data => {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'))
        myModal.show();
        _id("pushResultFormId").classList.remove('d-none');
        _id("pushResultFormId").innerHTML = '<h3> আপনার পরীক্ষাটি সম্পন্ন হয়েছে।</h3>';
        _id("pushResultFormId").innerHTML += `
          <form action="{{ route('seeFreeExamResult') }}" method="GET">
            @csrf
              <button class="btn btn-primary w-100" type="submit">ফলাফল</button>
          </form>
        `;
    })
    .catch(error => {
      console.error('Error:', error);
    });











    // questionData.forEach((element,index) => {
    //     _id("pushExamQuestionMcqId").innerHTML += `<div class="row">`
    //     if(element.question_type == 1){
    //         pushTmpData.push(element.option1);
    //         pushTmpData.push(element.option2);
    //         pushTmpData.push(element.option3);
    //         pushTmpData.push(element.option4);

    //         if(JSON.parse(element.answer)[0] == userAnswers[0]){
    //             _id("pushExamQuestionMcqId").innerHTML += `
    //             <div class="col-12">
    //               <h5 class="mb-2 text-success mt-3">${index+1}. ${element.question}</h5>
    //             </div>`
    //             for(let i=0; i<4; i++){
    //                 if(JSON.parse(element.answer)[0] == i+1){
    //                     _id("pushExamQuestionMcqId").innerHTML += `
    //                     <div class="col-6">
    //                     <p class="mb-2 text-success mt-3">${options4[i]}. ${pushTmpData[i]}  (your answer)</p>
    //                     </div>`
    //                 }else{
    //                     _id("pushExamQuestionMcqId").innerHTML += `
    //                     <div class="col-6">
    //                     <p class="mb-2 mt-3">${options4[i]}. ${pushTmpData[i]}</p>
    //                     </div>`
    //                 }
    //             }
    //             pushTmpData = [];
    //         }else{
    //             _id("pushExamQuestionMcqId").innerHTML += `
    //             <div class="col-12">
    //               <h5 class="mb-2 text-danger mt-3">${index+1}. ${element.question}</h5>
    //             </div>`
    //             for(let i=0; i<4; i++){
    //                 if(JSON.parse(element.answer)[0] == i+1){
    //                     _id("pushExamQuestionMcqId").innerHTML += `
    //                     <div class="col-6">
    //                     <p class="mb-2 text-success mt-3">${options4[i]}.  ${pushTmpData[i]}</p>
    //                     </div>`
    //                 }else if(userAnswers[0] == i+1){
    //                     _id("pushExamQuestionMcqId").innerHTML += `
    //                     <div class="col-6">
    //                     <p class="mb-2 text-danger mt-3">${options4[i]}.  ${pushTmpData[i]} (your answer)</p>
    //                     </div>`
    //                 }else{
    //                     _id("pushExamQuestionMcqId").innerHTML += `
    //                     <div class="col-6">
    //                     <p class="mb-2 mt-3">${options4[i]}.  ${pushTmpData[i]}</p>
    //                     </div>`
    //                 }
    //             }
    //             pushTmpData = [];
    //         }
    //     }else{
    //         pushTmpData = [];
    //         pushTmpData.push(element.option1);
    //         pushTmpData.push(element.option2);
    //         pushTmpData.push(element.option3);

    //         let flag = false;
    //         if(userAnswers[index].length != JSON.parse(element.answer).length){
                
    //         }else{
    //             for(let i=0; i<userAnswers[index].length; i++){
    //                 if(userAnswers[index][i] == JSON.parse(element.answer)[i]){
    //                     flag =true;
    //                 }else{
    //                     flag = false;
    //                 }
    //             }
    //         }
    //         if(flag === true){
    //              _id("pushExamQuestionMcqId").innerHTML += `
    //             <div class="col-12">
    //               <h5 class="mb-2 text-success mt-3">${index+1}. ${element.question}</h5>
    //             </div>
    //             `
    //             for(let i=0; i<3; i++){
    //                 if(userAnswers[index][i] === JSON.parse(element.answer)[i]){
    //                     _id("pushExamQuestionMcqId").innerHTML += `
    //                     <div class="col-6">
    //                     <p class="mb-2 mt-3">${options3[i]}.  ${pushTmpData[i]}</p>
    //                     </div>` 
    //                 }else{
    //                     _id("pushExamQuestionMcqId").innerHTML += `
    //                     <div class="col-6">
    //                     <p class="mb-2 mt-3 ">${options3[i]}.  ${pushTmpData[i]}</p>
    //                     </div>` 
    //                 }
    //             }
    //             _id("pushExamQuestionMcqId").innerHTML += `<span class="text-success"> Your answer correct: </span>`
    //             for(let i=0; i<JSON.parse(element.answer).length;i++){
    //                 _id("pushExamQuestionMcqId").innerHTML += JSON.parse(element.answer)[i] + ',';
    //             }
    //         }
    //          if(flag === false){
    //              _id("pushExamQuestionMcqId").innerHTML += `
    //             <div class="col-12">
    //               <h5 class="mb-2 text-danger mt-3">${index+1}. ${element.question}</h5>
    //             </div>`
    //             for(let i=0; i<3; i++){
    //                 _id("pushExamQuestionMcqId").innerHTML += `
    //                 <div class="col-6">
    //                 <p class="mb-2 mt-3">${options3[i]}.  ${pushTmpData[i]}</p>
    //                 </div>` 
    //             }
    //             _id("pushExamQuestionMcqId").innerHTML += `<span class="text-danger"> Your answer wrong: </span>`
    //             for(let i=0; i<userAnswers[index].length;i++){
    //                 _id("pushExamQuestionMcqId").innerHTML += userAnswers[index][i]+ ','
    //             }
    //             _id("pushExamQuestionMcqId").innerHTML += `<span> Correct answer: </span>`
    //             for(let i=0; i<JSON.parse(element.answer).length;i++){
    //                 _id("pushExamQuestionMcqId").innerHTML += JSON.parse(element.answer)[i] + ',';
    //             }
    //         }
    //     }
    //     _id("pushExamQuestionMcqId").innerHTML += `</div> `;
    // });

});