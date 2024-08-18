<style>
    .swal2-popup {
        width: 80%;
    }

    .swal2-html-container {
        overflow-x: hidden !important;
    }

    .name-date-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .name-date-wrapper h3,
    h4 {
        margin: 0 !important;
        padding: 0 !important;
    }

    .answers {
        gap: 1rem;
        text-align: center;
        align-items: center;
    }

    .answers label {
        width: 100%;
    }

    .card-header.name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .survey-height {
        height: 400px;
    }

    .no-survey {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        margin: 0;
        font-size: 1.2rem;
        color: #666;
        text-align: center;
    }

    #survey-hover {
        transition: .4s;
    }

    #survey-hover:hover {
        scale: 1.05;
    }
</style>
<link rel="stylesheet" href="/css/surveys/surveys_cu.css">

<div class="col-lg-4 col-md-6">
    <div class="card">
        <div class="card-header text-center" style="font-size:24px">Anketlər</div>
        <div class="card-body scrollable-content survey-height pt-0">
            @if($surveys->isEmpty())
                <p class="no-survey">Hal-hazırda aktiv anket yoxdur</p>
            @else
                <div class="row">
                    @foreach($surveys->sortByDesc('created_at') as $survey)
                        @php
                            $surveyUser = $surveys_users->firstWhere('surveys_id', $survey->id);
                        @endphp
                        <div class="col-6 mt-4">
                            <div class="card" id="survey-hover">
                                <div class="card-header text-center name">{{ $survey->name }}</div>
                                <div class="card-body">
                                    <div>
                                        <p class="m-0" style="font-weight:bold">Silinmə tarixi:</p>
                                        <p class="m-0">
                                            {{ \Carbon\Carbon::parse($survey->expired_at)->format('d-m-Y H:i') }}
                                        </p>
                                    </div>
                                    <div class="mt-3">
                                        @if ($survey->priority == 1)
                                            <p class="important">Önəmli</p>
                                        @else
                                            <p class="normal">Normal</p>
                                        @endif
                                    </div>
                                    <button class="btn btn-success btn-md mt-3 allSurveysButton"
                                        data-is-answered='{{$surveyUser->is_answered}}' data-survey-id='{{$survey->id}}'
                                        data-survey='@json($survey)' data-is-answered="true">
                                        @if ($surveyUser && $surveyUser->is_answered == 0) Cavabla
                                        @elseif ($surveyUser && $surveyUser->is_answered == 1) Cavabları gör
                                        @elseif ($surveyUser && $surveyUser->is_answered == 2) Anket Yeniləndi
                                        @endif
                                    </button>
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
    const csrfToken = '{{ csrf_token() }}';

    function showNecessarySurvey() {
        window.surveyData = @json($surveys);
    }

    window.addEventListener("DOMContentLoaded", showNecessarySurvey());
</script>
<script>
    window.surveyStoreUrl = "{{ route('employee.employee-submitSurvey') }}";
    window.csrfToken = "{{ csrf_token() }}";
</script>
