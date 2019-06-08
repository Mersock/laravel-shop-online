<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('layouts.patails._head')
  <body>
@include('layouts.patails._nav')   
    <!-- Page Content -->
    <div class="container">
        @yield('content')
    </div>
    <!-- /.container -->
    @include('layouts.patails._footer')  
    @include('layouts.patails._script')  
  </body>

</html>
