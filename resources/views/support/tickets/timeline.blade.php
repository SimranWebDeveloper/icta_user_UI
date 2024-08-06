@foreach($ticket->ticket_histories as $hisItem)
    <div class="card-body">
        <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">

            <div class="vertical-timeline-item vertical-timeline-element">
                <div>
                                            <span class="vertical-timeline-element-icon bounce-in">
                                                <i class="badge badge-dot badge-dot-xl badge-success"> </i>
                                            </span>
                    <div class="vertical-timeline-element-content bounce-in">
                        <h4 class="timeline-title text-success">{{ $hisItem->subject }}</h4>
                        <p>{{ $hisItem->description }}</p>
                        <span class="vertical-timeline-element-date">{{ \Carbon\Carbon::parse($hisItem->created_at)->format('d.m.Y') }}</span>
                        <br>
                        <span class="vertical-timeline-element-time">{{ \Carbon\Carbon::parse($hisItem->created_at)->format('H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
