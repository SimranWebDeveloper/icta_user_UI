<style>
    #meetings {
        transition: .4s;
    }

    #meetings:hover {
        scale: 1.05;
    }
</style>
<div class="col-lg-4 col-md-6 mt-4 mt-md-0">
    <div class="card">
        <div class="card-header">Iclas və tədbirlər</div>
        <div class="card-body scrollable-content pt-0">
            <div class="row">
                @foreach($meetings as $meeting)
                    <div class="col-6 mt-4">
                        <div id="meetings" class="card" style="cursor:pointer;">
                            <div class="card-header text-center">{{ $meeting->subject }}</div>
                            <div class="card-body">
                                <p>{{ $meeting->rooms->name }}</p>
                                <p class="m-0">
                                    {{ \Carbon\Carbon::parse($meeting->start_date_time)->format('d-m-Y H:i') }}-dan etibarən
                                    {{ $meeting->duration }} dəqiqə
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>