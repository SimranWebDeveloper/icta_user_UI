@extends('hr.layouts.app')
@section('content')

<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="m-0">Elanlar</h3>
                    <a href="{{route('hr.announcements.create')}}">

                        <button class="btn btn-success">
                            <span class="me-2">
                                <i class="nav-icon i-Add-File"></i>
                            </span>
                            Yeni Elan
                        </button>
                    </a>
                </div>

            </div>
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table id="announcement-table" class="display table table-striped " style="width:100%">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Başlıq</th>
                                <th>Başlama Tarixi</th>
                                <th>Bitmə Tarix</th>
                                <th>Status</th>
                                <th>Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = $announcements->count();
                            @endphp
                            @foreach($announcements as $announcement)
                                <tr>
                                    <td>{{ $index-- }}</td>
                                    <td>{{ $announcement->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($announcement->start_date)->format('d.m.Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($announcement->end_date)->format('d.m.Y') }}</td>
                                    <td>
                                        @if($announcement->status == 1)
                                            <button class="btn btn-sm btn-success text-white">Aktiv</button>
                                        @elseif($announcement->status == 0)
                                            <button class="btn btn-sm btn-danger text-white">Deaktiv</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('hr.announcements.edit', $announcement->id) }}"
                                            class="text-success mr-2">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                        </a>

                                        <a href="{{ route('hr.announcements.show', $announcement->id) }}"
                                            class="text-info mr-2">
                                            <i class="nav-icon i-Eye font-weight-bold"></i>
                                        </a>

                                        <a href="#" class="text-danger mr-2 delete-item" data-id="{{ $announcement->id }}">
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
        $('#announcement-table').DataTable({
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

        $('.delete-item').on("click", function () {
            const item_id = $(this).data('id');
            Swal.fire({
                title: "Silmək istədiyinizdən əminsiniz?",
                text: "Qeyd edək ki, silmək istədiyiniz elemendə bağlı olan bütün məlumatlar silinəcək!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sil",
                cancelButtonText: "Ləğv et"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/hr/announcements/" + item_id,
                        type: "DELETE",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: "Uğurlu!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    location.href = response.route;
                                });
                            } else {
                                Swal.fire({
                                    title: "Xəta!",
                                    text: response.message,
                                    icon: "error"
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                title: "Xəta!",
                                text: "Elan silinərkən bir xəta baş verdi.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endsection