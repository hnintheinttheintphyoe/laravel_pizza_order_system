<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //redirect order list page
    public function orderList(){
        $orderList=Order::select('orders.*','users.name as user_name')
                  ->when(request('key'),function($query){
                    $query->orWhere('users.name','like','%'.request('key').'%')
                    ->orWhere('orders.total_price','like','%'.request('key').'%');
                  })
                  ->leftJoin('users','users.id','orders.user_id')
                  ->orderBy('created_at','desc')
                  ->get();
                 
        return view('admin.order.list',compact('orderList'));
    }
    public function listStatus(Request $request){
     
    
    $orderList=Order::select('orders.*','users.name as user_name')
                  ->leftJoin('users','users.id','orders.user_id')
                  ->orderBy('created_at','desc');
     if($request->orderStatus == ''){
        $orderList=$orderList->get();
     }
     else{
        $orderList=$orderList->where('status',$request->orderStatus)
                             ->get();
     }
     return view('admin.order.list',compact('orderList'));
                  
    }
    //ajax status change
    public function statusChange(Request $request){
   Order::where('id',$request->orderId)->update(
          ['status'=>$request->status]
   );
    }
    //direct order product list
    public function orderProductList($orderCode){
        $orderList=OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.name as product_name')
        ->leftJoin('users','users.id','order_lists.user_id')
        ->leftJoin('products','products.id','order_lists.product_id')
        ->where('order_code',$orderCode)->get();
        $order=Order::where('order_code',$orderCode)->first();
        
        // dd($orderList->toArray());
        return view('admin.order.productList',compact('orderList','order'));
    }
}
