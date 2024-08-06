@extends('accountant.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-7 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>{{ $whs->name }} tərkibində olan inventarlar</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="products-table" class="display table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Unikal kod</th>
                                <th>Alış sayı</th>
                                <th>İstifadədə olan</th>
                                <th>Qalıq</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($whs->stocks as $item)
                                    <tr data-product-code="{{ $item->product_unical_code }}">
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->product_unical_code }}</td>
                                        <td>{{ $item->purchase_count }}</td>
                                        <td>{{ $item->purchase_count - $item->stock_count }}</td>
                                        <td>{{ $item->stock_count }}</td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-md-5 productDetails-div">

        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            const table = $('#products-table').DataTable();

            $('#products-table').on('click', 'tr', function() {
                const productCode = $(this).data('product-code');
                $.ajax({
                    url:"{{ route('accountant.product-details') }}",
                    method:"POST",
                    data:{
                        "_token":"{{ csrf_token() }}",
                        "productCode":productCode
                    },
                    success:function (response) {
                        console.log(response);
                        $('.productDetails-div').html();
                        $('.productDetails-div').html(response);
                    }
                })
            });

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
