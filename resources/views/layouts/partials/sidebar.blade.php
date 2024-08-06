

<div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
    <ul class="navigation-left">
        <li class="nav-item " data-item="">
            <a class="nav-item-hold" href="{{route('home')}}">
                <i class="nav-icon i-Computer-Secure"></i>
                <span class="nav-text">Əsas səhifə</span>
            </a>
            <div class="triangle"></div>
        </li>


        <li class="nav-item " data-item="dashboard-department">
            <a class="nav-item-hold" href="#">
                <i class="nav-icon i-Bar-Chart"></i>
                <span class="nav-text">Departament</span>
            </a>
            <div class="triangle"></div>

        </li>

        <li class="nav-item " data-item="dashboard-inventory">
            <a class="nav-item-hold" href="#">
                <i class="nav-icon i-Bar-Chart"></i>
                <span class="nav-text">İnvertar</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item ">
            <a class="nav-item-hold" href="{{ route('appointments.index') }}">
                <i class="nav-icon i-Bar-Chart"></i>
                <span class="nav-text">İnvertar əməliyyatları</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item ">
            <a class="nav-item-hold" href="{{ route('logs') }}">
                <i class="nav-icon i-Bar-Chart"></i>
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
               href="{{ route('departments.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Departamentlər</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('branches.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Şöbələr</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('rooms.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Otaqlar</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('users.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">İşçilər</span>
            </a>
        </li>
    </ul>

    <ul class="childNav" data-parent="dashboard-inventory">
        <li class="nav-item ">
            <a class=""
               href="{{ route('categories.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Kateqoriyalar</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('vendors.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Təminatçılar</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class=""
               href="{{ route('products.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">İnventarlar</span>
            </a>
        </li>

        <li class="nav-item ">
            <a class=""
               href="{{ route('invoices.index') }}">
                <i class="nav-icon i-Cash-register-2"></i>
                <span class="item-name">Qaimələr</span>
            </a>
        </li>
    </ul>
</div>
<div class="sidebar-overlay"></div>
