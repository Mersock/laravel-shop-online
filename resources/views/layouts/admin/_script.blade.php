    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    @yield('script-admin')
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    //ajax laravel set
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    //clear form เมื่อ modal ปิด
    $('.modal').on('hidden.bs.modal', function (e) {
        $(this)
        .find("input,textarea,select")
            .not('input[type=radio], input[type=checkbox]')
            .val('')
            .end()
        // .find("input[type=checkbox], input[type=radio]")
        .find("input[type=checkbox]")
            .prop("checked", "")
            .end();

        $("form input:text,select, textarea").removeClass('is-invalid');    
    });
    </script>