@extends('layouts.app')
@section('main-content')
    @include('itd-leader.layouts.partials.topbar')
    <!-- header top menu end -->


    <div class="side-content-wrap">
        @include('itd-leader.layouts.partials.sidebar')
    </div>
    <!--=============== Left side End ================-->

    <!-- ============ Body content start ============= -->
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            @yield('content')
        </div>

        <!-- Footer Start -->
        <div class="flex-grow-1"></div>
        @include('layouts.partials.footer')
        <!-- fotter end -->
    </div>
@endsection
