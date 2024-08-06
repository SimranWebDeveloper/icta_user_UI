@extends('admin.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Daxili nömrə - {{ $number->number }}</h3>
                        <a href="{{route('admin.local-numbers.index')}}">
                            <button class="btn btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back-2"></i>
                                </span>
                                Daxili nömrələr
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.local-numbers.update', $number->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-3 form-group mb-3">
                                <div class="select_label ui sub header ">Nəzərdə tutulub </div>
                                <select id="for_who" name="for_who"
                                        class="form-control ui fluid search dropdown create_form_dropdown">
                                    <option disabled selected>Seçim edin</option>
                                    <option value="departments" {{ $number->department_id && !$number->branch_id && !$number->user_id ? 'selected' : '' }}>Departament üçün</option>
                                    <option value="branches" {{ $number->department_id && $number->branch_id && !$number->user_id ? 'selected' : '' }}>Şöbə üçün</option>
                                    <option value="rooms" {{ $number->room_id && !$number->user_id ? 'selected' : '' }}>Otaq üçün</option>
                                    <option value="users" {{ $number->user_id ? 'selected' : '' }}>İşçi üçün</option>
                                </select>
                            </div>

                            <div class="col-md-3 form-group mb-3" id="departments-section">
                                <div class="select_label ui sub header ">Departament </div>
                                <select id="department_id" name="department_id"
                                        class="form-control ui fluid search dropdown create_form_dropdown">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ $number->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('department_id'))
                                    <span class="text-danger">{{ $errors->first('department_id') }}</span>
                                @endif
                            </div>

                            <div class="col-md-3 form-group mb-3" id="branches-section">
                                <div class="select_label ui sub header ">Şöbə </div>
                                <select id="branch_id" name="branch_id"
                                        class="form-control ui fluid search dropdown create_form_dropdown">
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ $number->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('branch_id'))
                                    <span class="text-danger">{{ $errors->first('branch_id') }}</span>
                                @endif
                            </div>

                            <div class="col-md-3 form-group mb-3" id="rooms-section">
                                <div class="select_label ui sub header ">Otaq </div>
                                <select id="room_id" name="room_id"
                                        class="form-control ui fluid search dropdown create_form_dropdown">
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}" {{ $number->room_id == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('room_id'))
                                    <span class="text-danger">{{ $errors->first('room_id') }}</span>
                                @endif
                            </div>

                            <div class="col-md-3 form-group mb-3" id="users-section">
                                <div class="select_label ui sub header ">İşçi </div>
                                <select id="users_id" name="user_id"
                                        class="form-control ui fluid search dropdown create_form_dropdown">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $number->user_id == $user->id ? 'selected' : '' }}> {{ $user->name }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('user_id'))
                                    <span class="text-danger">{{ $errors->first('user_id') }}</span>
                                @endif
                            </div>

                            <div class="col-md-3 form-group mb-3">
                                <div class="select_label ui sub header ">Daxili nömrə</div>
                                <input type="text" name="number" required value="{{$number->number}}" id="" class="form-control">
                                @if($errors->has('number'))
                                    <span class="text-danger">{{ $errors->first('number') }}</span>
                                @endif
                            </div>

                            <div class="col-md-3 form-group mb-3">
                                <div class="select_label ui sub header ">Status</div>
                                <select id="status" name="status"
                                        class="form-control ui fluid search dropdown create_form_dropdown">
                                    <option value="1" {{ $number->status == '1' ?  'selected' : '' }}>Aktiv</option>
                                    <option value="0" {{ $number->status == '0' ?  'selected' : '' }}>Deaktiv</option>
                                </select>

                                @if($errors->has('status'))
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                @endif
                            </div>

                            <div class="col-md-12 mt-4">
                                <button class="btn btn-success btn-lg">Yadda saxlayın</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function () {
            $('#departments-section, #branches-section, #rooms-section, #users-section').hide();

            const department = "{{$number->department_id}}";
            const branch = "{{$number->branch_id}}";
            const room = "{{$number->room_id}}";
            const user = "{{$number->user_id}}";

            if(department && !user && !branch)
            {
                $('#branches-section, #rooms-section, #users-section').hide();
                $('#departments-section').fadeIn(500);
            }
            else if(department && branch && !user)
            {
                $('#departments-section, #rooms-section, #users-section').hide();
                $('#branches-section').fadeIn(500);
            }
            else if(room && !user)
            {
                $('#departments-section, #branches-section, #users-section').hide();
                $('#rooms-section').fadeIn(500);
            }
            else if(user)
            {
                $('#departments-section, #branches-section, #rooms-section').hide();
                $('#users-section').fadeIn(500);
            }


            $('#for_who').on("change", function (e) {
                const val = e.target.value;
                $('#departments-section, #branches-section, #rooms-section, #users-section').hide();
                $('#' + val + '-section').fadeIn(500);
            });
        });
    </script>
@endsection
