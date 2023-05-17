<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\AdminRequestController;
use App\Http\Controllers\API\RequestController;
use App\Models\ForgotPassword;
use Illuminate\Support\Facades\Storage;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/auth')->group(function(){
        Route::get('/user', [UserController::class, 'index']);
        Route::get('/admin', function(){
            return response()->json(['message'=>'ola soy dora']);
        });
        Route::get('/test',function(){
            return response()->json(Auth::user());
        });
    });
    Route::prefix('user')->group(function(){
        Route::get('/get-details', [UserController::class, 'getDetails']);
        Route::put('/update-user', [UserController::class, 'updateInfo']);
        Route::get('/request/get-slots',[RequestController::class, 'getSlots']);
        Route::get('/documents', [RequestController::class, 'getDocuments']);
        Route::post('/submit-request', [RequestController::class, 'submitRequest']);
        Route::post('/upload-photo', [UserController::class, 'uploadPhoto']);
        Route::get('/profile-pic', [UserController::class, 'getProfilePic']);
        Route::get('/count-request', [RequestController::class, 'countRequest']);
    });

    Route::prefix('admin')->group(function(){
        Route::get('/get-details', [AdminController::class, 'getDetails']);
        Route::post('/store', [AdminController::class, 'store']);
        Route::get('send-code', [AdminController::class, 'sendCode']);
        Route::put('verify-account', [AdminController::class, 'verify']);
        Route::get('/verify-code-password', [AdminController::class, 'verifyCodePassword']);
        Route::put('/update-password', [AdminController::class, 'updatePassword']);
        Route::put('/update-user', [AdminController::class, 'updateInfo']);
        Route::get('/request/get-slots',[AdminRequestController::class, 'getSlots']);
        Route::get('/documents', [AdminRequestController::class, 'getDocuments']);
        Route::post('/submit-request', [AdminRequestController::class, 'submitRequest']);
        Route::post('/upload-photo', [AdminController::class, 'uploadPhoto']);
        Route::get('/profile-pic', [AdminController::class, 'getProfilePic']);
        Route::get('/get-requests/{status}', [AdminRequestController::class, 'index']);
        Route::get('/get-request/{id}', [AdminRequestController::class, 'getRequestDetails']);
        Route::get('/count-request', [AdminRequestController::class, 'countRequest']);
        Route::get('/requests/get-pdf/{path}', [AdminRequestController::class, 'getPDF']);
        Route::put('/requests/update-status', [AdminRequestController::class, 'updateRequestStatus']);
        Route::get('/get-reports', [AdminRequestController::class, 'getReports']);
        Route::get('/get-all-reports', [AdminRequestController::class, 'getAllReports']);
        
    });
});

Route::prefix('user')->group(function(){
    Route::post('/store', [UserController::class, 'store']);
    Route::post('/resend-email', [UserController::class, 'resendEmail']);
    Route::get('/check-email',[UserController::class, 'checkEmail']);
    Route::get('/send-code', [UserController::class, 'sendCode']);
    Route::put('verify-account', [UserController::class, 'verify']);
    Route::get('/verify-code-password', [UserController::class, 'verifyCodePassword']);
    Route::put('/update-password', [UserController::class, 'updatePassword']);
    Route::get('/get-requests/{status}', [RequestController::class, 'index']);

});


Route::get('/test/get-pdf',function(){
    $file = Storage::get('public/supporting_documents/1683819565_RESUME - APUS.pdf');
    return $file;
    
    // return response()->json(['path'=>$link]);
});




// Route::get('/test', function(){
//     Log::info(Auth::user());
//     return response()->json(Auth::user());
// });
include_once 'auth/login.php';

