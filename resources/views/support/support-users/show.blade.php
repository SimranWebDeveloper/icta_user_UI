@extends('support.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>{{ $user->name }}</h3>
                        <a href="{{ route('support.support-users.index') }}">
                            <button class="btn btn-danger">
                                <span>
                                    <i class="nav-icon i-Arrow-Back"></i>
                                </span>
                                Texniki dəstək mütəxəssisləri
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- ICON BG -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                                <div class="card-body text-center">
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
                                <div class="card-body text-center">
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
                                <div class="card-body text-center">
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
                                <div class="card-body text-center">
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



                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Biletlər</h3>
                                </div>
                                <div class="card-body">
                                    @foreach($user->my_tickets as $item)
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
                                                            @can('Texniki dəstək bileti təhkim etmə')
                                                                <button class="tickets assign-ticket mt-0"
                                                                        data-ticket-number="{{ $item->ticket_number }}">Bileti təhkim et
                                                                </button>
                                                            @endcan

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

                                                        @if($item->status == 0 && is_null($item->helpdesk_id))
                                                            <button class="tickets w-100 accept-ticket"
                                                                    data-ticket-number="{{ $item->ticket_number }}">Bileti qəbul et
                                                            </button>
                                                        @endif
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
                                                    @if(count($user->my_tickets) > 0)
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
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
    </script>
@endsection
