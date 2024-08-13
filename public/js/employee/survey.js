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

    $(".showSurveyButton").on("click", function () {
        const surveyId = $(this).data("survey-id");
        fetchUserAnswers(surveyId);
    });

    $(".surveyButton").on("click", function () {
        const survey = $(this).data("survey");
        showSurveyPopup(survey, survey.priority === 0);
    });

    function fetchUserAnswers(surveyId) {
        $.ajax({
            url: `/employee/survey/answers/${surveyId}`,
            method: "GET",
            success: function (response) {
                const survey = surveys.find((s) => s.id === surveyId);
                if (survey) {
                    showUserAnswersPopup(response, survey);
                }
            },
            error: function (error) {
                console.error("Failed to fetch user answers:", error);
            },
        });
    }

    function showUserAnswersPopup(answers, survey) {
        let answersHtml = "";

        survey.surveys_questions.forEach((question, index) => {
            const questionId = question.id;
            const questionType = question.input_type; // Determine the question type (checkbox, radio, textarea)

            // Get the list of user's answers for this question
            const answerList = answers[questionId] || []; // Adjust based on the response structure

            answersHtml += `<div class="col-lg-6 col-12">                        
                <div class="card mb-4">
                    <div class="card-header w-100 d-flex justify-content-center align-items-center">
                        <h3 class="m-0">${index + 1}.</h3>
                        <h3 class="m-0">${question.question}</h3>
                    </div>
                    <div class="card-body">`;

            if (questionType === "textarea") {
                // Display the textarea with the user's answer
                const textareaAnswer = answerList[0]
                    ? answerList[0].answer
                    : ""; // Adjust based on response structure
                answersHtml += `<div class="textarea" style="height:250px; overflow-y:auto;text-align:start">
                ${textareaAnswer}
            </div>`;
            } else {
                // Display the options with user answers marked as checked
                answersHtml += `<ul class="list-group-custom">`;
                question.answers.forEach((option) => {
                    // Determine if this option should be checked
                    const isChecked = answerList.some(
                        (answer) => answer.answer === option.name
                    );

                    answersHtml += `<li class="d-flex my-3 align-items-center w-100 justify-content-between">
                        <div class="d-flex align-items-center justify-content-between  w-100 py-2">
                            <div class="d-flex align-items-center justify-content-center">                                                
                                <input type="${questionType}" disabled ${
                        isChecked ? "checked" : ""
                    } class="rounded" style="width: 35px; height: 35px" />
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
            title: "Mənim cavabım",
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

    function removeError(input) {
        const parent = input.closest(".card-body");
        const errorText = parent.querySelector(".error-text");
        if (errorText) {
            errorText.remove();
        }
    }

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
});
