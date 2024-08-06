

<div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
    <ul class="navigation-left">
        <li class="nav-item " data-item="">
            <a class="nav-item-hold" href="{{route('support.home')}}">
                <i class="nav-icon i-Computer-Secure"></i>
                <span class="nav-text">Əsas səhifə</span>
            </a>
            <div class="triangle"></div>
        </li>

        <li class="nav-item " data-item="">
            <a class="nav-item-hold" href="{{route('support.messages.index')}}">
                <i class="nav-icon i-Computer-Secure"></i>
                <span class="nav-text">Mesajlar</span>
            </a>
            <div class="triangle"></div>
        </li>
       @if($general_settings->ticket_module == 1)
       <li class="nav-item">
            <a class="nav-item-hold" href="{{ route('support.tickets.index') }}">
                <i class="nav-icon i-Ticket"></i>
                <span class="nav-text">Biletlər</span>
            </a>
            <div class="triangle"></div>
        </li>
       @endif
        <li class="nav-item">
            <a class="nav-item-hold" href="{{ route('support.support-users.index') }}">
                <i class="nav-icon i-Checked-User"></i>
                <span class="nav-text">Mütəxəssislər</span>
            </a>
            <div class="triangle"></div>
        </li>
    </ul>
</div>

<div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
    <!-- Submenu Dashboards -->
{{--    <ul class="childNav" data-parent="dashboard-department">--}}
{{--        <li class="nav-item ">--}}
{{--            <a class=""--}}
{{--               href="{{ route('support.departments.index') }}">--}}
{{--                <i class="nav-icon i-Cash-register-2"></i>--}}
{{--                <span class="item-name">Departamentlər</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item ">--}}
{{--            <a class=""--}}
{{--               href="{{ route('support.branches.index') }}">--}}
{{--                <i class="nav-icon i-Cash-register-2"></i>--}}
{{--                <span class="item-name">Şöbələr</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item ">--}}
{{--            <a class=""--}}
{{--               href="{{ route('support.positions.index') }}">--}}
{{--                <i class="nav-icon i-Cash-register-2"></i>--}}
{{--                <span class="item-name">Vəzifələr</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item ">--}}
{{--            <a class=""--}}
{{--               href="{{ route('support.rooms.index') }}">--}}
{{--                <i class="nav-icon i-Cash-register-2"></i>--}}
{{--                <span class="item-name">Otaqlar</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item ">--}}
{{--            <a class=""--}}
{{--               href="{{ route('support.users.index') }}">--}}
{{--                <i class="nav-icon i-Cash-register-2"></i>--}}
{{--                <span class="item-name">İşçilər</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    </ul>--}}

{{--    <ul class="childNav" data-parent="dashboard-inventory">--}}
{{--        <li class="nav-item ">--}}
{{--            <a class=""--}}
{{--               href="{{ route('categories.index') }}">--}}
{{--                <i class="nav-icon i-Cash-register-2"></i>--}}
{{--                <span class="item-name">Kateqoriyalar</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item ">--}}
{{--            <a class=""--}}
{{--               href="{{ route('vendors.index') }}">--}}
{{--                <i class="nav-icon i-Cash-register-2"></i>--}}
{{--                <span class="item-name">Təminatçılar</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item ">--}}
{{--            <a class=""--}}
{{--               href="{{ route('products.index') }}">--}}
{{--                <i class="nav-icon i-Cash-register-2"></i>--}}
{{--                <span class="item-name">İnventarlar</span>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        <li class="nav-item ">--}}
{{--            <a class=""--}}
{{--               href="{{ route('invoices.index') }}">--}}
{{--                <i class="nav-icon i-Cash-register-2"></i>--}}
{{--                <span class="item-name">Qaimələr</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    </ul>--}}
</div>
<div class="sidebar-overlay"></div>
