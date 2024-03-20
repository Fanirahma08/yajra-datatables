<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/company/exportPDF', [CrudController::class, 'exportPDF']);
Route::get('/company/exportId/{id}', [CrudController::class, 'exportId']);
Route::resource('company', CrudController::class);
Route::post('delete-company', [CrudController::class,'destroy']);
