@extends('hr.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="d-flex justify-content-between align-items-center">
                <h3>{{ $user->name }} - istifadəçi məlumatları</h3>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('hr.update-profile', $user->id)}}">
                        @csrf
                        @method("PUT")
                        <div class="card-body">


                            <div class="form-group row">
                                <label for="name_surname" class="col-sm-2 col-form-label">Ad, soyad, ata adı</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                           value="{{$user->name}}" name="name" id="name"
                                           placeholder="Ad, soyad daxil edin...">
                                    @if($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control"
                                           value="{{$user->email}}" id="inputEmail3" name="email"
                                           placeholder="Email ünvanınızı daxil edin...">
                                    @if($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Şifrə</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" id="inputPassword3"
                                           placeholder="Şifrənizi daxil edin">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Yeni şifrə</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="new_password" id="inputPassword3"
                                           placeholder="Yeni şifrənizi daxil edin">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Yadda saxlayın</button>
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
        @if (session('success'))
        const storeSuccess = "{{ session('success') }}";
        const SuccessAlert = Swal.fire({
            title: "Uğurlu!",
            text: storeSuccess,
            icon: "success"
        })
        SuccessAlert.fire();

        @php session()->forget('success') @endphp
        @endif

        @if (session('error'))
        const storeError = "{{ session('error') }}";
        const ErrorAlert = Swal.fire({
            title: "Xəta!",
            text: storeError,
            icon: "error"
        })
        SuccessAlert.fire();

        @php session()->forget('error') @endphp
        @endif
    </script>
@endsection
