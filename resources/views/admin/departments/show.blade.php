@extends('admin.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    {{ $department->name }}
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($department->branches->count() > 0)
                            <div class="col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Şöbələr</h3>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach($department->branches as $branch)
                                                <li class="list-group-item">
                                                    <a href="{{ route('admin.branches.show', $branch->id) }}">
                                                        {{ $branch->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($department->users->count() > 0)
                            <div class="col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>İşçilər</h3>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach($department->users as $user)
                                                <li class="list-group-item">
                                                    <a href="{{ route('admin.users.show', $user->id) }}">
                                                        {{ $user->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                            @if(isset($department->positions) && $department->positions->count() > 0)
                                <div class="col-md-4 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Vəzifələr</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                @foreach($department->positions as $position)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <a href="{{ route('admin.positions.show', $position->id) }}">
                                                            {{ $position->name }}
                                                        </a>
                                                        @isset($position->users)
                                                            @foreach($position->users as $position_user)
                                                                <code><small>{{ $position_user->name }}</small></code>
                                                            @endforeach
                                                        @endisset
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
