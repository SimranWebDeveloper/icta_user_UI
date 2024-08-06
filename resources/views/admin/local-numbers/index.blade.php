@extends('admin.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">

           <div class="card">
               <div class="card-header">
                   <div class="d-flex justify-content-between align-items-center">
                       <h3>Daxili nömrələr</h3>

                       <a href="{{route('admin.local-numbers.create')}}">
                           <button class="btn btn-success">
                                <span class="me-2">
                                    <i class="nav-icon i-Add-File"></i>
                                </span>
                               Yeni daxili nömrə
                           </button>
                       </a>
                   </div>
               </div>
               <div class="card-body">
                   <div class="table-responsive">
                       <table id="branches-table" class="display table table-striped" style="width:100%">
                           <thead>
                           <tr>
                               <th>№</th>
                               <th>Nömrə</th>
                               <th>Departament</th>
                               <th>Şöbə</th>
                               <th>Otaq</th>
                               <th>Vəzifə</th>
                               <th>İşçi</th>
                               <th>Status</th>
                               <th>Əməliyyatlar</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($numbers as $item)
                               <tr>
                                   <td>{{ $item->id }}</td>
                                   <td>
                                       <button class="btn btn-primary btn-lg">
                                           <span>
                                               <i class="nav-icon i-Telephone"></i>
                                           </span>
                                           <strong>{{$item->number}}</strong>
                                       </button>
                                   </td>
                                   <td>{{!is_null($item->departments) ? $item->departments->name : '------'}}</td>
                                   <td>{{!is_null($item->branches) ? $item->branches->name : '------'}}</td>
                                   <td>{{!is_null($item->rooms) ? $item->rooms->name : '------'}}</td>
                                   <td>{{!is_null($item->users) ? $item->users->positions->name : '------'}}</td>
                                   <td>{{!is_null($item->users) ? $item->users->name : '------'}}</td>
                                   <td>
                                       <button class="btn btn-sm btn-{{$item->status == 1 ? 'success' : 'danger'}}">
                                           {{$item->status == 1 ? 'Aktiv' : 'Deaktiv'}}
                                       </button>
                                   </td>
                                   <td>
                                       <a href="{{ route('admin.local-numbers.edit', $item->id ) }}"
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
            $('#branches-table').DataTable();
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
