<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'login_index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register_index'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [FamilyController::class, 'index']);
    Route::get('/families', [FamilyController::class, 'index'])->name('families.index');
    Route::get('/families/{id}', [FamilyController::class, 'view'])->name('families.view');
    Route::post('/families', [FamilyController::class, 'create'])->name('families.create');
    Route::post('/families/{id}', [FamilyController::class, 'edit'])->name('families.edit');
    Route::delete('/families/{id}', [FamilyController::class, 'delete'])->name('families.delete');

    Route::get('/families/{family_id}/members/{member_id}', [FamilyMemberController::class, 'view'])->name('families.members.view');
    Route::post('/families/{id}/family_member', [FamilyMemberController::class, 'create'])->name('families.create.member');
    Route::post('/families/{family_id}/members/{member_id}/edit', [FamilyMemberController::class, 'edit'])->name('families.members.edit');
    Route::delete('/families/{family_id}/members/{member_id}', [FamilyMemberController::class, 'delete'])->name('families.members.delete');
});