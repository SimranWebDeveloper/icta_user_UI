<div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
    <ul class="navigation-left">
        <li class="nav-item " data-item="">
            <a class="nav-item-hold" href="{{route('itd-leader.home')}}">
                <i class="nav-icon i-Computer-Secure"></i>
                <span class="nav-text">Əsas səhifə</span>
            </a>
            <div class="triangle"></div>
        </li>


        <li class="nav-item " data-item="dashboard-department">
            <a class="nav-item-hold" href="#">
                <i class="nav-icon i-Building"></i>
                <span class="nav-text">Struktur</span>
            </a>
            <div class="triangle"></div>
        </li>

        <li class="nav-item ">
            <a class="nav-item-hold" href="{{ route('itd-leader.appointments.index') }}">
                <i class="nav-icon i-traffic-Light"></i>
                <span class="nav-text">Təhkim olunma</span>
            </a>
            <div class="triangle"></div>
        </li>

        <li class="nav-item ">
            <a class="nav-item-hold" href="{{ route('itd-leader.messages.index') }}">
                <i class="nav-icon i-traffic-Light"></i>
                <span class="nav-text">Mesajlar</span>
            </a>
            <div class="triangle"></div>
        </li>

        @if($general_settings->ticket_module)
            <li class="nav-item ">
                <a class="nav-item-hold" href="{{ route('itd-leader.tickets.index') }}">
                    <i class="nav-icon i-Ticket"></i>
                    <span class="nav-text">Texniki dəstək biletləri</span>
                </a>
                <div class="triangle"></div>
            </li>
        @endif

        @if($general_settings->weekly_report_module)
            @if(\Illuminate\Support\Facades\Auth::user()->report_sender->count() > 0)
                <li class="nav-item ">
                    <a class="nav-item-hold" href="{{ route('itd-leader.reports.index') }}">
                        <i class="nav-icon i-Calendar"></i>
                        <span class="nav-text">Həftəlik hesabatlar</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endif
        @endif

        @if($general_settings->assets_requests)
            <li class="nav-item ">
                <a class="nav-item-hold" href="{{ route('itd-leader.assets-requests.index') }}">
                    <i class="nav-icon i-Bag-Items"></i>
                    <span class="nav-text">Mal-material sorğusu</span>
                </a>
                <div class="triangle"></div>
            </li>
        @endif

    </ul>
</div>

<div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
    <!-- Submenu Dashboards -->
    <ul class="childNav" data-parent="dashboard-department">
        <li class="nav-item ">
            <a class=""
               href="{{ route('itd-leader.structures.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Struktur</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('itd-leader.departments.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Departamentlər</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('itd-leader.branches.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Şöbələr</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('itd-leader.positions.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Vəzifələr</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('itd-leader.rooms.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Otaqlar</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('itd-leader.users.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">İşçilər</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('itd-leader.local-numbers.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Daxili nömrələr</span>
            </a>
        </li>
    </ul>
</div>
<div class="sidebar-overlay"></div>
