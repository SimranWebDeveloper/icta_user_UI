@extends('itd-leader.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">


            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Vəzifələr</h3>
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
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($positions as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @isset($item->departments)
                                            <span style="color: {{$item->departments->trashed() ? 'red' : 'black'}};">
                                                {{$item->departments->name}}
                                            </span>
                                            @else
                                            <p>İdarə heyəti</p>
                                        @endif
                                    </td>
                                    <td>
                                        @isset($item->branches)
                                            <span style="color: {{$item->branches->trashed() ? 'red' : 'black'}};">
                                                {{$item->branches->name}}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <strong class="{{ $item->report_receiver == 1 ? 'text-success' : 'text-danger' }}">
                                            {{ $item->report_receiver == 1 ? 'Hesabat qəbul edə bilər' : 'Hesabat qəbul edə bilməz' }}
                                        </strong>
                                    </td>
                                    <td>
                                        {{ $item->count }}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-{{$item->status == 1 ? 'success' : 'danger'}}">
                                            {{$item->status == 1 ? 'Aktiv' : 'Deaktiv'}}
                                        </button>
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
