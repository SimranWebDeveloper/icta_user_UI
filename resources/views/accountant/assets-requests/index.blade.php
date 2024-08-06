@extends('accountant.layouts.app')
@section('content')
    <style>
        .steps {
            border: 1px solid #e7e7e7
        }

        .steps-header {
            padding: .375rem;
            border-bottom: 1px solid #e7e7e7
        }

        .steps-header .progress {
            height: .25rem
        }

        .steps-body {
            display: table;
            table-layout: fixed;
            width: 100%
        }

        .step {
            display: table-cell;
            position: relative;
            padding: 1rem .75rem;
            -webkit-transition: all 0.25s ease-in-out;
            transition: all 0.25s ease-in-out;
            border-right: 1px dashed #dfdfdf;
            color: rgba(0, 0, 0, 0.65);
            font-weight: 600;
            text-align: center;
            text-decoration: none
        }

        .step:last-child {
            border-right: 0
        }

        .step-indicator {
            display: block;
            position: absolute;
            top: .75rem;
            left: .75rem;
            width: 1.5rem;
            height: 1.5rem;
            border: 1px solid #e7e7e7;
            border-radius: 50%;
            background-color: #fff;
            font-size: .875rem;
            line-height: 1.375rem
        }

        .has-indicator {
            padding-right: 1.5rem;
            padding-left: 2.375rem
        }

        .has-indicator .step-indicator {
            top: 50%;
            margin-top: -.75rem
        }

        .step-icon {
            display: block;
            width: 1.5rem;
            height: 1.5rem;
            margin: 0 auto;
            margin-bottom: .75rem;
            -webkit-transition: all 0.25s ease-in-out;
            transition: all 0.25s ease-in-out;
            color: #888
        }

        .step:hover {
            color: rgba(0, 0, 0, 0.9);
            text-decoration: none
        }

        .step:hover .step-indicator {
            -webkit-transition: all 0.25s ease-in-out;
            transition: all 0.25s ease-in-out;
            border-color: transparent;
            background-color: #f4f4f4
        }

        .step:hover .step-icon {
            color: rgba(0, 0, 0, 0.9)
        }

        .step-active,
        .step-active:hover {
            color: rgba(0, 0, 0, 0.9);
            pointer-events: none;
            cursor: default
        }

        .step-active .step-indicator,
        .step-active:hover .step-indicator {
            border-color: transparent;
            background-color: #64ff00;
            color: #fff
        }

        .step-active .step-icon,
        .step-active:hover .step-icon {
            color: #00ff20
        }

        .step-completed .step-indicator,
        .step-completed:hover .step-indicator {
            border-color: transparent;
            background-color: rgba(51, 203, 129, 0.12);
            color: #33cb81;
            line-height: 1.25rem
        }

        .step-completed .step-indicator .feather,
        .step-completed:hover .step-indicator .feather {
            width: .875rem;
            height: .875rem
        }

        @media (max-width: 575.98px) {
            .steps-header {
                display: none
            }
            .steps-body,
            .step {
                display: block
            }
            .step {
                border-right: 0;
                border-bottom: 1px dashed #e7e7e7
            }
            .step:last-child {
                border-bottom: 0
            }
            .has-indicator {
                padding: 1rem .75rem
            }
            .has-indicator .step-indicator {
                display: inline-block;
                position: static;
                margin: 0;
                margin-right: 0.75rem
            }
        }

        .bg-secondary {
            background-color: #f7f7f7 !important;
        }
    </style>
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Mal-material sorğusu</h3>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($assets as $asset_key => $assets_requests)
                        <div class="card mt-2">
                            <div class="p-5 mb-sm-4">
                                <!-- Details-->

                                <!-- Progress-->
                                <div class="steps">
                                    <div class="steps-header">
                                        <div class="p-4">
                                            <h4>{{ $assets_requests->user->name}}: {{ $assets_requests->content }}</h4>
                                            <br>
                                            <h5>Sorğunun yaradılma tarixi: {{ $assets_requests->created_at }}</h5>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: {{20+$assets_requests->assets_requests_details()->where('status', 2)->count()*20}}%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="steps-body">
                                        <div class="step step-completed">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <img src="{{ asset('assets/images/2.jpeg') }}" height="150px;"  width="150px;" alt="">
                                                <strong>
                                                    Mal-material sorğusu yaradıldı
                                                </strong>
                                            </div>
                                        </div>
                                        @foreach($assets_requests->assets_requests_details as $detail_key => $detail)
                                            <div class="step step-completed">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <img src="{{ asset('assets/images/').'/'.$detail->status.'.jpeg' }}" height="150px;"  width="150px;" alt="">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h3>{{ $detail->users->name }}</h3>
                                                            @if(\Illuminate\Support\Facades\Auth::user()->id == $detail->users_id && $check_available[$asset_key] && $detail->status == 1)
                                                                <button class="btn btn-outline-success w-100 confirm-request" data-detail-id="{{ $detail->id }}" data-status="2">
                                                                    Təsdiq edin
                                                                </button>
                                                                <button class="btn btn-outline-danger mt-2 w-100 reject-request" data-detail-id="{{ $detail->id }}" data-status="0">
                                                                    Ləğv edin
                                                                </button>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('document').ready(function () {
            $('.confirm-request').on('click', function () {
                var detailId = $(this).data('detail-id');
                var status = 0;

                $.ajax({
                    url: "{{ route('accountant.assets-requests.submit') }}",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    data: {
                        "status": status,
                        "detailId": detailId
                    },
                    success: function (response) {
                        Swal.fire({
                            title: 'Uğurlu!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        Swal.fire({
                            title: 'Xəta!',
                            text: 'Xəta baş verdi.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            $('document').ready(function () {
                $('.reject-request').on('click', function () {
                    var detailId = $(this).data('detail-id');
                    Swal.fire({
                        title: 'Geri çevirmə (qəbul etməmə)',
                        html: '<label for="rejectReason">Zəhmət olmasa səbəbi daxil edin:</label>' +
                            '<input id="rejectReason" class="swal2-input" required>',
                        inputAttributes: {
                            autocapitalize: 'off',
                            autocorrect: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Göndər',
                        cancelButtonText: 'Ləğv et',
                        preConfirm: () => {
                            const reason = document.getElementById('rejectReason').value;
                            if (!reason) {
                                Swal.showValidationMessage('Səbəbi daxil etməlisiniz');
                            }
                            return reason;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var reason = result.value;
                            $.ajax({
                                url: "{{ route('accountant.assets-requests.submit') }}",
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                data: {
                                    "status": 0,
                                    "detailId": detailId,
                                    "reason": reason
                                },
                                success: function (response) {
                                    Swal.fire({
                                        title: 'Uğurlu!',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                },
                                error: function (xhr, status, error) {
                                    console.error(error);
                                    Swal.fire({
                                        title: 'Xəta!',
                                        text: 'Xəta baş verdi',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
                        }
                    });
                });
            });
        });
    </script>

    <script>
        $('document').ready(function () {
            @if(session('success'))
            Swal.fire("Sorğu uğurla təsdiq edildi");
            @endif
        });
    </script>
@endsection
