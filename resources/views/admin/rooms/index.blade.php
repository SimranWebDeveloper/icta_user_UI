@extends('admin.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">


            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Otaqlar</h3>
                        <a href="{{route('admin.rooms.create')}}">
                            <button class="btn btn-success">
                                <span class="me-2">
                                    <i class="nav-icon i-Add-File"></i>
                                </span>
                                Yeni otaq
                            </button>
                        </a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="rooms-table" class="display table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Otaq</th>
                                <th>Status</th>
                                <th>Əməliyyatlar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rooms as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-{{$item->status == 1 ? 'success' : 'danger'}}">
                                            {{$item->status == 1 ? 'Aktiv' : 'Deaktiv'}}
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.rooms.edit', $item->id ) }}"
                                           class="text-success mr-2">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                        </a>

                                        <a href="{{ route('admin.rooms.show', $item->id ) }}"
                                           class="text-info mr-2">
                                            <i class="nav-icon i-Eye font-weight-bold"></i>
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
            $('#rooms-table').DataTable({ "paging": false });
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


        $(document).ready(function(){
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
                            url: "/admin/rooms/"+item_id,
                            type: "DELETE",
                            data: {
                                "_token":"{{csrf_token()}}"
                            },
                            success:function (response) {
                                Swal.fire(response.message).then((result) => {
                                    if(result.isConfirmed){
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
