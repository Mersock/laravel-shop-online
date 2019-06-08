@extends('layouts.main')

@section('title','ชำระเงิน')

@section('content')

<div class="row" style="margin-bottom:10%;">
    <div class="col-md-4 offset-md-3">
        <h3 class="pull-left">ชำระเงิน</h3>
    </div>
    <div class="col-md-6 offset-md-3">
        <form action="{{route('payment.store')}}" method="post" id="payment-form">
                {{csrf_field()}}
               
                <div class="payment-errors" style="color:red"></div>

                <div class="form-row">
                    <div class="form-group">
                    <label for="Card_number">Card number</label>
                        <input type="text"  data-stripe="number" class="form-control" data_attr="Card number">
                    </div>
                </div>
            
                <div class="form-row">
                    <div class="form-group">
                        <label for="Expiration">Expiration (MM)</label>
                        <input type="text"  data-stripe="exp_month" class="form-control" data_attr="Expiration (MM)">
                    </div>
                    &nbsp;
                    <div class="form-group">
                    <label for="Expiration">Expiration (YY)</label>
                    <input type="text"  data-stripe="exp_year" class="form-control" data_attr="Expiration (YY)">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="CVC">CVC</label>
                        <input type="text" data-stripe="cvc" class="form-control" data_attr="CVC">
                    </div>
                </div>
                {{-- <input type="submit" class="submit btn btn-primary" value="Submit Payment" > --}}
                <button class="submit btn btn-primary" ><i class="fas fa-credit-card"></i>&nbsp;ยืนยันการชำระเงิน</button>
            </form>
        </div>
</div>
@endsection
