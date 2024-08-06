@extends('warehouseman.layouts.app')
@section('content')

@section('content')
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card mt-4">
            <div class="card-header">
                <h3>Düzəliş</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('warehouseman.products.update', $product->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kateqoriya</label>
                        <select required class="form-select form-control" id="category_id" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->categories_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <div class="select_label ui sub header">Material tipi</div>
                        <select frequency="true" id="material_type" name="material_type" class="form-control ui fluid search dropdown create_form_dropdown material_type_select_cl">
                            <option disabled selected>Material tipini seçin</option>
                            <option value="Azqiymətli/Tezköhnələn" {{ $product->material_type == 'Azqiymətli/Tezköhnələn' ? 'selected' : '' }}>Azqiymətli/Tezköhnələn</option>
                            <option value="Əsas inventar" {{ $product->material_type == 'Əsas inventar' ? 'selected' : '' }}>Əsas inventar</option>
                            <option value="Mal-material" {{ $product->material_type == 'Mal-material' ? 'selected' : '' }}>Mal-material</option>
                        </select>
                        <span class="text-danger error_message" id="activity_statusError"></span>
                    </div>

                    <div class="mb-3">
                        <label for="avr_code" class="form-label">AVR Kodu</label>
                        <input type="text" class="form-control" id="avr_code" name="avr_code" value="{{ $product->avr_code }}">
                    </div>

                    <div class="mb-3">
                        <label for="serial_number" class="form-label">Seria nömrəsi</label>
                        <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{ $product->serial_number }}">
                    </div>

                    <div class="mb-3">
                        <label for="product_name" class="form-label">İnventar adı</label>
                        <input type="text" required class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="product_name" class="form-label">Qiyməti</label>
                        <input type="number" required class="form-control" id="product_name" name="price" value="{{ $product->price }}">
                    </div>

                    <div class="mb-3">
                        <label for="product_name" class="form-label">Inventar dəyəri</label>
                        <input type="number" required class="form-control" id="product_name" name="inventory_cost" value="{{ $product->inventory_cost}}">
                    </div>

                    <div class="mb-3">
                        <label for="product_name" class="form-label">Ölçü</label>
                        <input type="text" required class="form-control" id="product_name" name="size" value="{{ $product->size }}">
                    </div>

                    <div class="form-group mb-3">
                        <div class="select_label ui sub header">Aktivlik statusu</div>
                        <select frequency="true" id="activity_status" name="activity_status" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                            <option disabled selected>Aktivlik statusu seçin</option>
                            <option value="1" {{ $product->activity_status == 1 ? 'selected' : '' }}>Aktiv</option>
                            <option value="0" {{ $product->activity_status == 0 ? 'selected' : '' }}>Deaktiv</option>
                        </select>
                        <span class="text-danger error_message" id="activity_statusError"></span>
                    </div>

                    <div class="form-group mb-3">
                        <div class="select_label ui sub header">Statusu</div>
                        <select frequency="true" id="status" name="status" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                            <option disabled selected>Statusu seçin</option>
                            <option value="Yeni" {{ $product->status == 'Yeni' ? 'selected' : '' }}>Yeni</option>
                            <option value="İşlənmiş" {{ $product->status == 'İşlənmiş' ? 'selected' : '' }}>İşlənmiş</option>
                        </select>
                        <span class="text-danger error_message" id="activity_statusError"></span>
                    </div>

                    <button type="submit" class="btn btn-primary">Yadda saxla</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

