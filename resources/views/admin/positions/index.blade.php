@extends('admin.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">


            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Vəzifələr</h3>

                        <a href="{{route('admin.positions.create')}}">
                            <button class="btn btn-success">
                                <span class="me-2">
                                    <i class="nav-icon i-Add-File"></i>
                                </span>
                                Yeni vəzifə
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="positions-table" class="display table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Departament</th>
                                <th>Şöbə</th>
                                <th>Vəzifə</th>
                                <th>Hesabat qəbulu</th>
                                <th>Ştat</th>
                                <th>İşçi</th>
                                <th>Status</th>
                                <th>Əməliyyatlar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($positions as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @isset($item->departments)
                                            <span style="color: {{$item->departments->trashed() ? 'red' : 'black'}};">
                                                <a href="{{ route('admin.departments.show', $item->departments->id) }}">
                                                    {{$item->departments->name}}
                                                </a>
                                            </span>
                                        @else
                                            <p>İdarə heyəti</p>
                                        @endif
                                    </td>
                                    <td>
                                        @isset($item->branches)
                                            <span style="color: {{$item->branches->trashed() ? 'red' : 'black'}};">
                                                <a href="{{ route('admin.branches.show', $item->branches->id) }}">
                                                    {{$item->branches->name}}
                                                </a>
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <code
                                            class="{{ $item->report_receiver == 1 ? 'text-success' : 'text-danger' }}">
                                            {{ $item->report_receiver == 1 ? 'Hesabat qəbul edə bilər' : 'Hesabat qəbul edə bilməz' }}
                                        </code>
                                    </td>
                                    <td>
                                        {{ $item->count }}
                                    </td>
                                    <td>
                                        @forelse($item->users as $item_user)
                                            <a href="{{ route('admin.users.show', $item_user->id) }}">
                                                {{ $item_user->name }}
                                            </a>
                                        @empty
                                            <code>Ştat boşdur</code>
                                        @endforelse
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-{{$item->status == 1 ? 'success' : 'danger'}}">
                                            {{$item->status == 1 ? 'Aktiv' : 'Deaktiv'}}
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.positions.edit', $item->id ) }}"
                                           class="text-success mr-2">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                        </a>

                                        <a href="#"
                                           class="text-danger mr-2 delete-item" data-id="{{$item->id}}">
                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
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
            $('#positions-table').DataTable({ "paging": false });
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

        $(document).ready(function () {
            $('.delete-item').on("click", function () {
                const item_id = $(this).data('id');
                Swal.fire({
                    title: "Silmək istədiyinizdən əminsiniz ?",
                    text: "Qeyd edək ki, silmək istədiyiniz elemendə bağlı olan bütün məlumatlar silinəcək!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sil!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/positions/" + item_id,
                            type: "DELETE",
                            data: {
                                "_token": "{{csrf_token()}}"
                            },
                            success: function (response) {
                                Swal.fire(response.message).then((result) => {
                                    if (result.isConfirmed) {
                                        location.href = response.route;
                                    }
                                });
                            },
                        })
                    }
                })
            })
        })
    </script>
@endsection
