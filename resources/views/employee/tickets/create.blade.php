@extends('employee.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Yeni texniki dəstək bileti</h3>
                        <a href="{{ route('employee.tickets.index') }}">
                            <button class="btn btn-danger">
                                <span class="me-2">
                                    <i class="nav-icon i-Arrow-Back-2"></i>
                                </span>
                                Texniki dəstək biletləri
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('employee.tickets.store') }}" class="store-local-report-form">
                        @csrf
                        <div class="form_inputs_container position-relative">
                            <div class="row position-relative form_block" id="formRow">
                                <div class="col-md-4 form-group mb-3">
                                    <div class="select_label ui sub header ">İnventar</div>
                                    <select frequency="true" id="inventories_select" name="inventories_id" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option value="">İnventar seçin</option>
                                        @forelse($appointments as $item)
                                            <option value="{{$item->id}}" {{ old('inventories_id')==$item->id ? 'selected' : '' }}>{{$item->products->product_name}}</option>
                                        @empty
                                            <option disabled selected>Məlumat yoxdur</option>
                                        @endforelse
                                    </select>
                                    <span class="text-danger error_message" id="categories_idError"></span>
                                </div>

                                <div class="col-md-4 form-group mb-3">
                                    <div class="select_label ui sub header ">Səbəb</div>
                                    <select frequency="true" id="reasons_select" name="ticket_reasons_id" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option value="">Səbəb seçin</option>
                                        @forelse($reasons as $item)
                                            <option value="{{$item->id}}" {{ old('ticket_reasons_id')==$item->id ? 'selected' : '' }}>{{$item->reason}}</option>
                                        @empty
                                            <option disabled selected>Məlumat yoxdur</option>
                                        @endforelse
                                    </select>
                                    <span class="text-danger error_message" id="categories_idError"></span>
                                </div>

                                <div class="col-md-4 form-group mb-3">
                                    <div class="select_label ui sub header ">Əlavə qeyd</div>
                                    <div class="ui input">
                                        <input id="note" required value="{{old('note')}}"
                                               name="note" type="text" placeholder="">
                                    </div>
                                    <span class="text-danger error_message" id="noteError"></span>
                                </div>

                            </div>
                        </div>
                        <button class="btn btn-primary btn-lg" type="submit">Yeni bilet yaradın</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
