<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="BRo50BKcBSbFtNDV2aE5RHXS6DX69Y6ll9PEvImY">
    <title>İnventar İdarə Sistemi</title>
    <link id="gull-theme" rel="stylesheet" href="{{ asset('assets/styles/css/themes/create_foreign_broadcast.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_dots.min.css')}}">
    <link id="gull-theme" rel="stylesheet" href="{{ asset('assets/styles/css/themes/lite-purple.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/perfect-scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/pickadate/classic.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/pickadate/classic.date.css')}}">
    <link rel="stylesheet" href="{{ asset('css/ticket-style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.css"
          integrity="sha512-KXol4x3sVoO+8ZsWPFI/r5KBVB/ssCGB5tsv2nVOKwLg33wTFP3fmnXa47FdSVIshVTgsYk/1734xSk9aFIa4A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">



    <style>
        .main-content-wrap {
            background-image: url({{ asset('assets/images/bg-main.png') }});
            backdrop-filter: invert(20%);
        }
    </style>
    @yield('css')
</head>
<body class="text-left main-body">
<div class='loadscreen' id="preloader">
    <div class="loader spinner-bubble spinner-bubble-primary">
    </div>
</div>
<!-- ============ Compact Layout start ============= -->
<!-- ============Deafult  Large SIdebar Layout start ============= -->
<div class="app-admin-wrap layout-sidebar-large clearfix">
    @yield('main-content')
    <!-- ============ Body content End ============= -->
</div>


@if ($general_settings && $general_settings->notification_module == 1 && !\Illuminate\Support\Facades\Auth::user()->read_notf)
    <div class="modal" id="notificationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Bildiriş</h3>
                    <button type="button" class="btn-close btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <span>
                            <i class="nav-icon i-Close"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{!! $general_settings->notification_content !!}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
                    <button type="button" class="btn btn-primary notification-read">Tanış oldum</button>
                </div>
            </div>
        </div>
    </div>

@endif


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/common-bundle-script.js')}}"></script>

<script src="{{ asset('assets/js/es5/dashboard.v1.script.js')}}"></script>
<script src="{{ asset('assets/js/es5/dashboard.v2.script.js')}}"></script>
<script src="{{ asset('assets/js/script.js')}}"></script>
<script src="{{ asset('assets/js/sidebar.large.script.js')}}"></script>
<script src="{{ asset('assets/js/customizer.script.js')}}"></script>
<script src="{{ asset('assets/js/form.basic.script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.js"
        integrity="sha512-Xo0Jh8MsOn72LGV8kU5LsclG7SUzJsWGhXbWcYs2MAmChkQzwiW/yTQwdJ8w6UA9C6EVG18GHb/TrYpYCjyAQw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<script src="{{ asset('assets/js/vendor/pickadate/picker.js')}}"></script>

<script src="{{ asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>
<script src="{{ asset('assets/js/create_foreign_broadcast.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/4.13.1/dragula.min.js"></script>
<script src="{{ asset('assets/js/vendor/jquery.smartWizard.min.js')}}"></script>
<script src="{{ asset('assets/js/smart.wizard.script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/l10n/az.js"></script>
<script>
    $(document).ready(function () {
        $('#notificationModal').modal('show');
    });
</script>

