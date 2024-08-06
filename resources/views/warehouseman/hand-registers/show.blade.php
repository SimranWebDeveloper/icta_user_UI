@extends('warehouseman.layouts.app')
 <style>
     .invoice-details {
         display: flex;
         flex-wrap: wrap;
     }

     .invoice-detail {
         flex: 1;
         margin-right: 20px;
         margin-bottom: 20px;
     }

     .invoice-detail h3 {
         margin-bottom: 5px;
         font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif
     }
 </style>
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="invoice-details">
                        <div class="invoice-detail">
                            <h3>Əl qaimə nömrəsi :</h3>
                            <p>{{ $register->register_number }}</p>
                        </div>

                        <div class="invoice-detail">
                            <h3>Əsas kateqoriya :</h3>
                            <p>{{ $register->categories->name }}</p>
                        </div>

                        <div class="invoice-detail">
                            <h3>Ümumi məhsul sayı :</h3>
                            <p>{{ $register->products->count() }} ədəd</p>
                        </div>

                        <div class="invoice-detail">
                            <h3>Ümumi məbləğ :</h3>
                            <p>{{ $register->total_amount }} AZN</p>
                        </div>

                        <div class="invoice-detail">
                            <h3>ƏDV daxil məbləğ :</h3>
                            <p>{{ $register->edv_total_amount }} AZN</p>
                        </div>

                        <div class="invoice-detail">
                            <h3>Alış tarixi :</h3>
                            <p>{{ \Carbon\Carbon::parse($register->register_date)->format('d.m.Y') }}</p>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="user-inventories-table" class="display table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Seria nömrəsi</th>
                                <th>AVR kodu</th>
                                <th>İnventar adı</th>
                                <th>Kateqoriya</th>
                                <th>Material tipi</th>
                                <th>Ölçü</th>
                                <th>Aktivlik statusu</th>
                                <th>Alış statusu</th>
                                <th>Alış tarixi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($register->products as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->serial_number }}</td>
                                    <td>{{ $item->avr_code }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->categories->name }}</td>
                                    <td>{{ $item->material_type }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>
                                        <button class="btn btn-{{$item->activity_status == 1 ? 'success' : 'danger'}}">
                                            {{ $item->activity_status == 1 ? 'Aktiv' : 'Deaktiv' }}
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary">
                                            {{ $item->status }}
                                        </button>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        İnventar təhkim olunmayıb
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#user-appointments-table').DataTable();
        })
    </script>
@endsection
