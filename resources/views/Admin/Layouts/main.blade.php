@include('Admin.Layouts.header')
<div class="container-fluid">
    <div class="row">
        @yield('main')
    </div>
</div>
@stack('js')