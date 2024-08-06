@extends('itd-leader.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">


            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Otaqlar</h3>
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
