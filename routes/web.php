<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Models\Category;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});









Route::middleware('auth')->group(function () {
    Route::resource('colocations', ColocationController::class);
    // Route::resource('users', UserControlle::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('requests', RequestController::class);


    Route::get('/', [DashboardController::class , 'index'])->name("dashboard");
    Route::get('/dashboard', [DashboardController::class , 'index'])->name("dashboard");


    Route::patch('/requests/{id}/reject', [RequestController::class , 'reject'])->name("requests.reject");
    Route::patch('/requests/{id}/accept', [RequestController::class , 'accept'])->name("requests.accept");


    Route::patch('/membership/kick', [MembershipController::class , 'kick'])->name("memberships.kick");
});











require __DIR__ . '/auth.php';
