<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::latest('id')->take(5)->get();
        $totalOrders = Order::count();

        $totalDelivered = Order::where('status', 'delivered')->count();
        $totalDeliveredAmount = Order::where('status', 'delivered')->sum('total');

        $totalCancelled = Order::where('status', 'cancelled')->count();
        $totalCancelledAmount = Order::where('status', 'cancelled')->sum('total');

        $totalOrdered = Order::where('status', 'ordered')->count();
        $totalOrderedAmount = Order::where('status', 'ordered')->sum('total');

        $totalAmount = Order::sum('total');

        return view('admin.index', compact(
            'orders',
            'totalOrders',
            'totalDelivered',
            'totalDeliveredAmount',
            'totalCancelled',
            'totalCancelledAmount',
            'totalOrdered',
            'totalOrderedAmount',
            'totalAmount'
        ));
    }
}
