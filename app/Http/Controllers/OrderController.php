<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    public function orderlist(){
        $orderlist = Order::select('orders.*','users.name as user_name')
                    ->orderby('orders.created_at','desc')
                    ->join('users','orders.user_id','users.id')
                    ->get();
        // dd($orderlist->toarray());
        return view('admin.order.orderlist',compact('orderlist'));
    }

    function ordersort(Request $request){
        // logger($request->all());
        $order = Order::select('orders.*','users.name as user_name')
            ->orderby('orders.created_at','desc')
            ->join('users','orders.user_id','users.id');
        if($request->status == 'all'){
             $order=$order->get();
        }else{
                $order = $order
                ->where('orders.status',$request->status)
                ->get();
       }
        return response()->json($order, 200);
    }
    // if($request->status == 'all'){
    //     return response()->json('hi', 200,);
    // };

}
