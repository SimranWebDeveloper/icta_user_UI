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
        <div class="card-header">Anketlər</div>
        <div class="card-body scrollable-content pt-0">
            <div class="row">
                @foreach($surveys_users as $survey)
                    <div class="col-6 mt-4">
                        <div class="card">
                            <div class="card-header text-center name">{{ $survey->surveys->name }}</div>
                            <div class="card-body">
                                <div>
                                    <p class="m-0" style="font-weight:bold">Silinmə tarixi:</p>
                                    <p class="m-0">
                                        {{ \Carbon\Carbon::parse($survey->surveys->expired_at)->format('d-m-Y H:i') }}
                                    </p>
                                </div>
                                <div class="mt-3">
                                    @if ($survey->surveys->priority == 1)
                                        <p class="important">Önəmli</p>
                                    @else
                                        <p class="normal">Normal</p>
                                    @endif
                                </div>

                                @if ($survey->is_answered == 1)
                                <button class="btn btn-success btn-md mt-3 surveyButton" data-survey='@json($survey)'>
                                    Cavablandirilib
                                </button>
                                @else
                                <button class="btn btn-success btn-md mt-3 surveyButton" data-survey='@json($survey)'>
                                    Cavabla
                                </button>
                                @endif

                                
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <form action="">

    @csrf
    <button type="submit">Submit</button>
    </form>

    <form action="">

@csrf
<button type="submit">Submit2</button>
</form>
</div>


<script>

    const csrfToken = '{{ csrf_token() }}';

    function showNecessarySurvey() {
        window.surveyData = @json($surveys);
    }

    window.addEventListener("DOMContentLoaded", showNecessarySurvey());
    
</script>