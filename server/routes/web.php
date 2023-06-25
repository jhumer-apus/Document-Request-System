<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;
use App\Mail\SignUp;
use App\Mail\NotifyStatus;
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
    $data = (object) array(
        'document_name' => "Cedula",
        'status' => "completed",
        'comment'=>"Love you",
        'fee' => "100.00",
        'admin_name' => "Boyaks Mix"
    );
    return new NotifyStatus($data);
});

Route::post('/message', function () {
    return response()->json(["message"=>"hi"]);
});

Route::get('/email', function(){
    // Mail::to('jumboy@yopmail.com')->send(new ForgotPassword("DSFW"));
    return new SignUp("DSFW");
});