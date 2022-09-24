<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //direct contact page
    public function contactPage(){
       
     return view('user.contact.contact');
    }
    //data send
    public function sendMessage(Request $request){
        
        $this->contactValidationCheck($request);
        $data=$this->getContactData($request);
        Contact::create($data);
        return back()->with('sendSuccess','Success! you sent message...');
    }
    //direct list page
    public function list(){
        $contact=Contact::when(request('key'),function($query){
        $query->orWhere('name','like','%'.request('key').'%')
               ->orWhere('email','like','%'.request('key').'%')
               ->orWhere('created_at','like','%'.request('key').'%');
        })
        ->orderBy('created_at','desc')
        ->paginate(3);
        
        return view('admin.contact.list',compact('contact'));
    }
    //direct list view
    public function view($id){
     $contact=Contact::where('id',$id)->first();
     return view('admin.contact.view',compact('contact'));
    }
    //contact list delete
    public function delete($id){
     Contact::where('id',$id)->delete();
     return back()->with('deleteSuccess','Success contact  list delete...');
    }
    //contact validation check
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'message'=>'required'
            
        ])->validate();
    }
    private function getContactData($request){
    return[
        'name'=>$request->name,
        'email'=>$request->email,
        'message'=>$request->message
    ];
    }
}
