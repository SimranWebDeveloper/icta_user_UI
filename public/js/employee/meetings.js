$(document).ready(function () {
    $(document).on('click', '#meetingButton', function () {
        const meeting = $(this).data('meeting');
        let meetingTitle;

        if (meeting.type === 0) {
            meetingTitle = 'İclas';
        } else if (meeting.type === 1) {
            meetingTitle = 'Tədbir';
        }

        Swal.fire({
            title: meetingTitle,
            html:
                ` <div class="row mb-4 w-100">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Mövzu</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item"> ${meeting.subject} </li>
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
                                                <li class="list-group-item">${meeting.rooms.name}</li>
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
                                                <li class="list-group-item">${meeting.start_date_time}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card mt-4">
                                        <div class="card-header">
                                            <h3>Müddət</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">${meeting.duration} dəq</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card mt-4">
                                        <div class="card-header">
                                            <h3>Məzmun</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    ${meeting.content}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#">
                                <button class="btn btn-success btn-lg">
                                    İştirak edəcəm
                                </button>
                            </a>
                            <a href="#">
                                <button class="btn btn-danger btn-lg">
                                    İştirak etməyəcəm
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div> `,
            showConfirmButton: false,
        });
    });
});