<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    @include('layouts.admin._head')
<body>
    <div id="wrapper">
    @include('layouts.admin._nav')
    <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Menu</a>
    <div id="page-content-wrapper">
        <div class="container-fluid">
        @yield('content-admin')
        </div>
    </div>
    </div>
    <!-- /#wrapper -->

    @include('layouts.admin._script')
</body>

</html>
