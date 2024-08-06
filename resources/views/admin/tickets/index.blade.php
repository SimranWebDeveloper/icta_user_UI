@extends('admin.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-lg-8 col-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center ">
                        <h3 class="">Texniki dəstək biletləri</h3>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($tickets as $item)
                        @php
                            if($item->status == 0) {
                                $text = 'Gözləyir';
                                $class = 'status-warning';
                            } elseif ($item->status == 1) {
                                $text = 'Həll olundu';
                                $class = 'status-success';
                            } elseif($item->status == 2) {
                                $text = 'Problem yoxdur - Əsassız';
                                $class = 'status-primary';
                            } elseif($item->status == 3) {
                                $text = 'İnventar sıradan çıxıb';
                                $class = 'status-danger';
                            }
                        @endphp
                        <div class="ticket-container">
                            <div class="item {{ $class }}">
                                <div class="item-right">
                                    <h2 class="num">{{ \Illuminate\Support\Carbon::parse($item->created_at)->format('d') }}</h2>
                                    <p class="day">{{ \Illuminate\Support\Carbon::parse($item->created_at)->format('M') }}</p>

                                    <button class="btn btn-secondary show-details" data-ticket-id="{{$item->id}}">
                                            <span>
                                                <i class="nav-icon i-Eye font-weight-bold"></i>
                                            </span>
                                        Ətraflı bax
                                    </button>
                                    <span class="up-border"></span>
                                    <span class="down-border"></span>
                                    <!-- Göz simgesi burada -->

                                </div> <!-- end item-right -->

                                <div class="item-left">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="event mb-0">{{$item->ticket_number}}</p>
                                        @if(!$item->helpdesk_id)
                                            <button class="tickets assign-ticket mt-0"
                                                    data-ticket-number="{{ $item->ticket_number }}">Bileti təhkim et
                                            </button>
                                        @else
                                            <strong class="text-white">{{ $item->helpdesk->name }}
                                            </strong>
                                        @endif
                                    </div>
                                    <p style="white-space: wrap; margin-top: 10px">{{ $item->user->name }}
                                        - {{ $item->appointments->products->product_name }}</p>
                                    <div class="sce">
                                        <div class="icon">
                                            <i class="nav-icon i-Calendar"></i>
                                        </div>
                                        <strong>{{ \Illuminate\Support\Carbon::parse($item->created_at)->format('d.m.Y') }}</strong>
                                    </div>
                                    <div class="fix"></div>
                                    <div class="loc">
                                        <strong>{{$item->ticket_reasons->reason}}</strong>
                                    </div>
                                    <div class="desc_container">
                                        <input type="checkbox" class="hidden_check" id="myInput{{$item -> id}}"
                                               style="display: none">
                                        <label class="description" for='myInput{{$item -> id}}'>{{$item->note}}</label>
                                    </div>
                                    {{--                                    <div class="fix"></div>--}}
                                    <div
                                        class="d-flex flex-column align-items-end justify-content-end buttons_container"
                                        style="height: 87px">
                                        <button class="tickets w-100">{{ $text }}</button>
                                    </div>
                                </div> <!-- end item-left -->
                            </div> <!-- end item -->
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Bilet əməliyyatları</h3>
                        <hr>
                        <div class="main-card mb-3">
                            <div class="card-body">
                                <div class="vertical-timeline-item vertical-timeline-element text-center">
                                    @if(count($tickets) > 0)
                                        Əməliyyat tarixçəsinə baxmaq üçün zəhmət olmasa bilet seçin
                                    @else
                                        Texniki dəstək bileti yaradılmayıb
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#appointments-table').DataTable();

            $(".assign-ticket").on("click", function () {
                const ticket_number = $(this).data('ticket-number');
                Swal.fire({
                    title: "Zəhmət olmasa mütəxəssis seçin",
                    icon: "info",
                    html: `
                        <select id="user_id" name="user_id" class="form-control ui fluid search dropdown create_form_dropdown">
                            @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                    </select>`,
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText: `
                    <i class="fa fa-thumbs-up"></i> Təsdiqləyin
                  `,
                    confirmButtonAriaLabel: "Təsdiqləyin",
                    cancelButtonText: `
                    <i class="fa fa-thumbs-down"></i> Ləğv edin
                  `,
                    cancelButtonAriaLabel: "Ləğv edin"
                }).then((result) => {
                    if (result.isConfirmed) {
                        const user_id = $('#user_id').val();
                        $.ajax({
                            url: "{{ route('admin.assign-ticket') }}",
                            method: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "ticket_number": ticket_number,
                                "user_id": user_id,
                            },
                            success: function (response) {
                                if (response.status == 200) {
                                    Swal.fire(response.notification, "", "success")
                                        .then((result) => {
                                            if (result.isConfirmed) {
                                                location.href = response.route
                                            }
                                        });
                                } else if (response.status == 404) {
                                    Swal.fire(response.notification, "", "danger")
                                        .then((result) => {
                                            if (result.isConfirmed) {
                                                location.href = response.route
                                            }
                                        });
                                } else {
                                    Swal.fire(response.notification, "", "info")
                                        .then((result) => {
                                            if (result.isConfirmed) {
                                                location.href = response.route
                                            }
                                        });
                                }

                            }
                        })
                    } else {
                        Swal.fire("Dəyişikliklər qeydə alınmadı", "", "info");
                    }
                    ;
                });
            })

            $('.show-details').on('click', function () {
                const ticket_id = $(this).data('ticket-id');
                $.ajax({
                    url: "{{ route('admin.get-ticket-details') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "ticket_id": ticket_id
                    },
                    success: function (response) {
                        $('.main-card').html('');
                        $('.main-card').html(response);
                    }
                })
            })
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
@endsection
