<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DateTime;

use \App\Order;

class OrderController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('orders.index');
    }

    public function getOrders(Request $request) {
        $date = date_create($request->date);
        $date = date_format(new \DateTime($request->date), 'Y-m-d');
        if(isset($request->date)){
            $orders = Order::orderBy('required_date','desc')
            ->where('required_date', $date)
            ->with('user','products')
            ->get();
        }else{
            $orders = Order::orderBy('required_date','desc')
            ->with('user','products')
            ->get();
        }
        $data = array();
        foreach($orders as $order) {
            $total = $order->products->map(function ($product, $key) {
                return $product->price * $product->pivot->quantity;
            })->sum();

            $data[] = array(
                "id" => $order->id,
                "status" => $order->status,
                "total" => $total,
                "date" => $order->created_at,
                "userId" => $order->user->id,
                "userName" => $order->user->name,
                "products" => $order->products
            );
        }
        return response()->json($data);
    }

    public function show($id) {
        return view('orders.show', compact('id'));
    }

    public function getOrderById($id){
        $order = Order::find($id)->with('user','products', 'products.vendor')->first();
        return response()->json($order);
    }

}
