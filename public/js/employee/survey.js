$(document).ready(function () {
    const surveys = window.surveyData;
    const surveyStoreUrl = window.surveyStoreUrl; // URL-i dəyişkəndən əldə edin
    const csrfToken = window.csrfToken; // CSRF tokeni dəyişkəndən əldə edin

    if (surveys && surveys.length > 0) {
        surveys.forEach((survey) => {
            if (survey.priority === 1) {
                // Trigger the popup on page load for high priority surveys
                showSurveyPopup(survey, false);
            }
        });
    } else {
        console.log("No surveys available.");
    }

    // cavablari gor
    $(".showSurveyButton").on("click", function () {
        const survey = $(this).data("survey");
        showUserAnswer();
    });
    // cavabla
    $(".surveyButton").on("click", function () {
        const survey = $(this).data("survey");
        showSurveyPopup(survey, survey.priority === 0);
    });

    function showUserAnswer() {
        $(".showSurveyButton").on("click", function () {
            Swal.fire({
                title: "Anket Detalları",
                html: `
                    <div class="row mb-4 w-100">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <!-- checkbox -->
                    <div class="col-lg-6 col-12">                        
                        <div class="card mb-4">
                            <div class="card-header w-100 d-flex justify-content-center align-items-center">
                                <h3 class="m-0">1.</h3>
                                <h3 class="m-0">cox variantli</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group-custom">

                                    <li class="d-flex my-3 align-items-center w-100 justify-content-between">
                                       <div class="d-flex align-items-center justify-content-between  w-100 py-2">
                                            <div class="d-flex align-items-center justify-content-center">                                                
                                                <input type="checkbox" disabled checked class=" rounded" style="width: 35px; height: 35px" />
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center  w-100 pl-3">
                                                <label class="text-justify">
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                </label>
                                            </div>
                                       </div>
                                    </li>
                                    <li class="d-flex my-3 align-items-center w-100 justify-content-between">
                                       <div class="d-flex align-items-center justify-content-between  w-100 py-2">
                                            <div class="d-flex align-items-center justify-content-center">                                                
                                                <input type="checkbox" disabled  class=" rounded" style="width: 35px; height: 35px" />
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center  w-100 pl-3">
                                                <label class="text-justify">
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                </label>
                                            </div>
                                       </div>
                                    </li>                              

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- radio -->
                    <div class="col-lg-6 col-12">                        
                        <div class="card mb-4">
                            <div class="card-header w-100 d-flex justify-content-center align-items-center">
                                <h3 class="m-0">2.</h3>
                                <h3 class="m-0">Tek variantli</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group-custom">

                                    <li class="d-flex my-3 align-items-center w-100 justify-content-between">
                                       <div class="d-flex align-items-center justify-content-between  w-100 py-2">
                                            <div class="d-flex align-items-center justify-content-center">                                                
                                                <input type="radio" disabled checked name="radio_name" class=" rounded" style="width: 35px; height: 35px" />
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center  w-100 pl-3">
                                                <label class="text-justify">
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                    cavab 1 variant
                                                </label>
                                            </div>
                                       </div>
                                    </li>
                                    <li class="d-flex my-3 align-items-center w-100 justify-content-between">
                                       <div class="d-flex align-items-center justify-content-between  w-100 py-2">
                                            <div class="d-flex align-items-center justify-content-center">                                                
                                                <input type="radio" disabled name="radio_name" class=" rounded" style="width: 35px; height: 35px" />
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center  w-100 pl-3">
                                                <label class="text-justify">
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                    cavab 2 variant
                                                </label>
                                            </div>
                                       </div>
                                    </li>                              

                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- text -->
                    <div class="col-lg-6 col-12">                        
                        <div class="card mb-4">
                            <div class="card-header w-100 d-flex justify-content-center align-items-center">
                                <h3 class="m-0">2.</h3>
                                <h3 class="m-0">Metn</h3>
                            </div>
                            <div class="card-body">
                                <ul class="w-100  pl-0">

                                    <li class=" d-flex my-3 align-items-center w-100 justify-content-between ">
                                       <div class="d-flex align-items-center justify-content-between  w-100 ">
                                            
                                                <textarea  rows="7" cols="10" class="w-100 " disabled="" style="resize: none;"></textarea>

                                       </div>
                                    </li>
                                                  

                                </ul>
                            </div>
                        </div>
                    </div>


                </div>


            </div>


        </div>
    </div>
</div>
                `,

              

                showConfirmButton: true,
            });
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
                    form.submit();
                } else {
                    Swal.showValidationMessage(
                        "Zəhmət olmasa təqdim etməzdən əvvəl bütün tələb olunan suallara cavab verin."
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
                                          <h4 class="ml-3 mt-0 mb-0 mr-0">Bitme Tarixi: ${new Date(
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
