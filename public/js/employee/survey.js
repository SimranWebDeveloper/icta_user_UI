$(document).ready(function () {
    $(document).on('click', '#loginButton', function () {
        const survey = $(this).data('survey');
        console.log(survey); 
        Swal.fire({
            title: survey.name || 'Survey', 
            html: generateSurveyHtml(survey),
            showCancelButton: true,
            confirmButtonText: 'Submit',
            preConfirm: () => {
                const form = document.getElementById('surveyForm');
                if (form) {
                    console.log('Form is being submitted');
                    form.submit(); 
                }
            }
        });
    });
});

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
                        <input class="form-check-input" type="radio" name="question_${index}" id="option_${index}_${option.id}" />
                        <label class="w-100" for="option_${index}_${option.id}">${option.name}</label>
                    </div>
                `;
            });
        } else if (question.input_type === 'checkbox') {
            question.answers.forEach(option => {
                optionsHtml += `
                    <div class="answers d-flex form-check">
                        <input class="form-check-input" type="checkbox" name="question_${index}[]" id="option_${index}_${option.id}" />
                        <label class="w-100" for="option_${index}_${option.id}">${option.name}</label>
                    </div>
                `;
            });
        } else if (question.input_type === 'textarea') {
            optionsHtml = `
                <div>
                    <textarea rows="7" cols="10" class="form-control" name="question_${index}"></textarea>
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
                    <form id="surveyForm">
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