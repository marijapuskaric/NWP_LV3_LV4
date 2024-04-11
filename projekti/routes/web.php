<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//ruta za prikaz stranice za dodavanje novog projekta
Route::get('/createproject', function (){
    return view('projects.createProject');
});
//ruta za spremanje novog projekta u bazu
Route::post('/project', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.store');
//ruta za prikaz profila korisnika
Route::get('/profile', [App\Http\Controllers\ProjectController::class, 'show'])->name('project.profile');
//ruta za dohvacanje svih korisnika kod dodavanja korisnika na projekte
Route::get('/adduser/{id}', [App\Http\Controllers\ProjectController::class, 'getUsers'])->name('project.addUserProject');
//ruta za dodavanje korisnika na projekte
Route::post('/adduser/{id}', [App\Http\Controllers\ProjectController::class, 'addUserProject'])->name('project.addUsers');
//ruta za prikaz stranice za uredivanje projekta kao voditelj projekta
Route::get('/editprojectmanager/{id}', [App\Http\Controllers\ProjectController::class, 'editProjectManager'])->name('project.editManager');
//ruta za prikaz stranice za uredivanje projekta kao clan tima
Route::get('/editprojectuser/{id}', [App\Http\Controllers\ProjectController::class, 'editProjectUser'])->name('project.editUser');
//ruta za spremanje promjena na projektu kao voditelj projekta
Route::post('/updateprojectmanager/{id}', [App\Http\Controllers\ProjectController::class, 'updateProjectManager'])->name('project.updateManager');
//ruta za spremanje promjena na projektu kao clan tima
Route::post('/updateprojectuser/{id}', [App\Http\Controllers\ProjectController::class, 'updateProjectUser'])->name('project.updateUser');



