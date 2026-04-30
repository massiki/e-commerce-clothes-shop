<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $orders = Order::where('user_id', $userId)->latest()->paginate(10);
        return view('user.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('user.order.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        if ($order->status !== 'ordered') {
            return redirect()->back()->with('error', 'Order cannot be cancelled.');
        }

        $order->status = 'cancelled';
        $order->cancelled_date = now();
        $order->save();

        return redirect()->route('user.orders.show', $order->id)->with('success', 'Order has been cancelled.');
    }
}
