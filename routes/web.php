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
// Read
Route::get("/",[CrudController::class,"index"])->name("crud.index");

// Create
Route::post("/register",[CrudController::class,"create"])->name("crud.create");

// Update
Route::post("/update",[CrudController::class,"update"])->name("crud.update");

// Delete
Route::get("/delete-{id}",[CrudController::class,"delete"])->name("crud.delete");
