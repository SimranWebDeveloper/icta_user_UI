@extends('employee.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Texniki dəstək biletlərim</h3>
                        <div>
                            <a href="{{route('employee.tickets.create')}}">
                                <button class="btn btn-success">
                                <span class="me-2">
                                    <i class="nav-icon i-Add-File"></i>
                                </span>
                                    Yeni texniki dəstək bileti
                                </button>
                            </a>
                        </div>
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
                                    <span class="up-border"></span>
                                    <span class="down-border"></span>
                                </div> <!-- end item-right -->

                                <div class="item-left">
                                    <p class="event">{{$item->ticket_number}}</p>
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
                                    <div class="fix"></div>
                                    <div
                                        class="d-flex flex-column align-items-end justify-content-end buttons_container" style="height: 87px">

                                        @if($item->ticket_status == 0)
                                            <button class="tickets w-100 close-ticket"
                                                    data-ticket-helpdesk="{{ $item->helpdesk_id }}"
                                                    data-ticket-status="{{ $item->status }}"
                                                    data-id="{{ $item->ticket_number }}">
                                                Bileti {{ is_null($item->helpdesk_id) ? 'sil' : 'bağla' }}
                                            </button>
                                        @else
                                            <button class="tickets w-100">Bilet bağlıdır</button>
                                        @endif
                                        @if($item->status !=0 && $item->ticket_status == 1)
                                            <button class="tickets w-100">{{ $text }}</button>
                                        @endif
                                    </div>
                                </div> <!-- end item-left -->
                            </div> <!-- end item -->
                        </div>
                    @endforeach
                </div>

            </div>


        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#appointments-table').DataTable();

            $(".close-ticket").on("click", function () {
                const ticket_number = $(this).data('id');
                const ticket_helpdesk = $(this).data('ticket-helpdesk');
                const ticket_status = $(this).data('ticket-status');
                const ratingHtml = ticket_helpdesk && ticket_status != 0  ? `
                <div class="rating-stars">
                    <input type="radio" name="rating" id="rs0" value="0" checked><label for="rs0"></label>
                    <input type="radio" name="rating" id="rs1" value="1"><label for="rs1"></label>
                    <input type="radio" name="rating" id="rs2" value="2"><label for="rs2"></label>
                    <input type="radio" name="rating" id="rs3" value="3"><label for="rs3"></label>
                    <input type="radio" name="rating" id="rs4" value="4"><label for="rs4"></label>
                    <input type="radio" name="rating" id="rs5" value="5"><label for="rs5"></label>
                    <span class="rating-counter"></span>
                </div>
            ` : '';

                const text = ticket_helpdesk ? "bağlamaq" : "silmək";
                Swal.fire({
                    title: `Bileti ${text} istəyirsiniz ?`,
                    icon: "question",
                    html: ratingHtml,
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
                        const selectedRating = $('input[name="rating"]:checked').val();
                        $.ajax({
                            url: "{{ route('employee.update-ticket') }}",
                            method: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "ticket_number": ticket_number,
                                "ticket_rating": ticket_helpdesk && ticket_status != 0 ? selectedRating : 'NULL',
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
