@foreach($products as $product)
    <div class="card mt-2">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>{{ $product->product_name }} {{ $product->material_type == 'Əsas inventar' ? '('.$product->serial_number.')' : '('.$product->avr_code.')' }}</h3>
                <strong>
                    {{ !is_null($product->invoices) ? $product->invoices->e_invoice_number.' '.$product->invoices->e_invoice_serial_number : 'Əl qaiməsi ilə alınıb' }}
                    {{ !is_null($product->hand_registers) ? $product->hand_registers->register_number : '' }}
                </strong>
            </div>
        </div>
        <div class="card-body">
            <table class="table tab-bordered table-striped">
                <tr>
                    <td><strong>İnventar adı</strong></td>
                    <td>{{ $product->product_name }}</td>
                </tr>
                <tr>
                    <td><strong>Material tipi</strong></td>
                    <td>{{ $product->material_type }}</td>
                </tr>
                <tr>
                    <td><strong>Kateqoriya</strong></td>
                    <td> {{ $product->categories->name }}</td>
                </tr>

                <tr>
                    <td><strong>Qiyməti / Anbar dəyəri</strong></td>
                    <td> {{ $product->price }} AZN / {{ $product->inventory_cost }} AZN</td>
                </tr>
                <tr>
                    <td><strong>Aktivlik statusu</strong></td>
                    <td>
                        <button
                            class="w-100 btn btn-{{ $product->activity_status == 1 ? 'success' : 'danger' }}">{{ $product->activity_status == 1 ? 'Aktiv' : 'Deaktiv' }}</button>
                    </td>
                </tr>
                <tr>
                    <td><strong>Yenilik statusu</strong></td>
                    <td>
                        <button class="w-100 btn btn-info">{{ $product->status }}</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endforeach
