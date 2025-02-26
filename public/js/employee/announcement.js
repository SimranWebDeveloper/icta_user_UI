$(document).ready(function () {
    $(document).on("click", ".announcement-item", function () {
        const announcement = $(this).data("announcement");
        const imageUrl = announcement.image
            ? `/assets/images/announcements/${announcement.image}`
            : "/assets/images/announcements/no_announcement.svg";

        Swal.fire({
            title: "Elan Detalları",
            html: `<div class="card-body">
                    <div class="row announcement">
                        <div class="col-md-6 col-sm-12">
                            <div class="card image">
                                <div class="card-header">
                                    <h3>Şəkil</h3>
                                </div>
                                <div class="card-body d-flex justify-content-center h-50">
                                    <img class="not-found-img rounded" src="${imageUrl}" alt="Image not available">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 mt-md-0 mt-4">
                            <div class="sticky-col">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Başlıq</h3>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <a>${announcement.title}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="date d-flex justify-content-between">
                                    <div class="card mt-4 w-50 ">
                                        <div class="card-header">
                                            <h3>Başlama Tarixi</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    ${announcement.start_date}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card mt-4 w-50" style="margin-left: 20px;">
                                        <div class="card-header">
                                            <h3>Bitmə Tarixi</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    ${announcement.end_date}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h3>Məzmun</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="textarea" style="max-height:250px; overflow-y:auto;text-align:start">
                                            ${announcement.content}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`,
            showConfirmButton: true,
            customClass: {
                popup: "announcement-popup",
                container: "announcementModal",
            },
        });
    });
});
