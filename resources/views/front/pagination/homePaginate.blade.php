<div class="row text-center">
    @forelse($products->chunk(4) as $chunk)
    @foreach ($chunk as $product)
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
        <img class="card-img-top img-thumbnail" src="{{asset('images/product_image/'.$product->image)}}" alt="{{$product->name}}" width="50px" height="50px">
        <div class="card-body">
            <h4 class="card-title">{{$product->name}}</h4>
            <p class="card-text text-left">{{$product->description}}</p>
            <p class="card-text text-left">ขนาดตัว {{$product->size}}</p>
            <p class="card-text text-left"><strong>{{$product->price}} ฿</strong></p>
        </div>
        <div class="card-footer">
        {{-- <a href="{{route('cart.addItem',$product->id)}}" class="btn btn-primary add-cart" data-id="{{$product->id}}">Add to Cart</a> --}}
        <a href="javascript:void(0)" class="btn btn-primary add-cart" data-id="{{$product->id}}"><i class="fas fa-cart-plus"></i>&nbsp;เพิ่มลงตะกร้า</a>
        </div>
        </div>
    </div>

    @endforeach
    @empty
    <div class="col-12">
    <div class="row">
        <h4 class="col align-self-center">ไม่มีรายการสินค้า</h4>
    </div>
    </div>
    @endforelse
</div>
{{ $products->links() }}