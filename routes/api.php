<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('/user', [UserController::class, 'current']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);


    Route::get('/posts',[PostController::class,'index']);
    Route::get('/posts/{post}',[PostController::class,'show']);

    Route::get('/messages/user1/{user1}/user2/{user2}',[MessageController::class,'getMessageOfBoth']);

    Route::get('/interests' , [InterestController::class,'index']);
    Route::post('/interests' , [InterestController::class,'store']);
    Route::get('/interests/{interest}' , [InterestController::class,'show']);
    Route::put('/interests/{interest}' , [InterestController::class,'update']);
    Route::delete('/interests/{interest}' , [InterestController::class,'destroy']);

    Route::get('/admins', [AdminController::class,'index']);
    Route::post('/admins' , [AdminController::class,'store']);
    Route::get('/admins/{admin}' , [AdminController::class,'show']);
    Route::put('/admins/{admin}' , [AdminController::class,'update']);
    Route::delete('/admins/{admin}' , [AdminController::class,'destroy']);

    Route::get('/roles', [RoleController::class,'index']);
    
    // Route::get('/friends/{user}', 'FriendController@getFriend');
    // Route::get('/friends/request/{user}','FriendController@getRequest');
    // Route::post('/friends/{id}','FriendController@updateStatusFriend');
    // Route::get('/friends/status/{username}', 'FriendController@getStatusFriend');
    // Route::get('/friends/count/{username}', 'FriendController@getCountFriend');

    // Route::get('/posts/friend/{user}', 'PostController@getPostFriend');

    // Route::get('/interests/people/{user}', 'InterestController@getPeople');
    // Route::get('/interests','InterestController@index');
    // Route::get('/interests/{user}', 'InterestController@showId');
    // Route::get('/interests/name/{username}','InterestController@show');
    // Route::put('/interests/{user}', 'InterestController@update');

    Route::patch('settings/profile', [ProfileController::class,'update']);
    Route::patch('settings/password', [PasswordController::class,'update']);

    // Route::get('/messages/from/{username}','MessageController@getMessage');
    // Route::post('/messages','MessageController@store');

    // Route::post('/search', 'UserController@searchUser');

    // Route::patch('settings/profile', [ProfileController::class, 'update']);
    // Route::patch('settings/password', [PasswordController::class, 'update']);
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
});
