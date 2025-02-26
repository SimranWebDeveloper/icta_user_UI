<style>
    .fixed-height {
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .no-announcement {
        margin: 0;
        font-size: 1.2rem;
        color: #666;
        text-align: center;
    }

    #carouselExampleControls {
        width: 100%;
    }

    .carousel-item {
        width: 100%;
    }

    .carousel-item img {
        width: 100%;
        height: 365px;
        object-fit: cover;
    }

    @media screen and (max-width:990px) {
        .announcementModal .announcement-popup {
            width: 99%;
        }

    }

    .announcementContent {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<div class="col-lg-4 col-12 mt-4 mt-lg-0">
    <div class="card">
        <div class="card-header text-center" style="font-size:24px">Elanlar</div>
        <div class="card-body fixed-height">
            @if($announcements->isEmpty())
                <p class="no-announcement">Hal-hazırda aktiv elan yoxdur</p>
            @else
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($announcements as $index => $announcement)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }} announcement-item data-announcement='@json($announcement)'"
                                                data-announcement='@json($announcement)' style="cursor:pointer;">
                                                @php
                                                    $image = $announcement->image
                                                        ? asset('assets/images/announcements/' . $announcement->image)
                                                        : asset('assets/images/announcements/no_announcement.svg');
                                                @endphp
                                                <img class="d-block w-100" style="border-radius:5px;" src="{{ $image }}"
                                                    alt="Slide {{ $index + 1 }}">
                                                <div class="carousel-caption d-md-block p-3"
                                                    style="border-radius:15px; background-color: rgba(125, 159, 246, 0.8);">
                                                    <h3 class="text-white announcementContent">{{ $announcement->title }}</h3>
                                                    <!-- <p class="text-white announcementContent">{{ $announcement->content }}</p> -->
                                                </div>
                                            </div>
                            @endforeach

                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
            @endif
        </div>
    </div>
</div>