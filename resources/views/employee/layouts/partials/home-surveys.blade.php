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
    .name-date-wrapper h3,h4{
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
                            <button id="loginButton" class="btn btn-success btn-lg mt-3">
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
<script>
    $(document).ready(function () {
        $('#loginButton').on('click', function () {
            Swal.fire({
                title: 'Yeni Anket',
                html: `
           <div class="pt-4 custom-container bg-white">
      <div class="row">
        <div class="col-12">
          <form>
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="name-date-wrapper">
                    <h3 class="ml-3 mt-0 mb-0 mr-0">Anketin adi <span>(anonim)</span> </h3>
                    <h4 class="ml-3 mt-0 mb-0 mr-0">
                      Bitme Tarixi: 12.21.2324
                    </h4>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 col-sm-12 mb-4">
                    <div class="card">
                      <div class="card-header d-flex justify-content-center">
                        <h4>1.</h4>
                        <h4>Lorem, ipsum dolor?</h4>
                      </div>
                      <div class="card-body">
                        <!-- ------- -->
                        <div class="answers d-flex form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault1"
                          />
                          <label class="w-100" for="">yaxsi </label>
                        </div>
                        <!-- ------- -->

                        <div class="answers d-flex form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault1"
                          />
                          <label class="" for=""
                            >Lorem ipsum dolor.</label
                          >
                        </div>
                        <div class="answers d-flex form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault1"
                          />
                          <label class="w-100" for="">Pis</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-4">
                    <div class="card">
                      <div class="card-header d-flex justify-content-center">
                        <h4>1.</h4>
                        <h4>Lorem, ipsum dolor?</h4>
                      </div>
                      <div class="card-body">
                        <div class="answers d-flex form-check">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            id="flexCheckDefault"
                          />
                          <label class="w-100" for="">Yaxsi</label>
                        </div>
                        <div class="answers d-flex form-check">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            id="flexCheckDefault"
                          />
                          <label class="w-100" for="">Orta</label>
                        </div>
                        <div class="answers d-flex form-check">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            id="flexCheckDefault"
                          />
                          <label class="w-100" for="">Pis</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-4">
                    <div class="card">
                      <div class="card-header d-flex justify-content-center">
                        <h4>1.</h4>
                        <h4>Lorem, ipsum dolor?</h4>
                      </div>
                      <div class="card-body">
                        <div>
                          <textarea
                            rows="7"
                            cols="10"
                            class="form-control"
                          ></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Submit',
                preConfirm: () => {
                    // Perform the form submission here
                    const form = document.getElementById('myForm');
                    form.submit();
                }
            });
        });
    });
</script>
@endsection