<style>
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
        <div class="card-body scrollable-content pt-0">
            <div class="row">
                @foreach($meetings as $meeting)
                    <div class="col-6 mt-4">
                        <div id="meetings" class="card" data-meeting='@json($meeting)'>
                            <div class="card-header text-center subject">{{ $meeting->subject }}</div>
                            <div class="card-body">
                                <p>{{ $meeting->rooms->name }}</p>
                                <p class="m-0">
                                    {{ \Carbon\Carbon::parse($meeting->start_date_time)->format('d-m-Y H:i') }}-dan etibarən
                                    {{ $meeting->duration }} dəqiqə
                                </p>
                                <button id="meetingButton" class="btn btn-success btn-md mt-3 meetingButton"
                                    data-meeting='@json($meeting)'>
                                    Cavabla
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    window.participationStatusUrl = "{{ route('employee.employee-updateParticipationStatus') }}";
    window.csrfToken = "{{ csrf_token() }}";
</script>


