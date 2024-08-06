@extends('support.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="row">
                @foreach($users as $user)
                    <div class="col-md-2">
                        <div class="card" style="">
                            <img class="card-img-top" src="{{ asset('assets/images/avatars/user.jpg') }}"
                                 alt="Card image cap" style="">
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ $user->name }}</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>Departament</td>
                                        <td><strong>{{ $user->departments ? $user->departments->name : '' }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Şöbə</td>
                                        <td><strong>{{ $user->branches ? $user->branches->name : '' }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Vəzifə</td>
                                        <td><strong>{{ $user->role ?? '' }}</strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <div class="d-flex justify-content-between align-items-center"
                                                 style="gap: 12px">
                                                <a href="{{ route('support.support-users.show', $user->id) }}">
                                                    <button class="btn btn-info w-100">
                                                    <span>
                                                        <i class="nav-icon i-Eye"></i>
                                                    </span>
                                                        Ətraflı
                                                    </button>
                                                </a>
                                                @if(\Illuminate\Support\Facades\Auth::user()->id != $user->id)
                                                    <button class="btn btn-danger w-100">
                                                    <span>
                                                        <i class="nav-icon i-File-Trash"></i>
                                                    </span>
                                                        Sil
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
