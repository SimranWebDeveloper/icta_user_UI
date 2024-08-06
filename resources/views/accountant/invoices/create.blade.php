@extends('accountant.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Yeni alış qaiməsi</h3>
                        <a href="{{ route('accountant.invoices.index') }}">
                            <button class="btn btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back-2"></i>
                                </span>
                                Qaimələr
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('accountant.invoices.store') }}" class="store-local-report-form">
                        @csrf
                        <div class="form_inputs_container position-relative">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 form-group mb-3">
                                            <div class="select_label ui sub header ">Seçim edin</div>
                                            <select frequency="true" id="register_or_new" name="register_or_new" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                                <option value="">Seçin</option>
                                                <option value="new">Yeni</option>
                                                <option value="old">Əl qaimələri ilə</option>
                                            </select>
                                            <span class="text-danger error_message" id="vendors_idError"></span>
                                        </div>
                                        <div class="col-md-3 form-group mb-3 " id="vendors-section">
                                            <div class="select_label ui sub header ">Təminatçılar</div>
                                            <select frequency="true" id="vendors_select" name="vendors_id" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                                <option value="">Təminatçı seçin</option>
                                                @forelse($vendors as $item)
                                                    <option value="{{$item->id}}" {{ old('vendors_id')==$item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                                @empty
                                                    <option disabled selected>Məlumat yoxdur</option>
                                                @endforelse

                                            </select>
                                            <span class="text-danger error_message" id="vendors_idError"></span>
                                        </div>

                                        <div class="col-md-3 form-group mb-3 " id="categories-section">
                                            <div class="select_label ui sub header ">Əsas kateqoriya</div>
                                            <select frequency="true" id="categories_id" name="main_categories_id" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                                <option value="">Əsas kategoriya seçin</option>
                                                @forelse($categories as $category)
                                                    <option value="{{$category->id}}" {{ old('categories_id')==$category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                                @empty
                                                    <option disabled selected>Məlumat yoxdur</option>
                                                @endforelse

                                            </select>
                                            <span class="text-danger error_message" id="vendors_idError"></span>
                                        </div>

                                        <div class="col-md-3 form-group mb-3">
                                            <div class="select_label ui sub header ">E-qaimə nömrəsi / Seria nömrəsi</div>
                                            <div class="ui input">
                                                <input id="e_invoice_number" value="{{old('e_invoice_number')}}"
                                                       name="e_invoice_number" type="text" placeholder="E-Qaimə nömrəsi">
                                                <input id="e_invoice_serial_number" value="{{old('e_invoice_number')}}"
                                                       name="e_invoice_serial_number" type="text" placeholder="Seria nömrəsi">
                                            </div>
                                            <span class="text-danger error_message" id="e_invoice_numberError"></span>
                                        </div>

                                            <div class="col-md-3 form-group mb-3">
                                                <div class="select_label ui sub header ">Anbar</div>
                                                <select frequency="true" id="warehouses_id"  name="warehouses_id" class="form-control ui fluid search dropdown create_form_dropdown warehouses_select_cl">
                                                    <option value="">Anbar seçin</option>
                                                    @foreach($whs as $wh)
                                                        <option value="{{ $wh->id }}">{{ $wh->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger error_message" id="subcategories_idError"></span>
                                            </div>

                                        <div class="col-md-3 form-group mb-3">
                                            <div class="select_label ui sub header ">E-qaimə tarixi</div>
                                            <div class="ui input">
                                                <input id="e_invoice_date"
                                                       name="e_invoice_date" type="date">
                                            </div>
                                            <span class="text-danger error_message" id="e_invoice_numberError"></span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row position-relative form_block" id="hand_registers_section">
                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Əl qaiməsi</div>
                                    <select frequency="true" id="hand_registers_id" multiple name="hand_registers_id[]" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option value="">Əl qaimələri seçin</option>
                                        @foreach($registers as $register)
                                            <option value="{{ $register->id }}">{{ $register->register_number }} - {{ $register->total_amount }} AZN  ({{ $register->register_date }})</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error_message" id="subcategories_idError"></span>
                                </div>
                            </div>

                            <div class="row position-relative form_block" id="formRow">
                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Kateqoriya</div>
                                    <select frequency="true" id="subcategories_id" name="subcategories_id[]" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option value="">Alt kateqoriya seçin</option>
                                    </select>
                                    <span class="text-danger error_message" id="subcategories_idError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Material tipi</div>
                                    <select frequency="true" id="material_type" name="material_type[]" class="form-control ui fluid search dropdown create_form_dropdown material_type_select_cl">
                                        <option disabled selected>Material tipini seçin</option>
                                        <option value="Azqiymətli/Tezköhnələn">Azqiymətli/Tezköhnələn</option>
                                        <option value="Əsas inventar">Əsas inventar</option>
                                        <option value="Mal-material">Mal-material</option>

                                    </select>
                                    <span class="text-danger error_message" id="activity_statusError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">İnventar adı</div>
                                    <div class="ui input">
                                        <input id="product_name" value="{{old('product_name')}}"
                                               name="product_name[]" type="text" placeholder="İnventar adını daxil edin">
                                    </div>
                                    <span class="text-danger error_message" id="product_nameError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Qiyməti</div>
                                    <div class="ui input">
                                        <input id="price" value="{{old('price')}}"
                                               name="price[]" type="number" step=any placeholder="Ədəd üçün qiymət">
                                    </div>
                                    <span class="text-danger error_message" id="priceError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">İnventar dəyəri</div>
                                    <div class="ui input">
                                        <input id="inventory_cost" value="{{old('inventory_cost')}}"
                                               name="inventory_cost[]" type="number" step=any placeholder="İnventar dəyəri">
                                    </div>
                                    <span class="text-danger error_message" id="inventory_costError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Ölçü</div>
                                    <div class="ui input">
                                        <input id="size" required value="ədəd"
                                               name="size[]"  type="text" placeholder="">
                                    </div>
                                    <span class="text-danger error_message" id="sizeError"></span>
                                </div>

                                <style>
                                    .purchase_count_container{
                                        display: flex;
                                        align-items: flex-end;
                                        width: 100%;
                                        gap: 20px;
                                    }

                                    .purchase_count_container .input_container{
                                        flex: 1 1 75%;
                                    }

                                    .purchase_count_container .main_inventory_btn_cls{
                                        flex: 1 1 25%;
                                        height: 45px;
                                    }

                                    .additional_inputs_container{
                                        border: 1px solid #adaaaa;
                                        padding: 16px 24px;
                                        margin: 22px 15px;
                                        border-radius: 4px;
                                        display: flex;
                                        flex-direction: column;
                                        gap: 12px;
                                        width: 42%;
                                    }

                                    .additional_inputs_container input{
                                        border: 1px solid gray;
                                        padding: 15px 8px;
                                        border-radius: 3px;
                                    }

                                    .additional_inputs_container input:focus-visible{
                                        outline: none;
                                        border-color: gray;
                                    }
                                </style>

                                <div class="col-md-3 form-group mb-3 purchase_count_container">
                                    <div class="input_container">
                                        <div class="select_label ui sub header ">Alış sayı</div>
                                        <div class="ui input">
                                            <input id="purchase_count" value="{{old('purchase_count')}}"
                                                   name="purchase_count[]" type="number" placeholder="Alış sayını daxil edin">
                                        </div>
                                        <span class="text-danger error_message" id="purchase_countError"></span>
                                    </div>

                                    <button type="button" id="main_inventory_number_btn" class="btn btn-primary d-none main_inventory_btn_cls" data-bs-toggle="modal" data-bs-target="">
                                        AVR kod / Seriya nömrəsi
                                    </button>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Aktivlik statusu</div>
                                    <select frequency="true" id="activity_status" name="activity_status[]" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option disabled selected>Aktivlik statusu seçin</option>
                                        <option value="1">Aktiv</option>
                                        <option value="0">Deaktiv</option>

                                    </select>
                                    <span class="text-danger error_message" id="activity_statusError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Statusu</div>
                                    <select frequency="true" id="status" name="status[]" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option disabled selected>Statusu seçin</option>

                                        <option value="Yeni">Yeni</option>
                                        <option value="İşlənmiş">İşlənmiş</option>

                                    </select>
                                    <span class="text-danger error_message" id="activity_statusError"></span>
                                </div>

                                <input type="hidden" id="hidden_input">

                                <div class="additional_inputs_container">

                                </div>
                            </div>
                        </div>



                        <div class="col-md-12 form-group mb-3 mt-2">
                            <label for="device">Əlavə qeyd</label>
                            <textarea class="form-control" rows="6" name="note"
                                      placeholder="Əlavə qeydi daxil edin.."></textarea>
                        </div>

                        <div class="lower_buttons_container d-flex align-items-center row">
                            <div class="col-6 ">
                                <button type="button" class="btn btn-success btn-lg" id="addRow">Yenisini əlavə et</button>
                            </div>

                            <div class="col-6 ">
                                <button class="btn btn-primary btn-lg">Qaiməni təsdiqlə</button>
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
        document.getElementById('material_type').addEventListener('change', function(e) {
            if(e.target.value !== 'Mal-material' && e.target.value !== ''){
                document.getElementById('main_inventory_number_btn').classList.remove('d-none');
            } else {
                document.getElementById('main_inventory_number_btn').classList.add('d-none')
            }

            document.getElementById('hidden_input').value = 'formRow';
            document.getElementById('hidden_input').name = 'unique_row_name[]';
        })

        document.getElementById('main_inventory_number_btn').addEventListener('click', function(e) {
            const serialNumElement = document.querySelectorAll('.serial_num_input');

            if(serialNumElement){
                serialNumElement.forEach(el => {
                    el.remove();
                })
            }

            const count = document.getElementById('purchase_count').value;

            for(let i = 0; i < count; i++){
                const inputContainer = document.createElement('input');
                inputContainer.classList.add('serial_num_input')
                inputContainer.type = 'text';
                inputContainer.name = 'formRow[]';
                document.querySelector('#formRow .additional_inputs_container').appendChild(inputContainer);
            }
        })



        $(document).on('click', '[id^="addRow"]', function(e) {
            document.querySelectorAll('.material_type_select_cl select').forEach(select => {
                select.addEventListener('change', function (e){
                    const whichRow = e.target.id.substring(13, e.target.id.length)
                    if(e.target.value !== 'Mal-material' && e.target.value !== ''){
                        document.getElementById(`main_inventory_number_btn${whichRow}`).classList.remove('d-none');
                    } else {
                        document.getElementById(`main_inventory_number_btn${whichRow}`).classList.add('d-none')

                        if(document.querySelectorAll(`.serial_num_input${whichRow}`)){
                            document.querySelectorAll(`.serial_num_input${whichRow}`).forEach(el => {
                                el.remove()
                            })
                        }
                    }

                    document.getElementById(`hidden_input${whichRow}`).value = `${whichRow}`;
                    document.getElementById(`hidden_input${whichRow}`).name = 'unique_row_name[]';
                })
            })

            document.querySelectorAll('.main_inventory_btn_cls').forEach(button => {
                console.log(button)
                button.addEventListener('click', function (e) {
                    console.log(1)
                    const whichRow = e.target.id.substring(25, e.target.id.length)

                    const serialNumElement = document.querySelectorAll(`.serial_num_input${whichRow}`);

                    if(serialNumElement){
                        serialNumElement.forEach(el => {
                            el.remove();
                        })
                    }

                    const count = document.getElementById(`purchase_count${whichRow}`).value;

                    for(let i = 0; i < count; i++){
                        const inputContainer = document.createElement('input');
                        inputContainer.classList.add(`serial_num_input${whichRow}`, 'serial_input')
                        inputContainer.type = 'text';
                        inputContainer.name = `${whichRow}[]`;
                        document.querySelector(`#formRow${whichRow} .additional_inputs_container`).appendChild(inputContainer)
                        // document.querySelector('#formRow .additional_inputs_container')
                    }
                })
            })
        });

    </script>

    <script>
        function generateRandomString(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            const charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        let rowCount;
        $(document).ready(function () {
            $('#hand_registers_section').hide();
            $('#vendors-section').hide();
            $('#categories-section').hide();
            $('#addRow').hide();
            $('#formRow').hide();
            $('#register_or_new').on("change", function (e) {
                if(e.target.value == "new")
                {
                    $('#hand_registers_section').fadeOut();
                    $('#formRow').fadeIn();
                    $('#addRow').fadeIn();
                    $('#vendors-section').fadeIn();
                    $('#categories-section').fadeIn();

                    addNewBtn.addEventListener('click', function () {

                        rowCount = generateRandomString(20);
                        // rowCount++;
                        const formsContainer = document.querySelector('.form_inputs_container');
                        const defaultForm = document.getElementById('formRow');

                        const clone = defaultForm.cloneNode(true);
                        clone.id += rowCount;
                        const inputs = clone.querySelectorAll('input');
                        const serialInputs = clone.querySelectorAll('.serial_num_input');
                        const selects = clone.querySelectorAll('select');
                        const addSerialButton = clone.querySelector('#main_inventory_number_btn');
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

                        serialInputs.forEach((input) => input.remove());

                        addSerialButton.id += rowCount;
                        addSerialButton.classList.add('d-none')

                        error_messages.forEach(message => message.id ? message.id += rowCount : null);

                        delete_button.forEach(button => button.id ? button.id += rowCount : null);

                        formsContainer.appendChild(clone);

                        const dynamicForm = document.getElementById(`formRow${rowCount}`);
                        if(rowCount.length > 0){
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
                }
                else {
                    $('#hand_registers_section').fadeIn();
                    $('#formRow').fadeOut();
                    $('#addRow').fadeOut();
                    $('#vendors-section').fadeOut();
                    $('#categories-section').fadeOut();
                    $('.delete_block').each(function( e ) {
                        this.click();
                    });

                }
            })
        })



        $(document).on('click', '[id^="delete_container"]', function(e) {
            const number = e.target.id.substring(16, e.target.id.length);
            const container = document.querySelector(`#formRow${number}`);
            container.remove();
            // rowCount--;
            // fields = fields.filter(field => field.num != number)
            // console.log(fields)
        });

        $('#categories_id').on("change", function (e) {
            const main_categories_id = e.target.value;
            $.ajax({
                url:"{{ url('accountant/get-subcategories-by-main-category') }}",
                type:"POST",
                data:{
                    "_token":"{{csrf_token()}}",
                    "categories_id":main_categories_id
                },
                success:function(response){
                    let subcategory = $('#subcategories_id');
                    subcategory.empty();
                    $.each(response, function(index, category) {
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
