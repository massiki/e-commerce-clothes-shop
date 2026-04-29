<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest('id')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.order.show', compact('order'));
    }

    public function deliver(Order $order)
    {
        if ($order->status !== 'ordered') {
            return redirect()->back()->with('error', 'Order cannot be delivered.');
        }

        $order->status = 'delivered';
        $order->delivered_date = now();
        $order->save();

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Order has been delivered.');
    }

    public function cancel(Order $order)
    {
        if ($order->status !== 'ordered') {
            return redirect()->back()->with('error', 'Order cannot be cancelled.');
        }

        $order->status = 'cancelled';
        $order->cancelled_date = now();
        $order->save();

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Order has been cancelled.');
    }
}
