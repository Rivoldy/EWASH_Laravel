<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ViewModel;
use App\Http\Controllers\MenuModel;
use App\Http\Controllers\PrivilegeKlegoSambi;
use App\Http\Controllers\MfactoryModel;
use App\Http\Controllers\AllocateController;
use App\Http\Controllers\ReportAWController;
use App\Http\Controllers\ReportPCLController ;
use App\Http\Controllers\ReportAWRFIDController;
use App\Http\Controllers\ReportAWdetailController;
use App\Http\Controllers\MasterGramasiController;
use App\Http\Controllers\ReportOrderController;
use App\Http\Controllers\SendOutController;
use App\Http\Controllers\SendOutRFID;
use App\Http\Controllers\scanplController;
use App\Http\Controllers\detailplController;
use App\Http\Controllers\detailplRfidController;
use App\Http\Controllers\scanplRfidController;
use App\Http\Controllers\detailAWplRfidController;
use App\Http\Controllers\AdminclearRfidController;
use App\Http\Controllers\UnpackController;

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
    Route::resource('privilegeKlegoSambi', PrivilegeKlegoSambi::class);

    Route::get('GroupAccess/getSidebarMenu/', [ViewModel::class, 'getSidebarMenu'])->name('GroupAccess.getSidebarMenu');


    Route::resource('GroupAccess', ViewModel::class)->except(['create', 'show']);
    
    Route::get('prevedit_group_access/{id}', [ViewModel::class, 'edit2'])->name('GroupAccess.edit2');
   
    Route::delete('GroupAccess/{group_access_name}', [ViewModel::class, 'destroy'])->name('GroupAccess.destroy');

    Route::get('GroupAccess/editPrivilege/{id}', [ViewModel::class, 'editPrivilege'])->name('GroupAccess.editPrivilege');

    Route::post('GroupAccess/updateBatch/{id}', [ViewModel::class, 'updateBatch'])->name('GroupAccess.updateBatch');

    //rep_afterwash_actpl
    Route::get('report-aw', [ReportAWController::class, 'index'])->name('reportAW.index');
    Route::post('/report-aw/generate', [ReportAWController::class, 'generateReport'])->name('reportAW.generate');
    Route::post('/report-aw/get-data', [ReportAWController::class, 'getData'])->name('reportAW.getData');
    //rep_packlist
    Route::get('report', [ReportPCLController ::class, 'index']);
    
    //
    Route::get('reportAWRFID', [ReportAWRFIDController ::class, 'index']);
    //
    Route::get('reportAWdetail', [ReportAWdetailController ::class, 'index']);
    //master gramasi 
    Route::get('MasterGramasi', [MasterGramasiController ::class, 'index']);
    Route::post('gramasi/getData', [MasterGramasiController::class, 'getData'])->name('gramasi.getData');
    Route::post('gramasi/getgram', [MasterGramasiController::class, 'getGram'])->name('gramasi.getgram');
    Route::post('gramasi/savegram', [MasterGramasiController::class, 'saveGram'])->name('gramasi.savegram');
    //
    Route::get('ReportOrderStat', [ReportOrderController ::class, 'index']);
    //
    Route::get('SendOut', [SendOutController ::class, 'index']);
    //
    Route::get('SendOutRFID', [SendOutRFID ::class, 'index']);
    //
    Route::get('Scanpl', [scanplController ::class, 'index']);
    //
    Route::get('Detailpl', [detailplController ::class, 'index']);
    //
    Route::get('DetailplRFID', [detailplRfidController ::class, 'index']);
    //
    Route::get('ScanplRFID', [scanplRfidController ::class, 'index']);
    //
    Route::get('DetailAWRFID', [detailAWplRfidController ::class, 'index']);
    //
    Route::get('ClearRFID', [AdminclearRfidController ::class, 'index']);
    //
    Route::get('UnPack', [UnpackController ::class, 'index']);
    
}); 

