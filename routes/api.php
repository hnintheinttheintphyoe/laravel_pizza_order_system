<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//get

Route::get('category/list',[RouteController::class,'categoryList']);//R
Route::get('order/list',[RouteController::class,'orderList']);
Route::get('contact/list',[RouteController::class,'contactList']);

//post
Route::post('create/category',[RouteController::class,'createCategory']);//C
Route::post('create/contact',[RouteController::class,'createContact']);
Route::get('category/delete/{id}',[RouteController::class,'categoryDelete']);//D
Route::get('category/list/{id}',[RouteController::class,'categoryDetails']);//R
Route::post('category/update',[RouteController::class,'categoryUpdate']);//U
//product
Route::get('product/list',[RouteController::class,'productList']);

//get product list
//http://127.0.0.1:8000/api/category/list(GET)
//http://127.0.0.1:8000/api/create/category(POST)|name
//http://127.0.0.1:8000/api/category/list/{id}(GET)
//http://127.0.0.1:8000/api/category/delete/{id}(GET)
//http://127.0.0.1:8000/api/category/update(POST)|category_id,category_name