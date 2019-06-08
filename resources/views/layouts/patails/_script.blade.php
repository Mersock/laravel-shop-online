    <!-- Bootstrap core Jquery -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Stripe Payment -->
    <script src="https://js.stripe.com/v2/"></script>
    <script> 
            Stripe.setPublishableKey('pk_test_EIiUkcmqhdKzTAi0xNXxx2PZ');
    </script>
    <script src="{{asset('js/paymentToken.js')}}"></script>
     <!-- Sweet Alert -->
    <script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>

    <script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    </script>
    @yield('script')