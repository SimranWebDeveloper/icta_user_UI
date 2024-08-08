@extends('employee.layouts.app')
<style>
    .swal2-popup {
        width: 80%;
    }

    #swal2-html-container {
        overflow: hidden;
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

@section('content')

<!-- <div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="m-0">İclas və tədbir</h3>
                    <a href="{{ route('employee.brons.create') }}">
                        <button class="btn btn-success">
                            <span class="me-2">
                                <i class="nav-icon i-Add-File"></i>
                            </span>
                            Yeni iclas və ya tədbir
                        </button>
                    </a>
                </div>
            </div>
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table id="meetings-table" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Mövzu</th>
                                <th>Başlama tarixi</th>
                                <th>Müddət (dəq)</th>
                                <th>Otaq</th>
                                <th>Növ</th>
                                <th>Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>salam</td>
                                <td>saf</td>
                                <td>asda</td>
                                <td>sfa</td>
                                <td>dfsd</td>
                                <td>Rezerv</td>
                                <td>
                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>

                                    <i class="nav-icon i-Eye font-weight-bold"></i>

                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="container">
    <div id="calendar"></div>
</div>



@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<script>
    $(document).ready(function () {
        $('#calendar').fullCalendar(
            {
                selectable: true,
                selectHelper: true,
                select: function () {
                    Swal.fire({
                        title: 'Create event',
                        html: `<form method="POST" id="form" action="{{ route('hr.meetings.store') }}">
    @csrf
    <div class="row">
        <div class="col-md-4 form-group mb-3">
            <div class="select_label ui sub header">Mövzu <span class="text-danger">*</span></div>
            <input type="text" name="subject" required id="subject" class="form-control" placeholder="Mövzu daxil edin">
            @error('subject')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-4 form-group mb-3">
            <div class="select_label ui sub header">Növ <span class="text-danger">*</span></div>
            <select id="type" name="type" required class="form-control ui fluid">
                <option value="" selected disabled>Növ seçin</option>
                <option value="0" {{ old('type') == '0' ? 'selected' : '' }}>İclas</option>
                <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Tədbir</option>
            </select>
            @error('type')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-4 form-group mb-3">
            <div class="select_label ui sub header">Otaq nömrəsi <span class="text-danger">*</span>
            </div>
            <select id="room" name="rooms_id" required class="form-control ui fluid">
                <option value="" selected disabled>Otaq nömrəsini seçin</option>
                    <option value="1" {{ old('rooms_id') == 1 ? 'selected' : '' }}>
                      otaq 1
                    </option>
                
            </select>
            @error('rooms_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-4 form-group mb-3 none-field" style="display: none;">
            <div class="select_label ui sub header">Tarix <span class="text-danger">*</span></div>
            <input type="text" id="date-time-picker" name="start_date_time" required class="form-control"
                style="background: #f8f9fa;" placeholder="Başlama tarixini seçin">
            @error('start_date_time')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-4 form-group mb-3 none-field" style="display: none;">
            <div class="select_label ui sub header">Müddət (dəq) <span class="text-danger">*</span>
            </div>
            <select id="duration" name="duration" required class="form-control ui fluid">
                <option value="" selected disabled>Müddəti seçin</option>
                @foreach([15, 30, 60, 90] as $minute)
                    <option value="{{ $minute }}" {{ old('duration') == $minute ? 'selected' : '' }}>
                        {{ $minute }}
                    </option>
                @endforeach
            </select>
            @error('duration')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-4 form-group mb-3 none-field" style="display: none;">
            <div class="select_label ui sub header">Status <span class="text-danger">*</span></div>
            <select id="status" name="status" required class="form-control ui fluid">
                <option value="" selected disabled>Status seçin</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deaktiv</option>
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktiv</option>
                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Gözləmə</option>
            </select>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 form-group mb-3">
            <div class="select_label ui sub header">Məzmun <span class="text-danger">*</span></div>
            <textarea name="content" required rows="6" class="form-control" id="content" placeholder="Məzmun daxil edin"
                style="resize: none;"></textarea>
            @error('content')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @csrf
        <div class="col-md-12 mt-2">
            <div class="accordion mt-2" id="accordionRightIcon">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                            <a data-toggle="collapse" class="text-default collapsed" href="#accordion-item-icons-3"
                                aria-expanded="false">
                                <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                İştirakçılar <span class="text-danger">*</span>
                            </a>
                        </h6>
                    </div>
                    <div id="accordion-item-icons-3" class="collapse" data-parent="#accordionRightIcon" style="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <h3>Departament</h3>
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" class="report-departments" name="w_departments_id[]"
                                                value="1">
                                            <span><strong>İT</strong> (Şöbə:
                                               3, İşçi:
                                                10)</span>
                                            <span class="checkmark"></span>
                                        </label>
                                </div>
                                <div class="col-8">
                                    <h3>Şöbə</h3>
                                    <div class="row">
                                            <div class="col-4">
                                                <label class="checkbox checkbox-primary">
                                                    <input type="checkbox" class="report-branches"
                                                        data-department-id="1"
                                                        name="w_branch_id[]" value="1">
                                                    <span><strong>İT</strong> (İşçi:
                                                       5)</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <h3>İşçilər</h3>
                                    <div class="row">
                                            <div class="col-4 mt-4">
                                                <label class="checkbox checkbox-primary">
                                                    <input type="checkbox"
                                                        data-branch-id="1"
                                                        data-department-id="1"
                                                        class="report-users" name="w_user_id[]" value="1">
                                                    <span>Salam</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>`,
                        showCancelButton: true,
                        confirmButtonText: 'Submit',
                        preConfirm: () => {
                            const form = document.getElementById('myForm');
                            form.submit();
                        }

                    });
                },
                eventClick: function (event) {
                    Swal.fire({
                        title: 'Event Details',
                        html: `<p>test</p>`,
                        showCancelButton: true,
                        confirmButtonText: 'Edit',
                        cancelButtonText: 'Close'
                    });
                },
                dayClick: function () {
                    alert('a day has been clicked!');
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
                events: [{
                    title: "Rezerv",
                    start: '2024-08-05T09:05',
                    end: '2024-08-05T12:05',
                    color: 'yellow',
                    textColor: 'blue',
                },
                {
                    title: "Rezerv-2",
                    start: '2024-08-05T12:15',
                    end: '2024-08-05T14:05',
                    color: 'blue',
                    textColor: 'red'
                }
                ],
                dayRender: function (date, cell) {
                    let newDate = $.fullCalendar.formatDate(date, 'DD-MM-YYYY');
                    if (newDate == '07-08-2024') {
                        cell.css('background', "yellow")
                    }
                    else if (newDate == '09-08-2024') {
                        cell.css('background', "red")
                    }
                }
            }
        );
    }); 
</script>
@endsection