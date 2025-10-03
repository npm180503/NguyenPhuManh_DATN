<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class OrderInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $pdf;
    protected $filename;

    public function __construct($order)
    {
        $this->order = $order;
        Log::info($this->order);
        // Tạo PDF ngay khi gửi email
        $this->pdf = PDF::loadView('admin.order.invoice', compact('order'))
            ->setPaper('A4', 'portrait');
    }

    public function build()
    {
        $filename = 'hoadon_' . $this->order->order_code . '.pdf';

        return $this->subject('Hóa đơn đơn hàng #' . $this->order->order_code)
            ->markdown('emails.orders.invoice')
            ->attachData($this->pdf->output(), $filename, [
                'mime' => 'application/pdf',
            ]);
    }
}
