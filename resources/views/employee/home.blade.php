@extends('employee.layouts.app')
<style>
    @keyframes norm {
        0% {
            color: blue;
        }

        50% {
            color: white;
        }

        100% {
            color: blue;
        }
    }

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
        animation: norm 2s infinite;
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

    #meeting {
        transition: .4s;
    }

    #meeting:hover {
        scale: 1.05;
    }

    .carousel-inner img {
        width: 100%;
        height: 365px;
        object-fit: cover;
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
@section('js')
<!-- <script>
    $(document).ready(function () {
        $('#loginButton').on('click', function () {
            Swal.fire({
                title: 'Login Form',
                html:
                    '<form id="loginForm">' +
                    '<div class="form-group">' +
                    '<label for="email">Email address</label>' +
                    '<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="password">Password</label>' +
                    '<input type="password" class="form-control" id="password" name="password" placeholder="Password">' +
                    '</div>' +
                    '<button type="submit" class="btn btn-primary">Submit</button>' +
                    '</form>',
                showConfirmButton: false,
                didOpen: () => {
                    $('#loginForm').on('submit', function (e) {
                        e.preventDefault();
                        const email = $('#email').val();
                        const password = $('#password').val();
                        if (!email || !password) {
                            Swal.showValidationMessage('Please enter both email and password');
                        } else {
                            // Perform login action here
                            Swal.fire({
                                icon: 'success',
                                title: 'Logged in successfully!',
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
        });
    });
</script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection