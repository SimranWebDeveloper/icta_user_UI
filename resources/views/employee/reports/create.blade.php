@extends('employee.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Yeni hesabat</h3>
                        <a href="{{ route('employee.reports.index') }}">
                            <button class="btn btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back-2"></i>
                                </span>
                                Hesabatlar
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('employee.reports.store') }}" class="store-local-report-form">
                        @csrf
                        <div class="form_inputs_container position-relative">

                            <div class="row position-relative form_block" id="formRow">


                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Layihə adı</div>
                                    <div class="ui input">
                                        <input id="project_name" value="{{old('project_name')}}"
                                               name="project_name[]" type="text"
                                               placeholder="Layihə adını daxil edin">
                                    </div>
                                    <span class="text-danger error_message" id="project_nameError"></span>
                                </div>

                                <div class="col-md-9 form-group mb-3">
                                    <div class="select_label ui sub header ">Tapşırıq</div>
                                    <div class="ui input">
                                        <input id="subjects" value="{{old('subjects')}}"
                                               name="subjects[]" type="text"
                                               placeholder="Tapşırıq mövzusunu daxil edin">
                                    </div>
                                    <span class="text-danger error_message" id="subjectsError"></span>
                                </div>
                            </div>
                        </div>

                        <div class="lower_buttons_container d-flex align-items-center row">
                            <div class="col-6 ">
                                <button type="button" class="btn btn-success btn-lg" id="addRow">Yenisini əlavə et
                                </button>
                            </div>

                            <div class="col-6 ">
                                <button class="btn btn-primary btn-lg" type="submit">Hesabatı daxil et</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('js')
    <script>

        $(document).ready(function () {

                    let rowCount = 0;

                    addNewBtn.addEventListener('click', function () {
                        rowCount++;
                        const formsContainer = document.querySelector('.form_inputs_container');
                        const defaultForm = document.getElementById('formRow');

                        const clone = defaultForm.cloneNode(true);
                        clone.id += rowCount;
                        const inputs = clone.querySelectorAll('input');
                        const selects = clone.querySelectorAll('select');
                        const error_messages = clone.querySelectorAll('.error_message');
                        const delete_button = clone.querySelectorAll('.delete_block');

                        inputs.forEach((input) => {
                            const $input = $(input);
                            const $textDiv = $input.siblings('div.text');
                            $textDiv.empty();
                            input.value = '';
                            input.id ? input.id += rowCount : null;
                        });

                        selects.forEach((select) => {
                            const $select = $(select);
                            $select.find(":selected").val('');
                            const $textDiv = $select.siblings('div.text');
                            $textDiv.empty();
                            if (select.id) {
                                select.id += rowCount;
                            }
                        });

                        error_messages.forEach(message => message.id ? message.id += rowCount : null);

                        delete_button.forEach(button => button.id ? button.id += rowCount : null);

                        formsContainer.appendChild(clone);

                        const dynamicForm = document.getElementById(`formRow${rowCount}`);
                        if (rowCount > 0) {
                            const deleteContainer = document.createElement('div');
                            deleteContainer.id = `delete_container${rowCount}`;
                            deleteContainer.classList.add('delete_block');
                            deleteContainer.textContent = 'Bloku sil';
                            dynamicForm.appendChild(deleteContainer);
                        }
                        ;


                        $('.ui.create_form_dropdown').dropdown({
                            clearable: true,
                        });

                        $('.vendors_select_cl').dropdown({
                            allowAdditions: true,
                            clearable: true,
                        });
                    });

        })


        $(document).on('click', '[id^="delete_container"]', function (e) {
            const number = e.target.id.substring(16, e.target.id.length);
            const container = document.querySelector(`#formRow${number}`);
            container.remove();
            rowCount--;
            fields = fields.filter(field => field.num != number)
            console.log(fields)
        });

        $('#categories_id').on("change", function (e) {
            const main_categories_id = e.target.value;
            $.ajax({
                url: "{{ url('employee/reports-subcategories-by-main-category') }}",
                type: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    "categories_id": main_categories_id
                },
                success: function (response) {
                    let subcategory = $('#subcategories_id');
                    subcategory.empty();
                    $.each(response, function (index, category) {
                        subcategory.append($("<option>", {
                            value: category.id,
                            text: category.name
                        }));
                    });
                    subcategory.attr('disabled', false);
                }
            })
        })

    </script>
@endsection
