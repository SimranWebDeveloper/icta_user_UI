<style>
    .fixed-height {
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

    #meetings {
        transition: .4s;
    }

    #meetings:hover {
        scale: 1.05;
    }

    .card-header.subject {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<div class="col-lg-4 col-md-6 mt-4 mt-md-0">
    <div class="card">
        <div class="card-header text-center" style="font-size:24px">Iclas və tədbirlər</div>
        <div class="card-body scrollable-content fix-height pt-0">
            @if($meetings->isEmpty())
                <p class="no-meeting">Hal-hazırda aktiv iclas, tədbir və ya rezerv yoxdur</p>
            @else
                    <div class="row">
                        @foreach($meetings as $meeting)
                                    @php
                                        $meetingUser = $meetings_users->firstWhere('meetings_id', $meeting->id);
                                    @endphp
                                    <div class="col-6 mt-4">
                                        <div id="meetings" class="card" data-meeting='@json($meeting)'>
                                            <div class="card-header text-center subject d-flex justify-content-between align-items-center">
                                                {{ $meeting->subject }} 
                                                <i class="fa-solid fa-badge-check" style="color: #008000;font-size:20px"></i>
                                                <i class="fa-solid fa-seal-exclamation" style="color: #ff0000; font-size:20px"></i>
                                            </div>
                                            <div class="card-body">
                                                <p>{{ $meeting->rooms->name }}</p>
                                                <p class="m-0" style="font-size:13px">
                                                    {{ \Carbon\Carbon::parse($meeting->start_date_time)->format('d-m-Y H:i') }}-dan etibarən
                                                    {{ $meeting->duration }} dəqiqə
                                                </p>
                                                @if ($meetingUser && $meetingUser->participation_status == 1)
                                                    <button id="meetingButton" class="btn btn-success btn-md mt-3 meetingButton"
                                                        data-meeting='@json($meeting)'>
                                                        Cavablandırıldı
                                                    </button>
                                                @else
                                                    <button id="meetingButton" class="btn btn-success btn-md mt-3 meetingButton"
                                                        data-meeting='@json($meeting)'>
                                                        Cavablandir
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