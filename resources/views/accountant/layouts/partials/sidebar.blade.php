

<div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
    <ul class="navigation-left">
        <li class="nav-item " data-item="">
            <a class="nav-item-hold" href="{{route('accountant.home')}}">
                <i class="nav-icon i-Computer-Secure"></i>
                <span class="nav-text">Əsas səhifə</span>
            </a>
            <div class="triangle"></div>
        </li>

        <li class="nav-item " data-item="">
            <a class="nav-item-hold" href="{{ route('accountant.messages.index') }}">
                <i class="nav-icon i-Inbox-Empty"></i>
                <span class="nav-text">Mesajlar</span>
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
            <a class="nav-item-hold" href="{{ route('accountant.appointments.index') }}">
                <i class="nav-icon i-traffic-Light"></i>
                <span class="nav-text">Təhkim olunma</span>
            </a>
            <div class="triangle"></div>
        </li>

        @if($general_settings->assets_requests == 1)
            <li class="nav-item">
                <a class="nav-item-hold" href="{{ route('accountant.assets-requests.index') }}">
                    <i class="nav-icon i-Bag-Items"></i>
                    <span class="nav-text">Mal-material sorğusu</span>
                </a>
                <div class="triangle"></div>
            </li>
        @endif
    </ul>
</div>

<div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">


    <ul class="childNav" data-parent="dashboard-inventory">
        <li class="nav-item ">
            <a class=""
               href="{{ route('accountant.categories.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Kateqoriyalar</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('accountant.vendors.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Təminatçılar</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('accountant.warehouses.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Saxlanc anbarları</span>
            </a>
        </li>

        <li class="nav-item ">
            <a class=""
               href="{{ route('accountant.invoices.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">E-qaimələr</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('accountant.hand-registers.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Fakturalar</span>
            </a>
        </li>
    </ul>
</div>
<div class="sidebar-overlay"></div>
