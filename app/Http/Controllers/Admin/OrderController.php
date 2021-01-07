<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 订单管理视图
    public function toOrder(Request $request){
        return view('admin.order.order');
    }

    // 订单报表视图
    public function toOrderForm(Request $request){
        return view('admin.order.order_form');
    }
}
