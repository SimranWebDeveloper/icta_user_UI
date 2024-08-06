@extends('admin.layouts.app')
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
                    <div class="accordion" id="accordionRightIcon">

                        @foreach($reports as $report)
                            <div class="card p-8">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0 data_head_container">
                                        <div class="profile_container">
                                            <div class="profile_img">
                                                @if(!is_null($report->user->avatar))
                                                    <img src="{{ asset('assets/images/avatars').'/'.$report->user->avatar }}" height="26px" alt="">
                                                @else
                                                    <i class="nav-icon i-Checked-User" style="font-size: 26px;"></i>
                                                @endif
                                            </div>
                                            <div class="profile_owner">{{ $report->user->name }}</div>
                                        </div>

                                        <a data-toggle="collapse" class="text-default collapsed"
                                           href="#accordion-item-icons-{{ $report->id }}" aria-expanded="false">
                                            <span><i class="i-Data-Settings ul-accordion__font"> </i></span>
                                            {{ \Carbon\Carbon::parse($report->report_date)->format('d.m.Y') }} tarixi üçün həftəlik hesabat</a>
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
