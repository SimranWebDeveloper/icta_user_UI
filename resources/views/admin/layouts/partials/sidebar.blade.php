

<div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
    <ul class="navigation-left">
        <li class="nav-item " data-item="">
            <a class="nav-item-hold" href="{{route('admin.dashboard')}}">
                <i class="nav-icon i-Computer-Secure"></i>
                <span class="nav-text">Əsas səhifə</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item " data-item="">
            <a class="nav-item-hold" href="{{route('admin.messages.index')}}">
                <i class="nav-icon i-Computer-Secure"></i>
                <span class="nav-text">Mesajlar</span>
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

        <li class="nav-item " data-item="dashboard-inventory">
            <a class="nav-item-hold" href="#">
                <i class="nav-icon i-Inbox-Empty"></i>
                <span class="nav-text">İnventar</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item ">
            <a class="nav-item-hold" href="{{ route('admin.appointments.index') }}">
                <i class="nav-icon i-traffic-Light"></i>
                <span class="nav-text">Təhkim olunma</span>
            </a>
            <div class="triangle"></div>
        </li>
        @if($general_settings->assets_requests == 1)
            <li class="nav-item">
                <a class="nav-item-hold" href="{{ route('admin.assets-requests.index') }}">
                    <i class="nav-icon i-Bag-Items"></i>
                    <span class="nav-text">Mal-material sorğusu</span>
                </a>
                <div class="triangle"></div>
            </li>
        @endif
        <li class="nav-item ">
            <a class="nav-item-hold" href="{{ route('admin.tickets.index') }}">
                <i class="nav-icon i-Ticket"></i>
                <span class="nav-text">Texniki dəstək biletləri</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item ">
            <a class="nav-item-hold" href="{{ route('admin.reports.index') }}">
                <i class="nav-icon i-Calendar"></i>
                <span class="nav-text">Həftəlik hesabatlar</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item ">
            <a class="nav-item-hold" href="{{ route('admin.general-settings.index') }}">
                <i class="nav-icon i-Settings-Window"></i>
                <span class="nav-text">Ümumi tənzimləmələr</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item ">
            <a class="nav-item-hold" href="{{ route('admin.logs') }}">
                <i class="nav-icon i-Data-Transfer"></i>
                <span class="nav-text">Loqlar</span>
            </a>
            <div class="triangle"></div>
        </li>


    </ul>
</div>

<div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
    <!-- Submenu Dashboards -->
    <ul class="childNav" data-parent="dashboard-department">
        <li class="nav-item ">
            <a class=""
               href="{{ route('admin.structures.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Struktur</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('admin.departments.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Departamentlər</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('admin.branches.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Şöbələr</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('admin.positions.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Vəzifələr</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('admin.rooms.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Otaqlar</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('admin.users.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">İşçilər</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('admin.local-numbers.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Daxili nömrələr</span>
            </a>
        </li>
    </ul>

    <ul class="childNav" data-parent="dashboard-inventory">
        <li class="nav-item ">
            <a class=""
               href="{{ route('admin.categories.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Kateqoriyalar</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('admin.vendors.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Təminatçılar</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('admin.warehouses.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Saxlanc anbarları</span>
            </a>
        </li>

        <li class="nav-item ">
            <a class=""
               href="{{ route('admin.invoices.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">E-qaimələr</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('admin.hand-registers.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Fakturalar</span>
            </a>
        </li>
    </ul>
</div>
<div class="sidebar-overlay"></div>
