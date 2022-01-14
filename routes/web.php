<?php

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

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\NumberController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SalesChannelController;
use App\Http\Controllers\UserController;

Route::middleware(['admin.auth'])->prefix("admin")->group(function () {
    Route::view('dashboard', 'dashboard')->name("admin.dashboard");
    Route::get('claims', [ClaimController::class, "index"])->name("claims.index");
    Route::get('users', [UserController::class, "index"])->name("users.index");
    Route::get('claims/{claim}', [ClaimController::class, "edit"])->name("claims.edit");
    Route::put('claims/{claim}', [ClaimController::class, "update"])->name("claims.update");
    Route::get('sales-channels', [SalesChannelController::class, "index"])->name("sales.channel");
    Route::get('sales-channels/{id}', [SalesChannelController::class, "destroy"])->name("sales.delete");
    Route::post('sales-channels', [SalesChannelController::class, "store"])->name("sales.store");
    Route::get('items', [ItemController::class, "index"])->name("items.index");
    Route::get('items/create', [ItemController::class, "create"])->name("items.create");
    Route::post('items/create', [ItemController::class, "store"])->name("items.store");
    Route::get('items/import-csv', [ItemController::class, "getImport"])->name("items.csv.view");
    Route::post('items/parse-csv', [ItemController::class, "parseImport"])->name("items.csv.parse");
    Route::post('items/process-csv', [ItemController::class, "processImport"])->name("items.csv.process");
    Route::post('admin/logout', [AdminAuthController::class, "logout"])->name("admin.logout");
    Route::get('admin/change-password', [AdminAuthController::class, "changePwd"])->name("admin.change-password");
    Route::post('admin/change-password', [AdminAuthController::class, "changePassword"])->name("admin.change.password");
});

Route::get('/', [ClaimController::class, "userView"])->name("claim.view");
Route::post("claim", [ClaimController::class, "store"])->name("claim.store");


Route::middleware(['admin.guest'])->prefix("auth")->group(function(){
    Route::view('login', 'pages.auth.login')->name("admin.login.view");
    Route::post('login', [AdminAuthController::class, "login"])->name("admin.login");
    // Route::get('register', function () { return view('pages.auth.register'); });
});


Route::middleware(['guest'])->group(function () {
    Route::view("login", "pages.user.login")->name("user.login.view");
    Route::post("login", [AuthController::class, "login"])->name("user.login");
});
Route::middleware(['auth'])->group(function () {
    Route::get("home", [HomeController::class, "view"])->name("home");
    Route::get("/change-password", [HomeController::class, "changePasswordView"])->name("user.changepwd");
    Route::post("/change-password", [AuthController::class, "changePassword"])->name("user.change.password");
    Route::get("claims/escalate/{claim:id}", [ClaimController::class, "escalateByUser"])->name("claims.escalatebyuser");
    Route::post("logout", [AuthController::class, "logout"])->name("user.logout");
});

Route::group(['prefix' => 'error'], function(){
    Route::get('404', function () { return view('pages.error.404'); });
    Route::get('500', function () { return view('pages.error.500'); });
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('pages.error.404');
})->where('page','.*');