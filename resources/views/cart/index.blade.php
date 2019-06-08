@extends('layouts.main')

@section('title',' ตะกร้าสินค้า')
@section('content')
<div class="row">
        
        <h3 style="margin-top:10px;">ตะกร้าสินค้า</h3>

</div>
<div class="row">
        <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>ขนาดตัว</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="data_cart">
                    @php
                        $i =1;
                    @endphp
                    @foreach ($cartItems as $cartItem)
                    <tr id="{{$cartItem->rowId}}">    
                            <td>{{$i}}</td>
                            <td>{{$cartItem->name}}</td>
                            <td>{{number_format($cartItem->price,2)}}</td>
                            <td nowrap>
                                {{-- {!! Form::open(['route'=>['cart.update',$cartItem->rowId],'method'=>'PUT','id'=>'frm_update_'.$cartItem->rowId]) !!} --}}
                                <div class="col-sm-6 qty_group" >
                                        {{Form::text('qty',$cartItem->qty,['class'=>'form-control qty_update','data_id'=>$cartItem->rowId])}}
                                        {{-- {{Form::submit('submit',['class'=>'btn btn-info btn-sm'])}} --}}
                                </div>
                                {{-- {!! Form::close() !!} --}}
                            </td>
                            <td>{{$cartItem->options->has('size')?$cartItem->options->size:''}}</td>
                            <td class="text-center">
                                {{-- {!! Form::open(['route'=>['cart.destroy',$cartItem->rowId],'method'=>'DELETE']) !!} --}}
                                    {!!Form::button('<i class="fas fa-trash-alt"></i>&nbsp;ลบสินค้านี้',['type'=>'submit','class'=>'btn btn-danger btn-sm delete_item','data-id'=>$cartItem->rowId])!!}
                                {{-- {!! Form::close() !!} --}}
                            </td>
                    </tr>    
                    @php
                        $i++;
                    @endphp    
                    @endforeach
                    <tr class="total_cart">
                        <td></td>
                        {{-- subtotal ไม่รวม tax
                        total รวม tax --}}
                        <td></td>
                        <td><strong>รวมราคา : <span id="total">{{number_format(Cart::total(),2)}}</span> </strong></td>
                        <td><strong>จำนวนทั้งหมด : <span id="count_item">{{number_format(Cart::count())}}</span></strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @if(count($cartItems))
            <a href="{{route('checkout.shipping')}}" class="btn btn-primary checkout_shipping"><i class="fas fa-calendar-check"></i>&nbsp;ชำระเงิน</a>
        @endif
</div>
<br>

@endsection
@section('script')
<script>
$(document).ready(function(){
    //บังคับกรอกตัวเลข
    $('.qty_group').on('keydown', '.qty_update', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});

});

    //แก้ไข qty
    $(".qty_update").blur(function(){
        var id = $(this).attr('data_id');
        var qty = $(this).val();
        var url = "{{url('cart/')}}/"+id;

    if(qty>0){
        $.ajax({
            type:'POST',
            dataType:'json',
            data:{
                id:id,
                qty:qty,
                _method:'PUT'
            },
            url:url,
            success:function(data){
                $("#count_cart").html(data.count);
                $("#count_item").html(data.count);
                $("#total").html(data.total)
            }
        });
    }else{
        //ลบ
        $.ajax({
            type:'POST',
            dataType:'json',
            data:{
                id:id,
                _method:'DELETE'
            },
            url:url,
            success:function(data){
                $("tr#"+data.remove_id).remove();
                $("#count_cart").html(data.count);
                $("#count_item").html(data.count);
                $("#total").html(data.total);
                
                var count_tr_cart = $(".data_cart tr").not(".total_cart").length;
                if(count_tr_cart==0){
                    $(".checkout_shipping").hide();
                }else{
                    $(".checkout_shipping").show();
                }
            }
        });
    }

    });

    $(".delete_item").click(function(){
        swal({
        title: "ยืนยันการลบสินค้า",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {  
                    var tr_id = $(this).attr('data-id');
                        var url = "{{url('cart/')}}/"+tr_id;
                        // $("tr#"+tr_id).hide();
                        $.ajax({
                            type:'POST',
                            dataType:'json',
                            data:{
                                id:tr_id,
                                _method:'DELETE'
                            },
                            url:url,
                            success:function(data){
                                $("tr#"+data.remove_id).remove();
                                $("#count_cart").html(data.count);
                                $("#count_item").html(data.count);
                                $("#total").html(data.total);

                                    var count_tr_cart = $(".data_cart tr").not(".total_cart").length;
                                    if(count_tr_cart==0){
                                        $(".checkout_shipping").hide();
                                    }else{
                                        $(".checkout_shipping").show();
                                    }
                            }
                        });
            }
        });
    });
</script>
@endsection