<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IMS Login</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/styles/css/themes/lite-purple.min.css')}}">
    <style>
        .auth-layout-wrap {
            background-image: url({{ asset('assets/images/bg-main.png') }});
            backdrop-filter: invert(20%);
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body>
<div class="auth-layout-wrap">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-4">
                        <div class="text-center mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <img src="{{asset('assets/images/gradient_black.png')}}" alt="" height="60px;">
                                <img src="{{asset('assets/images/logoobiri.svg')}}" alt="" height="60px;">
                            </div>
                        </div>
                        <hr>
                        <form id="loginForm" action="{{route('login')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" class="form-control @error('email') is-invalid @enderror" required name="email" value="{{ old('email') }}" placeholder="Email ünvanınızı daxil edin..." type="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Şifrə</label>
                                <input id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="********" type="password">
                                <input type="text" hidden id="selectedRole" name="selectedRole" value="">
                            </div>

                            <button class="btn btn-primary btn-block mt-2" id="loginButton">Daxil olun</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('assets/js/common-bundle-script.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    $('#loginButton').click(function (e) {
        e.preventDefault();

        var email = $('#email').val();
        var password = $('#password').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: "POST",
            url: "{{ route('check.user.status') }}",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                email: email,
                password: password
            },
            success: function (response) {

                if (response.status == 'multiple_roles') {
                    let selectHTML = '<select id="roleSelect" class="form-control">';
                    const roles_array = [
                        { value: 'employee', label: 'İşçi' },
                        { value: 'warehouseman', label: 'Təhcizatçı' },
                        { value: 'accountant', label: 'Mühasib' },
                        { value: 'administrator', label: 'Administrator' },
                        { value: 'hr', label: 'İnsan resursları' },
                        { value: 'support', label: 'Texniki dəstək' },
                        { value: 'itd-leader', label: 'İKT rəhbəri' },
                    ];

                    const rolesObject = {};
                    roles_array.forEach(function(role) {
                        rolesObject[role.value] = role.label;
                    });

                    response.roles.forEach(function(role) {
                        selectHTML += '<option value="' + role + '">' + rolesObject[role] + '</option>';
                    });
                    selectHTML += '</select>';


                    Swal.fire({
                        title: "<strong>Subyekti seçin</strong>",
                        icon: "info",
                        html: selectHTML,
                        showCloseButton: true,
                        focusConfirm: false,
                        confirmButtonText: `<i class="fa fa-thumbs-up"></i> Sistemə daxil olun`,
                        confirmButtonAriaLabel: "Sistemə daxil olun",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const selected_role = $('#roleSelect').val();
                            $('#selectedRole').val(selected_role);
                            $('#loginForm').submit();
                        }
                    });
                } else {
                    const selectedRole = $('#roleSelect').val();
                    $('#selectedRole').val('employee');
                    $('#loginForm').submit();
                }
            },
        });
    });

    // Handle role selection confirmation
    $('#confirmRoleSelection').click(function () {
        var selectedRole = $('input[name=roleSelection]:checked').val();
        $('#selectedRole').val(selectedRole);
        console.log(selectedRole);
        $('#loginForm').submit();
    });
});
</script>



</body>
</html>
