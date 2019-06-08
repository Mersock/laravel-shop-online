@extends('layouts.main')


@section('content')
<div class="row">
        <div class="col-md-6 offset-md-4 align-self-center">
        <h3 style="margin-top:10px">รายการสั่งซื้อสำเร็จแล้ว</h3>
        <div class="alert alert-success" role="alert">
                รายการสั่งซื้อหมายเลข #{{$order->no}} สำเร็จแล้ว
        </div>
        <p><strong>รวมราคา :</strong> {{number_format($order->total,2)}} ฿</p>
        <p><strong>วันที่สั่งซื้อ</strong> {{$order->date}}</p>
        <p>เมื่อมีการจัดส่งสินค้าทางเราจะแจ้งไปที่อีเมล  {{Auth::user()->email}}</p>
        <h4>ที่อยู่ในการจัดส่ง</h4>
            @foreach ($address as $add)
            <p><strong>ที่อยู่ :</strong>{{$add->address_line}}</p>
            <p><strong>ตำบล :</strong>{{$add->state}}</p>            
            <p><strong>เมื่อง :</strong>{{$add->city}}</p>
            <p><strong>จังหวัด :</strong>{{$add->country}}</p>            
            <p><strong>รหัสไปรษณีย์ :</strong>{{$add->zip}}</p>
            <p><strong>เบอร์โทรศัพท์ :</strong>{{$add->phone}}</p>        
            @endforeach    

        </div>
</div>
@endsection
