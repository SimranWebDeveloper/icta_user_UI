@extends('employee.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="m-0">Yeni Bron</h3>
            <a href="{{ route('employee.brons.index') }}">
                <button class="btn btn-danger">
                    <span class="me-2">
                        <i class="nav-icon i-Arrow-Back-2"></i>
                    </span>
                    Bronlar
                </button>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" id="form" action="{{ route('hr.meetings.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <div class="select_label ui sub header">Mövzu <span class="text-danger">*</span></div>
                    <input type="text" name="subject" required id="subject" class="form-control"
                        placeholder="Mövzu daxil edin">
                    @error('subject')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4 form-group mb-3 d-none">
                    <div class="select_label ui sub header">Növ <span class="text-danger">*</span></div>
                    <select id="type" name="type" required class="form-control ui fluid">
                        <option value="2" selected>Rezerv</option>
                    </select>
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group mb-3">
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
                <div class="col-md-6 form-group mb-3 none-field" style="display: none;">
                    <div class="select_label ui sub header">Tarix <span class="text-danger">*</span></div>
                    <input type="text" id="date-time-picker" name="start_date_time" required class="form-control"
                        style="background: #f8f9fa;" placeholder="Başlama tarixini seçin">
                    @error('start_date_time')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group mb-3 none-field" style="display: none;">
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
                                            <label class="checkbox checkbox-primary">
                                                <input type="checkbox" class="report-departments"
                                                    name="w_departments_id[]" value="1">
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
                                                            data-department-id="1" name="w_branch_id[]" value="1">
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
                                                        <input type="checkbox" data-branch-id="1" data-department-id="1"
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
                <div class="col-md-12 mt-4">
                    <button class="btn btn-success btn-lg" id="submitBtn">Daxil edin</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<script>
    const submitBtn = document.getElementById('submitBtn');

    submitBtn.addEventListener('click', function (event) {
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
    })
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