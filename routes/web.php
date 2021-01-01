<?php

use App\Http\Controllers\IPAddressController;
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
    return redirect('dashboard');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    Route::get('ipaddress-list', [IPAddressController::class, 'index']);
    Route::post('ipaddress-save', [IPAddressController::class, 'store']);
    Route::get('ipaddress-audit-logs/{ip}', [IPAddressController::class, 'auditLogs']);
});

require __DIR__.'/auth.php';


