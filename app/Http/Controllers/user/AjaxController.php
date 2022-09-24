<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Log\Logger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
    //    logger($request->status);
        if($request->status == 'asc'){
            $data=Product::orderBy('created_at','asc')->get();
       
        }
        else{
            $data=Product::orderBy('created_at','desc')->get();
        }
        return $data;
    }
    // add to cart pizza
    public function addToCart(Request $request){
    // logger($request->all());
    $data=$this->getOrderData($request);
//    logger($data);
    Cart::create($data);
    $response=[
        'message'=>'Add To Cart Complete',
        'status'=>'success'
    ];
    return response()->json($response,200);
    }
    
    //order
    public function order(Request $request){
        // logger($request->all());
        $total=0;
        foreach ($request->all() as $item) {
         $data=  OrderList::create([
            'user_id'=>$item['userId'],
            'product_id'=>$item['productId'],
            'total'=>$item['total'],
            'qty'=>$item['qty'],
            'order_code'=>$item['orderCode'],
           ]);
        $total+=$data->total;
           
        }
        
        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([  
            'user_id'=>Auth::user()->id,
            'order_code'=>$data->order_code,
            'total_price'=>$total+3000  

        ]);
        return response()->json([
            'status'=>'true',
            'message'=>'order complete'
        ],200);
    }
    //clear cart
    public function cartClear(Request $request){
    Cart::where('user_id',Auth::user()->id)->delete();
    }
    //delete cart item
    public function delete(Request $request){
        Cart::where('id',$request->cartId)
             ->where('user_id',$request->userId)
             ->where('product_id',$request->productId)
        ->delete();
    }
    //increase user view count
    public function viewCount(Request $request){
    $pizza=Product::where('id',$request->productId)->first();
    $viewCount=['view_count'=>$pizza->view_count+1];
    Product::where('id',$request->productId)->update($viewCount);

    }
    //get order data
    private function getOrderData($request){
     return[
        'user_id'=>$request->userId,
        'product_id'=>$request->pizzaId,
        'qty'=>$request->count,
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now(),
     ];
    }
}
