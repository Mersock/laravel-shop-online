@extends('layouts.admin.main')

@section('content-admin')
<h3>หมวดหมู่สินค้า</h3>
<div class="row">
    <div class="col-9">
            <div class="card">
                    <div class="card-header">
                        หมวดหมู่สินค้า
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">

                    <table class="table table-bordered table-striped table-hover" width="100%">
                            <th scope="col" width="5%" class="text-center">ลำดับ</th>
                            <th scope="col" width="55%" class="text-center">ชื่อหมวดหมู่สินค้า</th>  
                            <th scope="col" width="30%" class="text-center">แก้ไข</th>   
                            <th scope="col" width="10%" class="text-center">ลบ</th>                  
                        @forelse($categories as $key => $category)
                            <tr>
                                <td class="text-center">{{$key+1}}</td>
                                <td>{{$category->name}}</td>
                                <td class="text-center">
                                        {{Form::open(['route'=>['category.update',$category->id],'method'=>'PUT','class'=>'form-inline'])}}            
                                        {{Form::text('name',null,['class'=>'form-control form-control-sm','maxlength'=>'190','required'])}}
                                        &nbsp;
                                        {{Form::button('<i class="fas fas fa-edit"></i>&nbsp;แก้ไข',['type'=>'submit','class'=>'btn btn-warning btn-sm'])}}
                                        {{Form::close()}}     
                                </td>
                                <td>
                                        {{Form::open(['route'=>['category.destroy',$category->id],'method'=>'DELETE'])}}
                                        {{Form::button('<i class="fas fa-trash-alt"></i>&nbsp;ลบ',['type'=>'submit','class'=>'btn btn-danger btn-sm',$category->product()->count()>0?'disabled':''])}}
                                        {{Form::close()}}
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="2">ไม่พบหมวดหมู่สินค้า</td></tr>
                        @endforelse
                    </table>
                    </div>
                  </div>
    </div>
    <div class="col-3">
            <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">เพิ่มหมวดหมู่สินค้า</h5>
                        {{Form::open(['route'=>'category.store','method'=>'post'])}}
                        {{Form::label('name','ชื่อหมวดหมู่')}}
                        {{Form::text('name',null,['class'=>'form-control','maxlength'=>'190','required'])}}
                        <br>
                        {{Form::button('บันทีก',['type'=>'submit','id'=>'save','class'=>'btn btn-success'])}}
                        {{Form::close()}}
                    </div>
            </div>
    </div>

</div>
@endsection
@section('script-admin')
<script>
$(document).ready(function(){

});
</script>
@endsection