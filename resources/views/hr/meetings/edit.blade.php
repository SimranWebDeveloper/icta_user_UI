@extends('hr.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="m-0">
                    <span class="text-capitalize">
                        {{$meeting->subject}}
                    </span>
                    redaktə et
                </h3>
                <a href="{{ route('hr.meetings.index') }}">
                    <button class="btn btn-danger">
                        <span class="me-2">
                            <i class="nav-icon i-Arrow-Back-2"></i>
                        </span>
                        İclas və ya tədbirlər
                    </button>
                </a>
            </div>
        </div>
        <div class="container-fluid mt-4">
            <form method="POST" id="form" action="{{ route('hr.meetings.update', $meeting->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 form-group mb-3">
                        <div class="select_label ui sub header">Mövzu</div>
                        <input required type="text" id="subject" name="subject" value="{{ old('subject', $meeting->subject) }}"
                            class="form-control">
                        @error('subject')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <div class="select_label ui sub header">Növ</div>
                        <select required id="type" name="type" class="form-control ui fluid">
                            <option value="0" {{ old('type', $meeting->type) == '0' ? 'selected' : '' }}>İclas</option>
                            <option value="1" {{ old('type', $meeting->type) == '1' ? 'selected' : '' }}>Tədbir</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <div class="select_label ui sub header">Otaq nömrəsi</div>
                        <select required id="room" name="rooms_id" class="form-control ui fluid">
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('rooms_id', $meeting->rooms_id) == $room->id ? 'selected' : '' }}>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('rooms_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group mb-3 none-field">
                        <div class="select_label ui sub header">Tarix <span class="text-danger">*</span></div>
                        <input type="text" id="date-time-picker" name="start_date_time" required
                            class="form-control" style="background: #f8f9fa;" placeholder="Başlama tarixini seçin"
                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                            value="{{ $meeting->start_date_time }}">
                        @error('start_date_time')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <div class="select_label ui sub header">Müddət (dəq)</div>
                        <select id="duration" required name="duration" class="form-control ui fluid">
                            @foreach ([15, 30, 60, 90] as $duration)
                                <option value="{{ $duration }}" {{ old('duration', $meeting->duration) == $duration ? 'selected' : '' }}>
                                    {{ $duration }}
                                </option>
                            @endforeach
                        </select>
                        @error('duration')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <div class="select_label ui sub header">Status</div>
                        <select id="status" name="status" required class="form-control ui fluid">
                            <option value="1" {{ old('status', $meeting->status) == '1' ? 'selected' : '' }}>Aktiv</option>
                            <option value="0" {{ old('status', $meeting->status) == '0' ? 'selected' : '' }}>Deaktiv</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <div class="select_label ui sub header">Məzmun</div>
                        <textarea rows="6" name="content" required
                            class="form-control">{{ old('content', $meeting->content) }}</textarea>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="accordion mt-2" id="accordionRightIcon">
                            <div class="card">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                        <a data-toggle="collapse" class="text-default collapsed"
                                            href="#accordion-item-icons-3" aria-expanded="false">
                                            <span><i class="i-Big-Data ul-accordion__font"></i></span>
                                            İştirakçılar <span class="text-danger">*</span>
                                        </a>
                                    </h6>
                                </div>
                                <div id="accordion-item-icons-3" class="collapse" data-parent="#accordionRightIcon">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <h3>Departament</h3>
                                                @foreach ($departments as $department)
                                                    <label class="checkbox checkbox-primary">
                                                        <input type="checkbox" class="report-departments" {{ in_array($department->id, $user_departments) ? 'checked' : '' }} name="w_departments_id[]"
                                                            value="{{ $department->id }}">
                                                        <span><strong>{{ $department->name }}</strong> (Şöbə:
                                                            {{ $department->branches_count }}, İşçi:
                                                            {{ $department->users_count }})</span> <span
                                                            class="checkmark"></span>
                                                    </label>
                                                @endforeach
                                            </div>
                                            <div class="col-8">
                                                <h3>Şöbə</h3>
                                                <div class="row">
                                                    @foreach ($branches as $branch)
                                                        <div class="col-4">
                                                            <label class="checkbox checkbox-primary">
                                                                <input type="checkbox" class="report-branches"
                                                                    data-department-id="{{ !is_null($branch->departments) ? $branch->departments->id : '' }}"
                                                                    {{ in_array($branch->id, $user_branches) ? 'checked' : '' }} name="w_branch_id[]"
                                                                    value="{{ $branch->id }}">
                                                                <span><strong>{{ $branch->name }}</strong> (İşçi:
                                                                    {{ $branch->users_count }})</span>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 mt-2">
                                                <h3>İşçilər</h3>
                                                <div class="row">
                                                    @foreach ($users as $user)
                                                        <div class="col-4 mt-4">
                                                            <label class="checkbox checkbox-primary">
                                                                <input type="checkbox"
                                                                    data-branch-id="{{ !is_null($user->branches) ? $user->branches->id : '' }}"
                                                                    data-department-id="{{ !is_null($user->departments) ? $user->departments->id : '' }}"
                                                                    class="report-users" {{ in_array($user->id, $meeting_users) ? 'checked' : '' }}
                                                                    name="w_user_id[]" value="{{ $user->id }}">
                                                                <span>{{ $user->name }}</span>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-1 mt-3">
                        <button type="submit" class="btn btn-info btn-lg" id="submitBtn">
                            <span class="me-2">
                                <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                            </span>
                            Redaktə et
                        </button>
                        <p class="text-danger mt-3" id="err-text"></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script>
    document.getElementById('submitBtn').addEventListener('click', function(event) {
        const subjectInput = document.getElementById('subject');

        if (subjectInput.value.length > 125) {
            event.preventDefault();

            Swal.fire({
                title: "Xəta!",
                text: "Mövzu 125 simvoldan uzun ola bilməz",
                icon: "warning",
                confirmButtonText: "Tamam"
            });
            return;
        }

        const inputs = document.querySelectorAll('input[required]');
        inputs.forEach(input => {
            if (input.value) {
                input.setCustomValidity("");
            } else {
                input.setCustomValidity("Zəhmət olmazsa xananı doldurun");
            }
        });

        const selects = document.querySelectorAll('select[required]');
        selects.forEach(select => {
            if (select.value) {
                select.setCustomValidity("");
            } else {
                select.setCustomValidity("Zəhmət olmazsa xananı doldurun");
            }
        });

        const texts = document.querySelectorAll('textarea[required]');
        texts.forEach(text => {
            if (text.value) {
                text.setCustomValidity("");
            } else {
                text.setCustomValidity("Zəhmət olmazsa xananı doldurun");
            }
        });

        $('#form').on('submit', function(e) {
            e.preventDefault();

            if ($('.report-users:checked').length === 0) {
                Swal.fire({
                    title: "Xəta!",
                    text: "Ən azı 1 iştirakçı seçin",
                    icon: "warning",
                    confirmButtonText: "Tamam"
                });
                return;
            }

            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        Swal.fire({
                            title: "Xəta!",
                            text: response.message,
                            icon: "error",
                            confirmButtonText: "Tamam"
                        });
                    } else {
                        Swal.fire({
                            title: "Uğurlu!",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "Tamam"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/hr/meetings";
                            }
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        title: "Xəta!",
                        text: 'Bir hata oluştu. Lütfen tekrar deneyin.',
                        icon: "error",
                        confirmButtonText: "Tamam"
                    });
                }
            });
        });
    });

    flatpickr("#date-time-picker", {
        allowInput: true,
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today",
        time_24hr: true,
        locale: "az",
        minTime: new Date().toTimeString().slice(0, 5),
        onChange: function(selectedDates, dateStr, instance) {
            const now = new Date();
            const selectedDate = selectedDates[0];
            if (selectedDate.toDateString() === now.toDateString()) {
                instance.set('minTime', now.toTimeString().slice(0, 5));
            } else {
                instance.set('minTime', '00:00');
            }
        }
    });

    $('.report-departments').on('change', function () {
        const departmentId = $(this).val();
        const isChecked = $(this).is(':checked');
        $('.report-branches[data-department-id="' + departmentId + '"]').prop('checked', isChecked);
        $('.report-users[data-department-id="' + departmentId + '"]').prop('checked', isChecked);
    });

    $('.report-branches').on('change', function () {
        const branchId = $(this).val();
        const isChecked = $(this).is(':checked');
        $('.report-users[data-branch-id="' + branchId + '"]').prop('checked', isChecked);
    });
</script>
@endsection
