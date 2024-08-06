@extends('accountant.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Alış qaimələri</h3>
                        <a href="{{route('accountant.invoices.create')}}">
                            <button class="btn btn-success">
                                <span class="me-2">
                                    <i class="nav-icon i-Add-File"></i>
                                </span>
                                Yeni alış qaiməsi
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="products-table" class="display table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Kategoriya</th>
                                <th>Təminatçı</th>
                                <th>E-qaimə nömrəsi</th>
                                <th>E-qaimə seria nömrəsi</th>
                                <th>Ümumi məbləğ</th>
                                <th>ƏDV daxil məbləğ</th>
                                <th>Əməliyyatlar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->categories->name }}</td>
                                    <td>{{$item->vendors->name}}</td>
                                    <td>{{$item->e_invoice_number}}</td>
                                    <td>{{$item->e_invoice_serial_number}}</td>
                                    <td>{{$item->total_amount}} AZN</td>
                                    <td>{{$item->edv_total_amount}} AZN</td>
                                    <td>
                                        <a href="{{ route('accountant.invoices.show', $item->id ) }}"
                                           class="text-success mr-2">
                                            <i class="nav-icon i-Eye font-weight-bold"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
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
            $('#products-table').DataTable();
        })

        @if (session('success'))
        const storeSuccess = "{{ session('success') }}";
        const SuccessAlert = Swal.fire({
            title: "Uğurlu!",
            text: storeSuccess,
            icon: "success"
        })
        SuccessAlert.fire();

        @php session()->forget('success') @endphp
        @endif


        @if (session('error'))
        const storeError = "{{ session('error') }}";
        const ErrorAlert = Swal.fire({
            title: "Xəta!",
            text: storeError,
            icon: "error"
        })
        ErrorAlert.fire();

        @php session()->forget('error') @endphp
        @endif
    </script>
@endsection
