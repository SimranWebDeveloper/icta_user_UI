@extends('employee.layouts.app')
<style>
    .showModal .swal2-popup {
        width: 80%;
    }
    .bron-content{
        max-height: 200px;
        overflow-y: auto;
    }
    #swal2-html-container {
        overflow: hidden;
    }

    .fc-event-container {
        cursor: pointer;
    }

    .fc-list-item {
        cursor: pointer;
    }

    .fc-content-skeleton {
        overflow-y: auto;
        height: 100px;
    }
    .bronCause {
        transition-duration: .5s;
    }
    .bronCause:hover {
        color: blue
    }
    @media screen and (max-width: 768px) {
        .swal2-popup {
            width: 99%;
        }
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="m-0">Bronlar</h3>
            <a href="{{ route('employee.brons.create') }}">
                <button class="btn btn-success">
                    <span class="me-2">
                        <i class="nav-icon i-Add-File"></i>
                    </span>
                    Yeni bron
                </button>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="container">
            <div id="calendar"></div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<script>
    @php
        $groupedParticipants = [];
        foreach ($meetings as $meeting) {
            $participants = $meeting->participants->groupBy(function ($user) {
                return $user->departments_id . '-' . $user->branches_id;
            });

            foreach ($participants as $group => $users) {
                $department = $departments[$users->first()->departments_id] ?? 'Bilinməyən departament';
                $branch = $branches[$users->first()->branches_id] ?? 'Bilinməyən şöbə';

                $groupedParticipants[$meeting->id][] = [
                    'department' => $department,
                    'branch' => $branch,
                    'users' => $users->map(function ($user) {
                        return [
                            'name' => $user->name,
                            'participation_status' => $user->participation_status,
                            'reason' => $user->reason
                        ];
                    })->toArray()
                ];
            }
        }
    @endphp
    let groupedParticipants = @json($groupedParticipants);

    $(document).ready(function () {
        $('#calendar').fullCalendar({
            monthNames: ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'İyun', 'İyul', 'Avqust', 'Sentyabr', 'Oktyabr', 'Noyabr', 'Dekabr'],
            monthNamesShort: ['Yan', 'Fev', 'Mar', 'Apr', 'May', 'İyun', 'İyul', 'Avq', 'Sen', 'Okt', 'Noy', 'Dek'],
            dayNames: ['Bazar', 'Bazar ertəsi', 'Çərşənbə axşamı', 'Çərşənbə', 'Cümə axşamı', 'Cümə', 'Şənbə'],
            dayNamesShort: ['B.', 'B.E', 'Ç.A', 'Ç.', 'C.A', 'C.', 'Ş.'],
            eventClick: function (event) {
                let participants = groupedParticipants[event.id] || [];
                let participantsHtml = participants.map(group => {
                    return `<div class="d-xl-flex mt-3 align-items-start">
                        <h3 class="col-xl-2 m-0" style="text-align: start;">${group.department}</h3>
                        <h4 class="col-xl-2 mb-0 mt-2 mt-md-0" style="text-align: start;">${group.branch}</h4>
                        <div class="col-xl-8 d-flex align-items-start flex-wrap mt-2 mb-0 mt-md-0">
                            ${group.users.map(user => {
                                let statusClass = 
                                user.participation_status === 1 ? 'text-success' : 
                                (user.participation_status === 0 ? 'text-danger' : null);
                                let reasonText = user.reason ? `İştirak etməmə səbəbi: ${user.reason}` : '';
                                return `<h5 style="cursor:pointer" class="${statusClass} bronCause mt-1 mb-1 mt-md-0 mb-md-0"
                                    data-user-name="${user.name}" data-user-reason="${user.reason}" data-user-status="${user.participation_status}">
                                   ${user.name}
                                </h5>`;
                            }).join(', ')}
                        </div>
                    </div>`;
                }).join('<hr class="hr" />');
                Swal.fire({
                    html: `<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-center align-items-center">
                        <h3 class="ml-3 mt-0 mr-0 mb-0 text-capitalize">Otaq bronu</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Mövzu</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        ${event.subject}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3>Otaq nömrəsi</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                       ${event.room_number}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3>Başlama tarixi</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        ${moment(event.start).format('DD-MM-YYYY HH:mm')}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3>Müddət</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        ${event.duration} dəq
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
                            <div class="card-body bron-content" style="text-align:start">
                                        ${event.content}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3>İştirakçılar</h3>
                            </div>
                            <div class="card-body">
                               ${participantsHtml}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>`,
                    customClass: {
                        popup: 'swal2-popup', // Ensures that only this modal has the specific width
                        container: 'showModal' // Custom class to differentiate this modal
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Redaktə et',
                    cancelButtonText: 'Sil',
                    cancelButtonColor: 'red'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `{{ route('employee.brons.edit', ['bron' => ':id']) }}`.replace(':id', event.id);
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        $.ajax({
                            url: "/employee/brons/" + event.id,
                            type: "DELETE",
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                Swal.fire(response.message).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            },
                        });
                    }
                });
            },
            header: {
                left: 'month,agendaWeek,agendaDay,list',
                center: 'title',
                right: 'prev,today,next'
            },
            buttonText: {
                month: "Ay",
                week: "Həftə",
                day: "Gün",
                list: "List",
                today: "Bu gün"
            },
            events: [
                @foreach ($meetings as $meeting)
                {
                    title: "{{ $meeting->subject }}",
                    start: "{{ $meeting->start_date_time }}",
                    end: moment("{{ $meeting->start_date_time }}").add({{ $meeting->duration }}, 'minutes').format('YYYY-MM-DDTHH:mm'),
                    color: 'green',
                    textColor: 'white',
                    subject: "{{ $meeting->subject }}",
                    content: "{{ $meeting->content }}",
                    room_number: "{{ $meeting->rooms->name ?? 'Bilinmeyen Otaq' }}",
                    duration: "{{ $meeting->duration }}",
                    participants: {!! json_encode($meeting->participants->pluck('name')->toArray()) !!},
                    department: "{{ $meeting->department->name ?? 'Bilinmeyen Departament' }}",
                    branch: "{{ $meeting->branch->name ?? 'Bilinmeyen Branch' }}",
                    id: "{{ $meeting->id }}"
                },
                @endforeach
            ],
            timeFormat: 'HH:mm',
        });

        $(document).on("click", ".bronCause", function () {
            const user = $(this).data("user-name");
            const reason = $(this).data("user-reason") || '';
            const participantStatus = $(this).data("user-status");

            let answersHtml = '';

            if ((!reason || reason === '') && participantStatus === 1) {
                answersHtml += `<p>${user} iştirakını təsdiqlədi.</p>`;
            } else if (participantStatus === 0) {
                answersHtml += `<p class="font-weight-bold">İştirak etməmə səbəbi: <span class="font-weight-normal">${reason}</span></p>`;
            } else {
                answersHtml += `<p>${user} iştirakının təsdiqlənməsi gözlənilir.</p>`;
            }

            Swal.fire({
                title: `${user}`,
                html: `
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">İştirak Statusu</div>
                            <div class="card-body">
                                ${answersHtml}
                            </div>
                        </div>
                    </div>
                </div>`,
                showCancelButton: false,
                confirmButtonText: "Ok",
                customClass: {
                    popup: 'swal2-popup',
                    container: 'employeeAnswerModal'
                }
            });
        });
    });
</script>
@endsection
