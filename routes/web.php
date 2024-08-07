<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',fn()=>'Anda belum login')->name('login');
Route::middleware('auth')->group(function(){
    Route::get('/hello', fn()=>'ini hello');
       
    });
    // auth untuk mengecek auntivekasi login, manggil secsion

Route::post('world', function () {
    return 'hello world';
});    
// Route::get('/hello', function () {
//     return 'hello';
// });
Route::get('/world', function(){
    return 'world';

});
Route::prefix('product')->group(function(){
 Route::get('laptop',fn()=>'ini laptop');  
 Route::get('hp',fn()=>'ini hp') ;  
});

Route::group(['middleware'=>['auth'],'prefix'=>'dashboard'],function(){
    Route::get('product-page',fn()=>'product-page');
});

Route::get('coba',fn()=>view('coba'));
Route::get('produk/laptop',fn()=>'halaman dashboard')->name('dashboard');

Route::name('kategori.')->prefix('kategoriku.')->group(function(){
    Route::get('/laptop',fn()=>'laptop')->name('laptop');
    Route::get('/hp',fn()=>'hp')->name('hp');
});

Route::get('products/{name}/stok/{stok}',function($name,$stok){
    echo "product $name memiliki stok $stok";
});
Route::resource('categories',PhotoController::class);

Route::get('/',[HomeController::class,'index']);
Route::view('/','welcome');

Route::get('user/{nama}',[HomeController::class,'nama']);
Route::view('post','post');

Route::post('tasks',[HomeController::class,'store'])->name('tasks.store');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('profile/{name}',[ProfileController::class,'index']);//indek adalah sebuah method yang bisa di ganti2
// Route::resource('categories',CategoryController::class);//resource karena mau membuat crud
// Route::resources([
//     'categories'=>CategoryController::class,
//     'tasks'=>TaskController::class
// ]);
Route::middleware('auth')->prefix('dashboard')->group(function(){
    Route::resources([
        'categories'=>CategoryController::class,
        'tasks'=>TaskController::class
    ]);

});
//midlewarwe untuk pengamanan apabila skses lewat url
//auth hanya di tampilan saja

