<?php


use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//login register
Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'login', );
    Route::get('login',[AuthController::class,'loginPage'])->name('Auth#login');
    Route::get('register',[AuthController::class,'registerPage'])->name('Auth#register');
});

//



Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    //admin

    Route::middleware(['admin_auth'])->group(function () {
        Route::prefix('category')->group(function () {
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('create/page',[CategoryController::class,'createpage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update',[Categorycontroller::class,'update'])->name('category#update');
        });

        Route::prefix('admin')->group(function(){
            // password
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class,'changepassword'])->name('admin#changepassword');

            // profile
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changerole/{id}',[AdminController::class,'changerole'])->name('admin#changerole');
            Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');

        });
        Route::prefix('products')->group(function () {
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::get('update/{id}',[ProductController::class,'updatepage'])->name('product#updatepage');
            Route::post('updareppage',[ProductController::class,'update'])->name('product#update');

        });
        // order list
        Route::prefix('order')->group(function () {
           Route::get('order/list',[OrderController::class,'orderlist'])->name('admin#order');
           Route::get('ajax/ordersort',[OrderController::class,'ordersort'])->name('admin#ordersort');
        });

    });


    //user

    Route::prefix('user')->middleware('user_auth')->group(function () {
        Route::get('home',[UserController::class,'home'])->name("user#home");
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('history',[UserController::class,'history'])->name('user#history');

        Route::prefix('pizza')->group(function(){
            Route::get('detail/{id}',[UserController::class,'detail'])->name('pizza#detail');
        });

        Route::prefix('cart')->group(function(){
            Route::get('cartlist',[UserController::class,'cartlist'])->name('user#cart');
        });

        Route::prefix('password')->group(function () {
            Route::get('change',[UserController::class,'changepasswordpage'])->name('user#changepasswordpage');
            Route::post('changepassword',[UserController::class,'changepassword'])->name('user#changepassword');
        });
        Route::prefix('profile')->group(function () {
            Route::get('accountchangepage',[UserController::class,'accountchangepage'])->name('user#accountchangepage');
            Route::post('accountchange/{id}',[UserController::class,'accountchange'])->name('profile#accountchange');
        });


        Route::prefix('ajax')->group(function () {
            Route::get('pizza/list',[AjaxController::class,'pizzalist'])->name('ajax#pizzalist');
            Route::get('cart',[AjaxController::class,'addtocard'])->name('ajax#cart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/cart',[AjaxController::class,'clearcart'])->name('ajax#clear');
            Route::get('clear/current/product',[AjaxController::class,'clearproduct'])->name('ajax#clearproduct');
        });
    });
});
