$(document).ready(function () {
    $(document).on("click", "#meetingButton", function () {
        const meeting = $(this).data("meeting");
        const is_answered = $(this).data("is-answered");
        let meetingTitle;

        if (meeting.type === 0) {
            meetingTitle = "İclas";
        } else if (meeting.type === 1) {
            meetingTitle = "Tədbir";
        } else if (meeting.type === 2) {
            meetingTitle = "Bron";
        }

        let participationButtons;
        if (is_answered === true) {
            participationButtons = `
                <button class="answerPopup btn btn-danger btn-lg participation-button" value="0" data-meeting-id="${meeting.id}">
                    İştirak etməyəcəm
                </button>`;
        } else if (is_answered === false) {
            participationButtons = `
                <button class="btn btn-info btn-lg participation-button" value="1" data-meeting-id="${meeting.id}">
                    İştirak edəcəm
                </button>`;
        } else {
            participationButtons = `
                <button class="btn btn-info btn-lg participation-button" value="1" data-meeting-id="${meeting.id}">
                    İştirak edəcəm
                </button>
                <button class="answerPopup btn btn-danger btn-lg participation-button" value="0" data-meeting-id="${meeting.id}">
                    İştirak etməyəcəm
                </button>`;
        }

        Swal.fire({
            title: meetingTitle,
            html: ` <div class="row mb-4 w-100">
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
                                        <div class="card-body meeting-content" style="text-align:start">
                                        ${meeting.content}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="mt-5">
                            ${participationButtons}
                        </div>
                </div>
            </div> `,
            showConfirmButton: false,
        });
    });

    $(document).on("click", ".participation-button", function () {
        const participationStatus = $(this).val();
        const meetingId = $(this).data("meeting-id");

        if (participationStatus == 0) {
            Swal.fire({
                title: "İştirak etməmə səbəbi",
                input: "textarea",
                inputPlaceholder: "Səbəbinizi daxil edin...",
                showCancelButton: true,
                confirmButtonText: "Göndər",
                cancelButtonText: "Ləğv et",
                customClass: {
                    popup: "notEmployee-popup",
                    container: "notEmployee",
                },
                preConfirm: (reason) => {
                    if (!reason) {
                        Swal.showValidationMessage(
                            "Zəhmət olmasa səbəbinizi daxil edin"
                        );
                    }
                    return { reason: reason };
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: window.participationStatusUrl,
                        method: "POST",
                        data: {
                            _token: window.csrfToken,
                            meeting_id: meetingId,
                            participation_status: participationStatus,
                            reason: result.value.reason,
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                title: "Cavabınız qeyd olundu!",
                                showConfirmButton: false,
                                customClass: {
                                    popup: "swal2-popup",
                                    container: "employeeMeetingModal",
                                },
                                timer: 1500,
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function (response) {
                            Swal.fire({
                                icon: "error",
                                title: "Xəta baş verdi!",
                                text: "Cavabınız qeyd edilərkən xəta baş verdi. Zəhmət olmasa bir daha cəhd edin.",
                            });
                        },
                    });
                }
            });
        } else {
            // Handle "İştirak edəcəm"
            $.ajax({
                url: window.participationStatusUrl,
                method: "POST",
                data: {
                    _token: window.csrfToken,
                    meeting_id: meetingId,
                    participation_status: participationStatus,
                },
                success: function (response) {
                    if (response.status === "error") {
                        Swal.fire({
                            title: "Xəta!",
                            text: response.message,
                            icon: "error",
                            confirmButtonText: "Tamam",
                            customClass: {
                                popup: "swal2-popup",
                                container: "employeeMeetingModal",
                            },
                        });
                    } else {
                        Swal.fire({
                            icon: "success",
                            title: "Cavabınız qeyd olundu!",
                            showConfirmButton: false,
                            customClass: {
                                popup: "swal2-popup",
                                container: "employeeMeetingModal",
                            },
                            timer: 1500,
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Xəta baş verdi!",
                        text: "Cavabınız qeyd edilərkən xəta baş verdi. Zəhmət olmasa bir daha cəhd edin.",
                    });
                },
            });
        }
    });
});
