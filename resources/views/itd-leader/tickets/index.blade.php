@extends('itd-leader.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Əməliyyatlar</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="inventories-table" class="display table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>İşçi</th>
                                <th>Bilet nömrəsi</th>
                                <th>Təhkim olunan</th>
                                <th>İnventar</th>
                                <th>Səbəb</th>
                                <th>Qeyd</th>
                                <th>Status</th>
                                <th>Qiymət</th>
                                <th>Aktivlik statusu</th>
                                <th>Tarix</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $item)
                                @php
                                    if($item->status == 0)
                                    {
                                        $text = 'Gözləyir';
                                        $class = 'warning';
                                    }elseif ($item->status == 1) {
                                        $text = 'Həll olundu';
                                        $class = 'success';
                                    }
                                    elseif($item->status == 2) {
                                        $text = 'Problem yoxdur - Əsassız';
                                        $class = 'primary';
                                    }
                                    elseif($item->status == 3) {
                                        $text = 'İnventar sıradan çıxıb';
                                        $class = 'danger';
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><strong>{{ $item->user->name }}</strong> (
                                        {{ !is_null($item->user->departments) ? $item->user->departments->name : ''}}
                                        {{ !is_null($item->user->branches) ? $item->user->branches->name : ''}}
                                        {{ !is_null($item->user->positions) ? $item->user->positions->name : ''}}
                                        )
                                    </td>
                                    <td><strong>{{$item->ticket_number}}</strong></td>
                                    <td>{{ !is_null($item->helpdesk) ? $item->helpdesk->name : 'Təhkim olunmayıb'}}</td>
                                    <td>{{$item->inventories->products->product_name}}</td>
                                    <td>{{$item->ticket_reasons->reason}}</td>
                                    <td>{{$item->note}}</td>
                                    <td>
                                        <button class="btn btn-lg btn-{{ $class }}">{{ $text }}</button>
                                    </td>
                                    <td>
                                        @for($i=0;$i<$item->rate;$i++)
                                            <span>
                                                &#9733;
                                            </span>
                                        @endfor
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-lg btn-{{ $item->ticket_status == 0 ? 'danger' : 'info' }}">
                                            {{ $item->ticket_status == 0 ? 'Bilet açıqdır' : 'Bilet bağlıdır' }}
                                        </button>
                                    </td>
                                    <td>{{\Illuminate\Support\Carbon::parse($item->created_at)->format('d.m.Y')}}</td>

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
        })
    </script>
@endsection
