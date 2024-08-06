@extends('employee.layouts.app')
<style>
    @keyframes norm {
        0% {
            color: blue;
        }

        50% {
            color: white;
        }

        100% {
            color: blue;
        }
    }

    @keyframes important {
        0% {
            color: red;
        }

        50% {
            color: white;
        }

        100% {
            color: red;
        }
    }


    @keyframes unread {
        0% {
            background-color: blue;
        }

        50% {
            background-color: white;
        }

        100% {
            background-color: blue;
        }
    }

    .important {
        animation: important 0.5s infinite;
    }

    .normal {
        animation: norm 2s infinite;
    }

    .unread {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        animation: unread 2s infinite;
    }

    .scrollable-content {
        height: 400px;
        overflow-y: auto;
    }

    #meeting {
        transition: .4s;
    }

    #meeting:hover {
        scale: 1.05;
    }

    .carousel-inner img {
        width: 100%;
        height: 365px;
        object-fit: cover;
    }
</style>

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Information Management System
                    <code>
                            (version 1.0.0)
                        </code>
                </h3>

                <div>
                    @if(is_array(display_user_types()) && count(display_user_types()) > 1)
                        @foreach(display_user_types() as $type_key => $types)
                            @foreach($types as $type)
                                <a href="{{ $type['route'] }}">
                                    <button class="btn btn-lg btn-secondary text-white font-weight-700">
                                        {{ $type['name'] }} hesabına keçid edin
                                    </button>
                                </a>
                            @endforeach
                        @endforeach
                    @endif
                </div>

            </div>

            <div class="card-body text-center">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <code>
                        Hörmətli {{\Illuminate\Support\Facades\Auth::user()->name}}, sistemin təhlükəsizliyi üçün
                        şifrənizi gizli saxlayın
                    </code>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
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
                                <button class="btn btn-success btn-lg mt-3">
                                    Cavabla
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
        <div class="card">
            <div class="card-header">Iclas və tədbirlər</div>
            <div class="card-body scrollable-content pt-0">
                <div class="row">
                    <div class="col-6 mt-4">
                        <div id="meeting" class="card" style="cursor:pointer; font-weight:bold">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="m-0">Mövzu adı</p>
                                    <div class="unread m-0"></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>Otaq 1</p>
                                <p class="m-0">2024-12-15 12:30-dan etibarən 90 dəqiqə</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div id="meeting" class="card" style="cursor:pointer">
                            <div class="card-header text-center">Mövzu adı</div>
                            <div class="card-body">
                                <p>Otaq 1</p>
                                <p class="m-0">2024-12-15 12:30-dan etibarən 90 dəqiqə</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div id="meeting" class="card" style="cursor:pointer">
                            <div class="card-header text-center">Mövzu adı</div>
                            <div class="card-body">
                                <p>Otaq 1</p>
                                <p class="m-0">2024-12-15 12:30-dan etibarən 90 dəqiqə</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div id="meeting" class="card" style="cursor:pointer">
                            <div class="card-header text-center">Mövzu adı</div>
                            <div class="card-body">
                                <p>Otaq 1</p>
                                <p class="m-0">2024-12-15 12:30-dan etibarən 90 dəqiqə</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div id="meeting" class="card" style="cursor:pointer">
                            <div class="card-header text-center">Mövzu adı</div>
                            <div class="card-body">
                                <p>Otaq 1</p>
                                <p class="m-0">2024-12-15 12:30-dan etibarən 90 dəqiqə</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div id="meeting" class="card" style="cursor:pointer">
                            <div class="card-header text-center">Mövzu adı</div>
                            <div class="card-body">
                                <p>Otaq 1</p>
                                <p class="m-0">2024-12-15 12:30-dan etibarən 90 dəqiqə</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12 mt-4 mt-lg-0">
        <div class="card">
            <div class="card-header text-center">Elanlar</div>
            <div class="card-body">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="cursor:pointer">
                            <img class="d-block w-100" style="border-radius:5px;"
                                src="https://images.unsplash.com/photo-1517292987719-0369a794ec0f?q=80&w=1674&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="First slide">
                            <div class="carousel-caption d-md-block p-3"
                                style="border-radius:15px; background-color: rgba(125, 159, 246, 0.5);">
                                <h3 class="text-white">Başlıq</h3>
                                <p class="text-white">Məzmun</p>
                            </div>
                        </div>
                        <div class="carousel-item" style="cursor:pointer">
                            <img class="d-block w-100"
                                src="https://images.unsplash.com/photo-1597075095386-87bdd1ee195c?q=80&w=1889&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Second slide">
                            <div class="carousel-caption d-md-block bg-success" style="border-radius:15px">
                                <h3 class="text-white">Başlıq</h3>
                                <p class="text-white">Məzmun</p>
                            </div>
                        </div>
                        <div class="carousel-item" style="cursor:pointer">
                            <img class="d-block w-100"
                                src="https://images.unsplash.com/photo-1666408738188-212c470d08b0?q=80&w=1760&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Third slide">
                            <div class="carousel-caption d-md-block bg-primary" style="border-radius:15px">
                                <h5 class="text-white">Başlıq</h5>
                                <p class="text-white">Məzmun</p>
                            </div>
                        </div>
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
</div>
@endsection