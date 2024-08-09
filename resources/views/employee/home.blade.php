@extends('employee.layouts.app')
<style>
    /* @keyframes norm {
        0% {
            color: blue;
        }

        50% {
            color: white;
        }

        100% {
            color: blue;
        }
    } */

    @keyframes important {
        0% {
            color: red;
        }

        50% {
            color: white;
        }

        100% {
            color: red;
        }
    }


    @keyframes unread {
        0% {
            background-color: blue;
        }

        50% {
            background-color: white;
        }

        100% {
            background-color: blue;
        }
    }

    .important {
        animation: important 0.5s infinite;
    }

    .normal {
        color: blue;
    }

    .unread {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        animation: unread 2s infinite;
    }

    .scrollable-content {
        height: 400px;
        overflow-y: auto;
    }




</style>

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
                    @if(is_array(display_user_types()) && count(display_user_types()) > 1)
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
                        Hörmətli {{\Illuminate\Support\Facades\Auth::user()->name}}, sistemin təhlükəsizliyi üçün
                        şifrənizi gizli saxlayın
                    </code>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">

    @include('employee.layouts.partials.home-surveys')
    @include('employee.layouts.partials.home-meetings')
    @include('employee.layouts.partials.home-announcements')

</div>




@endsection