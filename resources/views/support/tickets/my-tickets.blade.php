@extends('support.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body">
                    <i class="i-Ticket"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">
                            <strong>
                                Ümumi bilet sayı - {{ $total }}
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body">
                    <i class="i-Pause"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">
                            <strong>
                                Gözləyən bilet sayı - {{ $pending }}
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body">
                    <i class="i-Check"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">
                            <strong>
                                Həll olunan bilet sayı - {{ $solved }}
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body">
                    <i class="i-Time-Backup"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">
                            <strong>
                                Gecikən bilet sayı - {{ $solved }}
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Mənim biletlərim</h3>
                        <div>
                            <a href="{{route('support.tickets.index')}}">
                                <button class="btn btn-lg btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back"></i>
                                </span>
                                    Texniki dəstək biletləri
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

                                    <button class="btn btn-secondary show-details" data-ticket-id="{{$item->id}}">
                                            <span>
                                                <i class="nav-icon i-Eye font-weight-bold"></i>
                                            </span>
                                        Ətraflı bax
                                    </button>


                                    <span class="up-border"></span>
                                    <span class="down-border"></span>
                                </div> <!-- end item-right -->

                                <div class="item-left">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="event">{{$item->ticket_number}}</p>
                                        <strong class="text-white">{{ $item->helpdesk->name }}
                                        </strong>
                                    </div>
                                    <p style="white-space: nowrap; margin-top: 10px">{{ $item->user->name }}
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
                                    @if($item->status == 0 && $item->ticket_status == 0)
                                        <button class="tickets w-100 solve-ticket"
                                                data-ticket-number="{{ $item->ticket_number }}">Bilet statusunu
                                            dəyişdirin
                                        </button>
                                    @endif
                                    <button class="tickets w-100 {{ $class }}">{{ $text }}
                                    </button>
                                </div> <!-- end item-left -->
                            </div> <!-- end item -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
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
            // $('#tickets-table').DataTable();

            $('.solve-ticket').on("click", function () {
                const ticket_number = $(this).data('ticket-number');

                Swal.fire({
                    title: "Bilet statusunu seçin",
                    icon: "info",
                    html: `
                    <select class="form-control" id="ticket-status" name="status">
                        <option value="1">Həll olundu</option>
                        <option value="2">Problem yoxdur - Əsassız</option>
                        <option value="3">İnventar sıradan çıxıb</option>
                    </select>
                  `,
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
                        const selectedStatus = $('#ticket-status').val();
                        $.ajax({
                            url: "{{ route('support.update-ticket') }}",
                            method: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "ticket_number": ticket_number,
                                "ticket_status": selectedStatus
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
                    } else if (result.isDenied) {
                        Swal.fire("Dəyişikliklər qeydə alınmadı", "", "info");
                    }
                    ;
                });
            })

            $('.show-details').on('click', function () {
                const ticket_id = $(this).data('ticket-id');
                $.ajax({
                    url: "{{ route('support.get-ticket-details') }}",
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
    </script>
@endsection
