@extends('layouts.main')

@section('content')

      <!-- Jumbotron Header -->
      <header class="jumbotron my-4">
        <h1 class="display-3">ยินดีต้อนรับ!</h1>
        <p class="lead">จำหน่ายเสื้อกีฬา, ชุดกีฬา, เสื้อฟุตบอล</p>
        {{-- <a href="#" class="btn btn-primary btn-lg">Call to action!</a> --}}
      </header>

      <!-- Page Features -->
    <div class="item-product">
        @include('front.pagination.homePaginate')
    </div>

@endsection
@section('script')
  <script>
    //เพิ่มตะกร้าสินค้า
      $("body").delegate(".add-cart","click",function(e){
          var id = $(this).attr("data-id");
          var url = "{{URL::to('cart/add-item/')}}/"+id;
          $.ajax({
            type:'GET',
            dataType:'json',
            data:{
                id:id
            },
            url:url,
            success:function(data){
              $("#count_cart").html(data);
            }
          });
          
      });

  $(document).on('click','.pagination a',function(e){
      e.preventDefault();
      var page = $(this).attr('href').split("page=")[1];
      // console.log(page);
      $.get('/pagination?page='+page,null,function(data){
              console.log(data);
              //empty กันข้อมูลมาซ้ำ
              $('.item-product').empty().html(data);
              location.hash='?page='+page;
              // window.history.pushState({"html":page,"pageTitle":'hello'},"ปปป", 'pagination?page='+page);
              // $("#page").val(page);
      });
  });
  </script>
@endsection