<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FamilyMemberController;

Route::get('/', [FamilyController::class, 'index']);
Route::get('/families', [FamilyController::class, 'index'])->name('families.index');
Route::get('/families/{id}', [FamilyController::class, 'view'])->name('families.view');
Route::get('/families/{id}/members', [FamilyMemberController::class, 'view'])->name('families.members.view');