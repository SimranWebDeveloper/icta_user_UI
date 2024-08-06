@extends('hr.layouts.app')
@section('content')
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="m-0">İclas və tədbir</h3>
                    <a href="{{ route('hr.meetings.create') }}">
                        <button class="btn btn-success">
                            <span class="me-2">
                                <i class="nav-icon i-Add-File"></i>
                            </span>
                            Yeni iclas və ya tədbir
                        </button>
                    </a>
                </div>
            </div>
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table id="meetings-table" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Mövzu</th>
                                <th>Başlama tarixi</th>
                                <th>Müddət (dəq)</th>
                                <th>Otaq</th>
                                <th>Növ</th>
                                <th>Status</th>
                                
                                <th>Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = $meetings->count()
                            @endphp
                            @foreach ($meetings as $meeting)
                                <tr>
                                    <td>{{ $index-- }}</td>
                                    <td>{{ $meeting->subject }}</td>
                                    <td>{{ $meeting->start_date_time }}</td>
                                    <td>{{ $meeting->duration }}</td>
                                    <td>{{ $meeting->rooms->name }}</td>
                                    <td>
                                        @if ($meeting->type == 0)
                                            İclas
                                        @elseif ($meeting->type == 1)
                                            Tədbir
                                        @else
                                            Rezerv
                                        @endif
                                    </td>

                                    <td>
                                        @if ($meeting->status == 0)
                                            <button class="btn btn-sm btn-danger">
                                                Deaktiv
                                            </button>
                                        @elseif ($meeting->status == 1)
                                            <button class="btn btn-sm btn-success">
                                                Aktiv
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-warning text-white">
                                                Gözləmə
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('hr.meetings.edit', $meeting->id) }}" class="text-success mr-2">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                        </a>

                                        <a href="{{ route('hr.meetings.show', $meeting->id) }}" class="text-info mr-2">
                                            <i class="nav-icon i-Eye font-weight-bold"></i>
                                        </a>

                                        <a href="#" class="text-danger mr-2 delete-item" data-id="{{ $meeting->id }}">
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
        $('#meetings-table').DataTable({
            "paging": false,
            "language": {
                "search": "Axtar:",
                "info": "Göstərilir _START_ - _END_ arası _TOTAL_ yazı",
                "infoEmpty": "Göstəriləcək yazı yoxdur",
                "infoFiltered": "(_MAX_ yazı arasından filtrləndi)",
                "emptyTable": "Cədvəldə hər hansı bir məlumat mövcud deyil",
                "lengthMenu": "Göstər _MENU_ yazı",
                "zeroRecords": "Uyğun nəticə tapılmadı",
                "paginate": {
                    "first": "İlk",
                    "last": "Son",
                    "next": "Növbəti",
                    "previous": "Əvvəlki"
                }
            }
        });
    })

    @if (session('success'))
        Swal.fire({
            title: "Uğurlu!",
            text: "{{ session('success') }}",
            icon: "success"
        });
        @php session() -> forget('success') @endphp
    @endif

    @if (session('error'))
        Swal.fire({
            title: "Xəta!",
            text: "{{ session('error') }}",
            icon: "error"
        });
        @php session() -> forget('error') @endphp
    @endif

    $(document).ready(function () {
        $('.delete-item').on("click", function () {
            const item_id = $(this).data('id');
            Swal.fire({
                title: "Silmək istədiyinizdən əminsiniz?",
                text: "Qeyd edək ki, silmək istədiyiniz elemendə bağlı olan bütün məlumatlar silinəcək!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sil!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/hr/meetings/" + item_id,
                        type: "DELETE",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            Swal.fire(response.message).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                    });
                }
            });
        });
    });
</script>
@endsection