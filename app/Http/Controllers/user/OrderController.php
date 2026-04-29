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
        $orders = Order::where('user_id', $userId)->paginate(10);
        return view('user.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('user.order.show', compact('order'));
    }
}
