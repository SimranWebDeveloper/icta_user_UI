@extends('accountant.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>{{ $whs->name }}</h3>
                        <a href="{{route('accountant.warehouses.index')}}">
                            <button class="btn btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back-2"></i>
                                </span>
                                Anbarlar
                            </button>
                        </a>

                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('accountant.warehouses.update', $whs->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Anbar adı</div>
                                <input type="text" name="name" value="{{$whs->name}}" id="" class="form-control">
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Anbar ünvanı</div>
                                <input type="text" name="address" value="{{$whs->address}}" id="" class="form-control">
                                @if($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Status</div>
                                <select id="status" name="status"
                                        class="form-control ui fluid search dropdown create_form_dropdown">
                                    <option value="1" {{ $whs->status == '1' ?  'selected' : '' }}>Aktiv</option>
                                    <option value="0" {{ $whs->status == '0' ?  'selected' : '' }}>Deaktiv</option>
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
    </div>
@endsection
