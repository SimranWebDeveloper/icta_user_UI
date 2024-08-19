@extends('hr.layouts.app')
@section('content')
<style>
    .dataTables_wrapper .dataTables_filter {
        float: right;
    }
</style>
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="m-0">Anketlər</h3>
                    <a href="{{route('hr.surveys.create')}}">
                        <button class="btn btn-success">
                            <span class="me-2">
                                <i class="nav-icon i-Add-File"></i>
                            </span>
                            Yeni anket
                        </button>
                    </a>
                </div>
            </div>
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table id="surveys-table" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Ad</th>
                                <th>Sual sayı</th>
                                <th>İştirak edənlərin sayı</th>
                                <th>Bitmə tarixi</th>
                                <th>Status</th>
                                <th>Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = $surveys->count();
                            @endphp
                            @foreach ($surveys as $survey)
                                <tr>
                                    <td>{{ $index-- }}</td>
                                    <td>{{ $survey->name }}</td>
                                    <td>{{ $survey->surveys_questions->count() }}</td>
                                    <td>{{ $survey->users->count() }}</td>
                                    <td>{{ $survey->expired_at}}</td>
                                    <td>
                                        @if ($survey->status == 0)
                                            <button class="btn btn-sm btn-danger">
                                                Deaktiv
                                            </button>
                                        @elseif ($survey->status == 1)
                                            <button class="btn btn-sm btn-success">
                                                Aktiv
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('hr.surveys.edit', $survey->id) }}" class="text-success mr-2">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                        </a>
                                        <a href="{{ route('hr.surveys.show', $survey->id) }}" class="text-info mr-2">
                                            <i class="nav-icon i-Eye font-weight-bold"></i>
                                        </a>
                                        <a href="#" class="text-danger mr-2 delete-item" data-id="{{$survey->id}}">
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
        $('#surveys-table').DataTable({
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
        const storeSuccess = "{{ session('success') }}";
        const SuccessAlert = Swal.fire({
            title: "Uğurlu!",
            text: storeSuccess,
            icon: "success"
        })
        SuccessAlert.fire();

        @php session() -> forget('success') @endphp
    @endif


    @if (session('error'))
        const storeError = "{{ session('error') }}";
        const ErrorAlert = Swal.fire({
            title: "Xəta!",
            text: storeError,
            icon: "error"
        })
        ErrorAlert.fire();

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
                confirmButtonText: "Sil",
                cancelButtonText: "Ləğv et"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/hr/surveys/" + item_id,
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
    })
</script>
@endsection