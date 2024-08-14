$(document).ready(function () {
    const surveys = window.surveyData;
    const surveyStoreUrl = window.surveyStoreUrl;
    const csrfToken = window.csrfToken;

    // user anketi daha evvel cavabladi mı yoxlamaq
    function openNextSurvey() {
        const completedSurveys =
            JSON.parse(localStorage.getItem("completedSurveys")) || [];
        const nextSurvey = surveys.find(
            (survey) =>
                survey.priority === 1 && !completedSurveys.includes(survey.id)
        );

        if (nextSurvey) {
            showSurveyPopup(nextSurvey, false);
        }
    }


    if (!localStorage.getItem("surveyCompleted")) {
        openNextSurvey();
    }


    // Anket Yenilendi 1
    $(".allSurveysButton").on("click", function () {
        
        const surveyId = $(this).data("survey-id");
        const surveyObj = $(this).data("survey");
        const isAnswered = $(this).data("is-answered");
  

        // Cavablari gör
            $.ajax({
                url: `/employee/survey/answers/${surveyId}`,
                method: 'GET',
                success: function (response) {
                    
                    const survey = surveys.find(s => s.id === surveyId);
                    
                    if (survey) {
                        
                        
                        
                        showAllSurveys(response, survey.surveys_questions,surveyObj,isAnswered);
                        
                    }
                },
                error: function (error) {
                    console.error("Failed to fetch user answers:", error);
                }
            });

    
    });

    // Anket yenilendi 2
    function showAllSurveys(checkedAnswers, allData,surveyObj,isAnswered) {        

        const keysArray = Object.keys(checkedAnswers);
        
        let answersHtml = '';

        const showOldQuestion = allData.filter(question => keysArray.includes(question.id.toString()));
        

        showOldQuestion.forEach((question, index) => {            
            
            // Cavablari gor olan hisse -----------------------------------------------------------------------------------------
            const questionId = question.id;
            const questionType = question.input_type;             
            const answerList = checkedAnswers || []; 
            
            answersHtml += `<div class="col-xl-6 col-12">                        
                <div class="card mb-4">
                    <div class="card-header w-100 d-flex justify-content-center align-items-center">
                        <h3 class="m-0">${index + 1}.</h3>
                        <h3 class="m-0">${question.question}</h3>
                    </div>
                    <div class="card-body">`;
            
            if (questionType === 'textarea') {
                const textareaAnswer = answerList[(questionId).toString()][0].answer || []; // Adjust based on response structure
            answersHtml += `<textarea disabled  rows="6" style='box-sizing:border-box; width: 100%; resize:none '>${textareaAnswer}</textarea>`;
            } 
            else {
                // Display the options with user answers marked as checked
                answersHtml += `<ul class="list-group-custom">`;
                question.answers.forEach((option) => {

                    let isChecked = false;
                    if (Array.isArray(answerList[(questionId).toString()])) {
                            isChecked = answerList[(questionId).toString()].some(answer => answer.answer === option.name);
                        console.log('isChecked:', isChecked);
                    } else {
                        console.log(`No answers found for question ID: ${questionId}`);
                            isChecked = false; // or any other default handling
                    }

                    answersHtml += `<li class="d-flex my-3 align-items-center w-100 justify-content-between">
                        <div class="d-flex align-items-center justify-content-between  w-100 py-2">
                            <div class="d-flex align-items-center justify-content-center">                                                
                                <input type="${questionType}" disabled ${isChecked ? 'checked' : ''} class="rounded" style="width: 20px; height: 20px" />
                            </div>
                            <div class="d-flex align-items-center justify-content-center  w-100 pl-3">
                                <label class="text-justify">
                                    ${option.name}
                                </label>
                            </div>
                        </div>
                    </li>`;
                });
                answersHtml += `</ul>`;
            }

            answersHtml += `</div>
                </div>
            </div>`;
        });
        // ----------------------------------------------------------------------------------------------------------------------------


        // Cavab ver olan hisse--------------------------------------------------------------------------------------------------------  
        let checkSubmit = 'Ok';
        let questionsHtml = "";      
        const showNewQuestion = allData.filter(question => !keysArray.includes(question.id.toString()));

        // cavabi gor 
        if (showNewQuestion.length===0  && isAnswered===1) {
            checkSubmit = 'Ok';
            questionsHtml=`                       
            `;
        }
         // anket yenilendi ve yeni sual elave edilmedi 
        else if (showNewQuestion.length===0 && isAnswered===2){
            checkSubmit = 'Ok';
            questionsHtml=`
            <div class="row">                            
                <div class="col-12">
                    <form id="newSurveyForm" action="${surveyStoreUrl}" method="POST">
                        <input name="_token" value="${csrfToken}" type="hidden">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="name-date-wrapper ">
                                        <h3 class="ml-3 mt-0 mb-0 mr-0 w-100 text-center ">
                                            Anketə  əlavə olunmuş yeni sual və ya suallar
                                        </h3>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <p>Anket yenilendi ve yeni sual elave edilmedi</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>                        
                </div>                       
                `;
                
            
        }
        
      

        //Cavabla - anket yenilendi ve yeni sual elave edildi 
        else{
            checkSubmit = 'Submit';
            console.log('anket yenilendi showNewQuestion:', showNewQuestion);
            
            let newQuestionHtml='';

            showNewQuestion.forEach((question, index) => {
                
                let optionsHtml = "";
                if (question.input_type === "radio") {
                    question.answers.forEach((option) => {
                        optionsHtml += `
                            <div class="answers d-flex form-check">
                                <input class="form-check-input" type="radio" value="${option.name}" name="question[${question.id}]" id="option_${index}_${option.id}" required />
                                <label class="w-100" for="option_${index}_${option.id}">${option.name}</label>
                            </div>
                        `;
                    });
                } else if (question.input_type === "checkbox") {
                    question.answers.forEach((option) => {
                        optionsHtml += `
                            <div class="answers d-flex form-check">
                                <input class="form-check-input" type="checkbox" value="${option.name}" name="question[${question.id}][]" id="option_${index}_${option.id}" />
                                <label class="w-100" for="option_${index}_${option.id}">${option.name}</label>
                            </div>
                        `;
                    });
                } else if (question.input_type === "textarea") {
                    optionsHtml = `
                        <div>
                            <textarea rows="7" cols="10" class="form-control" name="question[${question.id}]" required></textarea>
                        </div>
                    `;
                }

                newQuestionHtml+=`
                <div class="col-md-6 col-sm-12 mb-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-center">
                                            <h4>${index + 1}.</h4>
                                            <h4>${question.question}</h4>
                                        </div>
                                        <div class="card-body">
                                            ${optionsHtml}
                                        </div>
                                    </div>
                                </div>                     
                `;




            });

            questionsHtml=`
            <div class="row">                            
                <div class="col-12">
                    <form id="newSurveyForm" action="${surveyStoreUrl}" method="POST">
                        <input name="_token" value="${csrfToken}" type="hidden">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="name-date-wrapper ">
                                        <h3 class="ml-3 mt-0 mb-0 mr-0 w-100 text-center ">
                                            Anketə  əlavə olunmuş yeni sual və ya suallar
                                        </h3>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    ${newQuestionHtml}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>                        
                </div>                       
                `;
            // ----------------------------------------------------------------------------------------------------------------------------
            
        }
        Swal.fire({
            title: "Istifadeci Anketi",
            html: `

                    <div class="row">
                        ${answersHtml}                        
                    </div>

                    ${questionsHtml}
                `,
            showCancelButton: false,
            confirmButtonText: checkSubmit,


            cancelButtonText: "Cancel",
            allowOutsideClick: true,
            allowEscapeKey: true,
            allowEnterKey: true,
            preConfirm: () => {
                let allAnswered = true;
                const form = document.getElementById("newSurveyForm");
                const inputs = form?.querySelectorAll("input, textarea");

         
                if (showNewQuestion.length>=1) {
                    
                    inputs.forEach((input) => {
                        if (input.type !== "hidden") {
                            if (
                                (input.type === "radio" ||
                                    input.type === "checkbox") &&
                                !input.checked
                            ) {
                                const name = input.name;
                                const options = document.querySelectorAll(
                                    `[name="${name}"]`
                                );
                                const isChecked = Array.from(options).some(
                                    (option) => option.checked
                                );
        
                                if (!isChecked) {
                                    allAnswered = false;
                                    showError(input);
                                } else {
                                    removeError(input);
                                }
                            } else if (
                                input.type === "textarea" &&
                                !input.value.trim()
                            ) {
                                allAnswered = false;
                                showError(input);
                            } else {
                                removeError(input);
                            }
                        }
                    });
        
                    if (allAnswered ) {
                        // istifadeci anketi muveffeqiyyetle tamamliyanda completedSurveys listine elave et
                        let completedSurveys = JSON.parse(localStorage.getItem("completedSurveys")) || [];
                        completedSurveys.push(surveyObj.id);
                        localStorage.setItem("completedSurveys", JSON.stringify(completedSurveys));
        
                        // Formu gönder
                        form.submit();
        
                        // novbeti anketi aç
                        const nextSurvey = surveys.find(s => s.priority === 1 && !completedSurveys.includes(s.id));
                        if (nextSurvey) {
                            // novbeti anketin açılmasını 1 saniye gecikdirmek ucun, belelikle form gönderildikden sonra açılacaq
                            setTimeout(() => {
                                showSurveyPopup(nextSurvey, false);
                            }, 1000);
                        }
                    } else {
                        Swal.showValidationMessage(
                            "Zəhmət olmasa təqdim etməzdən əvvəl bütün tələb olunan suallara cavab verin."
                        );
                        return false;
                    }
                }
    
            },
        
        });
    }


    // Cavabla 1
    $(".surveyButton").on("click", function () {
        const survey = $(this).data("survey");
        
        showSurveyPopup(survey, survey.priority === 0);
    });

    // Cavabla 2
    function showSurveyPopup(survey, canCancel) {
        Swal.fire({
            html: generateSurveyHtml(survey),
            showCancelButton: canCancel,
            confirmButtonText: "Cavabı göndər",
            cancelButtonText: "Ləğv et",
            cancelButtonColor: "red",
            allowOutsideClick: canCancel,
            allowEscapeKey: canCancel,
            allowEnterKey: canCancel,
            preConfirm: () => {
                let allAnswered = true;
                const form = document.getElementById("surveyForm");
                const inputs = form.querySelectorAll("input, textarea");

                inputs.forEach((input) => {
                    if (input.type !== "hidden") {
                        if (
                            (input.type === "radio" ||
                                input.type === "checkbox") &&
                            !input.checked
                        ) {
                            const name = input.name;
                            const options = document.querySelectorAll(
                                `[name="${name}"]`
                            );
                            const isChecked = Array.from(options).some(
                                (option) => option.checked
                            );

                            if (!isChecked) {
                                allAnswered = false;
                                showError(input);
                            } else {
                                removeError(input);
                            }
                        } else if (
                            input.type === "textarea" &&
                            !input.value.trim()
                        ) {
                            allAnswered = false;
                            showError(input);
                        } else {
                            removeError(input);
                        }
                    }
                });

                if (allAnswered) {
                    
                    // istifadeci anketi muveffeqiyyetle tamamliyanda completedSurveys listine elave et
                    let completedSurveys =
                        JSON.parse(localStorage.getItem("completedSurveys")) ||
                        [];
                    completedSurveys.push(survey.id);
                    localStorage.setItem(
                        "completedSurveys",
                        JSON.stringify(completedSurveys)
                    );

                    // Formu gönder
                    form.submit();

                    // novbeti anketi aç
                    const nextSurvey = surveys.find(
                        (s) =>
                            s.priority === 1 && !completedSurveys.includes(s.id)
                    );
                    if (nextSurvey) {
                        // novbeti anketin açılmasını 1 saniye gecikdirmek ucun, belelikle form gönderildikden sonra açılacaq
                        setTimeout(() => {
                            showSurveyPopup(nextSurvey, false);
                        }, 1000);
                    }
                } else {
                    Swal.showValidationMessage(
                        "Zəhmət olmasa cavabı göndərməzdən əvvəl bütün tələb olunan suallara cavab verin."
                    );
                    return false;
                }
            },
        });
    }

    // Cavabla 3
    function showError(input) {
        const errorText = document.createElement("span");
        errorText.className = "error-text";
        errorText.style.color = "red";
        errorText.innerText = "Bu suala cavab verməyiniz tələb olunur.";

        const parent = input.closest(".card-body");
        if (!parent.querySelector(".error-text")) {
            parent.appendChild(errorText);
        }
    }

    // Cavabla 4
    function removeError(input) {
        const parent = input.closest(".card-body");
        const errorText = parent.querySelector(".error-text");
        if (errorText) {
            errorText.remove();
        }
    }

    // Cavabla 5
    function generateSurveyHtml(survey) {
        if (
            !survey ||
            !survey.surveys_questions ||
            !Array.isArray(survey.surveys_questions)
        ) {
            return "<p>Hələki Heç Bir Sual Yoxdur.</p>";
        }

        let questionsHtml = "";
        survey.surveys_questions.forEach((question, index) => {
            let optionsHtml = "";
            if (question.input_type === "radio") {
                question.answers.forEach((option) => {
                    optionsHtml += `
                      <div class="answers d-flex form-check">
                          <input class="form-check-input" type="radio" value="${option.name}" name="question[${question.id}]" id="option_${index}_${option.id}" required />
                          <label class="w-100" for="option_${index}_${option.id}">${option.name}</label>
                      </div>
                  `;
                });
            } else if (question.input_type === "checkbox") {
                question.answers.forEach((option) => {
                    optionsHtml += `
                      <div class="answers d-flex form-check">
                          <input class="form-check-input" type="checkbox" value="${option.name}" name="question[${question.id}][]" id="option_${index}_${option.id}" />
                          <label class="w-100" for="option_${index}_${option.id}">${option.name}</label>
                      </div>
                  `;
                });
            } else if (question.input_type === "textarea") {
                optionsHtml = `
                  <div>
                      <textarea rows="7" cols="10" class="form-control" name="question[${question.id}]" required></textarea>
                  </div>
              `;
            }

            questionsHtml += `
              <div class="col-md-6 col-sm-12 mb-4">
                  <div class="card">
                      <div class="card-header d-flex justify-content-center">
                          <h4>${index + 1}.</h4>
                          <h4>${question.question}</h4>
                      </div>
                      <div class="card-body">
                          ${optionsHtml}
                      </div>
                  </div>
              </div>
          `;
        });

        return `
          <div class="pt-4 custom-container bg-white">
              <div class="row">
                  <div class="col-12">
                      <form id="surveyForm" action="${surveyStoreUrl}" method="POST">
                        <input name="_token" value="${csrfToken}" type="hidden">
                          <div class="card">
                              <div class="card-header">
                                  <div class="d-flex justify-content-between align-items-center">
                                      <div class="name-date-wrapper">
                                          <h3 class="ml-3 mt-0 mb-0 mr-0">
                                            ${survey.name} 
                                            ${
                                                survey.is_anonym === 1
                                                    ? "<span>(anonim)</span>"
                                                    : ""
                                            }
                                        </h3>
                                          <h4 class="ml-3 mt-0 mb-0 mr-0">Bitmə Tarixi: ${new Date(
                                              survey.expired_at
                                          ).toLocaleDateString()} ${new Date(survey.expired_at).toLocaleTimeString()}</h4>
                                      </div>
                                  </div>
                              </div>
                              <div class="card-body">
                                  <div class="row">
                                      ${questionsHtml}
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      `;
    }


    
    // Cavablari gör 1
    $(".showSurveyButton").on("click", function () {
        const surveyId = $(this).data("survey-id");
        fetchUserAnswers(surveyId);

    });

    // Cavablari gör 2
    function fetchUserAnswers(surveyId) {
        $.ajax({
            url: `/employee/survey/answers/${surveyId}`,
            method: 'GET',
            success: function (response) {
                // console.log('Response:', response);
                const survey = surveys.find(s => s.id === surveyId);
                if (survey) {
                    showUserAnswersPopup(response, survey);
                }
            },
            error: function (error) {
                console.error("Failed to fetch user answers:", error);
            }
        });
    }
    
    // Cavablari gör 3
    function showUserAnswersPopup(answers, survey) {
        let answersHtml = '';
    
        survey.surveys_questions.forEach((question, index) => {
            const questionId = question.id;
            const questionType = question.input_type; // Determine the question type (checkbox, radio, textarea)
    
            // Get the list of user's answers for this question
            const answerList = answers[questionId] || []; // Adjust based on the response structure
    
            answersHtml += `<div class="col-xl-6 col-12">                        
                <div class="card mb-4">
                    <div class="card-header w-100 d-flex justify-content-center align-items-center">
                        <h3 class="m-0">${index + 1}.</h3>
                        <h3 class="m-0">${question.question}</h3>
                    </div>
                    <div class="card-body">`;
    
            if (questionType === 'textarea') {
                // Display the textarea with the user's answer
                const textareaAnswer = answerList[0] ? answerList[0].answer : ''; // Adjust based on response structure
            answersHtml += `<textarea disabled  rows="10" style='box-sizing:border-box; width: 100%;resize: "none" '>${textareaAnswer}</textarea>`;
            } else {
                // Display the options with user answers marked as checked
                answersHtml += `<ul class="list-group-custom">`;
                question.answers.forEach((option) => {
                    // Determine if this option should be checked
                    const isChecked = answerList.some(answer => answer.answer === option.name);
    
                    answersHtml += `<li class="d-flex my-3 align-items-center w-100 justify-content-between">
                        <div class="d-flex align-items-center justify-content-between  w-100 py-2">
                            <div class="d-flex align-items-center justify-content-center">                                                
                                <input type="${questionType}" disabled ${isChecked ? 'checked' : ''} class="rounded" style="width: 20px; height: 20px" />
                            </div>
                            <div class="d-flex align-items-center justify-content-center  w-100 pl-3">
                                <label class="text-justify">
                                    ${option.name}
                                </label>
                            </div>
                        </div>
                    </li>`;
                });
                answersHtml += `</ul>`;
            }
    
            answersHtml += `</div>
                </div>
            </div>`;
        });
    
        Swal.fire({
            title: "User Answers",
            html: `
                <div class="row mb-4 w-100">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    ${answersHtml}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`,
            showCancelButton: false,
            confirmButtonText: "Ok",
        });
    }





});












