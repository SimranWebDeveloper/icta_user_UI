@extends('admin.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>{{ $user->name }}</h3>
                        <a href="{{route('admin.users.index')}}">
                            <button class="btn btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back-2"></i>
                                </span>
                                İşçi heyəti
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.users.update', $user->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Departament</div>
                                <select frequency="true" id="frequency_select" name="department" class="form-control ui fluid search dropdown create_form_dropdown frequency_select_cl">
                                    <option value="">Departament seçin</option>
                                    @forelse($departments as $item)
                                        <option value="{{$item->name}}" {{ !is_null($user->departments) && $user->departments_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                    @empty
                                        <option disabled selected>Məlumat yoxdur</option>
                                    @endforelse

                                </select>
                                @if($errors->has('department'))
                                    <span class="text-danger">{{ $errors->first('department') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Şöbə</div>
                                <select frequency="true" id="frequency_select" name="branch" class="form-control ui fluid search dropdown create_form_dropdown frequency_select_cl">
                                    <option value="">Şöbə seçin</option>
                                    @forelse($branches as $item)
                                        <option value="{{$item->name}}" {{ !is_null($user->branches) && $user->branches_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                    @empty
                                        <option disabled selected>Məlumat yoxdur</option>
                                    @endforelse

                                </select>
                                @if($errors->has('branch'))
                                    <span class="text-danger">{{ $errors->first('branch') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Otaq</div>
                                <select frequency="true" id="frequency_select" name="room" class="form-control ui fluid search dropdown create_form_dropdown frequency_select_cl">
                                    <option value="">Otaq seçin</option>
                                    @forelse($rooms as $item)
                                        <option value="{{$item->name}}" {{ !is_null($user->rooms) && $user->rooms_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                    @empty
                                        <option disabled selected>Məlumat yoxdur</option>
                                    @endforelse

                                </select>
                                @if($errors->has('branch'))
                                    <span class="text-danger">{{ $errors->first('branch') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Ad soyad ata adı
                                </div>
                                <div class="ui input">
                                    <input id="test" required name="name" value="{{ $user->name }}"
                                           type="text" placeholder="Ad, soyad, ata adını daxil edin">
                                    @if($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Email
                                </div>
                                <div class="ui input">
                                    <input id="test" required name="email" value="{{ $user->email }}"
                                           type="email" placeholder="user@icta.az">
                                    @if($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Şifrə
                                </div>
                                <div class="ui input">
                                    <input id="test" min="6" max="50" name="password"
                                           type="password" placeholder="********">
                                    @if($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <button class="btn btn-success btn-lg" type="submit">Yadda saxlayın</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
