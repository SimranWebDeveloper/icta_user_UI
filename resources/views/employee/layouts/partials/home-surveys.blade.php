<style>
  .swal2-popup {
      width: 80%;
  }

  .name-date-wrapper {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
  }   
  .name-date-wrapper h3, h4 {
      margin: 0 !important;
      padding: 0 !important;
  }

  .answers {
      gap: 1rem;
      text-align: center;
      align-items: center;
  }

  .answers label {
      width: 100%;
  }
</style>
<link rel="stylesheet" href="/css/surveys/surveys_cu.css">

<div class="col-lg-4 col-md-6">
  <div class="card">
      <div class="card-header">Anketlər</div>
      <div class="card-body scrollable-content pt-0">
          <div class="row">
              @foreach($surveys as $survey)
              <div class="col-6 mt-4">
                  <div class="card">
                      <div class="card-header text-center">{{ $survey->name }}</div>
                      <div class="card-body">
                          <div>
                              <p class="m-0" style="font-weight:bold">Silinmə tarixi:</p>
                              <p class="m-0">
                                  {{ \Carbon\Carbon::parse($survey->expired_at)->format('d-m-Y H:i') }} 
                              </p>
                          </div>
                          <div class="mt-3">
                              <p class="important">Önəmli</p>
                              <p class="normal">Normal</p>
                          </div>
                          <button id="loginButton" class="btn btn-success btn-lg mt-3" data-survey='@json($survey)'>
                              Cavabla
                          </button>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>
      </div>
  </div>
</div>


@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function () {
      // Attach click event handler to dynamically created buttons
      $(document).on('click', '#loginButton', function () {
          const survey = $(this).data('survey');
          console.log(survey); // Debug: Log survey data

          // Generate HTML for the survey modal
          Swal.fire({
              title: survey.name || 'Survey', // Use survey name or default to 'Survey'
              html: generateSurveyHtml(survey),
              showCancelButton: true,
              confirmButtonText: 'Submit',
              preConfirm: () => {
                  const form = document.getElementById('surveyForm');
                  if (form) {
                      console.log('Form is being submitted'); // Debug: Log form submission
                      // form.submit(); // Uncomment this line if you want to submit the form
                  }
              }
          });
      });
  });

  function generateSurveyHtml(survey) {
      if (!survey || !survey.surveys_questions || !Array.isArray(survey.surveys_questions)) {
          return '<p>Hələki Heç Bir Sual Yoxdur.</p>'; // Handle missing data
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
</script>

@endsection

