<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
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

/* Route::get('/hello', function(){
    return response('<h1>Hello</h1>')
        -> header('content-type','text/plain');
});

Route::get('/posts/{id}', function($id){
    // dd($id);
    return response('Posts: '.$id);
})->where('id','[0-9]+');

Route::get('/search', function(Request $request){       // dependency Injection (passing values(name, job) through url) 
    dd($request);
    return $request->name.' '.$request->job;
});
 */

// All listings
Route::get('/', [ListingController::class, 'index']);

// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store a job entry
Route::post('/listings',[ListingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{id}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Edit-Submit Update
Route::put('/listings/{id}', [ListingController::class, 'update'])->middleware('auth');

// Entry Delete
Route::delete('/listings/{id}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage',[ListingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{id}', [ListingController::class, 'show']);



// USER ROUTES

// Show register form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// User Registration 
Route::post('/users', [UserController::class, 'store']);

// User Logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login',[UserController::class, 'login'])->name('login')->middleware('guest');

// User Login Process
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

