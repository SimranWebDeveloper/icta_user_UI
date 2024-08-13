$(document).ready(function () {
    const surveys = window.surveyData;
    const surveyStoreUrl = window.surveyStoreUrl;
    const csrfToken = window.csrfToken;

    function openNextSurvey() {
        const completedSurveys = JSON.parse(localStorage.getItem("completedSurveys")) || [];
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

    $(".allSurveysButton").on("click", function () {
        const survey = $(this).data("survey");
        catchAllSurveys(survey);
    });

    function catchAllSurveys(survey) {
        $.ajax({
            url: `/employee/survey/answers/${survey.id}`,
            method: "GET",
            success: function (response) {
                console.log(response)
                let answersHtml = "";
    
                survey.surveys_questions.forEach((question, index) => {
                    const questionId = question.id;
                    const questionType = question.input_type;
                    const answerList = response[questionId] || [];
                    console.log(answerList)
    
                    answersHtml += `<div class="col-xl-6 col-12">                        
                        <div class="card mb-4">
                            <div class="card-header w-100 d-flex justify-content-center align-items-center">
                                <h3 class="m-0">${index + 1}.</h3>
                                <h3 class="m-0">${question.question}</h3>
                            </div>
                            <div class="card-body">`;
    
                    if (questionType === "textarea") {
                        const textareaAnswer = answerList.length > 0 ? answerList[0].answer : "";
                        answersHtml += `<textarea rows="10" name="question_${questionId}" style="box-sizing:border-box; width: 100%;resize: none;" ${textareaAnswer ? "disabled" : ""}>${textareaAnswer}</textarea>`;
                    } else {
                        answersHtml += `<ul class="list-group-custom">`;
                        question.answers.forEach((option) => {
                            const isChecked = answerList.some(
                                (answer) => answer.answer === option.name
                            );
    
                            answersHtml += `<li class="d-flex my-3 align-items-center w-100 justify-content-between">
                                <div class="d-flex align-items-center justify-content-between  w-100 py-2">
                                    <div class="d-flex align-items-center justify-content-center">                                                
                                        <input type="${questionType}" name="question_${questionId}" value="${option.name}" ${isChecked ? "checked disabled" : ""} class="rounded" style="width: 20px; height: 20px" />
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
                    title: "Survey Details",
                    html: `<div class="row mb-4 w-100">
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
                    showCancelButton: true,
                    confirmButtonText: "Submit",
                    preConfirm: () => {
                        const updatedAnswers = [];
    
                        $("input[type='checkbox']:not(:disabled), input[type='radio']:not(:disabled)").each(function () {
                            const nameAttr = $(this).attr("name");
                            if (nameAttr) {
                                updatedAnswers.push({
                                    question_id: nameAttr.split("_")[1],
                                    answer: $(this).val(),
                                });
                            }
                        });
    
                        const textareaAnswers = $("textarea:not(:disabled)").map(function () {
                            const nameAttr = $(this).attr("name");
                            if (nameAttr) {
                                return {
                                    question_id: nameAttr.split("_")[1],
                                    answer: $(this).val(),
                                };
                            }
                        }).get();
    
                        updatedAnswers.push(...textareaAnswers);
    
                        return $.ajax({
                            url: surveyStoreUrl,
                            method: "POST",
                            data: {
                                _token: csrfToken,
                                survey_id: survey.id,
                                answers: updatedAnswers,
                            },
                        }).then((response) => {
                            return response;
                        }).catch((error) => {
                            Swal.showValidationMessage(`Request failed: ${error}`);
                        });
                    }
                });
            },
            error: function (error) {
                console.error("Failed to fetch survey answers:", error);
            },
        });
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
                console.log("Response:", response);
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
            const questionType = question.input_type;

            const answerList = answers[questionId] || [];

            answersHtml += `<div class="col-xl-6 col-12">                        
                <div class="card mb-4">
                    <div class="card-header w-100 d-flex justify-content-center align-items-center">
                        <h3 class="m-0">${index + 1}.</h3>
                        <h3 class="m-0">${question.question}</h3>
                    </div>
                    <div class="card-body">`;

            if (questionType === "textarea") {
                const textareaAnswer = answerList[0] ? answerList[0].answer : "";
                answersHtml += `<textarea disabled rows="10" style="box-sizing:border-box; width: 100%;resize: none;">${textareaAnswer}</textarea>`;
            } else {
                answersHtml += `<ul class="list-group-custom">`;
                question.answers.forEach((option) => {
                    const isChecked = answerList.some(
                        (answer) => answer.answer === option.name
                    );

                    answersHtml += `<li class="d-flex my-3 align-items-center w-100 justify-content-between">
                        <div class="d-flex align-items-center justify-content-between w-100 py-2">
                            <div class="d-flex align-items-center justify-content-center">                                                
                                <input type="${questionType}" disabled ${isChecked ? "checked" : ""} class="rounded" style="width: 20px; height: 20px" />
                            </div>
                            <div class="d-flex align-items-center justify-content-center w-100 pl-3">
                                <label class="text-justify">${option.name}</label>
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
            html: `<div class="row mb-4 w-100">
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
            title: survey.name || "Survey",
            html: generateSurveyHtml(survey),
            showCancelButton: canCancel,
            confirmButtonText: "Submit",
            cancelButtonText: "Cancel",
            allowOutsideClick: canCancel,
            allowEscapeKey: canCancel,
            allowEnterKey: canCancel,
            preConfirm: () => {
                let allAnswered = true;
                const form = document.getElementById("surveyForm");
                const inputs = form.querySelectorAll("input, textarea");

                inputs.forEach((input) => {
                    if (input.type !== "hidden") {
                        if ((input.type === "radio" || input.type === "checkbox") && !input.checked) {
                            const name = input.name;
                            const options = document.querySelectorAll(`[name="${name}"]`);
                            const isChecked = Array.from(options).some((option) => option.checked);

                            if (!isChecked) {
                                allAnswered = false;
                                showError(input);
                            } else {
                                removeError(input);
                            }
                        } else if (input.type === "textarea" && input.value.trim() === "") {
                            allAnswered = false;
                            showError(input);
                        } else {
                            removeError(input);
                        }
                    }
                });

                if (!allAnswered) {
                    Swal.showValidationMessage("Please answer all questions before submitting.");
                    return false;
                } else {
                    const formData = new FormData(form);
                    const data = {};

                    for (const [key, value] of formData.entries()) {
                        const match = key.match(/^question_(\d+)$/);
                        if (match) {
                            const questionId = match[1];
                            if (!data[questionId]) {
                                data[questionId] = [];
                            }
                            data[questionId].push(value);
                        }
                    }

                    return $.ajax({
                        url: surveyStoreUrl,
                        method: "POST",
                        data: {
                            _token: csrfToken,
                            survey_id: survey.id,
                            answers: data,
                        },
                    }).then((response) => {
                        return response;
                    }).catch((error) => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    });
                }
            },
        }).then((result) => {
            if (result.isConfirmed) {
                saveCompletedSurvey(survey.id);
                if (survey.priority === 1) {
                    openNextSurvey();
                }
            }
        });
    }

    function generateSurveyHtml(survey) {
        let surveyHtml = `<form id="surveyForm">`;

        survey.surveys_questions.forEach((question, index) => {
            const questionType = question.input_type;

            surveyHtml += `<div class="mb-3">
                <label class="form-label">${index + 1}. ${question.question}</label>`;

            if (questionType === "textarea") {
                surveyHtml += `<textarea class="form-control" name="question_${question.id}" required></textarea>`;
            } else if (questionType === "radio") {
                question.answers.forEach((option) => {
                    surveyHtml += `<div class="form-check">
                        <input class="form-check-input" type="radio" name="question_${question.id}" value="${option.name}" required>
                        <label class="form-check-label">${option.name}</label>
                    </div>`;
                });
            } else if (questionType === "checkbox") {
                question.answers.forEach((option) => {
                    surveyHtml += `<div class="form-check">
                        <input class="form-check-input" type="checkbox" name="question_${question.id}" value="${option.name}">
                        <label class="form-check-label">${option.name}</label>
                    </div>`;
                });
            }

            surveyHtml += `</div>`;
        });

        surveyHtml += `<input type="hidden" name="_token" value="${csrfToken}">
            <input type="hidden" name="survey_id" value="${survey.id}">
        </form>`;

        return surveyHtml;
    }

    function saveCompletedSurvey(surveyId) {
        const completedSurveys = JSON.parse(localStorage.getItem("completedSurveys")) || [];
        completedSurveys.push(surveyId);
        localStorage.setItem("completedSurveys", JSON.stringify(completedSurveys));
    }

    function showError(input) {
        $(input).addClass("is-invalid");
    }

    function removeError(input) {
        $(input).removeClass("is-invalid");
    }
});
