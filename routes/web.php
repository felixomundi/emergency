<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SalaryTypeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AreasofWorkController;
use App\Http\Controllers\Manager\ManagerDashboard;
use App\Http\Controllers\UserAllowancesController;
use App\Http\Controllers\UserAttendanceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmailContactController;
use App\Http\Controllers\UserAdvanceController;
use App\Http\Controllers\AssignUserSalariesController;
use App\Http\Controllers\CommonUser\UserDashboardController;
use App\Http\Controllers\PurposeController;
use App\Http\Controllers\UserDeductionController;

Auth::routes(["verify" => true,"register"=>false]);

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
Route::get("/transactions",[TransactionsController::class, "index"]);
//  Users routes
Route::controller(UsersController::class)->group(function () {
    Route::get('/users', 'users')->name("users");
    Route::get('/users/{id}/edit', 'editUser');
    Route::put('/users/{id}/edit', 'updateUser');
    Route::get('/users/create', 'create');
    Route::post('/users/create', 'store');

});

// areas of work routes
Route::controller(AreasofWorkController::class)->group(function () {
    Route::get('/areas-of-work', 'index');
    Route::get("/areas-of-work/create", "create");
    Route::post("/areas-of-work/create", "store");
    Route::get("/areas-of-work/{id}/edit", "edit");
    Route::put("/areas-of-work/{id}/edit", "update");
});

// department routes
Route::controller(DepartmentController::class)->group(function () {
    Route::get('/departments', 'index');
    Route::get("/departments/create", "create");
    Route::post("/departments/create", "store");
    Route::get("/departments/{id}/edit", "edit");
    Route::put("/departments/{id}/edit", "update");
});


// positions routes
Route::controller(PositionsController::class)->group(function () {
    Route::get('/positions', 'index');
    Route::get("/positions/create", "create");
    Route::post("/positions/create", "store");
    Route::get("/positions/{id}/edit", "edit");
    Route::put("/positions/{id}/edit", "update");
});


// salary types  routes
Route::controller(SalaryTypeController::class)->group(function () {
    Route::get('/salary/types', 'index');
    Route::get("/salary/types/create", "create");
    Route::post("/salary/types/create", "store");
    Route::get("/salary/types/{id}/edit", "edit");
    Route::put("/salary/types/{id}/edit", "update");
});

// assign user salaries
Route::controller(AssignUserSalariesController::class)->group(function () {
    Route::get('/manage-salary', 'index');
    Route::get("/manage-salary/create", "create");
    Route::post("/manage-salary/create", "store");
    Route::get("/manage-salary/{id}/edit", "edit");
    Route::put("/manage-salary/{id}/edit", "update");
});

// user attendancies
Route::controller(UserAttendanceController::class)->group(function () {
    Route::get('/user_attendancies', 'index');
    Route::get("/user_attendancies/create", "create");
    Route::post("/user_attendancies/create", "store");
    Route::get("/user_attendancies/edit/{id}", "edit");
    Route::put("/user_attendancies/edit/{id}", "update");
});

// user allowances
Route::controller(UserAllowancesController::class)->group(function () {
    Route::get('/user_allowances', 'index');
    Route::get("/user_allowances/create", "create");
    Route::post("/user_allowances/create", "store");
    Route::get("/user_allowances/edit/{id}", "edit");
    Route::put("/user_allowances/edit/{id}", "update");
});

// user deductions
Route::controller(UserDeductionController::class)->group(function () {
    Route::get('/user_deductions', 'index');
    Route::get("/user_deductions/create", "create");
    Route::post("/user_deductions/create", "store");
    Route::get("/user_deductions/edit/{id}", "edit");
    Route::put("/user_deductions/edit/{id}", "update");
});

//user advance
Route::controller(UserAdvanceController::class)->group(function(){
Route::get("/advance", "index");
Route::get("/advance/create", "create");
Route::post("/advance/create", "store");
Route::get("/advance/edit/{id}", "edit");
Route::put("/advance/edit/{id}", "update");
});



//purpose routes
Route::controller(PurposeController::class)->group(function(){
    Route::get("/purpose", "index");
    Route::get("/purpose/create", "create");
    Route::post("/purpose/create", "store");
    Route::get("/purpose/edit/{id}", "edit");
    Route::put("/purpose/edit/{id}", "update");
    });


// email contacts controller
Route::controller(EmailContactController::class)->group(function (){
    Route::get("/contacts", "index");
    Route::get("/contacts/{slug}", "readmail");
    Route::get("/contacts/{slug}/reply", "reply");
    Route::put("/contacts/{slug}/reply", "replyEmail");

});
});




Route::prefix("manager")->middleware(["auth", "isManager" ])->group(function(){
Route::get("/dashboard", [ManagerDashboard::class, "index"]);
Route::get("/profile", [ManagerDashboard::class, "profile"]);
Route::post("/profile", [ManagerDashboard::class, "updateProfile"]);
Route::get("/change_password", [ManagerDashboard::class, "changePassword"]);
Route::post("/change_password", [ManagerDashboard::class, "updatePassword"]);


});


// Common User Routes controllers
Route::prefix("user")->middleware(["auth", "isUser"])->group(function(){
Route::get("/dashboard", [UserDashboardController::class, "index"]);
Route::get("/profile", [UserDashboardController::class, "profile"]);
Route::post("/profile", [UserDashboardController::class, "updateProfile"]);
Route::get("/change-password", [UserDashboardController::class, "changePassword"]);
Route::post("/change-password", [UserDashboardController::class, "updatePassword"]);


// // Student routes
// Route::controller(ReceptionStudentsController::class)->group(function () {
//     Route::get('/students', 'students');
//     Route::get('/create_student', 'create');
//     Route::post('/create_student', 'store');
//     Route::get('/students/{id}', 'view');
//     Route::put('/students/{id}', 'updateStudent');
// });


});


// URL::forceScheme('https');

