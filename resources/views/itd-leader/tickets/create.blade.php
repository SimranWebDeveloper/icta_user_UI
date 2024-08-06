@extends('itd-leader.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Yeni texniki dəstək bileti</h3>
                        <a href="{{ route('itd-leader.tickets.index') }}">
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
                    <form method="POST" action="{{ route('itd-leader.tickets.store') }}" class="store-local-report-form">
                        @csrf
                        <div class="form_inputs_container position-relative">
                            <div class="row position-relative form_block" id="formRow">

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">İşçi</div>
                                    <select frequency="true" id="user_select" name="user_id" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option value="">İşçi seçin</option>
                                        @forelse($users as $user)
                                            <option value="{{$user->id}}" {{ old('users_id')==$user->id ? 'selected' : '' }}>{{$user->name}}</option>
                                        @empty
                                            <option disabled selected>Məlumat yoxdur</option>
                                        @endforelse
                                    </select>
                                    <span class="text-danger error_message" id="categories_idError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3">
                                    <div class="select_label ui sub header ">İşçi</div>
                                    <select frequency="true" id="support_select" name="helpdesk_id" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option value="">Kimə təhkim olunsun</option>
                                        @forelse($support as $user)
                                            <option value="{{$user->id}}" {{ old('helpdesk_id')==$user->id ? 'selected' : '' }}>{{$user->name}}</option>
                                        @empty
                                            <option disabled selected>Məlumat yoxdur</option>
                                        @endforelse
                                    </select>
                                    <span class="text-danger error_message" id="categories_idError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3" id="inventory_section">
                                    <div class="select_label ui sub header ">İnventar</div>
                                    <select frequency="true" id="inventories_select" name="inventories_id" class="form-control ui fluid search dropdown create_form_dropdown vendors_select_cl">
                                        <option value="">İnventar seçin</option>
                                    </select>
                                    <span class="text-danger error_message" id="inventory_selectError"></span>
                                </div>

                                <div class="col-md-3 form-group mb-3" id="reason_section">
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

                                <div class="col-md-12 form-group mb-3" id="note_section">
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

@section('js')
    <script>
        $(document).ready(function () {
            $('#inventory_section').hide();
            $('#reason_section').hide();
            $('#note_section').hide();

            $('#user_select').on("change", function (e) {
                    const user_id = e.target.value;
                    $.ajax({
                        url:"{{ url('get-appointments-by-user') }}",
                        type:"POST",
                        data:{
                            "_token":"{{csrf_token()}}",
                            "user_id": user_id
                        },
                        success:function(response){
                            let inventories_section = $('#inventories_select');
                            inventories_section.empty();
                            $.each(response, function(index, inventory) {
                                inventories_section.append($("<option>", {
                                    value: inventory.id,
                                    text: inventory.products.product_name
                                }));
                            });
                            inventories_section.attr('disabled', false);
                        }
                    })
                    $('#inventory_section').fadeIn(500);
                    $('#reason_section').fadeIn(500);
                    $('#note_section').fadeIn(500);
            })
        })
    </script>
@endsection

