<?php

namespace App\Http\Controllers;

use App\Models\Order;

class InvoiceController extends Controller
{
    public function show($order_code)
    {
        $order = Order::with('items.service', 'items.game')
            ->where('order_code', $order_code)
            ->firstOrFail();

        if ($order->status === Order::STATUS_PENDING) {
            return redirect()->route('payment.show', $order->order_code);
        }
        if ($order->status === Order::STATUS_PAID) {
            return redirect()->route('account.show', $order->order_code);
        }

        $title = 'Invoice';

        // Generate link WA konfirmasi
        $waNumber = \App\Models\Setting::get('wa_number', '6281998060507');
        $text = "Halo Admin, saya sudah bayar dan isi data akun untuk order:\n\n"
              . "Kode Order: {$order->order_code}\n"
              . "Total: Rp " . number_format($order->total_price, 0, ',', '.') . "\n\n"
              . "Mohon dikonfirmasi ya. Terima kasih!";
        $waLink = "https://wa.me/{$waNumber}?text=" . urlencode($text);

        return view('public.invoice', compact('order', 'title', 'waLink'));
    }
}