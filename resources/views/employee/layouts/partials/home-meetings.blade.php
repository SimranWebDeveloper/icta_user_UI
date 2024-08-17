<style>
    .fix-height {
        height: 400px;
    }

    .no-meeting {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        margin: 0;
        font-size: 1.2rem;
        color: #666;
        text-align: center;
    }
    .employeeMeetingModal .swal2-popup {
        width: 30%;
    }
    .notEmployee .notEmployee-popup {
        width: 30%;
    }
        @media (max-width: 968px) {
         .employeeMeetingModal .swal2-popup {
        width: 90%;
    }
    .notEmployee .notEmployee-popup {
        width: 90%;
    }
}
    #meetings {
        transition: .4s;
    }

    #meetings:hover {
        scale: 1.05;
    }

    .card-header>.subject {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<div class="col-lg-4 col-md-6 mt-4 mt-md-0">
    <div class="card">
        <div class="card-header text-center" style="font-size:24px">İclas və tədbirlər</div>
        <div class="card-body scrollable-content fix-height pt-0">
            @if($meetings->isEmpty())
                <p class="no-meeting">Hal-hazırda aktiv iclas, tədbir və ya rezerv yoxdur</p>
            @else
                <div class="row">
                    @foreach($meetings->sortByDesc('created_at') as $meeting)
                        @php
                            $meetingUser = $meetings_users->firstWhere('meetings_id', $meeting->id);
                        @endphp
                        <div class="col-6 mt-4">
                            <div id="meetings" class="card" data-meeting='@json($meeting)'>
                                <div class="card-header pl-2 pr-2 d-flex justify-content-between align-items-center">
                                    <p class="subject p-0 m-0">{{ $meeting->subject }}</p> 
                                    @php
                                        $status = $meetingUser->participation_status;
                                    @endphp

                                    @if (is_null($status))
                                        <i class="fa-solid fa-question-circle" style="color: #888888;font-size:20px"></i>
                                    @else
                                        @switch($status)
                                            @case(1)
                                                <i class="fa-solid fa-badge-check" style="color: #008000;font-size:20px"></i>
                                                @break

                                            @case(0)
                                                <i class="fa-solid fa-seal-exclamation" style="color: #ff0000; font-size:20px"></i>
                                                @break

                                            @default
                                                <i class="fa-solid fa-question-circle" style="color: #888888;font-size:20px"></i>
                                        @endswitch
                                    @endif
                                </div>
                                <div class="card-body">
                                    <p>{{ $meeting->rooms->name }}</p>
                                    <p class="m-0" style="font-size:13px">
                                        {{ \Carbon\Carbon::parse($meeting->start_date_time)->format('d-m-Y H:i') }}-dan etibarən
                                        {{ $meeting->duration }} dəqiqə
                                    </p>
                                    @if ($meetingUser && $meetingUser->participation_status === 1)
                                        <button id="meetingButton" class="btn btn-success btn-md mt-3 meetingButton"
                                        data-is-answered="true"
                                        data-meeting='@json($meeting)'>
                                        Cavablandırıldı
                                    </button>
                                    @elseif ($meetingUser && $meetingUser->participation_status === 0)
                                    <button id="meetingButton" class="btn btn-success btn-md mt-3 meetingButton"
                                    data-is-answered="false"
                                    data-meeting='@json($meeting)'>
                                    Cavablandırıldı
                                </button>
                                    @else
                                    <button id="meetingButton" class="btn btn-success btn-md mt-3 meetingButton"
                                    data-is-answered="null"
                                    data-meeting='@json($meeting)'>
                                    Cavabla
                                </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>


<script>
    window.participationStatusUrl = "{{ route('employee.employee-updateParticipationStatus') }}";
    window.csrfToken = "{{ csrf_token() }}";
</script>