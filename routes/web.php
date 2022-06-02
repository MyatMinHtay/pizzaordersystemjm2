<?php

use App\Http\Middleware\AdminCheckMiddleWare;
use App\Http\Middleware\UserCheckMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin#profile');
            }else if(Auth::user()->role == 'user'){
                return redirect()->route('user#index');
            }
        }
        // return view('dashboard');
    })->name('dashboard');
});


Route::group(['prefix' => 'admin','namespace'=>'Admin','middleware'=>[AdminCheckMiddleWare::class]] , function(){
    // Rute တစ္ခုတည္း middleware ထိန္းခ်င္တယ္ဆိုရင္ 
    Route::get('profile','AdminController@profile')->name('admin#profile')->middleware(AdminCheckMiddleWare::class);
    Route::post('update/{id}','AdminController@updateProfile')->name('admin#updateProfile');
    Route::get('changepassword','Admincontroller@changepasswordpage')->name('admin#changepasswordpage');
    Route::post('changepassword/{id}','Admincontroller@changepassword')->name('admin#changepassword');
    

    Route::get('category','CategoryController@category')->name('admin#category'); //list
    Route::get('addCategory','CategoryController@addCategory')->name('admin#addCategory'); 
    Route::post('createCategory','CategoryController@createCategory')->name('admin#createCategory');
    Route::get('deleteCategory/{id}','CategoryController@deleteCategory')->name('admin#deleteCategory');
    Route::get('editCategory/{id}','CategoryController@editCategory')->name('admin#editCategory');
    Route::post('updateCategory','CategoryController@updateCategory')->name('admin#updateCategory');
    Route::get('category/search','CategoryController@searchCategory')->name('admin#searchCategory');
    Route::get('categoryItem/{id}','PizzaController@categoryItem')->name('admin#categoryItem');
    Route::get('category/download','CategoryController@categoryDownload')->name('admin#categoryDownload');

    Route::get('pizza','PizzaController@pizza')->name('admin#pizza');
    Route::get('createpizza','PizzaController@createpizza')->name('admin#createpizza');
    Route::post('insertPizza','PizzaController@insertPizza')->name('admin#insertPizza');
    Route::get('deletePizza/{id}','PizzaController@deletePizza')->name('admin#deletePizza');
    Route::get('pizzainfo/{id}','PizzaController@pizzainfo')->name('admin#pizzainfo');
    Route::get('edit/{id}','PizzaController@editPizza')->name('admin#editpizza');
    Route::post('updatePizza/{id}','PizzaController@updatePizza')->name('admin#updatePizza');
    Route::get('pizza/search','PizzaController@searchPizza')->name('admin#searchPizza');
    Route::get('pizza/download','PizzaController@pizzaDownload')->name('admin#pizzaDownload');


    Route::get('userlist','UserController@userlist')->name('admin#userlist');
    Route::get('adminlist','UserController@adminlist')->name('admin#adminlist');
    Route::get('userlist/search','UserController@usersearch')->name('admin#usersearch');
    Route::get('userlist/delete/{id}','UserController@userdelete')->name('admin#userdelete');
    Route::get('adminlist/search','UserController@searchadmin')->name('admin#searchadmin');
    // Route::get('adminlist/delete/{id}','UserController@deleteadmin')->name('admin#deleteadmin');

    Route::get('contact/list','ContactController@contactlist')->name('admin#contactlist');
    Route::get('contact/search','ContactController@contactSearch')->name('admin#contactSearch');

    Route::get('order/list','OrderController@orderList')->name('admin#orderList');
    Route::get('order/search','OrderController@orderSearch')->name('admin#orderSearch');



});

Route::group(['prefix' => 'user','middleware'=>[UserCheckMiddleware::class]] , function(){
    Route::get('/','UserController@index')->name('user#index');
    Route::post('contact/create','Admin\ContactController@createContact')->name('user#createContact');

    Route::get('category/search/{id}','UserController@categorySearch')->name('user#categorySearch');
    Route::get('category/item','UserController@searchItem')->name('user#searchItem');
    Route::get('pizza/details/{id}','UserController@pizzaDetails')->name('user#pizzaDeatils');

    Route::get('search/pizzaItem','UserController@searchPizzaItem')->name('user#searchPizzaItem');

    Route::get('order','UserController@order')->name('user#order');
    Route::post('order','UserController@placeOrder')->name('user#placeOrder');



}); 

