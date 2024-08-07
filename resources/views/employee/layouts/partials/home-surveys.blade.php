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


