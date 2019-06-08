<div class="modal fade" id="update_data" tabindex="-1" role="dialog" aria-labelledby="update_dataLabel" aria-hidden="true">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="update_dataLabel">แก้ไขข้อมูล</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            {!! Form::open(['route' => 'product.update','id'=>'form-update','method' => 'post','files'=>'true']) !!}
                {{ Form::hidden('id',null,['id'=>'id']) }}
                <div class="form-group">
                    {!! Form::label('name', 'ชื่อสินค้า'); !!}
                    {!! Form::text('name',null,['class'=>'form-control','maxlength'=>'100']); !!}
                </div>      
                <div class="form-group">
                    {!! Form::label('description', 'คำอธิบาย'); !!}
                    {!! Form::textarea ('description',null,['class'=>'form-control','maxlength'=>'190','rows'=>'3']); !!}
                </div>
                <div class="form-group price">
                    {!! Form::label('price', 'ราคา'); !!}
                    {!! Form::text('price',null,['class'=>'form-control price_number','maxlength'=>'100']); !!}
                </div>  
                <div class="form-group">
                        {!! Form::label('size', 'ขนรดตัว'); !!}
                        {!! Form::select('size',['S'=>'S','M' => 'M', 'L' => 'L','XL'=>'XL','XXL'=>'XXL'],null,['class'=>'form-control','placeholder'=>'Please Choose...']); !!}
                </div>
                <div class="form-group">
                        {!! Form::label('category', 'หมวดหมู่'); !!}
                        {!! Form::select('category',$categories,null,['id'=>'category','class'=>'form-control','placeholder'=>'Please Choose...']); !!}
                </div>
                <div class="form-group">
                  {!! Form::label('image', 'รูปภาพ'); !!}
                  {!! Form::file('image',['class'=>'form-control']); !!}
              </div> 
              <div class="form-group">
                  {!! Form::label('active', 'สถานะการใช้งาน'); !!}
                  {!! Form::radio('active', '1','',['id'=>'active_1']); !!}ใช้งาน
                  {!! Form::radio('active', '0','',['id'=>'active_0']); !!}ไม่ใช้งาน
              </div>  
            </div>
            <div class="modal-footer">
              {!! Form::button('ปิด',['data-dismiss'=>'modal','class'=>'btn btn-secondary']); !!}
              {!! Form::button('แก้ไข',['class'=>'btn btn-success','type'=>'submit']); !!}
            </div>
            {!! Form::close()!!}
          </div>
        </div>
      </div>