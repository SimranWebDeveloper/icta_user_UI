@extends('employee.layouts.app')
<style>
    .swal2-popup {
        width: 80%;
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
    let durationInMinutes = 60; // 2 hours
    let endDate = moment('2024-08-05T12:15').add(durationInMinutes, 'minutes').format('YYYY-MM-DDTHH:mm');
    $(document).ready(function () {
        $('#calendar').fullCalendar(
            {
                monthNames: ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'İyun', 'İyul', 'Avqust', 'Sentyabr', 'Oktyabr', 'Noyabr', 'Dekabr'],
                monthNamesShort: ['Yan', 'Fev', 'Mar', 'Apr', 'May', 'İyun', 'İyul', 'Avq', 'Sen', 'Okt', 'Noy', 'Dek'],
                dayNames: ['Bazar', 'Bazar ertəsi', 'Çərşənbə axşamı', 'Çərşənbə', 'Cümə axşamı', 'Cümə', 'Şənbə'],
                dayNamesShort: ['B.', 'B.E', 'Ç.A', 'Ç.', 'C.A', 'C.', 'Ş.'],
                eventClick: function (event) {
                    Swal.fire({
                        title: 'Event Details',
                        html: `<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h3 class="ml-3 mt-0 mr-0 mb-0 text-capitalize">${event.subject} <span
                                class="text-lowercase">
                                haqqında Rezerv
                            </span>


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
                                    <li class="list-group-item">
                                        ${event.subject}
                                    </li>
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
                                    <li class="list-group-item">
                                       ${event.room_number}
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
                                        ${moment(event.start).format('DD-MM-YYYY HH:mm')}
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
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        ${event.contect}
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
                                //burda olacaq 
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>`,
                        showCancelButton: true,
                        confirmButtonText: 'Redaktə et',
                        cancelButtonText: 'Sil',
                        cancelButtonColor: 'red'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `{{ route('employee.brons.edit', ['bron' => ':id']) }}`.replace(':id', event.id);
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
                        room_number: "{{ $meeting->rooms->name ?? 'Bilinmeyen Otaq' }}",
                        duration: "{{ $meeting->duration }}",
                        content: "{{ $meeting->content }}",
                        participants: {!! json_encode($meeting->participants->pluck('name')->toArray()) !!},
                        department: "{{ $meeting->department->name ?? 'Bilinmeyen Departament' }}",
                        branch: "{{ $meeting->branch->name ?? 'Bilinmeyen Branch' }}",
                        id: "{{ $meeting->id }}"

                    },
                    @endforeach
                ],


                timeFormat: 'HH:mm',

                // dayRender: function (date, cell) {
                //     let newDate = $.fullCalendar.formatDate(date, 'DD-MM-YYYY');
                //     if (newDate == '07-08-2024') {
                //         cell.css('background', "yellow")
                //     }
                //     else if (newDate == '09-08-2024') {
                //         cell.css('background', "red")
                //     }
                // }
            }
        );
    }); 
</script>
@endsection