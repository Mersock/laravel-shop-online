@extends('layouts.admin.main')

@section('content-admin')
<h3>รายการสั่งซื้อ</h3>

<ul>
    @forelse ($orders as $order)

<li>
    ชื่อ-สกุลลูกค้า: {{$order->user->name}} <br>
    เลขที่สั่งซื้อ : #{{$order->no}}<br>
    วันที่สั่งซื้อ : {{$order->date}}<br>
    ราคารวม:  {{number_format($order->total,2)}} ฿
</li>     
    {{Form::open(['route'=>['orders.status',$order->id],'method'=>'post'])}}
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="delivered" value="1" {{$order->delivered==1?"checked":""}}>
                <label class="form-check-label" for="defaultCheck1">
                  จัดส่งแล้ว
                </label>
        </div>
        {{Form::submit('submit',['class'=>'btn btn-success btn-sm'])}}
    {{Form::close()}}
<br>
    <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                    <thead>
                            <tr>
                              <th scope="col"  class="text-center" width="10%">ลำดับที่</th>
                              <th scope="col"  class="text-center" width="50%">ชื่อสินค้า</th>
                              <th scope="col"  class="text-center" width="20%">จำนวน</th>
                              <th scope="col"  class="text-center" width="20%">ราคา</th>
                            </tr>
                    </thead>
                    <tbody>

                        @foreach ($order->orderItems as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td class="text-center">{{$item->pivot->qty}}</td>
                            <td class="text-center">{{number_format($item->pivot->total_amout,2)}}</td>
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
                              <th scope="col"  class="text-center" width="10%">#</th>
                              <th scope="col"  class="text-center" width="50%">Name</th>
                              <th scope="col"  class="text-center" width="20%">qty</th>
                              <th scope="col"  class="text-center" width="20%">price</th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">No Orders</td>
                    </tbody>
            </table>
          </div>
    @endforelse
</ul>


@endsection