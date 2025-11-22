<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Jobs\SendOrderMailJob;
use App\Models\Customer;


class OrderController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'items' => 'required|array',
        'items.*.item_id' => 'required|exists:items,id',
        'items.*.qty' => 'required|integer|min:1',
    ]);    

    
    $order = Order::create([
        'customer_id' => $request->user()->id,
        'total_amount' => 0,
    ]);

    $total = 0;

    foreach ($request->items as $data) {

        $item = Item::find($data['item_id']);
        $item_total = $item->price * $data['qty'];

        OrderDetail::create([
            'order_id' => $order->id,
            'item_id' => $data['item_id'],
            'quantity' => $data['qty'],
            'price' => $item_total,
        ]);

        $total += $item_total;
    }

    
    $order->update(['total_amount' => $total]);

    $orderDetails = OrderDetail::where('order_id', $order->id)->with('item')->get();
    $customer = $request->user();

    dispatch(new SendOrderMailJob($order, $orderDetails, $customer));

    return response()->json([
        'success' => true,
        'message' => 'Order Created',
        'order_id' => $order->id,
        'total_amount' => $total
    ]);
}

}
