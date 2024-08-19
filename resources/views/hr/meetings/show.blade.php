@extends('hr.layouts.app')
<style>
    #list-item {
        list-style: none;
    }

    .swal2-html-container {
        overflow-x: hidden !important;
    }
</style>
@section('content')
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <ul class="m-0 p-0">
                            <li id="list-item">
                                @if ($meeting->status == 0)
                                    <button class="btn btn-danger text-white">
                                        Deaktiv
                                    </button>
                                @elseif ($meeting->status == 1)
                                    <button class="btn btn-success text-white">
                                        Aktiv
                                    </button>
                                @endif
                            </li>
                        </ul>
                        <h3 class="ml-3 mt-0 mr-0 mb-0 text-capitalize">{{ $meeting->subject }}</h3>
                    </div>
                    <a href="{{route('hr.meetings.index')}}">
                        <button class="btn btn-danger">
                            <span class="me-2">
                                <i class="nav-icon i-Arrow-Back-2"></i>
                            </span>
                            İclas və ya tədbirlər
                        </button>
                    </a>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Mövzu</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        {{ $meeting->subject }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card mt-4 mt-md-0">
                            <div class="card-header">
                                <h3>Otaq nömrəsi</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        {{ $meeting->rooms->name }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card mt-4 mt-md-0">
                            <div class="card-header">
                                <h3>Növ</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        {{ $meeting->type == 0 ? 'İclas' : 'Tədbir' }}
                                    </li>
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
                                    <li class="list-group-item">
                                        {{ $meeting->start_date_time }}
                                    </li>
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
                                    <li class="list-group-item">
                                        {{ $meeting->duration }} dəq
                                    </li>
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
                                        {{ $meeting->content }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3>İştirakçılar</h3>
                            </div>
                            <div class="card-body">
                                @php
                                    $groupedParticipants = $participants->groupBy(function ($user) {
                                        return $user->departments_id . '-' . $user->branches_id;
                                    });
                                @endphp

                                @foreach($groupedParticipants as $group => $users)
                                    <div class="d-xl-flex mt-3 align-items-start">
                                        <h3 class="col-xl-2 m-0">
                                            {{ $departments[$users->first()->departments_id] ?? 'Bilinməyən departament' }}
                                        </h3>

                                        <h4 class="col-xl-2 mb-0 mt-2 mt-md-0">
                                            {{ $branches[$users->first()->branches_id] ?? 'Bilinməyən şöbə' }}
                                        </h4>

                                        <div class="col-xl-8 d-flex align-items-start flex-wrap mt-2 mb-0 mt-md-0">
                                            @foreach($users as $index => $user)
                                            @php 
                                                    $participant_status = 
                                                    $user->participation_status === 1 ? 'text-success' : 
                                                    ($user->participation_status === 0 ? 'text-danger' : null);
                                            @endphp
                                                <h5 style="cursor:pointer"
                                                    class="meetingCause {{ $participant_status }} mt-1 mb-1 mt-md-0 mb-md-0"
                                                    data-user-name="{{ $user->name }}" data-user-reason="{{$user->reason}}" data-status="{{$user->participation_status}}">
                                                    {{ $user->name }}
                                                </h5>
                                                {{ $index < count($users) - 1 ? ', ' : '' }}
                                            @endforeach
                                        </div>
                                    </div>
                                    @if (!$loop->last)
                                        <hr class="hr" />
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <a href="{{ route('hr.meetings.edit', $meeting->id) }}">
                    <button class="btn btn-info btn-lg">
                        <span class="me-2">
                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                        </span>
                        Redaktə et
                    </button>
                </a>
                <a href="#" class="delete-item" data-id="{{ $meeting->id }}">
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
                        url: "/hr/meetings/" + item_id,
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

        $(document).on("click", ".meetingCause", function () {
            const user = $(this).data("user-name");
            const reason = $(this).data("user-reason") || '';
            const status = $(this).data("status");
            console.log(status);
            let answersHtml = '';


            if (status === 1) {
                answersHtml += `<p>${user} iştirakını təsdiqlədi.</p>`;
            } else if (status === 0) {
                answersHtml += `<p class="font-weight-bold">İştirak etməmə səbəbi: <span class="font-weight-normal">${reason}</span></p>`;
            } else {
                answersHtml += `<p>${user} iştirakının təsdiqlənməsi gözlənilir.</p>`;
            }





            Swal.fire({
                title: `${user}`,
                html: `
                <div class="row"  >
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">İştirak Statusu</div>
                            <div class="card-body">
                                    ${answersHtml}
                            </div>
                        </div>
                     </div>
                    </div>
        </div >`,
                showCancelButton: false,
                confirmButtonText: "Ok",
                customClass: {
                    popup: 'swal2-popup',
                    container: 'employeeAnswerModal'
                }
            });
        });
    })
</script>
@endsection