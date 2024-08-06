@extends('hr.layouts.app')

<style>
    .form-control {
        resize: none;
    }

    .dropzone-label {
        width: 100%;
        cursor: pointer;
    }
    #end_date:disabled {
    cursor: not-allowed;
}
    #preview-container {
        position: relative;
        width: 100%;
        height: 250px;
        background-color: transparent;
        border: none;
    }

    #preview-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    #actions i {
        font-size: 18px;
        cursor: pointer;
        padding: 5px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.7);
    }

    #actions i:hover {
        background-color: rgba(255, 255, 255, 1);
    }

    #default-icon,
    #upload-icon {
        font-size: 60px;
    }

    .file-icon i,
    .file-icon img {
        max-width: 100%;
        max-height: 100%;
    }

    .file-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 150px;
        height: 150px;
        border: 1px dashed #ccc;
        border-radius: 10px;
        background-color: #f8f9fa;
    }

    @media (max-width: 768px) {
        .custom-spacing {
            margin-bottom: 1.5rem;
        }
    }
</style>

@section('content')
<div class="card">
    <div class="card-header">
        <div class="header d-flex justify-content-between align-items-center">
            <h3 class="m-0">Yeni Elan</h3>
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
    <div class="container-fluid mt-4">
        <form id="announcementForm" method="POST" action="{{ route('hr.announcements.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- First Main Section -->
                <div class="col-md-8 custom-spacing">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Başlıq <span class="text-danger">*</span></label>
                            <input type="text" name="title" required id="title" class="form-control"
                                placeholder="Başlığı daxil edin">
                            @if($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select id="status" name="status" required
                                class="form-control ui fluid ">
                                <option value="" disabled selected>Elanın statusunu seçin</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktiv</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deaktiv</option>
                                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Gözləmə</option>
                            </select>
                            @if($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6  form-group date-duration-field mb-3">
                            <label for="start_date" class="form-label">Başlama tarixi <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="start_date" style="background:#f8f9fa" id="start_date" class="form-control" required
                                placeholder="Başlama tarixi seçin">
                            @if($errors->has('start_date'))
                                <span class="text-danger">{{ $errors->first('start_date') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6  form-group date-duration-field mb-3">
                            <label for="end_date" class="form-label">Bitmə tarixi <span
                                    class="text-danger">*</span></label>
                                    <input type="text" name="end_date" id="end_date" style="background:#f8f9fa"
                                class="form-control" required disabled placeholder="Bitmə tarixi seçin">

                            @if($errors->has('end_date'))
                                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="content" class="form-label">Mövzu <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="content" name="content" rows="9" required
                                    placeholder="Zəhmət olmasa mövzunu daxil edin"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Second Main Section for Image Upload -->
                <div class="col-md-4 custom-spacing">
                    <label for="files" class="form-label">Şəkil</label>
                    <div class="upload-container bg-white p-5 rounded shadow-sm border">
                        <div class="dropzone d-flex justify-content-center align-items-center flex-column">
                            <label for="files" class="dropzone-label d-flex flex-column align-items-center">
                                <div id="preview-container" class="file-icon mb-3">
                                    <img id="image-preview" src="" alt="Image Preview" class="d-none" />
                                    <div class="separator mb-2">
                                        <i id="upload-icon" class="fa-solid fa-upload text-primary"></i>
                                    </div>
                                </div>
                                <div id="actions" class="d-none">
                                    <i id="trash-icon" class="fa-solid fa-trash text-danger"></i>
                                    <i id="change-icon" class="fa-solid fa-pen text-primary"></i>
                                </div>
                            </label>
                            <input id="files" name="image" type="file" class="file-input d-none" />
                        </div>
                    </div>
                </div>
                <div class="col-md-12 my-1">
                    <button type="submit" form="announcementForm" class="btn btn-success btn-lg">Daxil
                        edin</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    document.getElementById('files').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const imagePreview = document.getElementById('image-preview');
        const uploadIcon = document.getElementById('upload-icon');
        const actions = document.getElementById('actions');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('d-none');
                uploadIcon.classList.add('d-none');
                actions.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '';
            imagePreview.classList.add('d-none');
            uploadIcon.classList.remove('d-none');
            actions.classList.add('d-none');
        }
    });

    document.getElementById('trash-icon').addEventListener('click', function (event) {
        event.stopPropagation();
        event.preventDefault();

        const fileInput = document.getElementById('files');
        const imagePreview = document.getElementById('image-preview');
        const uploadIcon = document.getElementById('upload-icon');
        const actions = document.getElementById('actions');

        fileInput.value = '';
        imagePreview.src = '';
        imagePreview.classList.add('d-none');
        uploadIcon.classList.remove('d-none');
        actions.classList.add('d-none');
    });

    document.getElementById('change-icon').addEventListener('click', function (event) {
        event.stopPropagation();
        event.preventDefault();

        const fileInput = document.getElementById('files');
        fileInput.click();
    });

    function getTodayDate() {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}`;
    }

    document.getElementById('start_date').setAttribute('min', getTodayDate());

    document.addEventListener('DOMContentLoaded', function () {
        flatpickr('#start_date', { 
            allowInput: true,
            dateFormat: 'Y-m-d',
            minDate: 'today',
            locale: "az",
        });

        flatpickr('#end_date', {
            allowInput: true,
            dateFormat: 'Y-m-d',
            locale: "az",
            onOpen: function (selectedDates, dateStr, instance) {
                const startDate = document.getElementById('start_date').value;
                instance.set('minDate', startDate ? new Date(startDate) : 'today');
            }
        });

        document.getElementById('start_date').addEventListener('change', function () {
            const startDate = this.value;
            const endDateInput = document.getElementById('end_date');
            endDateInput.value = '';
            endDateInput._flatpickr.set('minDate', startDate);
            endDateInput.removeAttribute('disabled');
        });

        document.getElementById('end_date').addEventListener('change', function () {
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(this.value);
            if (endDate < startDate) {
                this.value = '';
            }
        });
    });
</script>
@endsection