<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,diproses,dikirim,selesai,dibatalkan'],
        ]);

        $order->update($data);

        return back()->with('success', "Status order #{$order->id} diubah menjadi {$data['status']}.");
    }

    public function destroy(Order $order)
    {
        $order->delete(); // order_items ikut terhapus (cascadeOnDelete)

        return back()->with('success', "Order #{$order->id} dihapus.");
    }
}
