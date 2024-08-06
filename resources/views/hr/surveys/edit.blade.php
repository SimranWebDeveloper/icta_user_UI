@extends('hr.layouts.app')
@section('content')
<link rel="stylesheet" href="/css/surveys/surveys_cu.css">
        <div class="card">
            <!-- title -->
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="m-0">
                    <span class="text-capitalize">
                    {{ $data->name }}
                    </span> redaktə et </h3>
                    <a href="{{route('hr.surveys.index')}}">
                        <button class="btn btn-danger">
                            <span class="me-2">
                                <i class="nav-icon i-Arrow-Back-2"></i>
                            </span>
                            Anketlər
                        </button>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{route('hr.surveys.update', $data->id)}}" onsubmit="return submitForm(event)">
                    @csrf
                    @method("PUT")
                    <!-- general info -->
                    <div class="row mb-3 ">
                        <!-- Anket adi -->
                        <div class="col-md-6 col-lg-4 col-xl-3 form-group ">
                            <div class="select_label ui sub header">Anket adı <span class="text-danger">*</span></div>

                            <input title="" type="survey-name" name="name" value="{{ $data->name }}" required class="form-control"
                                placeholder="Anket adını daxil edin">
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <!-- Tarix -->
                        <div class="col-md-6 col-lg-4 col-xl-3 form-group mb-3">

                            <div class="select_label ui sub header">Silinmə tarixi <span class="text-danger">*</span>
                            </div>

                            <input type="text" id="date-time-picker" value="{{ $data->expired_at }}" name="expired_at" required class="form-control"
                                placeholder="Silinmə tarixini daxil edin">
                        </div>
                        <!-- Elanin statusu -->
                        <div class="col-md-6 col-lg-4 col-xl-3 form-group mb-3">
                            <!-- ui fluid search dropdown -->
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select id="status" name="status" required class="form-control form-control-select  ">
                                <option value="" disabled {{ old('status') == '' ? 'selected' : '' }}>Elanın statusunu
                                    seçin</option>
                                <option value="1" {{ $data->status == '1' ? 'selected' : '' }} class="">Aktiv</option>
                                <option value="0" {{ $data->status == '0' ? 'selected' : '' }} class="">Deaktiv</option>
                                <option value="2" {{ $data->status == '2' ? 'selected' : '' }} class="">Gözləmə</option>
                            </select>

                            @if($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                        <!-- Elanin is_anonym -->
                        <div class="col-md-6 col-lg-4 col-xl-3 form-group mb-3">
                            <label for="subtitle" class="form-label">Görünmə <span class="text-danger">*</span></label>
                            <select name="is_anonym" required id="is_anonym" title="" class="form-control ">
                                <option value="" selected disabled>Elanın Görünməsini seçin</option>
                                <option value="0" {{ $data->is_anonym == '0' ? 'selected' : '' }}>Açıq</option>
                                <option value="1" {{ $data->is_anonym == '1' ? 'selected' : '' }}>Gizli</option>
                            </select>
                            @if($errors->has('is_anonym'))
                                <span class="text-danger">{{ $errors->first('is_anonym') }}</span>
                            @endif
                        </div>

                    </div>

                    <!-- questions container -->
                    <div class="row questions-container">

                        <!-- questions -->
                        @foreach ($data->surveys_questions as $question_key => $question)
                       
                        <div class="col-lg-6 my-3 " id="c{{$question->id}}">

                            <div class=" row  custom-card  position-relative">

                                <button type="button" class="position-left btn btn-danger z-custom-index"
                                    onclick="removeQuestion({{$question->id}})">X</button>

                                <div class="col-md-8 form-group mb-3">
                                    <div class="select_label ui sub header"><span></span> Sual <span
                                            class="text-danger">*</span></div>

                                        
                                        <div class="line-break-input disabled-div " >{{$question->question}}</div>
                                        <input type="hidden"  name="question[{{ $question->id }}]" value="{{$question->question}}">

                                    @if($errors->has('question'))
                                        <span class="text-danger">{{ $errors->first('question') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group mb-3 ">
                                    <div class="select_label ui sub header ">Sualın növü <span
                                            class="text-danger">*</span></div>
                                    <select id="input_type-0"  style="height: 48px;"  aria-readonly="true"
                                     name="input_type[{{ $question->id }}]"
                                        class="input_type form-control ui fluid search dropdown ">
                                        <option value="checkbox"    {{ $question->input_type == 'checkbox' ? 'selected' : '' }}>
                                            Çox variantlı</option>
                                        <option value="radio"  {{ $question->input_type == 'radio' ? 'selected' : '' }}>Tək
                                            variantlı</option>
                                        <option value="textarea"  {{ $question->input_type == 'textarea' ? 'selected' : '' }}>
                                            Mətn</option>
                                    </select>

                       
                                    @if($errors->has('input_type'))
                                        <span class="text-danger">{{ $errors->first('input_type') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-12 form-group mb-3" id="todo-content-0">
                                    <div class="select_label ui sub header ">Cavab və ya cavablar <span
                                            class="text-danger">*</span></div>
                                    <div class="todo-container" style="width: 100%;">
                                        <div id="todo-header">

                                            <input type="text" id="todo-input-0" 
                                                class="todo-input form-control form-control-left-radius disabled-div "
                                                placeholder="Yeni cavab daxil edin">


                                            <button class="add-btn btn-right-radius btn-success disabled-div" type="button"
                                                onclick="addTodo(0)">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>

                                        <ul id="todo-list-0" class="todo-list disabled-div">
                                            @foreach ($question->answers as $answer)
                                            <li>                                          

                                                <p class="line-break-input disabled-div  "  style="width: calc(100% - 70px)">{{ $answer->name }}</p>
                                                <input type="hidden"  name="answer_value[{{ $question->id }}][]" value="{{ $answer->name }}"/>

                                                <button class="remove" onclick="removeSelf(this)" type="button">Delete</button>
                                            </li>
                                            @endforeach
                                        </ul>
                                        
                                    </div>
                                </div>

                            </div>

                        </div>
                        @endforeach




                    </div>

                    <div class="mt-4">
                        <button type="button" id="add-question-btn" class="btn btn-outline-success">Yeni Sual Əlavə
                            et</button>
                    </div>

                    <div class="mt-3">
                        <div class="accordion mt-2" id="accordionRightIcon">
                            <div class="card">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                        <a data-toggle="collapse" class="text-default collapsed"
                                            href="#accordion-item-icons-3" aria-expanded="false">
                                            <span><i class="i-Big-Data ul-accordion__font"></i></span>
                                            İştirakçılar <span class="text-danger">*</span>
                                        </a>
                                    </h6>
                                </div>
                                <div id="accordion-item-icons-3" class="collapse" data-parent="#accordionRightIcon">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <h3>Departament</h3>
                                                @foreach ($departments as $department)
                                                    <label class="checkbox checkbox-primary">
                                                        <input type="checkbox" class="report-departments" {{ in_array($department->id, $user_departments) ? 'checked' : '' }} name="w_departments_id[]"
                                                            value="{{ $department->id }}">
                                                        <span><strong>{{ $department->name }}</strong> (Şöbə:
                                                            {{ $department->branches_count }}, İşçi:
                                                            {{ $department->users_count }})</span> <span
                                                            class="checkmark"></span>
                                                    </label>
                                                @endforeach
                                            </div>
                                            <div class="col-8">
                                                <h3>Şöbə</h3>
                                                <div class="row">
                                                    @foreach ($branches as $branch)
                                                        <div class="col-4">
                                                            <label class="checkbox checkbox-primary">
                                                                <input type="checkbox" class="report-branches"
                                                                    data-department-id="{{ !is_null($branch->departments) ? $branch->departments->id : '' }}"
                                                                    {{ in_array($branch->id, $user_branches) ? 'checked' : '' }} name="w_branch_id[]"
                                                                    value="{{ $branch->id }}">
                                                                <span><strong>{{ $branch->name }}</strong> (İşçi:
                                                                    {{ $branch->users_count }})</span>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 mt-2">
                                                <h3>İşçilər</h3>
                                                <div class="row">
                                                    @foreach ($users as $user)
                                                        <div class="col-4 mt-4">
                                                            <label class="checkbox checkbox-primary">
                                                                <input type="checkbox"
                                                                    data-branch-id="{{ !is_null($user->branches) ? $user->branches->id : '' }}"
                                                                    data-department-id="{{ !is_null($user->departments) ? $user->departments->id : '' }}"
                                                                    class="report-users" {{ in_array($user->id, $surveys_users) ? 'checked' : '' }}
                                                                    name="w_user_id[]" value="{{ $user->id }}">
                                                                <span>{{ $user->name }}</span>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- submit button -->
                    <div class="mt-4">
                    <button type="submit" class="btn btn-info btn-lg">
                                <span class="me-2">
                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                </span>
                                Redaktə et
                            </button>
                            <p class="text-danger mt-3" id="err-text"></p>                  
                          </div>
                </form>
            </div>
        </div>


@endsection
@section('js')

<script>

    function submitForm(e) {
        e.preventDefault();

        const card_List = document.querySelectorAll('.custom-card');

        let shouldSubmit = true;
        
        card_List.forEach((element) => {
            
            if (element.className?.includes('editable')) {

                if (element.querySelector('.input_type').value != 'textarea' && element.querySelector('.todo-list').children.length < 2) {
                    // eger error msj yoxdursa
                    if (!element.querySelector('.todo-list')?.nextElementSibling?.className?.includes('error_msg')) {
                        element.querySelector('.todo-list').insertAdjacentHTML('afterend', '<span class="text-danger error_msg">Zehmet olmasa cavab daxil edin*</span>');
                    }
                    shouldSubmit = false;
                    return;
                };
            }

        });
        if (shouldSubmit) {
            e.currentTarget.submit();
        }
    }

    // -----------------------------date time picker-----------------------------
    document.addEventListener('DOMContentLoaded', function () {

        flatpickr("#date-time-picker", {
            allowInput: true,
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
            time_24hr: true,

        });
    });


    // ------------------------------ When chance question type -----------------------------

    function chanceQuestionType(cardId) {
        const questionType = document.getElementById(`input_type-${cardId}`);
        const list = document.getElementById(`todo-list-${cardId}`);
        const todoContent = document.getElementById(`todo-content-${cardId}`);

        if (questionType.value === 'textarea') {
            list.innerHTML = '';
            list?.nextElementSibling?.remove();
            todoContent.classList.add('disabled-div');
            input.value = '';
            input.removeAttribute('required');
        } else {
            todoContent.classList.remove('disabled-div');
        }

    }
    // ------------------------------CRUD Question-----------------------------

    const indexQuestions = []
    document.addEventListener('DOMContentLoaded', function () {
        function setId() {
            let questionsContainer = document.querySelector('.questions-container');
            console.log('setId', questionsContainer, questionsContainer.children.length);
            for (let i = 0; i < questionsContainer.children.length; i++) {
                const childId = parseInt((questionsContainer.children[i].id).slice(1));
                indexQuestions.push({ id: childId });
            }
        }
        setId();
    });

    // check removeButton state
    function changeStateOfRemoveButton() {
        
        let questionsContainer = document.querySelector('.questions-container')
        
        if (indexQuestions.length == 1) {

            questionsContainer.querySelector('.position-left').disabled = false;
            questionsContainer.querySelector('.position-left').style.opacity = '0.5';
        } else {

            questionsContainer.querySelectorAll('[disabled]').forEach(element => {
                element.style.opacity = '1'; 
                element.disabled = false;

            });
        }
    }


    // delete
    function removeQuestion(deletedQuestionId) {

        let questionsContainer = document.querySelector('.questions-container')


        questionsContainer.removeChild(document.getElementById(`c${deletedQuestionId}`));

        const index = indexQuestions.findIndex((item) => item.id == deletedQuestionId);
        indexQuestions.splice(index, 1);

        changeStateOfRemoveButton();
    }



    // create
    document.addEventListener('DOMContentLoaded', function () {

        document.getElementById('add-question-btn').addEventListener('click', function () {

            let questionsContainer = document.querySelector('.questions-container')

            let newElement = document.createElement("div");
            newElement.classList.add("col-lg-6", "my-3");

            if (indexQuestions.length == 0) {

                indexQuestions.push({
                    id: 0
                });
                newElement.id = "c0";
            }
            else {

                indexQuestions.push({
                    id: indexQuestions[indexQuestions.length - 1].id + 1
                });
                newElement.id = "c" + indexQuestions[indexQuestions.length - 1].id;

            }


            const lastQuestionId = indexQuestions[indexQuestions.length - 1].id;

            let newQuestion = `           
                <div class="editable row  custom-card  position-relative ">
                    
                        <button type="button"  class="position-left btn btn-danger z-custom-index" onclick="removeQuestion(${lastQuestionId})" >X</button>
                    
                    <div class="col-md-8 form-group mb-3">
                        <div class="select_label ui sub header"><span></span> Sual <span class="text-danger">*</span></div>
                        <input type="text" name="question[]" required id="" class="form-control" placeholder="Sual daxil edin">
                        @if($errors->has('question'))
                            <span class="text-danger">{{ $errors->first('question') }}</span>
                        @endif
                    </div>

                    
                    
                    <div class="col-md-4 form-group mb-3 " >
                        <div class="select_label ui sub header ">Sualın növü <span class="text-danger">*</span></div>
                      <select id="input_type-${lastQuestionId}" required onchange="chanceQuestionType(${lastQuestionId})" style="height: 48px;" name="input_type[]" class="input_type form-control ui fluid search dropdown create_form_dropdown">
                        <option value="checkbox" {{ old('input_type') == 'checkbox' ? 'selected' : '' }}>Çox variantlı</option>
                        <option value="radio" {{ old('input_type') == '2' ? 'selected' : '' }}>Tək variantlı</option>
                        <option value="textarea" {{ old('input_type') == '3' ? 'selected' : '' }}>Mətn</option>
                    </select>

              
                        
                        @if($errors->has('input_type'))
                            <span class="text-danger">{{ $errors->first('input_type') }}</span>
                        @endif
                    </div>

                    <div class="col-md-12 form-group mb-3" id="todo-content-${lastQuestionId}" >
                        <div class="select_label ui sub header ">Cavab və ya cavablar <span class="text-danger">*</span></div>
                        <div class="todo-container" style="width: 100%;">        
                            <div id="todo-header">
                                
                                <input type="text"   id="todo-input-${lastQuestionId}" class="todo-input form-control form-control-left-radius  "   placeholder="Add a new task"  >
                                

                                <button class="add-btn btn-right-radius btn-success" type="button" onclick="addTodo(${lastQuestionId})">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                            <ul id="todo-list-${lastQuestionId}" class="todo-list">
                            </ul>
                            </div>
                            </div>
                            
                            </div>  
                            
                            `;

            newElement.innerHTML = newQuestion

            questionsContainer.appendChild(newElement);

            changeStateOfRemoveButton();

        }
        );

    });

    // --------------------------------todo Form---------------------------------
    function addTodo(cardId) {


        const todoContent = document.getElementById(`todo-content-${cardId}`);
        const list = document.getElementById(`todo-list-${cardId}`);
        const questionType = document.getElementById(`input_type-${cardId}`);
        const input = document.getElementById(`todo-input-${cardId}`);

        const text = input.value.trim();



        if (text === '') return;

        if (questionType.value === 'textarea') {

            todoContent.style.display = 'none';

        }
        else {
            const li = document.createElement('li');
            li.innerHTML = `
                <input type="text" name='answer_value[${cardId}][]' class="form-answer form-control" value="${text}"/>
                <button class="remove" onclick="removeSelf(this)" type="button" >Delete</button>
            `;

            list.appendChild(li);
            input.value = '';

        }

        list?.nextElementSibling?.remove()

    }

    function removeSelf(e) {
        e.parentElement.remove();
    }

    $('#form').on('submit', function (e) {
        if ($('.report-users:checked').length === 0) {
            $('#err-text').html("Ən azı 1 iştirakçı seçin")
            e.preventDefault()
        }
    });

    $('.report-departments').on('change', function () {
        const departmentId = $(this).val();
        const isChecked = $(this).is(':checked');
        $('.report-branches[data-department-id="' + departmentId + '"]').prop('checked', isChecked);
        $('.report-users[data-department-id="' + departmentId + '"]').prop('checked', isChecked);
    });

    $('.report-branches').on('change', function () {
        const branchId = $(this).val();
        const isChecked = $(this).is(':checked');
        $('.report-users[data-branch-id="' + branchId + '"]').prop('checked', isChecked);
    });


</script>
@endsection
