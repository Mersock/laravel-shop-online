@extends('layouts.main')

@section('title','ประวัติการสั่งซื้อ')

@section('content')
<h3 style="margin-top:10px;">ประวัติการสั่งซื้อ</h3>

<ul>
    @forelse ($orders as $order)
<strong><p>เลขที่สั่งซื้อ: #{{$order->no}} </p></strong> 
<strong><p>วันที่ทำรายการ: {{$order->date}} </p></strong> 
<strong><p>จำนวนเงินรวม: {{number_format($order->total,2)}} ฿</p></strong> 
@if($order->delivered==1)
    <div class="alert alert-success" role="alert">
            จัดส่งเรียบร้อยแล้ว
    </div>
@else
    <div class="alert alert-secondary" role="alert">
            กำลังดำเนินการ
    </div>
@endif
    <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                    <thead>
                            <tr>
                              <th scope="col"  class="text-center" width="10%">ลำดับที่</th>
                              <th scope="col"  class="text-center" width="50%">ชื่อ</th>
                              <th scope="col"  class="text-center" width="20%">จำนวน</th>
                              <th scope="col"  class="text-center" width="20%">ราคา</th>
                            </tr>
                    </thead>
                    <tbody>

                        @foreach ($order->orderItems as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->pivot->qty}}</td>
                            <td>{{number_format($item->pivot->total_amout,2)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
          <hr>
        @empty
    <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                    <thead>
                            <tr>
                              <th scope="col"  class="text-center" width="10%">ลำดับที่</th>
                              <th scope="col"  class="text-center" width="50%">ชื่อ</th>
                              <th scope="col"  class="text-center" width="20%">จำนวน</th>
                              <th scope="col"  class="text-center" width="20%">ราคา</th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">ไม่พบประวัติการสั่งซื้อ</td>
                    </tbody>
            </table>
          </div>
    @endforelse
    {{ $orders->links() }}
</ul>

@endsection