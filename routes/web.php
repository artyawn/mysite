<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthRegController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;

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
Route::get('/login',[AuthRegController::class,'login'])->name('login');
Route::post('/login',[AuthRegController::class,'signin'])->name('signin');
Route::get('/logout',[AuthRegController::class,'logout'])->name('logout');
Route::get('/register',[AuthRegController::class, 'reg'])->name('register');
Route::post('/register',[AuthRegController::class, 'store'])->name('user.store');


Route::get('/tasks',[TaskController::class, 'index'])->name('task.index');
Route::get('/tasks/create/{group}',[TaskController::class, 'create'])->name('task.create');
Route::get('/tasks/createOwn/',[TaskController::class, 'createOwn'])->name('task.createOwn');
Route::post('/tasks',[TaskController::class, 'store'])->name('task.store');
Route::post('/tasksOwn',[TaskController::class, 'storeOwn'])->name('task.storeOwn');
Route::get('/tasks/{task}/edit',[TaskController::class, 'edit'])->name('task.edit');
Route::patch('/tasks/{task}',[TaskController::class, 'update'])->name('task.update');
Route::delete('/tasks/{task}',[TaskController::class, 'destroy'])->name('task.delete');
Route::post('/tasks/custom',[TaskController::class, 'custom'])->name('task.custom');
Route::patch('/tasks/{task}/editStatus',[TaskController::class, 'editStatus'])->name('task.editStatus');


Route::get('/groups',[GroupController::class, 'index'])->name('group.index');
Route::get('/groups/create',[GroupController::class, 'create'])->name('group.create');
Route::get('/groups/{group}/edit',[GroupController::class, 'edit'])->name('group.edit');
Route::get('/groups/{group}',[GroupController::class, 'show'])->name('group.show');
Route::post('/groups/add/{group}',[GroupController::class, 'addWorker'])->name('add.worker');
Route::patch('/groups/update/{group}',[GroupController::class, 'updateTitle'])->name('group.updateTitle');
Route::get('/groups/custom/{group}',[GroupController::class, 'custom'])->name('group.custom');
Route::post('/groups',[GroupController::class, 'store'])->name('group.store');
Route::delete('/groups/{group}',[GroupController::class,'destroy'])->name('group.delete');
Route::delete('/groups/{group}/edit/{user}',[GroupController::class, 'deleteWorker'])->name('delete.worker');
Route::delete('/groups/{group}/{task}',[GroupController::class, 'deleteTask'])->name('group.task.delete');
