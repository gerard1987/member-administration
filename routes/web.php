<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FamilyMemberController;

Route::get('/', [FamilyController::class, 'index']);
Route::get('/families', [FamilyController::class, 'index'])->name('families.index');
Route::get('/families/{id}', [FamilyController::class, 'view'])->name('families.view');
Route::delete('/families/{id}', [FamilyController::class, 'delete'])->name('families.delete');

Route::get('/families/{family_id}/members/{member_id}', [FamilyMemberController::class, 'view'])->name('families.members.view');
Route::delete('/families/{family_id}/members/{member_id}', [FamilyMemberController::class, 'delete'])->name('families.members.delete');