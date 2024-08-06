@extends('warehouseman.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Yeni anbar</h3>
                        <a href="{{route('warehouseman.warehouses.index')}}">
                            <button class="btn btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back-2"></i>
                                </span>
                                Otaqlar
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('warehouseman.warehouses.store')}}">
                        @csrf
                        <div class="row">

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Anbar adı</div>
                                <input type="text" name="name" required id="" class="form-control">
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Anbar ünvanı</div>
                                <input type="text" name="address" required id="" class="form-control">
                                @if($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Status</div>
                                <select id="status" name="status"
                                        class="form-control ui fluid search dropdown create_form_dropdown">
                                    <option value="1" {{ old('status') == '1' ?  'selected' : '' }}>Aktiv</option>
                                    <option value="0" {{ old('status') == '0' ?  'selected' : '' }}>Deaktiv</option>
                                </select>

                                @if($errors->has('status'))
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                @endif
                            </div>

                            <div class="col-md-12 mt-4">
                                <button class="btn btn-success btn-lg">Daxil edin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

