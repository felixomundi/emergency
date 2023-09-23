<?php

use App\Http\Controllers\CommonUser\CasesController;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmailContactController;
use App\Http\Controllers\CommonUser\UserDashboardController;

Auth::routes(["verify" => true,"register"=>true]);

Route::get("/", [App\Http\Controllers\HomeController::class, 'index']);

// unauthorized middleware
Route::middleware(["auth","isUnauthorized"])->group(function (){
    Route::get("/contact", [App\Http\Controllers\HomeController::class, 'contact']);
    Route::post("/contact", [App\Http\Controllers\HomeController::class, 'emailUs']);
    Route::get("/inbox", [App\Http\Controllers\HomeController::class, 'inbox']);
    Route::get("/sent", [App\Http\Controllers\HomeController::class, 'sent']);
    Route::get("/sent/{slug}", [App\Http\Controllers\HomeController::class, 'readmail']);
    Route::get("/contacts/view/{slug}", [App\Http\Controllers\HomeController::class, 'viewContact']);
});


Route::prefix("admin")->middleware(["auth", "isAdmin"])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard");
    Route::get('/change-password', [DashboardController::class, 'changePassword']);
    Route::post('/change-password', [DashboardController::class, 'updatePassword']);
    Route::get('/profile', [DashboardController::class, 'profile']);
    Route::post('/profile', [DashboardController::class, 'profileUpdate']);
//  Users routes
Route::controller(UsersController::class)->group(function () {
    Route::get('/users', 'users')->name("users");
    Route::get('/users/{id}/edit', 'editUser');
    Route::put('/users/{id}/edit', 'updateUser');
    Route::get('/users/create', 'create');
    Route::post('/users/create', 'store');
});

// email contacts controller
Route::controller(EmailContactController::class)->group(function (){
    Route::get("/contacts", "index");
    Route::get("/contacts/{slug}", "readmail");
    Route::get("/contacts/{slug}/reply", "reply");
    Route::put("/contacts/{slug}/reply", "replyEmail");
});


});



// Common User Routes controllers
Route::prefix("user")->middleware(["auth", "isUser"])->group(function(){
Route::get("/dashboard", [UserDashboardController::class, "index"]);
Route::get("/profile", [UserDashboardController::class, "profile"]);
Route::post("/profile", [UserDashboardController::class, "updateProfile"]);
Route::get("/change-password", [UserDashboardController::class, "changePassword"]);
Route::post("/change-password", [UserDashboardController::class, "updatePassword"]);

Route::controller(CasesController::class)->group(function () {
Route::get("/cases", "index");
Route::get("/cases/create", "create");
Route::post("/cases/create", "create");
});


});


// URL::forceScheme('https');

