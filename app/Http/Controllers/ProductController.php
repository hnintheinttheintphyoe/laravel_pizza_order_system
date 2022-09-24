<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
//product list page
public function list(){
    $pizzas=Product::select('products.*','categories.name as category_name')
           ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
    })->leftJoin('categories','products.category_id','categories.id')
    ->orderBy('products.created_at','desc')->paginate(3);
    
    $pizzas->appends(request()->all());
    return view('admin.product.pizzalist',compact('pizzas'));
}
//direct create page
public function createPage(){
    $categories=Category::select('id','name')->get();
    
    return view('admin.product.create',compact('categories'));
}
//direct create pizza product
public function create(Request $request){
    // dd($request->all());
    $this->productValidationCheck($request,'create');
    $data=$this->getPostData($request);
    $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
    $request->file('pizzaImage')->storeAs('public',$fileName);
    $data['image']=$fileName;
    Product::create($data);
    return redirect()->route('product#list');

}
//delete pizza
public function delete($id){
Product::where('id',$id)->delete();
return redirect()->route('product#list')->with('deleteSuccess','Pizza delete success ....');
}
//pizza details
public function detail($id){
    $pizza=Product::select('products.*','categories.name as category_name')
    ->leftJoin('categories','products.category_id','categories.id')
    ->where('products.id',$id)->first();
return view('admin.product.detail',compact('pizza'));
}
//pizza update page
public function updatePage($id){
$pizza=Product::where('id',$id)->first();
$category=Category::get();
return view('admin.product.update',compact('pizza','category'));
}
//pizza update
public function update(Request $request){
    $this->productValidationCheck($request,'update');
    $data=$this->getPostData($request);
    if($request->hasFile('pizzaImage')){
        $dbImage=Product::where('id',$request->pizzaId)->first();
        $dbImage=$dbImage->image;
        if($dbImage != null){
            Storage::delete('public/'.$dbImage);
        }
        $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image']=$fileName;
    }
    Product::where('id',$request->pizzaId)->update($data);
    return redirect()->route('product#list');
}
//get product data 
private function getPostData($request){
    return[
        'category_id'=>$request->pizzaCategory,
        'name'=>$request->pizzaName,
        'description'=>$request->pizzaDescription,
        'price'=>$request->pizzaPrice,
        'waiting_time'=>$request->pizzaWaitingTime

    ];
}
//pizza product validation check
private function productValidationCheck($request,$action){
    $validationRules=[
        'pizzaCategory' => 'required',
        'pizzaName'=>'required|min:5|unique:products,name,'.$request->pizzaId,
        'pizzaDescription'=>'required|min:10',
        
        'pizzaPrice'=>'required',
        'pizzaWaitingTime'=>'required'
    ];
    $validationRules['pizzaImage']=$action == 'create'? 'required|mimes:png,jpg,jpeg,webp|file': 'mimes:png,jpg,jpeg,webp|file';
   
    
  Validator::make($request->all(),$validationRules)->validate();
}
}
