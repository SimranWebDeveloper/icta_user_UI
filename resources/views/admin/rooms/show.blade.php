@extends('admin.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    {{ $room->name }}
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($room->users->count() > 0)
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>İşçilər</h3>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach($room->users as $user)
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
                        @if($room->local_numbers->count() > 0)
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Daxili nömrələr</h3>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach($room->local_numbers as $number)
                                                <li class="list-group-item">
                                                        {{ $number->name }}
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
