<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportController;
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

Route::get('/', [IndexController::class, "index"]);
Route::get('/dashboard', [IndexController::class, "index"]);
Route::get('/dashboard/users', [DashboardController::class, "totaluser"]);
Route::get('/dashboard/bandwith', [DashboardController::class, "total_bandwidth_user"]);
Route::get('/dashboard/network_activity', [DashboardController::class, "total_activity_done"]);
Route::get('/dashboard/traffic', [DashboardController::class, "network_traffic"]);
Route::get('/dashboard/ipactivity', [DashboardController::class, "device_activity"]);
Route::get('/dashboard/ip', [DashboardController::class, "ip"]);
Route::get('/dashboard/apps', [DashboardController::class, "ip_applications"]);
Route::get('/details/{traffic_sourceIP}', [DeviceController::class, "device_details"]);
Route::get('/details/{traffic_sourceIP}/network', [DeviceController::class, "network_traffic"]);
Route::get('/login', [IndexController::class, "index"]);
Route::post('/login', [LoginController::class, "authenticate"])->name('login');
Route::post('/register', [RegistrationController::class, "register"])->name('register');
Route::post('/logout', [LoginController::class, "logout"])->name("logout");
Route::get('/report', [ReportController::class, "index"]);
Route::post('/ClearTraffic', [DashboardController::class, "clear_activity"]);
Route::get('/profile', [ProfileController::class, "profile"]);
Route::post('/report', [ReportController::class, "preview"])->name('report');
Route::post('/download', [ReportController::class, "generate_report"])->name('download');
Route::get("/python", [IndexController::class, "network_scripts"]);