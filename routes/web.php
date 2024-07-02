<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAgeValid;
use App\Http\Middleware\CheckRoleValid;
use App\Http\Middleware\HandleThrottleRequest;

Route::get("/products",[
    ProductsController::class,
    "index"
])->name("index")->middleware(CheckRoleValid::class); // route's name
Route::get("/products/{productName}/{id}",[
    ProductsController::class,
    "detail"
]) -> where([
    'id' => '[0-9]+',
    "productName" => "[a-zA-Z0-9]+"
]);
Route::resource("authors",AuthorController::class);
Route::resource("articles",ArticleController::class);
Route::resource("categories",CategoryController::class)->middleware(CheckAgeValid::class);
Route::resource("posts",PostController::class);

Route::get('/', [LoginController::class,'index'])
// ->middleware(HandleThrottleRequest::class.":2,1")
;
Route::post("/login",[LoginController::class,"login"])->name("login");
Route::get('/showRegister', [LoginController::class,'showRegister'])->name('showRegister');
Route::post('/register', [LoginController::class,'register'])->name('register');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');
Route::get('/forgotpassword', [LoginController::class,'showForgotPassword'])->name('showforgotPassword');
Route::get('/showotp', [LoginController::class,'showOTP'])->name('showOTP');
Route::get('/showresetpassword',[LoginController::class,'showResetPassword'])->name('showResetPassword');
Route::post('resetpassword', [LoginController::class,'resetPassword'])->name('resetPassword');
Route::post('/confirmemail', [LoginController::class,'confirmEmail'])->name('confirmEmail');
Route::post('/verifyotp', [LoginController::class,'verifyOTP'])->name('verifyOTP');
Route::get('/home', function () {
    return view('home');
});
Route::get('/trash',[ArticleController::class,'showTrash'])->name('articles.trash');
Route::get('/restore/{article_id}',[ArticleController::class,'restore'])->name('articles.restore');
Route::delete('/focusdelete/{article_id}',[ArticleController::class,'forceDelete'])->name('articles.forcedelete');

