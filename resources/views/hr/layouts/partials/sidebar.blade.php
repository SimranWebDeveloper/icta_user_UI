<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">


<div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
    <ul class="navigation-left">
        <li class="nav-item " data-item="">
            <a class="nav-item-hold" href="{{route('hr.home')}}">
                <!-- <i class="fa-duotone fa-solid fa-house nav-icon"></i> -->
                <i class="fa-light fa-house nav-icon" style="color: #000000;"></i>
                <span class="nav-text">Əsas səhifə</span>
            </a>
            <div class="triangle"></div>
        </li>

        <li class="nav-item " data-item="">
            <a class="nav-item-hold" href="{{ route('hr.messages.index') }}">
                <!-- <i class="fa-duotone fa-solid fa-messages nav-icon"></i> -->
                <i class="fa-light fa-messages nav-icon" style="color: #000000;"></i>
                <span class="nav-text">Mesajlar</span>
            </a>
            <div class="triangle"></div>
        </li>

        @if($general_settings->assets_requests == 1)
            <li class="nav-item">
                <a class="nav-item-hold" href="#">
                    <!-- <i class="fa-duotone fa-solid fa-clipboard-question nav-icon"></i> -->
                    <i class="fa-light fa-clipboard-question nav-icon" style="color: #000000;"></i>
                    <span class="nav-text">Mal-material sorğusu</span>
                </a>
                <div class="triangle"></div>
            </li>
        @endif
        <li class="nav-item " data-item="">
            <a class="nav-item-hold" href="{{ route('hr.announcements.index') }}">
                <!-- <i class="fa-duotone fa-solid fa-bullhorn nav-icon"></i> -->
                <i class="fa-light fa-bullhorn nav-icon" style="color: #000000;"></i>
                <span class="nav-text">Elanlar</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item " data-item="">
            <a class="nav-item-hold" href="{{ route('hr.meetings.index') }}">
                <!-- <i class="fa-duotone fa-solid fa-handshake nav-icon"></i> -->
                <i class="fa-light fa-handshake nav-icon" style="color: #000000;"></i>
                <span class="nav-text">İclas və tədbir</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item " data-item="">
            <a class="nav-item-hold" href="{{ route('hr.surveys.index') }}">
                <!-- <i class="fa-duotone fa-solid fa-square-poll-horizontal nav-icon"></i> -->
                <i class="fa-light fa-square-poll-horizontal nav-icon" style="color: #000000;"></i>
                <span class="nav-text">Anketlər</span>
            </a>
            <div class="triangle"></div>
        </li>
    </ul>
</div>

<div class="sidebar-overlay"></div>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<script src="https://kit.fontawesome.com/6650e5b955.js" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
