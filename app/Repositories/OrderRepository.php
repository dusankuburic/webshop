<?php
namespace App\Repositories;
use App\Repositories\Interfaces\OrderRepositoryInterface;

use Illuminate\Support\Facades\DB;

use App\OrderPart;
use App\Order;
use App\User;
use App\Product;

use Session;



class OrderRepository implements OrderRepositoryInterface {


    public function all(){

        return Order::orderBy('created_at','desc')->paginate(10);
    }

    public function allWithUsers(){

        $orders = Order::orderBy('created_at','desc')->paginate(10);

        foreach($orders as $order){
            $order['user'] = User::findOrFail($order->user_id);
        }
        
        return $orders;
    }

    public function saveTheOrder($request){

        $cart = Session::get('auth()->user()->id');
 

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'message' => $request->input('message')
        ]);


        foreach($cart as $key => $value){

            OrderPart::create([
                'order_id' => $order->id,
                'product_id' => $cart[$key]['product_id'],
                'quantity' => $cart[$key]['quantity']
            ]);
        }

        Session::put('auth()->user()->id', []);  
    }

    public function customerOrders($customer_id){
        
        return DB::table('orders')
            ->where('user_id',$customer_id)
            ->paginate(10);
    }

    public function customerOrderDetails($customer_id){


        $order = Order::findOrFail($customer_id);
        $orderParts = OrderPart::where('order_id',$order->id)->get();
        $toPay = 0;

        foreach($orderParts as $part){
            $part['product'] = Product::findOrFail($part->product_id);
        }

        foreach($orderParts as $part){
            $toPay += $part->product->price * $part->quantity;
        }

    
        $orderDetails = [
            'order' => $order,
            'orderParts' => $orderParts,
            'topay' => $toPay
        ];

        return $orderDetails;
    }


    public function delete($order_id){

        $parts = OrderPart::where('order_id', $order_id);
        $parts->delete();

        $order = Order::where('id',$order_id);
        $order->delete();
    }
}