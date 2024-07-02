<?php

use App\Http\Controllers\ArticleControllerAPI;
use App\Http\Controllers\CartControllerAPI;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CourseControllerAPI;
use App\Http\Controllers\LoginControllerAPI;
use App\Http\Controllers\PostControllerAPI;
use App\Http\Controllers\ProfileControllerAPI;
use App\Http\Controllers\StudentControllerAPI;
use App\Http\Controllers\UserControllerAPI;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('/users', UserControllerAPI::class);
Route::apiResource('/articles', ArticleControllerAPI::class);
Route::apiResource('/profiles', ProfileControllerAPI::class);
Route::apiResource('/posts', PostControllerAPI::class);
Route::apiResource('/students', StudentControllerAPI::class);
Route::apiResource('/courses', CourseControllerAPI::class);
Route::apiResource('/carts', CartControllerAPI::class);

Route::post('/login', [LoginControllerAPI::class, 'login'])->name('loginAPI');
Route::post('/logout', [LoginControllerAPI::class, 'logout'])->name('logoutAPI');
Route::post('/register', [LoginControllerAPI::class, 'register'])->name('registerAPI');
Route::get('/profileuser/{user_id}', [ProfileControllerAPI::class, 'showProfileUser']);
Route::get('/searchcomment/{post_id}/{search}', [PostControllerAPI::class, 'searchCommentContainCharacter']);
Route::get('/searchcomment/{search}', [PostControllerAPI::class, 'searchCommentContainSearchPost']);
Route::post('/addcourse/{student_id}', [StudentControllerAPI::class, 'addCourse']);
Route::get('/students/{name}', [StudentControllerAPI::class, 'searchName']);
Route::post('/savedata', [CityController::class, 'saveData']);
Route::get('/cities', [CityController::class, 'index']);
Route::get('/viewcart', [CartControllerAPI::class, 'viewCart'])->middleware(StartSession::class);
Route::post('/addtocart/{product_id}', [CartControllerAPI::class, 'addToCart'])->middleware(StartSession::class);
Route::delete('/removefromcart/{product_id}', [CartControllerAPI::class, 'removeFromCart'])->middleware(StartSession::class);
Route::get('/getcache', [CartControllerAPI::class, 'getCache']);


