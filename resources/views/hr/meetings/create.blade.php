@extends('hr.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="m-0">Yeni İclas və ya Tədbir</h3>
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
            <div class="card-body">
                <form method="POST" id="form" action="{{ route('hr.meetings.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 form-group mb-3">
                            <div class="select_label ui sub header">Mövzu <span class="text-danger">*</span></div>
                            <input type="text" name="subject" required id="subject" class="form-control"
                                placeholder="Mövzu daxil edin">
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
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('rooms_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rooms_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 form-group mb-3 none-field" style="display: none;">
                            <div class="select_label ui sub header">Tarix <span class="text-danger">*</span></div>
                            <input type="text" id="date-time-picker" name="start_date_time" required
                                class="form-control" style="background: #f8f9fa;" placeholder="Başlama tarixini seçin">
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
                            <textarea name="content" required rows="6" class="form-control" id="content"
                                placeholder="Məzmun daxil edin" style="resize: none;"></textarea>
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
                                            <a data-toggle="collapse" class="text-default collapsed"
                                                href="#accordion-item-icons-3" aria-expanded="false">
                                                <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                                İştirakçılar <span class="text-danger">*</span>
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="accordion-item-icons-3" class="collapse" data-parent="#accordionRightIcon"
                                        style="">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <h3>Departament</h3>
                                                    @foreach($departments as $department)
                                                        <label class="checkbox checkbox-primary">
                                                            <input type="checkbox" class="report-departments"
                                                                name="w_departments_id[]" value="{{ $department->id }}">
                                                            <span><strong>{{ $department->name }}</strong> (Şöbə:
                                                                {{ $department->branches_count }}, İşçi:
                                                                {{ $department->users_count }})</span>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                                <div class="col-8">
                                                    <h3>Şöbə</h3>
                                                    <div class="row">
                                                        @foreach($branches as $branch)
                                                            <div class="col-4">
                                                                <label class="checkbox checkbox-primary">
                                                                    <input type="checkbox" class="report-branches"
                                                                        data-department-id="{{ !is_null($branch->departments) ? $branch->departments->id : '' }}"
                                                                        name="w_branch_id[]" value="{{ $branch->id }}">
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
                                                        @foreach($users as $user)
                                                            <div class="col-4 mt-4">
                                                                <label class="checkbox checkbox-primary">
                                                                    <input type="checkbox"
                                                                        data-branch-id="{{ !is_null($user->branches) ? $user->branches->id : '' }}"
                                                                        data-department-id="{{ !is_null($user->departments) ? $user->departments->id : '' }}"
                                                                        class="report-users" name="w_user_id[]"
                                                                        value="{{ $user->id }}">
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
                        <div class="col-md-12 mt-4">
                            <button class="btn btn-success btn-lg">Daxil edin</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#room').change(function () {
        if ($(this).val()) {
            $('.none-field').show();
        } else {
            $('.none-field').hide();
        }
    });

    flatpickr("#date-time-picker", {
        allowInput: true,
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today",
        time_24hr: true,
        locale: "az"
    });

    $('#form').on('submit', function (e) {
        if ($('.report-users:checked').length === 0) {
            Swal.fire({
                title: "Xəta!",
                text: "Ən azı 1 iştirakçı seçin",
                icon: "warning"
            })
            e.preventDefault()
        }
    });

    $('.report-departments').on('change', function () {
        const department_id = $(this).val();
        if ($(this).is(':checked')) {
            // Seçilən şöbələri tapır və işarələyir
            $('.report-branches[data-department-id="' + department_id + '"]').prop('checked', true);
            // Seçilən şöbələrin istifadəçilərini işarələyir
            $('.report-users[data-department-id="' + department_id + '"]').each(function () {
                const branchId = $(this).data('branch-id');
                if ($('.report-branches[value="' + branchId + '"]').is(':checked')) {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });
        } else {
            // Departamentin işarəsini açdıqda şöbələri və istifadəçiləri işarəsiz edir
            $('.report-branches[data-department-id="' + department_id + '"]').prop('checked', false);
            $('.report-users[data-department-id="' + department_id + '"]').prop('checked', false);
        }
    });

    $('.report-branches').on('change', function () {
        const branch_id = $(this).val();
        if ($(this).is(':checked')) {
            // Şöbə seçildikdə istifadəçiləri işarələyir
            $('.report-users[data-branch-id="' + branch_id + '"]').prop('checked', true);
        } else {
            // Şöbə işarəsi açıldıqda istifadəçiləri işarəsiz edir
            $('.report-users[data-branch-id="' + branch_id + '"]').prop('checked', false);
        }
    });

</script>
@endsection
