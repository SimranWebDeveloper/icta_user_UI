@extends('layouts.app')
@section('main-content')
    @include('employee.layouts.partials.topbar')
    <!-- header top menu end -->


    <div class="side-content-wrap">
        @include('employee.layouts.partials.sidebar')
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

@section('js')
    <script src="{{ asset('js/employee/survey.js') }}"></script>
    <script src="{{ asset('js/employee/meetings.js') }}"></script>
    <script src="{{ asset('js/employee/announcement.js') }}"></script>
@endsection
