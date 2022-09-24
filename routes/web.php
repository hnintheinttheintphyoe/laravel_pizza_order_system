<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\user\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Register,login

Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware([
    'auth'])->group(function () {
    
    Route::get('dashboard',[AuthController::class,'dashboard']); 
    Route::middleware(['admin_auth'])->group(function(){
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            //create category page
            Route::get('createPage',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            //delete category
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            //edit page
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            
            //category update
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
            
            });
            //admin 
        Route::prefix('admin')->group(function(){
           Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('password#adminchangePage');
           Route::post('change/password',[AdminController::class,'change'])->name('change#password');
           //account 
           Route::get('details',[AdminController::class,'details'])->name('admin#details');
           Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
           Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');
           //admin list
           Route::get('list',[AdminController::class,'list'])->name('admin#list');
           Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
           //with ajax change role
           Route::get('ajax/change/role',[AdminController::class,'ajaxChangeRole'])->name('admin#ajaxChangeRole');
           // or change role
           Route::get('changeRolePage/{id}',[AdminController::class,'changeRolePage'])->name('admin#changeRolePage');
           Route::post('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');

           //Admin order list
           Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
            Route::get('list/status',[OrderController::class,'listStatus'])->name('admin#listStatus');
            Route::get('ajax/status/change',[OrderController::class,'statusChange'])->name('order#ajaxStatusChange');
            Route::get('product/list/{orderCode}',[OrderController::class,'orderProductList'])->name('admin#orderProductList');
           });
        });  

        // products
        Route::prefix('products')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('prouct#delete');
            Route::get('detail/{id}',[ProductController::class,'detail'])->name('product#detail');
            Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        }); 
        Route::prefix('user')->group(function(){
          Route::get('list',[UserController::class,'userListPage'])->name('admin#userListPage');  
          Route::get('ajax/change/role',[UserController::class,'userChangeRole'])->name('admin#userChangeRole');
          Route::get('delete/{id}',[UserController::class,'userListDelete'])->name('admin#userListDelete');
          Route::get('updatePage/{id}',[UserController::class,'userUpdatePage'])->name('admin#userUpdatePage');
          Route::post('update',[UserController::class,'update'])->name('admin#userUpdate');
        });
        //contact
       Route::prefix('contact')->group(function(){
        Route::get('list',[ContactController::class,'list'])->name('contact#listPage');
        Route::get('view/{id}',[ContactController::class,'view'])->name('contact#view');
        Route::get('delete/{id}',[ContactController::class,'delete'])->name('contact#delete');
       }); 
            

        });
         //user home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
        // Route::get('home',function(){
        //     return view('user.home');
        // })->name('user#home');
        Route::get('home',[UserController::class,'home'])->name('user#home');
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::prefix('pizza')->group(function(){
         Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('pizza#details');
         Route::get('history',[UserController::class,'history'])->name('user#history');
        });
        Route::prefix('cart')->group(function(){
        Route::get('list',[UserController::class,'cartList'])->name('cart#list');
        });
        Route::prefix('password')->group(function(){
            Route::get('change',[UserController::class,'changePage'])->name('password#changePage');
            Route::post('change',[UserController::class,'change'])->name('password#change');

        });
       
        Route::prefix('account')->group(function(){
            Route::get('change',[UserController::class,'accountChangePage'])->name('account#changePage');
            Route::post('change/{id}',[UserController::class,'accountChange'])->name('account#change');
        });
        Route::prefix('contact')->group(function(){
            Route::get('page',[ContactController::class,'contactPage'])->name('contact#page');
            Route::post('sendMessage',[ContactController::class,'sendMessage'])->name('contact#sendMessage');
        });
        Route::prefix('ajax')->group(function(){
          Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
          Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
          Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
          Route::get('cart/clear',[AjaxController::class,'cartClear'])->name('ajax#cartClear');
          Route::get('delete',[AjaxController::class,'delete'])->name('ajax#delete');
          Route::get('user/viewCount',[AjaxController::class,'viewCount'])->name('ajax#userViewCount');
        });
  
    });
            

    });   
       
    Route::get('webTesting',function(){
        $data=[
            'message'=>'this is web testing'
        ];
        return response()->json($data,200);
    });
   

   


