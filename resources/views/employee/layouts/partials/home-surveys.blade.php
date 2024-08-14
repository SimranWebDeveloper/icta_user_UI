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
</style>
<link rel="stylesheet" href="/css/surveys/surveys_cu.css">

<div class="col-lg-4 col-md-6">
    <div class="card">
        <div class="card-header text-center" style="font-size:24px">Anketlər</div>
        <div class="card-body scrollable-content pt-0">
            <div class="row">
                @foreach($surveys as $survey)
                @php
                    $surveyUser = $surveys_users->firstWhere('surveys_id', $survey->id);
                @endphp
                <div class="col-6 mt-4">
                    <div class="card">
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




                             
                            <button class="btn btn-success btn-md mt-3 allSurveysButton" data-is-answered='{{$surveyUser->is_answered}}'  data-survey-id='{{$survey->id}}' data-survey='@json($survey)' data-is-answered="true">
                                @if ($surveyUser && $surveyUser->is_answered == 0) Cavabla
                                @elseif ($surveyUser && $surveyUser->is_answered == 1) Cavablari gör
                                @elseif ($surveyUser && $surveyUser->is_answered == 2) Anket Yenilendi
                                @endif
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

    const csrfToken = '{{ csrf_token() }}';

    function showNecessarySurvey() {
        window.surveyData = @json($surveys);
    }

    window.addEventListener("DOMContentLoaded", showNecessarySurvey());
    
</script>
<script>
window.surveyStoreUrl = "{{route('employee.employee-submitSurvey') }}";
window.csrfToken = "{{ csrf_token() }}";
</script>





