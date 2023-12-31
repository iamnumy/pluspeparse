<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\PluspeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;
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

Route::get('/', function () {
    return Inertia::render('app', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/pluspe-csv', [PluspeController::class, 'excelParse']);
Route::post('/upload-excel', [ExcelController::class, 'upload']);
Route::post('/upload-csv', [ExcelController::class, 'uploadCSV']);
