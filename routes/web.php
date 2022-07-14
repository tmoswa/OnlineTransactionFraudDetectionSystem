<?php

    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\StartupController;
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

Auth::routes();

Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/log', [StartupController::class,'index'])->name('letslogin');
Route::get('/reg', [StartupController::class,'first_reg'])->name('account_register');

Route::post('/freg', [StartupController::class,'register_first'])->name('register_first');


Route::post('/submitOTP',[StartupController::class,'register_otp'])->name('submitOTP');
Route::post('/register_otp', [StartupController::class,'register_otp'])->name('register_otp');
Route::POST('/fitrstotp', [StartupController::class,'register_otp'])->name('fitrstotp');


Route::post('/finreg', [StartupController::class,'register_final'])->name('register_final');

Route::post('/finregistry', [StartupController::class,'finregistry'])->name('finregistry');

Route::get('/fotp', [StartupController::class,'finregistry'])->name('register_first_otp');

Route::get('/transact_online', [StartupController::class,'transact_online'])->name('transact_online');

Route::post('/first_trans', [StartupController::class,'first_trans'])->name('first_trans');

Route::post('/fotp2', [StartupController::class,'register_second_otp'])->name('register_second_otp');

Route::get('/manageclients', [HomeController::class,'manageclients'])->name('manageclients');

Route::get('/activate/{id}', [HomeController::class,'activate'])->name('activate');
Route::get('/viewtrans/{id}', [HomeController::class,'viewtrans'])->name('viewtrans');

Route::get('/changepassword', [HomeController::class,'changepassword'])->name('changepassword');

Route::post('/passchange', [HomeController::class,'passchange'])->name('passchange');













