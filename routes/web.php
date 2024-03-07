<?php
use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

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

    //---------------- READ ----------------
Route::get('/', [CrudController::class, 'index'])->name('productos.index');
Route::get('/productos/{id}', [CrudController::class, 'show'])->name('productos.show');
// Route::get('/productos/search', [CrudController::class, 'search'])->name('productos.search');

    //---------------- CREATE ----------------
Route::post('/productos', [CrudController::class, 'create'])->name('productos.store');

    //---------------- UPDATE ----------------
Route::put('/productos/{id}', [CrudController::class, 'update'])->name('productos.update');

    //---------------- DELETE ----------------
Route::delete('/productos/{id}', [CrudController::class, 'destroy'])->name('productos.destroy');
