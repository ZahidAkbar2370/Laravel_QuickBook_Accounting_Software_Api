<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get("get-customer", [ApiController::class, "customers"]);
Route::get("get-invoice", [ApiController::class, "invoices"]);
Route::get("create-customer", [ApiController::class, "createCustomer"]);
Route::get("show-customer", [ApiController::class, "showCustomer"]);