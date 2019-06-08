@component('mail::message')
เลขที่สั่งซื้อ #{{$order->no}}

ได้ทำการจัดส่งสินค้าเรียบร้อยแล้ว
{{-- ราคารวม {{$order->total}} ฿ --}}
{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
