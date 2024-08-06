@extends('employee.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Təhkim olunan inventarlar</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="inventories-table" class="display table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Məhsul</th>
                                <th>İnventar nömrəsi</th>
                                <th>Departament</th>
                                <th>Şöbə</th>
                                <th>İşçi</th>
                                <th>Tarix</th>
                                <th>Əməliyyatlar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inventories as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{$item->products->product_name}}</td>
                                    <td>{{$item->inventory_number}}</td>
                                    <td>
                                        {{ !is_null(\Illuminate\Support\Facades\Auth::user()->departments) ? \Illuminate\Support\Facades\Auth::user()->departments->name : '' }}
                                    </td>
                                    <td>
                                        {{ !is_null(\Illuminate\Support\Facades\Auth::user()->branches) ? \Illuminate\Support\Facades\Auth::user()->branches->name : '' }}
                                    </td>
                                    <td>{{ \Illuminate\Support\Facades\Auth::user()->name }}</td>
                                    <td>{{\Illuminate\Support\Carbon::parse($item->created_at)->format('d.m.Y')}}</td>
                                    <td>
                                        <a href=""
                                           class="text-success mr-2">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
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
            $('#appointments-table').DataTable();
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
