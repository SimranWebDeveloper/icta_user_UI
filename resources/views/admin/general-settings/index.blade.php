@extends('admin.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Ümumi tənzimləmələr</h3>
                    </div>
                </div>
                <form action="{{ route('admin.update-general-settings') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <!-- WELCOME MESSAGE START  -->
                        <div class="accordion mt-2" id="accordionRightIcon">
                            <div class="card">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                        <a data-toggle="collapse" class="text-default collapsed"
                                           href="#accordion-item-icons-1" aria-expanded="false">
                                            <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                            Sistemə giriş mesajı</a>
                                    </h6>
                                </div>
                                <div id="accordion-item-icons-1" class="collapse"
                                     data-parent="#accordionRightIcon" style="">
                                    <div class="card-body">
                                        <textarea name="welcome_message" class="summernote" id="" cols="30"
                                                  rows="10">{{ !is_null($item->welcome_message) ? $item->welcome_message : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- REPAIR MODE START  -->
                        <div class="accordion mt-2" id="accordionRightIcon">
                            <div class="card">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                        <a data-toggle="collapse" class="text-default collapsed"
                                           href="#accordion-item-icons-2" aria-expanded="false">
                                            <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                            Təmir modu və bildiriş</a>
                                    </h6>
                                </div>
                                <div id="accordion-item-icons-2" class="collapse"
                                     data-parent="#accordionRightIcon" style="">
                                    <div class="card-body">
                                        <label class="checkbox checkbox-warning">
                                            <input type="checkbox"
                                                   name="repair_mode" {{ $item->repair_mode == 1 ? 'checked' : ''}}>
                                            <span>Təmir modu</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <hr>
                                        <textarea name="repair_mode_message" class="summernote" id="" cols="30"
                                                  rows="10">{{ !is_null($item->repair_mode_message) ? $item->repair_mode_message : '' }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- REPORTS MODULE START  -->
                        @php
                            $report_departments = isset(json_decode($item->weekly_report_module_users, true)['departments']) ? json_decode($item->weekly_report_module_users, true)['departments'] : [];
                            $report_branches = isset(json_decode($item->weekly_report_module_users, true)['branches']) ? json_decode($item->weekly_report_module_users, true)['branches'] : [];
                            $report_users = isset(json_decode($item->weekly_report_module_users, true)['users']) ? json_decode($item->weekly_report_module_users, true)['users'] : [];
                        @endphp
                        <div class="accordion mt-2" id="accordionRightIcon">
                            <div class="card">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                        <a data-toggle="collapse" class="text-default collapsed"
                                           href="#accordion-item-icons-3" aria-expanded="false">
                                            <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                            Həftəlik hesabat modulu və istifadəçilər</a>
                                    </h6>
                                </div>
                                <div id="accordion-item-icons-3" class="collapse"
                                     data-parent="#accordionRightIcon" style="">
                                    <div class="card-body">
                                        <label class="checkbox checkbox-warning">
                                            <input type="checkbox"
                                                   name="weekly_report_module" {{ $item->weekly_report_module == 1 ? 'checked' : ''}}>
                                            <span>Həftəlik hesabat modulu</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4">
                                                <h3>Departament</h3>
                                                @foreach ($departments as $department_key => $department)
                                                    <label class="checkbox checkbox-primary">
                                                        <input type="checkbox" class="report-departments" {{ in_array($department->id, $report_departments) ? 'checked' : '' }} id="{{$department_key}}"
                                                               name="w_departments_id[]" value="{{ $department->id }}">
                                                        <span><strong>{{ $department->name}}</strong> (Şöbə: {{ $department->branches_count }}, İşçi: {{ $department->users_count }})</span>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                @endforeach
                                            </div>
                                            <div class="col-8">
                                                <h3>Şöbə</h3>
                                                <div class="row">
                                                    @foreach ($branches as $branch_key => $branch)
                                                        <div class="col-4">
                                                            <label class="checkbox checkbox-primary">
                                                                <input type="checkbox" class="report-branches" {{ in_array($branch->id, $report_branches) ? 'checked' : '' }} id="{{$branch_key}}"
                                                                       name="w_branch_id[]" data-department-id="{{ !is_null($branch->departments) ? $branch->departments->id : '' }}" value="{{ $branch->id }}">
                                                                <span><strong>{{ $branch->name}}</strong> (İşçi: {{ $branch->users_count }})</span>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 mt-2">
                                                <h3>İşçilər</h3>
                                                <div class="row">
                                                    @foreach ($users as $user_key => $user)
                                                        <div class="col-4 mt-4">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="checkbox checkbox-primary">
                                                                        <input type="checkbox" class="report-users" {{ in_array($user->id, $report_users) ? 'checked' : '' }} id="{{$user_key}}"
                                                                               name="w_user_id[]"
                                                                               data-branch-id="{{ !is_null($user->branches) ? $user->branches->id : '' }}"
                                                                               data-department-id="{{ !is_null($user->departments) ? $user->departments->id : '' }}"
                                                                               value="{{$user->id}}">
                                                                        <span>{{ $user->name}}</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="report_receiver_id" class="form-control report_receiver_list">
                                                                        <option selected value="NULL">Seçim edin</option>
                                                                        @foreach($report_receiver_positions as $positions)
                                                                            @foreach($positions->users as $position_user)
                                                                                <option value="{{ $position_user->id }}" data-user-id="{{ $user->id }}" {{ $user->report_receiver_id == $position_user->id ? 'selected' : '' }}>{{ $position_user->positions->name }} - {{ $position_user->name }}</option>
                                                                            @endforeach
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TICKET MODULE START  -->
                        <div class="accordion mt-2" id="accordionRightIcon">
                            <div class="card">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                        <a data-toggle="collapse" class="text-default collapsed"
                                           href="#accordion-item-icons-13" aria-expanded="false">
                                            <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                            Ticket modulu</a>
                                    </h6>
                                </div>
                                <div id="accordion-item-icons-13" class="collapse"
                                     data-parent="#accordionRightIcon" style="">
                                    <div class="card-body">
                                        <label class="checkbox checkbox-warning">
                                            <input type="checkbox"
                                                   name="ticket_module" {{ $item->ticket_module == 1 ? 'checked' : ''}}>
                                            <span>Ticket modulu</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ASSETS REQUEST MODULE START   -->
                        <div class="accordion mt-2" id="AssetsRequestsModule">
                            <div class="card">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                        <a data-toggle="collapse" class="text-default collapsed"
                                           href="#accordion-item-icons-4" aria-expanded="false">
                                            <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                            Mal-material sorğusu modulu</a>
                                    </h6>
                                </div>
                                <div id="accordion-item-icons-4" class="collapse"
                                     data-parent="#AssetsRequestsModule" style="">
                                    <div class="card-body">
                                        <label class="checkbox checkbox-warning">
                                            <input type="checkbox"
                                                   name="assets_requests" {{ $item->assets_requests == 1 ? 'checked' : ''}}>
                                            <span>Mal-material sorğusu modulu </span>
                                            <span class="checkmark"></span>
                                        </label>

                                        <hr>

                                        <div class="row">
                                            <div class="col-12 mt-2">
                                                <h3>Sorğunu qəbul edən səlahiyyətli şəxslər</h3>
                                                <div class="row">
                                                    @foreach ($all_users as $all_user_key => $all_user)
                                                        <div class="col-4 mt-4">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="checkbox checkbox-primary">
                                                                        <input type="checkbox" id="{{$all_user_key}}"
                                                                               name="assets_requests_confirm[{{$all_user_key}}]"
                                                                               value="{{$all_user->id}}" {{ in_array($all_user->id, $assets_requests_users_id) ? 'checked' : ''}}>
                                                                        <span>{{ $all_user->name}}</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="assets_requests_confirm_order[{{$all_user_key}}]" class="form-control">
                                                                        <option selected value="NULL">Seçim edin</option>
                                                                        @for($i=1; $i<=10; $i++)
                                                                                <option value="{{ $i }}" {{ $all_user->assets_requests_id == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PDF EXCEL START  -->
                        <div class="accordion mt-2" id="accordionRightIcon">
                            <div class="card">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                        <a data-toggle="collapse" class="text-default collapsed"
                                           href="#accordion-item-icons-5" aria-expanded="false">
                                            <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                            Təhvil-təslimdə pdf və excel generasiyası</a>
                                    </h6>
                                </div>
                                <div id="accordion-item-icons-5" class="collapse"
                                     data-parent="#accordionRightIcon" style="">
                                    <div class="card-body">
                                        <label class="checkbox checkbox-warning">
                                            <input type="checkbox"
                                                   name="delivery_act_generation" {{ $item->delivery_act_generation == 1 ? 'checked' : ''}}>
                                            <span>Təhvil-təslimdə pdf və excel generasiyası</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <hr>
                                        <textarea name="delivery_act_content" class="summernote" id="" cols="30"
                                                  rows="10">{{ $item->delivery_act_content }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- PDF EXCEL START  -->
                        <div class="accordion mt-2" id="accordionRightIcon">
                            <div class="card">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                        <a data-toggle="collapse" class="text-default collapsed"
                                           href="#accordion-item-icons-6" aria-expanded="false">
                                            <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                            Bir işçidən başqa işçiyə təhvil verilən zaman pdf və excel generasiyası</a>
                                    </h6>
                                </div>
                                <div id="accordion-item-icons-6" class="collapse"
                                     data-parent="#accordionRightIcon" style="">
                                    <div class="card-body">
                                        <label class="checkbox checkbox-warning">
                                            <input type="checkbox"
                                                   name="deliveryto_another_employee_act_generation" {{ $item->deliveryto_another_employee_act_generation == 1 ? 'checked' : ''}}>
                                            <span>Bir işçidən başqa işçiyə təhvil verilən zaman pdf və excel generasiyası</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <hr>
                                        <textarea name="delivery_to_another_employee_act_content" class="summernote"
                                                  id="" cols="30"
                                                  rows="10">{{ !is_null($item->delivery_to_another_employee_act_content) ? $item->delivery_to_another_employee_act_content : '' }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- NOTIFICATIONS MODULE START  -->
                        <div class="accordion mt-2" id="accordionRightIcon">
                            <div class="card">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                        <a data-toggle="collapse" class="text-default collapsed"
                                           href="#accordion-item-icons-7" aria-expanded="false">
                                            <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                            Bildiriş modulu</a>
                                    </h6>
                                </div>
                                <div id="accordion-item-icons-7" class="collapse"
                                     data-parent="#accordionRightIcon" style="">
                                    <div class="card-body">
                                        <label class="checkbox checkbox-warning">
                                            <input type="checkbox"
                                                   name="notification_module" {{ $item->notification_module == 1 ? 'checked' : ''}}>
                                            <span>Bildiriş modulu</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <hr>
                                        <textarea name="notification_content" class="summernote" id="" cols="30"
                                                  rows="10">{{ !is_null($item->notification_content) ? $item->notification_content : '' }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button class="btn btn-success btn-lg mt-2" type="submit">
                            Yadda saxlayın
                        </button>
                    </div>

                </form>

                <!-- TICKET REASONS START  -->
                <div class="card-body">
                    <div class="accordion mt-2" id="accordionRightIcon">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                    <a data-toggle="collapse" class="text-default collapsed"
                                       href="#accordion-item-icons-reason" aria-expanded="false">
                                        <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                        Texniki dəstək səbəbləri</a>
                                </h6>
                            </div>
                            <div id="accordion-item-icons-reason" class="collapse"
                                 data-parent="#accordionRightIcon" style="">
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{ route('admin.store-ticket-reasons') }}" method="POST">
                                                @csrf
                                                <div class="d-flex align-items-center">
                                                    <input type="text" class="form-control mr-2" required
                                                           name="reason" id="">
                                                    <button class="btn btn-lg btn-outline-success" type="submit"
                                                            style="height: 48px;">Yeni
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>№</th>
                                                    <th>Səbəb</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($reasons as $reason)
                                                    <tr>
                                                        <td>{{ $reason->id }}</td>
                                                        <td>{{ $reason->reason }}</td>
                                                        <td>
                                                            <button
                                                                class="btn btn-sm btn-{{$reason->status == 1 ? 'success' : 'danger'}}">
                                                                {{$reason->status == 1 ? 'Aktiv' : 'Deaktiv'}}
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TICKET REASONS END  -->


                <!-- PERMISSIONS START  -->
                <div class="card-body">
                    <div class="accordion mt-2" id="accordionRightIcon">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                    <a data-toggle="collapse" class="text-default collapsed"
                                       href="#accordion-item-permissions" aria-expanded="false">
                                        <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                        Səlahiyyətlər</a>
                                </h6>
                            </div>
                            <div id="accordion-item-permissions" class="collapse"
                                 data-parent="#accordionRightIcon" style="">
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{ route('admin.store-permissions') }}" method="POST">
                                                @csrf
                                                <div class="d-flex align-items-center">
                                                    <input type="text" class="form-control mr-2" required
                                                           name="permission_name"
                                                           placeholder="Səlahiyyət adını daxil edin" id="">
                                                    <button class="btn btn-lg btn-outline-success ms-2" type="submit"
                                                            style="height: 48px;">Yeni
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>№</th>
                                                    <th>Səlahiyyət adı</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($permissions as $permission)
                                                    <tr>
                                                        <td>{{ $permission->id }}</td>
                                                        <td>{{ $permission->name }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- ROLES START  -->
                <div class="card-body">
                    <div class="accordion mt-2" id="accordionRightIcon">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                    <a data-toggle="collapse" class="text-default collapsed"
                                       href="#accordion-item-roles" aria-expanded="false">
                                        <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                        Vəzifələr</a>
                                </h6>
                            </div>
                            <div id="accordion-item-roles" class="collapse"
                                 data-parent="#accordionRightIcon" style="">
                                <div class="card-body">

                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <form action="{{ route('admin.store-roles') }}" method="POST">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="" class="col-sm-2 col-form-label">Vəzifə adı</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="role_name" class="form-control"
                                                               placeholder="Vəzifə adını daxil edin">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-2 col-form-label">Səlahiyyətlər</label>
                                                    <div class="col-sm-10">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label class="checkbox checkbox-success">
                                                                    <input type="checkbox" id="select-all-permissions">
                                                                    <span>Hamısını seç</span>
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="checkbox checkbox-danger">
                                                                    <input type="checkbox"
                                                                           id="unselect-all-permissions">
                                                                    <span>Hamısını sıfırla</span>
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                            <hr>
                                                            @foreach($permissions as $permission)
                                                                <div class="col-4">
                                                                    <label class="checkbox checkbox-primary">
                                                                        <input type="checkbox" id="{{$permission}}"
                                                                               name="permissions[]"
                                                                               value="{{ $permission->name }}">
                                                                        <span>{{ $permission->name}}</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-success btn-lg" type="submit">Yeni</button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>№</th>
                                                    <th>Vəzifə adı</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($roles as $role)
                                                    <tr>
                                                        <td>{{ $role->id }}</td>
                                                        <td>{{ $role->name }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- SISTEM USERS START  -->
                <div class="card-body">
                    <div class="accordion mt-2" id="accordionRightIcon">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                    <a data-toggle="collapse" class="text-default collapsed"
                                       href="#accordion-item-system-users" aria-expanded="false">
                                        <span><i class="i-Big-Data ul-accordion__font"> </i></span>
                                        Sistem işçiləri</a>
                                </h6>
                            </div>
                            <div id="accordion-item-system-users" class="collapse"
                                 data-parent="#accordionRightIcon" style="">
                                <div class="card-body">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <form action="{{ route('admin.store-technical-users') }}" method="POST">
                                                @csrf
                                                <div class="d-flex align-items-center">
                                                    <select name="user_id" class="form-control ui fluid search dropdown create_form_dropdown" id="">
                                                        <option disabled selected>İşçi seçin</option>
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <select name="role" class="form-control ui fluid search dropdown create_form_dropdown" id="">
                                                        <option disabled selected>Vəzifə seçin</option>
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}">{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <select name="type" class="form-control ui fluid search dropdown create_form_dropdown me-2" id="">
                                                        <option disabled selected>Növ seçin</option>
                                                        <option value="warehouseman">Təhcizat</option>
                                                        <option value="accountant">Mühasib</option>
                                                        <option value="support">Texniki dəstək</option>
                                                        <option value="hr">İnsan resursları</option>
                                                        <option value="admin">Administrator</option>
                                                        <option value="itd-leader">ITD rəhbəri</option>
                                                    </select>
                                                    <button class="btn btn-lg btn-outline-success ms-2" type="submit"
                                                            style="height: 48px;">Yeni
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>

                                            </tr>
                                            <tr>
                                                <th>№</th>
                                                <th>Ad soyad</th>
                                                <th>Email</th>
                                                <th>Növ</th>
                                                <th>Vəzifə</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($technical_users as $t_user)
                                                <tr>
                                                    <td>{{ $t_user->id }}</td>
                                                    <td>{{ $t_user->name }}</td>
                                                    <td>{{ $t_user->email }}</td>
                                                    <td>{{ $t_user->type }}</td>
                                                    <td>
                                                        @if(!is_null($t_user->roles))
                                                            @foreach($t_user->roles as $role)
                                                                {{ $role->name }}
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SISTEM USERS END  -->

            </div>
        </div>
    </div>

@endsection
<!-- Modal -->

@section('js')
    <script>

        $(document).ready(function () {
            $('.summernote').summernote({height: 300});
            $('.table').DataTable();

            $('#select-all-permissions').change(function () {
                $('input[name="permissions[]"]').prop('checked', true);
                $('#unselect-all-permissions').prop('checked', false);
            });

            $('#unselect-all-permissions').change(function () {
                const isChecked = $(this).prop('checked', false);
                $('input[name="permissions[]"]').prop('checked', false);
                $('#select-all-permissions').prop('checked', false);
            });

            $('.report-departments').on('change', function() {
                if ($(this).is(':checked')) {
                    const department_id = $(this).val();
                    $('.report-branches[data-department-id="' + department_id + '"]').prop('checked', true);
                    $('.report-users[data-department-id="' + department_id + '"]').prop('checked', true);
                }
                else {
                    const department_id = $(this).val();
                    $('.report-branches[data-department-id="' + department_id + '"]').prop('checked', false);
                    $('.report-users[data-department-id="' + department_id + '"]').prop('checked', false);
                }
            });

            $('.report-branches').on('change', function() {
                if ($(this).is(':checked')) {
                    const branch_id = $(this).val();
                    console.log(branch_id);
                    $('.report-users[data-branch-id="' + branch_id + '"]').prop('checked', true);
                }
                else {
                    const branch_id = $(this).val();
                    $('.report-users[data-branch-id="' + branch_id + '"]').prop('checked', false);
                }
            });

            $('.report_receiver_list').on("change", function (e) {
                const selectedOption = $(this).find('option:selected');
                const selectedOptionValue = $(this).find('option:selected').val();
                const userId = selectedOption.attr('data-user-id');
                $.ajax({
                    url:"{{ route('admin.update-user-report-receiver-data') }}",
                    method:"POST",
                    data:{
                        "_token":"{{csrf_token()}}",
                        "report_receiver_id":selectedOptionValue,
                        "user_id": userId
                    },
                    success:function (response) {
                        if(response.status == 200)
                        {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: response.icon,
                                title: response.message
                            });
                        }
                    }
                })
            });
        })


    </script>
@endsection
