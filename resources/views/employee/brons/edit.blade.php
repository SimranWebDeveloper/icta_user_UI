@extends('employee.layouts.app')
@section('content')
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="m-0">
                       <span class="text-capitalize">
Rezerv                       </span>
                        redaktə et
                    </h3>
                    <a href="{{ route('employee.brons.index') }}">
                        <button class="btn btn-danger">
                            <span class="me-2">
                                <i class="nav-icon i-Arrow-Back-2"></i>
                            </span>
                            Rezerv
                        </button>
                    </a>
                </div>
            </div>
            <div class="container-fluid mt-4">
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form method="POST" id="form" action="{{ route('employee.brons.update', 1) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <div class="select_label ui sub header">Mövzu</div>
                            <input required type="text" name="subject" value=""
                                class="form-control">
                            @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 form-group mb-3 d-none">
                            <div class="select_label ui sub header">Növ</div>
                            <select required id="type" name="type" class="form-control ui fluid">
                                <option value="2" selected>Rezerv
                                </option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <div class="select_label ui sub header">Otaq nömrəsi</div>
                            <select required id="room" name="rooms_id" class="form-control ui fluid">
                                    <option value="" selected>
                                        otaq 1
                                    </option>  
                            </select>
                            @error('rooms_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group mb-3 none-field">
                            <div class="select_label ui sub header">Tarix <span class="text-danger">*</span></div>
                            <input type="text" id="date-time-picker" name="start_date_time" required
                                class="form-control" style="background: #f8f9fa;" placeholder="Başlama tarixini seçin"
                                min=""
                                value="">
                            @error('start_date_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <div class="select_label ui sub header">Müddət (dəq)</div>
                            <select id="duration" required name="duration" class="form-control ui fluid">
                                @foreach ([15, 30, 60, 90] as $duration)
                                    <option value="{{ $duration }}" selected>
                                        {{ $duration }}
                                    </option>
                                @endforeach
                            </select>
                            @error('duration')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="col-md-12 form-group mb-3">
                            <div class="select_label ui sub header">Məzmun</div>
                            <textarea rows="6" name="content" required
                                class="form-control">salam</textarea>
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
                        <div class="col-md-12 mb-1 mt-3">
                            <button type="submit" class="btn btn-info btn-lg">
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
            $('#err-text').html("Ən azı 1 iştirakçı seçin")
            e.preventDefault()
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