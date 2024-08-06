<div class="main-header">
    <div class="logo">
        <a href="{{route('accountant.home')}}">
            <img src="{{ asset('assets/images/logo.png')}}" alt="" class="main-logo">
        </a>
    </div>

    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div style="margin: auto"></div>
    <div class="header-part-right">
        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
        <!-- Grid menu Dropdown -->

        <!-- Notificaiton -->

        <!-- Notificaiton End -->

        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div class="user col align-self-end">
                <a href="#" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <h5 style="text-align: right">{{Auth::user()->name}}
                    </h5>
                    <p style="text-align: right; margin-bottom: 0;";>{{\Illuminate\Support\Facades\Auth::user()->position}}</p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('accountant.profile') }}">Hesab məlumatları</a>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button class="dropdown-item">
                            Çıxış
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
