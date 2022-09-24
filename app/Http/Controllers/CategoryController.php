<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //category list page
    public function list(){
        
        $categories=Category::when(request('key'),function($query){
                    $query->where('name','like','%'.request('key').'%');
                    })->orderBy('id','desc')->paginate(4);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }
    //category create page
    public function createPage(){
        return view('admin.category.create');
    }
    //category create
    public function create(Request $request){
  $this->requestCategoryValidation($request);
  $data=$this->getPostData($request);
  Category::create($data);
  return redirect()->route('category#list');
    }
    //category delete
    public function delete($id){
     Category::where('id',$id)->delete();
     return back()->with('deleteMessage','Category Deleted....');
    }
    //category edit page
    public function edit($id){
       $category= Category::where('id',$id)->first();
       
    return view('admin.category.edit',compact('category'));
    }
    //category update
    public function update(Request $request){
    //    dd($request->all()); 
    $this->requestCategoryValidation($request);
    $data=$this->getPostData($request);
    Category::where('id',$request->categoryId)->update($data);
    return redirect()->route('category#list');
    }
    //validation category item
    private function requestCategoryValidation($request){
        Validator::make($request->all(),
        ['categoryName' => 'required|min:4|unique:categories,name,'.$request->categoryId]
    )->validate();
    }
    //request post data
    private function getPostData($request){
    return [
        'name'=>$request->categoryName
    ];
    }
}
