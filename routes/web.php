<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FamilyMemberController;

Route::get('/', [FamilyController::class, 'index']);
Route::get('/families', [FamilyController::class, 'index'])->name('families.index');
Route::post('/families', [FamilyController::class, 'create'])->name('families.create');
Route::get('/families/{id}', [FamilyController::class, 'view'])->name('families.view');
Route::delete('/families/{id}', [FamilyController::class, 'delete'])->name('families.delete');

Route::get('/families/{family_id}/members/{member_id}', [FamilyMemberController::class, 'view'])->name('families.members.view');
Route::post('/families/{id}/family_member', [FamilyMemberController::class, 'create'])->name('families.create.member');
Route::delete('/families/{family_id}/members/{member_id}', [FamilyMemberController::class, 'delete'])->name('families.members.delete');