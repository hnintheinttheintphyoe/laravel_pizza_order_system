<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //redirect home page
    public function home(){
        $pizza=Product::orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $order=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','order'));
    }
    //admin user list page
    public function userListPage(){
        $userList=User::where('role','user')->paginate(2);
        // dd($userList->toArray());
        return view('admin.user.list',compact('userList'));
    }
    // user list delete
    public function userListDelete($id){
        User::where('id',$id)->delete();
        return back();

    }
    //direct user update page
    public function userUpdatePage($id){
        $user=User::where('id',$id)->first();
        // dd($user->toArray());
        return view('admin.user.update',compact('user'));
    } 
    public function update(Request $request){
       $this->accountValidationCheck($request);
        $user=$this->getAccountData($request);
        
        if($request->hasFile('image')){
       $dbImage=User::where('id',$request->userId)->first();
       $dbImage=$dbImage->image;
       $imageName=uniqid().$request->file('image')->getClientOriginalName();
       $request->file('image')->storeAs('public/',$imageName);
       $user['image']=$imageName;

        }
        User::where('id',$request->userId)->update($user);
        return redirect()->route('admin#userListPage')->with('updateSuccess','Update Success User List');
    }

    //ajax with user change role
    public function userChangeRole(Request $request){
        $userRole=['role'=>$request->role];
        User::where('id',$request->userId)->update($userRole);
    }
    //category list filter
    public function filter($categoryId){
      $pizza= Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
      $category=Category::get();
      $cart=Cart::where('user_id',Auth::user()->id)->get();
      $order=Order::where('user_id',Auth::user()->id)->get();
      return view('user.main.home',compact('pizza','category','cart','order'));
    }
    //redirect password change page
    public function changePage(){
        return view('user.account.changePassword');
    }
    //password change 
    public function change(Request $request){
        $this->passwordValidationCheck($request);
        $user=User::where('id',Auth::user()->id)->first();
        $dbHashValue=$user->password;
        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data=[
               'password'=>Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return back()->with('changeSuccess','Success Change Password!');
        }
        return back()->with('oldPassError','Old Password do not match.Try Again!');
    }
    //account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }
    //account Change
    public function accountChange($id,Request $request){
        $this->accountValidationCheck($request);
        $data=$this->getAccountData($request);
        if($request->hasFile('image')){
           $dbImage=User::where('id',$id)->first();
           $dbImage= $dbImage->image;
           if($dbImage != null){
            Storage::delete('public/'.$dbImage);
           }
           $imageFile=uniqid().$request->file('image')->getClientOriginalName();
           $request->file('image')->storeAs('public',$imageFile);
           $data['image']=$imageFile;
        }
        User::where('id',$id)->update($data);
        return back()->with('updateSuccess','Account Change Success!');
    }
    //direct pizza details page
    public function pizzaDetails($id){
        $data=Product::where('id',$id)->first();
        $pizzaList=Product::get();
        return view('user.main.details',compact('data','pizzaList'));
    }
    //direct cart list page
    public function cartList(){
        $cartList=Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image','products.id as product_id')
        ->leftJoin('products','products.id','carts.product_id')
        ->where('carts.user_id',Auth::user()->id)->get();
       
        $totalPrice=0;
        foreach ($cartList as $c) {
            $totalPrice +=$c->pizza_price*$c->qty;
        }
        // if($cartList->user_id == Auth::user()->id){
        //     $totalPrice +=$cartList->pizza_price*$cartList->qty;
        // }
        return view('user.main.cart',compact('cartList','totalPrice'));
    }
    //direct order history page
    public function history(){
        $order=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(3);
        return view('user.main.history',compact('order'));
    }
    
    //get account data
    private function getAccountData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender,

        ];

    }
    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
         'name'=>'required',
         'email'=>'required',
         'phone'=>'required',
         'address'=>'required',
         'gender'=>'required',
         'image'=>'mimes:png,jpg,jpeg,webp|file'
        ])->validate();
    }
    //password validation check
    private function passwordValidationCheck($request){
      Validator::make($request->all(),[
      'oldPassword'=>'required|min:6|max:15',
      'newPassword'=>'required|min:6|max:15',
      'confirmPassword'=>'required|min:6|max:15|same:newPassword'
      ])->validate();
    }
}
