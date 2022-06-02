<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orderList(){

        // $data = Order::select('orders.*','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
        //                 ->join('users','users.id','orders.customer_id')
        //                 ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
        //                 ->groupBy('orders.customer_id','orders.pizza_id','pizza.orders.order_id','pizza.orders.carrier_id','pizza.orders.payment_status','pizza.orders.order_time','pizza.orders.created_at','pizza.orders.updated_at','pizza.users.name','pizza.pizzas.pizza_name')
        //                 ->paginate(7);

        // $data = Order::select('orders.*','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
        //                 ->join('users','users.id','orders.customer_id')
        //                 ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
        //                 ->paginate(7);

        // $data = $data->groupBy('orders.customer_id','orders.pizza_id','pizza.orders.order_id','pizza.orders.carrier_id','pizza.orders.payment_status','pizza.orders.order_time','pizza.orders.created_at','pizza.orders.updated_at','pizza.users.name','pizza.pizzas.pizza_name');
        // dd($data->toArray());

        // $data = Order::select('order.*')->groupBy('orders.customer_id','orders.pizza_id','pizza.orders.order_id','pizza.orders.carrier_id','pizza.orders.payment_status','pizza.orders.order_time','pizza.orders.created_at','pizza.orders.updated_at','pizza.users.name');

        // $datatwo = $data->groupby('categories.category_id');
        $data = Order::orderBy('orders.order_id','desc')->select('orders.order_time','orders.order_id','orders.customer_id','orders.pizza_id','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
                           ->join('users','users.id','orders.customer_id')
                           ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
                           ->groupBy('orders.customer_id','orders.pizza_id')
                           ->paginate();

        // dd($data->toArray());
        return view('admin.order.list')->with(['order'=>$data]);
    }

    public function orderSearch(Request $request)
    {

        $data = Order::select('orders.*','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
                    ->join('users','users.id','orders.customer_id')
                    ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
                    ->orWhere('users.name','like','%'.$request->searchData.'%')
                    ->orWhere('pizzas.pizza_name','like','%'.$request->searchData.'%')
                    ->groupBy('orders.customer_id','orders.pizza_id','pizza.orders.order_id','pizza.orders.carrier_id','pizza.orders.payment_status','pizza.orders.order_time','pizza.orders.created_at','pizza.orders.updated_at','pizza.users.name','pizza.pizzas.pizza_name')
                    ->paginate(7);

        // dd($data->toArray());
        // $data->appends($request->all());
        
        return view('admin.order.list')->with(['order'=>$data]);

    }




}