<script>
    var notificationSound = document.getElementById('notificationSound');

    function playNotificationSound() {
        notificationSound.play();
    }

    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
    });

    var channel = pusher.subscribe('messages');

    $(document).ready(function () {
        $('.ims-users').on('click', '.fore-user', function (e) {
            var userName = $(this).data('user-name');
            var userId = $(this).data('user-id');
            $('#chatUserName').text(userName);
            $('#to_user_id').val(userId);

            fetchMessages(userId);
            localStorage.setItem('userId', userId);
            localStorage.setItem('userName', userName);
        });

        function fetchMessages(userId) {
            $.ajax({
                url: "{{ route('employee.messages.fetch') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "userId": userId
                },
                success: function (response) {
                    const messagesEl = document.getElementById('chatMessages');
                    messagesEl.innerHTML = '';

                    const sender = localStorage.getItem('userId');
                    response.messages.forEach(message => {
                        const messageEl = document.createElement('div');
                        messageEl.classList.add('message');

                        if (message.from_user_id == {{ Auth::id() }}  && message.to_user_id == sender) {
                            messageEl.classList.add('sent');
                            messageEl.textContent = message.message;
                            messagesEl.appendChild(messageEl);
                        } else if(message.to_user_id == {{ Auth::id() }} && message.from_user_id == sender) {
                            playNotificationSound();
                            messageEl.classList.add('received');
                            messageEl.textContent = message.message;
                            messagesEl.appendChild(messageEl);
                        }
                    });

                    const chatUserAvatarEl = document.querySelector('.chat-topbar img.avatar-sm');
                }
            })
        }

        // Pusher
        Pusher.logToConsole = true;
        const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            encrypted: true
        });
        const channel = pusher.subscribe('chat');
        channel.bind('App\\Events\\MessageSent', function (data) {
            const messagesEl = document.getElementById('chatMessages');
            const messageEl = document.createElement('div');
            const sender = localStorage.getItem('userId');
            messageEl.classList.add('message');
            if (data.message.from_user_id == {{ Auth::id() }} && data.message.to_user_id == sender) {
                messageEl.classList.add('sent');
                messageEl.textContent = data.message.message;
                messagesEl.appendChild(messageEl);
            } else if(data.message.to_user_id == {{ Auth::id() }} && data.message.from_user_id == sender) {
                playNotificationSound();
                messageEl.classList.add('received');
                messageEl.textContent = data.message.message;
                messagesEl.appendChild(messageEl);
            }

        });

        $('#sendMessageForm').on('submit', function (e) {
            e.preventDefault();

            const message = document.getElementById('message').value;
            const to_user_id = document.getElementById('to_user_id').value;

            axios.post(this.action, {message, to_user_id})
                .then(response => {
                    document.getElementById('message').value = '';
                    const messagesEl = document.getElementById('chatMessages');

                    messagesEl.scrollTop = messagesEl.scrollHeight;
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                });
        });

        function renderUsers(filteredUsers) {
            $('.ims-users').html('');
            $.each(filteredUsers, function (index, value) {
                let isActive = value.last_activity && new Date(value.last_activity) >= new Date(Date.now() - 5 * 60 * 1000);
                let statusClass = isActive ? 'online' : 'offline';
                let _html = `<div class="p-3 d-flex border-bottom align-items-center contact ${statusClass} clearfix fore-user"
                         data-user-id="${value.id}" data-user-name="${value.name}">
                        <img src="https://gull-html-laravel.ui-lib.com/assets/images/faces/3.jpg" alt=""
                             class="avatar-sm rounded-circle mr-3">
                        <h6 class="">${value.name}</h6>
                    </div>`;
                $('.ims-users').append(_html);
            });
        }

        @if(isset($users) && count($users) > 0)
        let users = @json($users);
        renderUsers(users);
        @endif

        $('#search').on("input", function (e) {
            let searchTerm = e.target.value.toLowerCase();
            let filteredUsers = users.filter(user => user.name.toLowerCase().includes(searchTerm));
            renderUsers(filteredUsers);
        });

        $('.notification-read').on("click", function () {
            const userId = "{{ \Illuminate\Support\Facades\Auth::id() }}";
            $.ajax({
                url: "{{ route('update-user-notf-status') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "userId": userId
                },
                success: function (response) {
                    if(response.status)
                    {
                        Swal.fire({
                            title: response.title,
                            text: response.message,
                            icon: response.icon
                        });
                    }
                }
            })
        })
    });

</script>

<!-- Initialize Quill editor -->
@yield('js')
</body>
</html>
