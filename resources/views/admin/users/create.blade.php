@extends('admin.layouts.app')
@section('content')

    <div class="row mb-4">
        <div class="col-md-12 mb-4">


            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Yeni işçi</h3>
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
                    <form method="POST" action="{{route('admin.users.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <div class="select_label ui sub header ">Növ</div>
                                <select  required id="main_position_select" name="main_position"
                                         class="form-control ui fluid search dropdown create_form_dropdown frequency_select_cl">
                                    <option value="">Tip seçin</option>
                                    <option value="1">İdarə heyəti</option>
                                    <option value="0">İşçi</option>
                                </select>
                                @if($errors->has('main_position'))
                                    <span class="text-danger">{{ $errors->first('main_position') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row form_inputs">
                            <div class="col-md-4 form-group mb-3" id="department-section">
                                <div class="select_label ui sub header ">Departament</div>
                                <select  id="department_select" name="departments_id"
                                         class="form-control ui fluid search dropdown create_form_dropdown frequency_select_cl">
                                    <option value="">Departament seçin</option>
                                    @forelse($departments as $item)
                                        <option
                                            value="{{$item->id}}" {{ old('departments_id')==$item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                    @empty
                                        <option disabled selected>Məlumat yoxdur</option>
                                    @endforelse

                                </select>
                                @if($errors->has('departments_id'))
                                    <span class="text-danger">{{ $errors->first('departments_id') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3 branch-section" id="branch-section">
                                <div class="select_label ui sub header ">Şöbə</div>
                                <select  id="branch_select" name="branches_id"
                                         class="form-control ui fluid search dropdown create_form_dropdown frequency_select_cl">
                                    <option value="">Şöbə seçin</option>
                                </select>
                                @if($errors->has('branches_id'))
                                    <span class="text-danger">{{ $errors->first('branches_id') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3 position-section" id="position-section">
                                <div class="select_label ui sub header ">Vəzifələr</div>
                                <select  required id="position_select" name="positions_id"
                                         class="form-control ui fluid search dropdown create_form_dropdown frequency_select_cl">
                                    <option value="">Vəzifə seçin</option>
                                </select>
                                @if($errors->has('positions_id'))
                                    <span class="text-danger">{{ $errors->first('positions_id') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Otaq</div>
                                <select  required id="rooms_select" name="rooms_id"
                                         class="form-control ui fluid search dropdown create_form_dropdown frequency_select_cl">
                                    <option value="">Otaq seçin</option>
                                    @forelse($rooms as $item)
                                        <option
                                            value="{{$item->id}}" {{ old('rooms_id')==$item->id ? 'selected' : '' }}>{{$item->name}}</option>
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
                                    <input id="name" required name="name" value="{{old('name')}}"
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
                                    <input id="email" name="email" value="{{old('email')}}"
                                           type="email" placeholder="user@icta.az">
                                    @if($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Doğum tarixi
                                </div>
                                <div class="ui input">
                                    <input id="b_day" name="b_day" value="{{old('b_day')}}"
                                           type="date">
                                    @if($errors->has('b_day'))
                                        <span class="text-danger">{{ $errors->first('b_day') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <div class="select_label ui sub header ">Şifrə
                                </div>
                                <div class="ui input">
                                    <input id="password" min="6" max="50" name="password"
                                           value="{{old('password')}}"
                                           type="password" placeholder="********">
                                    @if($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-12 mt-4">
                                <button class="btn btn-success btn-lg" type="submit">Daxil edin</button>
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
            $('#department-section').hide();
            $('#branch-section').hide();
            $('#position-section').hide();

            $('#main_position_select').on("change", function () {
                if($(this).val() == 1)
                {
                    $.ajax({
                        url:"{{ url('admin/get-positions-by-management-board') }}",
                        type:"POST",
                        data:{
                            "_token":"{{csrf_token()}}",
                        },
                        success:function(response){
                            let position_select = $('#position_select');
                            position_select.empty();
                            $.each(response, function(index, position) {
                                position_select.append($("<option>", {
                                    value: position.id,
                                    text: position.name
                                }));
                            });
                            position_select.attr('disabled', false);
                        }
                    })
                    $('#position-section').fadeIn(500);
                    $('#department-section').hide();
                    $('#branch-section').hide();
                }
                else
                {
                    $('#department-section').fadeIn(500);
                    $('#position-section').hide();
                    $('#branch-section').hide();
                }
            })

            $('#department_select').on('change', function(e){
                const department_id =  e.target.value;
                $.ajax({
                    url:"{{ url('admin/get-branches-by-department') }}",
                    type:"POST",
                    data:{
                        "_token":"{{csrf_token()}}",
                        "department_id": department_id
                    },
                    success:function(response){
                        $('#branch_select').empty();
                        $.each(response, function(index, branch) {
                            $('#branch_select').append($("<option>", {
                                value: branch.id,
                                text: branch.name
                            }));
                        });
                        $('#branch_select').append($("<option>", {
                            value: "NULL",
                            text: 'Yoxdur'
                        }));
                        $('#branch_select').attr('disabled', false);
                        $('#position-section').hide();
                        $('#branch-section').fadeIn();
                    }

                })
            })

            $('#branch_select').on('change', function(e){
                const branch_id =  e.target.value;
                const department_id = $('#department_select').val();
                if(branch_id != "NULL")
                {
                    $.ajax({
                        url:"{{ url('admin/get-positions-by-branch') }}",
                        type:"POST",
                        data:{
                            "_token":"{{csrf_token()}}",
                            "branch_id": branch_id
                        },
                        success:function(response){
                            let position_select = $('#position_select');
                            position_select.empty();
                            $.each(response, function(index, position) {
                                position_select.append($("<option>", {
                                    value: position.id,
                                    text: position.name
                                }));
                            });
                            position_select.attr('disabled', false);
                            $('#position-section').fadeIn(500);

                        }

                    })
                }
                else
                {
                    $.ajax({
                        url:"{{ url('admin/get-positions-by-null-department') }}",
                        type:"POST",
                        data:{
                            "_token":"{{csrf_token()}}",
                            "department_id": department_id,
                            "branch_id": branch_id
                        },
                        success:function(response){
                            let position_select = $('#position_select');
                            position_select.empty();
                            $.each(response, function(index, position) {
                                position_select.append($("<option>", {
                                    value: position.id,
                                    text: position.name
                                }));
                            });
                            position_select.attr('disabled', false);
                            $('#position-section').fadeIn(500);

                        }

                    })
                }
            })
        })
    </script>
@endsection

