<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;

Route::get('/', [FamilyController::class, 'index']);