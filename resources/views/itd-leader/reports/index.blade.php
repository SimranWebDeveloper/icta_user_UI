@extends('itd-leader.layouts.app')
@section('content')

    <style>
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
                    <div class="d-flex">
                        <h3>Hesabatlar</h3>
                    </div>
                </div>
                <div class="card-body">

                    <!-- right control icon -->

                    <div class="row">
                        @foreach($dates as $date_key => $date)
                            <div class="col-md-3">
                                <a href="{{ route('itd-leader.itd-report-details', ['date' => $date->report_date]) }}">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <h6 class="mb-3">{{ $date->report_date }} üçün göndərilən hesabatlar</h6>
                                            <p class="mb-1 text-22 font-weight-light">{{ $persentages[$date_key] }}%</p>
                                            <div class="progress mb-1" style="height: 4px">
                                                <div class="progress-bar bg-success" style="width: {{ $persentages[$date_key] }}%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <small class="text-muted">{{ $date->report_count }} hesabat daxil olub</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- /right control icon -->

                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
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
@endsection
