<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Orderlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //
    public function pizzalist(Request $request){

        $data = Product::orderby('created_at',$request->status)->get();
        return $data;
    }


    function addtocard(Request $request){
        $data = $this->ajaxdata($request);
        Cart::create($data);

        $respond = [
            'status' => 'success'
        ];
        return response()->json($respond, 200);
    }

    public function order(Request $request){

        $total = 0;
        foreach ($request->all() as $items) {


            $data = $items;
            // [
            //     'user_id' => $items['user_id'],
            //     'product_id' => $items['product_id'],
            //     'qty' => $items['qty'],
            //     'total' => $items['total'],
            //     'order_code' => $items['order_code'],
            // ]
            Orderlist::create( $data );
            $total += $data['total'];

        }
        Cart::where('user_id',Auth::user()->id)->delete();




        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code' => $data['order_code'],
            'total_price' => $total + 5000
        ]);

        return response()->json([
            'status' => 'success',

        ], 200);


    }
    function clearcart(){
        Cart::where('user_id',Auth::user()->id)->delete();

    }

    // clear current product
    function clearproduct(Request $request){
        // logger($request->all());
        Cart::where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->where('id',$request->orderid)->delete();

    }

    // get data from ajax
    private function ajaxdata($request){
        return [
            'user_id' => $request->userid,
            'product_id' => $request->product_id,
            'qty' => $request->count
        ];
    }
}
