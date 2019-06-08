@extends('layouts.main')

@section('title','ที่อยู่ในการจัดส่ง')

@section('content')
<div class="row">
    <div class="col-md-4 offset-md-4 align-self-center" style="margin-top:10px">
            <h3>ที่อยู่ในการจัดส่ง</h3>
    @forelse ($address as $add)    
            {!! Form::open(['route'=>['address.update',$add->id],'method'=>'PUT','id'=>'frm-addr']) !!}
            <div class="from-group">
                {!! Form::label('address_line','ที่อยู่') !!}
                {!! Form::text('address_line',$add->address_line,['class'=>'form-control valid','attr_name'=>'ที่อยู่']) !!}
            </div>
            <div class="from-group">
                {!! Form::label('state','ตำบล/แขวง') !!}
                {!! Form::text('state',$add->state,['class'=>'form-control valid','attr_name'=>'ตำบล/แขวง']) !!}          
            </div>
            <div class="from-group">
                {!! Form::label('city','อำเภอ/เขต') !!}
                {!! Form::text('city',$add->city,['class'=>'form-control valid','attr_name'=>'อำเภอ/เขต']) !!}        
            </div>
            <div class="from-group">
                {!! Form::label('country','จังหวัด') !!}
                {!! Form::text('country',$add->country,['class'=>'form-control valid','attr_name'=>'จังหวัด']) !!}             
            </div>
            <div class="from-group">
                {!! Form::label('zip','รหัสไปรษณีย์') !!}
                {!! Form::text('zip',$add->zip,['class'=>'form-control valid','attr_name'=>'รหัสไปรษณีย์','maxlength'=>'5']) !!}           
            </div>
            <div class="from-group">
                {!! Form::label('phone','เบอร์โทรศัพท์') !!}
                {!! Form::text('phone',$add->phone,['class'=>'form-control valid','attr_name'=>'เบอร์โทรศัพท์']) !!}             
            </div>    
            <br>
            <div class="from-group" style="margin-bottom:20px;">
            {!! Form::button('<i class="fas fa-check-circle"></i>&nbsp;ตกลง',['class'=>'btn btn-success check_valid']) !!}
            </div>
            {!! Form::close() !!}
     @empty   
        {!! Form::open(['route'=>'address.store','method'=>'post','id'=>'frm-addr']) !!}
        <div class="from-group">
                {!! Form::label('address_line','ที่อยู่') !!}
                {!! Form::text('address_line',null,['class'=>'form-control valid','attr_name'=>'ที่อยู่']) !!}
            </div>
            <div class="from-group">
                {!! Form::label('state','ตำบล/แขวง') !!}
                {!! Form::text('state',null,['class'=>'form-control valid','attr_name'=>'ตำบล/แขวง']) !!}          
            </div>
            <div class="from-group">
                {!! Form::label('city','อำเภอ/เขต') !!}
                {!! Form::text('city',null,['class'=>'form-control valid','attr_name'=>'อำเภอ/เขต']) !!}        
            </div>
            <div class="from-group">
                {!! Form::label('country','จังหวัด') !!}
                {!! Form::text('country',null,['class'=>'form-control valid','attr_name'=>'จังหวัด']) !!}             
            </div>
            <div class="from-group">
                {!! Form::label('zip','รหัสไปรษณีย์') !!}
                {!! Form::text('zip',null,['class'=>'form-control valid','attr_name'=>'รหัสไปรษณีย์','maxlength'=>'5']) !!}           
            </div>
            <div class="from-group">
                {!! Form::label('phone','เบอร์โทรศัพท์') !!}
                {!! Form::text('phone',null,['class'=>'form-control valid','attr_name'=>'เบอร์โทรศัพท์']) !!}             
            </div>    
        <br>
        <div class="from-group" style="margin-bottom:20px;">
        {!! Form::button('<i class="fas fa-check-circle"></i>&nbsp;ตกลง',['class'=>'btn btn-success check_valid']) !!}
        </div>
        {!! Form::close() !!}        
     @endforelse

    </div>

</div>
@endsection
@section('script')
<script>
$(document).ready(function(){
    $(".check_valid").click(function(){
        var i = 0;
        $('.valid').each(function(){
            var value = $(this).val();
            var attrname = $(this).attr('attr_name');
            var id_input = $(this).attr('id');
            if(value==""){
                i++;
                swal("กรุณาระบุ "+attrname,'', "warning"); 
                $("#"+id_input).focus();
            }
        });
        if(i==0){
            $("#frm-addr").submit();
        }
    });

    
    $('#phone').keyup(function(e){
        var ph = this.value.replace(/\D/g,'').substring(0,10);
        var deleteKey = (e.keyCode == 8 || e.keyCode == 46);
        var len = ph.length;
        if(len==0){
            ph=ph;
        }else if(len<=3){
            ph=ph;
        }else if(len<=6){
            ph=ph.substring(0,3)+'-'+ph.substring(3,6);
        }else{
            ph=ph.substring(0,3)+'-'+ph.substring(3,6)+'-'+ph.substring(6,10);
        }
        this.value = ph;
    });

     
}); 
</script>
@endsection