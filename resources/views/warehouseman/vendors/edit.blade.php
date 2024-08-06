@extends('warehouseman.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>{{ $vendor->name }}</h3>
                        <a href="{{route('warehouseman.vendors.index')}}">
                            <button class="btn btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back-2"></i>
                                </span>
                                Təminatçılar
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('warehouseman.vendors.update', $vendor->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Təminatçı adı</div>
                                <input type="text" name="name" value="{{$vendor->name}}" required id=""
                                       class="form-control">
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Əlaqədar şəxs</div>
                                <input type="text" name="relevant_person" value="{{$vendor->relevant_person}}" id=""
                                       class="form-control">
                                @if($errors->has('relevant_person'))
                                    <span class="text-danger">{{ $errors->first('relevant_person') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Email</div>
                                <input type="email" name="email" id="" value="{{$vendor->email}}" class="form-control">
                                @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Əlaqə nömrəsi</div>
                                <input type="text" name="phone_number" value="{{$vendor->phone_number}}" id=""
                                       class="form-control">
                                @if($errors->has('phone_number'))
                                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Status</div>
                                <select id="status" name="status"
                                        class="form-control ui fluid search dropdown create_form_dropdown">
                                    <option value="1" {{ $vendor->status == '1' ?  'selected' : '' }}>Aktiv</option>
                                    <option value="0" {{ $vendor->status == '0' ?  'selected' : '' }}>Deaktiv</option>
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
