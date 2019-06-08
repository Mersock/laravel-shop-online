<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_data">เพิ่มข้อมูล</button><br><br>   
  <div class="table-responsive" id="data-table">  
    <table class="table table-bordered table-striped table-hover" width="100%" id="main_table">
            <thead>
              <tr>
                <th scope="col" width="5%" class="text-center">ลำดับ</th>
                <th scope="col" width="20%" class="text-center">ชื่อสินค้า</th>
                <th scope="col" width="20%" class="text-center">คำอธิบาย</th>
                <th scope="col" width="5%" class="text-center">ขนาดตัว</th>
                <th scope="col" width="5%" class="text-center">ราคา</th>
                <th scope="col" width="15%" class="text-center">รูปภาพ</th>
                <th scope="col" width="15%" class="text-center">หมวดหมู่</th>
                <th scope="col" width="15%" class="text-center">สถานะ</th>
                <th scope="col" width="15%" class="text-center">จัดการ</th>
              </tr>
            </thead>
            <tbody id="product_list">
                @forelse($products as $key => $product)
                <tr id="{{$product->id}}">
                      <td scope="row" class="text-center">{{$products->firstItem()+$key}}</td>
                      <td>{{$product->name}}</td>
                      <td>{{$product->description}}</td>
                      <td>{{$product->size}}</td>
                      <td>{{$product->price}}</td>
                      <td class="text-center"><img src="{{asset('images/product_image/'.$product->image)}}"  class="img-thumbnail" width="50px" height="50px"></td>
                      <td>{{$product->category->name}}</td>
                      <td>{{$product->active==1?"ใช้งาน":"ไม่ใช้งาน"}}</td>
                  <td nowrap><button class="btn btn-warning btn-sm"  id="edit" data-id="{{$product->id}}"><i class="fas fa-edit"></i>&nbsp;แก้ไข</button>
                  <button class="btn btn-danger btn-sm" {{$product->ProductItems()->count()>0?"disabled":""}}  id="delete" data-id="{{$product->id}}"><i class="fas fa-trash-alt"></i>&nbsp;ลบ</button>
                  </td>
                </tr>
                @empty
                <tr id="not_found"><td colspan="9" class="text-center">Not Found</td></tr>
              @endforelse

            </tbody>
    </table>
    {{ $products->links() }}
  </div>
