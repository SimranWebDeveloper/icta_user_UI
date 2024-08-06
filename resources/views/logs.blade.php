@extends('layouts.app')
@section('content')
    <div class="col-lg-12 col-md-12 mb-4">
        <!-- order -->
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="text-primary">Loqlar</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="local-broadcasts-table" class="display table table-striped" style="width:100%">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Tip</th>
                            <th>Açıqlama</th>
                            <th>Tarix</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $log)
                            @php
                                $color = '';
                                if(in_array($log->type, ["Sistemə giriş", "Hesabat", "Yeni məlumat", "Yeni istifadəçi"])) {
                                    $color = 'success';
                                } elseif(in_array($log->type, ["Hesabatda düzəliş", "Məlumatda düzəliş", "Məhdudiyyətin aradan qaldırılması"])) {
                                    $color = 'info';
                                } else {
                                    $color = 'danger';
                                }
                            @endphp
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>
                                    <span class="alert alert-card alert-{{ $color }} w-100 d-flex justify-content-between align-items-center">
                                        {{ $log->type }}
                                        <i class="nav-icon i-Danger-2 text-{{ $color }}"></i>
                                    </span>
                                </td>
                                <td>
                                    <div class="alert alert-card alert-{{ $color }}">
                                        <strong>{{ $log->content }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <strong>{{ \Carbon\Carbon::parse($log->created_at)->format('d.m.Y (H:i)') }}</strong>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
