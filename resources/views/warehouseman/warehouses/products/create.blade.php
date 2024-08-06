@extends('warehouseman.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Yeni yerli hesabat</h3>
                        <a href="">
                            <button class="btn btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back-2"></i>
                                </span>
                                Yerli hesabatlar
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.products.store') }}" class="store-local-report-form">
                        @csrf
                        <div class="form_inputs_container position-relative">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <div class="select_label ui sub header ">Təminatçılar</div>
                                            <select frequency="true" id="vendors_select" name="vendors_id"
                                                    class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                                <option value="">Tezliyi seçin və ya daxil edin</option>
                                                @forelse($vendors as $item)
                                                    <option
                                                        value="{{$item->id}}" {{ old('vendors_id')==$item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                                @empty
                                                    <option disabled selected>Məlumat yoxdur</option>
                                                @endforelse

                                            </select>
                                            <span class="text-danger error_message" id="vendors_idError"></span>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <div class="select_label ui sub header ">E-qaimə nömrəsi</div>
                                            <div class="ui input">
                                                <input id="e_invoice_number" required
                                                       value="{{old('e_invoice_number')}}"
                                                       name="e_invoice_number" type="text" placeholder="">
                                            </div>
                                            <span class="text-danger error_message" id="e_invoice_numberError"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row position-relative form_block" id="formRow">
                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Kateqoriya</div>
                                    <select frequency="true" id="categories_select" name="categories_id[]"
                                            class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option value="">Kateqoriya seçin</option>
                                        @forelse($cats as $item)
                                            <option
                                                value="{{$item->id}}" {{ old('categories_id')==$item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                        @empty
                                            <option disabled selected>Məlumat yoxdur</option>
                                        @endforelse

                                    </select>
                                    <span class="text-danger error_message" id="categories_idError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">İnventar nömrəsi</div>
                                    <div class="ui input">
                                        <input id="inventory_number" required value="{{old('inventory_number')}}"
                                               name="inventory_number[]" type="text" placeholder="">
                                    </div>
                                    <span class="text-danger error_message" id="inventory_numberError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">AVR kodu</div>
                                    <div class="ui input">
                                        <input id="avr_code" required value="{{old('avr_code')}}"
                                               name="avr_code[]" type="text" placeholder="">
                                    </div>
                                    <span class="text-danger error_message" id="avr_codeError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Material tipi</div>
                                    <div class="ui input">
                                        <input id="material_type" required value="{{old('material_type')}}"
                                               name="material_type[]" type="text" placeholder="">
                                    </div>
                                    <span class="text-danger error_message" id="material_typeError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">İnventar adı</div>
                                    <div class="ui input">
                                        <input id="product_name" required value="{{old('product_name')}}"
                                               name="product_name[]" type="text" placeholder="">
                                    </div>
                                    <span class="text-danger error_message" id="product_nameError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Qiyməti</div>
                                    <div class="ui input">
                                        <input id="price" required value="{{old('price')}}"
                                               name="price[]" type="number" step=any placeholder="">
                                    </div>
                                    <span class="text-danger error_message" id="priceError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">İnventar dəyəri</div>
                                    <div class="ui input">
                                        <input id="inventory_cost" required value="{{old('inventory_cost')}}"
                                               name="inventory_cost[]" type="number" step=any placeholder="">
                                    </div>
                                    <span class="text-danger error_message" id="inventory_costError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Ölçü</div>
                                    <div class="ui input">
                                        <input id="size" required value="{{old('size')}}"
                                               name="size[]" type="text" placeholder="">
                                    </div>
                                    <span class="text-danger error_message" id="sizeError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Stok</div>
                                    <div class="ui input">
                                        <input id="stock" required value="{{old('stock')}}"
                                               name="stock[]" type="number" placeholder="">
                                    </div>
                                    <span class="text-danger error_message" id="stockError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Aktivlik statusu</div>
                                    <select frequency="true" id="activity_status" name="activity_status[]"
                                            class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option value="">Aktivlik statusu seçin</option>
                                        <option value="1">Aktiv</option>
                                        <option value="0">Deaktiv</option>

                                    </select>
                                    <span class="text-danger error_message" id="activity_statusError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">Statusu</div>
                                    <select frequency="true" id="status" name="status[]"
                                            class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option value="">Statusu seçin</option>

                                        <option value="Yeni">Yeni</option>
                                        <option value="İşlənmiş">İşlənmiş</option>

                                    </select>
                                    <span class="text-danger error_message" id="activity_statusError"></span>
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
                                <button type="button" class="btn btn-success btn-lg" id="addRow">Yenisini əlavə et
                                </button>
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

        $(document).on('click', '[id^="delete_container"]', function (e) {
            const number = e.target.id.substring(16, e.target.id.length);
            const container = document.querySelector(`#formRow${number}`);
            container.remove();
            rowCount--;
            fields = fields.filter(field => field.num != number)
            console.log(fields)
        });

    </script>
@endsection
