<style>
    .swal2-popup {
        width: 80%;
    }
</style>
<link rel="stylesheet" href="/css/surveys/surveys_cu.css">

<div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-header">Anketlər</div>
            <div class="card-body scrollable-content pt-0">
                <div class="row">
                    <div class="col-6 mt-4">
                        <div class="card">
                            <div class="card-header text-center">Anket adı</div>
                            <div class="card-body">
                                <div>
                                    <p class="m-0" style="font-weight:bold">Silinmə tarixi:</p>
                                    <p class="m-0">
                                        2024-12-12
                                    </p>
                                </div>
                                <div class="mt-3">
                                    <p class="important" style="font-weight:bold">Önəmli</p>
                                </div>
                                <button class="btn btn-success btn-lg mt-3">
                                    Cavabla
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div class="card">
                            <div class="card-header text-center">Anket adı</div>
                            <div class="card-body">
                                <div>
                                    <p class="m-0" style="font-weight:bold">Silinmə tarixi:</p>
                                    <p class="m-0">
                                        2024-12-12
                                    </p>
                                </div>
                                <div class="mt-3">
                                    <p class="normal">Normal</p>
                                </div>
                                <button class="btn btn-success btn-lg mt-3">
                                    Cavabla
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div class="card">
                            <div class="card-header text-center">Anket adı</div>
                            <div class="card-body">
                                <div>
                                    <p class="m-0" style="font-weight:bold">Silinmə tarixi:</p>
                                    <p class="m-0">
                                        2024-12-12
                                    </p>
                                </div>
                                <div class="mt-3">
                                    <p class="important">Önəmli</p>
                                </div>
                                <button class="btn btn-success btn-lg mt-3">
                                    Cavabla
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div class="card">
                            <div class="card-header text-center">Anket adı</div>
                            <div class="card-body">
                                <div>
                                    <p class="m-0" style="font-weight:bold">Silinmə tarixi:</p>
                                    <p class="m-0">
                                        2024-12-12
                                    </p>
                                </div>
                                <div class="mt-3">
                                    <p class="important">Önəmli</p>
                                </div>
                                <button class="btn btn-success btn-lg mt-3">
                                    Cavabla
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div class="card">
                            <div class="card-header text-center">Anket adı</div>
                            <div class="card-body">
                                <div>
                                    <p class="m-0" style="font-weight:bold">Silinmə tarixi:</p>
                                    <p class="m-0">
                                        2024-12-12
                                    </p>
                                </div>
                                <div class="mt-3">
                                    <p class="important">Önəmli</p>
                                </div>
                                <button class="btn btn-success btn-lg mt-3">
                                    Cavabla
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div class="card">
                            <div class="card-header text-center">Anket adı</div>
                            <div class="card-body">
                                <div>
                                    <p class="m-0" style="font-weight:bold">Silinmə tarixi:</p>
                                    <p class="m-0">
                                        2024-12-12
                                    </p>
                                </div>
                                <div class="mt-3">
                                    <p class="important">Önəmli</p>
                                </div>
                                <button id="loginButton" class="btn btn-success btn-lg mt-3">
                                    Cavabla
                                </button>
                            </div>
                        </div>
                    </div>
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
                <div class="row mb-4">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <!-- general info -->
                <div class="row mb-3">
                    <!-- Anket adi -->
                    <div class="col-md-6 col-lg-4 col-xl-3 form-group mb-3">
                        <div class="select_label ui sub header">Anket adı: </div>
                        <span>Salam</span>
                    </div>
                    <!-- Tarix -->
                    <div class="col-md-6 col-lg-4 col-xl-3 form-group mb-3">
                        <div class="select_label ui sub header">Silinmə tarixi:
                        </div>
                        <span>SAlam</span>
                    </div>
                </div>

                <!-- questions container -->
                <div class="row questions-container">
                    <!-- question 1 -->
                    <div class="col-lg-6 my-3" id="c0">
                        <div class="row custom-card position-relative">
                            <div class="col-md-8 form-group mb-3">
                                <div class="select_label ui sub header"><span></span>Sual:</div>
                                <span>SAlam</span>
                            </div>
                            <div class="col-md-12 form-group mb-3" id="todo-content-0">
                                <div class="select_label ui sub header ">Cavab və ya cavablar:</div>
                                <div class="todo-container" style="width: 100%;">
                                    <div>
                                        <input type="checkbox">
                                        <label for="">salam</label>
                                    </div>
                                    <div>
                                        <input type="checkbox">
                                        <label for="">sagol</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 my-3" id="c0">
                        <div class="row custom-card position-relative">
                            <div class="col-md-8 form-group mb-3">
                                <div class="select_label ui sub header"><span></span>Sual:</div>
                                <span>SAlam</span>
                            </div>
                            <div class="col-md-12 form-group mb-3" id="todo-content-0">
                                <div class="select_label ui sub header ">Cavab və ya cavablar:</div>
                                <div class="todo-container" style="width: 100%;">
                                    <div>
                                        <input type="radio">
                                        <label for="">salam</label>
                                    </div>
                                    <div>
                                        <input type="radio">
                                        <label for="">sagol</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 my-3" id="c0">
                        <div class="row custom-card position-relative">
                            <div class="col-md-8 form-group mb-3">
                                <div class="select_label ui sub header"><span></span>Sual:</div>
                                <span>SAlam</span>
                            </div>
                            <div class="col-md-12 form-group mb-3" id="todo-content-0">
                                <div class="select_label ui sub header ">Cavab və ya cavablar:</div>
                                <div class="todo-container" style="width: 100%;">
                                    <div>
                                        <textarea name="" id=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- submit button -->
                <div class="mt-4">
                    <button class="btn btn-success btn-lg">Cavabla</button>
                </div>
            </div>
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