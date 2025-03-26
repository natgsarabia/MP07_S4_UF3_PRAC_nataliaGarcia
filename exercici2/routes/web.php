<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuariController;

//Primer definim la ruta per la pagina inicial (que será el metode get)
Route::get('/usuaris', [UsuariController::class, 'getUsers']);

//Definim les rutes per la reste de metodes
Route::put('/usuaris/{id}', [UsuariController::class, 'putUsers'])->name('usuaris.update');
Route::post('/usuaris', [UsuariController::class, 'postUsers']);
Route::delete('/usuaris', [UsuariController::class, 'deleteUsers']);

//Definim la ruta blade per mostrar la graella d'usuaris actuals per actualitzar usuaris
Route::get('/putUsuaris', function(){
    $usuaris = \App\Models\Usuari::all(); // Obtenir els usuaris actuals
    return view('edit', compact('usuaris'));
})->name('putUsuaris');

//Definim la ruta blade per mostrar el formulari per crear un nou usuari
Route::get('/postUsuaris', function(){
    return view('create');
})->name('postUsuaris');

//Definim la ruta blade per mostrar la graella d'usuaris actuals  per eliminar un nou usuari
Route::get('/deleteUsuaris', function(){
    $usuaris = \App\Models\Usuari::all(); // Obtenir els usuaris actuals
    return view('delete', compact('usuaris'));
})->name('deleteUsuaris');
