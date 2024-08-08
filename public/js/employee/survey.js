$(document).ready(function () {
    const surveys = window.surveyData;
    const baseUrl = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
    const metaContent = document.querySelector('meta[name="csrf-token"]').content
    
    console.log(baseUrl);
    
    if (surveys && surveys.length > 0) {
        surveys.forEach(survey => {
            if (survey.priority === 1) {
                // Trigger the popup on page load for high priority surveys
                showSurveyPopup(survey, false);
                console.log(survey);
                
            }
        });
    } else {
        console.log('No surveys available.');
    }

    $('.surveyButton').on('click', function() {
        const survey = $(this).data('survey');
        showSurveyPopup(survey, survey.priority === 0);
    });

    function showSurveyPopup(survey, canCancel) {
        Swal.fire({
            title: survey.name || 'Survey',
            html: generateSurveyHtml(survey),
            showCancelButton: canCancel,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Cancel',
            allowOutsideClick: canCancel,
            allowEscapeKey: canCancel,
            allowEnterKey: canCancel,
            preConfirm: () => {
                let allAnswered = true;
                const form = document.getElementById('surveyForm');
                const inputs = form.querySelectorAll('input, textarea');

                inputs.forEach(input => {

                    if(input.type !== 'hidden'){
                        if ((input.type === 'radio' || input.type === 'checkbox') && !input.checked) {
                            const name = input.name;
                            const options = document.querySelectorAll(`[name="${name}"]`);
                            const isChecked = Array.from(options).some(option => option.checked);
                            
    
                            if (!isChecked) {
                                allAnswered = false;
                                showError(input);
                            } else {
                                removeError(input);
                            }
                        } else if (input.type === 'textarea' && !input.value.trim()) {
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
                    Swal.showValidationMessage('Zəhmət olmasa təqdim etməzdən əvvəl bütün tələb olunan suallara cavab verin.');
                    return false;
                }
            }
        });
    }

    function showError(input) {
        const errorText = document.createElement('span');
        errorText.className = 'error-text';
        errorText.style.color = 'red';
        errorText.innerText = 'Bu suala cavab verməyiniz tələb olunur.';

        const parent = input.closest('.card-body');
        if (!parent.querySelector('.error-text')) {
            parent.appendChild(errorText);
        }
    }

    function removeError(input) {
        
        const parent = input.closest('.card-body');
        const errorText = parent.querySelector('.error-text');
        if (errorText) {
            errorText.remove();
        }
    }

    function generateSurveyHtml(survey) {
        if (!survey || !survey.surveys_questions || !Array.isArray(survey.surveys_questions)) {
            return '<p>Hələki Heç Bir Sual Yoxdur.</p>';
        }

        let questionsHtml = '';
        survey.surveys_questions.forEach((question, index) => {
            let optionsHtml = '';
            if (question.input_type === 'radio') {
                question.answers.forEach(option => {
                    optionsHtml += `
                      <div class="answers d-flex form-check">
                          <input class="form-check-input" type="radio" value="${option.name}" name="question[${question.id}] id="option_${index}_${option.id}" required />
                          <label class="w-100" for="option_${index}_${option.id}">${option.name}</label>
                      </div>
                  `;
                });
            } else if (question.input_type === 'checkbox') {
                question.answers.forEach(option => {
                    optionsHtml += `
                      <div class="answers d-flex form-check">
                          <input class="form-check-input" type="checkbox" value="${option.name}" name="question[${question.id}][]" id="option_${index}_${option.id}" />
                          <label class="w-100" for="option_${index}_${option.id}">${option.name}</label>
                      </div>
                  `;
                });
            } else if (question.input_type === 'textarea') {
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
                      <form id="surveyForm" action='${baseUrl}/employee/surveys/store' method="POST">
                        <input name="_token" value="${csrfToken}" type="hidden">
                          <div class="card">
                              <div class="card-header">
                                  <div class="d-flex justify-content-between align-items-center">
                                      <div class="name-date-wrapper">
                                          <h3 class="ml-3 mt-0 mb-0 mr-0">
                                            ${survey.name} 
                                            ${survey.is_anonym === 1 ? '<span>(anonim)</span>' : ''}
                                        </h3>
                                          <h4 class="ml-3 mt-0 mb-0 mr-0">Bitme Tarixi: ${new Date(survey.expired_at).toLocaleDateString()} ${new Date(survey.expired_at).toLocaleTimeString()}</h4>
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
