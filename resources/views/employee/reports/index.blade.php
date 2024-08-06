@extends('employee.layouts.app')
@section('content')
    <style>
        .wrapper {
            display: table;
            width: 100%;
        }

        .wrapper .wrapper_inside {
            display: flex;
            width: 100%;
        }

        .wrapper_inside > div {
            flex: 1 1 50%;
        }

        .wrapper .wrapper_inside .header {
            font-size: 16px;
            padding: 10px 20px;
            margin: 10px;
            color: #ededed;
            text-align: center;
            border-radius: 6px;
            font-weight: 600;
        }

        .wrapper .wrapper_inside .right_container .header {
            background-color: #00af1c;
        }

        .wrapper .wrapper_inside .left_container .header {
            background-color: #e10101b5;
        }

        .container_dragula {
            min-height: 50px;
            cursor: pointer;
        }

        .container_dragula > div {
            display: flex;
            align-items: center;
        }

        .container_dragula button {
            flex: 1 1 10%;
            padding: 12px 0px;
            border: 1px solid #e9e9e9;
            border-radius: 4px;
            background-color: #ff4545;
            font-size: 16px;
            text-align: center;
            color: #fff;
            font-weight: 400;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-right: 10px;
        }

        .container_dragula button:hover {
            border-color: #ffa2a2;
            background-color: #ff0000;
        }

        .container_dragula div.list_item {
            flex: 1 1 90%;
            margin: 10px;
            padding: 10px;
            background-color: rgb(225 225 225 / 52%);
            transition: all 0.4s ease-in-out;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            font-size: 13px;
        }

        .container_dragula {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .container_dragula:nth-child(odd) {
            background-color: rgba(0, 0, 0, 0.2);
        }

        .wrapper_inside .input_section {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 12px 8px;
        }

        .input_section input {
            flex: 1 1 80%;
            padding: 12px;
            border: 1px solid #bdbdbd;
            border-radius: 4px;
            transition: border-color 0.2s ease;
            font-size: 14px;
        }

        .input_section input:focus-visible {
            outline: none;
            border-color: #605e5e;
        }

        .input_section button {
            flex: 1 1 20%;
            padding: 11px 0px;
            border: 1px solid #e9e9e9;
            border-radius: 4px;
            background-color: #918d8d;
            font-size: 17px;
            text-align: center;
            color: #fff;
            font-weight: 400;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        button:focus-visible {
            outline: none;
        }

        .input_section button:hover {
            border-color: #524f4f;
            background-color: #a9a4a4;
        }

        .input_section button#submit-report {
            background-color: #00af1c;
        }

        .input_section input#new-subject-project {
            flex: 1 1 30%;
        }

        .input_section input#new-subject-content {
            flex: 1 1 50%;
        }

        .data_head_container{
            display: flex;
            gap: 12px;
            flex-direction: column;
        }

        .data_head_container a{
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .data_head_container .profile_container{
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .data_head_container .profile_owner{
            color: #6a6a6a;
        }
    </style>
    <div class="row mb-4">
        <div class="col-md-12 mb-4">


            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Hesabat tərkibi</h3>
                        <strong>Hesabatı qəbul edən: {{ $receiver->name }}</strong>
                    </div>

                </div>
                <div class="card-body">

                    <div class="wrapper">
                        <div class="wrapper_inside" id="wrapper">
                            <div class="left_container">
                                <div class="header">Görüləcək işlər</div>

                                <div id="left" class="container_dragula">
                                    @if($uncompleted_reports)
                                        @foreach($uncompleted_reports->reports_subjects->where('status', 0) as $subject_key0 => $subject0)
                                            <div>
                                                <div class="list_item"><p
                                                        data-id="{{ $subject0->id }}">{{ $subject0->project_name ?? NULL }}
                                                        - {{ $subject0->subject}}</p></div>
                                                <button data-id="{{ $subject0->id }}" class="remove-button">Sil</button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="input_section">
                                    <input type="text" id="new-subject-project">
                                    <input type="text" required id="new-subject-content">
                                    <small id="subject-content-error" class="text-danger"></small>
                                    <button type="button" id="add-new-subject">Əlavə et</button>
                                </div>
                            </div>

                            <div class="right_container">
                                <div class="header">Hesabat tərkibi</div>
                                <div id="right" class="container_dragula">
                                    @if($uncompleted_reports)
                                        @foreach($uncompleted_reports->reports_subjects->where('status', 1) as $subject_key1 => $subject1)
                                            <div>
                                                <div class="list_item"><p
                                                        data-id="{{ $subject1->id }}">{{ $subject1->project_name ?? NULL }}
                                                        - {{ $subject1->subject}}</p></div>
                                                <button data-id="{{ $subject1->id }}" class="remove-button">Sil</button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="input_section" id="submit-report-div">
                                    <div style='visibility: hidden; flex: 1 1 80%;'></div>
                                    <button type="button" id="submit-report">Hesabatı təsdiqlə</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h3>Həftəlik hesabatlar</h3>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionRightIcon">
                        @foreach($completed_reports as $report)
                            <div class="card p-8">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0 data_head_container">
                                        <div class="profile_container">
                                            <div class="profile_img">
                                                @if(!is_null(\Illuminate\Support\Facades\Auth::user()->avatar))
                                                    <img src="{{ asset('assets/images/avatars').'/'.\Illuminate\Support\Facades\Auth::user()->avatar }}" height="26px" alt="">
                                                @else
                                                    <i class="nav-icon i-Checked-User" style="font-size: 26px;"></i>
                                                @endif
                                            </div>
                                            <div class="profile_owner">{{ \Illuminate\Support\Facades\Auth::user()->name }}</div>
                                        </div>

                                        <a data-toggle="collapse" class="text-default collapsed"
                                           href="#accordion-item-icons-{{ $report->id }}" aria-expanded="false">
                                            <span><i class="i-Data-Settings ul-accordion__font"> </i></span>
                                            {{ \Carbon\Carbon::parse($report->report_date)->format('d.m.Y') }} tarixi üçün həftəlik hesabat <strong class="text-{{$report->status == 2 ? 'success' : 'primary'}}">({{ $report->status==2 ? $receiver->name .' tərəfindən təsdiq olundu' : 'Təsdiq üçün göndərildi' }})</strong></a>
                                    </h6>

                                </div>


                                <div id="accordion-item-icons-{{ $report->id }}" class="collapse" data-parent="#accordionRightIcon"
                                     style="">
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach($report->reports_subjects as $subject_key => $subject)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <p class="text-primary">{{ $subject_key+1 }}. {{ $subject->subject }}</p>
                                                    <strong>{{ $subject->project_name }}</strong>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/$VERSION/dragula.min.js'></script> -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.6.6/dragula.min.js'></script>
    <script>
        $(document).ready(function () {
            $('#reports-table').DataTable({
                responsive: true
            });
        })

        @if (session('success'))
        const storeSuccess = "{{ session('success') }}";
        const SuccessAlert = Swal.fire({
            title: "Uğurlu!",
            text: storeSuccess,
            icon: "success"
        })
        SuccessAlert.fire();

        @php session()->forget('success') @endphp
        @endif


        @if (session('error'))
        const storeError = "{{ session('error') }}";
        const ErrorAlert = Swal.fire({
            title: "Xəta!",
            text: storeError,
            icon: "error"
        })
        ErrorAlert.fire();

        @php session()->forget('error') @endphp
        @endif
    </script>

    <script>

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });


        dragula([document.querySelector('#left'), document.querySelector('#right')]).on('drop', function (el, target, source, sibling) {
            const data_id = el.querySelector('p').getAttribute('data-id');
            const target_id = target.id
            console.log(data_id)
            console.log(target);
            // console.log(data_id);
            if (target_id == 'right') {
                $.ajax({
                    url: "{{ route('employee.update-reports-subjects') }}",
                    method: "POST",
                    data: {
                        "_token": "{{csrf_token()}}",
                        "data_id": data_id,
                        "target": "right",
                        "status": 1
                    },
                    success: function (response) {
                        let timerInterval;
                        Swal.fire({
                            html: response.message,
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getPopup().querySelector("b");
                                // timerInterval = setInterval(() => {
                                //     timer.textContent = `${Swal.getTimerLeft()}`;
                                // }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        })
                    }
                })
            } else if (target_id == 'left') {
                $.ajax({
                    url: "{{ route('employee.update-reports-subjects') }}",
                    method: "POST",
                    data: {
                        "_token": "{{csrf_token()}}",
                        "data_id": data_id,
                        "target": "left",
                        "status": 0
                    },
                    success: function (response) {
                        let timerInterval;
                        Swal.fire({
                            html: response.message,
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getPopup().querySelector("b");
                                // timerInterval = setInterval(() => {
                                //     timer.textContent = `${Swal.getTimerLeft()}`;
                                // }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        })
                    }
                })
            }
        });

        $('#add-new-subject').on("click", function () {
            const project_name = $('#new-subject-project').val();
            const subject_content = $('#new-subject-content').val();

            if (subject_content.trim() == '') {
                $('#subject-content-error').html('Tapşırıq məzmununu daxil edin');
            } else {
                $('#subject-content-error').html('');
                $.ajax({
                    url: "{{ route('employee.create-reports-subjects') }}",
                    method: "POST",
                    data: {
                        "_token": "{{csrf_token()}}",
                        "project_name": project_name,
                        "subject_content": subject_content,
                        "status": 0
                    },
                    success: function (response) {

                        $('#left').append('<div><div class="list_item"><p data-id="' + response.subjects.id + '">' + response.subjects.project_name + ' - ' + response.subjects.subject + '</p></div> <button data-id="' + response.subjects.id + '" class="remove-button">Sil</button></div>')

                        Toast.fire({
                            icon: response.icon,
                            title: response.message
                        });
                        $('#new-subject-project').val('');
                        $('#new-subject-content').val('');


                    }
                })

            }
        })

        $('.remove-button').on("click", function (e) {
            const data_id = $(this).data('id');
            Swal.fire({
                title: "Silmək istədiyinizdən əminsiniz ?",
                showCancelButton: true,
                cancelButtonText: "Ləğv et",
                confirmButtonText: "Sil",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('employee.delete-reports-subjects') }}",
                        method: "POST",
                        data: {
                            "_token": "{{csrf_token()}}",
                            "data_id": data_id
                        },
                        success: function (response) {
                            if (response.icon === 'success') {
                                $(`[data-id='${response.subject_id}']`).closest('div').remove();
                                Swal.fire("Məlumatlar silindi!", "", "success");
                            } else {
                                Swal.fire("Xəta baş verdi!", "", "error");
                            }
                        },
                        error: function (xhr, status, error) {
                            Swal.fire("Xəta baş verdi!", "", "error");
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });

        $('#submit-report').on("click", function () {
                var pCount = $("#right .list_item").find("p").length;
                if(pCount>0) {
                    Swal.fire({
                        title: "Hesabatın tərkibini təsdiqləyirsiniz ?",
                        showCancelButton: true,
                        cancelButtonText: "Ləğv et",
                        confirmButtonText: "Təsdiqlə",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('employee.confirm-reports') }}",
                                method: "POST",
                                data: {
                                    "_token": "{{csrf_token()}}",
                                },
                                success: function (response) {
                                    if (response.icon === 'success') {
                                        Swal.fire({
                                            icon: response.icon,
                                            title: response.message,
                                            showConfirmButton: false,
                                            timer: 1500
                                        }).then(function () {
                                            window.location.href = response.route;
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: response.icon,
                                            title: response.message
                                        });
                                    }
                                },
                                error: function (xhr, status, error) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Xəta baş verdi'
                                    });
                                }
                            });
                        }
                    });
                }
                else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Həftəlik hesabat tərkibi boşdur'
                    });
                }


        })


    </script>

@endsection
