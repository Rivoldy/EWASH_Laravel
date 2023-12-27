<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ViewModel;
use App\Http\Controllers\MenuModel;
use App\Http\Controllers\MfactoryModel;
use App\Http\Controllers\PrivilegeGroupAccess;

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

Route::post('loginApi',[LoginController::class,'loginApi'])->name('loginApi');

// Route::group(['middleware' => ['ewash']], function () {
//     Route::get('home', [HomeController::class, 'home'])->name('home');
// });
Route::group(['middleware' => 'DisableBack'], function()
{
    Route::get('login',[LoginController::class,'login'])->name('login');
});
Route::group(['middleware' => 'customAuth'], function()
{
    Route::post('logout',[LogoutController::class,'logout'])->name('logout');
    Route::get('home', [HomeController::class,'home'])->name('home');
    Route::resource('GroupAccess', ViewModel::class);
    Route::resource('menu', MenuModel::class);
    Route::resource('mfactory', MfactoryModel::class);

    Route::resource('PreGroupAccess', PrivilegeGroupAccess::class);

    Route::resource('GroupAccess', ViewModel::class)->except(['create', 'show']);
    
   
    Route::delete('GroupAccess/{group_access_name}', [ViewModel::class, 'destroy'])->name('GroupAccess.destroy');
    Route::get('GroupAccess/{group_access_name}/edit', [ViewModel::class, 'edit'])->name('GroupAccess.edit');

// Route::get('GroupAccess/{group_access_name}/edit', [ViewModel::class, 'edit'])->name('GroupAccess.edit');
   // Route::resource('menu', MenuModel::class)->except(['create', 'show']);

}); 
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
