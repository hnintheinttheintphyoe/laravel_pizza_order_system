<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get product data
    // public function productList(){
    //     $product=Product::get();
    //     $user=User::get();
    //     $data=[
    //         'product'=>$product,
    //         'user'=>$user
    //     ];
    //     return $data['product'][0]['name'];
    //     return response()->json($data,200);
    // }
    //get category data
    public function categoryList(){
        $category=Category::orderBy('id','desc')->get();
        return response()->json($category,200);
    }
    //get order data
    public function orderList(){
        $orderList=OrderList::get();
        $order=Order::get();
        $data=[
            'orderList'=>$orderList,
            'order'=>$order
        ];
        return response()->json($data,200);
    }
    public function contactList(){
        $contactList=Contact::get();
        return response()->json($contactList,200);
    }
    //create category
    public function createCategory(Request $request){
        // dd($request->all());
        $data=[
            'name'=>$request->name,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
        
        $response=Category::create($data);
        return response()->json($response,200);
    }
    //delete category data
    public function categoryDelete($id){
        
        $category=Category::where('id',$id)->first();
       if(isset($category)){
        $data=Category::where('id',$id)->delete();
       return response()->json(['status'=>'true','message'=>'category deleted..','deleteData'=>$category],200);
       }
       return response()->json(['status'=>'false','message'=>'There is no data'],200);
    }
    public function createContact(Request $request){
        // dd($request->all());
        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
        $response=Contact::create($data);
        return response()->json($response,200);
    }
    //get category details
    public function categoryDetails($id){
        $data=Category::where('id',$id)->first();
    if(isset($data)){
        
        return response()->json(['status'=>'true','category'=>$data],200);
    }
    return response()->json(['status'=>'true','category'=>'There is no category data...'],200);
    
    }
    //get category update
    public function categoryUpdate(Request $request){
    $category=Category::where('id',$request->category_id)->first();
    if(isset($category)){
     $data=$this->getCategoryData($request);
     Category::where('id',$request->category_id)->update($data);
     $response=Category::where('id',$request->category_id)->first();
     return response()->json(['status'=>'true','message'=>'catagory update success...','cartegory'=>$response],200);
    }
    return response()->json(['status'=>'false','message'=>'There is no data...'],500);
    } 
    private function getCategoryData($request){
        return[
            'name'=>$request->category_name,
            'updated_at'=>Carbon::now()
        ];
    }
    //get product list
    public function productList(){
        $data=Product::orderBy('id','desc')->get();
        return response()->json($data,200);
    }
}
