@extends('hr.layouts.app')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .employeeAnswerModal .swal2-popup {
            width: 80%;
        }

        .chartModal .swal2-chart {
            width: 50%;
        }
        @media screen and (max-width:900px) {
            .employeeAnswerModal .swal2-popup {
            width: 95%;
        }
            .chartModal .swal2-chart {
            width: 95%;
        }
        }

        #list-item {
            list-style: none;
        }

        .custom-container {
            background-color: transparent;
        }

        .custom-container .col-12 .surveys-name {
            border: 1px solid #C7C8CC;
        }

        .question-blank {}

        .checkbox-wrapper {
            width: 17%;
        }

        .answers ul li {
            gap: 30px;
        }

        .checkbox-wrapper input {
            width: 40px;
            height: 40px;
            border: 1px solid #C7C8CC;
        }

        .label-wrapper {
            /* border: 1px solid #C7C8CC; */
        }

        .label-wrapper label {
            height: 47px;
        }

        textarea {
            resize: none;
        }

        /* Hide the icon when a textarea is present within the same container */
        .chart {
            position: relative; /* Ensure positioning context for absolute child */
        }

        .chart .fa-chart-pie {
            display: block; /* Ensure icon is displayed by default */
            position: absolute;
            left: 15px;
        }

        .chart.has-textarea .fa-chart-pie {
            display: none; /* Hide the icon if the parent container has the .has-textarea class */
        }
        .chartIcon{
            transition-duration: .5s;
        }
        .chartIcon:hover{
scale: 1.25;
        }
    </style>


        <style>
        .progress-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .progress-label {
            width: 150px;
            padding: 4px 8px;
            background-color: #e0f7fa;
            border-radius: 12px;
            margin-right: 10px;
            text-align: center;
            font-size: 14px;
            color: #333;
        }

        .progress {
            position: relative;
            width: 100%;
            height: 100%;
            background-color: #f3f3f3;
            /* border-radius: 10px; */
        }

        .progress-bar {
            height: 100%;
            /* border-radius: 10px; */
            transition: width 0.3s ease;
        }
        .progress-bar.red {
            background-color: #F62700;
        }

        .progress-bar.yellow {
            background-color: #F8AA00;
        }

        .progress-bar.green {
            background-color: #00CE00;
        }



        .progress-bar.transparent {
            background-color: transparent;
        }

        .progress-percent {
            width: 80px;
            text-align: center;
            /* margin-left: 10px; */
            font-size: 14px;
            color: #333;
        }
    </style>

    <div class="pt-4 custom-container bg-white">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <ul class="m-0 p-0">
                                    <li id="list-item">
                                        @if ($survey->status == 0)
                                            <button class="btn btn-danger text-white">
                                                Deaktiv
                                            </button>
                                        @elseif ($survey->status == 1)
                                            <button class="btn btn-success text-white">
                                                Aktiv
                                            </button>
                                        @endif
                                    </li>
                                </ul>
                                <h3 class="ml-3 mt-0 mb-0 mr-0">{{ $survey->name }}</h3>
                            </div>
                            <a href="{{ route('hr.surveys.index') }}">
                                <button class="btn btn-danger">
                                    <span class="me-2">
                                        <i class="nav-icon i-Arrow-Back-2"></i>
                                    </span>
                                    Anketler
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($survey->surveys_questions as $question)
                                <div class="col-md-6 col-sm-12">
                                    <div class="card mb-4 chart">
                                        <div class="card-header w-100 d-flex justify-content-center align-items-center">
                                            <!-- <i class="fa-thin chartIcon cursor-pointer fa-chart-pie display-5"></i> -->
                                            <i class="fa-duotone fa-solid fa-chart-pie chartIcon cursor-pointer"  data-survey-id="{{ $survey->id }}"  data-question-id="{{ $question->id }}" style=" font-size:25px"></i>
                                            <!-- <i class="fa-thin chartIcon cursor-pointer fa-chart-pie" style="color: #252bd4; font-size:25px"></i> -->
                                            <h3 class="m-0">{{ $loop->iteration }}.</h3>
                                            <h3 class="m-0">{{ $question->question }}</h3>
                                        </div>
                                        <div class="card-body">
                                            @php
                                                $percentages = $questionPercentages[$question->id]['percentages'] ?? [];
                                            @endphp

                                            @if ($question->input_type == 'checkbox')
                                                <ul class="list-group-custom">
                                                    @foreach ($question->answers as $answer)
                                                        @php
                                                            $percentage = $percentages[$answer->name] ?? 0;
                                                            switch (true) {
                                                            case ($percentage > 66):
                                                                $color = 'green';
                                                                break;
                                                            case ($percentage > 33):
                                                                $color = 'yellow';
                                                                break;
                                                            case ($percentage > 0):
                                                                $color = 'red';
                                                                break;
                                                            default:
                                                                $color = 'gray'; }
                                                        @endphp
                                                    <li class="d-flex my-3 align-items-center w-100 justify-content-center align-items-center">
                                                        <div class="checkbox-wrapper d-flex align-items-center  pb-2 ">
                                                            <i class="fa-thin fa-square-check" style='font-size: 35px; color:#C7C8CC'></i>
                                                        </div>
                                                        <div class=" label-wrapper w-100 text-center " style="border:none">
                                                            <label class="progress-container d-flex justify-content-center align-items-center">
                                                            <div class="progress position-relative" style="border-radius: 2.25rem;">
                                                            
                                                            <div class="position-absolute w-100 d-flex align-items-center justify-content-center h-100">
                                                                <p class="chart-label text-nowrap p-2" style="width:95%;font-size: 14px;overflow-x:auto;">
                                                                {{ $answer->name }}
                                                                </p>
                                                     
                                                            </div>

                                                        </p>
                                                            
                                                            <div class="progress-bar   {{ $color }} "
                                                                style="width: {{ number_format($percentage, 2) }}%;" >
                                                                    
                                                                    </div>
                                                                </div>
                                                                <div class="progress-percent">{{ number_format($percentage, 2) }}%</div>
                                                            </label>
                            

                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            @elseif($question->input_type == 'radio')
                                                <ul class="list-group-custom">
                                                    <!-- radio check -->
                                                    @foreach ($question->answers as $answer)
                                                        @php
                                                            $percentage = $percentages[$answer->name] ?? 0;
                                                            switch (true) {
                                                            case ($percentage > 66):
                                                                $color = 'green';
                                                                break;
                                                            case ($percentage > 33):
                                                                $color = 'yellow';
                                                                break;
                                                            case ($percentage > 0):
                                                                $color = 'red';
                                                                break;
                                                            default:
                                                                $color = 'gray'; 
                            }
                                                        @endphp
                                                        <li class="d-flex my-3 align-items-center w-100 justify-content-between">
                                                            <div class="checkbox-wrapper d-flex align-items-center  pb-2">
                                                                <i class="fa-sharp fa-thin fa-circle-dot" style='font-size: 35px; color:#C7C8CC'></i>
                                                            </div>
                                                            <div class="label-wrapper w-100 text-center" style="border:none;">
                                                            <label class="progress-container d-flex justify-content-center align-items-center">
                                                            <div class="progress position-relative" style="border-radius: 2.25rem;">
                                                            <div class="position-absolute w-100 d-flex align-items-center justify-content-center h-100">
                                                                <p class=" chart-label  text-nowrap p-2" style="width:95%;font-size: 14px;overflow-x:auto;">
                                                                {{ $answer->name }}
                                                                </p>
                                                     
                                                            </div>
                                                                <div class="progress-bar   {{ $color }} "
                                                                style="width: {{ number_format($percentage, 2) }}%;color:#C7C8CC" >
                                                                    
                                                                    </div>
                                                                </div>
                                                                <div class="progress-percent">{{ number_format($percentage, 2) }}%</div>
                                                            </label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @elseif($question->input_type == 'textarea')
                                                <div class="form-floating">
                                                    <textarea rows="7" cols="10" class="form-control textarea-answer" disabled></textarea>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>İştirakçılar</h3>
                                    </div>
                                    <div class="card-body">
                                        @php
                                            $groupedParticipants = $users->groupBy(function ($user) {
                                                return $user->departments_id . '-' . $user->branches_id;
                                            });
                                        @endphp

                                        @foreach ($groupedParticipants as $group => $users)
                                            <div class="d-xl-flex mt-3 align-items-start">
                                                <h3 class="col-xl-2 m-0">
                                                    {{ $departments[$users->first()->departments_id] ?? 'Bilinməyən departament' }}
                                                </h3>

                                                <h4 class="col-xl-2 mb-0 mt-2 mt-xl-0">
                                                    {{ $branches[$users->first()->branches_id] ?? 'Bilinməyən şöbə' }}
                                                </h4>

                                                <div class="col-xl-8 d-flex align-items-start flex-wrap mt-2 mb-0 mt-xl-0">
                                                    @foreach ($users as $index => $user)
                                                        <h5 style="cursor: pointer"
                                                            class="employeeAnswer mt-1 mb-1 mt-xl-0 mb-xl-0 
                                                            @if (isset($is_answered[$user->id]) && $is_answered[$user->id] == 1) text-success @endif
                                                            "
                                                            data-survey-id="{{ $survey->id }}"
                                                            data-user-id="{{ $user->id }}"
                                                            data-user-name="{{ $user->name }}">
                                                            {{ $survey->is_anonym ? 'Anonim istifadəçi ' . $index + 1 : $user->name }}
                                                        </h5>,
                                                    @endforeach
                                                </div>
                                            </div>
                                            @if (!$loop->last)
                                                <hr class="hr" />
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('hr.surveys.edit', $survey->id) }}">
                            <button class="btn btn-info btn-lg">
                                <span class="me-2">
                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                </span>
                                Düzəliş et
                            </button>
                        </a>
                        <a href="#" class="delete-item" data-id="{{ $survey->id }}">
                            <button class="btn btn-danger btn-lg">
                                <span class="me-2">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </span>
                                Sil
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $(document).on("click", ".chartIcon", function() {
    const surveyId = $(this).data('survey-id');
    const questionId = $(this).data('question-id');

    $.ajax({
        url: `/employee/survey/answersdetails/${surveyId}/${questionId}`,
        method: 'GET',
        success: function(response) {
            let labels = [];
            let data = [];
            let backgroundColors = [];
            let userListsHtml = '';

            function getRandomColor() {
                const letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            // Обработка полученных данных
            $.each(response, function(answer, details) {
                labels.push(`${details.answer} (${details.count} человек)`); // Используем имя ответа и количество пользователей
                data.push(details.count); // Количество пользователей, выбравших данный ответ
                backgroundColors.push(getRandomColor()); // Генерируем случайный цвет для каждого ответа

                // Формируем список пользователей для каждого ответа
                userListsHtml += `
                    <div>
                        <h5>${details.answer} (${details.count} человек)</h5>
                        <ul>
                            ${details.users.map(user => `<li>${user}</li>`).join('')}
                        </ul>
                    </div>
                `;
            });

            // Отображение модального окна с диаграммой и списком пользователей
            Swal.fire({
                html: `
                    <div class="d-flex justify-content-center"> 
                        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                    </div>
                    <div class="mt-3">
                        ${userListsHtml}
                    </div>
                `,
                showCancelButton: false,
                confirmButtonText: "Ok",
                customClass: {
                    popup: 'swal2-chart',
                    container: 'chartModal'
                },
                didOpen: () => {
                    // Задержка для корректного рендеринга canvas
                    setTimeout(() => {
                        // Создание диаграммы с помощью Chart.js
                        new Chart("myChart", {
                            type: "doughnut", // Можно использовать также 'pie'
                            data: {
                                labels: labels, // Метки ответов с количеством людей
                                datasets: [{
                                    backgroundColor: backgroundColors, // Цвета сегментов
                                    data: data // Количество людей
                                }]
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: "Результаты вопроса"
                                },
                                responsive: true,
                            }
                        });
                    }, 100); // Задержка
                }
            });
        },
        error: function(error) {
            console.error("Failed to fetch answer details:", error);
        }
    });
});


        // Check each .chart div and add class if textarea is present
            $('.chart').each(function() {
                if ($(this).find('textarea').length > 0) {
                    $(this).addClass('has-textarea');
                }
            });

            // Handle delete button click
            $(document).on("click", ".delete-item", function() {
                const item_id = $(this).data('id');
                Swal.fire({
                    title: "Silmək istədiyinizdən əminsiniz?",
                    text: "Qeyd edək ki, silmək istədiyiniz elemendə bağlı olan bütün məlumatlar silinəcək!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sil!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/hr/surveys/" + item_id,
                            type: "DELETE",
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire(response.message).then((result) => {
                                    if (result.isConfirmed) {
                                        location.href = response.route;
                                    }
                                });
                            },
                        });
                    }
                });
            });

            // Handle employee answer click
            $(document).on("click", ".employeeAnswer", function() {
                const survey = @json($survey);
                const surveyId = $(this).data("survey-id");
                const userId = $(this).data("user-id");
                const user = $(this).data("user-name");
                fetchUserAnswers(surveyId, survey, user, userId);
            });

            // Fetch user answers
            function fetchUserAnswers(surveyId, survey, user, userId) {
                $.ajax({
                    url: `/employee/survey/answershr/${surveyId}/${userId}`,
                    method: 'GET',
                    success: function(response) {
                        console.log('Response:', response);
                        if (survey) {
                            showUserAnswersPopup(response, survey, user);
                        } else {
                            console.error('Survey not found in surveys data.');
                        }
                    },
                    error: function(error) {
                        console.error("Failed to fetch user answers:", error);
                    }
                });
            }

            // Show user answers in a popup
            function showUserAnswersPopup(answers, survey, user) {
                let answersHtml = '';

                const isAnonym = survey.is_anonym;
                console.log(isAnonym);

                survey.surveys_questions.forEach((question, index) => {
                    const questionId = question.id;
                    const questionType = question.input_type;
                    const answerList = answers[questionId] || [];

                    answersHtml += `
                    <div class="col-xl-6 col-12">
                        <div class="card mb-4">
                            <div class="card-header w-100 d-flex justify-content-center align-items-center">
                                <h3 class="m-0">${index + 1}.</h3>
                                <h3 class="m-0">${question.question}</h3>
                            </div>
                            <div class="card-body">`;

                    if (questionType === 'textarea') {
                        const textareaAnswer = answerList[0] ? answerList[0].answer : '';

                        answersHtml +=
                            `
                        <textarea disabled rows="10" class="form-control" style="box-sizing: border-box; width: 100%; resize: none;">${textareaAnswer}</textarea>`;
                    } else {
                        answersHtml += `<ul class="list-group-custom">`;
                        question.answers.forEach((option) => {
                            const isChecked = answerList.some(answer => answer.answer === option.name);

                            answersHtml += `
                            <li class="d-flex my-3 align-items-center w-100 justify-content-between">
                                <div class="d-flex align-items-center justify-content-between w-100 py-2">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <input type="${questionType}" disabled ${isChecked ? 'checked' : ''} 
                                               class="rounded border-bottom" style="width: 20px; height: 20px" />
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center w-100 pl-3">
                                        <label class="text-justify">${option.name}</label>
                                    </div>
                                </div>
                            </li>`;
                        });
                        answersHtml += `</ul>`;
                    }

                    answersHtml += `
                            </div>
                        </div>
                    </div>`;
                });

                Swal.fire({
                    title: `${survey.is_anonym ? 'Anonim istifadəçi' : user} Cavabları`,
                    html: `
                    <div class="row mb-4 w-100 ml-0 mt-0 mr-0">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        ${answersHtml}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`,
                    showCancelButton: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        popup: 'swal2-popup',
                        container: 'employeeAnswerModal'
                    }
                });
            }
        });
    </script>
@endsection




















