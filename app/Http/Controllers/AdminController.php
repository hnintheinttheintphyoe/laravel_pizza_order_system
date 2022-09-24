<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
public function changePasswordPage(){
    return view('admin.account.changePassword');
}
//change password
public function change(Request $request){
    $this->passwordValidationCheck($request);
   $user=User::select('password')->where('id',Auth::user()->id)->first();
    $dbHashValue=$user->password;
   if(Hash::check($request->oldPassword, $dbHashValue)){
    $hashPassword=[
        'password'=>Hash::make($request->newPassword)
    ];
    User::where('id',Auth::user()->id)->update($hashPassword);
    // Auth::logout();
    // return redirect()->route('auth#loginPage');
    return back()->with('changeSuccess','Password Change Success!');
    }
   return back()->with('oldPassError','old password do not match. Try again!');
   
   
}
//direct account datails
Public function details(){
    return view('admin.account.details');
}
//direct profile edit page
public function edit(){
    return view('admin.account.edit');
}
//account update
public function update($id,Request $request){
$this->accountValidationCheck($request);
$data=$this->getPostData($request);
if($request->hasFile('image')){
    $dbImage=User::where('id',$id)->first();
    $dbImage=$dbImage->image;
    if($dbImage != null){
        Storage::delete('public/'.$dbImage);
    }
    $fileName=uniqid().$request->file('image')->getClientOriginalName();
    $request->file('image')->storeAs('public',$fileName);
    $data['image']=$fileName;
    
}

User::where('id',$id)->update($data);
return redirect()->route('admin#details')->with('updateSuccess','Account data updated...');
}
//admin list page
public function list(){
    $admin=User::when(request('key'),function($query){
          $query->orWhere('name','like','%'.request('key').'%')
                ->orWhere('email','like','%'.request('key').'%')
                ->orWhere('phone','like','%'.request('key').'%')
                ->orWhere('address','like','%'.request('key').'%')
                ->orWhere('gender','like','%'.request('key').'%');
    })
           ->where('role','admin')->paginate(2);
           $admin->appends(request()->all());
    
    return view('admin.account.list',compact('admin'));
}
//with ajax change role
public function ajaxChangeRole(Request $request){
    logger($request->all());
    $user=User::where('id',$request->userId)->update([
        'role'=>$request->role
    ]);
    $response=[
        'message'=>'success'
    ];

    return response()->json($response,200);
    
}
public function delete($id){
   User::where('id',$id)->delete();
   return back()->with('deleteMessage','Admin list deleted..');
}
//admin change role page
// public function changeRolePage($id){
//     $changeRole=User::where('id',$id)->first();
// return view('admin.account.changeRole',compact('changeRole'));
// }
//admin change
// public function changeRole($id,Request $request){
// $data=$this->getRoleData($request);
// User::where('id',$id)->update($data);
// return redirect()->route('admin#list');
// }
private function getRoleData($request){
return[
    'role'=>$request->role
];
}
//account post data
private function getPostData($request){
return[
    'name'=>$request->name,
     'email'=>$request->email,
     'phone'=>$request->phone,
     'gender'=>$request->gender,
     'address'=>$request->address,
     'updated_at'=>Carbon::now()
];
}
//accout update validation check
private function accountValidationCheck($request){
Validator::make($request->all(),[
    'name'=>'required',
    'email'=>'required',
    'phone'=>'required',
    'gender'=>'required',
    'address'=>'required',
    'image'=>'mimes:png,jpg,jpeg,webp'
])->validate();
}
//password validation check
private function passwordValidationCheck($request){
Validator::make($request->all(),[
    'oldPassword'=>'required|min:6|max:10',
    'newPassword'=>'required|min:6|max:10',
    'confirmPassword'=>'required|min:6|max:10|same:newPassword'
])->validate();
}
}
