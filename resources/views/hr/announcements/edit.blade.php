@extends('hr.layouts.app')

<style>
    .form-control {
        resize: none;
    }

    .dropzone-label {
        width: 100%;
        cursor: pointer;
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

    #actions {
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 250px;
        gap: 10px;
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
        position: relative;
    }

    #upload-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }

    /* Ensure no CSS rule is hiding the input */
    #start_date {
        display: block;
        /* Ensure the input is displayed as block element */
        visibility: visible;
        /* Ensure the input is visible */
    }
</style>

@section('content')
<div class="card">
    <div class="card-header">
        <div class="header d-flex justify-content-between align-items-center">
            <h3 class="m-0"><span class="text-capitalize">{{ $announcement->title }}</span> redaktə et</h3>
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
        <form id="announcementForm" method="POST" action="{{ route('hr.announcements.update', $announcement->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Hidden input to track image deletion -->
            <input type="hidden" name="delete_image" id="delete_image" value="0">

            <div class="row">
                <!-- First Main Section -->
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Başlıq <span class="text-danger">*</span></label>
                            <input type="text" name="title" required id="title" class="form-control" placeholder="Başlığı daxil edin!" value="{{ old('title', $announcement->title) }}">
                            @if($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select id="status" name="status" required class="form-control ui fluid search dropdown create_form_dropdown">
                                <option value="" selected disabled>Elanın statusunu seçin!</option>
                                <option value="1" {{ old('status', $announcement->status) == '1' ? 'selected' : '' }}>Aktiv</option>
                                <option value="0" {{ old('status', $announcement->status) == '0' ? 'selected' : '' }}>Deaktiv</option>
                                <option value="2" {{ old('status', $announcement->status) == '2' ? 'selected' : '' }}>Gözləmə</option>
                            </select>
                            @if($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>

                        <div class="col-md-6 form-group date-duration-field mb-3">
                            <label for="start_date" class="form-label">Başlama tarixi <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" id="start_date" class="form-control" style="background:#f8f9fa" required value="{{ old('start_date', \Carbon\Carbon::parse($announcement->start_date)->format('Y-m-d')) }}">
                            @if($errors->has('start_date'))
                                <span class="text-danger">{{ $errors->first('start_date') }}</span>
                            @endif
                        </div>

                        <div class="col-md-6 form-group date-duration-field mb-3">
                            <label for="end_date" class="form-label">Bitmə tarixi <span class="text-danger">*</span></label>
                            <input type="text" name="end_date" id="end_date" style="background:#f8f9fa" class="form-control" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ old('end_date', \Carbon\Carbon::parse($announcement->end_date)->format('Y-m-d')) }}">
                            @if($errors->has('end_date'))
                                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="contentTextarea">Mövzu <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="content" name="content" rows="9" required placeholder="Zəhmət olmasa mövzunu daxil edin!">{{ old('content', $announcement->content) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Main Section for Image Upload -->
                <div class="col-md-4">
                    <label for="files" class="form-label">Şəkil</label>
                    <div class="upload-container bg-white p-5 rounded shadow-sm border">
                        <div class="dropzone d-flex justify-content-center align-items-center flex-column">
                            <label for="files" class="dropzone-label d-flex flex-column align-items-center">
                                <div id="preview-container" class="file-icon mb-3">
                                    <img id="image-preview" src="{{ $announcement->image ? asset('assets/images/announcements/' . $announcement->image) : '' }}" alt="Image Preview" class="{{ $announcement->image ? '' : 'd-none' }}">
                                    <div class="separator mb-2">
                                        <i id="upload-icon" class="fa-solid fa-upload text-primary {{ $announcement->image ? 'd-none' : '' }}"></i>
                                        <input id="files" name="image" type="file" class="file-input d-none" />
                                    </div>
                                    <div id="actions" class="{{ $announcement->image ? '' : 'd-none' }}">
                                        <i id="trash-icon" class="fa-solid fa-trash text-danger"></i>
                                        <i id="change-icon" class="fa-solid fa-pen text-primary"></i>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 d-flex justify-content-start my-1">
                    <button type="submit" form="announcementForm" class="btn btn-info btn-lg">
                        <span class="me-2">
                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                        </span>
                        Redaktə et
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('files');
        const imagePreview = document.getElementById('image-preview');
        const uploadIcon = document.getElementById('upload-icon');
        const trashIcon = document.getElementById('trash-icon');
        const changeIcon = document.getElementById('change-icon');
        const actions = document.getElementById('actions');
        const deleteImageInput = document.getElementById('delete_image');

        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('d-none');
                    uploadIcon.classList.add('d-none');
                    actions.classList.remove('d-none');
                    deleteImageInput.value = '0'; // Reset the delete_image input when a new file is selected
                };
                reader.readAsDataURL(file);
            } else {
                resetImagePreview();
            }
        });

        trashIcon.addEventListener('click', function (event) {
            event.preventDefault();
            resetImagePreview();
            deleteImageInput.value = '1'; 
        });

        changeIcon.addEventListener('click', function (event) {
            event.preventDefault();
            fileInput.click();
        });

        function resetImagePreview() {
            fileInput.value = '';
            imagePreview.src = '';
            imagePreview.classList.add('d-none');
            uploadIcon.classList.remove('d-none');
            actions.classList.add('d-none');
            deleteImageInput.value = '0'; 
        }

        flatpickr('#start_date', {
            dateFormat: 'Y-m-d',
            minDate: 'today',
            locale: 'az',
            onChange: function (selectedDates, dateStr, instance) {
                const endDateInput = document.getElementById('end_date');
                endDateInput._flatpickr.set('minDate', dateStr);
                endDateInput.disabled = false;
            }
        });

        flatpickr('#end_date', {
            dateFormat: 'Y-m-d',
            minDate: 'today',
            locale: 'az',
        });

        document.getElementById('start_date').addEventListener('change', function () {
            const startDate = this.value;
            const endDateInput = document.getElementById('end_date');
            endDateInput.value = '';
            endDateInput._flatpickr.set('minDate', startDate);
            endDateInput.disabled = false;
        });

        document.getElementById('end_date').addEventListener('change', function () {
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(this.value);
            if (endDate < startDate) {
                alert('End date cannot be earlier than start date.');
                this.value = '';
            }
        });
    });
</script>
@endsection
