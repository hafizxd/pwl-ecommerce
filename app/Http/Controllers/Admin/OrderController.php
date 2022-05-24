<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function detail($id) {
        $order = Order::findOrFail($id);

        return view('admin.orders.detail', compact('order'));
    }

    public function confirm($id) {
        $order = Order::where('is_shipped', 0)->findOrFail($id);

        $order->update([
            'is_shipped' => 1,
            'is_shipped_at' => Carbon::now()
        ]);

        return redirect()->route('admin.order');
    }
}
