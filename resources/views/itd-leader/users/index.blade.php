@extends('itd-leader.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>İşçi heyəti</h3>

                        <a href="{{route('itd-leader.users.create')}}">
                            <button class="btn btn-success">
                                <span class="me-2">
                                    <i class="nav-icon i-Add-File"></i>
                                </span>
                                Yeni işçi
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="users-table" class="display table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Ad soyad</th>
                                <th>Departament</th>
                                <th>Şöbə</th>
                                <th>Otaq</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        @isset($item->departments)
                                        <span style="color: {{$item->departments->trashed() ? 'red' : 'black'}};">
                                            {{$item->departments->name}}
                                        </span>
                                        @else
                                        <p>İdarə heyəti</p>
                                    @endif
                                    </td>
                                    <td>@isset($item->branches)
                                        <span style="color: {{$item->branches->trashed() ? 'red' : 'black'}};">
                                            {{$item->branches->name}}
                                        </span>
                                        @endif </td>
                                    <td>@isset($item->positions)
                                        <span style="color: {{$item->positions->trashed() ? 'red' : 'black'}};">
                                            {{$item->positions->name}}
                                        </span>
                                        @endif </td>
                                    <td>{{$item->email}}</td>

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
