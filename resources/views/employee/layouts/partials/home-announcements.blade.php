<div class="col-lg-4 col-12 mt-4 mt-lg-0">
        <div class="card">
            <div class="card-header text-center">Elanlar</div>
            <div class="card-body">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                    @foreach($announcements as $index => $announcement)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="cursor:pointer;">
                                <img class="d-block w-100" style="border-radius:5px;" src="{{ asset('assets/images/announcements/' . $announcement->image) }}" alt="Slide {{ $index + 1 }}">
                                <div class="carousel-caption d-md-block p-3" style="border-radius:15px; background-color: rgba(125, 159, 246, 0.5);">
                                    <h3 class="text-white">{{ $announcement->title }}</h3>
                                    <p class="text-white">{{ $announcement->content }}</p>
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
            </div>
        </div>
    </div>