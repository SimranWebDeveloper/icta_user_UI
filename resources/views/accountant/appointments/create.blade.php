@extends('accountant.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Yeni təhkim olunma</h3>
                        <a href="{{ route('accountant.appointments.index') }}">
                            <button class="btn btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back-2"></i>
                                </span>
                                Əməliyyatlar
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('accountant.appointments.store') }}" class="store-local-report-form">
                        @csrf
                        <div class="form_inputs_container position-relative">
                            <div class="row position-relative form_block" id="formRow">
                                <div class="col-md-4 form-group mb-3">
                                    <div class="select_label ui sub header ">İşçi</div>
                                    <select frequency="true" id="users_select" name="users_id[]" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option value="">İşçi seçin</option>
                                        @forelse($users as $item)
                                            <option value="{{$item->id}}" {{ old('users_id')==$item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                        @empty
                                            <option disabled selected>Məlumat yoxdur</option>
                                        @endforelse
                                    </select>
                                    <span class="text-danger error_message" id="categories_idError"></span>
                                </div>

                                <div class="col-md-4 form-group mb-3">
                                    <div class="select_label ui sub header ">İnventar</div>
                                    <select frequency="true" id="products_select" name="products_id[]" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option value="">İnventar seçin</option>
                                        @forelse($products as $item)
                                            <option value="{{$item->id}}" {{ old('products_id')==$item->id ? 'selected' : '' }}>{{$item->material_type == 'Əsas inventar' ? $item->serial_number : $item->avr_code}} - {{$item->product_name}}</option>
                                        @empty
                                            <option disabled selected>Məlumat yoxdur</option>
                                        @endforelse
                                    </select>
                                    <span class="text-danger error_message" id="categories_idError"></span>
                                </div>

                                <div class="col-md-4 form-group mb-3">
                                    <div class="select_label ui sub header ">İnvertar nömrəsi</div>
                                    <div class="ui input">
                                        <input id="inventory_number" required value="{{old('inventory_number')}}"
                                               name="inventory_number[]" type="text" placeholder="">
                                    </div>
                                    <span class="text-danger error_message" id="inventory_numberError"></span>
                                </div>

                            </div>
                        </div>

                        <div class="lower_buttons_container d-flex align-items-center row">
                            <div class="col-6 ">
                                <button type="button" class="btn btn-success btn-lg" id="addRow">Yenisini əlavə et</button>
                            </div>

                            <div class="col-6 ">
                                <button class="btn btn-primary btn-lg">Təhkim et</button>
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
            if(rowCount > 0){
                const deleteContainer = document.createElement('div');
                deleteContainer.id = `delete_container${rowCount}`;
                deleteContainer.classList.add('delete_block');
                deleteContainer.textContent = 'Bloku sil';
                dynamicForm.appendChild(deleteContainer);
            };


            $('.ui.create_form_dropdown').dropdown({
                clearable: true,
            });

            $('.vendors_select_cl').dropdown({
                allowAdditions: true,
                clearable: true,
            });
        });

        $(document).on('click', '[id^="delete_container"]', function(e) {
            const number = e.target.id.substring(16, e.target.id.length);
            const container = document.querySelector(`#formRow${number}`);
            container.remove();
            rowCount--;
            fields = fields.filter(field => field.num != number)
            console.log(fields)
        });

    </script>
@endsection
