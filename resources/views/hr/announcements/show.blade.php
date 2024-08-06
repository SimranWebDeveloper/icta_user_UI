@extends('hr.layouts.app')
<style>
    #list-item {
        list-style: none;
    }

    .sticky-col {
        position: -webkit-sticky;
        /* Safari */
        position: sticky;
        top: 100;
    }
</style>
@section('content')
<link rel="stylesheet" href="/css/announcement/table_show.css">

<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <ul class="m-0 p-0">
                            <li id="list-item">
                                @if ($announcement->status == 0)
                                    <button class="btn btn-danger text-white">
                                        Deaktiv
                                    </button>
                                @elseif ($announcement->status == 1)
                                    <button class="btn btn-success text-white">
                                        Aktiv
                                    </button>
                                @elseif ($announcement->status == 2)
                                    <button class="btn btn-warning text-white">
                                        Gözləmə
                                    </button>
                                @endif
                            </li>
                        </ul>
                        <h3 class="ml-3 mt-0 mr-0 mb-0">
                            Elan
                        </h3>
                    </div>
                    <a href="{{ route('hr.announcements.index') }}">
                        <button class="btn btn-danger">
                            <span class="me-2">
                                <i class="nav-icon i-Arrow-Back-2"></i>
                            </span>
                            Elanlar
                        </button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row announcement">
                    <div class="col-md-6 col-sm-12">
                        <div class="card image">
                            <div class="card-header">
                                <h3>Şəkil</h3>
                            </div>
                            <div class="card-body d-flex justify-content-center h-50">
                                @if ($announcement->image)
                                    <img class="rounded"
                                        src="{{ asset('assets/images/announcements/' . $announcement->image) }}" alt="">
                                @else
                                    <img class="not-found-img w-50"
                                        src="{{asset('assets/images/announcements/not-found-image.jpg')}}" alt="">
                                @endif
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
                                            <a>{{ $announcement->title }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="date d-flex justify-content-between">
                                <div class="card mt-4 w-50">
                                    <div class="card-header">
                                        <h3>Başlama Tarixi</h3>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <a>{{ \Carbon\Carbon::parse($announcement->start_date)->format('d/m/Y') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card mt-4 w-50">
                                    <div class="card-header">
                                        <h3>Bitmə Tarixi</h3>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <a>{{ \Carbon\Carbon::parse($announcement->end_date)->format('d/m/Y') }}</a>
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
                                    <div class="textarea">
                                        {{ $announcement->content }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('hr.announcements.edit', $announcement->id) }}">
                    <button class="btn btn-info btn-lg">
                        <span class="me-2">
                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                        </span>
                        Redaktə et
                    </button>
                </a>
                <a href="#" class="delete-item" data-id="{{ $announcement->id }}">
                    <button class="btn btn-danger btn-lg">
                        <span class="me-2">
                            <ion-icon name="trash-outline"></ion-icon>
                        </span>
                        Sil
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('.delete-item').on("click", function () {
            const item_id = $(this).data('id');
            Swal.fire({
                title: "Silmək istədiyinizdən əminsiniz ?",
                text: "Qeyd edək ki, silmək istədiyiniz elemendə bağlı olan bütün məlumatlar silinəcək!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sil!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/hr/announcements/" + item_id,
                        type: "DELETE",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            Swal.fire(response.message).then((result) => {
                                if (result.isConfirmed) {
                                    location.href = response.route;
                                }
                            });
                        },
                    })
                }
            })
        })
    })
</script>
@endsection