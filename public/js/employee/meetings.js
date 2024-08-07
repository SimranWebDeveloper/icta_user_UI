$(document).ready(function () {
    $(document).on('click', '#meetings', function () {
        Swal.fire({
            title: 'İclas',
            html:
                ` <div class="row mb-4 w-100">
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <h3 class="ml-3 mt-0 mr-0 mb-0 text-capitalize">
                                        <span class="text-lowercase">iclas</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Mövzu</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">movzu</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card mt-4 mt-md-0">
                                        <div class="card-header">
                                            <h3>Otaq nömrəsi</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">otaq nomresi</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card mt-4">
                                        <div class="card-header">
                                            <h3>Başlama tarixi</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">tarix</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card mt-4">
                                        <div class="card-header">
                                            <h3>Müddət (dəq)</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">muddet</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> `,
            showConfirmButton: false,
        });
    });
});