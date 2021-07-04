<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Models\Employee;

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
    $jumlahpegawai = Employee::count();
    $jumlahlaki = Employee::where('jeniskelamin', 'Laki-laki')->count();
    $jumlahperempuan = Employee::where('jeniskelamin', 'Perempuan')->count();
    return view('welcome', compact('jumlahpegawai', 'jumlahlaki', 'jumlahperempuan'));
});

Route::get('/pegawai', [EmployeeController::class, 'index'])->name('pegawai');

Route::get('/tambahpegawai', [EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai');
Route::post('/insertpegawai', [EmployeeController::class, 'insertpegawai'])->name('insertpegawai');
Route::get('/editpegawai/{id}', [EmployeeController::class, 'editpegawai'])->name('editpegawai');
Route::post('/updatepegawai/{id}', [EmployeeController::class, 'updatepegawai'])->name('updatepegawai');

Route::get('/deletepegawai/{id}', [EmployeeController::class, 'deletepegawai'])->name('deletepegawai');

Route::get('/exportpdf', [EmployeeController::class, 'exportpdf'])->name('exportpdf');
Route::get('/exportexcel', [EmployeeController::class, 'exportexcel'])->name('exportexcel');
Route::post('/importexcel', [EmployeeController::class, 'importexcel'])->name('importexcel');