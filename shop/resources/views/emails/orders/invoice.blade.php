@component('mail::message')
# Cảm ơn bạn đã đặt hàng!

Đơn hàng **#{{ $order->order_code }}** của bạn đã được tạo thành công.

Bạn có thể xem hóa đơn đính kèm trong email này.

Thanks,<br>
@endcomponent
