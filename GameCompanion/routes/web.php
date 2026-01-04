<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\NotesController;

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

Route::get('/', function() { return View('index'); });

Route::get('/games', [GamesController::class, 'index'])->name('games.index');

Route::get('/games/add', [GamesController::class, 'add'])->name('games.add');

Route::get('/games/{id}/edit', [GamesController::class, 'edit'])->name('games.edit');   

Route::post('/games/store', [GamesController::class, 'store'])->name('games.store');

Route::put('/games/{id}', [GamesController::class, 'update'])->name('games.update');

Route::post('/games/steam/import', [GamesController::class, 'steamImport'])->name('games.steam.import');

Route::delete('/games/{id}', [GamesController::class, 'destroy'])->name('games.destroy');



Route::get('/games/{id}/notes', [NotesController::class, 'index'])->name('games.notes.index');

Route::get('/games/{id}/notes/add', [NotesController::class, 'add'])->name('notes.add');