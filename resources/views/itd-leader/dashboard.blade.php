@extends('itd-leader.layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Information Management System
                            <code>
                                (version 1.0.0)
                            </code>
                        </h3>

                        <div>
                            @if(is_array(display_user_types()) && count(display_user_types())>1)
                                @foreach(display_user_types() as $type_key => $types)
                                    @foreach($types as $type)
                                        <a href="{{ $type['route'] }}">
                                            <button class="btn btn-lg btn-secondary text-white font-weight-700">
                                                {{ $type['name'] }} hesabına keçid edin
                                            </button>
                                        </a>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>

                    </div>
                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <code>
                            Hörmətli {{\Illuminate\Support\Facades\Auth::user()->name}}, {{ $general_settings->welcome_message}}
                        </code>
                    </div>
                </div>
            </div>
        </div>
@endsection
